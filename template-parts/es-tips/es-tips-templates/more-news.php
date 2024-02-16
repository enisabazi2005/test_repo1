<?php
    $tips = get_field( 'es_tips')['select_es_tips'] ?? '';
    $title = get_field( 'es_tips' )['title'] ?? '';
    global $wpdb;

    $results = $wpdb->get_results("SELECT blog_id FROM wp_blogs WHERE path LIKE '%es%'");
    switch_to_blog((int)$results[0]->blog_id);
?>
<div class="more-tips">
    <div>
        <div class="more-tips__title">
            <span class="more-tips__title__text">
                <?= $title ?>
            </span>
        </div>
        <div class="more-tips__blocks">
            <?php if (is_array( $tips )) :
                foreach ( $tips as $value ) : ?>
                    <div class="more-tips__blocks__block">
                        <div class="more-tips__blocks__block__image">
                            <?= get_the_post_thumbnail( $value, 'thumbnail' ) ?>
                        </div>
                        <div class="more-tips__blocks__block__text">
                        <a
                            href=<?= get_permalink( $value ) ?>
                            class="module_link"
                        >
                            <p class="more-tips__blocks__block__text__title">
                                <?= (strlen(get_the_title( $value )) > 60 ? substr(get_the_title( $value ), 0, 60).'...' : get_the_title( $value ) ) ?>
                            </p>
                        </a>
                        <time datetime="<?= get_the_modified_date( "Y-m-d\TH:i:sP", $value ) ?>" class="more-tips__blocks__block__text__time">
                            <?= get_the_modified_date( "M d, Y h:i A", $value ) ?>
                        </time>
                        </div>
                    </div>
                <?php endforeach; 
            endif; ?>
        </div>
    </div>
</div>
<?php 
    restore_current_blog();
?>