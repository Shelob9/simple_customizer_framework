<?php
/**
* Example Options
* In this example we are setting up colors for our sidebar.
* Use this example to create your own.
* Steps to complete this challenge are inline with code and prefixed with STEP
*
* The css selectors set in this example will work with twentytwelve.
*
* @package scf
* @since 0.1
*/
if (! function_exists('scf_customize_sidebar') ) :
add_action('customize_register', 'scf_customize_sidebar');

function scf_customize_sidebar() {
	
	//STEP 1 tell us what section this goes in.
	//This should correspond to a value set for 'slug' in sections.php
	$sectionName = 'sidebar_options';
	
	global $wp_customize;
	
	//STEP 2: Tell us about each option you wish to offer.
	//slug- name of the option. default- default value (optional). Label- will be shown above the control. Priority- use to set order that options appear in (options.) If not set they will appear in the order you add them in. Selector- css selector this option controls. Property- CSS property this option defines.
	$colors[] = array(
		'slug'=>'sidebar_bg_color', 
		'default' => '#fff',
		'label' => 'Sidebar Background Color',
		'priority' => 5,
		'selector' => '#secondary',
		'property' => 'color',
		'priority' => '',
	);
	$colors[] = array(
		'slug'=>'widget_title_color', 
		'default' => '#000',
		'label' => 'Widget Title Color',
		'selector' => 'h3.widget-title',
		'property' => 'color',
		'priority' => '',
	);
	$colors[] = array(
		'slug'=>'sidebar_text_color', 
		'default' => '#000',
		'label' => 'Widget Text Color',
		'selector' => '#secondary',
		'property' => 'color',
		'priority' => '200',
	);
	$colors[] = array(
		'slug'=>'sidebar_link_color', 
		'default' => '#1e73be',
		'label' => 'Widget Link Color',
		'selector' => '#secondary a',
		'property' => 'color',
		'priority' => '',
		
	);
	$colors[] = array(
		'slug'=>'sidebar_linkHvr_color', 
		'default' => '#fff',
		'label' => 'Widget Link Hover Color',
		'selector' => '#secondary a:hover',
		'property' => 'color',
		'priority' => '',
	);
	$colors[] = array(
		'slug'=>'sidebar_linkVstd_color', 
		'default' => '#800080',
		'label' => 'Widget Visited Link Color',
		'selector' => '#secondary a:visited',
		'property' => 'color',
		'priority' => '',
	);
	
	//STEP 3: Set the initial priority value
	$countStart = 50;
	
	//prefix the section name
	$section = 'scf_'.$sectionName;
	
	//STEP 4: Watch the magic happen.
	scf_customzier_color_loop($colors, $countStart, $section);
}
endif; //! scf_customize_sidebar
?>