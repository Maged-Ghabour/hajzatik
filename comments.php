<?php
/**
 * The template for displaying comments
 */

if ( post_password_required() ) {
    return;
}
?>

<div id="comments" class="comments-area" style="margin-top: 50px;">

    <?php if ( have_comments() ) : ?>
        <h3 class="comments-title" style="margin-bottom: 30px; font-weight: 700; font-size: 22px;">
            <?php
            $comment_count = get_comments_number();
            echo esc_html( $comment_count ) . ' تعليقات';
            ?>
        </h3>

        <ul class="comment-list" style="list-style: none; padding: 0; margin: 0;">
            <?php
            wp_list_comments( array(
                'style'       => 'ul',
                'short_ping'  => true,
                'avatar_size' => 60,
            ) );
            ?>
        </ul>

        <?php the_comments_navigation(); ?>
    <?php endif; ?>

    <?php
    if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
        ?>
        <p class="no-comments" style="margin-top: 20px; color: var(--text-muted);">التعليقات مغلقة.</p>
    <?php endif; ?>

    <?php
    $commenter = wp_get_current_commenter();
    $req = get_option( 'require_name_email' );
    
    comment_form( array(
        'title_reply_before'   => '<h3 id="reply-title" class="comment-reply-title" style="font-size: 22px; font-weight: 700; margin-bottom: 20px;">',
        'title_reply_after'    => '</h3>',
        'title_reply'          => 'اترك تعليقاً',
        'title_reply_to'       => 'الرد على %s',
        'cancel_reply_link'    => 'إلغاء الرد',
        'label_submit'         => 'إرسال التعليق',
        'class_submit'         => 'btn btn-dark btn-pill',
        'class_form'           => 'order-form custom-comment-form',
        'submit_button'        => '<button name="%1$s" type="submit" id="%2$s" class="%3$s">%4$s</button>',
        'submit_field'         => '<div class="form-submit">%1$s %2$s</div>',
        'comment_field'        => '<div class="form-group"><label for="comment">التعليق:</label><textarea id="comment" name="comment" cols="45" rows="4" required="required" class="form-control" placeholder="اكتب تعليقك هنا..."></textarea></div>',
        'fields'               => array(
            'author' => '<div class="form-row"><div class="form-group"><label for="author">الاسم:</label><input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" required="required" class="form-control" placeholder="محمد أحمد"></div>',
            'email'  => '<div class="form-group"><label for="email">البريد الإلكتروني:</label><input id="email" name="email" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" required="required" class="form-control" placeholder="البريد الإلكتروني (لن يتم نشره)"></div></div>',
            'url'    => '',
            'cookies' => '',
        ),
    ) );
    ?>

</div><!-- #comments -->
