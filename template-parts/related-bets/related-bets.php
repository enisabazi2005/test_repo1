<?php
    $terms = get_the_terms(get_the_ID(), "cat_tips");
    $id_term = ($terms ? $terms[0]->term_id : false);

    $query = new WP_Query;
    $related_data = $query->query([
        "post_type" => "tips",
        "posts_per_page" => "7",
        "tax_query" => [
            [
                "taxonomy" => "cat_tips",
                "field" => "id",
                "terms" => $id_term
            ]
        ],
    ]);

if (
    !empty($related_data) 
    && get_field("related_bets") == "show"
): ?>
    <div class="container related-bets">
        <h2 class="wrapper">
            <?php _e("Related Tips Articles", "bettingpro") ?>
        </h2>
        <div class="related wrapper">
            <?php foreach($related_data as $key => $value):
                if ($value->ID != get_the_ID()): ?>
                    <div class="related__block">
                        <div class="related__block__image">
                            <?= get_the_post_thumbnail($value->ID); ?>    
                        </div>
                        <div class="related__block__text">
                            <a href="<?= get_post_permalink($value->ID); ?>">
                                <?= get_the_title($value->ID); ?>
                            </a>
                        </div>
                        <p class="related__block__date">
                            <?php _e("By", "bettingpro") ?>
                            <a href="<?= get_author_posts_url($value->post_author) ?>">
                                <?= get_the_author_meta("display_name" ,$value->post_author) ?>
                            </a>
                            <?= " - " . get_the_date("M d, Y h:i A" ,$value->ID); ?>
                        </p>
                    </div>
                <?php endif;
            endforeach; ?>
        </div>
    </div>
<?php endif; ?>
