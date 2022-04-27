<?
// header('Content-Type: text/html; charset=utf-8');
// header('Content-Type: application/json; charset=utf-8');
date_default_timezone_set('Asia/Tashkent');

define('API_KEY','5366289252:AAF8Zjz2kaG6_bRBG7D9eNaJsc_YLWQc43U');

function dump($what){
    echo '<pre>'; 
        print_r($what); 
    echo '</pre>';
};

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
    if (!curl_error($curl)) return json_encode(json_decode($res, true), JSON_PRETTY_PRINT);
};



file_put_contents("log.json",json_encode(json_decode(file_get_contents('php://input'), true), JSON_PRETTY_PRINT));

// echo bot();
// echo bot('sendMessage', [
//     'chat_id' => 679143250,
//     'text' => "Bot ishlayapti !!!"
// ]);

// sendMessage
// markdown mode
// $mess_text = "
// *To'yintirilgan matn bold*\n
// _Yotiq yozuv italic_\n
// __Ostki chiziqli matn  underline__\n
// ~Inkor qilingan matn strikethrough~\n
// ||Yashirin matn spoiler||\n
// `Ko'chirib olish mumkin bo'lgan matn code`\n
// [Biriktirilgan havola inline link](http://www.example.com)\n
// [Tgram foydalanuchisiga havola user link](tg://user?id=679143250)\n
// ```
// Ko'rsatmalar yoki codelar uchun maxsus formatlash turidagi matn... Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s pre
// ```
// ";
// echo bot('sendMessage', [
//     'chat_id' => "679143250",
//     'text' => $mess_text,
//     'parse_mode' => "MarkdownV2"
// ]);

// HTML mode
// $mess_text = "
// <b>To'yintirilgan matn bold</b>\n
// <i>Yotiq yozuv italic</i>\n
// <u>Ostki chiziqli matn underline</u>\n
// <s>Inkor qilingan matn strikethrough</s>\n
// <tg-spoiler>Yashirin matn spoiler</tg-spoiler>\n
// <code>Ko'chirib olish mumkin bo'lgan matn code</code>\n
// <a href='http://www.example.com'>Biriktirilgan havola inline link</a>\n
// <a href='tg://user?id=5366289252'>Tgram foydalanuchisiga havola user link</a>\n
// <pre>
// Ko'rsatmalar yoki codelar uchun maxsus formatlash turidagi matn... Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s pre
// </pre>";
// echo bot('sendMessage', [
//     'chat_id' => "679143250",
//     'text' => $mess_text,
//     'parse_mode' => "HTML"
// ]);


// disable_web_page_preview
// disable_notification
// protect_content
// reply_to_message_id
// allow_sending_without_reply
// echo bot('sendMessage', [
//     'chat_id' => "679143250",
//     'text' => "https://www.youtube.com/watch?v=uaEAn5AB2Jw",
//     // 'disable_web_page_preview' => true,
//     // 'disable_notification' => true,
//     // 'protect_content' => true,
//     // 'reply_to_message_id' => 900,
//     // 'allow_sending_without_reply' => true
// ]);

// markups
// inline btns
// echo bot('sendMessage', [
//     'chat_id' => "679143250",
//     'text' => "Bu inline reply markup",
//     'disable_web_page_preview' => true,
//     'reply_markup' => json_encode([
//         'inline_keyboard' => [
//             [['text' => "textbtn1", 'callback_data' => 'btn1'],['text' => "textbtn2", 'callback_data' => 'btn2'],['text' => "textbtn3", 'callback_data' => 'btn3']],
//             [
//                 ['text' => "Saytga havola", 'url' => 'http://www.example.com'],
//             ],
//             [['text' => "👉 videoni korish 👈", 'url' => 'https://www.youtube.com/watch?v=uaEAn5AB2Jw']],
//             [['text' => "Maxmudjon 😎😎", 'url' => 'tg://user?id=5366289252']],
//             [['text' => "kanalga havola 👣", 'url' => 'https://t.me/Infomiruz']],
//             [['text' => "Share tugmasi", 'url' => 'https://t.me/share/url?url=https://www.youtube.com/watch?v=uaEAn5AB2Jw&text=Mashu+videoni+ko\'rda']],
//         ]
//     ])
// ]);

