<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;

class CreateUserCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:user {name?} {email?} {password?} {--admin : Create an admin user}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new user';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->argument('name')?? $this->anticipate('donnez le nom ', ['Taylor', 'Dayle']);
        $email = $this->argument('email')?? $this->ask("donnez l'email ");
        $password = $this->argument('password')?? $this->secret('Donnez le mot de password');
        $isAdmin = $this->option('admin');

        $user = new User();
        $user->name = $name;
        $user->email = $email;
        $user->password = bcrypt($password);
        $user->is_admin = $isAdmin;
        $user->save();

        $this->info("user created successfully");
    }
}
