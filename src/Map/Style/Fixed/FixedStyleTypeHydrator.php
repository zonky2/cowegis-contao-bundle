<?php

declare(strict_types=1);

namespace Cowegis\Bundle\Contao\Map\Style\Fixed;

use Cowegis\Bundle\Contao\Map\Options\ConfigurableOptionsHydrator;
use Cowegis\Bundle\Contao\Model\StyleModel;
use Override;

final class FixedStyleTypeHydrator extends ConfigurableOptionsHydrator
{
    /** @var list<string>|array<string,string> */
    protected static array $options = [
        'stroke'      => 'stroke',
        'color'       => 'color',
        'weight'      => 'weight',
        'opacity'     => 'opacity',
        'lineCap'     => 'lineCap',
        'lineJoin'    => 'lineJoin',
        'dashArray'   => 'dashArray',
        'dashOffset'  => 'dashOffset',
        'fill'        => 'fill',
        'fillColor'   => 'fillColor',
        'fillOpacity' => 'fillOpacity',
        'fillRule'    => 'fillRule',
    ];

    #[Override]
    public function supports(object $data, object $definition): bool
    {
        if (! $definition instanceof FixedStyle) {
            return false;
        }

        if ($data instanceof StyleModel) {
            return $data->type === 'fixed';
        }

        return false;
    }
}
