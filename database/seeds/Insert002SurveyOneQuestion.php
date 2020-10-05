<?php

use App\Enums\QuestionEnum;
use Illuminate\Database\Seeder;

class Insert002SurveyOneQuestion extends Seeder
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
                //id=1
                'text' => 'Do you currently have life insurance?',
                'survey_id' => '1',
                'type' => $enum::MCQ,
                'parent_id' => NULL
            ],
            [
                //id=2
                'text' => 'What is your gender?',
                'survey_id' => '1',
                'type' => $enum::MCQ,
                'parent_id' => NULL
            ],
            [
                //id=3
                'text' => 'Have you used tobacco products within the last 12 months?',
                'survey_id' => '1',
                'type' => $enum::MCQ,
                'parent_id' => NULL
            ],
            [
                //id=4
                'text' => 'What is your weight (lbs)?',
                'survey_id' => '1',
                'type' => $enum::INPUT,
                'parent_id' => NULL
            ],
            [
                //id=5
                'text' => 'Are you married?',
                'survey_id' => '1',
                'type' => $enum::MCQ,
                'parent_id' => NULL
            ],
            [
                //id=6
                'text' => 'Do you have a child?',
                'survey_id' => '1',
                'type' => $enum::MCQ,
                'parent_id' => '5'
            ],
            [
                //id=7
                'text' => 'Does your child have any insurance?',
                'survey_id' => '1',
                'type' => $enum::MCQ,
                'parent_id' => '6'
            ],
            [
                //id=8
                'text' => 'What is your job status?',
                'survey_id' => '1',
                'type' => $enum::MCQ,
                'parent_id' => NULL
            ],
            [
                //id=9
                'text' => 'How much total income do you earn per year?',
                'survey_id' => '1',
                'type' => $enum::MCQ,
                'parent_id' => NULL
            ],
            [
                //id=10
                'text' => 'Do you have a mortage?',
                'survey_id' => '1',
                'type' => $enum::MCQ,
                'parent_id' => NULL
            ],
            [
                //id=11
                'text' => 'Do you have any other debt?',
                'survey_id' => '1',
                'type' => $enum::MCQ,
                'parent_id' => NULL
            ]
        );
        DB::table('questions')->insert($data);
    }
}
