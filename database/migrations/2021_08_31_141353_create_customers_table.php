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
            $table->string('name',50)->comment('氏名');
            $table->string('email',50)->comment('メールアドレス')->nullable()->default(null);
            $table->string('image',100)->comment('画像')->nullable()->default(null);
            $table->string('divises',50)->comment('ディバイス')->nullable()->default(null);
            $table->string('gender',50)->comment('性別');
            $table->string('age_group',50)->comment('電話番号');
            $table->string('remarks',100)->comment('特記事項')->nullable()->default('特になし。');
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
