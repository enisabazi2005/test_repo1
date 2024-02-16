<?php 
  $query->the_post();
  $author_id = get_the_author_meta('ID'); 
  $author_name = get_the_author();
  $author_url = get_author_posts_url($author_id);
  $custom_date_tips = get_field('tips_fields', get_the_ID())['custom_date_tips'] ?? '';
?>
<?php  if ($current >= 3 && $current <= 5) { ?>
<li>
    <article>
        <div class="tip_image">
            <?= the_post_thumbnail() ?>
        </div>
        <div class="tip_texts">
            <div class="tip_infos">
                <div class="tip_infos_date">
                    <img  class="stadiumIcon" src="<?= get_template_directory_uri() . '/assets/images/stadium-icon.svg' ?>" alt="search-icon" />
                    <time datetime="<?= $custom_date_tips ?>" class="date"><?=  $custom_date_tips ?></time>
                    <a href="<?= $author_url ?>" class="tip_author"><?php echo esc_html($author_name); ?></a>
                </div>
                <a href="<?= the_permalink(); ?>" class="read_more_tips">
                    <?php _e('Read More', 'bettingpro'); ?>
                </a>
            </div>
            <a class="tip_title" href="<?= the_permalink(); ?>">
                <?php the_title(); ?>
            </a>
            <a href="<?= the_permalink(); ?>" class="read_more_tips_mobile">
                <?php _e('Read More', 'bettingpro'); ?>
            </a>
        </div>
    </article>
</li>
<?php   } ?>