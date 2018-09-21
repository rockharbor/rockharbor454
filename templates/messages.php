<?php
/**
 * Template Name: Messages
 */

$campus = $_COOKIE['campus'] ?? null;
// If Campus Cookie Not set
if (!$campus) {
	// check for campus url parameter, ex: ?c=cotsa-mesa
	if(isset($_GET['c'])) {
    	$campus = $_GET['c'];
		setcookie('campus', $campus, 2147483647, '/');
	} else {
		//setcookie('campus', 'all', 2147483647, '/');
		$campus = 'all';
	}
}

get_header();
	while ( have_posts() ) :	the_post(); ?>


		<section class="section message no-top-padding campus-costa-mesa campus-all">
			<div class="container">
				<?php
				$m_args = array(
					'post_type'              => array( 'message' ),
					'posts_per_page'         => '1',
					'order'                  => 'DESC',
					'orderby'                => 'date',
					'tax_query' => array(
				        array(
				            'taxonomy' => 'campuses',
							'field' => 'slug',
							'terms' => 'costa-mesa',
				        ),
				    ),
				);
				$m_query = new WP_Query( $m_args );
				if ( $m_query->have_posts() ) {
					while ( $m_query->have_posts() ) {

						$m_query->the_post();

						$placeholder = get_bloginfo('template_url').'/images/series-placeholder.png';
						$seriescover = get_field('thumbnail', 'series_'.get_the_terms( $post->ID, 'series' )[0]->term_id);
						if ( has_post_thumbnail() ) {
							$imageMedium = get_the_post_thumbnail_url( $post->id, 'medium' );
							$imageLarge = get_the_post_thumbnail_url( $post->id, 'large' );
						} elseif($seriescover) {
							$imageMedium = wp_get_attachment_image_url( $seriescover, 'medium' );
							$imageLarge = wp_get_attachment_image_url( $seriescover, 'large' );
						} else {
							$imageMedium = $placeholder;
							$imageLarge = $placeholder;
						}

						 ?>
						<a href="<?php the_permalink();?>" class="cover"><img src="<?php echo $imageMedium; ?>" data-layzr="<?php echo $imageLarge; ?>" alt="<?php the_title(); ?>"></a>
						<div class="content">
							<h1 class="heading">Last Weekend&rsquo;s Message</h1>
							<div class="info">
								<h3><?php the_title();?></h3>
								<?php the_excerpt();?>
							</div>
							<div class="meta">
								<strong><?php $date = get_the_date( 'M j' ); echo $date;?></strong>
								<a href="<?php the_permalink();?>" class="button teal">View</a>
							</div>
						</div>
					<?php }
				} wp_reset_postdata(); ?>
			</div>
		</section>

		<section class="section message no-top-padding campus-mission-viejo">
			<div class="container">
				<?php
				$m_args = array(
					'post_type'              => array( 'message' ),
					'posts_per_page'         => '1',
					'order'                  => 'DESC',
					'orderby'                => 'date',
					'tax_query' => array(
				        array(
				            'taxonomy' => 'campuses',
							'field' => 'slug',
							'terms' => 'mission-viejo',
				        ),
				    ),
				);
				$m_query = new WP_Query( $m_args );
				if ( $m_query->have_posts() ) {
					while ( $m_query->have_posts() ) {

						$m_query->the_post();

						$placeholder = get_bloginfo('template_url').'/images/series-placeholder.png';
						$seriescover = get_field('thumbnail', 'series_'.get_the_terms( $post->ID, 'series' )[0]->term_id);
						if ( has_post_thumbnail() ) {
							$imageMedium = get_the_post_thumbnail_url( $post->id, 'medium' );
							$imageLarge = get_the_post_thumbnail_url( $post->id, 'large' );
						} elseif($seriescover) {
							$imageMedium = wp_get_attachment_image_url( $seriescover, 'medium' );
							$imageLarge = wp_get_attachment_image_url( $seriescover, 'large' );
						} else {
							$imageMedium = $placeholder;
							$imageLarge = $placeholder;
						}

						 ?>
						<a href="<?php the_permalink();?>" class="cover"><img src="<?php echo $imageMedium; ?>" data-layzr="<?php echo $imageLarge; ?>" alt="<?php the_title(); ?>"></a>
						<div class="content">
							<h1 class="heading">Last Weekend&rsquo;s Message</h1>
							<div class="info">
								<h3><?php the_title();?></h3>
								<?php the_excerpt();?>
							</div>
							<div class="meta">
								<strong><?php $date = get_the_date( 'M j' ); echo $date;?></strong>
								<a href="<?php the_permalink();?>" class="button teal">View</a>
							</div>
						</div>
					<?php }
				} wp_reset_postdata(); ?>
			</div>
		</section>

		<section class="section message no-top-padding campus-charlotte">
			<div class="container">
				<?php
				$m_args = array(
					'post_type'              => array( 'message' ),
					'posts_per_page'         => '1',
					'order'                  => 'DESC',
					'orderby'                => 'date',
					'tax_query' => array(
				        array(
				            'taxonomy' => 'campuses',
							'field' => 'slug',
							'terms' => 'charlotte',
				        ),
				    ),
				);
				$m_query = new WP_Query( $m_args );
				if ( $m_query->have_posts() ) {
					while ( $m_query->have_posts() ) {

						$m_query->the_post();

						$placeholder = get_bloginfo('template_url').'/images/series-placeholder.png';
						$seriescover = get_field('thumbnail', 'series_'.get_the_terms( $post->ID, 'series' )[0]->term_id);
						if ( has_post_thumbnail() ) {
							$imageMedium = get_the_post_thumbnail_url( $post->id, 'medium' );
							$imageLarge = get_the_post_thumbnail_url( $post->id, 'large' );
						} elseif($seriescover) {
							$imageMedium = wp_get_attachment_image_url( $seriescover, 'medium' );
							$imageLarge = wp_get_attachment_image_url( $seriescover, 'large' );
						} else {
							$imageMedium = $placeholder;
							$imageLarge = $placeholder;
						}

						 ?>
						<a href="<?php the_permalink();?>" class="cover"><img src="<?php echo $imageMedium; ?>" data-layzr="<?php echo $imageLarge; ?>" alt="<?php the_title(); ?>"></a>
						<div class="content">
							<h1 class="heading">Last Weekend&rsquo;s Message</h1>
							<div class="info">
								<h3><?php the_title();?></h3>
								<?php the_excerpt();?>
							</div>
							<div class="meta">
								<strong><?php $date = get_the_date( 'M j' ); echo $date;?></strong>
								<a href="<?php the_permalink();?>" class="button teal">View</a>
							</div>
						</div>
					<?php }
				} wp_reset_postdata(); ?>
			</div>
		</section>


		<section class="series-archive">
			<div class="container">
				<h2>Past Series</h2>
				<div class="filters">
					<div class="filter">
						<select id="campus-filter">
							<option value="all">All Campuses</option>
							<?php
							$campuses = 'campuses';
							$termsargs = array (
								'hide_empty'	=> 0,
								'parent'        => 0,
								'taxonomy'      => $campuses,
							);
							$terms = get_terms($termsargs);
								foreach($terms as $term){ ?>
								<option value="<?php echo $term->slug;?>"><?php echo $term->name;?></option>
							<?php } ?>
						</select>
					</div>
					<div class="filter">
						<select onchange="location = this.value;">
							<option value="">Filter by Teacher</option>
							<?php
							$teachers = 'teacher';
							$termsargs = array (
								'hide_empty'	=> 0,
								'parent'        => 0,
								'taxonomy'      => $teachers,
							);
							$terms = get_terms($termsargs);
								foreach($terms as $term){
									$termlink = get_term_link( $term->slug, $teachers );
									$currentterm = get_queried_object()->slug; //b
								if ($currentterm == $term->slug) { ?>
									<option value="<?php echo $termlink;?>" selected><?php echo $term->name;?></option>
								<?php } else { ?>
									<option value="<?php echo $termlink;?>"><?php echo $term->name;?></option>
								<?php }
							}?>
						</select>
					</div>
				</div>

				<section class="campus-series-archive campus-all">
					<?php
					$paged = ( get_query_var('page') ) ? get_query_var('page') : 1;
					$args = array (
						'taxonomy'			=> 'campuses',
						//'term'				=> 'costa-mesa',
						'post_type'         => array( 'message' ),
						'posts_per_page'    => 100,
						'paged' 			=> $paged,
						'order'             => 'DESC',
						'orderby'           => 'date',
					);
					// The Query
					$query = new WP_Query( $args );
					// The Loop
					if ( $query->have_posts() ) { ?>
						<ul class="series">
						<?php while ( $query->have_posts() ) { $query->the_post();

							$seriescover = get_field('thumbnail', 'series_'.get_the_terms( $post->ID, 'series' )[0]->term_id);
							$placeholder = get_bloginfo('template_url').'/images/series-placeholder.png';

							if ( has_post_thumbnail() ) {
								$image = get_the_post_thumbnail_url( $post->id, 'thumb_uncropped' );
							} elseif($seriescover) {
								$image = wp_get_attachment_image_url( $seriescover, 'thumb_uncropped' );
							} else {
								$image = $placeholder;
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
												)
											)
										);
										if (isset($campus) && ($campus != 'all')) {
											$args['tax_query'][] = array(
												'taxonomy' => 'campuses',
												'field' => 'slug',
												'terms' => $campus
											);
										}
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
					<?php } ?>
					<?php wp_reset_postdata();?>

					<div class="pagination-infinite campus-all">
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
				</section>
				<section class="campus-series-archive campus-costa-mesa">
					<?php
					$paged = ( get_query_var('page') ) ? get_query_var('page') : 1;
					$args = array (
						'taxonomy'			=> 'campuses',
						'term'				=> 'costa-mesa',
						'post_type'         => array( 'message' ),
						'posts_per_page'    => 100,
						'paged' 			=> $paged,
						'order'             => 'DESC',
						'orderby'           => 'date',
					);
					// The Query
					$query = new WP_Query( $args );
					// The Loop
					if ( $query->have_posts() ) { ?>
						<ul class="series">
						<?php while ( $query->have_posts() ) { $query->the_post();

							$seriescover = get_field('thumbnail', 'series_'.get_the_terms( $post->ID, 'series' )[0]->term_id);				$placeholder = get_bloginfo('template_url').'/images/series-placeholder.png';

							if ( has_post_thumbnail() ) {
								$image = get_the_post_thumbnail_url( $post->id, 'thumb_uncropped' );
							} elseif($seriescover) {
								$image = wp_get_attachment_image_url( $seriescover, 'thumb_uncropped' );
							} else {
								$image = $placeholder;
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
					<?php } ?>
					<?php wp_reset_postdata();?>

					<div class="pagination-infinite campus-costa-mesa">
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
				</section>

				<section class="campus-series-archive campus-mission-viejo">
					<?php
					$paged = ( get_query_var('page') ) ? get_query_var('page') : 1;
					$args = array (
						'taxonomy'			=> 'campuses',
						'term'				=> 'mission-viejo',
						'post_type'         => array( 'message' ),
						'posts_per_page'    => 100,
						'paged' 			=> $paged,
						'order'             => 'DESC',
						'orderby'           => 'date',
					);
					// The Query
					$query = new WP_Query( $args );
					// The Loop
					if ( $query->have_posts() ) { ?>
						<ul class="series">
						<?php while ( $query->have_posts() ) { $query->the_post();

							$seriescover = get_field('thumbnail', 'series_'.get_the_terms( $post->ID, 'series' )[0]->term_id);				$placeholder = get_bloginfo('template_url').'/images/series-placeholder.png';

							if ( has_post_thumbnail() ) {
								$image = get_the_post_thumbnail_url( $post->id, 'thumb_uncropped' );
							} elseif($seriescover) {
								$image = wp_get_attachment_image_url( $seriescover, 'thumb_uncropped' );
							} else {
								$image = $placeholder;
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
					<?php } ?>
					<?php wp_reset_postdata();?>

					<div class="pagination-infinite campus-mission-viejo">
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
				</section>

				<section class="campus-series-archive campus-charlotte">
					<?php
					$paged = ( get_query_var('page') ) ? get_query_var('page') : 1;
					$args = array (
						'taxonomy'			=> 'campuses',
						'term'				=> 'charlotte',
						'post_type'         => array( 'message' ),
						'posts_per_page'    => 100,
						'paged' 			=> $paged,
						'order'             => 'DESC',
						'orderby'           => 'date',
					);
					// The Query
					$query = new WP_Query( $args );
					// The Loop
					if ( $query->have_posts() ) { ?>
						<ul class="series">
						<?php while ( $query->have_posts() ) { $query->the_post();

							$seriescover = get_field('thumbnail', 'series_'.get_the_terms( $post->ID, 'series' )[0]->term_id);				$placeholder = get_bloginfo('template_url').'/images/series-placeholder.png';

							if ( has_post_thumbnail() ) {
								$image = get_the_post_thumbnail_url( $post->id, 'thumb_uncropped' );
							} elseif($seriescover) {
								$image = wp_get_attachment_image_url( $seriescover, 'thumb_uncropped' );
							} else {
								$image = $placeholder;
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
					<?php } ?>
					<?php wp_reset_postdata();?>

					<div class="pagination-infinite campus-charlott">
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
				</section>
			</div>
		</section>

	<?php endwhile; ?>

	<script src="<?php bloginfo('template_url');?>/js/vendors/infinite-scroll.pkgd.js"></script>
	<script src="<?php bloginfo('template_url');?>/js/vendors/js.cookie.js"></script>

	<script>
	//////////////////////////////////////////////////////////////////////////////////////////////////
	////// Remove content modules assigned to other campuses */

	var $campus = Cookies.get('campus'); // => 'value'
	if ($campus) {
		if ($campus != 'all') {
			var $campus  = 'campus-'+$campus; // add campus- to match class
			$('.section.message').not('.'+$campus).remove(); // remove featured messages from other campuses
			$('.campus-series-archive').not('.'+$campus).remove(); // remove featured messages from other campuses
		} else {
			$('.section.message').not('.campus-all').remove();
			$('.campus-series-archive').not('.campus-all').remove();
		}
	} else {
		$('.section.message').not('.campus-all').remove();
		$('.campus-series-archive').not('.campus-all').remove();
	}
	</script>

	<script>

		$(function () {
			$('.campus-all .series').infiniteScroll({
			  path: '.campus-all .page-numbers.next',
			  append: '.campus-all .series li',
			  responseType: 'document',
			  scrollThreshold: 400,
			  history: false,
			  hideNav: '.campus-all .pagination-infinite',
			  status: '.campus-all .page-load-status',
			  debug: false,
			})

			$('.campus-costa-mesa .series').infiniteScroll({
			  path: '.campus-costa-mesa .page-numbers.next',
			  append: '.campus-costa-mesa .series li',
			  responseType: 'document',
			  scrollThreshold: 400,
			  history: false,
			  hideNav: '.campus-costa-mesa .pagination-infinite',
			  status: '.campus-costa-mesa .page-load-status',
			  debug: false,
			})

			$('.campus-mission-viejo .series').infiniteScroll({
			  path: '.campus-mission-viejo .page-numbers.next',
			  append: '.campus-mission-viejo .series li',
			  responseType: 'document',
			  scrollThreshold: 400,
			  history: false,
			  hideNav: '.campus-mission-viejo .pagination-infinite',
			  status: '.campus-mission-viejo .page-load-status',
			  debug: false,
			})

			$('.campus-charlotte .series').infiniteScroll({
			  path: '.campus-charlotte .page-numbers.next',
			  append: '.campus-charlotte .series li',
			  responseType: 'document',
			  scrollThreshold: 400,
			  history: false,
			  hideNav: '.campus-charlotte .pagination-infinite',
			  status: '.campus-charlotte .page-load-status',
			  debug: false,
			})

			$('.series').on( 'append.infiniteScroll', function( event, response, path, items ) {
				removeDuplicateSeries();
			});

			function removeDuplicateSeries() {
				var seen = {};
				$('.series li').each(function() {
				    var identifier = $(this).data('series-id');
				    if (seen[identifier])
				        $(this).remove();
				    else
				        seen[identifier] = true;
				});
				//console.log('removeDuplicateSeries');
			}
			removeDuplicateSeries();
		});
	</script>

<?php
get_footer();
