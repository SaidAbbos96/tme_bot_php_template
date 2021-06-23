<? 
require_once "config.php";
require_once "funcs.php";

$h = date('H');
if($h > 6 || 1 > $h){
    // $request = get_data($api_url."https://www.instagram.com/p/B15veOxhiH9/");
    // dump($request);
    if($request['result']){
        echo $reply = "Sizning instagram API php monitor yordamida tekshirildi, ✅ hammasi joyida !";
        bot('sendmessage', [
            'chat_id' => $Manager,
            'text' => $reply,
            'parse_mode' => 'HTML'
        ]);
    };
};