<?php 
$id = 'text-' . $block['id'];

// Layout
$layout = get_field('layout') ?? '';
$layout_class = strtolower(str_replace(' ', '-', $layout));

// Padding & Margin
$section_padding = get_field("section_padding") ?? [];
$padding_bottom = $section_padding["padding_bottom"] ?? '';
$padding_top = $section_padding["padding_top"] ?? '';

$section_margin = get_field("section_margin") ?? [];
$margin_bottom = $section_margin["margin_bottom"] ?? '';
$margin_top = $section_margin["margin_top"] ?? '';

// Other Fields
$background = get_field('background') ?? '';
$main_heading = get_field('main_heading') ?? '';
$grid_start = get_field('grid_start') ?? '';
$main_paragraph = get_field('main_paragraph') ?? '';
$heading_separator = get_field('heading_separator') ?? '';
$heading_separator_color = get_field('heading_separator_color') ?? '';
$subheading_separator = get_field('subheading_separator') ?? '';
$sub_heading_color = get_field('sub_heading_color') ?? '';
$sub_heading_alignment = get_field('sub_heading_alignment') ?? '';
$card_with_border = get_field('card_with_border') ?? '';
$card_text_alignment = get_field('card_text_alignment') ?? '';
$card_below_content = get_field('card_below_content') ?? '';
$card_below_content_color = get_field('card_below_content_color') ?? '';
$card_below_paragraph = get_field('card_below_paragraph') ?? '';
$card_image_required = get_field('card_image_required') ?? '';
$learn_more_button_required = get_field('learn_more_button_required') ?? '';
$learn_more_bg_color = get_field('learn_more_bg_color') ?? '';
$learn_more_text_color = get_field('learn_more_text_color') ?? '';
$card_number_required = get_field('card_number_required') ?? '';
$card_end_to_end_required = get_field('card_end_to_end_required') ?? '';
$required_counter = get_field('required_counter') ?? '';
$card_border_color = get_field('card_border_color') ?? '';
$card_block = get_field('card_block') ?? [];

// Button color layout
$button_color_layout = get_field('button_color_layout') ?? [];
$other_color_layout = get_field('other_color_layout') ?? [];

$default_background = $other_color_layout['default_background'] ?? '';
$default_text_color = $other_color_layout['default_text_color'] ?? '';
$hover_background = $other_color_layout['hover_background'] ?? '';
$hover_text_color = $other_color_layout['hover_text_color'] ?? '';


$normal_link_button = get_field('normal_link_button') ?? [];
$normal_btn_text_color = $normal_link_button['normal_btn_text_color'] ?? '';
?>

<div class="full-width" style="background:<?php echo $background; ?>;">
<div id="<?php echo $id; ?>" class="col-full card-section-main" style="padding-top:<?php echo $padding_top; ?>px;padding-bottom:<?php echo $padding_bottom; ?>px;margin-top:<?php echo $margin_top; ?>px;margin-bottom:<?php echo $margin_bottom; ?>px">

<?php if (!empty($main_heading)): ?>
            <div class="main-heading-box">
              <h2 class="card-layout-main-heading">
                <?php echo $main_heading; ?>
              </h2>
              <?php if ($heading_separator === 'yes'): ?>
              <div class="line-seperator" style="background:<?php echo $heading_separator_color; ?>"></div>
              <?php endif; ?>
            </div>
<?php endif; ?>

<?php if (!empty($main_paragraph)): ?>
            <div class="main-para-box">
              <div class="card-layout-main-para text-center">
                <?php echo $main_paragraph; ?>
              </div>
            </div>
<?php endif; ?>

<?php if ($card_block): ?>
  <div class="card-layout <?php echo $layout_class; ?>-layout" style="text-align:<?php echo $card_text_alignment; ?>;justify-content: <?php echo $grid_start; ?>">
<?php foreach ($card_block as $index => $card): 
  $card_image = $card['card_image'] ?? '';
  $sub_heading_separator_color = $card['sub_heading_separator_color'] ?? '';
  $card_sub_heading = $card['card_sub_heading'] ?? '';
  $card_paragraph = $card['card_paragraph'] ?? '';
  $learn_more_button = $card['learn_more_button'] ?? [];
  $cta_button_icon = $card['cta_button_icon'] ?? '';
  $card_number = str_pad($index + 1, 2, '0', STR_PAD_LEFT);

  $card_url = $learn_more_button['url'] ?? '';
  $card_title = $learn_more_button['title'] ?? '';

  $counter_group = $card['counter_group'] ?? [];
  $symbol_prefix = $counter_group['symbol_prefix'] ?? '';
  $counter_number = $counter_group['counter_number'] ?? '';
  $number_color = $counter_group['number_color'] ?? '';
  $symbol_suffix = $counter_group['symbol_suffix'] ?? '';
  $counter_heading = $counter_group['counter_heading'] ?? '';


  $card_classes = trim(
    'card-layout-column ' .
    (($card_with_border === 'yes') ? 'border-card-layout ' : '') .
    (($card_end_to_end_required === 'yes') ? 'card-end-to-end' : '')
  );

  $card_styles = ($card_with_border === 'yes') ? 'border: 1px solid ' . ($card_border_color ?? '') . ';' : '';
