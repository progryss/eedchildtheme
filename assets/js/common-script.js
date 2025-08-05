// Start Header JS
document.addEventListener('DOMContentLoaded', function () {
    const leftItems = document.querySelectorAll('.left-box .depth-1-children > li.menu-item-has-children');
    const leftItems2 = document.querySelectorAll('.left-box .depth-1-children > li:not(.menu-item-has-children)');
    const middleBox = document.querySelector('.middle-box');

    leftItems.forEach(item => {
        item.addEventListener('mouseenter', () => {
            // Remove previous hover_active class
            leftItems.forEach(i => i.classList.remove('hover_active'));
            
            // Add hover_active to current item
            item.classList.add('hover_active');

            // Add class to middle-box
            if (middleBox) {
                middleBox.classList.add('show-middle-box');
            }
        });

        let outerBox = item.closest(".top-level-child-box");
        if (outerBox) {
            outerBox.addEventListener('mouseleave', () => {
                // Remove hover_active from all items
                leftItems.forEach(i => i.classList.remove('hover_active'));

                // Remove show-middle-box from middleBox
                if (middleBox) {
                    middleBox.classList.remove('show-middle-box');
                }
            });
        }
    });

    leftItems2.forEach(item => {
        item.addEventListener('mouseenter', () => {
            // Remove hover_active and middle box class on hover of non-child items
            leftItems.forEach(i => i.classList.remove('hover_active'));
            if (middleBox) {
                middleBox.classList.remove('show-middle-box');
            }
        });
    });
});


// End Header JS



// Start JS For Footer
  jQuery(document).ready(function() {
    // Ensure this runs only on mobile view
    if (jQuery(window).width() <= 991) {
      document.querySelectorAll('.menu').forEach(menu => {
        menu.parentElement.classList.add('toggle-content');
      });

      jQuery('.widget-title').click(function() {
        const navMenu = jQuery(this).next('.toggle-content'); 
        
        // Toggle slide up or down
        navMenu.slideToggle(300); 
        jQuery(this).toggleClass('active'); 
        
        // Add or remove 'active' class from the parent of the heading
        jQuery(this).parent().toggleClass('active');
      });
    }
  });

  // End JS For Footer

  // Start Add Unique Class in Pagination
function addUniqueClasses(selector) {
    // Get all pagination items inside the given selector
    const paginationItems = document.querySelectorAll(`${selector} .woocommerce-pagination`);
    paginationItems.forEach((item, index) => {
        item.classList.add('pagination-' + (index + 1));
    });

    // Get all result count items inside the given selector
    const resultCountItems = document.querySelectorAll(`${selector} .woocommerce-result-count`);
    resultCountItems.forEach((item, index) => {
        item.classList.add('result-count-' + (index + 1));
    });

    // Get all sorting items inside the given selector
    const sortingItems = document.querySelectorAll(`${selector} .storefront-sorting`);
    sortingItems.forEach((item, index) => {
        item.classList.add('sorting-' + (index + 1));
    });
}

document.addEventListener('DOMContentLoaded', function () {
    // Run for both custom pages
    addUniqueClasses('.custom-collection-page');
    addUniqueClasses('.custom-shop-page');
    addUniqueClasses('.custom-archive-page');

    // Observe changes inside each page
    ['.custom-collection-page', '.custom-shop-page','.custom-archive-page'].forEach((selector) => {
        const targetNode = document.querySelector(selector);

        if (targetNode) {
            const observer = new MutationObserver((mutationsList) => {
                for (const mutation of mutationsList) {
                    if (mutation.type === 'childList') {
                        addUniqueClasses(selector);
                    }
                }
            });

            observer.observe(targetNode, {
                childList: true,
                subtree: true,
            });
        }
    });
});
// End Add Unique Class in Pagination

