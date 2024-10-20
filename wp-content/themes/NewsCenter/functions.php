<?php

require get_template_directory() . '/inc/hooks/enqueue_style.php';

if (is_user_logged_in()) {
    add_filter('show_admin_bar', '__return_true');
}

function register_my_menu() {
  register_nav_menu('menu-principal',__( 'Menu Principal' ));
}
add_action( 'init', 'register_my_menu' );

add_theme_support('post-thumbnails');



// Create custom post type 'News'
function create_news_post_type() {
  register_post_type('noticias',
      array(
          'labels' => array(
              'name' => __('Noticias'),
              'singular_name' => __('Item Noticias')
          ),
          'public' => true,
          'has_archive' => true,
          'rewrite' => array('slug' => 'noticias'),
          'supports' => array('title', 'editor', 'thumbnail'),
      )
  );
}
add_action('init', 'create_news_post_type');

// Transfer all existing posts to 'News' post type
function transfer_posts_to_news() {
  global $wpdb;

  $wpdb->query("UPDATE {$wpdb->posts} SET post_type = 'noticias' WHERE post_type = 'post'");
}
add_action('init', 'transfer_posts_to_news');

// Hide the default 'Posts' menu in the admin dashboard
function hide_default_posts_menu() {
  remove_menu_page('edit.php'); 
}
add_action('admin_menu', 'hide_default_posts_menu');
