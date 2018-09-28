<?php
$fileUrl = $_GET["file"] ?? null;
if (!isset($fileUrl) || empty($fileUrl)) {
	errorPage('400 Bad Request', 'Invalid link.', 'You should supply a "file" parameter that contains the file URL to be downloaded.');
}

// Load WordPress
require_once(rtrim($_SERVER['DOCUMENT_ROOT'], '/') . '/wp-load.php');
$redirectKey = strtolower(get_field('redirect_key', 'option'));
if ($redirectKey && !empty($redirectKey)) {
	// Validate redirect - was it generated by rockharbor.org?
	if (!isset($_GET['key']) || empty($_GET['key'])) {
		errorPage('403 Forbidden', 'Invalid link.', 'You should supply a "key" parameter generated by rockharbor.org. This isn\'t an open redirect.');
	}

	// Check if hash matches
	$expectedHash = hash_hmac('sha256', urlencode($fileUrl), $redirectKey);
	if (md5($expectedHash) != md5($_GET['key'])) {
		errorPage('403 Forbidden', 'Invalid link.', 'You should supply a valid "key" parameter generated by rockharbor.org. This isn\'t an open redirect.');
	}
}

$fileUrl = urldecode($_GET['file']);
if (strpos($fileUrl, 's3.amazonaws.com')) {
	// Generate presigned download URL

	$signingKey = get_option('aws_signing_key');

	// If the key expires sooner than an hour from now, or no expiration at all,
	// generate a new key
	if (!isset($signingKey['expires']) || ($signingKey['expires'] < (time() + 3600))) {
		// Generate a new key
		$secretKey = get_field('aws_secret_key', 'option');
		if (empty($secretKey)) {
			// No one put in a secret key so we can't do signed URLs
			// Just do a regular download proxy
			doRegularDownload($fileUrl);
		}
		$signingKey = array();
		// signing key is binary not ascii hex
		$signingKey['key'] = hash_hmac('sha256', 'aws4_request', hash_hmac('sha256', 's3', hash_hmac('sha256', 'us-east-1', hash_hmac('sha256', gmdate('Ymd'), "AWS4" . $secretKey, true), true), true), true);
		$signingKey['expires'] = strtotime('+7 days');
		update_option('aws_signing_key', $signingKey, false);
	}

	$publicKey = get_field('aws_public_key', 'option');
	if (!$publicKey || empty($publicKey)) {
		// No one put in a public key so we can't do signed URLs
		// Just do a regular download proxy
		doRegularDownload($fileUrl);
	}

	// Generate canonical URL request
	$filePath = parse_url($fileUrl, PHP_URL_PATH);
	$filePathParts = explode('/', $filePath);
	$fileName = array_pop($filePathParts);
	$fileHost = parse_url($fileUrl, PHP_URL_HOST);
	$startTime = time();
	$expiresTime = strtotime('+7 days');
	$validityLength = $expiresTime - $startTime;
	$longDate = gmdate('Ymd\THis\Z');
	$shortDate = gmdate('Ymd');

	$canonicalRequest = "GET\n" .
	"{$filePath}\n" .
	"X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=" . urlencode($publicKey . "/{$shortDate}/us-east-1/s3/aws4_request") . "&X-Amz-Date={$longDate}&X-Amz-Expires={$validityLength}&X-Amz-SignedHeaders=host&response-content-disposition=" . urlencode("attachment;filename={$fileName}") . "\n" .
	"host:{$fileHost}\n" .
	"\n" .
	"host\n" .
	"UNSIGNED-PAYLOAD";

	// Generate string to sign
	$stringToSign = "AWS4-HMAC-SHA256\n" .
	"{$longDate}\n" .
	"{$shortDate}/us-east-1/s3/aws4_request\n" .
	hash('sha256', $canonicalRequest);

	// Sign string
	$signature = hash_hmac('sha256', $stringToSign, $signingKey['key']);

	// Generate link
	$downloadLink = "{$fileUrl}?X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=" . urlencode($publicKey . "/{$shortDate}/us-east-1/s3/aws4_request") . "&X-Amz-Date={$longDate}&X-Amz-Expires={$validityLength}&X-Amz-SignedHeaders=host&response-content-disposition=" . urlencode("attachment;filename={$fileName}") . "&X-Amz-Signature={$signature}";
	doGoogleAnalytics($fileUrl);
	header("Location: {$downloadLink}");
	exit();
} elseif (strpos($fileUrl, 'vimeo.com')) {
	// Append download query parameter to Vimeo play link if it isn't already there
	$urlParts = explode('?', $fileUrl);
	$uri = $urlParts[0];
	$queryString = $urlParts[1];
	if (strpos($queryString, '#')) {
		// strip the fragment, also why is it there in the first place?
		$queryString = explode('#', $queryString)[0];
	}
	if (!strpos($queryString, 'download=1')) {
		// append download param
		$queryString .= '&download=1';
	}
	$downloadLink = "{$uri}?{$queryString}";
	doGoogleAnalytics($fileUrl);
	header("Location: {$downloadLink}");
	exit();
}

