<?php
// Step 1: Remove WooCommerce Default Product Gallery
remove_action('woocommerce_before_single_product_summary', 'woocommerce_show_product_images', 20);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);


// Step 2: Start wrapper before image + summary (priority 9)
add_action('woocommerce_before_single_product_summary', function () {
    echo '<div class="custom-product-main-wrapper">';
}, 10);

// Step 3: Add Custom Product Gallery and Slider (priority 10+)
add_action('woocommerce_before_single_product_summary', function() {
   $product = wc_get_product(get_the_ID());

    $featured_image_id = $product->get_image_id();
    $gallery_image_ids = $product->get_gallery_image_ids();
    $image_ids = array_filter(array_merge([$featured_image_id], $gallery_image_ids)); // Remove empty entries

    // Dummy image for both thumbnail and large
    $dummy_image = '/wp-content/uploads/2025/05/default-image.jpg';

    // First image for fake slides
    $first_image_url = !empty($image_ids[0]) ? wp_get_attachment_image_url($image_ids[0], 'thumbnail') : $dummy_image;
    ?>

    <div class="container-slider">
        <!-- <div class="loading">Product detail is loading...</div> -->
        <div class="synch-carousels">
            <div class="left child">
                <div class="product_customizer_gallery">
                    <?php if (!empty($image_ids)): ?>
                        <?php foreach ($image_ids as $id): ?>
                            <div class="item">
                                <img src="<?= wp_get_attachment_image_url($id, 'thumbnail'); ?>" alt="">
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <div class="item">
                            <img src="<?= esc_url($dummy_image); ?>" alt="Dummy Image">
                        </div>
                    <?php endif; ?>

                    <?php for ($i = 0; $i < 3; $i++): ?>
                        <div class="item fake-slide">
                            <img src="<?= esc_url($first_image_url); ?>" alt="Fake Slide">
                        </div>
                    <?php endfor; ?>
                </div>

                <div class="nav-arrows">
                    <button class="arrow-left"><i class="fa-solid fa-circle-chevron-left"></i></button>
                    <button class="arrow-right"><i class="fa-solid fa-circle-chevron-right"></i></button>
                </div>
            </div>

            <div class="right child">
                <!-- <h1 class="product_title"><?= $product->get_name(); ?></h1> -->
                <div class="summery-move-here"></div>
                <div class="product_customizer_gallery2">
                    <?php if (!empty($image_ids)): ?>
                        <?php foreach ($image_ids as $id): ?>
    <?php
        $large_src = wp_get_attachment_image_url($id, 'full');
        $thumbnail_src = wp_get_attachment_image_url($id, 'large');
        $meta = wp_get_attachment_metadata($id);
        $width = $meta['width'] ?? 1200;
        $height = $meta['height'] ?? 900;
        $caption = get_post_field('post_excerpt', $id);
    ?>
    <div class="item">
        <a href="<?= esc_url($large_src); ?>"
           data-pswp-width="<?= esc_attr($width); ?>"
           data-pswp-height="<?= esc_attr($height); ?>"
           data-caption="<?= esc_attr($caption); ?>"
           class="pswp-link">
            <img src="<?= esc_url($thumbnail_src); ?>" alt="">
        </a>
    </div>
<?php endforeach; ?>

                    <?php else: ?>
                        <div class="item">
                            <img src="<?= esc_url($dummy_image); ?>" alt="Dummy Image">
                        </div>
                    <?php endif; ?>
                </div>

              <?php
              $custom_domain = rtrim(get_field('unbranded_url', 'option'), '/');

              // Current product full URL
              $current_permalink = get_permalink();

              // Current path
              $product_path = wp_parse_url($current_permalink, PHP_URL_PATH);

              // Final URL: custom domain + current path
              $final_url = $custom_domain . $product_path;
              ?>

              <div class="button-group">
                  <a class="rounded-btn-css secondary-btn-custom" href="<?php echo esc_url($final_url); ?>" target="_blank">
                      <i class="fa fa-share"></i> Share unbranded link
                  </a>
              </div>



                <div class="photos-counter"><span></span><span></span></div>
            </div>
        </div>

        <div class="varient-move-heres"></div>

        <div class="button-group above-product-btn">
            <a class="rounded-btn-css secondary-btn-custom" href="#"><i class="fa fa-share"></i> Share unbranded link</a>
        </div>

<div class="product-custom-description">
<?php 
$description = $product->get_description();
$short_description = $product->get_short_description();

if (!empty($description) || !empty($short_description)) {
echo '<p class="product-desc-heading"><strong>Product Description</strong></p>';

if (!empty($short_description)) {
echo '<div class="product-short-description">';
echo apply_filters('the_content', $short_description);
echo '</div>';
}

if (!empty($description)) {
echo apply_filters('the_content', $description);
}
}
?>

</div>

<!-- Washing Instruction -->
<div class="product-custom-description">
<?php 
    $product_id = get_the_ID();
    $_washing_instructions = get_post_meta($product_id, '_washing_instructions', true);
    $_fabric_description    = get_post_meta($product_id, '_fabric_description', true);
    $accreditation_field    = get_post_meta($product_id, '_accreditations', true);

if (!empty($_washing_instructions)) {
    echo '<p class="product-desc-heading"><strong>Washing Instruction</strong></p>';
    echo '<p>' . $_washing_instructions . '</p>';
}
?>
</div>

<!-- Fabric Description -->
<div class="product-custom-description">
<?php 

if (!empty($_fabric_description)) {
    echo '<p class="product-desc-heading"><strong>Fabric Description</strong></p>';
    echo '<p>' . $_fabric_description . '</p>';
}
?>
</div>


<!-- Accreditation -->
<div class="product-custom-description">
<?php
$accreditation_items = array_map('trim', explode('|', $accreditation_field));

if ($accreditation_field) {
    echo '<p class="product-desc-heading"><strong>Accreditation</strong></p>';
    echo '<div class="accreditation-list">';

    $matched_texts = [];
    $accreditation_items_lower = array_map('strtolower', $accreditation_items);

    if (have_rows('accreditation_repeater', 'option')) {
        while (have_rows('accreditation_repeater', 'option')) {
            the_row();
            $logo = get_sub_field('accreditation__logo');
            $logo_text = get_sub_field('accreditation__logo_text');
            $accreditation_description = get_sub_field('accreditation_description');

            if (in_array(strtolower($logo_text), $accreditation_items_lower)) {
                $matched_texts[] = strtolower($logo_text);
                $modal_id = 'accreditation-modal-' . sanitize_title($logo_text);

                echo '<div class="accreditation-item" data-modal-target="#' . $modal_id . '">';

                if (!empty($logo)) {
                    echo '<img src="' . $logo['url'] . '" alt="' . esc_attr($logo_text) . '" />';
                }

                // Hidden modal inside this item
               if (!empty($accreditation_description)) {
    $modal_id = 'accreditation-modal-' . sanitize_title($logo_text);
    ?>
    <div id="<?php echo $modal_id; ?>" class="accreditation-modal hidden">
      <div class="accreditation-modal-main">
        <div class="accreditation-modal-content">
          
          <div class="customise-header">
                <div><h2><?php echo esc_html($logo_text); ?></h2></div>
                <div class="cross-icon"><span class="close-modal">×</span></div>
            </div>

            <div class="modal-description">
                <p><?php echo esc_html(strip_tags($accreditation_description)); ?></p>
            </div>
               </div>
        </div>
    </div>
    <?php
}
                echo '</div>'; // .accreditation-item
            }
        }
    }

    // Unmatched text
    $unmatched = array_udiff($accreditation_items, $matched_texts, 'strcasecmp');
    foreach ($unmatched as $text) {
        echo '<div class="accreditation-item">';
        echo '<p>' . esc_html($text) . '</p>';
        echo '</div>';
    }

    echo '</div>'; // .accreditation-list
}
?>
</div>


    </div>

<?php
}, 20);

