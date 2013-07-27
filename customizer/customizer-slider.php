<?php
/**
* Home Page Slider Customizer Options
*
* @since _sf 1.1.0
*/
if (! function_exists('_sf_customize_slider') ) :
add_action('customize_register', '_sf_customize_slider');

function _sf_customize_slider() {
	$section = '_sf_home_slider';
	global $wp_customize;
	//  ============================
    //  = Show Slider on Home Page? =
    //  =============================
   
	$wp_customize->add_setting(
    	'_sf[slider_visibility]',
    	array(
    		'capability'  => 'edit_theme_options',
			'type' => 'option',
		)
    );

    $wp_customize->add_control(
		'slider_visibility',
		array(
			'type' => 'checkbox',
			'label' => __('Show Home Page Slider?', '_sf'),
			'section' => $section,
			'priority' => '1',
			'settings' => '_sf[slider_visibility]'
			)
	);
 
    //  ============================
    //  = Number of Slides To Show =
    //  ============================
 
    $wp_customize->add_setting(
    '_sf[slide_numb]', array(
    	'default' => 5,
    	'capability'  => 'edit_theme_options',
    	'type' => 'option',
    	)
    );

    $wp_customize->add_control(
    'slide_numb',
    array(
        'type' => 'text',
		'default' => 5,
        'label' => __('Number Of Slides To Show - Default is 5. Enter numbers only.', '_sf'),
        'section' => $section,
        'sanitize_callback' => '_sf_sanitize_number',
        'settings' => '_sf[slide_numb]',
        )
    );
   
   	// ==========================
   	// = Which Category To Show = 
   	// ==========================
   	
 	//create category dropdown
    $categories = get_categories();
	$cats = array();
	$i = 0;
	foreach($categories as $category){
		if($i==0){
			$default = $category->slug;
			$i++;
		}
		$cats[$category->slug] = $category->name;
	}
 
	$wp_customize->add_setting('_sf[slide_cat]', array(
		'default'        => $default,
		'capability'  => 'edit_theme_options',
		'type' => 'option',
		)
	);
	$wp_customize->add_control( 'slide_cat', array(
		'settings' => '_sf[slide_cat]',
		'label'   => __('Select Category:', '_sf'),
		'section' => $section,
		'type'    => 'select',
		'choices' => $cats,
	));

	// =================
	// = Slider Colors =
	// =================

	$slider[] = array(
		'slug'=>'slider_bg_color', 
		'default' => '',
		'label' => __('Slider Background Color', 'sf'),
	);
	$slider[] = array(
		'slug'=>'slider_title_color', 
		'default' => '#',
		'label' => __('Slider Post Title Color', 'sf'),

	);
	$slider[] = array(
		'slug'=>'slider_excerpt_text_color',
		'default' => '',
		'label' => __('Slider Excerpt Color', '_sf'),
	);
		//read more button
	$slider[] = array(
		'slug'=>'slider_readMore_bg_color', 
		'default' => ' ',
		'label' => __('Slider Read More Button Background Color', 'sf')
	);
		$slider[] = array(
		'slug'=>'slider_readMore_link_color', 
		'default' => '#1e73be',
		'label' => __('Slider Read More Button Text Color', 'sf')
	);
	$slider[] = array(
		'slug'=>'slider_readMore_linkHvr_color', 
		'default' => '#fff',
		'label' => __('Slider Read More Button Link Text Color', 'sf')
	);
	$slider[] = array(
		'slug'=>'slider_readMore_linkVstd_color', 
		'default' => '#800080',
		'label' => __('Slider Read More Button Visited Text Color', 'sf')
	);
	
	$colors = $slider;
	$countStart = 50;
	_sf_customzier_color_loop($colors, $countStart, $section);
}
endif; //! _sf_customize_slider
?>