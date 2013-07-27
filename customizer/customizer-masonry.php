<?php
/**
* Masonry Customizer Options
*
* @since _sf 1.1.0
*/
if (! function_exists('_sf_customize_masonry') ) :
add_action('customize_register', '_sf_customize_masonry');

function _sf_customize_masonry() {
    //TODO: seperate settings for mobile.
    
    global $wp_customize;
	$section = '_sf_masonry_options';
   //enable/disable?
	$wp_customize->add_setting(
    	'_sf[masonry]', array(
			'capability'  => 'edit_theme_options',
    		'type' => 'option',
    	)
    );

    $wp_customize->add_control(
		'masonry',
		array(
			'type' => 'checkbox',
			'label' => __('Disable Masonry?', '_sf'),
			'section' => '_sf_masonry_options',
			'priority' => 3,
			'settings' => '_sf[masonry]',
			)
    );
    
    //How many bricks Wide?
    $wp_customize->add_setting(
    	'_sf[masonry_how_many]',
    		array(
    			'default'	=> '4',
    			'capability'  => 'edit_theme_options',
        		'type' => 'option',
    		)
    );
    
    $wp_customize->add_control(
    	'masonry_how_many',
    	array(
    		'type' => 'text',
    		'label' => __('How Many Bricks Per Row', '_sf'),
    		'priority' => '10',
    		'section' => '_sf_masonry_options',
    		'settings' => '_sf[masonry_how_many]',
    		'callback' => '_sf_sanitize_number',
    	)
    );
    
 	//show excerpt
 	$wp_customize->add_setting(
   	 '_sf[masonry_excerpt]',
   	 	array(
   			'default'	=> '',
   			'capability'  => 'edit_theme_options',
			'type' => 'option',
		)
    );

    $wp_customize->add_control(
    	'masonry_excerpt',
		array(
			'type' => 'checkbox',
			'label' => __('Show Excerpt In Masonry Box?', '_sf'),
			'section' => '_sf_masonry_options',
			'settings' => '_sf[masonry_excerpt]',
			'priority' => '20',
			)
    );
    
    //How long is excerpt?
    $wp_customize->add_setting(
   		'_sf[masonry_excerpt_length]',
   		array(
   			'default'	=> '10',
   			'capability'  => 'edit_theme_options',
        	'type' => 'option',
   		)
   	);
   	
   	$wp_customize->add_control(
   		'masonry_excerpt_length',
   		array (
   			'type' => 'text',
   			'label' => __('Masonry Excerpt Length (enter numbers only)', '_sf'),
   			'section' => '_sf_masonry_options',
   			'callback' => '_sf_sanitize_number',
   			'settings' => '_sf[masonry_excerpt_length]',
   			'priority' => '25',
   			)
   	);
   	
    //masonry colors
	$masonry[] = array(
		'slug'=>'masonry_bg_color', 
		'default' => '#fff',
		'label' => __('Background Color', '_sf'),
		'priority' => 30,
	);
	$masonry[] = array(
	'slug'=>'masonry_excerpt_text_color', 
	'default' => ' ',
	'label' => __('Excerpt Text Color', '_sf'),
	'priority' => 27,
	);
	$masonry[] = array(
		'slug'=>'masonry_title_color', 
		'default' => ' ',
		'label' => __('Title Color', '_sf'),
		'priority' => 15,
	);
	$masonry[] = array(
		'slug'=>'masonry_border_color', 
		'default' => ' ',
		'label' => __('Border Color', '_sf'),
		'priority' => 35,
	);
	
	$colors = $masonry;
	$countStart = 50;
	_sf_customzier_color_loop($colors, $countStart, $section);
}
endif; //! _sf_customize_masonry
?>