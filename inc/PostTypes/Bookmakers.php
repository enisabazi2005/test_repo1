<?php

namespace Bettingpro\PostTypes;

use Bettingpro\Contracts\CustomPostType;

class Bookmakers implements CustomPostType
{

    public static string $singular_name = "Bookmaker";
    public static string $plural_name = "Bookmakers";
    public static array $metaFields = [ "bookmaker_rating", "logo", "bookmaker_name" ];

    public static function getPostType(): string
    {
        return "bookmakers";
    }

    public static function getPostTypeConfig(): array
    {
        $labels = [
            "name" => esc_html__( self::$plural_name, strtolower(self::$plural_name) ),
            "singular_name" => esc_html__(self::$singular_name, strtolower(self::$plural_name) ),
            "plural_name" => esc_html__(self::$plural_name, strtolower(self::$plural_name) ),
            "add_new" => esc_html__("Add New ", strtolower(self::$plural_name) ),
            "add_new_item" => esc_html__("Add New " . self::$singular_name, strtolower(self::$plural_name) ),
            "edit_item" => esc_html__("Edit " . self::$singular_name, strtolower(self::$plural_name)),
            "new_item" => esc_html__("New " . self::$singular_name, strtolower(self::$plural_name)),
            "all_items" => esc_html__("All " . self::$plural_name, strtolower(self::$plural_name)),
            "search_items" => esc_html__("Search " . self::$singular_name, strtolower(self::$plural_name)),
            "not_found" => esc_html__("No " . self::$singular_name . " Found", strtolower(self::$plural_name)),
            "not_found_in_trash" => esc_html__("No ". self::$plural_name ." Found in trash", strtolower(self::$plural_name)),
        ];

        return [
            "labels"        => $labels,
            "show_in_rest" => true,
            "public"        => true,
            "publicly_queryable" => true,
            "show_ui" => true,
            'show_in_graphql' => true,
            'graphql_single_name' => 'bookmaker', 
            'graphql_plural_name' => 'bookmakers',
            "delete_with_user" => false,
            "rest_base" => "",
            "rest_controller_class" => "WP_REST_Posts_Controller",
            "show_in_menu" => true,
            "menu_position" => 6,
            "has_archive"   => false,
            "supports"      => ["title", "editor", "thumbnail", "revisions", "excerpt", "custom-fields", "page-attributes", "author"],
            "hierarchical"  => true,
            "rewrite" => array( "slug" => self::getPostType(), "with_front" => true ),
            "query_var" => true,
            "menu_icon" => "dashicons-book-alt",
        ];
    }
}
