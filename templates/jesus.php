<?php
/**
 * Template Name: Know Jesus
 */

get_header();
	while ( have_posts() ) :	the_post();

	$who = get_field('who_is_jesus');
	$why = get_field('why_jesus');
	$alpha = get_field('alpha');
	$church = get_field('why_the_church');
	$services = get_field('weekend_services');
	?>


	<section id="know-jesus" class="fullpage-wrapper">
		<div class="section who" data-anchor="who" data-aos="fade-down">
			<div class="container">
				<h2 class="title"><?php echo $who['title'];?></h2>
				<div class="blurb"><?php echo $who['blurb'];?></div>
				<div class="content">
					<?php echo $who['content'];?>
				</div>
			</div>
			<img src="<?php bloginfo('template_url');?>/images/jesus/who-jesus.png" class="element elem1">
		</div>
		<div class="section why" data-anchor="why">
			<div class="container">
				<h2 class="title"><?php echo $why['title'];?></h2>
				<div class="content">
					<?php echo $why['content'];?>

					<h3>Want to learn more about Jesus? Submit your info and receive a free eBook.</h3>
					<?php echo do_shortcode('[gravityform id="3" title="false" description="false" ajax="true"]');?>
				</div>
			</div>
			<img src="<?php bloginfo('template_url');?>/images/jesus/why-jesus.png" class="element elem2">
		</div>
		<div class="section alpha" data-anchor="alpha">
			<div class="container">
				<h2 class="title"><?php echo $alpha['title'];?></h2>
				<div class="blurb"><?php echo $alpha['blurb'];?></div>
				<div class="content">
					<?php echo $alpha['content'];?>
					<div class="plyr__video-embed" id="plyr">
			            <iframe data-ratio="normal" class="vimeo-embed" src="https://player.vimeo.com/video/288478585" webkitallowfullscreen="webkitallowfullscreen" mozallowfullscreen="mozallowfullscreen" allowfullscreen="allowfullscreen" frameborder="0"></iframe>
			        </div>
				</div>
			</div>
			<img src="<?php bloginfo('template_url');?>/images/jesus/alpha.png" class="element elem3">
		</div>
		<div class="section church fp-auto-height" data-anchor="church">
			<div class="container">
				<h2 class="title"><?php echo $church['title'];?></h2>
				<div class="content">
					<?php echo $church['content'];?>
					<ul class="tab-labels clearfix">
			            <li><a href="#tab1">The Global Church</a></li>
						<li><a href="#tab2">The Local Church</a></li>
			        </ul>
			        <div class="tab-contents">
			            <div id="tab1" class="tab-wrapper">
							<?php echo $church['content_one'];?>
						</div>
						<div id="tab2" class="tab-wrapper">
							<?php echo $church['content_two'];?>
						</div>
			        </div>
					<script>
					$(window).ready(function(){
					    $('ul.tab-labels').each(function(){
					        var $active, $content, $links = $(this).find('a');
					        $active = $($links.filter('[href="'+location.hash+'"]')[0] || $links[0]);
					        $active.addClass('active');
					        $content = $($active.attr('href'));

					        $links.not($active).each(function () {
					            $($(this).attr('href')).hide();
					        });

					        $(this).on('click', 'a', function(e){
					            $active.removeClass('active');
					            $content.hide();

					            $active = $(this);
					            $content = $($(this).attr('href'));

					            $active.addClass('active');
					            $content.fadeIn('fast');

					            e.preventDefault();
					        });
					    });
					});
					</script>
				</div>
			</div>
			<img src="<?php bloginfo('template_url');?>/images/jesus/church.png" class="element elem4">
		</div>
		<div class="section services" data-anchor="services">
			<div class="container">
				<h2 class="title"><?php echo $services['title'];?></h2>
				<div class="blurb"><?php echo $services['blurb'];?></div>
				<div class="visit">
					<?php
	                $args = array(
	                    'post_type'      	=> 'campus',
	                	'posts_per_page'	=> -1,
	                    'orderby'        	=> 'menu_order',
	                    'order'             => 'ASC'
	                );
		            $query = new WP_Query( $args );
		            if ( $query->have_posts() ) {
		                while ( $query->have_posts() ) {
		                $query->the_post();
							$address = get_field('address');
							$gtemp = explode (',',  implode($address));
							$coord = explode (',', implode($gtemp));
		                ?>
		                    <div class="campus">
								<a href="<?php the_permalink();?>">
			                        <div class="name"><div class="image" style="background-image: url(<?php echo the_post_thumbnail_url( 'medium_large' );?>);"></div><h3><?php the_title();?></h3></div>
			                        <div class="info">
			                            <div class="times"><i class="bx bx-time"></i>
			                                <?php
			            					$rows = get_field('hours');
			            					$first_row = $rows[0];
			            					if($rows) { ?>
			                                    <div><strong><?php echo $first_row['description'];?></strong><?php echo $first_row['hours'];?></div>
			            					<?php } ?>
			                            </div>
			                            <div class="address"><i class="bx bx-map"></i><div><?php echo $gtemp[0] . ',<br>' . $gtemp[1] . ', ' . $gtemp[2]; ?></div></div>
			                        </div>
								</a>
		                    </div>
		                <?php }
		            } wp_reset_postdata(); ?>
				</div>
			</div>
		</div>
	</section>

	<div class="gradients gradient-who"></div>
	<div class="gradients gradient-why"></div>
	<div class="gradients gradient-alpha"></div>
	<div class="gradients gradient-church"></div>
	<div class="gradients gradient-services"></div>

	<nav id="fp-nav" class="fp-show-active navigation">
		<ul>
			<li data-menuanchor="who" class="active"><a href="#who"></a><div class="fp-tooltip">Who is Jesus?</div></li>
			<li data-menuanchor="why"><a href="#why"></a><div class="fp-tooltip">Why Jesus?</div></li>
			<li data-menuanchor="alpha"><a href="#alpha"></a><div class="fp-tooltip">Alpha</div></li>
			<li data-menuanchor="church"><a href="#church"></a><div class="fp-tooltip">Why the Church?</div></li>
			<li data-menuanchor="services"><a href="#services"></a><div class="fp-tooltip">Weekend Servcies</div></li>
		</ul>
	</nav>



	<?php endwhile;
get_footer();
