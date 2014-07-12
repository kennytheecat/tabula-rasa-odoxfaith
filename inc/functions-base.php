<?php
/*************************************************************
functions-base is for functions that rarely get changed
	-not stuff you switch on and off
functions-site is for functions that are commonly used
	-stuff you switch on and off

At the bottom of the functions-site file should be the specific functions for the website
**************************************************************/

/*************************************************************
ALL CAPS CASE
**************************************************************/

/** Proper Case
**************************************************************/

/** Proper Case **/

/*
Comments Single Line
or Multiple Line
*/

/*************************************************************
>>>TABLE OF CONTENTS
**************************************************************/
/*
LAUNCH TABULA RASA
	- tr_launch()
WP_HEAD GOODNESS	
	- head cleanup (remove rss, uri links, junk css, ect)
	- remove WP version from RSS
	- remove WP version from scripts
	- remove injected CSS for recent comments widget
	- remove injected CSS from recent comments widget
	- remove injected CSS from gallery
SCRIPTS & ENQUEUEING		
	- modernizer
	- main stylesheet
	- IE only stylesheet
	- comment reply script for threaded comments
	- scripts.js
	- mobile menu script
THEME SUPPORT	
	- add_theme_support('post-thumbnails')
	- add_editor_style( get_template_directory_uri() . '/css/editor-style.css' )
	- add_theme_support( 'custom-background')
	- add_theme_support('automatic-feed-links')
	- add_theme_support( 'post-formats') 
	- add_theme_support( 'menus' )
	- register_nav_menus( 'The Main Menu', 'The Secondary Menu', 'Footer Links' )
MENUS & NAVIGATION	
	- tr_main_nav()
	- tr_sec_nav()
	- tr_footer_links()
	- tr_main_nav_fallback()
	- tr_sec_nav_fallback()
	- tr_footer_links_fallback()
	- tr_register_sidebars( 'Main Sidebar', 'Secondary Widget Area' )
	- removing <p> from around images
	- tr_content_nav( $html_id )
		// Displays navigation to next/previous pages when applicable.		
	
MISC
	- Custom Header
	- remove the p from around imgs 
	- tr_get_the_author_posts_link()
		// This is a modified the_author_posts_link() which just returns the link.
	- of_get_option
		// This function is needed by inc/theme-options-inc
	- Meta Boxes
		// This function is needed by inc/metabox
********************************************************************/		

/*************************************************************
LAUNCH TABULA RASA
**************************************************************/

/** tr_setup()
***************************************************************/
if ( ! function_exists( 'tr_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function tr_setup() {
	// launching operation cleanup
	add_action('init', 'tr_head_cleanup');
	// remove WP version from RSS
	add_filter('the_generator', 'tr_rss_version');
	// remove pesky injected css for recent comments widget
	add_filter( 'wp_head', 'tr_remove_wp_widget_recent_comments_style', 1 );
	// clean up comment styles in the head
	add_action('wp_head', 'tr_remove_recent_comments_style', 1);
	// clean up gallery output in wp
	add_filter('gallery_style', 'tr_gallery_style');

	// enqueue base scripts and styles
	add_action('wp_enqueue_scripts', 'tr_scripts_and_styles', 999);
	// launching this stuff after theme setup
	tr_theme_support();

	// adding sidebars to Wordpress (these are created in functions.php)
	add_action( 'widgets_init', 'tr_register_sidebars' );

	// cleaning up random code around images
	add_filter('the_content', 'tr_filter_ptags_on_images');
}
endif; // tr_setup
add_action( 'after_setup_theme', 'tr_setup' );

/*************************************************************
WP_HEAD GOODNESS
The default wordpress head is a mess. Let's clean it up by removing all the junk we don't need.
**************************************************************/

function tr_head_cleanup() {
	// category feeds
	// remove_action( 'wp_head', 'feed_links_extra', 3 );
	// post and comment feeds
	// remove_action( 'wp_head', 'feed_links', 2 );
	// EditURI link
	remove_action( 'wp_head', 'rsd_link' );
	// windows live writer
	remove_action( 'wp_head', 'wlwmanifest_link' );
	// index link
	remove_action( 'wp_head', 'index_rel_link' );
	// previous link
	remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
	// start link
	remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
	// links for adjacent posts
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );
	// WP version
	remove_action( 'wp_head', 'wp_generator' );
  // remove WP version from css
  add_filter( 'style_loader_src', 'tr_remove_wp_ver_css_js', 9999 );
  // remove Wp version from scripts
  add_filter( 'script_loader_src', 'tr_remove_wp_ver_css_js', 9999 );
} /* end tr head cleanup */

