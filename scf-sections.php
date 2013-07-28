<?php
/**
* @package scf
* @since 0.1
*
*
INSTRUCTIONS:
 	For each desired section, create an array like in this example
		$sections[] = array(
			'slug'		=> '',
			'label'		=> '',
			'priority'	=> '',
		);
	'slug' is the section's name. You must use all lower case letters and no spaces.
	'label' will be displayed in the customizer. You can use uppercase and spaces, etc.
	'priority' determines the order of the settings. It is optional. If not set priorities will be set in increments of 10 starting at 100.
*/

	

/**
* Define Sections
*
* @since scf 0.1
*/
if (! function_exists('scf_customizer_sections') ) :

function scf_customizer_sections( $wp_customize) {
	//SET THE ARRAY HERE
	//todo: move this out of the function itself
	//this is for use with the settings in scf-example
	$sections[] = array(
		'slug'		=> 'sidebar_options',
		'label'		=> 'Sidebar Settings',
		'priority'	=> '',
	);

	
	$count = 100;
	foreach ($sections as $section) {
		//If current array has a priority set, use it, if not use the counter.
		if (! isset($section['priority']) ) {
			$priority = $count;
		}
		else {
			$priority = $section['priority'];
		}
		//make the sections id from theme slug and setting slug and put it in $id
		$id = 'scf_'.$section['slug'];
		
		//create the section
		$wp_customize->add_section($id, array(
			'title'    => __($section['label'], 'scf'),
			'priority' => $priority,
		)); 
	}
}
add_action('customize_register', 'scf_customizer_sections');
endif; //! _scf_customizer_sections