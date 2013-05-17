<?php

function setup_nav_menu() {
	register_nav_menus(array('primary' => 'Primary Menu'));
}
add_action( 'after_setup_theme', 'setup_nav_menu' );

function nav_add_search_box($items, $args) {

	if ($args->theme_location === 'primary')
		$items .= '						<li class="menu-item menu-item-search">
							<form method="get" id="searchform" action="' . esc_url( home_url( '/' ) ) . '" role="search">
								<label for="s" class="screen-reader-text">Search</label>
								<input type="text" class="field" name="s" value="' . esc_attr( get_search_query() ) .'" id="s" placeholder="Search &#133;" />
								<input type="submit" class="submit" name="submit" id="searchsubmit" value="Search" />
							</form>
						</li>
					';

	return $items;
}
add_filter('wp_nav_menu_items', 'nav_add_search_box', 10, 2);


function page_meta_setup() {

	add_action('add_meta_boxes','page_meta_add');
	add_action('save_post','page_meta_save', 10, 2);
}
add_action('load-post.php','page_meta_setup');
add_action('load-post-new.php','page_meta_setup');


function page_meta_add() {

	add_meta_box (
		'osi_page_meta',
		'Page Information',
		'osi_page_meta',
		'page',
		'side',
		'default');
}


function osi_page_meta() {

	// Get current values for all of the meta
	
	global $post;
	wp_nonce_field(basename( __FILE__ ), 'page-form-nonce' );
	$visible = get_post_meta($post->ID, 'page-form-visible', true) ? get_post_meta($post->ID, 'page-form-visible', true) : 'show';
	$order = get_post_meta($post->ID, 'page-form-order', true) ? get_post_meta($post->ID, 'page-form-order', true) : '0';
	$title = get_post_meta($post->ID, 'page-form-title', true) ? get_post_meta($post->ID, 'page-form-title', true) : get_the_title();

	// Make special arrangements for possibly disabling the end date/time fields

	$checked = "checked = 'checked'";
	$disabled = "";
	$style = "";
	if ($visible == "hide") {
		$checked = "";
		$disabled = "disabled='disabled'";
		$style = "style='background-color:#EEEEEE'";	}

	?>
	<style type="text/css">
		#page-form-main {width: 100%;}
		#page-form-order, #page-form-title {width: 80px;}
	</style>
	<script type="text/javascript">
		function visibleCheckBox() {
			var checkBox = document.getElementById('page-form-visible');
			var orderInput = document.getElementById('page-form-order');
			var titleInput = document.getElementById('page-form-title');
			if (checkBox.checked) {
				orderInput.disabled = false;
				orderInput.style.backgroundColor = '#FFFFFF';
				
				titleInput.disabled = false;
				titleInput.style.backgroundColor = '#FFFFFF';
			}
			else {
				orderInput.disabled = true;
				orderInput.style.backgroundColor = '#EEEEEE';
				
				titleInput.disabled = true;
				titleInput.style.backgroundColor = '#EEEEEE';
			}
		}
	</script>
	<table id="page-form-main">
		<tr>
			<th><label for="page-form-visible">Show in Menu:</label></th>
			<td> <input type="checkbox" name="page-form-visible" id="page-form-visible" value="show" <?php echo $checked; ?> onchange="visibleCheckBox()"></td>
		</tr><tr>
			<th><label for="page-form-order">Menu Order:</label></th>
			<td><input type="text" name="page-form-order" id="page-form-order" value="<?php echo $order; ?>" <?php echo $disabled . " " . $style; ?>></td>
		</tr><tr>
			<th><label for="page-form-title">Name in Menu:</label></th>
			<td><input type="text" name="page-form-title" id="page-form-title" value="<?php echo $title; ?>" <?php echo $disabled . " " . $style; ?>></td>
		</tr>
	</table>
	<?php
}


function page_meta_save($post_id, $post) {

	if ($parent_id = wp_is_post_revision($post_id)) 
		$post_id = $parent_id;

	if (!isset($_POST['page-form-nonce']) || !wp_verify_nonce($_POST['page-form-nonce'], basename( __FILE__ ))) {
		return $post_id;
	}

	$post_type = get_post_type_object($post->post_type);

	if (!current_user_can($post_type->cap->edit_post, $post_id)) {
		return $post_id;
	}

	$input = array();

	$input['visible'] = (isset($_POST['page-form-visible']) && $_POST['page-form-visible'] == 'show' ? 'show' : 'hide');
	$input['order'] = (isset($_POST['page-form-order']) ? $_POST['page-form-order'] : '0');
	$input['title'] = (isset($_POST['page-form-title']) ? $_POST['page-form-title'] : get_the_title());

	foreach ($input as $field => $value) {

		$old = get_post_meta($post_id, 'page-form-' . $field, true);

		if ($value && '' == $old)
			add_post_meta($post_id, 'page-form-' . $field, $value, true);
		else if ($value && $value != $old)
			update_post_meta($post_id, 'page-form-' . $field, $value);
		else if ('' == $value && $old)
			delete_post_meta($post_id, 'page-form-' . $field, $old);
	}
}


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

?>