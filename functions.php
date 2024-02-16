<?php
const MOD_THEME_DIR = __DIR__;
require_once __DIR__ . '/bootstrap/app.php';

class Walker_Main_Menu extends Walker_Nav_Menu
{
    public $current_item = false;

    function start_lvl(&$output, $depth = 0, $args = array())
    {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"sub-menu menu-$depth\">\n";
        $output .= "\n<li class=\"menu-item menu-li-$depth\">
            <button type=\"button\" class=\"menu-back-list\">
                " . __("Back", "bettingpro") . "
            </button></li>\n";
    }

    function end_lvl(&$output, $depth = 0, $args = array())
    {
        $indent = str_repeat("\t", $depth);
        $output .= "$indent</ul>\n" . ($depth ? "$indent\n" : "");
    }

    public function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
    {
        if (isset($args->item_spacing) && 'discard' === $args->item_spacing) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n";
        }
        $indent = ($depth) ? str_repeat($t, $depth) : '';

        $classes   = empty($item->classes) ? array() : (array)$item->classes;
        $classes[] = 'menu-item-' . $item->ID;
        if ($depth == 0) {
            $classes[] = 'menu-item-first-lvl';
        }
        if (is_singular(array('articles', 'features', 'tips')) && ! $this->current_item) {
            $path       = explode('/', parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
            $parent_url = explode('/', $item->url);
            if ( ! empty($parent_url[3]) && $path[1] == $parent_url[3]) {
                $classes[]          = 'current-menu-parent';
                $this->current_item = true;

            }
        }

        $args = apply_filters('nav_menu_item_args', $args, $item, $depth);

        $class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args, $depth));
        $class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

        $id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth);
        $id = $id ? ' id="' . esc_attr($id) . '"' : '';

        $output .= $indent . '<li' . $id . $class_names . '>';

        $atts                      = array();
        $atts['title']             = ! empty($item->attr_title) ? $item->attr_title : '';
        $atts['target']            = ! empty($item->target) ? $item->target : '';
        $atts['rel']               = ! empty($item->xfn) ? $item->xfn : '';
        $atts['href']              = ! empty($item->url) ? $item->url : '';
        $atts['aria-current']      = $item->current ? 'page' : '';
        $atts['data-default-href'] = $atts['href'];

        $atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args, $depth);

        $attributes = '';
        foreach ($atts as $attr => $value) {
            if ( ! empty($value)) {
                $value      = ('href' === $attr) ? esc_url($value) : esc_attr($value);
                $attributes .= ' ' . $attr . '="' . $value . '"';
            }
        }

        $title          = apply_filters('the_title', $item->title, $item->ID);
        $title          = apply_filters('nav_menu_item_title', $title, $item, $args, $depth);
        $icon           = get_field('menu_icon', $item->ID);
        $menu_item_icon = '';
        if ($icon) {
            $menu_item_icon = wp_get_attachment_image($icon, 'menu-icon', true);
        }

        $item_output = sprintf(
            '%s<a %s>%s%s%s%s</a>%s',
            $args->before,
            $attributes,
            $menu_item_icon,
            $args->link_before,
            $title,
            $args->link_after,
            $args->after
        );

        $output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
    }

    public function end_el(&$output, $item, $depth = 0, $args = array())
    {
        if (isset($args->item_spacing) && 'discard' === $args->item_spacing) {
            $t = '';
            $n = '';
        } else {
            $t = "\t";
            $n = "\n";
        }
        $output .= "</li>{$n}";
    }
}
add_action( 'wp_enqueue_scripts', 'add_url' );
  function add_url() {
    wp_localize_script('bettingpro_scripts', 'ajax_var', array(
    'url' => admin_url('admin-ajax.php'),
    'nonce' => wp_create_nonce('ajaxnonce')
  ));
}

function load_more() {
  $ajaxposts = new WP_Query([
    'post_type'       => 'how-to-guides',
    'posts_per_page'  => $_POST['step'],
    'orderby'         => 'post__in',
    'paged'           => $_POST['paged'],
    'post__in'        => $_POST['posts'],
  ]);

  $response = '';
  $max_pages = $ajaxposts->max_num_pages;

  if($ajaxposts->have_posts()) {
    ob_start();
    while($ajaxposts->have_posts()) :
      $ajaxposts->the_post();
      $response .= get_template_part('template-parts/guides/guides-templates/load-more-guide');
    endwhile;
    $output = ob_get_contents();
    ob_end_clean();
  } else {
    $output = '';
  }


  $result = [
    'max' => $max_pages,
    'html' => $output,
  ];

  echo json_encode($result);
  exit;
}
add_action('wp_ajax_load_more', 'load_more');


