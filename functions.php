<?php

// get active theme directory name (lets you rename roots)
$theme_name = next(explode('/themes/', get_template_directory()));

require_once('AB_ScriptLoader.php');
require_once('AB_StyleLoader.php');

include_once('includes/roots-activation.php');	// activation
include_once('includes/roots-admin.php');		// admin additions/mods
include_once('includes/roots-options.php');		// theme options menu
include_once('includes/roots-ob.php');			// output buffer
include_once('includes/roots-cleanup.php');		// code cleanup/removal
include_once('includes/roots-htaccess.php');	// h5bp htaccess

// set the value of the main container class depending on the selected grid framework
$roots_css_framework = get_option('roots_css_framework');
if (!defined('roots_container_class')) {
	switch ($roots_css_framework) {
		case 'blueprint':
			define('roots_container_class', 'span-24');
      break;
		case '960gs_12':
			define('roots_container_class', 'container_12');
      break;
		case '960gs_16':
			define('roots_container_class', 'container_16');
      break;
		case '960gs_24':
			define('roots_container_class', 'container_24');
      break;
		case '1140':
			define('roots_container_class', 'container');
      break;
		default:
			define('roots_container_class', '');
      break;
	}
}

//grab header without nav
function get_lpheader() {
	$template_uri = get_template_directory_uri();
	include('header-lp.php');
}


function get_roots_stylesheets() {
	$roots_css_framework = get_option('roots_css_framework');
	$template_uri = get_template_directory_uri();
	$styles = '';

	if ($roots_css_framework === 'blueprint') {
		$styles .= "<link rel=\"stylesheet\" href=\"$template_uri/css/blueprint/screen.css\">\n";
	} elseif ($roots_css_framework === '960gs_12' || $roots_css_framework === '960gs_16') {
		$styles .= "<link rel=\"stylesheet\" href=\"$template_uri/css/960/reset.css\">\n";
		$styles .= "\t<link rel=\"stylesheet\" href=\"$template_uri/css/960/text.css\">\n";
		$styles .= "\t<link rel=\"stylesheet\" href=\"$template_uri/css/960/960.css\">\n";
	} elseif ($roots_css_framework === '960gs_24') {
		$styles .= "<link rel=\"stylesheet\" href=\"$template_uri/css/960/reset.css\">\n";
		$styles .= "\t<link rel=\"stylesheet\" href=\"$template_uri/css/960/text.css\">\n";
		$styles .= "\t<link rel=\"stylesheet\" href=\"$template_uri/css/960/960_24_col.css\">\n";
	} elseif ($roots_css_framework === '1140') {
		$styles .= "<link rel=\"stylesheet\" href=\"$template_uri/css/1140/1140.css\">\n";
	}

	if (class_exists('RGForms')) {
		$styles .= "\t<link rel=\"stylesheet\" href=\"" . plugins_url(). "/gravityforms/css/forms.css\">\n";
	}

	$styles .= "\t<link rel=\"stylesheet\" href=\"$template_uri/css/style.css\">\n";

	if ($roots_css_framework === 'blueprint') {
		$styles .= "\t<!--[if lt IE 8]><link rel=\"stylesheet\" href=\"$template_uri/css/blueprint/ie.css\"><![endif]-->\n";
	} elseif ($roots_css_framework === '1140') {
		$styles .= "\t<!--[if lt IE 8]><link rel=\"stylesheet\" href=\"$template_uri/css/1140/ie.css\"><![endif]-->\n";
	}

	return $styles;
}
	
// set the maximum 'Large' image width to the maximum grid width
if (!isset($content_width)) {
	switch ($roots_css_framework) {
    case 'blueprint':
		  $content_width = 950;
	break;
    case '960gs_12':
		  $content_width = 940;
	break;
    case '960gs_16':
		  $content_width = 940;
	break;
    case '960gs_24':
		  $content_width = 940;
	break;
    case '1140':
		  $content_width = 1140;
	break;
    default:
		  $content_width = 950;
	break;
  }
}
// tell the TinyMCE editor to use editor-style.css
// if you have issues with getting the editor to show your changes then use the following line:
// add_editor_style('editor-style.css?' . time());
add_editor_style('editor-style.css');

