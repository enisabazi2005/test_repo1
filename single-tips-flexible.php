<?php
/*
Template Name: Flexible Layout Template
Template Post Type: tips, page, bookmakers
*/

get_header();
$blocks = new \Bettingpro\Includes\DisplayBlocks ( $post->post_content );
$helper = \Bettingpro\Includes\Helper::getInstance();
$blocks_array = $blocks->get_blocks(); 
$has_flexible_content = false; 
$blocks_under = array(); 
$blocks_above = array();
foreach ($blocks_array as $block) {
    if ($block['blockName'] === 'acf/flexible-content') {
        $has_flexible_content = true; 
        continue; 
    }

    if ($has_flexible_content) {
        $blocks_under[] = $block; 
    }else {
        $blocks_above[] = $block; 
    }
}
?>

<?php while (have_posts()) : the_post(); ?>
<?php 
        $show_thumbnail = get_field('tips_fields')['show_featured_image_in_view'];
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
        if ( has_block( 'acf/countdown' ) ) {
            $blocks->display_blocks(['acf/countdown']);
        }
        if ( has_block( "acf/takeover" ) ):
            $blocks->single_block("acf/takeover");
        endif;
        ?>
    <div class="container">
        <?php
            $blocks->single_block("acf/ad-banner");
            if ( has_block( 'acf/takeover' ) ):
                $blocks->display_blocks(['acf/takeover']);
            endif;
        ?>
    </div>
    <div class="breadcrumbs container">
        <?php
            if ( function_exists('yoast_breadcrumb') && !is_front_page() ) {
                yoast_breadcrumb( '<p id="breadcrumbs" class="wrapper">','</p>' );
            }
            ?>
    </div>
    <section class="container">
        <h1 class=" wrapper page-title"><?php the_title(); ?></h1>
        <?php $helper::displaySection('author-section-top'); ?>
    </section>
    <div class="container">
        <?php if ($has_flexible_content) :?>
        <div class="flex_container wrapper">
            <?php if (!empty($blocks_above)) : ?>
                <div class="content">
                    <?php if($show_thumbnail): ?>
                        <div class="tips-featured-image">
                            <?= get_the_post_thumbnail();?>                       
                        </div>
                    <?php endif; ?>
                    <?php foreach ($blocks_above as $block) : ?>
                        <?php  if ($block['blockName'] !== 'acf/ad-banner' && $block['blockName'] !== 'acf/countdown' && $block['blockName'] !== 'acf/tips' && $block['blockName'] !== 'acf/bookmaker-sidebar' && $block['blockName'] !== 'acf/sidebar'  && $block['blockName'] !== 'acf/es-tips') {
                             echo apply_filters('the_content', render_block($block));
                        }
                        if($block['blockName'] === 'acf/tips' || $block['blockName'] === 'acf/es-tips') {
                            echo render_block($block);
                        }?>
                    <?php endforeach; ?>
                </div>
                <aside class="sidebar">
                    <?php
                    if (is_active_sidebar('sidebar-best-bookmakers')) :
                        dynamic_sidebar('sidebar-best-bookmakers');
                    endif;
                    $blocks->display_sidebar();
                    ?>
                </aside>
            <?php endif; ?>
            <?php if (!empty($blocks_under)) : ?>
                <div class="without_sidebar content">
                    <?php foreach ($blocks_under as $block) : ?>
                        <?php  if ($block['blockName'] !== 'acf/ad-banner' && $block['blockName'] !== 'acf/countdown' && $block['blockName'] !== 'acf/tips' && $block['blockName'] !== 'acf/bookmaker-sidebar' && $block['blockName'] !== 'acf/sidebar'  && $block['blockName'] !== 'acf/es-tips') {
                              echo apply_filters('the_content', render_block($block));
                        } 
                        if($block['blockName'] === 'acf/tips' || $block['blockName'] === 'acf/es-tips') {
                            echo render_block($block);
                        }?>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    <?php else : ?>
        <div class="flex_container wrapper">
            <div class="content">
                <?php if($show_thumbnail): ?>
                    <div class="tips-featured-image">
                        <?= get_the_post_thumbnail(); ?>                    
                    </div>
                <?php endif; ?>
                <?php $blocks->display_blocks(''); ?>
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
    <?php endif; ?>
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
    <?php get_template_part('template-parts/related-bets/related-bets'); ?>
<?php endwhile;
get_footer();