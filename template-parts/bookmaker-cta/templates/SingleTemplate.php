<div 
    class="cta-single-template cta-bookmaker-template"
    style="background-color: <?= $bookmakerCTA["container_background_color"] ?>;"
>
    <div class="cta-tag" style="
        background-color: <?= $bookmakerCTA["tag_background_color"] ?>; 
        color: <?= $bookmakerCTA["tag_text_color"] ?>;"
    >
        <?= $bookmakerCTA["tag"] ?>
    </div>
    <?= wp_get_attachment_image($bookmakerFields["logo"], "full",
            "", ["class" => "cta-template-image"]); ?>
    <div class="cta-single-details">
        <p class="cta-single-text-offer" style="color: <?= $bookmakerCTA["container_text_color"] ?>">
            <?= $bookmakerCTA["offer"] ?>
        </p>
        <a
            class="cta-offer-button"
            href="<?= $offer["url"] ?>"
            style="
                background: <?= $bookmakerCTA["offer_background_color"] ?>;
                color: <?= $bookmakerCTA["offer_text_color"] ?>";
        >
            <?php if (!empty($bookmakerCTA["offer_button_icon"])) : ?>
                <img 
                    class="gift-svg" 
                    src="<?= $bookmakerCTA["offer_button_icon"] ?>"
                    alt="gift">
            <?php else: ?>
                <img 
                    class="gift-svg" 
                    src="<?= get_template_directory_uri() ?>/assets/images/gift-vector.svg" 
                    alt="gift">
            <?php endif; ?>
            <span>
                <?= $offer["title"] ?>
            </span>
        </a>
    </div>
</div>
