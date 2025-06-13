<?php

declare(strict_types=1);

namespace Cowegis\Bundle\Contao\Hydrator;

use Cowegis\Core\Provider\Context;
use Override;
use Psr\EventDispatcher\EventDispatcherInterface;

final class EventDispatchingHydrator implements Hydrator
{
    public function __construct(private readonly EventDispatcherInterface $eventDispatcher)
    {
    }

    #[Override]
    public function supports(object $data, object $definition): bool
    {
        return true;
    }

    #[Override]
    public function hydrate(object $data, object $definition, Context $context, Hydrator $hydrator): void
    {
        $this->eventDispatcher->dispatch(new HydrateEvent($data, $definition, $context, $hydrator));
    }
}
