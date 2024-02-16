<?php

namespace Bettingpro\Includes;

use Bettingpro\GDWebPConverter\GDWebPConverter;

class Setup
{

    public static function getServices(string $component)
    {
        $path = new \FilesystemIterator(MOD_THEME_DIR . '/inc/' . $component);
        $paths = [];

        foreach ($path as $content) {
            $name = strtolower($content->getBasename(".{$content->getExtension()}"));
            $paths[$name] = "Bettingpro\\{$component}\\{$content->getBasename(".{$content->getExtension()}")}";
        }

        return $paths;
    }

    function bettingpro_support()
    {

        // Add support for block styles.
        add_theme_support('wp-block-styles');

        // Enqueue editor styles.
        add_editor_style('style.css');

        load_theme_textdomain('bettingpro', get_template_directory() . '/languages');

    }

    function custom_header_metadata()
    {
        ?>
        <meta name="viewport" content="width=device-width,initial-scale=1">
        <?php
    }

    function bettingpro_styles()

    {


        wp_register_style('custom_wp_admin_css', get_template_directory_uri() . '/build/css/index.css', false, '1.0.0');
        wp_enqueue_style('custom_wp_admin_css');

        if (!is_admin() && is_main_query()) {

            $helper = \Bettingpro\Includes\Helper::getInstance();

            $template_part = 'template-parts/';

            if ($helper->has_block("acf/ad-banner") ) {
                wp_register_style('ad-banner', get_template_directory_uri() . '/build/css/ad-banner.css', false, '1.0.0');
                wp_enqueue_style('ad-banner');
            }
            if ($helper->has_block("acf/bookmaker-comparison-table") ) {
                wp_register_style('bookmaker-comparison', get_template_directory_uri() . '/build/css/bookmaker-comparison.css', false, '1.0.0');
                wp_enqueue_style('bookmaker-comparison');
            }
            if ($helper->has_block("acf/bookmaker-cta")) {
                wp_register_style('cta-bookmaker-block', get_template_directory_uri() . '/build/css/cta-bookmaker-block.css', false, '1.0.0');
                wp_enqueue_style('cta-bookmaker-block');
            }
            if ($helper->has_block("acf/bookmaker-toplists")) {
                wp_register_style('bookmaker-toplist', get_template_directory_uri() . '/build/css/bookmaker-toplist.css', false, '1.0.0');
                wp_enqueue_style('bookmaker-toplist');
            }
            if ($helper->has_block("acf/countdown")) {
                wp_register_style('countdown', get_template_directory_uri() . '/build/css/countdown.css', false, '1.0.0');
                wp_enqueue_style('countdown');
            }
            if ($helper->has_block("acf/guides")) {
                wp_register_style('guides', get_template_directory_uri() . '/build/css/guides.css', false, '1.0.0');
                wp_enqueue_style('guides');
            }
            if ($helper->has_block("acf/image-iframe-widget") ) {
                wp_register_style('imageIframeWidget', get_template_directory_uri() . '/build/css/imageIframeWidget.css', false, '1.0.0');
                wp_enqueue_style('imageIframeWidget');
            }
            if ($helper->has_block("acf/list-highlights") ) {
                wp_register_style('list-highlights', get_template_directory_uri() . '/build/css/list-highlights.css', false, '1.0.0');
                wp_enqueue_style('list-highlights');
            }
            if ($helper->has_block("acf/sticky-video")) {
                wp_register_style('sticky-video', get_template_directory_uri() . '/build/css/sticky-video.css', false, '1.0.0');
                wp_enqueue_style('sticky-video');
            }
            if ($helper->has_block("acf/table-highlights")) {
                wp_register_style('table-highlights', get_template_directory_uri() . '/build/css/table-highlights.css', false, '1.0.0');
                wp_enqueue_style('table-highlights');
            }
            if ($helper->has_block("acf/table-review-analysis")) {
                wp_register_style('table-review-analysis', get_template_directory_uri() . '/build/css/table-review-analysis.css', false, '1.0.0');
                wp_enqueue_style('table-review-analysis');
            }

            if ($helper->has_block("acf/takeover-block")) {
                wp_register_style('takeover', get_template_directory_uri() . '/build/css/takeover.css', false, '1.0.0');
                wp_enqueue_style('takeover');
            }
            
            wp_register_style('more-tips', get_template_directory_uri() . '/build/css/more-tips.css', false, '1.0.0');
            wp_enqueue_style('more-tips');

            wp_register_style('latest-news', get_template_directory_uri() . '/build/css/latest-news.css', false, '1.0.0');
            wp_enqueue_style('latest-news');
            

            $post_type = get_post_type();

     
            wp_register_style('banners', get_template_directory_uri() . '/build/css/banners.css', false, '1.0.0');
            wp_enqueue_style('banners');
            

            if (is_404()) {
                wp_register_style('404', get_template_directory_uri() . '/build/css/404.css', false, '1.0.0');
                wp_enqueue_style('404');
            }

            if(is_author()) {
                wp_register_style('author', get_template_directory_uri() . '/build/css/author.css', false, '1.0.0');
                wp_enqueue_style('author');
            }

            $authors = get_field('authors_list');
            if (!empty($authors)) {
                wp_register_style('authors-list', get_template_directory_uri() . '/build/css/authors-list.css', false, '1.0.0');
                wp_enqueue_style('authors-list');
            }

            if (locate_template($template_part . 'parts/bookmaker-banner.php')) {
                wp_register_style('single-bookmakers', get_template_directory_uri() . '/build/css/single-bookmakers.css', false, '1.0.0');
                wp_enqueue_style('single-bookmakers');
            }

            if (locate_template($template_part . 'parts/author-section-top.php')) {
                wp_register_style('single-tips', get_template_directory_uri() . '/build/css/single-tips.css', false, '1.0.0');
                wp_enqueue_style('single-tips');
            }

            if ( is_page_template( 'sub-affiliate-landing-page.php' ) ) {
                wp_register_style('sub-affiliate-page', get_template_directory_uri() . '/build/css/sub-affiliate-page.css', false, '1.0.0');
                wp_enqueue_style('sub-affiliate-page');
            }

            if ($helper->has_block("acf/bookmaker-sidebar") || $helper->has_block("acf/custom-html-sidebar") || is_active_sidebar('sidebar-1') || is_active_sidebar('sidebar-best-bookmakers')) {
                wp_register_style('bookmaker-sidebar', get_template_directory_uri() . '/build/css/bookmaker-sidebar.css', false, '1.0.0');
                wp_enqueue_style('bookmaker-sidebar');
            }

            if ($helper->has_block("acf/sidebar-block") || is_active_sidebar('sidebar-1') || is_active_sidebar('sidebar-best-bookmakers')) {
                wp_register_style('sidebar', get_template_directory_uri() . '/build/css/sidebar.css', false, '1.0.0');
                wp_enqueue_style('sidebar');
            }
             
        }

    }

