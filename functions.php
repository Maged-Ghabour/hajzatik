<?php
/**
 * Hajzatik Theme Functions
 */

if ( ! function_exists( 'hajzatik_setup' ) ) :
	function hajzatik_setup() {
		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// Let WordPress manage the document title.
		add_theme_support( 'title-tag' );

		// Enable support for Post Thumbnails on posts and pages.
		add_theme_support( 'post-thumbnails' );

		// Register Menus
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary Menu', 'hajzatik' ),
			'footer'  => esc_html__( 'Footer Menu', 'hajzatik' ),
		) );

		// Switch default core markup for search form, comment form, and comments to output valid HTML5.
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );
	}
endif;
add_action( 'after_setup_theme', 'hajzatik_setup' );

/**
 * Enqueue scripts and styles.
 */
function hajzatik_scripts() {
	// Fonts
	wp_enqueue_style( 'hajzatik-fonts', 'https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap', array(), null );
	
	// Font Awesome
	wp_enqueue_style( 'hajzatik-fontawesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css', array(), '6.4.0' );
	
	// Swiper CSS
	wp_enqueue_style( 'hajzatik-swiper-css', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css', array(), '11.0.0' );
	
	// AOS CSS
	wp_enqueue_style( 'hajzatik-aos-css', 'https://unpkg.com/aos@2.3.1/dist/aos.css', array(), '2.3.1' );

	// Theme CSS
	wp_enqueue_style( 'hajzatik-style', get_stylesheet_uri(), array(), filemtime(get_template_directory() . '/style.css') );

	// Swiper JS
	wp_enqueue_script( 'hajzatik-swiper-js', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', array(), '11.0.0', true );
	
	// AOS JS
	wp_enqueue_script( 'hajzatik-aos-js', 'https://unpkg.com/aos@2.3.1/dist/aos.js', array(), '2.3.1', true );

	// Custom JS (We'll inline this for now to match HTML behavior)
	wp_add_inline_script( 'hajzatik-aos-js', "
        document.addEventListener('DOMContentLoaded', function() {
            AOS.init({ duration: 800, once: true, offset: 100 });
            
            // Mobile Menu Toggle
            const menuToggle = document.querySelector('.menu-toggle');
            const menuClose = document.querySelector('.menu-close');
            const mobileMenu = document.querySelector('.mobile-menu');
            const mobileMenuOverlay = document.querySelector('.mobile-menu-overlay');

            if(menuToggle && menuClose) {
                menuToggle.addEventListener('click', () => {
                    mobileMenu.classList.add('active');
                    mobileMenuOverlay.classList.add('active');
                    document.body.style.overflow = 'hidden';
                });

                function closeMenu() {
                    mobileMenu.classList.remove('active');
                    mobileMenuOverlay.classList.remove('active');
                    document.body.style.overflow = 'auto';
                }

                menuClose.addEventListener('click', closeMenu);
                mobileMenuOverlay.addEventListener('click', closeMenu);
            }

            // FAQ Accordion
            const faqItems = document.querySelectorAll('.faq-item');
            faqItems.forEach(item => {
                const question = item.querySelector('.faq-question');
                if(question) {
                    question.addEventListener('click', () => {
                        faqItems.forEach(i => {
                            if (i !== item) i.classList.remove('active');
                        });
                        item.classList.toggle('active');
                    });
                }
            });

            // Initialize Swiper
            if(document.querySelector('.testimonials-swiper')) {
                const swiper = new Swiper('.testimonials-swiper', {
                    direction: 'horizontal',
                    slidesPerView: 1,
                    spaceBetween: 20,
                    loop: true,
                    navigation: {
                        nextEl: '.swiper-button-next-custom',
                        prevEl: '.swiper-button-prev-custom',
                    },
                    breakpoints: {
                        768: { slidesPerView: 2, spaceBetween: 30 },
                        1024: { slidesPerView: 3, spaceBetween: 30 },
                    }
                });
            }

            // Dark Mode Toggle
            const darkModeToggle = document.getElementById('darkModeToggle');
            const body = document.body;
            
            if(localStorage.getItem('hajzatik_dark_mode') === 'enabled') {
                body.classList.add('dark-mode');
                if(darkModeToggle) darkModeToggle.innerHTML = '<i class=\"fa-solid fa-sun\"></i>';
            }
            
            if(darkModeToggle) {
                darkModeToggle.addEventListener('click', () => {
                    body.classList.toggle('dark-mode');
                    if(body.classList.contains('dark-mode')) {
                        localStorage.setItem('hajzatik_dark_mode', 'enabled');
                        darkModeToggle.innerHTML = '<i class=\"fa-solid fa-sun\"></i>';
                    } else {
                        localStorage.setItem('hajzatik_dark_mode', null);
                        darkModeToggle.innerHTML = '<i class=\"fa-solid fa-moon\"></i>';
                    }
                });
            }

            // AJAX Form Submission
            const bookingForm = document.getElementById('bookingForm');
            const formMessage = document.getElementById('formMessage');
            if (bookingForm) {
                bookingForm.addEventListener('submit', function(e) {
                    e.preventDefault();
                    
                    const submitBtn = bookingForm.querySelector('.submit-btn');
                    const originalBtnText = submitBtn.innerHTML;
                    submitBtn.innerHTML = 'جاري الإرسال... <span class=\"arrow-circle\"><i class=\"fa-solid fa-spinner fa-spin\"></i></span>';
                    submitBtn.disabled = true;
                    formMessage.style.display = 'none';

                    const formData = new FormData(bookingForm);
                    formData.append('action', 'submit_booking');

                    fetch(hajzatik_ajax.ajax_url, {
                        method: 'POST',
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        submitBtn.innerHTML = originalBtnText;
                        submitBtn.disabled = false;
                        
                        formMessage.style.display = 'block';
                        if(data.success) {
                            formMessage.style.backgroundColor = '#d4edda';
                            formMessage.style.color = '#155724';
                            formMessage.innerText = data.data.message;
                            bookingForm.reset();
                        } else {
                            formMessage.style.backgroundColor = '#f8d7da';
                            formMessage.style.color = '#721c24';
                            formMessage.innerText = data.data.message || 'حدث خطأ. حاول مرة أخرى.';
                        }
                    })
                    .catch(error => {
                        submitBtn.innerHTML = originalBtnText;
                        submitBtn.disabled = false;
                        formMessage.style.display = 'block';
                        formMessage.style.backgroundColor = '#f8d7da';
                        formMessage.style.color = '#721c24';
                        formMessage.innerText = 'حدث خطأ في الاتصال بالخادم.';
                    });
                });
            }
        });

        // Preloader
        window.addEventListener('load', function() {
            const preloader = document.getElementById('preloader');
            if(preloader) {
                preloader.style.opacity = '0';
                setTimeout(() => { preloader.style.visibility = 'hidden'; }, 500);
            }
        });
	" );

	// Pass AJAX URL to JS
	wp_localize_script( 'hajzatik-aos-js', 'hajzatik_ajax', array(
		'ajax_url' => admin_url( 'admin-ajax.php' )
	) );
}
add_action( 'wp_enqueue_scripts', 'hajzatik_scripts' );

/**
 * Register Custom Post Types
 */
function hajzatik_register_cpts() {
	// Services
	register_post_type( 'service', array(
		'labels'      => array( 'name' => 'الخدمات', 'singular_name' => 'خدمة' ),
		'public'      => true,
		'has_archive' => false,
		'supports'    => array( 'title', 'editor', 'thumbnail' ),
		'menu_icon'   => 'dashicons-hammer',
	) );

	// Features
	register_post_type( 'feature', array(
		'labels'      => array( 'name' => 'المميزات', 'singular_name' => 'ميزة' ),
		'public'      => true,
		'has_archive' => false,
		'supports'    => array( 'title', 'editor', 'thumbnail' ),
		'menu_icon'   => 'dashicons-star-filled',
	) );

	// Testimonials
	register_post_type( 'testimonial', array(
		'labels'      => array( 'name' => 'آراء العملاء', 'singular_name' => 'رأي عميل' ),
		'public'      => true,
		'has_archive' => false,
		'supports'    => array( 'title', 'editor', 'thumbnail', 'excerpt' ), // Excerpt for role/service
		'menu_icon'   => 'dashicons-format-quote',
	) );

	// FAQs
	register_post_type( 'faq', array(
		'labels'      => array( 'name' => 'الأسئلة الشائعة', 'singular_name' => 'سؤال' ),
		'public'      => true,
		'has_archive' => false,
		'supports'    => array( 'title', 'editor' ),
		'menu_icon'   => 'dashicons-editor-help',
	) );

	// Booking Requests
	register_post_type( 'booking_request', array(
		'labels'      => array( 'name' => 'طلبات الحجز', 'singular_name' => 'طلب حجز' ),
		'public'      => false,
		'show_ui'     => true,
		'has_archive' => false,
		'supports'    => array( 'title', 'editor', 'custom-fields' ),
		'menu_icon'   => 'dashicons-clipboard',
		'menu_position' => 20,
	) );
}
add_action( 'init', 'hajzatik_register_cpts' );

/**
 * Customizer Settings
 */
function hajzatik_customize_register( $wp_customize ) {
	// Header Section
	$wp_customize->add_section( 'hajzatik_header_section', array(
		'title' => 'إعدادات الهيدر',
		'priority' => 30,
	) );
	
	$wp_customize->add_setting( 'header_phone', array( 'default' => '+974 123 456 789' ) );
	$wp_customize->add_control( 'header_phone', array(
		'label' => 'رقم الهاتف',
		'section' => 'hajzatik_header_section',
		'type' => 'text',
	) );

	// Dark Mode Toggle Setting
	$wp_customize->add_setting( 'enable_dark_mode', array( 'default' => true ) );
	$wp_customize->add_control( 'enable_dark_mode', array(
		'label' => 'تفعيل خيار الوضع الليلي للزوار',
		'section' => 'hajzatik_header_section',
		'type' => 'checkbox',
	) );

	// Hero Section
	$wp_customize->add_section( 'hajzatik_hero_section', array(
		'title' => 'القسم الرئيسي (Hero)',
		'priority' => 31,
	) );

	$wp_customize->add_setting( 'hero_title', array( 'default' => 'احصل على موعدك أو<br>حجزك بسرعة أكبر' ) );
	$wp_customize->add_control( 'hero_title', array(
		'label' => 'عنوان القسم الرئيسي',
		'section' => 'hajzatik_hero_section',
		'type' => 'textarea',
	) );

	$wp_customize->add_setting( 'hero_desc', array( 'default' => 'نوفر لك المساعدة في الوصول إلى المواعيد والحجوزات...' ) );
	$wp_customize->add_control( 'hero_desc', array(
		'label' => 'وصف القسم الرئيسي',
		'section' => 'hajzatik_hero_section',
		'type' => 'textarea',
	) );

	$wp_customize->add_setting( 'whatsapp_link', array( 'default' => '#' ) );
	$wp_customize->add_control( 'whatsapp_link', array(
		'label' => 'رابط الواتساب',
		'section' => 'hajzatik_hero_section',
		'type' => 'url',
	) );

	// CTA Section
	$wp_customize->add_section( 'hajzatik_cta_section', array(
		'title' => 'قسم الإجراء (CTA)',
		'priority' => 32,
	) );

	$wp_customize->add_setting( 'cta_title', array( 'default' => 'نوفر لك الوصول السريع إلى أهم المواعيد' ) );
	$wp_customize->add_control( 'cta_title', array(
		'label' => 'عنوان CTA',
		'section' => 'hajzatik_cta_section',
		'type' => 'textarea',
	) );

	// Form & Integration Section
	$wp_customize->add_section( 'hajzatik_integration_section', array(
		'title' => 'الربط المتقدم (Google Sheets)',
		'priority' => 33,
	) );

	$wp_customize->add_setting( 'google_sheets_webhook', array( 'default' => '' ) );
	$wp_customize->add_control( 'google_sheets_webhook', array(
		'label' => 'رابط Webhook لـ Google Sheets',
		'section' => 'hajzatik_integration_section',
		'type' => 'url',
		'description' => 'ضع الرابط هنا لإرسال بيانات النموذج تلقائياً إلى شيت جوجل.',
	) );
}
add_action( 'customize_register', 'hajzatik_customize_register' );

/**
 * Custom Admin Styling
 */
function hajzatik_enqueue_admin_fonts() {
    wp_enqueue_style( 'hajzatik-admin-fonts', 'https://fonts.googleapis.com/css2?family=Cairo:wght@400;600;700&display=swap', array(), null );
}
add_action( 'admin_enqueue_scripts', 'hajzatik_enqueue_admin_fonts' );

function hajzatik_custom_admin_css() {
    echo '<style>
        /* Apply Cairo Font Everywhere in Admin */
        body, #wpadminbar *:not([class="ab-icon"]), .wp-core-ui, .media-menu, .media-frame *, .custom-background-add, .search-form input, .press-this #description, .press-this .options, .press-this .export-me, .press-this .trackback, .press-this .tag-area, .press-this .categories-area, .press-this .add-cat, .press-this .login-form, .press-this .forgot-password, .press-this .login-links, .press-this .register, .press-this .log-in, .press-this .submit, .press-this .post-form, .press-this .post-formats, .press-this .categories-area label, .press-this .add-cat label, .press-this .tag-area label, .press-this .trackback label, .press-this .options label, .press-this .export-me label, .press-this .submit input, .press-this .post-form input, .press-this .post-formats input, .press-this .categories-area input, .press-this .add-cat input, .press-this .tag-area input, .press-this .trackback input, .press-this .options input, .press-this .export-me input {
            font-family: "Cairo", sans-serif !important;
        }

        /* Professional Tweaks */
        #adminmenu .wp-submenu a {
            font-size: 14px;
        }
        #adminmenu a.menu-top {
            font-size: 15px;
        }
        .wp-core-ui .button-primary {
            background-color: #212121 !important;
            border-color: #000 !important;
            color: #fff !important;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1) !important;
            border-radius: 5px !important;
            transition: all 0.3s ease;
        }
        .wp-core-ui .button-primary:hover {
            background-color: #000 !important;
            transform: translateY(-1px);
        }
        #wpadminbar {
            background-color: #1a1a1a !important;
        }
        .postbox {
            border-radius: 8px;
            box-shadow: 0 2px 15px rgba(0,0,0,0.03);
            border: none;
        }
    </style>';
}
add_action( 'admin_head', 'hajzatik_custom_admin_css' );

