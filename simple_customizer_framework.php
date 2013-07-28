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
	var $dir = 'options';
	//the names of settings files to be included, the example file is included as an example.
	//seperate values with commas
	var $optionsList = array('scf-example.php');
	//set your theme slug.
	//todo: this/implement it.

	
	/**
     * Class Constructor
     */
    function __construct() {
        $this->paths();
        $this->setup_actions();
    }
    
     /**
     * Define Path(s)
     */
    function paths(){
        define( 'SCF_PATH', trailingslashit( get_template_directory() ).trailingslashit( $dir) );
    }
    
    /**
    * Setup Actions
    */
    function setup_actions() {
    	add_action('admin_menu', array($this, 'add_options_menu') );
		add_action( 'wp_before_admin_bar_render', array($this, 'add_admin_bar_options_menu') );
		add_action(	'wp_enqueue_scripts', array($this, 'localize_customizer') );
		//add_action(	'admin_init', array($this, 'localize_shit') );
	}
	
	/**
	* Include shit
	*/
	function include_shit() {
	//include_once(SCF_PATH.'/customizer/customizer.php');
	//load the sanitization file
	include_once(SCF_PATH.'/customizer/customizer-sanitizer.php');
	//load the sections file
	include_once(SCF_PATH.'scf-sections.php');
	//load the actual controls/settings we need IE: the point of this
		foreach ($optionsList as $options) {
			include_once(SCF_PATH.'/settings/'.$options);
		}
	}
	/**
	* Binds JS handlers to make Theme Customizer preview reload changes asynchronously with customizer.js
	* Also localize the customizer options so they can be added dynamically in customizer.js
	*
	* @since scf 1.1.0
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
		wp_localize_script(	$handle, 'custStyle', $customizerData);
	}
	
	/**
	* Add links to Customizer
	* @since _sf 1.0.5.1
	* @since scf 0.1
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

}

$simple_customzier_framework = new simple_customzier_framework;
?>