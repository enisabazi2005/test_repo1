<?php 
namespace Bettingpro\Includes;

class Helper {
    private static $instance;

    public static function getInstance() 
    {
        if (self::$instance === null)
            self::$instance = new Helper();

        return self::$instance;
    }
    
    public static function displaySection($sectionName) 
    {
        include get_template_directory() . '/template-parts/parts/' . $sectionName . '.php';
    }

    public static function getModifiedDate($post_id = null, $date_format = "M d, Y")
    {
        if ($post_id === null) 
        {
            $post_id = get_the_ID();
        }
        $revisions = wp_get_latest_revision_id_and_total_count($post_id);

        if ($post_id && isset($revisions["latest_id"])) {
            $revision_date = get_the_modified_date($date_format, $revisions["latest_id"]); 

            return $revision_date;
        } else {
            return  get_the_date($date_format, $post_id);
        }
    }
    public static function renderMonotizedTemplate ( $posts )
    {   
        global $monetized_bookmakers;

        if ( count( $posts ) > 1 )
        {
            $filtered_posts = array_filter($posts, function( $item ) 
            {
                $demonotized = get_field('main_info', $item->ID);
                $item->extra_data = $demonotized;
                return !$demonotized['demonotized_bookmaker'];
            });
            $filtered_ids = array_map(function ($item) {
                return $item->ID;
            }, $filtered_posts);
            
            if (count($filtered_posts) < 3) {
                $bookmakers = get_field('bookmakers', 'options');
                $extra_posts = array_filter($bookmakers, function ($item) use ($filtered_ids) {
                    $country_code= getCountryCode();
                    $demonotized = get_field('main_info', $item->ID);
                    $item->extra_data = $demonotized;
                    $terms = get_the_terms($item->ID, 'geo_location');
                    if($terms){
                        $slugs = array_column($terms, 'slug');
                        if (in_array(strtolower($country_code), $slugs)) {
                            return !$demonotized['demonotized_bookmaker'];
                        }
                    }else{
                        return !$demonotized['demonotized_bookmaker'];
                    }
                });
                array_push($filtered_posts, ...$extra_posts);
            }
            if(count($filtered_posts) > 0){
                $monetized_bookmakers = array_slice($filtered_posts, 0, 3);
            }
        }else{
            $bookmakers = get_field('bookmakers', 'options');
            if(is_array($bookmakers)){
                $filtered_posts = array_filter( $bookmakers, function( $item )
                {
                    $country_code= getCountryCode();
                    $demonotized = get_field('main_info', $item->ID );
                    $item->extra_data = $demonotized;
                    $terms = get_the_terms($item->ID, 'geo_location');
                    if($terms){
                        $slugs = array_column($terms, 'slug');
                        if (in_array(strtolower($country_code), $slugs)) {
                            return !$demonotized['demonotized_bookmaker'];
                        }
                    }else{
                        return !$demonotized['demonotized_bookmaker'];
                    }
                });
                if(count($filtered_posts) > 0){
                    $monetized_bookmakers = array_slice($filtered_posts, 0, 3);
                }
            }
        }
        get_template_part('template-parts/parts/demonotized-bookmakers-template');
    }

    private $blocks;

	/**
	 * Has block implementation counting with reusable blocks
	 *
	 * @param string $block_name Full Block type to look for.
	 * @return bool
	 */
	public function has_block($block_name)
	{

		if (has_block($block_name)) {
			return true;
		}

		$this->parse_reusable_blocks();

		if (empty($this->blocks)) {
			return false;
		}

		return $this->recursive_search_within_innerblocks($this->blocks, $block_name);
	}

	/**
	 * Search for a reusable block inside innerblocks
	 *
	 * @param array $blocks Blocks to loop through.
	 * @param string $block_name BFull Block type to look for.
	 * @return true|void
	 */
	private function recursive_search_within_innerblocks($blocks, $block_name)
	{
		foreach ($blocks as $block) {
			if (isset($block['innerBlocks']) && !empty($block['innerBlocks'])) {
				$this->recursive_search_within_innerblocks($block['innerBlocks'], $block_name);
			} elseif ($block['blockName'] === 'core/block' && !empty($block['attrs']['ref']) && \has_block($block_name, $block['attrs']['ref'])) {
				return true;
			}
		}
		return false;
	}

	/**
	 * Parse blocks if at leat one reusable block is presnt.
	 *
	 * @return void
	 */
	private function parse_reusable_blocks()
	{

		if ($this->blocks !== null) {
			return;
		}

		if (has_block('core/block')) {
			$content = get_post_field('post_content');
			$this->blocks = parse_blocks($content);
			return;
		}

		$this->blocks = false;
	}
}