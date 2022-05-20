<? 
require_once "config.php";
require_once "funcs.php";
$log = file_get_contents('php://input');
$update = json_decode($log);
if($update && $logging) file_put_contents("log.json", reformat($log));
// message variables
$message = $update->message;
$text = html($message->text);
$chat_id = $message->chat->id;
$chat_type = $message->chat->type;
$from_id = $message->from->id;
$message_id = $message->message_id;
$language_code = $message->from->language_code;
$first_name = $message->from->first_name;
$last_name = $message->from->last_name;
$user_id = $message->from->id;
$full_name = html($first_name . " " . $last_name);

// call back
$call = $update->callback_query;
if ($call){
    $chat_id = $call->message->chat->id;
    $chat_type = $call->message->chat->type;
    $message_id = $call->message->message_id;
    $language_code = $call->from->language_code;
}
$call_from_id = $call->from->id;
$call_id = $call->id;
$call_data = $call->data;
$call_message_id = $call->message->message_id;

if($chat_type == "private"){
    if($text == "/start"){
        $hi_text = "<pre>{$langs[$language_code]['text']} 👇</pre>";
        bot('sendmessage', [
            'chat_id' => $chat_id,
            'text' => $hi_text,
            'parse_mode' => 'HTML',
            'reply_markup' => json_encode([
                'inline_keyboard' => $langs_keyboard
            ])
        ]);
    }else if(mb_stripos($call_data, "lang||") !== false){
        $lang_code = explode("||",$call_data)[1];
        $words = get_words(["lang_code" => $lang_code, "user_id" => $call_from_id]);
        
        bot('editMessageText', [
            'chat_id' => $chat_id,
            'message_id' => $call_message_id,
            'text' => $words["hi_text"],
            'parse_mode' => 'HTML',
            'reply_markup' => json_encode([
                'inline_keyboard' => [
                        [
                            ['text' => $words['book_store'], 'callback_data' => "book||store"],
                        ],
                        [
                            ['text' => $words['videos_1'], 'url' => "https://youtube.com/playlist?list=PLmYtzpKf4ieqwj-NZNu2euI53tdz6Pd7r"],
                        ],
                        [
                            ['text' => $words['videos_2'], 'url' => "https://youtube.com/playlist?list=PLmYtzpKf4iepGNbOZszg4BjK3JQINVmjS"],
                        ],
                        [
                            ['text' => $words['lang_settings'], 'callback_data' => "reset_lang"]
                        ]    
                ]
            ])
        ]);
    }else if($call_data == "book||store"){
        $words = get_words(["user_id" => $call_from_id]);
        $reply = $words["product_list_title"];
        foreach ($words['books_list'] as $book) $reply .= "\nNomi: <b>{$book}</b>";

        bot('editMessageText', [
            'chat_id' => $chat_id,
            'message_id' => $call_message_id,
            'text' => $reply,
            'parse_mode' => 'HTML',
            'reply_markup' => json_encode([
                'inline_keyboard' => [
                    [
                        ['text' => $words['menu'], 'callback_data' => "menu"]
                    ]
                ]
            ])
            
        ]);
    }else if($call_data == "menu"){
        $words = get_words(["user_id" => $call_from_id]);
        bot('editMessageText', [
            'chat_id' => $chat_id,
            'message_id' => $call_message_id,
            'text' => $words["menu"],
            'parse_mode' => 'HTML',
            'reply_markup' => json_encode([
                'inline_keyboard' => [
                        [
                            ['text' => $words['book_store'], 'callback_data' => "book||store"],
                        ],
                        [
                            ['text' => $words['videos_1'], 'url' => "https://youtube.com/playlist?list=PLmYtzpKf4ieqwj-NZNu2euI53tdz6Pd7r"],
                        ],
                        [
                            ['text' => $words['videos_2'], 'url' => "https://youtube.com/playlist?list=PLmYtzpKf4iepGNbOZszg4BjK3JQINVmjS"],
                        ],
                        [
                            ['text' => $words['lang_settings'], 'callback_data' => "reset_lang"]
                        ]    
                ]
            ])
        ]);
    };
};