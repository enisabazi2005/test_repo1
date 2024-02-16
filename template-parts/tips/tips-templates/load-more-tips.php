<?php 
    $label ?? '';
    $helper = \Bettingpro\Includes\Helper::getInstance();
?>
<div class="features__block ">
    <div class="features__block__image">
        <?= the_post_thumbnail('medium') ?>
        <?php if(!empty($label)):?>
            <span class="features__block__image__special_offer">
            <p><?= $label ?? ''; ?></p>
            </span>
            <?php endif; ?>
    </div>
    <div class="features__block__text">
        <div class="features__block__text__info">
        <time datetime="<?= $helper::getModifiedDate(get_the_ID(), "Y-m-d\TH:i:sP"); ?>">
            <?= $helper::getModifiedDate(get_the_ID(), "M d, Y h:i A"); ?>
        </time>
        <a href="<?= get_permalink() ?>" alt="<?= get_the_title() ?>" 
            class="features__block__text__info__button"><?php _e('Read More', 'bettingpro'); ?></a>
    </div>
    <div class="features__block__text__title">
        <a href="<?= get_permalink() ?>"><?= get_the_title() ?></a>
        </div>
        <div class="features__block__text__desc">
            <p><?= get_the_excerpt() ?></p>
        </div>
    </div>
</div>