<?php
/*
Plugin Name: File Gallery
Plugin URI: http://skyphe.org/code/wordpress/file-gallery/
Version: 1.6.5.4
Description: "File Gallery" extends WordPress' media (attachments) capabilities by adding a new gallery shortcode handler with templating support, a new interface for attachment handling when editing posts, and much more.
Author: Bruno "Aesqe" Babic
Author URI: http://skyphe.org

////////////////////////////////////////////////////////////////////////////

    This program is free software: you can redistribute it and/or modify
    it under the terms of the GNU General Public License as published by
    the Free Software Foundation, either version 3 of the License, or
    (at your option) any later version.

    This program is distributed in the hope that it will be useful,
    but WITHOUT ANY WARRANTY; without even the implied warranty of
    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
    GNU General Public License for more details.

    You should have received a copy of the GNU General Public License
    along with this program.  If not, see <http://www.gnu.org/licenses/>.
	
////////////////////////////////////////////////////////////////////////////

*/

global $wp_version;


/**
 * Setup the WordPress constants
 */
if ( ! defined( 'WP_CONTENT_URL' ) )
	define( 'WP_CONTENT_URL', get_option('siteurl') . '/wp-content' );
if ( ! defined( 'WP_CONTENT_DIR' ) )
	define( 'WP_CONTENT_DIR', ABSPATH . 'wp-content' );
if ( ! defined( 'WP_PLUGIN_URL' ) )
	define( 'WP_PLUGIN_URL', WP_CONTENT_URL. '/plugins' );
if ( ! defined( 'WP_PLUGIN_DIR' ) )
	define( 'WP_PLUGIN_DIR', WP_CONTENT_DIR . '/plugins' );


/**
 * Setup default File Gallery options
 */
$file_gallery_abspath = WP_PLUGIN_DIR . '/' . basename(dirname(__FILE__));
$file_gallery_abspath = str_replace('\\', '/', $file_gallery_abspath);
$file_gallery_abspath = preg_replace('#/+#', '/', $file_gallery_abspath);

define('FILE_GALLERY_URL', WP_PLUGIN_URL . '/' . basename(dirname(__FILE__)));
define('FILE_GALLERY_ABSPATH', $file_gallery_abspath);
define('FILE_GALLERY_DEFAULT_TEMPLATES', serialize( array('default', 'file-gallery', 'list', 'simple') ) );


/**
 * Support for other plugins
 *
 * Supported so far:
 * - WordPress Mobile Edition
 * - Media Tags
 */
function file_gallery_plugins_support()
{
	global $sitepress, $wp_taxonomies, $file_gallery;
	
	$mobile = false;
	$file_gallery_media_tag_name = 'media_tag';
	$options = get_option('file_gallery');
	
	// WordPress Mobile Edition
	if( function_exists('cfmobi_check_mobile') && cfmobi_check_mobile() )
	{
		$mobile = true;
	
		if( ! isset($options['disable_shortcode_handler']) || true != $options['disable_shortcode_handler'] )
			add_filter('stylesheet_uri', 'file_gallery_mobile_css');
	}
	
	// Media Tags
	if( defined('MEDIA_TAGS_TAXONOMY') )
		$file_gallery_media_tag_name = MEDIA_TAGS_TAXONOMY;
		
	define('FILE_GALLERY_MOBILE', $mobile);
	define('FILE_GALLERY_MEDIA_TAG_NAME', $file_gallery_media_tag_name);
}
add_action('plugins_loaded', 'file_gallery_plugins_support', 100);


/*
 * Some constants you can filter even with your theme's functions.php file
 *
 * @since 1.6.3
 */
