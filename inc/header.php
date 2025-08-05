<?php

// Start Header and  Mega Menu Code
function custom_storefront_header_cleanup()
{
    remove_action('storefront_header', 'storefront_site_branding', 20);
    remove_action('storefront_header', 'storefront_product_search', 40);
    remove_action('storefront_header', 'storefront_header_cart', 60);
}
add_action('init', 'custom_storefront_header_cleanup');

function custom_storefront_header_layout()
{
    ?>
    <div class="custom-header-container desktop-header">
        <!-- Logo -->
        <div class="custom-header-logo">
            <?php storefront_site_branding(); ?>
        </div>

        <!-- Right Section -->
        <div class="custom-header-right">
            <!-- Search Bar -->
            <div class="custom-header-search">
                <?php storefront_product_search(); ?>
            </div>

            <!-- Contact Info -->
            <div class="custom-header-contact">
                <!-- <i class="fa-solid fa-phone"></i> -->
                <svg width="18" height="18" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M0.799805 4.65741C0.799805 15.4689 9.28153 24.2333 19.7442 24.2333C20.2163 24.2333 20.6843 24.2155 21.1477 24.1804C21.6795 24.1401 21.9453 24.12 22.1875 23.9761C22.3879 23.8568 22.578 23.6454 22.6784 23.4301C22.7998 23.1702 22.7998 22.8669 22.7998 22.2606V18.7024C22.7998 18.1925 22.7998 17.9375 22.7185 17.719C22.6469 17.5259 22.5303 17.354 22.3792 17.2183C22.2082 17.0648 21.9763 16.9776 21.5126 16.8033L17.5931 15.3306C17.0535 15.1279 16.7837 15.0265 16.5277 15.0436C16.302 15.0588 16.0848 15.1385 15.9002 15.2736C15.691 15.4268 15.5433 15.6812 15.2479 16.19L14.2442 17.9185C11.0055 16.4028 8.3799 13.6862 6.91092 10.3407L8.58369 9.30362C9.07602 8.99837 9.32219 8.84575 9.47049 8.6295C9.60127 8.43882 9.67839 8.21438 9.69306 7.98115C9.70968 7.71664 9.61154 7.43786 9.41537 6.88029L7.99013 2.83016C7.82147 2.35093 7.73715 2.11131 7.58854 1.93459C7.45726 1.77847 7.29089 1.65806 7.10405 1.58392C6.89253 1.5 6.64579 1.5 6.15231 1.5H2.70893C2.1221 1.5 1.82868 1.5 1.57711 1.62535C1.36875 1.72918 1.1642 1.92563 1.04877 2.13278C0.909414 2.3829 0.889943 2.65766 0.851003 3.20718C0.817075 3.68601 0.799805 4.16963 0.799805 4.65741Z"
                        stroke="var(--secondary-color)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                </svg>

                <span class="call-text-box">Call <span>+44 (0)1582 475 801</span></span>
            </div>

            <!-- Login/Register -->
            <div class="custom-header-login">
                <!-- <i class="fa-regular fa-user"></i> -->
                <svg width="18" height="18" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <g clip-path="url(#clip0_759_483)">
                        <path
                            d="M12.8003 14.0617C15.9649 14.0617 18.5303 11.2825 18.5303 7.85417C18.5303 4.42586 15.9649 1.64667 12.8003 1.64667C9.63572 1.64667 7.07031 4.42586 7.07031 7.85417C7.07031 11.2825 9.63572 14.0617 12.8003 14.0617Z"
                            stroke="#00AF9A" stroke-width="1.91" stroke-miterlimit="10" />
                        <path
                            d="M2.2998 25.4367L2.6698 23.2158C3.1069 20.651 4.35954 18.3331 6.21011 16.6647C8.06069 14.9964 10.3923 14.083 12.7998 14.0833C15.2102 14.084 17.5441 15.0004 19.395 16.6731C21.246 18.3457 22.4969 20.6687 22.9298 23.2375L23.2998 25.4583"
                            stroke="var(--secondary-color)" stroke-width="1.91" stroke-miterlimit="10" />
                    </g>
                    <defs>
                        <clipPath id="clip0_759_483">
                            <rect width="24" height="26" fill="white" transform="translate(0.799805)" />
                        </clipPath>
                    </defs>
                </svg>

                <div>
                    <div class="login-account"><a
                            href="<?php echo esc_url(get_permalink(get_option('woocommerce_myaccount_page_id'))); ?>">Your
                            Account</a></div>
                    <!-- <div class="login-register"><a href="<?php echo esc_url(get_permalink(get_option('woocommerce_myaccount_page_id'))); ?>">Login / Register</a></div> -->

<?php
// Show user name or login/register link
if (is_user_logged_in()) {
    $current_user = wp_get_current_user();
    $first_name = get_user_meta($current_user->ID, 'first_name', true);
    $account_url = get_permalink(get_option('woocommerce_myaccount_page_id'));
    ?>
    <div class="login-register">
        <a href="<?php echo $account_url; ?>">
            Welcome, <strong><?php echo $first_name ? esc_html($first_name) : esc_html($current_user->user_login); ?></strong>!
        </a>
    </div>
    <?php
} else {
    ?>
    <div class="login-register">
        <a href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>">Login / Register</a>
    </div>
    <?php
}
?>


                </div>
            </div>

            <!-- Cart -->

            <div class="custom-header-cart">
                <a href="<?php echo esc_url(wc_get_cart_url()); ?>">
                    <div class="circle-icon">
                        <div> <svg width="18" height="18" viewBox="0 0 25 25" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M7.38467 3.50551H24.3193L22.0153 12.7268H8.62531M23.1673 17.9961H9.3433L7.0393 0.87085H3.5833M3.5833 7.4575H1.2793M4.7353 11.4095H1.2793M5.8873 15.3615H1.2793M10.4953 23.2655C10.4953 23.993 9.97952 24.5828 9.3433 24.5828C8.70707 24.5828 8.1913 23.993 8.1913 23.2655C8.1913 22.5379 8.70707 21.9481 9.3433 21.9481C9.97952 21.9481 10.4953 22.5379 10.4953 23.2655ZM23.1673 23.2655C23.1673 23.993 22.6515 24.5828 22.0153 24.5828C21.379 24.5828 20.8633 23.993 20.8633 23.2655C20.8633 22.5379 21.379 21.9481 22.0153 21.9481C22.6515 21.9481 23.1673 22.5379 23.1673 23.2655Z"
                                    stroke="var(--white-color)" stroke-width="1.3824" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                            <span class="cart-count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>

                        </div>
                    </div>

                </a>
            </div>
        </div>
    </div>
    <!-- Mobile Header -->
    <div class="mobile-header-main">
        <div class="mobile-header">
            <div class="custom-header-logo">
                <?php storefront_site_branding(); ?>
            </div>
            <div class="header-icons">
                <!-- <a href="<?php echo esc_url(get_permalink(get_option('woocommerce_myaccount_page_id'))); ?>" class="sign-in">Sign in / Register</a> -->
<?php
$account_url = get_permalink(get_option('woocommerce_myaccount_page_id'));

if (is_user_logged_in()) {
    $current_user = wp_get_current_user();
    $first_name = get_user_meta($current_user->ID, 'first_name', true);
    ?>
    <a href="<?php echo $account_url; ?>" class="sign-in">
        Welcome, <strong><?php echo $first_name ? $first_name : $current_user->user_login; ?></strong>
    </a>
    <?php
} else {
    ?>
    <a href="<?php echo $account_url; ?>" class="sign-in">Sign in / Register</a>
    <?php
}
?>


                <a href="<?php echo esc_url(wc_get_cart_url()); ?>" class="cart-icon">
                    <div class="circle-icon">
                        <div> <i class="fa-solid fa-shopping-basket"></i>
                            <?php $cart_count = WC()->cart->get_cart_contents_count(); ?>
                            <span class="cart-count"><?php echo WC()->cart->get_cart_contents_count(); ?></span>
                        </div>
                    </div>
                </a>
            </div>
        </div>

        <!-- Search Bar (Mobile Only) -->
        <div class="custom-header-search mobile-search">
            <?php storefront_product_search(); ?>
        </div>
    </div>

    <?php
}
add_action('storefront_header', 'custom_storefront_header_layout', 20);


