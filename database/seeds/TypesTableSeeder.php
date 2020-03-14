<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class TypesTableSeeder extends Seeder
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
                'title' => "Abertura"
            ],
            [
                "id" => 2,
                'title' => "Intermediária"
            ],
            [
                "id" => 3,
                'title' => "Finalizadora"
            ]
        ];

        foreach ($data as $row) {
            $type = DB::table('types')->find($row['id']);

            if (!$type) {
                DB::table('types')->insert($row);
            }
        }
    }
}
