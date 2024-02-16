<?php
    $post_id = get_the_ID();
    $tips_id = get_field("article_category", $post_id)[0];
    $taxonomy = "cat_tips";
    $terms = get_the_terms($tips_id, $taxonomy);
    $id_term = $terms[0]->term_id;

    $query = new WP_Query;
    $related_data = $query->query([
        "post_type" => "tips",
        "category" => $id_term,
        "tax_query" => [
            [
                "taxonomy" => $taxonomy,
                "field" => "id",
                "terms" => $id_term
            ]
        ],
        "posts_per_page" => "7"
    ]);
?>
<div>
    <h2>
        <?php _e("Related Tips Articles", "bettingpro") ?>
    </h2>
</div>
<div class="related">
    <?php if (!empty($related_data)) :
        foreach($related_data as $key => $value):
            if ($value->ID != $post_id) : ?>
                <div class="related__block">
                    <div class="related__block__image">
                        <?= get_the_post_thumbnail($value->ID); ?>    
                    </div>
                    <div class="related__block__text">
                        <a href="<?= get_post_permalink($value->ID); ?>">
                            <h2>
                                <?= get_the_title($value->ID); ?>
                            </h2>
                        </a>
                    </div>
                    <p class="related__block__date">
                        <?php _e("By", "bettingpro") ?>
                        <a href="<?= get_author_posts_url($value->post_author) ?>">
                            <?= get_the_author_meta("display_name" ,$value->post_author) ?>
                        </a>
                        <?= " - ".get_the_date("M d, Y h:i A" ,$value->ID); ?>
                    </p>
                </div>
            <?php endif;
        endforeach;
    endif;?>
</div>