function file_gallery_filtered_constants()
{
	$stylesheet_directory = get_stylesheet_directory();
	$file_gallery_crystal_url = get_bloginfo('wpurl') . '/' . WPINC . '/images/crystal';
	$file_gallery_theme_abspath = str_replace('\\', '/', $stylesheet_directory);
	$file_gallery_theme_abspath = preg_replace('#/+#', '/', $file_gallery_theme_abspath);
	
	define('FILE_GALLERY_THEME_ABSPATH', $file_gallery_theme_abspath);
	define('FILE_GALLERY_THEME_TEMPLATES_ABSPATH', apply_filters('file_gallery_templates_folder_abspath', $file_gallery_theme_abspath . '/file-gallery-templates'));
	define('FILE_GALLERY_THEME_TEMPLATES_URL', apply_filters('file_gallery_templates_folder_url', get_bloginfo('stylesheet_directory') . '/file-gallery-templates'));
	
	define('FILE_GALLERY_CRYSTAL_URL', apply_filters('file_gallery_crystal_url', $file_gallery_crystal_url));
	
	define('FILE_GALLERY_DEFAULT_TEMPLATE_NAME', apply_filters('file_gallery_default_template_name', 'default'));
	define('FILE_GALLERY_DEFAULT_TEMPLATE_URL', apply_filters('file_gallery_default_template_url', FILE_GALLERY_URL . '/templates/default'));
	define('FILE_GALLERY_DEFAULT_TEMPLATE_ABSPATH', apply_filters('file_gallery_default_template_abspath', FILE_GALLERY_ABSPATH . '/templates/default'));
}
add_action('after_setup_theme', 'file_gallery_filtered_constants');


/**
 * Registers default File Gallery options when plugin is activated
 */
function file_gallery_activate()
{
	file_gallery_plugins_support();
	
	$defaults = array(
		'folder' 					  => FILE_GALLERY_URL, 
		'abspath' 					  => FILE_GALLERY_ABSPATH, 
		'media_tag_name'			  => FILE_GALLERY_MEDIA_TAG_NAME,
		
		'in_excerpt' 				  => 1, 
		'in_excerpt_replace_content'  => '<p><strong>(' . __('galleries are shown on full posts only', 'file-gallery') . ')</strong></p>', 
		
		'default_image_size' 		  => 'thumbnail', 
		'default_linkto' 			  => 'attachment', 
		'default_linked_image_size'   => 'full',
		'default_external_url'		  => '', 
		'default_orderby' 			  => '', 
		'default_order' 			  => 'ASC', 
		'default_template' 			  => 'default', 
		'default_linkclass' 		  => '', 
		'default_imageclass' 		  => '', 
		'default_columns' 			  => 3, 
		'default_mimetype'			  => '',
		
		'single_default_image_size'   => 'thumbnail', 
		'single_default_linkto'		  => 'attachment', 
		'single_default_external_url' => '', 
		'single_default_linkclass' 	  => '', 
		'single_default_imageclass'   => '',
		'single_default_align'        => 'none',
		
		'insert_options_state'		  => 1,
		'insert_single_options_state' => 1,
		'acf_state'					  => 1,
		'display_gallery_fieldset'	  => 1,
		'display_single_fieldset'	  => 1,
		'display_acf'				  => 1,
		
		'e_display_attachment_count'  => 1,
		'e_display_media_tags'		  => 1,
		'e_display_post_thumb'		  => 1,
		
		'cache'						  => 0,
		'cache_time'				  => 3600, // == 1 hour
		'cache_non_html_output'		  => 0,
		
		'del_options_on_deactivate'   => 0,

		'show_on_post_type_post'	  => 1,
		'show_on_post_type_page'	  => 1,
		
		'library_filter_duplicates'   => 1,
		
		'auto_enqueued_scripts'		  => 'thickbox',
		
		'disable_shortcode_handler'	  => 0,
		
		'default_metabox_image_size'  => 'thumbnail',
		'default_metabox_image_width' => 75
	);
	
	// if options already exist, upgrade
	if( $options = get_option('file_gallery') )
	{
		// preserve display options when upgrading from below 1.6.5.3
		if( ! isset($options['display_acf']) )
		{
			if( isset($options['insert_options_states']) )
				$states = explode(',', $options['insert_options_states']);
			else
				$states = array('1', '1');
			
			if( isset($options['display_insert_fieldsets']) )
				$display = $options['display_insert_fieldsets'];
			else
				$display = 1;
	
			$defaults['insert_options_state'] = (int) $states[0];
			$defaults['insert_single_options_state'] = (int) $states[1];
			$defaults['acf_state'] = 1;
		
			$defaults['display_gallery_fieldset'] = $display;
			$defaults['display_single_fieldset'] = $display;
			$defaults['display_acf'] = 1;
		}

		$defaults = file_gallery_parse_args( $options, $defaults); // $defaults = shortcode_atts( $defaults, $options );
		$defaults['folder']  = FILE_GALLERY_URL;
		$defaults['abspath'] = FILE_GALLERY_ABSPATH;
	}
	
	update_option('file_gallery', $defaults);
	
	// clear any existing cache
	file_gallery_clear_cache();
}
register_activation_hook( __FILE__, 'file_gallery_activate' );