// Filter JS
jQuery(document).ready(function($) {
  $('.wc-blocks-filter-wrapper .wp-block-heading').each(function(index) {
    var $heading = $(this);
    var $parentWrapper = $heading.closest('.wp-block-woocommerce-filter-wrapper');
    var $filterBox = $heading.nextUntil('.wp-block-heading').filter('.is-loading');

    if (index === 1 || index ===2) {
      $heading.addClass('active');
      $filterBox.addClass('active').show();
      $parentWrapper.addClass('active');
    }

    if (index !== 0) {
      if ($heading.hasClass('active')) {
        $filterBox.addClass('active').show();
        $parentWrapper.addClass('active');
      } else {
        $filterBox.removeClass('active').hide();
        $parentWrapper.removeClass('active');
      }
    }
  });

  $('.wc-blocks-filter-wrapper .wp-block-heading').not(':first').on('click', function () {
    var $heading = $(this);
    var $filterBox = $heading.nextUntil('.wp-block-heading').filter('.is-loading');
    var $parentWrapper = $heading.closest('.wp-block-woocommerce-filter-wrapper');

    $heading.toggleClass('active');

    if ($heading.hasClass('active')) {
      $filterBox.addClass('active').slideDown(300, function() {
        $parentWrapper.addClass('active');
      });
    } else {
      $filterBox.removeClass('active').slideUp(300, function() {
        $parentWrapper.removeClass('active');
      });
    }
  });
});
// End Filter JS

// Start Mobile Filter Js
document.addEventListener('DOMContentLoaded', function () {
  const openBtn = document.getElementById('openFilter');
  const closeBtn = document.getElementById('closeFilter');
  const popup = document.getElementById('mobileFilterPopup');

  openBtn?.addEventListener('click', () => {
    const sidebar = document.getElementById('secondary');
    const popupContent = popup.querySelector('.filter-popup-content');

    // Clone only once
    if (sidebar && popupContent && !popupContent.querySelector('#clonedSidebar')) {
      const clonedSidebar = sidebar.cloneNode(true);
      clonedSidebar.id = 'clonedSidebar'; // Avoid ID conflicts
      popupContent.appendChild(clonedSidebar);
    }

    popup.style.display = 'flex';
    setTimeout(() => popup.classList.add('active'), 10);
    document.body.style.overflow = 'hidden';
  });

  closeBtn?.addEventListener('click', closePopup);
  popup?.addEventListener('click', function (e) {
    if (e.target === popup) closePopup();
  });

  function closePopup() {
    popup.classList.add('closing');
    document.body.style.overflow = '';

    setTimeout(() => {
      popup.classList.remove('active');
      popup.classList.remove('closing');
      popup.style.display = 'none';

      // Optional: Remove cloned sidebar if you want to refresh next time
      const existingClone = popup.querySelector('#clonedSidebar');
      if (existingClone) existingClone.remove();
    }, 500);
  }
});


// End Mobile Filter JS

