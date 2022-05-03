<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromoCodesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promo_codes', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('event_id');
            
            $table->foreign('event_id', 'events_promocodes')
            ->references('id')->on('events')
            ->onDelete('cascade')
            ->onUpdate('restrict');

            $table->string("code",10)->unique();
            $table->tinyInteger('is_active')->length(1)->nullable()->default(1);
            $table->integer("available_count");
            $table->date("expiration_date")->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('promo_codes');
    }
}
