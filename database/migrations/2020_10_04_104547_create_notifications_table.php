<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('notifications', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('content');
            $table->boolean('status'); //powiadomienia nieprzeczytane
            $table->boolean('shown')->default(false); //powiadomianie w czasie rzeczywistym JS - false bo jesli nastapilo powiadomienie to default nie jest pokazane uzytkownikowi
            $table->bigInteger('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            //klucz obcy do tabeli users - kazde powiadomienie pochodzi od okreslonego usera
            //on cascade - jesli usune usera to BD auto usunie jego powiadomienia
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('notifications');
    }
}
