<?php

namespace Bettingpro\Taxonomies;

use \Bettingpro\Contracts\Categories;

class Locations implements Categories
{

    private string $category_singular_name = "Location";
    private string $category_plural_name = "Locations";
    private string $category_slug = "geo_location";
    private array $show_categories_on_post_types = ['bookmakers','ad_banners', 'cta_banner', 'sticky_banner'];


    public function getCategoryArgs(): array
    {
        $labels = [
            'name'                      => __( str_replace('-',' ', $this->category_plural_name ), 'Location' ),
            'singular_name'             => __( str_replace('-',' ', $this->category_singular_name ), 'Locations' ),
            'search_items'              => __( 'Search ' . str_replace('-',' ', $this->category_plural_name ) ),
            'all_items'                 => __( 'All ' . str_replace('-',' ', $this->category_plural_name )),
            'parent_item'               => __( 'Parent ' . str_replace('-',' ', $this->category_singular_name ) ),
            'parent_item_colon'         => __( 'Parent ' .  str_replace('-',' ', $this->category_singular_name ) .':' ),
            'edit_item'                 => __( 'Edit ' . str_replace('-',' ', $this->category_singular_name ) ),
            'update_item'               => __( 'Update ' .str_replace('-',' ', $this->category_singular_name ) ),
            'add_new_item'              => __( 'Add New ' . str_replace('-',' ', $this->category_singular_name ) ),
            'new_item_name'             => __( 'New '. str_replace('-',' ', $this->category_singular_name ) .' Name' ),
            'menu_name'                 => __( str_replace('-',' ', $this->category_plural_name )),
        ];

        return [
            'hierarchical'      => true,
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'show_in_rest'      => true,
            'query_var'         => true,
            'rewrite'           => [ 'slug' => $this->category_slug ],
        ];
    }

    public function getTaxonomySlug(): string
    {

        return $this->category_slug;
    }

    public function getShowCategoriesOnPostType(): array
    {

        return $this->show_categories_on_post_types;
    }
}
