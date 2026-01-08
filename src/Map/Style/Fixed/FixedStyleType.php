<?php

declare(strict_types=1);

namespace Cowegis\Bundle\Contao\Map\Style\Fixed;

use Cowegis\Bundle\Contao\Map\Style\Style;
use Cowegis\Bundle\Contao\Map\Style\StyleType;
use Cowegis\Bundle\Contao\Model\StyleModel;
use Override;

final class FixedStyleType implements StyleType
{
    #[Override]
    public function name(): string
    {
        return 'fixed';
    }

    #[Override]
    public function createDefinition(StyleModel $styleModel): Style
    {
        return new FixedStyle();
    }
}
