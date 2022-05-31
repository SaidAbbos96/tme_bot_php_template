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
        $hi_text = "<pre>salom infomir inline botga hush kelibsiz 👇</pre>";
        bot('sendmessage', [
            'chat_id' => $chat_id,
            'text' => $hi_text
        ]);
    }
}else if($update->callback_query->game_short_name){
    bot('answerCallbackQuery', [
        'callback_query_id' => $update->callback_query->id,
        'url' => "https://mproweb.uz/YTless/gameBot/games/omadshou/"
    ]);
}else if ($update->inline_query){
    $i_query = $update->inline_query;
    bot('answerInlineQuery', [
        'inline_query_id' => $i_query->id,
        'cache_time' => 5,
        'switch_pm_text' => "Yordam",
        'switch_pm_parameter' => "BONUS_CODE-AB445__PRAM1-infomir",
        // 'next_offset' => "5",
        'results' => json_encode([
            [
                'type'=> 'article',
                'id'=> uniqid(),
                'title'=> "⭕️Python, JavaScript va PHP da bot yaratamiz.",
                'input_message_content'=> [
                    'message_text' => "⭕️Python, JavaScript va PHP da telegram chat bot yaratamiz. Hammasini yagona 💰bepul hostinga deploy qilamiz. shoshiling hosting soni cheklangan !\n✅Ushbu videoda siz bilan birgalikda Telegram uchun Python(aiogram), Javascript va PHP dasturlash tillarida chat bot yaratamiz va barcha botlarimizni bitta bepul web hostinga deploy qilamiz, shoshiling bepul hosting berilish cheklangan.\n<a href='https://beget.com/p703532'>Python, Nodejs va PHP botlar uchun bepul hosting.</a>\nhttps://youtu.be/20Q0WAMsl30",
                    'parse_mode' => "HTML"
                ],
                'url' => 'https://youtu.be/20Q0WAMsl30',
                'description' => 'Bepul 💰 hostinga deploy qilamiz.',
                'thumb_url' => 'https://img.youtube.com/vi/20Q0WAMsl30/0.jpg',
                'thumb_width' => 100,
                'thumb_height' => 100,
                'reply_markup' => [
                    'inline_keyboard' => [
                        [
                            ['text' => "Do'stlarga ulashish", 'switch_inline_query' => "chatbot"]
                        ],
                        [
                            ['text' => "Barcha videolarni ko'rish", 'switch_inline_query_current_chat' => "videolar"]
                        ],
                        [
                            ['text' => "Callback", 'callback_data' => "videolar"]
                        ],
                        [
                            ['text' => "Havola", 'url' => "https://www.youtube.com/channel/UCpAmhIilueKZ301QTbuJUzw"]
                        ]
                    ]
                ]
        ],
        [
            'type'=> 'contact',
            'id'=> uniqid(),
            'phone_number'=> "+8617121048051",
            'first_name'=> "Abdullajon",
            'last_name'=> "Jurayev",
            'vcard'=> "BEGIN:VCARD\nVERSION:3.0\nFN:Abdullajon Jurayev\nTEL;MOBILE:+8617121048051\nEND:VCARD",
            'input_message_content'=> [
                'phone_number'=> "+8617121048051",
                'first_name'=> "Abdullajon",
                'last_name'=> "Jurayev",
                'vcard'=> "BEGIN:VCARD\nVERSION:3.0\nFN:Abdullajon Jurayev\nTEL;MOBILE:+8617121048051\nEND:VCARD",
            ],
            'description' => 'Abdullajondi tel nomeri',
            'thumb_url' => 'https://img.youtube.com/vi/QBy5c5_WsI8/0.jpg',
            'thumb_width' => 100,
            'thumb_height' => 70,
            'reply_markup' => [
                'inline_keyboard' => [
                    [
                        ['text' => "Do'stlarga ulashish", 'switch_inline_query' => "chatbot"]
                    ],
                    [
                        ['text' => "Barcha videolarni ko'rish", 'switch_inline_query_current_chat' => "videolar"]
                    ]
                ]
            ]
        ],
        [
            'type'=> 'photo',
            'id'=> uniqid(),
            'photo_url'=> "https://st.depositphotos.com/1010683/1389/i/450/depositphotos_13895290-stock-photo-giant-panda-bear-eating-bamboo.jpg",
            'photo_width' => 600,
            'photo_height' => 400,
            'title'=> "Ochko'z panda 2022",
            'caption'=> "Pandani rasmi 29.05.22",
            'parse_mode'=> "HTML",
            'description' => 'Pandachani rasmchasi',
            'thumb_url' => 'https://st.depositphotos.com/1010683/1389/i/450/depositphotos_13895290-stock-photo-giant-panda-bear-eating-bamboo.jpg',
            'reply_markup' => [
                'inline_keyboard' => [
                    [
                        ['text' => "Do'stlarga ulashish", 'switch_inline_query' => "chatbot"]
                    ],
                    [
                        ['text' => "Barcha videolarni ko'rish", 'switch_inline_query_current_chat' => "videolar"]
                    ]
                ]
            ]
        ],
        [
            'type'=> 'photo',
            'id'=> uniqid(),
            'photo_url'=> "https://ichef.bbci.co.uk/news/640/cpsprodpb/2F39/production/_103498021_gettyimages-475636556.jpg",
            'photo_width' => 600,
            'photo_height' => 400,
            'title'=> "Ochko'z panda 2022",
            'caption'=> "Pandani rasmi 29.05.22",
            'parse_mode'=> "HTML",
            'description' => 'boshqa panda',
            'thumb_url' => 'https://ichef.bbci.co.uk/news/640/cpsprodpb/2F39/production/_103498021_gettyimages-475636556.jpg',


            'reply_markup' => [
                'inline_keyboard' => [
                    [
                        ['text' => "Do'stlarga ulashish", 'switch_inline_query' => "chatbot"]
                    ],
                    [
                        ['text' => "Barcha videolarni ko'rish", 'switch_inline_query_current_chat' => "videolar"]
                    ]
                ]
            ]
        ],
        [
            'type'=> 'video',
            'id'=> uniqid(),
            'video_url'=> "https://mproweb.uz/YTless/tgramApi/myvideo.mp4",
            'mime_type'=> "video/mp4",
            'title'=> "Test video",
            'caption'=> "inlinebotdan video",
            'parse_mode'=> "HTML",
            'description' => 'qiziqarli video',

            'thumb_url' => 'https://itiq.ps/wp-content/uploads/2021/10/youtube-video-titles.jpg',
            'reply_markup' => [
                'inline_keyboard' => [
                    [
                        ['text' => "Do'stlarga ulashish", 'switch_inline_query' => "chatbot"]
                    ],
                    [
                        ['text' => "Barcha videolarni ko'rish", 'switch_inline_query_current_chat' => "videolar"]
                    ]
                ]
            ]
        ],
        [
            'type'=> 'audio',
            'id'=> uniqid(),
            'audio_url'=> "https://mproweb.uz/YTless/tgramApi/audio.mp3",
            'title'=> "Test audio",
            'caption'=> "inlinebotdan audio",
            'parse_mode'=> "HTML",
            'performer' => 'Katta hofiz',

            'reply_markup' => [
                'inline_keyboard' => [
                    [
                        ['text' => "Do'stlarga ulashish", 'switch_inline_query' => "chatbot"]
                    ],
                    [
                        ['text' => "Barcha videolarni ko'rish", 'switch_inline_query_current_chat' => "videolar"]
                    ]
                ]
            ]
        ],
        [
            'type'=> 'document',
            'id'=> uniqid(),
            'document_url'=> "https://mproweb.uz/YTless/tgramApi/file.pdf",
            'title'=> "Test document",
            'caption'=> "inlinebotdan document",
            'parse_mode'=> "HTML",
            'mime_type' => 'application/pdf',
            'description' => 'May oyi hisobotlari',
        ],        
        [
            'type'=> 'game',
            'id'=> uniqid(),
            'game_short_name'=> "omadshou",
            'reply_markup' => [
                'inline_keyboard' => [
                    [
                        ['text' => "Omad shouni o'ynash", 'callback_game' => []]
                    ],
                    [
                        ['text' => "Do'stlarga ulashish", 'switch_inline_query' => "chatbot"]
                    ],
                    [
                        ['text' => "Barcha videolarni ko'rish", 'switch_inline_query_current_chat' => "videolar"]
                    ]
                ]
            ]
         ]
        ]),
    ]);
};