/**
 * Custom Login Page Styling
 */
function hajzatik_custom_login_logo() {
    $logo_url = get_template_directory_uri() . '/assets/logo.png';
    echo '<style type="text/css">
        body.login {
            background-color: #f4f6f8;
            font-family: "Cairo", sans-serif;
        }
        #login h1 a, .login h1 a {
            background-image: url(' . esc_url($logo_url) . ');
            height: 70px;
            width: 100%;
            background-size: contain;
            background-repeat: no-repeat;
            padding-bottom: 20px;
        }
        body.login div#login {
            padding: 8% 0 0;
        }
        body.login #loginform {
            border-radius: 12px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.08);
            border: none;
            padding: 30px;
        }
        body.login .button-primary {
            background-color: #212121 !important;
            border-color: #000 !important;
            border-radius: 8px !important;
            text-shadow: none !important;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1) !important;
            transition: all 0.3s ease;
            width: 100%;
            padding: 8px 0;
            font-size: 16px;
        }
        body.login .button-primary:hover {
            background-color: #000 !important;
            transform: translateY(-2px);
        }
        body.login #backtoblog a, body.login #nav a {
            color: #666 !important;
            transition: color 0.3s ease;
        }
        body.login #backtoblog a:hover, body.login #nav a:hover {
            color: #212121 !important;
        }
    </style>';
}
add_action( 'login_enqueue_scripts', 'hajzatik_custom_login_logo' );

