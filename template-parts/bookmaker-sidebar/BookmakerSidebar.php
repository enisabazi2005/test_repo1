<?php
$helper = \Bettingpro\Includes\Helper::getInstance();
$general_data = get_field('bookmaker_sidebar');

$country_code= getCountryCode();

update_option('posts_per_page', 50);

$taxq = ($general_data['show_on_all_countries'] ? '' : [
    [
        'taxonomy' => 'geo_location',
        'field'    => 'slug',
        'terms'    =>  strtolower($country_code)
    ]
]);

$args = [
    'post_type' => 'bookmakers',
    'post__in'  => $general_data['bookmaker'],
    'orderby'   => 'post__in',
    'tax_query' => $taxq,
];
$query = new WP_Query($args);

if ($query->have_posts()) : ?>
    <div class="sidebar-container">
        <div class="title-block tips-title">
            <span class="title-block_text">
                <?= $general_data['sidebar_title'] ?>
            </span>
        </div>
        <?php while ($query->have_posts()) :
            $query->the_post();
            $bookmakers = get_field('main_info', get_the_ID());
            $link = $bookmakers["link"];
            
            if (is_array($general_data["custom_links"])) :
                $bookmaker_position = array_column($general_data["custom_links"], "bookmaker_position");
                $link_key = array_search($query->current_post + 1, $bookmaker_position);
                $match = $general_data["custom_links"][$link_key];
                $link = is_numeric($link_key) ? $match["go_link"]["url"] : $bookmakers["link"];
            endif;
            
            if (!$bookmakers['demonotized_bookmaker']) :
        ?>
                <a href="<?= $link ?>" style="color:<?= $bookmakers["font_color"]; ?>">
                    <div class="sidebar-container__bookmakers">
                        <div class="sidebar-container__bookmakers__box" style="background-color:<?= $bookmakers['main_color'] ?>">
                            <div class="sidebar-container__bookmakers__box__bookmaker">
                                <?php if ($bookmakers['add_label'] == true) : ?>
                                    <span class="sidebar-container__bookmakers__box__bookmaker__label" style="background-color:<?= $bookmakers['label_color'] ?>">
                                        <p><?= $bookmakers['label_text'] ?></p>
                                    </span>
                                <?php endif; ?>
                                <div class="sidebar-container__bookmakers__box__bookmaker__group">
                                    <div style="background-color:<?= $bookmakers['main_color'] ?>" class="sidebar-container__bookmakers__box__bookmaker__group__logo">
                                        <?= wp_get_attachment_image($bookmakers['logo'], 'full'); ?>
                                    </div>
                                    <div class="sidebar-container__bookmakers__box__bookmaker__group__stars">
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
                            </div>
                            <div class="sidebar-container__bookmakers__box__offer">
                                <p class="sidebar-container__bookmakers__box__offer__text"><?= $bookmakers['offer'] ?></p>
                                <span class="sidebar-container__bookmakers__box__offer__btn" 
                                    <?= $bookmakers['button_color'] ? 'style="background-color:' .  $bookmakers['button_color'] . '"' : ''?>>
                                    <p><?= $bookmakers['button_text'] ?></p>
                                    <img class="sidebar-container__bookmakers__box__offer__arrow" src="<?= get_template_directory_uri() . '/assets/images/arrow-right.svg' ?>" alt="arrow-right" />
                                </span>
                                <div class="sidebar-container__bookmakers__box__offer__text-under">
                                    <p><?= $bookmakers['text_under_button'] ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="sidebar-container__bookmakers__warning">
                            <p><?= $bookmakers['privacy_text'] ?></p>
                        </div>
                    </div>
                </a>
            <?php else : ?>
                <a href="javascript:void(0);" class="openModalBtn" style="color:<?= $bookmakers["font_color"]; ?>">
                    <div class="sidebar-container__bookmakers">
                        <div class="sidebar-container__bookmakers__box" style="background-color:<?= $bookmakers['main_color'] ?>">
                            <div class="sidebar-container__bookmakers__box__bookmaker">
                                <?php if ($bookmakers['add_label'] == true) : ?>
                                    <span class="sidebar-container__bookmakers__box__bookmaker__label" style="background-color:<?= $bookmakers['label_color'] ?>">
                                        <p><?= $bookmakers['label_text'] ?></p>
                                    </span>
                                <?php endif; ?>
                                <div class="sidebar-container__bookmakers__box__bookmaker__group">
                                    <div style="background-color:<?= $bookmakers['main_color'] ?>" class="sidebar-container__bookmakers__box__bookmaker__group__logo">
                                        <?= wp_get_attachment_image($bookmakers['logo'], 'full'); ?>
                                    </div>
                                    <div class="sidebar-container__bookmakers__box__bookmaker__group__stars">
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
                            </div>
                            <div class="sidebar-container__bookmakers__box__offer">
                                <p class="sidebar-container__bookmakers__box__offer__text"><?= $bookmakers['offer'] ?></p>
                                <span class="sidebar-container__bookmakers__box__offer__btn" 
                                    <?= $bookmakers['button_color'] ? 'style="background-color:' .  $bookmakers['button_color'] . '"' : '' ?>>
                                    <p><?= $bookmakers['button_text'] ?></p>
                                    <img class="sidebar-container__bookmakers__box__offer__arrow" src="<?= get_template_directory_uri() . '/assets/images/arrow-right.svg' ?>" alt="arrow-right" />
                                </span>
                                <div class="sidebar-container__bookmakers__box__offer__text-under">
                                    <p><?= $bookmakers['text_under_button'] ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="sidebar-container__bookmakers__warning">
                            <p><?= $bookmakers['privacy_text'] ?></p>
                        </div>
                    </div>
                </a>
        <?php
                $helper::renderMonotizedTemplate($query->posts);
            endif;
        endwhile;
        ?>
    </div>

<?php endif; ?>