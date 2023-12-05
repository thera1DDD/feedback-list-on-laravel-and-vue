<?php

namespace Database\Seeders;

use App\Models\ToDoList;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ToDoListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'email' => 'test@mail.ru',
            'name' => 'test-name',
            'admin' => 1,
            'password' => Hash::make(123123123)

        ]);
        ToDoList::factory()->count(10)->create();
    }
}
