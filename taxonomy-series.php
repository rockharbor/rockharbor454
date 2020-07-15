<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ROCKHARBOR_Church
 */

get_header();
?>

	<section class="series-archive">
		<?php the_archive_title( '<h1 class="heading">', '</h1>' ); ?>
		<div class="campus-filter" style="position: relative; margin-bottom: 50px; margin-left: auto; margin-right: auto;" >
			<select id="campus-filter">
				<?php
					$realLocations = array();
					$locations = get_terms(array(
						'hide_empty' => 0,
						'parent' => 0,
						'taxonomy' => 'campuses',
						'exclude' => '33' // exclude Charlotte
					));
					$locations[] = (object) ['name' => 'All Campuses', 'slug' => 'all'];
					foreach ($locations as $location) {
						$realLocations[] = $location->slug; ?>
					<option value="<?php echo $location->slug; ?>"><?php echo $location->name; ?></option>
					<?php } ?>
			</select>
		</div>
		<?php foreach ($locations as $location): ?>
		<div class="container campus-<?php echo $location->slug; ?>">

			<?php $terms = get_queried_object()->slug;
			$paged = ( get_query_var('page') ) ? get_query_var('page') : 1;
			if ($location->slug == 'all') {
				$taxQuery = array(array(
					'taxonomy' => 'campuses',
					'field' => 'slug',
					'terms' => $realLocations
				));
			} else {
				$taxQuery = array(array(
					'taxonomy' => 'campuses',
					'field' => 'slug',
					'terms' => $location->slug
				));
			}
			$args = array (
				'taxonomy'			=> 'series',
				'term'				=> $terms,
				'post_type'         => array( 'message' ),
				'posts_per_page'    => 8,
				'paged' 			=> $paged,
				'order'             => 'DESC',
				'orderby'           => 'date',
				'tax_query' => $taxQuery
			);
			// The Query
			$query = new WP_Query( $args );
			// The Loop
			if ( $query->have_posts() ) { ?>
				<ul class="series-term">
				<?php while ( $query->have_posts() ) { $query->the_post();
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
				<?php } ?>
				</ul>
			<?php } else { ?>
				<div style="padding: 40px 0; text-align: center;">It looks like there are no messages available for <?php the_archive_title(); ?>.</div>
			<?php }
			wp_reset_postdata();?>

			<div class="pagination-infinite">
				<?php
						global $query;
						echo "<span class='page-numbers page-num'>Page " . $paged . " of " . $query->max_num_pages . "</span> ";
						echo paginate_links( array(
							'format' => '?page=%#%',
							'current' => max( 1, get_query_var('page') ),
							'total' => $query->max_num_pages,
							'prev_text'    => __('«'),
							'next_text'    => __('»'),
						));
					?>
			</div>
			<div class="page-load-status">
				<p class="infinite-scroll-request"><img src="<?php bloginfo('template_url');?>/images/svg-loaders/tail-spin-grey.svg" alt="" class="next-page-loader" /></p>
			</div>
		</div>
		<?php endforeach; ?>
	</section>

	<script src="<?php bloginfo('template_url'); ?>/js/vendors/infinite-scroll.pkgd.js"></script>
	<script src="<?php bloginfo('template_url'); ?>/js/vendors/js.cookie.js"></script>
	<script>
		<?php
		if (isset($_GET['c']) && !empty($_GET['c'])) {
			echo "var phpCampus = " . json_encode(array('campus' => $_GET['c'])) . ";\n";
		} ?>
		cookieCampus = Cookies.get('campus');
		if (typeof phpCampus !== 'undefined') {
			campus = phpCampus.campus;
		} else if (cookieCampus) {
			campus = cookieCampus.replace('/(.*)-online/', '$1');
		} else {
			campus = 'all';
		}
		$(document).ready(function() {
			$('.container').not('.campus-' + campus).remove();
			if ($('.page-numbers.next').length) {
				$('.series-term').infiniteScroll({
				  path: '.page-numbers.next',
				  append: '.campus-' + campus + ' .series-term li',
				  responseType: 'document',
				  scrollThreshold: 400,
				  history: false,
				  hideNav: '.pagination-infinite',
				  status: '.page-load-status',
				  debug: false,
				})
			}
		});
	</script>

<?php
get_footer();
