<?php
/**
 * Front Page Template
 */
get_header();
?>

    <!-- Hero Section -->
    <section class="hero" data-aos="fade-up" data-aos-duration="1000">
        <div class="container">
            <div class="hero-content">
                <div class="hero-overlay"></div>
                <div class="hero-text-box">
                    <h1 class="hero-title"><?php echo wp_kses_post( get_theme_mod( 'hero_title', 'احصل على موعدك أو<br>حجزك بسرعة أكبر' ) ); ?></h1>
                    <p class="hero-description">
                        <?php echo wp_kses_post( get_theme_mod( 'hero_desc', 'نوفر لك المساعدة في الوصول إلى المواعيد والحجوزات<br>المطلوبة في المستشفيات والفعاليات والمطاعم والسفر<br>وغيرها — بسرعة، وبدون عناء البحث الطويل.' ) ); ?>
                    </p>
                    <a href="<?php echo esc_url( get_theme_mod( 'whatsapp_link', '#' ) ); ?>" class="btn btn-white btn-whatsapp">
                        ابدأ عبر واتساب
                        <i class="fa-brands fa-whatsapp"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features" data-aos="fade-up" data-aos-delay="200">
        <div class="container">
            <div class="features-box">
                <?php
                $features = new WP_Query( array(
                    'post_type'      => 'feature',
                    'posts_per_page' => 3,
                    'order'          => 'ASC'
                ) );
                if ( $features->have_posts() ) :
                    while ( $features->have_posts() ) : $features->the_post();
                        $thumbnail_url = get_the_post_thumbnail_url() ? get_the_post_thumbnail_url() : get_template_directory_uri() . '/assets/icon1.png';
                ?>
                <div class="feature-item">
                    <div class="feature-icon">
                        <img src="<?php echo esc_url( $thumbnail_url ); ?>" alt="<?php the_title_attribute(); ?>">
                    </div>
                    <div class="feature-text">
                        <h3><?php the_title(); ?></h3>
                        <div><?php the_content(); ?></div>
                    </div>
                </div>
                <?php
                    endwhile;
                    wp_reset_postdata();
                else : // Fallback content ?>
                    <div class="feature-item">
                        <div class="feature-icon"><img src="<?php echo get_template_directory_uri(); ?>/assets/icon1.png" alt="Feature"></div>
                        <div class="feature-text"><h3>مواعيد أسرع</h3><p>نساعدك في الوصول إلى المواعيد بأسرع وقت</p></div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section class="services">
        <div class="container">
            <div class="section-header">
                <span class="badge">خدماتنا</span>
                <h2>كل ما تحتاجه في مكان واحد</h2>
                <p>حلول حجز متنوعة تناسب احتياجاتك اليومية</p>
            </div>

            <div class="services-grid" data-aos="fade-up">
                <?php
                $services = new WP_Query( array(
                    'post_type'      => 'service',
                    'posts_per_page' => 6,
                    'order'          => 'ASC'
                ) );
                if ( $services->have_posts() ) :
                    while ( $services->have_posts() ) : $services->the_post();
                        $thumbnail_url = get_the_post_thumbnail_url() ? get_the_post_thumbnail_url() : get_template_directory_uri() . '/assets/service1.png';
                ?>
                <div class="service-card">
                    <div class="service-img">
                        <img src="<?php echo esc_url( $thumbnail_url ); ?>" alt="<?php the_title_attribute(); ?>">
                    </div>
                    <div class="service-content">
                        <h3><?php the_title(); ?></h3>
                        <div><?php the_content(); ?></div>
                        <a href="<?php echo esc_url( get_theme_mod( 'whatsapp_link', '#' ) ); ?>" class="btn btn-dark btn-full btn-pill book-now-btn">
                            احجز الآن <span class="arrow-circle"><i class="fa-solid fa-arrow-left"></i></span>
                        </a>
                    </div>
                </div>
                <?php
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>
            </div>
        </div>
    </section>

    <!-- CTA Banner Section -->
    <section class="cta-banner">
        <div class="container">
            <div class="cta-content">
                <div class="cta-overlay"></div>
                <div class="cta-text-box">
                    <h2 class="cta-title"><?php echo esc_html( get_theme_mod( 'cta_title', 'نوفر لك الوصول السريع إلى أهم المواعيد والحجوزات' ) ); ?></h2>
                    <p class="cta-description">
                        من المواعيد الطبية والحكومية إلى الفعاليات والمطاعم وتذاكر السفر، نساعدك في الحصول على الحجز الذي تحتاجه بأسرع وقت
                    </p>
                    <a href="<?php echo esc_url( get_theme_mod( 'whatsapp_link', '#' ) ); ?>" class="btn btn-white btn-whatsapp cta-btn">
                        احجز عبر واتساب
                        <i class="fa-brands fa-whatsapp"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section class="how-it-works">
        <div class="container">
            <div class="section-header">
                <span class="badge">آلية العمل</span>
                <h2>كيف تتم عملية الحجز؟</h2>
                <p>خطوات بسيطة من طلبك الأول حتى تأكيد الحجز</p>
            </div>

            <div class="steps-grid" data-aos="fade-up">
                <div class="step-card">
                    <div class="step-number">01</div>
                    <div class="step-content">
                        <h3>تواصل معنا</h3>
                        <p>أرسل طلبك عبر الواتساب أو النموذج بالأسفل</p>
                    </div>
                </div>
                <div class="step-card">
                    <div class="step-number">02</div>
                    <div class="step-content">
                        <h3>متابعة الطلب</h3>
                        <p>فريقنا سيقوم بالبحث وتأكيد المواعيد المتاحة</p>
                    </div>
                </div>
                <div class="step-card">
                    <div class="step-number">03</div>
                    <div class="step-content">
                        <h3>تأكيد الحجز</h3>
                        <p>نرسل لك تفاصيل الحجز المؤكد ليكون بين يديك</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="testimonials">
        <div class="container">
            <div class="section-header">
                <span class="badge">آراء العملاء</span>
                <h2>ماذا يقول عملاؤنا؟</h2>
                <p>ثقة عملائنا هي مصدر نجاحنا</p>
            </div>

            <div class="swiper testimonials-swiper" data-aos="zoom-in">
                <div class="swiper-wrapper">
                    <?php
                    $testimonials = new WP_Query( array(
                        'post_type'      => 'testimonial',
                        'posts_per_page' => 6,
                    ) );
                    if ( $testimonials->have_posts() ) :
                        while ( $testimonials->have_posts() ) : $testimonials->the_post();
                            $avatar = get_the_post_thumbnail_url() ? get_the_post_thumbnail_url() : get_template_directory_uri() . '/assets/avatar.png';
                            $role = get_the_excerpt() ? get_the_excerpt() : 'عميل مميز';
                    ?>
                    <div class="swiper-slide">
                        <div class="testimonial-card">
                            <div class="testimonial-header">
                                <div class="user-info-box">
                                    <img src="<?php echo esc_url( $avatar ); ?>" alt="<?php the_title_attribute(); ?>" class="user-avatar">
                                    <div class="user-details">
                                        <h4><?php the_title(); ?></h4>
                                        <span><?php echo esc_html( $role ); ?></span>
                                    </div>
                                </div>
                                <div class="stars">
                                    <i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i><i class="fa-solid fa-star"></i>
                                </div>
                            </div>
                            <hr class="testimonial-divider">
                            <div class="testimonial-text">
                                <?php the_content(); ?>
                            </div>
                        </div>
                    </div>
                    <?php
                        endwhile;
                        wp_reset_postdata();
                    endif;
                    ?>
                </div>
            </div>

            <div class="slider-controls">
                <button class="slider-btn prev-btn swiper-button-next-custom">
                    <i class="fa-solid fa-arrow-right"></i>
                </button>
                <button class="slider-btn next-btn swiper-button-prev-custom">
                    <i class="fa-solid fa-arrow-left"></i>
                </button>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section class="faq">
        <div class="container">
            <div class="section-header">
                <span class="badge">الأسئلة الشائعة</span>
                <h2>كل ما تود معرفته</h2>
                <p>إجابات سريعة على أبرز استفساراتك</p>
            </div>

            <div class="faq-grid" data-aos="fade-up">
                <?php
                $faqs = new WP_Query( array(
                    'post_type'      => 'faq',
                    'posts_per_page' => -1,
                ) );
                if ( $faqs->have_posts() ) :
                    while ( $faqs->have_posts() ) : $faqs->the_post();
                ?>
                <div class="faq-item">
                    <div class="faq-question">
                        <h3><?php the_title(); ?></h3>
                        <div class="faq-icon"><i class="fa-solid fa-chevron-down"></i></div>
                    </div>
                    <div class="faq-answer">
                        <?php the_content(); ?>
                    </div>
                </div>
                <?php
                    endwhile;
                    wp_reset_postdata();
                endif;
                ?>
            </div>
        </div>
    </section>

    <!-- Contact Form Section -->
    <section class="contact-section">
        <div class="container">
            <div class="section-header">
                <span class="badge">اطلب خدمتك</span>
                <h2>لا تتردد في التواصل معنا</h2>
                <p>شاركنا تفاصيل طلبك وسنتولى متابعة إجراءات الحجز نيابة عنك</p>
            </div>

            <div class="contact-card" data-aos="fade-up">
                <div class="contact-form-area">
                    <form id="bookingForm" class="order-form">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="fullName">الاسم بالكامل:</label>
                                <input type="text" id="fullName" name="fullName" placeholder="الاسم ثلاثي" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="phoneNumber">رقم الجوال:</label>
                                <input type="tel" id="phoneNumber" name="phoneNumber" placeholder="مثال: 05xxxxxxxxx" class="form-control" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="serviceType">نوع الخدمة المطلوبة:</label>
                            <div class="select-wrapper">
                                <select id="serviceType" name="serviceType" class="form-control select-control" required>
                                    <option value="" disabled selected>اختر الخدمة...</option>
                                    <option value="medical">موعد طبي (مستشفى/عيادة)</option>
                                    <option value="events">تذاكر فعاليات أو مباريات</option>
                                    <option value="travel">حجوزات طيران أو فنادق</option>
                                    <option value="restaurant">حجز مطعم أو كافيه</option>
                                    <option value="cars">مواعيد صيانة سيارات</option>
                                    <option value="other">خدمات خاصة أخرى</option>
                                </select>
                                <i class="fa-solid fa-chevron-down select-icon"></i>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="orderDetails">تفاصيل الطلب (إن وجد):</label>
                            <textarea id="orderDetails" name="orderDetails" rows="4" placeholder="اكتب تفاصيل الحجز أو الموعد المطلوب" class="form-control"></textarea>
                        </div>

                        <button type="submit" class="btn btn-dark btn-full btn-pill book-now-btn submit-btn">
                            إرسال الطلب
                            <span class="arrow-circle"><i class="fa-solid fa-arrow-left"></i></span>
                        </button>
                        
                        <div id="formMessage" style="margin-top:15px; font-weight:600; font-size:15px; text-align:center; display:none; padding:10px; border-radius:5px;"></div>
                    </form>
                </div>

                <div class="contact-image-area">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/contact_us.png" alt="تواصل معنا">
                </div>
            </div>
        </div>
    </section>

<?php
get_footer();
