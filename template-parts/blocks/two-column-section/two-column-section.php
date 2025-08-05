<?php 
$id = 'text-' . ($block['id'] ?? '');

$section_padding = get_field("section_padding") ?? [];
$padding_bottom = $section_padding["padding_bottom"] ?? '';
$padding_top = $section_padding["padding_top"] ?? '';

$layout_full_width = get_field("layout_full_width") ?: '';
$custom_wrapper_class = $layout_full_width ? 'full-width design-end-to-end' : 'col-full';

$section_margin = get_field("section_margin") ?? [];
$margin_bottom = $section_margin["margin_bottom"] ?? '';
$margin_top = $section_margin["margin_top"] ?? '';

$grid_column_width = get_field("grid_column_width") ?? [];
$image_column_width = $grid_column_width["image_column_width"] ?? '';
$content_column_width = $grid_column_width["content_column_width"] ?? '';

$background = get_field('background') ?? '';
$reverse_image = get_field('reverse_image') ?? '';
$image = get_field('image') ?? '';
$grid_verticle_alignement = get_field('grid_verticle_alignement') ?? '';

$content_group_two_column = get_field("content_group_two_column") ?? [];
$description = $content_group_two_column["description"] ?? '';
$heading_separator = $content_group_two_column["heading_separator"] ?? '';
$heading = $content_group_two_column["heading"] ?? '';
$heading_alignment = $content_group_two_column["heading_alignment"] ?? '';
$separator_color = $content_group_two_column["separator_color"] ?? '';

$reverse_class = $reverse_image ? 'reverse' : '';
?>


<div class="full-width" style="background:<?php echo $background; ?>;">
  <div id="<?php echo $id; ?>" class="<?php echo $custom_wrapper_class; ?> two-column-section-main <?php echo $reverse_class; ?>" style="padding-top:<?php echo $padding_top; ?>px;padding-bottom:<?php echo $padding_bottom; ?>px;margin-top:<?php echo $margin_top; ?>px;margin-bottom:<?php echo $margin_bottom; ?>px">

  <div class="two-column-grid" style="grid-template-columns: <?php echo $image_column_width; ?>fr <?php echo $content_column_width; ?>fr;align-items: <?php echo $grid_verticle_alignement; ?>;">
    <div class="two-column-img-box">
      <img src="<?php echo $image['url']; ?>" alt="" />
    </div>
    <div class="two-column-contentbox">
          <?php if (!empty($heading)): ?>
      <div class="main-heading-box <?php echo $heading_alignment; ?>">
        <h2 class="card-layout-main-heading">
          <?php echo $heading; ?>
        </h2>
        <?php if ($heading_separator === 'yes'): ?>
          <div class="line-seperator" style="background:<?php echo $separator_color; ?>"></div>
        <?php endif; ?>
      </div>
    <?php endif; ?>
      <?php echo $description; ?>
    </div>
  </div>

  </div>
</div>

<style>
.text-center {
  text-align: center;
}

.two-column-section-main {
  &.reverse {
    .two-column-contentbox {
      order: -1;
    }
  }

  &.design-end-to-end {
    &.reverse {
      .two-column-contentbox {
        @media (min-width: 1280px) {
          padding-left: calc(-37.5em + 50vw) !important;
        }
      }
    }

    .two-column-grid {
      gap: 0;

      .two-column-img-box {
        height: 100%;
        position: relative;

        img {
          width: 100%;
          height: 100%;
          object-fit: cover;
        }
      }

      .two-column-contentbox {
        padding-block: 30px;

        @media (min-width: 1280px) {
          padding-left: calc(-41.5em + 50vw);
          padding-right: 10%;
        }

        @media (min-width: 1024px) and (max-width: 1279px) {
          padding-left: calc((100vw - 58.4989378333em) / 2);
          padding-right: 10%;
        }

        @media (max-width: 1023px) {
          padding-inline: 1.75em;
        }

        @media (max-width: 767px) {
          padding-inline: 1.75em;
        }
      }
    }
  }

  .two-column-grid {
    display: grid;
    gap: 30px;

    .two-column-img-box {
      img {
        margin: auto;
      }
    }

    .two-column-contentbox {
      .main-heading-box {
        margin-bottom: 15px;

        &.start {
          text-align: start;

          .line-seperator {
            margin-inline: 0 auto !important;
          }
        }

        &.center {
          text-align: center;

          .line-seperator {
            margin-inline: auto !important;
          }
        }

        &.end {
          text-align: end;

          .line-seperator {
            margin-inline: auto 0 !important;
          }
        }

        h2 {
          margin-bottom: 0;
        }

        .line-seperator {
          width: 125px;
          height: 5px;
          display: block;
          margin: 10px auto 0;
        }
      }
    }
  }
}

@media (max-width: 767px) {
  .two-column-section-main {
    &.reverse {
      .two-column-grid {
        .two-column-img-box {
          order: -1;
        }
      }
    }

    .two-column-grid {
      grid-template-columns: 1fr !important;
    }
  }
}

</style>
