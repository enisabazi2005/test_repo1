<?php

namespace Bettingpro\ACFBlock;

use Bettingpro\Factory\BlockEditorFactory;

class SidebarBlock extends BlockEditorFactory
{
    /**
     * @string name
     * @string description
     * @string icon
     * @string path
     */
    public string $name = 'Sidebar';
    public string $description = 'Sidebar Template';
    public string $icon = 'money-alt';
    public string $path = 'sidebar-block';

}

