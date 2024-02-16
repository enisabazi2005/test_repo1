<?php
    $featured_posts = get_field('articles');
    $step = get_field('step');
    $helper = \Bettingpro\Includes\Helper::getInstance();

    // Check if $featured_posts is a valid array before using implode
    if (is_array($featured_posts)) {
        $posts = implode(',', $featured_posts);
    } else {
        $posts = ''; // Set a default value if $featured_posts is not an array
    }

    $args = [
        'post_type'      => 'how-to-guides', 
        'posts_per_page' => $step,
        'paged'          => 1,
        'orderby'        => 'post__in',
        'post__in'       => $featured_posts
    ];

    $query = new WP_Query( $args );
?>

<?php if ($query->have_posts()) :?>
    <div class="block-guide">
        <div class="module_guide">
            <?php while ($query->have_posts()): 
                $query->the_post(); ?>
                <div class="module">
                    <a href="<?= get_permalink() ?>" class="module__link">
                        <div class="module__link__image">
                        <?= the_post_thumbnail( array( 'thumbnail', 'medium', 'large' ), array( 'sizes' => '(max-width:300) 300px, (max-width:1024) 1024px' ) ); ?>
                        </div>
                        <div class="module__link__text">
                            <span><?= the_title() ?></span>
                        </div>
                    </a>
                    <time datetime="<?= $helper::getModifiedDate(get_the_id(), "Y-m-d\TH:i:sP"); ?>"
                        class="module_modified_date">
                        <?= $helper::getModifiedDate(get_the_id(), "M d, Y h:i A"); ?>
                    </time>
                </div>
            <?php endwhile; ?>
        </div>
        <?php if((int)$step <= count($query->posts)) : ?>
        <div  data-index-number=<?= $step ?> data-sec_number=<?= $posts ?> id="load-more" class="load">
            <div  class="btn-more"><?php _e('Load More', 'bettingpro'); ?></div>
        </div>
        <?php endif; ?>
    </div>
<?php endif;?>