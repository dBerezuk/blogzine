<?php
//подлючение стилей и скриптов
add_action('wp_enqueue_scripts', function(){
    //стили
    //стили для главной страницы
//    if(is_page_template('index.php')){
        wp_enqueue_style('tiny-slider',get_template_directory_uri() . '/assets/vendor/tiny-slider/tiny-slider.css');
        //wp_enqueue_style('plyr', get_template_directory_uri() . '/assets/vendor/plyr/plyr.css');
//    }
    //стили для страницы записи
    if(is_single()){
        wp_enqueue_style('glightbox', get_template_directory_uri() . '/assets/vendor/glightbox/css/glightbox.css');
    }

    //wp_enqueue_style('fonts-gstatic', 'https://fonts.gstatic.com');
    wp_enqueue_style('fonts', 'https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@400;700&family=Rubik:wght@400;500;700&display=swap');
    wp_enqueue_style('font-awesome', get_template_directory_uri() . '/assets/vendor/font-awesome/css/all.min.css');
    wp_enqueue_style('bootstrap-icons','https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css');
    wp_enqueue_style('style', get_template_directory_uri() . '/assets/css/style.css');
    //скрипты
    //скрипты для главной страницы
//    if(is_page_template('index.php')){
        wp_enqueue_script('tiny-slider', get_template_directory_uri() . '/assets/vendor/tiny-slider/tiny-slider.js',[],'null',true);
        //wp_enqueue_script('plyr', get_template_directory_uri() . '/assets/vendor/plyr/plyr.js',[],'null',true);
//    }
    //скрипты для страницы записи
    if(is_single()){
        wp_enqueue_script('glightbox', get_template_directory_uri() . '/assets/vendor/glightbox/js/glightbox.js',[],'1.0',true);
    }
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
    wp_enqueue_script('bootstrap', get_template_directory_uri() . '/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js',[],'5.3.0',true);
    wp_enqueue_script('sticky', get_template_directory_uri() . '/assets/vendor/sticky-js/sticky.min.js',[],'null',true);
    wp_enqueue_script('functions', get_template_directory_uri() . '/assets/js/functions.js',[],'1.0',true);

});


add_theme_support(
    'html5',
    array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script',
    )
);

add_theme_support('post-thumbnails');
add_theme_support('title-tag');
add_theme_support('custom-logo');


## Отключает Гутенберг (новый редактор блоков в WordPress).
## ver: 1.2
if( 'disable_gutenberg' ){
    remove_theme_support( 'core-block-patterns' ); // WP 5.5

    add_filter( 'use_block_editor_for_post_type', '__return_false', 100 );

    // отключим подключение базовых css стилей для блоков
    // ВАЖНО! когда выйдут виджеты на блоках или что-то еще, эту строку нужно будет комментировать
    remove_action( 'wp_enqueue_scripts', 'wp_common_block_scripts_and_styles' );

    // Move the Privacy Policy help notice back under the title field.
    add_action( 'admin_init', function(){
        remove_action( 'admin_notices', [ 'WP_Privacy_Policy_Content', 'notice' ] );
        add_action( 'edit_form_after_title', [ 'WP_Privacy_Policy_Content', 'notice' ] );
    } );
}

//Страница настроек
add_action('pre_get_posts',function($query){
    if(!is_admin() && !is_main_query()){
        return false;
    }
    global $typenow;
    if($typenow == "page"){
        $settings_page = get_page_by_path("options-page",NULL,"page")->ID;
        $query->set('post__not_in',[$settings_page]);
    }
    return;
});
//добавление страницы настроек в панель
add_action('admin_menu',function(){
    add_menu_page(
        'Страница настроек',
        'Страница настроек',
        'manage_options',
        'post.php?post=' . get_page_by_path("options-page",NULL,"page")->ID . '&action=edit',
        '',
        'dashicons-admin-tools',
        16
    );
});

//отключение визуального редактора от страницы по выбраному id

add_action('admin_init',function(){
    if (isset($_GET['post'])) {
        $post_ID = $_GET['post'];
    } else if (isset($_POST['post_ID'])) {
        $post_ID = $_POST['post_ID'];
    }

    if (!isset($post_ID) || empty($post_ID)) {
        return;
    }
    $disabled_IDs = [16,8,266,269];
    if (in_array($post_ID, $disabled_IDs)) {
        remove_post_type_support('page', 'editor');
    }
});

