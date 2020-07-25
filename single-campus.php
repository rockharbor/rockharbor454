<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package ROCKHARBOR_Church
 */


// Set Campus Slug as Campus Cookie
global $post;
// fix new -online campuses; costa-mesa-online becomes costa-mesa
$campus = preg_replace('/(.*)-online/', '$1', $post->post_name);
$_COOKIE['campus'] = $campus;
setcookie('campus', $campus, 2147483647, '/');

get_header(); ?>
	<?php while ( have_posts() ) : the_post(); ?>

		<section class="campus-hero" style="background-image: url('<?php echo the_post_thumbnail_url( 'large' );?>')">
			<div class="container">
	  			<div>
				<h1><?php the_title();?></h1>
				<?php
					$weekend_fields = get_field('weekend_fields');
					$kids_fields = get_field('kids_fields');
					$youth_fields = get_field('youth_fields');
					$social_fields = get_field('social_fields');
					$custom_button = get_field('custom_button');
				?>
				<div class="info">
					<div class="info-box">
						<div class="info-header">
							<span>Weekend Services</span>
						</div>
						<div class="info-body">
							<span><?php echo $weekend_fields['description']; ?></span>
						</div>
						<div class="info-links">
							<ul>
								<li><a href="<?php echo $weekend_fields['live_link']; ?>">Watch Live</a></li>
								<li><a href="<?php echo $weekend_fields['archive_link']; ?>">Past Messages</a></li>
							</ul>
						</div>
					</div>
					<div class="info-box">
						<div class="info-header">
							<span>Kids Services</span>
						</div>
						<div class="info-body">
							<span><?php echo $kids_fields['description']; ?></span>
						</div>
						<div class="info-links">
							<ul>
								<li><a href="<?php echo $kids_fields['live_link']; ?>">Watch Live</a></li>
								<li><a href="<?php echo $kids_fields['archive_link']; ?>">Past Messages</a></li>
							</ul>
						</div>
					</div>
					<div class="info-box">
						<div class="info-header">
							<span>Youth Services</span>
						</div>
						<div class="info-body">
							<span><?php echo $youth_fields['description']; ?></span>
						</div>
						<div class="info-links">
							<ul>
								<li><a href="<?php echo $youth_fields['live_link']; ?>">Watch Live</a></li>
								<li><a href="<?php echo $youth_fields['archive_link']; ?>">Past Messages</a></li>
							</ul>
						</div>
					</div>
				</div>
				<div class="bottom-links">
					<a href="<?php echo $social_fields['instagram']; ?>" title="Follow Us on Instagram"><i class="bx bx-instagram"></i>Follow Us</a>
					<a href="<?php echo $custom_button['link']; ?>" title="<?php echo $custom_button['text']; ?>"><?php echo $custom_button['text']; ?></a>
				</div>
				</div>
			</div>
			<nav class="campus-menu">
				<?php
				wp_nav_menu( array(
					'theme_location' => 'campuses',
					'menu_id'        => '',
					'menu_class'     => '',
					'container'      => '',
					'depth'			 => 1,
				) );
				?>
			</nav>
		</section>
		
		<?php get_template_part( 'template-parts/content', 'modules' );?>
		
	<?php endwhile; ?>
<?php
get_footer();
