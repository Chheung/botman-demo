<?php
use App\Http\Controllers\BotManController;

$botman = resolve('botman');


$botman->hears('Hi', BotManController::class.'@startConversation');
