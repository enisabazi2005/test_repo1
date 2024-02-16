<?php

namespace Bettingpro\ACFBlock;

use Bettingpro\Factory\BlockEditorFactory;

class BookmakerSidebar extends BlockEditorFactory
{
    /**
     * @string name
     * @string description
     * @string icon
     * @string path
     */
    public string $name = 'Bookmaker Sidebar';
    public string $description = 'Block to generate Bookmaker Sidebar';
    public string $icon = 'excerpt-view';
    public string $path = 'bookmaker-sidebar';

}

