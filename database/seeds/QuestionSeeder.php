<?php

use App\Enums\QuestionEnum;
use Illuminate\Database\Seeder;

class QuestionSeeder extends Seeder
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
                'type' => $enum::MCQ
            ],
            [
                'text' => 'What is your gender?',
                'survey_id' => '1',
                'type' => $enum::MCQ
            ],
            [
                'text' => 'Have you used tobacco products within the last 12 months?',
                'survey_id' => '1',
                'type' => $enum::MCQ
            ],
            [
                'text' => 'What is your weight (lbs)?',
                'survey_id' => '1',
                'type' => $enum::INPUT
            ],
            [
                'text' => 'Are you married?',
                'survey_id' => '1',
                'type' => $enum::MCQ
            ]
        );
        DB::table('questions')->insert($data);
    }
}
