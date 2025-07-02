<?php

declare(strict_types=1);

namespace Cowegis\Bundle\Contao\Map\Style\Fixed;

use Cowegis\Bundle\Contao\Map\Style\Style;
use Cowegis\Core\Constraint\BooleanConstraint;
use Cowegis\Core\Constraint\FloatConstraint;
use Cowegis\Core\Constraint\IntegerConstraint;
use Cowegis\Core\Constraint\StringConstraint;
use Cowegis\Core\Definition\Layer\Layer;
use Cowegis\Core\Definition\OptionsPlugin;
use Override;

final class FixedStyle implements Style
{
    use OptionsPlugin;

    /** {@inheritDoc} */
    #[Override]
    protected function optionConstraints(): array
    {
        return [
            'stroke'      => BooleanConstraint::withDefaultValue(true),
            'color'       => StringConstraint::withDefaultValue('#3388ff'),
            'weight'      => IntegerConstraint::withDefaultValue(3),
            'opacity'     => FloatConstraint::withDefaultValue(1.0),
            'lineCap'     => StringConstraint::withDefaultValue('round'),
            'lineJoin'    => StringConstraint::withDefaultValue('round'),
            'dashArray'   => StringConstraint::withDefaultValue(null),
            'dashOffset'  => StringConstraint::withDefaultValue(null),
            'fill'        => new BooleanConstraint(),
            'fillColor'   => StringConstraint::withDefaultValue('*'),
            'fillOpacity' => FloatConstraint::withDefaultValue(0.2),
            'fillRule'    => StringConstraint::withDefaultValue('evenodd'),
        ];
    }

    #[Override]
    public function apply(Layer $layer): void
    {
        $layer->options()->merge($this->options()->toArray());
    }

    /** {@inheritDoc} */
    #[Override]
    public function jsonSerialize(): array
    {
        return $this->options()->toArray();
    }
}
