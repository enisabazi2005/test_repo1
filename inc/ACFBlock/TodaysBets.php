<?php

namespace Bettingpro\ACFBlock;

use Bettingpro\Factory\BlockEditorFactory;

class TodaysBets extends BlockEditorFactory
{
    /**
     * @string name
     * @string description
     * @string icon
     * @string path
     */
    public string $name = 'Today\'s Bets';
    public string $description = 'Today\'s Bets';
    public string $icon = 'money-alt';
    public string $path = 'todays-bets';

}

