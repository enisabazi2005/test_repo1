<?php

namespace Bettingpro\ACFBlock;

use Bettingpro\Factory\BlockEditorFactory;

class TipsBlock extends BlockEditorFactory
{
    /**
     * @string name
     * @string description
     * @string icon
     * @string path
     */
    public string $name = 'Tips';
    public string $description = 'Tips block';
    public string $icon = 'money';
    public string $path = 'tips';

}
