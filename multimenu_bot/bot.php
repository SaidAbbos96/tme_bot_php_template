<?
const API_KEY = '5353968828:AAFQ6yx38-XsOfB82MVQHgXil1oucxcr66Y';

function bot($method = "getMe", $params = []){
    $url = "https://api.telegram.org/bot".API_KEY."/" . $method;
    $params['parse_mode'] = 'HTML'; 
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
$log = file_get_contents('php://input');
$update = json_decode($log);
if($update && $logging) file_put_contents("log.json", reformat($log));
// message variables
$message = $update->message;
$text = $message->text;
$chat_id = $message->chat->id;
