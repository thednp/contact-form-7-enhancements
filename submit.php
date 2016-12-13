<?php
/**
** A reworked base module for [submit]
**/

/* form_tag handler */

add_action( 'wpcf7_init', 'dnp_add_form_tag_submit' );

if (!function_exists('dnp_add_form_tag_submit')) {
	function dnp_add_form_tag_submit() {
		wpcf7_add_form_tag( 'submit', 'dnp_submit_form_tag_handler' );
	}
}	


if (!function_exists('dnp_submit_form_tag_handler')) {
	function dnp_submit_form_tag_handler( $tag ) {
		$tag = new WPCF7_FormTag( $tag );

		$class = wpcf7_form_controls_class( $tag->type );

		$atts = array();

		$atts['class'] = $tag->get_class_option( $class );
		$atts['id'] = $tag->get_id_option();
		$atts['tabindex'] = $tag->get_option( 'tabindex', 'int', true );

		$value = isset( $tag->values[0] ) ? $tag->values[0] : '';

		if ( empty( $value ) ) {
			$value = __( 'Send', 'cf7e' );
		}

		$atts['type'] = 'submit';
		$atts['value'] = $value;

		$atts = wpcf7_format_atts( $atts );

		$html = '<button ' . $atts . '>' . esc_attr( $value ) .  '</button>';

		return $html;
	}
}
