<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package storefront
 */

?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">


<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php wp_body_open(); ?>

<?php do_action( 'storefront_before_site' ); ?>

<div id="page" class="hfeed site">
	<?php do_action( 'storefront_before_header' ); ?>

	<header id="masthead" class="site-header" role="banner" style="<?php storefront_header_styles(); ?>">

		<?php
		/**
		 * Functions hooked into storefront_header action
		 *
		 * @hooked storefront_header_container                 - 0
		 * @hooked storefront_skip_links                       - 5
		 * @hooked storefront_social_icons                     - 10
		 * @hooked storefront_site_branding                    - 20
		 * @hooked storefront_secondary_navigation             - 30
		 * @hooked storefront_product_search                   - 40
		 * @hooked storefront_header_container_close           - 41
		 * @hooked storefront_primary_navigation_wrapper       - 42
		 * @hooked storefront_primary_navigation               - 50
		 * @hooked storefront_header_cart                      - 60
		 * @hooked storefront_primary_navigation_wrapper_close - 68
		 */
		do_action( 'storefront_header' );
		
		?>

<?php
if (has_nav_menu('primary')) {
    wp_nav_menu(array(
        'theme_location' => 'primary',
        'menu_class'     => 'menu nav-menu top-level',
        'container_class'=> 'primary-navigation desktop-menu',
        'walker'         => new Mega_Menu_Walker()
    ));
} else {
    wp_page_menu(array(
        'menu_class' => 'menu nav-menu top-level',
        'container_class' => 'primary-navigation desktop-menu'
    ));
}
?>



	</header><!-- #masthead -->

	<?php
	/**
	 * Functions hooked in to storefront_before_content
	 *
	 * @hooked storefront_header_widget_region - 10
	 * @hooked woocommerce_breadcrumb - 10
	 */
	do_action( 'storefront_before_content' );
	?>

	<div id="content" class="site-content <?php
        if ( is_front_page() ) {
          echo 'custom-home-page';
        } elseif ( is_shop() ) {
          echo 'custom-shop-page';
        } elseif ( is_product_category() ) {
          echo 'custom-collection-page';
        } elseif ( is_product() ) {
          echo 'custom-product-page';
        } elseif ( is_category() ) {
          echo 'custom-blog-category-page';
        } elseif ( is_single() ) {
          echo 'custom-blog-post-page';
        } elseif ( is_page() ) {
          echo 'custom-static-page';
        } elseif ( is_search() ) {
          echo 'custom-search-results-page';
        } elseif ( is_archive() ) {
          echo 'custom-archive-page';
        } elseif ( is_404() ) {
          echo 'custom-page-not-found';
        } else {
          echo 'custom-page';
        }
      ?>" tabindex="-1">
		<div>

		<?php
		do_action( 'storefront_content_top' );