function load_more_tips() {


  $ajaxposts = new WP_Query([
    'post_type'       => 'tips',
    'post_status'     => 'publish',
    'numberposts'     => 9999999,
    'posts_per_page'  => $_POST['step'],
    'order'           => 'DSC',
    'paged'           => $_POST['paged'],
    'tax_query' => array(
      array(
      'taxonomy' => 'cat_tips',
      'field' => 'term_id',
      'terms' => $_POST['terms'] ?? 0
       )
    )
  ]);

  $response = '';
  $max_pages = $ajaxposts->max_num_pages;

  if($ajaxposts->have_posts()) {
    ob_start();
    while($ajaxposts->have_posts()) :
      $ajaxposts->the_post();
      $response .= get_template_part('template-parts/tips/tips-templates/load-more-tips');
    endwhile;
    $output = ob_get_contents();
    ob_end_clean();
  } else {
    $output = '';
  }


  $result = [
    'max' => $max_pages,
    'html' => $output,
  ];

  echo json_encode($result);
  exit;

 
}
add_action('wp_ajax_load_more_tips', 'load_more_tips');
add_action('wp_ajax_nopriv_load_more_tips', 'load_more_tips');

function load_more_en_tips() {
    $results = 1;
  
    switch_to_blog( (int)$results );
  
    $ajaxposts = new WP_Query([
      'post_type'       => 'tips',
      'post_status'     => 'publish',
      'numberposts'     => 9999999,
      'posts_per_page'  => $_POST['step'],
      'order'           => 'DSC',
      'paged'           => $_POST['paged'],
      'tax_query' => array(
        array(
        'taxonomy' => 'cat_tips',
        'field' => 'term_id',
        'terms' => $_POST['terms'] ?? 0
         )
      )
    ]);
  
    $response = '';
    $max_pages = $ajaxposts->max_num_pages;
  
    if($ajaxposts->have_posts()) {
      ob_start();
      while($ajaxposts->have_posts()) :
        $ajaxposts->the_post();
        $response .= get_template_part('template-parts/en-tips/en-tips-templates/load-more-tips');
      endwhile;
      $output = ob_get_contents();
      ob_end_clean();
    } else {
      $output = '';
    }
  
  
    $result = [
      'max' => $max_pages,
      'html' => $output,
    ];
  
    echo json_encode($result);
    exit;
    restore_current_blog();
   
}
add_action('wp_ajax_load_more_en_tips', 'load_more_en_tips');
add_action('wp_ajax_nopriv_load_more_en_tips', 'load_more_en_tips');

function load_more_es_tips() {
  global $wpdb;
  $results = $wpdb->get_results( "SELECT blog_id FROM wp_blogs WHERE path LIKE '%es%'" );

  switch_to_blog( (int)$results[0]->blog_id );

  $ajaxposts = new WP_Query([
    'post_type'       => 'tips',
    'post_status'     => 'publish',
    'numberposts'     => 9999999,
    'posts_per_page'  => $_POST['step'],
    'order'           => 'DSC',
    'paged'           => $_POST['paged'],
    'tax_query' => array(
      array(
      'taxonomy' => 'cat_tips',
      'field' => 'term_id',
      'terms' => $_POST['terms'] ?? 0
       )
    )
  ]);

  $response = '';
  $max_pages = $ajaxposts->max_num_pages;

  if($ajaxposts->have_posts()) {
    ob_start();
    while($ajaxposts->have_posts()) :
      $ajaxposts->the_post();
      $response .= get_template_part('template-parts/es-tips/es-tips-templates/load-more-tips');
    endwhile;
    $output = ob_get_contents();
    ob_end_clean();
  } else {
    $output = '';
  }


  $result = [
    'max' => $max_pages,
    'html' => $output,
  ];

  echo json_encode($result);
  exit;
  restore_current_blog();
 
}
add_action('wp_ajax_load_more_es_tips', 'load_more_es_tips');
add_action('wp_ajax_nopriv_load_more_es_tips', 'load_more_es_tips');
add_action('wp_ajax_nopriv_load_more', 'load_more');

