<?php

namespace App\Repositories\Interfaces;

interface CurrencyRepositoryInterface
{
    public function getAll();

    public function find($id);

    public function getHistory($id);
}
