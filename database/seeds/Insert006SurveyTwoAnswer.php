<?php

use Illuminate\Database\Seeder;

class Insert006SurveyTwoAnswer extends Seeder
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
                'text' => 'ACA Plan',
                'question_id' => 12,
                'next_id' => NULL
            ],
            [
                'text' => 'Short-Term Options',
                'question_id' => 12,
                'next_id' => 13
            ],
            [
                'text' => 'Immediately',
                'question_id' => 13,
                'next_id' => 14
            ],
            [
                'text' => 'Within 2 months',
                'question_id' => 13,
                'next_id' => 14
            ],
            [
                'text' => 'Not sure',
                'question_id' => 13,
                'next_id' => 14
            ],
            [
                'text' => '$47,001 +',
                'question_id' => 14,
                'next_id' => 15
            ],
            [
                'text' => '$30,001 - $47,000',
                'question_id' => 14,
                'next_id' => 15
            ],
            [
                'text' => '$16,001 - $30,000',
                'question_id' => 14,
                'next_id' => 15
            ],
            [
                'text' => '$0 - $16,000',
                'question_id' => 14,
                'next_id' => 15
            ],
            [
                'text' => 'Yes',
                'question_id' => 15,
                'next_id' => 16
            ],
            [
                'text' => 'No',
                'question_id' => 15,
                'next_id' => NULL
            ],
            [
                'text' => 'Male',
                'question_id' => 16,
                'next_id' => 17
            ],
            [
                'text' => 'Female',
                'question_id' => 16,
                'next_id' => 17
            ],
            [
                'text' => 'INPUT',
                'question_id' => 17,
                'next_id' => 18
            ],
            [
                'text' => 'Yes',
                'question_id' => 18,
                'next_id' => 19
            ],
            [
                'text' => 'No',
                'question_id' => 18,
                'next_id' => 19
            ],
            [
                'text' => 'Yes',
                'question_id' => 19,
                'next_id' => 20
            ],
            [
                'text' => 'No',
                'question_id' => 19,
                'next_id' => NULL
            ],
            [
                'text' => 'Yes',
                'question_id' => 20,
                'next_id' => 21
            ],
            [
                'text' => 'No',
                'question_id' => 20,
                'next_id' => 21
            ],
            [
                'text' => 'Yes',
                'question_id' => 21,
                'next_id' => NULL
            ],
            [
                'text' => 'No',
                'question_id' => 21,
                'next_id' => NULL
            ]
        );
        DB::table('answers')->insert($data);
    }
}