// Start Product Gallery JS 
jQuery(function($) {
    const $gl = $(".product_customizer_gallery");
    const $gl2 = $(".product_customizer_gallery2");

    function getCleanImageName(url) {
        return url.replace(/-\d+x\d+(?=\.(jpg|jpeg|png|gif))/i, "").toLowerCase();
    }

    function handleCarouselsHeight() {
        $(".left.child").css("height", "auto");
        $(".product_customizer_gallery2 .slick-slide").css("height", "auto");
        $(".product_customizer_gallery2 .item").css("height", "auto");
    }

   function initSlickIfDesktop() {
    if (window.innerWidth >= 1025 && !$gl.hasClass('slick-initialized')) {
        $gl.slick({
            rows: 0,
            slidesToShow: 4,
            arrows: false,
            draggable: false,
            useTransform: false,
            infinite: false,
            mobileFirst: true,
            responsive: [
                { breakpoint: 768, settings: { slidesToShow: 4 }},
                { breakpoint: 1023, settings: { slidesToShow: 4, vertical: true }}
            ]
        });

        $gl2.slick({
            rows: 0,
            useTransform: false,
            prevArrow: ".arrow-left",
            nextArrow: ".arrow-right",
            fade: true,
            speed: 200,
            infinite: false,
            asNavFor: $gl
        });

        // ✅ Immediately update photo counter after initializing
        const slickInstance = $gl2.slick("getSlick");
        if (slickInstance) {
            $(".photos-counter span:nth-child(1)").text(`${slickInstance.currentSlide + 1}/`);
            $(".photos-counter span:nth-child(2)").text(slickInstance.slideCount);
        }

        // ✅ Also keep your init event in case it triggers normally
        $gl2.on("init", function(event, slick){
            $(".photos-counter span:nth-child(1)").text(`${slick.currentSlide + 1}/`);
            $(".photos-counter span:nth-child(2)").text(slick.slideCount);
            handleCarouselsHeight();
            const currentIndex = slick.currentSlide;
            $gl.find(".item").removeClass("slick-current slick-active");
            $gl.find(`[data-slick-index="${currentIndex}"]`).addClass("slick-current slick-active");
        });

        // ✅ Keep updating counter after every change
        $gl2.on("afterChange", function(event, slick, currentSlide){
            $(".photos-counter span:nth-child(1)").text(`${slick.currentSlide + 1}/`);
            handleCarouselsHeight();
            $gl.find(".item").removeClass("slick-current slick-active");
            $gl.find(`[data-slick-index="${currentSlide}"]`).addClass("slick-current slick-active");
        });
    }
}


    function destroySlickIfMobile() {
        if (window.innerWidth < 1025 && $gl.hasClass('slick-initialized')) {
            $gl.slick('unslick');
            $gl2.slick('unslick');
        }
    }

    function initManualSliderForMobile() {
        if (window.innerWidth >= 1025) return;

        const mainSlides = document.querySelectorAll(".product_customizer_gallery2 .item");
        const thumbSlides = document.querySelectorAll(".product_customizer_gallery .item");
        const leftBtn = document.querySelector(".arrow-left");
        const rightBtn = document.querySelector(".arrow-right");
        const wrapper = document.querySelector(".product_customizer_gallery");

        if (!mainSlides.length || !thumbSlides.length) return;

        let currentSlide = 0;

function showMainImage(index) {
    mainSlides.forEach((slide, i) => {
        slide.style.display = i === index ? "block" : "none";
    });

    thumbSlides.forEach((slide, i) => {
        slide.classList.toggle("slick-current", i === index);
        slide.classList.toggle("slick-active", i === index);
        slide.classList.toggle("active-thumb", i === index);
    });

    const counter = document.querySelector(".photos-counter span:nth-child(1)");
    const total = document.querySelector(".photos-counter span:nth-child(2)");
    if (counter && total) {
        counter.textContent = `${index + 1}/`;
        total.textContent = mainSlides.length;
    }

    // Disable/Enable arrows like Slick
    if (leftBtn) {
        leftBtn.classList.toggle("slick-disabled", index === 0);
    }
    if (rightBtn) {
        rightBtn.classList.toggle("slick-disabled", index === mainSlides.length - 1);
    }

    // Scroll active thumbnail
    const activeThumb = thumbSlides[index];
    if (activeThumb && wrapper) {
        const wrapperRect = wrapper.getBoundingClientRect();
        const thumbRect = activeThumb.getBoundingClientRect();
        const scrollLeftOffset = thumbRect.left - wrapperRect.left + wrapper.scrollLeft;

        wrapper.scrollTo({
            left: scrollLeftOffset,
            behavior: "smooth"
        });
    }
}

        thumbSlides.forEach((thumb, index) => {
            thumb.addEventListener("click", () => {
                currentSlide = index;
                showMainImage(index);
            });
        });

        if (leftBtn) {
            leftBtn.addEventListener("click", () => {
                if (currentSlide > 0) {
                    currentSlide--;
                    showMainImage(currentSlide);
                }
            });
        }

        if (rightBtn) {
            rightBtn.addEventListener("click", () => {
                if (currentSlide < mainSlides.length - 1) {
                    currentSlide++;
                    showMainImage(currentSlide);
                }
            });
        }

        showMainImage(currentSlide);
    }

    function handleSlickBasedOnWidth() {
        destroySlickIfMobile();
        initSlickIfDesktop();
    }

    // Init functions
    $(window).on("load resize", function(){
        handleSlickBasedOnWidth();
        initManualSliderForMobile();
        handleCarouselsHeight();
    });

    // Common thumbnail click
    $(".product_customizer_gallery").on("click", ".item", function(){
        const index = $(this).index();
        if (window.innerWidth >= 768) {
            $gl2.slick("slickGoTo", index);
        }
    });

    // Variation thumbnail mapping
    var variationsDataInput = $("input[name='variations_data']").val();
    var variationsData = variationsDataInput ? JSON.parse(variationsDataInput) : null;
    var imageMap = variationsData && variationsData.image_map ? variationsData.image_map : {};

    $(".evp-color-swatch").on("click", function() {
        var selectedColor = $(this).data("color").toLowerCase();
        var variantFullURL = imageMap[selectedColor] && imageMap[selectedColor].image_src 
            ? imageMap[selectedColor].image_src.toLowerCase()
            : "";
        var cleanVariantURL = variantFullURL ? getCleanImageName(variantFullURL) : "";

        if (!cleanVariantURL) return;

        var matchedIndex = -1;
        $(".product_customizer_gallery img").each(function(index) {
            var src = $(this).attr("src").toLowerCase();
            var cleanGalleryURL = getCleanImageName(src);
            if (cleanGalleryURL === cleanVariantURL) {
                matchedIndex = index;
                return false;
            }
        });

        if (matchedIndex !== -1) {
            if (window.innerWidth >= 768) {
                $gl.slick("slickGoTo", matchedIndex);
                $gl2.slick("slickGoTo", matchedIndex);
            } else {
                document.querySelectorAll(".product_customizer_gallery .item")[matchedIndex]?.click();
            }
        }
    });
});


 // End Product Gallery JS

