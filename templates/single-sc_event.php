<?php
/**
 * Single events entry
 *
 * @since 1.0.0
 */

get_header(); ?>

		<section id="primary" class="site-content">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'partials/content', 'singleevent' ); ?>

			<?php endwhile; // end of the loop. ?>

		</section><!-- #primary .site-content -->

<?php get_footer(); ?>