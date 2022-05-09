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

function custom_file($file_path){
    return new CURLFile($file_path);
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

function db_mysql($test = false){
    global $db_mysql;
    if($db_mysql['status']){
        require_once "rb.php";
        if(!R::testConnection()){
            R::setup('mysql:host='.$db_mysql["host"].';dbname='.$db_mysql["name"].'', $db_mysql["user"], $db_mysql["pass"]);
        };
        if ($test){
            echo R::testConnection() ? "Global DB Bor" : "Global DB Yuq";
            dump(R::inspect());
        };
    };
};

function bot_info($revoke = false){
    global $admin,$system_pass,$my_group,$my_channel;
    $admin_info = bot('getChat', ['chat_id' => $admin]);
    $cms_url = str_replace("app.php", "index.php", $_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST']."".$_SERVER['REQUEST_URI']);
    $hook_url = $_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST']."".$_SERVER['REQUEST_URI'];
    
    return "Tizim haqida ma'lumot:
    👨‍💻Tizim admini: <a href='tg://user?id=".$admin."'>@".$admin_info['result']['username']."</a>.
    ⚙️Bot Web CMS: <a href='".$cms_url."'>Web enterface</a>.
    🔑CMS paroli: <tg-spoiler>".$system_pass."</tg-spoiler>👁.
    📃Bot dasturi manzili:
    <code>".$hook_url."</code>";
};

function order($params = []){
    db_mysql();
    if($params['new_order']){
        $params = $params['new_order'];
        $user = R::findOne('users','user_id = ?', [$params['user']['id']]);
        if(!$user){
            $user = R::dispense('users');
            $user->userId = $params['user']['id'];
            $user->name = $params['user']['first_name'];
            $user->username = $params['user']['username'];
            $user->languageCode = $params['user']['language_code'];
            $user->sts = "consumer";
            R::store($user);
        };
        if (!$order = R::findOne('orders','user = ? and sts = 0', [$params['user']['id']])){
            $order = R::dispense('orders');
            $order->user = $params['user']['id'];
        }
        $order->products = json_encode($params['orderData']);
        $order->orderSum = $params['orderPrice'];
        $order->date = date('Y-m-d H:i:s');
        $order->sts = 0;
        R::store($order);
    }else if($params['check_order']){
        $params = $params['check_order'];
        $order_id = explode("=", $params->invoice_payload);
        $order = R::findOne('orders','id = ? and user = ? and sts = 0', [$order_id[1], $params->from->id]);
    }else if($params['succ_order']){
        $message = $params['succ_order'];
        $succ_order = $message->successful_payment;
        $order_id = explode("=", $succ_order->invoice_payload)[1];

        $order = R::findOne('orders','id = ? and user = ? and sts = 0', [$order_id, $message->from->id]);
        $order->sts = 1;
        $order->details = json_encode([
            'customer' => $message->from,
            'details' => $succ_order
        ]);
    };
    return $order['id'] ? $order : false;
};