// menu markup
// echo bot('sendMessage', [
//     'chat_id' => "679143250",
//     'text' => "Bu menu markup",
//     'disable_web_page_preview' => true,
//     'reply_markup' => json_encode([
//         'resize_keyboard'=> true,
//         // 'one_time_keyboard'=> true,
//         // 'input_field_placeholder'=> "Telefon kiriting...",
//         'keyboard' => [
//             [['text' => "textbtn1 ✌️"],['text' => "textbtn2 🤟"],['text' => "textbtn3 🤘"]],
//             [['text' => "Raqamni yuborish ☎️", 'request_contact' => true]],
//             [['text' => "Manzilni yuborish 🎯", 'request_location' => true]],
//             [
//                 ['text' => "Quiz", 'request_poll' => ['type' => 'quiz']],
//                 ['text' => "Regular", 'request_poll' => ['type' => 'regular']],
//                 ['text' => "Quiz + Regular", 'request_poll' => ['type' => 'regular, quiz']],
//             ],
//         ]
//     ])
// ]);

// remove + force_reply
// echo bot('sendMessage', [
//     'chat_id' => "679143250",
//     'text' => "Karta raqamingizni kiriting",
//     'disable_web_page_preview' => true,
//     'reply_markup' => json_encode([
//         // 'remove_keyboard' => true,
//         'force_reply' => true,
//         'input_field_placeholder' => "8600 **** **** ****"
//     ])
// ]);


// // forwardMessage
// echo bot('forwardMessage', [
//     'chat_id' => "679143250",
//     'from_chat_id' => 679143250,
//     'message_id' => 731
// ]);
// // copyMessage
// echo bot('copyMessage', [
//     'chat_id' => "679143250",
//     'from_chat_id' => 679143250,
//     'message_id' => 731
// ]);


// sendPhoto
// echo bot('sendPhoto', [
//     'chat_id' => "679143250",
//     'photo' => "https://mproweb.uz/YTless/tgramApi/rasm.jpg",
//     'caption' => "Bu internetdan url bn yuborilgan rasm"
// ]);
// echo bot('sendPhoto', [
//     'chat_id' => "679143250",
//     'photo' => new CURLFile("rasm.jpg"),
//     'caption' => "local yuborilgan rasm"
// ]);
// echo bot('sendPhoto', [
//     'chat_id' => "679143250",
//     'photo' => "AgACAgQAAxkDAAIC4mJefuPfkRpMxMTaxNq6Dod7GWHnAAKgtjEbUi7wUpE5XnfCPhYTAQADAgADeAADJAQ",
//     'caption' => "telegram serveridan file id bn yuborilgan rasm"
// ]);



// sendAudio
// echo bot('sendAudio', [
//     'chat_id' => "679143250",
//     'audio' => "https://mproweb.uz/YTless/tgramApi/audio.mp3",
//     'caption' => "Bu internetdan url bn yuborilgan audio file"
// ]);
// echo bot('sendAudio', [
//     'chat_id' => "679143250",
//     'audio' => new CURLFile("audio.mp3"),
//     'caption' => "local yuborilgan audio file",
//     'performer' => "Notanish Amerikos",
//     'title' => "Mening Amerikam :)",
//     'thumb' => new CURLFile("audio_player.jpg"),
// ]);
// echo bot('sendAudio', [
//     'chat_id' => "679143250",
//     'audio' => "CQACAgQAAxkDAAIBymJdq4kDCvRIiANcVyky0O22wUdjAAJRCwACUi7wUn2yRw34Y2CnJAQ",
//     'caption' => "telegram serveridan file id bn yuborilgan audio file",
//     'performer' => "Notanish Amerikos",
//     'title' => "Mening Amerikam :)",
//     'thumb' => "AAMCBAADGQMAAgLoYl6BDtmxnIt0VTJfqd-xtMx8T6QAAnALAAJSLvhSH6xprIRjZZIBAAdtAAMkBA",
// ]);


