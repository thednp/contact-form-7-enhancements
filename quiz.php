<?php
/**
** A reworked module for [quiz]
**/

/* form_tag handler */

add_action( 'wpcf7_init', 'dnp_add_form_tag_quiz' );

if (!function_exists('dnp_add_form_tag_quiz')) {
	function dnp_add_form_tag_quiz() {
		wpcf7_add_form_tag( 'quiz', 'dnp_quiz_form_tag_handler', true );
	}
}

if (!function_exists('dnp_quiz_form_tag_handler')) {
	function dnp_quiz_form_tag_handler( $tag ) {
		$tag = new WPCF7_FormTag( $tag );

		if ( empty( $tag->name ) ) {
			return '';
		}

		$validation_error = wpcf7_get_validation_error( $tag->name );

		$class = wpcf7_form_controls_class( $tag->type );

		if ( $validation_error ) {
			$class .= ' wpcf7-not-valid';
		}

		$atts = array();

		$atts['size'] = $tag->get_size_option( '40' );
		$atts['maxlength'] = $tag->get_maxlength_option();
		$atts['minlength'] = $tag->get_minlength_option();

		if ( $atts['maxlength'] && $atts['minlength'] && $atts['maxlength'] < $atts['minlength'] ) {
			unset( $atts['maxlength'], $atts['minlength'] );
		}

		$atts['class'] = $tag->get_class_option( $class );
		$atts['id'] = $tag->get_id_option();
		$atts['tabindex'] = $tag->get_option( 'tabindex', 'int', true );
		$atts['autocomplete'] = 'off';
		$atts['aria-required'] = 'true';
		$atts['aria-invalid'] = $validation_error ? 'true' : 'false';

		$pipes = $tag->pipes;

		if ( $pipes instanceof WPCF7_Pipes && ! $pipes->zero() ) {
			$pipe = $pipes->random_pipe();
			$question = $pipe->before;
			$answer = $pipe->after;
		} else {
			// default quiz
			$question = '1+1=?';
			$answer = '2';
		}

		$answer = wpcf7_canonicalize( $answer );

		$atts['type'] = 'text';
		$atts['name'] = $tag->name;

		if ( $tag->has_option( 'placeholder' ) || $tag->has_option( 'watermark' ) ) {
			$atts['placeholder'] = $question;
			$question = '';
			$template = '<span class="wpcf7-form-control-wrap %1$s"><input %3$s /><input type="hidden" name="_wpcf7_quiz_answer_%4$s" value="%5$s" />%6$s</span>';
		} else {
			$template = '<span class="wpcf7-form-control-wrap %1$s"><span class="wpcf7-quiz-label">%2$s</span><input %3$s /><input type="hidden" name="_wpcf7_quiz_answer_%4$s" value="%5$s" />%6$s</span>';		
		}
		
		$atts = wpcf7_format_atts( $atts );

		$html = sprintf(
			$template,
			sanitize_html_class( $tag->name ),
			esc_html( $question ), $atts, $tag->name,
			wp_hash( $answer, 'wpcf7_quiz' ), $validation_error );

		return $html;
	}
}
