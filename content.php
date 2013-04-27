<?php

/**
 * Displays the results of a search or other undefined content.
 *
 * @package MiniBill
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<h1 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>


<!-- POST CONTENT START -->
<?php the_content(); ?>
<!-- POST CONTENT END -->


					</article>
