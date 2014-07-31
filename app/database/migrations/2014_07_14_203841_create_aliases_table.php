<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAliasesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('aliases', function(Blueprint $table) {
			$table->increments('id');
			$table->integer('domain_id')->unsigned();
			$table->string('source', 100);
			$table->string('destination', 100);
			$table->boolean('active')->default(true);
			$table->timestamps();

            $table->foreign('domain_id', 'alias_domain_fk')
                ->references('id')->on('domains')
                ->onDelete('cascade');
            $table->index('domain_id', 'alias_domain_id_idx');
            $table->index(['source', 'active'], 'active_aliases');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('aliases');
	}

}