// Step 4: Close wrapper after summary (priority 21)
add_action('woocommerce_after_single_product_summary', function () {
    echo '</div>'; 
}, 21);

// Remove Tabs
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10);

add_action('woocommerce_after_main_content', 'custom_logo_customisation_tabs_after_product_div', 49);
function custom_logo_customisation_tabs_after_product_div() {
    if (is_product()) {
    ?>
    <?php
$default_tab_title_icon_tab_1 = get_field('default_tab_title_icon_tab_1', 'option');
$active_tab_title_icon_tab_1 = get_field('active_tab_title_icon_tab_1', 'option');
$tab_title_tab_1 = get_field('tab_title_tab_1', 'option');
$two_column_layout_group_tab_1 = get_field('two_column_layout_group_tab_1', 'option');
$left_column_tab_1 = $two_column_layout_group_tab_1['left_column_tab_1'] ?? '';
$right_column_tab_1 = $two_column_layout_group_tab_1['right_column_tab_1'] ?? '';

$default_tab_title_icon_tab_2 = get_field('default_tab_title_icon_tab_2', 'option');
$active_tab_title_icon_tab_2 = get_field('active_tab_title_icon_tab_2', 'option');
$tab_title_tab_2 = get_field('tab_title_tab_2', 'option');
$two_column_layout_group_tab_2 = get_field('two_column_layout_group_tab_2', 'option');
$left_column_tab_2 = $two_column_layout_group_tab_2['left_column_tab_2'] ?? '';
$right_column_tab_2 = $two_column_layout_group_tab_2['right_column_tab_2'] ?? '';

$default_tab_title_icon_tab_3 = get_field('default_tab_title_icon_tab_3', 'option');
$active_tab_title_icon_tab_3 = get_field('active_tab_title_icon_tab_3', 'option');
$tab_title_tab_3 = get_field('tab_title_tab_3', 'option');
$two_column_layout_group_tab_3 = get_field('two_column_layout_group_tab_3', 'option');
$left_column_tab_3 = $two_column_layout_group_tab_3['left_column_tab_3'] ?? '';
$right_column_tab_3 = $two_column_layout_group_tab_3['right_column_tab_3'] ?? '';

$default_tab_title_icon_tab_4 = get_field('default_tab_title_icon_tab_4', 'option');
$active_tab_title_icon_tab_4 = get_field('active_tab_title_icon_tab_4', 'option');
$tab_title_tab_4 = get_field('tab_title_tab_4', 'option');
$two_column_layout_group_tab_4 = get_field('two_column_layout_group_tab_4', 'option');
$left_column_tab_4 = $two_column_layout_group_tab_4['left_column_tab_4'] ?? '';
$right_column_tab_4 = $two_column_layout_group_tab_4['right_column_tab_4'] ?? '';

$default_tab_title_icon_tab_5 = get_field('default_tab_title_icon_tab_5', 'option');
$active_tab_title_icon_tab_5 = get_field('active_tab_title_icon_tab_5', 'option');
$tab_title_tab_5 = get_field('tab_title_tab_5', 'option');
$two_column_layout_group_tab_5 = get_field('two_column_layout_group_tab_5', 'option');
$left_column_tab_5 = $two_column_layout_group_tab_5['left_column_tab_5'] ?? '';
$right_column_tab_5 = $two_column_layout_group_tab_5['right_column_tab_5'] ?? '';

$default_tab_title_icon_tab_6 = get_field('default_tab_title_icon_tab_6', 'option');
$active_tab_title_icon_tab_6 = get_field('active_tab_title_icon_tab_6', 'option');
$tab_title_tab_6 = get_field('tab_title_tab_6', 'option');
$two_column_layout_group_tab_6 = get_field('two_column_layout_group_tab_6', 'option');
$left_column_tab_6 = $two_column_layout_group_tab_6['left_column_tab_6'] ?? '';
$right_column_tab_6 = $two_column_layout_group_tab_6['right_column_tab_6'] ?? '';
?>
    <div class="logo-customisation-custom-tabs full-width">
        <div class="custom-tab-buttons-main">
        <div class="custom-tab-buttons col-full">

<?php if (!empty($tab_title_tab_1)) : ?>
  <button class="custom-tab active">
    <?php if (!empty($active_tab_title_icon_tab_1['url'])) : ?>
      <img class="active-tab-icon" src="<?php echo $active_tab_title_icon_tab_1['url']; ?>">
    <?php endif; ?>
    <?php if (!empty($default_tab_title_icon_tab_1['url'])) : ?>
      <img class="default-tab-icon" src="<?php echo $default_tab_title_icon_tab_1['url']; ?>">
    <?php endif; ?>
    <?php echo $tab_title_tab_1; ?>
  </button>
<?php endif; ?>

<?php if (!empty($tab_title_tab_2)) : ?>
  <button class="custom-tab">
    <?php if (!empty($active_tab_title_icon_tab_2['url'])) : ?>
      <img class="active-tab-icon" src="<?php echo $active_tab_title_icon_tab_2['url']; ?>">
    <?php endif; ?>
    <?php if (!empty($default_tab_title_icon_tab_2['url'])) : ?>
      <img class="default-tab-icon" src="<?php echo $default_tab_title_icon_tab_2['url']; ?>">
    <?php endif; ?>
    <?php echo $tab_title_tab_2; ?>
  </button>
<?php endif; ?>

<?php if (!empty($tab_title_tab_3)) : ?>
  <button class="custom-tab">
    <?php if (!empty($active_tab_title_icon_tab_3['url'])) : ?>
      <img class="active-tab-icon" src="<?php echo $active_tab_title_icon_tab_3['url']; ?>">
    <?php endif; ?>
    <?php if (!empty($default_tab_title_icon_tab_3['url'])) : ?>
      <img class="default-tab-icon" src="<?php echo $default_tab_title_icon_tab_3['url']; ?>">
    <?php endif; ?>
    <?php echo $tab_title_tab_3; ?>
  </button>
<?php endif; ?>

<?php if (!empty($tab_title_tab_4)) : ?>
  <button class="custom-tab">
    <?php if (!empty($active_tab_title_icon_tab_4['url'])) : ?>
      <img class="active-tab-icon" src="<?php echo $active_tab_title_icon_tab_4['url']; ?>">
    <?php endif; ?>
    <?php if (!empty($default_tab_title_icon_tab_4['url'])) : ?>
      <img class="default-tab-icon" src="<?php echo $default_tab_title_icon_tab_4['url']; ?>">
    <?php endif; ?>
    <?php echo $tab_title_tab_4; ?>
  </button>
<?php endif; ?>

<?php if (!empty($tab_title_tab_5)) : ?>
  <button class="custom-tab">
    <?php if (!empty($active_tab_title_icon_tab_5['url'])) : ?>
      <img class="active-tab-icon" src="<?php echo $active_tab_title_icon_tab_5['url']; ?>">
    <?php endif; ?>
    <?php if (!empty($default_tab_title_icon_tab_5['url'])) : ?>
      <img class="default-tab-icon" src="<?php echo $default_tab_title_icon_tab_5['url']; ?>">
    <?php endif; ?>
    <?php echo $tab_title_tab_5; ?>
  </button>
<?php endif; ?>

<?php if (!empty($tab_title_tab_6)) : ?>
  <button class="custom-tab">
    <?php if (!empty($active_tab_title_icon_tab_6['url'])) : ?>
      <img class="active-tab-icon" src="<?php echo $active_tab_title_icon_tab_6['url']; ?>">
    <?php endif; ?>
    <?php if (!empty($default_tab_title_icon_tab_6['url'])) : ?>
      <img class="default-tab-icon" src="<?php echo $default_tab_title_icon_tab_6['url']; ?>">
    <?php endif; ?>
    <?php echo $tab_title_tab_6; ?>
  </button>
<?php endif; ?>

</div>

      </div>
      <div class="tab-content-outer-main">
    <div class="col-full tab-content-main">
        <!-- Tab 1 Content -->
    <?php if (!empty($left_column_tab_1) || !empty($right_column_tab_1)) : ?>
  <div class="custom-tab-content active">
    <div class="two-column-tab-layout">
      
      <?php if (!empty($left_column_tab_1)) : ?>
        <div class="tab-column custom-tab-left">
          <?php echo $left_column_tab_1; ?>
        </div>
      <?php endif; ?>

      <?php if (!empty($right_column_tab_1)) : ?>
        <div class="tab-column custom-tab-right">
          <?php echo $right_column_tab_1; ?>
        </div>
      <?php endif; ?>

    </div>
  </div>
<?php endif; ?>
<!-- Tab 2 Content -->
<?php if (!empty($left_column_tab_2) || !empty($right_column_tab_2)) : ?>
  <div class="custom-tab-content">
    <div class="two-column-tab-layout">
      
      <?php if (!empty($left_column_tab_2)) : ?>
        <div class="tab-column custom-tab-left">
          <?php echo $left_column_tab_2; ?>
        </div>
      <?php endif; ?>

      <?php if (!empty($right_column_tab_2)) : ?>
        <div class="tab-column custom-tab-right">
          <?php echo $right_column_tab_2; ?>
        </div>
      <?php endif; ?>

    </div>
  </div>
<?php endif; ?>
<!-- Tab 3 Content -->
<?php if (!empty($left_column_tab_3) || !empty($right_column_tab_3)) : ?>
  <div class="custom-tab-content">
    <div class="two-column-tab-layout">
      
      <?php if (!empty($left_column_tab_3)) : ?>
        <div class="tab-column custom-tab-left">
          <?php echo $left_column_tab_3; ?>
        </div>
      <?php endif; ?>

      <?php if (!empty($right_column_tab_3)) : ?>
        <div class="tab-column custom-tab-right">
          <?php echo $right_column_tab_3; ?>
        </div>
      <?php endif; ?>

    </div>
  </div>
<?php endif; ?>
<!-- Tab 4 Content -->
<?php if (!empty($left_column_tab_4) || !empty($right_column_tab_4)) : ?>
  <div class="custom-tab-content">
    <div class="two-column-tab-layout">
      
      <?php if (!empty($left_column_tab_4)) : ?>
        <div class="tab-column custom-tab-left">
          <?php echo $left_column_tab_4; ?>
        </div>
      <?php endif; ?>

      <?php if (!empty($right_column_tab_4)) : ?>
        <div class="tab-column custom-tab-right">
          <?php echo $right_column_tab_4; ?>
        </div>
      <?php endif; ?>

    </div>
  </div>
<?php endif; ?>
<!-- Tab 5 Content -->
  <div class="custom-tab-content">
<?php
$faqs = get_field('two_column_layout_group_tab_5', 'option');

if ($faqs): ?>
<div class="container-fluid faqs-main">
  <div class="container p-0">
    <div class="col-lg-12 col-md-12 col-sm-12 p-0">
      <div itemscope itemtype="http://schema.org/FAQPage">

        <?php foreach ($faqs as $faq):
          $question = $faq['question'];
          $answer = $faq['answer'];

          // Only display FAQ if both question and answer are filled
          if (!empty($question) && !empty($answer)): ?>
            <div class="faqs-question-main" itemprop="mainEntity" itemscope itemtype="http://schema.org/Question">
              <h3 class="faqs-question-heading" itemprop="name">
                <?php echo $question; ?>
              </h3>
              <div itemprop="acceptedAnswer" itemscope itemtype="http://schema.org/Answer" class="faqs-answer-content">
                <div itemprop="text">
                  <p><?php echo $answer; ?></p>
                </div>
              </div>
            </div>
          <?php endif; endforeach; ?>

      </div>
    </div>
  </div>
</div>
<?php endif; ?>
  </div>

<!-- Tab 6 Content -->
<?php if (!empty($left_column_tab_6) || !empty($right_column_tab_6)) : ?>
  <div class="custom-tab-content">
    <div class="two-column-tab-layout">
      
      <?php if (!empty($left_column_tab_6)) : ?>
        <div class="tab-column custom-tab-left">
          <?php echo $left_column_tab_6; ?>
        </div>
      <?php endif; ?>

      <?php if (!empty($right_column_tab_6)) : ?>
        <div class="tab-column custom-tab-right">
          <?php echo $right_column_tab_6; ?>
        </div>
      <?php endif; ?>

    </div>
  </div>
  </div>
<?php endif; ?>

    </div>
    </div>
    <?php
}
}