function get_gtm_string($params, $placement_details)
{
    if ( ! isset($params)) {
        return null;
    }

    $brand             = isset($params['brand']) ? 'data-brand="' . $params['brand'] . '"' : '';
    $brand_slug        = isset($params['brand_slug']) ? 'data-brand-slug="' . $params['brand_slug'] . '"' : '';
    $position          = isset($params['position']) ? 'data-position="' . $params['position'] . '"' : '';
    $placement         = isset($params['placement']) ? 'data-placement="' . $params['placement'] . '"' : '';
    $placement_details = isset($placement_details) ? 'data-placement-details="' . $placement_details . '"' : '';
    $rating            = isset($params['rating']) ? 'data-rating="' . $params['rating'] . '"' : '';

    return 'data-ga ' . $brand . ' ' . $brand_slug . ' ' . $position . ' ' . $placement . ' ' . $placement_details . ' ' . $rating;
}

function get_country_code()
{
    $state_code  = '';
    $countryCode = '';

    if (( isset( $_COOKIE['locat'] ) && $_COOKIE['locat'] != 'none' ) || isset( $_GET['locat'] )) {
        if (isset( $_GET['locat'] )) {
            $countryCode = $_GET['locat'];
        } else {
            $countryCode = $_COOKIE['locat'];
        }
    } else {
        if (function_exists( 'cpGeoIPResolveWrapper' ) && ! empty( (array) cpGeoIPResolveWrapper() )) {
            $CPGeoIPResolve = cpGeoIPResolveWrapper();
            $codes          = json_decode( json_encode( $CPGeoIPResolve ) );

            if (isset( $codes->country_code )) {
                $countryCode = strtolower( $codes->country_code );
            }
            if (isset( $codes->first_subdivision_code )) {
                $state_code = $codes->first_subdivision_code;
            }
        } else {
            if (isset( $_SERVER["HTTP_CF_IPCOUNTRY"] )) {
                $countryCode = strtolower( $_SERVER["HTTP_CF_IPCOUNTRY"] );
            } else {
                $countryCode = '';
            }

            $state_code = '';
        }
    }

    return [
        'countryCode' => $countryCode,
        'state_code'  => $state_code,
    ];
}

function generate_custom_markup_schema($data)
{
    if (isset($data)) {

        $home_team_name     = isset($data['home_team_name']) ? $data['home_team_name'] : '';
        $home_team_image_id = isset($data['home_team_image']) ? $data['home_team_image'] : '';
        $home_team_image    = $home_team_image_id ? wp_get_attachment_url($home_team_image_id) : '';

        $away_team_name     = isset($data['away_team_name']) ? $data['away_team_name'] : '';
        $away_team_image_id = isset($data['away_team_image']) ? $data['away_team_image'] : '';
        $away_team_image    = $away_team_image_id ? wp_get_attachment_url($away_team_image_id) : '';

        $post_id       = isset($data['post_id']) ? $data['post_id'] : '';
        $preview_image = $post_id ? wp_get_attachment_url(get_post_thumbnail_id($post_id)) : '';
        $preview_url   = isset($data['preview_url']) ? $data['preview_url'] : '';

        $start_date    = isset($data['startdate']) ? $data['startdate'] : '';
        $end_date      = isset($data['enddate']) ? $data['enddate'] : '';
        $place_address = isset($data['place_address']) ? $data['place_address'] : '';
        $place_name    = isset($data['place_name']) ? $data['place_name'] : '';

        $structured_data = array(
            "@context"    => "http://schema.org/",
            "@type"       => "SportsEvent",
            "name"        => "{$home_team_name} vs {$away_team_name}",
            "description" => "{$home_team_name} vs {$away_team_name} ",
            "url"         => $preview_url,
            "startDate"   => $start_date,
            "endDate"     => $end_date,
            "image"       => $preview_image,
            "competitor"  => array(
                array(
                    "@type" => "SportsTeam",
                    "name"  => $home_team_name,
                    "image" => $home_team_image
                ),
                array(
                    "@type" => "SportsTeam",
                    "name"  => $away_team_name,
                    "image" => $away_team_image
                )
            ),
            "location"    => array(
                "@type"   => "Place",
                "name"    => $place_name,
                "address" => $place_address
            ),
            "homeTeam"    => array(
                "@type" => "SportsTeam",
                "name"  => $home_team_name
            ),
            "awayTeam"    => array(
                "@type" => "SportsTeam",
                "name"  => $away_team_name
            )
        );

        return "<script type='application/ld+json'>" . json_encode($structured_data) . "</script>";
    }
}

