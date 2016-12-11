<?php
/**
** A reworked base module for [submit]
**/

/* Shortcode handler */

add_action( 'wpcf7_init', 'dnp_cf7_add_shortcode_submit' );

function dnp_cf7_add_shortcode_submit() {
	wpcf7_add_form_tag( 'submit', 'dnp_cf7_submit_shortcode_handler' );
}

function dnp_cf7_submit_shortcode_handler( $tag ) {
	$tag = new WPCF7_Shortcode( $tag );

	$class = wpcf7_form_controls_class( $tag->type );

	$atts = array();

	$atts['class'] = $tag->get_class_option( $class );
	$atts['id'] = $tag->get_id_option();
	$atts['tabindex'] = $tag->get_option( 'tabindex', 'int', true );

	$value = isset( $tag->values[0] ) ? $tag->values[0] : '';

	if ( empty( $value ) )
		$value = __( 'Send', 'cf7e' );

	$atts['type'] = 'submit';
	$atts['value'] = $value;

	$atts = wpcf7_format_atts( $atts );

	//$html = sprintf( '<input %1$s />', $atts );
	$html = '<button ' . $atts . '>' . esc_attr( $value ) .  '</button>';

	return $html;
}


/* Tag generator */

add_action( 'admin_init', 'dnp_cf7_add_tag_generator_submit', 55 );

function dnp_cf7_add_tag_generator_submit() {
	if ( ! function_exists( 'wpcf7_add_tag_generator' ) )
		return;

	wpcf7_add_tag_generator( 'submit', __( 'Submit button', 'cf7e' ),
		'wpcf7-tg-pane-submit', 'dnp_cf7_tg_pane_submit', array( 'nameless' => 1 ) );
}

function dnp_cf7_tg_pane_submit( $contact_form ) {
?>
<div id="wpcf7-tg-pane-submit" class="hidden">
<form action="">
<table>
<tr>
<td><code>id</code> (<?php echo esc_html( __( 'optional', 'cf7e' ) ); ?>)<br />
<input type="text" name="id" class="idvalue oneline option" /></td>

<td><code>class</code> (<?php echo esc_html( __( 'optional', 'cf7e' ) ); ?>)<br />
<input type="text" name="class" class="classvalue oneline option" /></td>
</tr>

<tr>
<td><?php echo esc_html( __( 'Label', 'cf7e' ) ); ?> (<?php echo esc_html( __( 'optional', 'cf7e' ) ); ?>)<br />
<input type="text" name="values" class="oneline" /></td>

<td></td>
</tr>
</table>

<div class="tg-tag"><?php echo esc_html( __( "Copy this code and paste it into the form left.", 'cf7e' ) ); ?><br /><input type="text" name="submit" class="tag wp-ui-text-highlight code" readonly="readonly" onfocus="this.select()" /></div>
</form>
</div>
<?php
}
