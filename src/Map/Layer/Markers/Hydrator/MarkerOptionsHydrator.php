<?php

declare(strict_types=1);

namespace Cowegis\Bundle\Contao\Map\Layer\Markers\Hydrator;

use Cowegis\Bundle\Contao\Hydrator\Hydrator;
use Cowegis\Bundle\Contao\Map\Options\ConfigurableOptionsHydrator;
use Cowegis\Bundle\Contao\Model\LayerModel;
use Cowegis\Core\Definition\UI\Marker;
use Cowegis\Core\Provider\Context;

final class MarkerOptionsHydrator extends ConfigurableOptionsHydrator
{
    /** @var list<string>|array<string,string> */
    protected static array $options = [
        'interactive',
        'draggable',
        'keyboard',
        'opacity',
        'zIndexOffset',
        'riseOnHover',
    ];

    /** @var array<string,array<int|string,string>> */
    protected static array $conditionalOptions = [
        'riseOnHover' => ['riseOffset'],
    ];

    public function hydrate(object $data, object $definition, Context $context, Hydrator $hydrator): void
    {
        parent::hydrate($data, $definition, $context, $hydrator); // TODO: Change the autogenerated stub
    }

    protected function supportsDefinition(object $definition): bool
    {
        return $definition instanceof Marker;
    }

    protected function supportsData(object $data): bool
    {
        return $data instanceof LayerModel;
    }
}
