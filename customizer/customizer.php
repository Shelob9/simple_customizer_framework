<?php
/**
 * _sf Theme Customizer
 *
 * @package _sf
 */


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
		$theme_slug = '_sf';
		$slug = $things['slug'];
		$id = "{$theme_slug}[{$slug}]";
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
			'label'         => __( $things['label'], $theme_slug ),
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
* Binds JS handlers to make Theme Customizer preview reload changes asynchronously with customizer.js
* Also localize the customizer options so they can be added dynamically in customizer.js
*
* @since _sf 1.1.0
*/

if (! function_exists('_sf_localize_customizer') ):
function _sf_localize_customizer() {
	wp_enqueue_script( 'customizer-preview', get_template_directory_uri() . '/lib/js/customizer.js', array( 'customize-preview' ), '20130304', true );
	$customizerData = get_option('cData');
	wp_localize_script('customizer-preview', 'custStyle', $customizerData);
}
add_action('wp_enqueue_scripts', '_sf_localize_customizer');
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