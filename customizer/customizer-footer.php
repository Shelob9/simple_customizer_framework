<?php
/**
* Sidebar Customizer Options
*
* @since _sf 1.1.0
*/
if (! function_exists('_sf_customize_footer') ) :
add_action('customize_register', '_sf_customize_footer');

function _sf_customize_footer() {
	//todo: creditlink/additional text options
	
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
			'section' => '_sf_background_options',
			'priority' => '5',
			'settings' => '_sf[footer-trans-bg]',
			)
    );
	//  ==================
	//  = Color Controls =
	//  ==================
	$footer[] = array(
		'slug'=>'footer_bg_color', 
		'default' => '#000',
		'label' => __('Footer Background Color', 'sf'),
		'priority' => '1',
	);
	$footer[] = array(
		'slug'=>'footer_text_color', 
		'default' => '#fff',
		'label' => __('Footer Text Color', 'sf')
	);
	$footer[] = array(
		'slug'=>'footer_link_color', 
		'default' => '#1e73be',
		'label' => __('Footer Link Color', 'sf')
	);
	$footer[] = array(
		'slug'=>'footer_linkHvr_color', 
		'default' => '#fff',
		'label' => __('Footer Link Hover Color', 'sf')
	);
	$footer[] = array(
		'slug'=>'footer_linkVstd_color', 
		'default' => '#800080',
		'label' => __('Footer Visited Link Color', 'sf')
	);

	$section = '_sf_footer_options';
	$count = 10;
	foreach ($footer as $things) {
		$slug = $things['slug'];
		$id = "_sf[{$slug}]";
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
		) );
 
		$control = 
		new WP_Customize_Color_Control(
				$wp_customize, $slug, 
			array(
			'label'         => __( $things['label'], '_sf' ),
			'section'       => $section,
			'priority'      => $priority,
			'settings'      => $id
			) 
		);
		$wp_customize->add_control($control); 
		$count++;
	}
	
}
endif; //! _sf_customize_footer
?>