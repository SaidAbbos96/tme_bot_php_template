<? 
require_once "config.php";
require_once "funcs.php";

$update = json_decode(file_get_contents('php://input'));

// message variables
$message = $update->message;
$channel_post = $update->channel_post;
$text = html($message->text);
$chat_id = $message->chat->id;
$chat_type = $message->chat->type;
$from_id = $message->from->id;
$message_id = $message->message_id;
$first_name = $message->from->first_name;
$last_name = $message->from->last_name;
$full_name = html($first_name . " " . $last_name);

// reply_to_message
$reply_message = $message->reply_to_message;

// filelar
$caption = $message->caption;
$document = $message->document;
$photo = $message->photo;
$audio = $message->audio;
$video = $message->video;
// call back
$call = $update->callback_query;
if ($call){
    $chat_id = $call->message->chat->id;
    $chat_type = $call->message->chat->type;
    $message_id = $call->message->message_id;
}
$call_from_id = $call->from->id;
$call_id = $call->id;
$call_data = $call->data;
$call_message_id = $call->message->message_id;

// game
$game = $call->message->game;
$game_short_name = $call->game_short_name;
$callback_game = $message->reply_markup->inline_keyboard[0]->text;

if($chat_type == "private"){
    if($text == "/start"){
        $hi_text = "Salom <b>Infomir.uz</b> Game botga hush kelibsiz.<pre>⚠️ Diqqat, ushbu bot tizimi infomiruz portalida, faqat ilm ulashish maqsadida prototipe shaklida yaratildi !</pre>";
        bot('sendmessage', [
            'chat_id' => $chat_id,
            'text' => $hi_text,
            'parse_mode' => 'HTML' 
        ]);
    }else if($text == "/startgame"){
        $reply = "Quyida siz uchun tizimda mavjud barcha o'yinlar ruyxati keltirilgan, o'zingiz uchun istalgan o'yinni tanlang !";
        $game_keyboard = [
            [
                ['text' => "💡 O'yinlar qanday o'ynaladi ?", 'callback_data' => "game||faq"],
                ['text' => "🎮 Barcha o'yinlar ?", 'callback_data' => "game||count"]
            ]
        ];
        foreach ($games_list as $game){
            array_push($game_keyboard, [
                ['text' => $game['list_text'], 'callback_data' => "game||".$game['short_name']]
            ]);
        };
        bot('sendmessage', [
            'chat_id' => $chat_id,
            'text' => $reply,
            'parse_mode' => 'HTML',
            'reply_markup' => json_encode([
                'inline_keyboard' => $game_keyboard
            ])
        ]);
    }else if($call && mb_stripos($call_data, "game||") !== false){
        $comand = explode("||", $call_data)[1] ?: false;
        if($comand == 'faq'){
            bot('answerCallbackQuery', [
                'callback_query_id' => $call_id,
                'show_alert' => true,
                'text' => "Ushbu game bot yordamida siz tanlagan o'yinni telegram ichida ochib o'ynashingiz va natijalarni tizim reytingeda kuzatishingiz mumkin."
            ]);
        }else if($comand == 'count') {
            bot('answerCallbackQuery', [
                'callback_query_id' => $call_id,
                'cache_time' => 3600,
                'text' => "O'yinlar soni: ".count($games_list)
            ]);
        }else if(in_array($comand, $games_name_list)) {
            $game = $games_list[array_search($comand, $games_name_list)];
            bot('sendGame', [
                'chat_id' => $chat_id,
                'game_short_name' => $game['short_name'],
                'reply_markup' => json_encode([
                    'inline_keyboard' => [
                        [
                            ['text' => $game['list_text'], 'callback_game' => []]
                        ],
                        [
                            [
                                'text' => $share_btn['share_btn'],
                                'url' => 'https://t.me/share/url?url='.$share_btn['share_link'].'&text='.$share_btn['share_text']
                            ]
                        ],
                        [
                            [
                                'text' => "Konkurs",
                                'url' => 'https://www.youtube.com/watch?v=rE3P97A8yDY'
                            ]
                        ],
                    ]
                ])
            ]);
        };
    }else if($game && $game_short_name){
        $game = $games_list[array_search($game_short_name, $games_name_list)];
        bot('answerCallbackQuery', [
            'callback_query_id' => $call_id,
            'url' => $game['url']
        ]);
    }else if($text == "/info" && $chat_id == $admin){
        bot('sendmessage', [
            'chat_id' => $chat_id,
            'text' => bot_info(),
            'parse_mode' => 'HTML' 
        ]);
    };
};