// Mega Menu Code

class Mega_Menu_Walker extends Walker_Nav_Menu
{

    public function start_lvl(&$output, $depth = 0, $args = array())
    {
        // Skip default submenu output
    }

    public function end_lvl(&$output, $depth = 0, $args = array())
    {
        // Skip default submenu close
    }

    public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
    {
        $classes = implode(' ', $item->classes);
        $title = esc_html($item->title);
        $url = esc_url($item->url);

        if ($depth === 0) {
            $output .= "<li class='menu-item $classes'>";
            $output .= "<a href='{$url}'>{$title}</a>";

            if (in_array('menu-item-has-children', $item->classes)) {
                $output .= '<div class="top-level-child-box">';
                $output .= '<div class="left-box"><ul class="depth-1-children">';
            }
        } elseif ($depth === 1) {
            $has_children = in_array('menu-item-has-children', $item->classes) ? ' has-submenu' : '';
            $output .= "<li class='menu-item $classes$has_children'><a href='{$url}'>{$title}</a>";
            $output .= '<ul class="depth-2-children" style="display:none;">';
        } elseif ($depth === 2) {
            $output .= "<li class='menu-item $classes'><a href='{$url}'>{$title}</a></li>";
        }
    }

    public function end_el(&$output, $item, $depth = 0, $args = array())
    {
        if ($depth === 1) {
            $output .= '</ul></li>'; // Close depth-2 list and depth-1 li
        }

        if ($depth === 0) {
            if (in_array('menu-item-has-children', $item->classes)) {
                $output .= '</ul></div>'; // Close left-box


                $isBrandGrid = get_field('brand_logo_grid', $item);
                if ($isBrandGrid) {
                    $grid_title = get_field('grid_title', $item);

                    $acf_html = '<div class="right-box logo-grid-wrapper">';
                    if ($grid_title) {
                        $acf_html .= '<h3 class="menu-grid-title">' . esc_html($grid_title) . '</h3>';
                    }

                    if (have_rows('image_grid', $item)):
                        $acf_html .= '<div class="menu-logo-grid">';
                        while (have_rows('image_grid', $item)):
                            the_row();
                            $logo_image = get_sub_field('logo_image');
                            $link = get_sub_field('link');

                            // Output example:
                            $acf_html .= '<div class="menu-logo-grid-item">';
                            if ($logo_image) {
                                if ($link) {
                                    $acf_html .= '<a href="' . esc_url($link['url']) . '" target="' . esc_attr($link['target']) . '"><img src="' . esc_url($logo_image['url']) . '" alt="' . esc_attr($logo_image['alt']) . '"></a>';
                                } else {
                                    $acf_html .= '<img src="' . esc_url($logo_image['url']) . '" alt="' . esc_attr($logo_image['alt']) . '">';
                                }
                            }

                            $acf_html .= '</div>';

                        endwhile;
                        $acf_html .= '</div>';
                    endif;
                    $acf_html .= '</div>';
                } else {
                    // ACF Block 1
                    $acf_1 = get_field('right_content_box_1', $item);
                    $acf_html = '<div class="right-box"><div class="acf-mega-data">';
                    if (!empty($acf_1['mega_link'])) {
                        $link_url1 = esc_url($acf_1['mega_link']['url']);
                        if (!empty($acf_1['mega_image'])) {
                            $acf_html .= '<a href="' . $link_url1 . '"><img src="' . esc_url($acf_1['mega_image']['url']) . '" alt="' . esc_attr($acf_1['mega_image']['alt']) . '"></a>';
                        }
                    } else {
                        if (!empty($acf_1['mega_image'])) {
                            $acf_html .= '<img src="' . esc_url($acf_1['mega_image']['url']) . '" alt="' . esc_attr($acf_1['mega_image']['alt']) . '">';
                        }
                    }

                    if (!empty($acf_1['mega_link'])) {
                        $link_url2 = esc_url($acf_1['mega_link']['url']);
                        if (!empty($acf_1['mega_title'])) {
                            $acf_html .= '<h2><a href="' . $link_url2 . '">' . esc_html($acf_1['mega_title']) . '</a></h2>';
                        }
                    } else {
                        // If no link, just display the title normally
                        if (!empty($acf_1['mega_title'])) {
                            $acf_html .= '<h2>' . esc_html($acf_1['mega_title']) . '</h2>';
                        }
                    }

                    if (!empty($acf_1['mega_desc'])) {
                        $acf_html .= '<p>' . esc_html($acf_1['mega_desc']) . '</p>';
                    }

                    if (!empty($acf_1['mega_link'])) {
                        $link_url3 = esc_url($acf_1['mega_link']['url']);
                        $link_text = esc_html($acf_1['mega_link']['title']);
                        $acf_html .= '<a href="' . $link_url3 . '" class="mega-btn">' . $link_text . '</a>';
                    }

                    $acf_html .= '</div></div>';

                    // ACF Block 2
                    $acf_2 = get_field('right_content_box_2', $item);
                    $acf_html .= '<div class="right-box"><div class="acf-mega-data">';

                    if (!empty($acf_2['mega_link_end'])) {
                        $link_end_url1 = esc_url($acf_2['mega_link_end']['url']);
                        if (!empty($acf_2['mega_image_end'])) {
                            $acf_html .= '<a href="' . $link_end_url1 . '"><img src="' . esc_url($acf_2['mega_image_end']['url']) . '" alt="' . esc_attr($acf_2['mega_image_end']['alt']) . '"></a>';
                        }
                    } else {
                        if (!empty($acf_2['mega_image_end'])) {
                            $acf_html .= '<img src="' . esc_url($acf_2['mega_image_end']['url']) . '" alt="' . esc_attr($acf_2['mega_image_end']['alt']) . '">';
                        }
                    }

                    if (!empty($acf_2['mega_link_end'])) {
                        $link_end_url2 = esc_url($acf_2['mega_link_end']['url']);
                        if (!empty($acf_2['mega_title_end'])) {
                            $acf_html .= '<h2><a href="' . $link_end_url2 . '">' . esc_html($acf_2['mega_title_end']) . '</a></h2>';
                        }
                    } else {
                        // If no link, just display the title normally
                        if (!empty($acf_2['mega_title_end'])) {
                            $acf_html .= '<h2>' . esc_html($acf_2['mega_title_end']) . '</h2>';
                        }
                    }

                    if (!empty($acf_2['mega_desc_end'])) {
                        $acf_html .= '<p>' . esc_html($acf_2['mega_desc_end']) . '</p>';
                    }

                    if (!empty($acf_2['mega_link_end'])) {
                        $link_end_url3 = esc_url($acf_2['mega_link_end']['url']);
                        $link_end_text = esc_html($acf_2['mega_link_end']['title']);
                        $acf_html .= '<a href="' . $link_end_url3 . '" class="mega-btn">' . $link_end_text . '</a>';
                    }

                    $acf_html .= '</div></div>';
                }

                $output .= '<div class="middle-box"></div>';
                $output .= $acf_html;
                $output .= '</div>'; // Close top-level-child-box
            }

            $output .= '</li>'; // Close top-level li
        }
    }
}



