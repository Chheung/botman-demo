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

    protected $currentIndex = 0;

    protected $result = array();

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
            $this->surveyQuestions = Q::with('answers')->where(['survey_id'=> $surveyId, 'parent_id' => NULL])->get();
            if(count($this->surveyQuestions) > 0) {
                $this->askQuestion();
            } else {
                $this->say('Sorry there is no questions in this survey. Please try another one by typing Start!');
                return;
            }
        });
    }

    function askQuestion() {
        if ($this->currentIndex < count($this->surveyQuestions)) {
            $q = $this->surveyQuestions[$this->currentIndex];
            $a = $q->answers;
            $questionTemplate = Question::create($q->text);
            if ($q->type == QuestionEnum::MCQ) {
                foreach($a as $answer) {
                    $questionTemplate->addButton(Button::create($answer->text)->value($answer->id));
                }
                $this->ask($questionTemplate, function (Answer $answer) use ($q, $a) {
                    if ($answer->isInteractiveMessageReply()) {
                        $val = $answer->getValue();

                        // For Facebook we can retrieve the answered button text but not for everything else. So I looped this for general purpose
                        // Reference: https://github.com/botman/driver-facebook/issues/70
                        // $text = $answer->getText();

                        $text = '';
                        foreach($a as $ans) {
                            if ($ans->id == $val) {
                                $text = $ans->text;
                            }
                        }
                        $validAnswer = A::where('question_id', $q->id)->where('text', $text)->first();
                        if ($validAnswer) {
                            array_push($this->result, ['question_id' => $q->id, 'answer_id' => $val, 'answer_value' => NULL]);
                            if ($validAnswer->next_id) {
                                $this->askSubQuestion($validAnswer->next_id);
                            } else {
                                $this->currentIndex++;
                                $this->askQuestion();
                            }
                        }
                    } else {
                        $this->say('Sorry, I did not get that. Please use the buttons.');
                        $this->askQuestion();
                    }
                });
            } else {
                $this->ask($questionTemplate, function (Answer $answer) use ($q, $a) {
                    $a = $a->first();
                    $text = $answer->getText();
                    array_push($this->result, ['question_id' => $q->id, 'answer_id' => $a->id, 'answer_value' => $text]);
                    $this->currentIndex++;
                    $this->askQuestion();
                });
            }
        } else {
            Result::insert($this->result);
            $this->say('Congratulation! You have completed the survey!');
        }
    }

    function askSubQuestion($nextId) {
        $q = Q::with('answers')->find($nextId);
        $a = $q->answers;
        $questionTemplate = Question::create($q->text);
        if ($q->type == QuestionEnum::MCQ) {
            foreach($a as $answer) {
                $questionTemplate->addButton(Button::create($answer->text)->value($answer->id));
            }
            $this->ask($questionTemplate, function (Answer $answer) use ($q, $a) {
                if ($answer->isInteractiveMessageReply()) {
                    $val = $answer->getValue();
                    // For Facebook we can retrieve the answered button text but not for everything else. So I looped this for general purpose
                    // Reference: https://github.com/botman/driver-facebook/issues/70
                    // $text = $answer->getText();

                    $text = '';
                    foreach($a as $ans) {
                        if ($ans->id == $val) {
                            $text = $ans->text;
                        }
                    }
                    $validAnswer = A::where('question_id', $q->id)->where('text', $text)->first();
                    array_push($this->result, ['question_id' => $q->id, 'answer_id' => $val, 'answer_value' => NULL]);
                    if ($validAnswer->next_id) {
                        $this->askSubQuestion($validAnswer->next_id);
                    } else {
                        $this->currentIndex++;
                        $this->askQuestion();
                    }
                } else {
                    $this->say('Sorry, I did not get that. Please use the buttons.');
                    $this->askQuestion();
                }
            });
        } else {
            $this->ask($questionTemplate, function (Answer $answer) use ($q, $a) {
                $a = $a->first();
                $text = $answer->getText();
                array_push($this->result, ['question_id' => $q->id, 'answer_id' => $a->id, 'answer_value' => $text]);
                if ($a->next_id) {
                    $this->askSubQuestion($a->next_id);
                } else {
                    $this->currentIndex++;
                    $this->askQuestion();
                }
            });
        }
    }

    /**
     * Start the conversation
     */
    public function run() {
        $this->start();
    }
}
