<?php

use Illuminate\Database\Seeder;
use App\Client;
use App\Payment;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Client::create(['name'=>'Jorge Cabezas','email'=>'jorge.cabezas@monguen.cl','join_date'=>"2020-01-03"]);
        factory(Client::class, 49)->create()->each(function ($user)
        {
            if(array_rand([false,true])){
                $pagos=mt_rand(1,5);
                for($i=1;$i<=$pagos;$i++){
                    $user->payments()->save(factory(Payment::class)->make());
                }

            }

        });
    }
}
