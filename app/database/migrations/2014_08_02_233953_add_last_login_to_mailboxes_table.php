<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddLastLoginToMailboxesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::table('mailboxes', function(Blueprint $table) {
			$table->timestamp('last_login')->nullable();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::table('mailboxes', function(Blueprint $table) {
			$table->dropColumn('last_login');
		});
	}
}
