<?php
/**
 * I am the sanitizer of customizer inputs!
 * since _sf 1.0.5.1
 */

/**
 * adds sanitization callback function : textarea
 * @since _sf 1.0.5.1
 */
 if(!function_exists('_sf_sanitize_textarea')) :
	function _sf_sanitize_textarea($value) {
		$value = esc_textarea( $value);
		return $value;
	}
endif;


/**
 * adds sanitization callback function : number
 * @since _sf 1.0.5.1
 */
 if(!function_exists('_sf_sanitize_number')) :
	function _sf_sanitize_number($value) {
		$value = esc_attr( $value); // clean input
		$value = (int) $value; // Force the value into integer type.
   		return ( 0 < $value ) ? $value : null;
	}
endif;

/**
 * adds sanitization callback function : url
 * @since _sf 1.0.5.1
 */
if(!function_exists('_sf_sanitize_url')) :
	function _sf_sanitize_url($value) {
		$value = esc_url( $value);
		return $value;
	}
endif;


?>