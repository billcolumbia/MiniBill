<?php get_header(); ?>

<div class="content-area">
	<div class="main">
		<?php while ( have_posts() ) : the_post(); ?>

			<?php get_template_part( 'content', 'page' ); ?>

		<?php endwhile; // end of the loop. ?>

	</div>
	<!-- <aside> -->
		<!-- OPTIONAL -->
	<!-- </aside> -->
</div>

<?php get_footer(); ?>