/**
 * Some cleanup on deactivation
 */
function file_gallery_deactivate()
{
	file_gallery_clear_cache();
	
	$options = get_option('file_gallery');
	
	if( isset($options['del_options_on_deactivate']) && true == $options['del_options_on_deactivate'] )
		delete_option('file_gallery');
}
register_deactivation_hook( __FILE__, 'file_gallery_deactivate' );


/**
 * Adds a link to plugin's settings page (shows up next to the 
 * deactivation link on the plugins management page)
 */
function file_gallery_add_settings_link( $links )
{ 
	array_unshift( $links, '<a href="options-media.php">' . __('Settings', 'file-gallery') . '</a>' ); 
	
	return $links; 
}
add_filter('plugin_action_links_' . plugin_basename(__FILE__), 'file_gallery_add_settings_link' );


/**
 * Adds media_tags taxonomy so we can tag attachments
 */
function file_gallery_add_textdomain_and_taxonomies()
{
	load_plugin_textdomain('file-gallery', false, dirname(plugin_basename(__FILE__)) . '/languages');

	$args = array(
		"public"                => true,
		"query_var"             => str_replace("_", "-", FILE_GALLERY_MEDIA_TAG_NAME),
		"update_count_callback" => "file_gallery_update_media_tag_term_count",
		"label"                 => __("Media tags", "file-gallery"),
		"singular_label"        => __("Media tag", "file-gallery"),
		"rewrite"               => array(
									"slug" => str_replace("_", "-", FILE_GALLERY_MEDIA_TAG_NAME)
		),
		"labels"                => array(
									"singular_label" => __("Media tag", "file-gallery")
		)
	);
	
	register_taxonomy( FILE_GALLERY_MEDIA_TAG_NAME, "attachment", $args );
}
add_action("init", "file_gallery_add_textdomain_and_taxonomies");


/**
 * A slightly modified copy of WordPress' _update_post_term_count function
 * 
 * Updates number of posts that use a certain media_tag
 */
function file_gallery_update_media_tag_term_count( $terms )
{
	global $wpdb;

	foreach ( (array) $terms as $term )
	{
		$count = $wpdb->get_var(
					$wpdb->prepare(
						"SELECT COUNT(*) FROM $wpdb->term_relationships, $wpdb->posts 
						 WHERE $wpdb->posts.ID = $wpdb->term_relationships.object_id 
						 AND post_type = 'attachment' 
						 AND term_taxonomy_id = %d",
					$term )
		);
		
		do_action( 'edit_term_taxonomy', $term );
		
		$wpdb->update( $wpdb->term_taxonomy, compact( 'count' ), array( 'term_taxonomy_id' => $term ) );
		
		do_action( 'edited_term_taxonomy', $term );
	}
	
	// clear cache
	file_gallery_clear_cache("mediatags_all");
}


/**
 * Adds media tags submenu
 */
