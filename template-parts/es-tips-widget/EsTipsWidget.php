<?php
  $title = get_field('es_tips_widget')['title'] ?? '';
  $category = get_field('es_tips_widget')['es_tips_categories'] ?? '';
  $helper = \Bettingpro\Includes\Helper::getInstance();
  $site_details = get_blog_details();

  global $wpdb;
  $results = $wpdb->get_results("SELECT blog_id FROM wp_blogs WHERE path LIKE '%es%'");
  switch_to_blog((int)$results[0]->blog_id);
  $term = get_term( $category, "cat_tips" );

  $tips = [
    'post_type' => 'tips',
    'post_status' => 'publish',
    'posts_per_page' => 6,
    'order' => 'ASC',
    'meta_key' => 'tips_fields_custom_date_tips',
      'meta_type' => 'DATE', 
      'orderby' => 'meta_value', 
      'meta_query' => array(
          array(
              'key' => 'tips_fields_custom_date_tips',
              'value' => date('Y-m-d'), 
              'compare' => '>=',
              'type' => 'DATE',
          ),
      ),
    'tax_query' => array(
      array(
        'taxonomy' => 'cat_tips',
        'field' => 'term_id',
        'terms' => $category ?? 0
      )
    )
  ];
  
  $query = new WP_Query($tips);
  $current = 0;

  if($query->have_posts()): ?>
      <?php ?>
      <div class="latest-news">
        <div class="title-block tips-title">
            <span class="title-block_text">
                <?= $title ? $title : 'Latest News'; ?>
            </span>
        </div>
        <div class="latest-news__holder">
            <?php include('parts/latest-tips.php'); ?>       
              <div class="latest-news__holder__other">
                <div class="latest-news__holder__other__wrapper">
            <?php
            while ($query->have_posts()) {
              $taxname = get_the_terms(get_the_ID(), 'cat_tips');
            ?>
              <?php include('parts/other-tips.php'); ?>       
            <?php 
              $current++; 
            }
            ?>
               </div>
            </div>
        </div>
        <ul class="tips_widget_list">
            <?php
            $current = 0;
            while ($query->have_posts()) {
                include('parts/tips-list.php');
            $current++;
            }
            ?>
        </ul>
    </div>
<?php    
endif; 
restore_current_blog();
?>
