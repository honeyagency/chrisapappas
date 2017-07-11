<?php
/**
 * Search results page
 *
 * Methods for TimberHelper can be found in the /lib sub-directory
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since   Timber 0.1
 */

$templates = array('search.twig', 'archive.twig', 'index.twig');
$context   = Timber::get_context();

function is_search_has_results()
{
    if (is_search()) {
        global $wp_query;
        $result = (0 != $wp_query->found_posts) ? true : false;
        return $result;
    }
}
$results            = is_search_has_results();
$context['results'] = $results;

if ($results == true) {
	$context['title'] = 'Search results for <span class="query">' . get_search_query() . '</span>';
}else{
	$context['title'] = 'It looks like there are no results for <span class="query">' . get_search_query() . '</span>';
}


$context['posts'] = Timber::get_posts();

Timber::render($templates, $context);
