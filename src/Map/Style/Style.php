<?php

declare(strict_types=1);

namespace Cowegis\Bundle\Contao\Map\Style;

use Cowegis\Core\Definition\HasOptions;
use Cowegis\Core\Definition\Layer\Layer;
use Cowegis\Core\Definition\Path\Style as CoreStyle;

interface Style extends HasOptions, CoreStyle
{
    public function apply(Layer $layer): void;
}