    function bettingpro_scripts()
    {
        wp_register_script(
            'bettingpro_scripts',
            get_template_directory_uri() . '/build/js/index.js',
            '',
            true,
            false
        );
        wp_enqueue_script('bettingpro_scripts');
    }

    function add_script_preload_attribute( $tag, $handle ) 
    {
        if ( 'bettingpro_scripts' === $handle ) {
            $tag = str_replace( '<script', '<script rel="preload"', $tag );
        }
        return $tag;
    }
    
    function add_style_preload_attribute( $tag, $handle ) 
    {
        if ( 'custom_wp_admin_css' === $handle ) {
            $tag = str_replace( '<link rel=\'stylesheet\'', '<link rel="preload stylesheet"', $tag );
        }
        return $tag;
    }

    function bettingpro_widgets_init()
    {
        $sidebars = [
            [
                'name' => esc_html__('Sidebar', 'bettingpro'),
                'id' => 'sidebar-1',
                'description' => esc_html__('Add widgets here.', 'bettingpro'),
                'before_widget' => '<section id="%1$s" class="widget %2$s">',
                'after_widget' => '</section>',
                'before_title' => '<h2 class="widget-title">',
                'after_title' => '</h2>',
            ],
            [
                'name' => esc_html__('Best Bookmakers Sidebar', 'bettingpro'),
                'id' => 'sidebar-best-bookmakers',
                'description' => esc_html__('Add widgets here.', 'bettingpro'),
                'before_widget' => '<section id="%1$s" class="widget %2$s">',
                'after_widget' => '</section>',
                'before_title' => '<h2 class="widget-title">',
                'after_title' => '</h2>',
            ],
        ];

        foreach ($sidebars as $sidebar) {
            register_sidebar($sidebar);
        }
    }

