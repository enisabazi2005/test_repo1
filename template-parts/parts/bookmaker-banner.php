<?php   
    $bookmaker_review = get_field('review') ?? get_field('review_fields'); 
    $bookmaker_main = get_field('main_info');
    $helper = \Bettingpro\Includes\Helper::getInstance();
?>

<div class="container">
    <div class="wrapper">
        <div    class="bookmaker-banner" 
                style="color:<?= $bookmaker_review['text_color'] ?>; 
                background-image: linear-gradient(90deg, <?= $bookmaker_review['color_1'] ?> 0%, <?= $bookmaker_review['color_2'] ?> 100%);">
            <div style="background-color:<?= $bookmaker_main['main_color']?>" class="bookmaker-banner__logos">
                <?= wp_get_attachment_image($bookmaker_main['logo'], 'full'); ?>
            </div>
            <div class="bookmaker-banner__contents">
                <div class="bookmaker-banner__contents__stars">
                    <?php
                    $starRating = doubleval($bookmaker_main['rank']);
                    for ($i = 1; $i <= 5; $i++) {
                        if($starRating < $i ) 
                        {
                            if(is_float($starRating) && (round($starRating) == $i))
                            {
                                echo '<img src="' . get_template_directory_uri() . '/assets/images/star-half.svg" alt="star-half">';
                            }
                            else
                            {
                                echo '<img src="' . get_template_directory_uri() . '/assets/images/star-empty.svg" alt="star-empty">';
                            }
                        }
                        else 
                        {
                        echo '<img src="' . get_template_directory_uri() . '/assets/images/star-filled.svg" alt="star-filled">';
                        }
                    }
                    ?>
                </div>
                <div class="bookmaker-banner__contents__main-text">
                    <p><?= $bookmaker_review['banner_main_text'] ?></p>
                </div>
                <div class="bookmaker-banner__contents__subtext">
                    <p><?= $bookmaker_review['banner_subtext'] ?></p>
                </div>
            </div>   
            <div class="bookmaker-banner__links">
                <?php if($bookmaker_review['show_button']== true): ?>
                    <h2 class="bookmaker-banner__links__text-above">
                        <?= $bookmaker_review['text_above_the_button'] ?? $bookmaker_review['text_above_button']; ?>
                    </h2>
                    <?php if(!$bookmaker_main['demonotized_bookmaker']): ?>
                        <a href="<?= $bookmaker_review['button_link'] ?>" target="_blank" class="link">
                            <p>
                                <?= $bookmaker_review['button_text'] ?>
                            </p>
                        </a>
                        <?php else: ?>
                        <a href="javascript:void(0);" class="link openModalBtn">
                            <p>
                                <?= $bookmaker_review['button_text'] ?>
                            </p>
                        </a> 
                    <?php 
                        $helper::renderMonotizedTemplate([]);
                        endif;
                    ?>
                    <div class="bookmaker-banner__links__text-under">
                        <p>
                            <?= $bookmaker_review['text_under_the_button'] ?? $bookmaker_review['text_under_button'] ?>
                        </p>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        <div class="text-under-banner">
            <p>
                <?= $bookmaker_review['text_under_the_banner'] ?>
            </p>
        </div>
    </div>
</div>