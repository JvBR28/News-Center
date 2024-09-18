<?php

add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style('tailwind', get_template_directory_uri() . '/tailwind.css');
});
