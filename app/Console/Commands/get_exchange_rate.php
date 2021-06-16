<?php

namespace App\Console\Commands;

use App\Models\ExchangeRate;
use Carbon\Carbon;
use Exception;
use Illuminate\Console\Command;
use GuzzleHttp\Client;

class get_exchange_rate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'get_exchange_rate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'get_exchange_rate';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $day = Carbon::now()->startOfDay();
        $client = new Client();
        $oeAppId = env('OPEN_EXCHANGE_RATE_APP_ID');
        if (empty($oeAppId)) {
            throw new Exception('no open exchange app key');
        }
        $baseurl = 'https://openexchangerates.org/api/historical/';
        for ($i = 0; $i < 5; $i++) {
            $url = $baseurl . $day->toDateString() . '.json';
            $res = $client->request('GET', $url, [
                'query' => [
                    'app_id' => $oeAppId,
                    'symbols' => 'EUR,CNY,CAD,JPY,HKD'
                ]
            ]);
            $contents = $res->getBody()->getContents();

            $contents = json_decode($contents, true);
            foreach ($contents['rates'] as $symbol => $rate) {
                if (
                    !ExchangeRate::query()->where('symbol', $symbol)
                        ->where('data_time', $day)
                        ->exists()
                ) {
                    $exchangeRate = new ExchangeRate();
                    $exchangeRate->base = 'USD';
                    $exchangeRate->symbol = $symbol;
                    $exchangeRate->rate = (int)($rate * 1000000);
                    $exchangeRate->data_time = $day;
                    $exchangeRate->save();
                } else {
                    dump('exist', $day, $symbol);
                }
            }
            $day = $day->subDay();
        }

        return 0;
    }
}