    function cc_mime_types($mimes)
    {
        $mimes['svg'] = 'image/svg+xml';

        return $mimes;
    }

    function filter_nav_menu_link_attributes($atts, $item, $args, $depth) {

        $menu_type = '';

        if ($args->theme_location === 'top_menu') {
            $menu_type = 'header_nav-link';
        } elseif ($args->theme_location === 'main_menu') {
            $menu_type = 'header_nav-main';
        }

        if ($menu_type) {
            $atts['class'] = $menu_type;
            if ($item->current) {
                $atts['class'] .= '_active';
            }
        }

        return $atts;
    }

    function register_menus()
    {
        register_nav_menus(
            [
                'main_menu' => 'Main menu',
                'top_menu' => 'Top menu',
                'language_switcher' => 'Language switcher'
            ]
        );
    }

    function filter_nav_menu_css_classes($classes, $item, $args, $depth) {
        $menu_type = '';
        if ($args->theme_location === 'top_menu') {
            $menu_type = 'header_nav-item';
        } elseif ($args->theme_location === 'main_menu') {
            $menu_type = 'header_nav-menu';
        }

        if ($menu_type) {
            $classes[] = $menu_type;
        }

        if (is_singular('tips') && in_array('current-tips-ancestor', $classes)) {
            $classes[] = 'current-menu-item';
        }

        return $classes;
    }

    function slick_slider_js()
    {
        $es_template = '';
        $template = '';
        $en_template = '';
        global $post;
        $blocks = parse_blocks($post->post_content);
        foreach ($blocks as $block) {
            if ($block['blockName'] === 'acf/es-tips' && $block['attrs']['data']['es_tips_es_templates'] = "latest_news")  {
                $es_template = $block['attrs']['data']['es_tips_es_templates'] ?? '';
            }
            if ($block['blockName'] === 'acf/tips' && $block['attrs']['data']['tips_tips_template'] = "latest_news") {
                $template = $block['attrs']['data']['tips_tips_template'] ?? '';
            }
            if ($block['blockName'] === 'acf/en-tips' && $block['attrs']['data']['en_tips_en_templates'] = "latest_news") {
                $en_template = $block['attrs']['data']['en_tips_en_templates'] ?? '';
            }
        }
        if (
            has_block('acf/offer-slider', $post->ID)
            || has_block('acf/tips-widget', $post->ID)
            || has_block('acf/es-tips-widget', $post->ID)
            || $es_template === "latest_news"
            || $template === "latest_news"
            || $en_template === "latest_news"
            || has_shortcode($post->post_content, 'offer-slider')
        ) {
            wp_enqueue_script('slick-js', '//cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', array('jquery'), '', true);
        }
    }
    
    function _validate_save_post()
    {

        // bail early if no $_POST
        $acf = false;
        foreach ($_POST as $key => $value) {
            if (strpos($key, 'acf') === 0) {
                if (!empty($_POST[$key])) {
                    acf_validate_values($_POST[$key], $key);
                }
            }
        }
    }

    function defers($tag, $handle)
    {
        if ('slick-js' !== $handle) {
            return $tag;
        }
        return str_replace(' src', ' defer src', $tag);
    }

    function user_social_links() {
        return [
            'facebook'    => 'Facebook profile URL',
            'instagram'   => 'Instagram profile URL',
            'linkedin'    => 'LinkedIn profile URL',
            'myspace'     => 'MySpace profile URL',
            'pinterest'   => 'Pinterest profile URL',
            'soundcloud'  => 'SoundCloud profile URL',
            'tumblr'      => 'Tumblr profile URL',
            'twitter'     => 'Twitter profile URL',
            'youtube'     => 'YouTube profile URL'
        ];
    }