// Start  Product Page Tab JS
document.addEventListener("DOMContentLoaded", function () {
        const tabs = document.querySelectorAll('.custom-tab');
        const contents = document.querySelectorAll('.custom-tab-content');
        tabs.forEach((tab, index) => {
          tab.addEventListener('click', () => {
            tabs.forEach(t => t.classList.remove('active'));
            tab.classList.add('active');
            contents.forEach(c => c.classList.remove('active'));
            if (contents[index]) contents[index].classList.add('active');
          });
        });
      });
// End  Product Page Tab JS

// Start Code SKU + Commodity + Country  Change Sku
jQuery(function ($) {
    const colorNameEl = document.querySelector('.evp-selected-color-name');
    const skuSpan = document.getElementById('variant-sku');

    if (!colorNameEl || !skuSpan || typeof colorSkuMap === 'undefined') return;

     function slugify(text) {
        return text
            .toLowerCase()
            .replace(/\s*\/\s*/g, '-')   // Replace slashes and surrounding spaces with dash
            .replace(/\s+/g, '-')        // Replace remaining spaces with dash
            .replace(/[^a-z0-9\-]/g, ''); // Remove unwanted characters (optional)
    }

    function updateSku() {
        const selectedColor = slugify(colorNameEl.textContent.trim());
        const sku = colorSkuMap[selectedColor] || '';
        skuSpan.textContent = sku;
    }

    // Option 1: Observe DOM changes
    const observer = new MutationObserver(updateSku);
    observer.observe(colorNameEl, { childList: true, subtree: true });

    // Option 2: fallback listener
    colorNameEl.addEventListener('DOMSubtreeModified', updateSku);

    // Also update on load
    updateSku();
});
 jQuery(function($){
        $('form.variations_form').on('show_variation', function (event, variation) {
            const attrs = variation.attributes;
            let color = '';

            for (let key in attrs) {
                if (key.includes('pa_colour')) {
                    color = attrs[key];
                }
            }

            const fallbackSku = skuMap[color] || 'NA';
            const finalSku = variation.sku || fallbackSku;

            $('#variant-sku').text(finalSku);
        });

        $('form.variations_form').on('reset_data', function() {
            $('#variant-sku').text(defaultSku);
        });
    });

// End Code SKU + Commodity + Country  Change Sku


// Start Customize Popup Open JS
function openPopup() {
    const scrollbarWidth = window.innerWidth - document.body.clientWidth;

    document.body.classList.add('noscroll');
    document.body.style.paddingRight = `${scrollbarWidth}px`;

    document.getElementById('popup').style.display = 'flex';
  }

  function closePopup() {
    document.body.classList.remove('noscroll');
    document.body.style.paddingRight = '0';
    document.getElementById('popup').style.display = 'none';
  }
// End Customize Popup Open JS

// Start Hide LoginIn Section When User Login

document.addEventListener('DOMContentLoaded', function() {
    const section = document.querySelector('.logged-in-section-main');
    if (section) {
        if (document.body.classList.contains('logged-in')) {
            section.style.display = 'none';  // Hide for logged-in users
        } else {
            section.style.display = 'block';  // Show for logged-out users
        }
    }
});