function bet_box_shortcode_handler($atts) {
  $banner_data = get_field( 'bet_box_banner' )[$atts['index']];

  if ($banner_data['special_bookie_link']) {
      $banner_link = $banner_data['special_bookie_link'];
  } elseif ($banner_data['bookmaker']) {
      $banner_link = get_country_depended_bookmaker_link( $banner_data['bookmaker'] );
  }

  $bookmaker  = get_post( $banner_data['bookmaker'] );
  $main_info  = get_field( 'main_info', $bookmaker );
  $gtm_params = array(
      'brand'      => $bookmaker->post_title,
      'brand_slug' => $bookmaker->post_name,
      'position'   => 0,
      'placement'  => 'CTA banner event',
      'rating'     => $main_info['rank']
  );


  ob_start();
  $post_id = get_the_ID();

  $custom_schema                = $banner_data['structured_schema'];
  $custom_schema['post_id']     = $post_id;
  $custom_schema['preview_url'] = get_the_permalink( $post_id );
  ?>
  <div class="events__single">
      <article class="events__card event-card">
          <div class="event-card__body">
              <div class="event-card__column">
                  <?php if ($banner_data['event_title'] != '') { ?>
                      <h3 class="event-card__title">
                          <?= $banner_data['event_title']; ?>
                      </h3>
                  <?php } ?>
                  <div class="event-card__info">
                      <?php
                          if ($banner_data['kick_off_time'] != '') {
                              $date = DateTime::createFromFormat( 'd/m/Y g:i a', $banner_data['kick_off_time'] );

                              $now        = new DateTime();
                              $date_day   = (int) $date->format( 'd' );
                              $date_month = (int) $date->format( 'm' );
                              $now_day    = (int) $now->format( 'd' );
                              $now_month  = (int) $now->format( 'm' );
                              if ($date_day == $now_day && $date_month == $now_month) {
                                  $day = __( 'Today', 'bettingpro' );
                              } elseif ($date_day - $now_day == 1 && $date_month == $now_month) {
                                  $day = __( 'Tomorrow', 'bettingpro' );
                              } else {
                                  $day_diff = $date->diff( $now );
                                  if ($day_diff->m < 0) {
                                      $day = __( 'in', 'bettingpro' ) . " " . ( $day_diff->d ) . " " . __( 'days',
                                              'bettingpro' );
                                  } else {
                                      $day = $date->format( 'F d' );
                                  }
                              }
                              ?>
                              <time datetime="<?= $date->format( 'c' ); ?>" class="event-card__time">
                                  <?= $day; ?> | <?= $date->format( 'G:i' ); ?> |
                              </time>
                      <?php } ?>
                      <?php if ($banner_data['event_league'] != '') { ?>
                          <span class="event-card__category">
                              <?= $banner_data['event_league']; ?>
                          </span>
                      <?php } ?>
                  </div>
                  <?php if ($banner_data['more_info_text']) { ?>
                      <button class="event-card__more-btn event-card__more-btn_for-desk js-event-more">
                          <?= $banner_data['more_info_link']; ?>
                      </button>
                  <?php } ?>
              </div>
              <?php
                  if ($banner_link && $banner_data['result']) {
                      ?>
                      <div class="event-card__column">
                          <a href="<?= $banner_link; ?>" target="_blank" rel="noreferrer noopener nofollow"
                              class="event-card__result"
                              <?= get_gtm_string( $gtm_params, 'side link' ) ?>
                          >
                              <?= $banner_data['result']; ?>
                          </a>
                      </div>
              <?php }

              if ($banner_link && $banner_data['odds']) {
                  ?>
                  <div class="event-card__column">
                      <a href="<?= $banner_link; ?>" target="_blank" rel="noreferrer noopener nofollow"
                          class="event-card__result"
                          <?= get_gtm_string( $gtm_params, 'odds link' ) ?>
                      >
                          <?= $banner_data['odds']; ?>
                      </a>
                  </div>
              <?php } ?>
              <div class="event-card__column">
                  <?php
                      if ($banner_link && $banner_data['bet_button_text']) {
                  ?>
                          <a 
                              href="<?= $banner_link; ?>" 
                              target="_blank" rel="noreferrer noopener nofollow"
                              class="event-card__btn"
                              <?= get_gtm_string( $gtm_params, 'bet now button' ) ?>
                          >
                              <?= $banner_data['bet_button_text']; ?>
                          </a>
                  <?php } ?>
                  <div class="event-card__warning">
                      <?= $banner_data['t&cs']; ?>
                  </div>

                  <?php if ($banner_data['more_info_text']) { ?>
                      <button class="event-card__more-btn event-card__more-btn_for-mob js-event-more">
                          <?= $banner_data['more_info_link']; ?>
                      </button>
                  <?php } ?>
              </div>
          </div>
          <?php if ($banner_data['more_info_text']) { ?>
              <div class="event-card__description">
                  <?= $banner_data['more_info_text']; ?>
              </div>
          <?php }
          if (! empty( $custom_schema ) && $custom_schema['switcher_structured_schema'] == true) {
              echo generate_custom_markup_schema( $custom_schema );
          } ?>
      </article>
  </div>
  <?php

  return ob_get_clean();
}

