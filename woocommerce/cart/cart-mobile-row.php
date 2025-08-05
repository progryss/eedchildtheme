<?php
// Determine if this is a fee product
$fee_ids = [];
foreach ($GLOBALS['customisation_fee_products'] as $group => $items) {
  if (is_array($items)) {
    $fee_ids = array_merge($fee_ids, array_values($items));
  }
}

$product_id = !empty($cart_item['variation_id']) ? $cart_item['variation_id'] : $cart_item['product_id'];
$is_fee_product = in_array($product_id, $fee_ids);
?>
<tr class="forMob <?php echo $is_fee_product ? 'mobile-customise-tr' : ''; ?>">
  <td class="cartProductRow">
    <div class="cart-product-flex">
      <div class="productThumbnail">
        <?php
        $thumbnail = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key);

        if (!$product_permalink) {
          echo $thumbnail; // PHPCS: XSS ok.
        } else {
          printf('<a href="%s">%s</a>', esc_url($product_permalink), $thumbnail); // PHPCS: XSS ok.
        }
        ?>
      </div>
      <div class="productRowDetails">
        <?php

        $product_name = $_product->get_name();

        if (!$product_permalink) {
          echo '<div class="product-name common-label">' . wp_kses_post($product_name . '&nbsp;') . '</div>';
        } else {
          echo '<div class="common-label product-name custom-name-pl">' . wp_kses_post(apply_filters(
            'woocommerce_cart_item_name',
            sprintf('<a href="%s">%s</a>', esc_url($product_permalink), $product_name),
            $cart_item,
            $cart_item_key
          )) . '</div>';
        }



        echo '<div class="productPrice common-label"><div class="custom-product-label">Price (ex VAT):</div>' . apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key) . '</div>';

        ?>

        <p class="productQuantity common-label">
          <span class="custom-product-label">Total Quantity:</span>
          <span class="product-quantity" data-title="<?php esc_attr_e('Quantity', 'woocommerce'); ?>">
            <?php echo esc_html($cart_item['quantity']); ?>
          </span>
        </p>
        <p class="productSubtotal common-label">
          <span class="custom-product-label">Subtotal (ex VAT):</span>
          <span>
            <?php
            echo apply_filters('woocommerce_cart_item_subtotal', WC()->cart->get_product_subtotal($_product, $cart_item['quantity']), $cart_item, $cart_item_key); // PHPCS: XSS ok.
            ?>
          </span>
        </p>
        <p class="productRemove">
          <?php
          echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
            'woocommerce_cart_item_remove_link',
            sprintf(
              '<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s">Remove</a>',
              esc_url(wc_get_cart_remove_url($cart_item_key)),
              /* translators: %s is the product name */
              esc_attr(sprintf(__('Remove %s from cart', 'woocommerce'), wp_strip_all_tags($product_name))),
              esc_attr($product_id),
              esc_attr($_product->get_sku())
            ),
            $cart_item_key
          );
          ?>
        </p>
      </div>
    </div>

  </td>

</tr>
<script>
  document.addEventListener("DOMContentLoaded", function () {
    const rows = document.querySelectorAll("tr.mobile-customise-tr");
    if (rows.length > 0) {
      // Remove any previous red border if already set
      rows.forEach((row) => {
        const cell = row.querySelector(".cartProductRow");
        if (cell) {
          cell.style.borderTop = "";
          cell.style.borderBottom = "";
        }
      });

      // Add red border to the first row
      const firstRow = rows[0];
      const firstCell = firstRow.querySelector(".cartProductRow");
      if (firstCell) {
        firstCell.style.setProperty("border-top", "1px solid #E0E0E0", "important");
        firstCell.style.setProperty("border-radius", "10px 10px 0px 0px", "important");
      }

      // Add red border to the last row
      const lastRow = rows[rows.length - 1];
      const lastCell = lastRow.querySelector(".cartProductRow");
      if (lastCell) {
        lastCell.style.setProperty("border-bottom", "1px solid #E0E0E0", "important");
        lastCell.style.setProperty("padding-bottom", "15px", "important");
        lastCell.style.setProperty("border-radius", "0px 0px 10px 10px", "important");
      }
    }
  });
</script>