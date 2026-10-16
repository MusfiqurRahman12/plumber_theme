<?php
/**
 * The template for displaying comments
 *
 * @package PlumberX
 */

if ( post_password_required() ) {
    return;
}
?>

<div id="comments" class="comments-area">

    <?php if ( have_comments() ) : ?>
        <h3 class="comments-title" style="font-size: 20px; font-weight: 700; color: var(--primary-navy); margin-bottom: 20px;">
            <?php
            $comment_count = get_comments_number();
            if ( '1' === $comment_count ) {
                printf( esc_html__( 'One Comment on &ldquo;%1$s&rdquo;', 'plumberx' ), '<span>' . wp_kses_post( get_the_title() ) . '</span>' );
            } else {
                printf(
                    esc_html( _nx( '%1$s Comment on &ldquo;%2$s&rdquo;', '%1$s Comments on &ldquo;%2$s&rdquo;', $comment_count, 'comments title', 'plumberx' ) ),
                    number_format_i18n( $comment_count ),
                    '<span>' . wp_kses_post( get_the_title() ) . '</span>'
                );
            }
            ?>
        </h3>

        <ol class="comment-list" style="list-style: none; padding: 0; margin-bottom: 35px;">
            <?php
            wp_list_comments( array(
                'style'       => 'ol',
                'short_ping'  => true,
                'avatar_size' => 50,
            ) );
            ?>
        </ol>

        <?php the_comments_navigation(); ?>

    <?php endif; ?>

    <?php
    $commenter     = wp_get_current_commenter();
    $req           = get_option( 'require_name_email' );
    $aria_req      = ( $req ? " aria-required='true'" : '' );
    $html_req      = ( $req ? " required='required'" : '' );

    $fields = array(
        'author' => '<div style="display: grid; grid-template-columns: 1fr 1fr; gap: 16px;"><div class="form-group">' .
                    '<label style="font-size: 12.5px; font-weight: 600; color: #334155; margin-bottom: 6px; display:block;">' . esc_html__( 'Name', 'plumberx' ) . ( $req ? ' *' : '' ) . '</label>' .
                    '<input id="author" name="author" type="text" class="form-input" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . $html_req . ' /></div>',
        'email'  => '<div class="form-group">' .
                    '<label style="font-size: 12.5px; font-weight: 600; color: #334155; margin-bottom: 6px; display:block;">' . esc_html__( 'Email', 'plumberx' ) . ( $req ? ' *' : '' ) . '</label>' .
                    '<input id="email" name="email" type="email" class="form-input" value="' . esc_attr( $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . $html_req . ' /></div></div>',
        'url'    => '<div class="form-group">' .
                    '<label style="font-size: 12.5px; font-weight: 600; color: #334155; margin-bottom: 6px; display:block;">' . esc_html__( 'Website', 'plumberx' ) . '</label>' .
                    '<input id="url" name="url" type="url" class="form-input" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></div>',
    );

    $comments_args = array(
        'fields'               => $fields,
        'comment_field'        => '<div class="form-group">' .
                                  '<label style="font-size: 12.5px; font-weight: 600; color: #334155; margin-bottom: 6px; display:block;">' . esc_html__( 'Comment', 'plumberx' ) . ' *</label>' .
                                  '<textarea id="comment" name="comment" class="form-input" rows="6" required="required"></textarea></div>',
        'class_container'      => 'comment-form-wrap',
        'title_reply'          => esc_html__( 'Leave a Reply', 'plumberx' ),
        'title_reply_before'   => '<h3 id="reply-title" class="comment-reply-title" style="font-size: 20px; font-weight: 700; color: var(--primary-navy); margin-bottom: 6px;">',
        'title_reply_after'    => '</h3>',
        'comment_notes_before' => '<p style="font-size: 12.5px; color: #64748b; margin-bottom: 22px;">' . esc_html__( 'Your email address will not be published. Required fields are marked *', 'plumberx' ) . '</p>',
        'submit_button'        => '<button name="%1$s" type="submit" id="%2$s" class="%3$s" style="width: auto; padding: 12px 30px;">%4$s</button>',
        'class_submit'         => 'btn-quote-submit',
        'label_submit'         => esc_html__( 'Post Comment', 'plumberx' ),
    );

    comment_form( $comments_args );
    ?>

</div>
