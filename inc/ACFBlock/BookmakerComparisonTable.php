<?php

namespace Bettingpro\ACFBlock;

use Bettingpro\Factory\BlockEditorFactory;

class BookmakerComparisonTable extends BlockEditorFactory
{
    /**
     * @string name
     * @string description
     * @string icon
     * @string path
     */
    public string $name = 'Bookmaker Comparison Table';
    public string $description = 'Block to generate Bookmaker Comparison Table';
    public string $icon = 'grid-view';
    public string $path = 'bookmaker-comparison-table';

}