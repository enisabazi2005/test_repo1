<?php

namespace Bettingpro\ACFBlock;

use Bettingpro\Factory\BlockEditorFactory;

class ESTips extends BlockEditorFactory
{
    /**
     * @string name
     * @string description
     * @string icon
     * @string path
     */
    public string $name = 'ES Tips';
    public string $description = 'ES Tips block';
    public string $icon = 'money';
    public string $path = 'es-tips';

}