// End Hide LoginIn Section When User Login

// Start Faqs JS
jQuery(document).ready(function($) {
    $('.faqs-question-heading').click(function() {
      var answer = $(this).next('.faqs-answer-content');

      // Close all others
      $('.faqs-answer-content').not(answer).slideUp();
      $('.faqs-question-heading').not(this).removeClass('active');

      // Toggle current
      answer.slideToggle();
      $(this).toggleClass('active');
    });
  });

  // End  Faqs JS


// Start Summary Content Position Change For Mobile
let contentMoved = false;

function moveEnhancedContainerForMobile() {
  if (contentMoved) return; // Already moved, skip

  if (window.innerWidth <= 1024) {
    const evpContainer = document.querySelector('.enhanced-variable-product-container');
    const targetContainer = document.querySelector('.varient-move-heres');

    const summaryContainer = document.querySelector('.entry-summary');
    const summaryTarget = document.querySelector('.summery-move-here');

    if (evpContainer && targetContainer && !targetContainer.contains(evpContainer)) {
      targetContainer.appendChild(evpContainer);
    }

    if (summaryContainer && summaryTarget && !summaryTarget.contains(summaryContainer)) {
      summaryTarget.appendChild(summaryContainer);
    }

    contentMoved = true; // Mark as moved
  }
}

// Run on load
moveEnhancedContainerForMobile();

// Run on resize too (but only once)
window.addEventListener('resize', moveEnhancedContainerForMobile);
// End Summary Content Position Change For Mobile


// Start Related Product Slider JS
jQuery(document).ready(function($) {
                $('.custom-related-products-fullwidth ul.products').slick({
                    slidesToShow: 5,
                    slidesToScroll: 1,
                    arrows: true,
                    dots: false,
                    infinite: false,
                    responsive: [
                        {
                            breakpoint: 1024,
                            settings: {
                                slidesToShow: 3
                            }
                        },
                        {
                            breakpoint: 768,
                            settings: {
                                slidesToShow: 2
                            }
                        },
                        {
                            breakpoint: 450,
                            settings: {
                                slidesToShow: 1
                            }
                        }
                    ]
                });
            });
// End Related Product Slider JS

// Start quantity Plus minus without varients 
document.addEventListener('DOMContentLoaded', function () {
  const qtyWrappers = document.querySelectorAll('.custom-product-page .quantity');

  qtyWrappers.forEach(function (wrapper) {
    const input = wrapper.querySelector('input.qty');
    if (!input) return;

    // Check if buttons already exist
    if (wrapper.querySelector('.minus') || wrapper.querySelector('.plus')) return;

    const minusBtn = document.createElement('button');
    minusBtn.type = 'button';
    minusBtn.className = 'minus';
    minusBtn.textContent = '−';

    const plusBtn = document.createElement('button');
    plusBtn.type = 'button';
    plusBtn.className = 'plus';
    plusBtn.textContent = '+';

    wrapper.insertBefore(minusBtn, input);
    wrapper.appendChild(plusBtn);

    minusBtn.addEventListener('click', function () {
      let value = parseInt(input.value, 10) || 1;
      if (value > 1) input.value = value - 1;
    });

    plusBtn.addEventListener('click', function () {
      let value = parseInt(input.value, 10) || 1;
      input.value = value + 1;
    });
  });
});