// End Header and  Mega Menu Code

// Start Before Header Announcement Bar
add_action('storefront_before_header', 'custom_before_header_announcement_bar', 48);

function custom_before_header_announcement_bar()
{
    $before_header_announcement_bar = get_field('before_header_announcement_bar', 'option');
    $before_header_announcement_bar_group = get_field('before_header_announcement_bar_group', 'option');

    $before_header_background = $before_header_announcement_bar_group['before_header_background'] ?? '';
    $before_header_text_color = $before_header_announcement_bar_group['before_header_text_color'] ?? '';
    $before_header_text = $before_header_announcement_bar_group['before_header_text'] ?? '';

    if ($before_header_announcement_bar && !empty($before_header_text)) {
        ?>
        <div class="before-header-announcement-bar"
            style="background:<?php echo esc_attr($before_header_background); ?>; color:<?php echo esc_attr($before_header_text_color); ?>">
            <div class="col-full">
                <p><?php echo esc_html($before_header_text); ?></p>
            </div>
        </div>
        <?php
    }
}

// End Before Header Announcement Bar

// Start After Header Announcement Bar
add_action('storefront_before_content', 'custom_after_header_announcement_bar', 5);

function custom_after_header_announcement_bar()
{
    $after_header_announcement_bar = get_field('after_header_announcement_bar', 'option');
    $after_header_announcement_bar_group = get_field('after_header_announcement_bar_group', 'option');

    $after_header_background = $after_header_announcement_bar_group['after_header_background'] ?? '';
    $after_header_text_color = $after_header_announcement_bar_group['after_header_text_color'] ?? '';
    $after_header_text = $after_header_announcement_bar_group['after_header_text'] ?? '';

    if ($after_header_announcement_bar && !empty($after_header_text)) {
        ?>
        <div class="after-header-announcement-bar"
            style="background:<?php echo esc_attr($after_header_background); ?>; color:<?php echo esc_attr($after_header_text_color); ?>">
            <div class="col-full">
                <p><?php echo esc_html($after_header_text); ?></p>
            </div>
        </div>
        <?php
    }
}
// End After Header Announcement Bar

