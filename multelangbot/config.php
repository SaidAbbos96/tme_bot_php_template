<? session_start();

const API_KEY = '5318061037:AAGg37l-jQC_SJ8Kny1PISn9XAKo1wwP2SQ';
// admin akkounti id raqamini ushbu bot orqali bilishingiz mumkin @infomiruz_idbot
$admin = "679143250";
$system_pass = "123";
$logging = true; //false
$work_folder = str_replace("app.php", "", $_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST']."".$_SERVER['REQUEST_URI']);

$langs = [
    "uz" => [
        "text" => "Iltimos, Tilni tanlang !", 
        "btn_text" => "O'zbekcha 🇺🇿",
    ],
    "ru" => [
        "text" => "Пожалуйста, выберите язык !", 
        "btn_text" => "Русский 🇷🇺",
    ],
    "en" => [
        "text" => "Please, select a language !", 
        "btn_text" => "English 🇱🇷",
    ],
    "fr" => [
        "text" => "FRench Please, select a language !", 
        "btn_text" => "French",
    ]
];