// Cart Page plus minus
(function () {
    function addQuantityButtons() {
        document.querySelectorAll('.woocommerce-cart-form .quantity').forEach(function (wrapper) {
            if (wrapper.classList.contains('buttons-added')) return;

            const input = wrapper.querySelector('input.qty');
            if (!input) return;

            // Create minus button
            const minusBtn = document.createElement('button');
            minusBtn.type = 'button';
            minusBtn.innerHTML = '&minus;';
            minusBtn.className = 'qty-minus';

            // Create plus button
            const plusBtn = document.createElement('button');
            plusBtn.type = 'button';
            plusBtn.innerHTML = '+';
            plusBtn.className = 'qty-plus';

            // Mark wrapper as processed
            wrapper.classList.add('buttons-added');
            wrapper.insertBefore(minusBtn, input);
            wrapper.appendChild(plusBtn);

            let submitTimeout;

            function autoSubmitCart() {
                clearTimeout(submitTimeout);
                submitTimeout = setTimeout(() => {
                    jQuery('[name="update_cart"]').prop('disabled', false).trigger('click');
                }, 2000); // Delay of 2 seconds
            }

            // Add event listeners
            minusBtn.addEventListener('click', function () {
                let val = parseInt(input.value, 10);
                if (val > 1) {
                    input.value = val - 1;
                    input.dispatchEvent(new Event('change', { bubbles: true }));
                    autoSubmitCart();
                }
            });

            plusBtn.addEventListener('click', function () {
                let val = parseInt(input.value, 10);
                input.value = val + 1;
                input.dispatchEvent(new Event('change', { bubbles: true }));
                autoSubmitCart();
            });

            // Listen to manual input change as well
            input.addEventListener('change', function () {
                autoSubmitCart();
            });
        });
    }

    function initQuantityButtons() {
        addQuantityButtons();

        // Re-run after cart is updated via AJAX
        jQuery(document.body).on('updated_cart_totals updated_wc_div', function () {
            addQuantityButtons();
        });
    }

    document.addEventListener('DOMContentLoaded', initQuantityButtons);
})();


// End quantity Plus minus without varients 

// Start Collection Page Description Read more JS
// document.addEventListener("DOMContentLoaded", function () {
//   const termBox = document.querySelector(".term-description");

//   if (termBox) {
//     const toggleBtn = document.createElement("span");
//     toggleBtn.className = "toggle-readmore";
//     toggleBtn.textContent = "Read more";

//     // Insert after the termBox
//     termBox.parentNode.insertBefore(toggleBtn, termBox.nextSibling);

//     toggleBtn.addEventListener("click", function () {
//       termBox.classList.toggle("expanded");
//       toggleBtn.textContent = termBox.classList.contains("expanded") ? "Read less" : "Read more";
//     });
//   }
// });
document.addEventListener("DOMContentLoaded", function () {
  const termBox = document.querySelector(".term-description");

  if (termBox) {
    const toggleBtn = document.createElement("span");
    toggleBtn.className = "toggle-readmore read-more"; // default class
    toggleBtn.textContent = "Read more";

    termBox.parentNode.insertBefore(toggleBtn, termBox.nextSibling);

    toggleBtn.addEventListener("click", function () {
      termBox.classList.toggle("expanded");

      if (toggleBtn.textContent === "Read more") {
        toggleBtn.textContent = "Read less";
        toggleBtn.classList.remove("read-more");
        toggleBtn.classList.add("read-less");
      } else {
        toggleBtn.textContent = "Read more";
        toggleBtn.classList.remove("read-less");
        toggleBtn.classList.add("read-more");
      }
    });
  }
});

// End  Collection Page Description Read more JS


// Start Sales Contact Form Popup
document.addEventListener("DOMContentLoaded", function () {
  const trigger = document.querySelector(".custom-static-content a");
  const modalOverlay = document.querySelector(".sales-contact-modal-overlay");
  const closeBtn = document.querySelector(".sales-contact-modal-close");
  const scrollbarWidth = window.innerWidth - document.documentElement.clientWidth;

  function openModal() {
    modalOverlay.style.display = "flex";
    document.body.classList.add("sales-contact-modal-open");
    document.body.style.paddingRight = scrollbarWidth + "px";
  }

  function closeModal() {
    modalOverlay.style.display = "none";
    document.body.classList.remove("sales-contact-modal-open");
    document.body.style.paddingRight = "";
  }

  if (trigger) {
    trigger.addEventListener("click", function (e) {
      e.preventDefault();
      openModal();
    });
  }

  if (closeBtn) {
    closeBtn.addEventListener("click", function () {
      closeModal();
    });
  }
});


// End Sales Contact Form Popup