// Step 1: Remove default Related Products
remove_action('woocommerce_after_single_product_summary', 'woocommerce_output_related_products',20);

// Step 2: Add Related Products completely outside product div
add_action('woocommerce_after_main_content', function() {
    if (is_product()) { // Only on single product pages
        echo '<div class="custom-related-products-fullwidth col-full" style="margin-top:50px;">';
        woocommerce_related_products(array(
            'posts_per_page' => 10,
            'columns'        => 5,
        ));
        echo '</div>';
    }
}, 50);

// End Product Page Code

// Start Add secondary image on Product
// Remove default product image output
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );

// Add primary + optional secondary image
add_action( 'woocommerce_before_shop_loop_item_title', 'custom_add_secondary_product_thumbnail', 10 );

function custom_add_secondary_product_thumbnail() {
    global $product;

    $attachment_ids = $product->get_gallery_image_ids();
    $has_secondary = isset( $attachment_ids[0] );
    $secondary_image_url = $has_secondary ? wp_get_attachment_image_url( $attachment_ids[0], 'woocommerce_thumbnail' ) : '';

    $primary_image = get_the_post_thumbnail( $product->get_id(), 'woocommerce_thumbnail', array( 'class' => 'primary-image' ) );

    // Dummy image fallback if no featured image
    if ( empty( $primary_image ) ) {
        $dummy_image_url = '/wp-content/uploads/2025/05/default-image.jpg';
        $primary_image = '<img src="' . esc_url( $dummy_image_url ) . '" class="primary-image dummy-image" />';
    }

    $classes = $has_secondary ? 'product-thumbnail-wrapper hover-enabled' : 'product-thumbnail-wrapper';

    echo '<div class="' . esc_attr( $classes ) . '">';
        echo $primary_image;

        if ( $has_secondary && $secondary_image_url ) {
            echo '<img src="' . esc_url( $secondary_image_url ) . '" class="secondary-image" />';
        }
    echo '</div>';
}

