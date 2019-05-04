<?php
$filterC = get_sub_field('filter_campuses');
$filterD = get_sub_field('filter_departments');
$custom = get_sub_field('custom_staff');
$staff = get_sub_field('staff', false, false);
?>
<section class="section staff <?php echo $bg;?> <?php if(!$top){ echo 'no-top-padding';}?> <?php if(!$bottom){ echo 'no-bottom-padding';}?> <?php if( $assigned_campuses ) { foreach( $assigned_campuses as $assigned_campus ) { echo ' campus-'.$assigned_campus->slug; } } else { echo 'campus-all';} ?>" id="<?php echo $secid;?>">
    <div class="container">
        <?php if($filterD || $filterD) { ?>
        <div class="filters">
            <?php if($filterC){ ?>
            <div class="filter">
                <span>Filter by Campus</span>
                <select class="filter-select" data-filter-group="campuses">
                    <option data-filter-value="*">Show All</option>
                    <?php // WP_Query arguments
                    $args = array(
                        'post_type'      	=> 'campus',
                    	'posts_per_page'	=> -1,
                    );
                    $query = new WP_Query( $args );
                    if ( $query->have_posts() ) {
                        while ( $query->have_posts() ) {
                        $query->the_post(); ?>
                            <option data-filter-value=".<?php echo sanitize_title(get_the_title());?>"><?php the_title();?></option>
                        <?php }
                    }
                    wp_reset_postdata();
                    ?>
                    <option data-filter-value=".church-wide">Church-Wide</option>
                </select>
            </div>
            <?php }?>
            <?php if($filterD){ ?>
            <div class="filter">
                <span>Filter by Department</span>
                <select class="filter-select" data-filter-group="departments">
                    <option data-filter-value="*">Show All</option>
                    <?php
                    $termsargs = array (
                        'hide_empty'	=> 1,
                        'parent'        => 0,
                        'taxonomy'      => 'department',
                    );
                    $terms = get_terms($termsargs);
                    	foreach($terms as $term){
                        $termlink = get_term_link( $term->slug, 'department' ); ?>
                        <option data-filter-value=".<?php echo $term->slug;?>"><?php echo $term->name;?></option>
                    <?php } ?>
                </select>
            </div>
            <?php }?>
        </div>
        <?php }?>
        <div class="staff-list">
            <?php
            if($custom) {
                $args = array(
                    'post_type'      	=> 'staff',
                	'posts_per_page'	=> -1,
                	'post__in'			=> $staff,
                	'post_status'		=> 'any',
                	'orderby'        	=> 'post__in',
                );
            } else {
                $args = array(
                    'post_type'      	=> 'staff',
                	'posts_per_page'	=> -1,
                    'orderby'        	=> 'title',
                    'order'             => 'ASC'
                );
            }
            $query = new WP_Query( $args );
            if ( $query->have_posts() ) {
                while ( $query->have_posts() ) {
                $query->the_post();
                    //Get campuses
                    $posts = get_field('campus'); if( $posts ): foreach( $posts as $p ): $staffCampus = ' '.sanitize_title(get_the_title( $p->ID )); endforeach; endif;
                    //Get departments
                    $terms = get_the_terms( $post->ID, 'department'); foreach($terms as $term) { $dept = $term->slug . ' '; }?>
                    <div class="item<?php if(get_field('church_wide')){echo ' church-wide';} else {echo $staffCampus;}?> <?php echo $dept;?>" data-category="<?php if(get_field('church_wide')){echo 'church-wide';} else {echo $staffCampus;}?> <?php echo $dept;?>">
                        <a data-fancybox data-options='{"touch" : false}' data-src="#<?php echo sanitize_title(get_the_title());?>" href="javascript:;">
                            <div class="figure">
                            	<img src="<?php bloginfo('template_url');?>/images/spacer.gif" data-layzr="<?php echo the_post_thumbnail_url('thumbnail');?>" alt="<?php the_title();?>">
                                <?php
                                    $alt = get_field('secondary_image');
                                    if($alt) { ?>
                                    <img src="<?php echo wp_get_attachment_image_url( $alt, 'thumbnail' ); ?>" class="alt-image" alt="<?php the_title();?>">
                                <?php } ?>
                            </div>
                            <div class="name">
                                <h3><?php the_title();?></h3>
                                <small><?php echo $term->name;?></small>
                            </div>
                        </a>
                    </div>
                <?php }
            }
            wp_reset_postdata();
            ?>
        </div>
        <?php
        if($custom) {
            $args = array(
                'post_type'      	=> 'staff',
                'posts_per_page'	=> -1,
                'post__in'			=> $staff,
                'post_status'		=> 'any',
                'orderby'        	=> 'post__in',
            );
        } else {
            $args = array(
                'post_type'      	=> 'staff',
                'posts_per_page'	=> -1,
                'orderby'        	=> 'title',
                'order'             => 'ASC'
            );
        }
        $query = new WP_Query( $args );
        if ( $query->have_posts() ) {
            while ( $query->have_posts() ) {
            $query->the_post();
                //Get campuses
                $posts = get_field('campus'); if( $posts ): foreach( $posts as $p ): $staffCampus = ' '.sanitize_title(get_the_title( $p->ID )); endforeach; endif;
                //Get departments
                $terms = get_the_terms( $post->ID, 'department'); foreach($terms as $term) { $dept = $term->slug . ' '; }
                $info = get_field('info');
                ?>
                <div id="<?php echo sanitize_title(get_the_title());?>" class="staff-profile">
                    <div class="image">
	                    <img src="<?php echo the_post_thumbnail_url( 'thumbnail' ); ?>" data-layzr="<?php echo the_post_thumbnail_url('medium_large');?>" alt="<?php the_title();?>">
                    </div>
                    <div class="content">
                        <div class="info">
                            <h3><?php the_title();?> <small><?php if(get_field('church_wide')){ echo 'Church-wide'; } else {echo get_the_title( $p->ID );}?></small></h3>
                            <?php if($info['job_title']) { ?>
                                <span><?php echo $info['job_title'];?></span>
                            <?php } ?>
                            <?php if($info['email']) { ?>
                                <a href="mailto:<?php echo $info['email'];?>" class="email"><?php echo $info['email'];?></a>
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
            <?php }
        }
        wp_reset_postdata();
        ?>
    </div>
</section>
<script>
$(window).on('load',function() {
    var $container = $('.staff-list'),
        filters = {};
    $container.isotope({
        itemSelector : '.item',
        layoutMode: 'fitRows'
    });
    // filter buttons
    $('select').change(function(){
        var $this = $(this);
        var group = $this.attr('data-filter-group');
        filters[ group ] = $this.find(':selected').attr('data-filter-value');
        // console.log( $this.find(':selected') )
        // convert object into array
        var isoFilters = [];
        for ( var prop in filters ) {
            isoFilters.push( filters[ prop ] )
        }
        console.log(filters);
        var selector = isoFilters.join('');
        $container.isotope({ filter: selector });
        return false;
    });
});
</script>
