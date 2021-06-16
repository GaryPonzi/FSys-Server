<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ExchangeRate extends Model
{
    protected $table = 'exchange_rate';
    protected $guarded = [];
    protected $casts = [
        'id' => 'int',
        'base' => 'string',
        'symbol' => 'string',
        'rate' => 'int',
        'data_time' => 'timestamp'
    ];
}