// Add inline CSS for hover effect only when needed
add_action( 'wp_head', 'custom_hover_image_inline_css' );
function custom_hover_image_inline_css() {
    ?>
    <?php
}
// End Add secondary image on Product


// Start Code SKU + Commodity + Country 
add_action('woocommerce_single_product_summary', function () {
    global $product;

    $sku_map = [];
    $default_sku = ''; // Start blank
    $is_variable = $product && $product->is_type('variable');

    if ($is_variable) {
        $variations = $product->get_available_variations();
        $color_sku_tracker = []; // Track all SKUs for each color

        if (!empty($variations)) {
            foreach ($variations as $variation) {
                $variation_id = $variation['variation_id'];
                $sku = get_post_meta($variation_id, '_sku', true);
                $attributes = $variation['attributes'];
                $color = '';

                foreach ($attributes as $key => $value) {
                    if (strpos($key, 'pa_colour') !== false) {
                        $color = $value;
                    }
                }

                if ($color) {
                    if (!isset($color_sku_tracker[$color])) {
                        $color_sku_tracker[$color] = [];
                    }

                    if (!empty($sku)) {
                        $color_sku_tracker[$color][] = $sku;
                    }

                    if (!$default_sku && !empty($sku)) {
                        $default_sku = $sku;
                    }
                }
            }

            // Set SKU map: First valid SKU or 'NA'
            foreach ($color_sku_tracker as $color => $skus) {
                $sku_map[$color] = !empty($skus) ? $skus[0] : 'NA';
            }
        } else {
            $default_sku = $product->get_sku();
        }
    } else {
        $default_sku = $product->get_sku();
    }

    $default_sku = $default_sku ?: 'NA';

    // Get extra meta fields
    $product_id = get_the_ID();
    $country_of_origin = get_post_meta($product_id, '_country_of_origin', true);
    $commodity_code    = get_post_meta($product_id, '_commodity_code', true);
    ?>

    <div class="custom-div-below-title">
        <div class="product-details-below-title">
            <span class="product-sku">
                <strong>SKU:</strong> <span id="variant-sku"><?php echo $default_sku; ?></span>
            </span>

            <?php if ($commodity_code) : ?>
                <span class="product-sku">
                    <strong>Commodity Code:</strong> <span><?php echo $commodity_code; ?></span>
                </span>
            <?php endif; ?>

            <?php if ($country_of_origin) : ?>
                <span class="product-sku">
                    <strong>Country of Origin:</strong> <span><?php echo $country_of_origin; ?></span>
                </span>
            <?php endif; ?>
        </div>
    </div>

    <script>
    const defaultSku = '<?php echo esc_js($default_sku); ?>';

    var colorSkuMap = <?php echo json_encode($sku_map); ?>;
    </script>

<!-- Start Brand Thumbnail Show -->
<?php if (!empty($brand_image_url) && !empty($brand_url)): ?>
    <div class="brand-name-box">
        <a href="<?php echo $brand_url; ?>">
            <img src="<?php echo $brand_image_url; ?>" alt="Brand Thumbnail" />
        </a>
    </div>
<?php endif; ?>
<!-- End Brand Thumbnail Show -->


<!-- Start customise Button + Popup  -->

<?php
$popup_heading = get_field('popup_heading', 'option');
// card 1
$card_1 = get_field('card_1', 'option');
$card_1_icon = $card_1['card_1_icon'] ?? '';
$card_1_heading = $card_1['card_1_heading'] ?? '';
$card_1_description = $card_1['card_1_description'] ?? '';
// Card 2
$card_2 = get_field('card_2', 'option');
$card_2_icon = $card_2['card_2_icon'] ?? '';
$card_2_heading = $card_2['card_2_heading'] ?? '';
$card_2_description = $card_2['card_2_description'] ?? '';

// Card 3
$card_3 = get_field('card_3', 'option');
$card_3_icon = $card_3['card_3_icon'] ?? '';
$card_3_heading = $card_3['card_3_heading'] ?? '';
$card_3_description = $card_3['card_3_description'] ?? '';

$card_below_description = get_field('card_below_description', 'option');
$card_below_image = get_field('card_below_image', 'option');
?>

 <div class="customise-btn">
<button class="customise-btn" onclick="openPopup()">
  <i class="fas fa-pen"></i> How do I customise this product?
</button>
<!-- Popup HTML -->
<div class="popup-overlay" id="popup">
<div class="popup-content">
    <div class="customise-header">
        <div>
            <?php if (!empty($popup_heading)) : ?>
                <h3><?php echo $popup_heading; ?></h3>
            <?php endif; ?>
        </div>
        <div class="cross-icon">
            <span onclick="closePopup()">&#215;</span>
        </div>
    </div>

    <div class="customise-body">
        <div class="customise-body-inner">
            <div class="customise-card-box">

            <?php if (!empty($card_1_icon['url']) || !empty($card_1_heading) || !empty($card_1_description)) : ?>
                <div class="customise-column">
                    <?php if (!empty($card_1_icon['url'])) : ?>
                        <div class="customise-img-box">
                            <img src="<?php echo $card_1_icon['url']; ?>">
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($card_1_heading)) : ?>
                        <h4><?php echo $card_1_heading; ?></h4>
                    <?php endif; ?>
                    <?php if (!empty($card_1_description)) : ?>
                        <p><?php echo $card_1_description; ?></p>
                    <?php endif; ?>
                </div>
                <?php endif; ?>

                <?php if (!empty($card_2_icon['url']) || !empty($card_2_heading) || !empty($card_2_description)) : ?>
                <div class="customise-column">
                    <?php if (!empty($card_2_icon['url'])) : ?>
                        <div class="customise-img-box">
                            <img src="<?php echo $card_2_icon['url']; ?>">
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($card_2_heading)) : ?>
                        <h4><?php echo $card_2_heading; ?></h4>
                    <?php endif; ?>
                    <?php if (!empty($card_2_description)) : ?>
                        <p><?php echo $card_2_description; ?></p>
                    <?php endif; ?>
                </div>
                <?php endif; ?>

                <?php if (!empty($card_3_icon['url']) || !empty($card_3_heading) || !empty($card_3_description)) : ?>
                <div class="customise-column">
                    <?php if (!empty($card_3_icon['url'])) : ?>
                        <div class="customise-img-box">
                            <img src="<?php echo $card_3_icon['url']; ?>">
                        </div>
                    <?php endif; ?>
                    <?php if (!empty($card_3_heading)) : ?>
                        <h4><?php echo $card_3_heading; ?></h4>
                    <?php endif; ?>
                    <?php if (!empty($card_3_description)) : ?>
                        <p><?php echo $card_3_description; ?></p>
                    <?php endif; ?>
                </div>
                <?php endif; ?>

            </div>
            <div class="customise-card-box-below">
                <?php if (!empty($card_below_description)) : ?>
                    <p><?php echo $card_below_description; ?></p>
                <?php endif; ?>
                <?php if (!empty($card_below_image['url'])) : ?>
                    <img src="<?php echo $card_below_image['url']; ?>">
                <?php endif; ?>
            </div>

        </div>
    </div>

    <div class="customise-footer">
        <button onclick="closePopup()">Close</button>
    </div>
