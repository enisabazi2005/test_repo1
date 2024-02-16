<?php 
    $module = get_sub_field('block_articles');
    if ($module['is_latest_news']) {
        $articles = new WP_Query( array(
            'posts_per_page' => $module['count'],
            'post_type'   => 'news'
        ));
        $articles = $articles->posts;
    } else {
        $articles = $module['list'];
    }
    $first_post_id = array_shift($articles)->ID;
?>
<section class="modules-holder">
    <div class="module">
        <div class="title-block"><span class="title-block_text"><?= $module['title'] ?></span></div>
        <article class="module_main">
            <a href="<?= get_permalink($first_post_id) ?>" class="module_link">
                <img src="<?= get_the_post_thumbnail_url($first_post_id, 'thumbnail') ?>" alt="<?= get_the_title($first_post_id) ?>">
                <div class="module_text_title"><?= get_the_category($first_post_id)[0]->cat_name ?></div>
            </a>
            <div class="news_article-main">
                <p class="module_text_title"><a href="<?= get_permalink($first_post_id) ?>"><?= get_the_title($first_post_id) ?></a></p>
            </div>
            <div class="news_duo">
                <?php foreach ($articles as $key => $post): ?>
                    <?php $post_id = $post->ID; ?>
                    <article class="news_article--small">
                        <a href="<?= get_permalink($post_id) ?>" class="news_article-img">
                            <img src="<?= get_the_post_thumbnail_url($first_post_id, 'thumbnail') ?>" alt="<?= get_the_title($post_id) ?>">
                        </a>
                        <div class="news_article-main">
                            <p class="module_text_title"><a href="<?= get_permalink($post_id) ?>"><?= get_the_title($post_id) ?></a></p>
                            <time datetime="<?= get_the_date("Y-m-d\TH:i:sP") ?>" class="module_text_time">
                                <?= get_the_date("M d, Y h:i A") ?>
                            </time>
                        </div>
                    </article>
                <?php endforeach; ?>
                <?php wp_reset_postdata(); ?>
            </div>
        </article>
    </div>
</section>