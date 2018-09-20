<?php
    // Content
    $type = get_sub_field('type');
    $image = wp_get_attachment_image_url( get_sub_field('image'), 'medium_large' );
    $images = get_sub_field('gallery');
    $video = get_sub_field('video', false, false);
    
    // Options
    $align = get_sub_field('align');
?>
<section class="section media-content <?php echo $bg;?> <?php echo 'media-',$align;?> <?php if(!$top){ echo 'no-top-padding';}?> <?php if(!$bottom){ echo 'no-bottom-padding';}?> <?php if( $assigned_campuses ) { foreach( $assigned_campuses as $assigned_campus ) { echo ' campus-'.$assigned_campus->slug; } } else { echo 'campus-all';} ?>" id="<?php echo $secid;?>">
    <div class="container">
        <div class="media <?php echo $type;?>" <?php if($type == 'image') {?>style="background-image:url(<?php echo $image;?>);"<?php } ?>>
            <?php if($type == 'video') { ?>
                <a href="<?php echo $video;?>" class="media-video" data-fancybox style="background-image: url(<?php echo get_video_thumbnail( $video );?>);"><i class='fas fa-play'></i></a>
                <?php/*
                <a data-fancybox data-src="#media-video-<?php echo $i;?>" class="media-video" href="javascript:;" style="background-image: url(<?php echo get_video_thumbnail( $video );?>);"><i class='bx bx-play-circle'></i></a>
                <div id="media-video-<?php echo $i;?>" class="hidden-media-video">
                    <div class="plyr__video-embed" id="plyr-<?php echo $i;?>">
                        <?php the_sub_field('video');?>
                    </div>
                </div>
                */?>
            <?php } elseif($type == 'gallery') { ?>
                <div class="media-slider-<?php echo $i;?>">
                    <?php foreach( $images as $image ): ?>
                        <div><a href="<?php echo $image['sizes']['large']; ?>" style="background-image:url(<?php echo $image['sizes']['medium_large']; ?>);" data-fancybox="gallery<?php echo $i;?>"></a></div>
                    <?php endforeach; ?>
                </div>
            <?php } ?>
        </div>
        <div class="content"><?php the_sub_field('content');?></div>
    </div>
</section>
<?php if($type == 'gallery') { ?>
<script>
$(window).ready(function(){
    $('.media-slider-<?php echo $i;?>').slick({
    	arrows: false,
    	dots: true,
    	infinite: true,
    	slidesToShow: 1,
      	slidesToScroll: 1,
      	speed: 500,
    	fade: true,
      	cssEase: 'linear',
      	//autoplay: true,
    	//autoplaySpeed: 2000,
    	pauseOnFocus: true,
    	pauseOnHover: false,
    	pauseOnDotsHover: true,
    });
});
</script>
<?php } ?>
<?php if($type == 'video') { ?>
<script>
$(window).ready(function(){
    const player = new Plyr('#plyr-<?php echo $i;?>');
});
</script>
<?php } ?>
