<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use App\Payment;
use App\Http\Controllers\PaymentsController;

class PaymentNewJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $payment;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct( Payment $payment )
    {
        $this->payment=$payment;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $valor=PaymentsController::dolar($this->payment->payment_date);
        $this->payment->clp_usd= number_format( $valor["value_dolar"], 2);
        $this->payment->save();
    }
}
