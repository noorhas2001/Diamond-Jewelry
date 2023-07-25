<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Http;

/**
 * @property mixed $exchange_rate
 * @property mixed $code
 */
class Currency extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'symbol', 'exchange_rate', 'status', 'code'];

    public function updateExchangeRate()
    {
        try {
            if (get_setting('update_currency_online')) {
                // Call the external API to get the latest exchange rate for this currency
                $response = Http::withHeaders([
                    'Authorization' => 'Bearer '.env('EXCHANGE_GENERATES_API'),
                ])->get('https://api.exchangeratesapi.io/latest', [
                    'base' => $this->code,
                    'symbols' => 'USD',
                ]);

                // Update the exchange rate of this currency based on the API response
                if ($response->ok()) {
                    $data = $response->json();
                    $this->exchange_rate = $data['rates']['USD'];
                    $this->save();
                }
            }
        } catch (Exception $e) {
            flash('Currency update failed')->error();
        }
    }
}
