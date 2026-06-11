<?php
/**
 * The template for displaying all single pages
 */
get_header();
?>

    <!-- Page Banner -->
    <section class="page-header-banner" style="position: relative; min-height: 300px; display: flex; align-items: center; justify-content: center; background-image: url('<?php echo get_template_directory_uri(); ?>/assets/cta_banner.png'); background-size: cover; background-position: center; margin-bottom: 60px;">
        <div class="cta-overlay" style="display: block; position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: rgba(0,0,0,0.6); z-index: 1;"></div>
        <div class="container" style="position: relative; z-index: 2; text-align: center;">
            <h1 class="cta-title" style="color: #fff; margin-bottom: 0; font-size: 36px;"><?php the_title(); ?></h1>
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
