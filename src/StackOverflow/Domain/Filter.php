<?php

declare(strict_types=1);

namespace App\StackOverflow\Domain;

use App\StackOverflow\Domain\ValueObject\DateFilter;
use App\StackOverflow\Domain\ValueObject\TaggedFilter;

final class Filter
{
    private TaggedFilter $tagged;
    private DateFilter $dateFilter;

    public function __construct(TaggedFilter $tagged, DateFilter $dateFilter)
    {
        $this->tagged = $tagged;
        $this->dateFilter = $dateFilter;
    }

    public function tagged(): TaggedFilter
    {
        return $this->tagged;
    }

    public function dateFilter(): DateFilter
    {
        return $this->dateFilter;
    }
}