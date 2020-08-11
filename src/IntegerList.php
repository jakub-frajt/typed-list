<?php
declare(strict_types=1);

namespace Frajt;

class IntegerList implements \Countable, \Iterator
{
    /**
     * @var int
     */
    private $position = 0;

    /**
     * @var array
     */
    private $data = [];

    public function __construct(array $data)
    {
        foreach ($data as $item) {
            if (is_numeric($item) === false) {
                throw new \InvalidArgumentException(
                    sprintf('Each item of IntegerList must be a numeric value, "%s" given.', $item)
                );
            }

            $this->data[] = (int)$item;
        }
    }


    public function count(): int
    {
        return \count($this->data);
    }

    /**
     * @return mixed
     */
    public function current()
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