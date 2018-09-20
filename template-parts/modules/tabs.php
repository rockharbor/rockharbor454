<?php
    $color = get_sub_field('tab_color');
?>
<section class="section tabs <?php echo $bg;?> <?php if(!$top){ echo 'no-top-padding';}?> <?php if(!$bottom){ echo 'no-bottom-padding';}?> <?php if( $assigned_campuses ) { foreach( $assigned_campuses as $assigned_campus ) { echo ' campus-'.$assigned_campus->slug; } } else { echo 'campus-all';} ?>" id="<?php echo $secid;?>">
    <div class="container">
        <?php if( have_rows('tabs') ): $count = 1;?>
        <ul class="tab-labels clearfix">
            <?php while ( have_rows('tabs') ) : the_row(); ?>
                <li class="<?php echo $color;?>"><a href="#tab<?php echo $count++;?>"><?php the_sub_field('tab_label');?></a></li>
            <?php endwhile; ?>
        </ul>
        <div class="tab-contents">
            <?php $count = 1?>
            <?php while ( have_rows('tabs') ) : the_row();?>
                <div id="tab<?php echo $count++;?>" class="tab-wrapper"><?php the_sub_field('tab_content');?></div>
            <?php endwhile; ?>
        </div>
        <?php endif; ?>
    </div>
</section>
<script>
$(window).ready(function(){
    $('ul.tab-labels').each(function(){
        var $active, $content, $links = $(this).find('a');
        $active = $($links.filter('[href="'+location.hash+'"]')[0] || $links[0]);
        $active.addClass('active');
        $content = $($active.attr('href'));
        
        $links.not($active).each(function () {
            $($(this).attr('href')).hide();
        });
    
        $(this).on('click', 'a', function(e){
            $active.removeClass('active');
            $content.hide();
            
            $active = $(this);
            $content = $($(this).attr('href'));
            
            $active.addClass('active');
            $content.fadeIn('fast');
            
            e.preventDefault();
        });
    });
});
</script>
