<?php

function prepareSiteOptions()
{

    $social = array(
        'instagram' => get_field('field_5949a2a73c828', 'option'),
        'twitter'   => get_field('field_5949a2c33c829', 'option'),
        'facebook'  => get_field('field_5949a2c93c82a', 'option'),
        'pinterest' => get_field('field_5949a2d13c82b', 'option'),
    );

    $options = array(
        'social' => $social,
    );
    return $options;
}
function prepareBlogPostFields()
{
    $gridImageId = get_field('field_59499f895468c');
    if ($gridImageId != null) {
        $gridImage = new TimberImage($gridImageId);
    } else {
        $gridImage = new TimberImage(get_post_thumbnail_id());
    }
    $pinnedPostImageId = get_field('field_5949b17e82130');
    if ($pinnedPostImageId != null) {
        $pinnedPostImage = new TimberImage($pinnedPostImageId);
    } else {
        $pinnedPostImage = new TimberImage(get_post_thumbnail_id());
    }
    $details = array(
        'grid_image'             => $gridImage,
        'pinned_post_image'      => $pinnedPostImage,
        'pinned_post'            => get_field('field_59499fc15468d'),
        'pinned_post_expiration' => get_field('field_59499fd15468e'),
    );
    $event = get_field('field_5949b93c14a89');

    if ($event != null) {
        $event = array(
            'start_date' => get_field('field_5949b94f2b5f2'),
            'start_time' => get_field('field_5949b9c00a1eb'),
            'end_date'   => get_field('field_5949b99a2b5f4'),
            'end_time'   => get_field('field_5949b9d20a1ec'),
        );
    }
    $section = array(
        'details' => $details,
        'event'   => $event,
    );
    return $section;

}
