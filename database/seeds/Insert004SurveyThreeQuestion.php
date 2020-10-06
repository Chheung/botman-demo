<?php

use App\Enums\QuestionEnum;
use Illuminate\Database\Seeder;

class Insert004SurveyThreeQuestion extends Seeder
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
                //id--22
                'text' => 'Are you currently enrolled in Medicare Parts A & B?',
                'survey_id' => '3',
                'type' => $enum::MCQ,
                'parent_id' => NULL
            ],
            [
                //id--23
                'text' => 'What is your full name?',
                'survey_id' => '3',
                'type' => $enum::INPUT,
                'parent_id' => NULL
            ],
            [
                //id--24
                'text' => 'What is your email address?',
                'survey_id' => '3',
                'type' => $enum::INPUT,
                'parent_id' => NULL
            ],
            [
                //id--25
                'text' => 'What Phone Number can a licensed insurance agent contact you at?',
                'survey_id' => '3',
                'type' => $enum::INPUT,
                'parent_id' => NULL
            ],
        );
        DB::table('questions')->insert($data);
    }
}
