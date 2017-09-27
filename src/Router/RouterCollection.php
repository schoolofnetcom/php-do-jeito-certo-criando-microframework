<?php

namespace ErikFig\Router;

use Illuminate\Support\Collection;

class RouterCollection
{
    protected $collection = [];

    public function add(string $method, string $path, $callback)
    {
        if (!isset($this->collection[$method])) {
            $this->collection[$method] = new Collection;
        }
        $this->collection[$method]->put($path, $callback);
    }

    public function filter($method)
    {
        if (!isset($this->collection[$method])) {
            $this->collection[$method] = new Collection;
        }
        return $this->collection[$method];
    }

    public function all()
    {
        return $this->collection;
    }
}
