<?php
/**
* Page Customizer Options
*
* @since _sf 1.1.0
*/
if (! function_exists('_sf_customize_page') ) :
add_action('customize_register', '_sf_customize_page');

function _sf_customize_page() {
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
			'section' => '_sf_background_options',
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
			'section'    => '_sf_background_options',
			'settings' => '_sf[body_bg_img]',
			'priority' => '10',
    )));
    
    //  ==================
	//  = Color Controls =
	//  ==================
    $color[] = array(
		'slug'=>'page_bg_color', 
		'default' => '#fff',
		'label' => __('Page Background Color', 'sf')
	);

	$section = '_sf_background_colors';
	$count = 5;
	foreach ($color as $things) {
		$slug = $things['slug'];
		$id = "_sf[{$slug}]";
		$wp_customize->add_setting( $id, array(
			'type'              => 'option', 
			'transport'     => 'postMessage',
			'capability'     => 'edit_theme_options',
		) );
 
		$control = 
		new WP_Customize_Color_Control(
				$wp_customize, $slug, 
			array(
			'label'         => __( $things['label'], '_sf' ),
			'section'       => $section,
			'priority'      => $count,
			'settings'      => $id
			) 
		);
		$wp_customize->add_control($control); 
		$count++;
	}
}
endif; //! _sf_customize_page
?>