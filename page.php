<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ROCKHARBOR_Church
 */
?>
<?php get_header(); ?>
	<?php while ( have_posts() ) :	the_post(); ?>
		
		<?php if(is_front_page()) {
			include(locate_template('template-parts/modules/home-header.php'));
		} else {
			include(locate_template('template-parts/modules/page-header.php'));
		} ?>

		<?php get_template_part( 'template-parts/content', 'modules' );?>
	



	<?php endwhile; ?>
<?php get_footer();
