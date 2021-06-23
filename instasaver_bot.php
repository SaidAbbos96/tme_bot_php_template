<? 
require_once "config.php";
require_once "funcs.php";

if(isset($_GET['reset'])){
    $protokol = $_SERVER['REQUEST_SCHEME'];
    if($protokol != "https"){
        echo "Xatolik, So'rov HTTPS protokolida bo'lishi shart !<br> SSl sertifekat kerak domainga !";
    }else{
        echo $webhook_url = "https://api.telegram.org/bot".API_KEY."/setWebHook?url=".$protokol."://".$_SERVER['HTTP_HOST']."".$_SERVER['SCRIPT_NAME'];
    };
    dump(reformat(file_get_contents($webhook_url)));
};

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