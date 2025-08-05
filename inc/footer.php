<?php
// Start Footer Widgets Code 

function remove_storefront_footer_widgets() {
    remove_action( 'storefront_footer', 'storefront_footer_widgets', 10 );
}
add_action( 'after_setup_theme', 'remove_storefront_footer_widgets', 15 );



// Footer Widgets Code
function custom_storefront_widgets_init() {
        // Register the upper footer widget area
        register_sidebar( array(
            'name'          => __( 'Upper Footer', 'storefront' ),
            'id'            => 'upper-footer',
            'description'   => __( 'Widgets added here will appear in the upper footer.', 'storefront' ),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        ) );
    // First, unregister the existing footer widgets
    for ( $i = 1; $i <= 4; $i++ ) {
        unregister_sidebar( 'footer-' . $i );
    }

    // Register the new 6 footer widget areas
    for ( $i = 1; $i <= 6; $i++ ) {
        register_sidebar( array(
            'name'          => sprintf( __( 'Footer %d', 'storefront' ), $i ),
            'id'            => 'footer-' . $i,
            'description'   => __( 'Add widgets here.', 'storefront' ),
            'before_widget' => '<div id="%1$s" class="widget %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h3 class="widget-title">',
            'after_title'   => '</h3>',
        ) );
    }
}
add_action( 'widgets_init', 'custom_storefront_widgets_init', 11 );

// End Footer widgets Code
