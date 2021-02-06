<?php
/**
 * This file is part of the event-engine/php-engine-utils.
 * (c) 2018-2021 prooph software GmbH <contact@prooph.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace EventEngine\Util;

use Traversable;

final class MapIterator extends \IteratorIterator
{
    public function __construct(Traversable $iterator, callable $callback)
    {
        parent::__construct(new MapTraversable($iterator, $callback));
    }

    public function valid()
    {
        return parent::getInnerIterator()->valid();
    }
}
