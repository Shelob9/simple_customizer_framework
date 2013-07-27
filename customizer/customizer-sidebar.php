<?php
/**
* Sidebar Customizer Options
*
* @since _sf 1.1.0
*/
if (! function_exists('_sf_customize_sidebar') ) :
add_action('customize_register', '_sf_customize_sidebar');

function _sf_customize_sidebar() {
	$section = '_sf_sidebar_options';
	//  ==============
	//  = Background =
	//  ==============
	//what happened to sidebar transparency??
	
	//  ====================
	//  = Sidebar Location =
	//  ====================
	$wp_customize->add_setting(
			'_sf[default_sidebar]', array(
				'capability'  => 'edit_theme_options',
        		'type' => 'option',
			)
		);
	$wp_customize->add_control(
   		'default_sidebar',
		array(
			'label' => __('Sidebar Location', '_s_f'),
			'section' => $section,
			'default'        => 'value1',
			'type'       => 'select',
			'choices'    => array(
				'value1' => 'Right',
				'value2' => 'Left',
				'value3' => 'None',
			),
			'settings' => '_sf[default_sidebar]',
		)
    );
    
	//  ==================
	//  = Color Controls =
	//  ==================
	$sidebar[] = array(
		'slug'=>'sidebar_bg_color', 
		'default' => '#fff',
		'label' => __('Sidebar Background Color', 'sf')
	);
	$sidebar[] = array(
	'slug'=>'sidebar_text_color', 
	'default' => '#000',
	'label' => __('Sidebar Text Color', 'sf')
	);
	$sidebar[] = array(
		'slug'=>'widget_title_color', 
		'default' => '#000',
		'label' => __('Widget Title Color', 'sf')
	);
	$sidebar[] = array(
		'slug'=>'sidebar_link_color', 
		'default' => '#1e73be',
		'label' => __('Sidebar Link Color', 'sf')
	);
	$sidebar[] = array(
		'slug'=>'sidebar_linkHvr_color', 
		'default' => '#fff',
		'label' => __('Sidebar Link Hover Color', 'sf')
	);
	$sidebar[] = array(
		'slug'=>'sidebar_linkVstd_color', 
		'default' => '#800080',
		'label' => __('Sidebar Visited Link Color', 'sf')
	);
	
	$sidebar = $colors;
	_sf_customzier_color_loop($colors, $countStart, $section)
	
}
endif; //! _sf_customize_sidebar
?>