// sendVideo
// echo bot('sendVideo', [
//     'chat_id' => "679143250",
//     'video' => "https://mproweb.uz/YTless/tgramApi/myvideo.mp4",
//     'caption' => "Bu internetdan url bn yuborilgan video file",
//     'supports_streaming'=> true
// ]);
// echo bot('sendVideo', [
//     'chat_id' => "679143250",
//     'video' => new CURLFile("myvideo.mp4"),
//     'caption' => "local yuborilgan video file",
//     'thumb' => new CURLFile("audio_player.jpg"),
//     'supports_streaming'=> true
// ]);
// echo bot('sendVideo', [
//     'chat_id' => "679143250",
//     'video' => "BAACAgQAAxkDAAIBz2JdrK3ou-nQ6WWqi5Qdcva86bVfAAJTCwACUi7wUok9Mm_o3v0YJAQ",
//     'caption' => "telegram serveridan file id bn yuborilgan video file",
//     'thumb' => "AAMCBAADGQMAAgHPYl2srei76dDpZaqLlB1y9rzptV8AAlMLAAJSLvBSiT0yb-je_RgBAAdtAAMkBA",
//      'supports_streaming'=> true
// ]);

// // sendAnimation
// echo bot('sendAnimation', [
//     'chat_id' => "679143250",
//     'animation' => "https://mproweb.uz/YTless/tgramApi/animation.mp4",
//     'caption' => "Bu internetdan url bn yuborilgan animation file",
//     'duration'=> 10
// ]);
// echo bot('sendAnimation', [
//     'chat_id' => "679143250",
//     'animation' => new CURLFile("animation.mp4"),
//     'caption' => "local yuborilgan animation file",
//     'thumb' => new CURLFile("audio_player.jpg"),
//     'duration'=> 10
// ]);
// echo bot('sendAnimation', [
//     'chat_id' => "679143250",
//     'animation' => "CgACAgQAAxkBAAIC-WJehm8SVqV6De9cxUq5N6kBAf50AAI8AgACuEKVUuYAASofde-oeyQE",
//     'caption' => "telegram serveridan file id bn yuborilgan animation file"
// ]);


// sendVoice
// echo bot('sendVoice', [
//     'chat_id' => "679143250",
//     'voice' => "https://mproweb.uz/YTless/tgramApi/voice.ogg",
//     'caption' => "Bu internetdan url bn yuborilgan voice file"
// ]);
// echo bot('sendVoice', [
//     'chat_id' => "679143250",
//     'voice' => new CURLFile("voice.ogg"),
//     'caption' => "local yuborilgan voice file"
// ]);
// echo bot('sendVoice', [
//     'chat_id' => "679143250",
//     'voice' => "AwACAgQAAxkDAAIB0mJdrhDGHY14qxs8Dixi801Wae1XAAJLAwACQHztUqexwAYzhiUIJAQ",
//     'caption' => "telegram serveridan file id bn yuborilgan voice file",
// ]);

// sendVideoNote
// echo bot('sendVideoNote', [
//     'chat_id' => "679143250",
//     'video_note' => new CURLFile("videoNote.mp4"),
//     'caption' => "local yuborilgan video_note file",
//     'thumb' => new CURLFile("face.jpg")
// ]);
// echo bot('sendVideoNote', [
//     'chat_id' => "679143250",
//     'video_note' => "DQACAgQAAxkDAAIB1GJdrs4WOzCAsL7cS4Apu2IUKS9-AAJWCwACUi7wUj3aFyG-jmcMJAQ",
//     'caption' => "telegram serveridan file id bn yuborilgan video_note file",
//     'thumb' => "AAMCBAADGQMAAgHUYl2uzhY7MICwvtxLgCm7YhQpL34AAlYLAAJSLvBSPdoXIb6OZwwBAAdtAAMkBA"
// ]);


// sendDocument
// echo bot('sendDocument', [
//     'chat_id' => "679143250",
//     'document' => "https://mproweb.uz/YTless/tgramApi/test file.pdf",
//     'caption' => "Bu internetdan url bn yuborilgan document file"
// ]);
// echo bot('sendDocument', [
//     'chat_id' => "679143250",
//     'document' => "https://mproweb.uz/YTless/tgramApi/test file.pdf",
//     'caption' => "Bu internetdan url bn yuborilgan document file unknown format",
//     'disable_content_type_detection' => true
// ]);
// echo bot('sendDocument', [
//     'chat_id' => "679143250",
//     'document' => new CURLFile("test arxiv.rar"),
//     'caption' => "local yuborilgan document file",
//     'thumb' => new CURLFile("file.jpg"),
// ]);
// echo bot('sendDocument', [
//     'chat_id' => "679143250",
//     'document' => "BQACAgQAAxkDAAIB12JdsBasedZyRPutkU0KRhNsNwMsAAJXCwACUi7wUjgYWm_yyRf7JAQ",
//     'caption' => "telegram serveridan file id bn yuborilgan document file",
//     'thumb' => "AAMCBAADGQMAAgHXYl2wFqx51nJE-62RTQpGE2w3AywAAlcLAAJSLvBSOBhab_LJF_sBAAdtAAMkBA"
// ]);

