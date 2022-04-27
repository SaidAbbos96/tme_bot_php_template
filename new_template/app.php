<? 
require_once "config.php";
require_once "funcs.php";

$update = json_decode(file_get_contents('php://input'));

// message variables
$message = $update->message;
$channel_post = $update->channel_post;
$text = html($message->text);
$chat_id = $message->chat->id;
$chat_type = $message->chat->type;
$from_id = $message->from->id;
$message_id = $message->message_id;
$first_name = $message->from->first_name;
$last_name = $message->from->last_name;
$full_name = html($first_name . " " . $last_name);

// reply_to_message
$reply_message = $message->reply_to_message;

// filelar
$caption = $message->caption;
$document = $message->document;
$photo = $message->photo;
$audio = $message->audio;
$video = $message->video;
// call back
$call = $update->callback_query;
if ($call){
    $chat_id = $call->message->chat->id;
    $chat_type = $call->message->chat->type;
    $message_id = $call->message->message_id;
}
$call_from_id = $call->from->id;
$call_id = $call->id;
$call_data = $call->data;
$call_message_id = $call->message->message_id;

if($message->new_chat_member || $message->left_chat_member){
    delete(['chat_id' => $chat_id, 'mess_id' => $message_id]);
    $new_members = $message->new_chat_members;
};

