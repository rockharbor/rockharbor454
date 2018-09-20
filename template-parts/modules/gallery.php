<?php
    // Content
    $images = get_sub_field('gallery');
    $size = get_sub_field('size');
    $fade = get_sub_field('fade');
    
    // Options
    $type = get_sub_field('type');
?>
<section class="section gallery <?php echo $bg;?> <?php if(!$top){ echo 'no-top-padding';}?> <?php if(!$bottom){ echo 'no-bottom-padding';}?> <?php if( $assigned_campuses ) { foreach( $assigned_campuses as $assigned_campus ) { echo ' campus-'.$assigned_campus->slug; } } else { echo 'campus-all';} ?>" id="<?php echo $secid;?>">
    <div class="container">
        <?php if($heading) { ?><h2 class="heading <?php echo $align;?>"><?php echo $heading;?></h2><?php } ?>
        <?php if($type == 'grid') {
            $col = count($images);?>
            <div class="gallery-grid <?php if($col == 1) {?>col-single<?php }else{?>col-<?php echo $size;?><?php }?>">
                <?php foreach( $images as $image ):?>
                    <?php if($col == '1') { ?>
                    <div style="background-image: url(<?php echo $image['sizes']['large']; ?>);"></div>
                <?php } else { ?>
                    <?php if($size == 'small') {
                        $imageurl = $image['sizes']['thumb_uncropped'];;
                    } elseif($size == 'medium') {
                        $imageurl = $image['sizes']['medium'];;
                    } else {
                        $imageurl = $image['sizes']['large'];;
                    } ?>
                    <div>
                        <a href="<?php echo $image['sizes']['large']; ?>" data-fancybox="gallery-grid-<?php echo $i;?>">
                            <img src="<?php echo $imageurl; ?>" data-layzr="<?php echo $image['sizes']['medium']; ?>" alt="">
                        </a>
                    </div>
                <?php } ?>
                <?php endforeach; ?>
            </div>
        <?php } else { ?>
            <div class="gallery-<?php echo $type;?>-<?php echo $i;?> <?php if($fade) { echo 'fade';}?>">
                <?php foreach( $images as $image ):?>
                    <?php if($type == 'slider') { ?>
                    <div class="slide" style="background-image: url(<?php echo $image['sizes']['large']; ?>);"></div>
                    <?php } else { ?>
                    <div>
                        <a href="<?php echo $image['sizes']['large']; ?>" data-fancybox="gallery-<?php echo $type;?>-<?php echo $i;?>">
                            <img src="<?php echo $image['sizes']['thumbnail']; ?>" data-layzr="<?php echo $image['sizes']['large']; ?>" alt="">
                        </a>
                    </div>
                    <?php } ?>
                    
                <?php endforeach; ?>
            </div>
        <?php } ?>
    </div>
</section>
<?php if($type == 'carousel') { ?>
<script>
$(window).ready(function(){
    $('.gallery-carousel-<?php echo $i;?>').slick({
    	arrows: false,
    	dots: true,
        centerMode: true,
    	infinite: true,
    	slidesToShow: 1,
      	slidesToScroll: 1,
      	speed: 500,
      	autoplay: true,
    	autoplaySpeed: 2000,
    	pauseOnFocus: true,
    	pauseOnHover: false,
    	pauseOnDotsHover: true,
        mobileFirst: true,
        responsive: [
        	{
          	breakpoint: 600,
          	settings: {
           		slidesToShow: 2,
                centerMode: false,
          		}
        	},
        	{
    		breakpoint: 800,
          	settings: {
            	slidesToShow: 2,
                centerMode: true,
          	    }
            },
        	{
    		breakpoint: 1100,
          	settings: {
            	slidesToShow: 3,
                centerMode: true,
          	    }
            }
        ]
    });
});
</script>
<?php } elseif($type == 'slider') { ?>
<script>
$(window).ready(function(){
    $('.gallery-slider-<?php echo $i;?>').slick({
    	arrows: false,
    	dots: true,
    	infinite: true,
    	slidesToShow: 1,
      	slidesToScroll: 1,
      	speed: 500,
        <?php if($fade) { ?>
        fade: true,
        cssEase: 'linear',
        <?php }?>
      	autoplay: true,
    	autoplaySpeed: 3000,
    	pauseOnFocus: true,
    	pauseOnHover: false,
    	pauseOnDotsHover: true,
    });
});
</script>
<?php } ?>