    function add_blog_slug_body_class($classes)
    {
        // $details = get_blog_details();
        if (is_a($details, 'WP_Site') && str_replace('/', '', $details->path)) {
            $classes[] = 'lang-' . str_replace('/', '', $details->path);
        }

        return $classes;
    }
    function custom_meta_author() {
        if ( is_author() ) {
            $author_name = get_the_author();
            $author_bio = get_the_author_meta('description');
            echo '<meta name="author" content="' . esc_attr( $author_name ) . '">';
            echo '<meta name="description" content="' . esc_attr( $author_bio ) . '">';
            $url = 'https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
            echo '<link rel="canonical" href="' . $url . '" class="yoast-seo-meta-tag" />';
        }else if( is_singular() ){
            $author_id = get_the_author_meta( 'ID' );
            $author_name = get_the_author_meta( 'display_name', $author_id );
            echo '<meta name="name" content="' . esc_attr( $author_name ) . '">';
        }else{

        }
    }
    function add_hreflangs_to_head() {
        // Get the repeater field
        global $post;
        $hreflangs = get_field('custom_hreflang_links', $post?->ID);

        if(empty($hreflangs)){
            return;
        }

        // Loop through each row in the repeater and build the hreflang tags
        foreach ($hreflangs as $hreflang) {
            echo '<link rel="alternate" hreflang="' . esc_attr($hreflang['href_lang']) . '" href="' . esc_url($hreflang['href_link']) . '" />';
        }

    }
    function my_admin_only_prepare_field( $field ) {

        if ($field["label"] == "Select Category") {

            $taxonomies = get_terms( [
                'taxonomy' => 'cat_tips',
                'hide_empty' => false
            ]);

            $field["choices"] = array_reduce( $taxonomies, function( $choices, $term ) {
                $choices[ $term->term_id ] = $term->name;
                return $choices;
            }, [] );
        }

        return $field;
    }

    function es_categories_select( $field ) {

        if ($field["label"] == "Filter by category") {
            global $wpdb;
            $results = $wpdb->get_results( "SELECT blog_id FROM wp_blogs WHERE path LIKE '%es%'" );

            switch_to_blog( (int)$results[0]->blog_id );

            $taxonomies = get_terms( [
                'taxonomy' => 'cat_tips',
                'hide_empty' => false
            ]);

            restore_current_blog();

            $field["choices"] = array_reduce( $taxonomies, function( $choices, $term ) {
                $choices[ $term->term_id ] = $term->name;
                return $choices;
            }, [] );
        }

        return $field;
    }
    function filter_by_category_en( $field ) {

        if ($field["label"] == "Filter By Categories") {
            global $wpdb;
            $results = 1;
    
            switch_to_blog( (int)$results);
    
            $taxonomies = get_terms( [
                'taxonomy' => 'cat_tips',
                'hide_empty' => false
            ]);
    
            restore_current_blog();
    
            $field["choices"] = array_reduce( $taxonomies, function( $choices, $term ) {
                $choices[ $term->term_id ] = $term->name;
                return $choices;
            }, [] );
        }
    
        return $field;
    }
    function populate_entips_relationship( $args, $field, $post_id ) {
  
        $blogid = 1;
        switch_to_blog((int)$blogid);
        
        $args['post_type'] = array( 'tips' );
        $args['post_status'] = 'publish';
        $args['orderby'] = 'date';
        $args['order'] = 'DESC';

        return $args;
      
        restore_current_blog();
    }
    
    function populate_toptips_relationship( $args, $field, $post_id ) {
  
        global $wpdb;
        $results = $wpdb->get_results("SELECT blog_id FROM wp_blogs WHERE path LIKE '%es%'");
      
        switch_to_blog((int)$results[0]->blog_id);
        
        $args['post_type'] = array( 'tips' );
        $args['post_status'] = 'publish';
        $args['orderby'] = 'date';
        $args['order'] = 'DESC';

        return $args;
      
        restore_current_blog();
    }

