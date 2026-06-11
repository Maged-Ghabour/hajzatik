<?php
/**
 * The template for displaying all single posts
 */
get_header();
?>

    <!-- Single Post Banner -->
    <section class="cta-banner" style="min-height: 250px; align-items: center; display: flex;">
        <div class="container">
            <div class="cta-content" style="min-height: 250px; background-image: url('<?php echo get_template_directory_uri(); ?>/assets/cta_banner.png');">
                <div class="cta-overlay" style="display: block;"></div>
                <div class="cta-text-box" style="text-align: center; margin: 0 auto; max-width: 800px;">
                    <h1 class="cta-title" style="margin-bottom: 0;"><?php the_title(); ?></h1>
                    <div class="post-meta" style="color: #ccc; margin-top: 15px; font-size: 14px;">
                        <span><i class="fa-regular fa-calendar"></i> <?php echo get_the_date(); ?></span>
                        <span style="margin: 0 10px;">|</span>
                        <span><i class="fa-regular fa-folder"></i> <?php the_category(', '); ?></span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Post Content -->
    <section class="single-post-content" style="padding: 60px 0;">
        <div class="container">
            <div class="post-content-inner" style="background: #fff; padding: 40px; border-radius: var(--border-radius-lg); box-shadow: 0 5px 20px rgba(0,0,0,0.03); max-width: 900px; margin: 0 auto;">
                <?php
                while ( have_posts() ) :
                    the_post();
                    if ( has_post_thumbnail() ) {
                        echo '<div style="margin-bottom: 30px; border-radius: 10px; overflow: hidden;">';
                        the_post_thumbnail('large', array('style' => 'width: 100%; height: auto; display: block;'));
                        echo '</div>';
                    }
                    the_content();
                    
                    // Comments
                    if ( comments_open() || get_comments_number() ) :
                        echo '<hr style="margin: 40px 0; border: none; border-top: 1px solid #eee;">';
                        comments_template();
                    endif;
                endwhile;
                ?>
            </div>
        </div>
    </section>

<?php
get_footer();
