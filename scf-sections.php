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

$sections[] = array(
	'slug'		=> 'sidebar_options',
	'label'		=> 'Sidebar Settings',
	'priority'	=> '',
);