// sendMediaGroup
// audio
// echo bot('sendMediaGroup', [
//     'chat_id' => "679143250",
//     'media' => json_encode(
//         [
//             [
//                 'type' => 'audio',
//                 'caption' => 'Bu internetdan url bn yuborilgan audio file',
//                 'media' => "https://mproweb.uz/YTless/tgramApi/audio.mp3",
//                 'thumb' => "AAMCBAADGQMAAgHKYl2riQMK9EiIA1xXKTLQ7bbBR2MAAlELAAJSLvBSfbJHDfhjYKcBAAdtAAMkBA"
//             ],
//             [
//                 'type' => 'audio',
//                 'caption' => 'telegram serveridan file id bn yuborilgan audio file',
//                 'media' => "CQACAgQAAxkDAAIB4WJdsd6OgKv0nqy7DiP82mZT94TgAAKLAwACj1zsUqvnaNy05FsbJAQ"
//             ]
//         ]
//     )
// ]);

// video + photo
// echo bot('sendMediaGroup', [
//     'chat_id' => "679143250",
//     'media' => json_encode(
//         [
//             [
//                 'type' => 'photo',
//                 'caption' => 'Bu internetdan url bn yuborilgan rasm',
//                 'media' => "https://mproweb.uz/YTless/tgramApi/rasm.jpg"
//             ],
//             [
//                 'type' => 'photo',
//                 'caption' => 'telegram serveridan file id bn yuborilgan rasm',
//                 'media' => "AgACAgQAAxkDAAIByGJdqFVM8bHhh73o7hizKyUAAcVbcwACoLYxG1Iu8FKROV53wj4WEwEAAwIAA3gAAyQE"
//             ],
//             [
//                 'type' => 'photo',
//                 'caption' => 'Bu internetdan url bn yuborilgan rasm fly.jpg',
//                 'media' => "https://mproweb.uz/YTless/tgramApi/fly.jpg"
//             ],
//             [
//                 'type' => 'photo',
//                 'caption' => 'telegram serveridan file id bn yuborilgan rasm fly.jpg',
//                 'media' => "AgACAgQAAxkBAAIB9WJdtDDRqbk_l4UmfBTFwp8yGDfJAAIttzEbUi7wUkHppz8z1ushAQADAgADeQADJAQ"
//             ],
//             [
//                 'type' => 'video',
//                 'caption' => 'Bu internetdan url bn yuborilgan video',
//                 'media' => "https://mproweb.uz/YTless/tgramApi/myvideo.mp4",
//                 'supports_streaming' => true
//             ],
//             [
//                 'type' => 'video',
//                 'caption' => 'telegram serveridan file id bn yuborilgan video',
//                 'media' => "BAACAgQAAxkDAAIBz2JdrK3ou-nQ6WWqi5Qdcva86bVfAAJTCwACUi7wUok9Mm_o3v0YJAQ",
//                 'supports_streaming' => true
//             ]
//         ]
//     )
// ]);


// echo bot('sendMediaGroup', [
//     'chat_id' => "679143250",
//     'media' => json_encode(
//         [
//             [
//                 'type' => 'document',
//                 'caption' => 'Bu internetdan url bn yuborilgan document',
//                 'media' => "https://mproweb.uz/YTless/tgramApi/test file.pdf",
//                 'thumb' => "AAMCBAADGQMAAgHKYl2riQMK9EiIA1xXKTLQ7bbBR2MAAlELAAJSLvBSfbJHDfhjYKcBAAdtAAMkBA"
//             ],
//             [
//                 'type' => 'document',
//                 'caption' => 'telegram serveridan file id bn yuborilgan document',
//                 'media' => "BQACAgQAAxkDAAIB12JdsBasedZyRPutkU0KRhNsNwMsAAJXCwACUi7wUjgYWm_yyRf7JAQ"
//             ]
//         ]
//     )
// ]);

