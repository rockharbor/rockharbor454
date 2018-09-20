<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ROCKHARBOR_Church
 */
 
$campus = $_COOKIE['campus'];
// If Campus Cookie Not set
if (!$campus) {
	// check for campus url parameter, ex: ?c=cotsa-mesa
	if(isset($_GET['c'])) {
    	$campus = $_GET['c'];
	} else {
		$campus_slug = get_post(269)->post_name; // Costa Mesa by default
		$campus = $campus_slug;	
	}
}

get_header();
?>
	
	<section class="series-archive">
		<div class="container">
			<?php the_archive_title( '<h1 class="heading">', '</h1>' ); ?>
			<?php if ( have_posts() ) {?>
				<ul class="series-term">
					<?php while ( have_posts() ) : the_post();
						$term = get_queried_object();
						$tags = get_the_term_list( $post->ID, 'tags', '<span>', ' ', '</span>' ) ;
						$scripture = get_field('scripture');
						$seriescover = get_field('thumbnail', 'series_'.get_the_terms( $post->ID, 'series' )[0]->term_id);
						
						if ( has_post_thumbnail() ) {
							$imagesm = get_the_post_thumbnail_url( $post->id, 'thumbnail_uncropped' );
							$image = get_the_post_thumbnail_url( $post->id, 'medium' );
						} elseif($seriescover) {
							$imagesm = wp_get_attachment_image_url( $seriescover, 'thumbnail_uncropped' );
							$image = wp_get_attachment_image_url( $seriescover, 'medium' );
						} else {
							$imagesm = get_bloginfo('template_url').'/images/series-placeholder.png';
							$image = $imagesm;
						} 
						?>
					<li>
						<a href="<?php the_permalink();?>" class="cover"><img src="<?php echo $imagesm; ?>" data-layzr="<?php echo $image; ?>" alt="<?php the_title();?>"></a>
						<div class="content">
							<h3><a href="<?php the_permalink();?>"><?php the_title();?></a></h3>
							<div class="date"><?php $date = get_the_date( 'F j, Y' ); echo $date;?> <?php $terms_as_link = get_the_term_list( $post->ID, 'campuses', '<span>', ', ', '</span>' ); if($terms_as_link){ echo ' &nbsp;&mdash;&nbsp; ' , $terms_as_link; }?></div>
							<div class="description"><?php the_excerpt();?></div>
							<?php if($scripture) { ?>
								<div class="scripture"><strong>Scripture:</strong> <?php the_field('scripture');?></div>
							<?php }?>
							<?php if($tags) { ?>
								<div class="tags"><strong>Tags:</strong> <?php echo ($tags); ?></div>
							<?php }?>
						</div>
					</li>
					<?php endwhile;?>
				</ul>			
			<?php } else { ?>
				<div style="padding: 40px 0; text-align: center;">It looks like there are no messages available for <?php the_archive_title(); ?>.</div>
			<?php } ?>
			
			<div class="pagination-infinite">
				<?php
					global $wp_query;
					$big = 999999999; // need an unlikely integer
					echo paginate_links( array(
						'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
						'format' => '?paged=%#%',
						'current' => max( 1, get_query_var('paged') ),
						'total' => $wp_query->max_num_pages,
						'prev_text'    => __('«'),
						'next_text'    => __('»'),
					) );
				?>
			</div>
			<div class="page-load-status">
				<p class="infinite-scroll-request"><img src="<?php bloginfo('template_url');?>/images/svg-loaders/tail-spin-grey.svg" alt="" class="next-page-loader" /></p>
			</div>
			
		</div>
	</section>
	
	<script src="<?php bloginfo('template_url');?>/js/vendors/infinite-scroll.pkgd.js"></script>
	<script>
		if ($('.page-numbers.next').length) {
			$('.series-term').infiniteScroll({
			  path: '.page-numbers.next',
			  append: '.series-term li',
			  responseType: 'document',
			  scrollThreshold: 400,
			  history: false,
			  hideNav: '.pagination-infinite',	
			  status: '.page-load-status',
			  debug: false,
			})
		}
	</script>

<?php
get_footer();