?>


    <?php if (!empty($card_url)): ?>
      <a href="<?php echo $card_url; ?>" target="_blank" class="<?php echo $card_classes; ?>" style="display: block; text-decoration: none; color: inherit; <?php echo $card_styles; ?>">
    <?php else: ?>
      <div class="<?php echo $card_classes; ?>" style="<?php echo $card_styles; ?>">
    <?php endif; ?>
    <?php if (!empty($counter_number)): ?>
          <div class="counter-box">
      <div class="dynamic-number" style="color:<?php echo $number_color; ?>" data-target="<?php echo $counter_number; ?>" data-prefix="<?php echo $symbol_prefix; ?>" data-suffix="<?php echo $symbol_suffix; ?>"><?php echo $symbol_prefix; ?> <?php echo $counter_number; ?><?php echo $symbol_suffix; ?></div>
      <?php if (!empty($counter_heading)): ?><div class="label"><?php echo $counter_heading; ?></div><?php endif; ?>
    </div>
    <?php endif; ?>
        <?php if (!empty($card_image['url'])): ?>
          <div class="card-image-box">
            <img src="<?php echo $card_image['url']; ?>" alt="<?php echo $card_sub_heading; ?>">
          </div>
        <?php endif; ?>

        <?php if (!empty($card_sub_heading)): ?>
          <div class="card-subheading-box" style="text-align:<?php echo $sub_heading_alignment; ?>;">
            <h3 class="<?php echo $sub_heading_alignment; ?> card-layout-subheading <?php echo ($card_number_required === 'yes') ? 'card-number' : ''; ?>" style="color:<?php echo $sub_heading_color; ?>;" data-card-number="<?php echo $card_number; ?>">
              <?php echo $card_sub_heading; ?>
            </h3>
            <?php if ($subheading_separator === 'yes'): ?>
              <div class="<?php echo $sub_heading_alignment; ?> line-seperator" style="background: <?php echo $sub_heading_separator_color; ?>"></div>
            <?php endif; ?>
          </div>
        <?php endif; ?>

        <?php if (!empty($card_paragraph)): ?>
          <div class="card-paragraph-box">
            <p><?php echo $card_paragraph; ?></p>
          </div>
        <?php endif; ?>

        <!-- <?php if (!empty($card_url) && !empty($card_title)): ?>
          <div class="card-link-button-box <?php echo $card_text_alignment; ?>" style="text-align:<?php echo $card_text_alignment; ?>">
            <span class="learn-more-btn rounded-btn-css <?php echo $button_color_layout; ?>-btn-custom">
              <?php if (!empty($cta_button_icon)): ?><span class="cta-btn-icon"><?php echo $cta_button_icon; ?></span><?php endif; ?>
              <span><?php echo $card_title; ?></span>
            </span>
          </div>
        <?php endif; ?> -->
<?php if (!empty($card_url) && !empty($card_title)): ?>
  <div class="card-link-button-box <?php echo $card_text_alignment; ?>" style="text-align:<?php echo $card_text_alignment; ?>">
    <span
      class="learn-more-btn rounded-btn-css <?php echo $button_color_layout; ?>-btn-custom"
      <?php if ($button_color_layout === 'normal-link'): ?>
        style="background:transparent; color:<?php echo $normal_btn_text_color; ?>; text-decoration: underline !important;"
      <?php elseif ($button_color_layout === 'other'): ?>
        style="background:<?php echo $default_background; ?>; color:<?php echo $default_text_color; ?>;"
        onmouseover="this.style.background='<?php echo $hover_background; ?>'; this.style.color='<?php echo $hover_text_color; ?>';"
        onmouseout="this.style.background='<?php echo $default_background; ?>'; this.style.color='<?php echo $default_text_color; ?>';"
      <?php endif; ?>
    >
      <?php if (!empty($cta_button_icon)): ?><span class="cta-btn-icon"><?php echo $cta_button_icon; ?></span><?php endif; ?>
      <span><?php echo $card_title; ?></span>
    </span>
  </div>
<?php endif; ?>



    <?php if (!empty($card_url)): ?>
      </a>
    <?php else: ?>
      </div>
    <?php endif; ?>

    <?php endforeach; ?>
  </div>
<?php endif; ?>


<?php if (!empty($card_below_paragraph)): ?>
    <div class="card-below-content-box text-center" style="color:<?php echo $card_below_content_color; ?>;">
      <?php echo $card_below_paragraph; ?>
    </div>
<?php endif; ?>
</div>
</div>

