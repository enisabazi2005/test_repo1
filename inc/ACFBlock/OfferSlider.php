<?php

namespace Bettingpro\ACFBlock;

use Bettingpro\Factory\BlockEditorFactory;

class OfferSlider extends BlockEditorFactory
{
    /**
     * @string name
     * @string description
     * @string icon
     * @string path
     */
    public string $name = 'Offer Slider';
    public string $description = 'Items of offer slider';
    public string $icon = 'slides';
    public string $path = 'offer-slider';
}

