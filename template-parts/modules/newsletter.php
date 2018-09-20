<?php
// Content
$content = get_sub_field('content');
$image = get_sub_field('image');
?>
<section class="section newsletter <?php echo $bg;?> <?php if(!$top){ echo 'no-top-padding';}?> <?php if(!$bottom){ echo 'no-bottom-padding';}?> <?php if( $assigned_campuses ) { foreach( $assigned_campuses as $assigned_campus ) { echo ' campus-'.$assigned_campus->slug; } } else { echo 'campus-all';} ?>" id="<?php echo $secid;?>">
    <div class="container">
        <div class="col content"><?php echo $content;?></div>
        <div class="col image"><?php echo wp_get_attachment_image( $image, 'medium_large' ); ?></div>
    </div>
</section>
