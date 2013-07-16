<?php

/* Add Meta Box to Pages to collect information for the navigation menu. */

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

?>