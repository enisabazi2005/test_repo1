<div class="bookmakers">
    <?php
    $bookmakers = get_field( 'bookmakers', 'option' );
    if (! empty( $bookmakers )) {
        $country          = get_country_code();
        $bookies_filtered = new WP_Query( array(
            'post_type' => 'bookmakers',
            'post__in'  => $module['offers'],
            'orderby'   => 'post__in',
            'tax_query' => array(
                array(
                    'taxonomy' => 'geo_location',
                    'field'    => 'slug',
                    'terms'    => $country['countryCode']
                )
            )
        ) );
        if (! empty( $bookies_filtered->posts )) {
            $bookmakers = wp_list_pluck( $bookies_filtered->posts, 'ID' );
        } else {
            $bookmakers = array();
        }
    } else {
        $bookmakers = array();
    }

    if (! empty( $bookmakers )) {
        $bookmakers_section_heading = get_field( 'bookmakers_section_heading', 'option' );
        $pos                        = 1;
        $event_category             = 'Special Offers';
        $event_label                = 'TopList';
        $url_path                   = get_the_permalink();
        $page_title                 = get_the_title() . ' - ' . get_option( 'blogname' );
        $experiment_id              = '';
        $environment                = 'Prod';

        if ($bookmakers_section_heading) {
            ?>
            <div class="title-block"><h2 class="title-block_text"><?php echo $bookmakers_section_heading; ?></h2></div>
            <?php
        }
        ?>

        <div class="bookmaker_rows">
            <?php
            foreach ($bookmakers as $bookmaker) {
                $bookmaker      = get_post( $bookmaker );
                $bookmaker_info = get_field( 'main_info', $bookmaker->ID );
                $bookmaker_img  = $bookmaker_info['logo'];
                ?>
                <div class="bookmaker_wrap">
                    <div class="bookmaker_holder">
                        <div class="bookmaker_card bookmaker_card--big">
                            <?php if
                            ($bookmaker_info['add_label']) {
                                ?>
                                <div class="bookmaker_label"
                                     style="background: <?php echo $bookmaker_info['label_color'] ?>;">
                                    <div class="bookmaker_label-text"><?php echo $bookmaker_info['label_text']; ?></div>
                                </div>
                                <?php
                            }
                            ?>
                            <div class="bookmaker_card-holder">
                                <div class="bookmaker_logo_holder">
                                    <div class="bookmaker_logo--big"
                                         style="background-color: <?php echo $bookmaker_info['main_color'] ?>;">
                                        <img src="<?php echo $bookmaker_img['sizes']['medium']; ?>"
                                             alt="<?php echo( $bookmaker_img['alt'] ? $bookmaker_img['alt'] : $bookmaker->post_title ); ?>">
                                    </div>
                                    <div class="bookmaker_review">
                                        <div class="rating rating--big">
                                            <?php echo $bookmaker->post_title; ?>
                                            <a href="<?php echo get_the_permalink( $bookmaker->ID ); ?>"
                                               class="rating_title"><?php echo $bookmaker->post_title . ' ' . __( 'review',
                                                        'bettingpro' ); ?></a>
                                            <ul class="rating_list">
                                                <?php
                                                for ($x = 1; $x <= $bookmaker_info['rank']; $x ++) {
                                                    echo "<li class=\"rating_list-item icon-star-fill\"></li>";
                                                }
                                                if (strpos( $bookmaker_info['rank'], '.' )) {
                                                    echo "<li class=\"rating_list-item icon-star-half\"></li>";
                                                    $x ++;
                                                }
                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="bookmaker_card-right--big">
                                    <div class="bookmaker_title--big">
                                        <span class="b-title"><?php echo $bookmaker_info['offer']; ?></span>
                                    </div>
                                    <div class="bookmaker_info--big">
                                        <a href="<?php echo $bookmaker_info['link']; ?>" target="_blank"
                                           rel="noopener noreferrer nofollow" class="btn_fake"
                                           data-aqa="row__go-link"
                                           data-position="<?php echo $pos; ?>"
                                           data-click-text="Claim Bonus"
                                           data-rating="<?php echo $bookmaker_info['rank']; ?>"
                                           data-op-name="<?php echo $bookmaker->post_title; ?>"
                                           data-click-link="<?php echo $bookmaker_info['link']; ?>"
                                           data-url-path="<?php echo $url_path; ?>"
                                           data-page-title="<?php echo $page_title; ?>"
                                           data-eventlabel="<?php echo $event_label; ?>"
                                           data-experiment-id="<?php echo $experiment_id; ?>"
                                           data-site-environment="<?php echo $environment; ?>"><?php echo $bookmaker_info['button_text']; ?></a>
                                        <div
                                            class="bookmaker_info-note"><?php echo $bookmaker_info['text_under_button']; ?></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="bookmaker_note"><?php echo $bookmaker_info['privacy_text']; ?></div>
                    </div>
                </div>
                <?php
                $pos ++;
            }
            ?>
        </div>
        <?php
    }
    ?>
</div>
<?php