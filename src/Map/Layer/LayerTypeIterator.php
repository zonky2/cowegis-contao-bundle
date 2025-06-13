<?php

declare(strict_types=1);

namespace Cowegis\Bundle\Contao\Map\Layer;

use Countable;
use Iterator;
use Override;

use function count;

/** @implements Iterator<array-key, LayerType> */
final class LayerTypeIterator implements Countable, Iterator
{
    /** @var LayerType[] */
    private array $layerTypes;

    private int $position;

    public function __construct(LayerType ...$layerTypes)
    {
        $this->layerTypes = $layerTypes;
        $this->position   = 0;
    }

    #[Override]
    public function current(): LayerType
    {
        return $this->layerTypes[$this->position];
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
        return $this->position < count($this->layerTypes);
    }

    #[Override]
    public function rewind(): void
    {
        $this->position = 0;
    }

    #[Override]
    public function count(): int
    {
        return count($this->layerTypes);
    }
}
