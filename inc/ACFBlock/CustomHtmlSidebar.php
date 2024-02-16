<?php

namespace Bettingpro\ACFBlock;

use Bettingpro\Factory\BlockEditorFactory;

class CustomHtmlSidebar extends BlockEditorFactory
{
    /**
     * @string name
     * @string description
     * @string icon
     * @string path
     */
    public string $name = 'Custom HTML Sidebar';
    public string $description = 'Custom HTML Sidebar';
    public string $icon = 'html';
    public string $path = 'custom-html-sidebar';

}