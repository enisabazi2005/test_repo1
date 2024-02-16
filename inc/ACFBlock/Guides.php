<?php

namespace Bettingpro\ACFBlock;

use Bettingpro\Factory\BlockEditorFactory;

class Guides extends BlockEditorFactory
{
    /**
     * @string name
     * @string description
     * @string icon
     * @string path
     */
    public string $name = 'Guides';
    public string $description = 'How to Guides';
    public string $icon = 'money';
    public string $path = 'guides';

}
