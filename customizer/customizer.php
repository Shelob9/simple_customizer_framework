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
 *
 * @since _sf 1.1.0 action removed in favor of _sf_localize_customizer() below. Keeping this here for now, for saftey/ testing.
 */
 
if (! function_exists('_sf_customize_preview_js') ) :
function _sf_customize_preview_js() {
	wp_enqueue_script( 'customizer-preview', get_template_directory_uri() . '/lib/js/customizer.js', array( 'customize-preview' ), '20130304', true );
}
//add_action( 'customize_preview_init', '_sf_customize_preview_js' );
endif; //! _sf_customize_preview_js exists

/**
* Theme Customizer Settings
**/
if (! function_exists('_sf_customizer_sections') ) :
function _sf_customizer_sections( $wp_customize ){

	//Remove unnecessary defaults controls, settings and sections
	$wp_customize-> remove_section('background_image');
	$wp_customize-> remove_section('static_front_page');
	$wp_customize-> remove_section('colors');

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';




//Page Options 
    $wp_customize->add_section('_sf_page_options', array(
        'title'    => __('Page Options', '_sf'),
        'priority' => 100,
    )); 
//header options
    $wp_customize->add_section('_sf_header_options', array(
        'title'    => __('Header Options', '_sf'),
        'priority' => 120,
    ));
//menu options
    $wp_customize->add_section('_sf_menu_options', array(
        'title'    => __('Menu Options', '_sf'),
        'priority' => 125,
    ));
//content options
    $wp_customize->add_section('_sf_content_options', array(
        'title'    => __('Content Area Options', '_sf'),
        'priority' => 130,
    ));
//slider
    $wp_customize->add_section('_sf_home_slider', array(
        'title'    => __('Home Page Slider Options', '_s_f'),
        'priority' => 130,
    ));
     $wp_customize->add_section('_sf_home_slider_colors', array(
        'title'    => __('Slider Colors', '_s_f'),
        'priority' => 135,
    ));
// Masonry Options
    $wp_customize->add_section('_sf_masonry_options', array(
        'title'    => __('Masonry Options', '_sf'),
        'priority' => 140,
    ));
 //Sidebar Colors
    $wp_customize->add_section('_sf_sidebar_options', array(
        'title'    => __('Sidebar Options', '_sf'),
        'priority' => 145,
    ));
 //Footer Options
     $wp_customize->add_section('_sf_footer_options', array(
        'title'    => __('Footer Options', '_sf'),
        'priority' => 155,
    ));
}
add_action('customize_register', '_sf_customizer_sections');
endif; //! _sf_customizer_sections

/**
* Bring In Other Parts Of Customizer
*
* @since _sf 1.1.0
*/

	//locate_template('lib/customizer/customizer-page.php', true);
	//locate_template('lib/customizer/customizer-header.php', true);
	//locate_template('lib/customizer/customizer-content.php', true);
	//locate_template('lib/customizer/customizer-slider.php', true);
	//locate_template('lib/customizer/customizer-masonry.php', true);
	locate_template('lib/customizer/customizer-sidebar.php', true);
	//locate_template('lib/customizer/customizer-footer.php', true);


/**
* Customizer Color Control Loop
*
* @since _sf 1.1.0
*/
if (! function_exists('_sf_customzier_color_loop') ) :
function _sf_customzier_color_loop($colors, $countStart = 10, $section) {
	//Not sure why I have to do this first thing
	global $wp_customize;
	//start the counter at 10 or whatever was set.
	$count = $countStart;
	foreach ($colors as $things) {
		$slug = $things['slug'];
		$id = "_sf[{$slug}]";
		//If current array has a priority set, use it, if not use the counter.
		if (! isset($things['priority']) ) {
			$priority = $count;
		}
		else {
			$priority = $things['priority'];
		}
		$wp_customize->add_setting( $id, array(
			'type'              => 'option', 
			'transport'     => 'postMessage',
			'capability'     => 'edit_theme_options',
			'default' 		=> $things['default'],
		) );
 
		$control = 
		new WP_Customize_Color_Control(
				$wp_customize, $slug, 
			array(
			'label'         => __( $things['label'], '_sf' ),
			'section'       => $section,
			'priority'      => $priority,
			'settings'      => $id
			) 
		);
		$wp_customize->add_control($control);
		//create array to be used for the outputting styles to wp_head and customizer.js
		$customizerData [] = array(
        	'id' => $id,
        	'slug' => $slug, 
        	'selector' => $things['selector'],
        	'property' => $things['property'],
        );
		
		//advance priority counter
		$count++;
	}
	//save the $customizerData array in the option '_sf_cData'
	$option_name = '_sf_cData';
	$new_value = $customizerData;
	if ( get_option( $option_name ) !== false ) {

		// The option already exists, so we just update it.
		update_option( $option_name, $new_value );

	} else {

		// The option hasn't been added yet. We'll add it with $autoload set to 'no'.
		$deprecated = null;
		$autoload = 'yes';
		add_option( $option_name, $new_value, $deprecated, $autoload );
	}
}
endif; // ! _sf_customzier_color_loop exists

/**
* Set styles set in customizer dynamically
*
* @since _sf 1.1.0
*/

if (! function_exists('_sf_auto_style') ) :
function _sf_auto_style() {
	//get the options array
	global $options;
	//get the data we need fromt he option '_sf_cData' we save in the color loop.
	$customizerData = get_option('cData');
	//create the css by looping through $customizerData
	//create $return to be populated in this loop
	$return = '';
	foreach ($customizerData as $data) {
		$return .= $data['selector'];
		$return .= "{";
		$return .= $data['property'].":";
		$return .= $options[$data['slug']].";} ";
	}
	//echos
	echo "<style>";
	echo $return;
	echo "</style>";
}
add_action('wp_head', '_sf_auto_style');
endif; // ! _sf_auto_style exists

/**
* Localize customizer.js
*
* @since _sf 1.1.0
*/

if (! function_exists('_sf_localize_customizer') ):
function _sf_localize_customizer() {
	global $customizerData;
	wp_localize_script('customizer-preview', 'custStyle', $customizerData);
}
endif; // ! _sf_localize_customizer exists



/**
* Add links to Customizer
* @since _sf1.0.5.1
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