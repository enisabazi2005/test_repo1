<?php 
    get_header(); 
    global $wp_query;
    $query = $wp_query;
    $helper = \Bettingpro\Includes\Helper::getInstance();
?>

<div id="primary" class="container search-page">
    <h1><?= __('Search results for', 'bettingpro') . ' "' . get_search_query() . '"' ?></h1>
    <?php
    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post(); ?>
    
    <article class="features__block ">
        <div class="features__block__image">
        <?= the_post_thumbnail('medium') ?? '' ?>
        </div>
        <div class="features__block__text">
        <div class="features__block__text__info">
            <time datetime="<?= $helper::getModifiedDate( get_the_ID() , "Y-m-d\TH:i:sP") ?>">
                <?= $helper::getModifiedDate( get_the_ID(), "M d, Y h:i A" ) ?>
            </time>
            <a href="<?= the_permalink(); ?>" alt="<?= the_title(); ?>" class="features__block__text__info__button"><?php _e('Read More', 'bettingpro'); ?></a>
        </div>
        <div class="features__block__text__title">
            <a href="<?= the_permalink(); ?>">
                <h2 class="the_title">
                    <?= the_title(); ?>
                </h2>
            </a>
        </div>
        <div class="features__block__text__desc">
            <?= the_excerpt(); ?>
        </div>
        </div>
    </article>

    <?php
        endwhile;
        ?>
    <?php
        $site_language = get_bloginfo('language');
        $supported_languages = array('es', 'es-CL', 'es-PE', 'es-CO', 'es-MX', 'pt-BR');
        if (in_array($site_language, $supported_languages)) {
            $page = 'pagina';
        } else {
            $page = 'page';
        }
        $pagination_args = [
            'total' => $query->max_num_pages,
            'format'    => $page . '/%#%/',
            'prev_next' => true,
            'prev_text' => __('&laquo; ', 'bettingpro'),
            'next_text' => __(' &raquo;', 'bettingpro'),
            'mid_size'  => 2,
        ];
    ?>
    <div class="paginations">
        <?php echo paginate_links($pagination_args); ?>
    </div>
    <?php
    else :
        echo '<p>' . __('Sorry, no results found.', 'bettingpro') . '</p>';
    endif;

    wp_reset_postdata();
    ?>
</div>

<?php get_footer(); ?>
