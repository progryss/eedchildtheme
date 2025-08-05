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

$logo_before_text = get_field('logo_before_text') ?? '';
$logo = get_field('logo') ?? '';
$logo_after_text = get_field('logo_after_text') ?? '';
$description = get_field('description') ?? '';
$description_below_button_required = get_field('description_below_button_required') ?? '';

$button_group = get_field('button_group') ?? [];

$button_1 = $button_group["button_1"] ?? '';
$button_2 = $button_group["button_2"] ?? '';

// button 1 Style
$button_color_layout_1 = $button_group['button_color_layout_1'] ?? '';
$other_color_layout_1 = $button_group['other_color_layout_1'] ?? [];

$default_background_1 = $other_color_layout_1['default_background_1'] ?? '';
$default_text_color_1 = $other_color_layout_1['default_text_color_1'] ?? '';
$hover_background_1 = $other_color_layout_1['hover_background_1'] ?? '';
$hover_text_color_1 = $other_color_layout_1['hover_text_color_1'] ?? '';

// button 2 Style
$button_color_layout_2 = $button_group['button_color_layout_2'] ?? '';
$other_color_layout_2 = $button_group['other_color_layout_2'] ?? [];

$default_background_2 = $other_color_layout_2['default_background_2'] ?? '';
$default_text_color_2 = $other_color_layout_2['default_text_color_2'] ?? '';
$hover_background_2 = $other_color_layout_2['hover_background_2'] ?? '';
$hover_text_color_2 = $other_color_layout_2['hover_text_color_2'] ?? '';
?>


<div class="full-width" <?php echo !empty($background) ? 'style="background:' . $background . '"' : ''; ?>>
  <div id="<?php echo $id; ?>" class="col-full logged-in-section-main" style="padding-top:<?php echo $padding_top; ?>px; padding-bottom:<?php echo $padding_bottom; ?>px; margin-top:<?php echo $margin_top; ?>px; margin-bottom:<?php echo $margin_bottom; ?>px;">

    <?php if (!empty($logo_before_text) || !empty($logo['url']) || !empty($logo_after_text)): ?>
      <div class="main-heading-box">
        <h2 class="card-layout-main-heading">
          <?php if (!empty($logo_before_text)) echo '<span class="logo-before-text">' . $logo_before_text . '</span>'; ?>
          <?php if (!empty($logo['url'])): ?>
            <span class="logo-text"><img src="<?php echo $logo['url']; ?>" alt="<?php echo !empty($logo['alt']) ? $logo['alt'] : 'Logo'; ?>"></span>
          <?php endif; ?>
          <?php if (!empty($logo_after_text)) echo '<span class="logo-after-text">' . $logo_after_text . '</span>'; ?>
        </h2>
      </div>
    <?php endif; ?>

    <?php if (!empty($description)): ?>
      <div class="logged-in-description-box text-center "><?php echo $description; ?></div>
    <?php endif; ?>

    <div class="logged-in-description-below-flex ">
      <?php if (!empty($button_1['url']) && !empty($button_1['title'])): ?>
        <div class="button-group btn-1-box">
          <a class="btn-1-css btn-1 rounded-btn-css <?php echo $button_color_layout_1; ?>-btn-custom" href="<?php echo $button_1['url']; ?>">
            <?php echo $button_1['title']; ?>
          </a>
        </div>
      <?php endif; ?>
      <?php if (!empty($button_2['url']) && !empty($button_2['title'])): ?>
        <div class="button-group btn-2-box">
          <a class="btn-1-css btn-2 rounded-btn-css <?php echo $button_color_layout_2; ?>-btn-custom"  href="<?php echo $button_2['url']; ?>">
            <?php echo $button_2['title']; ?>
          </a>
        </div>
      <?php endif; ?>
    </div>

  </div>
</div>
<style>
  .logged-in-section-main{
    .btn-1.other-btn-custom {
      background: <?php echo $default_background_1 ?>;
    color: <?php echo $default_text_color_1 ?>; 

}
.btn-2.other-btn-custom {
      background: <?php echo $default_background_2 ?>;
    color: <?php echo $default_text_color_2 ?>; 

}
@media(min-width:768px){
  .btn-1.other-btn-custom:hover {
  background:<?php echo  $hover_background_1 ?>;
    color:<?php echo  $hover_text_color_1 ?>;
}
.btn-2.other-btn-custom:hover {
  background:<?php echo  $hover_background_2 ?>;
    color:<?php echo  $hover_text_color_2 ?>;
}
}
} 


  .text-center {
  text-align: center;
}

.logged-in-section-main {
.main-heading-box {
  h2 {
    display: flex;
    align-items: center;
    gap: 10px;
    justify-content: center;
    .logo-text{
      img{
        max-width:150px
      }
    }
  }
}
.logged-in-description-below-flex{
  display:grid;
    grid-template-columns:1fr 1fr!important;
    gap:15px;
    .button-group {
      a{
        margin-top: 15px;
        width:100%;
      }
    }
  }
}
@media(min-width:1200px){
  .logged-in-description-below-flex,.logged-in-description-box{
    width:70%;
    margin:auto;
  }
}
@media (max-width: 767px) {
  .logged-in-section-main {
  .logged-in-description-below-flex{
    grid-template-columns:1fr!important;
    gap:15px;
  }
}
}
</style>