<?php
/**
 * Template Name: Events
 */

// add ?c parameter to url
if(!isset($_GET['c'])) {
	$campus = $_COOKIE['campus'] ?? null;
	// If Campus Cookie Not set
	if (!$campus) {
		// check for campus url parameter, ex: ?c=cotsa-mesa
		if(isset($_GET['c'])) {
	    	$campus = $_GET['c'];
		} else {
			$campus = 'all';
		}
	}	
	header("Location: /events/?c=".$campus);
	die();
} else {
	$campus = $_GET['c'];
}
setcookie('campus', $campus, 2147483647, '/');


// Set ministry variable
if(isset($_GET['ministry'])) {
	$ministry = $_GET['ministry'];
} else {
	$ministry = '';
}


// Set month variable
if(isset($_GET['month'])) {
	$month = $_GET['month'];
} else {
	$month = '';
}

get_header();
	while ( have_posts() ) :	the_post();
		include(locate_template('template-parts/modules/page-header.php')); ?>

		
		<div class="content-filter event-filters">
			<span>Filter by</span>
			<div class="select">
				<select id="event-filter-campus">
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
			<div class="select" style="margin-left: 20px;">
				<select id="event-filter-ministry">
					<option value="">All Ministries</option>
					<option value="Alpha">Alpha</option>
					<option value="Campus Events||Church Wide Events||Involvement/Connecting||Lead||Operations||The Caf">General Events</option>
					<option value="Foundations/Equipping||Pastoral Ministries||Prayer||RHU">Classes & Courses</option>
					<option value="College">College</option>
					<option value="Elementary||Family Ministries||High School||Middle School||Nursery||Nurture||Preschool||VBS||Youth Ministries">Families</option>
					<option value="Marriages">Marriages</option>
					<option value="Men's Ministry">Men</option>
					<option value="Global Missions||Local Missions">Missions</option>
					<option value="Recovery">Recovery</option>
					<option value="Small Groups">Small Groups</option>
					<option value="Women's Ministry">Women</option>
					<option value="Arts||Communications||Worship & Production">Worship &amp; Arts</option>
				</select>
			</div>	
			<div class="select" style="margin-left: 20px;">
				<select id="event-filter-month">
					<option value="">All Months</option>
					<option value="01">January</option>
					<option value="02">February</option>
					<option value="03">March</option>
					<option value="04">April</option>
					<option value="05">May</option>
					<option value="06">June</option>
					<option value="07">July</option>
					<option value="08">August</option>
					<option value="09">September</option>
					<option value="10">October</option>
					<option value="11">November</option>
					<option value="12">December</option>
				</select>
			</div>
		</div>
		
		
		<section class="section upcoming-events campus-all">
		    <div class="container">
		        
				<?php
			        $duration = 'date_range="4 weeks" ';
			        $max = 'how_many="50" ';
					
					// date
					if ($month) {
						$start_date = date('Y').'-'.$month.'-01';
						$max = ''; // remove max to show only specific month
					}
					if($start_date) {
			            $start = 'date_start="'.$start_date.'" ';
			        }
					
					// campus
					if ($campus != 'all') {
						$filter = 'filter_by="campus" ';
						if ($campus == 'costa-mesa') {
							$campus_id = 2;
						} else if ($campus == 'mission-viejo') {
							$campus_id = 3;
						} else if ($campus == 'charlotte') {
							$campus_id = 7;
						}
						
						$value = 'campus_id="'.$campus_id.'" ';
					}
					
					// ministry
					if ($ministry != '') {
						$filter = 'filter_by="department" ';
						$value = 'department="'.$ministry.'" ';
					}
			        
			        $finalshortcode = '[ccbpress_upcoming_events ' . ($start ?? '') . ($duration ?? '') . ($max ?? '') . ($filter ?? '') . ($value ?? '') . ' theme="graphical"]';
			        
			        echo do_shortcode($finalshortcode);
			        
			        //echo $finalshortcode;
			        
		        ?>
		    </div>
		</section>
		

		
		<?php get_template_part( 'template-parts/content', 'modules' );?>


		<script>
			$campusFilter = $('#event-filter-campus');
			$ministryFilter = $('#event-filter-ministry');
			$monthFilter = $('#event-filter-month');
			
			$campus = '<?php echo $campus; ?>';
			$ministry = '<?php echo $ministry; ?>';
			$month = '<?php echo $month; ?>';
		
			// Update Campus Filter to match URL
			$campusFilter.val($campus);
			
			// Update Ministry Filter to match URL
			$ministryFilter.val($ministry);
			
			// Update Month Filter to match URL
			$monthFilter.val($month);
		
			// change url on filter change
			$('.event-filters select').change(function(){
				
				// If Campus Filter Change
				if ($(this).is($campusFilter)) {
					console.log('campus change');
					$campus = $(this).val();
					$ministry = '';
					
				}
				
				// If Ministry Filter Change
				if ($(this).is($ministryFilter)) {
					console.log('ministry change');
					$ministry = $(this).val();
					$campus = 'all';
				}
				
				// If Month Filter Change
				if ($(this).is($monthFilter)) {
					console.log('month change');
					$month = $(this).val();
				}
				
				window.location.replace('/events/?c='+$campus+'&ministry='+$ministry+'&month='+$month);
						
			});
			
			// Rewriting descriptive "No Results" Message
			$campusLabel = $campusFilter.find('option:selected').text();
			$campusLabel = $campusLabel+' / ';
		
			$ministryLabel = $ministryFilter.find('option:selected').text();
			$ministryLabel = $ministryLabel+' / ';
			
			$monthLabel = $monthFilter.find('option:selected').text();
			
			$('.ccbpress_upcoming_events:contains("No upcoming events are scheduled")')
				.addClass('no-results')
				.html('No Events Found For: <span>' + $campusLabel + $ministryLabel + $monthLabel + '</span>' );
			
		</script>

	<?php endwhile;
get_footer();
