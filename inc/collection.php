<?php
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

function storefront_mobile_filter_popup() {
    if ( ! is_shop() && ! is_product_category() && ! is_archive() ) return;
    ?>
    <button class="mobile-filter-button rounded-btn-css" id="openFilter">
        <svg width="24" height="24" viewBox="0 0 24 24">
            <path d="M3 6h18M6 12h12M10 18h4" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
        </svg>
        Filter
    </button>

    <div id="mobileFilterPopup" class="filter-popup-overlay">
        <div class="filter-popup-content">
            <button class="close-filter" id="closeFilter">&times;</button>
        </div>
    </div>

    <?php
}
add_action( 'wp_footer', 'storefront_mobile_filter_popup' );


// Start Keep Side Bar code 
add_action( 'template_redirect', 'custom_control_storefront_sidebar' );
function custom_control_storefront_sidebar() {
    if ( is_product_category() || is_shop() || is_archive() ) {
        // Product pages – keep sidebar
    } else {
        // Remove sidebar and switch to full-width layout
        remove_action( 'storefront_sidebar', 'storefront_get_sidebar' );
        add_filter( 'storefront_sidebar_enabled', '__return_false' );
        add_filter( 'body_class', 'custom_remove_sidebar_body_class' );
    }
}

// Remove 'storefront-has-sidebar' from body class
function custom_remove_sidebar_body_class( $classes ) {
    if ( ( $key = array_search( 'storefront-has-sidebar', $classes ) ) !== false ) {
        unset( $classes[$key] );
    }
    $classes[] = 'storefront-full-width-content';
    return $classes;
}

// End Keep Side Bar code 


// Start Per page Product Show 
// Step 1: Remove default result count from original position
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );

// Step 2: Add result count + per-page dropdown together
add_action( 'woocommerce_before_shop_loop', 'custom_result_and_per_page_wrapper', 20 );

function custom_result_and_per_page_wrapper() {
    echo '<div class="result-and-perpage-wrap">';

    // ✅ Custom Result Count (Only total results)
    global $wp_query;
    $total = $wp_query->found_posts;
    echo '<p class="woocommerce-result-count">(' . $total . ' results)</p>';

    // ✅ Custom per-page dropdown
    $options = get_default_per_page_options();
    $per_page = isset($_GET['products_per_page']) ? (int) $_GET['products_per_page'] : $options[0];

    echo '<div class="per-page-dropdown">';
    echo '<form method="GET">';
    echo '<label for="products_per_page" class="one-label">View</label>';
    echo '<select name="products_per_page" id="products_per_page" onchange="this.form.submit()">';

    foreach ( $options as $option ) {
        $selected = ( $per_page === $option ) ? 'selected' : '';
        echo "<option value='{$option}' {$selected}>{$option}</option>";
    }

    // Preserve other GET parameters
    foreach ( $_GET as $key => $value ) {
        if ( $key !== 'products_per_page' && ! is_array( $value ) ) {
            echo "<input type='hidden' name='" . esc_attr( $key ) . "' value='" . esc_attr( $value ) . "' />";
        }
    }

    echo '</select>';
    echo '<label for="products_per_page" class="two-label">per page </label>';
    echo '</form>';
    echo '</div>';

    echo '</div>';
}


// Step 3: Respect per-page selection
add_filter( 'loop_shop_per_page', 'custom_loop_shop_per_page', 20 );
function custom_loop_shop_per_page( $cols ) {
    if ( isset($_GET['products_per_page']) && is_numeric($_GET['products_per_page']) ) {
        return (int) $_GET['products_per_page'];
    }

    $options = get_default_per_page_options();
    return $options[0];
}

// Step 4: Helper function for options
function get_default_per_page_options() {
    $columns = absint( get_theme_mod( 'storefront_products_per_row', 4 ) );
    $rows    = absint( get_theme_mod( 'storefront_rows_per_page', 4 ) );
    $base = $columns * $rows;

    return [ $base, $base * 2, $base * 3, $base * 4 ];
}
// End Per page Product Show 
