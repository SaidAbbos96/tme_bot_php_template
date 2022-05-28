<? 
const API_KEY = '5353968828:AAFQ6yx38-XsOfB82MVQHgXil1oucxcr66Y';

function bot($method = "getMe", $params = []){
    $url = "https://api.telegram.org/bot".API_KEY."/" . $method;
    $params['parse_mode'] = 'HTML'; 
    $curl = curl_init();
    curl_setopt_array($curl, [
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POSTFIELDS => $params,
        CURLOPT_HTTPHEADER => ['Content-Type:multipart/form-data'],
    ]);
    $res = curl_exec($curl);
    // dump(curl_getinfo($curl));
    curl_close($curl);
    return !curl_error($curl) ? json_decode($res, true) : false;
};
$logging = true;
$log = file_get_contents('php://input');
$update = json_decode($log);
if($update && $logging) file_put_contents("log.json", $log);
// message variables
$message = $update->message;
$text = $message->text;
$chat_id = $message->chat->id;
// echo "hello dunyo !";
$menu_btns = [
    "Accaount", "Hisoblarim", "Referallarim"
];
$languages = [
    "⭕️ Uzbek", "⭕️ Engish", "⭕️ Russian"
];
$user_lang = "en";

$words = [
    'uz' => [
        'home' => "Bosh sahifaga",
        'tabs' => [
            'cat1' => "Telefonlar",
            'cat2' => "Noutbooklar",
        ],
        'info' => "*** bo'limiga hush kelibsiz  !!!"
    ],
    'en' => [
        'home' => "Home page",
        'tabs' => [
            'cat1' => "SmartPhones",
            'cat2' => "Laptops",
        ],
        'info' => "Welcome to the *** page !!!"
    ],
    'ru' => [
        'home' => "Главный",
        'tabs' => [
            'cat1' => "Смартфоны",
            'cat2' => "Ноутбуки",
        ],
        'info' => "Добро пожаловать в раздел *** !!!"
    ]
];
function main_menu(){
    global $menu_btns;
    $ref_soni = 3;
    $menu = [
        "resize_keyboard" => true,
        "keyboard" => [
            [
                ["text" => $menu_btns[0]]
            ],
            [
                ["text" => $menu_btns[1]]
            ],
            [
                ["text" => "Bo'lim 1"], ["text" => "Bo'lim 2"], ["text" => "Bo'lim 3"],
            ]
        ]
    ];
    if($ref_soni > 0)  $menu['keyboard'][1][] = ["text" => $menu_btns[2]];
    return json_encode($menu);
}
function tabs($tab_num = 1){
    return json_encode([
        "resize_keyboard" => true,
        "keyboard" => [
            [
                ["text" => "⭕️ Bosh menu"]
            ],
            [
                ["text" => "{$tab_num} Funcsiya 1"],["text" => "{$tab_num} Funcsiya 2"],["text" => "{$tab_num} Funcsiya 3"],
            ]
        ]
    ]);
}
if ($text == "/start"){
    bot("sendMessage", [
        "chat_id" => $chat_id,
        "text" => "Salom <b>infomiruz</b> multibotga hush kelibsiz !",
        "reply_markup" => json_encode([
            "resize_keyboard" => true,
            // "one_time_keyboard" => true,
            "keyboard" => [
                [
                    ["text" => "⭕️ Bosh menu"]
                ]
            ]
        ])
    ]);
    // bot("sendMessage", [
    //     "chat_id" => $chat_id,
    //     "text" => "Salom <b>infomiruz</b> multibotga hush kelibsiz !",
    //     "reply_markup" => json_encode([
    //         "resize_keyboard" => true,
    //         // "one_time_keyboard" => true,
    //         "keyboard" => [
    //             [
    //                 ["text" => "Tugma 0"]
    //             ],
    //             [
    //                 ["text" => "Tugma 1"], ["text" => "Tugma 2"],
    //             ],
    //             [
    //                 ["text" => "Tugma 3"], ["text" => "Tugma 4"], ["text" => "Tugma 5"],
    //             ],
    //         ]
    //     ])
    // ]);
}else if ($text == "⭕️ Bosh menu") {
        bot("sendMessage", [
        "chat_id" => $chat_id,
        "text" => "Bizdagi bo'limlar",
        "reply_markup" => main_menu()
    ]);
}else if (in_array($text, $menu_btns)) {

    switch ($text) {
        case  $menu_btns[0]:
            $reply = "Sizning akkountingiz";
            break;
        case  $menu_btns[1]:
            $reply = "Hisobingizda 50 mln. sum bor";
            break;
        case  $menu_btns[2]:
            $reply = "Sizning referallaringiz\nAbdug'ani\nSardor";
            break;
        
        default:
            break;
    }
    bot("sendMessage", [
        "chat_id" => $chat_id,
        "text" => $reply,
        "reply_markup" => main_menu()
    ]);
}else if(mb_stripos($text, "Bo'lim") !== false){
    $tab_num =  explode(" ", $text)[1];
    bot("sendMessage", [
        "chat_id" => $chat_id,
        "text" => "Siz <b>{$text}</b>ga kirdingiz !",
        "reply_markup" => tabs($tab_num)
    ]);
}else if(mb_stripos($text, "Funcsiya") !== false){
    $params = explode(" ", $text);
    bot("sendMessage", [
        "chat_id" => $chat_id,
        "text" => "Siz <b>{$params[0]}-bo'limdagi <b>{$params[2]}</b>- funksiyaga</b>ga kirdingiz !",
        "reply_markup" => json_encode([
            "resize_keyboard" => true,
            // "one_time_keyboard" => true,
            "keyboard" => [
                [
                    ["text" => "⭕️ Bosh menu"], ["text" => "Bo'lim {$params[0]}"]
                ],
                [
                    ["text" => "Punkt 1"],["text" => "Punkt 2"],["text" => "Punkt 3"],["text" => "Punkt 4"],
                ],
            ]
        ])
    ]);
}else if($text == "/setlang"){
    bot("sendMessage", [
        "chat_id" => $chat_id,
        "text" => "Tilni tanlang !",
        "reply_markup" => json_encode([
            "resize_keyboard" => true,
            // "one_time_keyboard" => true,
            "keyboard" => [
                [
                    ["text" => $languages[0]]
                ],
                [
                    ["text" => $languages[1]], ["text" => $languages[2]]
                ]
            ]
        ])
    ]);
}else if(in_array($text, $languages)){
    $lang_codes = ['uz', 'en', 'ru'];
    $user_lang = array_search($text, $languages);
    $tarjima = $words[$lang_codes[$user_lang]];
    bot("sendMessage", [
        "chat_id" => $chat_id,
        "text" => "tanlangan til indexi {$lang_codes[$user_lang]}",
        "reply_markup" => json_encode([
            "resize_keyboard" => true,
            // "one_time_keyboard" => true,
            "keyboard" => [
                [
                    ["text" => $tarjima['tabs']['cat1']], ["text" => $tarjima['tabs']['cat2']]
                ]
            ]
        ])
    ]);
}else if(in_array($text, $words[$user_lang]['tabs'])){
    $tarjima =  $words[$user_lang];
    bot("sendMessage", [
        "chat_id" => $chat_id,
        "text" => str_replace("***", $text, $tarjima['info']),
        "reply_markup" => json_encode([
            "resize_keyboard" => true,
            // "one_time_keyboard" => true,
            "keyboard" => [
                [
                    ["text" => $tarjima['home']],
                ],
                [
                    ["text" => $tarjima['tabs']['cat1']], ["text" => $tarjima['tabs']['cat2']]
                ]
            ]
        ])
    ]);
}else if($text == $words[$user_lang]['home']){
    $tarjima =  $words[$user_lang];
    bot("sendMessage", [
        "chat_id" => $chat_id,
        "text" => $tarjima['home'],
        "reply_markup" => json_encode([
            "resize_keyboard" => true,
            // "one_time_keyboard" => true,
            "keyboard" => [
                [
                    ["text" => $tarjima['tabs']['cat1']], ["text" => $tarjima['tabs']['cat2']]
                ]
            ]
        ])
    ]);
}
// bot("sendMessage", [
//     "chat_id" => $chat_id,
//     "text" => "yangi xabar",
//     "reply_markup" => json_encode([
//         "remove_keyboard"=> true
//     ])
// ]);