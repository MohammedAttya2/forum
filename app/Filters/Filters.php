<?php

namespace App\Filters;


use Illuminate\Http\Request;

abstract class Filters
{
    protected $filters = [];

    protected $builder;

    function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function apply($builder)
    {
        $this->builder = $builder;

        foreach ($this->getFilters() as $filter => $value) {
            if (method_exists($this, $filter)) {
                $this->$filter($value);
            }
        }

        return $this->builder;

    }


    /**
     * @return array
     */
    protected function getFilters() : array
    {
        return $this->request->intersect($this->filters);
    }
}