<?php
$helper = \Bettingpro\Includes\Helper::getInstance();
$module         = get_sub_field( 'block_latest_offers' );
$pos            = 1;
$event_category = 'Special Offers';
$event_label    = 'TopList';
$url_path       = get_the_permalink();
$page_title     = get_the_title() . ' - ' . get_option( 'blogname' );
$experiment_id  = '';
$environment    = 'Prod';
if ($module['offers']) {
    if (! empty( $module['offers'] )) {
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
            $module['offers'] = wp_list_pluck( $bookies_filtered->posts, 'ID' );
        } else {
            $module['offers'] = array();
        }
    } else {
        $module['offers'] = array();
    }
    if (! empty( $module['offers'] )) {
        ?>
        <div class="module last-offers">
            <div class="title-block">
                <span class="title-block_text"><?php echo $module['title'] ?></span>
            </div>
            <div class="bookmakers">
                <?php
                foreach ($module['offers'] as $key => $offer_id) {
                    $bookmaker_info = get_field( 'main_info', $offer_id );
                    if (function_exists( 'get_country_depended_bookmaker_link' )) {
                        $link = get_country_depended_bookmaker_link( $offer_id );
                    } else {
                        $link = $bookmaker_info['link'];
                    }
                    $gtm_params = array(
                        'brand'      => get_the_title( $offer_id ),
                        'brand_slug' => get_post_field( 'post_name', $offer_id ),
                        'position'   => $key + 1,
                        'placement'  => 'Sidebar toplist',
                        'rating'     => $bookmaker_info['rank']
                    );
                    if(!$bookmaker_info['demonotized_bookmaker']):
                    ?>
                    <div class="bookmaker_holder">
                        <a href="<?php echo $link; ?>"
                           target="_blank"
                           rel="noopener noreferrer nofollow"
                           class="bookmaker_card"
                           data-aqa="row__go-link"
                           data-click-text="Claim Bonus"
                           data-op-name="<?php echo get_the_title( $offer_id ) ?>"
                           data-click-link="<?php echo $bookmaker_info['link'] ?>"
                           data-url-path="<?php echo $url_path; ?>"
                           data-page-title="<?php echo $page_title ?>"
                           data-eventlabel="<?php echo $event_label ?>"
                           data-experiment-id="<?php echo $experiment_id ?>"
                           data-site-environment="<?php echo $environment ?>"
                            <?php echo get_gtm_string( $gtm_params, 'box link' ) ?>
                        >
                            <?php
                            if ($bookmaker_info['add_label']) {
                                ?>
                                <div class="bookmaker_label"
                                     style="background: <?php echo $bookmaker_info['label_color'] ?>;">
                                    <div class="bookmaker_label-text"><?php echo $bookmaker_info['label_text'] ?></div>
                                </div>
                                <?php
                            }
                            ?>
                            <div class="bookmaker_card-holder">
                                <div class="bookmaker_card-left">
                                    <div class="bookmaker_logo"
                                         style="background: <?php echo $bookmaker_info['main_color'] ?>;">
                                        <?php
                                        $alt_text = $bookmaker_info['logo'] ? $bookmaker_info['logo'] : get_the_title( $offer_id );
                                        echo wp_get_attachment_image( $bookmaker_info['logo']);
                                        ?>
                                    </div>
                                    <div class="rating">
                                        <ul class="rating_list">
                                            <?php
                                            $starRating = doubleval($bookmaker_info['rank']);
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
                                        </ul>
                                    </div>
                                </div>
                                <div class="bookmaker_card-right">
                                    <h3 class="bookmaker_title"><?php echo $bookmaker_info['offer']; ?></h3>
                                    <div class="bookmaker_info">
                                        <span class="btn_fake"><?php echo $bookmaker_info['button_text']; ?></span>
                                        <p
                                            class="bookmaker_info-note"><?php echo $bookmaker_info['text_under_button']; ?></p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <div class="bookmaker_note"><?php echo $bookmaker_info['privacy_text']; ?></div>
                    </div>
                    <?php else: ?>
                        <div class="bookmaker_holder">
                        <a href="javascript:void(0);"
                           rel="noopener noreferrer nofollow"
                           class="bookmaker_card openModalBtn"
                           data-aqa="row__go-link"
                           data-click-text="Claim Bonus"
                           data-op-name="<?php echo get_the_title( $offer_id ) ?>"
                           data-click-link="<?php echo $bookmaker_info['link'] ?>"
                           data-url-path="<?php echo $url_path; ?>"
                           data-page-title="<?php echo $page_title ?>"
                           data-eventlabel="<?php echo $event_label ?>"
                           data-experiment-id="<?php echo $experiment_id ?>"
                           data-site-environment="<?php echo $environment ?>"
                            <?php echo get_gtm_string( $gtm_params, 'box link' ) ?>
                        >
                            <?php
                            if ($bookmaker_info['add_label']) {
                                ?>
                                <div class="bookmaker_label"
                                     style="background: <?php echo $bookmaker_info['label_color'] ?>;">
                                    <div class="bookmaker_label-text"><?php echo $bookmaker_info['label_text'] ?></div>
                                </div>
                                <?php
                            }
                            ?>
                            <div class="bookmaker_card-holder">
                                <div class="bookmaker_card-left">
                                    <div class="bookmaker_logo"
                                         style="background: <?php echo $bookmaker_info['main_color'] ?>;">
                                        <?php
                                        $alt_text = $bookmaker_info['logo'] ? $bookmaker_info['logo'] : get_the_title( $offer_id );
                                        echo wp_get_attachment_image( $bookmaker_info['logo']);
                                        ?>
                                    </div>
                                    <div class="rating">
                                        <ul class="rating_list">
                                            <?php
                                            $starRating = doubleval($bookmaker_info['rank']);
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
                                        </ul>
                                    </div>
                                </div>
                                <div class="bookmaker_card-right">
                                    <h3 class="bookmaker_title"><?php echo $bookmaker_info['offer']; ?></h3>
                                    <div class="bookmaker_info">
                                        <span class="btn_fake"><?php echo $bookmaker_info['button_text']; ?></span>
                                        <p
                                            class="bookmaker_info-note"><?php echo $bookmaker_info['text_under_button']; ?></p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <div class="bookmaker_note"><?php echo $bookmaker_info['privacy_text']; ?></div>
                    </div>
                    <?php
                    $post_objects = [];
                    foreach ($module['offers'] as $post_id) {
                        $post = get_post($post_id);
                        
                        if ($post) {
                            $post_objects[] = $post;
                        }
                    }

                    $helper::renderMonotizedTemplate($post_objects);
                    endif;
                }
                ?>
            </div>
        </div>
        <?php
    }

}