// sendSticker
// echo bot('sendSticker', [
//     'chat_id' => "679143250",
//     'sticker' => "CAACAgIAAxkBAAICAAFiXbbphC-tJ6Ee6zEZeJXvboBCNgACBgADwDZPE8fKovSybnB2JAQ"
// ]);
// echo bot('sendSticker', [
//     'chat_id' => "679143250",
//     'sticker' => "CAACAgIAAxkBAAIDIGJejur14WI1_uF0ZBntZSIigtlGAAIaAAPANk8TgtuwtTwGQVckBA"
// ]);


// sendlocation
// echo bot('sendLocation', [
//     'chat_id'=> 679143250,
//     'latitude' => 41.311514,
//     'longitude' => 69.2400093,
//     'horizontal_accuracy' => 50
// ]);

// sendVenue
// echo bot('sendVenue', [
//     'chat_id'=> 679143250,
//     'latitude' => 41.311514,
//     'longitude' => 69.2400093,
//     'title' => "Xalqlar do'stligi sanat saroyi",
//     'address' => "Islom Karimov st. 00 a uy"
// ]);


// // sendContact
// echo bot('sendContact', [
//     'chat_id'=> 679143250,
//     "phone_number" => "+998994460450",
//     "first_name" => "SaidAbbos",
//     "last_name" => "Khudoykulov",
//     "vcard" => "BEGIN:VCARD\nVERSION:3.0\nFN:SaidAbbos Khudoykulov\nTEL;MOBILE:+998994460450\nEND:VCARD"
// ]);

// sendPoll
// echo bot('sendPoll', [
//     'chat_id'=> 679143250,
//     "question" => "Savol regular",
//     "options" => json_encode([
//         "javob0",
//         "javob1+",
//         "javob2",
//         "javob3",
//     ])
// ]);
// echo bot('sendPoll', [
//     'chat_id'=> 679143250,
//     "question" => "Savol regular multiply",
//     "options" => json_encode([
//         "javob0",
//         "javob1+",
//         "javob2",
//         "javob3",
//     ]),
//     'allows_multiple_answers' => true,
//     'is_anonymous' => false,
// ]);
// echo bot('sendPoll', [
//     'chat_id'=> 679143250,
//     "question" => "Savol regular",
//     "options" => json_encode([
//         "javob0",
//         "javob1+",
//         "javob2",
//         "javob3",
//     ]),
//     'is_anonymous' => false,
//     'open_period' => 300,
//     'correct_option_id' => 1,
// ]);

// echo bot('sendPoll', [
//     'chat_id'=> 679143250,
//     "question" => "Savol quiz",
//     "options" => json_encode([
//         "javob0",
//         "javob1+",
//         "javob2",
//         "javob3",
//     ]),
//     'is_anonymous' => true,
//     'type' => "quiz",
//     'explanation' => "O'ylab kor, osonku",
//     'correct_option_id' => 1,
//     'close_date' => time() + 550
// ]);
// echo bot('sendPoll', [
//     'chat_id'=> 679143250,
//     "question" => "Savol quiz",
//     "options" => json_encode([
//         "javob0",
//         "javob1+",
//         "javob2",
//         "javob3",
//     ]),
//     'is_anonymous' => true,
//     'type' => "quiz",
//     'explanation' => "O'ylab kor, osonku",
//     'correct_option_id' => 1,
//     'close_date' => time() + 10
// ]);


// sendDice
// // score 1-6
// echo bot('sendDice', [
//     'chat_id' => "679143250",
//     'emoji' => '🎲'
// ]);
// echo bot('sendDice', [
//     'chat_id' => "679143250",
//     'emoji' => '🎯'
// ]);
// echo bot('sendDice', [
//     'chat_id' => "679143250",
//     'emoji' => '🎳'
// ]);
// score 1-5
// echo bot('sendDice', [
//     'chat_id' => "679143250",
//     'emoji' => '🏀'
// ]);
// echo bot('sendDice', [
//     'chat_id' => "679143250",
//     'emoji' => '⚽'
// ]);
// score 1- 64
// echo bot('sendDice', [
//     'chat_id' => "679143250",
//     'emoji' => '🎰'
// ]);