add_shortcode( 'bet-box', 'bet_box_shortcode_handler' );

function bp_read_more_shortcode_handler($atts) {

    $atts = shortcode_atts( [
        'link' => '',
        'text' => '',
    ], $atts );


    if (! empty( $atts['link'] ) && ! empty( $atts['text'] )) {

        return sprintf( '<div class="bp-read-more-wrap"><a href="%s" class="bp-read-more-btn">%s</a></div>',
            $atts['link'],
            $atts['text']
        );

    }

    return '';
}

add_shortcode( 'bp-read-more', 'bp_read_more_shortcode_handler' );

function get_parram($post_id, $toplist)
{
    global $wpdb;
    $query = 'SELECT
			tpl.*,
			tplp.`go_link`,
			tplp.`terms_and_conditions_link` AS "tc_link",
			tplp.`position` AS "post_position",
			tplp.`special_offer`,
			po.`post_title`,
			po.`id` AS "postID"
		FROM
			`' . esc_sql(TopListEditor::getListTableName()) . '` AS tpl
			LEFT JOIN `' . esc_sql(TopListEditor::getItemsTableName()) . '` AS tplp ON tpl.`id` = tplp.`toplistID`
			LEFT JOIN `' . $wpdb->posts . '` AS po ON po.`ID` = tplp.`postID`
		WHERE po.`ID` =  ' . $post_id . ' AND tpl.`id` = ' . $toplist . '
		ORDER BY
			tpl.`toplist_name`,
			tpl.`id`,
			tplp.`position`';
    $query = $wpdb->get_results($query);

    return $query;
}
define( 'BP_DIRECTORY_URI', get_stylesheet_directory_uri() );

function get_country_depended_bookmaker_link($bookmaker)
{
    if (get_post_type( $bookmaker ) !== 'bookmakers') {
        return false;
    }

    $link         = '';
    $country_code = get_country_code();

    if (function_exists( 'get_field' )) {
        $links = get_field( 'list_of_links', $bookmaker );
        if (is_array( $links ) && ! empty( $links ) && ! empty( $country_code['countryCode'] )) {
            $link_mapping = [];

            foreach ($links as $item) {
                $location_term = get_term_by( 'slug', $item['users_from'], 'geo_location' );

                if (is_a( $location_term, 'WP_Term' )) {
                    $link_mapping [$location_term->slug] = $item['link'];
                }
            }

            if (! empty( $country_code['state_code'] )) {
                $state = strtolower( $country_code['countryCode'] ) . '-' . strtolower( $country_code['state_code'] );
            }
            if (! empty( $state ) && array_key_exists( $state, $link_mapping )) {
                $link = $link_mapping[$state];
            } elseif (array_key_exists( strtolower( $country_code['countryCode'] ), $link_mapping )) {
                $link = $link_mapping[strtolower( $country_code['countryCode'] )];
            } else {
                $main_info = get_field( 'main_info', $bookmaker );

                if (array_key_exists( 'link', $main_info )) {
                    $link = $main_info['link'];
                }
            }
        } else {
            $main_info = get_field( 'main_info', $bookmaker );
            if (isset($main_info['link'])) {
                $link = $main_info['link'];
            }
        }
    }

    return $link;
}

function add_hyphen_for_child_posts($columns)
{
    $new_columns = array();

    foreach ($columns as $key => $value) {
        $new_columns[$key] = $value;
        if ($key === 'title') {
            $new_columns['parent'] = __('Parent');
        }
    }
    return $new_columns;
}
add_filter('manage_tips_posts_columns', 'add_hyphen_for_child_posts');

function display_parent_column_content($column, $post_id)
{
    if ($column === 'parent') {
        $post = get_post($post_id);
        if ($post->post_parent) {
            $parent_title = get_the_title($post->post_parent);
            echo '- ' . $parent_title;
        }
    }
}
add_action('manage_tips_posts_custom_column', 'display_parent_column_content', 10, 2);

