<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->comment('氏名');
            $table->string('email')->comment('メールアドレス');
            $table->string('image')->comment('画像')->nullable()->default(null);
            $table->string('divises')->comment('ディバイス')->nullable()->default(null);
            $table->string('gender')->comment('性別');
            $table->string('age_group')->comment('電話番号');
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
        Schema::dropIfExists('customers');
    }
}
