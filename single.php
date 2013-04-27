<?php get_header(); ?>

			<div class="content-area">
				<div class="main">
					<?php
					while (have_posts()) {
						the_post();
						get_template_part( 'content', 'single' );
					} ?>
				</div>
				<!-- <aside> -->
					<!-- OPTIONAL -->
				<!-- </aside> -->
			</div>

<?php get_footer(); ?>