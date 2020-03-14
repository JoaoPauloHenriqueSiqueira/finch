<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class FlowsTableSeeder extends Seeder
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
                'user_id' => 1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),

            ]
        ];

        foreach ($data as $row) {
            $user = DB::table('flows')->find($row['id']);

            if (!$user) {
                DB::table('flows')->insert($row);
            }
        }
    }
}
