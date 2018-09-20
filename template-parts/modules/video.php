<?php
    // Content
    $video = get_sub_field('video');
?>
<section class="section video-plyr <?php echo $bg;?> <?php if(!$top){ echo 'no-top-padding';}?> <?php if(!$bottom){ echo 'no-bottom-padding';}?> <?php if( $assigned_campuses ) { foreach( $assigned_campuses as $assigned_campus ) { echo ' campus-'.$assigned_campus->slug; } } else { echo 'campus-all';} ?>" id="<?php echo $secid;?>">
    <div class="container">
        <div class="plyr__video-embed" id="plyr-<?php echo $i;?>">
            <?php if($heading) { ?><h2 class="heading <?php echo $align;?>"><?php echo $heading;?></h2><?php } ?>
            <?php echo $video;?>
        </div>
    </div>
</section>
<script>
$(window).ready(function(){
    const player = new Plyr('#plyr-<?php echo $i;?>');
});
</script>
