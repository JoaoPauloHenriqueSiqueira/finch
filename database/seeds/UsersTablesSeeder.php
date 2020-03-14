<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class UsersTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                "id" => 1,
                'name' => "João Siqueira",
                'email' => 'joao@gmail.com',
                'password' => bcrypt('joao123456'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                "id" => 2,
                'name' => "Leonardo",
                'email' => 'leonardo@gmail.com',
                'password' => bcrypt('leonardo123456'),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ];

        foreach ($data as $row) {
            $user = DB::table('users')->find($row['id']);

            if (!$user) {
                DB::table('users')->insert($row);
            }
        }
    }
}
