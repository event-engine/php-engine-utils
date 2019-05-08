<?php
/**
 * This file is part of the event-engine/php-engine-utils.
 * (c) 2018-2019 prooph software GmbH <contact@prooph.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace EventEngine\Util;

use Traversable;

final class MapIterator extends \IteratorIterator
{
    /**
     * @var callable
     */
    private $callback;

    public function __construct(Traversable $iterator, callable $callback)
    {
        $this->callback = $callback;
        parent::__construct($this->getIterator($iterator));
    }

    public function valid()
    {
        return parent::getInnerIterator()->valid();
    }

    private function getIterator(\Traversable $iterator): \Generator
    {
        $cb = $this->callback;

        foreach ($iterator as $k => $v) {
            yield $k => $cb($v);
        }
    }
}
