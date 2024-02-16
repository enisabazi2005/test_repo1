<?php

namespace Bettingpro\Includes;

class DisplayBlocks
{

    private $blocks;
    private $blocks_name;

    function __construct($blocks)
    {
        $this->blocks = parse_blocks($blocks);
        $this->blocks_name = array_column($this->blocks, 'blockName');
    }

    function get_blocks()
    {
        return $this->blocks;
    }

    function set_blocks($blocks)
    {
        $this->blocks = $blocks;
    }

    function set_blocks_name($blocks_name)
    {
        $this->blocks_name = $blocks_name;
    }

    function get_blocks_name()
    {
        return $this->blocks_name;
    }

    function display_blocks($show_blocks)
    {
        $blocks = $this->get_blocks();

        foreach ($blocks as $key => $block) {
            if (!empty($show_blocks) && is_array($show_blocks)) {
                if (in_array($block['blockName'], $show_blocks)) {
                    echo render_block($block);
                    unset($blocks[$key]);
                    $this->set_blocks($blocks);
                }
            } elseif (
                $block['blockName'] !== null 
                && !str_contains($block['blockName'], 'sidebar')
            ) {
                if ('core/paragraph' === $block['blockName'] || 'core/shortcode' === $block['blockName']) {
                    echo apply_filters('the_content', render_block($block));
                }else if ($block['blockName'] === 'core/embed' && isset($block['attrs']['providerNameSlug']) && $block['attrs']['providerNameSlug'] === 'youtube') {
                    $block_content = wp_oembed_get($block['attrs']['url']);
                    echo $block_content;
                }else if ($block['blockName'] === 'core/embed' && isset($block['attrs']['url']) && strpos($block['attrs']['url'], 'twitter.com') !== false) {
                    $tweetUrl = $block['attrs']['url'];
    
                    $oEmbedUrl = 'https://publish.twitter.com/oembed?url=' . urlencode($tweetUrl);
                    $response = file_get_contents($oEmbedUrl);
                    $responseData = json_decode($response, true);
                    
                    if (isset($responseData['html'])) {
                        // Output the embedded HTML markup
                        echo $responseData['html'];
                    }
                }
                else {
                    echo render_block($block);
                }
                unset($blocks[$key]);
                $this->set_blocks($blocks);
            }
        }
    }

    function display_sidebar()
    {
        $blocks = $this->get_blocks();

        if (is_array($blocks)) {
            foreach ($blocks as $key => $block) {
                if ($block['blockName'] !== null && str_contains($block['blockName'], 'sidebar')) {
                    echo render_block($block);
                    unset($blocks[$key]);
                    $this->set_blocks($blocks);
                }
            }
        }
    }

    function single_block($show_blocks)
    {
        $blocks = $this->get_blocks();
        $blocks_name = $this->get_blocks_name();

        if (empty($blocks)) return false;

        foreach ($blocks as $key => $value) {
            if ($value['blockName'] == $show_blocks) {
                $single_block = $blocks[$key];

                unset($blocks[$key]);
                unset($blocks_name[$key]);
                $this->set_blocks($blocks);
                $this->set_blocks_name($blocks_name);

                echo render_block($single_block);
            }
        }
    }
}
