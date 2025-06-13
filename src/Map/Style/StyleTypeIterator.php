<?php

declare(strict_types=1);

namespace Cowegis\Bundle\Contao\Map\Style;

use Countable;
use Iterator;
use Override;

use function count;

/** @implements Iterator<array-key,StyleType> */
final class StyleTypeIterator implements Countable, Iterator
{
    /** @var StyleType[] */
    private array $controlTypes;

    private int $position;

    public function __construct(StyleType ...$controlTypes)
    {
        $this->controlTypes = $controlTypes;
        $this->position     = 0;
    }

    #[Override]
    public function current(): StyleType
    {
        return $this->controlTypes[$this->position];
    }

    #[Override]
    public function next(): void
    {
        $this->position++;
    }

    #[Override]
    public function key(): int
    {
        return $this->position;
    }

    #[Override]
    public function valid(): bool
    {
        return $this->position < count($this->controlTypes);
    }

    #[Override]
    public function rewind(): void
    {
        $this->position = 0;
    }

    #[Override]
    public function count(): int
    {
        return count($this->controlTypes);
    }
}
