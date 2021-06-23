<?
function dump($what){
    echo '<pre>'; 
        print_r($what); 
    echo '</pre>';
};

function get_data($url){
    return json_decode(file_get_contents($url), true);
};

function bot($method, $datas = []){
    $url = "https://api.telegram.org/bot".API_KEY."/" . $method;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $datas);
    $res = curl_exec($ch);
    curl_close($ch);
    if (!curl_error($ch)) return json_decode($res, true);
};

function html($text){
    return str_replace(['<','>'],['&#60;','&#62;'],$text);
};

function reformat($json){
    return json_encode(json_decode($json, true), JSON_PRETTY_PRINT);
};

function user_is_followed($user_id){
    global $channels;
    $count = 0;
    $count_verf = 0;
    foreach ($channels as $channel){
        if($channel["required"] == 1){
            $count++;
            $stss = ['creator', 'administrator', 'member'];
            $res = get_data('https://api.telegram.org/bot'.API_KEY.'/getChatMember?chat_id='.$channel["chan_id"].'&user_id=' . $user_id)['result'];
            if(in_array($res['status'], $stss)){
                $count_verf++;
            };
        };
    };
    return ($count_verf == $count) ? true : false;
};

function get_chans(){
    global $channels;
    $list_channels = [];
    foreach($channels as $channel){
        $list_channels[][] = ['text' => $channel['btn_text'], 'url'=> "https://t.me/".$channel['username'].""];
    };
    array_push($list_channels, [
        [
            'text' => "Obuna bo'ldim ✅",
            'callback_data' => "followed"
        ]
    ]);
    return $list_channels;
};
if($logging){
    if(file_get_contents('php://input')){
        file_put_contents("log.json",reformat(file_get_contents('php://input')));
    };
    
};

function bot_manager(){
    if(isset($_GET['reset'])){
        $protokol = $_SERVER['REQUEST_SCHEME'];
        if($protokol != "https"){
            echo "Xatolik, So'rov HTTPS protokolida bo'lishi shart !<br> SSl sertifekat kerak domainga !";
        }else{
            echo $webhook_url = "https://api.telegram.org/bot".API_KEY."/setWebHook?url=".$protokol."://".$_SERVER['HTTP_HOST']."".$_SERVER['SCRIPT_NAME'];
            dump(json_decode(file_get_contents($webhook_url),true));
        };
    }else if(isset($_GET['info'])){
        dump(json_decode(file_get_contents("https://api.telegram.org/bot".API_KEY."/getWebhookInfo"),true));
    }else if(isset($_GET['kill'])){
        dump(json_decode(file_get_contents("https://api.telegram.org/bot".API_KEY."/deleteWebhook?drop_pending_updates=true"),true));
    }else if(isset($_GET['test'])){
        global $Manager;
        $res = bot('sendmessage', [
            'chat_id' => $Manager,
            'text' => "Test xabar !",
            'parse_mode' => 'HTML'
        ]);
        if($res["ok"]){echo "Test Xabr yuborildi";};
        dump($res);
    };
};

function test_url(){
    $res = explode("/", $_SERVER['SCRIPT_NAME']);
    $res[array_key_last($res)] = "app.php";
    $res = implode("/", $res);
    return $_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST']."".$res."?test";
};