// sendChatAction
// echo bot('sendChatAction', [
//     'chat_id' => "679143250",
//     'action' => 'typing'
// ]);
// echo bot('sendChatAction', [
//     'chat_id' => "679143250",
//     'action' => 'record_video'
// ]);
// echo bot('sendChatAction', [
//     'chat_id' => "679143250",
//     'action' => 'upload_video'
// ]);
// echo bot('sendChatAction', [
//     'chat_id' => "679143250",
//     'action' => 'record_voice'
// ]);
// echo bot('sendChatAction', [
//     'chat_id' => "679143250",
//     'action' => 'upload_voice'
// ]);
// echo bot('sendChatAction', [
//     'chat_id' => "679143250",
//     'action' => 'upload_document'
// ]);
// echo bot('sendChatAction', [
//     'chat_id' => "679143250",
//     'action' => 'choose_sticker'
// ]);
// echo bot('sendChatAction', [
//     'chat_id' => "679143250",
//     'action' => 'find_location'
// ]);
// echo bot('sendChatAction', [
//     'chat_id' => "679143250",
//     'action' => 'record_video_note'
// ]);
// echo bot('sendChatAction', [
//     'chat_id' => "679143250",
//     'action' => 'upload_video_note'
// ]);





// echo bot('sendMessage', [
//     'chat_id' => 679143250,
//     'text' => "Bot ishlayapti (test) !!!"
// ]);

// setMyCommands
// echo bot('setMyCommands', [
//     'commands' => json_encode([
//         ["command" => "/start", "description" => "Start bot"],
//         ["command" => "/info", "description" => "Bot haqida"],
//         ["command" => "/buy", "description" => "Buyurtma berish"]
//     ])
// ]);

// echo bot('setMyCommands', [
//     'commands' => json_encode([
//         ["command" => "/start", "description" => "Старт бота"],
//         ["command" => "/info", "description" => "Информация о системе"],
//         ["command" => "/buy", "description" => "Заказать новый товар"]
//     ]),
//     'language_code' => "ru"
// ]);

// echo bot('setMyCommands', [
//     'commands' => json_encode([
//         ["command" => "/start", "description" => "Start bot"],
//         ["command" => "/info", "description" => "About us"],
//         ["command" => "/buy", "description" => "Buy new pruduct"]
//     ]),
//     'language_code' => "en",
//     // 'scope' => json_encode([
//     //     'type' => "all_private_chats"
//     // ])
// ]);
// echo bot('getMyCommands');
// echo bot('getMyCommands', [
//     // 'scope' => json_encode([
//     //     'type' => "all_private_chats"
//     // ]),
//     // 'language_code' => 'ru',
//     // 'language_code' => 'en',
// ]);
// echo bot('deleteMyCommands', [
//     // 'scope' => json_encode([
//     //     'type' => "all_private_chats"
//     // ]),
//     // 'language_code' => 'ru',
//     // 'language_code' => 'en',
// ]);

// setChatMenuButton
// echo bot('setChatMenuButton', [
//     'chat_id' => "679143250",
//     'menu_button' => json_encode([
//         // 'type' => "defult",
//         'type' => "commands",
//     ])
// ]);
// echo bot('getChatMenuButton', [
//     'chat_id' => "679143250"
// ]);


// // // freind user
// echo bot('getChat', [
//     'chat_id' => 679143250
// ]);
// // aliense user
// echo bot('getChat', [
//     'chat_id' => 713516566
// ]);
// // // bot 
// echo bot('getChat', [
//     'chat_id' => 5366289252
// ]);
// // joined channel
// echo bot('getChat', [
//     'chat_id' => "-1001624814365"
// ]);
// // joined group
// echo bot('getChat', [
//     'chat_id' => "-1001552299980"
// ]);
// // joined supergroup
// echo bot('getChat', [
//     'chat_id' => "-1001797419694"
// ]);
// // aliense channel
// echo bot('getChat', [
//     'chat_id' => "-1001090616869"
// ]);


// aliense user
// echo bot('getUserProfilePhotos', [
//     'user_id' => 679143250,
//     // 'offset' => 1,
//     'limit' => 1,
// ]);
// bot 
// echo bot('getUserProfilePhotos', [
//     'user_id' => 5366289252
// ]);

// echo bot('sendPhoto', [
//     'chat_id' => "679143250",
//     'photo' => "AgACAgQAAxUAAWJg6PorZUKSO6ql_3S_AsT1j7t9AAKxpzEbUud6KAI-CuQsoV2jAQADAgADYwADJAQ",
// ]);

