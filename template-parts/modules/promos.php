<?php
    $single = get_sub_field('single_promo');
    $double = get_sub_field('double_promo');
    $full = get_sub_field('full_promo');
    $left = get_sub_field('left_promo');
    $right = get_sub_field('right_promo');
?>
<section class="section promos <?php echo $bg;?> <?php if(!$top){ echo 'no-top-padding';}?> <?php if(!$bottom){ echo 'no-bottom-padding';}?> <?php if( $assigned_campuses ) { foreach( $assigned_campuses as $assigned_campus ) { echo ' campus-'.$assigned_campus->slug; } } else { echo 'campus-all';} ?>" id="<?php echo $secid;?>">
    <div class="container">
        <?php if($single) {?>
        <div class="promo single <?php if($full['title'] || $full['blurb']){ echo 'has-info';}?>">
            <?php if($full['type'] != 'none') {?>
            <?php if($full['button'] == '') {?>
            	<a href="<?php echo ($full['type'] == 'link') ? $full['link'] : $full['url'];?>" <?php echo ($full['type'] == 'external' && $full['new_window']) ? 'target="_blank"' : '';?>>
	        <?php }?>
	        <?php }
            $bgUrl = wp_get_attachment_image_url( $full['image'], 'large');
            $backgroundAttribute = empty($bgUrl) ? 'background: #fff;' : 'background-image: url(' . $bgUrl . ');'; ?>
            <div class="image" style="<?php echo $backgroundAttribute; ?>"></div>
            <?php if($full['title'] || $full['blurb']){ ?>
            <div class="info">
                <?php if($full['title']) { ?><h3><?php echo $full['title'];?></h3><?php } ?>
                <?php if($full['blurb']) { ?><p><?php echo $full['blurb'];?></p><?php } ?>
                <?php if($full['button']) {?><a href="<?php echo ($full['type'] == 'link') ? $full['link'] : $full['url'];?>" class="button <?php echo $full['button_color'];?>"><?php echo $full['button'];?></a><?php } ?>
            </div>
            <?php }?>
            <?php if($full['type'] != 'none') {?>
            <?php if($full['button'] == '') {?>
            	</a>
            <?php }?>
            <?php }?>
        </div>
        <?php }?>
        <?php if($double) {?>
        <div class="promo double <?php if($left['title'] || $left['blurb']){ echo 'has-info';}?>">
            <?php if($left['type'] != 'none') {?>
            <?php if($left['button'] == '') {?>
            	<a href="<?php echo ($left['type'] == 'link') ? $left['link'] : $left['url'];?>" <?php echo ($left['type'] == 'external' && $left['new_window']) ? 'target="_blank"' : '';?>>
	        <?php }?>
	        <?php }
            $bgUrl = wp_get_attachment_image_url( $left['image'], 'large');
            $backgroundAttribute = empty($bgUrl) ? 'background: #fff;' : 'background-image: url(' . $bgUrl . ');'; ?>
            <div class="image" style="<?php echo $backgroundAttribute; ?>"></div>
            <?php if($left['title'] || $left['blurb']){ ?>
            <div class="info">
                <?php if($left['title']) { ?><h3><?php echo $left['title'];?></h3><?php } ?>
                <?php if($left['blurb']) { ?><p><?php echo $left['blurb'];?></p><?php } ?>
                <?php if($left['button']) {?><a href="<?php echo ($left['type'] == 'link') ? $left['link'] : $left['url'];?>" class="button <?php echo $left['button_color'];?>"><?php echo $left['button'];?></a><?php } ?>
            </div>
            <?php }?>
            <?php if($left['type'] != 'none') {?>
            <?php if($left['button'] == '') {?>
            	</a>
            <?php }?>
            <?php }?>
        </div>
        <div class="promo double <?php if($right['title'] || $right['blurb']){ echo 'has-info';}?>">
            <?php if($right['type'] != 'none') {?>
            <?php if($right['button'] == '') {?>
            	<a href="<?php echo ($right['type'] == 'link') ? $right['link'] : $right['url'];?>" <?php echo ($right['type'] == 'external' && $right['new_window']) ? 'target="_blank"' : '';?>>
	        <?php }?>
	        <?php }
            $bgUrl = wp_get_attachment_image_url( $right['image'], 'large');
            $backgroundAttribute = empty($bgUrl) ? 'background: #fff;' : 'background-image: url(' . $bgUrl . ');'; ?>
            <div class="image" style="<?php echo $backgroundAttribute; ?>"></div>
            <?php if($right['title'] || $right['blurb']){ ?>
            <div class="info">
                <?php if($right['title']) { ?><h3><?php echo $right['title'];?></h3><?php } ?>
                <?php if($right['blurb']) { ?><p><?php echo $right['blurb'];?></p><?php } ?>
                <?php if($right['button']) {?><a href="<?php echo ($right['type'] == 'link') ? $right['link'] : $right['url'];?>" class="button <?php echo $right['button_color'];?>"><?php echo $right['button'];?></a><?php } ?>
            </div>
            <?php }?>
            <?php if($right['type'] != 'none') {?>
            <?php if($right['button'] == '') {?>
            	</a>
            <?php }?>
            <?php }?>
        </div>
        <?php } ?>
    </div>
</section>