if($chat_type == "private" && $chat_id == $admin){
    if($text == "/start"){
        $hi_text = "Salom cap, bot ishlamoqda !";
        bot('sendmessage', [
            'chat_id' => $chat_id,
            'text' => $hi_text,
            'parse_mode' => 'HTML' 
        ]);
    }else if($text == "/info"){
        bot('sendmessage', [
            'chat_id' => $chat_id,
            'text' => bot_info(),
            'parse_mode' => 'HTML' 
        ]);
    }else if(mb_stripos($text, "/top") !== false){
        $top_level = (strlen($text) > 4) ? explode("+",$text)[1] : 10;
        $res = invites(['top' => true, 'top_level' => $top_level]);
        if($res){
            $reply = "Guruhga takliflar bo'yicha top natijalar:";
            $i = 1;
            foreach ($res as $user) {
                $reply .= "\n".$i.") <b>".$user['score']." ball</b>, <a href='tg://user?id=".$user['user']."'>".$user['name']."</a>";
                $i++;
            };
            $reply .= "\n<pre>⚠️ Top natijalarini boshqacha daraja(1-100gacha) bilan tekshirish uchun /top buyrug'iga darajani + belgisi orqali qoshib yuboring, Namuna:</pre><code>/top+15</code>";
        } else {
            $reply = "⚠️ Xatolik, natijalar topilmadi !!";
        };
        bot('sendmessage', [
            'chat_id' => $chat_id,
            'text' => $reply,
            'parse_mode' => 'HTML'
        ]);
        
    }else if($text == "/newfile"){
        bot('sendMessage', [
            'chat_id' => $chat_id,
            'text' => "<pre>Shaxsiy FileCloudga file qo'shish uchun istalgan fileni shu xabarga javob tariqasida yuboring, yoki file yuborishda ostida #addfile hashtagini qoldiring !!!</pre>",
            'parse_mode' => 'HTML',
            'reply_markup' => json_encode([
                'force_reply' => true,
                'input_field_placeholder' => "Fileni tanlang yoki chatga tashlang..."
            ])
        ]);
    }else if($caption == "#addfile" || $document || $photo || $audio || $video){
        if($document){
            $file = $document->file_id;
            $method = "sendDocument";
            $type = "document";
        }else if($video){
            $file = $video->file_id;
            $method = "sendVideo";
            $type = "video";
        }else if($audio){
            $file = $audio->file_id;
            $method = "sendAudio";
            $type = "audio";
        }else if($photo){
            $file = array_pop($photo)->file_id;
            $method = "sendPhoto";
            $type = "photo";
        };
        if ($method) {
            $db_file = fileCloud("c", ['file_id' => $file, 'method' => $method, 'type'=> $type]);
            $caption = "✅ Fayl saqlandi. \n🆔 Cloud_id: <b>".$db_file['id']."</b>\n🔍 Maxsus Hashtag: #".$type;
            $caption .= "\n\n<pre>⚠️ Faylni yuborish uchun guruh, kanal yoki botda Cloud idni va istasangiz filega izohni ko'rsatib xabar yozing.\n🆗 /mycloud+<b>".$db_file['id']."</b>+ File haqida !!!</pre>";
            bot($method, [
                'chat_id' => $chat_id,
                $type => $file,
                'caption' => $caption,
                'parse_mode' => 'HTML',
                'protect_content' => true
            ]);
        }else {
            bot('sendMessage', [
                'chat_id' => $chat_id,
                'text' => "⚠️ Xatolik, file topilmadi !!",
                'parse_mode' => 'HTML'
            ]);
        };

    }else if(mb_stripos($text, "/mycloud_") !== false){
        $type =  explode("_", $text)[1];
        $db_files = $type ? fileCloud("r", ['type' => $type]) : 0;
        if(count($db_files) > 1){
            $files = [];
            foreach ($db_files as $file) {
                $files[] = [
                    'type' => $file['type'],
                    'media' => $file['file_id'],
                    'caption' => "🆗 <code>/mycloud+<b>".$file['id']."</b>+ File haqida !!!</code>",
                    'parse_mode' => "HTML"
                ];
            };
            bot('sendMediaGroup', [
                'chat_id' => $chat_id,
                'media' => json_encode($files)
            ]);
        } else if(count($db_files) == 1){
            $file = array_shift($db_files);
            bot($file['method'], [
                'chat_id' => $chat_id,
                $file['type'] => $file['file_id'],
                'caption' => "🆗 <code>/mycloud+<b>".$file['id']."</b>+ File haqida !!!</code>",
                'parse_mode' => "HTML"
            ]);
        }else{
            bot('sendmessage', [
                'chat_id' => $chat_id,
                'text' => "⚠️ Xatolik, file topilmadi !!",
            ]);
        };
    };
}else if($chat_type == "supergroup" && $chat_id == $my_group){
    if(count($new_members) > 0 && $new_members[0]->id != $from_id){
        invites(['from_id' => $from_id, 'new_members' => count($new_members), 'name' => $full_name]);
    }else if(mb_stripos($text, "/top@") !== false){
        $res = invites(['top' => true]);
        if($res){
            $reply = "Guruhga takliflar bo'yicha top natijalar:";
            $i = 1;
            foreach ($res as $user) {
                $reply .= "\n".$i.") <b>".$user['score']." ball</b>, <a href='tg://user?id=".$user['user']."'>".$user['name']."</a>";
                $i++;
            };
            $reply .= "\n<pre>⚠️ Siz ham guruhimizga do'stlaringizni taklif qiling va yanada ko'proq ballarga ega bo'ling !</pre>";
        } else {
            $reply = "⚠️ Xatolik, natijalar topilmadi !!";
        };
        bot('sendmessage', [
            'chat_id' => $chat_id,
            'text' => $reply,
            'parse_mode' => 'HTML'
        ]);
        delete(['chat_id' => $chat_id, 'mess_id' => $message_id]);
    }else if(mb_stripos($text, "/money@") !== false){
        $res = get_data("https://cbu.uz/oz/arkhiv-kursov-valyut/json/");
        if($res){
            $reply = "💹<b>Markaziy bank valyuta kurslari:</b>";
            for($i=0; $i < 10; $i++){ 
                $money = $res[$i];
                $reply .= "\n🔹<b>".$money['Ccy']."</b>) Kurs <b>1".$money['Ccy']."=".$money['Rate']." sum</b>. ~: <b>".$money['Diff']." sum</b>, ♻️: <b>".$money['Date']."</b>.";
            };
            $reply .= "\n<pre>⚠️ Ushbu malumotlar O'ZRES markaziy banki tomonidan taqdim etilgan, yangilanish vaqti bir kun !</pre>";
        } else {
            $reply = "⚠️ Xatolik, Ushbu malumotlar O'ZRES markaziy banki tomonidan taqdim etilgan, agar xatolik bilan javob olsangiz kiyinroq urunb ko'ring !!!";
        };
        bot('sendmessage', [
            'chat_id' => $chat_id,
            'text' => $reply,
            'parse_mode' => 'HTML'
        ]);
        delete(['chat_id' => $chat_id, 'mess_id' => $message_id]);
    }else if($from_id == $admin && isset($message->reply_to_message) && (mb_stripos($text, "/ban@") !== false) ){
        bot('banChatMember', [
            'chat_id' => $chat_id,
            'user_id' => $message->reply_to_message->from->id,
            'revoke_messages' => true
        ]);
        delete(['chat_id' => $chat_id, 'mess_id' => $message_id]);
    }else if($from_id == $admin && isset($message->reply_to_message) && (mb_stripos($text, "/mute") !== false)){
        $params = explode("+", $text);
        $until_hours = (count($params) == 2) ? $params[1] : 1;
        bot('restrictChatMember', [
            'chat_id' => $chat_id,
            'user_id' => $message->reply_to_message->from->id,
            'until_date' => time() + ($until_hours * 3600),
            'permissions' => json_encode([
                'can_send_messages' => false,
                'can_send_media_messages' => false,
                'can_send_polls' => false,
                'can_send_other_messages' => false
            ])
        ]);
        delete(['chat_id' => $chat_id, 'mess_id' => $message_id]);
    }else if($from_id == $admin && (mb_stripos($text, "/stop@") !== false)){
        bot('setChatPermissions', [
            'chat_id' => $chat_id,
            'permissions' => json_encode([
                'can_send_messages' => false,
                'can_send_media_messages' => false,
                'can_send_other_messages' => false,
                'can_send_polls' => false,
                'can_add_web_page_previews' => false,
                'can_change_info' => false,
                'can_pin_messages' => false,
            ])
        ]);
        delete(['chat_id' => $chat_id, 'mess_id' => $message_id]);
    }else if($from_id == $admin && (mb_stripos($text, "/start@") !== false)){
        bot('setChatPermissions', [
            'chat_id' => $chat_id,
            'permissions' => json_encode([
                'can_send_messages' => true,
                'can_send_media_messages' => true,
                'can_send_other_messages' => true,
                'can_invite_users' => true
            ])
        ]);
        delete(['chat_id' => $chat_id, 'mess_id' => $message_id]);
    }else if((mb_stripos($text, "/game@") !== false)){
        // $dices = ['🎲','🎯','🎳','🏀','⚽','🎰'];
        bot('sendDice', [
            'chat_id' => $chat_id,
            'emoji' => $dices[rand(0, 5)]
        ]);
        delete(['chat_id' => $chat_id, 'mess_id' => $message_id]);
    };
}else if($chat_type == "private" && $chat_id != $admin){
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
                'emoji' => $dices[rand(0, 5)]
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
                'text' => "Guruhga takliflar bo'yicha sizning ballaringiz: <b>".$res."</b> 🎯.<pre>Ballarni ko'paytirish uchun bizng guruhimizga do'stlaringizni taklif qiling va sovg'alarga ega bo'ling !</pre>",
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
                'inline_keyboard' => get_fallows(['test_btn' => true])
            ])
        ]);
    }
};


if(mb_stripos($text, "/mycloud+") !== false && $from_id == $admin && $text != "/mycloud"){
    $cloud_id = explode("+", $text);
    if (count($cloud_id) >= 2 && is_numeric($cloud_id[1])) {
        $db_file = fileCloud("f", ['cloud_id' => $cloud_id[1]]);
        $caption = trim($cloud_id['2']) ?: "";
        bot($db_file['method'], [
            'chat_id' => $chat_id,
            $db_file['type'] => $db_file['file_id'],
            'parse_mode' => 'HTML',
            'caption' => $caption
        ]);
    }else {
        bot('sendmessage', [
            'chat_id' => $chat_id,
            'text' => "⚠️ Xatolik, file topilmadi !!",
            'parse_mode' => 'HTML' 
        ]);
    };
    if($chat_type != "private") {
        delete(['chat_id' => $chat_id, 'mess_id' => $message_id]);
    };
};
