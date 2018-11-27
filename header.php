<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ROCKHARBOR_Church
 */

$campus = $_COOKIE['campus'] ?? null;
// If Campus Cookie Not set
if (!$campus) {
	// check for campus url parameter, ex: ?c=cotsa-mesa
	if(isset($_GET['c'])) {
    	$campus = $_GET['c'];
	} else {
		$campus = 'all';
	}
}

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="shortcut icon" href="<?php bloginfo('template_url');?>/favicon.ico">
	<link rel="apple-touch-icon" href="<?php bloginfo('template_url');?>/apple-touch-icon.png">

	<?php wp_head(); ?>

	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.1.0/css/all.css" integrity="sha384-lKuwvrZot6UHsBSfcMvOkWwlCMgc0TaWr+30HWe3a4ltaBwTZhyTEggF5tJv8tbt" crossorigin="anonymous">
	<link href='https://cdn.jsdelivr.net/npm/boxicons@1.0.7/css/boxicons.min.css' rel='stylesheet'>

	<?php if( have_rows('modules') ) { ?>
		<!-- Video Player -->
		<script src="<?php bloginfo('template_url');?>/js/vendors/plyr.min.js"></script>
		<!-- Slick Slider -->
		<script src="<?php bloginfo('template_url');?>/js/vendors/slick.min.js"></script>
		<!-- Filter (staff) -->
		<script src="<?php bloginfo('template_url');?>/js/vendors/isotope.min.js"></script>
	<?php } ?>

	<?php if(is_page_template('templates/about.php')) { ///////////////// ABOUT PAGE ?>
		<script src="<?php bloginfo('template_url');?>/js/vendors/plyr.min.js"></script>
	<?php } ?>

	<!-- Google Tag Manager -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-7415608-26"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());
	  gtag('config', 'UA-7415608-26');
	</script>
	<!-- Google Tag Manager -->

	<!-- Facebook Pixel Code -->
	<script>
	!function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
	n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
	n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
	t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
	document,'script','https://connect.facebook.net/en_US/fbevents.js');
	fbq('init', '151499425391027'); // Insert your pixel ID here.
	fbq('track', 'PageView');
	</script>
	<noscript><img height="1" width="1" style="display:none"
	src="https://www.facebook.com/tr?id=151499425391027&ev=PageView&noscript=1"
	/></noscript>
	<!-- End Facebook Pixel Code -->

	<!-- Hotjar Tracking Code for www.rockharbor.org -->
	<script>
	    (function(h,o,t,j,a,r){
	        h.hj=h.hj||function(){(h.hj.q=h.hj.q||[]).push(arguments)};
	        h._hjSettings={hjid:989115,hjsv:6};
	        a=o.getElementsByTagName('head')[0];
	        r=o.createElement('script');r.async=1;
	        r.src=t+h._hjSettings.hjid+j+h._hjSettings.hjsv;
	        a.appendChild(r);
	    })(window,document,'https://static.hotjar.com/c/hotjar-','.js?sv=');
	</script>
	<!-- End Hotjar Tracking Code -->
	<!-- Intercom messenger JS -->
	<script>
	  window.intercomSettings = {
	    app_id: "j6g0qit3"
	  };
	</script>
	<script>(function(){var w=window;var ic=w.Intercom;if(typeof ic==="function"){ic('reattach_activator');ic('update',intercomSettings);}else{var d=document;var i=function(){i.c(arguments)};i.q=[];i.c=function(args){i.q.push(args)};w.Intercom=i;function l(){var s=d.createElement('script');s.type='text/javascript';s.async=true;s.src='https://widget.intercom.io/widget/j6g0qit3';var x=d.getElementsByTagName('script')[0];x.parentNode.insertBefore(s,x);}if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})()</script>
	<!-- End Intercom messenger JS -->

</head>

<body <?php body_class(); ?>>
<div id="page" class="site">

	<header id="masthead" class="site-header">
		<?php if ( (is_front_page() || ($post->post_type == 'campus')) && have_rows('notification_bars', 'option') ) {
            if (is_front_page()) {
                $currentCampus = 'homepage';
            } else {
                $currentCampus = $post->post_name;
            }
			$rowFound = false;
            while (have_rows('notification_bars', 'option')):
                the_row();
				if ($rowFound) { continue; }
                $notificationText = get_sub_field('message');
    			$current = current_time('mysql');
    			$start = get_sub_field('publish_date');
    			$end = get_sub_field('expiration_date');
                $notificationCampuses = get_sub_field('campuses');
                if (!in_array($currentCampus, $notificationCampuses) || empty($notificationText)) {
                    continue;
                }
                if($current >= $start && $end == '' || $start == '' && $current <= $end || $start == '' && $end == '' || $current >= $start && $current <= $end) { ?>
				<div class="header-bar bg-<?php the_sub_field('background'); ?>"><?php the_sub_field('message'); ?>
					<?php if($button = get_sub_field('button')){ ?>
						<a href="<?php (get_sub_field('type') == 'link') ? the_sub_field('page_link') : the_sub_field('url');?>" class="button" <?php if((get_sub_field('type') == 'url') && get_sub_field('new_window')){?>target="_blank"<?php }?>>
							<?php the_sub_field('button');?>
						</a>
					<?php }?>
				</div>
			    <?php
                    $rowFound = true;
					continue;
                }
            endwhile;
        } ?>
		<div class="header-wrapper">
		<?php if ( is_front_page() ) { ?>
			<h1 class="logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php rockharbor_logo(); ?></a></h1>
		<?php } else { ?>
			<div class="logo"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php rockharbor_logo(); ?></a></div>
		<?php } ?>
			<nav class="header-navigation">
				<?php
                if ($post->post_type == 'campus') {
                    switch($post->post_name) {
                        case 'mission-viejo':
                            $menuSlug = 'header-mv';
                            break;
                        case 'charlotte':
                            $menuSlug = 'header-char';
                            break;
                        default:
                            $menuSlug = 'header-default';
                    }
                } else {
                    $menuSlug = 'header-default';
                }
				wp_nav_menu( array(
					'theme_location' => $menuSlug,
					'menu_id'        => 'header-menu',
					'menu_class'     => 'header-menu',
					'container'      => '',
					'depth'			 => 0,
				) );
				?>
			</nav>

			<div class="menu-toggle"><i></i></div>
		</div>
	</header>

	<div id="content" class="site-content">
