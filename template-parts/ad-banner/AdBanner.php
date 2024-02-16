<?php  
    $data = get_field("ad_banner_data");
    $country_code= getCountryCode();
    $gtm_data = get_field("data_attributes");
    $gtm_string = get_gtm_string_banner($gtm_data);


    if (in_array(strtolower($country_code), $data["country"]) || in_array("all-countries", $data["country"])) :
?>

    <div class="wrapper">
        <div class="ad-banner" style="background-color: <?= $data["background_color"] ?> " <?= $gtm_string ?>>
            <div class="ad-banner__content">
                <p class="event-text" style="color: <?= $data["event_text_color"] ?>"><?= $data["event_text"] ?></p>
                <?php if($data["main_text"]):
                    foreach($data["main_text"] as $main_text): ?>
                        <p class="main-text" style="color: <?= $main_text["color"] ?>"><?= $main_text["text"] ?></p>
                    <?php endforeach;
                endif; ?>
                <?php if($data["button_text"]): ?>
                    <a 
                        href="<?= $data["button_link"] ?>" 
                        target="blank"
                        style="border: 1px solid <?= $data["border_color"] ?>; <?= $data["button_color"] ? 'background-color: ' . $data["button_color"] . ';' : '' ?>"
                    >
                        <?= $data["button_text"] ?>
                    </a>
                <?php endif; ?>
                <p class="terms"><?= $data["terms_text"] ?></p>
            </div>
            <div class="ad-banner__image">
                <span style="background: linear-gradient(-90deg, rgba(0, 0, 0, 0), <?= $data["background_color"]; ?>);"></span>
                <?= wp_get_attachment_image( $data["image"], "full"); ?>
            </div>
        </div>
    </div>
<?php
    endif;