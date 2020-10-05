<?php

use App\Enums\QuestionEnum;
use Illuminate\Database\Seeder;

class Insert003SurveyTwoQuestion extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $enum = new QuestionEnum();
        $data = array(
            [
                'text' => 'Do you currently have life insurance?',
                'survey_id' => '1',
                'type' => $enum::MCQ,
                'parent_id' => NULL
            ],
            [
                'text' => 'What is your gender?',
                'survey_id' => '1',
                'type' => $enum::MCQ,
                'parent_id' => NULL
            ],
            [
                'text' => 'Have you used tobacco products within the last 12 months?',
                'survey_id' => '1',
                'type' => $enum::MCQ,
                'parent_id' => NULL
            ],
            [
                'text' => 'What is your weight (lbs)?',
                'survey_id' => '1',
                'type' => $enum::INPUT,
                'parent_id' => NULL
            ],
            [
                'text' => 'Are you married?',
                'survey_id' => '1',
                'type' => $enum::MCQ,
                'parent_id' => NULL
            ],
            [
                'text' => 'Do you have a child?',
                'survey_id' => '1',
                'type' => $enum::MCQ,
                'parent_id' => '5'
            ],
            [
                'text' => 'Does your child have any insurance?',
                'survey_id' => '1',
                'type' => $enum::MCQ,
                'parent_id' => '6'
            ]
        );
        // DB::table('questions')->insert($data);
    }
}
