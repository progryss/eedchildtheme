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
$heading_separator = get_field('heading_separator') ?? '';
$separator_color = get_field('separator_color') ?? '';

$testimonials_block = get_field('testimonials_block') ?? [];
?>


<div class="full-width" style="background:<?php echo $background; ?>;">
  <div id="<?php echo $id; ?>" class="col-full testimonials-section-main" style="padding-top:<?php echo $padding_top; ?>px;padding-bottom:<?php echo $padding_bottom; ?>px;margin-top:<?php echo $margin_top; ?>px;margin-bottom:<?php echo $margin_bottom; ?>px">

    <?php if (!empty($heading)): ?>
      <div class="main-heading-box">
        <h2 class="card-layout-main-heading">
          <?php echo $heading; ?>
        </h2>
        <?php if ($heading_separator === 'yes'): ?>
          <div class="line-seperator" style="background:<?php echo $separator_color; ?>"></div>
        <?php endif; ?>
      </div>
    <?php endif; ?>

    <?php if ($testimonials_block): ?>
      <div class="testimonials-layout text-center">
        <?php foreach ($testimonials_block as $card): 
    $client_title = $card['client_title'] ?? '';
    $client_content = $card['client_content'] ?? '';
    $client_name = $card['client_name'] ?? '';
    $client_rating = $card['client_rating'] ?? '';
    $client_designation = $card['client_designation'] ?? '';
        ?>
          <div class="testimonials-layout-box">
            <?php if ($client_title): ?><h3 class="client-title"> <?php echo $client_title; ?> </h3><?php endif; ?>
            <?php if ($client_content): ?><div class="client-content"> <?php echo $client_content; ?> </div><?php endif; ?>
            <?php if ($client_name): ?><p class="client-name"><?php echo $client_name; ?></p><?php endif; ?>

              <div class="client-rating">
  <?php 
  $full_stars = floor($client_rating);
  $half_star = ($client_rating - $full_stars) >= 0.5 ? 1 : 0;
  $empty_stars = 5 - $full_stars - $half_star;

  for ($i = 0; $i < $full_stars; $i++) echo '<i class="fa-solid fa-star"></i>';
  if ($half_star) echo '<i class="fa-solid fa-star-half-alt"></i>';
  for ($i = 0; $i < $empty_stars; $i++) echo '<i class="fa-regular fa-star" style="color: #febe15;"></i>';
  ?>
</div>


            <?php if ($client_designation): ?><p class="client-designation"> <?php echo $client_designation; ?> </p><?php endif; ?>
          </div>
        <?php endforeach; ?>
      </div>
    <?php endif; ?>

  </div>
</div>


<style>
.text-center {
  text-align: center;
}

.testimonials-section-main {
  padding:0 2.617924em;
  box-sizing:border-box;
  .main-heading-box {
    text-align: center;
    margin-bottom: 30px;

    h2 {
      font-size: 42px;
      margin-bottom: 0;
    }
    .line-seperator {
    width: 125px;
    height: 5px;
    display: block;
    margin: 0px auto 0;
  }
  }
  .testimonials-layout {
  .testimonials-layout-box {
    h3 {
      font-size: 20px;
    }
    .client-name{
      margin-bottom:5px;
      font-family:"Arial Rounded MT Pro - Bold", sans-serif;
    }
    .client-rating{
      margin-bottom:5px;
      font-size:26px;
      .fa-solid{
        color:#febe15;
      }
      i{
        margin:2px;
      }
    }
  }
}
.slick-next {
  right: -60px !important;
}

.slick-prev {
  left: -60px !important;
  z-index: 1;
}

.slick-prev, .slick-next, .slick-prev:focus, .slick-next:focus {
  top: 50% !important;
        transform: translateY(-50%);
        width: 34px;
        height: 38px;
        background: transparent;
        border: 2px solid #777777;
}

.slick-prev:hover, .slick-next:hover {
  background: #1595ce;
  border: 2px solid #1595ce;
}

.slick-prev:hover:before, .slick-next:hover:before {
  color: #fff;
}

.slick-prev:before, .slick-next:before {
  font-family: 'Font Awesome 6 Free';
  font-weight: 900;
  font-size: 18px;
  color: #777777;
}

.slick-prev:before {
  content: '\f104'; /* Left Arrow Icon */
}

.slick-next:before {
  content: '\f105'; /* Right Arrow Icon */
}
.slick-dots li button:before{
  font-size:13px;
}
.slick-dots li.slick-active button:before {
    opacity: .75;
    color: #1595ce;
}
}
@media (min-width: 1200px) {
  .testimonials-section-main {
    .testimonials-layout {
      width:75%;
      margin:auto;
    }
}
}
@media (max-width: 767px) {
  .testimonials-section-main {
    padding: 0 15px;
  .main-heading-box {
    h2 {
      font-size: 34px;
    }
  }
  .testimonials-layout{
    .testimonials-layout-box{

    }
  }

}
}

</style>
<script>

jQuery(document).ready(function($) {
    $('.testimonials-layout').slick({
      autoplay: true,
      autoplaySpeed: 3000,
      arrows: true,
      dots: true,
      slidesToShow: 1,
      slidesToScroll: 1,
      responsive: [
        {
          breakpoint: 767,
          settings: {
            arrows: false
          }
        }
      ]
    });
  });

</script>