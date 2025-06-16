<?php

declare(strict_types=1);

namespace Cowegis\Bundle\Contao\Map\Icon\Div;

use Cowegis\Bundle\Contao\Map\Icon\IconTypeHydrator;
use Cowegis\Core\Definition\Icon\DivIcon;
use Override;

final class DivIconHydrator extends IconTypeHydrator
{
    /** @var list<string>|array<string,string> */
    protected static array $options = [
        'html',
        'className',
    ];

    #[Override]
    protected function supportedType(): string
    {
        return 'div';
    }

    #[Override]
    protected function supportedDefinition(): string
    {
        return DivIcon::class;
    }
}
