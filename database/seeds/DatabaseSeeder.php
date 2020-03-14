<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTablesSeeder::class);
        $this->call(TypesTableSeeder::class);
        $this->call(TasksTableSeeder::class);
        $this->call(FlowsTableSeeder::class);
    }
}
