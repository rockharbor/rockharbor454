<section class="section expandable-banner <?php //echo $bg;?> <?php if(!$top){ echo 'no-top-padding';}?> <?php if(!$bottom){ echo 'no-bottom-padding';}?> <?php if( $assigned_campuses ) { foreach( $assigned_campuses as $assigned_campus ) { echo ' campus-'.$assigned_campus->slug; } } else { echo 'campus-all';} ?>" id="<?php echo $secid;?>">
    <div class="container">
        <?php if($heading) { ?><h2 class="heading <?php echo $align;?>"><?php echo $heading;?></h2><?php } ?>
        <?php if( have_rows('banner') ): $countbtn = 1; $countcnt = 1; ?>
        <div id="accordion" class="clearfix">
        	<?php while ( have_rows('banner') ) : the_row();
                $image = get_sub_field('image'); ?>
                <div class="wrapper">
                    <div class="cover" style="background-image: url(<?php echo wp_get_attachment_image_url( $image, 'large' );;?>);"></div>
                    <div class="accordionButton btn-<?php echo $countbtn++;?>"><h3><?php the_sub_field('heading');?> <i class="fas fa-plus"></i></h3></div>
                	<div class="accordionContent cnt-<?php echo $countcnt++;?>">
                		<div class="content"><?php the_sub_field('content');?></div>
                	</div>
                </div>
            <?php endwhile; ?>
        </div>
        <?php endif; ?>
    </div>
</section>
<script>
$(window).ready(function() {
    
	$('#<?php echo $secid;?> .accordionButton').click(function() {
		$('#<?php echo $secid;?> .accordionButton').removeClass('on');
        $('#<?php echo $secid;?> .cover').removeClass('on');
		$('#<?php echo $secid;?> .accordionContent').slideUp('normal');
		if($(this).next().is(':hidden') == true) {
			$(this).addClass('on');
            $(this).prev().addClass('on');
			$(this).next().slideDown('normal');
		}
	});
	$('#<?php echo $secid;?> .accordionButton').mouseover(function() {
		$(this).addClass('over');
        $(this).prev().addClass('over');
	}).mouseout(function() {
		$(this).removeClass('over');
        $(this).prev().removeClass('over');
	});
	$('#<?php echo $secid;?> .accordionContent').hide();
});
</script>
