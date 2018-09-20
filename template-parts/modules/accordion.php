<section class="section accordion <?php echo $bg;?> <?php if(!$top){ echo 'no-top-padding';}?> <?php if(!$bottom){ echo 'no-bottom-padding';}?> <?php if( $assigned_campuses ) { foreach( $assigned_campuses as $assigned_campus ) { echo ' campus-'.$assigned_campus->slug; } } else { echo 'campus-all';} ?>" id="<?php echo $secid;?>">
    <div class="container">
        <?php if($heading) { ?><h2 class="heading <?php echo $align;?>"><?php echo $heading;?></h2><?php } ?>
        <?php if( have_rows('accordion') ): $countbtn = 1; $countcnt = 1;?>
        <div id="accordion" class="clearfix">
        	<?php while ( have_rows('accordion') ) : the_row();?>
                <div class="accordionButton btn-<?php echo $countbtn++;?>"><?php the_sub_field('heading');?> <i class="fas fa-angle-right"></i></div>
            	<div class="accordionContent cnt-<?php echo $countcnt++;?>">
            		<?php the_sub_field('content');?>
            	</div>
                <hr>
            <?php endwhile; ?>
        </div>
        <?php endif; ?>
    </div>
</section>
<script>
$(window).ready(function() {
    $('#<?php echo $secid;?> .btn-1').addClass('on');
	$('#<?php echo $secid;?> .cnt-1').slideDown('normal');
	
	$('#<?php echo $secid;?> .accordionButton').click(function() {
		$('#<?php echo $secid;?> .accordionButton').removeClass('on');
		$('#<?php echo $secid;?> .accordionContent').slideUp('normal');
		if($(this).next().is(':hidden') == true) {
			$('.accordionButton').removeClass('over');
			$(this).addClass('on');
			$(this).next().slideDown('normal');
		}
	});
	$('#<?php echo $secid;?> .accordionButton').mouseover(function() {
		$(this).addClass('over');
	}).mouseout(function() {
		$(this).removeClass('over');
	});
	//$('.accordionContent').hide();
});
</script>
