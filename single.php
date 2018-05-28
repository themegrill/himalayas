<?php
/**
 * The template for displaying all single posts
 *
 * @package ThemeGrill
 * @subpackage Himalayas
 * @since Himalayas 1.0
 */

get_header(); ?>

	<?php do_action( 'himalayas_before_body_content' );

	$himalayas_layout = himalayas_layout_class(); ?>

	<div id="content" class="site-content">
		<main id="main" class="clearfix <?php echo $himalayas_layout; ?>">
			<div class="tg-container">

				<div id="primary">

					<div id="content-2">
						<?php while ( have_posts() ) : the_post();

							get_template_part( 'content', 'single' );

						endwhile; ?>
					</div><!-- #content -->

					<?php get_template_part( 'navigation', 'single' ); ?>

					<?php if ( ( get_theme_mod( 'himalayas_author_bio_setting', 0 ) == 1 ) && ( get_the_author_meta( 'description' ) ) ) { ?>
							<div class="author-box clearfix">
								<div class="author-img"><?php echo get_avatar( get_the_author_meta( 'user_email' ), '100' ); ?></div>
								<div class="author-description-wrapper">
									<h4 class="author-name"><?php the_author_meta( 'display_name' ); ?></h4>

									<p class="author-description"><?php the_author_meta( 'description' ); ?></p>
								</div>
							</div>
						<?php } ?>

					<?php if ( get_theme_mod( 'himalayas_related_posts_activate', 0 ) == 1 ) {
						get_template_part( 'inc/related-posts' );
					} ?>

					<?php do_action( 'himalayas_before_comments_template' );
					// If comments are open or we have at least one comment, load up the comment template
					if ( comments_open() || '0' != get_comments_number() )
						comments_template();
					do_action ( 'himalayas_after_comments_template' ); ?>
				</div><!-- #primary -->

				<?php himalayas_sidebar_select(); ?>
			</div>
		</main>
	</div>

	<?php do_action( 'himalayas_after_body_content' ); ?>

<?php get_footer(); ?>
