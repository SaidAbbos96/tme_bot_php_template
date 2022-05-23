<? session_start();
date_default_timezone_set('Asia/Tashkent');
const API_KEY = '5303395364:AAESm2JBPg6NBNV6L2rZV2FSPSsYkmAiIy8';
// admin akkounti id raqamini ushbu bot orqali bilishingiz mumkin @infomiruz_idbot
$admin = "679143250";
$system_pass = "123";
$logging = true; //false
$work_folder = str_replace("app.php", "", $_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST']."".$_SERVER['REQUEST_URI']);
$bonus_ball = 5;
// $fallows = [
//     [
//         'text_btn' => "🤟 Dasturlash darslari", 
//         'chat_id' => "-1001090616869",
//         'link' => "https://t.me/Infomiruz",
//         'required'=> false
//     ],
//     [
//         'text_btn' => "👌 Bizning kanal", 
//         'link' => "https://t.me/kanal_api", 
//         'chat_id' => $my_channel,
//         'required'=> true
//     ],
//     [
//         'text_btn' => "👉 Bizning guruh 👈",
//         'link' => "https://t.me/+HyCLAXJCBSc1ZGE1",
//         'chat_id' => $my_group,
//         'required'=> true
//     ]
// ];
// // bu majbury obunalarni tekshirish entervali soatlarda ko'rsating !
// $fallow_time = 24; //7*24
$share_btn = [
    'share_btn' => "Do'stlarni taklif qilish 👭",
    'share_text' => "🤩🥳 Eng kerakli va foydali dasturlarni bepul yuklab olish mumkin bo'lgan tizim.",
    'share_link' => "https://t.me/im_ref_bot"
];
$db_mysql = [
    "status" => true,
    "host" => "localhost",
    "name" => "cmhosting_refer",
    "user" => "cmhosting_refer",
    "pass" => "1d8EZ&Kc"
];
