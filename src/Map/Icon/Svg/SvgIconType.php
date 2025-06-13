<?php

declare(strict_types=1);

namespace Cowegis\Bundle\Contao\Map\Icon\Svg;

use Cowegis\Bundle\Contao\Map\Icon\BaseIconType;
use Cowegis\Bundle\Contao\Model\IconModel;
use Cowegis\Core\Definition\Icon\Icon;
use Cowegis\Core\Definition\Icon\SvgIcon;
use Override;

final class SvgIconType extends BaseIconType
{
    #[Override]
    public function name(): string
    {
        return 'svg';
    }

    #[Override]
    public function createDefinition(IconModel $iconModel): Icon
    {
        return new SvgIcon($iconModel->iconId());
    }
}
