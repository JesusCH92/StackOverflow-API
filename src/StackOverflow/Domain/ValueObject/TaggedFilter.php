<?php

declare(strict_types=1);

namespace App\StackOverflow\Domain\ValueObject;

use App\StackOverflow\Domain\Exception\TaggedIsEmpty;

final class TaggedFilter
{
    public const TAGGED_FILTER = '&tagged=';
    private string $tagged;

    public function __construct(string $tagged)
    {
        $this->setTagged($tagged);
    }

    private function guardIfIsNotEmpty(string $tagged): void
    {
        if ('' === $tagged) {
            throw new TaggedIsEmpty($tagged);
        }
    }

    private function setTagged(string $tagged): void
    {
        $this->guardIfIsNotEmpty($tagged);
        $this->tagged = $tagged;
    }

    public function tagged(): string
    {
        return $this->tagged;
    }

    public function taggedFilterFormat(): string
    {
        return self::TAGGED_FILTER . $this->tagged;
    }
}