<?php
// Content
//$content = get_sub_field('content');
$start_date = get_sub_field('start_date');
$list_duration = get_sub_field('list_duration');
$max_displayed = get_sub_field('max_displayed');
$filter_by = get_sub_field('filter_by');
$filter_value = get_sub_field('filter_value');
$excluded_event_ids = get_sub_field('excluded_event_ids');
?>

<section class="section upcoming-events <?php echo $bg;?> <?php if(!$top){ echo 'no-top-padding';}?> <?php if(!$bottom){ echo 'no-bottom-padding';}?> <?php if( $assigned_campuses ) { foreach( $assigned_campuses as $assigned_campus ) { echo ' campus-'.$assigned_campus->slug; } } else { echo 'campus-all';} ?>" id="<?php echo $secid;?>">
    <div class="container">
        <?php if($heading) { ?><h2 class="heading <?php echo $align;?>"><?php echo $heading;?></h2><?php } ?>
        <?php if($start_date) {
            $start = 'date_start="'.$start_date.'" ';
        }
        if($list_duration) {
            $duration = 'date_range="'.$list_duration.'" ';
        }
        if($max_displayed) {
            $max = 'how_many="'.$max_displayed.'" ';
        }
        if($filter_by) {
            $filter = 'filter_by="'.$filter_by.'" ';
        }
        if($filter_by && $filter_value) {
	        if ($filter_by == 'group') {
		        $filter_by = 'group_id';
	        } if ($filter_by == 'campus') {
		        $filter_by = 'campus_id';
	        }
            $value = $filter_by.'="'.$filter_value.'" ';
        }
        if($excluded_event_ids) {
            $exclude = 'exclude="'.$excluded_event_ids.'"';
        }
        $finalshortcode = '[ccbpress_upcoming_events ' . ($start ?? '') . ($duration ?? '') . ($max ?? '') . ($filter ?? '') . ($value ?? '') . ($exclude ?? '') . ' theme="graphical"]';
        
        echo do_shortcode($finalshortcode);
        
        //echo '<script>console.log(\''.$finalshortcode.'\');</script>';
        
        ?>
    </div>
</section>
