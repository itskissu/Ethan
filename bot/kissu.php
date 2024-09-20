<?php

/*
Telegram Channel : @osClub
Developer : @LampStack
*/

ini_set("log_errors", "off");
error_reporting(0);

$apiKey = '7920354517:AAE54Hwan7jN2ed7LQ2bOMXB5QCofMOtdyY';
$update = json_decode(file_get_contents('php://input'));
$username = isset($update->message->from->first_name) ? $update->message->from->first_name : 'User'; // Get the user's first name
$games_url = 'https://ethantg.netlify.app/';
$community = 'https://t.me/kissuxbots';

function LampStack($method, $datas = []) {
    global $apiKey;
    $url = 'https://api.telegram.org/bot' . $apiKey . '/' . $method;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $datas);
    $res = curl_exec($ch);
    if (curl_error($ch)) {
        return json_decode(curl_error($ch));
    } else {
        return json_decode($res);
    }
}

if (isset($update->message)) {
    @$msg = $update->message->text;
    @$from_id = $update->message->from->id;
    @$message_id = $update->message->message_id;

    if ($msg === '/start') {
        LampStack('sendPhoto', [
            'chat_id' => $from_id,
            'photo' => new CURLFile('home.png'), // Use CURLFile for the photo
            'caption' => "<b>Hey, $username! Welcome to GojoTap Bot!</b>\n\nClick on Play Now and Tap on the coin and see your balance rise🔥 Earn tokens and anticipate huge airdrops!",
            'parse_mode' => 'HTML',
            'reply_to_message_id' => $message_id,
            'reply_markup' => json_encode([
                'inline_keyboard' => [
                    [
                        ['text' => '✨ Oᴘᴇɴ Aᴘᴘ ✨', 'web_app' => ['url' => $games_url]]
                    ],
                    [
                        ['text' => 'Jᴏɪɴ Oᴜʀ Cᴏᴍᴍᴜɴɪᴛʏ ❤️', 'url' => $community]
                    ],
                ]
            ])
        ]);
    }
}

?>
