<?php 
$id = 'text-' . $block['id'];
$layout = get_field('layout') ?: '';
$layout_class = strtolower(str_replace(' ', '-', $layout));

$section_padding = get_field("section_padding") ?: [];
$padding_top = $section_padding["padding_top"] ?? '';
$padding_bottom = $section_padding["padding_bottom"] ?? '';

$section_margin = get_field("section_margin") ?: [];
$margin_top = $section_margin["margin_top"] ?? '';
$margin_bottom = $section_margin["margin_bottom"] ?? '';

$background = get_field('background') ?: '';
$main_heading = get_field('heading') ?: '';
$paragraph = get_field('paragraph') ?: '';
$heading_separator = get_field('heading_separator') ?: '';
$separator_color = get_field('separator_color') ?: '';

$view_all_button = get_field('view_all_button') ?: '';
$view_all_background_color = get_field('view_all_background_color') ?: '';
$view_all_text_color = get_field('view_all_text_color') ?: '';

$image_card_block = get_field('image_card_block') ?: [];

$button_color_layout = get_field('button_color_layout') ?: '';
$other_color_layout = get_field('other_color_layout') ?: [];
$default_background = $other_color_layout['default_background'] ?? '';
$default_text_color = $other_color_layout['default_text_color'] ?? '';
$hover_background = $other_color_layout['hover_background'] ?? '';
$hover_text_color = $other_color_layout['hover_text_color'] ?? '';
?>


<div class="full-width" style="background:<?php echo $background; ?>;">
    <div id="<?php echo $id; ?>" class="col-full image-card-link-section-main" style="padding-top:<?php echo $padding_top; ?>px;padding-bottom:<?php echo $padding_bottom; ?>px;margin-top:<?php echo $margin_top; ?>px;margin-bottom:<?php echo $margin_bottom; ?>px">
        
        <?php if (!empty($main_heading)): ?>
            <div class="main-heading-box">
                <h2 class="image-card-link-layout-main-heading">
                    <?php echo $main_heading; ?>
                </h2>
                <?php if ($heading_separator === 'yes'): ?>
                    <div class="line-seperator" style="background:<?php echo $separator_color; ?>"></div> 
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($paragraph)): ?>
            <div class="main-para-box">
                <div class="image-card-link-layout-main-para text-center">
                    <?php echo $paragraph; ?>
                </div>
            </div>
        <?php endif; ?>

        <?php if ($image_card_block): ?>
    <div class="image-card-link-layout <?php echo $layout_class; ?>-layout">
        <?php foreach ($image_card_block as $index => $card): 
            $image = $card['image'] ?? '';;
            $link = $card['link'] ?? '';;
        ?>
            <div class="image-card-link-layout-column">
                <?php if (!empty($image['url'])): ?>
                    <div class="card-image-box">
                        <?php if (!empty($link['url'])): ?>
                            <a href="<?php echo $link['url']; ?>">
                                <img src="<?php echo $image['url']; ?>" alt="">
                            </a>
                        <?php else: ?>
                            <img src="<?php echo $image['url']; ?>" alt="">
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <?php if (!empty($link['url']) && !empty($link['title'])): ?>
                    <div class="image-card-link-link-box">
                        <a class="card-link-btn" href="<?php echo $link['url']; ?>">
                            <span><?php echo $link['title']; ?></span>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
<?php endif; ?>


        <?php if (!empty($view_all_button['url']) && !empty($view_all_button['title'])): ?>
            <div class="view-all-link-box">
                <a class="view-all-link-btn rounded-btn-css <?php echo $button_color_layout; ?>-btn-custom"  href="<?php echo $view_all_button['url']; ?>">
                    <?php echo $view_all_button['title']; ?>
                </a>
            </div>
        <?php endif; ?>
    </div>
</div>


<style>
  .image-card-link-section-main{
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

.text-center {
  text-align: center;
}

.image-card-link-section-main {
  .main-heading-box {
    text-align: center;

    .line-seperator {
      width: 125px;
      height: 5px;
      display: block;
      margin: 0px auto 0;
    }
  }

  .main-para-box {
    margin-bottom: 30px;
    .image-card-link-layout-main-para {
      p {
        margin-bottom: 15px;
      }
    }
  }

  .image-card-link-layout {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
    row-gap: 20px;
    margin-bottom: 0px;

    .image-card-link-layout-column {
      display: flex;
      flex-direction: column;
      width: calc((100% - 60px) / 3);

      .card-image-box {
        background:var(--white-color);
        img {
          max-width: 100%;
          border-radius: 0;
          mix-blend-mode: multiply;
          padding
        }
      }
    }

    &.two-column-layout .image-card-link-layout-column {
      width: calc((100% - 20px) / 2);
    }

    &.three-column-layout .image-card-link-layout-column {
      width: calc((100% - 40px) / 3);
    }

    &.four-column-layout .image-card-link-layout-column {
      width: calc((100% - 60px) / 4);
    }

    &.five-column-layout .image-card-link-layout-column {
      width: calc((100% - 80px) / 5);
    }

    &.six-column-layout .image-card-link-layout-column {
      width: calc((100% - 100px) / 6);
    }

    .card-subheading-box .line-seperator {
      width: 45px;
    }

    .image-card-link-link-box {

      .card-link-btn,
      .card-link-btn:hover {
        color: var(--white-color);
        background:var(--primary-color);
        text-decoration: none;
        outline: none;
        padding: 10px;
        font-size: 16px;
        width: 100%;
        display: block;
        box-sizing:border-box;
        position: relative;
        border-top: 1px solid #fff;
        @media(max-width:767px){
          font-size:15px;
        }
      }

      .card-link-btn::after {
        content: "\f054";
        /* FontAwesome Unicode */
        font-family: "Font Awesome 6 Free";
        font-weight: 900;
        margin-left: 10px;
        font-size: 12px;
        display: inline-block;
        @media(max-width:767px){
          margin-left: 5px;
        }
      }
    }
  }

  .view-all-link-box {
    .view-all-link-btn {
      margin-top: 40px;
    }
  }
}

@media (min-width: 1200px) {

  .image-card-link-section-main .main-para-box .image-card-link-layout-main-para,
  .card-below-content-box {
    width: 70%;
    margin-left: auto;
    margin-right: auto;
  }

}

@media (min-width: 0px) and (max-width: 1199px) {
  .image-card-link-layout {
    flex-wrap: wrap;
    gap: 20px !important;
    row-gap: 20px !important;
  }

  .image-card-link-layout-column {
    width: calc((100% - 20px) / 2) !important;
  }
}

@media (max-width: 767px) {
  .image-card-link-section-main {
    .main-heading-box h2 {
      font-size: 34px;
    }

    .image-card-link-layout {
      h3 {
        font-size: 24px;
      }
    }
/* 
    .image-card-link-layout-column {
      width: 100% !important;
    } */
  }
}

</style>