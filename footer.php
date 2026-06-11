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
                            <span dir="ltr"><?php echo esc_html( get_theme_mod( 'header_phone', '+974 123 456 789' ) ); ?></span>
                        </li>
                        <li>
                            <i class="fa-solid fa-phone"></i>
                            <span dir="ltr"><?php echo esc_html( get_theme_mod( 'header_phone', '+974 123 456 789' ) ); ?></span>
                        </li>
                        <li>
                            <i class="fa-regular fa-envelope"></i>
                            <span>example@hotmail.com</span>
                        </li>
                    </ul>
                </div>

                <!-- Column 4: Socials -->
                <div class="footer-col social-col">
                    <h4 class="footer-title">تابعنا على وسائل التواصل</h4>
                    <div class="social-links">
                        <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="#"><i class="fa-brands fa-twitter"></i></a>
                        <a href="#"><i class="fa-brands fa-instagram"></i></a>
                        <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
                    </div>
                </div>
            </div>

            <div class="footer-bottom">
                <p>&copy; جميع الحقوق المحفوظة <?php echo date('Y'); ?></p>
                <p>الرقم الضريبي : 123456789</p>
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