    function populate_estips_relationship( $args, $field, $post_id ) {
        global $wpdb, $post;
    
        $results = $wpdb->get_results("SELECT blog_id FROM wp_blogs WHERE path LIKE '%es%'");
      
        switch_to_blog((int)$results[0]->blog_id);
        
        $args['post_type'] = array( 'tips' );
        $args['post_status'] = 'publish';
        $args['orderby'] = 'date';
        $args['order'] = 'DESC';

        return $args;
      
        restore_current_blog();
    }

    function filter_by_cats( $field ) {

        if ($field["label"] == "ES Tips Categories") {
            global $wpdb;
            $results = $wpdb->get_results( "SELECT blog_id FROM wp_blogs WHERE path LIKE '%es%'" );

            switch_to_blog( (int)$results[0]->blog_id );

            $taxonomies = get_terms( [
                'taxonomy' => 'cat_tips',
                'hide_empty' => false
            ]);

            restore_current_blog();

            $field["choices"] = array_reduce( $taxonomies, function( $choices, $term ) {
                $choices[ $term->term_id ] = $term->name;
                return $choices;
            }, [] );
        }

        return $field;
    }

    function translatePostTypes( $args, $post_type ): array
    {
        $site_language = get_bloginfo( 'language' );

        if ( $post_type === 'bookmakers' )
        {
            $args = match ( $site_language )
            {
                'es' => setBookmakerLabelsInArgentina( $args ),
                'es-CL' => setBookmakerLabelsInSpanish( $args ),
                'es-PE' => setBookmakerLabelsInSpanish( $args ),
                'es-CO' => setBookmakerLabelsInSpanish( $args ),
                'es-MX' => setBookmakerLabelsInSpanish( $args ),
                'pt-BR' => setBookmakerLabelsInPortuguese( $args ),
                default => $args
            };
        }

        if ( $post_type === 'post' ) {
            $args = match ( $site_language )
            {
                'es', 
                'es-CL', 
                'es-PE', 
                'es-CO', 
                'es-MX' => setPostLabelsInSpanish( $args ),
                'pt-BR' => setPostLabelsInPortuguese( $args ),
                default => $args
            };
        }
        if ( $post_type === 'tips' ) {
            $args = match ( $site_language )
            {
                'es', 
                'es-CL', 
                'es-PE', 
                'es-CO', 
                'es-MX' => setTipsLabelsInSpanish( $args ),
                'pt-BR' => setTipsLabelsInPortuguese( $args ),
                default => $args
            };
        }
        if ( $post_type === 'how-to-guides' ) {
            $args = match ( $site_language )
            {
                'es', 
                'es-CL', 
                'es-PE', 
                'es-CO',
                'es-MX' => setHowToGuidesLabelsInSpanish( $args ),
                'pt-BR' => setHowToGuidesLabelsInPortuguese( $args ),
                default => $args
            };
        }
        return $args;
    }

