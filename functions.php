<?php

/* Allow Post Thumbnails to be used */

function setup_thumbnails() {

	add_theme_support('post-thumbnails');
}
add_action('after_setup_theme', 'setup_thumbnails');


/* Remove menus from the admin dashboard
 *
 * In order to use this function, uncomment "add_action(...)" at the end.
 *
 * All of the administration pages are listed here (in order of appearance in the dashboard)
 * so that you may choose which are removed.  If you remove a main page, you do not also
 * need to remove its subpages.
 *
 * Use this for cleaning up the dashboard only (example: you wish to remove the Posts link
 * because you use only custom post types).  Do not use it for security (example: to keep
 * another user from editing theme files, etc).  Roles (Editor versus Admin) and
 * Capabilities (which can be added and removed for specific roles and users) are best
 * suited for such a purpose.
 */

function remove_menus() {
	$user = wp_get_current_user();
	if ($user->wp_capabilities['administrator'] != 1) {

			remove_submenu_page('index.php', 'update-core.php');
		remove_menu_page('edit.php');
			remove_submenu_page('edit.php', 'post-new.php');
			remove_submenu_page('edit.php', 'edit-tags.php?taxonomy=category');
			remove_submenu_page('edit.php', 'edit-tags.php?taxonomy=post_tag');
		remove_menu_page('upload.php');
			remove_submenu_page('upload.php', 'media-new.php');
		remove_menu_page('link-manager.php');
			remove_submenu_page('link-manager.php', 'link-add.php');
			remove_submenu_page('link-manager.php', 'edit-tags.php?taxonomy=link_category');
		remove_menu_page('edit.php?post_type=page');
			remove_submenu_page('edit.php', 'post-new.php?post_type=page');
		remove_menu_page('edit-comments.php');
		remove_menu_page('themes.php');
			remove_submenu_page('themes.php', 'widgets.php');
			remove_submenu_page('themes.php', 'nav-menus.php');
			remove_submenu_page('themes.php', 'theme-editor.php');
		remove_menu_page('plugins.php');
			remove_submenu_page('plugins.php', 'plugin-install.php');
			remove_submenu_page('plugins.php', 'plugin-editor.php');
		remove_menu_page('users.php');
			remove_submenu_page('users.php', 'user-new.php');
			remove_submenu_page('users.php', 'profile.php');
		remove_menu_page('tools.php');
			remove_submenu_page('tools.php', 'import.php');
			remove_submenu_page('tools.php', 'export.php');
		remove_menu_page('options-general.php');
			remove_submenu_page( 'options-general.php', 'options-writing.php' );
			remove_submenu_page( 'options-general.php', 'options-reading.php' );
			remove_submenu_page( 'options-general.php', 'options-discussion.php' );
			remove_submenu_page( 'options-general.php', 'options-media.php' );
			remove_submenu_page( 'options-general.php', 'options-permalink.php' );
	}
}
//add_action('admin_menu', 'remove_menus');


/* Sample Custom Post Type
 *
 * In order to use this function, uncomment "add_action(...)" at the end.
 *
 * This code will add a new type of post to the site called "news".  It will appear
 * in the dashboard and have the features mentioned in the "supports" field.
 *
 * Full documentation for register_post_type() can be found at:
 * 		http://codex.wordpress.org/Function_Reference/register_post_type
 */

function custom_post_types() {

	register_post_type('news', array(
		'labels' => array(
			'name' => 'News',
			'singular_name' => 'News'),
		'public' => true,
		'hierarchical' => false,
		'supports' => array('title', 'editor', 'excerpt', 'author'),
		'register_meta_box_cb' => 'news_meta_add',
		'taxonomies' => array(),
		'has_archive' => false,
		));
}
//add_action('init', 'custom_post_types');


/* Change dashboard icons for the custom post types.
 *
 * In order to use this function, uncomment "add_action(...)" at the end.
 *
 * This CSS uses an icon from the cpt_icons collection for a custom post type
 * in the dashboard.  Place the icon in the resources directory.
 */

function cpt_icons() {

	?>
	<style type="text/css" media="screen">
		#menu-posts-news .wp-menu-image {
			background: url(<?php echo get_stylesheet_directory_uri(); ?>/resources/news.png) no-repeat 6px -17px !important;
		}
		#menu-posts-news:hover .wp-menu-image, #menu-posts-news.wp-has-current-submenu .wp-menu-image {
			background-position: 6px 7px!important;
		}
	</style>
	<?php
}
//add_action('admin_head', 'cpt_icons');


include_once("functions/functions-nav.php");

?>