function file_gallery_media_submenu()
{
    add_submenu_page('upload.php', __("Media tags", "file-gallery"), __("Media tags", "file-gallery"), 'upload_files', 'edit-tags.php?taxonomy=' . FILE_GALLERY_MEDIA_TAG_NAME);
}
add_action('admin_menu', 'file_gallery_media_submenu');


/**
 * Gets intermediate image sizes
 */
function file_gallery_get_intermediate_image_sizes()
{
	$sizes = array();

	if( function_exists("get_intermediate_image_sizes") )
		$sizes = get_intermediate_image_sizes();

	$additional_intermediate_sizes = apply_filters("intermediate_image_sizes", $sizes);
	
	array_unshift($additional_intermediate_sizes, "thumbnail", "medium", "large", "full");
	
	return array_unique($additional_intermediate_sizes);
}


/**
 * Media library extensions
 */
function file_gallery_add_library_query_vars( $input )
{
	global $wpdb, $pagenow;

	$options = get_option("file_gallery");

	// affect the query only if we're on a certain page
	if( "media-upload.php" == $pagenow && "library" == $_GET["tab"] && is_numeric($_GET['post_id']) )
	{
		if( isset($_GET['exclude']) && "current" == $_GET['exclude'] )
			$input .= " AND `post_parent` != " . intval($_GET["post_id"]) . " ";

		if( isset($options["library_filter_duplicates"]) && true == $options["library_filter_duplicates"] )
			$input .= " AND $wpdb->posts.ID NOT IN ( SELECT ID FROM $wpdb->posts AS ps INNER JOIN $wpdb->postmeta AS pm ON pm.post_id = ps.ID WHERE pm.meta_key = '_is_copy_of' ) ";
	}
	elseif( "upload.php" == $pagenow && isset($options["library_filter_duplicates"]) && true == $options["library_filter_duplicates"] )
	{
		$input .= " AND $wpdb->posts.ID NOT IN ( SELECT ID FROM $wpdb->posts AS ps INNER JOIN $wpdb->postmeta AS pm ON pm.post_id = ps.ID WHERE pm.meta_key = '_is_copy_of' ) ";
	}

	return $input;
}
add_filter('posts_where', 'file_gallery_add_library_query_vars');


/**
 * Adds js to admin area
 */
