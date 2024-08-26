<?php
function dimension_customize_bg_register($wp_customize) {
    // Section for the background image
    $wp_customize->add_section('background_image_section', array(
        'title'    => __('Background Image', 'dimension'),
        'priority' => 30,
    ));

    // Setting for the background image
    $wp_customize->add_setting('background_image', array(
        'default'   => '',
        'transport' => 'refresh',
    ));

    // Control for uploading the background image
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'background_image', array(
        'label'    => __('Background Image', 'dimension'),
        'section'  => 'background_image_section',
        'settings' => 'background_image',
    )));
}

add_action('customize_register', 'dimension_customize_bg_register');

function dimension_customizer_css() {
    ?>
    <style type="text/css">
        :root {
            --bg-image: url('<?php echo esc_url(get_theme_mod('background_image', get_template_directory_uri() . '/assets/images/bg.jpg')); ?>');
        }
    </style>
    <?php
}

add_action('wp_head', 'dimension_customizer_css');
