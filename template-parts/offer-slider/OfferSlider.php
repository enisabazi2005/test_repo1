<?php 
$helper = \Bettingpro\Includes\Helper::getInstance();
?>
<div class="vcos-wrapper">
    <?php
    $top_slider = get_field('slider_items');
    if (is_array($top_slider)) : ?>
    <div class="js-vcos-slider vcos-slider">
    <?php
        foreach ($top_slider as $key => $slide) :
            if (!empty($slide['bookmaker'][0]) && get_field('main_info', $slide['bookmaker'][0]) != null) :
                $bookie_main_info = get_field('main_info', $slide['bookmaker'][0]);
                $default_link = array_key_exists('link', $bookie_main_info) && $bookie_main_info['link'] ? $bookie_main_info['link'] : '';
                $link = $slide['special_link'] ? $slide['special_link'] : $default_link;
                $bookie_logo_id = $slide['special_logo'] ? $slide['special_logo']['url'] : wp_get_attachment_image($bookie_main_info['logo'], array('85', '24'), "vcos__logo-img");
                $offer = substr($slide['main_offer'], 0, 71) ? substr($slide['main_offer'], 0, 71)  : substr($bookie_main_info['offer'],0 ,71) ;
                $offer_extended = substr($slide['offer_extended'],0, 361) ? substr($slide['offer_extended'],0 ,361)  : substr($bookie_main_info['privacy_text'],0 ,361);
                $privacy_text = $slide['special_privacy_text'] ? $slide['special_privacy_text'] : $bookie_main_info['text_under_button'];
                $bg_color = $slide['special_background_color'] ? $slide['special_background_color'] : $bookie_main_info['main_color'];
                $slide_image = isset($slide['slide_image']['url']) ? $slide['slide_image']['url'] : $bookie_main_info['main_color'];
                $button_text = $slide['cta_button_text'] ? $slide['cta_button_text'] : $bookie_main_info['button_text'];
                $data_attributes = $slide['data_attributes'];
                $data_attributes['data_position'] = $key +1;
                $data_attributes["data_placement"] = "offer slider";

                if(!$bookie_main_info['demonotized_bookmaker']): ?>
                    <div class="slick-slide">
                        <div class="vcos__slide" data-link="<?= $link; ?>" data-thumb="<?= $offer; ?>" data-color="#f00" data-target="_blank">
                            <a 
                                href="<?php echo $link; ?>" 
                                class="vcos__content" 
                                target="_blank" 
                                rel="noopener noreferrer" 
                                <?= get_gtm_string_href($data_attributes); ?>
                            >
                                <div class="vcos__logo">
                                    <?php
                                                if (!empty($bookie_logo_id)) : ?>
                                    <?php if ($slide['special_logo']) : ?>
                                    <img width="1024" height="536" class="vcos__logo-img"
                                        alt="<?= $slide['special_logo']['alt']; ?>" src="<?= $slide['special_logo']['url']; ?>">
                                    <?php else : ?>
                                    <?= wp_get_attachment_image($bookie_main_info['logo'], array(85, 24), "vcos__logo-img") ?>
                                    <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                                <?php
                                            if (!empty($offer)) : ?>
                                <strong class="vcos__title"><?= $offer ?></strong>
                                <?php endif; ?>
                                <div class="vcos__bottom-line">
                                    <div id="floating-disclaimer" class="container pc">
                                        <div class="disclaimer-container">
                                            <?php if (!empty($offer_extended)) : ?>
                                            <span class="vcos__addtext vcos__addtext--desktop">
                                                <?= $offer_extended; ?>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="vcos__btn-holder">
                                        <?php if (!empty($button_text)) : ?>
                                        <span class="vcos__btn" style="background: <?= $bg_color ?>;"><?= $button_text ?></span>
                                        <span class="vcos__terms-label">
                                            <?php endif; ?>
                                            <?php if (!empty($privacy_text)) : ?>
                                            <p><?= $privacy_text; ?></p>
                                            <?php endif; ?>
                                        </span>
                                    </div>
                                </div>
                            </a>
                            <?php
                                        if (!empty($slide_image)) : ?>
                            <img width="1024" height="536" class="vcos__bg-image" alt="<?= $slide['slide_image']['alt']; ?>" src="<?= $slide_image; ?>" />
                            <?php endif; ?>
                        </div>
                        <?php
                                    if (!empty($offer_extended)) : ?>
                        <div class="vcos__addtext vcos__addtext--mobile"><?= $offer_extended; ?></div>
                        <?php endif; ?>
                    </div>
                <?php else: 
                    ?>
                    <div class="slick-slide">
                        <div class="vcos__slide" data-link="javascript:void(0);" data-thumb="<?= $offer; ?>" data-color="#f00" data-target="" data-class="openModalBtn">
                            <a 
                                href="javascript:void(0);"
                                class="vcos__content openModalBtn" 
                                rel="noopener noreferrer" 
                                <?= get_gtm_string_href($data_attributes); ?>
                            >
                                <div class="vcos__logo">
                                    <?php
                                    if (!empty($bookie_logo_id)) : ?>
                                    <?php if ($slide['special_logo']) : ?>
                                    <img width="1024" height="536" class="vcos__logo-img"
                                        alt="<?= $slide['special_logo']['alt']; ?>" src="<?= $slide['special_logo']['url']; ?>">
                                    <?php else : ?>
                                    <?= wp_get_attachment_image($bookie_main_info['logo'], array(85, 24), "vcos__logo-img") ?>
                                    <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                                <?php
                                if (!empty($offer)) : ?>
                                    <strong class="vcos__title"><?= $offer ?></strong>
                                <?php endif; ?>
                                <div class="vcos__bottom-line">
                                    <div id="floating-disclaimer" class="container pc">
                                        <div class="disclaimer-container">
                                            <?php if (!empty($offer_extended)) : ?>
                                            <span class="vcos__addtext vcos__addtext--desktop">
                                                <?= $offer_extended; ?>
                                            </span>
                                            <?php endif; ?>
                                        </div>
                                    </div>

                                    <div class="vcos__btn-holder">
                                        <?php if (!empty($button_text)) : ?>
                                        <span class="vcos__btn" style="background: <?= $bg_color ?>;"><?= $button_text ?></span>
                                        <span class="vcos__terms-label">
                                            <?php endif; ?>
                                            <?php if (!empty($privacy_text)) : ?>
                                            <p><?= $privacy_text; ?></p>
                                            <?php endif; ?>
                                        </span>
                                    </div>
                                </div>
                            </a>
                            <?php
                                        if (!empty($slide_image)) : ?>
                            <img width="1024" height="536" class="vcos__bg-image" alt="<?= $slide['slide_image']['alt']; ?>" src="<?= $slide_image; ?>" />
                            <?php endif; ?>
                        </div>
                        <?php
                                    if (!empty($offer_extended)) : ?>
                        <div class="vcos__addtext vcos__addtext--mobile"><?= $offer_extended; ?></div>
                        <?php endif; ?>
                    </div>
                <?php
                endif; ?>
            <?php else :
                    continue;
                endif;
            endforeach;
            ?>

    </div>
    <?php endif;
        $helper::renderMonotizedTemplate([]);
    ?>
</div>