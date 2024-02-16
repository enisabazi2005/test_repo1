<?php get_header(); ?>

<?php 
    $userinfo = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));

    global $wp_query;
    $query = $wp_query;
?>

<div class="author-page container">
    <div class="wrapper">
        <address class="author-page__profile">
            <div class="author-page__profile__avatar">
                <?= get_avatar($userinfo->ID); ?>
            </div>
            <div class="author-page__profile__text">
                <h1><?= $userinfo->display_name; ?></h1>
                <p><?= $userinfo->user_description; ?></p>
            </div>
        </address>
        <div class="author-page__posts">
            <div class="author-page__posts__title">
                <span class="author-page__posts__title__text"><?= $userinfo->display_name.' articles' ?></span>
            </div>
            <?php
                if ( $query->have_posts() ) :
                    while ( $query->have_posts() ) :
                        $query->the_post();
            ?>
                <article class="author-page__posts__post">
                    <div class="author-page__posts__post__thumbnail">
                        <a href="<?= the_permalink() ?>">
                            <?= the_post_thumbnail(); ?>
                        </a>
                    </div>
                    <div class="author-page__posts__post__details">
                        <div class="author-page__posts__post__details__button">
                            <time datetime="<?= the_modified_date("Y-m-d\TH:i:sP") ?>">
                                <?= the_modified_date("M d, Y h:i A") ?>
                            </time>
                            <a href="<?= the_permalink()?>"><?php _e( 'Read More', 'bettingpro');?></a>
                        </div>
                        <div class="author-page__posts__post__details__texts">
                            <a href="<?= the_permalink(); ?>">
                                <h2><?= the_title(); ?></h2>
                            </a>
                            <p><?= the_excerpt(); ?></p>
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
            <?php endif; ?>
        </div>
    </div>
</div>

<?php get_footer(); ?>