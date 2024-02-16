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
        $blocks->display_blocks(['acf/countdown']);
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
        <h1 class="wrapper page-title"><?php the_title(); ?></h1>
        <?php
            $blocks->single_block("acf/ad-banner");
        ?>
    </div>
    
    <div class="container">
        <?php $helper::displaySection('author-section-top'); ?>
        <div class="flex_container wrapper">
            <div class="content">
                 <div class="tips-featured-image">
                    <?php echo get_the_post_thumbnail(); ?>                    
                </div>
                <?php $blocks->display_blocks([]); ?>
            </div>
            <aside class="sidebar">
                <?php 
                    if (is_active_sidebar('sidebar-best-bookmakers')) :
                        dynamic_sidebar('sidebar-best-bookmakers');
                    endif;
                    $blocks->display_sidebar();
               ?>
            </aside>
        </div>
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
    </div>
<?php get_footer();