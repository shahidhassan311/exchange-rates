<?php

namespace App\Repositories\Interfaces;

interface CurrencyRepositoryInterface
{
    public function getAll();

    public function find($id);

    public function getHistory($id);

    public function firstOrCreate(array $attributes, array $values = []);

    public function update(array $attributes);

    public function create(array $attributes);
}