    function custom_yoast_breadcrumb( $output, $class ): string
    {
        $post_type = get_post_type();
        $delimiter = ' / ';
        global $post;
        $postToManipulate = $post;
        $currentPost = $post;

        if ( $post_type === 'tips' )
        {
            $output = '<a class="breadcrumb-hover" href="' . esc_url( home_url() ) .'/">' . __( 'BettingPro', 'bettingpro' ) . '</a>' . $delimiter;
            $breadcrumbs = [];
            while ( $post->post_parent >= 0 )
            {
                $postToManipulate = get_post( $postToManipulate->post_parent );
                $isLastPost = $postToManipulate->ID === $currentPost->ID; // Check if this is the last post in the breadcrumb trail
                $breadcrumbs[] = 
                    $isLastPost ? 
                        ucfirst( 
                            (
                                !empty(get_post_meta($postToManipulate->ID, '_yoast_wpseo_bctitle', true)) 
                                ? get_post_meta($postToManipulate->ID, '_yoast_wpseo_bctitle', true) 
                                : get_the_title($postToManipulate->ID)
                            )
                        ) : '<a class="breadcrumb-hover" href="' . get_permalink( $postToManipulate->ID ) . '">' . ucfirst( 
                                (
                                    !empty(get_post_meta($postToManipulate->ID, '_yoast_wpseo_bctitle', true))
                                    ? get_post_meta($postToManipulate->ID, '_yoast_wpseo_bctitle', true)
                                    : get_the_title($postToManipulate->ID)
                                )
                            ) . '</a>';
                if ($postToManipulate->post_parent == 0)
                {
                    break;
                }
            }
            $breadcrumbs = array_reverse( $breadcrumbs );
            $output .= implode( $delimiter, $breadcrumbs );
            if ($post->post_parent > 0){
                $output .= $delimiter . (
                    !empty(get_post_meta($post->ID, '_yoast_wpseo_bctitle', true)) ? get_post_meta($post->ID, '_yoast_wpseo_bctitle', true) : get_the_title()
                );
            }
        }

        if ( $post_type === "how-to-guides" )
        {
            $output = "<a class=\"breadcrumb-hover\" href=\"" 
                . esc_url( home_url() ) . "/\">" 
                . __( "BettingPro", "bettingpro" ) . "</a>" . $delimiter;

            $post_type_object = get_post_type_object( $post_type );
            $output .= "<a class=\"breadcrumb-hover\" href=\"" 
                . home_url() . "/" 
                . data_get($post_type_object->rewrite, "slug") . "/\">" 
                . ucfirst( $post_type_object->labels->name ) . "</a>" . $delimiter;
            $breadcrumbs = [];
    
            while ( $post->post_parent >= 0 )
            {
                $postToManipulate = get_post( $postToManipulate->post_parent );
                $isLastPost = $postToManipulate->ID === $currentPost->ID; 
                $breadcrumbs[] = 
                    $isLastPost ? 
                        ucfirst(
                            (
                                !empty(get_post_meta($postToManipulate->ID, "_yoast_wpseo_bctitle", true)) 
                                ? get_post_meta($postToManipulate->ID, "_yoast_wpseo_bctitle", true) 
                                : get_the_title($postToManipulate->ID)
                            )
                        ) : "<a class=\"breadcrumb-hover\" href=\"" . get_permalink( $postToManipulate->ID ) . "\">" . ucfirst( 
                                (
                                    !empty(get_post_meta($postToManipulate->ID, "_yoast_wpseo_bctitle", true)) 
                                    ? get_post_meta($postToManipulate->ID, "_yoast_wpseo_bctitle", true) 
                                    : get_the_title($postToManipulate->ID)
                                )
                            ) . "</a>";
                if ($postToManipulate->post_parent == 0)
                {
                    break;
                }
            }
            $breadcrumbs = array_reverse( $breadcrumbs );
            $output .= implode( $delimiter, $breadcrumbs );
            if ($post->post_parent > 0){
                $output .= $delimiter . (
                    !empty(get_post_meta($post->ID, "_yoast_wpseo_bctitle", true)) 
                    ? get_post_meta($post->ID, "_yoast_wpseo_bctitle", true) 
                    : get_the_title()
                );
            }

        }

        if ( $post_type === 'bookmakers' )
        {
            $output = '<a class="breadcrumb-hover" href="' . esc_url( home_url() ) . '/">' . __( 'BettingPro', 'bettingpro' ) . '</a>' . $delimiter;

            $post_type_object = get_post_type_object( $post_type );
            $output .= '<a class="breadcrumb-hover" href="' 
            . home_url() . '/' 
            . data_get($post_type_object->rewrite, "slug") . '/">' 
            . ucfirst( $post_type_object->labels->name ) 
            . '</a>' . $delimiter;
            $breadcrumbs = [];
    
            while ( $post->post_parent >= 0 )
            {
                $postToManipulate = get_post( $postToManipulate->post_parent );
                $isLastPost = $postToManipulate->ID === $currentPost->ID; 
                $breadcrumbs[] = 
                    $isLastPost ? 
                        ucfirst(
                            (
                                !empty(get_post_meta($postToManipulate->ID, '_yoast_wpseo_bctitle', true)) 
                                ? get_post_meta($postToManipulate->ID, '_yoast_wpseo_bctitle', true) 
                                : get_the_title($postToManipulate->ID)
                            )
                        ) : '<a class="breadcrumb-hover" href="' . get_permalink( $postToManipulate->ID ) . '">' . ucfirst( 
                                (
                                    !empty(get_post_meta($postToManipulate->ID, '_yoast_wpseo_bctitle', true)) 
                                    ? get_post_meta($postToManipulate->ID, '_yoast_wpseo_bctitle', true) 
                                    : get_the_title($postToManipulate->ID)
                                )
                            ) . '</a>';
                if ($postToManipulate->post_parent == 0)
                {
                    break;
                }
            }
            $breadcrumbs = array_reverse( $breadcrumbs );
            $output .= implode( $delimiter, $breadcrumbs );
            if ($post->post_parent > 0){
                $output .= $delimiter . (
                    !empty(get_post_meta($post->ID, '_yoast_wpseo_bctitle', true)) ? get_post_meta($post->ID, '_yoast_wpseo_bctitle', true) : get_the_title()
                );
            }
        }

        return $output;
    }
    function remove_author_robots_meta( $robots ) {
        if ( is_author() ) {
            return 'index, follow';
        }
        return $robots;
    }
}

