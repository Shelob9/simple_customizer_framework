<?php
/**
* Sidebar Customizer Options
*
* @since _sf 1.1.0
*/
if (! function_exists('_sf_customize_footer') ) :
add_action('customize_register', '_sf_customize_footer');

function _sf_customize_footer() {
	$section = '_sf_footer_options';
	//todo: creditlink/additional text options
	global $wp_customize;
	//  ==============
	//  = Background =
	//  ==============
	 $wp_customize->add_setting(
   		'_sf[footer-trans-bg]', array(
   			'type' => 'option',
   			'capability'  => 'edit_theme_options',
    	)
    );

    $wp_customize->add_control(
		'footer-trans-bg',
		array(
			'type' => 'checkbox',
			'label' => 'Use A Background Color For Footer Area',
			'section' => $section,
			'priority' => '5',
			'settings' => '_sf[footer-trans-bg]',
			)
    );
	//  ==================
	//  = Color Controls =
	//  ==================
	$colors[] = array(
		'slug'=>'footer_bg_color', 
		'default' => '#000',
		'label' => __('Footer Background Color', 'sf'),
		'priority' => '10',
	);
	$colors[] = array(
		'slug'=>'footer_text_color', 
		'default' => '#fff',
		'label' => __('Footer Text Color', 'sf')
	);
	$colors[] = array(
		'slug'=>'footer_link_color', 
		'default' => '#1e73be',
		'label' => __('Footer Link Color', 'sf')
	);
	$colors[] = array(
		'slug'=>'footer_linkHvr_color', 
		'default' => '#fff',
		'label' => __('Footer Link Hover Color', 'sf')
	);
	$colors[] = array(
		'slug'=>'footer_linkVstd_color', 
		'default' => '#800080',
		'label' => __('Footer Visited Link Color', 'sf')
	);

	
	$countStart = 20;
	_sf_customzier_color_loop($colors, $countStart, $section);
	
}
endif; //! _sf_customize_footer
?>