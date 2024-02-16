<?php

namespace Bettingpro\ACFBlock;

use Bettingpro\Factory\BlockEditorFactory;

class TakeoverBlock extends BlockEditorFactory
{
    /**
     * @string name
     * @string description
     * @string icon
     * @string path
     */
    public string $name = "Takeover";
    public string $description = "Takeover";
    public string $icon = "cover-image";
    public string $path = "takeover-block";
}
