<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Models\ToDoList;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class SeedController extends Controller
{
    public function runSeeder(): string
    {
        Artisan::call('db:seed', [
            '--class' => 'ToDoListSeeder',
        ]);

        return "Seeder ToDoListSeeder выполнен успешно!";
    }
}
