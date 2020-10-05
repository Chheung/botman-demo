<?php

use Illuminate\Database\Seeder;

class Insert004SurveyOneAnswer extends Seeder
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
                'text' => 'INPUT',
                'question_id' => 4,
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
            ],
            [
                'text' => 'Currently Employed',
                'question_id' => 8,
                'next_id' => 9
            ],
            [
                'text' => 'Retired',
                'question_id' => 8,
                'next_id' => NULL
            ],
            [
                'text' => 'On Disability',
                'question_id' => 8,
                'next_id' => NULL
            ],
            [
                'text' => 'Homemaker/Other',
                'question_id' => 8,
                'next_id' => NULL
            ],
            [
                'text' => 'INPUT',
                'question_id' => 9,
                'next_id' => 10
            ],
            [
                'text' => 'INPUT',
                'question_id' => 10,
                'next_id' => 11
            ],
            [
                'text' => 'No',
                'question_id' => 11,
                'next_id' => NULL
            ],
            [
                'text' => 'Yes',
                'question_id' => 11,
                'next_id' => NULL
            ]
        );
        DB::table('answers')->insert($data);
    }
}
