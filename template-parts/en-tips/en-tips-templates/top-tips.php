<?php
$tips = get_field('en_tips')['select_en_tips'] ?? '';
$title = get_field('en_tips')['title'] ?? '';

$results = 1;

switch_to_blog((int)$results);
?>
<div>
  <div class="title-block tips-title">
    <span class="title-block_text"> <?= $title ?></span>
  </div>
  <?php if (!empty($tips)) : ?>
    <section class="latest-tips">
      <div class="modules-holder">
        <div class="module_main">
          <a href=<?= get_permalink($tips[0]) ?> class="module_link">
            <div class="module_image">
              <?= get_the_post_thumbnail($tips[0], 'medium' ) ?>
            </div>
            <div class="module_text_container">
              <div class="module_text">
                <p class="module_text_title">
                  <?= get_the_title($tips[0]) ?>
                </p>
              </div>
              <time datetime="<?= get_the_modified_date("Y-m-d\TH:i:sP", $tips[0]) ?>" class="module_text_time">
                <?= get_the_modified_date("M d, Y h:i A", $tips[0]) ?>
              </time>
            </div>
          </a>
        </div>
      </div>
    </section>
  <?php endif; ?>
  <section class="top-tips">
    <div class="modules-holder">
      <?php if (is_array($tips)) :
        foreach (array_slice($tips, 1) as $value) :
          $taxname = get_the_terms($value, 'cat_tips', array('fields' => 'name'));
      ?>
          <div class="top-tips-module">
            <div class="title-block">
              <?php if (isset($taxname[0]->name)) : ?>
                <span class="title-block_text"><?= $taxname[0]->name ?></span>
              <?php endif; ?>
            </div>
            <div class="module_main">
              <a href=<?= get_permalink($value) ?> class="module_link">
                <div class="module_image">
                  <?= get_the_post_thumbnail($value, 'medium' ) ?>
                </div>
                <div class="module_text">
                  <p class="module_text_title"><?= get_the_title($value) ?></p>
                </div>
              </a>
              <time datetime="<?= get_the_modified_date("Y-m-d\TH:i:sP", $value) ?>" class="module_text_time">
                <?= get_the_modified_date("M d, Y h:i A", $value) ?>
              </time>
            </div>
          </div>
      <?php endforeach;
      endif; ?>
    </div>
  </section>
</div>
<?php  restore_current_blog(); ?>