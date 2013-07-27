<?php
/**
 * _sf Theme Customizer
 *
 * @package _sf
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */


/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
if (! function_exists('_sf_customize_preview_js') ) :
function _sf_customize_preview_js() {
	wp_enqueue_script( '_s_customizer', get_template_directory_uri() . '/lib/js/customizer.js', array( 'customize-preview' ), '20130304', true );
}
add_action( 'customize_preview_init', '_sf_customize_preview_js' );
endif; //! _sf_customize_preview_js exists

/**
* Theme Customizer Settings
**/
if (! function_exists('_sf_customize_register') ) :
function _sf_customize_register( $wp_customize ){

	//Remove unnecessary defaults controls, settings and sections
	$wp_customize-> remove_section('background_image');
	$wp_customize-> remove_section('static_front_page');
	$wp_customize-> remove_section('colors');

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

//slider
    $wp_customize->add_section('_sf_home_slider', array(
        'title'    => __('Home Page Slider', '_s_f'),
        'priority' => 110,
    ));
     $wp_customize->add_section('_sf_home_slider_colors', array(
        'title'    => __('Slider Colors', '_s_f'),
        'priority' => 115,
    ));
//header options
    $wp_customize->add_section('_sf_header_options', array(
        'title'    => __('Header Options', '_sf'),
        'priority' => 120,
    ));
//header colors
    $wp_customize->add_section('_sf_header_colors', array(
        'title'    => __('Header Colors', '_sf'),
        'priority' => 121,
    ));

//Page Options 
    $wp_customize->add_section('_sf_page_options', array(
        'title'    => __('Page Options', '_sf'),
        'priority' => 125,
    ));
//Section For Background Options
	 $wp_customize->add_section('_sf_background_options', array(
        'title'    => __('Background Options', '_sf'),
        'priority' => 128,
    ));
//Section For Background Colors
	 $wp_customize->add_section('_sf_background_colors', array(
        'title'    => __('Background Colors', '_sf'),
        'priority' => 129,
    ));
//content colors
    $wp_customize->add_section('_sf_content_colors', array(
        'title'    => __('Content Area Colors', '_sf'),
        'priority' => 132,
    ));
// Masonry Options
    $wp_customize->add_section('_sf_masonry_options', array(
        'title'    => __('Masonry Options', '_sf'),
        'priority' => 140,
    ));
 //Sidebar Colors
    $wp_customize->add_section('_sf_sidebar_options', array(
        'title'    => __('Sidebar Options', '_sf'),
        'priority' => 133,
    ));
 //Footer Options
     $wp_customize->add_section('_sf_footer_options', array(
        'title'    => __('Footer Options', '_sf'),
        'priority' => 145,
    ));
}
add_action('customize_register', '_sf_customize_register');
endif; //! _sf_customize_register exists

/**
* Add links to Customizer
* 1.0.5.1
*/
//Add WordPress customizer page to the admin menu.
if(!function_exists('_sf_add_options_menu')) :

	function _sf_add_options_menu() {
	    $theme_page = add_theme_page(
	        __( 'Customize Theme', '_sf' ),   // Name of page
	        __( 'Customize Theme', '_sf' ),   // Label in menu
	        'edit_theme_options',          // Capability required
	        'customize.php'             // Menu slug, used to uniquely identify the page
	    );
	}
add_action ('admin_menu', '_sf_add_options_menu');
endif; // ! _sf_add_options_menu exists

//Add WordPress customizer page to the admin bar menu.
if(!function_exists('_sf_add_admin_bar_options_menu')) :
	function _sf_add_admin_bar_options_menu() {
	   if ( current_user_can( 'edit_theme_options' ) ) {
	     global $wp_admin_bar;
	     $wp_admin_bar->add_menu( array(
	       'parent' => false,
	       'id' => 'theme_editor_admin_bar',
	       'title' =>  __( 'Customize Theme', '_sf' ),
	       'href' => admin_url( 'customize.php')
	     ));
	   }
	}
add_action( 'wp_before_admin_bar_render', '_sf_add_admin_bar_options_menu' );
endif; // ! _sf_add_admin_bar_options_menu exists

?>