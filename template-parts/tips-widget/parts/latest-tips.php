<?php 
    $the_post = $query->posts[0];
    $custom_date_tips = get_field('tips_fields', $the_post->ID)['custom_date_tips'] ?? '';
    $taxname = get_the_terms($the_post->ID, 'cat_tips');
    if ($current === 0 ) :
?>
            <div class="latest-news__holder__article">
                <div class="latest-news__holder__article__image first_image">
                    <?=  get_the_post_thumbnail($the_post->ID, 'medium') ?? '' ?>
                </div>
                <div class="latest-news__holder__article__text large_article">
                    <?php if (isset($taxname[0]->name)) : ?>
                        <span class="latest-news__holder__article__text__tag"><?= $taxname[0]->name ?></span>
                    <?php endif; ?>
                    <a href="<?= get_the_permalink($the_post->ID) ?? '' ?> ">
                        <p class="latest-news__holder__article__text__title title_first"><?= substr(strip_tags(get_the_title($the_post->ID)), 0, 53) ?? '' ?></p>
                    </a>
                    <p><?= substr(get_the_excerpt($the_post->ID), 0, 250)?> </p>
                    <div class="latest-news__holder__article__text__info info_first" style="bottom: 5px">
                    <div class="date_wrapper">
                        <img class="stadiumIcon" src="<?= get_template_directory_uri() . '/assets/images/stadium-icon.svg' ?>" alt="search-icon" />
                        <time datetime="<?= $custom_date_tips ?>"><?= $custom_date_tips ?></time>
                     </div>
                        <p>
                            <a href="<?= get_the_permalink($the_post->ID) ?>" alt="<?= get_the_title($the_post->ID) ?>"><?php _e('Read More', 'bettingpro'); ?></a>
                        </p>
                    </div>
                </div>
            </div>
<?php endif ?>