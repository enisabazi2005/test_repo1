<?php
$title = get_field('es_tips')['title'] ?? '';
$post_in = get_field('es_tips')['select_latest_es_tips'] ?? '';
$selectedOption = get_field('es_tips')['latest_tips'] ?? '';
$category = get_field('es_tips')['es_tips_categories'] ?? '';

global $wpdb;
$results = $wpdb->get_results("SELECT blog_id FROM wp_blogs WHERE path LIKE '%es%'");

switch_to_blog((int)$results[0]->blog_id);

    $taxq = ($selectedOption == 'defaultLatest' ? [
        [
            'taxonomy' => 'cat_tips',
            'field' => 'term_id',
            'terms' => $category ?? 0,
        ]
    ] : '');

    update_option('posts_per_page', 3);

    $args = [
        'post_type' => 'tips',
        'posts_per_page' => 3,
        'orderby' => (is_array($post_in) ? 'post__in' : 'ASC'),
        'post__in' => $post_in,
        'tax_query' => $taxq,

    ];
    $query = new WP_Query($args);
    update_option('posts_per_page', 50);
    
if($query->have_posts()):
    $taxname = get_the_terms($query->posts[0], 'cat_tips', array('fields' => 'name'));
    $excerpt = get_the_excerpt($query->posts[0]) ?? '';
?>
    <div class="latest-news">
        <div class="title-block tips-title">
            <span class="title-block_text">
                <?= $title ? $title : 'Latest News'; ?>
            </span>
        </div>
        <div class="latest-news__holder">
            <div class="latest-news__holder__article">
                <div class="latest-news__holder__article__image first_image">
                    <?= get_the_post_thumbnail($query->posts[0], 'medium') ?? '' ?>
                </div>
                <div class="latest-news__holder__article__text large_article">
                    <?php if (isset($taxname[0]->name)) : ?>
                        <span class="latest-news__holder__article__text__tag"><?= $taxname[0]->name ?></span>
                    <?php endif; ?>
                    <a href="<?= get_permalink($query->posts[0]) ?? '' ?> ">
                        <p class="latest-news__holder__article__text__title title_first"><?= substr(strip_tags(get_the_title($query->posts[0])), 0, 53) ?? '' ?></p>
                    </a>
                    <p><?= strlen($excerpt) > 250 ? substr($excerpt, 0, 250) . "..." : $excerpt; ?> </p>
                    <div class="latest-news__holder__article__text__info info_first">
                        <time datetime="<?= get_the_modified_date("Y-m-d\TH:i:sP", $query->posts[0]) ?? '' ?>">
                            <?= get_the_modified_date("M d, Y h:i A", $query->posts[0]) ?? '' ?>
                        </time>
                        <p>
                            <a href="<?= get_permalink($query->posts[0]) ?>" alt="<?= get_the_title() ?>"><?php _e('Read More', 'bettingpro'); ?></a>
                        </p>
                    </div>
                </div>
            </div>

            <div class="latest-news__holder__other">
                <div class="latest-news__holder__other__wrapper">
                    <?php
                    foreach ( (array) $query->posts as $key => $post) :
                        if ($key == 0) {
                            continue;
                        }
                        $terms = get_the_terms($post->ID, 'cat_tips');
                        ?>
                        <div class="latest-news__holder__article other_article">
                            <div class="latest-news__holder__article__image">
                                <?= get_the_post_thumbnail($post->ID, 'medium') ?? '' ?>
                            </div>
                            <div class="latest-news__holder__article__text">
                                <?php
                                if (isset($terms[0]->name)) : ?>
                                    <span class="latest-news__holder__article__text__tag"><?= $terms[0]->name ?? '' ?></span>
                                <?php endif; ?>
                                <a href="<?= get_permalink($post->ID) ?? ''  ?> ">
                                    <p class="latest-news__holder__article__text__title"><?= substr(strip_tags(get_the_title($post->ID)), 0, 53) ?? '' ?></p>
                                </a>
                                <div class="latest-news__holder__article__text__info">
                                    <time datetime="<?= get_the_modified_date("Y-m-d\TH:i:sP", $post->ID) ?? '' ?>">
                                        <?= get_the_modified_date("M d, Y h:i A", $post->ID) ?? '' ?>
                                    </time>
                                    <p onclick="mask_a_tag('<?= get_permalink($post->ID); ?>')">
                                        <a href="<?= get_permalink($post->ID) ?>" alt="<?= get_the_title($post->ID) ?>"><?php _e('Read More', 'bettingpro'); ?></a>
                                    </p>
                                </div>
                            </div>
                        </div>
                    <?php
                    endforeach;
                    ?>
                </div>
            </div>
        </div>
    </div>
<?php 
restore_current_blog();
endif;
?>