<?php

namespace App\Listeners;

use App\Events\PaymentNew;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

use Mail;

class SendPaymentNewNotification implements ShouldQueue
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  PaymentNew  $event
     * @return void
     */
    public function handle(PaymentNew $event)
    {
        $data = [
            'name' => $event->payment->client->name,
            'amount' => $event->payment->amount,
        ];
        Mail::send('emails.notification',$data,function($message){
            $message->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'));
            $message->to('user@example.com')->subject('Notificación');
        });
        return false;

    }
}
