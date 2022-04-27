<? 
require_once "config.php";
require_once "funcs.php";

if($monitoring["status"]){
    $h = date('H');
    if($h > $monitoring["work_start"] || $monitoring["work_end"] > $h){
        // $request = get_data($api_url."https://www.instagram.com/p/B15veOxhiH9/");
        if($monitoring["url"] == "test"){$monitoring["url"] = test_url();};
        if(file_get_contents($monitoring["url"])){
            echo $reply = "Sizning tizim php monitor yordamida tekshirildi, ✅ hammasi joyida !";
            bot('sendmessage', [
                'chat_id' => $Manager,
                'text' => $reply,
                'parse_mode' => 'HTML'
            ]);
        };
    };
};