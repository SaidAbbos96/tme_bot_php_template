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

// filelar
$document = $message->document;

if($chat_type == "private" && $chat_id == $admin){
    if(mb_stripos($text, "/start") !== false){
        $hi_text = "🤞 Salom cap, bot ishlamoqda !\nSizning taklif havolangiz: \n<code>https://t.me/im_ref_bot?start=BONUS={$chat_id}</code>";
        bot('sendmessage', [
            'chat_id' => $chat_id,
            'text' => $hi_text,
            'parse_mode' => 'HTML' 
        ]);
        userdb(['user_id' => $chat_id]);
    }else if($document){
        if ($db_file = fileCloud(['file' => $document])) {
            $caption = "✅ Fayl saqlandi. \n🆔 Cloud_id: <b>".$db_file['id']."</b>";
            $link = $share_btn["share_link"]."?start=BONUS={$chat_id}__app={$db_file['file_unique_id']}";
            bot("sendDocument", [
                'chat_id' => $chat_id,
                "document" => $document->file_id,
                'caption' => $caption,
                'parse_mode' => 'HTML',
                'reply_markup' => json_encode([
                    'inline_keyboard' => [
                        [
                            [
                                'text' => $share_btn['share_btn'], 
                                'url' => "https://t.me/share/url?url={$link}&text=".$share_btn['share_text']
                            ]
                        ]
                    ]
                ])
            ]);
        }
    }else if($text == "/apps" or $text == "/cloud"){
        $hi_text = "Filelar ruyxati:<pre>filalarni yuborish uchun shunchaki tugmaga bosing</pre>";
        $files = fileCloud(['find_all' => true]);
        $list_files = [];
        foreach ($files as $file) {
            $link = $share_btn["share_link"]."?start=BONUS={$chat_id}__app={$file['file_unique_id']}";
            $list_files[] = [
                [
                    'text' => $file['file_name'], 
                    'url' => "https://t.me/share/url?url={$link}&text=".$share_btn['share_text']
                ]
                ];
        }
        bot('sendmessage', [
            'chat_id' => $chat_id,
            'text' => $hi_text,
            'parse_mode' => 'HTML',
            'reply_markup' => json_encode([
                'inline_keyboard' => $list_files
            ])
        ]);
    }else if($text == "/hisob" or $text == "Hisob"){
        if($user = userdb(['score' => $chat_id])){
            bot('sendmessage', [
                'chat_id' => $chat_id,
                'text' => "Sizning hisobingizda: {$user['score']} ball",
                'parse_mode' => 'HTML' 
            ]);
        }
    }
}else if($chat_type == "private"){
    if(user_is_followed($from_id)){
        if($text == "/start"){
            $hi_text = "😎 Salom <a href='https://www.youtube.com/c/infomiruz'>infomiruz Guruhlarni boshqarish tizimi</a>ga hush kelibsiz !!!<pre>Tizimdan foydalanish uchun / belgisi orqali buyruqlarni yuboring yoki menudan foydalaning.</pre>";
            bot('sendmessage', [
                'chat_id' => $chat_id,
                'text' => $hi_text,
                'parse_mode' => 'HTML' 
            ]);
        }else if($text == "/game"){
            $game = bot('sendDice', [
                'chat_id' => $chat_id,
                'emoji' => $dices[rand(0, count($dice) -1)]
            ]);
            if($res = game(['game' => $game['result']])){
                bot('sendmessage', [
                    'chat_id' => $chat_id,
                    'text' => "Botning natijasi: <b>".$res['value']." ball</b> 😎🦾.\n🤝 Bot bilan o'yinda g'olibni aniqlash uchun, siz ham ushbu o'yin ustiga bosib botga yuboring !!!<pre>⚠️ Bot har safar tasodifiy o'yinni yuboradi va natijalar omadga bog'liq bo'ladi.</pre>",
                    'parse_mode' => 'HTML'
                ]);
            };
        }else if(isset($message->dice)){
            if($res = game(['mess' => $message])){
                $score = $message->dice->value;
                if ($score > $res['value']){
                    $reply = "🤘 Natijangiz: <b>".$score." ball.</b>\n🥳 Tabriklayman siz yutdingiz !";
                } else {
                    $reply = "Afsus, bot yutdi 😁";
                };
                $reply .= "\nYana o'ynash uchun 👉 /game buyrug'iga bosing !";
            }else {
                $reply = "Siz avval o'yin yuboringda ! 👉 /game";
            };
            bot('sendmessage', [
                'chat_id' => $chat_id,
                'text' => $reply,
                'parse_mode' => 'HTML'
            ]);
        }else if($text == "/myscore"){
            $res = invites(['user_id' => $from_id]);
            $res = $res ? $res['score'] : 0;
            bot('sendmessage', [
                'chat_id' => $chat_id,
                'text' => "Guruhga takliflar bo'yicha sizning ballaringiz: <b>".$res."</b> 🎯.<pre>Ballarni ko'paytirish uchun bizning guruhimizga do'stlaringizni taklif qiling va sovg'alarga ega bo'ling !</pre>",
                'parse_mode' => 'HTML',
                'reply_markup' => json_encode([
                    'inline_keyboard' => get_fallows(['share_btn' => true])
                ])
            ]);
        };
    }else{
        bot('sendmessage', [
            'chat_id' => $chat_id,
            'text' => "⚠️ Xatolik, tizimdan foydalanish uchun bizning kannallarga a'zo bo'lishingiz shart !",
            'parse_mode' => 'HTML',
            'disable_web_page_preview' => true,
            'reply_markup' => json_encode([
                'inline_keyboard' => get_fallows(['test_btn' => false])
            ])
        ]);
    }
    if(mb_stripos($text, "/start") !== false){
        $hi_text = "😎 Assalom alaykum <a href='https://www.youtube.com/c/infomiruz'>infomiruz apps boti</a>ga hush kelibsiz !!!
        <pre>UShbu botda siz kundalik hayotingiznida ishlatiladigan dasturlarni mutlaqo bepul yuklab olishingiz mumkin, ammo bu hammasi emas bizning botimizni va dasturarimizni do'stlaringizga ulashing va bonus ballarga ega boling.</pre>Sizning taklif havolangiz:\n<code>https://t.me/im_ref_bot?start=BONUS={$chat_id}</code>";
        bot('sendmessage', [
            'chat_id' => $chat_id,
            'text' => $hi_text,
            'parse_mode' => 'HTML' 
        ]);
        if(strlen($text) > 6){
            $params = getParams($text);

            bot('sendmessage', [
                'chat_id' => $chat_id,
                'text' => "parametrlar: ".json_encode($params),
                'parse_mode' => 'HTML' 
            ]);

            if(isset($params['BONUS']) and $params['BONUS'] != $chat_id){
                if($refer = userdb(['user_id' => $chat_id, "refer_id" => $params['BONUS']])){
                    bot('sendSticker', [
                        'chat_id' => $refer['user'],
                        'sticker' => "CAACAgIAAxkBAAPpYougS3usrbZoc_Ed9YrPUc6IwkIAAmgMAALK80FIaNh-rr2UbcUkBA"
                    ]);
                    bot('sendmessage', [
                        'chat_id' => $refer['user'],
                        'text' => "Sizning taklif havolangizdan yangi foydalanuvchi ro'yxatdan o'tdi.\nHisobingizga soqqa tushvottiyu bro....!: {$refer['score']} ball\n /hisob",
                        'parse_mode' => 'HTML', 
                        'reply_markup' => json_encode([
                            'resize_keyboard' => true,
                            'one_time_keyboard' => true,
                            'keyboard' => [
                                [
                                    [
                                        'text' => "Hisob"
                                    ]
                                ]
                            ]
                        ])
                    ]);
                }
            }
            if(isset($params['app'])){ 
                $app = fileCloud(['find' => $params['app']]);
                $link = $share_btn["share_link"]."?start=BONUS={$chat_id}__app={$app['file_unique_id']}";
                bot('sendDocument', [
                    'chat_id' => $chat_id,
                    'document' => $app['file_id'],
                    'caption' => "Bu eng zur dastur.",
                    'parse_mode' => 'HTML' ,
                    'reply_markup' => json_encode([
                        'inline_keyboard' => [
                            [
                                [
                                    'text' => $share_btn['share_btn'], 
                                    'url' => "https://t.me/share/url?url={$link}&text=".$share_btn['share_text']
                                ]
                            ]
                        ]
                    ])
                ]);
                userdb(['user_id' => $chat_id]);
            };
        }else{
            userdb(['user_id' => $chat_id]);
        }
    }else if($text == "/hisob" or $text == "Hisob"){
        if($user = userdb(['score' => $chat_id])){
            bot('sendmessage', [
                'chat_id' => $chat_id,
                'text' => "Sizning hisobingizda: {$user['score']} ball",
                'parse_mode' => 'HTML' 
            ]);
        }
    }
}

