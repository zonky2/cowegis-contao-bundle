<?php

declare(strict_types=1);

namespace Cowegis\Bundle\Contao\Map\Control;

use Cowegis\Bundle\Contao\Map\Options\ConfigurableOptionsHydrator;
use Cowegis\Bundle\Contao\Model\ControlModel;
use Cowegis\Core\Definition\Control;
use Override;

abstract class ControlTypeHydrator extends ConfigurableOptionsHydrator
{
    #[Override]
    public function supports(object $data, object $definition): bool
    {
        if (! parent::supports($data, $definition)) {
            return false;
        }

        return $data->type === $this->supportedType();
    }

    #[Override]
    protected function supportsDefinition(object $definition): bool
    {
        return $definition instanceof Control;
    }

    #[Override]
    protected function supportsData(object $data): bool
    {
        return $data instanceof ControlModel;
    }

    abstract protected function supportedType(): string;
}