// // adminlikdagi kanal
// echo bot('getChatAdministrators', [
//     'chat_id' => -1001624814365
// ]);
// // adminlikdagi guruh
// echo bot('getChatAdministrators', [
//     'chat_id' => -1001797419694
// ]);
// // begona kanal
// echo bot('getChatAdministrators', [
//     'chat_id' => "-1001090616869"
// ]);
// // begona huruh
// echo bot('getChatAdministrators', [
//     'chat_id' => "-1001266628952"
// ]);


// // adminlikdagi kanal
// echo bot('getChatMember', [
//     'chat_id' => -1001624814365,
//      'user_id' => 713516566,
// ]);
// // adminlikdagi guruh
// echo bot('getChatMember', [
//     'chat_id' => -1001797419694,
//      'user_id' => 713516566,
// ]);
// // adminlikdagi guruh oddiy user
// echo bot('getChatMember', [
//     'chat_id' => -1001797419694,
//      'user_id' => 679143250,
// ]);
// // begona kanal
// echo bot('getChatMember', [
//     'chat_id' => "-1001090616869",
//      'user_id' => 679143250,
// ]);
// begona huruh
// echo bot('getChatMember', [
//     'chat_id' => "-1001797419694",
//      'user_id' => 679143250,
// ]);

// // adminlikdagi kanal
// echo bot('getChatMemberCount', [
//     'chat_id' => -1001624814365
// ]);
// // adminlikdagi guruh
// echo bot('getChatMemberCount', [
//     'chat_id' => -1001797419694
// ]);
// // adminlikdagi guruh oddiy user
// echo bot('getChatMemberCount', [
//     'chat_id' => -1001797419694
// ]);
// // begona kanal
// echo bot('getChatMemberCount', [
//     'chat_id' => "-1001090616869"
// ]);
// // begona huruh
// echo bot('getChatMemberCount', [
//     'chat_id' => "-1001266628952"
// ]);

// setChatPhoto
// adminlikdagi kanal
// echo bot('setChatPhoto', [
//     'chat_id' => -1001624814365,
//     'photo' => new CURLFile("chat.png")
// ]);
// // adminlikdagi guruh
// echo bot('setChatPhoto', [
//     'chat_id' => -1001797419694,
//     'photo' => new CURLFile("chat.png")
// ]);

// deleteChatPhoto
// // adminlikdagi kanal
// echo bot('deleteChatPhoto', [
//     'chat_id' => -1001624814365
// ]);
// // adminlikdagi guruh
// echo bot('deleteChatPhoto', [
//     'chat_id' => -1001797419694
// ]);

// setChatTitle
// adminlikdagi kanal
// echo bot('setChatTitle', [
//     'chat_id' => -1001624814365,
//     'title' => "Bu kanal title"
// ]);
// // // adminlikdagi guruh
// echo bot('setChatTitle', [
//     'chat_id' => -1001797419694,
//     'title' => "Bu guruh title"
// ]);

// setChatDescription
// adminlikdagi kanal
// echo bot('setChatDescription', [
//     'chat_id' => -1001624814365,
//     'description' => "Bu kanal deskription",
// ]);
// // adminlikdagi guruh
// echo bot('setChatDescription', [
//     'chat_id' => -1001797419694,
//     'description' => "Bu guruh deskription",
// ]);

// pinChatMessage
// adminlikdagi kanal
// echo bot('pinChatMessage', [
//     'chat_id' => -1001624814365,
//     'message_id' => 28,
// ]);
// // adminlikdagi guruh
// echo bot('pinChatMessage', [
//     'chat_id' => -1001797419694,
//     'message_id' => 31,
// ]);

// unpinAllChatMessages
// adminlikdagi kanal
// echo bot('unpinAllChatMessages', [
//     'chat_id' => -1001624814365
// ]);
// // adminlikdagi guruh
// echo bot('unpinAllChatMessages', [
//     'chat_id' => -1001797419694
// ]);

// leaveChat
// adminlikdagi kanal
// echo bot('leaveChat', [
//     'chat_id' => -1001624814365
// ]);
// // adminlikdagi guruh
// echo bot('leaveChat', [
//     'chat_id' => -1001797419694
// ]);


// banChatMember...