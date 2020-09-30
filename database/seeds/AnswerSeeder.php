<?php

use Illuminate\Database\Seeder;

class AnswerSeeder extends Seeder
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
                'text' => 'Yes',
                'question_id' => '1'
            ],
            [
                'text' => 'No',
                'question_id' => '1'
            ],
            [
                'text' => 'Male',
                'question_id' => '2'
            ],
            [
                'text' => 'Female',
                'question_id' => '2'
            ],
            [
                'text' => 'Yes',
                'question_id' => '3'
            ],
            [
                'text' => 'No',
                'question_id' => '3'
            ],
            [
                'text' => 'Yes',
                'question_id' => '5'
            ],
            [
                'text' => 'No',
                'question_id' => '5'
            ]
            );
        DB::table('answers')->insert($data);
    }
}
