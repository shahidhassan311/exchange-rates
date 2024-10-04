<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Repositories\Interfaces\CurrencyRepositoryInterface;

class ExchangeRateService
{
    protected $apiUrl = 'http://www.cbr.ru/scripts/XML_daily.asp';
    protected $currencyRepository;

    public function __construct(CurrencyRepositoryInterface $currencyRepository)
    {
        $this->currencyRepository = $currencyRepository;
    }

    public function updateRates()
    {
        $response = Http::get($this->apiUrl);

        if ($response->ok()) {
            $xml = simplexml_load_string($response->body());
            foreach ($xml->Valute as $valute) {
                $currencyName = (string) $valute->CharCode;
                $rate = floatval(str_replace(',', '.', $valute->Value));

                $currency = $this->currencyRepository->firstOrCreate(
                    ['name' => $currencyName],
                    ['rate' => $rate]
                );

                if ($currency->rate != $rate) {
                    $currency->update(['rate' => $rate]);

                    $currency->history()->create([
                        'rate' => $rate,
                        'changed_at' => now(),
                    ]);
                }
            }
        }
    }
}
