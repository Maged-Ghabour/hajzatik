    <!-- Footer Section -->
    <footer class="footer">
        <div class="container">
            <div class="footer-top">
                <!-- Column 1: Logo -->
                <div class="footer-col logo-col">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/logoFooter.png" alt="<?php bloginfo('name'); ?>" class="footer-logo">
                    <p class="footer-description">منصتك الأولى الموثوقة لتسهيل وتأمين حجوزاتك ومواعيدك بضغطة زر وبأسرع وقت ممكن.</p>
                </div>

                <!-- Column 2: Links -->
                <div class="footer-col links-col">
                    <h4 class="footer-title">المزيد عنا</h4>
                    <?php
                    wp_nav_menu( array(
                        'theme_location' => 'footer',
                        'container'      => false,
                        'menu_class'     => 'footer-links',
                        'fallback_cb'    => false,
                    ) );
                    ?>
                </div>

                <!-- Column 3: Contact Info -->
                <div class="footer-col contact-col">
                    <h4 class="footer-title">تواصل معنا</h4>
                    <ul class="footer-contact-info">
                        <li>
                            <i class="fa-brands fa-whatsapp"></i>
                            <span dir="ltr"><?php echo esc_html( get_theme_mod( 'hajzatik_phone_number', '+974 123 456 789' ) ); ?></span>
                        </li>
                        <li>
                            <i class="fa-solid fa-phone"></i>
                            <span dir="ltr"><?php echo esc_html( get_theme_mod( 'hajzatik_phone_number', '+974 123 456 789' ) ); ?></span>
                        </li>
                        <li>
                            <i class="fa-regular fa-envelope"></i>
                            <span><?php echo esc_html( get_theme_mod( 'hajzatik_email', 'example@hotmail.com' ) ); ?></span>
                        </li>
                    </ul>
                </div>

                <!-- Column 4: Socials -->
                <div class="footer-col social-col">
                    <h4 class="footer-title">تابعنا على وسائل التواصل</h4>
                    <div class="social-links">
                        <?php if ( get_theme_mod('hajzatik_facebook') && get_theme_mod('hajzatik_facebook') !== '#' ) : ?>
                            <a href="<?php echo esc_url( get_theme_mod('hajzatik_facebook') ); ?>"><i class="fa-brands fa-facebook-f"></i></a>
                        <?php endif; ?>
                        <?php if ( get_theme_mod('hajzatik_twitter') && get_theme_mod('hajzatik_twitter') !== '#' ) : ?>
                            <a href="<?php echo esc_url( get_theme_mod('hajzatik_twitter') ); ?>"><i class="fa-brands fa-twitter"></i></a>
                        <?php endif; ?>
                        <?php if ( get_theme_mod('hajzatik_instagram') && get_theme_mod('hajzatik_instagram') !== '#' ) : ?>
                            <a href="<?php echo esc_url( get_theme_mod('hajzatik_instagram') ); ?>"><i class="fa-brands fa-instagram"></i></a>
                        <?php endif; ?>
                        <?php if ( get_theme_mod('hajzatik_linkedin') && get_theme_mod('hajzatik_linkedin') !== '#' ) : ?>
                            <a href="<?php echo esc_url( get_theme_mod('hajzatik_linkedin') ); ?>"><i class="fa-brands fa-linkedin-in"></i></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

            <div class="footer-bottom">
                <p>&copy; جميع الحقوق المحفوظة <?php echo date('Y'); ?></p>
                <?php if ( get_theme_mod('hajzatik_tax_number') ) : ?>
                    <p>الرقم الضريبي : <?php echo esc_html( get_theme_mod('hajzatik_tax_number') ); ?></p>
                <?php endif; ?>
            </div>
        </div>
    </footer>

    <!-- Floating WhatsApp Button -->
    <a href="<?php echo esc_url( get_theme_mod( 'whatsapp_link', '#' ) ); ?>" class="floating-whatsapp" target="_blank" aria-label="Chat on WhatsApp">
        <i class="fa-brands fa-whatsapp"></i>
    </a>

    <?php wp_footer(); ?>
</body>
</html>
