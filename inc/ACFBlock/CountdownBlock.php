<?php

namespace Bettingpro\ACFBlock;

use Bettingpro\Factory\BlockEditorFactory;

class CountdownBlock extends BlockEditorFactory
{
    /**
     * @string name
     * @string description
     * @string icon
     * @string path
     */
    public string $name = 'Countdown';
    public string $description = 'Countdown block';
    public string $icon = 'clock';
    public string $path = 'countdown';

}