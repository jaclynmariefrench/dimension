<?php
function dimension_customize_header_register($wp_customize) {
    // Header content
    $wp_customize->add_section('header_content_section', array(
        'title' => __('Header Content', 'dimension'),
        'priority' => 30,
    ));

    // Header title
    $wp_customize->add_setting('header_title', array(
        'default' => __('Dimension', 'dimension'),
        'sanitize_callback' => 'sanitize_text_field',
    ));

    // Header title control
    $wp_customize->add_control('header_title', array(
        'label' => __('Header Title', 'dimension'),
        'section' => 'header_content_section',
        'type' => 'text',
    ));

    // Header description
    $wp_customize->add_setting('header_description', array(
        'default' => __('A fully responsive site template designed by HTML5 UP and released for free under the Creative Commons license.', 'dimension'),
        'sanitize_callback' => 'sanitize_textarea_field',
    ));

    // Header description control
    $wp_customize->add_control('header_description', array(
        'label' => __('Header Description', 'dimension'),
        'section' => 'header_content_section',
        'type' => 'textarea',
    ));
    
    // Header logo
    $wp_customize->add_setting('header_logo', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));

    // Header logo control
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'header_logo', array(
        'label' => __('Header Logo', 'dimension'),
        'section' => 'header_content_section',
        'settings' => 'header_logo',
    )));

    //social links section
    $wp_customize->add_section('social_media_section', array(
        'title' => __('Social Media Links', 'dimension'),
        'priority' => 30,
    ));

    // settings and controls for social media links
    $social_networks = array('twitter', 'facebook', 'instagram', 'github', 'linkedin', 'tiktok');

    foreach ($social_networks as $network) {
        $wp_customize->add_setting("{$network}_link", array(
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        ));

        $wp_customize->add_control("{$network}_link", array(
            'label' => ucfirst($network) . ' URL',
            'section' => 'social_media_section',
            'type' => 'url',
        ));
    }

}
add_action('customize_register', 'dimension_customize_header_register');