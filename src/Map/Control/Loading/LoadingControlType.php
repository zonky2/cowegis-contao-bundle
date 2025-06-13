<?php

declare(strict_types=1);

namespace Cowegis\Bundle\Contao\Map\Control\Loading;

use Cowegis\Bundle\Contao\Map\Control\ControlType;
use Cowegis\Bundle\Contao\Model\ControlModel;
use Cowegis\Core\Definition\Control;
use Cowegis\Core\Definition\Control\LoadingControl;
use Override;

final class LoadingControlType implements ControlType
{
    #[Override]
    public function name(): string
    {
        return 'loading';
    }

    #[Override]
    public function createDefinition(ControlModel $controlModel): Control
    {
        return new LoadingControl(
            $controlModel->controlId(),
            $controlModel->alias ?: 'control_' . $controlModel->id(),
        );
    }
}
