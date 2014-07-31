<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateMailboxesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('mailboxes', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('domain_id')->unsigned();
			$table->string('email', 100)->unique();
			$table->string('password', 128);
			$table->boolean('active')->default(true);
			$table->timestamps();

            $table->foreign('domain_id', 'mailbox_domain_fk')
                ->references('id')->on('domains')
                ->onDelete('cascade');
            $table->index('domain_id', 'mailbox_domain_id_idx');
            $table->index(['email', 'active'], 'active_emails');
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
