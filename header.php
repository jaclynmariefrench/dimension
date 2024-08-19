<!DOCTYPE HTML>
<!--
    Dimension by HTML5 UP
    html5up.net | @ajlkn
    Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
    <?php wp_head(); ?>
</head>

<body class="is-preload">

    <!-- Wrapper -->
    <div id="wrapper">

        <!-- Header -->
        <header id="header">
            <div class="logo">
                <?php if (get_theme_mod('header_logo')) : ?>
                    <img src="<?php echo esc_url(get_theme_mod('header_logo')); ?>" alt="<?php echo esc_attr(get_bloginfo('name')); ?>">
                <?php else : ?>
                    <span class="icon fa-gem"></span>
                <?php endif; ?>
            </div>
            <div class="content">
                <div class="inner">
                    <h1><?php echo esc_html(get_theme_mod('header_title', 'Dimension')); ?></h1>
                    <p><?php echo esc_html(get_theme_mod('header_description', 'A fully responsive site template designed by HTML5 UP and released for free under the Creative Commons license.')); ?></p>
                </div>
            </div>
            <nav>
                <?php 
                wp_nav_menu(array(
                    'theme_location' => 'primary',
                    'menu_class' => 'menu',
                    'container' => false,
					'walker' => new Custom_Walker_Nav_Menu(),
                ));
                ?>
            </nav>
        </header>