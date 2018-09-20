<?php
/**
 * Template Name: About HR
 */

get_header();
	while ( have_posts() ) :	the_post();
		include(locate_template('template-parts/modules/page-header.php')); ?>



		<?php $blurb = count(get_field('blurb')); ?>
		<section class="section blurb">
		    <div class="container">
				<h2 class="heading">Discover Rockharbor</h2>
		        <?php if( have_rows('blurb') ): ?>
		        <ul class="count-<?php echo $blurb;?>">
		            <?php while ( have_rows('blurb') ) : the_row();
		                $image = wp_get_attachment_image_url(get_sub_field('image'),'thumbnail');
		                $type = get_sub_field('type');
		                $link = get_sub_field('link');
		                $url = get_sub_field('url');
		                $new = get_sub_field('new_window');
		            ?>
		            <li><a href="<?php echo ($type == 'link') ? $link : $url;?>" <?php echo (($type == 'url') && $new) ? 'target="_blank"' : '';?>><img src="<?php echo $image;?>"><h3><?php the_sub_field('title');?></h3></a></li>
		            <?php endwhile; ?>
		        </ul>
		        <?php endif; ?>
		    </div>
		</section>


		<?php while ( have_rows('teachings') ) : the_row();
			$image = get_sub_field('background');
		?>
		<section class="featured teachings">
			<div class="intro" style="background-image: url(<?php echo wp_get_attachment_image_url( $image, 'large' ); ?>);">
				<div class="wrapper">
					<div class="content">
					<?php while ( have_rows('content') ) : the_row(); ?>
						<h2><?php the_sub_field('heading');?></h2>
						<?php the_sub_field('content');?>
					<?php endwhile;?>
					</div>
				</div>
			</div>
			<div class="most-recent">
				<h3>Sermons to Get You Started</h3>
				<ul>
					<li>
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
								$campuses = get_the_terms( $post->ID, 'campuses' )[0]->name;
								$seriescover = get_field('thumbnail', 'series_'.get_the_terms( $post->ID, 'series' )[0]->term_id);
		
								if ( has_post_thumbnail() ) {
									$image = get_the_post_thumbnail_url( $post->id, 'thumb_uncropped' );
								} elseif($seriescover) {
									$image = wp_get_attachment_image_url( $seriescover, 'thumb_uncropped' );
								} else {
									$image = get_bloginfo('template_url').'/images/series-placeholder.png';
								} ?>

								<a href="<?php the_permalink();?>" class="cover"><img src="<?php echo $image; ?>" alt="<?php the_title();?>"></a>
								<h4><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
								<span><small>By <?php $terms_as_link = get_the_term_list( $post->ID, 'teacher', '<span>', ', ', '</span>' ) ; echo ($terms_as_link);?> - <?php echo $campuses;?></small></span>
							<?php }
						} wp_reset_postdata(); ?>
					</li>
					<li>
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
								$campuses = get_the_terms( $post->ID, 'campuses' )[0]->name;
								$seriescover = get_field('thumbnail', 'series_'.get_the_terms( $post->ID, 'series' )[0]->term_id);
		
								if ( has_post_thumbnail() ) {
									$image = get_the_post_thumbnail_url( $post->id, 'thumb_uncropped' );
								} elseif($seriescover) {
									$image = wp_get_attachment_image_url( $seriescover, 'thumb_uncropped' );
								} else {
									$image = get_bloginfo('template_url').'/images/series-placeholder.png';
								} ?>

								<a href="<?php the_permalink();?>" class="cover"><img src="<?php echo $image; ?>" alt="<?php the_title();?>"></a>
								<h4><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
								<span><small>By <?php $terms_as_link = get_the_term_list( $post->ID, 'teacher', '<span>', ', ', '</span>' ) ; echo ($terms_as_link);?> - <?php echo $campuses;?></small></span>
							<?php }
						} wp_reset_postdata(); ?>
					</li>
					<li>
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
								$campuses = get_the_terms( $post->ID, 'campuses' )[0]->name;
								$seriescover = get_field('thumbnail', 'series_'.get_the_terms( $post->ID, 'series' )[0]->term_id);
		
								if ( has_post_thumbnail() ) {
									$image = get_the_post_thumbnail_url( $post->id, 'thumb_uncropped' );
								} elseif($seriescover) {
									$image = wp_get_attachment_image_url( $seriescover, 'thumb_uncropped' );
								} else {
									$image = get_bloginfo('template_url').'/images/series-placeholder.png';
								} ?>

								<a href="<?php the_permalink();?>" class="cover"><img src="<?php echo $image; ?>" alt="<?php the_title();?>"></a>
								<h4><a href="<?php the_permalink();?>"><?php the_title();?></a></h4>
								<span><small>By <?php $terms_as_link = get_the_term_list( $post->ID, 'teacher', '<span>', ', ', '</span>' ) ; echo ($terms_as_link);?> - <?php echo $campuses;?></small></span>
							<?php }
						} wp_reset_postdata(); ?>
					</li>
				</ul>
			</div>
			<div class="listen-on">
				<h5>Listen On</h5>
				<?php while ( have_rows('listen_on') ) : the_row(); ?>
					<a href="<?php the_sub_field('url');?>" class="app"><img src="<?php bloginfo('template_url');?>/images/<?php the_sub_field('media');?>-app.png" target="_blank"></a>
				<?php endwhile; ?>
			</div>
		</section>
		<?php endwhile;?>
		



		<?php while ( have_rows('music') ) : the_row();
			$image = get_sub_field('background');
		?>
		<section class="featured music">
			<div class="intro" style="background-image: url(<?php echo wp_get_attachment_image_url( $image, 'large' ); ?>);">
				<div class="wrapper">
					<div class="content">
					<?php while ( have_rows('content') ) : the_row(); ?>
						<h2><?php the_sub_field('heading');?></h2>
						<?php the_sub_field('content');?>
					<?php endwhile;?>
					</div>
				</div>
			</div>
			<div class="most-recent">
				<h3>Recent Albums</h3>
				<ul>
				<?php while ( have_rows('albums') ) : the_row();
					$album = get_sub_field('album');
				?>
					<li>
						<div class="cover"><img src="<?php echo wp_get_attachment_image_url( $album, 'thumbnail' ); ?>"></div>
						<div class="info">
						<?php while ( have_rows('info') ) : the_row(); ?>
							<h4><?php the_sub_field('title');?></h4>
							<span><?php the_sub_field('artist');?></span>
							<audio class="player" controls>
							    <source src="<?php the_sub_field('mp3');?>" type="audio/mp3">
							</audio>
						<?php endwhile;?>
						</div>
					</li>
				<?php endwhile;?>
				</ul>
				<script>
				const players = Array.from(document.querySelectorAll('.player')).map(p => new Plyr(p,{
					enabled: true,
					debug: false,
					controls: ['play', 'progress'],
				}));
				$("audio").on("play", function() {
				    $("audio").not(this).each(function(index, audio) {
				        audio.pause();
				    });
				});
				</script>
			</div>
			<div class="listen-on">
				<h5>Listen On</h5>
				<?php while ( have_rows('listen_on') ) : the_row(); ?>
					<a href="<?php the_sub_field('url');?>" class="app"><img src="<?php bloginfo('template_url');?>/images/<?php the_sub_field('media');?>-app.png" target="_blank"></a>
				<?php endwhile; ?>
			</div>
		</section>
		<?php endwhile;?>



		<?php
			$promo = get_field('promos');
		    $single = $promo['single_promo'];
		    $double = $promo['double_promo'];
		    $full = $promo['full_promo'];
		    $left = $promo['left_promo'];
		    $right = $promo['right_promo'];
		?>
		<section class="section promos">
		    <div class="container">
		        <?php if($single) {?>
		        <div class="promo single <?php if($full['title'] || $full['blurb']){ echo 'has-info';}?>">
		            <?php if($full['button'] == '') {?><a href="<?php echo ($full['type'] == 'link') ? $full['link'] : $full['url'];?>" <?php echo ($full['type'] == 'external' && $full['new_window']) ? 'target="_blank"' : '';?>><?php }?>
		            <div class="image" style="background-image: url(<?php echo wp_get_attachment_image_url( $full['image'], 'large' ); ?>);"></div>
		            <?php if($full['title'] || $full['blurb']){ ?>
		            <div class="info">
		                <?php if($full['title']) { ?><h3><?php echo $full['title'];?></h3><?php } ?>
		                <?php if($full['blurb']) { ?><p><?php echo $full['blurb'];?></p><?php } ?>
		                <?php if($full['button']) {?><a href="<?php echo ($full['type'] == 'link') ? $full['link'] : $full['url'];?>" class="button <?php echo $full['button_color'];?>"><?php echo $full['button'];?></a><?php } ?>
		            </div>
		            <?php }?>
		            <?php if($full['button'] == '') {?></a><?php }?>
		        </div>
		        <?php }?>
		        <?php if($double) {?>
		        <div class="promo double <?php if($left['title'] || $left['blurb']){ echo 'has-info';}?>">
		            <?php if($left['button'] == '') {?><a href="<?php echo ($left['type'] == 'link') ? $left['link'] : $left['url'];?>" <?php echo ($left['type'] == 'external' && $left['new_window']) ? 'target="_blank"' : '';?>><?php }?>
		            <div class="image" style="background-image: url(<?php echo wp_get_attachment_image_url( $left['image'], 'large' ); ?>);"></div>
		            <?php if($left['title'] || $left['blurb']){ ?>
		            <div class="info">
		                <?php if($left['title']) { ?><h3><?php echo $left['title'];?></h3><?php } ?>
		                <?php if($left['blurb']) { ?><p><?php echo $left['blurb'];?></p><?php } ?>
		                <?php if($left['button']) {?><a href="<?php echo ($left['type'] == 'link') ? $left['link'] : $left['url'];?>" class="button <?php echo $left['button_color'];?>"><?php echo $left['button'];?></a><?php } ?>
		            </div>
		            <?php }?>
		            <?php if($left['button'] == '') {?></a><?php }?>
		        </div>
		        <div class="promo double <?php if($right['title'] || $right['blurb']){ echo 'has-info';}?>">
		            <?php if($right['button'] == '') {?><a href="<?php echo ($right['type'] == 'link') ? $right['link'] : $right['url'];?>" <?php echo ($right['type'] == 'external' && $right['new_window']) ? 'target="_blank"' : '';?>><?php }?>
		            <div class="image" style="background-image: url(<?php echo wp_get_attachment_image_url( $right['image'], 'large' ); ?>);"></div>
		            <?php if($right['title'] || $right['blurb']){ ?>
		            <div class="info">
		                <?php if($right['title']) { ?><h3><?php echo $right['title'];?></h3><?php } ?>
		                <?php if($right['blurb']) { ?><p><?php echo $right['blurb'];?></p><?php } ?>
		                <?php if($right['button']) {?><a href="<?php echo ($right['type'] == 'link') ? $right['link'] : $right['url'];?>" class="button <?php echo $right['button_color'];?>"><?php echo $right['button'];?></a><?php } ?>
		            </div>
		            <?php }?>
		            <?php if($right['button'] == '') {?></a><?php }?>
		        </div>
		        <?php } ?>
		    </div>
		</section>



	<?php endwhile;
get_footer();