//меню

register_nav_menus(
    [
        'header-top-menu' => esc_html__( 'меню верхняя часть в header', 'blogzine' ),
        'header-menu' => esc_html__( 'меню в header', 'blogzine' ),
        'footer-menu-page' => esc_html__( 'меню в footer страницы', 'blogzine' ),
        'footer-menu-platform' => esc_html__( 'меню в footer платформы', 'blogzine' ),
    ]
);

//меню добавление класса для li
add_filter( 'nav_menu_css_class', function($classes, $item, $args, $depth){
    $has_submenu = in_array( 'menu-item-has-children', $item->classes );
    $addClassDropdown = $has_submenu ? ' dropdown' : '';
    $classes[] = 'nav-item' . $addClassDropdown;
    if($depth == 1){
        $classes[] = 'dropdown-submenu dropend';
    }
    return $classes;
}, 10, 4 );
//меню добавление класса для a
add_filter('nav_menu_link_attributes',function ($atts, $item, $args, $depth){
    $has_submenu = in_array( 'menu-item-has-children', $item->classes );
    $addClassDropdownToggle = $has_submenu ? ' dropdown-toggle' : '';
    $atts['class'] = 'nav-link' . $addClassDropdownToggle;

    if($depth >= 1){
        $has_submenu_2 = in_array( 'menu-item-has-children', $item->classes );
        $addClassDropdownToggle = $has_submenu_2 ? ' dropdown-toggle' : '';
        $atts['class'] = 'dropdown-item' .$addClassDropdownToggle;
    }
    return $atts;
}, 10, 4);

//добавление тега span к ссылке в меню footer
add_filter('wp_nav_menu_objects',function ($items, $args) {
    if ($args->theme_location == 'footer-menu-page') {
        foreach ($items as $item) {
            if ($item->title === 'Статьи') {
                $count_posts = wp_count_posts();
                $item->title = $item->title . '<span class="badge text-bg-danger ms-2">' . $count_posts->publish .  '</span>';
            }
        }
    }
    return $items;
},10, 2);

// вложеное меню - добавление класса к ul
add_filter( 'nav_menu_submenu_css_class', 'change_wp_nav_menu', 10, 3 );

function change_wp_nav_menu( $classes, $args, $depth ) {
    if ( $args->theme_location == 'header-menu') {
        $classesSubMenu = $depth >= 1 ? ' dropdown-menu-start': '';
        $classes[] = 'dropdown-menu' . $classesSubMenu;
    }

    return $classes;
}

function add_data_popper_attribute( $items, $args ) {
    // Проверяем, является ли текущий объект меню экземпляром класса Walker_Nav_Menu
    if ( $args->walker instanceof Walker_Nav_Menu ) {
        // Добавляем атрибут data-bs-popper="none" к элементу <ul> меню
        $items = str_replace( '<ul', '<ul data-bs-popper="none"', $items );
    }

    return $items;
}
add_filter( 'wp_nav_menu', 'add_data_popper_attribute', 10, 2 );



function padeg_wplife ($before,$number) {
    $numbers = array(2,0,1,1,1,2);
    echo $number . ' ' . $before[($number%100>4 && $number%100<20)? 2: $numbers[min($number%10, 5)]];
}

//функция для подчета сколько займет статья чтоб прочитать её
function get_reading_time($content){
    $words_per_minute = 225;
    $word_count = str_word_count(strip_tags($content),0,'АаБбВвГгДдЕеЁёЖжЗзИиЙйКкЛлМмНнОоПпРрСсТтУуФфХхЦцЧчШшЩщЪъЫыЬьЭэЮюЯя');
    $reading_time = ceil($word_count / $words_per_minute);
    return padeg_wplife(['минуту','минуты','минут'],$reading_time) . ' читать';
}


//отключаем возможность счетчика просмотров обычных страниц, только посты
function exclude_pages_from_postviews( $should_count, $post_id ) {
    if ( 'post' === get_post_type( $post_id ) ) {
        return true;
    }

    return false;
}
add_filter( 'postviews_should_count', 'exclude_pages_from_postviews', 10, 2 );


//перемещение в блоке коментарии comment в низ
function bottom_commentfield($fields){
    $comment_field = $fields['comment'];
    unset($fields['comment']);
    $fields['comment'] = $comment_field;
    return $fields;
}

add_filter('comment_form_fields', 'bottom_commentfield');


