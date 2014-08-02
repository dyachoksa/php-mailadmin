<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class UpdateLastLoginCommand extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'mailbox:update-last-login';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Update date and time of last login to mailbox.';

    /**
     * Create a new command instance.
     *
     * @return \UpdateLastLoginCommand
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
		$mailbox_name = $this->argument('mailbox');

        $mailbox = Mailbox::whereEmail($mailbox_name)->first();

        $mailbox->last_login = time();

        $mailbox->update(['last_login']);

        $this->info("Mailbox {$mailbox_name} updated.");
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments() {
		return [
			['mailbox', InputArgument::REQUIRED, 'The mailbox name. E.g., test@example.com.'],
		];
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions() {
		return [
			// ['example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null],
		];
	}
}
