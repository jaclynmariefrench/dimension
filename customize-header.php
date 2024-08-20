<?php
function dimension_customize_register($wp_customize) {
    // Add section for header content
    $wp_customize->add_section('header_content_section', array(
        'title' => __('Header Content', 'dimension'),
        'priority' => 30,
    ));

    // Add setting for header title
    $wp_customize->add_setting('header_title', array(
        'default' => __('Dimension', 'dimension'),
        'sanitize_callback' => 'sanitize_text_field',
    ));

    // Add control for header title
    $wp_customize->add_control('header_title', array(
        'label' => __('Header Title', 'dimension'),
        'section' => 'header_content_section',
        'type' => 'text',
    ));

    // Add setting for header description
    $wp_customize->add_setting('header_description', array(
        'default' => __('A fully responsive site template designed by HTML5 UP and released for free under the Creative Commons license.', 'dimension'),
        'sanitize_callback' => 'sanitize_textarea_field',
    ));

    // Add control for header description
    $wp_customize->add_control('header_description', array(
        'label' => __('Header Description', 'dimension'),
        'section' => 'header_content_section',
        'type' => 'textarea',
    ));
    
    // Add setting for header logo
    $wp_customize->add_setting('header_logo', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));

    // Add control for header logo
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'header_logo', array(
        'label' => __('Header Logo', 'dimension'),
        'section' => 'header_content_section',
        'settings' => 'header_logo',
    )));

}
add_action('customize_register', 'dimension_customize_register');