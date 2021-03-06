<?php
declare(strict_types = 1);

namespace App\Gear\Factory\Filter;

use App\Gear\Filtration\Filters\BodyIsolatorFilter;
use App\Gear\Filtration\Filters\CommentsCleanerFilter;
use App\Gear\Filtration\Filters\FilterEssence\FilterInterface;
use App\Gear\Filtration\Filters\ScriptCleanerFilter;
use App\Gear\Filtration\Filters\StyleCleanerFilter;
use App\Gear\Filtration\Filters\SvgCleanerFilter;

/**
 * @author Roman Bondarenko <rom_bon@mail.ru>
 *
 * BaseFilterFactory
 */
class BaseFilterFactory implements FilterFactoryInterface
{
    /**
     * @inheritDoc
     */
    public function createFilter(): FilterInterface
    {
        $filter = new BodyIsolatorFilter();
        $filter->setFilter(new CommentsCleanerFilter())
            ->setFilter(new ScriptCleanerFilter())
            ->setFilter(new StyleCleanerFilter())
            ->setFilter(new SvgCleanerFilter());

        return $filter;
    }
}