add_action( 'wp_head', 'preload_top_banner');
function preload_top_banner() {
	$queried_object  = get_queried_object();
	$banner_type     = get_field('banner_type', $queried_object);
	$show_banner     = get_field('show_banner', $queried_object);
    if($show_banner){
    if($banner_type == 'custom'){
    $banners_ids = get_field('ad_banner', $queried_object);
	    $banner_id   = '';
	    if ( ! empty($banners_ids)) {
		    $locat_tax_name   = 'geo_location';
		    foreach ($banners_ids as $id) {
			    $locations_obj   = wp_get_post_terms($id, 'geo_location');
			    $show_for_all    = get_field('show_banners_for', $id);
			    $locations_slugs = array();
			    foreach ($locations_obj as $locat) {
				    $locations_slugs[] = $locat->slug;
			    }
			    $show_by_location =
				    $show_for_all ||
				    ( ! empty($current_location['state_code']) && has_term($current_location['state_code'],
						    $locat_tax_name, $id)) ||
				    ( ! empty($current_location['countryCode']) && has_term($current_location['countryCode'],
						    $locat_tax_name, $id));

			    if ($show_for_all || $show_by_location) {
				    $banner_id = $id;
				    break;
			    }
		    }
	    }

    }
	$banner_data = get_field('banner_data', $banner_id, $queried_object);
	// $preload_image_url = wp_get_attachment_image_url( $banner_data['image'], 'full' );
	// $srcset = wp_get_attachment_image_srcset( $banner_data['image'], 'full' );

	// printf( '<link rel="preload" as="image" href="%s" imagesrcset="%s" imagesizes="100vw">', $preload_image_url, $srcset);
    }
}

function offer_slider_shortcode( $atts ) {
    $atts = shortcode_atts(
        [
            'id' => '',
        ],
        $atts,
        'offer-slider'
    );
    $slider_id = $atts['id'];

    if ( ! $slider_id ) {
        return '';
    }
    $top_slider = get_field( 'top_slider', $slider_id );

    ob_start();
    include( locate_template( '/template-parts/offer-slider.php', false, false ) );
    $output = ob_get_clean();

    return $output;
}

add_shortcode( 'offer-slider', 'offer_slider_shortcode' );

function add_offer_slider_column($columns) {
    $columns['offer_slider_id'] = 'Offer Slider Shortcode';
    return $columns;
}
add_filter('manage_offer_slider_posts_columns', 'add_offer_slider_column');

function display_offer_slider_id($column, $post_id) {
    if ($column === 'offer_slider_id') {
        echo '[offer-slider id="' . $post_id . '"]';
    }
}
add_action('manage_offer_slider_posts_custom_column', 'display_offer_slider_id', 10, 2);

function add_offer_slider_metabox() {
    add_meta_box(
        'offer_slider_shortcode_metabox',
        'Offer Slider Shortcode',
        'render_offer_slider_metabox',
        'offer_slider',
        'side'
    );
}
add_action( 'add_meta_boxes', 'add_offer_slider_metabox' );

function render_offer_slider_metabox( $post ) {
    $post_id = $post->ID;

    $shortcode = '[offer-slider id="' . $post_id . '"]';

    echo '<div>' . $shortcode . '</div>';
}

add_filter('rest_tips_query', 'filter_page_attributes_exact_word', 10, 2);
function filter_page_attributes_exact_word($args, $request) {
    $search_term = $request['search'];
    $args['exact'] = true;
    $args['sentence'] = true;
    $args['search_columns'] = [
        'title',
    ];
    $args['search'] = $search_term;
    
    return $args;
}
add_filter( 'should_load_separate_core_block_assets', '__return_true' );

function get_gtm_string_banner($data) {
    
    if (!isset($data)) {
        return null;
    }
    
    $country_data = get_country_code();
    $countryCode = $country_data['countryCode'];

    $data_placement                = !empty($data['data_placement']) ? 'data-placement="' . $data['data_placement'] . '"' : '';
    $data_banner_track_name        = !empty($data['data_banner_track_name']) ? 'data-banner-track-name="' . $data['data_banner_track_name'] . '"' : '';
    $data_country                  = !empty($data['data_country']) ? 'data-country="' . $data['data_country'] . '"' : 'data-country="' . $countryCode . '"';
    $data_experiment_id            = !empty($data['data_experiment_id']) ? 'data-experiment-id="' . $data['data_experiment_id'] . '"' : '';


    return $data_placement . ' ' . $data_banner_track_name . ' ' . $data_country . ' ' . $data_experiment_id;
}

