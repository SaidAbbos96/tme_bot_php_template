<?
function dump($what){
    echo '<pre>'; 
        print_r($what); 
    echo '</pre>';
};

function get_data($url){
    return json_decode(file_get_contents($url), true);
};
function get_data_post($url,$params){
    $myCurl = curl_init();
    curl_setopt_array($myCurl, array(
        CURLOPT_URL => $url,
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POST => true,
        CURLOPT_POSTFIELDS => http_build_query($params)
    ));
    $response = curl_exec($myCurl);
    curl_close($myCurl);
    if (!curl_error($myCurl)) return $response;
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
    return !curl_error($curl) ? json_decode($res, true) : false;
};
function html($text){
    return str_replace(['<','>'],['&#60;','&#62;'],$text);
};

function reformat($json){
    return json_encode(json_decode($json, true), JSON_PRETTY_PRINT);
};
function json($arr){
    return json_encode($arr, JSON_PRETTY_PRINT);
};

if($logging){
    if(file_get_contents('php://input')){
        file_put_contents("log.json",reformat(file_get_contents('php://input')));
    };
};

function bot_info($revoke = false){
    global $admin,$system_pass,$my_group;
    $admin_info = bot('getChat', ['chat_id' => $admin]);
    $cms_url = str_replace("app.php", "index.php", $_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST']."".$_SERVER['REQUEST_URI']);
    $hook_url = $_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST']."".$_SERVER['REQUEST_URI'];
    
    return "Bot haqida ma'lumot:
    👨‍💻Tizim admini: <a href='tg://user?id=".$admin."'>@".$admin_info['result']['username']."</a>.
    ⚙️Bot Web CMS: <a href='".$cms_url."'>Web enterface</a>.
    🔑CMS paroli: <tg-spoiler>".$system_pass."</tg-spoiler>👁.
    📃Bot dasturi manzili:
    <code>".$hook_url."</code>";
};

function delete($params = []){
    if ($params['chat_id'] && $params['mess_id']) {
        return bot('deleteMessage', [
            'chat_id' => $params['chat_id'],
            'message_id' => $params['mess_id']
        ]);
    };
};
