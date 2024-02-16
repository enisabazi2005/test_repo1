<?php $helper = \Bettingpro\Includes\Helper::getInstance(); ?>
<div class="vcos-offer-block">
    <?php
    $offer_block = get_field('offer_block');
    if (is_array($offer_block)  && ! empty($offer_block)) :
    ?>
        <div class="vcos-bookie">
            <?php
            foreach ($offer_block as $slide) :
                if (!empty($slide['block_bookmaker'][0])) {
                    $bookie_main_info = (get_field('main_info', $slide['block_bookmaker'][0]));
                    $default_link = array_key_exists('link', $bookie_main_info) && $bookie_main_info['link'] ? $bookie_main_info['link'] : '';
                    $link = $slide['block_special_link'] ? $slide['block_special_link'] : $default_link;
                    $bookie_logo_id = $slide['block_special_logo'] ? $slide['block_special_logo']['url'] : wp_get_attachment_image($bookie_main_info['logo'], array('80', '40'), "vcos__logo-img");
                    $offer = substr($slide['block_main_offer'], 0, 71) ? substr($slide['block_main_offer'], 0, 71) : substr($bookie_main_info['offer'], 0, 71);
                    $offer_extended = $slide['block_offer_extended'] ? $slide['block_offer_extended'] : $bookie_main_info['privacy_text'];
                    $privacy_text = $slide['block_special_privacy_text'] ? $slide['block_special_privacy_text'] : $bookie_main_info['text_under_button'];
                    $bg_color = $slide['block_special_background_color'] ? $slide['block_special_background_color'] : $bookie_main_info['main_color'];
                    $button_text = $slide['block_cta_button_text'] ? $slide['block_cta_button_text'] : $bookie_main_info['button_text'];
                } else {
                    continue;
                }
                if(!$bookie_main_info['demonotized_bookmaker']): ?>
                    <div class="vcos-bookie__holder" style="background: <?= $bg_color ?>">
                        <div class="vcos-bookie__top transform">
                            <?php if (!empty($link)) : ?>
                                <a href="<?php echo $link; ?>" class="vcos-bookie__logo" target="_blank" rel="noopener noreferrer">
                                    <?php if ($slide['block_special_logo']) : ?>
                                        <img width="1024" height="536" class="vcos__logo-img" alt="<?= $slide['block_special_logo']['alt'] ?>" src="<?= $slide['block_special_logo']['url'] ?>">
                                    <?php else : ?>
                                        <?= wp_get_attachment_image($bookie_main_info['logo'], array('80', '40'), "vcos__logo-img") ?>
                                    <?php endif; ?>
                                </a>
                            <?php endif; ?>
                            <div class="vcos-bookie__text">
                                <?php if (!empty($offer)) : ?>
                                    <span class="vcos-bookie__text-title">
                                        <?= $offer ?>
                                    </span>
                                <?php endif; ?>
                                <span class="vcos-bookie__tc">T&Cs apply</span>
                            </div>
                        </div>
                        <div class="vcos-bookie__bottom">
                            <?php echo $offer_extended; ?>
                            <?php if ($privacy_text) : ?>
                                <div class="vcos-bookie__terms-label"><?= $privacy_text; ?></div>
                            <?php endif; ?>
                            <div class="vcos-bookie__bottom-holder">
                                <?php
                                if (!empty($link) && !empty($button_text)) : ?>
                                    <a href="<?= $link ?>" class="vcos-bookie__btn" target="_blank" rel="noopener noreferrer"><?= $button_text; ?></a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <div class="vcos-bookie__holder" style="background: <?= $bg_color ?>">
                        <div class="vcos-bookie__top transform">
                            <?php if (!empty($link)) : ?>
                                <a 
                                    href="javascript:void(0);" 
                                    class="vcos-bookie__logo openModalBtn" 
                                    rel="noopener noreferrer">
                                    <?php if ($slide['block_special_logo']) : ?>
                                        <img width="1024" height="536" class="vcos__logo-img" alt="<?= $slide['block_special_logo']['alt'] ?>" src="<?= $slide['block_special_logo']['url'] ?>">
                                    <?php else : ?>
                                        <?= wp_get_attachment_image($bookie_main_info['logo'], array('80', '40'), "vcos__logo-img") ?>
                                    <?php endif; ?>
                                </a>
                            <?php endif; ?>
                            <div class="vcos-bookie__text">
                                <?php if (!empty($offer)) : ?>
                                    <span class="vcos-bookie__text-title">
                                        <?= $offer ?>
                                    </span>
                                <?php endif; ?>
                                <span class="vcos-bookie__tc">T&Cs apply</span>
                            </div>
                        </div>
                        <div class="vcos-bookie__bottom">
                            <?php echo $offer_extended; ?>
                            <?php if ($privacy_text) : ?>
                                <div class="vcos-bookie__terms-label"><?= $privacy_text; ?></div>
                            <?php endif; ?>
                            <div class="vcos-bookie__bottom-holder">
                                <?php
                                if (!empty($link) && !empty($button_text)) : ?>
                                    <a 
                                        href="javascript:void(0);"
                                        class="vcos-bookie__btn openModalBtn" 
                                        rel="noopener noreferrer">
                                            <?= $button_text; ?>
                                    </a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php
                    $helper::renderMonotizedTemplate([]);
                endif;
            endforeach;
            ?>
        </div>
    <?php
    endif;
    ?>
</div>