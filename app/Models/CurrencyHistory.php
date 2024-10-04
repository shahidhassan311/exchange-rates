<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CurrencyHistory extends Model
{
    use HasFactory;

    protected $fillable = ['currency_id', 'rate', 'changed_at'];

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }
}
