<?php

/**
 * Displays the actual content of a page.
 *
 * @package MiniBill
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<h1 class="entry-title"><?php the_title(); ?></h1>
						<?php the_content(); ?>
					</article>
