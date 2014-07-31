<?php

class AliasesTableSeeder extends Seeder {

	public function run()
	{
        Alias::create([
            'domain_id' => 1,
            'source' => 'alias@example.com',
            'destination' => 'test@test.com',
        ]);
	}

}