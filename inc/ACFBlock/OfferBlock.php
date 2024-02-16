<?php

namespace Bettingpro\ACFBlock;

use Bettingpro\Factory\BlockEditorFactory;

class OfferBlock extends BlockEditorFactory
{
    /**
     * @string name
     * @string description
     * @string icon
     * @string path
     */
    public string $name = 'Offer Block';
    public string $description = 'Items of offer block';
    public string $icon = 'align-wide';
    public string $path = 'offer-block';
}
