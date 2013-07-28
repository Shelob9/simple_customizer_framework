<?php
/**
* Example Options
* In this example we are setting up colors for our sidebar.
* Use this example to create your own.
*
* @package scf
* @since 0.1
*/
if (! function_exists('scc_customize_sidebar') ) :
add_action('customize_register', 'scc_customize_sidebar');


function scc_customize_sidebar() {
	$section = 'scc_sidebar_options';
	global $wp_customize;
	
	$sidebar[] = array(
		'slug'=>'sidebar_bg_color', 
		'default' => '#fff',
		'label' => __('Sidebar Background Color', 'sf'),
		'priority' => 5,
		'selector' => '#secondary',
		'property' => 'color',
	);
	$sidebar[] = array(
		'slug'=>'widget_title_color', 
		'default' => '#000',
		'label' => __('Widget Title Color', 'sf'),
		'selector' => 'h5.widget-title',
		'property' => 'color',
		
	);
	$sidebar[] = array(
		'slug'=>'sidebar_text_color', 
		'default' => '#000',
		'label' => __('Widget Text Color', 'sf'),
		'selector' => '#secondary',
		'property' => 'color',
	);
	$sidebar[] = array(
		'slug'=>'sidebar_link_color', 
		'default' => '#1e73be',
		'label' => __('Widget Link Color', 'sf'),
		'selector' => '#secondary a',
		'property' => 'color',
		
	);
	$sidebar[] = array(
		'slug'=>'sidebar_linkHvr_color', 
		'default' => '#fff',
		'label' => __('Widget Link Hover Color', 'sf'),
		'selector' => '#secondary a:hover',
		'property' => 'color',
	);
	$sidebar[] = array(
		'slug'=>'sidebar_linkVstd_color', 
		'default' => '#800080',
		'label' => __('Widget Visited Link Color', 'sf'),
		'selector' => '#secondary a:visited',
		'property' => 'color',
	);
	
	$colors = $sidebar;
	$countStart = 50;
	scc_customzier_color_loop($colors, $countStart, $section);
	
}
endif; //! scc_customize_sidebar
?>