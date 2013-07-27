<?php
/**
* Header Customizer Options
*
* @since _sf 1.1.0
*/
if (! function_exists('_sf_customize_header') ) :
add_action('customize_register', '_sf_customize_header');

function _sf_customize_header() {
	global $wp_customize;
	$section = '_sf_header_colors';
	//  ==============
	//  = Background =
	//  ==============
		$wp_customize->add_setting(
    	'_sf[header-trans-bg]', array(
    		'type' => 'option',
    		'capability'  => 'edit_theme_options',
    	)
    );

    $wp_customize->add_control(
		'header-trans-bg',
		array(
			'type' => 'checkbox',
			'label' => 'Use A Background Color For Header Area, If Not Using An Image Background?',
			'section' => $section,
			'priority' => '13',
			'settings' => '_sf[header-trans-bg]',
			)
    );
    
    //Background Color or Image For Header?
	$wp_customize->add_setting(
		'_sf[header_bg_choice]', array(
			'capability'  => 'edit_theme_options',
        	'type' => 'option',
    	)
	 );

    $wp_customize->add_control(
    	'header_bg_choice',
		array(
			'type' => 'checkbox',
			'label' => 'Use Background Image Instead of Color For Header?',
			'section' => $section,
			'settings'   => '_sf[header_bg_choice]',
			'priority' => '12',
		)
    );
	//header background img
	    $wp_customize->add_setting(
	    '_sf[header_bg_img]', array(
        	'capability'  => 'edit_theme_options',
        	'type' => 'option',
    	)
    );
 
    $wp_customize->add_control(
		new WP_Customize_Image_Control($wp_customize, 'header_bg_img', array(
			'label'    => __('Upload Background Image For Header', 'sf'),
			'section'    => '_sf_background_options',
			'settings' => '_sf[header_bg_img]',
			'priority' => '15',
	)));
    
    //  ============================
    //  = Disable AJAX Page Loads? =
    //  ============================
	$wp_customize->add_setting(
    	'_sf[ajaxMenu]', array(
    		'type' => 'option',
    		'capability'  => 'edit_theme_options',
    	)
    );

    $wp_customize->add_control(
		'ajaxMenu',
			array(
				'type' => 'checkbox',
				'label' => __('Disable AJAX Page Loads?', '_sf'),
				'section' => '_sf_page_options',
				'settings' => '_sf[ajaxMenu]',
			)
    );
    
	//  ======================
    //  = Site Name In Menu? =
    //  ======================
    $wp_customize->add_setting('_sf[name_in_menu]',
    	 array(
        	'capability' => 'edit_theme_options',
    		'type' => 'option',
    	)
    );
 
    $wp_customize->add_control('name_in_menu', array(
        'settings' => '_sf[name_in_menu]',
        'label'    => __('Don\'t display Name of site in Menu?', '_sf'),
        'section'  => '_sf_header_options',
        'type'     => 'checkbox',
        'priority'	 => '5',
    ));
    
 	//  ================
    //  = Menu Sticky? =
    //  ================
    $wp_customize->add_setting('_sf[menu_sticky]',
    	array(
			'capability' => 'edit_theme_options',
			'type' => 'option',
		)
    );
 
    $wp_customize->add_control('menu_sticky', array(
        'settings' => '_sf[menu_sticky]',
        'label'    => __('Stick Menu To Top Of Page?', '_sf'),
        'section'  => '_sf_header_options',
        'type'     => 'checkbox',
        'priority'	 => '10',
    ));
    
    //  ======================
    //  = Search Bar In Menu =
    //  ======================
    $wp_customize->add_setting(
		'_sf[menu_search]', array(
			'capability' => 'edit_theme_options',
			'type' => 'option',
			)
	);
 
    $wp_customize->add_control('menu_search',
		array(
			'settings' => '_sf[menu_search]',
			'label'    => __('Search Bar In Menu?', '_sf'),
			'section'  => '_sf_header_options',
			'type'     => 'checkbox',
			'priority'	=> '15',
		)
    );
    
    //  ==================
    //  = Color Controls =
    //  ==================
    
	$menu[] = array(
		'slug'=>'header_bg_color', 
		'default' => '#fff',
		'label' => __('Header Background Color', 'sf')
	);
	$menu[] = array(
		'slug'=>'site_name_color', 
		'default' => ' ',
		'label' => __('Site Name Color', 'sf'),
	);
	$menu[] = array(
		'slug'=>'site_description_color', 
		'default' => ' ',
		'label' => __('Site Description Color', 'sf')
	);
	$menu[] = array(
		'slug'=>'menu_text_color', 
		'default' => ' ',
		'label' => __('Menu Text Color', 'sf'),
		
	);
	$menu[] = array(
		'slug'=>'menu_bg_color', 
		'default' => ' ',
		'label' => __('Menu Background Color', 'sf')
	);
	$menu[] = array(
		'slug'=>'menu_hover_color', 
		'default' => ' ',
		'label' => __('Menu Background Hover Color', 'sf')
	);
	$menu[] = array(
		'slug'=>'menu_search_txt_color', 
		'default' => '#fff',
		'label' => __('Search Button Text Color', 'sf')
	);
	$menu[] = array(
		'slug'=>'menu_search_bg_color', 
		'default' => '',
		'label' => __('Search Button Background Color', 'sf')
	);
	$menu[] = array(
		'slug'=>'menu_search_bg_color_hv', 
		'default' => '',
		'label' => __('Search Button Background Hover Color', 'sf')
	);
	
	$colors = $menu;
	$countStart = 5;
	_sf_customzier_color_loop($colors, $countStart, $section);
}
endif; //! _sf_customize_header
?>