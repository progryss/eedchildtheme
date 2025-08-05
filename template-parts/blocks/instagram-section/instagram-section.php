<?php 
$id = 'text-' . $block['id'];

$section_padding = get_field("section_padding") ?: [];
$padding_top = $section_padding["padding_top"] ?? '';
$padding_bottom = $section_padding["padding_bottom"] ?? '';

$section_margin = get_field("section_margin") ?: [];
$margin_top = $section_margin["margin_top"] ?? '';
$margin_bottom = $section_margin["margin_bottom"] ?? '';

$half_box_background = get_field('half_box_background') ?: '';
$half_box_text_color = get_field('half_box_text_color') ?: '';
$heading = get_field('heading') ?: '';
$description = get_field('description') ?: '';
?>


<div class="full-width">
  <div id="<?php echo $id; ?>" class=" instagram-section-main" style="padding-top:<?php echo $padding_top; ?>px;padding-bottom:<?php echo $padding_bottom; ?>px;margin-top:<?php echo $margin_top; ?>px;margin-bottom:<?php echo $margin_bottom; ?>px">
<div class="half-heading-box" style="background:<?php echo $half_box_background; ?>;color:<?php echo $half_box_text_color; ?>;">
<div class="half-heading-box-inner">
    <?php if (!empty($heading)): ?>
      <div class="main-heading-box">
        <h2 class="insta-heading">
          <?php echo $heading; ?>
        </h2>
      </div>
    <?php endif; ?>
    <?php if (!empty($description)): ?>
    <div><?php echo $description; ?> </div>
    <?php endif; ?>
</div>
</div>

      <div class="insta-main-box col-full">
<div class="tagembed-widget" style="width:100%;height:100%;" data-widget-id="292880" website="1"></div><script src="https://widget.tagembed.com/embed.min.js" type="text/javascript"></script>
      </div>
  </div>
</div>

<style>
  .instagram-section-main{
  .half-heading-box{
    padding-block:30px 90px;
    .half-heading-box-inner{
      padding-inline: calc((100vw - 82.5em) / 2) 25%;
      @media(max-width:1300px) and (min-width:1025px){
        padding-inline: calc((100vw - 73.5em) / 2) 25%;
      }
      h2,p{
        color:inherit;
      }
    }
  }
      .insta-main-box{  
    margin-top: -90px;
    @media(max-width:1024px){
      padding-inline:35px;
    }
    }
    .tb_app_container{
      .tb_app_wrapper{
        .tb_hs_post_container{
          .splide__list{
            .splide__slide{
              @media(min-width:1200px){
                width:16.66%!important;
              }
              .tb_hs_col_wrap{
                .tb_hs_post_wrapper{
                  padding:5px!important;
                  .tb_hs_post_in{
                    border-radius:0;
                    box-shadow:none;
                    border:1px solid var(--border-color);
                  }
                }
              }
            }
          }
          .tb_hs_arrow_wrapper_{
            opacity:1;
            .tb_hs_arrow_left__{
              left: -35px;
            }
            .tb_hs_arrow_right__{
              right: -35px;
            }
            .tb_hs_arrow{
              opacity:1;
              box-shadow:none;
              background:transparent;
            }
          }
        }
      }
    }
    }

          @media(min-width:992px){
            .half-heading-box{
            width:50%;
      }
    }
@media (max-width: 1279px) and (min-width: 1024px) {
  .half-heading-box .half-heading-box-inner {
    padding-inline: 45px !important;
  }
}

              @media(max-width:1023px){
            .half-heading-box{
              .half-heading-box-inner{
        padding-inline:30px!important;
        }
      }
    }
</style>


