<?php

function prepareSiteOptions()
{

    $social = array(
        'instagram' => get_field('field_5949a2a73c828', 'option'),
        'twitter'   => get_field('field_5949a2c33c829', 'option'),
        'facebook'  => get_field('field_5949a2c93c82a', 'option'),
        'pinterest' => get_field('field_5949a2d13c82b', 'option'),
        'youtube'   => get_field('field_5bbf8ba7de8c5', 'option'),
    );
    $email = array(
        'title'    => get_field('field_5952b2769b643', 'option'),
        'subtitle' => get_field('field_5952b2819b644', 'option'),
        'embed'    => get_field('field_5952b28d9b645', 'option'),
    );
    $text = array(
        'search' => get_field('field_59666d579c8d4', 'option'),
    );
    $options = array(
        'social' => $social,
        'email'  => $email,
        'text'   => $text,
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

    if (have_rows('field_5952e64708cef')) {

        while (have_rows('field_5952e64708cef')) {
            the_row();

            if (have_rows('field_5952e66a08cf1')) {
                $linkSection = array();
                while (have_rows('field_5952e66a08cf1')) {
                    the_row();
                    $imageId = get_sub_field('field_5952e68408cf3');
                    if (!empty($imageId)) {
                        $image = new TimberImage($imageId);
                    } else {
                        $image = null;
                    }
                    $linkSection[] = array(
                        'description' => get_sub_field('field_5952e68d08cf4'),
                        'link'        => get_sub_field('field_5952e67a08cf2'),
                        'image'       => $image,
                    );
                }
            }
            $postLinkSections[] = array(
                'title'    => get_sub_field('field_5952e65808cf0'),
                'sections' => $linkSection,
            );
        }
    }
    $section = array(
        'details' => $details,
        'links'   => $postLinkSections,
    );
    return $section;

}

function prepareHomePageFields()
{

    $about = array(
        'text'   => get_field('field_594af59666a67'),
        'button' => get_field('field_594af5ae66a69'),
        'url'    => get_field('field_594af5a366a68'),
    );
    $shop = array(
        'title'     => get_field('field_594af77fb3f25'),
        'paragraph' => get_field('field_594af784b3f26'),
        'button'    => get_field('field_594af790b3f27'),
        'url'       => get_field('field_594af7a3b3f28'),
    );

    $section = array(
        'about' => $about,
        'shop'  => $shop,
    );
    return $section;
}
