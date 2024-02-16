<?php
    get_header();
    $blocks = new \Bettingpro\Includes\DisplayBlocks ( $post->post_content );
    $helper = \Bettingpro\Includes\Helper::getInstance();
    $author_name = get_the_author();
    $author_link = get_author_posts_url( get_the_author_meta( 'ID' ) );
    $author_avatar = get_avatar( get_the_author_meta( 'ID' ));
    $author_desc = get_the_author_meta('description') ?? '';
    $author_instagram = get_the_author_meta( 'instagram');
    $author_youtube = get_the_author_meta( 'youtube');
    $author_linkedin = get_the_author_meta( 'linkedin');
    $author_facebook = get_the_author_meta( 'facebook');
    $author_pinterest = get_the_author_meta( 'pinterest');
    $author_web = get_the_author_meta( 'user_url');
    $author_twitter = get_the_author_meta( 'twitter');
?>
<?php
    $bookmaker_child = get_field('child_bookmaker_page');
    $bookmaker_review = get_field('review') ?? get_field('review_fields');
    $bookmaker_main = get_field('main_info');
    $show_featured_image = get_field('show_featured_image_in_view');
    global $post;

if ( has_block( 'acf/takeover' ) ):
    $blocks->display_blocks(['acf/takeover']);
endif;
?>
<div class="breadcrumbs container">
    <?php
        if ( function_exists('yoast_breadcrumb') && !is_front_page() ) {
            yoast_breadcrumb( '<p id="breadcrumbs" class="wrapper">','</p>' );
        }
    ?>
</div>
<div class="container">
    <div class="wrapper">
        <h1 class="page-title"><?= $post->post_title ?? $bookmaker_review['page_title'] ?></h1>
    </div>
</div>
<div class="container">
    <?php if ( has_block( 'acf/ad-banner' ) ) { ?>
        <div class="wrapper">
            <?php $blocks->single_block('acf/ad-banner'); ?>
        </div>
    <?php } ?>
    <?php
        if($bookmaker_child):
            $helper::displaySection('author-section-top');
        endif;?>
</div>

<?php if ( ! $bookmaker_child): 
    $helper::displaySection('bookmaker-banner');?>
    <div class="container">
        <?php $helper::displaySection('author-section-top'); ?>
    </div>
    <div class="container">
        <?php 
            if($bookmaker_review['show_pros_and_cons']== true):
                $helper::displaySection('bookmaker-comparison');
            endif; 
        ?>
    </div>
<?php endif; ?>

<div class="container">
    <div class="wrapper">
        <div class="bookmaker-review-container">
            <?php if($bookmaker_child && $show_featured_image): ?>
                <figure class="child-bookmaker-thumbnail">
                    <?= get_the_post_thumbnail(); ?>   
                </figure>
            <?php endif; ?>
            <?php $blocks->display_blocks([]); ?>
            <?php $bookmaker_bonus = isset($bookmaker_review['show_bonus_button']) ? $bookmaker_review['show_bonus_button'] : '';
            if($bookmaker_bonus): ?>
                <div class="bookmaker-button">
                    <h2 class="bookmaker-button__main-text">
                        <?= $bookmaker_review['bonus_button_main_text'] ?>
                    </h2>
                    <?php if(!$bookmaker_main['demonotized_bookmaker']): ?>
                        <a href="<?= $bookmaker_review['bonus_button_link'] ?>" target="_blank">
                            <p><?= $bookmaker_review['bonus_button_title'] ?></p>
                        </a>
                    <?php else: ?>
                        <a href="javascript:void(0);" class="link openModalBtn">
                            <p><?= $bookmaker_review['bonus_button_title'] ?></p>
                        </a>
                    <?php 
                        $helper::renderMonotizedTemplate([]);
                        endif;
                    ?>
                    <p class="bookmaker-button__under-text">
                        <?= $bookmaker_review['bonus_button_text'] ?>
                    </p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<?php
    $current_site_details = get_blog_details( get_current_blog_id() );
    $country = $current_site_details->path;
    if($country == '/usa/'):

        $terms = get_the_terms($post->ID, 'geo_location');
        $state = '';

        if ( isset($_SERVER["HTTP_X_CM_GEOIP_STATE"])) {
            $state = $_SERVER["HTTP_X_CM_GEOIP_STATE"];
            $stateName = $_SERVER["HTTP_CF_REGION"];
            
        }
        if (isset($_COOKIE['bpstate']) && isset($_COOKIE['bpname'])) { 
            $state = $_COOKIE["bpstate"];
            $stateName = $_COOKIE["bpname"];
        }

        $matchFound = false; // Variable to track if a match is found

        foreach ($terms as $term) {
            if ($term->slug == strtolower($state)) {
                $matchFound = true;
                break; // Exit the loop once a match is found
            }
        }

        if ($matchFound) {
            $textShow = __('Match: This operator is currently available in ', 'bettingpro') . strtoupper($stateName) . ' USA.';
        } else {
            $textShow = __('Not match: This operator is currently unavailable in ', 'bettingpro') . strtoupper($stateName) . ' USA.';
        }
