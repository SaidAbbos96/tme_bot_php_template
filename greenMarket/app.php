<? 
require_once "config.php";
require_once "funcs.php";

$update = json_decode(file_get_contents('php://input'));

// message variables
$message = $update->message;
$text = html($message->text);
$chat_id = $message->chat->id;
$chat_type = $message->chat->type;
$from_id = $message->from->id;
$message_id = $message->message_id;
$first_name = $message->from->first_name;
$last_name = $message->from->last_name;
$full_name = html($first_name . " " . $last_name);

// reply_to_message
$reply_message = $update->reply_to_message;

// shipping_query
$shipping_query = $update->shipping_query;
$ship_query_id = $shipping_query->id;
$ship_query_from = $shipping_query->from;
$invoice_payload = $shipping_query->invoice_payload;
$shipping_address = $shipping_query->shipping_address;

// pre_checkout_query
$pre_checkout_query = $update->pre_checkout_query;
$pre_checkout_id = $pre_checkout_query->id;
// successful_payment
$successful_payment = $message->successful_payment;

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

if($chat_type == "private" && $chat_id != $admin){
    if($text == "/start"){
        $hi_text = "😎 Assalom alaykum <a href='https://www.youtube.com/c/infomiruz'>infomiruz Green Market</a>ga hush kelibsiz !!!<pre>Tizimdan foydalanish uchun / belgisi orqali buyruqlarni yuboring yoki menudan foydalaning.</pre>";
        bot('sendmessage', [
            'chat_id' => $chat_id,
            'text' => $hi_text,
            'parse_mode' => 'HTML',
            'reply_markup' => json_encode([
                'inline_keyboard' => [
                    [
                        [ 'text' => "Eco mahsulotlar", 'web_app' => ['url' => 'https://mproweb.uz/YTless/greenMarket/store/']]
                    ]
                ]
            ])
        ]);
    };
}else if($chat_type == "private" && $chat_id == $admin){
    if($text == "/start"){
        $hi_text = "😎 Salom admin, ishlayapmiz !";
        bot('sendmessage', [
            'chat_id' => $chat_id,
            'text' => $hi_text."\n\n".bot_info(),
            'parse_mode' => 'HTML',
            'reply_markup' => json_encode([
                'inline_keyboard' => [
                    [
                        [ 'text' => "Bot CMS dasturi", 'web_app' => ['url' => 'https://mproweb.uz/YTless/greenMarket/']]
                    ],
                    [
                        [ 'text' => "Bizning dukon", 'web_app' => ['url' => 'https://mproweb.uz/YTless/greenMarket/store/']]
                    ],
                ]
            ])
        ]);
    };
}else if($shipping_query){
    if ($shipping_address->country_code == "UZ") {
        bot('answerShippingQuery', [
            'shipping_query_id' => $ship_query_id,
            'ok' => true,
            'shipping_options' => json_encode([
                [
                    'id' => "simple_ship",
                    'title' => "Milliy pochta, pochta.uz",
                    'prices' => [
                       ['label' => "15-30 kunda uygacha", 'amount' => 0],
                    ]
                ],
                [
                    'id' => "pro_ship",
                    'title' => "Straus shipping",
                    'prices' => [
                       ['label' => "3-7 kun uygacha kuryer", 'amount' => 50000*100],
                    ]
                ]
            ])
        ]);
    } else {
        bot('answerShippingQuery', [
            'shipping_query_id' => $ship_query_id,
            'error_message' => "Kechirasiz, Faqat Uzbekiston respublikasiga yetkazib bera olamiz",
            'ok' => false            
        ]);
    };
}else if($pre_checkout_query){
    if (order(['check_order' => $pre_checkout_query])){
        bot('answerPreCheckoutQuery', [
            'pre_checkout_query_id' => $pre_checkout_id,
            'ok' => true
        ]);
    } else {
        bot('answerPreCheckoutQuery', [
            'pre_checkout_query_id' => $pre_checkout_id,
            'error_message' => "Xatolik, Bunday buyurtma topilmadi, iltimos dukonda mahsulotlarni qayta tekshiring !",
            'ok' => false            
        ]);
    };
};
if($successful_payment){
    if (order(['succ_order' => $message])) {
        $hi_text = "😎 To'lov tasdiqlandi, haridingiz uchun rahmat !";
        bot('sendmessage', [
            'chat_id' => $chat_id,
            'text' => $hi_text,
            'parse_mode' => 'HTML',
            'reply_markup' => json_encode([
                'inline_keyboard' => [
                    [
                        [ 'text' => "Bonusingizni olish", 'web_app' => ['url' => 'https://mproweb.uz/YTless/greenMarket/store/']]
                    ],
                ]
            ])
        ]);
    };
};
