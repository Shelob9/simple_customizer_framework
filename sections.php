<?php
/**
* @package scc
* @since 0.1
*
*
INSTRUCTIONS:
 	For each desired section, create an array like in this example
		$sections[] = array(
			'slug'		=> '',
			'label'		=> '',
			'priority'	=> '',
		),
	'slug' is the section's name. You must use all lower case letters and no spaces.
	'label' will be displayed in the customizer. You can use uppercase and spaces, etc.
	'priority' determines the order of the settings. It is optional. If not set priorities will be set in increments of 10 starting at 100.
	

*/

	//this is for use with the settings in scc-example
	$sections[] = array(
		'slug'		=> 'sidebar_options',
		'label'		=> 'Sidebar Settings',
		'priority'	=> '',
	)


/**
* Define Sections
*
* @since scc 0.1
*/
if (! function_exists('_scc_customizer_sections') ) :
function scc_customizer_sections( $wp_customize, $sections){
	//get global theme slug
	global $scc_themeSlug;
	$themeSlug = $scc_themeSlug;
	
	$count = 100;
	foreach ($sectionsList as $section) {
		//If current array has a priority set, use it, if not use the counter.
		if (! isset($things['priority']) ) {
			$priority = $count;
		}
		else {
			$priority = $section['priority'];
		}
		//make the sections id from theme slug and setting slug and put it in $id
		$id = $themeslug.$section['slug'];
		
		//create the section
		$wp_customize->add_section($id, array(
			'title'    => __($section['label'], $themeSlug),
			'priority' => $priority;
		)); 
	}
}
add_action('customize_register', '_scc_customizer_sections');
endif; //! _scc_customizer_sections