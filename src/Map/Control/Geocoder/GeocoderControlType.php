<?php

declare(strict_types=1);

namespace Cowegis\Bundle\Contao\Map\Control\Geocoder;

use Cowegis\Bundle\Contao\Map\Control\ControlType;
use Cowegis\Bundle\Contao\Model\ControlModel;
use Cowegis\Core\Definition\Control;
use Cowegis\Core\Definition\Control\GeocoderControl;
use Override;

final class GeocoderControlType implements ControlType
{
    #[Override]
    public function name(): string
    {
        return 'geocoder';
    }

    #[Override]
    public function createDefinition(ControlModel $controlModel): Control
    {
        return new GeocoderControl(
            $controlModel->controlId(),
            $controlModel->alias ?: 'control_' . $controlModel->id(),
        );
    }
}
