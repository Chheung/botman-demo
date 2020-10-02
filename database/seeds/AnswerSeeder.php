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
                'question_id' => 1,
                'next_id' => NULL
            ],
            [
                'text' => 'No',
                'question_id' => 1,
                'next_id' => NULL
            ],
            [
                'text' => 'Male',
                'question_id' => 2,
                'next_id' => NULL
            ],
            [
                'text' => 'Female',
                'question_id' => 2,
                'next_id' => NULL
            ],
            [
                'text' => 'Yes',
                'question_id' => 3,
                'next_id' => NULL
            ],
            [
                'text' => 'No',
                'question_id' => 3,
                'next_id' => NULL
            ],
            [
                'text' => 'Yes',
                'question_id' => 5,
                'next_id' => 6
            ],
            [
                'text' => 'No',
                'question_id' => 5,
                'next_id' => NULL
            ],
            [
                'text' => 'Yes',
                'question_id' => 6,
                'next_id' => 7
            ],
            [
                'text' => 'No',
                'question_id' => 6,
                'next_id' => NULL
            ],
            [
                'text' => 'Yes',
                'question_id' => 7,
                'next_id' => NULL
            ],
            [
                'text' => 'No',
                'question_id' => 7,
                'next_id' => NULL
            ]
        );
        DB::table('answers')->insert($data);
    }
}
