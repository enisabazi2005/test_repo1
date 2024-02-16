<?php
namespace Bettingpro\Includes;

use Bettingpro\Providers\CustomBlockProvider;
use Bettingpro\Providers\CustomPostTypeServiceProvider;
use Bettingpro\Providers\TaxonomiesServiceProvider;

class Init
{
    public function __construct()
    {
        $this->define_settings();
        $this->define_hooks();
    }
    private function define_settings()
    {
        register_nav_menus(
            [
                'main_menu' => 'Main menu',
                'top_menu' => 'Top menu',
                'language_switcher' => 'Language switcher',
            ]
        );
        add_theme_support('post-thumbnails');
        add_theme_support( 'custom-logo' );
        add_theme_support( 'title-tag' );
        add_image_size('footer_logo', 220, 9999, false);
        add_image_size('menu-icon', 20, 20, false);

        if (function_exists('acf_add_options_page')) 
        {
            acf_add_options_page('Footer Settings');
            acf_add_options_page([
                'page_title' => __('Demonotized Bookmakers Template'),
                'menu_title' => __('Demonotized Bookmakers Template'),
                'menu_slug' => 'demonotized-bookmakers-template',
            ]);
            acf_add_options_page('Theme Settings');
        }
        remove_action( 'wp_head', 'wp_generator' );
    }
    private function define_hooks()
    {
        add_action('init', [new CustomPostTypeServiceProvider(), 'initPostTypes']);
        add_action('init', [new TaxonomiesServiceProvider(), 'initTaxonomies']);
        add_action('init', [new CustomBlockProvider(), 'initBlocks']);
        add_action('after_setup_theme', [new Setup(), 'bettingpro_support']);
        add_action('admin_enqueue_scripts', [new Setup(), 'bettingpro_styles']);
        add_action('wp_enqueue_scripts', [new Setup(), 'bettingpro_styles']);
        add_action('wp_enqueue_scripts', [new Setup(), 'bettingpro_styles']);
        add_action('widgets_init',  [new Setup(), 'bettingpro_widgets_init']);
        add_action('init', [ new Setup(), 'register_menus']);
        add_action('wp_enqueue_scripts',[new Setup(), 'bettingpro_scripts']);
        add_filter( 'script_loader_tag',[new Setup(), 'add_script_preload_attribute'], 10, 2 );
        add_filter( 'style_loader_tag', [new Setup(),'add_style_preload_attribute'], 10, 2 );
        add_action('wp_head', [new Setup(), 'custom_header_metadata']);
        add_filter('upload_mimes',[new Setup(), 'cc_mime_types']);
        add_filter('nav_menu_link_attributes', [ new Setup(), 'filter_nav_menu_link_attributes'], 10, 4);
        add_filter('nav_menu_css_class',[new Setup(), 'filter_nav_menu_css_classes'], 10, 4);
        add_action('admin_enqueue_scripts', [new Setup(), 'bettingpro_scripts']);
        add_action( 'wp_enqueue_scripts',[new Setup(), 'slick_slider_js'] , 11);
        add_filter('upload_mimes',[new Setup(),  'cc_mime_types']);
        add_action( 'acf/validate_save_post', [new Setup(), '_validate_save_post'], 5 );
        add_filter( 'script_loader_tag', [new Setup(), 'defers'], 10, 2 );
        add_filter('user_contactmethods',[new Setup(),  'user_social_links'],10,1);
        add_filter('body_class', [new Setup(), 'add_blog_slug_body_class']);
        add_action( 'wp_head',[new Setup(), 'custom_meta_author' ]);
        add_action('wp_head',[new Setup(), 'add_hreflangs_to_head']);
        add_filter( 'acf/prepare_field', [new Setup(), 'my_admin_only_prepare_field']);
        add_filter('register_post_type_args',[new Setup(),  'translatePostTypes'],10,2);
        add_filter( 'acf/prepare_field', [new Setup(), 'filter_by_category_en']);
        add_filter( 'acf/prepare_field', [new Setup(), 'es_categories_select']);
        add_filter( 'acf/prepare_field', [new Setup(), 'filter_by_cats']);
        add_filter( 'acf/fields/relationship/query/name=select_es_tips', [new Setup(), 'populate_estips_relationship'], 10, 3 );
        add_filter( 'acf/fields/relationship/query/name=select_latest_es_tips', [new Setup(), 'populate_toptips_relationship'], 10, 3 );
        add_filter( 'acf/fields/relationship/query/name=select_en_tips', [new Setup(), 'populate_entips_relationship'], 10, 3 );
        add_filter( 'acf/fields/relationship/query/name=select_latest_en_tips', [new Setup(), 'populate_entips_relationship'], 10, 3 );
        add_filter( 'wpseo_robots',[new Setup(), 'remove_author_robots_meta' ]);
        add_filter( 'wpseo_breadcrumb_output',[new Setup(), 'custom_yoast_breadcrumb'], 10, 2 );
    }
}