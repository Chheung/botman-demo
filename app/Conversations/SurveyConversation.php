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

    protected $surveyQuestions;

    protected $currentQuestion;

    function start()
    {
        $list = "This is the list: \n 1. Health Insurance \n 2. Car Insurance";
        $this->say($list);
        $this->ask('Please choose one to continue!', function(Answer $answer) {
            $surveyId = $answer->getText();
            $this->surveyQuestions = Q::where('survey_id', $surveyId)->get();
            $this->currentQuestion = $this->surveyQuestions->first()->id;
            $this->askQuestion();
        });
    }

    function askQuestion() {
        if ($this->currentQuestion <= $this->surveyQuestions->last()->id) {
            $q = Q::find($this->currentQuestion);
            $a = A::where('question_id', $this->currentQuestion)->get();
            Log::info($q);
            $questionTemplate = Question::create($q->text);
            foreach($a as $answer) {
                $questionTemplate->addButton(Button::create($answer->text)->value($answer->id));
            }
            $this->ask($questionTemplate, function (Answer $answer) use ($q) {
                if ($answer->isInteractiveMessageReply()) {
                    $text = $answer->getText();
                    $val = $answer->getValue();
                    $validAnswer = A::where('question_id', $q->id)->where('text', $text);
                    if (!$validAnswer) {
                        $this->say('Sorry, I did not get that. Please use the buttons.');
                        $this->askQuestion();
                    } else {
                        Result::create(['question_id' => $q->id, 'answer_id' => $val]);
                        $this->currentQuestion++;
                        $this->askQuestion();
                    }
                }
            });
        } else {
            $this->say('Done');
        }
    }

    /**
     * Start the conversation
     */
    public function run() {
        $this->start();
    }
}
