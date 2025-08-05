<?php
add_action('woocommerce_archive_description', 'custom_brand_archive_description', 5);
function custom_brand_archive_description() {
    if (is_tax('product_brand')) {
        remove_action('woocommerce_archive_description', 'woocommerce_taxonomy_archive_description', 10);

        $term_id = get_queried_object_id();
        $thumbnail_id = get_term_meta($term_id, 'thumbnail_id', true);
        $image_url = wp_get_attachment_url($thumbnail_id);
        $term_description = term_description($term_id);

        echo '<div class="brand-meta">';

        if ($image_url) {
            echo '<div class="brand-image-wrapper">';
            echo '<img src="' . esc_url($image_url) . '" alt="' . esc_attr(single_term_title('', false)) . '" class="brand-thumbnail" width="600" height="600">';
            echo '</div>';
        }

        if ($term_description) {
            echo '<div class="term-description">' . wp_kses_post($term_description) . '</div>';
        }

        echo '</div>';
    }
}
