<?php
/**
* Home Page Slider Customizer Options
*
* @since _sf 1.1.0
*/
if (! function_exists('_sf_customize_slider') ) :
add_action('customize_register', '_sf_customize_slider');

function _sf_customize_slider() {
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
			'section' => '_sf_home_slider',
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
    	'type' => 'option',
    	)
    );

    $wp_customize->add_control(
    'slide_numb',
    array(
        'type' => 'text',
		'default' => 5,
        'label' => __('Number Of Slides To Show - Default is 5. Enter numbers only.', '_sf'),
        'section' => '_sf_home_slider',
        'sanitize_callback' => '_sf_sanitize_number',
        'settings' => '_sf[slidenumb]',
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
	$wp_customize->add_control( 'cat_select_box', array(
		'settings' => '_sf[slide_cat]',
		'label'   => __('Select Category:', '_sf'),
		'section'  => '_sf_home_slider',
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
		'slug'=>'excerpt_button_bg_color', 
		'default' => ' ',
		'label' => __('Slider Read More Button Background Color', 'sf')
	);
		$slider[] = array(
		'slug'=>'slider_readMore_link_color', 
		'default' => '#1e73be',
		'label' => __('Slider Read More Button Link Color', 'sf')
	);
	$slider[] = array(
		'slug'=>'slider_readMore_linkHvr_color', 
		'default' => '#fff',
		'label' => __('Slider Read More Button Link Hover Color', 'sf')
	);
	$slider[] = array(
		'slug'=>'slider_readMore_linkVstd_color', 
		'default' => '#800080',
		'label' => __('Slider Read More Button Visited Link Color', 'sf')
	);
	
	$count = 5;
	$section = '_sf_home_slider_colors';
	foreach ($slider as $things) {
		
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
endif; //! _sf_customize_slider
?>