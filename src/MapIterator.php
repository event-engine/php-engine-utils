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

final class MapIterator implements \IteratorAggregate
{
    /**
     * @var callable
     */
    private $callback;

    private $iterator;

    public function __construct(\Traversable $iterator, callable $callback)
    {
        $this->callback = $callback;
        $this->iterator = $iterator;
    }

    public function getIterator()
    {
        $cb = $this->callback;

        foreach ($this->iterator as $k => $v) {
            yield $k => $cb($v);
        }
    }
}
