<?php
declare(strict_types=1);

namespace EventEngine\Util;

use Traversable;

final class MapTraversable implements \Iterator
{
    /**
     * @var Traversable
     */
    private $traversable;

    /**
     * @var callable
     */
    private $callback;

    /**
     * @var \Generator
     */
    private $innerGenerator;

    public function __construct(\Traversable $traversable, callable $callback)
    {
        $this->traversable = $traversable;
        $this->callback = $callback;
        $this->generateGenerator();
    }

    private function generateGenerator(): void
    {
        $this->innerGenerator = $this->generatorFunction();
    }

    private function generatorFunction(): \Generator
    {
        $cb = $this->callback;

        foreach ($this->traversable as $k => $v) {
            yield $k => $cb($v);
        }
    }

    /**
     * @inheritDoc
     */
    public function current(): mixed
    {
        return $this->innerGenerator->current();
    }

    /**
     * @inheritDoc
     */
    public function next(): void
    {
        $this->innerGenerator->next();
    }

    /**
     * @inheritDoc
     */
    public function key(): mixed
    {
        return $this->innerGenerator->key();
    }

    /**
     * @inheritDoc
     */
    public function valid(): bool
    {
        return $this->innerGenerator->valid();
    }

    /**
     * @inheritDoc
     */
    public function rewind(): void
    {
        $this->generateGenerator();
    }
}
