<?php
/**
 * Template part for displaying results in search pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package ROCKHARBOR_Church
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php if ('campus' == get_post_type()) { ?>
		<figure><a href="<?php the_permalink();?>"><?php echo the_post_thumbnail( 'thumbnail' );?></a></figure>
		<div class="content">
			<h2><a href="<?php the_permalink();?>">Rockharbor - <?php the_title();?></a></h2>
			<?php
				$address = get_field('address');
				$gtemp = explode (',',  implode($address));
				$coord = explode (',', implode($gtemp));
			?>
			<div class="address"><?php echo '<span>' . $gtemp[0] . ',</span> <span>' . $gtemp[1] . ', ' . $gtemp[2] . '</span>'; ?></div>
			<?php if( have_rows('hours') ): ?>
			<ul class="other-info">
				<?php while ( have_rows('hours') ) : the_row(); ?>
					<li><strong><?php the_sub_field('description');?>: </strong> <?php the_sub_field('hours');?></li>
				<?php endwhile; ?>
			</ul>
			<?php endif; ?>
		</div>
		
		
		
	<?php } elseif('message' == get_post_type()) {
		$seriescover = get_field('thumbnail', 'series_'.get_the_terms( $post->ID, 'series' )[0]->term_id);
		if ( has_post_thumbnail() ) {
			$image = get_the_post_thumbnail_url( $post->id, 'thumbnail' );
		} elseif($seriescover) {
			$image = wp_get_attachment_image_url( $seriescover, 'thumbnail' );
		} else {
			$image = get_bloginfo('template_url').'/images/series-placeholder.png';
		} ?>
		<figure><a href="<?php the_permalink();?>"><img src="<?php echo $image; ?>"></a></figure>
		<div class="content">
			<h2><a href="<?php the_permalink();?>"><?php the_title();?></a></h2>
			<div class="meta"><?php $date = get_the_date( 'F j, Y' ); echo $date;?></span> &nbsp;&mdash;&nbsp; <?php $terms_as_link = get_the_term_list( $post->ID, 'teacher', '<span>', ', ', '</span>' ) ; echo ($terms_as_link);?></div>
			<?php the_excerpt(); ?>
		</div>
		
		
		
	<?php } elseif('staff' == get_post_type()) {
		$staff = get_field('campus'); if( $staff ): foreach( $staff as $p ): $campus = ' '.sanitize_title(get_the_title( $p->ID )); endforeach; endif;
		$terms = get_the_terms( $post->ID, 'department'); foreach($terms as $term) { $dept = $term->slug . ' '; }
		$info = get_field('info');?>
		<figure>
			<a data-fancybox data-src="#<?php echo sanitize_title(get_the_title());?>" href="javascript:;">
			<?php
				echo the_post_thumbnail( 'thumbnail' );
				$alt = get_field('secondary_image');
				if($alt) { ?>
				<img src="<?php echo wp_get_attachment_image_url( $alt, 'thumbnail' ); ?>" class="alt-image">
			<?php } ?>
			</a>
		</figure>
		<div class="content">
			<h2><a data-fancybox data-src="#<?php echo sanitize_title(get_the_title());?>" href="javascript:;"><?php the_title();?> <small> - <?php if(get_field('church_wide')){ echo 'Church Wide'; } else {echo get_the_title( $p->ID );}?></small></a></h2>
			<span class="title"><?php echo $info['job_title'];?></span>
			<?php if($info['email']) { ?>
				<a href="mailto:<?php echo $info['mail'];?>" class="email"><?php echo $info['email'];?></a>
			<?php } ?>
			<?php if($info['phone']) { ?>
				<br>
				<a href="tel:<?php echo $info['phone'];?>" class="phone"><?php echo $info['phone'];?></a>
			<?php } ?>
		</div>
		<div id="<?php echo sanitize_title(get_the_title());?>" class="staff-profile">
			<div class="image">
				 <img src="<?php echo the_post_thumbnail_url( 'thumbnail' ); ?>" data-layzr="<?php echo the_post_thumbnail_url('medium_large');?>" alt="<?php the_title();?>">
			</div>
			<div class="content">
				<div class="info">
					<h3><?php the_title();?> <?php if(get_the_title( $p->ID )){?><small><?php echo get_the_title( $p->ID );?></small><?php }?></h3>
					<?php if($info['job_title']) { ?>
						<span><?php echo $info['job_title'];?></span>
					<?php } ?>
					<?php if($info['email']) { ?>
						<a href="mailto:<?php echo $info['mail'];?>" class="email"><?php echo $info['email'];?></a>
					<?php } ?>
					<?php if($info['email'] && $info['phone']) { ?> | <?php } ?>
					<?php if($info['phone']) { ?>
						<a href="tel:<?php echo $info['phone'];?>" class="phone"><?php echo $info['phone'];?></a>
					<?php } ?>
				</div>
				<div class="scroller">
					<?php if (!get_the_content() == ''){ ?>
						<div class="bio">
							<?php the_content();?>
						</div>
					<?php } ?>
					<div class="details">
						<?php if( have_rows('staff_bio') ): ?>
							<?php while ( have_rows('staff_bio') ) : the_row(); ?>
								<div class="section">
								<h4><?php the_sub_field('title');?></h4>
								<?php if( have_rows('details') ): ?>
									<?php while ( have_rows('details') ) : the_row(); ?>
										<div>
											<strong><?php the_sub_field('question');?></strong>
											<?php the_sub_field('answer');?>
										</div>
									<?php endwhile; ?>
								<?php endif; ?>
								</div>
							<?php endwhile; ?>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
		
		
		
	<?php } else { ?>
		<?php if ( has_post_thumbnail() ) { ?><figure><a href="<?php the_permalink();?>"><?php echo the_post_thumbnail( 'thumbnail' );?></a></figure><?php } ?>
		<div class="content">
			<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			<p><?php if(get_the_excerpt()) { the_excerpt(); } else { echo get_post_meta(get_the_ID(), '_yoast_wpseo_metadesc', true); } ?></p>
		</div>
		
		
		
	<?php } ?>
</article>
