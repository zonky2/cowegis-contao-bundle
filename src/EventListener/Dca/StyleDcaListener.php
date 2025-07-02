<?php

declare(strict_types=1);

namespace Cowegis\Bundle\Contao\EventListener\Dca;

use Contao\CoreBundle\DependencyInjection\Attribute\AsCallback;
use Cowegis\Bundle\Contao\Map\Style\StyleTypeRegistry;
use Netzmacht\Contao\Toolkit\Dca\DcaManager;
use Netzmacht\Contao\Toolkit\Dca\Listener\AbstractListener;
use Override;

final class StyleDcaListener extends AbstractListener
{
    public function __construct(DcaManager $dcaManager, private readonly StyleTypeRegistry $styleTypes)
    {
        parent::__construct($dcaManager);
    }

    #[Override]
    public static function getName(): string
    {
        return 'tl_cowegis_style';
    }

    /**
     * Get style type options.
     *
     * @return string[]
     */
    #[AsCallback('tl_cowegis_style', 'fields.type.options')]
    public function typeOptions(): array
    {
        $options = [];
        foreach ($this->styleTypes as $styleType) {
            $options[] = $styleType->name();
        }

        return $options;
    }
}
