<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->date('rental_day_in'); //data wypozyczenia auta
            $table->date('rental_day_out'); //data zwrotu auta
            $table->boolean('status'); //czy rezerwacja potwierdzona czy nie

            //rezerwacja nalezy do jakiegos usera - usuniecie usera = usuniecie rezerwacji
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            //rezerwacja nalezy do jakiegos miasta - usuniecie miasta = usuniecie rezerwacji
            //(bo na str. glownej bd wyszukiwal miasto, data wypozyczenia, data zwrotu,)
            //i wyswietle na str gl. dostepne auta dla zadanych warunkow.
            //te auta nie bd wyszukiwal w tabeli car, tylko auta bd
            //wyszukiwal poprzez miasta. Majac dane miasta to bd wyciagal jakie auta w tym miescie sa dostepne.
            //ulatwi to prace z wyszukiwarka
            $table->bigInteger('city_id')->unsigned();
            $table->foreign('city_id')->references('id')->on('cities')->onDelete('cascade');

            //potrzebne w panelu admina. jak bd wyswietlal kalendarz rezerwacji to musze
            //miec auta ktore dotycza tej rezerwacji
            $table->bigInteger('car_id')->unsigned();
            $table->foreign('car_id')->references('id')->on('cars')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservations');
    }
}