</div>
</div>
</div>

<!-- End customise Button + Popup  -->

      <?php if (is_user_logged_in()) : ?>
        <div class="logo-price-calculator-wrap">
            <?php echo do_shortcode('[logo_price_calculator]'); ?>
        </div>
    <?php endif; ?>
    <?php
}, 25);
// End Code SKU + Commodity + Country


// Start  Static content Sales Modal
// Start Static content Sales Modal
add_action('wp_footer', 'insert_conditional_static_content');

function insert_conditional_static_content() {
    if (!is_product()) return;

    $content = get_field('content_below_variant_color', 'option');
    if (empty($content)) return;

    // Escape content for JS
    $content_escaped = wp_kses_post($content);
    $content_escaped = str_replace(["\n", "\r", "'"], ["", "", "\\'"], $content_escaped);
    ?>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var summary = document.querySelector('.summary');
            var enhancedBox = summary ? summary.querySelector(':scope > .enhanced-variable-product-container') : null;
            var form = document.querySelector('form.cart');
            var customiseBtn = document.querySelector('.customise-btn');
            var isVariableType = document.body.classList.contains('product-type-variable');

            var contentHTML = '<?php echo $content_escaped; ?>';
            var div = document.createElement('div');
            div.className = 'custom-static-content';
            div.style.clear = 'both';
            div.innerHTML = contentHTML;

            if (enhancedBox) {
                enhancedBox.parentNode.insertBefore(div, enhancedBox.nextSibling);
            } else if (form) {
                form.parentNode.insertBefore(div, form.nextSibling);
            } else if (!enhancedBox && !isVariableType && customiseBtn) {
                customiseBtn.parentNode.insertBefore(div, customiseBtn.nextSibling);
            }
        });
    </script>
    <?php
}


