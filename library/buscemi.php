<?php

date_default_timezone_set('America/Los_Angeles');
// Adding documentation to the dash
function bc_dashboard_widget_function()
{
    $docs_template = get_template_directory() . '/library/docs.php';
    load_template($docs_template);
}
function bc_add_dashboard_widgets()
{
    wp_add_dashboard_widget('wp_dashboard_widget', 'Training Documents', 'bc_dashboard_widget_function');
}
add_action('wp_dashboard_setup', 'bc_add_dashboard_widgets');

// add ie conditional html5 shim to header
function add_ie_html5_shim()
{
    echo '<!--[if lt IE 9]>';
    echo '<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>';
    echo '<![endif]-->';
}
add_action('wp_head', 'add_ie_html5_shim');

// Remove WP 4.2 emoji
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_styles', 'print_emoji_styles');

// Getting rid of WP Default jquery and adding from google
if (!is_admin()) {
    add_action("wp_enqueue_scripts", "jquery_enqueue", 11);
}

function jquery_enqueue()
{
    wp_dequeue_script('jquery');
    wp_deregister_script('jquery');
    wp_register_script('jquery', "http" . ($_SERVER['SERVER_PORT'] == 443 ? "s" : "") . "://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.slim.min.js", false, '5', true);

}




// Enqueuing all of our scripts and styles
function buscemi_scripts()
{
    wp_enqueue_script('jquery');
    wp_register_script('picturefill', get_template_directory_uri() . '/app/vendors/picturefill.min.js', array('jquery'), false, true);
    wp_enqueue_script('picturefill');

    wp_enqueue_style('buscemi_style', get_template_directory_uri() . '/app/main.min.css', null, '5', null);
    wp_enqueue_script('buscemi_script', get_template_directory_uri() . '/app/app.min.js', array('jquery'), null, true);
}
add_action('wp_enqueue_scripts', 'buscemi_scripts');

// Allowing SVG preveiw in WP Upload
function cc_mime_types($mimes)
{
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

// Setting up ACF options page
if (function_exists('acf_add_options_page')) {
    acf_add_options_page();
}

add_theme_support('post-thumbnails');
add_image_size('medium_large', 1380, 9999); // Unlimited Height Mode
// update_option('medium_large_size_w', 1380);
// update_option('medium_large_size_h', 9999);

function addDiamondsToQuotes($content)
{
    return preg_replace('/<blockquote>\\s*?/s', '<blockquote><i class="icon-diamond" data-grunticon-embed></i>', $content);
}

// img unautop

add_filter('the_content', 'addDiamondsToQuotes');

// load a list of recent images from instagram
require_once 'instagram.php';


function new_excerpt_more($more)
{
    return '&hellip;';
}
add_filter('excerpt_more', 'new_excerpt_more');

require_once 'functions--custom-fields.php';
require_once 'functions--custom-posts.php';
