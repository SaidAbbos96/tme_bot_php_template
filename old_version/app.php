<? 
require_once "config.php";
require_once "funcs.php";

bot_manager();

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

// call back
$call = $update->callback_query;
$call_from_id = $call->from->id;
$call_id = $call->id;
$call_data = $call->data;
$call_message_id = $call->message->message_id;

if($text == "/start"){
    $hi_text = "Salom, Infomir.uz php botlar maketidasiz, bot ishlamoqda !";
    bot('sendmessage', [
        'chat_id' => $chat_id,
        'text' => $hi_text,
        'parse_mode' => 'HTML'
    ]);
};