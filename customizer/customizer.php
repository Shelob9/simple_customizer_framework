<?php
/**
 * scf Theme Customizer
 *
 * @package scf
 * @since scf 0.1
*/

/**
* The SCF Make The Magic Happen Class
* This machine automatically create settings/controls, and outputs css to header.
* One day it will update js for previewing.
*
* @since scf 0.1
*/
if (! class_exists('scf_make_the_magic') ):
class scf_make_the_magic {
	public $customizerData;
	/**
	* Customizer Color Control Loop
	*
	* @since _sf 1.1.0
	* @since scf 0.1
	*/
	public function scf_customzier_color_loop($colors, $countStart = 10, $section) {
		//Not sure why I have to do this first thing
		global $wp_customize;
		//get the options
		//todo: set which option in a nonstupid way.
		//get_option('scf');
		
		
		//start the counter at 10 or whatever was set.
		$count = $countStart;
		foreach ($colors as $things) {
			$slug = $things['slug'];
			$id = "scf[{$slug}]";
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
			$this->customizerData[] = array(
				'id' => $id,
				'slug' => $slug, 
				'selector' => $things['selector'],
				'property' => $things['property'],
			);
		
			//advance priority counter
			$count++;
		}
		/*
		//save the $customizerData array in the option 'scf_cData'
		$option_name = 'scf_cData';
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
		*/
	}

	/**
	* Set styles set in customizer dynamically
	*
	* @since scf 1.1.0
	*/
	public function scf_auto_style() {
		/*
		//get the options array
		global $options;
		//get the data we need fromt he option 'scf_cData' we save in the color loop.
		$customizerData = get_option('scf_cData');
		*/
		//create the css by looping through $customizerData
		//create $return to be populated in this loop
		$return = '';
		foreach ($this->customizerData as $data) {
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
	//add_action('wp_head', 'scf_auto_style');

	/**
	* Add links to Customizer
	* @since _sf 1.0.5.1
	* @since scf 0.1
	*/
	function _add_options_menu() {
	//Add WordPress customizer page to the admin menu.
		$theme_page = add_theme_page(
			__( 'Customize Theme', 'scf' ),   // Name of page
			__( 'Customize Theme', 'scf' ),   // Label in menu
			'edit_theme_options',          // Capability required
			'customize.php'             // Menu slug, used to uniquely identify the page
		);
	}
	//add_action ('admin_menu', 'scf_add_options_menu');

	//Add WordPress customizer page to the admin bar menu.
	
	function scf_add_admin_bar_options_menu() {
	   if ( current_user_can( 'edit_theme_options' ) ) {
		 global $wp_admin_bar;
		 $wp_admin_bar->add_menu( array(
		   'parent' => false,
		   'id' => 'theme_editor_admin_bar',
		   'title' =>  __( 'Customize Theme', 'scf' ),
		   'href' => admin_url( 'customize.php')
		 ));
	   }
	}
	//add_action( 'wp_before_admin_bar_render', 'scf_add_admin_bar_options_menu' );
}
endif; //! scf_make_the_magic exists
?>