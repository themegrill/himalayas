<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package ThemeGrill
 * @subpackage Himalayas
 * @since Himalayas 1.0
 */
?>

<?php get_header(); ?>

	<?php do_action( 'himalayas_before_body_content' );

	$himalayas_layout = himalayas_layout_class(); ?>

	<div id="content" class="site-content">
		<main id="main" class="clearfix <?php echo $himalayas_layout; ?>">
			<div class="tg-container">
				<div id="primary" class="content-area">

					<?php if ( have_posts() ) : ?>

						<header class="page-header">
							<h1 class="page-title">
								<?php _e( 'Search Results:', 'himalayas' ); ?>
							</h1>
						</header><!-- .page-header -->

						<?php while ( have_posts() ) : the_post(); ?>

							<?php get_template_part( 'content', get_post_format() ); ?>

						<?php endwhile; ?>

						<?php get_template_part( 'navigation', 'search' ); ?>

					<?php else : ?>

						<?php get_template_part( 'no-results', 'search' ); ?>

					<?php endif; ?>

				</div><!-- #primary -->
				<?php himalayas_sidebar_select(); ?>
			</div>
		</main>
	</div>

	<?php do_action( 'himalayas_after_body_content' ); ?>

<?php get_footer(); ?>