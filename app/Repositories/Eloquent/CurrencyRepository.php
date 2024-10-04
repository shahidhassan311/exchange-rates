<?php

namespace App\Repositories\Eloquent;

use App\Models\Currency;
use App\Repositories\Interfaces\CurrencyRepositoryInterface;

class CurrencyRepository implements CurrencyRepositoryInterface
{
    protected $currency;

    public function __construct(Currency $currency)
    {
        $this->currency = $currency;
    }

    public function getAll()
    {
        return $this->currency->paginate(15);
    }

    public function find($id)
    {
        return $this->currency->findOrFail($id);
    }

    public function getHistory($id)
    {
        $currency = $this->currency->findOrFail($id);
        return $currency->history;
    }

    public function firstOrCreate(array $attributes, array $values = [])
    {
        return $this->currency->firstOrCreate($attributes, $values);
    }

    public function update(array $attributes)
    {
        return $this->currency->update($attributes);
    }

    public function create(array $attributes)
    {
        return $this->currency->create($attributes);
    }
}
