<?php

class MailboxesTableSeeder extends Seeder {

	public function run()
	{
		Mailbox::create([
            'domain_id' => 1,
            'email' => 'user@example.com',
            'password' => Hash::make('password'),
        ]);
	}

}