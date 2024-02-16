<?php  
    $data = get_field('todays_bets');
    $country_code= getCountryCode();
?>

<div class="today-bets">
    <div class="today-bets__title">
        <p><?= $data['bets_title'] ?></p>
    </div>
    <div class="today-bets__time-price">
        <p><?= $data['event_time'] ?></p>
        <?= $data['event_time'] && $data['event_fee'] ? '|' : '' ?>
        <p><?= $data['event_fee'] ?></p>
    </div>
    <div class="today-bets__box">
        <div class="today-bets__box__title-price">
            <p><?= $data['inner_box_title'] ?></p>
            <p><?= $data['bet'] ?></p>
        </div>
        <div class="today-bets__box__image">
            <?= wp_get_attachment_image( $data['bookmaker_logo'], 'full'); ?>
        </div>
        <div class="today-bets__box__inner-box">
            <?php if(is_array($data['match_odds'])):
                foreach($data['match_odds'] as $match_data): ?>
                    <div class="today-bets__box__inner-box__content">
                        <p class="today-bets__box__inner-box__content__match"><?= $match_data['match'] ?></p>
                        <p class="today-bets__box__inner-box__line">
                            <?= $match_data['match'] ? (($match_data['country_odds'] || $match_data['bet_price']) ? '–' : '') : '' ?>
                        </p>
                        <div class="today-bets__box__inner-box__odds">
                            <?php 
                                if (is_array($match_data['country_odds'])) :
                                    $country_codes = array_column($match_data['country_odds'], 'country_code');
                                    if (array_search($country_code, $country_codes) !== false && !is_null($country_code)) : 
                                        $country_odds = $match_data['country_odds'][array_search($country_code, $country_codes)];
                            ?>
                                        <a href="<?= $country_odds['odd']['url'] ?>">
                                            <p><?= $country_odds['odd']['title'] ?></p>
                                        </a>
                            <?php   else :
                                        $country_odds = $match_data['country_odds'][0];
                            ?>
                                        <a href="<?= $country_odds['odd']['url'] ?>">
                                            <p><?= $country_odds['odd']['title'] ?></p>
                                        </a>
                            <?php   endif;
                                endif;
                            ?>
                            <p><?= $match_data['bet_price'] ?></p>
                        </div>
                    </div>
                <?php endforeach;
            endif ?>
        </div>
            
        <div class="today-bets__box__betting">
            <p class="today-bets__box__betting__price"><?= $data['betting_price'] ?></p>
            <a href="<?= $data['betting_button_link'] ?>">
                <p><?= $data['betting_button_title'] ?></p>
            </a>
            <p class="today-bets__box__betting__terms"><?= $data['terms'] ?></p>
        </div>
    </div>
    <div class="today-bets__outter">
        <p><?= $data['outter_box_text'] ?></p>
    </div>
</div>