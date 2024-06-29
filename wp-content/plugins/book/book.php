<?php
/**
 * Plugin Name: book
 * Plugin URI: http://example.com
 * Description: This plugin adds awesomeness to your site.
 * Version: 1.0
 * Author: Sergey Prokopovich
 * Author URI: http://example.com
 */

define( 'BOOK_VERSION', '1.0.0' );
define( 'BOOK__MINIMUM_WP_VERSION', '5.8' );
define( 'BOOK__PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'BOOK_DELETE_LIMIT', 10000 );






function my_gallery_shortcode() {
    return '<div class="my-gallery">Your gallery code here</div>';
}
add_shortcode('book_list', 'my_gallery_shortcode');


//function wp_learn_create_database_table() {
//    global $wpdb;
//
//    $table_name = $wpdb->prefix . 'book';
//
//    $charset_collate = $wpdb->get_charset_collate();
//
//
//    $sql = "CREATE TABLE $table_name (
//        id mediumint(9) NOT NULL AUTO_INCREMENT,
//        time datetime DEFAULT '0000-00-00 00:00:00' NOT NULL,
//        name tinytext NOT NULL,
//        text text NOT NULL,
//        url varchar(55) DEFAULT '' NOT NULL,
//        PRIMARY KEY  (id)
//    ) $charset_collate;";
//
//    require_once ABSPATH . 'wp-admin/includes/upgrade.php';
//    dbDelta( $sql );
//}
//
//register_activation_hook( __FILE__, 'wp_learn_create_database_table' );
//
//

add_action( 'init', 'register_taxonomy_genre' );

function register_taxonomy_genre() {

    $args = array(
        'labels' => array(
            'name'                     => 'жанр', // основное название во множественном числе
            'singular_name'            => 'жанр', // название единичного элемента таксономии
            'menu_name'                => 'жанры', // Название в меню. По умолчанию: name.
            'all_items'                => 'Все жанры',
            'edit_item'                => 'Изменить жанр',
            'view_item'                => 'Просмотр жанр', // текст кнопки просмотра записи на сайте (если поддерживается типом)
            'update_item'              => 'Обновить жанр',
            'add_new_item'             => 'Добавить новый жанр',
            'new_item_name'            => 'Название нового жанра',
            'parent_item'              => 'Родительский жанр', // только для таксономий с иерархией
            'parent_item_colon'        => 'Родительский жанр:',
            'search_items'             => 'Искать жанр',
            'popular_items'            => 'Популярные жанры', // для таксономий без иерархий
            'separate_items_with_commas' => 'Разделяйте жанры запятыми',
            'add_or_remove_items'      => 'Добавить или удалить направление',
            'choose_from_most_used'    => 'Выбрать из часто используемых жанров',
            'not_found'                => 'Жанр не найдено',
            'back_to_items'            => '← Назад к жанрам',
        ),
        'public' => true,
    );
    register_taxonomy( 'genre', 'book', $args );
}



add_action( 'init', 'register_book_types' );

function register_book_types(): void
{

    register_post_type( 'book', [

        'label'  => null,
        'labels' => [
            'name'               => 'книги', // основное название для типа записи
            'singular_name'      => 'книга', // название для одной записи этого типа
            'add_new'            => 'Добавить книгу', // для добавления новой записи
            'add_new_item'       => 'Добавление книги', // заголовка у вновь создаваемой записи в админ-панели.
            'edit_item'          => 'Редактирование книги', // для редактирования типа записи
            'new_item'           => 'Новое ____', // текст новой записи
            'view_item'          => 'Смотреть книгу', // для просмотра записи этого типа.
            'search_items'       => 'Искать rybue', // для поиска по этим типам записи
            'not_found'          => 'Не найдено', // если в результате поиска ничего не было найдено
            'not_found_in_trash' => 'Не найдено в корзине', // если не было найдено в корзине
            'parent_item_colon'  => '', // для родителей (у древовидных типов)
            'menu_name'          => 'Книги', // название меню
        ],
        'public'                 => true,
        // 'publicly_queryable'  => null, // зависит от public
        // 'exclude_from_search' => null, // зависит от public
        // 'show_ui'             => null, // зависит от public
        // 'show_in_nav_menus'   => null, // зависит от public
        'show_in_menu'           => null, // показывать ли в меню админки
        // 'show_in_admin_bar'   => null, // зависит от show_in_menu
        'show_in_rest'        => null, // добавить в REST API. C WP 4.7
        'rest_base'           => null, // $post_type. C WP 4.7
        'menu_position'       => null,
        'menu_icon'           => null,
        //'capability_type'   => 'post',
        //'capabilities'      => 'post', // массив дополнительных прав для этого типа записи
        //'map_meta_cap'      => null, // Ставим true чтобы включить дефолтный обработчик специальных прав
        'hierarchical'        => false,
        'supports'            => [ 'title',  'description', 'editor' ], // 'title','editor','author','thumbnail','excerpt','trackbacks','custom-fields','comments','revisions','page-attributes','post-formats'
        'taxonomies'          => ['genre'],
        'has_archive'         => false,
        'rewrite'             => true,
        'query_var'           => true,
        'register_meta_box_cb' => 'add_project_metaboxes',
    ] );

}


add_action( 'init', 'true_add_excerpt_to_pages' );

function true_add_excerpt_to_pages() {
    add_post_type_support( 'description', 'editor' );
}


add_filter( 'rwmb_meta_boxes', 'prefix_meta_boxes' );
function prefix_meta_boxes( $meta_boxes ) {

    $meta_boxes[] = array(
        'title'  => 'Test Meta Box',
        'fields' => array(
            array(
                'id'   => 'custom_autor',
                'name' => 'custom_autor',
                'type' => 'text',
            ),
            array(
                'id'   => 'custom_published_date',
                'name' => 'custom_published_date',
                'type' => 'date',
                'js_options' => [
                    'dateFormat'      => 'yy-mm-dd',
                    'showButtonPanel' => false,
                ],
                'inline'    => false,
                'timestamp' => false
            ),
        ),
    );

    return $meta_boxes;
}

function add_project_metaboxes() {
    add_meta_box('custom_autor', 'autor', 'global_notice_meta_box_callback', 'book', 'normal', 'default');
    add_meta_box('custom_published_date', 'date', 'date_c', 'book', 'normal', 'default');
}


function global_notice_meta_box_callback( $post ) {

    // Добавляем поле nonce, чтобы потом его проверить.
    wp_nonce_field( 'global_notice_nonce', 'global_notice_nonce' );

    $value = get_post_meta( $post->ID, '_global_notice', true );

    echo '<textarea style="width:100%" id="global_notice" name="global_notice">' . esc_attr( $value ) . '</textarea>';
}

function date_c( $post ) {

    // Добавляем поле nonce, чтобы потом его проверить.
    wp_nonce_field( 'custom_date_nonce', 'custom_date_nonce' );

    $value = get_post_meta( $post->ID, '_custom_date', true );

    echo '
	<label for="custom_date">Custom date</label>	
	<input id="custom_date" name="custom_date" type="date" value="' . esc_attr( $value ) . '">
';
}


function save_global_notice_meta_box_data( $post_id ) {

    // Проверяем, задано ли поле nonce.
    if ( ! isset( $_POST['global_notice_nonce'] ) ) {
        return;
    }

    // Проверяем nonce на валидность.
    if ( ! wp_verify_nonce( $_POST['global_notice_nonce'], 'global_notice_nonce' ) ) {
        return;
    }

    // Если было автосохранение, наша форма не отправилась, нам ничего делать не нужно.
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    // Проверяем разрешения пользователя.
    if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {

        if ( ! current_user_can( 'edit_page', $post_id ) ) {
            return;
        }

    }
    else {

        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }
    }

    /* OK, теперь сохранять данные безопасно. */

    // Проверяем.
    if ( ! isset( $_POST['global_notice'] ) ) {
        return;
    }

    // Очищаем введенные данные.
    $my_data = sanitize_text_field( $_POST['global_notice'] );

    // Обновляем мета поле в базе данных.
    update_post_meta( $post_id, '_global_notice', $my_data );
}

add_action( 'save_post', 'save_global_notice_meta_box_data' );




function save_date_c( $post_id ) {

    // Проверяем, задано ли поле nonce.
    if ( ! isset( $_POST['custom_date_nonce'] ) ) {
        return;
    }

    // Проверяем nonce на валидность.
    if ( ! wp_verify_nonce( $_POST['custom_date_nonce'], 'custom_date_nonce' ) ) {
        return;
    }

    // Если было автосохранение, наша форма не отправилась, нам ничего делать не нужно.
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    // Проверяем разрешения пользователя.
    if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {

        if ( ! current_user_can( 'edit_page', $post_id ) ) {
            return;
        }

    }
    else {

        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }
    }

    /* OK, теперь сохранять данные безопасно. */

    // Проверяем.
    if ( ! isset( $_POST['custom_date'] ) ) {
        return;
    }

    // Очищаем введенные данные.
    $my_data = sanitize_text_field( $_POST['custom_date'] );

    // Обновляем мета поле в базе данных.
    update_post_meta( $post_id, '_custom_date', $my_data );
}

add_action( 'save_post', 'save_date_c' );
