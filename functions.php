<?php

// To get article IDs from menu
class Custom_Walker_Nav_Menu extends Walker_Nav_Menu
{
    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
    {
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

function load_modal_article() {
    error_log('load_modal_article function called');

    if (isset($_GET['slug'])) {
        $slug = sanitize_text_field($_GET['slug']);
        error_log('Slug received: ' . $slug);

        // Query the page by slug
        $query = new WP_Query(array(
            'name'           => $slug,
            'post_type'      => 'page',
            'post_status'    => 'publish',
            'posts_per_page' => 1
        ));

        if ($query->have_posts()) {
            $post = $query->post;
            error_log('Page found: ' . $post->post_title);

            // Start output buffering
            ob_start();

            // Pass the post to the template part
            set_query_var('custom_post', $post);
            get_template_part('templates/modal-article');

            // Get the buffered content and clean the buffer
            $content = ob_get_clean();
            error_log('Buffered content length: ' . strlen($content));

            // Return the content
            echo $content;
        } else {
            error_log('Page not found for slug: ' . $slug);

            // Return 404 response
            $response = array('error' => 'not_found', 'message' => 'Page not found');
            echo json_encode($response);
        }
    } else {
        error_log('No slug provided');

        // Return 404 response
        $response = array('error' => 'no_slug', 'message' => 'No slug provided');
        echo json_encode($response);
    }

    wp_die(); // This is required to terminate immediately and return a proper response
}

add_action('wp_ajax_load_modal_article', 'load_modal_article');
add_action('wp_ajax_nopriv_load_modal_article', 'load_modal_article');




function dimension_theme_support()
{
    //adds dynamic title tag support
    add_theme_support('title-tag');

    //Register navigation menu
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'dimension'),
    ));
}

add_action('after_setup_theme', 'dimension_theme_support');

function enqueue_admin_modify_preview_link_script() {
    wp_enqueue_script(
        'modify-preview-link-admin',
        get_template_directory_uri() . '/assets/js/modify-preview-link.js',
        array(),
        null,
        true
    );
}
add_action('admin_enqueue_scripts', 'enqueue_admin_modify_preview_link_script');


function dimension_register_assets()
{
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

    // Localize scripts with AJAX URL and Home URL
    wp_localize_script('custom-js', 'myScriptVars', array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'home_url' => home_url()
    ));
}

add_action('wp_enqueue_scripts', 'dimension_register_assets');


//customize header
require get_template_directory() . '/customize/customize-header.php';
//customize background image
require get_template_directory() . '/customize/customize-bg.php';
//customize footer
require get_template_directory() . '/customize/customize-footer.php';
