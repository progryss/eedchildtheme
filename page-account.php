<?php
/**
 * Template Name: Account and Company Registration
 *
 * @package storefront
 */

get_header(); ?>

<div id="primary" class="content-area">
    <main id="main" class="site-main" role="main">

        <?php if ( is_user_logged_in() ) : ?>
            <?php
                while ( have_posts() ) :
                    the_post();

                    do_action( 'storefront_page_before' );

                    get_template_part( 'content', 'page' ); // This will render <article> structure + the_content()

                    do_action( 'storefront_page_after' );
                endwhile;
            ?>
        <?php else : ?>
            <div class="account-container">
                <div class="account-column">
                    <?php echo do_shortcode('[woocommerce_my_account]'); ?>
                </div>
                <div class="account-column registration-column">
                    <?php echo do_shortcode('[company_registration_form]'); ?>
                </div>
            </div>
        <?php endif; ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>
