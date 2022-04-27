<? session_start();
// header('Content-Type: text/html; charset=utf-8');
date_default_timezone_set('Asia/Tashkent');

define('API_KEY','5366289252:AAHrdml_aUIPQJ4sAWzYIeePV1t2nBU1rMc');
// admin akkounti id raqamini ushbu bot orqali bilishingiz mumkin @infomiruz_idbot
$admin = "713516566";
$system_pass = "123";
$my_group = "-1001797419694";
$my_channel = "-1001624814365";
$logging = true; //false
$fallows = [
    [
        'text_btn' => "🤟 Dasturlash darslari", 
        'chat_id' => "-1001090616869",
        'link' => "https://t.me/Infomiruz",
        'required'=> false
    ],
    [
        'text_btn' => "👌 Bizning kanal", 
        'link' => "https://t.me/kanal_api", 
        'chat_id' => $my_channel,
        'required'=> true
    ],
    [
        'text_btn' => "👉 Bizning guruh 👈",
        'link' => "https://t.me/+HyCLAXJCBSc1ZGE1",
        'chat_id' => $my_group,
        'required'=> true
    ]
];
// bu majbury obunalarni tekshirish entervali soatlarda ko'rsating !
$fallow_time = 24; //7*24
$share_btn = [
    'share_btn' => "Do'stlarni taklif qilish 👭",
    'share_text' => "🤩🥳 Salom, biz do'stlarimiz bilan yangi guruhda, sovg'alar o'yini tashkil etdik, omadingizni sinab ko'rmaysizmi (tekinga) ?!",
    'share_link' => "https://t.me/supergrop_api"
];
$db_mysql = [
    "status" => true,
    "host" => "host",
    "name" => "db_name",
    "user" => "db_user",
    "pass" => "db_pass"
];
$comands = [
   [
        'commands' => json_encode([
            ["command" => "/info", "description" => "Bot faoliyati haqida."],
            ["command" => "/top", "description" => "Takliflar bo'yicha natijalar."],
            ["command" => "/newfile", "description" => "Yangi file yuklash."],
            ["command" => "/mycloud_photo", "description" => "Mening barcha photolarim."],
            ["command" => "/mycloud_audio", "description" => "Mening barcha audio filelarim."],
            ["command" => "/mycloud_video", "description" => "Mening barcha videolarim."],
            ["command" => "/mycloud_document", "description" => "Mening barcha documentlarim."]
        ]),
        'scope' => json_encode([
            'type' => "chat",
            'chat_id' => $admin
        ])
    ],
   [
        'commands' => json_encode([
            ["command" => "/ban", "description" => "Qatnashchiga ban berish, reply /ban."],
            ["command" => "/mute", "description" => "Foydalanuvchini cheklash, reply 10 menut."],
            ["command" => "/money", "description" => "Valyuta Kurslarini olish."],
            ["command" => "/top", "description" => "Takliflar bo'yicha yetakchilar + 3...100."],
            ["command" => "/game", "description" => "Tasodifiy o'yin boshlash."],
            ["command" => "/stop", "description" => "Chatni yopib qo'yish."],
            ["command" => "/start", "description" => "Chatni ishga tushurish."]
        ]),
        'scope' => json_encode([
            'type' => "all_chat_administrators"
        ])
    ],
   [
        'commands' => json_encode([
            ["command" => "/top", "description" => "Takliflar bo'yicha yetakchilar."],
            ["command" => "/game", "description" => "Tasodifiy o'yin boshlash."],
            ["command" => "/money", "description" => "Valyuta Kurslarini olish."],
        ]),
        'scope' => json_encode([
            'type' => "all_group_chats"
        ])
    ],
   [
        'commands' => json_encode([
            ["command" => "/top", "description" => "Статистика по приглашению."],
            ["command" => "/game", "description" => "Начать случайная игра."],
            ["command" => "/money", "description" => "Узнать о курсах валют."],
        ]),
        'scope' => json_encode([
            'type' => "all_group_chats"
        ]),
        "language_code" => "ru"
    ],
    [
        'commands' => json_encode([
            ["command" => "/start", "description" => "Bot haqida malumot."],
            ["command" => "/game", "description" => "Bot bilan o'yin o'ynash."],
            ["command" => "/myscore", "description" => "Mening ballarim."],
        ]),
        'scope' => json_encode([
            'type' => "all_private_chats"
        ])
    ],
    [
        'commands' => json_encode([
            ["command" => "/start", "description" => "Информация о работе бота."],
            ["command" => "/game", "description" => "Играть в случайную игру с ботом."],
            ["command" => "/myscore", "description" => "Мои баллы."],
        ]),
        'scope' => json_encode([
            'type' => "all_private_chats"
        ]),
        "language_code" => "ru"
    ],
];

$dices = ['🎲','🎯','🎳','🏀','⚽','🎰'];