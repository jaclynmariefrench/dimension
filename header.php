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
                <?php
                $social_networks = array(
                    'twitter' => 'fa-twitter',
                    'facebook' => 'fa-facebook-f',
                    'instagram' => 'fa-instagram',
                    'github' => 'fa-github',
                    'linkedin' => 'fa-linkedin-in',
                    'tiktok' => 'fa-tiktok',
                );

                $has_links = false;
                foreach ($social_networks as $network => $icon_class) {
                    if (get_theme_mod("{$network}_link")) {
                        $has_links = true;
                        break;
                    }
                }

                if ($has_links) : ?>
                    <ul class="icons">
                        <?php
                        foreach ($social_networks as $network => $icon_class) {
                            $link = get_theme_mod("{$network}_link");
                            if ($link) {
                                echo '<li><a href="' . esc_url($link) . '" class="icon brands ' . esc_attr($icon_class) . '"><span class="label">' . ucfirst($network) . '</span></a></li>';
                            }
                        }
                        ?>
                    </ul>
                <?php endif; ?>
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