<?php
    $blurb = count(get_sub_field('blurb'));
?>
<section class="section blurb <?php echo $bg;?> <?php if(!$top){ echo 'no-top-padding';}?> <?php if(!$bottom){ echo 'no-bottom-padding';}?> <?php if( $assigned_campuses ) { foreach( $assigned_campuses as $assigned_campus ) { echo ' campus-'.$assigned_campus->slug; } } else { echo 'campus-all';} ?>" id="<?php echo $secid;?>">
    <div class="container">
        <?php if($heading) { ?><h2 class="heading <?php echo $align;?>"><?php echo $heading;?></h2><?php } ?>
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
