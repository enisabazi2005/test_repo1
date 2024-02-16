<?php
    $tips = get_field( 'tips')['select_tips'] ?? '';
    $title = get_field( 'tips' )['title'] ?? '';
    $helper = \Bettingpro\Includes\Helper::getInstance();
?>
<div class="more-tips">
    <div>
        <div class="more-tips__title">
            <span class="more-tips__title__text">
                <?= $title ?>
            </span>
        </div>
        <div class="more-tips__blocks">
            <?php if (is_array( $tips )) :
                foreach ( $tips as $value ) : ?>
                    <div class="more-tips__blocks__block">
                        <div class="more-tips__blocks__block__image">
                            <?= get_the_post_thumbnail( $value, 'thumbnail' ) ?>
                        </div>
                        <div class="more-tips__blocks__block__text">
                        <a
                            href=<?= get_permalink( $value ) ?>
                            class="module_link"
                        >
                            <p class="more-tips__blocks__block__text__title">
                                <?= (strlen(get_the_title( $value )) > 60 ? substr(get_the_title( $value ), 0, 60).'...' : get_the_title( $value ) ) ?>
                            </p>
                        </a>
                        <time datetime="<?= $helper::getModifiedDate($value, "Y-m-d\TH:i:sP"); ?>" class="more-tips__blocks__block__text__time">
                            <?= $helper::getModifiedDate($value, "M d, Y h:i A"); ?>
                        </time>
                        </div>
                    </div>
                <?php endforeach; 
            endif; ?>
        </div>
    </div>
</div>