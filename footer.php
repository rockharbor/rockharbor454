<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ROCKHARBOR_Church
 */

?>

	</div>

	<footer id="colophon" class="site-footer">
		<div class="footer-info">
			<div class="social">
				<a href="https://www.twitter.com/rockharbor"><i class="fab fa-twitter"></i></a>
				<a href="https://www.instagram.com/rockharborchurch/"><i class="fab fa-instagram"></i></a>
				<a href="https://www.facebook.com/rockharborchurch"><i class="fab fa-facebook-f"></i></a>
			</div>
			<?php wp_nav_menu( array(
				'theme_location' => 'footer',
				'menu_id'        => 'footer-menu',
				'menu_class'     => 'footer-menu',
				'container'      => '',
				'depth'			 => 1,
			));	?>
			<div class="app-store">
				<h5>Download the Rockharbor App</h5>
				<a href="https://itunes.apple.com/us/app/rockharbor/id1230114218?mt=8"><img src="<?php bloginfo('template_url');?>/images/apple_app_store_badge.svg" alt="Download the ROCKHARBOR App on the App Store for iPhone and iPad" class="svg-logo"></a>
				<a href="https://play.google.com/store/apps/details?id=io.echurch.rockharborc&amp;hl=en"><img src="<?php bloginfo('template_url');?>/images/google_play_web_badge.png" alt="Get the ROCKHARBOR App on Google Play"></a>
			</div>
		</div>
		<div class="site-info">
			&copy; <?php echo date('Y');?> <?php bloginfo('name'); ?> <span class="sep"></span> <a href="/privacy-policy/">Privacy Policy</a>
		</div>
	</footer>
</div>

<nav class="overlay-navigation">
	<img src="<?php bloginfo('template_url');?>/images/rockharbor-white-logo.svg" alt="<?php bloginfo('name');?>" class="overlay-logo">
	<span class="overlay-close"><i></i></span>
	<div class="wrapper">
		<div class="overlay-scroller">
			<?php
			wp_nav_menu( array(
				'theme_location' => 'primary',
				'menu_id'        => 'overlay-menu',
				'menu_class'        => 'overlay-menu',
				'container'        => '',
			) );
			?>
			<form role="search" method="get" class="overlay-search" action="<?php echo home_url( '/' ); ?>">
			    <div>
					<input type="search" placeholder="What are you looking for?" value="<?php echo get_search_query() ?>" name="s" autocomplete="off">
					<button type="submit"><i></i></button>
			    </div>
			</form>
		</div>
	</div>
	<div class="overlay-social">
		<a href="https://www.twitter.com/rockharbor"><i class="fab fa-twitter"></i></a>
		<a href="https://www.instagram.com/rockharborchurch/"><i class="fab fa-instagram"></i></a>
		<a href="https://www.facebook.com/rockharborchurch"><i class="fab fa-facebook-f"></i></a>
	</div>
</nav>

<?php wp_footer(); ?>


<?php if(!is_page_template('templates/events.php')) { // dont run on events page ?>
	<script>
	//////////////////////////////////////////////////////////////////////////////////////////////////
	////// Update Campus Filter to match Cookie
	var $campus = Cookies.get('campus');
	if (!$campus) {
		$campus = 'all';
	}
	$('#campus-filter').val($campus);
	</script>
<?php } ?>

<script>
//////////////////////////////////////////////////////////////////////////////////////////////////
////// Campus Filter Cookie on Change
$('#campus-filter').change(function(){
	// get filter value
	var campus = $(this).val();
	// set cookie
	Cookies.set('campus', campus, 2147483647, {path: '/'});
	// append campus to url in case cookies are disallowed
	redirectUrl = document.location.protocol + "//" + document.location.hostname + document.location.pathname;
	if (document.location.search.length > 0) {
		redirectUrl += "?";
		newParams = Array();
		queryParams = document.location.search.substring(1).split('&');
		queryParams.forEach(function(queryParam) {
			if (queryParam.search(/^c=/g) == -1) {
				newParams.push(queryParam);
			}
		});
		newParams.push("c=" + campus);
		redirectUrl += newParams.join("&");
	} else {
		redirectUrl += "?c=" + campus;
	}
	location.href = redirectUrl; });
