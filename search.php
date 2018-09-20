<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package ROCKHARBOR_Church
 */

get_header();
?>

	<section class="section page-header simple">
		<div class="container">
			<h1 class="heading">
				<small>Search Results for:</small>
				<form role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
				    <label><input type="search" id="heading-search" class="search-field" placeholder="Search Rockharbor" value="<?php echo get_search_query() ?>" name="s" title="search Rockharbor" autocomplete="off" spellcheck="false">
				    </label>
				    <input type="submit" class="search-submit" value="Search">
				</form>
			</h1>
		</div>
	</section>
	
	<section class="section results">
		<div class="container">
		<?php if ( have_posts() ) { ?>
			<?php while ( have_posts() ) : the_post();

				get_template_part( 'template-parts/content', 'search' );

			endwhile;
			if (paginate_links()) { ?>
			<nav class="pagination">
			<?php echo paginate_links( array(
				'mid_size'           => 2,
				'type'               => 'list',
				'prev_text'          => '<i class="fas fa-angle-left"></i>',
				'next_text'          => '<i class="fas fa-angle-right"></i>',
			)); ?>
			</nav>
			<?php }?>
			
		<?php } else { ?>
			
			<div class="no-results" style="padding-bottom: 100px;">
				<h2>Nothing Found</h2>
				<p>Sorry, but nothing matched your search terms. Please try again with some different keywords.</p>
			</div>
			
		<?php }	?>
		</div>
	</section>

<?php
get_footer();