doRegularDownload($fileUrl);
exit();

function doRegularDownload($fileUrl) {
	// We don't recognize it as a Vimeo or S3 url, so just do a plain force download proxy
	doGoogleAnalytics($fileUrl);
	$mimeType = 'application/force-download'; // this is important
	header('Pragma: public');
	header('Expires: 0'); // We tell browser no to cache anything
	header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
	header('Cache-Control: private',false);
	header('Content-Type: '.$mimeType); // Content-Type is now set to application/force-download
	header('Content-Disposition: attachment; filename="'.basename($fileUrl).'"');
	header('Content-Transfer-Encoding: binary');
	header('Connection: close'); readfile($fileUrl); // reads a file from start to end
	die(0); // nothing else should be written to stream
}

function errorPage($code, $header, $message) {
	header("HTTP/1.1 {$code}");
	echo "<span style=\"font-family: Arial, sans-serif; font-size: 40px;\">{$header}</span><br/><p>{$message}</p>";
	exit();
}

function doGoogleAnalytics($url) {
	$googlePropertyUA = get_field('google_property_ua', 'option');
	if (!$googlePropertyUA || empty($googlePropertyUA)) {
		return;
	}
	$visitorId = isset($_COOKIE['rh-podcast-redirect']) ?? gen_uuid();
	setcookie('rh-podcast-redirect', $visitorId, strtotime('+2 years'), '/', 'rockharbor.org');
	$clientIp = $_SERVER['REMOTE_ADDR'];
	$userAgent = $_SERVER['HTTP_USER_AGENT'];
	$referer = $_SERVER['HTTP_REFERER'] ?? $_SERVER['HTTP_REFERER'];
	$urlParts = parse_url($_SERVER['REQUEST_URI']);
	$gaPageUrl = "{$urlParts['scheme']}://{$urlParts['host']}{$urlParts['path']}?url=" . urlencode($url);
	/* Prepare the Google Analytics POST data
	See here for reference: https://developers.google.com/analytics/devguides/collection/protocol/v1/devguide */
	$ga = curl_init("https://www.google-analytics.com/collect");
	curl_setopt_array($ga, array(
		CURLOPT_POST => true,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_POSTFIELDS => http_build_query(array(
			'v' => '1',
			'tid' => $googlePropertyUA,
			'cid' => $visitorId,
			't' => 'pageview',
			'uip' => $clientIp,
			'ua' => $userAgent,
			'dr' => $referer,
			'dl' => $gaPageUrl
		))
	));
	$response = curl_exec($ga);
	curl_close($ga);
	unset($ga);

	return;
}

function gen_uuid() {
	$data = file_get_contents('/dev/urandom', NULL, NULL, 0, 16);
	$data[6] = chr(ord($data[6]) & 0x0f | 0x40); // set version to 0100
	$data[8] = chr(ord($data[8]) & 0x3f | 0x80); // set bits 6-7 to 10

	return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
}
