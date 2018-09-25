<?php

namespace App\Console\Commands;

use App\Active;
use App\Reading;
use Illuminate\Console\Command;

class MarketDataCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'marketData:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return mixed
     */
    public function handle()
    {
        $active = Active::where('name','WINV18')->first();
        $url = 'https://mdgateway04.easynvest.com.br/iwg/snapshot/?t=webgateway&c=5448062&q=WINV18';
        $client = new \GuzzleHttp\Client();
        $retorno = $client->request('GET', $url)->getBody();
        $retorno = json_decode($retorno);
        $reading = new Reading;
        $reading->active_id = $active->id;
        $reading->price = $retorno->Value[0]->Ps->P;
        $reading->volume = $retorno->Value[0]->Ps->V;
        $reading->moment = $retorno->Value[0]->UT;
        $reading->save();
    }
}