//пагинация все статьи
function kama_paginate_links_data( array $args ): array {
    global $wp_query;

    $args += [
//        'total'        => 1,
//        'current'      => 0,
        'url_base'     => '/{pagenum}',
        'first_url'    => '',
        'mid_size'     => 2,
        'end_size'     => 1,
        'show_all'     => false,
        'a_text_patt'  => '%s',
        'is_prev_next' => false,
        'prev_text'    => '« Previous',
        'next_text'    => 'Next »',
    ];

    $rg = (object) $args;

    $total_pages = max( 1, (int) ( $rg->total ?: $wp_query->max_num_pages ) );

    if( $total_pages === 1 ){
        return [];
    }

    // fix working parameters

    $rg->total = $total_pages;
    $rg->current = max( 1, abs( $rg->current ?: get_query_var( 'paged', 1 ) ) );

    $rg->url_base = $rg->url_base ?: str_replace( PHP_INT_MAX, '{pagenum}', get_pagenum_link( PHP_INT_MAX ) );
    $rg->url_base = wp_normalize_path( $rg->url_base );

    if( ! $rg->first_url ){
        // /foo/page(d)/2 >>> /foo/ /foo?page(d)=2 >>> /foo/
        $rg->first_url = preg_replace( '~/paged?/{pagenum}/?|[?]paged?={pagenum}|/{pagenum}/?~', '', $rg->url_base );
        $rg->first_url = user_trailingslashit( $rg->first_url );
    }

    // core array

    if( $rg->show_all ){
        $active_nums = range( 1, $rg->total );
    }
    else {

        if( $rg->end_size > 1 ){
            $start_nums = range( 1, $rg->end_size );
            $end_nums = range( $rg->total - ($rg->end_size - 1), $rg->total );
        }
        else {
            $start_nums = [ 1 ];
            $end_nums = [ $rg->total ];
        }

        $from = $rg->current - $rg->mid_size;
        $to = $rg->current + $rg->mid_size;

        if( $from < 1 ){
            $to = min( $rg->total, $to + absint( $from ) );
            $from = 1;

        }
        if( $to > $rg->total ){
            $from = max( 1, $from - ($to - $rg->total) );
            $to = $rg->total;
        }

        $active_nums = array_merge( $start_nums, range( $from, $to ), $end_nums );
        $active_nums = array_unique( $active_nums );
        $active_nums = array_values( $active_nums ); // reset keys
    }

    // fill by core array

    $pages = [];

    if( 1 === count( $active_nums ) ){
        return $pages;
    }

    $item_data = static function( $num ) use ( $rg ){

        $data = [
            'is_current'   => false,
            'page_num'     => null,
            'url'          => null,
            'link_text'    => null,
            'is_prev_next' => false,
            'is_dots'      => false,
        ];

        if( 'dots' === $num ){

            return (object) ( [
                    'is_dots' => true,
                    'link_text' => '…',
                ] + $data );
        }

        $is_prev = 'prev' === $num && ( $num = max( 1, $rg->current - 1 ) );
        $is_next = 'next' === $num && ( $num = min( $rg->total, $rg->current + 1 ) );

        $data = [
                'is_current'   => ! ( $is_prev || $is_next ) && $num === $rg->current,
                'page_num'     => $num,
                'url'          => 1 === $num ? $rg->first_url : str_replace( '{pagenum}', $num, $rg->url_base ),
                'is_prev_next' => $is_prev || $is_next,
            ] + $data;

        if( $is_prev ){
            $data['link_text'] = $rg->prev_text;
        }
        elseif( $is_next ) {
            $data['link_text'] = $rg->next_text;
        }
        else {
            $data['link_text'] = sprintf( $rg->a_text_patt, $num );
        }

        return (object) $data;
    };

    foreach( $active_nums as $indx => $num ){

        $pages[] = $item_data( $num );

        // set dots
        $next = $active_nums[ $indx + 1 ] ?? null;
        if( $next && ($num + 1) !== $next ){
            $pages[] = $item_data( 'dots' );
        }
    }

    if( $rg->is_prev_next ){
        $rg->current !== 1 && array_unshift( $pages, $item_data( 'prev' ) );
        $rg->current !== $rg->total && $pages[] = $item_data( 'next' );
    }

    return $pages;
}


//отключение меню админка сверху
add_filter('after_setup_theme',function(){
    show_admin_bar(false);
});





?>