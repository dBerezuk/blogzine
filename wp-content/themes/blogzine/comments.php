<div class="mt-5 comments">
    <?php
    $countComments = get_comments_number();
    if(get_comments_number() > 0){
    ?>
    <h3><?php padeg_wplife(['коментарий','коментария','коментарий'],$countComments); ?></h3>
    <?php
    }

    wp_list_comments(
        [
            'style'      => 'div',
            'short_ping' => true,
            'avatar_size' => '48',
        ]
    );


    $req = get_option( 'require_name_email' );
    $html_req = ( $req ? " required='required'" : '' );
    //    $html5    = 'html5' === $args['format'];
    $aria_req = ( $req ? " aria-required='true'" : '' );
    $commenter = wp_get_current_commenter();

    comment_form([
    //    'logged_in_as' => '',
        'class_form' => 'row g-3 mt-2',
        'comment_notes_before' => '<small>Ваш адрес email не будет опубликован. Обязательные поля помечены *</small>',
        'fields' => [
            'author' => '<div class="col-md-6"><label class="form-label mb-2">Имя *</label><p class="comment-form-author"><input class="form-control" id="author"  name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . $html_req . ' /></p></div><div class="col-md-6"><label class="form-label mb-2">Email *</label><p class="comment-form-email"><input class="form-control" id="email" name="email" type="email" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" aria-describedby="email-notes"' . $aria_req . $html_req  . ' /></p></div>',
            'email'  => '',
            'cookies' => '<div class="col-md-12 mb-3 mt-1"><p class="comment-form-cookies-consent form-check"><input class="form-check-input" id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes"> <label class="form-check-label" for="wp-comment-cookies-consent">Сохранить моё имя, email и адрес сайта в этом браузере для последующих моих комментариев.</label></p></div>',
        ],
        'comment_field' => '<label class="form-label mb-2">Коментарий *</label><p class="comment-form-comment m-0"><textarea class="form-control" id="comment" name="comment" rows="3"  aria-required="true" required="required"></textarea></p>',
        'submit_button' => '<p class="form-submit mt-3"><button class="submit btn btn-primary" id="submit">Отправить</button></p>',
    ]);
    ?>
</div>
