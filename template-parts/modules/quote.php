<?php
// Content
$quote = count(get_sub_field('quotes'));
$gradient = get_sub_field('gradient');
?>

<section class="section quote <?php echo $bg;?> <?php if(!$top){ echo 'no-top-padding';}?> <?php if(!$bottom){ echo 'no-bottom-padding';}?> <?php if( $assigned_campuses ) { foreach( $assigned_campuses as $assigned_campus ) { echo ' campus-'.$assigned_campus->slug; } } else { echo 'campus-all';} ?>" id="<?php echo $secid;?>">
    <div class="container">
        <?php if($quote <= 1) {
            if( have_rows('quotes') ):
            	while ( have_rows('quotes') ) : the_row(); ?>
            	    <blockquote><p class="<?php echo $gradient;?>"><?php the_sub_field('quote');?></p><?php if(get_sub_field('name')){?><small><?php the_sub_field('name');?></small><?php }?></blockquote>
                <?php endwhile;
            endif;
        } else {
            if( have_rows('quotes') ): ?>
            <div class="quotes-<?php echo $i;?>">
            	<?php while ( have_rows('quotes') ) : the_row(); ?>
            	    <div><blockquote><p class="<?php echo $gradient;?>"><?php the_sub_field('quote');?></p><?php if(get_sub_field('name')){?><small><?php the_sub_field('name');?></small><?php }?></blockquote></div>
                <?php endwhile; ?>
            </div>
            <?php endif;
        } ?>
    </div>
</section>
<?php if($quote >= 2) {?>
<script>
$(window).ready(function(){
    $('.quotes-<?php echo $i;?>').slick({
    	arrows: false,
    	dots: true,
    	infinite: true,
    	slidesToShow: 1,
      	slidesToScroll: 1,
      	speed: 500,
        fade: true,
        cssEase: 'linear',
        adaptiveHeight: true,
        autoplay: true,
    	autoplaySpeed: 8000,
    	pauseOnFocus: true,
    	pauseOnHover: false,
    	pauseOnDotsHover: true,
    });
});
</script>
<?php } ?>
