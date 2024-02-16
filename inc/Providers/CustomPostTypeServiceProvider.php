<?php

namespace Bettingpro\Providers;

use Bettingpro\Includes\Setup;

class CustomPostTypeServiceProvider
{
    public function initPostTypes()
    {

        $services = Setup::getServices('PostTypes');

        foreach ($services as $service) {
            register_post_type($service::getPostType(), $service::getPostTypeConfig());
        }
    }
}
