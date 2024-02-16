<?php
    $post_id = get_the_ID();
    $tips_id = get_field('article_category', $post_id)[0];
    $taxonomy = 'cat_tips';
    $terms = get_the_terms($tips_id, $taxonomy);
    $id_term = $terms[0]->term_id;

    $query = new WP_Query;
    $data = $query->query([
        'post_type' => 'tips',
        'category' => $id_term,
        'tax_query' => [
            [
                'taxonomy' => $taxonomy,
                'field' => 'id',
                'terms' => $id_term
            ]
        ],
        'posts_per_page' => '7'
    ]);
?>
<div class="related-header">
    <h2><?php _e('Next bets', 'bettingpro') ?></h2>
</div>
<?php
    foreach ($data as $key => $value) :
        if ($value->ID != $post_id) : ?>
            <div class="related-card">
                <div class="related-image">
                    <?= get_the_post_thumbnail($value->ID); ?>    
                </div>
                <div class="related-text">
                    <a href="<?php echo get_post_permalink($value->ID);?>">
                        <p><?php echo get_the_title($value->ID) ?></p>
                    </a>
                    <a href="<?= get_post_permalink($value->ID);?>">
                        <div class="related-button">
                            Aposte Agora! <i class="arrow-right"></i>
                        </div>
                    </a>
                </div>
            </div>
        <?php endif;
    endforeach;
?>
