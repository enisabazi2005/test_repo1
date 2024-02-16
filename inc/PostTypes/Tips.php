<?php

namespace Bettingpro\PostTypes;

use Bettingpro\Contracts\CustomPostType;

class Tips implements CustomPostType
{
    
    public static string $singularName = 'Tip';
    public static string $pluralName = 'Tips';

    public static function getPostType(): string
    {
        return 'tips';
    }

    public static function getPostTypeConfig(): array
    {
        $labels = [
            'name' => esc_html__(self::$pluralName, strtolower(self::$pluralName) . '-overview'),
            'singular_name' => esc_html__(self::$singularName, strtolower(self::$pluralName) . '-overview'),
            'plural_name' => esc_html__(self::$pluralName, strtolower(self::$pluralName) . '-overview'),
            'add_new' => esc_html__('Add New ', strtolower(self::$pluralName) . '-overview'),
            'add_new_item' => esc_html__('Add New ' . self::$singularName, strtolower(self::$pluralName) . '-overview'),
            'edit_item' => esc_html__('Edit ' . self::$singularName, strtolower(self::$pluralName) . '-overview'),
            'new_item' => esc_html__('New ' . self::$singularName, strtolower(self::$pluralName) . '-overview'),
            'all_items' => esc_html__('All ' . self::$pluralName, strtolower(self::$pluralName) . '-overview'),
            'search_items' => esc_html__('Search ' . self::$singularName, strtolower(self::$pluralName) . '-overview'),
            'not_found' => esc_html__('No ' . self::$singularName . ' Found', strtolower(self::$pluralName) . '-overview'),
            'not_found_in_trash' => esc_html__('No ' . self::$pluralName . ' Found in trash', strtolower(self::$pluralName) . '-overview'),
        ];

        return [
            'labels' => $labels,
            'show_in_rest' => true,
            'public' => true,
            "publicly_queryable" => true,
            "show_ui" => true, 
            'show_in_graphql' => true,
            'graphql_single_name' => 'tip', 
            'graphql_plural_name' => 'tips',
            "delete_with_user" => false,
            "rest_base" => "",
            "rest_controller_class" => "WP_REST_Posts_Controller",
            "show_in_menu" => true,
            'menu_position' => 8,
            'has_archive' => false,
            'supports' => ['editor', 'title', 'custom-fields', 'thumbnail', 'revisions', 'excerpt', 'page-attributes', 'author'],
            'hierarchical' => true,
            'rewrite' => [
                'slug' => 'tips',
                'with_front' => false
            ],
            "query_var" => true,
            "menu_icon" => "dashicons-welcome-write-blog",
        ];
    }
}
