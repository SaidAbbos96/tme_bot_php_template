<? session_start();
// header('Content-Type: text/html; charset=utf-8');
date_default_timezone_set('Asia/Tashkent');

define('API_KEY','5333539303:AAE5Otq0DMKSMEe-3s_paphhyf0kcZxoTT8');
// admin akkounti id raqamini ushbu bot orqali bilishingiz mumkin @infomiruz_idbot
$admin = "679143250";
$system_pass = "123";
// $kurs_rub = 140;
$logging = true; //false
$share_btn = [
    'share_btn' => "Do'stlarni taklif qilish 👭",
    'share_text' => "🤩🥳 Salom, biz do'stlarimiz bilan yangi guruhda, sovg'alar o'yini tashkil etdik, omadingizni sinab ko'rmaysizmi (tekinga) ?!",
    'share_link' => "https://t.me/supergrop_api"
];
$db_mysql = [
    "status" => true,
    "host" => "localhost",
    "name" => "cmhosting_less",
    "user" => "cmhosting_less",
    "pass" => "H&wwT4x2"
];
$products = [
    [
        'title' => 'Qizil olma',
        'info' => "Lorem ipsum dolor sit amet consectetur adipisicing elit.",
        'photo' => "1.png",
        'price' => 4200,
    ],
    [
        'title' => 'Samarqand Gilos',
        'info' => "Lorem ipsum dolor sit amet consectetur adipisicing elit.",
        'photo' => "2.png",
        'price' => 5000,
    ],
    [
        'title' => 'Ananas',
        'info' => "Lorem ipsum dolor sit amet consectetur adipisicing elit.",
        'photo' => "3.png",
        'price' => 3500,
    ],
    [
        'title' => 'Qulupnay',
        'info' => "Lorem ipsum dolor sit amet consectetur adipisicing elit.",
        'photo' => "4.png",
        'price' => 2100,
    ],
    [
        'title' => 'Apelsin',
        'info' => "Lorem ipsum dolor sit amet consectetur adipisicing elit.",
        'photo' => "5.png",
        'price' => 3600,
    ],
    [
        'title' => 'Limon',
        'info' => "Lorem ipsum dolor sit amet consectetur adipisicing elit.",
        'photo' => "6.png",
        'price' => 2800,
    ]
];