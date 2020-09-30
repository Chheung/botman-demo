<?php

use Illuminate\Database\Seeder;

class SurveySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = array(
            [
                'title' => 'Life Insurance'
            ],
            [
                'title' => 'Health Insurance'
            ],
            [
                'title' => 'Medicare'
            ]
            );
        DB::table('surveys')->insert($data);
    }
}
