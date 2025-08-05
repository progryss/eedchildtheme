<?php
// Start Load CDN link through Function.php
function enqueue_custom_assets() {
    // Load WordPress jQuery
    wp_enqueue_script('jquery');

    // Load Slick JS
    wp_enqueue_script(
        'slick-js',
        'https://cdn.jsdelivr.net/npm/slick-carousel/slick/slick.min.js',
        array('jquery'),
        null,
        true
    );
    // Load Slick CSS
    wp_enqueue_style('slick-css', 'https://cdn.jsdelivr.net/npm/slick-carousel/slick/slick.css');
    wp_enqueue_style('slick-theme-css', 'https://cdn.jsdelivr.net/npm/slick-carousel/slick/slick-theme.css');

    // Load Font Awesome
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css');
}

add_action('wp_enqueue_scripts', 'enqueue_custom_assets');
// End Load CDN link through Function.php


// Start All Custom Common Js 
function custom_enqueue_footer_js() {
    wp_enqueue_script(
        'common-script',
        get_stylesheet_directory_uri() . '/assets/js/common-script.js',
        array(), // Add jQuery or others here if needed
        '1.0.0',
        true // Load in footer
    );
}
add_action('wp_enqueue_scripts', 'custom_enqueue_footer_js');
// End All Custom Common Js 


// Start Best Selller Badge Code 

// Add custom sort option to dropdown
add_filter( 'woocommerce_default_catalog_orderby_options', 'add_custom_best_seller_sort_option' );
add_filter( 'woocommerce_catalog_orderby', 'add_custom_best_seller_sort_option' );

function add_custom_best_seller_sort_option( $options ) {
    $options['best_seller_category'] = 'Best Seller';
    return $options;
}

// Disable default WC ordering when using Best Seller option
add_filter( 'woocommerce_get_catalog_ordering_args', function( $args ) {
    if ( isset($_GET['orderby']) && $_GET['orderby'] === 'best_seller_category' ) {
        $args['orderby'] = 'none'; // Prevent default WC SQL sorting
    }
    return $args;
});

// Custom SQL sorting: Prioritize products in "Best Seller" category
add_filter( 'posts_clauses', 'sort_best_seller_products_first', 20, 2 );

function sort_best_seller_products_first( $clauses, $query ) {
    if ( is_admin() || ! $query->is_main_query() || ! is_woocommerce() ) return $clauses;

    if ( isset($_GET['orderby']) && $_GET['orderby'] === 'best_seller_category' ) {
        global $wpdb;

        $best_seller_term = get_term_by( 'name', 'Best Seller', 'product_cat' );
        if ( ! $best_seller_term || is_wp_error($best_seller_term) ) return $clauses;

        $term_taxonomy_id = $wpdb->get_var( $wpdb->prepare(
            "SELECT term_taxonomy_id FROM {$wpdb->term_taxonomy} WHERE term_id = %d AND taxonomy = %s",
            $best_seller_term->term_id, 'product_cat'
        ) );

        $clauses['orderby'] = "
            (SELECT COUNT(*) FROM {$wpdb->term_relationships}
             WHERE {$wpdb->term_relationships}.object_id = {$wpdb->posts}.ID
             AND term_taxonomy_id = {$term_taxonomy_id}) DESC,
            {$wpdb->posts}.menu_order ASC,
            {$wpdb->posts}.post_title ASC
        ";
    }

    return $clauses;
}

// Show "Best Seller" badge on product card if product is in the Best Seller category
function get_product_badge_bestseller( $product ) {
    $terms = get_the_terms( $product->get_id(), 'product_cat' );
    if ( ! $terms || is_wp_error( $terms ) ) return '';

    foreach ( $terms as $term ) {
        if ( stripos( strtolower( $term->name ), 'best seller' ) !== false ) {
            return '<span class="card-label bg-warning text-black rounded px-2 ms-2">Best Seller</span>';
        }
    }

    return '';
}

// Hook badge before product title
add_action( 'woocommerce_before_shop_loop_item_title', function() {
    global $product;
    echo get_product_badge_bestseller( $product );
}, 10 );

// End Best Seller Badge Code

function show_all_brands_in_grid() {
    $terms = get_terms(array(
        'taxonomy'   => 'product_brand',
        'hide_empty' => false,
    ));

    if (empty($terms) || is_wp_error($terms)) {
        return '<p>No brands found.</p>';
    }

    // Custom sort: A–Z first, then numeric
    usort($terms, function($a, $b) {
        $nameA = $a->name;
        $nameB = $b->name;

        $startsWithNumberA = preg_match('/^[0-9]/', $nameA);
        $startsWithNumberB = preg_match('/^[0-9]/', $nameB);

        if ($startsWithNumberA && !$startsWithNumberB) return 1;
        if (!$startsWithNumberA && $startsWithNumberB) return -1;

        return strcasecmp($nameA, $nameB);
    });

    $default_image = 'http://localhost:8000/wp-content/uploads/2025/04/logo.png';

    $output = '<div class="brand-grid">';

    foreach ($terms as $term) {
        $term_link = get_term_link($term);
        $thumbnail_id = get_term_meta($term->term_id, 'thumbnail_id', true);
        $image_url = wp_get_attachment_url($thumbnail_id);

        // Use default image if none found
        if (!$image_url) {
            $image_url = $default_image;
        }

        $output .= '<div class="brand-box">';
        $output .= '<a href="' . esc_url($term_link) . '">';
        $output .= '<div class="brand-logo-box"><img src="' . esc_url($image_url) . '" alt="' . esc_attr($term->name) . '" /></div>';
        $output .= '</a>';
        $output .= '<p class="brand-name"><a href="' . esc_url($term_link) . '">' . esc_html($term->name) . '</a></p>';
        $output .= '</div>';
    }

    $output .= '</div>';

    // Inline CSS
    $output .= '<style>
.brand-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 20px;
    margin: 30px 0;
}
.brand-box {
    text-align: center;
    padding: 30px 15px;
    box-sizing: border-box;
    background: #fafafa;
    border-radius: 10px;
    border: 1px solid #eee;
}
.brand-logo-box {
    width: 150px;
    height: 150px;
    margin: 0 auto 20px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 8px;
    overflow: hidden;
}
.brand-logo-box img {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
    display: block;
    padding: 15px;
    box-sizing: border-box;
    transition: transform 0.3s ease;
    will-change: transform;
}
.brand-box:hover .brand-logo-box img {
    transform: scale(1.05);
}
.brand-name {
    margin-bottom: 0;
}
.brand-name a {
    text-decoration: none;
    color: #333;
    font-weight: 500;
    font-size: 16px;
}

/* Tablet (up to 1024px): 2 columns */
@media (max-width: 1024px) {
    .brand-grid {
        grid-template-columns: repeat(2, 1fr);
    }
}

/* Mobile (up to 480px): 1 column */
@media (max-width: 480px) {
    .brand-grid {
        grid-template-columns: repeat(1, 1fr);
    }
}
</style>';

    return $output;
}
add_shortcode('brand_grid', 'show_all_brands_in_grid');


// Start Breadcumb below Banner section
add_action('template_redirect', function () {
	if (is_singular('page') && !is_front_page()) { // ✅ exclude homepage
		global $post;

		if (has_block('acf/banner-section', $post)) {
			remove_action('storefront_before_content', 'woocommerce_breadcrumb', 10);
			$GLOBALS['has_banner_block'] = true; // ✅ only for non-home pages
		}
	}
});
// End Breadcumb below Banner section






