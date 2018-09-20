<?php
$style = get_field('header_style');
$align = get_field('align');
$gradient = get_field('gradient');
$title = get_field('custom_title');
$blurb = get_field('page_blurb');
//$image = get_field('header_image');
//$url = wp_get_attachment_image_url($image,'large');
$video = get_field('header_video');

if(!($style == 'none')) { ?>
    <section class="section page-header <?php echo $style;?> <?php if($style == 'gradient'){ echo $gradient;}?> <?php if( isset($assigned_campuses) && !is_null($assigned_campuses) ) { foreach( $assigned_campuses as $assigned_campus ) { echo ' campus-'.$assigned_campus->slug; } } else { echo 'campus-all';} ?>" id="<?php echo 'page' , the_ID() , '_0';?>">
        <?php if($style == 'image'){ ?><div class="background-image" style="background-image:url(<?php echo the_post_thumbnail_url( 'large' ); ?>);"></div><?php } ?>
        <?php if($style == 'video'){ ?>
            <video poster="<?php echo the_post_thumbnail_url( 'large' ); ?>" id="plyr-header" playsinline controls>
                <source src="<?php echo $video;?>" type="video/mp4">
            </video>
        <?php } ?>
        <div class="container">
            <h1 class="heading <?php echo $align;?>"><?php if($title) { the_field('page_title'); } else { the_title(); } ?></h1>
            <?php if($blurb) { ?><div class="blurb <?php echo $align;?>"><?php the_field('page_blurb');?></div><?php }?>
        </div>
    </section>
    <?php if($style == 'video'){ ?>
    <script>
        const player_audio = new Plyr('#plyr-header');
    </script>
    <?php } ?>
<?php } ?>
