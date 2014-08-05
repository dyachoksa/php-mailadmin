<?php

use PHPassLib\Hash\SHA512Crypt;

class MailboxesTableSeeder extends Seeder {

	public function run()
	{
		Mailbox::create([
            'domain_id' => 1,
            'email' => 'user@example.com',
            'password' => SHA512Crypt::hash('password', ['rounds' => 5000]),
        ]);
	}

}