<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConfigsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('configs', function (Blueprint $table) {
            $table->id();
            $table->string('name', 200)->nullable();
            $table->string('email', 200)->nullable();
            $table->string('telefone', 200)->nullable();
            $table->string('celular', 200)->nullable();
            $table->string('razao_social', 200)->nullable();
            $table->string('cnpj', 200)->nullable();
            $table->string('url', 200)->nullable();
            $table->string('endereco', 200)->nullable();
            $table->unsignedBigInteger("state_id")->nullable();
            $table->unsignedBigInteger("city_id")->nullable();
            $table->integer('num_pages')->default(10);
            $table->integer('dia')->default(10);
            $table->integer('periodo')->default(3);
            $table->integer('auto_block')->default(1);
            $table->text('about')->nullable();
            $table->text('privacy_policy')->nullable();
            $table->integer('status')->default(1);
            $table->integer('dias_atraso')->default(5);
            $table->string('logo')->default('')->nullable();
            $table->string('taxa')->default('10');
            $table->integer('admin_id')->default(1);
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
        Schema::dropIfExists('configs');
    }
}
