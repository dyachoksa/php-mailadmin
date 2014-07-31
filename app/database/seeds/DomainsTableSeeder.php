<?php

class DomainsTableSeeder extends Seeder {

	public function run()
	{
        Domain::create([
            'fqdn' => 'example.com',
            'active' => true,
        ]);

        Domain::create([
            'fqdn' => 'example.org',
            'active' => false,
        ]);
	}

}