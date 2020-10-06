<?php

use Illuminate\Database\Seeder;

class Insert007SurveyThreeAnswer extends Seeder
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
                'question_id' => 22,
                'next_id' => NULL
            ],
            [
                'text' => 'No',
                'question_id' => 22,
                'next_id' => NULL
            ],
            [
                'text' => 'Not sure',
                'question_id' => 22,
                'next_id' => NULL
            ],
            [
                'text' => 'INPUT',
                'question_id' => 23,
                'next_id' => NULL
            ],
            [
                'text' => 'INPUT',
                'question_id' => 24,
                'next_id' => NULL
            ],
            [
                'text' => 'INPUT',
                'question_id' => 25,
                'next_id' => NULL
            ],
        );
        DB::table('answers')->insert($data);
    }
}
