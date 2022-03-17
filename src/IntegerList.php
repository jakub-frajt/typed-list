<?php
declare(strict_types=1);

namespace Frajt;

class IntegerList implements \Countable, \Iterator
{
    private int $position = 0;
    private array $data = [];

    public function __construct(array $data)
    {
        foreach ($data as $item) {
            if (is_numeric($item) === false) {
                throw new \InvalidArgumentException(
                    sprintf(
                        'Each item of IntegerList must be a numeric value, "%s" given.',
                        is_scalar($item) ? $item : gettype($item)
                    )
                );
            }

            $this->data[] = (int)$item;
        }
    }


    public function count(): int
    {
        return \count($this->data);
    }

    public function current(): mixed
    {
        return $this->data[$this->position];
    }

    public function next(): void
    {
        ++$this->position;
    }

    public function key(): int
    {
        return $this->position;
    }

    public function valid(): bool
    {
        return isset($this->data[$this->position]);
    }

    public function rewind(): void
    {
        $this->position = 0;
    }

    public function getValues(): array
    {
        return $this->data;
    }
}