<?php

declare(strict_types=1);

namespace Cowegis\Bundle\Contao\Map\Style;

use Cowegis\Bundle\Contao\Model\StyleModel;

interface StyleType
{
    public function name(): string;

    public function createDefinition(StyleModel $styleModel): Style;
}
