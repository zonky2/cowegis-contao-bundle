<?php

declare(strict_types=1);

namespace Cowegis\Bundle\Contao\Model;

/**
 * @property string $type
 * @psalm-suppress ClassMustBeFinal
 */
class StyleModel extends Model
{
    /** @var string */
    // phpcs:ignore SlevomatCodingStandard.TypeHints.PropertyTypeHint.MissingNativeTypeHint
    protected static $strTable = 'tl_cowegis_style';
}
