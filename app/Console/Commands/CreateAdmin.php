<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class CreateAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Creating admin user...');

        $email = $this->ask('Enter email');
        $password = $this->secret('Enter password');

        $user = User::create([
            'id'=> 1,
            'email' => $email,
            'name' => $email,
            'firstName' => $email,
            'avatar' => $email,
            'password' => Hash::make($password),
        ]);

        $this->info('Admin user created successfully');
    }
}
