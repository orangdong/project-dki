<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSpekSubFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spek_sub_forms', function (Blueprint $table) {
            $table->id();
            $table->foreignId('spek_form_id')->constrained('spek_forms')->onDelete('cascade');
            $table->string('name')->nullable();
            $table->string('option');
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
        Schema::dropIfExists('spek_sub_forms');
    }
}
