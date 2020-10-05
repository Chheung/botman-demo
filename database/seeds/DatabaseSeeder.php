<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(Insert001SurveySeeder::class);
        $this->call(Insert002SurveyOneQuestion::class);
        $this->call(Insert003SurveyTwoQuestion::class);
        $this->call(Insert004SurveyOneAnswer::class);
    }
}
