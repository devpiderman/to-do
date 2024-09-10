<?php

namespace App\Filters;

use Illuminate\Database\Eloquent\Builder;

class TaskFilter
{
    public function __construct(public Builder $builder) {}

    public function apply(array $params)
    {
        foreach ($params as $methodName => $value) {
            if (!is_null($value) && method_exists($this, $methodName)) $this->$methodName($value);
        }
    }

    private function filter($value)
    {
        $this->builder->where('status', $value);
    }
}