function file_gallery_js_admin()
{
	global $pagenow, $current_screen, $wp_version, $post_ID;
	
	$s = array('{"', '",', '"}', '\/', '"[', ']"');
	$r = array("\n{\n\"", "\",\n", "\"\n}", '/', '[', ']');

	if(
	      "post.php" == $pagenow 
	   || "post-new.php" == $pagenow
	   || "page.php" == $pagenow 
	   || "page-new.php" == $pagenow 
	   || "edit.php" == $pagenow 
	   || ("post" == $current_screen->base && isset($current_screen->post_type))
	  )
	{
		// file_gallery.L10n
		$file_gallery_localize = array(
			"switch_to_tags" 			=> __("Switch to tags", "file-gallery"),
			"switch_to_files" 			=> __("Switch to list of attachments", "file-gallery"),
			"fg_info" 					=> __("Insert checked attachments into post as", "file-gallery"),
			"no_attachments_upload" 	=> __("No files are currently attached to this post.", "file-gallery"),
			"sure_to_delete" 			=> __("Are you sure that you want to delete these attachments? Press [OK] to delete or [Cancel] to abort.", "file-gallery"),
			"saving_attachment_data" 	=> __("saving attachment data...", "file-gallery"),
			"loading_attachment_data"	=> __("loading attachment data...", "file-gallery"),
			"deleting_attachment" 		=> __("deleting attachment...", "file-gallery"),
			"deleting_attachments" 		=> __("deleting attachments...", "file-gallery"),
			"loading" 					=> __("loading...", "file-gallery"),
			"detaching_attachment"		=> __("detaching attachment", "file-gallery"),
			"detaching_attachments"		=> __("detaching attachments", "file-gallery"),
			"sure_to_detach"			=> __("Are you sure that you want to detach these attachments? Press [OK] to detach or [Cancel] to abort.", "file-gallery"),
			"close"						=> __("close", "file-gallery"),
			"loading_attachments"		=> __("loading attachments", "file-gallery"),
			"post_thumb_set"			=> __("Featured image set successfully", "file-gallery"),
			"post_thumb_unset"			=> __("Featured image removed", "file-gallery"),
			"copy_all_from_original"	=> __("Copy all attachments from the original post?", "file-gallery"),
			"set_as_featured"			=> __("Set as featured image", "file-gallery"),
			"unset_as_featured"			=> __("Unset as featured image", "file-gallery")
		);
		
		// file_gallery.options
		$file_gallery_options = array( 
			"file_gallery_url"   => FILE_GALLERY_URL,
			"file_gallery_nonce" => wp_create_nonce('file-gallery'),
			"file_gallery_mode"  => "list",
			"num_attachments"    => 1,
			"tags_from"          => true,
			"clear_cache_nonce"  => wp_create_nonce('file-gallery-clear_cache'),
			"post_thumb_nonce"   => wp_create_nonce( "set_post_thumbnail-" . $post_ID )
		);
		
		// acf.L10n
		$acf_localize = array(
			'new_custom_field' => __("Add New Custom Field", "file-gallery"),
			'add_new_custom_field' => __("Add Custom Field", "file-gallery"),
			'error_deleting_attachment_custom_field' => __("Error deleting attachment custom field!", "file-gallery"),
			'error_adding_attachment_custom_field' => __("Error adding attachment custom field!", "file-gallery"),
			'name' => __("Name:", "file-gallery"),
			'value' => __("Value:", "file-gallery")
		);
		
		// acf.options
		$acf_options = array( 
			'add_new_attachment_custom_field_nonce' => wp_create_nonce( 'add_new_attachment_custom_field_nonce' ),
			'delete_attachment_custom_field_nonce' => wp_create_nonce( 'delete_attachment_custom_field_nonce' ),
			'custom_fields' => '[]'
		);
		
		$dependencies = array('jquery', 'jquery-ui-core', 'jquery-ui-draggable', 'jquery-ui-sortable', 'jquery-ui-dialog');
		
		wp_enqueue_script('file-gallery-main',  FILE_GALLERY_URL . '/js/file-gallery.js', $dependencies);
		wp_enqueue_script('file-gallery-clear_cache',  FILE_GALLERY_URL . '/js/file-gallery-clear_cache.js');
		wp_enqueue_script('acf-attachment-custom-fields', FILE_GALLERY_URL . '/js/file-gallery-attachment_custom_fields.js');

		echo '
		<script type="text/javascript">
			var file_gallery_L10n = ' . str_replace($s, $r, json_encode($file_gallery_localize)) . ',
				file_gallery_options = ' . str_replace($s, $r, json_encode($file_gallery_options)) . ',
				acf_L10n = ' . str_replace($s, $r, json_encode($acf_localize)) . ',
				acf_options = ' . str_replace($s, $r, json_encode($acf_options)) . ';
		</script>
		';
	}
	elseif( "media.php" == $pagenow && is_numeric($_GET['attachment_id']) && "edit" == $_GET["action"] )
	{
		$custom_fields = array();
		$custom = get_post_custom($_GET['attachment_id']);

		foreach( (array) $custom as $key => $val )
		{
			if( 1 < count($val) || "_" == substr($key, 0, 1) || is_array($val[0]) )
				continue;
	
			$custom_fields[] = $key;
		}

		$custom_fields = (! empty($custom_fields)) ? "'" . implode("','", $custom_fields) . "'" : "";

		$acf_localize = array(
			'new_custom_field' => __("Add New Custom Field", "file-gallery"),
			'add_new_custom_field' => __("Add Custom Field", "file-gallery"),
			'error_deleting_attachment_custom_field' => __("Error deleting attachment custom field!", "file-gallery"),
			'error_adding_attachment_custom_field' => __("Error adding attachment custom field!", "file-gallery"),
			'name' => __("Name:", "file-gallery"),
			'value' => __("Value:", "file-gallery")
		);
		
		$acf_options = array( 
			'add_new_attachment_custom_field_nonce' => wp_create_nonce( 'add_new_attachment_custom_field_nonce' ),
			'delete_attachment_custom_field_nonce' => wp_create_nonce( 'delete_attachment_custom_field_nonce' ),
			'custom_fields' => '[' . $custom_fields . ']'
		);

		wp_enqueue_script('acf-attachment-custom-fields', FILE_GALLERY_URL . '/js/file-gallery-attachment_custom_fields.js');
		
		echo '
		<script type="text/javascript">
			var acf_L10n = ' . str_replace($s, $r, json_encode($acf_localize)) . ',
				acf_options = ' . str_replace($s, $r, json_encode($acf_options)) . ';
		</script>
		';
	}
	elseif( "media-upload.php" == $pagenow && isset($_GET["tab"]) && "library" == $_GET["tab"] )
	{
		$file_gallery_localize = array(
			'attach_all_checked_copy' => __("Attach all checked items to current post", "file-gallery"),
			'exclude_current' => __("Exclude current post's attachments", "file-gallery"),
			'include_current' => __("Include current post's attachments", "file-gallery")
		);

		wp_enqueue_script('file-gallery-attach', FILE_GALLERY_URL . '/js/file-gallery-attach.js');
		
		echo '
		<style type="text/css">
			#library-form .media-item.child-of-' . $_GET["post_id"] . '
			{
				background-color: #FFE;
			}
		</style>
		<script type="text/javascript">
			var file_gallery_attach_nonce = "' . wp_create_nonce( 'file-gallery-attach' ) . '",
				file_gallery_L10n = ' . str_replace($s, $r, json_encode($file_gallery_localize)) . ';
		</script>
		';
	}
	elseif( "options-media.php" == $pagenow )
	{
		echo '
		<script type="text/javascript">
			var file_gallery_options =
			{
				clear_cache_nonce : "' . wp_create_nonce('file-gallery-clear_cache') . '"
			};
		</script>
		';

		wp_enqueue_script('file-gallery-clear_cache', FILE_GALLERY_URL . '/js/file-gallery-clear_cache.js');
	}
	elseif( 'edit-tags.php' == $pagenow && FILE_GALLERY_MEDIA_TAG_NAME == $_GET['taxonomy'] && 3 > floatval($wp_version) )
	{
		echo '
		<script type="text/javascript">
			jQuery(document).ready(function()
			{
				jQuery("h2").html("' . __("Media tags", "file-gallery") . '");
			});
		</script>
		';
	}
}
add_action('admin_print_scripts', 'file_gallery_js_admin');


