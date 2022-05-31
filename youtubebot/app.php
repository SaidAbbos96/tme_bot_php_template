<? 
require_once "config.php";
require_once "funcs.php";
$log = file_get_contents('php://input');
$update = json_decode($log);
if($update && $logging) file_put_contents("log.json", reformat($log));
// message variables
$message = $update->message;
$text = $message->text;
$chat_id = $message->chat->id;
$chat_type = $message->chat->type;

if($chat_type == "private"){
    if($text == "/start"){
        $hi_text = "<pre>Salom infomir youtuber botiga hush kelibsiz 👇</pre>";
        bot('sendmessage', [
            'chat_id' => $chat_id,
            'text' => $hi_text,
            'reply_markup' => json_encode([
                'inline_keyboard' => [
                    [
                        ['text' => "Botni ishga tushurish", 'switch_inline_query' => ""]
                    ],
                    [
                        ['text' => "Botni tekshirish", 'switch_inline_query_current_chat' => "infomiruz"]
                    ]
                ]
            ])
        ]);
    }
}else if ($update->inline_query){
    $i_query = $update->inline_query;
    $data = youtuber($i_query->query ?: "infomiruz");
    $send_keyboard = [
        'inline_keyboard' => [
            [
                ['text' => "Do'stlarga ulashish", 'switch_inline_query' => $i_query->query]
            ],
            [
                ['text' => "Video qidirish", 'switch_inline_query_current_chat' => "infomiruz"]
            ],
            [
                ['text' => "⭕️ Homiy kanal 1", 'url' => "https://t.me/Infomiruz"]
            ],
            [
                ['text' => "✅ Homiy sayt ", 'url' => "https://www.youtube.com/c/infomiruz"]
            ],
        ]
    ];
    $results = [];
    foreach ($data['items'] as $video) {
        array_push($results,[
                    'type'=> 'article',
                    'id'=> uniqid(),
                    'title'=> $video['snippet']['title'],
                    'description' => $video['snippet']['description'],
                    'thumb_url' => $video['snippet']['thumbnails']['default']['url'],
                    'input_message_content'=> [
                        'message_text' => "Ushbu video <b>@im_youtuberbot</b> yordamida yuborildi, siz ham sinab ko'rishni istasangiz, video qidirish tugmasini bosing ! \nhttps://youtu.be/{$video['id']['videoId']}",
                        'parse_mode' => "HTML"
                    ],
                    'reply_markup' => $send_keyboard
                ]
        );
    }
    bot('answerInlineQuery', [
        'inline_query_id' => $i_query->id,
        'cache_time' => 5,
        'switch_pm_text' => "Yordam",
        'switch_pm_parameter' => "BONUS_CODE-AB445__PRAM1-infomir",
        // 'next_offset' => "5",
        'results' => json_encode($results),
    ]);
};
