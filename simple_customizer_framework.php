<?php
/*
*
* Simple Customizer Framework
*
* @since scf 0.1
* Began life in _Second Foundation (1.1.0) WordPress theme
*
* Copyright 2013 Josh Pollock (ComplexWaveform.com)
* Licensed under the terms of the gnu public license version 3.
*
* Thanks:
	* Otto for his awesome theme customizer tutorials and help via wordpress.stackexchange.com
	* /u/emptyemptyempty0/ for help via /r/phphelp
*/

class simple_customzier_framework{
	/**
	* Dearest end user, please define these variables.
	*/
	//the location of the folder containing this file relative to theme folder.
	public $dir = 'options';
	//the names of settings files to be included, the example file is included as an example.
	//seperate values with commas
	var $optionsList = array('scf-example.php');
	//set your theme slug.
	//todo: this/implement it.
	
	/**
	* END USER: Nothing below this line needs to be messed with for normal operation.
	*/
	
	//create $customizerData to carry the css info on to the header and preview js
	public $customizerData = array();
	
	/**
     * Class Constructor
     */
    function __construct() {
        $this->paths();
        $this->setup_actions();
    }
    
     /**
     * Define Path(s)
     *
	 * @package scf
	 * @since 0.1
     */
    function paths(){
        define( 'SCF_PATH',  get_template_directory() .'/options' );
    }
    
    /**
    * Setup Actions
    *
	* @package scf
	* @since 0.1
    */
    function setup_actions() {
    	add_action( 'admin_menu', array($this, 'add_options_menu') );
		add_action( 'wp_before_admin_bar_render', array($this, 'add_admin_bar_options_menu') );
		add_action(	'wp_enqueue_scripts', array($this, 'localize_customizer') );
		add_action( 'wp_head', array($this, 'auto_style') );
		add_action( 'customize_register', array($this, 'customzier_color_loop' ) );
		add_action( 'tha_header_after', array($this, 'data_dump') );
		add_action( 'init', array($this, 'make_data') );
	}
	
	*/
	/**
	* Binds JS handlers to make Theme Customizer preview reload changes asynchronously with customizer.js
	* Also localize the customizer options so they can be added dynamically in customizer.js
	*
	* @package scf
	* @since 0.1
	*/
	function localize_customizer() {
		//deregister twentytwelves theme customizer js. Need a more unviersal way to do this.
		wp_deregister_script('twentytwelve-customizer');
		$handle = 'customizer-preview';
		$src = SCF_PATH.'/js/customizer.js';
		//$src = get_template_directory_uri().'/options/js/customizer.js';
		$deps = array( 'jquery' );
		$ver = 1;
		$in_footer = true;
		wp_enqueue_script( $handle, $src, $deps, $ver, $in_footer );
		//localize script with the css bits we need
		wp_localize_script(	$handle, 'custStyle', $this->customizerData);
	}
	
	/**
	* Add links to Customizer
	*
	* @package scf
	* @since 0.1
	*/
	function add_options_menu() {
	//Add WordPress customizer page to the admin menu.
		$theme_page = add_theme_page(
			__( 'Customize Theme', 'scf' ),   // Name of page
			__( 'Customize Theme', 'scf' ),   // Label in menu
			'edit_theme_options',          // Capability required
			'customize.php'             // Menu slug, used to uniquely identify the page
		);
	}
	
	//Add WordPress customizer page to the admin bar menu.
	function add_admin_bar_options_menu() {
	   if ( current_user_can( 'edit_theme_options' ) ) {
		 global $wp_admin_bar;
		 $wp_admin_bar->add_menu( array(
		   'parent' => false,
		   'id' => 'theme_editor_admin_bar',
		   'title' =>  __( 'Customize Theme', 'scf' ),
		   'href' => admin_url( 'customize.php')
		 ));
	   }
	}
	
	/**
	* Populate $customizerData
	*
	* @package scf
	* @since 0.1
	*/
	
	function make_data() {
		//get the settings
		//TOD: get this from the array on 25 instead of hardcoding
		include(SCF_PATH.'/settings/scf-example.php');
		//start the counter at 10 or whatever was set.
		$count = $countStart;
		foreach ($colors as $things) {
			$slug = $things['slug'];
			$id = "scf[{$slug}]";
			//If current array has a priority set, use it, if not use the counter.
			if (! isset($things['priority']) ) {
				$priority = $count;
			}
			else {
				$priority = $things['priority'];
			}
			//get current value
			$options = get_option('scf');
			$value = $options[$slug];
			$this->customizerData[] = array(
				'id' 			=> $id,
				'slug' 			=> $slug, 
				'selector' 		=> $things['selector'],
				'property'		 => $things['property'],
				'default' 		=> $things['default'],
				'label'         => __( $things['label'], $theme_slug ),
				//'section'       => $sectionName,
				'section'		=> 'colors',
				'priority'      => $priority,
				'settings'      => $id,
				'value'			=> $value,
			);
		
			//advance priority counter
			$count++;
		}
	}
	
	
	/**
	* Customizer Color Control Loop
	*
	*
	* @package scf
	* @since 0.1
	*/
	
	public function customzier_color_loop() {
		//Not sure why I have to do this first thing
		global $wp_customize;
		
		//CREATE SECTIONS
		//include sections
		include(SCF_PATH.'/scf-sections.php');
		//set counter for priorities at 100
		$count = 100;
		//make the sections happen
		foreach ($sections as $section) {
			//If current item has a priority set, use it, if not use the counter.
			if (! isset($section['priority']) ) {
				$priority = $count;
			}
			else {
				$priority = $section['priority'];
			}
			//make the sections id from theme slug and setting slug and put it in $id
			$id = 'scf_'.$section['slug'];
		
			//create the section
			$wp_customize->add_section($id, array(
				'title'    => __($section['label'], 'scf'),
				'priority' => $priority,
			));
			//increase the counter
			$count++;
		}
		
		//CREATE CONTROLS AND SETTINGS
		foreach ($this->customizerData as $things) {
			$wp_customize->add_setting( $things['id'], array(
				'type'              => 'option', 
				'transport'     => 'postMessage',
				'capability'     => 'edit_theme_options',
				'default' 		=> $things['default'],
			) );
			$control = 
			new WP_Customize_Color_Control(
					$wp_customize, $slug, 
				array(
				'label'         => $things['label'],
				'section'       => $things['section'],
				'priority'      => $things['priority'],
				'settings'      => $things['id'],
				) 
			);
			$wp_customize->add_control($control);
		}
		
		
	}
	/**
	* Output styles set in customizer in header dynamically
	*
	* @package scf
	* @since scf 0.1
	*/
	public function auto_style() {
		//create the css by looping through $customizerData
		//create $return to be populated in this loop
		$return = '';
		foreach ($this->customizerData as $data) {
			$return .= $data['selector'];
			$return .= "{";
			$return .= $data['property'].":";
			$return .= $data['value'].";} ";
		}
		//echos
		echo "<!-- Simple Customizer Framework :) -->";
		echo "<style>";
		echo $return;
		echo "</style>";
	}
	
	/**
	* For diagnostic purposes: var_dump customizerData at end of header
	* Presumes: Theme Hook Alliance hooks are in use.
	* Note: action is disabled by default.
	*
	* @package scf
	* @since v0.1
	*/
	
	public function data_dump() {
		var_dump($this->customizerData);
	}

}

$simple_customzier_framework = new simple_customzier_framework;
?>