<?php

namespace Bettingpro\ACFBlock;

use Bettingpro\Factory\BlockEditorFactory;

class FlexibleContent extends BlockEditorFactory
{
    /**
     * @string name
     * @string description
     * @string icon
     * @string path
     */
    public string $name = 'Flexible Content';
    public string $description = 'Content below this block will show full width';
    public string $icon = 'align-wide';
    public string $path = 'flexible-content';

}

