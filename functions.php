<?php

function dimension_register_assets() {
    // Log to check if this function is being executed
    error_log('dimension_register_assets called.');

    // Enqueue styles
    wp_enqueue_style('font-awesome', get_template_directory_uri() . '/assets/fonts/fontawesome-all.min.css');
    wp_enqueue_style('dimension-style', get_template_directory_uri() . '/style.css', array('font-awesome'), '1.1', 'all');

    // Enqueue scripts
    wp_enqueue_script('dimension-jquery', get_template_directory_uri() . '/assets/js/jquery.min.js', array('jquery'), '1.0', true);
    wp_enqueue_script('dimension-browser', get_template_directory_uri() . '/assets/js/browser.min.js', array('jquery'), '1.0', true);
    wp_enqueue_script('dimension-breakpoint', get_template_directory_uri() . '/assets/js/breakpoints.min.js', array('jquery'), '1.0', true);
    wp_enqueue_script('dimension-util', get_template_directory_uri() . '/assets/js/util.js', array('jquery'), '1.0', true);
    wp_enqueue_script('dimension-main', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), '1.0', true);
}

add_action('wp_enqueue_scripts', 'dimension_register_assets');



