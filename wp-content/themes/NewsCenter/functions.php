<?php

require get_template_directory() . '/inc/hooks/enqueue_style.php';

if (is_user_logged_in()) {
    add_filter('show_admin_bar', '__return_true');
}