</script>

<?php
///////////////// JESUS PAGE
if(is_page_template('templates/jesus.php')) { ?>
<script src="<?php bloginfo('template_url');?>/js/vendors/multiplyfilter.min.js"></script>
<script src="<?php bloginfo('template_url');?>/js/vendors/plyr.min.js"></script>
<script src="<?php bloginfo('template_url');?>/js/vendors/scrolloverflow.min.js"></script>
<script src="<?php bloginfo('template_url');?>/js/vendors/fullpage.min.js"></script>
<script src="<?php bloginfo('template_url');?>/js/vendors/aos.min.js"></script>
<script>
	const player = new Plyr('#plyr');

	var myFullpage = new fullpage('#know-jesus', {
		licenseKey: 'OPEN-SOURCE-GPLV3-LICENSE',
		menu: '#fp-nav',
		navigationPosition: 'left',
		showActiveTooltip: true,
		scrollingSpeed: 1000,
		paddingTop: '0',
		paddingBottom: '0',
		lockAnchors: true,
		normalScrollElements: '.site-footer',
		fitToSection: false,
		scrollOverflow: true,
		responsiveHeight: 0,
		//hybrid: true,
		//v2compatible: true,
		onLeave: function(index, nextIndex, direction) {
			player.pause();
			//$('#know-jesus').attr('class', 'fullpage-wrapper');
			//$('#know-jesus').addClass('section' + nextIndex);

			//$('body.page-template-jesus').addClass('gradient' + nextIndex);
		}
    });

	$(window).ready(function() {
		AOS.init({ duration: 1000, once: true,});
	});
</script>
<?php } ?>

<?php
///////////////// MESSAGES PAGE
if(is_singular('message')) { ?>
<script src="https://cdn.plyr.io/3.3.22/plyr.polyfilled.js"></script>
<script>
const player = new Plyr('#plyr',{
	//autoplay: true,
});
const player_audio = new Plyr('#plyr-audio');
</script>
<?php } ?>

<?php
///////////////// CAMPUSES PAGE
if(is_singular('campus')) { ?>
<script src="<?php bloginfo('template_url');?>/js/vendors/sticky.min.js"></script>
<script>
$(window).ready(function() {
	$('.campus-menu').scrollToFixed();
});
</script>
<?php } ?>

<?php
///////////////// HOME PAGE
if(is_front_page()) { ?>
<script src="<?php bloginfo('template_url');?>/js/vendors/slick.min.js"></script>
<script src="<?php bloginfo('template_url');?>/js/vendors/wheel-indicator.min.js"></script>
<script src="<?php bloginfo('template_url');?>/js/vendors/aos.min.js"></script>
<script type="text/javascript">
$(window).ready(function() {
	var SLIDER = (function () {
		var slider = {};
		slider.build = function ($selector) {
			var $currentSlider = $selector.slick({
				vertical: true,
				verticalSwiping: true,
				infinite: true,
				dots: false,
				centerMode: true,
				prevArrow: '<span class="slick-prev"><i class="fas fa-angle-up"></i></span>',
				nextArrow: '<span class="slick-next"><i class="fas fa-angle-down"></i></span>',
	  			slidesToShow: 3,
  				slidesToScroll: 3,
  				focusOnSelect: true
		  	});
			new WheelIndicator({
				elem: document.querySelector('.callout-slider'),
				callback: function (e) {
					if ($currentSlider.slick('slickCurrentSlide') == $currentSlider.find('.slide').length - 1) {
						this.setOptions({
							preventMouse: false
						});
				  	} else {
						this.setOptions({
							preventMouse: true
						});
					}
					e.direction === 'up' ? $currentSlider.slick('slickPrev') : $currentSlider.slick('slickNext');
				}
			});
	  	};
		return slider;
  	}());
	SLIDER.build($('.callout-slider'));
});

$(window).ready(function() {
	AOS.init({ duration: 1000, once: true,});
});
</script>
<?php } ?>

<?php if(is_search()) { ?>
<script>
$("#heading-search").focus();
</script>
<?php } ?>

</body>
</html>