add_theme_support('post-thumbnails');

// http://codex.wordpress.org/Post_Formats
// add_theme_support('post-formats', array('aside', 'gallery', 'link', 'image', 'quote', 'status', 'video', 'audio', 'chat'));

add_theme_support('menus');
register_nav_menus(
	array(
		'primary_navigation' => 'Primary Navigation',
		'utility_navigation' => 'Utility Navigation',
		'footer_navigation' => 'Footer Navigation'
	)
);

// remove container from menus
function roots_nav_menu_args($args = ''){
	$args['container'] = false;
	return $args;
}

add_filter('wp_nav_menu_args', 'roots_nav_menu_args');

// create widget areas: sidebar, footer
// WARNING -- Changing the order of these has dire consequences - JT
$sidebars = array('Sidebar1', 'Footer', 'Header', 'AboveArticle','ArticleHeader', 'UnderArticle','UnderComments','Sidebar2','Footer2');
foreach ($sidebars as $sidebar) {
	register_sidebar(array('name'=> $sidebar,
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3>',
		'after_title' => '</h3>'
	));
}

// add to robots.txt
// http://codex.wordpress.org/Search_Engine_Optimization_for_WordPress#Robots.txt_Optimization
add_action('do_robots', 'roots_robots');

function roots_robots() {
	echo "Disallow: /cgi-bin\n";
	echo "Disallow: /wp-admin\n";
	echo "Disallow: /wp-includes\n";
	echo "Disallow: /wp-content/plugins\n";
	echo "Disallow: /plugins\n";
	echo "Disallow: /wp-content/cache\n";
	echo "Disallow: /wp-content/themes\n";
	echo "Disallow: /trackback\n";
	echo "Disallow: /feed\n";
	echo "Disallow: /comments\n";
	echo "Disallow: /category/*/*\n";
	echo "Disallow: */trackback\n";
	echo "Disallow: */feed\n";
	echo "Disallow: */comments\n";
	echo "Disallow: /*?*\n";
	echo "Disallow: /*?\n";
	echo "Allow: /wp-content/uploads\n";
	echo "Allow: /assets";
}


/*
//Custom CSS Widget
add_action('admin_menu', 'custom_css_hooks');
add_action('save_post', 'save_custom_css');
add_action('wp_head','insert_custom_css');
function custom_css_hooks() {
	add_meta_box('custom_css', 'Custom CSS', 'custom_css_input', 'post', 'normal', 'high');
	add_meta_box('custom_css', 'Custom CSS', 'custom_css_input', 'page', 'normal', 'high');
	add_meta_box('custom_css', 'Custom CSS', 'custom_css_input', 'thankyou_page', 'normal', 'high');
	add_meta_box('custom_css', 'Custom CSS', 'custom_css_input', 'landing_page', 'normal', 'high');
}
function custom_css_input() {
	global $post;
	echo '<input type="hidden" name="custom_css_noncename" id="custom_css_noncename" value="'.wp_create_nonce('custom-css').'" />';
	echo '<textarea name="custom_css" id="custom_css" rows="5" cols="30" style="width:100%;">'.get_post_meta($post->ID,'_custom_css',true).'</textarea>';
}
function save_custom_css($post_id) {
	if (!wp_verify_nonce($_POST['custom_css_noncename'], 'custom-css')) return $post_id;
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) return $post_id;
	$custom_css = $_POST['custom_css'];
	update_post_meta($post_id, '_custom_css', $custom_css);
}
function insert_custom_css() {
	if (is_page() || is_single()) {
		if (have_posts()) : while (have_posts()) : the_post();
			echo '<style type="text/css">'.get_post_meta(get_the_ID(), '_custom_css', true).'</style>';
		endwhile; endif;
		rewind_posts();
	}
}
*/

add_post_type_support('page', 'excerpt');

// disable the automatic adding of <p> tags...
remove_filter( 'the_content', 'wpautop' );
remove_filter( 'the_excerpt', 'wpautop' );

?>
