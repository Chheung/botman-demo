<?php

namespace App\Conversations;

use App\Question as Q;
use App\Answer as A;
use App\Result;
use App\Survey;
use App\Enums\QuestionEnum;
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
        $surveyList = Survey::all();
        $text = "This is the list: ";
        foreach($surveyList as $key=>$s) {
            $index = $key + 1;
            $text = $text . "\n" . $index . ")." . $s->title;
        }
        $text = $text . "\n Please choose one to continue!";
        $this->ask($text, function(Answer $answer) {
            $surveyId = $answer->getText();
            $survey = Survey::find($surveyId);
            if (!$survey) {
                $this->say('Sorry we dont have this option yet');
                return;
            }
            $this->surveyQuestions = Q::where('survey_id', $surveyId)->get();
            if(count($this->surveyQuestions) > 0) {
                $this->currentQuestion = $this->surveyQuestions->first()->id;
                $this->askQuestion();
            } else {
                $this->say('Sorry there is no questions in this survey. Please try another one by typing Start!');
                return;
            }
        });
    }

    function askQuestion() {
        if ($this->currentQuestion <= $this->surveyQuestions->last()->id) {
            $q = Q::find($this->currentQuestion);
            $questionTemplate = Question::create($q->text);
            if ($q->type == QuestionEnum::MCQ) {
                $a = A::where('question_id', $this->currentQuestion)->get();
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
                $this->ask($questionTemplate, function (Answer $answer) use ($q) {
                    $text = $answer->getText();
                    Result::create(['question_id' => $q->id, 'answer_value' => $text]);
                    $this->currentQuestion++;
                    $this->askQuestion();
                });
            }
        } else {
            $this->say('Congratulation! You have completed the survey!');
        }
    }

    /**
     * Start the conversation
     */
    public function run() {
        $this->start();
    }
}
