<?php
$fullwidth = get_sub_field('full_width');
$spacing = get_sub_field('spacing');
?>
<section class="section callout <?php echo $bg;?> <?php if($fullwidth){ echo 'full-width ';}?><?php echo $bg;?> <?php if($spacing){ echo 'vertical-spacing ';}?><?php if(!$top){ echo 'no-top-padding';}?> <?php if(!$bottom){ echo 'no-bottom-padding';}?> <?php if( $assigned_campuses ) { foreach( $assigned_campuses as $assigned_campus ) { echo ' campus-'.$assigned_campus->slug; } } else { echo 'campus-all';} ?>" id="<?php echo $secid;?>">
    <div class="container">
        <?php while ( have_rows('banner') ) : the_row();?>
            <?php
            $image = get_sub_field('image');
            $title = get_sub_field('title');
            $blurb = get_sub_field('blurb');
            $type = get_sub_field('type');
            $link = get_sub_field('link');
            $url = get_sub_field('url');
            if ($type == 'link') {
            	$url = get_sub_field('link');
            }
            $new = get_sub_field('new_window');
            ?>
            <div class="banner">
                <a href="<?php echo $url;?>" <?php echo ($new) ? 'target="_blank"' : '';?>>
                    <div class="image" style="background-image: url(<?php echo wp_get_attachment_image_url( $image, 'large' ); ?>);"></div>
                    <div class="info">
                        <h3><?php echo $title;?></h3>
                        <?php if($blurb) { ?><p><?php echo $blurb;?></p><?php } ?>
                    </div>
					<div class="label"><span>More Info</span></div>
                </a>
            </div>
        <?php endwhile; ?>
    </div>
</section>
