<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class Setup extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'setup:required-data';

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
        // creating user
        $name = 'Heritier';
        $email = 'admin@gmail.com';
        $password = '123456';

        User::create([
            "name" => $name,
            "email" => $email,
            "password" => Hash::make($password),
        ]);

        $this->info("user created successfully");
    }
}
