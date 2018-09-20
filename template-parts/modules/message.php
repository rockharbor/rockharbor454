<?php
    // Content
    $latest = get_sub_field('latest_message');
    $campusmessages = get_sub_field('campus_messages');
    $message = get_sub_field('message', false, false);
    
    // Options
    $align = get_sub_field('align');
?>
<section class="section message <?php echo $bg;?> <?php echo 'media-',$align;?> <?php if(!$top){ echo 'no-top-padding';}?> <?php if(!$bottom){ echo 'no-bottom-padding';}?> <?php if( $assigned_campuses ) { foreach( $assigned_campuses as $assigned_campus ) { echo ' campus-'.$assigned_campus->slug; } } else { echo 'campus-all';} ?>" id="<?php echo $secid;?>">
    <div class="container">
	    <?php
		
        if($latest) {
            $args = array(
                'post_type'              => array( 'message' ),
                'posts_per_page'         => '1',
                'order'                  => 'DESC',
                'orderby'                => 'date',
                'tax_query' => array(
			        array(
			            'taxonomy' => 'campuses',
						'field' => 'slug',
						'terms' => $campusmessages,
			        ),
			    ),
            );
        } else {
            $args = array(
                'post_type'              => array( 'message' ),
                'posts_per_page'	=> 1,
                'post__in'			=> $message,
                'post_status'		=> 'any',
                'orderby'        	=> 'post__in',
            );
        }
        $query = new WP_Query( $args );
        if ( $query->have_posts() ) {
            while ( $query->have_posts() ) {
                $query->the_post();
                $placeholer = get_bloginfo('template_url').'/images/series-placeholder.png';
				$seriescover = get_field('thumbnail', 'series_'.get_the_terms( $post->ID, 'series' )[0]->term_id);
				if ( has_post_thumbnail() ) {
					$imageMedium = get_the_post_thumbnail_url( $post->id, 'medium' );
					$imageLarge = get_the_post_thumbnail_url( $post->id, 'large' );
				} elseif($seriescover) {
					$imageMedium = wp_get_attachment_image_url( $seriescover, 'medium' );
					$imageLarge = wp_get_attachment_image_url( $seriescover, 'large' );
				} else {
					$imageMedium = $placeholer;
					$imageLarge = $placeholer;
				} 
                ?>
                <a href="<?php the_permalink();?>" class="cover"><img src="<?php echo $imageMedium; ?>" data-layzr="<?php echo $imageLarge; ?>" alt="<?php echo $term->name;?>"></a>
                <div class="content">
                    <h2>Current Message</h2>
                    <div class="info">
                        <h3><?php the_title();?></h3>
                        <?php the_excerpt();?>
                        <a href="/messages/"><strong>View Message Archive</strong></a>
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