/**
 * Adds css to admin area
 */
function file_gallery_css_admin()
{
	global $pagenow, $current_screen;
	
	if(
		   'post.php' 			== $pagenow
		|| 'post-new.php' 		== $pagenow 
		|| 'page.php' 			== $pagenow 
		|| 'page-new.php' 		== $pagenow 
		|| 'media.php' 			== $pagenow 
		|| 'media-upload.php'	== $pagenow 
		|| 'edit.php'			== $pagenow 
		|| (isset($current_screen->post_type) && 'post' == $current_screen->base)
	  )
	{
		wp_enqueue_style('file_gallery_admin', apply_filters('file_gallery_admin_css_location', FILE_GALLERY_URL . '/css/file-gallery.css') );
		
		if( 'rtl' == get_bloginfo('text_direction') )
			wp_enqueue_style('file_gallery_admin_rtl', apply_filters('file_gallery_admin_rtl_css_location', FILE_GALLERY_URL . '/css/file-gallery-rtl.css') );
	}
}
add_action('admin_print_styles', 'file_gallery_css_admin');


/**
 * Edit post/page meta box content
 */
function file_gallery_content()
{	
	echo 
	'<div id="fg_container">
		&nbsp;
		<noscript>' . __('File Gallery requires Javascript to function. Please enable it in your browser.', 'file-gallery') . '</noscript>
	</div>
				
	<div id="image_dialog"></div>
	
	<div id="delete_dialog" title="' . __('Delete attachment dialog', 'file-gallery') . '">
		<p><strong>' . __("Warning: one of the attachments you've chosen to delete has copies.", 'file-gallery') . '</strong></p>
		<p>' . __('How do you wish to proceed?', 'file-gallery') . '</p>
		<p><a href="' . FILE_GALLERY_URL . '/help/index.html#deleting_originals" target="_blank">' . __('Click here if you have no idea what this dialog means', 'file-gallery') . '</a> ' . __('(opens File Gallery help in new browser window)', 'file-gallery') . '</p>
	</div>
	
	<div id="file_gallery_copy_all_dialog" title="' . __('Copy all attachments from another post', 'file-gallery') . '">
		<form action="" id="file_gallery_copy_all_form">
			<div id="file_gallery_copy_all_wrap">
				<label for="file_gallery_copy_all_from">' . __('Post ID:', 'file-gallery') . '</label>
				<input type="text" id="file_gallery_copy_all_from" value="" />
			</div>
		</form>
	</div>';
}


