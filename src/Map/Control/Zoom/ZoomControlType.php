<?php

declare(strict_types=1);

namespace Cowegis\Bundle\Contao\Map\Control\Zoom;

use Cowegis\Bundle\Contao\Map\Control\ControlType;
use Cowegis\Bundle\Contao\Model\ControlModel;
use Cowegis\Core\Definition\Control;
use Cowegis\Core\Definition\Control\ZoomControl;
use Override;

final class ZoomControlType implements ControlType
{
    #[Override]
    public function name(): string
    {
        return 'zoom';
    }

    #[Override]
    public function createDefinition(ControlModel $controlModel): Control
    {
        return new ZoomControl(
            $controlModel->controlId(),
            $controlModel->alias ?: 'control_' . $controlModel->id(),
        );
    }
}
