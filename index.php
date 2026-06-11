<?php
/**
 * The main template file (Blog Index)
 */
get_header();
?>

    <!-- Blog Banner -->
    <section class="cta-banner" style="min-height: 250px; align-items: center; display: flex;">
        <div class="container">
            <div class="cta-content" style="min-height: 250px; background-image: url('<?php echo get_template_directory_uri(); ?>/assets/cta_banner.png');">
                <div class="cta-overlay" style="display: block;"></div>
                <div class="cta-text-box" style="text-align: center; margin: 0 auto; max-width: 800px;">
                    <h1 class="cta-title" style="margin-bottom: 0;">المدونة</h1>
                    <p class="cta-description">أحدث الأخبار والمقالات</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Blog Content -->
    <section class="blog-content" style="padding: 60px 0;">
        <div class="container">
            <div class="services-grid" style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 30px;">
                <?php
                if ( have_posts() ) :
                    while ( have_posts() ) : the_post();
                        $thumbnail_url = get_the_post_thumbnail_url() ? get_the_post_thumbnail_url() : get_template_directory_uri() . '/assets/service1.png';
                ?>
                <div class="service-card blog-card" style="background: #fff;">
                    <div class="service-img" style="height: 200px;">
                        <img src="<?php echo esc_url( $thumbnail_url ); ?>" alt="<?php the_title_attribute(); ?>" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                    <div class="service-content" style="padding: 15px;">
                        <h3 style="font-size: 18px; margin-bottom: 10px;"><a href="<?php the_permalink(); ?>" style="color: var(--text-dark); text-decoration: none;"><?php the_title(); ?></a></h3>
                        <div style="font-size: 14px; color: var(--text-muted); margin-bottom: 20px;"><?php the_excerpt(); ?></div>
                        <a href="<?php the_permalink(); ?>" class="btn btn-dark btn-pill" style="font-size: 13px; padding: 8px 20px;">اقرأ المزيد</a>
                    </div>
                </div>
                <?php
                    endwhile;
                else :
                    echo '<p>لا توجد مقالات حالياً.</p>';
                endif;
                ?>
            </div>
            
            <!-- Pagination -->
            <div class="pagination" style="margin-top: 40px; text-align: center;">
                <?php
                the_posts_pagination( array(
                    'mid_size'  => 2,
                    'prev_text' => '<i class="fa-solid fa-arrow-right"></i> السابق',
                    'next_text' => 'التالي <i class="fa-solid fa-arrow-left"></i>',
                ) );
                ?>
            </div>
        </div>
    </section>

<?php
get_footer();
