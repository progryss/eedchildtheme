<?php 
$id = 'text-' . $block['id'];

$section_padding = get_field("section_padding") ?? [];
$padding_bottom = $section_padding["padding_bottom"] ?? '';
$padding_top = $section_padding["padding_top"] ?? '';

$section_margin = get_field("section_margin") ?? [];
$margin_bottom = $section_margin["margin_bottom"] ?? '';
$margin_top = $section_margin["margin_top"] ?? '';

$background = get_field('background') ?? '';
$heading = get_field('heading') ?? '';
$grid_start = get_field('grid_start') ?? '';
$heading_separator = get_field('heading_separator') ?? '';
$separator_color = get_field('separator_color') ?? '';

$logo_required = get_field('logo_required') ?? '';
$logo = get_field('logo') ?? '';
$logo_alignment = get_field('logo_alignment') ?? '';
$asset_above_content_layout = get_field('asset_above_content_layout') ?? '';
$asset_above_content = get_field('asset_above_content') ?? '';

$two_column_layout_group = get_field('two_column_layout_group') ?? [];
$asset_above_left_content = $two_column_layout_group["asset_above_left_content"] ?? '';
$asset_above_right_content = $two_column_layout_group["asset_above_right_content"] ?? '';

$asset_type = get_field('asset_type') ?? '';
$asset_layout = get_field('asset_layout') ?? '';
$video_url = get_field('video_url') ?? '';
$asset_below_content = get_field('asset_below_content') ?? '';

$asset_repeater = get_field('asset_repeater') ?? [];
?>


<div class="full-width" style="background:<?php echo $background; ?>;">
  <div id="<?php echo $id; ?>" class="col-full content-section-main" style="padding-top:<?php echo $padding_top; ?>px; padding-bottom:<?php echo $padding_bottom; ?>px; margin-top:<?php echo $margin_top; ?>px; margin-bottom:<?php echo $margin_bottom; ?>px;">

    <?php if (!empty($heading)): ?>
      <div class="main-heading-box">
        <h2 class="card-layout-main-heading">
          <?php echo $heading; ?>
        </h2>
        <?php if ($heading_separator === 'yes' && !empty($separator_color)): ?>
          <div class="line-separator" style="background:<?php echo $separator_color; ?>;"></div>
        <?php endif; ?>
      </div>
    <?php endif; ?>

    <?php if (!empty($logo) && $logo_required): ?>
      <div class="logo-box <?php echo $logo_alignment; ?>">
        <img src="<?php echo $logo['url']; ?>" alt="Logo">
      </div>
    <?php endif; ?>

    <?php if (!empty($asset_above_content)): ?>
      <div class="asset-above-content"><?php echo $asset_above_content; ?></div>
    <?php endif; ?>

    <?php if (!empty($asset_above_left_content) || !empty($asset_above_right_content)): ?>
      <div class="asset-above-layout-flex">
        <?php if (!empty($asset_above_left_content)): ?>
          <div class="asset-above-left-content"><?php echo $asset_above_left_content; ?></div>
        <?php endif; ?>
        <?php if (!empty($asset_above_right_content)): ?>
          <div class="asset-above-right-content"><?php echo $asset_above_right_content; ?></div>
        <?php endif; ?>
      </div>
    <?php endif; ?>

    <!-- <?php if (!empty($asset_repeater)): ?>
      <div class="asset-box asset-<?php echo $asset_layout; ?>" style="justify-content: <?php echo $grid_start; ?>">
        <?php foreach ($asset_repeater as $card): 
          if (!empty($card['image'])): ?>
            <div class="asset-layout-column">
              <img src="<?php echo $card['image']['url']; ?>" alt="Asset Image">
            </div>
          <?php endif; ?>
        <?php endforeach; ?>
      </div>
    <?php endif; ?> -->
    <?php
$has_image = false;
if (!empty($asset_repeater)) {
  foreach ($asset_repeater as $card) {
    if (!empty($card['image'])) {
      $has_image = true;
      break;
    }
  }
}
?>

<?php if ($has_image): ?>
  <div class="asset-box asset-<?php echo $asset_layout; ?>" style="justify-content: <?php echo $grid_start; ?>">
    <?php foreach ($asset_repeater as $card): ?>
      <?php if (!empty($card['image'])): ?>
        <div class="asset-layout-column">
          <img src="<?php echo $card['image']['url']; ?>" alt="Asset Image">
        </div>
      <?php endif; ?>
    <?php endforeach; ?>
  </div>
<?php endif; ?>


    <?php if (!empty($video_url)): ?>
      <div class="video-box">
        <iframe src="<?php echo $video_url; ?>" allowfullscreen></iframe>
      </div>
    <?php endif; ?>

    <?php if (!empty($asset_below_content)): ?>
      <div class="asset-below-content"><?php echo $asset_below_content; ?></div>
    <?php endif; ?>

  </div>
</div>

<style>
  .text-center {
  text-align: center;
}

.content-section-main {
.main-heading-box {
  text-align: center;
  .line-separator {
    width: 125px;
    height: 5px;
    display: block;
    margin: 0 auto;
  }
}
.asset-above-content{
  @media(min-width:1200px){
    max-width:70%;
    margin-inline:auto;           
  }
}
.asset-below-content{
  margin-top:30px;
}
.logo-box {
  margin:0 auto 30px;
  display: flex;
  justify-content: center;
  max-width:350px;

  img {
    max-width: 100%;
    height: auto;
  }

  &.left {
    justify-content: flex-start;
  }

  &.right {
    justify-content: flex-end;
  }
}

.asset-above-layout-flex {
  display: grid;
  grid-template-columns: repeat(2, 1fr);
  gap: 30px;
}

.asset-box {
  display: flex;
  flex-wrap: wrap;
  gap: 20px;
  justify-content: center;
  margin-top:30px;
  .asset-layout-column {
    img {
      margin: auto;
      display: block;
      max-width: 100%;
      height: auto;
    }
  }

  &.asset-one-column-layout .asset-layout-column {
    width: 100%;
  }

  &.asset-two-column-layout .asset-layout-column {
    width: calc((100% - 20px) / 2);
  }

  &.asset-three-column-layout .asset-layout-column {
    width: calc((100% - 40px) / 3);
  }

  &.asset-four-column-layout .asset-layout-column {
    width: calc((100% - 60px) / 4);
  }
}

.video-box {
  width: 90%;
    aspect-ratio: 1 / 0.5;
  margin:50px auto 0;

  iframe {
    width: 100%;
    height: 100%;
    border: none;
  }
}
}

@media (min-width: 768px) and (max-width: 1199px) {
  .asset-layout-column {
    width: calc((100% - 20px) / 2) !important;
  }
}
@media(max-width:1024px){
  .video-box {
    width: 100% !important;
  aspect-ratio: 1 / 0.5 !important;
  height: auto !important;
}
}
@media (max-width: 767px) {
  .content-section-main {
  .asset-above-layout-flex{
    grid-template-columns:1fr!important;
    gap:15px;
  }

  .asset-layout-column {
    width: 100%!important;
  }

  .main-heading-box h2 {
    font-size: 32px;
  }

  .logo-box {
    justify-content: center;
  }
}
}
</style>