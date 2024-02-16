<?php 
    $bookmaker_review = get_field('review') ?? get_field('review_fields'); 
?>
<div class="wrapper">
    <h2><?= $bookmaker_review['pros_and_cons_title'] ?></h2>
    <div class="bookmakers-comparison">
        <div class="bookmakers-comparison__pros-cons">
            <div class="bookmakers-comparison__pros-cons__title">
                <p>Pros</p>
            </div>
            <div class="bookmakers-comparison__pros-cons__item">
                <?php if (is_array($bookmaker_review['pros'])) :
                    foreach ($bookmaker_review['pros'] as $pros) : ?>
                        <div class="bookmakers-comparison__pros-cons__item__group">
                            <img src="<?= get_template_directory_uri() ?>/assets/images/tick-circle.svg" alt="tick" />
                            <p><?= $pros['item'] ?></p>
                        </div>
                <?php endforeach;
                endif; ?>
            </div>
        </div>
        <div class="bookmakers-comparison__pros-cons">
            <div class="bookmakers-comparison__pros-cons__title">
                <p>Cons</p>
            </div>
            <div class="bookmakers-comparison__pros-cons__item">
                <?php if (is_array($bookmaker_review['cons'])) :
                    foreach ($bookmaker_review['cons'] as $cons) : ?>
                        <div class="bookmakers-comparison__pros-cons__item__group">
                            <img src="<?= get_template_directory_uri() ?>/assets/images/cross.svg" alt="cross" />
                            <p><?= $cons['item'] ?></p>
                        </div>
                <?php endforeach;
                endif; ?>
            </div>
        </div>
    </div>
</div>