<style>
  .card-section-main{
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

.card-section-main {
  .main-heading-box {
    text-align: center;
  }

  .main-para-box {
    margin-top: 30px;
    margin-bottom:30px;
  }

  .card-layout {
    display: flex;
    flex-wrap:wrap;
    gap: 20px;
    row-gap:20px;
    margin-top: 20px;

    .card-layout-column {
      display: flex;
      flex-direction: column;
      width: calc((100% - 60px) / 3);
      /* background:var(--bg-color); */
      .counter-box{
        .dynamic-number{
          font-size: 70px;
        }
          .label{
            font-size: 18px;
          }
      }
      .card-image-box{
        img{
          width:100%;
        }
      }
      .card-subheading-box {
        position: relative;

        h3 {
          font-size: 24px;
          margin-bottom: 0;
          line-height:1.3;
          margin-top:15px;
          &.card-number{
            margin-top:30px;
          }
        }

        .card-layout-subheading.card-number::before {
          content: attr(data-card-number);
          position: absolute;
          font-weight: 500;
          font-size: 56px;
          margin-top: -42px;
          z-index: 1;
          color: rgba(0, 0, 0, 0.1);
        }

        & .left.card-layout-subheading.card-number::before {
          left: 0;
        }

        & .center.card-layout-subheading.card-number::before {
          left: 50%;
          transform: translateX(-50%);
        }

        & .right.card-layout-subheading.card-number::before {
          right: 0;
        }
      }

      .card-paragraph-box {
        margin-top: 00px;
        p {
          margin-bottom: 0;
        }
      }
    }

    .card-layout-column.border-card-layout {
      padding: 15px;
      box-sizing:border-box;
      border-radius: 8px;
      border: 1px solid var(--card-border-color);
    }
    .card-end-to-end{
      padding:0 0 15px!important;
      border-radius:0!important;
      .card-subheading-box,.card-paragraph-box,.card-link-button-box{
        padding:15px 15px 0;
      }
    }

    &.two-column-layout .card-layout-column {
      width: calc((100% - 20px) / 2);
    }

    &.three-column-layout .card-layout-column {
      width: calc((100% - 40px) / 3);
    }

    &.four-column-layout .card-layout-column {
      width: calc((100% - 60px) / 4);
    }

    &.five-column-layout .card-layout-column {
      width: calc((100% - 80px) / 5);
    }

    .card-subheading-box .line-seperator {
      width: 50px;
      margin-top: 8px;
    }

    .card-link-button-box {
      &.left>span{
        margin-left:0;
      }
      &.right>span{
        margin-right:0;
      }
      &.center>span{
        margin:auto;
      }
      margin-top: 30px;
      margin-bottom: 8px;

      .learn-more-btn{
        .cta-btn-icon {
          margin-right: 5px;
        }
      }
    }
  }

  .card-below-content-box {
    text-align: center;
    margin-top:45px;
  }

  .line-seperator {
    width: 125px;
    height: 5px;
    display: block;
    margin: 0px auto 0;
  }

  .left.line-seperator {
    margin-left: 0;
  }

  .right.line-seperator {
    margin-right: 0;
  }
}

@media (min-width: 1200px) {
  .card-section-main .main-para-box .card-layout-main-para, .card-below-content-box {
    width: 70%;
    margin-left: auto;
    margin-right: auto;
  }
}

@media (min-width: 768px) and (max-width: 1199px) {
  .card-layout {
    flex-wrap: wrap;
    gap: 20px!important;
    row-gap: 20px!important;
  }

  .card-layout-column {
    width: calc((100% - 20px) / 2) !important;
  }
}

@media (max-width: 767px) {
  .card-section-main {
    .main-heading-box h2 {
      font-size: 34px;
    }

    .card-layout {
      flex-direction: column;
      gap: 20px !important;
      row-gap: 20px !important;

      h3 {
        font-size: 24px;
      }
    }

    .card-layout-column {
      width: 100% !important;
    }
  }
}

</style>
<script>
document.addEventListener("DOMContentLoaded", () => {
  const counters = document.querySelectorAll('.dynamic-number');

  counters.forEach(counter => {
    const prefix = counter.getAttribute('data-prefix') || '';
    const suffix = counter.getAttribute('data-suffix') || '';
    const target = +counter.getAttribute('data-target');

    if (!isNaN(target)) {
      let count = 0;
      let increment = 1;

      // Speed logic: smaller target = faster update
      if (target <= 100) {
        increment = 1;
      } else if (target <= 500) {
        increment = 5;
      } else if (target <= 1000) {
        increment = 10;
      } else {
        increment = Math.ceil(target / 100); // Adaptive for large numbers
      }

      const updateCount = () => {
        count += increment;
        if (count < target) {
          counter.innerText = `${prefix}${count}${suffix}`;
          setTimeout(updateCount, 20);
        } else {
          counter.innerText = `${prefix}${target}${suffix}`;
        }
      };

      updateCount();
    }
  });
});
</script>

