<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAliasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aliases', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('domain_id')->unsigned();
            $table->string('source', 100);
            $table->string('destination', 100);
            $table->boolean('active')->default(true);
            $table->timestamps();
            
            $table->foreign('domain_id', 'fk_aliases__domain')
                ->references('id')->on('domains')
                ->onDelete('cascade');
            
            $table->index('domain_id', 'idx_aliases__domain_id');
            $table->index(['source', 'active'], 'idx_aliases__active');        
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('aliases');
    }
}