function get_gtm_string_href($data) {
    if (!isset($data)) {
        return null;
    }

    $country_data = get_country_code();
    $countryCode = $country_data['countryCode'];

    $data_banner_name               = !empty($data['data_banner_name']) ? 'data-banner-name="' . $data['data_banner_name'] . '"' : '';
    $data_click_text                = !empty($data['data_click_text']) ? 'data-click-text="' . $data['data_click_text'] . '"' : '';
    $data_country                   = !empty($data['data_country']) ? 'data-country="' . $data['data_country'] . '"' : 'data-country="' . $countryCode . '"';
    $data_placement                 = !empty($data['data_placement']) ? 'data-placement="' . $data['data_placement'] . '"' : '';
    $data_placement_details         = !empty($data['data_placement_details']) ? 'data-placement-details="' . $data['data_placement_details'] . '"' : '';
    $data_position                  = !empty($data['data_position']) ? 'data-position="' . $data['data_position'] . '"' : '';

    return 
        $data_banner_name . ' ' .
        $data_click_text . ' ' .
        $data_country . ' ' .
        $data_placement . ' ' .
        $data_placement_details . ' ' . 
        $data_position;
}

function set_tips_default_order() {
    if ( is_admin() && 'edit.php' === $GLOBALS['pagenow'] && isset( $_GET['post_type'] ) && 'tips' === $_GET['post_type'] ) {
        $orderby = isset( $_GET['orderby'] ) ? sanitize_text_field( $_GET['orderby'] ) : '';
        $order   = isset( $_GET['order'] ) ? sanitize_text_field( $_GET['order'] ) : '';

        if ( empty( $orderby ) || empty( $order ) ) {
            $orderby = 'date';
            $order   = 'desc';

            if ( current_user_can( 'edit_tips' ) ) {
                $redirect_url = add_query_arg( array( 'post_type' => 'tips', 'orderby' => $orderby, 'order' => $order ), admin_url( 'edit.php' ) );
                wp_safe_redirect( $redirect_url );
                exit;
            }
        }
    }
}
add_action( 'admin_init', 'set_tips_default_order' );

function author_post_query($query) {
    if ($query->is_main_query() && $query->is_author()) {
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

        $query->set('posts_per_page', 20);
        $query->set('post_type', ['tips', 'how-to-guides', 'bookmakers']);
        $query->set('post_status', 'publish');
        $query->set('paged', $paged);
    }
}
add_action('pre_get_posts','author_post_query');

function set_pagination_base() {
    global $wp_rewrite;
    $site_language = get_bloginfo('language');
    $supported_languages = array('es', 'es-CL', 'es-PE', 'es-CO', 'es-MX', 'pt-BR');

    if (in_array($site_language, $supported_languages)) {
        $wp_rewrite->pagination_base = 'pagina';
    } else {
        $wp_rewrite->pagination_base = 'page';
    }
}
add_action( 'init', 'set_pagination_base' );
function custom_search_query($query) {
    if (!is_admin() && $query->is_main_query() && $query->is_search()) {
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

        $query->set('posts_per_page', 20);
        $query->set('post_type', ['tips', 'how-to-guides', 'bookmakers']);
        $query->set('post_status', 'publish');
        $query->set('paged', $paged);
    }
}
add_action('pre_get_posts','custom_search_query');

function breadcrumbSchema() : void {
    global $post;
    $postParent = $post;
    $items = [];

    if (is_home()) {
        return;
    }

    if ($postParent->post_parent != 0) {
        while ($postParent->post_parent >= 0) {
            $postParent = get_post($postParent->post_parent);

            array_push($items, [
                "title" => $postParent->post_title,
                "permalink" => get_permalink ($postParent->ID),
            ]);

            if ($postParent->post_parent == 0)
            {
                break;
            }
        }
    }

    if ( in_array(get_post_type(), ["how-to-guides", "bookmakers"]) ) {
        $post_type_object = get_post_type_object( get_post_type() );
        array_push($items, [
            "title" => ucfirst( $post_type_object->labels->name ),
            "permalink" => home_url() . "/"
                . data_get($post_type_object->rewrite, "slug") . "/",
        ]);
    }

    array_push($items, [
        "title" => __( 'BettingPro', 'bettingpro' ),
        "permalink" => esc_url( home_url() ) . "/",
    ]);

    $items = array_reverse($items);
    array_push($items, [
        "title" => get_the_title(),
        "permalink" => get_permalink(),
    ]);

    $schema = [];

    foreach ( $items as $key => $value ) {
        $schema[] = [
            "@type" => "ListItem",
            "position" => $key + 1,
            "name" => $value["title"],
            "item" => $value["permalink"]
        ];
    }

    echo "<script type=\"application/ld+json\">
        {
        \"@context\": \"https://schema.org/\",
        \"@type\": \"BreadcrumbList\",
        \"itemListElement\": [ " . json_encode($schema) . "]
        }
    </script>";
}
add_action("wp_head", "breadcrumbSchema");

