<?php

namespace Bettingpro\ACFBlock;

use Bettingpro\Factory\BlockEditorFactory;

class ImageIframeWidget extends BlockEditorFactory
{
    /**
     * @string name
     * @string description
     * @string icon
     * @string path
     */
    public string $name = 'Image/Iframe Widget';
    public string $description = 'Image/Iframe Widget';
    public string $icon = 'cover-image';
    public string $path = 'image-iframe-widget';

}

