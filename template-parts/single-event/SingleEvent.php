<?php

$single_event = get_field('bet_box_banner');
$country_code= getCountryCode();

$single_event = get_field('bet_box_banner');

        $default_country = $single_event['default_country'];
        $default_link = $single_event['default_link'];
        $locations = $single_event['write_locations'];
        
        $result = "";
        $short_country = "";
        if(is_array($locations)){
            foreach ($locations as $location) {
                $short_country = $location['country_shortcode'];
                if ( $short_country == strtolower($country_code) ) {
                    $result = $location['go_link'];
                }
            }
        }
        ?>
        <section>
            <div class="events__single">
                <article class="events__card event-card">
                    <div class="event-card__body">
                        <div class="event-card__column">
                            <?php if ($single_event['event_title'] != '') : ?>
                                <h3 class="event-card__title">
                               <?php if ($short_country && $result) : ?>
                                    <a href="<?= $result ?>" target="_blank" rel="noreferrer noopener nofollow">
                                    <?php else :?>
                                        <a href="<?= $default_link  ?>" target="_blank" rel="noreferrer noopener nofollow">
                                <?php endif; ?>
                                            <?php echo $single_event['event_title']; ?></h3>
                                     </a>
                                <?php endif; ?>
                            <div class="event-card__info">
                                <?php if ($single_event['kick_off_time'] != '') {
                                    $date = DateTime::createFromFormat('d/m/Y g:i a', $single_event['kick_off_time']);
                                    $now        = new DateTime();
                                    $date_day   = (int) $date->format('d');
                                    $date_month = (int) $date->format('m');
                                    $now_day    = (int) $now->format('d');
                                    $now_month  = (int) $now->format('m');
                                    if ($date_day == $now_day && $date_month == $now_month) {
                                        $day = __('Today', 'bettingpro');
                                    } elseif ($date_day - $now_day == 1 && $date_month == $now_month) {
                                        $day = __('Tomorrow', 'bettingpro');
                                    } else {
                                        $day = $date->format('F d');
                                        $day_diff = $date->diff($now);
                                        if ($day_diff->m < 0) {
                                            $day = __('in', 'bettingpro') . " " . ($day_diff->d) . " " . __(
                                                'days',
                                                'bettingpro'
                                            );
                                        } else {
                                            $day = $date->format('F d');
                                        }
                                    }
                                ?>
                                    <time datetime="<?php echo $date->format('c'); ?>" class="event-card__time">
                                    <?php echo $day; ?> | <?php echo $date->format('G:i'); ?> |
                                    </time>
                                <?php
                                }
                                ?>
                                <?php if ($single_event['event_league'] != '') : ?>
                                    <span class="event-card__category"><?php echo $single_event['event_league']; ?></span>
                                <?php endif; ?>
                            </div>
                            <?php if ($single_event['more_info_text']) : ?>
                                <button class="event-card__more-btn event-card__more-btn_for-desk js-event-more">
                                    <?php echo $single_event['more_info_link']; ?>
                                </button>
                            <?php endif; ?>
                        </div>
                        <?php if ($single_event['result']) : ?>
                            <div class="event-card__column">
                                <?php if ( $short_country && $result) : ?>
                                    <a href="<?= $result ?>" target="_blank" rel="noreferrer noopener nofollow" class="event-card__result">
                                    <?php else :?>
                                        <a href="<?= $default_link  ?>" target="_blank" rel="noreferrer noopener nofollow" class="event-card__result">
                                    <?php endif; ?>
                                    <?php echo $single_event['result']; ?>
                                    
                                    </a>
                            </div>
                        <?php endif; ?>

                        <?php if ($single_event['odds']) : ?>
                            <div class="event-card__column">
                                <?php if ($short_country && $result) : ?>
                                    <a href="<?= $result ?>" target="_blank" rel="noreferrer noopener nofollow" class="event-card__result">
                                    <?php else :?>
                                        <a href="<?= $default_link  ?>" target="_blank" rel="noreferrer noopener nofollow" class="event-card__result">
                                    <?php endif; ?>
                                    <?php echo $single_event['odds']; ?>
                                    </a>
                            </div>
                        <?php endif; ?>

                        <div class="event-card__column">
                            <?php if ($single_event['bet_button_text']) : ?>
                                <?php if ($short_country && $result) : ?>
                                    <a href="<?= $result ?>" target="_blank" rel="noreferrer noopener nofollow" class="event-card__btn">
                                    <?php else :?>
                                        <a href="<?= $default_link  ?>" target="_blank" rel="noreferrer noopener nofollow" class="event-card__btn">
                                    <?php endif; ?>
                                    <?php echo $single_event['bet_button_text']; ?>
                                    </a>
                                <?php endif; ?>
                                <div class="event-card__warning">
                                    <?php echo $single_event['t&cs']; ?>
                                </div>
                                <?php if ($single_event['more_info_text']) : ?>
                                    <button class="event-card__more-btn event-card__more-btn_for-mob js-event-more">
                                        <?php echo $single_event['more_info_link']; ?>
                                    </button>
                                <?php endif; ?>
                        </div>
                    </div>
                    <?php if ($single_event['more_info_text']) : ?>
                        <div class="event-card__description">
                            <?php echo $single_event['more_info_text']; ?>
                        </div>
                    <?php endif; ?>
                </article>
            </div>
        </section>