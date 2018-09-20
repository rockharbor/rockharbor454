<section class="home-header">
    <video class="video" autoplay loop muted>
        <source src="<?php the_field('video');?>" type="video/mp4">
    </video>
    <div class="container">
        <h2><div data-aos="fade-up"><?php the_field('title');?></div></h2>
        <div class="callout">
            <h3 data-aos="fade-up" data-aos-delay="500" data-aos-offset="-9999">I Want To</h3>
            <div class="callout-slider" data-aos="fade-up" data-aos-delay="500" data-aos-offset="-9999">
                <?php while ( have_rows('dropdown_links') ) : the_row(); ?>
                	<div><a href="<?php the_sub_field('link'); ?>"><?php the_sub_field('name'); ?> <i class="fas fa-angle-right"></i></a></div>
                <?php endwhile; ?>
            </div>
            <span class="left-border" data-aos="fade-up" data-aos-delay="500" data-aos-offset="-9999"></span>
            <span class="top-border" data-aos="fade-up" data-aos-delay="500" data-aos-offset="-9999"></span>
            <span class="bottom-border" data-aos="fade-up" data-aos-delay="500" data-aos-offset="-9999"></span>
            <span class="right-border-top" data-aos="fade-up" data-aos-delay="500" data-aos-offset="-9999"></span>
            <span class="right-border-bottom" data-aos="fade-up" data-aos-delay="500" data-aos-offset="-9999"></span>
            <div class="callout-toggle"></div>
        </div>
    </div>
    <div class="close-callout"></div>
</section>
