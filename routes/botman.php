<?php
use App\Http\Controllers\BotManController;

$botman = resolve('botman');


// $botman->hears('Hi|Hello', BotManController::class.'@startConversation');
$botman->hears('Hi|Hello|hi|hello', function ($bot) {
  $bot->reply('Hola! How can I help you?');
  $bot->reply('Please type Start to continue!');
});

$botman->hears('Start|start', BotManController::class.'@startSurvey');

