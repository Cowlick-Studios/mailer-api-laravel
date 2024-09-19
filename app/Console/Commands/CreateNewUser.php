<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Models\User;

class CreateNewUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:create-new-user {name} {email} {password}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new user in the system.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $user = new User;
        $user->name = $this->argument('name');
        $user->email = $this->argument('email');
        $user->password = Hash::make($this->argument('password'));
        $user->email_verified_at = now();
        $user->remember_token = Str::random(10);
        $user->save();
  
        $this->info('User "' . $this->argument('email') . '" created!');
        $this->info("Password: {$this->argument('password')}");
        return;
    }
}