function setBookmakerLabelsInArgentina( $args ): array
{
    $args['labels']['name'] = 'Casas De Apuestas';
    $args['labels']['singular_name'] = 'Casa De Apuestas';
    $args['labels']['menu_name'] = 'Casas De Apuestas';
    $args['labels']['all_items'] = 'Todas las casas de apuestas';
    $args['labels']['add_new'] = 'Agregar nueva';
    $args['labels']['add_new_item'] = 'Agregar nueva casa de apuestas';
    $args['labels']['edit_item'] = 'Editar casa de apuestas';
    $args['labels']['view_item'] = 'Ver casa de apuestas';
    $args['labels']['search_items'] = 'Buscar casas de apuestas';
    $args['labels']['not_found'] = 'No se encontraron casas de apuestas';
    $args['labels']['not_found_in_trash'] = 'No se encontraron casas de apuestas en la papelera';
    $args['rewrite']['slug'] = 'casas-apuestas-argentina';

    return $args;
}

function setBookmakerLabelsInSpanish( $args ): array
{
    $args['labels']['name'] = 'Casas De Apuestas';
    $args['labels']['singular_name'] = 'Casa De Apuestas';
    $args['labels']['menu_name'] = 'Casas De Apuestas';
    $args['labels']['all_items'] = 'Todas las casas de apuestas';
    $args['labels']['add_new'] = 'Agregar nueva';
    $args['labels']['add_new_item'] = 'Agregar nueva casa de apuestas';
    $args['labels']['edit_item'] = 'Editar casa de apuestas';
    $args['labels']['view_item'] = 'Ver casa de apuestas';
    $args['labels']['search_items'] = 'Buscar casas de apuestas';
    $args['labels']['not_found'] = 'No se encontraron casas de apuestas';
    $args['labels']['not_found_in_trash'] = 'No se encontraron casas de apuestas en la papelera';
    $args['rewrite']['slug'] = 'casas-apuestas';

    return $args;
}
function setBookmakerLabelsInPortuguese( $args ): array
{
    $args['labels']['name'] = 'Casas de Apostas';
    $args['labels']['singular_name'] = 'Casa de Apostas';
    $args['labels']['menu_name'] = 'Casas de Apostas';
    $args['labels']['all_items'] = 'Todas as casas de apostas';
    $args['labels']['add_new'] = 'Adicionar nova';
    $args['labels']['add_new_item'] = 'Adicionar nova casa de apostas';
    $args['labels']['edit_item'] = 'Editar casa de apostas';
    $args['labels']['view_item'] = 'Ver casa de apostas';
    $args['labels']['search_items'] = 'Procurar casas de apostas';
    $args['labels']['not_found'] = 'Nenhuma casa de apostas encontrada';
    $args['labels']['not_found_in_trash'] = 'Nenhuma casa de apostas encontrada na lixeira';
    $args['rewrite']['slug'] = 'casas-de-apostas';

    return $args;
}

