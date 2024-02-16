<?php
    $module = get_sub_field('block_latest_tips');
    $tips = $module['tips'];
    $first_tip = array_shift($tips);
?>
<?php if ($first_tip): ?>
    <section class="latest-tips">
        <div class="modules-holder">
            <article class="module">
                <div class="title-block"><span class="title-block_text"><?= $module['title'] ?></span></div>
                <div class="module_main">
                    <a href="<?= get_permalink($first_tip) ?>" class="module_link">
                        <div class="module_image">
                            <?= get_the_post_thumbnail($first_tip, 'latest_tips') ?>
                        </div>
                        <div class="module_text">
                            <p class="module_text_title"><?= get_the_title($first_tip) ?></p>
                        </div>
                    </a>
                    <time datetime="<?= get_the_modified_date("Y-m-d\TH:i:sP", $first_tip) ?>" class="module_text_time">
                        <?= get_the_modified_date("M d, Y h:i A", $first_tip) ?>
                    </time>
                </div>
            </article>
        </div>
    </section>
<?php endif ?>
<?php if (isset($tips)): ?>
    <section class="top-tips">
        <div class="modules-holder">
            <?php foreach ($tips as $key => $post_id):
                $taxonomy = 'cat_tips';
                $terms = get_the_terms( $post_id, $taxonomy);
                $id_current_category   = $terms[0]->term_id;
                $parents = get_ancestors( $id_current_category, $taxonomy );
                $categoryName = isset( $parents[0] ) ? get_term( $parents[0], $taxonomy)->name : $terms[0]->name;
            ?>
                <div class="module">
                    <div class="title-block"><span class="title-block_text"><?= $categoryName; ?></span></div>
                    <div class="module_main">
                        <a href="<?= get_permalink($post_id); ?>" class="module_link">
                            <div class="module_image">
                                <?= get_the_post_thumbnail($post_id, 'toptips') ?>
                            </div>
                            <div class="module_text">
                                <p class="module_text_title"><?= get_the_title($post_id) ?></p>
                            </div>
                        </a>
                    <time datetime="<?= get_the_modified_date("Y-m-d\TH:i:sP", $post_id) ?>" class="module_text_time">
                        <?= get_the_modified_date("M d, Y h:i A", $post_id) ?>
                    </time>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </section>
<?php endif ?>
<?php wp_reset_postdata(); ?>
