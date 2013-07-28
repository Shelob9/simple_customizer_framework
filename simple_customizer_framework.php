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

/**
* Dearest end user, please define these variables.
*/
//the location of the folder containing this file relative to theme folder.
$dir = 'options';
//the names of settings files to be included, the example file is included as an example.
//seperate values with commas
$optionsList = array('scc-example.php');



/**
* Get everything toghehter (sections, settings and sections.)
*
* @since scf 0.1
*/

//set the path
$scf_path = trailingslashit( get_template_directory() ).trailingslashit( $dir);
//load the customzier functions
include_once($scf_path.'/customizer/customizer.php');
//load the sanitization file
include_once($scf_path.'/customizer/customizer-sanitizer.php');
//load the sections file
include_once($scf_path.'scf-sections.php');
//load the actual controls/settings we need IE: the point of this
foreach ($optionsList as $options) {
	include_once($scf_path.'/settings/'.$options);
}
