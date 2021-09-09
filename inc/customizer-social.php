<?php

function gilape_customizer_sections( $wp_customize ) {
		/**
	 * Add panels
	 */
	$wp_customize->add_panel( 'gilape_customizer', array(
		'priority'    => 12,
		'title'       => __( 'Gilape Theme Options', 'gilape' ),
	) );


	/**
	 * Add sections
	 */
     $wp_customize->add_section( 'header_background', array(
 		'title'       => __( 'Social Settings', 'gilape' ),
 		'priority'    => 14,
 		'panel'       => 'gilape_customizer',
 	) ); 

}
add_action( 'customize_register', 'gilape_customizer_sections' );

function gilape_customizer_fields( $fields ) {

   $fields[] = array(
        'type'        => 'url',
        'settings'    => 'facebook',
        'label'       => __( 'Facebook URL', 'gilape' ),
        'section'     => 'header_background',
        'priority'    => 10,
    ); 
	$fields[] = array(
        'type'        => 'url',
        'settings'    => 'twitter',
        'label'       => __( 'Twitter', 'gilape' ),
        'section'     => 'header_background',
        'priority'    => 10,
    );
	$fields[] = array(
        'type'        => 'url',
        'settings'    => 'linkedin',
        'label'       => __( 'Linkedin', 'gilape' ),
        'section'     => 'header_background',
        'priority'    => 10,
    );
	$fields[] = array(
        'type'        => 'url',
        'settings'    => 'pinterest',
        'label'       => __( 'Pinterest', 'gilape' ),
        'section'     => 'header_background',
        'priority'    => 10,
    ); 
	$fields[] = array(
        'type'        => 'url',
        'settings'    => 'instagram',
        'label'       => __( 'Instagram', 'gilape' ),
        'section'     => 'header_background',
        'priority'    => 10,
    ); 

	$fields[] = array(
        'type'        => 'color',
        'settings'    => 'social_color',
        'label'       => __( 'Social Color', 'gilape' ),
        'section'     => 'header_background',
        'priority'    => 11,
		'default'     => '#888',
		'transport'   => 'postMessage',
		'output' => array(
				array(
					'element'  => '.social-network .fa',
					'property' => 'color',
				),
		),
    );
	$fields[] = array(
        'type'        => 'dimension',
		'settings'    => 'social_font_size',
		'label'       => esc_html__( 'Font Size', 'gilape' ),
		'description' => esc_html__( 'Use any font size with size and unit (eg. 36px).', 'gilape' ),
		'section'     => 'header_background',
		'transport'   => 'postMessage',
		'default'     => '36px',
		'output' => array(
				array(
					'element'  => '.social-network .fa',
					'property' => 'font-size',
				),
		),
    );
	
    return $fields;

}
add_filter( 'kirki/fields', 'gilape_customizer_fields' );

?>