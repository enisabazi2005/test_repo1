<?php 
    global $monetized_bookmakers;
    $bookie_class = 'bookmaker-row';
    $pos = 1;
    $url_path = get_the_permalink();
    $bookmaker_position = 0;
?>
<section id="bookmaker-modal" class="modal">
    <section class="modal-content">
        <div id="closeModalBtn">
            <button>X</button>
        </div>
        <header>
            <?php
            if (get_field('demonotized_template_title', 'options')) :  ?>
                <h3><?=  get_field('demonotized_template_title', 'options'); ?></h3>
            <?php
            endif;
            if(get_field('demonotized_template_description', 'options')):?>
                <p><?=  get_field('demonotized_template_description', 'options'); ?></p>
            <?php
            endif;
            ?>
        </header>
        <section class="cards">
            <?php if (is_array(($monetized_bookmakers))) :
                foreach($monetized_bookmakers as $bookmaker):
                    $event_label = 'TopList';
                    $experiment_id = '';
                    $environment = 'Prod';
                    $page_title = get_the_title($bookmaker->ID);
                    $bookmaker_info = $bookmaker->extra_data;
                    $toplist_go_link = $bookmaker->toplist_go_link;
                    $rank = floatval( $bookmaker_info['rank'] ) * 2;
                    $gtm_params = array(
                        'brand' => get_the_title(),
                        'brand_slug' => get_post_field( 'post_name', $bookmaker->ID ),
                        'position' => $bookmaker_position,
                        'placement' => 'Toplist',
                        'rating' => $bookmaker_info['rank'],
                    );
                    if($toplist_go_link){
                        $link = $bookmaker->toplist_go_link;
                    }
                    else if (function_exists('get_country_depended_bookmaker_link')) {
                        $link = get_country_depended_bookmaker_link($bookmaker->ID);
                
                    } else {
                        $link = $bookmaker_info['link'];
                    }
                    $toplist_offer = $bookmaker->toplist_special_offer;
                ;?>
                <div class="<?= $bookie_class; ?>">
                    <div class="bookmaker-row__holder" id="row-holder"
                        <?php if ( !empty($bookmaker_info['highlight_phrase'])) {
                            echo "data-title='" . $bookmaker_info['highlight_phrase'] . "'";
                        } ?>>

                        <?php
                        if(isset($bookmaker_info['logo'])){
                            $logo = $bookmaker_info['logo'];
                        }    
                        
                        if ( ! empty( $logo ) ) {
                            ?>
                            <a href="<?= $link; ?>"
                            class="bookmaker-offers__logo"
                            target="_blank"
                            rel="noopener noreferrer nofollow"
                            data-aqa="row__go-link"
                            data-position="<?= $pos ?>"
                            data-click-text="Claim Bonus"
                            data-rating="<?= $rank ?>"
                            data-op-name="<?= $bookmaker->post_title ?>"
                            data-click-link="<?= $bookmaker_info['link'] ?>"
                            data-url-path="<?= $url_path ?>"
                            data-page-title="<?= $bookmaker->post_title ?>"
                            data-eventlabel="<?= $event_label ?>"
                            data-experiment-id="<?= $experiment_id ?>"
                            data-site-environment="<?= $environment ?>"
                                <?php
                                if( $bookmaker_info['main_color'] ){
                                    ?>
                                    style="background-color: <?= $bookmaker_info['main_color']; ?>;"
                                    <?php
                                }else{
                                    ?>
                                    style="background-color: grey;"
                                    <?php
                                }
                                ?>
                                <?= get_gtm_string($gtm_params, 'logo') ?>
                                >
                                <?php 
                                    $logoSrc = wp_get_attachment_image_src($bookmaker_info['logo'], 'full')[0];
                                ?>
                                    <span class="img-holder">
                                        <img src="<?= $logoSrc ?>"
                                            alt="Logo"/>
                                    </span>
                            </a>
                            <?php
                        } ?>
                        <a href="<?= $link; ?>"
                            class="bookmaker-offers__info"
                            target="_blank"
                            rel="noopener noreferrer nofollow"
                            data-aqa="row__go-link"
                            data-position="<?= $pos ?>"
                            data-click-text="Claim Bonus"
                            data-rating="<?= $bookmaker_info['rank'] ?>"
                            data-op-name="<?= $bookmaker->post_title ?>"
                            data-click-link="<?= $bookmaker_info['link'] ?>"
                            data-url-path="<?= $url_path ?>"
                            data-page-title="<?= $page_title ?>"
                            data-eventlabel="<?= $event_label ?>"
                            data-experiment-id="<?= $experiment_id ?>"
                            data-site-environment="<?= $environment ?>"
                            <?= get_gtm_string($gtm_params, 'info') ?>
                        >
                        <span class="name"><?= get_the_title($bookmaker->ID); ?></span>

                        <?php
                            if ($toplist_offer) {
                                ?>
                                <span class="text"><?= $toplist_offer ?></span>
                                <?php
                            } elseif($bookmaker_info['short_description']){ ?>
                                <span class="text"><?= $bookmaker_info['short_description'] ?></span>
                            <?php } ?>
                        </a>
                        <div class="bookmaker-offers__link">
                            <div class="bookmaker-offers__score">
                                <div class="score-text">
                                    <?php
                                    $grade = '';
                                    switch ( $rank ){
                                        case $rank<=10 && $rank>=9 : $grade = __('Excellent', 'bettingpro');
                                            break;
                                        case $rank<9 && $rank>=8 : $grade = __('Very Good', 'bettingpro');
                                            break;
                                        case $rank<8 && $rank>=7 : $grade = __('Good', 'bettingpro');
                                            break;
                                        case $rank<7 && $rank>=5 : $grade = __('Average', 'bettingpro');
                                            break;
                                        default : $grade = __('Poor', 'bettingpro');
                                    }
                                    ?>
                                    <strong class="value"><?= $grade; ?></strong>
                                    <a href="<?= get_the_permalink($bookmaker->ID) ?>" class="review-link"><?php _e( 'Review', 'bettingpro' );?></a>
                                </div>
                                <div class="score-box">
                                    <span class="score-box__rating">
                                        <?= floatval( $bookmaker_info['rank'] ) * 2; ?>
                                    </span>
                                    <?php _e( 'Our Score', 'bettingpro' );?>
                                </div>
                            </div>
                            <a href="<?= $link; ?>"
                            class="bookmaker-offer__btn"
                            target="_blank"
                            rel="noopener noreferrer nofollow"
                            data-aqa="row__go-link"
                            data-position="<?= $pos ?>"
                            data-click-text="Claim Bonus"
                            data-rating="<?= $bookmaker_info['rank'] ?>"
                            data-op-name="<?= get_the_title() ?>"
                            data-click-link="<?= $bookmaker_info['link'] ?>"
                            data-url-path="<?= $url_path ?>"
                            data-page-title="<?= $page_title ?>"
                            data-eventlabel="<?= $event_label ?>"
                            data-experiment-id="<?= $experiment_id ?>"
                            data-site-environment="<?= $environment ?>"
                            <?= get_gtm_string($gtm_params, 'claim offer'); ?>
                            >
                                <?php _e( 'Claim Offer', 'bettingpro'); ?>
                            </a>
                        </div>
                    </div>
                    <?php
                    if( $bookmaker_info['privacy_text'] ){
                        ?>
                        <div class="bookmaker-offers__addtext">
                            <p><?= $bookmaker_info['privacy_text']; ?></p>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            <?php
                $pos ++;
                endforeach; 
            endif ; ?>
        </section>
    </section>
</section>

