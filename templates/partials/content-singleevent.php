<?php
/**
 * The template used for displaying single event content
 *
 * @since 1.0.0
 */

$date     = get_sc_event_display_date( get_the_ID() );
$time     = get_sc_event_display_time( get_the_ID() );
$location = get_post_meta( get_the_ID(), 'sc_event_location', true );
?>
<div class="inside">
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header class="entry-header" >
			<h1 class="entry-title"><?php the_title(); ?></h1>
		</header><!-- .entry-header -->

		<div class="entry-content">
			<h2><?php echo $date; ?></h2>
			<h3>
				<?php if ( ! empty( $time ) ) : echo $time; endif; ?><?php if ( $location && ! empty( $time ) ) : ?><span>|</span><?php endif; ?><?php echo esc_html( $location ); ?>
			</h3>
			<?php the_content(); ?>

		</div><!-- .entry-content -->
	</article><!-- #post-<?php the_ID(); ?> -->
</div>