// remove WP version from scripts
function tr_remove_wp_ver_css_js( $src ) {
    if ( strpos( $src, 'ver=' ) )
        $src = remove_query_arg( 'ver', $src );
    return $src;
}

// remove WP version from RSS
function tr_rss_version() { return ''; }

// remove injected CSS for recent comments widget
function tr_remove_wp_widget_recent_comments_style() {
   if ( has_filter('wp_head', 'wp_widget_recent_comments_style') ) {
      remove_filter('wp_head', 'wp_widget_recent_comments_style' );
   }
}

// remove injected CSS from recent comments widget
function tr_remove_recent_comments_style() {
  global $wp_widget_factory;
  if (isset($wp_widget_factory->widgets['WP_Widget_Recent_Comments'])) {
    remove_action('wp_head', array($wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style'));
  }
}

// remove injected CSS from gallery
function tr_gallery_style($css) {
  return preg_replace("!<style type='text/css'>(.*?)</style>!s", '', $css);
}

/*********************
THEME SUPPORT
*********************/

// Adding WP 3+ Functions & Theme Support
function tr_theme_support() {

	// Make theme available for translation.
	// Translations can be filed in the /languages/ directory.
	load_theme_textdomain( 'tabula-rasa', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	//Enable support for Post Thumbnails on posts and pages.
	//@link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	add_theme_support( 'post-thumbnails' );
	
	//Switch default core markup for search form, comment form, and comments to output valid HTML5.
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	// wp menus
	add_theme_support( 'menus' );

	// registering wp3+ menus
	register_nav_menus(
		array(
			'primary' => __( 'Primary Menu', 'tabula-rasa' ),   // main nav in header
			'social' => __( 'Social Menu', 'tabula-rasa'),
		//	'sec-nav' => __( 'The Secondary Menu', 'tabula-rasa' ),   // secondary nav in header
		//	'footer-links' => __( 'Footer Links', 'tabula-rasa' ) // secondary nav in footer
		)
	);
	
	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style( get_template_directory_uri() . '/css/editor-style.css' );	
	
} /* end tr_theme_support() */

/*************************************************************
ACTIVE SIDEBARS
**************************************************************/
//@link http://codex.wordpress.org/Function_Reference/register_sidebar
// Sidebars & Widgetizes Areas
function tr_register_sidebars() {
	register_sidebar( array(
		'name' => __( 'Main Sidebar', 'tabula-rasa' ),
		'id' => 'sidebar-1',
		'description' => __( 'Appears on posts and pages except the optional Front Page template, which has its own widgets', 'tabula-rasa' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	// 	to add more sidebars or widgetized areas, just copy and edit the above sidebar code.
}

/*************************************************************
MISC
**************************************************************/

// remove the p from around imgs (http://css-tricks.com/snippets/wordpress/remove-paragraph-tags-from-around-images/)
function tr_filter_ptags_on_images($content){
   return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}

/** FROM _S EXTRAS
**************************************************************//**
 * Filters wp_title to print a neat <title> tag based on what is being viewed.
 *
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 */
function tr_wp_title( $title, $sep ) {
	if ( is_feed() ) {
		return $title;
	}
	global $page, $paged;

	// Add the blog name
	$title .= get_bloginfo( 'name', 'display' );

	// Add the blog description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) ) {
		$title .= " $sep $site_description";
	}

	// Add a page number if necessary:
	if ( ( $paged >= 2 || $page >= 2 ) && ! is_404() ) {
		$title .= " $sep " . sprintf( __( 'Page %s', 'tabula-rasa' ), max( $paged, $page ) );
	}
	return $title;
}
add_filter( 'wp_title', 'tr_wp_title', 10, 2 );
?>