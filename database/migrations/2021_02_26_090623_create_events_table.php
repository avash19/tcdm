<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->date('startDate');
            $table->date('endDate');
            $table->unsignedBigInteger('messageId')->nullable();
            $table->unsignedBigInteger('commentId')->nullable();
            $table->unsignedBigInteger('calendarSpreadId')->nullable();
            $table->unsignedBigInteger('followUpId')->nullable();
            $table->unsignedBigInteger('clientId');
            $table->text('messageRemark')->nullable();
            $table->enum('messageStatus',['unassigned','assigned'])->default('unassigned');
            $table->text('commentRemark')->nullable();
            $table->enum('commentStatus',['unassigned','assigned'])->default('unassigned');
            $table->text('calendarSpreadRemark')->nullable();
            $table->enum('calendarSpreadStatus',['unassigned','assigned'])->default('unassigned');
            $table->text('followUpRemark')->nullable();
            $table->enum('followUpStatus',['unassigned','assigned'])->default('unassigned');
            $table->timestamps();

            $table->foreign('clientId')->references('id')->on('clients')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('messageId')->references('id')->on('users')->cascadeOnUpdate()->nullOnDelete();
            $table->foreign('commentId')->references('id')->on('users')->cascadeOnUpdate()->nullOnDelete();
            $table->foreign('calendarSpreadId')->references('id')->on('users')->cascadeOnUpdate()->nullOnDelete();
            $table->foreign('followUpId')->references('id')->on('users')->cascadeOnUpdate()->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('events');
    }
}
