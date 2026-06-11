<?php
/**
 * The template for displaying all single pages
 */
get_header();
?>

    <!-- Page Banner -->
    <section class="cta-banner" style="min-height: 250px; align-items: center; display: flex;">
        <div class="container">
            <div class="cta-content" style="min-height: 250px; background-image: url('<?php echo get_template_directory_uri(); ?>/assets/cta_banner.png');">
                <div class="cta-overlay" style="display: block;"></div>
                <div class="cta-text-box" style="text-align: center; margin: 0 auto; max-width: 800px;">
                    <h1 class="cta-title" style="margin-bottom: 0;"><?php the_title(); ?></h1>
                </div>
            </div>
        </div>
    </section>

    <!-- Page Content -->
    <section class="page-content" style="padding: 60px 0;">
        <div class="container">
            <div class="page-content-inner" style="background: #fff; padding: 40px; border-radius: var(--border-radius-lg); box-shadow: 0 5px 20px rgba(0,0,0,0.03);">
                <?php
                while ( have_posts() ) :
                    the_post();
                    the_content();
                endwhile;
                ?>
            </div>
        </div>
    </section>

<?php
get_footer();
