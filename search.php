<?php get_header(); ?>

			<div class="content-area">
				<div class="main">
					<?php if ( have_posts() ) : ?>

						<div>
							<h1><?php printf( 'Search: %s', '<span>' . get_search_query() . '</span>' ); ?></h1>
						</div><!-- .page-header -->

						<?php /* Start the Loop */ ?>
						<?php while ( have_posts() ) : the_post(); ?>

							<?php get_template_part( 'content', 'search' ); ?>

						<?php endwhile; ?>

					<?php else : ?>

						<?php get_template_part( 'no-results', 'search' ); ?>

					<?php endif; ?>
				</div>
				<!-- <aside> -->
					<!-- OPTIONAL -->
				<!-- </aside> -->
			</div>

<?php get_footer(); ?>