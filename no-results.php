
			<div class="content-area">
				<div class="main">

<?php			if (is_home() && current_user_can('publish_posts')) { ?>
					<p>Trying to edit the site? <a href="<?php echo esc_url(admin_url('post-new.php')); ?>">Get started here</a></p>
<?php			} else if (is_search()) { ?>
					<p>Sorry, but we couldn't find anything for those keywords. Try again with different keywords?</p>
						<?php get_search_form(); ?>
<?php			} else { ?>
					<p>Hey I just met you, and this is crazy, but I can't find that page, so search me maybe?</p>
						<?php get_search_form(); ?>
<?php			} ?>
				</div>
				<!-- <aside> -->
					<!-- OPTIONAL -->
				<!-- </aside> -->
			</div>
