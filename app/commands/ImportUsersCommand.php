<?php

use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use PHPassLib\Hash\SHA512Crypt;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class ImportUsersCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'mailbox:import-users';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Import users from CSV file (format: domain,email,password)';

	/**
	 * Create a new command instance.
	 */
	public function __construct() {
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire() {
		$file_name = $this->argument('file_name');

        $fh = fopen($file_name, 'r');
        if ($fh === FALSE) {
            $this->error('Cannot open file: ' . $file_name);
            return;
        }

        $counter = 0;
        $domains = [];

        while (($data = fgetcsv($fh)) !== FALSE) {
            $domain_name = $data[0];
            $email = $data[1];
            $password = $data[2];

            if (!isset($domains[$domain_name])) {
                try {
                    $domains[$domain_name] = Domain::whereFqdn($domain_name)->firstOrFail();
                }
                catch (ModelNotFoundException $e) {
                    $domains[$domain_name] = Domain::create([
                        'fqdn' => $domain_name,
                        'active' => true,
                    ]);
                }
            }

            try {
                Mailbox::create([
                    'domain_id' => $domains[$domain_name]->id,
                    'email' => $email,
                    'password' => SHA512Crypt::hash($password, ['rounds' => 5000]),
                ]);
                $counter += 1;
            }
            catch (Exception $e) {}
        }

        if ($counter)
            $this->info("Successfully imported {$counter} users.");

        fclose($fh);
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments() {
		return [
			['file_name', InputArgument::REQUIRED, 'Path to CSV file'],
		];
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions() {
		return [];
	}

}
