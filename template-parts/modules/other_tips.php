<?php
    $module = get_sub_field('block_other_tips');
    $tips = $module['list'];
?>
<?php if (isset($tips)):
	global $add_swiper;
	$add_swiper = true;
    ?>
    <section class="remaining-cards">
        <div class="title-block"><h2 class="title-block_text"><?= $module['title'] ?></h2></div>
        <div class="modules-holder swiper-container js-swiper">
            <div class="swiper-wrapper">
                <?php foreach ($tips as $key => $post): ?>
                    <?php
                        $post_id = $post->ID;
                        $attachment_id = get_post_thumbnail_id( $post_id );
                        $small_image = get_the_post_thumbnail_url($post_id, 'thumbnail');
                        $prev_image = wp_get_attachment_image_url( $attachment_id, 'previmage' );
                        $article_category = get_field('article_category', $post_id );
                        $taxonomy = 'cat_tips';
                        if(!empty($article_category[0])){
                            $postId = $article_category[0];
                        }else{
                            $postId = $post_id;
                        }
                        $terms = get_the_terms( $postId, $taxonomy);
                        $categoryName = $terms[0]->name; // display parent category
                    ?>
                    <article class="module swiper-item">
                        <div class="module_main">
                           <a href="<?= get_permalink($post_id) ?>" class="module_link">
                                <div class="module_image">
                                    <?php if ($attachment_id): ?>
                                        <picture>
                                            <?php if ($prev_image): ?>
                                                <source srcset="<?= $prev_image ?>" media="(max-width: 1023px)" />
                                            <?php endif ?>
                                            <source srcset="<?= $small_image ?>" media="(min-width: 1024px)" />
                                            <img width="120" height="120"   src="<?= $small_image ?>" alt="<?= get_the_title($post_id) ?>"/>
                                        </picture>
                                    <?php endif ?>
                                </div>
                                <div class="module_text">
                                    <p class="module_text_title"><?= get_the_title($post_id) ?></p>
                                </div>
                            </a>
                            <time datetime="<?= get_the_modified_date("Y-m-d\TH:i:sP") ?>" class="module_text_time">
                                <?= get_the_modified_date("M d, Y h:i A") ?>
                            </time>
                        </div>
                    </article>
                <?php endforeach ?>
            </div>
            <div class="swiper-pagination"></div>
        </div>
    </section>
<?php endif; ?>
<?php wp_reset_postdata(); ?>