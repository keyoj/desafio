<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {

            $table->uuid("uuid")->primary()->index();
            $table->date("payment_date")->nullable();
            $table->date("expires_at");
            $table->enum("status",['pending','paid'])->default('pending');
            $table->unsignedBigInteger('client_id');
            $table->bigInteger('amount')->default(0);
            $table->float('clp_usd')->nullable();
            $table->timestamps();
            $table
                ->foreign('client_id')
                ->references('id')
                ->on('clients');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
