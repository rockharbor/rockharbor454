<?php
$includeall = get_sub_field('all_campuses');
$campuses = get_sub_field('campuses', false, false);
?>
<section class="section campuses <?php echo $bg;?> <?php if(!$top){ echo 'no-top-padding';}?> <?php if(!$bottom){ echo 'no-bottom-padding';}?> <?php if( $assigned_campuses ) { foreach( $assigned_campuses as $assigned_campus ) { echo ' campus-'.$assigned_campus->slug; } } else { echo 'campus-all';} ?>" id="<?php echo $secid;?>">
    <div class="container">
            <?php
            if($includeall) {
                $args = array(
                    'post_type'      	=> 'campus',
                	'posts_per_page'	=> -1,
                    'orderby'        	=> 'title',
                    'order'             => 'ASC'
                );
            } else {
                $args = array(
                    'post_type'      	=> 'campus',
                	'posts_per_page'	=> -1,
                	'post__in'			=> $campuses,
                	'post_status'		=> 'any',
                	'orderby'        	=> 'post__in',
                );
            }
            $query = new WP_Query( $args );
            if ( $query->have_posts() ) {
                while ( $query->have_posts() ) {
                $query->the_post();
					$address = get_field('address');
					$gtemp = explode (',',  implode($address));
					$coord = explode (',', implode($gtemp));
                ?>
                    <div class="campus">
                        <div class="name" style="background-image: url(<?php echo the_post_thumbnail_url( 'medium_large' );?>);"><h3><?php the_title();?></h3></div>
                        <div class="info">
                            <div class="times"><i class="bx bx-time"></i>
                                <?php
            					$rows = get_field('hours');
            					$first_row = $rows[0];
            					if($rows) { ?>
                                    <div><strong><?php echo $first_row['description'];?></strong><?php echo $first_row['hours'];?></div>
            					<?php } ?>
                            </div>
                            <div class="address"><i class="bx bx-map"></i><div><?php echo $gtemp[0] . ',<br>' . $gtemp[1] . ', ' . $gtemp[2]; ?></div></div>
                        </div>
                        <a href="<?php the_permalink();?>"><span>Visit</span></a>
                    </div>
                <?php }
            } wp_reset_postdata(); ?>
        </div>
    </div>
</section>
