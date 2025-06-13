<?php

declare(strict_types=1);

namespace Cowegis\Bundle\Contao\Map\Icon;

use Override;

abstract class BaseIconType implements IconType
{
    /** {@inheritDoc} */
    #[Override]
    public function label(string $label, array $row): string
    {
        return $label;
    }
}