// Start Light Box CSS
document.addEventListener('DOMContentLoaded', function () {
    const pswpElement = document.querySelector('.pswp');
    const galleryItems = [];

    // Collect image data
    document.querySelectorAll('.pswp-link').forEach((link, index) => {
        const width = parseInt(link.getAttribute('data-pswp-width'), 10);
        const height = parseInt(link.getAttribute('data-pswp-height'), 10);
        const item = {
            src: link.getAttribute('href'),
            w: width,
            h: height,
            title: link.getAttribute('data-caption') || ''
        };
        galleryItems.push(item);

        // Preload full-size image
        const preloadImg = new Image();
        preloadImg.src = item.src;

        // On click, open PhotoSwipe
        link.addEventListener('click', function (e) {
            e.preventDefault();

            const options = {
                index: index,
                bgOpacity: 0.8,
                showHideOpacity: true,
                closeOnScroll: false,
                showAnimationDuration: 0 // Fix tint/overlay flash
            };

            const gallery = new PhotoSwipe(pswpElement, PhotoSwipeUI_Default, galleryItems, options);

            // Lock scroll
            gallery.listen('beforeChange', function () {
                document.body.classList.add('no-scroll');
                document.querySelector('.product_customizer_gallery2')?.classList.add('pswp-active');
            });

            // Unlock scroll on close
            gallery.listen('close', function () {
                document.body.classList.remove('no-scroll');
                document.querySelector('.product_customizer_gallery2')?.classList.remove('pswp-active');
            });

            gallery.init();
        });
    });
});

// End Light Box CSS

document.addEventListener("DOMContentLoaded", function () {
  const customArchive = document.querySelector('.custom-archive-page');
  const breadcrumb = document.querySelector('.storefront-breadcrumb');

  if (customArchive && breadcrumb && customArchive.querySelector('.brand-meta')) {
    breadcrumb.classList.add('is-brand-meta');
  }
});


 // Start Cart Page Notification JS

    document.addEventListener('DOMContentLoaded', function () {
        function fadeAndRemove(el) {
            const topBefore = el.getBoundingClientRect().top;

            el.classList.add('fade-out');

            // Scroll fix after animation
            setTimeout(function () {
                const topAfter = el.getBoundingClientRect().top;
                const shift = topBefore - topAfter;

                // Scroll the window up smoothly to adjust for shift
                if (shift > 0) {
                    window.scrollBy({ top: -shift, behavior: 'smooth' });
                }

                el.remove();
            }, 1000); // Wait for fade
        }

        function enhanceMessage(el) {
            // Avoid duplicate close
            if (el.querySelector('.custom-close')) return;

            // Add close (×) icon
            const closeBtn = document.createElement('span');
            closeBtn.innerHTML = '&times;';
            closeBtn.className = 'custom-close';
            closeBtn.addEventListener('click', function () {
                fadeAndRemove(el);
            });
            el.appendChild(closeBtn);

            // Auto remove after 5s
            setTimeout(function () {
                fadeAndRemove(el);
            }, 5000);
        }

        // Enhance existing
        document.querySelectorAll('.woocommerce-cart .woocommerce-message').forEach(enhanceMessage);

        // Observe for new messages
        const observer = new MutationObserver(function (mutations) {
            mutations.forEach(function (mutation) {
                mutation.addedNodes.forEach(function (node) {
                    if (node.nodeType === 1 && node.classList.contains('woocommerce-message')) {
                        enhanceMessage(node);
                    }
                });
            });
        });

        observer.observe(document.body, {
            childList: true,
            subtree: true
        });
    });
    // End Cart Page Notification JS


    // Start Filter Everything JS
document.addEventListener('DOMContentLoaded', function () {
	const sections = document.querySelectorAll('.wpc-filters-section');

	sections.forEach((section, index) => {
		if (index < 2) {
			// First 2 filters: Open
			section.classList.add('wpc-opened');
			section.classList.remove('wpc-closed');
		} else {
			// All others: Closed
			section.classList.remove('wpc-opened');
			section.classList.add('wpc-closed');
		}
	});
});

    // End Filter Everything JS

    // Start Deliverybox Modal JS

      function showModal() {
    document.getElementById("deliveryModal").style.display = "block";
    document.body.classList.add("no-scroll");
  }

  function closeModal() {
    document.getElementById("deliveryModal").style.display = "none";
    document.body.classList.remove("no-scroll");
  }

  window.onclick = function(event) {
    const deliverymodal = document.getElementById("deliveryModal");
    if (event.target === deliverymodal) {
      closeModal();
    }
  };
   // End Deliverybox Modal JS


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

