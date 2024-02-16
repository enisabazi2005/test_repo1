<?php

namespace Bettingpro\ACFBlock;

use Bettingpro\Factory\BlockEditorFactory;

class BookmakerTopList extends BlockEditorFactory
{
    /**
     * @string name
     * @string description
     * @string icon
     * @string path
     */
    public string $name = 'Bookmaker Toplists';
    public string $description = 'Block to generate Bookmaker toplists';
    public string $icon = 'excerpt-view';
    public string $path = 'bookmaker-toplists';

}