function hajzatik_custom_login_url() {
    return home_url();
}
add_filter( 'login_headerurl', 'hajzatik_custom_login_url' );

function hajzatik_custom_login_title() {
    return get_bloginfo( 'name' );
}
add_filter( 'login_headertext', 'hajzatik_custom_login_title' );

/**
 * Handle Form Submission (AJAX)
 */
function hajzatik_submit_booking() {
    $full_name = isset($_POST['fullName']) ? sanitize_text_field( $_POST['fullName'] ) : '';
    $phone_number = isset($_POST['phoneNumber']) ? sanitize_text_field( $_POST['phoneNumber'] ) : '';
    $service_type = isset($_POST['serviceType']) ? sanitize_text_field( $_POST['serviceType'] ) : '';
    $order_details = isset($_POST['orderDetails']) ? sanitize_textarea_field( $_POST['orderDetails'] ) : '';

    if ( empty( $full_name ) || empty( $phone_number ) ) {
        wp_send_json_error( array( 'message' => 'يرجى تعبئة الحقول المطلوبة.' ) );
    }

    // 1. Save to WordPress Dashboard
    $post_id = wp_insert_post( array(
        'post_title'   => 'طلب من: ' . $full_name,
        'post_content' => "رقم الجوال: $phone_number\nالخدمة: $service_type\nالتفاصيل: $order_details",
        'post_status'  => 'publish',
        'post_type'    => 'booking_request',
    ) );

    if ( is_wp_error( $post_id ) ) {
        wp_send_json_error( array( 'message' => 'حدث خطأ أثناء الحفظ. يرجى المحاولة لاحقاً.' ) );
    }

    update_post_meta( $post_id, 'client_phone', $phone_number );
    update_post_meta( $post_id, 'service_type', $service_type );
    update_post_meta( $post_id, 'order_details', $order_details );

    // 2. Send to Google Sheets (Webhook)
    $webhook_url = get_theme_mod( 'google_sheets_webhook', '' );
    if ( ! empty( $webhook_url ) ) {
        $data = array(
            'date'    => current_time('mysql'),
            'name'    => $full_name,
            'phone'   => $phone_number,
            'service' => $service_type,
            'details' => $order_details
        );
        
        wp_remote_post( $webhook_url, array(
            'method'      => 'POST',
            'timeout'     => 15,
            'redirection' => 5,
            'httpversion' => '1.0',
            'blocking'    => true, // Can be false if we don't care about the response
            'headers'     => array( 'Content-Type' => 'application/json' ),
            'body'        => json_encode( $data ),
        ) );
    }

    wp_send_json_success( array( 'message' => 'تم استلام طلبك بنجاح! سنتواصل معك قريباً لتأكيد الحجز.' ) );
}
add_action( 'wp_ajax_nopriv_submit_booking', 'hajzatik_submit_booking' );
add_action( 'wp_ajax_submit_booking', 'hajzatik_submit_booking' );

