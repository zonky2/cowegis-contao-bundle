<?php

declare(strict_types=1);

namespace Cowegis\Bundle\Contao\Map\Icon\Image;

use Cowegis\Bundle\Contao\Map\Icon\BaseIconType;
use Cowegis\Bundle\Contao\Model\IconModel;
use Cowegis\Core\Definition\Icon\Icon;
use Cowegis\Core\Definition\Icon\ImageIcon;
use Override;

final class ImageIconType extends BaseIconType
{
    #[Override]
    public function name(): string
    {
        return 'image';
    }

    #[Override]
    public function createDefinition(IconModel $iconModel): Icon
    {
        return new ImageIcon($iconModel->iconId());
    }
}
