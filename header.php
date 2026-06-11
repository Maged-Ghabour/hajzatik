<!DOCTYPE html>
<html <?php language_attributes(); ?> dir="rtl">
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

    <!-- Preloader -->
    <div id="preloader">
        <div class="preloader-content">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/logo.png" alt="Loading..." class="preloader-logo">
            <div class="preloader-spinner"></div>
        </div>
    </div>

    <!-- Header Section -->
    <header class="header">
        <div class="container header-container">
            <!-- Mobile Menu Toggle -->
            <button class="menu-toggle">
                <i class="fa-solid fa-bars"></i>
            </button>

            <!-- Logo -->
            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="logo">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/logo.png" alt="<?php bloginfo('name'); ?>">
            </a>

            <!-- Navigation -->
            <nav class="main-nav">
                <?php
                wp_nav_menu( array(
                    'theme_location' => 'primary',
                    'container'      => false,
                    'menu_class'     => 'nav-list',
                    'fallback_cb'    => false,
                ) );
                ?>
            </nav>

            <!-- Contact Info & CTA -->
            <div class="header-contact">
                <?php if ( get_theme_mod('enable_dark_mode', true) ) : ?>
                <button id="darkModeToggle" class="dark-mode-toggle" aria-label="Toggle Dark Mode">
                    <i class="fa-solid fa-moon"></i>
                </button>
                <?php endif; ?>
                
                <div class="phone-number">
                    <span dir="ltr"><?php echo esc_html( get_theme_mod( 'header_phone', '+974 123 456 789' ) ); ?></span>
                    <i class="fa-solid fa-phone"></i>
                </div>
                <a href="<?php echo esc_url( get_theme_mod( 'whatsapp_link', '#' ) ); ?>" class="btn btn-dark">تواصل معنا</a>
            </div>
        </div>

        <!-- Mobile Sidebar Menu -->
        <div class="mobile-menu-overlay"></div>
        <div class="mobile-menu">
            <div class="mobile-menu-header">
                <img src="<?php echo get_template_directory_uri(); ?>/assets/logo.png" alt="<?php bloginfo('name'); ?>" class="mobile-logo">
                <button class="menu-close">
                    <i class="fa-solid fa-xmark"></i>
                </button>
            </div>
            <?php
            wp_nav_menu( array(
                'theme_location' => 'primary',
                'container'      => false,
                'menu_class'     => 'mobile-nav-list',
                'fallback_cb'    => false,
            ) );
            ?>
        </div>
    </header>
