<? 
date_default_timezone_set('Asia/Tashkent');
const API_KEY = '5314942065:AAHOQV9K5KpVpvK4em1vEJVauaWjwh6WlWM';
$operator = "679143250";

$update = json_decode(file_get_contents('php://input'));
// message variables
$message = $update->message;
$text = $message->text;
$chat_id = $message->chat->id;
$from_id = $message->from->id;
$message_id = $message->message_id;
$first_name = $message->from->first_name;
$last_name = $message->from->last_name;
$full_name = $first_name . " " . $last_name;

// replymessage
$reply_to_message = $message->reply_to_message;
$reply_chat_id = $message->reply_to_message->forward_from->id;
$reply_text = $message->text;

function bot($method = "getMe", $params = []){
    $url = "https://api.telegram.org/bot".API_KEY."/" . $method;
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
//$res = bot('deleteWebhook', [ // maxsus bot funksiyamiz orqali sendmessage ga
  //         'url' => "https://oedu.uz/php_bot/bot.php"
//]);
//print_r($res);
// Agar yozgan odam $Manager bo'lmasa ushbu kod qismiga kiramiz
if ($chat_id != $operator) {
    // Agar yozilgan habar /start bolsa, yani yangi foydalanuvchi
    //  botni ishga tushursa ushbu kod bajariladi
    if ($text == "/start") {
        // Foydalanuvchiga Manager  yoki kompaniya nomidan salom yo'llaymiz.
        $reply = "PHP рџ�Ћ Assalom alaykum <b>{$full_name}</b>, <a href='https://www.youtube.com/c/infomiruz'>infomiruz chatboti</a>ga hush kelibsiz !!!\nMurojat Yo'llashingiz Mumkin рџ‘‡";
        bot('sendmessage', [ // maxsus bot funksiyamiz orqali sendmessage ga
            'chat_id' => $chat_id, //foydalanuvchi id raqami va
            'text' => $reply, // habar matnini
            'parse_mode' => "HTML", //html formatda yuboramiz.
        ]);
        //  Yangi foydalanuvchi malumotlarini manajerga aniq vaqt bilan yuboramiz.
        $reply = "Yangi mijoz:\n{$full_name}\n👉 👉  <a href='tg://user?id={$from_id}'>{$from_id}</a>\n".date('Y-m-d H:i:s');
        bot('sendmessage', [ // maxsus bot funksiyamiz orqali sendmessage ga
            'chat_id' => $operator, //Manager id raqami va
            'text' => $reply, // habar matnini
            'parse_mode' => "HTML", //html formatda yuboramiz.
        ]);
        // Foydalanuvchidan kelgan ilk /start habarini javob bera olishi uchun managerga yuboramiz.
        bot('forwardMessage', [ // maxsus bot funksiyamiz orqali forwardMessage ga
            'chat_id' => $operator, //Manager id raqami va
            'from_chat_id' => $chat_id, // foydalanuvchi bilan bot o'rtasidagi chat id raqami
            'message_id' => $message_id, // va foydalanuvchi yuborgan habar id raqamini yuboramiz.
        ]);
        // Tekshiramiz foydalanuvchi /start komandasidan boshqa narsa yozgan bo'lsa
    }else if ($text != "/start"){
        // Foydalanuvchidan kelgan habarni javob bera olishi uchun managerga yuboramiz.
        bot('forwardMessage', [ // maxsus bot funksiyamiz orqali forwardMessage ga
            'chat_id' => $operator, //Manager id raqami va
            'from_chat_id' => $chat_id, // foydalanuvchi bilan bot o'rtasidagi chat id raqami
            'message_id' => $message_id, // va foydalanuvchi yuborgan habar id raqamini yuboramiz.
        ]);
    }
    // Yoki agar $Manager yozgan bo'lsa ushbu kod qismiga kiramiz
}else if($chat_id == $operator){
    // Agar manager bot qayta yuborgan hatga javob berish orqali habar yuborsa,
    if(isset($reply_to_message)){
        // Manager habarini bot qayta yuborgan habar egasiga bot nomidan yuboramiz
        bot('sendmessage', [ // maxsus bot funksiyamiz orqali sendmessage ga
            'chat_id' => $reply_chat_id, // bot qayta yuborgan habar id raqami va
            'text' => $reply_text, // manager yuborgan habarni
            'parse_mode' => "HTML", //html formatda yuboramiz.
        ]);
    }
    // Manager profilidan botni tekshirib ko'rish uchun botdan managerga salom !
    if($text == "hi" or $text == "/start"){
        bot('sendmessage', [
            'chat_id' => $operator,
            'text' => "PHP dan salom !",
        ]);
    }
}
