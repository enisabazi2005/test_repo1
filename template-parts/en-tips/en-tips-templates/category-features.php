<?php
  $title = get_field('en_tips')['title'] ?? '';
  $label = get_field('tips_fields')['add_label'] ?? '';
  $steps = get_field('en_tips')['steps'] ?? '';
  $category = get_field('en_tips')['filter_by_categories'] ?? '';
  $skip_posts = get_field('en_tips')['en_skip_posts'] ? 3 : 0;

  $site_details = get_blog_details();

  $results = 1;

  switch_to_blog((int)$results);

    $tips = [
      'post_type' => 'tips',
      'post_status' => 'publish',
      'posts_per_page' => $steps,
      'order'    => 'DSC',
      'offset'  => $skip_posts,
      'tax_query' => array(
        array(
          'taxonomy' => 'cat_tips',
          'field' => 'term_id',
          'terms' => $category ?? 0
        )
      )
    ];
    
    $query = new WP_Query($tips);
  restore_current_blog();
 
  if($query->have_posts()): ?>
  <div>
    <div class="title-block tips-title">
      <span class="title-block_text">
        <?= $title ? $title : 'Features' ?>
      </span>
    </div>
    <section class="features features_en">
      <?php
      foreach ($query->posts as $key => $post) :

        switch_to_blog((int)$results);
        
        if ($key < 3 && is_tax('cat_tips')) {
          continue;
        }
      ?>
        <?php $label ?? ''; ?>
        <div class="features__block ">
          <div class="features__block__image">
            <?= get_the_post_thumbnail($post->ID, 'medium') ?>
            <?php if (!empty($label)) : ?>
              <span class="features__block__image__special_offer">
                <p><?= $label ?? ''; ?></p>
              </span>
            <?php endif; ?>
          </div>
          <div class="features__block__text">
            <div class="features__block__text__info">
              <time datetime="<?= get_the_modified_date("Y-m-d\TH:i:sP", $post->ID) ?>">
                <?= get_the_modified_date("M d, Y h:i A", $post->ID) ?>
              </time>
              <a href="<?= get_permalink($post->ID) ?>" alt="<?= get_the_title($post->ID) ?>" class="features__block__text__info__button"><?php _e('Read More', 'bettingpro'); ?></a>
            </div>
            <div class="features__block__text__title">
              <a href="<?= get_permalink($post->ID) ?>"><?= get_the_title($post->ID); ?></a>
            </div>
            <div class="features__block__text__desc">
              <p><?= get_the_excerpt($post->ID) ?></p>
            </div>
          </div>
        </div>
      <?php restore_current_blog();
      endforeach;
      ?>
    </section>

    <?php if ((int)$steps <= count($query->posts)) : ?>
      <div id="en_tips" data-typeId=<?= $steps ?> data-sec_number=<?= $category ?? 0 ?> class="load">
        <div class="btn-more"><?php _e('Load More', 'bettingpro'); ?></div>
      </div>
    <?php endif; ?>
  </div>
<?php endif; ?>