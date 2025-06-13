<?php

declare(strict_types=1);

namespace Cowegis\Bundle\Contao\Map\Control;

use Countable;
use Iterator;
use Override;

use function count;

/** @implements Iterator<array-key, ControlType> */
final class ControlTypeIterator implements Countable, Iterator
{
    /** @var ControlType[] */
    private array $controlTypes;

    private int $position;

    public function __construct(ControlType ...$controlTypes)
    {
        $this->controlTypes = $controlTypes;
        $this->position     = 0;
    }

    #[Override]
    public function current(): ControlType
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
