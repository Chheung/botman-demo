<?php

namespace App\Conversations;

use App\Question as Q;
use App\Answer as A;
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
        $answerButtons = array();
        foreach(A::where('question_id', 1)->get()->toArray() as $answer) {
            array_push(Button::create($answer->text)->value($answer->id));
        }
        $questionTemplate = Question::create($q->text)->addButtons([$answerButtons]);
        $this->ask($questionTemplate, function (Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {
                if ($answer->getValue() === '1') {
                    $this->say('Alright! That is what I want to hear!');
                } else {
                    $this->say('Ouch! But dont worry because I am always here to cheer u up! I will tell you a joke!');
                }
            }
        });
    }
    /**
     * Start the conversation
     */
    public function run()
    {
        $this->start('home');
    }
}