/**
 * Creates meta boxes on post editing screen
 */
function file_gallery()
{
	$options = get_option('file_gallery');
	
	if( function_exists('get_post_types') )
	{
		$types = get_post_types();
		
		foreach( $types as $type )
		{
			if( ! in_array( $type, array('nav_menu_item', 'revision', 'attachment') ) && 
				isset($options['show_on_post_type_' . $type]) && true == $options['show_on_post_type_' . $type]
			)
				add_meta_box('file_gallery', __( 'File gallery', 'file-gallery' ), 'file_gallery_content', $type);
		}
	}
	else // pre 2.9
	{
		add_meta_box('file_gallery', __( 'File gallery', 'file-gallery' ), 'file_gallery_content', 'post');
		add_meta_box('file_gallery', __( 'File gallery', 'file-gallery' ), 'file_gallery_content', 'page');
	}
}
add_action('admin_menu', 'file_gallery');


/**
 * Outputs attachment count in the proper column
 */
function file_gallery_posts_custom_column($column_name, $post_id)
{
	global $wpdb;
	
	$options = get_option('file_gallery');

	if( 'attachment_count' == $column_name && isset($options['e_display_attachment_count']) && true == $options['e_display_attachment_count'] )
	{
		$count = $wpdb->get_var( $wpdb->prepare("SELECT COUNT(ID) FROM $wpdb->posts WHERE post_type='attachment' AND post_parent=%d", $post_id) );
		
		echo apply_filters('file_gallery_post_attachment_count', $count, $post_id);
	}
	elseif( 'post_thumb' == $column_name && isset($options['e_display_post_thumb']) && true == $options['e_display_post_thumb'] )
	{
		if( $thumb_id = get_post_meta( $post_id, '_thumbnail_id', true ) )
		{
			$thumb_src = wp_get_attachment_image_src( $thumb_id, 'thumbnail', false );
			$content   = '<img src="' . $thumb_src[0] .'" alt="Post thumb" />';
			
			echo apply_filters('file_gallery_post_thumb_content', $content, $post_id, $thumb_id);
		}
		else
		{
			echo apply_filters('file_gallery_no_post_thumb_content', '-', $post_id);
		}
	}
}
add_action('manage_posts_custom_column', 'file_gallery_posts_custom_column', 100, 2);
add_action('manage_pages_custom_column', 'file_gallery_posts_custom_column', 100, 2);


/**
 * Adds attachment count column to the post and page edit screens
 */
