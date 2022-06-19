<? session_start();
date_default_timezone_set('Asia/Tashkent');
const API_KEY = '5434227285:AAHHiPTPaZ-9xdWmA-WwT0Z9sJauHk3gM8M';
const YOUTUBE_API_KEY = 'AIzaSyCsOAmPXGGLtDga12IvarWMMVE78gS2rUU';
$admin = "679143250";
$system_pass = "123";
$logging = true; //false
$work_folder = str_replace("app.php", "", $_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST']."".$_SERVER['REQUEST_URI']);

$fallows = [
    [
        'text_btn' => "🤟 Dasturlash darslari", 
        'chat_id' => "-1001090616869",
        'link' => "https://t.me/Infomiruz",
        'required'=> true
    ]
];
// // bu majbury obunalarni tekshirish entervali soatlarda ko'rsating !
$fallow_time = 24; //7*24
$share_btn = [
    'share_btn' => "Do'stlarni taklif qilish 👭",
    'share_text' => "🤩🥳 Ijtimoiy tarmoqlarda <b>Give away</b>lar tasodifiy g'oliblarni aniqlash tizimi.",
    'share_link' => "https://t.me/im_givebot"
];
