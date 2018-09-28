<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package ROCKHARBOR_Church
 */

$campus = $_COOKIE['campus'] ?? null;
// Set default campus variable incase no Cookies Allowed
if (!$campus) {
	$campus_slug = get_post(269)->post_name; // Costa Mesa
    $campus = $campus_slug;
}

get_header();
?>
	<?php while ( have_posts() ) : the_post();
		$video = get_field('video');
		$audio = get_field('audio');
		$tags = get_the_term_list( $post->ID, 'tags', '<span>', ' ', '</span>' ) ;
		$scripture = get_field('scripture');
		$series = get_the_terms( $post->ID, 'series' )[0]->name;
		$campuses = get_the_terms( $post->ID, 'campuses' )[0]->name;
		$campusSlug = get_the_terms( $post->ID, 'campuses' )[0]->slug;
		$seriescover = get_field('thumbnail', 'series_'.get_the_terms( $post->ID, 'series' )[0]->term_id);

		if ( has_post_thumbnail() ) {
			$image = get_the_post_thumbnail_url( $post->id, 'large' );
		} elseif($seriescover) {
			$image = wp_get_attachment_image_url( $seriescover, 'large' );
		} else {
			$image = get_bloginfo('template_url').'/images/series-placeholder.png';
		} ?>

		<section class="sermon">
			<div class="container">
				<video poster="<?php echo $image; ?>" id="plyr" playsinline controls>
				    <?php if ($video) { ?>
						<source src="<?php echo $video;?>" type="video/mp4">
					<?php } else { ?>
						<source src="<?php echo $audio;?>" type="audio/mp3">
					<?php } ?>
				</video>
				<header>
					<h1 class="heading"><?php the_title();?></h1>
					<div class="meta">
						<span class="date"><?php $date = get_the_date( 'F j, Y' ); echo $date;?></span> &nbsp;&mdash;&nbsp; <span class="teacher"><?php $terms_as_link = get_the_term_list( $post->ID, 'teacher', '<span>', ', ', '</span>' ) ; echo ($terms_as_link);?></span>
					</div>
					<div class="share">
						<a href="https://www.facebook.com/sharer.php?u=<?php the_permalink();?>" target="_blank" rel="noopener noreferrer"><i class="fab fa-facebook-f"></i></a>
						<a href="https://pinterest.com/pin/create/button/?url=<?php the_permalink();?>&media=<?php echo wp_get_attachment_image_url( $image, 'medium' ); ?>&description=<?php the_title();?>" target="_blank" rel="noopener noreferrer"><i class="fab fa-pinterest-p"></i></a>
						<a href="https://twitter.com/intent/tweet?text=I want you guys to check out this article: <?php the_permalink();?>" class="icon-twitter" target="_blank" rel="noopener noreferrer"><i class="fab fa-twitter"></i></a>
					</div>
				</header>
				<main>
					<div class="description">
						<?php the_content();?>
					</div>
					<?php if($scripture) { ?>
						<div class="scripture"><strong>Scripture:</strong> <?php the_field('scripture');?></div>
					<?php }?>
					<?php if($tags) { ?>
						<div class="tags"><strong>Tags:</strong> <?php echo ($tags); ?></div>
					<?php }?>
					<?php if($video && $audio) { ?>
						<audio id="plyr-audio" controls>
						    <source src="<?php echo $audio;?>" type="audio/mp3">
						</audio>
					<?php } ?>
					<div class="actions">
						<div class="download">
							<h5>Download <i class="fas fa-angle-down"></i></h5>
							<ul>
								<?php
								$redirectKey = strtolower(get_field('redirect_key', 'option'));
								if ($audio) {
									$audioUrl = get_bloginfo('template_url') . "/force_download.php?file=" . urlencode($audio);
									if ($redirectKey && !empty($redirectKey)) {
										$hash = hash_hmac('sha256', urlencode($audio), $redirectKey);
										$audioUrl .= "&key={$hash}";
									}
									?><li><a href="<?php echo $audioUrl; ?>" target="_blank"><i class="fas fa-volume-up"></i> Audio</a></li>
								<?php
								}
								if ($video) {
									$videoUrl = get_bloginfo('template_url') . "/force_download.php?file=" . urlencode($video);
									if ($redirectKey && !empty($redirectKey)) {
										$hash = hash_hmac('sha256', urlencode($video), $redirectKey);
										$videoUrl .= "&key={$hash}";
									}
									?><li><a href="<?php echo $videoUrl; ?>" target="_blank"><i class="fas fa-video"></i> Video</a></li>
								<?php
								} ?>
							</ul>
						</div>
						<?php
							if ($campusSlug == 'costa-mesa') {
								$podcastLink = 'https://itunes.apple.com/us/podcast/rockharbor-costa-mesa-podcast/id1094888066?mt=2';
							} else if($campusSlug == 'mission-viejo') {
								$podcastLink = 'https://itunes.apple.com/us/podcast/rockharbor-mission-viejo-podcast/id1095856839?mt=2';
							} else if($campusSlug == 'charlotte') {
								$podcastLink = 'https://itunes.apple.com/us/podcast/rockharbor-charlotte-podcast/id1095856746?mt=2';
							}
						?>
						<?php if($podcastLink) { ?>
							<span class="sep"></span>
							<a href="<?php echo $podcastLink; ?>" class="link podcast">Podcast <i class="fas fa-podcast"></i></a>
						<?php } ?>

						<?php if($video && $audio) { ?>
						<span class="sep"></span>
						<a href="javascript:;" class="link listen">Listen <i class="fas fa-volume-up"></i></a>
						<?php } ?>
					</div>
				</main>
			</div>
		</section>

		<section class="section more-sermons campus-costa-mesa campus-all">
			<div class="container">
				<h2 class="heading">More Messages in "<?php echo $series;?>"</h2>
				<ul>
					<?php
					$m_args = array(
						'post_type'              => array( 'message' ),
						'posts_per_page'         => '4',
						'order'                  => 'DESC',
						'orderby'                => 'date',
						'post__not_in'			 => array($post->ID),
						'tax_query' => array(
							'relation' => 'AND',
					        array(
					            'taxonomy' => 'series',
								'field'    => 'name',
								'terms' => $series,
					        ),
					    	array(
								'taxonomy' => 'campuses',
								'field'    => 'name',
								'terms' => $campuses,
					    	)
					    ),
					);
					$m_query = new WP_Query( $m_args );
					if ( $m_query->have_posts() ) {
						while ( $m_query->have_posts() ) {
							$m_query->the_post();

							$seriescover = get_field('thumbnail', 'series_'.get_the_terms( $post->ID, 'series' )[0]->term_id);

							if ( has_post_thumbnail() ) {
								$imagesm = get_the_post_thumbnail_url( $post->id, 'thumb_uncropped' );
								$image = get_the_post_thumbnail_url( $post->id, 'large' );
							} elseif($seriescover) {
								$imagesm = wp_get_attachment_image_url( $seriescover, 'thumb_uncropped' );
								$image = wp_get_attachment_image_url( $seriescover, 'large' );
							} else {
								$imagesm = get_bloginfo('template_url').'/images/series-placeholder.png';
								$image = $imagesm;
							} ?>
							<li>
								<a href="<?php the_permalink();?>">
									<div class="cover"><img src="<?php echo $imagesm; ?>" data-layzr="<?php echo $image; ?>" alt="<?php the_title();?>"></div>
									<h3><?php the_title();?></h3>
									<span class="date"><?php $date = get_the_date( 'F j, Y' ); echo $date;?></span>
								</a>
							</li>
						<?php }
					} wp_reset_postdata(); ?>
				</ul>
			</div>
		</section>

		<section class="section more-sermons campus-mission-viejo">
			<div class="container">
				<h2 class="heading">More Messages in "<?php echo $series;?>"</h2>
				<ul>
					<?php
					$m_args = array(
						'post_type'              => array( 'message' ),
						'posts_per_page'         => '4',
						'order'                  => 'DESC',
						'orderby'                => 'date',
						'post__not_in'			 => array($post->ID),
						'tax_query' => array(
							'relation' => 'AND',
					        array(
					            'taxonomy' => 'series',
								'field'    => 'name',
								'terms' => $series,
					        ),
					    	array(
								'taxonomy' => 'campuses',
								'field'    => 'name',
								'terms' => $campuses,
					    	)
					    ),
					);
					$m_query = new WP_Query( $m_args );
					if ( $m_query->have_posts() ) {
						while ( $m_query->have_posts() ) {
							$m_query->the_post();

							$seriescover = get_field('thumbnail', 'series_'.get_the_terms( $post->ID, 'series' )[0]->term_id);

							if ( has_post_thumbnail() ) {
								$imagesm = get_the_post_thumbnail_url( $post->id, 'thumb_uncropped' );
								$image = get_the_post_thumbnail_url( $post->id, 'large' );
							} elseif($seriescover) {
								$imagesm = wp_get_attachment_image_url( $seriescover, 'thumb_uncropped' );
								$image = wp_get_attachment_image_url( $seriescover, 'large' );
							} else {
								$imagesm = get_bloginfo('template_url').'/images/series-placeholder.png';
								$image = $imagesm;
							} ?>
							<li>
								<a href="<?php the_permalink();?>">
									<div class="cover"><img src="<?php echo $imagesm; ?>" data-layzr="<?php echo $image; ?>" alt="<?php the_title();?>"></div>
									<h3><?php the_title();?></h3>
									<span class="date"><?php $date = get_the_date( 'F j, Y' ); echo $date;?></span>
								</a>
							</li>
						<?php }
					} wp_reset_postdata(); ?>
				</ul>
			</div>
		</section>

		<section class="section more-sermons campus-charlotte">
			<div class="container">
				<h2 class="heading">More Messages in "<?php echo $series;?>"</h2>
				<ul>
					<?php
					$m_args = array(
						'post_type'              => array( 'message' ),
						'posts_per_page'         => '4',
						'order'                  => 'DESC',
						'orderby'                => 'date',
						'post__not_in'			 => array($post->ID),
						'tax_query' => array(
							'relation' => 'AND',
					        array(
					            'taxonomy' => 'series',
								'field'    => 'name',
								'terms' => $series,
					        ),
					    	array(
								'taxonomy' => 'campuses',
								'field'    => 'name',
								'terms' => $campuses,
					    	)
					    ),
					);
					$m_query = new WP_Query( $m_args );
					if ( $m_query->have_posts() ) {
						while ( $m_query->have_posts() ) {
							$m_query->the_post();

							$seriescover = get_field('thumbnail', 'series_'.get_the_terms( $post->ID, 'series' )[0]->term_id);

							if ( has_post_thumbnail() ) {
								$imagesm = get_the_post_thumbnail_url( $post->id, 'thumb_uncropped' );
								$image = get_the_post_thumbnail_url( $post->id, 'large' );
							} elseif($seriescover) {
								$imagesm = wp_get_attachment_image_url( $seriescover, 'thumb_uncropped' );
								$image = wp_get_attachment_image_url( $seriescover, 'large' );
							} else {
								$imagesm = get_bloginfo('template_url').'/images/series-placeholder.png';
								$image = $imagesm;
							} ?>
							<li>
								<a href="<?php the_permalink();?>">
									<div class="cover"><img src="<?php echo $imagesm; ?>" data-layzr="<?php echo $image; ?>" alt="<?php the_title();?>"></div>
									<h3><?php the_title();?></h3>
									<span class="date"><?php $date = get_the_date( 'F j, Y' ); echo $date;?></span>
								</a>
							</li>
						<?php }
					} wp_reset_postdata(); ?>
				</ul>
			</div>
		</section>

		<section class="section series-archive campus-costa-mesa campus-all">
			<div class="container">
				<h2>Past Series</h2>
				<?php
				$args = array (
					'taxonomy'			=> 'campuses',
					'term'				=> 'costa-mesa',
					'post_type'         => array( 'message' ),
					'posts_per_page'    => 20,
					'order'             => 'DESC',
					'orderby'           => 'date',
				);
				// The Query
				$query = new WP_Query( $args );
				// The Loop
				if ( $query->have_posts() ) { ?>
					<ul class="series">
					<?php while ( $query->have_posts() ) { $query->the_post();

						$seriescover = get_field('thumbnail', 'series_'.get_the_terms( $post->ID, 'series' )[0]->term_id); $placeholer = get_bloginfo('template_url').'/images/series-placeholder.png';

						if ( has_post_thumbnail() ) {
							$image = get_the_post_thumbnail_url( $post->id, 'thumb_uncropped' );
						} elseif($seriescover) {
							$image = wp_get_attachment_image_url( $seriescover, 'thumb_uncropped' );
						} else {
							$image = $placeholer;
						}
						?>

						<?php
							// Get series of post
							$seriesID = get_the_terms( $post->ID, 'series' )[0]->term_id;
							$seriesName = get_the_terms( $post->ID, 'series' )[0]->name;
							$seriesSlug = get_the_terms( $post->ID, 'series' )[0]->slug;
						?>
						<?php
							// if this series is not previous series
							if (!isset($previousSeriesID)) {
								$previousSeriesID = '';
							}

							if ($seriesID != $previousSeriesID) {
						?>
						<li data-series-id="<?php echo $seriesID ?>">
							<a href="/series/<?php echo $seriesSlug?>">
								<div class="cover"><img src="<?php echo $image ?>" alt="<?php echo $seriesName?>"></div>
								<h3 class="series-name"><?php echo $seriesName?></h3>
								<?php
									// Get Series Date Range
									$slug = get_the_terms( $post->ID, 'series' )[0]->slug;
									$args = array(
										'post_type'=>'message',
										'posts_per_page' => -1,
										'tax_query' => array(
											'relation' => 'AND',
											array(
												'taxonomy' => 'series',
												'field' => 'slug',
												'terms' => $slug,
											),
											array(
												'taxonomy' => 'campuses',
												'field' => 'slug',
												'terms' => $campus,
											),
										),
									);
									$posts_array = get_posts( $args );
									$first = $posts_array[0]->ID;
									$last = $posts_array[count($posts_array) -1 ]->ID;

									if(count($posts_array) == 1) {
										//echo get_the_title( $first );
										$date = get_the_date( 'M j, Y', $first );
									} else {
										//echo get_the_title( $first ) , ' - ' , echo get_the_title( $last );
										$date = get_the_date( 'M j, Y', $last ) . ' - ' . get_the_date( 'M j, Y', $first );
									}
								?>
								<span class="date"><?php echo $date ?></span>
							</a>
						</li>

						<?php  } ?>

						<?php $previousSeriesID = get_the_terms( $post->ID, 'series' )[0]->term_id; ?>

					<?php } ?>
					</ul>
				<?php } else { ?>
					<div style="padding: 40px 0; text-align: center;">It looks like there are no messages available for <?php the_archive_title(); ?>.</div>
				<?php }
				wp_reset_postdata();?>
				<a href="/messages/" class="button teal" style="margin: 0 auto; width: 241px; display: block;">View Messages Archive</a>
			</div>
		</section>

		<section class="section series-archive campus-mission-viejo">
			<div class="container">
				<h2>Past Series</h2>
				<?php
				$args = array (
					'taxonomy'			=> 'campuses',
					'term'				=> 'mission-viejo',
					'post_type'         => array( 'message' ),
					'posts_per_page'    => 20,
					'order'             => 'DESC',
					'orderby'           => 'date',
				);
				// The Query
				$query = new WP_Query( $args );
				// The Loop
				if ( $query->have_posts() ) { ?>
					<ul class="series">
					<?php while ( $query->have_posts() ) { $query->the_post();

						$seriescover = get_field('thumbnail', 'series_'.get_the_terms( $post->ID, 'series' )[0]->term_id); $placeholer = get_bloginfo('template_url').'/images/series-placeholder.png';

						if ( has_post_thumbnail() ) {
							$image = get_the_post_thumbnail_url( $post->id, 'thumb_uncropped' );
						} elseif($seriescover) {
							$image = wp_get_attachment_image_url( $seriescover, 'thumb_uncropped' );
						} else {
							$image = $placeholer;
						}
						?>

						<?php
							// Get series of post
							$seriesID = get_the_terms( $post->ID, 'series' )[0]->term_id;
							$seriesName = get_the_terms( $post->ID, 'series' )[0]->name;
							$seriesSlug = get_the_terms( $post->ID, 'series' )[0]->slug;
						?>
						<?php
							// if this series is not previous series
							if (!isset($previousSeriesID)) {
								$previousSeriesID = '';
							}

							if ($seriesID != $previousSeriesID) {
						?>
						<li data-series-id="<?php echo $seriesID ?>">
							<a href="/series/<?php echo $seriesSlug?>">
								<div class="cover"><img src="<?php echo $image ?>" alt="<?php echo $seriesName?>"></div>
								<h3 class="series-name"><?php echo $seriesName?></h3>
								<?php
									// Get Series Date Range
									$slug = get_the_terms( $post->ID, 'series' )[0]->slug;
									$args = array(
										'post_type'=>'message',
										'posts_per_page' => -1,
										'tax_query' => array(
											'relation' => 'AND',
											array(
												'taxonomy' => 'series',
												'field' => 'slug',
												'terms' => $slug,
											),
											array(
												'taxonomy' => 'campuses',
												'field' => 'slug',
												'terms' => $campus,
											),
										),
									);
									$posts_array = get_posts( $args );
									$first = $posts_array[0]->ID;
									$last = $posts_array[count($posts_array) -1 ]->ID;

									if(count($posts_array) == 1) {
										//echo get_the_title( $first );
										$date = get_the_date( 'M j, Y', $first );
									} else {
										//echo get_the_title( $first ) , ' - ' , echo get_the_title( $last );
										$date = get_the_date( 'M j, Y', $last ) . ' - ' . get_the_date( 'M j, Y', $first );
									}
								?>
								<span class="date"><?php echo $date ?></span>
							</a>
						</li>

						<?php  } ?>

						<?php $previousSeriesID = get_the_terms( $post->ID, 'series' )[0]->term_id; ?>

					<?php } ?>
					</ul>
				<?php } else { ?>
					<div style="padding: 40px 0; text-align: center;">It looks like there are no messages available for <?php the_archive_title(); ?>.</div>
				<?php }
				wp_reset_postdata();?>
				<a href="/messages/" class="button teal" style="margin: 0 auto; width: 241px; display: block;">View Messages Archive</a>
			</div>
		</section>

		<section class="section series-archive campus-charlotte">
			<div class="container">
				<h2>Past Series</h2>
				<?php
				$args = array (
					'taxonomy'			=> 'campuses',
					'term'				=> 'charlotte',
					'post_type'         => array( 'message' ),
					'posts_per_page'    => 20,
					'order'             => 'DESC',
					'orderby'           => 'date',
				);
				// The Query
				$query = new WP_Query( $args );
				// The Loop
				if ( $query->have_posts() ) { ?>
					<ul class="series">
					<?php while ( $query->have_posts() ) { $query->the_post();

						$seriescover = get_field('thumbnail', 'series_'.get_the_terms( $post->ID, 'series' )[0]->term_id); $placeholer = get_bloginfo('template_url').'/images/series-placeholder.png';

						if ( has_post_thumbnail() ) {
							$image = get_the_post_thumbnail_url( $post->id, 'thumb_uncropped' );
						} elseif($seriescover) {
							$image = wp_get_attachment_image_url( $seriescover, 'thumb_uncropped' );
						} else {
							$image = $placeholer;
						}
						?>

						<?php
							// Get series of post
							$seriesID = get_the_terms( $post->ID, 'series' )[0]->term_id;
							$seriesName = get_the_terms( $post->ID, 'series' )[0]->name;
							$seriesSlug = get_the_terms( $post->ID, 'series' )[0]->slug;
						?>
						<?php
							// if this series is not previous series
							if (!isset($previousSeriesID)) {
								$previousSeriesID = '';
							}

							if ($seriesID != $previousSeriesID) {
						?>
						<li data-series-id="<?php echo $seriesID ?>">
							<a href="/series/<?php echo $seriesSlug?>">
								<div class="cover"><img src="<?php echo $image ?>" alt="<?php echo $seriesName?>"></div>
								<h3 class="series-name"><?php echo $seriesName?></h3>
								<?php
									// Get Series Date Range
									$slug = get_the_terms( $post->ID, 'series' )[0]->slug;
									$args = array(
										'post_type'=>'message',
										'posts_per_page' => -1,
										'tax_query' => array(
											'relation' => 'AND',
											array(
												'taxonomy' => 'series',
												'field' => 'slug',
												'terms' => $slug,
											),
											array(
												'taxonomy' => 'campuses',
												'field' => 'slug',
												'terms' => $campus,
											),
										),
									);
									$posts_array = get_posts( $args );
									$first = $posts_array[0]->ID;
									$last = $posts_array[count($posts_array) -1 ]->ID;

									if(count($posts_array) == 1) {
										//echo get_the_title( $first );
										$date = get_the_date( 'M j, Y', $first );
									} else {
										//echo get_the_title( $first ) , ' - ' , echo get_the_title( $last );
										$date = get_the_date( 'M j, Y', $last ) . ' - ' . get_the_date( 'M j, Y', $first );
									}
								?>
								<span class="date"><?php echo $date ?></span>
							</a>
						</li>

						<?php  } ?>

						<?php $previousSeriesID = get_the_terms( $post->ID, 'series' )[0]->term_id; ?>

					<?php } ?>
					</ul>
				<?php } else { ?>
					<div style="padding: 40px 0; text-align: center;">It looks like there are no messages available for <?php the_archive_title(); ?>.</div>
				<?php }
				wp_reset_postdata();?>
				<a href="/messages/" class="button teal" style="margin: 0 auto; width: 241px; display: block;">View Messages Archive</a>
			</div>
		</section>


<script src="<?php bloginfo('template_url');?>/js/vendors/js.cookie.js"></script>
<script>
//////////////////////////////////////////////////////////////////////////////////////////////////
////// Remove content modules assigned to other campuses */
var $campus = Cookies.get('campus');
if ($campus) {
	$('.section').not('.campus-'+$campus).remove();
}
</script>

	<?php endwhile; ?>
<?php
get_footer();
