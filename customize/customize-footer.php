<?php
function customize_footer_register($wp_customize){
    //section for footer customization
    $wp_customize->add_section('footer_section', array(
        'title' => __('Footer', 'your_theme'),
        'priority' => 120,
    ));

    //setting for the dynamic section of the footer text
    $wp_customize-> add_setting('footer_dynamic_text', array(
        'default' => __('&copy; Untitled.', 'your_theme'),
        'sanitize_callback' => 'wp_kses_post',
    ));

    //control for the dynamic section of the footer text
    $wp_customize->add_control('footer_dynamic_text', array(
        'label' => __('Footer Text', 'your_theme'),
        'section' => 'footer_section',
        'type' => 'textarea',
    ));
}
add_action('customize_register', 'customize_footer_register');