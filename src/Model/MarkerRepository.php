<?php

declare(strict_types=1);

namespace Cowegis\Bundle\Contao\Model;

use Contao\Model\Collection;
use Cowegis\Bundle\Contao\Event\ApplyFilterRuleEvent;
use Cowegis\Core\Filter\Filter;
use Netzmacht\Contao\Toolkit\Data\Model\ContaoRepository;
use Psr\EventDispatcher\EventDispatcherInterface;
use function in_array;

final class MarkerRepository extends ContaoRepository
{
    /** @var EventDispatcherInterface */
    private $eventDispatcher;

    public function __construct(string $modelClass, EventDispatcherInterface $eventDispatcher)
    {
        parent::__construct($modelClass);

        $this->eventDispatcher = $eventDispatcher;
    }

    public function findActiveByLayer(int $layerId, array $options = []) : ?Collection
    {
        $options['sorting'] = $options['sorting'] ?? '.sorting';
        $columns            = [
            '.pid=?',
            '.active=?',
            '.latitude IS NOT NULL',
            '.longitude IS NOT NULL',
        ];

        $values = [$layerId, 1];

        $this->applyFilter($columns, $values, $options);

        return $this->findBy($columns, $values, $options);
    }

    private function applyFilter(array &$columns, array &$values, array $options) : void
    {
        $filter = $options['filter'] ?? null;
        $rules  = $options['rules'] ?? null;
        if (!$filter instanceof Filter) {
            return;
        }

        foreach ($filter->rules() as $rule) {
            if ($rules !== null && ! in_array($rule->name(), $rules, true)) {
                continue;
            }

            $event = new ApplyFilterRuleEvent($this->getModelClass(), $rule, $columns, $values, $options);
            $this->eventDispatcher->dispatch($event);

            $columns = $event->columns();
            $values  = $event->values();
        }
    }
}