// End  Static content Sales Modal

// Start Add cart fragments for updating cart count
add_filter('woocommerce_add_to_cart_fragments', 'custom_ajax_cart_count_fragments');
function custom_ajax_cart_count_fragments($fragments) {
    ob_start();
    ?>
    <span class="cart-count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
    <?php
    $fragments['.cart-count'] = ob_get_clean();
    return $fragments;
}

// Inject JS directly via wp_footer
add_action('wp_footer', 'custom_ajax_cart_count_script');
function custom_ajax_cart_count_script() {
    ?>
    <script type="text/javascript">
    jQuery(function($) {
        // WooCommerce event after AJAX add to cart
        $(document.body).on('added_to_cart', function(event, fragments, cart_hash) {
            if (fragments && fragments['.cart-count']) {
                $('.cart-count').replaceWith(fragments['.cart-count']);
            }
        });
    });
    </script>
    <?php
}

// End  Add cart fragments for updating cart count

// Start Show only Qunatity in Product table 
add_filter( 'woocommerce_get_availability_text', 'custom_stock_text', 10, 2 );
function custom_stock_text( $availability, $product ) {
    if ( $product->is_in_stock() ) {
        $stock_quantity = $product->get_stock_quantity();
        return $stock_quantity ? $stock_quantity : ''; // Only return quantity
    }
    return $availability;
}
// End Show only Qunatity in Product table

