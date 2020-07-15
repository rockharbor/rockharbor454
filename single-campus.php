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
					$address = get_field('address');
					$gtemp = explode (',',  implode($address));
					$coord = explode (',', implode($gtemp));
				?>
				<div class="info">
					<?php if($address){?><div class="address"><a href="<?php echo "https://www.google.com/maps/place/" . urlencode($address['address']); ?>" target="_blank"><i class="bx bx-map"></i><div><?php echo '<span>' . $gtemp[0] . ',</span> <span>' . $gtemp[1] . ', ' . $gtemp[2] . '</span>'; ?></div></a></div><?php } ?>
					<?php
					$rows = get_field('hours');
					$first_row = $rows[0];
					if($rows) { ?>
						<div class="times"><i class="bx bx-time"></i><div><span><strong><?php echo $first_row['description'];?> </strong></span> <span><?php echo $first_row['hours'];?></span></div></div>
					<?php } ?>
				</div>
				</div>
				<?php if( have_rows('hours') ):
				$countrows = 0;?>
				<ul class="other-info">
					<?php while ( have_rows('hours') ) : the_row(); $countrows++;
					if($countrows != 1) { ?>
						<li><span><?php the_sub_field('description');?>: </span> <?php the_sub_field('hours');?></li>
					<?php }
				    endwhile; ?>
				</ul>
				<?php endif; ?>
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