function file_gallery_posts_columns( $columns )
{
	$options = get_option('file_gallery');
	
	if( isset($options['e_display_attachment_count']) && true == $options['e_display_attachment_count'] )
		$columns['attachment_count'] = __('No. of attachments', 'file-gallery');
		
	if( isset($options['e_display_post_thumb']) && true == $options['e_display_post_thumb'] )
		$columns = array('post_thumb' => __('Post thumb', 'file-gallery')) + $columns; // $columns['post_thumb'] = 'Post thumb';
	
	return $columns;
}
add_filter('manage_posts_columns', 'file_gallery_posts_columns');
add_filter('manage_pages_columns', 'file_gallery_posts_columns');


/**
 * Outputs attachment media tags in the proper column
 */
function file_gallery_media_custom_column($column_name, $post_id)
{
	global $wpdb;
	
	$options = get_option('file_gallery');
	
	if( 'media_tags' == $column_name && isset($options['e_display_media_tags']) && true == $options['e_display_media_tags'])
	{
		if( isset($options['cache']) && true == $options['cache'] )
		{
			$transient = 'fileglry_mt_' . md5($post_id);
			$cache     = get_transient($transient);
			
			if( $cache )
			{
				echo $cache;
				
				return;
			}
		}
		
		$l = '?taxonomy=' . FILE_GALLERY_MEDIA_TAG_NAME . '&amp;term=';
		$out = __('No Media Tags', 'file-gallery');
		
		$q = "SELECT `name`, `slug` 
			  FROM $wpdb->terms
			  LEFT JOIN $wpdb->term_taxonomy ON ( $wpdb->terms.term_id = $wpdb->term_taxonomy.term_id ) 
			  LEFT JOIN $wpdb->term_relationships ON ( $wpdb->term_taxonomy.term_taxonomy_id = $wpdb->term_relationships.term_taxonomy_id ) 
			  WHERE `taxonomy` = '" . FILE_GALLERY_MEDIA_TAG_NAME . "'
			  AND `object_id` = %d
			  ORDER BY `name` ASC";
		
		if( $r = $wpdb->get_results($wpdb->prepare($q, $post_id)) )
		{
			$out = array();
			
			foreach( $r as $tag )
			{
				$out[] = '<a href="' . $l . $tag->slug . '">' . $tag->name . '</a>';
			}
			
			$out = implode(', ', $out);
		}
		
		if( isset($options['cache']) && true == $options['cache'] )
			set_transient($transient, $out, $options['cache_time']);
		
		echo $out;
	}
}
add_action('manage_media_custom_column', 'file_gallery_media_custom_column', 100, 2);


/**
 * Adds media tags column to attachments
 */
function file_gallery_media_columns( $columns )
{
	$columns['media_tags'] = __('Media tags', 'file-gallery');
	
	return $columns;
}
add_filter('manage_media_columns', 'file_gallery_media_columns');


/**
 * Just a variables placeholder for now
 *
 * @since 1.6.5.1
 */
class File_Gallery
{
	var $gallery_id;
	var $overrides;
	var $acf = false;
	var $version = '1.6.5.3';


	function __construct()
	{
		$this->File_Gallery();
	}
	
	
	function File_Gallery()
	{
		if( false !== strpos(serialize(get_option('active_plugins')), 'acf.php') )
			$this->acf = true;
	}
};

$file_gallery = new File_Gallery();


/**
 * Includes
 */
require_once('includes/attachments.php');
require_once('includes/attachments-custom-fields.php');
require_once('includes/media-settings.php');
require_once('includes/miscellaneous.php');
require_once('includes/mime-types.php');
require_once('includes/lightboxes-support.php');
require_once('includes/templating.php');
require_once('includes/main.php');
require_once('includes/functions.php');
require_once('includes/cache.php');

if( 3.1 <= floatval($wp_version) )
	require_once('includes/media-tags-list-table.class.php');

?>