// Start Sales Contact Form Popup
add_action('wp_footer', 'sales_team_contactpopup_markup');
function sales_team_contactpopup_markup() {
    ?>
<!-- Sales Contact Modal -->
<div class="sales-contact-modal-overlay" style="display: none;">
  <div class="sales-contact-modal-wrapper">
    <div class="sales-contact-modal-box">
      <div class="sales-contact-modal-close-main">
        <button class="sales-contact-modal-close">&times;</button>
      </div>
      <div class="sales-contact-modal-content">
        <?php echo do_shortcode('[formidable id=3]'); ?>
        <div class="contact-info-modal">
  <div>Or call us</div>
  <div>+44 (0) 330 822 8275</div>
</div>

      </div>
    </div>
  </div>
</div>

    <?php
}
// End Sales Contact Form Popup


// Start Show brand name (non-clickable) below product title on shop/archive pages
add_action( 'woocommerce_shop_loop_item_title', 'custom_show_product_brand_below_title', 11 );

function custom_show_product_brand_below_title() {
    global $product;

    $product_id = $product->get_id();

    // Get product brands (assuming 'product_brand' taxonomy)
    $brand_terms = wp_get_post_terms( $product_id, 'product_brand' );

    if ( ! is_wp_error( $brand_terms ) && ! empty( $brand_terms ) ) {
        $brand = $brand_terms[0]; // First brand (if multiple)

        echo '<div class="product-brand">';
        echo esc_html( $brand->name );
        echo '</div>';
    }
}
// End Show brand name (non-clickable) below product title on shop/archive pages

// Show SKU just above the product title in loop

// Shared function to print SKU
function custom_show_parent_product_sku_after_title() {
    global $product;

    if (!$product) return;

    $parent_sku = $product->get_sku();

    echo '<div class="custom-product-sku">';
    if (!empty($parent_sku)) {
        echo '<strong>SKU:</strong> ' . esc_html($parent_sku);
    }
    echo '</div>';
}

// On collection (archive) pages – show SKU right after title, before brand
add_action('woocommerce_shop_loop_item_title', 'custom_show_sku_on_archive', 10);
function custom_show_sku_on_archive() {
    if (is_shop() || is_product_category() || is_product_tag() || is_search()) {
        custom_show_parent_product_sku_after_title();
    }
}

// On other areas – show SKU above title
add_action('woocommerce_shop_loop_item_title', 'custom_show_sku_on_others', 4);
function custom_show_sku_on_others() {
    if (!is_shop() && !is_product_category() && !is_product_tag() && !is_search()) {
        custom_show_parent_product_sku_after_title();
    }
}