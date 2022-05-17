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
$photo = $message->photo;
$audio = $message->audio;
$video = $message->video;
$sticker = $message->sticker;

if($chat_type == "private" && $chat_id == $admin){
    if($text == "/start"){
        $hi_text = "😎 Assalom alaykum <a href='https://www.youtube.com/c/infomiruz'>infomiruz Downloader boti</a>ga hush kelibsiz !!!<pre>Tizimdan foydalanish buyicha qo'llanma: <a href='https://www.youtube.com/c/infomiruz'>infomiruz Downloader bot</a>.</pre>";
        bot('sendmessage', [
            'chat_id' => $chat_id,
            'text' => $hi_text,
            'parse_mode' => 'HTML'
        ]);
    }else if($sticker or $document or $video or $audio or $photo){
        if ($document): $file_id = $document->file_id;
        elseif ($sticker): $file_id = $sticker->file_id;
        elseif ($video): $file_id = $video->file_id;
        elseif ($audio): $file_id = $audio->file_id;
        elseif ($photo): $file_id = array_pop($photo)->file_id;
        endif;
        $file = save_file($file_id);
        if ($file['local_path']){
            $reply = "<b>Fayl yuklandi</b> ✅.\nFile haqida malumot:\nFile nomi: {$file['name']}.{$file['format']}\nFile hajmi: {$file['file_size']}\nFile saqlangan: <a href='{$file['local_path']}'>Ko'rish</a>\nFile telegram: <a href='{$file['telegram_path']}'>Ko'rish</a>";
            bot('sendmessage', [
                'chat_id' => $chat_id,
                'text' => $reply,
                'parse_mode' => 'HTML',
                'reply_markup' => json_encode([
                    'inline_keyboard' => [
                        [
                            [
                                'text' => "⭕️ Ko'rish",
                                'url' => $file['local_path']
                            ]
                        ]
                    ]
                ])
            ]);
        }
    }else if($text = "/files"){
        $files = scandir("files", 1);
        $reply = "Sizda saqlangan filelar ruyxati:";
        foreach ($files as $file_name) {
            if(strlen($file_name) < 5) continue;
            $reply .= "\n<a href='{$work_folder}files/{$file_name}'>{$file_name}</a>";
        }
        bot('sendmessage', [
            'chat_id' => $chat_id,
            'text' => $reply,
            'parse_mode' => 'HTML'
        ]);
    };
};
// https://api.telegram.org/file/bot5337366257:AAGm2erpdobRgt-fbwKi5VgtHHFJT2ucVrY/music/file_19.mp3 