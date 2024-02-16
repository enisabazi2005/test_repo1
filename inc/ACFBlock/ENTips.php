<?php

namespace Bettingpro\ACFBlock;

use Bettingpro\Factory\BlockEditorFactory;

class ENTips extends BlockEditorFactory
{
    /**
     * @string name
     * @string description
     * @string icon
     * @string path
     */
    public string $name = 'EN Tips';
    public string $description = 'EN Tips block';
    public string $icon = 'money';
    public string $path = 'en-tips';

}