/**
 * Seed Default Content Once
 */
function hajzatik_seed_default_content() {
    if ( get_option( 'hajzatik_default_content_seeded' ) ) {
        return;
    }

    // 1. Features
    $features = array(
        array('مواعيد أسرع', 'نساعدك في الوصول إلى المواعيد والحجوزات المطلوبة بأسرع وقت ممكن', 'assets/icon1.png'),
        array('متابعة عبر واتساب', 'فريق جاهز للتواصل والمتابعة حتى اكتمال طلبك', 'assets/icon2.png'),
        array('بدون بحث طويل', 'بدلاً من البحث والمقارنة، اختر الخدمة واترك المهمة علينا', 'assets/icon3.png')
    );
    foreach($features as $f) {
        $id = wp_insert_post(array('post_title'=>$f[0], 'post_content'=>$f[1], 'post_type'=>'feature', 'post_status'=>'publish'));
        update_post_meta($id, '_default_image', $f[2]);
    }

    // 2. Services
    $services = array(
        array('المواعيد الطبية', 'حجز المستشفيات الخاصة والمراكز الصحية ذات الضغط العالي', 'assets/service1.png'),
        array('الفعاليات والمناسبات', 'حجوزات الفعاليات الرياضية والترفيهية حسب التوفر', 'assets/service2.png'),
        array('السفر والطيران', 'حجوزات وتذاكر السفر وفق احتياجك', 'assets/service3.png'),
        array('المطاعم', 'حجوزات المطاعم والمواقع المميزة', 'assets/service4.png'),
        array('السيارات', 'حجز مواعيد الصيانة والخدمات الدورية للسيارات', 'assets/service5.png'),
        array('الخدمات الخاصة', 'تنسيق ومتابعة الطلبات الخاصة حسب الحاجة', 'assets/service6.png')
    );
    foreach($services as $s) {
        $id = wp_insert_post(array('post_title'=>$s[0], 'post_content'=>$s[1], 'post_type'=>'service', 'post_status'=>'publish'));
        update_post_meta($id, '_default_image', $s[2]);
    }

    // 3. Testimonials
    $testimonials = array(
        array('خالد العتيبي', 'موعد طبي', 'كنت أبحث عن موعد سريع مع استشاري مشهور وكانت المواعيد بعيدة جداً. تواصلت مع Hajzatik وتمت مساعدتي في الحصول على موعد مناسب خلال وقت قصير. الخدمة كانت احترافية والمتابعة ممتازة.'),
        array('سارة أحمد', 'حجوزات طيران', 'تطبيق ممتاز! ساعدوني في حجز رحلة طيران بسعر ممتاز وفي وقت قياسي جداً بعد أن فقدت الأمل في إيجاد حجوزات متاحة. شكراً لفريق الدعم على سرعة الاستجابة.'),
        array('فيصل عبدالرحمن', 'تذاكر فعاليات', 'واجهت صعوبة في الحصول على تذاكر لإحدى الفعاليات الكبرى بسبب نفاذها السريع، ولكن فريق حجوزاتك وفرها لي بكل سهولة. أنصح بالتعامل معهم بشدة لسرعتهم وموثوقيتهم.'),
        array('عبدالله الدوسري', 'حجز مطعم', 'أردت حجز طاولة في أحد المطاعم المزدحمة لمناسبة خاصة، وبفضل فريق حجوزاتك تم تأكيد الحجز في أقل من ساعة. تجربة رائعة ومريحة جداً!')
    );
    foreach($testimonials as $t) {
        wp_insert_post(array('post_title'=>$t[0], 'post_excerpt'=>$t[1], 'post_content'=>$t[2], 'post_type'=>'testimonial', 'post_status'=>'publish'));
    }

    // 4. FAQs
    $faqs = array(
        array('كيف يمكنني تقديم طلب حجز؟', 'يمكنك بسهولة تقديم طلبك عبر تعبئة النموذج الموجود في صفحة "اطلب خدمتك"، أو من خلال التواصل معنا مباشرة عبر زر الواتساب وسيقوم فريقنا بمتابعة طلبك فوراً.'),
        array('ما هي أنواع الحجوزات التي توفرونها؟', 'نغطي مجموعة واسعة من الخدمات تشمل المواعيد الطبية في المستشفيات، تذاكر الطيران والفنادق، حجوزات المطاعم الكبرى، وتذاكر الفعاليات والمناسبات الترفيهية.'),
        array('هل هناك رسوم إضافية على الخدمة؟', 'نعم، نتقاضى رسوماً رمزية مقابل خدمة التنسيق والمتابعة السريعة نيابة عنك. يتم توضيح جميع الرسوم بشكل شفاف قبل تأكيد الحجز لضمان رضاك التام.'),
        array('كم يستغرق تأكيد الحجز؟', 'يعتمد وقت التأكيد على نوع الخدمة ومدى توفرها، ولكننا نتميز بسرعة الاستجابة. في العادة يتم إنجاز وتأكيد معظم الطلبات خلال ساعات قليلة من استلام الطلب.'),
        array('ماذا لو أردت إلغاء أو تعديل حجزي؟', 'يمكنك تعديل أو إلغاء حجزك من خلال التواصل مع خدمة العملاء لدينا عبر الواتساب. يخضع الإلغاء لسياسات مزود الخدمة الأصلي وسنقوم بمساعدتك في كافة الإجراءات.'),
        array('هل بياناتي الشخصية آمنة؟', 'بكل تأكيد. نحن نولي خصوصية عملائنا أهمية قصوى، ونستخدم أحدث الأنظمة لضمان سرية معلوماتك الشخصية وعدم مشاركتها مع أي جهة غير مصرح لها.')
    );
    foreach($faqs as $f) {
        wp_insert_post(array('post_title'=>$f[0], 'post_content'=>$f[1], 'post_type'=>'faq', 'post_status'=>'publish'));
    }

    update_option( 'hajzatik_default_content_seeded', true );
}
add_action( 'admin_init', 'hajzatik_seed_default_content' );
