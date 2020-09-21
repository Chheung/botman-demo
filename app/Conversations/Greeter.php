<?php

namespace App\Conversations;

use Illuminate\Foundation\Inspiring;
use BotMan\BotMan\Messages\Incoming\Answer;
use BotMan\BotMan\Messages\Outgoing\Question;
use BotMan\BotMan\Messages\Outgoing\Actions\Button;
use BotMan\BotMan\Messages\Conversations\Conversation;

class Greeter extends Conversation
{
    /**
     * First question
     */
    public function greet()
    {
        $question = Question::create("Hola! How are u doing?")
            ->addButtons([
                Button::create('I am all good!')->value('good'),
                Button::create('I feel terrible today..')->value('terrible'),
            ]);

        $this->ask($question, function (Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {
                if ($answer->getValue() === 'good') {
                    $this->say('Alright! That is what I want to hear!');
                    $this->init();
                } else {
                    $this->say('Ouch! But dont worry because I am always here to cheer u up! I will tell you a joke!');
                    $this->say('Here goes!');
                    $this->say($this->getJokes());
                    $this->init();
                }
            }
        });
    }

    /**
     * Reinitialize
     */
    public function init()
    {
        $question = Question::create("What can I do to help you?")
            ->addButtons([
                Button::create('Tell me joke!')->value('joke'),
                Button::create('Nothing!')->value('nothing'),
            ]);

        $this->ask($question, function (Answer $answer) {
            if ($answer->isInteractiveMessageReply()) {
                if ($answer->getValue() === 'joke') {
                    $this->say($this->getJokes());
                    $this->init();
                } else {
                  $this->say('Too bad! If there is anything I can help please come back to me!');
                }
            }
        });
    }


    
    /**
     * Jokes
     */
    private function getJokes() {
      $jokes = array(
        "I have a fish that can breakdance! Only for 20 seconds though, and only once.",
        'I started crying when dad was cutting onions. Onions was such a good dog.',
        'What is yellow and cant swim? A bus full of children..',
        '“Siri, why am I still single?!” Siri activates front camera.',
        'Why don’t cannibals eat clowns? Because they taste funny.',
        'Why are friends a lot like snow? If you pee on them they disappear.'
      );
      return $jokes[array_rand($jokes, 1)];
    }

    /**
     * Start the conversation
     */
    public function run()
    {
        $this->greet();
    }
}
