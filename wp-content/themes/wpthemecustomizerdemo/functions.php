<?php

function tcx_register_theme_customizer($wp_customize)
{

    //Using existing color section in customizer, to add setting.

    // add setting
    $wp_customize->add_setting(
        'tcx_link_color',
        array(
            'default' => '#000000',
            'transport'   => 'postMessage'  // trasnpot method
        )
    );

    // append control to setting
    $wp_customize->add_control(
        new WP_Customize_Color_Control(
            $wp_customize,
            'link_color',
            array(
                'label' => __('Link Color', 'tcx'),
                'section' => 'colors',
                'settings' => 'tcx_link_color',
            )
        )
    );

    // Add new section 

    $wp_customize->add_section(
        'tcx_display_options',
        array(
            'title'     => 'Display Options',
            'priority'  => 200
        )
    );

    // display header : Display Options
    $wp_customize->add_setting(
        'tcx_display_header',
        array(
            'default'    =>  'true',
            'transport'  =>  'postMessage'
        )
    );

    $wp_customize->add_control(
        'tcx_display_header',
        array(
            'section'   => 'tcx_display_options',
            'label'     => 'Display Header?',
            'type'      => 'checkbox'
        )
    );

    // inverse color scheme functionality : Display Options
    $wp_customize->add_setting(
        'tcx_color_scheme',
        array(
            'default'   => 'normal',
            'transport' => 'postMessage'
        )
    );
     
    $wp_customize->add_control(
        'tcx_color_scheme',
        array(
            'section'  => 'tcx_display_options',
            'label'    => 'Color Scheme',
            'type'     => 'radio',
            'choices'  => array(
                'normal'    => 'Normal',
                'inverse'   => 'Inverse'
            )
        )
    );

    // add a font : Display Options
    $wp_customize->add_setting(
        'tcx_font',
        array(
            'default'   => 'times',
            'transport' => 'postMessage'
        )
    );

    $wp_customize->add_control(
        'tcx_font',
        array(
            'section'  => 'tcx_display_options',
            'label'    => 'Theme Font',
            'type'     => 'select',
            'choices'  => array(
                'times'     => 'Times New Roman',
                'arial'     => 'Arial',
                'courier'   => 'Courier New'
            )
        )
    );

    // add a footer copyright message : Display Options
    // new sanitize_callback
    $wp_customize->add_setting(
        'tcx_footer_copyright_text',
        array(
            'default'            => 'All Rights Reserved',
            'sanitize_callback'  => 'tcx_sanitize_copyright',
            'transport'          => 'postMessage'
        )
    );

    $wp_customize->add_control(
        'tcx_footer_copyright_text',
        array(
            'section'  => 'tcx_display_options',
            'label'    => 'Copyright Message',
            'type'     => 'text'
        )
    );

    // Add a new section

    $wp_customize->add_section(
        'tcx_advanced_options',
        array(
            'title'     => 'Advanced Options',
            'priority'  => 201
        )
    );

    // background image : Display Options

    $wp_customize->add_setting(
        'tcx_background_image',
        array(
            'default'      => '',
            'transport'    => 'postMessage'
        )
    );

    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'tcx_background_image',
            array(
                'label'    => 'Background Image',
                'settings' => 'tcx_background_image',
                'section'  => 'tcx_advanced_options'
            )
        )
    );
    

}
add_action('customize_register', 'tcx_register_theme_customizer');

function tcx_customizer_css()
{
    ?>
    <style type="text/css">
        body{
        <?php if ( 'normal' === get_theme_mod( 'tcx_color_scheme' ) ) { ?>
            background: #fff;
            color:      #000;
        <?php } else { ?>
            background: #000;
            color:      #fff;
        <?php } ?>
        font-family: <?php echo get_theme_mod( 'tcx_font' ); ?>;
        <?php if ( 0 <  strlen( ( $background_image_url = get_theme_mod( 'tcx_background_image' ) ) ) ) { ?>
            background-image: url( <?php echo $background_image_url; ?> );
        <?php } // end if ?>
        }
        a { color: <?php echo get_theme_mod('tcx_link_color'); ?>; }
        <?php if( false === get_theme_mod( 'tcx_display_header' ) ) { ?>
            #header { display: none; }
        <? } ?>
    </style>
    <?php
}
add_action('wp_head', 'tcx_customizer_css');

function tcx_customizer_live_preview() {
 
    wp_enqueue_script(
        'tcx-theme-customizer',
        get_template_directory_uri() . '/js/theme-customizer.js',
        array( 'jquery', 'customize-preview' ),
        '0.3.0',
        true
    );
 
}
add_action( 'customize_preview_init', 'tcx_customizer_live_preview' );


function tcx_sanitize_copyright( $input ) {
    return strip_tags( stripslashes( $input ) );
}