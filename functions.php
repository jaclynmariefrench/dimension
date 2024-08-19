<?php

// To get article IDs from menu
class Custom_Walker_Nav_Menu extends Walker_Nav_Menu {
    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
        // Get the post ID associated with the menu item
        $post_id = get_post_meta($item->ID, '_menu_item_object_id', true);
        
        // Get the post title and sanitize it
        $post_title = get_the_title($post_id);
        $sanitized_title = sanitize_title($post_title);
        
        // Generate the menu item HTML
        $output .= sprintf(
            '<li><a href="#%s" data-article-id="%s">%s</a></li>',
            esc_attr($sanitized_title),
            esc_attr($sanitized_title),
            esc_html($item->title)
        );
    }
}

// To load modal articles in template
function load_modal_article() {
    // Check if the slug parameter is set
    if (isset($_GET['slug'])) {
        $slug = sanitize_text_field($_GET['slug']);
        
        // Query the post by slug
        $post = get_page_by_path($slug, OBJECT, 'page');
        
        if ($post) {
            // Return the post content
            echo apply_filters('the_content', $post->post_content);
        } else {
            echo 'Post not found';
        }
    } else {
        echo 'No slug provided';
    }
    wp_die(); // This is required to terminate immediately and return a proper response
}
add_action('wp_ajax_load_modal_article', 'load_modal_article');
add_action('wp_ajax_nopriv_load_modal_article', 'load_modal_article');



function dimension_theme_support() {
    //adds dynamic title tag support
    add_theme_support('title-tag');

    //Register navigation menu
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'dimension'),
    ));
}

add_action('after_setup_theme', 'dimension_theme_support');


function dimension_register_assets() {
    // Enqueue styles
    wp_enqueue_style('font-awesome', get_template_directory_uri() . '/assets/fonts/fontawesome-all.min.css');
    wp_enqueue_style('dimension-style', get_template_directory_uri() . '/style.css', array('font-awesome'), '1.1', 'all');

    // Enqueue scripts
    wp_enqueue_script('dimension-jquery', get_template_directory_uri() . '/assets/js/jquery.min.js', array('jquery'), '1.0', true);
    wp_enqueue_script('dimension-browser', get_template_directory_uri() . '/assets/js/browser.min.js', array('jquery'), '1.0', true);
    wp_enqueue_script('dimension-breakpoint', get_template_directory_uri() . '/assets/js/breakpoints.min.js', array('jquery'), '1.0', true);
    wp_enqueue_script('dimension-util', get_template_directory_uri() . '/assets/js/util.js', array('jquery'), '1.0', true);
    wp_enqueue_script('dimension-main', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), '1.0', true);

    // Enqueue the custom.js file and localize the ajax URL
    wp_enqueue_script('custom-js', get_template_directory_uri() . '/assets/js/custom.js', array('dimension-main'), null, true);
    wp_localize_script('custom-js', 'ajaxurl', array('ajax_url' => admin_url('admin-ajax.php')));
}

add_action('wp_enqueue_scripts', 'dimension_register_assets');


//customize header
require get_template_directory() . '/customize-header.php';




