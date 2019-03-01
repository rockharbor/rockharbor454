<div class="flex-content">
<?php
/**
 * Template part for displaying content modules.
 */




if(!is_page_template('templates/events.php')): // dont show on events page

	$campus = $_COOKIE['campus'] ?? null;
	// If Campus Cookie Not set
	if (!$campus) {
		// check for campus url parameter, ex: ?c=cotsa-mesa
		if(isset($_GET['c'])) {
	    	$campus = $_GET['c'];
			setcookie('campus', $campus, 2147483647, '/');
		} else {
			//setcookie('campus', 'all', 2147483647, '/');
			$campus = 'all';	
		}
	}
	
	
	$filterCount = 1;
	if( have_rows('modules') ):
		while ( have_rows('modules') ) : the_row();
			$assign_campus_field = get_sub_field('assign_campus');
			if($assign_campus_field) {
				
				if($filterCount == '1') { ?>
					<div class="content-filter">
						<span>Filter by Campus</span>
						<div class="select">
							<select id="campus-filter">
								<option value="all">All Campuses</option>
								<?php
								$taxonomy = 'campuses';
								$locationsargs = array (
									'hide_empty'	=> 0,
									'parent'        => 0,
									'taxonomy'      => $taxonomy,
								);
								$locations = get_terms($locationsargs);
									foreach($locations as $location) {?>
									<option value="<?php echo $location->slug;?>"><?php echo $location->name;?></option>
								<?php } ?>
							</select>
						</div>				
					</div>
				<?php $filterCount++;
				}
			}
		endwhile;
	endif;
endif;

if( have_rows('modules') ): $i = 0;
	while ( have_rows('modules') ) : the_row(); $i++;
		
		//// Anchors
		$secid = 'page' . get_the_ID() . '_' . $i;
		
		//// Global Content
		$heading = get_sub_field('heading');
		$align = get_sub_field('align');

		//// Global Options
		$bg = get_sub_field('background_color');
		$top = get_sub_field('top_padding');
		$bottom = get_sub_field('bottom_padding');
		
		//// Expiration
		$currentdate = current_time('mysql');
		$startdate = get_sub_field('publish_date');
		$enddate = get_sub_field('expiration_date');
		$onlystartdate = $currentdate >= $startdate && $enddate == '';
		$onlyenddate = $startdate == '' && $currentdate <= $enddate;
		$nostartenddate = $startdate == '' && $enddate == '';
		$startenddate = $currentdate >= $startdate && $currentdate <= $enddate;
		
		$assigned_campuses = get_sub_field('assign_campus');
				
		$moduleCount = 1;
		
		if( $onlystartdate || $onlyenddate || $nostartenddate || $startenddate) {
	
			if ($moduleCount == 1) { 

				if( get_row_layout() == 'accordion' ) {
					 include(locate_template('template-parts/modules/accordion.php'));

				} elseif( get_row_layout() == 'blurb' ) {
					include(locate_template('template-parts/modules/blurb.php'));

				} elseif( get_row_layout() == 'callout_banner' ) {
					include(locate_template('template-parts/modules/callout-banner.php'));

				} elseif( get_row_layout() == 'campuses' ) {
					include(locate_template('template-parts/modules/campuses.php'));

				} elseif( get_row_layout() == 'columns' ) {
					include(locate_template('template-parts/modules/columns.php'));

				} elseif( get_row_layout() == 'content' ) {
					include(locate_template('template-parts/modules/content.php'));

				} elseif( get_row_layout() == 'expandable_banners' ) {
					include(locate_template('template-parts/modules/expandable-banner.php'));

				} elseif( get_row_layout() == 'gallery' ) {
					include(locate_template('template-parts/modules/gallery.php'));

				} elseif( get_row_layout() == 'media_content' ) {
					include(locate_template('template-parts/modules/media-content.php'));

				} elseif( get_row_layout() == 'messages' ) {
					include(locate_template('template-parts/modules/message.php'));

				} elseif( get_row_layout() == 'newsletter' ) {
					include(locate_template('template-parts/modules/newsletter.php'));

				} elseif( get_row_layout() == 'promos' ) {
					include(locate_template('template-parts/modules/promos.php'));

				} elseif( get_row_layout() == 'quote' ) {
					include(locate_template('template-parts/modules/quote.php'));

				} elseif( get_row_layout() == 'staff' ) {
					include(locate_template('template-parts/modules/staff.php'));

				} elseif( get_row_layout() == 'tabs' ) {
					include(locate_template('template-parts/modules/tabs.php'));

				} elseif( get_row_layout() == 'upcoming_events' ) {
					include(locate_template('template-parts/modules/upcoming-events.php'));
				
				} elseif( get_row_layout() == 'upcoming_events_filter' ) {
					include(locate_template('template-parts/modules/upcoming-events-filter.php'));

				} elseif( get_row_layout() == 'video' ) {
					include(locate_template('template-parts/modules/video.php'));
				}
			}
			$moduleCount++;
			
		}

	endwhile;
endif; ?>
</div>

<script src="<?php bloginfo('template_url');?>/js/vendors/js.cookie.js"></script>
<script>
//////////////////////////////////////////////////////////////////////////////////////////////////
////// Remove content modules assigned to other campuses */
var $campus = Cookies.get('campus');
if ($campus) {
	if ($campus != 'all') {
		var $campus  = 'campus-'+$campus; // add campus- to match class
		$('.section').not('.campus-all, .'+$campus).remove();
	}
}
</script>
