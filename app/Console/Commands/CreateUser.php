<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Validator;

class CreateUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:create';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new user.';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $email = $this->ask(trans('messages.ask.email'));
        $name = $this->ask(trans('messages.ask.name'));
        $password = $this->secret(trans('messages.ask.password'));

        $data = [
            'email' => $email,
            'name'  => $name,
            'password' => $password,
        ];

        $validator = Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|min:6',
        ]);

        if ($validator->fails()) {
            foreach ($validator->messages()->all() as $error) {
                $this->error($error);
            }

            return;
        }

        User::create([
            'email' => $email,
            'name' => $name,
            'password' => bcrypt($password),
        ]);

        $this->info('User created.');
    }
}
