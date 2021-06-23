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
    if (!curl_error($ch)) return json_decode($res);
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
    file_put_contents("log.json",reformat(file_get_contents('php://input')));
};

