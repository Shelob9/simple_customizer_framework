<?php
/**
* Content Customizer Options
*
* @since _sf 1.1.0
*/
if (! function_exists('_sf_customize_content') ) :
add_action('customize_register', '_sf_customize_content');

function _sf_customize_content() {
	global $wp_customize;
	$section = '_sf_content_colors';
	//  ==============
	//  = Background =
	//  ==============
	$wp_customize->add_setting(
    	'_sf[content-trans-bg]', array(
    		'type' => 'option',
    		'capability'  => 'edit_theme_options',
    	)
    );

    $wp_customize->add_control(
    	'content-trans-bg',
		array(
			'type' => 'checkbox',
			'label' => 'Use A Background Color For Content Area, If Not Using An Image Background?',
			'section' => $section,
			'priority' => '23',
			'settings' => '_sf[content-trans-bg]',
			)
    );
    
    //Background Color or Image For Content Area?
	$wp_customize->add_setting(
		'_sf[content_bg_choice]', array(
			'capability'  => 'edit_theme_options',
        	'type' => 'option',
        )
	);

    $wp_customize->add_control(
    	'content_bg_choice',
		array(
			'type' => 'checkbox',
			'label' => 'Use Background Image Instead of Color For Content Area?',
			'section' => $section,
			'settings'   => '_sf[content_bg_choice]',
			'priority' => '22',
		)
    );
	//content background img
	    $wp_customize->add_setting(
			'_sf[content_bg_img]', array(
				'capability'  => 'edit_theme_options',
				'type' => 'option'
			)
    	);
 
    $wp_customize->add_control(
    new WP_Customize_Image_Control($wp_customize, 'content_bg_img', array(
        'label'    => __('Upload Background Image For Content Area', 'sf'),
        'section'    => $section,
        'settings' => '_sf[content_bg_img]',
        'priority' => '25',
    )));
	//  ============================
    //  = Disable Infinite Scroll? =
    //  =============================
	$wp_customize->add_setting(
    	'_sf[infScroll]', array(
			'capability'  => 'edit_theme_options',
			'type' => 'option',
		)
    );

    $wp_customize->add_control(
		'infScroll',
		array(
			'type' => 'checkbox',
			'label' => __('Disable Infinite Scroll?', '_sf'),
			'section' => $section,
			'settings' => '_sf[infScroll]'
			)
    );
	
	//  ==================
	//  = Color Controls =
	//  ==================
	$content[] = array(
		'slug'=>'content_bg_color', 
		'default' => '#fff',
		'label' => __('Content Area Background Color', 'sf')
	);
	
	$content[] = array(
		'slug'=>'post_title_color', 
		'default' => '#fff',
		'label' => __('Post Title Color', 'sf')
	);
	$content[] = array(
		'slug'=>'page_title_color', 
		'default' => '#fff',
		'label' => __('Page Title Color', 'sf')
	);
	$content[] = array(
	'slug'=>'content_text_color', 
	'default' => '#000',
	'label' => __('Content Text Color', 'sf')
	);
	$content[] = array(
		'slug'=>'content_link_color', 
		'default' => '#1e73be',
		'label' => __('Page/ Post Link Color', 'sf')
	);
	$content[] = array(
		'slug'=>'content_linkHvr_color', 
		'default' => '#fff',
		'label' => __('Page/ Post Link Hover Color', 'sf')
	);
	$content[] = array(
		'slug'=>'content_linkVstd_color', 
		'default' => '#800080',
		'label' => __('Page/ Post Visited Link Color', 'sf')
	);

	$colors = $content;
	$countStart = 50;
	_sf_customzier_color_loop($colors, $countStart, $section);
	
	//read more button
	$readmore[] = array(
		'slug'=>'excerpt_button_bg_color', 
		'default' => ' ',
		'label' => __('Read More Button Background Color', 'sf')
	);
	$readmore[] = array(
		'slug'=>'content_readMore_link_color', 
		'default' => '#1e73be',
		'label' => __('Read More Button Link Color', 'sf')
	);
	$readmore[] = array(
		'slug'=>'content_readMore_linkHvr_color', 
		'default' => '#fff',
		'label' => __('Read More Button Link Hover Color', 'sf')
	);
	$readmore[] = array(
		'slug'=>'content_readMore_linkVstd_color', 
		'default' => '#800080',
		'label' => __('Read More Button Visited Link Color', 'sf')
	);
	
	
	$countStart = 150;
	_sf_customzier_color_loop($colors, $countStart, $section);
}
endif; //! _sf_customize_content
?>