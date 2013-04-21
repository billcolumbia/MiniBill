<div class="content-area">
	<div class="main">
		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p><?php printf('Trying to edit the site? <a href="%1$s">Get started here</a>.', esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

		<?php elseif ( is_search() ) : ?>

			<p>Sorry, but we couldn&rsquo;t find anything for those keywords. Try again with different keywords?</p>
			<?php get_search_form(); ?>

		<?php else : ?>

			<p>Hey I just met you, and this is crazy, but I can&rsquo;t find that page, search me maybe?</p>
			<?php get_search_form(); ?>

		<?php endif; ?>
	</div>
	<!-- <aside> -->
		<!-- OPTIONAL -->
	<!-- </aside> -->
</div>
