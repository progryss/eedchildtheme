<?php 
$id = 'text-' . $block['id'];

$section_padding = get_field("section_padding") ?? [];
$padding_bottom = $section_padding["padding_bottom"] ?? '';
$padding_top = $section_padding["padding_top"] ?? '';

$section_margin = get_field("section_margin") ?? [];
$margin_bottom = $section_margin["margin_bottom"] ?? '';
$margin_top = $section_margin["margin_top"] ?? '';

$background = get_field('background') ?? '';
$heading_separator = get_field('heading_separator') ?? '';

$left_group = get_field('left_group') ?? [];
$left_part_repeater = $left_group['left_part_repeater'] ?? [];

$right_group = get_field('right_group') ?? [];
$right_part_heading_sep_color = $right_group['right_part_heading_sep_color'] ?? '';
$right_part_heading = $right_group['right_part_heading'] ?? '';
$right_part_description = $right_group['right_part_description'] ?? '';
$contact_form_shortcode = $right_group['contact_form_shortcode'] ?? '';
?>


<div class="full-width" style="background:<?php echo $background; ?>;">
    <div id="<?php echo $id; ?>" class="col-full form-section-main" 
         style="padding-top:<?php echo $padding_top; ?>px; padding-bottom:<?php echo $padding_bottom; ?>px; margin-top:<?php echo $margin_top; ?>px; margin-bottom:<?php echo $margin_bottom; ?>px;">

        <div class="form-grid">
            <div class="left-part-box">
                <?php if ($left_part_repeater): ?>
                    <?php foreach ($left_part_repeater as $card): ?>
                        <?php
                        $left_part_heading = $card["left_part_heading"] ?? '';
                        $left_part_heading_color = $card["left_part_heading_color"] ?? '';
                        $left_part_heading_sep_color = $card["left_part_heading_sep_color"] ?? '';
                        $left_part_description = $card["left_part_description"] ?? '';
                        ?>
                        <div class="left-card">
                            <div class="form-heading-box">
                                <h2 class="form-heading" style="color:<?php echo $left_part_heading_color; ?>;">
                                    <?php echo $left_part_heading; ?>
                                </h2>
                                <?php if ($heading_separator === 'yes'): ?>
                                    <div class="line-separator" style="background:<?php echo $left_part_heading_sep_color; ?>;"></div>
                                <?php endif; ?>
                            </div>
                            <div class="desc-box">
                                <?php echo $left_part_description; ?>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <div class="right-part-box">
                <div class="form-heading-box">
                    <h2 class="form-heading">
                        <?php echo $right_part_heading; ?>
                    </h2>
                    <?php if ($heading_separator === 'yes'): ?>
                        <div class="line-separator" style="background:<?php echo $right_part_heading_sep_color; ?>;"></div>
                    <?php endif; ?>
                </div>
                <div class="desc-box">
                    <?php echo $right_part_description; ?>
                    <div class="contact-us-form">
                        <?php echo do_shortcode($contact_form_shortcode); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style lang="scss">
.form-section-main {
     a {
      text-decoration: none!important;
    color: inherit;
    outline: none; 
    }
    .form-grid {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 30px;

    .form-heading-box {
        margin-bottom: 25px;

        .form-heading {
            margin-bottom: 8px;
            font-size: 26px;
        }

        .line-separator {
            width: 85px;
            height: 5px;
            display: block;
        }
    }

    .desc-box {
        p {
            margin-bottom: 4px;
        }
    }
    .left-card {
  margin-bottom: 30px;

  &:last-child {
    margin-bottom: 0px;
  }
}
    .contact-us-form {
    margin-top: 15px;

    input:not([type="submit"]),
    textarea,select {
        width: 100%;
        border: 1px solid #ddd;
        padding: 10px;
        margin-bottom: 25px;
        font-size: 16px;
        outline: none;
        border-radius:10px;
        background: #f9f9f9; 
    }

    input:not([type="submit"]):focus,
    textarea:focus {
      background: #fff;
    }
    input:not([type="submit"]) {
        height: 42px;
    }

    textarea {
        height: 120px; 
        resize: vertical; 
    }
    .frm_form_fields button[type=submit]{
        display:initial!important;
        margin-top: 5px!important;
    }
    input[type="submit"] {
        padding: 10px 40px;
        color: #fff;
        background-color: #00a591;
        border: none;
        outline: none;

        cursor: pointer;

        &:hover,
        &:focus {
            background-color: #3a3a3a;
        }
    }

    .wpcf7-not-valid-tip {
        margin-top: -7px;
        font-size: 14px;
        margin-bottom: 15px;
    }
}
}

    @media (max-width: 767px) {
        .form-grid {
            grid-template-columns: 1fr;
        }
    }
}
</style>
