<?php

class Collection extends ArrayObject
{
    public function where($key, $operator, $value)
    {
        $filtered = array_filter($this->getArrayCopy(), function ($item) use ($key, $operator, $value) {
            switch ($operator) {
                case '=':
                    return $item->$key == $value;
                case '!=':
                    return $item->$key != $value;
                case '>':
                    return $item->$key > $value;
                case '<':
                    return $item->$key < $value;
                case '>=':
                    return $item->$key >= $value;
                case '<=':
                    return $item->$key <= $value;
                default:
                    return $item->$key == $value;
            }
        });

        return new static($filtered);
    }

    // public function get()
    // {
    //     return $this->getArrayCopy();
    // }

    public function get()
    {
        return new static($this->getArrayCopy());
    }

    public function orderBy($key, $direction = 'asc')
    {
        $items = $this->getArrayCopy();
        $direction = strtolower($direction); // Case-insensitive check

        usort($items, function ($a, $b) use ($key, $direction) {
            if (!isset($a->$key) || !isset($b->$key)) {
                return 0;
            }

            return $direction === 'asc'
                ? $a->$key <=> $b->$key
                : $b->$key <=> $a->$key;
        });

        return new static($items);
    }

    public function limit($limit, $offset = 0)
    {
        $items = $this->getArrayCopy();
        $limit = (int) $limit;
        $offset = (int) $offset;

        if ($limit < 0) $limit = 0;
        if ($offset < 0) $offset = 0;

        $limitedItems = array_slice($items, $offset, $limit);
        return new static($limitedItems);
    }

    public function first()
    {
        $items = $this->getArrayCopy();
        return !empty($items) ? reset($items) : null;
    }
}
