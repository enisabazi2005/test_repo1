<?php

namespace Bettingpro\Providers;

use Bettingpro\Includes\Setup;

class TaxonomiesServiceProvider
{
    public function initTaxonomies(): void
    {

        $taxonomies = Setup::getServices('Taxonomies');

        foreach ($taxonomies as $taxonomyClass) {
            $taxonomy = new $taxonomyClass;
            register_taxonomy(
                $taxonomy->getTaxonomySlug(),
                $taxonomy->getShowCategoriesOnPostType(),
                $taxonomy->getCategoryArgs()
            );
        }
    }
}
