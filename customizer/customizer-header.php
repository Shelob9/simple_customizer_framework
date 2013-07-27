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
	//Note section changes to menu later
	$section = '_sf_header_options';
	//  ==============
	//  = Background =
	//  ==============
		$wp_customize->add_setting(
    	'_sf[header_trans_bg]', array(
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
			'priority' => '5',
			'settings' => '_sf[header_trans_bg]',
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
			'priority' => '15',
		)
    );
   
	//header background img
	    $wp_customize->add_setting(
	    '_sf[header_bg_img]', array(
        	'capability'  => 'edit_theme_options',
        	'type' => 'option',
    	)
    );
 
    $wp_customize->add_control( new My_Customize_Image_Reloaded_Control( $wp_customize, 'my_logo', array(
        'label'     => __( 'Logo', 'textdomain' ),
        'section'   => $section,
        'settings'  => '_sf[header_bg_img]',
        'context'   => ''
) ) );
    
    $section = '_sf_menu_options';
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
				'section' => $section,
				'settings' => '_sf[ajaxMenu]',
				'priority' => 7,
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
        'section' => $section,
        'type'     => 'checkbox',
        'priority'	 => '10',
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
        'section' => $section,
        'type'     => 'checkbox',
        'priority'	 => '5',
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
			'section' => $section,
			'type'     => 'checkbox',
			'priority'	=> '200',
		)
    );
    
    //  ==================
    //  = Color Controls =
    //  ==================
    
	$header[] = array(
		'slug'=>'header_bg_color', 
		'default' => '#fff',
		'label' => __('Header Background Color', 'sf'),
		'priority' => 10,
	);
	$menu[] = array(
		'slug'=>'site_name_color', 
		'default' => ' ',
		'label' => __('Site Name Color', 'sf'),
		'priority' => 12,
	);
	$menu[] = array(
		'slug'=>'site_description_color', 
		'default' => ' ',
		'label' => __('Site Description Color', 'sf'),
		'priority' => 13,
	);
	$menu[] = array(
		'slug'=>'menu_text_color', 
		'default' => ' ',
		'label' => __('Menu Text Color', 'sf'),
		
	);
	$menu[] = array(
		'slug'=>'menu_textHvr_color', 
		'default' => ' ',
		'label' => __('Menu Text Hover Color', 'sf'),
		
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
		'label' => __('Search Button Text Color', 'sf'),
		'priority' => 205,
	);
	$menu[] = array(
		'slug'=>'menu_search_txtHvr_color', 
		'default' => '#000',
		'label' => __('Search Button Text Hover Color', 'sf'),
		'priority' => 210,
	);
	$menu[] = array(
		'slug'=>'menu_search_bg_color', 
		'default' => '',
		'label' => __('Search Button Background Color', 'sf'),
		'priority' => 220,
	);
	$menu[] = array(
		'slug'=>'menu_search_bgHvr_color', 
		'default' => '',
		'label' => __('Search Button Background Hover Color', 'sf'),
		'priority' => 225,
	);
	
	$colors = $menu;
	$countStart = 50;
	_sf_customzier_color_loop($colors, $countStart, $section);
	$section = '_sf_header_options';
	$colors = $header;
	_sf_customzier_color_loop($colors, $countStart, $section);
}
endif; //! _sf_customize_header
?>