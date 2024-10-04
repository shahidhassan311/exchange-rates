<?php

namespace App\Http\Controllers;

use App\Repositories\Interfaces\CurrencyRepositoryInterface;

class CurrencyController extends Controller
{
    protected $currencyRepository;

    public function __construct(CurrencyRepositoryInterface $currencyRepository)
    {
        $this->currencyRepository = $currencyRepository;
    }

    public function index()
    {
        $currencies = $this->currencyRepository->getAll();
        return response()->json($currencies);
    }

    public function show($id)
    {
        $currency = $this->currencyRepository->find($id);
        return response()->json($currency);
    }

    public function history($id)
    {
        $currencyHistory = $this->currencyRepository->getHistory($id);
        return response()->json($currencyHistory);
    }
}
