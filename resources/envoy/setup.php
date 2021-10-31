<?php

require __DIR__ . '/init.php';

$gitRepository = env('GIT_REPOSITORY');
$gitBranch = $branch ?? env('GIT_BRANCH');
$time = time();
$baseDir = env('DEPLOY_BASE_DIR');
$releaseDir = $baseDir . '/releases/' . $time;
$deployConnection = env('DEPLOY_CONNECTION');

$tgBotToken = env('DEPLOY_TELEGRAM_BOT_TOKEN');
$tgChatId = env('DEPLOY_TELEGRAM_CHAT_ID');

$slackWebHook = env('DEPLOY_SLACK_WEB_HOOK');
$slackChannel = env('DEPLOY_SLACK_CHANNEL');
