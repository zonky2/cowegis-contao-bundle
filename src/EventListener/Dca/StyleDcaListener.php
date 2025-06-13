<?php

declare(strict_types=1);

namespace Cowegis\Bundle\Contao\EventListener\Dca;

use Netzmacht\Contao\Toolkit\Dca\Listener\AbstractListener;
use Override;

final class StyleDcaListener extends AbstractListener
{
    #[Override]
    public static function getName(): string
    {
        return 'tl_cowegis_style';
    }
}
