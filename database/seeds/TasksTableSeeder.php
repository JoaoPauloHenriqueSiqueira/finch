<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class TasksTableSeeder extends Seeder
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
                "name" => "Solicitar Atendimento da Área de TI",
                "type_id" => 1,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
            [
                "id" => 2,
                "name" => "Atender Solicitação",
                "type_id" => 2,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
            [
                "id" => 3,
                "name" => "Analisar Retorno Atendimento",
                "type_id" => 2,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ],
            [
                "id" => 4,
                "name" => "Ciência da Finalização",
                "type_id" => 3,
                "created_at" => Carbon::now(),
                "updated_at" => Carbon::now(),
            ]
        ];

        foreach ($data as $row) {
            $tax = DB::table('tasks')->find($row['id']);

            if (!$tax) {
                DB::table('tasks')->insert($row);
            }
        }
    }
}
