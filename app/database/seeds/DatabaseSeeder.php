<?php

class DatabaseSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Eloquent::unguard();

		$this->call('DomainsTableSeeder');
        $this->call('MailboxesTableSeeder');
        $this->call('AliasesTableSeeder');
	}

}
