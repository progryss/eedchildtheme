<?php
  /**
  * Cart Page
  *
  * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
  *
  * HOWEVER, on occasion WooCommerce will need to update template files and you
  * (the theme developer) will need to copy the new files to your theme to
  * maintain compatibility. We try to do this as little as possible, but it does
  * happen. When this occurs the version of the template file will be bumped and
  * the readme will list any important changes.
  *
  * @see     https://woocommerce.com/document/template-structure/
  * @package WooCommerce\Templates
  * @version 7.9.0
  */

  defined('ABSPATH') || exit;

  do_action('woocommerce_before_cart'); ?>

  <form class="woocommerce-cart-form" action="<?php echo esc_url(wc_get_cart_url()); ?>" method="post">
    <?php do_action('woocommerce_before_cart_table'); ?>
    <div class="cart-left-part">
      <table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents" cellspacing="0">
        <thead>
          <tr>
            <th class="product-name" colspan="3"><?php esc_html_e('Product', 'woocommerce'); ?></th>
            <th class="product-price">
              <?php esc_html_e('Price', 'woocommerce'); ?>
              <div class="ex-vat-header">(EX-VAT)</div>
            </th>
            <th class="product-quantity"><?php esc_html_e('Quantity', 'woocommerce'); ?></th>
            <th class="product-subtotal">
              <?php esc_html_e('Subtotal', 'woocommerce'); ?>
              <div class="ex-vat-header">(EX-VAT)</div>
            </th>
          </tr>

        </thead>
        <tbody>
          <?php do_action('woocommerce_before_cart_contents'); ?>

          <?php
            foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) {
              $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
              $product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);
              /**
              * Filter the product name.
              *
              * @since 2.1.0
              * @param string $product_name Name of the product in the cart.
              * @param array $cart_item The product in the cart.
              * @param string $cart_item_key Key for the product in the cart.
              */
              $product_name = apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key);

              if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_cart_item_visible', true, $cart_item, $cart_item_key)) {
                $product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);
              ?>
              <!-- Include mobile row start-->
              <?php include __DIR__ . '/cart-mobile-row.php'; ?>
              <!-- Include mobile row end-->
              <tr
              class="forDesk woocommerce-cart-form__cart-item <?php echo esc_attr(apply_filters('woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key)); ?>">

              <td class="product-remove">
                <?php
                  echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                  'woocommerce_cart_item_remove_link',
                  sprintf(
                  '<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                      <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5"></path>
                    </svg>
                  </a>',
                  esc_url(wc_get_cart_remove_url($cart_item_key)),
                  esc_html__('Remove this item', 'woocommerce'),
                  esc_attr($product_id),
                  esc_attr($_product->get_sku())
                  ),
                  $cart_item_key
                  );
                ?>
              </td>

              <td class="product-thumbnail">
                <?php
                  /**
                  * Filter the product thumbnail displayed in the WooCommerce cart.
                  *
                  * This filter allows developers to customize the HTML output of the product
                  * thumbnail. It passes the product image along with cart item data
                  * for potential modifications before being displayed in the cart.
                  *
                  * @param string $thumbnail     The HTML for the product image.
                  * @param array  $cart_item     The cart item data.
                  * @param string $cart_item_key Unique key for the cart item.
                  *
                  * @since 2.1.0
                  */
                  $thumbnail = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key);

                  if (!$product_permalink) {
                    echo $thumbnail; // PHPCS: XSS ok.
                  } else {
                    printf('<a href="%s">%s</a>', esc_url($product_permalink), $thumbnail); // PHPCS: XSS ok.
                  }
                ?>
              </td>

              <td class="product-name" data-title="<?php esc_attr_e('Product', 'woocommerce'); ?>">
                <?php
                  if (!$product_permalink) {
                    echo wp_kses_post($product_name . '&nbsp;');
                  } else {
                    /**
                    * This filter is documented above.
                    *
                    * @since 2.1.0
                    */
                    echo wp_kses_post(apply_filters('woocommerce_cart_item_name', sprintf('<a href="%s">%s</a>', esc_url($product_permalink), $_product->get_name()), $cart_item, $cart_item_key));
                  }


                  do_action('woocommerce_after_cart_item_name', $cart_item, $cart_item_key);

                  // Meta data.
                  echo wc_get_formatted_cart_item_data($cart_item); // PHPCS: XSS ok.

                  // Backorder notification.
                  if ($_product->backorders_require_notification() && $_product->is_on_backorder($cart_item['quantity'])) {
                    echo wp_kses_post(apply_filters('woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__('Available on backorder', 'woocommerce') . '</p>', $product_id));
                  }
                  // Editable quantity input below product title start
                  //  if ($_product->is_sold_individually()) {
                    //    $min_quantity = 1;
                    //    $max_quantity = 1;
                    //     } else {
                      //    $min_quantity = 0;
                      //    $max_quantity = $_product->get_max_purchase_quantity();
                      //    }

                      //    $product_quantity = woocommerce_quantity_input(
                      //      array(
                      //          'input_name' => "cart[{$cart_item_key}][qty]",
                      //          'input_value' => $cart_item['quantity'],
                      //          'max_value' => $max_quantity,
                      //          'min_value' => $min_quantity,
                      //          'product_name' => $_product->get_name(),
                      //        ),
                      //        $_product,
                      //        false
                      //        );

                      //    echo '<div class="custom-edit-qty">' . apply_filters('woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item) . '</div>';
                      // Editable quantity input below product title end
                    ?>
                  </td>

                  <td class="product-price" data-title="<?php esc_attr_e('Price', 'woocommerce'); ?>">
                    <?php
                      echo apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key); // PHPCS: XSS ok.
                    ?>
                  </td>

                  <!-- Total Quantity (static display only) start-->
                  <td class="product-quantity" data-title="<?php esc_attr_e('Quantity', 'woocommerce'); ?>">
                    <?php echo esc_html($cart_item['quantity']); ?>
                  </td>
                  <!-- Total Quantity (static display only) end-->
                  <td class="product-subtotal" data-title="<?php esc_attr_e('Subtotal', 'woocommerce'); ?>">
                    <?php
                      echo apply_filters('woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal($_product, $cart_item['quantity']), $cart_item, $cart_item_key); // PHPCS: XSS ok.
                    ?>
                  </td>
                </tr>
                <?php
                }
              }
            ?>

            <?php do_action('woocommerce_cart_contents'); ?>

            <?php do_action('woocommerce_after_cart_contents'); ?>
          </tbody>
        </table>
        <?php do_action('woocommerce_after_cart_table'); ?>
        <?php echo do_shortcode('[send_basket]'); ?>
      </div>
      <div class="cart-right-part">
        <?php include __DIR__ . '/cart-right.php'; ?>

      </div>
    </form>
    <?php do_action('woocommerce_after_cart'); ?>