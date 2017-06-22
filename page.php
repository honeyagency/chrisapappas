<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * To generate specific templates for your pages you can use:
 * /mytheme/views/page-mypage.twig
 * (which will still route through this PHP file)
 * OR
 * /mytheme/page-mypage.php
 * (in which case you'll want to duplicate this file and save to the above path)
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since    Timber 0.1
 */

$context         = Timber::get_context();
$post            = new TimberPost();
$context['post'] = $post;

$pinpost = getCustomPosts('post', -1, null, 'date', null, null);

$pinnedPost           = null;
$pinPostId            = null;
$context['instagram'] = $instagramCachedResults;

foreach ($pinpost as $post) {

    // If there is a pinned post that isn't expired, we'll add it to a context

    if ($post['custom']['details']['pinned_post'] == 'true' and $post['custom']['details']['pinned_post_expiration'] > strtotime("now")) {
        $pinnedPost = $post;
        $pinPostId  = $post['id'];
        break;
    }

    // if there's nothing, we'll make the most recent post take its place (even if the most recent post is 'pinned' an has an expired pin date)

    if ($pinnedPost == null) {
        $pinnedPost = $pinpost['0'];
        $pinPostId  = $pinnedPost['id'];
    }
}
$context['pinnedPost'] = $pinnedPost;

$context['posts'] = getCustomPosts('post', 10, null, 'date', $pinPostId, null);

if (is_front_page()) {
    $context['home'] = prepareHomePageFields();
}

Timber::render(array('page-' . $post->post_name . '.twig', 'page.twig'), $context);
