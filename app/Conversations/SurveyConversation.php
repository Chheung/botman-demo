<?php

namespace App\Conversations;

use App\Question as Q;
use App\Answer as A;
use App\Result;
use Illuminate\Support\Facades\Log;
use Illuminate\Foundation\Inspiring;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Conversations\Conversation;

class SurveyConversation extends Conversation
{
    /**
     * initialize
     */
    public function start($type)
    {
        $list = "This is the list: \n 1. Health Insurance \n 2. Car Insurance";
        $this->say($list);
        $this->ask('Please choose one to continue!', function(Answer $answer) {
            $type = $answer->getText();
            $this->startSurvey();
        });
    }

    function startSurvey() {
        $q = Q::find(1);
        $a = A::where('question_id', 1)->get();
        $questionTemplate = Question::create($q->text);
        foreach($a as $answer) {
            $questionTemplate->addButton(Button::create($answer->text)->value($answer->id));
        }
        // $this->ask($questionTemplate, function (Answer $answer) {
        //     if ($answer->isInteractiveMessageReply()) {
        //         $text = $answer->getText();
        //         $val = $answer->getValue();
        //         $this->say('Cool! Your age is ' . $text);
        //         Result::create(['question_id' => 1, 'answer_id' => $val]);
        //     }
        // });
    }
    /**
     * Start the conversation
     */
    public function run()
    {
        $this->start('home');
    }
}
