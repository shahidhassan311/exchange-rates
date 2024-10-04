<?php

namespace App\Services;

namespace App\Services;

use App\Models\Currency;
use App\Models\CurrencyHistory;
use Illuminate\Support\Facades\Http;

class ExchangeRateService
{
    protected $apiUrl = 'http://www.cbr.ru/scripts/XML_daily.asp';

    public function updateRates()
    {
        $response = Http::get($this->apiUrl);

        if ($response->ok()) {
            $xml = simplexml_load_string($response->body());
            foreach ($xml->Valute as $valute) {
                $currencyName = (string) $valute->CharCode;
                $rate = floatval(str_replace(',', '.', $valute->Value));

                $currency = Currency::firstOrCreate(
                    ['name' => $currencyName],
                    ['rate' => $rate]
                );

                if ($currency->rate != $rate) {
                    $currency->update(['rate' => $rate]);

                    CurrencyHistory::create([
                        'currency_id' => $currency->id,
                        'rate' => $rate,
                        'changed_at' => now(),
                    ]);
                }
            }
        }
    }
}

