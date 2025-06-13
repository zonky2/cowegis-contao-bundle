<?php

declare(strict_types=1);

namespace Cowegis\Bundle\Contao\Map\Icon;

use Countable;
use Iterator;
use Override;

use function count;

/** @implements Iterator<array-key, IconType> */
final class IconTypeIterator implements Countable, Iterator
{
    /** @var IconType[] */
    private array $iconTypes;

    private int $position;

    public function __construct(IconType ...$iconTypes)
    {
        $this->iconTypes = $iconTypes;
        $this->position  = 0;
    }

    #[Override]
    public function current(): IconType
    {
        return $this->iconTypes[$this->position];
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
        return $this->position < count($this->iconTypes);
    }

    #[Override]
    public function rewind(): void
    {
        $this->position = 0;
    }

    #[Override]
    public function count(): int
    {
        return count($this->iconTypes);
    }
}
