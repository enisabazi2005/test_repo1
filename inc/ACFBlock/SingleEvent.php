<?php

namespace Bettingpro\ACFBlock;

use Bettingpro\Factory\BlockEditorFactory;

class SingleEvent extends BlockEditorFactory
{
    /**
     * @string name
     * @string description
     * @string icon
     * @string path
     */
    public string $name = 'Single Event';
    public string $description = 'Single Event Block';
    public string $icon = 'calendar-alt';
    public string $path = 'single-event';
}