function setPostLabelsInPortuguese( $args ): array
{
    $args['labels']['name'] = 'Artigos';
    $args['labels']['singular_name'] = 'Artigo';
    $args['labels']['plural_name'] = 'Artigos';
    $args['labels']['add_new'] = 'Novo Artigo';
    $args['labels']['add_new_item'] = 'Adicionar Novo Artigo';
    $args['labels']['edit_item'] = 'Editar Artigo';
    $args['labels']['new_item'] = 'Novo Artigo';
    $args['labels']['all_items'] = 'Todos os Artigos';
    $args['labels']['search_items'] = 'Pesquisar Artigos';
    $args['labels']['not_found'] = 'Artigo não encontrado';
    $args['labels']['not_found_in_trash'] = 'Artigo não encontrado na lixeira';
    $args['show_ui'] = true;
    $args['hierarchical'] = true;
    $args['public'] = true;
    $args['show_in_menu'] = true;
    $args['menu_position'] = 1;
    $args['supports'][] = 'page-attributes';
    $args['rewrite']['slug'] = 'artigos';

    return $args;
}

function setPostLabelsInSpanish( $args ): array
{
    $args['labels']['name'] = 'Entradas';
    $args['labels']['singular_name'] = 'Entrada';
    $args['labels']['plural_name'] = 'Entradas';
    $args['labels']['add_new'] = 'Nueva Entrada';
    $args['labels']['add_new_item'] = 'Agregar Nueva Entrada';
    $args['labels']['edit_item'] = 'Editar Entrada';
    $args['labels']['new_item'] = 'Nueva Entrada';
    $args['labels']['all_items'] = 'Todas las Entradas';
    $args['labels']['search_items'] = 'Buscar Entradas';
    $args['labels']['not_found'] = 'Entrada no encontrada';
    $args['labels']['not_found_in_trash'] = 'Entrada no encontrada en la papelera';
    $args['show_ui'] = true;
    $args['hierarchical'] = true;
    $args['public'] = true;
    $args['show_in_menu'] = true;
    $args['menu_position'] = 1;
    $args['supports'][] = 'page-attributes';
    $args['rewrite']['slug'] = 'artigos';

    return $args;
}

function setTipsLabelsInSpanish( $args ): array
{
    $args['labels']['name'] = 'Pronósticos';
    $args['labels']['singular_name'] = 'Pronóstico';
    $args['labels']['menu_name'] = 'Pronósticos';
    $args['labels']['all_items'] = 'Todos los pronósticos';
    $args['labels']['add_new'] = 'Agregar nuevo';
    $args['labels']['add_new_item'] = 'Agregar nuevo pronóstico';
    $args['labels']['edit_item'] = 'Editar pronóstico';
    $args['labels']['view_item'] = 'Ver pronóstico';
    $args['labels']['search_items'] = 'Buscar pronósticos';
    $args['labels']['not_found'] = 'No se encontraron pronósticos';
    $args['labels']['not_found_in_trash'] = 'No se encontraron pronósticos en la papelera';
    $args['rewrite']['slug'] = 'pronosticos';

    return $args;
}
function setTipsLabelsInPortuguese( $args ): array
{
    $args['labels']['name'] = 'Prognósticos';
    $args['labels']['singular_name'] = 'Prognóstico';
    $args['labels']['menu_name'] = 'Prognósticos';
    $args['labels']['all_items'] = 'Todos os prognósticos';
    $args['labels']['add_new'] = 'Adicionar novo';
    $args['labels']['add_new_item'] = 'Adicionar novo prognóstico';
    $args['labels']['edit_item'] = 'Editar prognóstico';
    $args['labels']['view_item'] = 'Ver prognóstico';
    $args['labels']['search_items'] = 'Procurar prognósticos';
    $args['labels']['not_found'] = 'Nenhum prognóstico encontrado';
    $args['labels']['not_found_in_trash'] = 'Nenhum prognóstico encontrado na lixeira';
    $args['rewrite']['slug'] = 'prognosticos';
    return $args;
}

function setHowToGuidesLabelsInSpanish( $args ): array
{
    $args['labels']['name'] = 'Guias Apuestas';
    $args['rewrite']['slug'] = 'guias-apuestas';

    return $args;
}

function setHowToGuidesLabelsInPortuguese( $args ): array
{
    $args['labels']['name'] = 'Guias De Aposta';
    $args['rewrite']['slug'] = 'guias-de-aposta';

    return $args;
}

