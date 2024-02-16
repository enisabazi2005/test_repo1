<?php
global $ga_post_slug;
$helper = \Bettingpro\Includes\Helper::getInstance();
$query = $template_params['toplist'];
$posts = $query->get_posts();
if ( isset( $_GET["source"] ) || ! empty( $_GET["source"] ) ) {
	$source = $_GET["source"];
	$lp     = '?source=' . $source . '';
} else {
	$ppc_parameter = get_field( 'ppc_parameter' );
	if ( ! empty( $ppc_parameter ) ) {
		$lp = '?ppc=' . $ppc_parameter . '';
	} else {
		$lp = '';
	}
}

$is_ppc = is_page() && wp_get_post_parent_id( get_the_ID() );
?>

<?php
    $url_path = get_the_permalink();
    $pos = 1;
    $bookmaker_position = 0;

while ( $query->have_posts() ) {
    $query->the_post();
    $bookmaker_id = get_the_ID();
    $param = get_parram( $bookmaker_id, $attrs['id'] );
    $title = get_the_title( $bookmaker_id );
    $title = str_replace( ' Review', '', $title );
    $event_category = 'Special Offers';
    $event_label = 'TopList';
    $page_title = get_the_title().' - '.get_option('blogname');
    $experiment_id = '';
    $environment = 'Prod';
    $bookmaker_info = get_field('main_info', $bookmaker_id);
    $toplist_go_link = $query->post->toplist_go_link;
    $toplist_terms_link = $query->post->toplist_terms_and_conditions_link;
    $toplist_offer = $query->post->toplist_special_offer;

    if($toplist_go_link){
        $link = $toplist_go_link;
    }
    else if (function_exists('get_country_depended_bookmaker_link')) {
        $link = get_country_depended_bookmaker_link($bookmaker_id);

    } else {
        $link = $bookmaker_info['link'];
    }


    $main_info = get_field( 'main_info' );
    $bookie_post_filters = wp_get_post_terms($bookmaker_id, 'bookmaker_filters', array('fields' => 'all'));

    if($toplist_go_link){
        $link = $toplist_go_link;
    }
    else if (function_exists('get_country_depended_bookmaker_link')) {
        $link = get_country_depended_bookmaker_link($bookmaker_id);

    } else {
        $link = $bookmaker_info['link'];
    }

    $bookie_class = 'bookmaker-row';


    if (empty($main_info['highlight_phrase']) ) {
        $bookie_class .= ' exclusive';
    }

    $data_filters = '';

    if ( !empty( $bookie_post_filters ) ){
        foreach ( $bookie_post_filters as $filter){
            $data_filters .= ' ' . $filter->slug;
        }
    }
    if(isset($main_info['rank'])){
        $rank = $main_info['rank'];
    }

    $gtm_params = array(
        'brand' => get_the_title(),
        'brand_slug' => get_post_field( 'post_name', $bookmaker_id ),
        'position' => $bookmaker_position,
        'placement' => 'Toplist',
        'rating' => $rank,
    );
    if(!$main_info['demonotized_bookmaker']): ?>
        <div class="<?php echo $bookie_class; ?>">
            <div class="bookmaker-row__holder" id="row-holder"
                <?php if ( !empty($main_info['highlight_phrase'])) {
                    echo "data-title='" . $main_info['highlight_phrase'] . "'";
                } ?>>

                <?php
                if(isset($main_info['logo'])){
                    $logo = $main_info['logo'];
                }    
                
                if ( ! empty( $logo ) ) {
                    ?>
                    <a href="<?php echo $link; ?>"
                    class="bookmaker-offers__logo"
                    target="_blank"
                    rel="noopener noreferrer nofollow"
                    data-aqa="row__go-link"
                    data-position="<?php echo $pos ?>"
                    data-click-text="Claim Bonus"
                    data-rating="<?php echo $rank ?>"
                    data-op-name="<?php echo get_the_title() ?>"
                    data-click-link="<?php echo $bookmaker_info['link'] ?>"
                    data-url-path="<?php echo $url_path ?>"
                    data-page-title="<?php echo $page_title ?>"
                    data-eventlabel="<?php echo $event_label ?>"
                    data-experiment-id="<?php echo $experiment_id ?>"
                    data-site-environment="<?php echo $environment ?>"
                        <?php
                        if( $main_info['main_color'] ){
                            ?>
                            style="background-color: <?php echo $main_info['main_color']; ?>;"
                            <?php
                        }else{
                            ?>
                            style="background-color: grey;"
                            <?php
                        }
                        ?>
                        <?php echo get_gtm_string($gtm_params, 'logo') ?>
                        >
                        <?php 
                            $logoSrc = wp_get_attachment_image_src($logo, 'full')[0];
                        ?>
                            <span class="img-holder">
                                <img src="<?= $logoSrc ?>"
                                    alt="Logo"/>
                            </span>
                    </a>
                    <?php
                } ?>
                <a href="<?php echo $link; ?>"
                class="bookmaker-offers__info"
                target="_blank"
                rel="noopener noreferrer nofollow"
                data-aqa="row__go-link"
                data-position="<?php echo $pos ?>"
                data-click-text="Claim Bonus"
                data-rating="<?php echo $bookmaker_info['rank'] ?>"
                data-op-name="<?php echo get_the_title() ?>"
                data-click-link="<?php echo $bookmaker_info['link'] ?>"
                data-url-path="<?php echo $url_path ?>"
                data-page-title="<?php echo $page_title ?>"
                data-eventlabel="<?php echo $event_label ?>"
                data-experiment-id="<?php echo $experiment_id ?>"
                data-site-environment="<?php echo $environment ?>"
                <?php echo get_gtm_string($gtm_params, 'info') ?>
                >
                    <span class="name"><?php the_title(); ?></span>
                    <?php
                    $bonuses = wp_get_post_terms( $bookmaker_id, 'bookmaker_bonuses', array( 'fields' => 'all' ) );
                    if ( ! empty( $bonuses ) ) {
                        ?>
                        <ul class="mark mark-list">
                            <?php
                            foreach ( $bonuses as $bonus ) {
                                $icon = get_field( 'icon', $bonus->taxonomy . '_' . $bonus->term_id );
                                ?>
                                <li class='mark-list-bonuses'>
                                    <svg class="<?php echo $icon; ?>"><use xlink:href="<?php echo BP_DIRECTORY_URI; ?>/assets/build/img/sprite.svg#<?php echo $icon; ?>"></use></svg>
                                    <?php echo $bonus->name; ?>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                        <?php
                    }
                    $main_info = get_field( 'main_info' );
                    if ($toplist_offer) {
                        ?>
                        <span class="text"><?php echo $toplist_offer ?></span>
                        <?php
                    } elseif($main_info['short_description']){ ?>
                        <span class="text"><?php echo $main_info['short_description'] ?></span>
                    <?php } 

                    $features = wp_get_post_terms( $bookmaker_id, 'bookmaker_features', array( 'fields' => 'all' ) );
                    if( !empty( $features ) ){
                        ?>
                        <ul class="bookmaker bookmaker-offers__tags">
                            <?php
                            foreach ( $features as $feature ) {
                                ?>
                                <li><?php echo $feature->name; ?></li>
                                <?php
                            }
                            ?>
                        </ul>
                        <?php
                    }
                    ?>
                </a>
                <div class="bookmaker-offers__link">
                    <div class="bookmaker-offers__score">
                        <div class="score-text">
                            <?php
                            $rank = floatval( $main_info['rank'] ) * 2;
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
                            <strong class="value"><?php echo $grade; ?></strong>
                            <a href="<?php echo get_the_permalink() ?>" class="review-link"><?php _e( 'Review', 'bettingpro' );?></a>
                        </div>
                        <div class="score-box">
                            <span class="score-box__rating">
                                <?php echo floatval( $main_info['rank'] ) * 2; ?>
                            </span>
                            <?php _e( 'Our Score', 'bettingpro' );?>
                        </div>
                    </div>
                    <a href="<?php echo $link; ?>"
                    class="bookmaker-offer__btn"
                    target="_blank"
                    rel="noopener noreferrer nofollow"
                    data-aqa="row__go-link"
                    data-position="<?php echo $pos ?>"
                    data-click-text="Claim Bonus"
                    data-rating="<?php echo $bookmaker_info['rank'] ?>"
                    data-op-name="<?php echo get_the_title() ?>"
                    data-click-link="<?php echo $bookmaker_info['link'] ?>"
                    data-url-path="<?php echo $url_path ?>"
                    data-page-title="<?php echo $page_title ?>"
                    data-eventlabel="<?php echo $event_label ?>"
                    data-experiment-id="<?php echo $experiment_id ?>"
                    data-site-environment="<?php echo $environment ?>"
                    <?php echo get_gtm_string($gtm_params, 'claim offer'); ?>
                    >
                        <?php _e( 'Claim Offer', 'bettingpro'); ?>
                    </a>
                </div>
            </div>
            <?php
            if( $main_info['privacy_text'] ){
                ?>
                <div class="bookmaker-offers__addtext">
                    <a href="<?php echo $toplist_terms_link ?>" target="_blank"><?php echo $main_info['privacy_text']; ?></a>
                </div>
                <?php
            }
            ?>
        </div>
    <?php else: ?>
        <div class="bookmaker-row__holder" id="row-holder"
            <?php if ( !empty($main_info['highlight_phrase'])) {
                echo "data-title='" . $main_info['highlight_phrase'] . "'";
            } ?>>

            <?php
            if(isset($main_info['logo'])){
                $logo = $main_info['logo'];
            }    
            
            if ( ! empty( $logo ) ) {
                ?>
                <div href="javascript:void(0);"
                    class="bookmaker-offers__logo openModalBtn"
                    target="_blank"
                    data-click-text="Claim Bonus"
                    <?php
                    if( $main_info['main_color'] ){
                        ?>
                        style="background-color: <?php echo $main_info['main_color']; ?>;"
                        <?php
                    }else{
                        ?>
                        style="background-color: grey;"
                        <?php
                    }
                    ?>
                    <?php echo get_gtm_string($gtm_params, 'logo') ?>
                    >
                    <?php 
                        $logoSrc = wp_get_attachment_image_src($logo, 'full')[0];
                    ?>
                        <span class="img-holder">
                            <img src="<?= $logoSrc ?>" alt="Logo"/>
                        </span>
                </div>
                <?php
            } ?>
            <a href="javascript:void(0);"
                class="bookmaker-offers__info openModalBtn"
                data-click-text="Claim Bonus"
            >
                <span class="name"><?php the_title(); ?></span>
                <?php
                $bonuses = wp_get_post_terms( $bookmaker_id, 'bookmaker_bonuses', array( 'fields' => 'all' ) );
                if ( ! empty( $bonuses ) ) {
                    ?>
                    <ul class="mark mark-list">
                        <?php
                        foreach ( $bonuses as $bonus ) {
                            $icon = get_field( 'icon', $bonus->taxonomy . '_' . $bonus->term_id );
                            ?>
                            <li class='mark-list-bonuses'>
                                <svg class="<?php echo $icon; ?>"><use xlink:href="<?php echo BP_DIRECTORY_URI; ?>/assets/build/img/sprite.svg#<?php echo $icon; ?>"></use></svg>
                                <?php echo $bonus->name; ?>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>
                    <?php
                }
                $main_info = get_field( 'main_info' );
                if ($toplist_offer) {
                    ?>
                    <span class="text"><?php echo $toplist_offer ?></span>
                    <?php
                } elseif($main_info['short_description']){ ?>
                    <span class="text"><?php echo $main_info['short_description'] ?></span>
                <?php } 

                $features = wp_get_post_terms( $bookmaker_id, 'bookmaker_features', array( 'fields' => 'all' ) );
                if( !empty( $features ) ){
                    ?>
                    <ul class="bookmaker bookmaker-offers__tags">
                        <?php
                        foreach ( $features as $feature ) {
                            ?>
                            <li><?php echo $feature->name; ?></li>
                            <?php
                        }
                        ?>
                    </ul>
                    <?php
                }
                ?>
            </a>
            <div class="bookmaker-offers__link">
                <div class="bookmaker-offers__score">
                    <div class="score-text">
                        <?php
                        $rank = floatval( $main_info['rank'] ) * 2;
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
                        <strong class="value"><?php echo $grade; ?></strong>
                        <a href="<?php echo get_the_permalink() ?>" class="review-link"><?php _e( 'Review', 'bettingpro' );?></a>
                    </div>
                    <div class="score-box">
                        <span class="score-box__rating">
                            <?php echo floatval( $main_info['rank'] ) * 2; ?>
                        </span>
                        <?php _e( 'Our Score', 'bettingpro' );?>
                    </div>
                </div>
                <a href="javascript:void(0);"
                    class="bookmaker-offer__btn openModalBtn"
                    data-click-text="Claim Bonus"
                >
                    <?php _e( 'Claim Offer', 'bettingpro'); ?>
                </a>
            </div>
        </div>
        <?php
            $helper::renderMonotizedTemplate($posts);
        endif;
        $pos ++;
}
wp_reset_postdata();
?>
