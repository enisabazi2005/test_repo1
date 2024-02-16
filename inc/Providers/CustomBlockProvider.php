<?php

namespace Bettingpro\Providers;

use Bettingpro\Includes\Setup;

class CustomBlockProvider
{
    public static function initBlocks()
    {

        $acfBlockServices = Setup::getServices('ACFBlock');

        foreach ($acfBlockServices as $serviceClass) {
            $block = new $serviceClass();
            $blockData = $block->getBlockData();
            acf_register_block($blockData);
        }
    }
}
