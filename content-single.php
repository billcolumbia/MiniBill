<?php

/**
 * Displays the actual content of a single post.
 *
 * @package MiniBill
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<h1 class="entry-title"><?php the_title(); ?></h1>


<!-- POST CONTENT START -->
<?php the_content(); ?>
<!-- POST CONTENT END -->


					</article>