add_filter('acf/load_field/name=custom_date_tips', function ($field) {
    $field['default_value'] = date('d/m/Y');
    return $field;
});

add_filter('acf/load_field/name=scrollbar_mobile_type', function ($field) {
    if (in_array(get_post_type(), ["tips", "how-to-guides"])) {
        $field['default_value'] = "true";
    }
 
    return $field;
});

// add_filter( 'wp_calculate_image_srcset_meta', '__return_empty_array' );


function custom_responsive_images($content) {
    if (!is_admin() && is_main_query()) {

        $media_queries = array(
            '(max-width: 600px)',
            '(min-width: 600px)',
            '(min-width: 768px)',
            '(min-width: 992px)',
            '(min-width: 1200px)',
        );

        foreach ($media_queries as $media_query) {
            $content = preg_replace('/srcset=[\'"](.+?)[\'"]/', 'srcset=$1 ' . $media_query, $content);
        }

    }

    return $content;
}

add_filter('the_content', 'custom_responsive_images');

// Read the contents of the CSS file base
$css_file_path = get_template_directory() . '/build/css/base.css';
$css_file_content = file_get_contents($css_file_path);

// Inline the CSS file content without using wp_enqueue_style
wp_add_inline_style('custom-inline-style', $css_file_content);

// Add the inline style directly in the head
function add_inline_styles_directly() {
    global $css_file_content;
    echo '<style type="text/css">' . $css_file_content . '</style>';
}
add_action('wp_head', 'add_inline_styles_directly', 1);




// Read the contents of the CSS file
$css_file_path_footer = get_template_directory() . '/build/css/footer.css';
$css_file_content_footer = file_get_contents($css_file_path_footer);

// Inline the CSS file content without using wp_enqueue_style
wp_add_inline_style('custom-inline-style', $css_file_content_footer);

// Add the inline style directly in the footer
function add_inline_styles_directly_footer() {
    global $css_file_content_footer;
    echo '<style type="text/css">' . $css_file_content_footer . '</style>';
}
add_action('wp_head', 'add_inline_styles_directly_footer', 1);

add_filter( 'wpseo_next_rel_link', 'custom_change_wpseo_rel_link' );
add_filter( 'wpseo_prev_rel_link', 'custom_change_wpseo_rel_link' );

function custom_change_wpseo_rel_link( $link ) {
    if ( is_author() ) {
        $author = get_queried_object();
        $language = get_bloginfo( 'language' );

        if ( is_a( $author, 'WP_User' ) ) {
            $author_base = ( 'en-GB' === $language ) ? 'author' : 'autor';
            $page_base = ( 'en-GB' === $language ) ? 'page' : 'pagina';
            $author_name = $author->user_nicename;
            $page_number = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
            $new_link = get_site_url() . '/' . $author_base . '/' . $author_name . '/' . $page_base . '/';

            $rel_attribute = (current_filter() === 'wpseo_next_rel_link') ? 'next' : 'prev';

            $new_link .= ($rel_attribute === 'next') ? ($page_number + 1) : ($page_number - 1);

            $link = '<link rel="' . $rel_attribute . '" href="' . esc_url( $new_link ) . "/" .'" class="yoast-seo-meta-tag"/>';
        }
    }

    return $link;
}


function getCountryCode() {
    $country_code = $_SERVER["HTTP_CF_IPCOUNTRY"];

    if ($country_code == 'US' || $country_code == 'AR') {
        $state_code = $_SERVER["HTTP_X_CM_GEOIP_STATE"];
        $country_code = $country_code . '-' . $state_code;
    }

    $current_site_details = get_blog_details(get_current_blog_id());
    $country_path = $current_site_details->path;

    if ($country_path == '/usa/' && isset($_COOKIE['bpstate'])) {
        $country_code = $_COOKIE['bpstate'];
    }

    return $country_code;


}

function wpdocs_enqueue_custom_admin_style() {
    wp_register_script( 'custom_wp_admin_js', get_template_directory_uri() . '/build/parent-child-block.js', false, '1.0.0' );
    wp_enqueue_script( 'custom_wp_admin_js' );
}
add_action( 'admin_enqueue_scripts', 'wpdocs_enqueue_custom_admin_style' );