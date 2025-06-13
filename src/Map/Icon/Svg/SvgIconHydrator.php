<?php

declare(strict_types=1);

namespace Cowegis\Bundle\Contao\Map\Icon\Svg;

use Cowegis\Bundle\Contao\Map\Icon\IconTypeHydrator;
use Cowegis\Core\Definition\Icon\SvgIcon;
use Override;

final class SvgIconHydrator extends IconTypeHydrator
{
    /** @var list<string>|array<string,string> */
    protected static array $options = [
        'bgColor'   => 'backgroundColor',
        'color'     => 'iconColor',
        'className' => 'className',
        'html'      => 'content',
    ];

    /** @var list<string>|array<string,string> */
    protected static array $pointOptions = [
        'iconSize',
        'iconAnchor',
        'popupAnchor',
        'tooltipAnchor',
    ];

    #[Override]
    protected function supportedType(): string
    {
        return 'svg';
    }

    #[Override]
    protected function supportedDefinition(): string
    {
        return SvgIcon::class;
    }
}