// Checkout page active class add
document.addEventListener("DOMContentLoaded", function () {
  const body = document.body;

  // Ensure checkout page is active
  if (body.classList.contains("woocommerce-checkout")) {
    const checkoutStep = document.querySelector(".checkout-step");
    const finalStep = document.querySelector(".final-step");

    if (!body.classList.contains("woocommerce-order-received")) {
      // On checkout step
      if (checkoutStep) checkoutStep.classList.add("active");
      if (finalStep) finalStep.classList.remove("active");
    } else {
      // On final step
      if (finalStep) finalStep.classList.add("active");
      if (checkoutStep) checkoutStep.classList.remove("active");
    }
  }
});


// Start Tooltip JS For Swatches
// Detect if the device supports hover (i.e., desktop)
const canHover = window.matchMedia('(hover: hover)').matches;

if (canHover) {
  document.querySelectorAll('.evp-color-swatch-wrapper, .evp-grid-swatch, .evp-grid-swatches').forEach(target => {
    let tooltip;

    target.addEventListener('mouseenter', () => {
      let colorName = '';

      const button = target.querySelector('button');
      if (button) {
        colorName = button.getAttribute('data-color-name') || '';
      } else {
        colorName = target.getAttribute('data-tooltip') || '';
      }

      if (!colorName) return;

      tooltip = document.createElement('div');
      tooltip.className = 'custom-tooltip-swatches';
      tooltip.innerText = colorName;
      document.body.appendChild(tooltip);

      const rect = target.getBoundingClientRect();
      const tooltipRect = tooltip.getBoundingClientRect();
      const spaceOnRight = window.innerWidth - rect.right;
      const offset = 4;

      const top = rect.bottom + window.scrollY + offset;
      let left;

      if (spaceOnRight >= tooltipRect.width + offset) {
        left = rect.right + window.scrollX + offset;
      } else {
        left = rect.left - tooltipRect.width + window.scrollX - offset;
      }

      tooltip.style.top = `${top}px`;
      tooltip.style.left = `${left}px`;
    });

    target.addEventListener('mouseleave', () => {
      if (tooltip) {
        tooltip.remove();
        tooltip = null;
      }
    });
  });
}

// End  Tooltip JS For Swatches

// Start Accrediation JS
document.addEventListener("DOMContentLoaded", function () {
    const accreditationItems = document.querySelectorAll(".accreditation-item");

    accreditationItems.forEach(item => {
        item.addEventListener("click", function (e) {
            // Prevent click if clicked inside modal or close button
            if (e.target.closest('.accreditation-modal')) return;

            const modalSelector = item.getAttribute('data-modal-target');
            const modal = item.querySelector(modalSelector);
            if (modal) {
                modal.style.display = "block";
                document.body.classList.add("no-scroll");
            }
        });
    });

    const modals = document.querySelectorAll(".accreditation-modal");
    modals.forEach(modal => {
        const close = modal.querySelector(".close-modal");

        // Close button
        close.addEventListener("click", function (e) {
            e.stopPropagation(); // prevent bubbling to parent .accreditation-item
            modal.style.display = "none";
            document.body.classList.remove("no-scroll");
        });

        // Click outside modal content
        modal.addEventListener("click", function (e) {
            if (e.target === modal) {
                modal.style.display = "none";
                document.body.classList.remove("no-scroll");
            }
        });
    });
});
// End Accrediation Jss


document.addEventListener('DOMContentLoaded', function () {
    const swatches = document.querySelectorAll('.evp-grid-swatch');

    swatches.forEach(swatch => {
        swatch.addEventListener('mouseenter', function () {
            const imageURL = this.getAttribute('data-variation-image');
            if (!imageURL) return;

            const productCard = this.closest('.product');
            if (!productCard) return;

            const img = productCard.querySelector('img.wp-post-image');
            if (img) {
                img.setAttribute('data-original-src', img.src); // store original
                img.src = imageURL;
            }
        });

        swatch.addEventListener('mouseleave', function () {
            const productCard = this.closest('.product');
            if (!productCard) return;

            const img = productCard.querySelector('img.wp-post-image');
            if (img && img.hasAttribute('data-original-src')) {
                img.src = img.getAttribute('data-original-src');
                img.removeAttribute('data-original-src');
            }
        });
    });
});
