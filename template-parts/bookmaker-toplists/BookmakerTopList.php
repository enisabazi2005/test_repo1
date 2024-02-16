<?php
$helper = \Bettingpro\Includes\Helper::getInstance();
$general_data = get_field('bookmaker_toplist');

$country_code= getCountryCode();


$args = [
    'post_type'      => 'bookmakers',
    'post__in'       => $general_data['bookmaker'],
    'orderby'        => 'post__in',
    'posts_per_page' => -1,
    'status'          => 'publish',
    'tax_query'      => [
        [
            'taxonomy' => 'geo_location',
            'field'    => 'slug',
            'terms'    => strtolower($country_code),
        ],
    ],
];

$query = new WP_Query($args);
?>
<?php if ($query->have_posts()) : ?>
    <div class="bookmaker">
        <?php if($general_data["affiliate_disclosure_statement"]): ?>
            <div class="bookmaker__disclosure">
                <span>
                    <svg><use xlink:href="<?= get_stylesheet_directory_uri(); ?>/assets/build/img/sprite.svg#bell"></use></svg>
                </span>
                <div class="bookmaker__disclosure__text">
                    <?php $first_string = substr($general_data["affiliate_disclosure_statement"], 0, 200);
                    $second_string = $general_data["affiliate_disclosure_statement"];?>
                    <div class="bookmaker__disclosure__text__first"><?= $first_string ?></div>
                    <div class="bookmaker__disclosure__text__second"><?= $second_string ?></div>
                    <?php if(strlen($second_string) > 200):?>
                        <span class="bookmaker__disclosure__text__read-more"><?php _e('Read more', 'bettingpro'); ?></span>
                        <span class="bookmaker__disclosure__text__read-less"><?php _e('Read less', 'bettingpro'); ?></span>
                    <?php endif;?>
                </div>
            </div>
        <?php endif; ?>
        <?php while ($query->have_posts()) : $query->the_post();
            $bookmakers = get_field("main_info", get_the_ID());
            $data_attributes = get_field("data_attributes", get_the_ID());
            $data_attributes["data_position"] = $query->current_post + 1;
            $data_attributes["data_placement"] = "toplist";
            $link = $bookmakers["link"];

            if (is_array($general_data["custom_links"])) :
                $custom_bookmaker = array_column($general_data["custom_links"], "bookmaker_name");
                $link_key = array_search(get_the_ID(), $custom_bookmaker);
                $match = $general_data["custom_links"][$link_key];
                $link = is_numeric($link_key) ? $match["go_link"]["url"] : $bookmakers["link"];
            endif;

            if (!$bookmakers['demonotized_bookmaker']) :
        ?>
                <div class="bookmaker__row">
                    <div class="bookmaker__row__holder" <?php if (!empty($bookmakers['highlight_phrase'])) {
                                                            echo "data-title='" . $bookmakers['highlight_phrase'] . "'";
                                                        } ?>
                        style="background-color:<?= $bookmakers['main_color'] ?>">
                        <a href="<?= $link ?>" class="bookmaker-offers__logo">
                            <span class="img-holder">
                                <?= wp_get_attachment_image($bookmakers['logo'], 'full'); ?>
                            </span>
                        </a>
                        <a href="<?= $link ?>" target="_blank" rel="noopener noreferrer nofollow" class="bookmaker-offers__info">
                            <span style="color: <?= $bookmakers["font_color"] ?>;" class="text">
                                <?= $bookmakers["offer"] ?>
                            </span>
                            <div class="bookmaker-offers__tags">
                                <?php $taxnameFeatures = get_the_terms(get_the_ID(), 'bookmaker_features', array('fields' => 'name'));
                                if (!is_bool($taxnameFeatures)) :
                                    foreach ($taxnameFeatures as $name) : ?>
                                        <span><?= $name->name ?></span>
                                <?php endforeach;
                                endif; ?>
                            </div>
                        </a>
                        <div class="bookmaker-offers__link">
                            <div class="bookmaker-offers__score">
                                <div class="score-text">
                                    <?php
                                    $rank  = floatval($bookmakers['rank']) * 2;
                                    $grade = '';
                                    switch ($rank) {
                                        case $rank <= 10 && $rank >= 9:
                                            $grade = __('Excellent', 'bettingpro');
                                            break;
                                        case $rank < 9 && $rank >= 8:
                                            $grade = __('Very Good', 'bettingpro');
                                            break;
                                        case $rank < 8 && $rank >= 7:
                                            $grade = __('Good', 'bettingpro');
                                            break;
                                        case $rank < 7 && $rank >= 5:
                                            $grade = __('Average', 'bettingpro');
                                            break;
                                        default:
                                            $grade = __('Poor', 'bettingpro');
                                    }
                                    ?>
                                    <strong class="value" style="color: <?= $bookmakers["font_color"] ?>;" >
                                        <?= $grade ?>
                                    </strong>
                                    <a href=<?= get_permalink() ?> class="review-link">
                                        <?= _e('Review', 'bettingpro') ?>
                                    </a>
                                </div>
                                <div class="score-rating">
                                    <?php
                                        $starRating = doubleval($bookmakers['rank']);
                                        for ($i = 1; $i <= 5; $i++) {
                                            if ($starRating < $i) {
                                                if (is_float($starRating) && (round($starRating) == $i)) {
                                                    echo '<img src="' . get_template_directory_uri() . '/assets/images/star-half.svg" alt="star-half">';
                                                } else {
                                                    echo '<img src="' . get_template_directory_uri() . '/assets/images/star-empty.svg" alt="star-empty">';
                                                }
                                            } else {
                                                echo '<img src="' . get_template_directory_uri() . '/assets/images/star-filled.svg" alt="star-filled">';
                                            }
                                        }
                                    ?>
                                </div>
                            </div>
                            <a href="<?= $link ?>" class="bookmaker-offer__btn" target="_blank" rel="noopener noreferrer nofollow" 
                                <?= "style=\"background-color:" .  $bookmakers["button_color"] 
                                    . "; color:" . $bookmakers["button_text_color"] . "\"" ?>
                                <?= get_gtm_string_href($data_attributes); ?>>
                                <span>
                                    <?= _e('Claim Offer', 'bettingpro'); ?>
                                </span>
                            </a>
                        </div>
                    </div>
                    <div class="bookmaker-offers__addtext">
                        <p><?= $bookmakers['privacy_text'] ?></p>
                    </div>
                </div>
            <?php else : ?>
                <div class="bookmaker__row">
                    <div class="bookmaker__row__holder" <?php if (!empty($bookmakers['highlight_phrase'])) {
                                                            echo "data-title='" . $bookmakers['highlight_phrase'] . "'";
                                                        } ?>
                        style="background-color:<?= $bookmakers['main_color'] ?>">
                        <a href="javascript:void(0);" class="bookmaker-offers__logo openModalBtn" style="background-color:<?= $bookmakers['main_color'] ?>">
                            <span class="img-holder">
                                <?= wp_get_attachment_image($bookmakers['logo'], 'full'); ?>
                            </span>
                        </a>
                        <a href="javascript:void(0);" rel="noopener noreferrer nofollow" class="bookmaker-offers__info openModalBtn">
                            <span style="color: <?= $bookmakers["font_color"] ?>;" class="text">
                                <?= $bookmakers["offer"] ?>
                            </span>
                            <div class="bookmaker-offers__tags">
                                <?php $taxnameFeatures = get_the_terms(get_the_ID(), 'bookmaker_features', array('fields' => 'name'));
                                if (!is_bool($taxnameFeatures)) :
                                    foreach ($taxnameFeatures as $name) : ?>
                                        <span><?= $name->name ?></span>
                                <?php endforeach;
                                endif; ?>
                            </div>
                        </a>
                        <div class="bookmaker-offers__link">
                            <div class="bookmaker-offers__score">
                                <div class="score-text">
                                    <?php
                                    $rank  = floatval($bookmakers['rank']) * 2;
                                    $grade = '';
                                    switch ($rank) {
                                        case $rank <= 10 && $rank >= 9:
                                            $grade = __('Excellent', 'bettingpro');
                                            break;
                                        case $rank < 9 && $rank >= 8:
                                            $grade = __('Very Good', 'bettingpro');
                                            break;
                                        case $rank < 8 && $rank >= 7:
                                            $grade = __('Good', 'bettingpro');
                                            break;
                                        case $rank < 7 && $rank >= 5:
                                            $grade = __('Average', 'bettingpro');
                                            break;
                                        default:
                                            $grade = __('Poor', 'bettingpro');
                                    }
                                    ?>
                                    <strong class="value"  style="color: <?= $bookmakers["font_color"] ?>;" >
                                        <?= $grade ?>
                                    </strong>
                                    <a href=<?= get_permalink() ?> class="review-link">
                                        <?= _e('Review', 'bettingpro') ?>
                                    </a>
                                </div>
                                <div class="score-rating">
                                    <?php
                                        $starRating = doubleval($bookmakers['rank']);
                                        for ($i = 1; $i <= 5; $i++) {
                                            if ($starRating < $i) {
                                                if (is_float($starRating) && (round($starRating) == $i)) {
                                                    echo '<img src="' . get_template_directory_uri() . '/assets/images/star-half.svg" alt="star-half">';
                                                } else {
                                                    echo '<img src="' . get_template_directory_uri() . '/assets/images/star-empty.svg" alt="star-empty">';
                                                }
                                            } else {
                                                echo '<img src="' . get_template_directory_uri() . '/assets/images/star-filled.svg" alt="star-filled">';
                                            }
                                        }
                                    ?>
                                </div>
                            </div>
                            <a href="javascript:void(0);" class="bookmaker-offer__btn openModalBtn" rel="noopener noreferrer nofollow" 
                                <?= $bookmakers['button_color'] ? 'style="background-color:' .  $bookmakers['button_color'] . '"' : '' ?> 
                                <?= get_gtm_string_href($data_attributes); ?>>
                                <span> <?= _e('Claim Offer', 'bettingpro'); ?></span>
                            </a>
                        </div>
                    </div>
                    <div class="bookmaker-offers__addtext">
                        <p><?= $bookmakers['privacy_text'] ?></p>
                    </div>
                </div>
        <?php
                $helper::renderMonotizedTemplate($query->posts);
            endif;
        endwhile;
        ?>
    </div>
<?php endif; ?>