<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Client;
use App\Payment;
use App\Jobs\PaymentNewJob;
use App\Events\PaymentNew;


class PaymentsController extends Controller
{
    public function paymentsByClient (Request $request ){
        $client = Client::find($request->client);
        // dd($client->payments);
        return collect($client->payments->sortByDesc('created_at'));
    }
    public function storeClientPayment ( Request $request ){

        $client = Client::find($request->user_id);
        $data= collect($request->all());
        $data->forget('user_id');
        $data->put('client_id',1);
        $payment = Payment::create($data->toArray());
        // dd($data,$payment);

        $client->payments()->save( $payment );
        PaymentNewJob::dispatch($payment)
                        // ->delay( now()->addMinutes(1) )
                        ;
        event(new PaymentNew( $payment ) );
        return collect($client->payments->sortByDesc('created_at'));
    }



    public static function dolar( $date = '' )
    {
        if($date==''){
            $date=\Carbon\Carbon::now()->toDateString();
        }

        $dolar = Payment::where('payment_date',$date)->first();

        if($dolar) {
            return collect(['value_dolar'=>$dolar->clp_usd]);
        }

        // formato api https://mindicador.cl/api/{tipo_indicador}/{dd-mm-yyyy}
// dd(\Carbon\Carbon::createFromFormat('Y-m-d', $date)->toDateString());
        $date = \Carbon\Carbon::createFromFormat('Y-m-d', $date);
        for($i=0;$i<=2;$i++){

            $dateChunk = explode('-',$date->subDays(1)->toDateString() );
            $url = 'https://mindicador.cl/api/dolar/'.$dateChunk[2].'-'.$dateChunk[1].'-'.$dateChunk[0];
            $cliente = new \GuzzleHttp\Client();
            $res = $cliente->request('GET', $url);
            $response = json_decode($res->getBody());
            if($response->serie){

                return collect(['value_dolar'=>$response->serie[0]->valor]);

            }else{
                continue;
            }
        }
        return collect(['value_dolar'=>0]);// En caso de error
    }
}