?>

    <?php if(!empty($textShow)): ?>
        <div class="container">
            <div class="wrapper">
                <div class="text-match">
                    <h1>
                        <?php echo $textShow; ?>
                    </h1>
                </div>
            </div>
        </div>
    <?php endif; ?>

<?php endif; ?>

<div class="container">
    <address class="single-tips__footer-author-box wrapper">
        <div class="single-tips__footer-author-box__social">
            <div class="single-tips__footer-author-box__social__avatar">
                <?= $author_avatar ?>
            </div>
            <div class="single-tips__footer-author-box__social__social-links">
                <?php if ($author_youtube): ?>
                    <a target="_blank" rel="nofollow" href="<?= $author_youtube ?>" class="social-profile">
                        <svg><use xlink:href="<?php echo get_stylesheet_directory_uri(); ?>/assets/build/img/sprite.svg#youtube"></use></svg>
                    </a>
                <?php endif; ?>
                <?php if ($author_linkedin): ?>
                    <a target="_blank" rel="nofollow" href="<?= $author_linkedin ?>" class="social-profile">
                        <svg><use xlink:href="<?php echo get_stylesheet_directory_uri(); ?>/assets/build/img/sprite.svg#linkedin"></use></svg>
                    </a>
                <?php endif; ?>
                <?php if ($author_facebook): ?>
                    <a target="_blank" rel="nofollow" href="<?= $author_facebook ?>" class="social-profile">
                        <svg><use xlink:href="<?php echo get_stylesheet_directory_uri(); ?>/assets/build/img/sprite.svg#facebook"></use></svg>
                    </a>
                <?php endif; ?>
                <?php if ($author_pinterest): ?>
                    <a target="_blank" rel="nofollow" href="<?= $author_pinterest ?>" class="social-profile">
                        <svg><use xlink:href="<?php echo get_stylesheet_directory_uri(); ?>/assets/build/img/sprite.svg#pinterest"></use></svg>
                    </a>
                <?php endif; ?>
                <?php if ($author_web): ?>
                    <a target="_blank" rel="nofollow" href="<?= $author_web ?>" class="social-profile">
                        <svg><use xlink:href="<?php echo get_stylesheet_directory_uri(); ?>/assets/build/img/sprite.svg#website"></use></svg>
                    </a>
                <?php endif; ?>
                <?php if ($author_twitter): ?>
                    <a target="_blank" rel="nofollow" href="<?= $author_twitter ?>" class="social-profile">
                        <svg><use xlink:href="<?php echo get_stylesheet_directory_uri(); ?>/assets/build/img/sprite.svg#twitter"></use></svg>
                    </a>
                <?php endif; ?>
                <?php if ($author_instagram): ?>
                    <a target="_blank" rel="nofollow" href="<?= $author_instagram ?>" class="social-profile">
                        <svg><use xlink:href="<?php echo get_stylesheet_directory_uri(); ?>/assets/build/img/sprite.svg#instagram"></use></svg>
                    </a>
                <?php endif; ?>
            </div>
        </div>
        <div class="single-tips__footer-author-box__details">
            <div class="single-tips__footer-author-box__details__display-name">
                <a href="<?= $author_link; ?>" rel="author">
                    <span><?= $author_name; ?></span>
                </a>
            </div>
            <p class="single-tips__footer-author-box__details__description"><?= $author_desc; ?></p>
            <div class="single-tips__footer-author-box__details__button">
                <a href="<?= $author_link; ?>" class="single-tips__footer-author-box__details__button" rel="author">
                <?php _e( 'View all posts by', 'bettingpro');?> <span><?= $author_name ?></span>
                </a>
            </div>
            <?php $helper::displaySection('social-sharing'); ?>
        </div>
    </address>
</div>
<?php
get_footer();