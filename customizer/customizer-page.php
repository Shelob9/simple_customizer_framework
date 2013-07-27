<?php
/**
* Page Customizer Options
*
* @since _sf 1.1.0
*/
if (! function_exists('_sf_customize_page') ) :
add_action('customize_register', '_sf_customize_page');

function _sf_customize_page() {
	$section = '_sf_page_options';
	global $wp_customize;
	//  ==============
	//  = Background =
	//  ==============
	//Background Color or Full-Width Image?
	$wp_customize->add_setting(
		'_sf[body_bg_choice]', array(
			'type' => 'option',
			'capability'  => 'edit_theme_options',
    	)
	);

    $wp_customize->add_control(
		'body_bg_choice',
		array(
			'type' => 'checkbox',
			'label' => 'Use Background Color Instead of Background Image For Page?',
			'section' => $section,
			'settings'   => '_sf[body_bg_choice]',
			'priority' => '5',
		)
    );
    
	//page background img
	$defaultbg = get_template_directory_uri().'/images/bg.jpg';
	    $wp_customize->add_setting(
	    '_sf[body_bg_img]', array(
			'default'           => $defaultbg,
			'capability'        => 'edit_theme_options',
			'type' => 'option',
    	)
    );
 
    $wp_customize->add_control( 
		new WP_Customize_Image_Control($wp_customize, 'body_bg_img', array(
			'label'    => __('Upload Page Background', 'sf'),
			'section' => $section,
			'settings' => '_sf[body_bg_img]',
			'priority' => '10',
    )));
    
    //  ==================
	//  = Color Controls =
	//  ==================
    $colors[] = array(
		'slug'=>'page_bg_color', 
		'default' => '#fff',
		'label' => __('Page Background Color', 'sf')
	);

	
	$countStart = 5;
	_sf_customzier_color_loop($colors, $countStart, $section);
}
endif; //! _sf_customize_page
?>