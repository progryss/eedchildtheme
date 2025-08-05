<?php 
$id = 'text-' . $block['id'];
 $extra_class = isset($GLOBALS['has_banner_block']) && $GLOBALS['has_banner_block'] ? ' banner-mt' : ''; 
$section_padding = get_field("section_padding") ?: [];
$padding_top = $section_padding["padding_top"] ?? '';
$padding_bottom = $section_padding["padding_bottom"] ?? '';

$section_margin = get_field("section_margin") ?: [];
$margin_top = $section_margin["margin_top"] ?? '';
$margin_bottom = $section_margin["margin_bottom"] ?? '';

$background = get_field('background') ?: '';
$layout_full_width = get_field("layout_full_width") ?: '';
$choose_banner_type = get_field('choose_banner_type') ?: '';
$banner_block = get_field('banner_block') ?: '';

$custom_wrapper_class = $layout_full_width ? 'full-width' : 'col-full';

$button_color_layout = get_field('button_color_layout') ?: '';
$other_color_layout = get_field('other_color_layout') ?: [];
$default_background = $other_color_layout['default_background'] ?? '';
$default_text_color = $other_color_layout['default_text_color'] ?? '';
$hover_background = $other_color_layout['hover_background'] ?? '';
$hover_text_color = $other_color_layout['hover_text_color'] ?? '';
?>
<div class="full-width banner-section-full <?php echo $extra_class; ?>" style="padding-top:<?php echo $padding_top; ?>px;padding-bottom:<?php echo $padding_bottom; ?>px;margin-top:<?php echo $margin_top; ?>px;margin-bottom:<?php echo $margin_bottom; ?>px">
<div class="banner-col <?php echo $custom_wrapper_class; ?>" style="background:<?php echo $background; ?>;">
<div id="<?php echo $id; ?>" class="banner-section-main">
  <?php if ($banner_block): ?>
    <?php foreach ($banner_block as $card): ?>
<?php
$mobile_image = $card["mobile_image"] ?? '';
$desktop_image = $card["desktop_image"] ?? '';
$overlay_color = $card["overlay_color"] ?? '';
$content_alignment = $card["content_alignment"] ?? '';
$text_color = $card["text_color"] ?? '';
$background_color = $card["background_color"] ?? '';
$heading = $card["heading"] ?? '';
$sub_heading = $card["sub_heading"] ?? '';
$paragraph = $card["paragraph"] ?? '';
$button = $card["button"] ?? '';
$button_background_color = $card["button_background_color"] ?? '';
$button_text_color = $card["button_text_color"] ?? '';
?>

      <div class="banner-section">
      <img class="mobile-visible" src="<?php echo $mobile_image['url']; ?>" alt="" />
        <img class="desktop-visible" src="<?php echo $desktop_image['url']; ?>" alt="" />
        <div class="banner-over-text <?php echo $content_alignment; ?>" style="   background: <?php echo $overlay_color; ?>65;">
          <?php if ($choose_banner_type === 'slider' && !empty($heading)): ?>
            <div class="slider-text-box" style="background: <?php echo $background_color; ?>;">
              <h1 class="slider-heading"><?php echo $heading; ?></h1>
            </div>
          <?php endif; ?>

          <?php if ($choose_banner_type === 'single'): ?>
            <?php if (!empty($heading)): ?>
              <h1 class="single-heading" style="color: <?php echo $text_color; ?>;"><?php echo $heading; ?></h1>
            <?php endif; ?>
            <?php if (!empty($sub_heading)): ?>
              <h2 class="single-subheading" style="color: <?php echo $text_color; ?>;"><?php echo $sub_heading; ?></h2>
            <?php endif; ?>
            <?php if (!empty($paragraph)): ?>
              <p style="color: <?php echo $text_color; ?>;"><?php echo $paragraph; ?></p>
            <?php endif; ?>
            <?php if (!empty($button['url']) && !empty($button['title'])): ?>
            <div class="banner-btn-box">
                <a class="banner-btn rounded-btn-css <?php echo $button_color_layout; ?>-btn-custom" href="<?php echo $button['url']; ?>">
                    <?php echo $button['title']; ?>
                </a>
            </div>
        <?php endif; ?>
          <?php endif; ?>
        </div>
      </div>
    <?php endforeach; ?>
  <?php endif; ?>
</div>
<?php
// Show WooCommerce breadcrumb here (below banner)
if ( function_exists( 'woocommerce_breadcrumb' ) ) {
    echo '<div class="custom-banner-breadcrumb">';
    woocommerce_breadcrumb();
    echo '</div>';
}
?>
</div>
</div>


