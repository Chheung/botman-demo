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
                //id--12
                'text' => 'What type of Health Insurance plan are you looking for?',
                'survey_id' => '2',
                'type' => $enum::MCQ,
                'parent_id' => NULL
            ],
            [
                //id--13
                'text' => 'When would you like coverage?',
                'survey_id' => '2',
                'type' => $enum::MCQ,
                'parent_id' => 12
            ],
            [
                //id--14
                'text' => 'What is your total household income?',
                'survey_id' => '2',
                'type' => $enum::MCQ,
                'parent_id' => 12
            ],
            [
                //id--15
                'text' => 'Are you looking to include your spouse in your Health Insurance plan?',
                'survey_id' => '2',
                'type' => $enum::MCQ,
                'parent_id' => 12
            ],
            [
                //id--16
                'text' => "What is your spouse's gender?",
                'survey_id' => '2',
                'type' => $enum::MCQ,
                'parent_id' => 13
            ],
            [
                //id--17
                'text' => "What is your spouse's birthdate?",
                'survey_id' => '2',
                'type' => $enum::INPUT,
                'parent_id' => 13
            ],
            [
                //id--18
                'text' => 'Has your spouse used tobacco products within the last 12 months?',
                'survey_id' => '2',
                'type' => $enum::MCQ,
                'parent_id' => 13
            ],
            [
                //id--19
                'text' => 'Are you looking to include your children in your Health Insurance plan?',
                'survey_id' => '2',
                'type' => $enum::MCQ,
                'parent_id' => 13
            ],
            [
                //id--20
                'text' => 'Do any applicants weigh over 325 lbs if male, or over 275 lbs if female?',
                'survey_id' => '2',
                'type' => $enum::MCQ,
                'parent_id' => 13
            ],
            [
                //id--21
                'text' => 'Do any applicants have any pre-existing conditions or been treated for any major medical conditions within the past 5 years?',
                'survey_id' => '2',
                'type' => $enum::MCQ,
                'parent_id' => 13
            ],
        );
        DB::table('questions')->insert($data);
    }
}
