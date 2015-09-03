<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMailboxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mailboxes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('domain_id')->unsigned();
            $table->string('email', 100)->unique();
            $table->string('password', 128)->nullable();
            $table->boolean('active')->default(true);
            $table->timestamp('last_login')->nullable();
            $table->timestamps();

            $table->foreign('domain_id', 'fk_mailboxes__domain')
                ->references('id')->on('domains')
                ->onDelete('cascade');

            $table->index('domain_id', 'idx_mailboxes__domain_id');
            $table->index(['email', 'active'], 'idx_mailboxes__active');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('mailboxes');
    }
}
