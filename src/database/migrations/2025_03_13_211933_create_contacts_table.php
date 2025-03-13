<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->string('first_name');
            $table->string('last_name');
            $table->enum('gender', ['1', '2', '3'])->default('1')->comment('1:男性, 2:女性, 3:その他');
            $table->string('email');
            $table->string('phone1', 3);
            $table->string('phone2', 4);
            $table->string('phone3', 4);
            $table->string('address');
            $table->string('building')->nullable();
            $table->enum('inquiry_type', ['1', '2', '3', '4', '5'])
                ->default('1')
                ->comment('1:商品のお届けについて, 2:商品交換について, 3:商品トラブル, 4:ショップへのお問い合わせ, 5:その他');
            $table->string('detail');
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
        Schema::dropIfExists('contacts');
    }
}
