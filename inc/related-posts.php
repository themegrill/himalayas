<?php $related_posts = himalayas_related_posts_function(); ?>

<?php if ( $related_posts->have_posts() ): ?>

	<div class="related-posts-wrapper">

		<h4 class="related-posts-main-title">
			<i class="fa fa-thumbs-up"></i><span><?php esc_html_e( 'You May Also Like', 'himalayas' ); ?></span>
		</h4>

		<div class="related-posts clearfix">

			<?php
			while ( $related_posts->have_posts() ) : $related_posts->the_post(); ?>
				<div class="tg-column-3">

					<?php if ( has_post_thumbnail() ): ?>
						<div class="post-thumbnails">
							<a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>">
								<?php the_post_thumbnail( 'himalayas-featured-image' ); ?>
							</a>
						</div>
					<?php endif; ?>

					<div class="wrapper">

						<h3 class="entry-title">
							<a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title(); ?>"><?php the_title(); ?></a>
						</h3><!--/.post-title-->

						<div class="entry-meta">
							<?php
							$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
							if (  ( 'U' ) !== get_the_modified_time( 'U' ) ) {
								$time_string .= '<time class="updated" datetime="%3$s">%4$s</time>';
							}
							$time_string = sprintf( $time_string,
								esc_attr( get_the_date( 'c' ) ),
								esc_html( get_the_date() ),
								esc_attr( get_the_modified_date( 'c' ) ),
								esc_html( get_the_modified_date() )
							);
							printf( __( '<span class="posted-on"><a href="%1$s" title="%2$s" rel="bookmark"> %3$s</a></span>', 'himalayas' ),
								esc_url( get_permalink() ),
								esc_attr( get_the_time() ),
								$time_string
							); ?>

							<span class="byline author vcard"><a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" title="<?php echo get_the_author(); ?>"><?php echo esc_html( get_the_author() ); ?></a></span>
						</div>

					</div>

				</div><!--/.related-->
			<?php
		endwhile; ?>

		</div><!--/.post-related-->

	</div>
<?php endif; ?>

<?php wp_reset_query(); ?>