<style>
   .banner-col {
  padding-inline: 0;
@media(min-width:768px){
margin-top:-59.3012px;
}
@media(max-width:767px){
margin-top:-25.888px;
}
  @media (max-width: 767px) {
    width: 100vw;
    position: relative;
    left: 50%;
    right: 50%;
    margin-left: -50vw;
    margin-right: -50vw;

    .banner-over-text {
      width: 100%;
    }
  }
  .banner-section-main{
    .other-btn-custom {
      background: <?php echo $default_background ?>;
    color: <?php echo $default_text_color ?>; 

}
@media(min-width:768px){
  .other-btn-custom:hover {
  background:<?php echo  $hover_background ?>;
    color:<?php echo  $hover_text_color ?>;
}
}
}
    p:empty {
    display: none!important;
  }
  img {
    width: 100%;
    height: auto;
  }
  .banner-section {
  position: relative;
  overflow: hidden;

  .slider-heading {
    margin-bottom: 0;
    width:max-content!important;
  }

  .single-heading {
    font-size: 30px;
  }

  h2 {
    font-size: 24px;
  }

  p {
    font-size: 18px;

  }

  h1, h2, p {
    color: <?php echo $text_color; ?>;
    line-height: 1.3;
  }
  h1, h2, p {
    margin-bottom: 0px;
  }
  h1, h2{
    margin-bottom: 10px;
  }
  .banner-btn-box{
    margin-top:10px;
  }

  .banner-over-text {
    position: absolute;
    inset: 0;
    display: flex;
    gap:15px;
    flex-direction: column;

    &.center {
      justify-content: center;
      align-items: center;
      text-align: center;
      padding: 20px;
    }
    &.left-center {
      justify-content: center;
      align-items: start;
      text-align: left;
      padding: 20px;
      p{
        margin-left:0;
      }
    }
    &.left-bottom {
      justify-content: end;
      align-items: baseline;
      padding: 20px;

      .slider-text-box {
        position: relative;
        bottom: -20px;
      }
    }
    .slider-text-box {
        font-size: 10px;
        padding: 25px 50px 25px 40px;
      }
  }
} 

  .banner-section-main {
  .slick-next {
    right: 0 !important;
  }

  .slick-prev {
    left: initial !important;
    z-index: 1;
    right: 60px;
  }

  .slick-prev, .slick-next, .slick-prev:focus, .slick-next:focus {
    top: initial !important;
    bottom: -30px !important;
    width: 60px;
    height: 60px;
    background: #81898d;
  }

  .slick-prev:hover, .slick-next:hover {
    background: #ced3d5;
  }

  .slick-prev:hover:before, .slick-next:hover:before {
    color: #81898d;
  }

  .slick-prev:before, .slick-next:before {
    font-family: 'Font Awesome 6 Free';
    font-weight: 900;
    font-size: 25px;
    color: #ced3d5;
  }

  .slick-prev:before {
    content: '\f104'; // Left Arrow Icon
  }

  .slick-next:before {
    content: '\f105'; // Right Arrow Icon
  }
}

@media(min-width:768px){
  .banner-over-text.left-center,.banner-over-text.left-bottom{
      p,h1,.banner-btn-box{
        width:70%;
        a{
          margin-left:0;
        }
      }
    }
    .banner-over-text.center{
      p,h1,.banner-btn-box{
      width:70%
    }
  }
    .mobile-visible{
        display:none!important;
}
.full-width .banner-over-text{
  padding-left: calc((100% - 75em) / 2)!important;
  padding-right: calc((100% - 75em) / 2)!important;
}
}
@media(min-width:1200px){
  .col-full .banner-over-text{
    padding:20px 60px!important;
  }
  .banner-section {
    p {
      width:80%;
      margin-left:auto;
      margin-right:auto;
    }
    .banner-over-text.left-center,.banner-over-text.left-bottom{
      p,h1,.banner-btn-box{
        width:40%;
        margin-left:0;
        a{
          margin-left:0;
        }
      }
    }
}
}
@media(max-width:767px){
    .slider-text-box {
    font-size: 7px!important;
    padding: 20px 30px 20px 25px!important;
    /* left:-20px */
}
.desktop-visible{
display:none!important;
}
.banner-over-text{
  align-items: center!important;
  justify-content: center!important;
  h1.single-heading{
font-size:24px
  }
  h2.single-subheading{
    font-size:20px
  }
  p{
    font-size:16px;
    text-align:center;
  }
}
}
}
@media(min-width:768px){
	.custom-home-page .banner-col{
margin-top: 1px !important;
}
}
@media(max-width:768px){
	.custom-home-page .banner-col{
margin-top: 1px !important;
}
}
</style>



<script>
jQuery(document).ready(function($) {
    $('.banner-section-main').slick({
      autoplay: true,
      autoplaySpeed: 300000000,
      arrows: true,
      dots: false,
      slidesToShow: 1,
      slidesToScroll: 1,
      responsive: [
        {
          breakpoint: 768,
          settings: {
            arrows: false
          }
        }
      ]
    });
  });
</script>