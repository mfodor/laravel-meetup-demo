<?php

namespace App\Console\Commands;

use App\Models\User;
use Database\Factories\TodoFactory;
use Illuminate\Console\Command;

class GenerateTodos extends Command
{
    protected $signature = 'itware:todos {user : The ID of the user} {--c|count=12 : How many todos should be generated}';

    protected $description = 'Generate Todos for a user';

    public function handle()
    {
        $userId = $this->argument('user');

        $user = User::findOrFail($userId);

        $count = $this->option('count');

        $user->todos()->saveMany(TodoFactory::times($count)->make());
    }
}
