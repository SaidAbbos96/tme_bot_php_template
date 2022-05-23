<?
function dump($what){
    echo '<pre>'; 
        print_r($what); 
    echo '</pre>';
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

// function custom_file($file_path){
//     return new CURLFile($file_path);
// };

function html($text){
    return str_replace(['<','>'],['&#60;','&#62;'],$text);
};

function reformat($json){
    return json_encode(json_decode($json, true), JSON_PRETTY_PRINT);
};
function json($arr){
    return json_encode($arr, JSON_PRETTY_PRINT);
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

function getParams($text){
    $res = str_replace("__", "&", explode(" ", $text)[1]);
    parse_str($res, $res);
    return $res;
};

function fileCloud($params = []){
    db_mysql();
    if(isset($params['file'])){
        $file = R::dispense('apps');
        $file['file_id'] = $params['file']->file_id;
        $file['file_unique_id'] = $params['file']->file_unique_id;
        $file['file_name'] = $params['file']->file_name;
        R::store($file);
    }else if($params['find']){
        $file = R::findOne('apps','file_unique_id = ?', [$params["find"]]);
    }else if($params['find_all']){
        $file = R::findAll('apps','ORDER BY id DESC LIMIT 50');
    };
    return $file ?: [];
};
function userdb($params = []){
    global $bonus_ball;
    db_mysql();
    if($params['user_id']){
        $user = R::findOne('users','user = ?', [$params['user_id']]);
        if(!$user){
            $user = R::dispense('users');
            $user->user = $params['user_id'];
            $user->score = 5;
            $user->refer = $params['refer_id'] ?: "";
            R::store($user);
            if ($user['refer']) {
                $refer = R::findOne('users','user = ?', [$user['refer']]);
                $refer['score'] = $refer['score'] + $bonus_ball;
                R::store($refer);   
            }
            return $refer ?: false;
        }
    }else if($params['score']){
        $user = R::findOne('users','user = ?', [$params['score']]);
        return $user ?: false;
    }
 
}

// function delete($params = []){
//     if ($params['chat_id'] && $params['mess_id']) {
//         return bot('deleteMessage', [
//             'chat_id' => $params['chat_id'],
//             'message_id' => $params['mess_id']
//         ]);
//     };
// };
// function get_chans(){
//     global $channels;
//     $list_channels = [];
//     foreach($channels as $channel){
//         $list_channels[][] = ['text' => $channel['btn_text'], 'url'=> "https://t.me/".$channel['username'].""];
//     };
//     array_push($list_channels, [
//         [
//             'text' => "Obuna bo'ldim ✅",
//             'callback_data' => "followed"
//         ]
//     ]);
//     return $list_channels;
// };
// function get_data($url){
//     return json_decode(file_get_contents($url), true);
// };
// function get_data_post($url,$params){
//     $myCurl = curl_init();
//     curl_setopt_array($myCurl, array(
//         CURLOPT_URL => $url,
//         CURLOPT_RETURNTRANSFER => true,
//         CURLOPT_POST => true,
//         CURLOPT_POSTFIELDS => http_build_query($params)
//     ));
//     $response = curl_exec($myCurl);
//     curl_close($myCurl);
//     if (!curl_error($myCurl)) return $response;
// };
// function bot_info($revoke = false){
//     global $admin,$system_pass,$my_group,$my_channel;
//     $admin_info = bot('getChat', ['chat_id' => $admin]);
//     $channel = bot('getChat', ['chat_id' => $my_channel]);
//     $group = bot('getChat', ['chat_id' => $my_group]);
//     $cms_url = str_replace("app.php", "index.php", $_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST']."".$_SERVER['REQUEST_URI']);
//     $hook_url = $_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST']."".$_SERVER['REQUEST_URI'];
    
//     return "Bot haqida ma'lumot:
//     👨‍💻Tizim admini: <a href='tg://user?id=".$admin."'>@".$admin_info['result']['username']."</a>.
//     ⚙️Bot Web CMS: <a href='".$cms_url."'>Web enterface</a>.
//     🔑CMS paroli: <tg-spoiler>".$system_pass."</tg-spoiler>👁.
//     🗣Bizning kanal: @".$channel['result']['username'].".
//     👥Bizning guruh: @".$group['result']['username'].".
//     📃Bot dasturi manzili:
//     <code>".$hook_url."</code>";
// };
// function get_fallows($params = []){
//     global $fallows, $share_btn;
//     $list_channels = [];
//     foreach ($fallows as $channel) {
//         $list_channels[][] = ['text' => $channel['text_btn'], 'url'=> $channel['link']];
//     };
//     if($params['test_btn']){
//         array_push($list_channels, [
//             [
//                 'text' => "Obuna bo'ldim ✅",
//                 'callback_data' => "followed"
//             ]
//         ]);
//     }else if($params['share_btn']){
//         array_push($list_channels, [
//             [
//                 'text' => $share_btn['share_btn'],
//                 'url' => 'https://t.me/share/url?url='.$share_btn['share_link'].'&text='.$share_btn['share_text']
//             ]
//         ]);
//     };
//     return $list_channels;
// };
// function user_is_followed($user_id){
//     global $chat_id, $fallow_time;
//     $file = "datas/allow_".$chat_id."_".$user_id.".temp";
//     if(file_exists($file) && filemtime($file) >= time()-($fallow_time * 3600)){
//         return true;
//     }else{
//         global $fallows;
//         $count = 0;
//         $count_verf = 0;
//         $stss = ['creator', 'administrator', 'member'];
//         foreach ($fallows as $channel){
//             if($channel["required"]){
//                 $count++;
//                 $res = get_data('https://api.telegram.org/bot'.API_KEY.'/getChatMember?chat_id='.$channel["chat_id"].'&user_id=' . $user_id)['result'];
//                 if(in_array($res['status'], $stss)){
//                     $count_verf++;
//                 };
//             };
//         };
//         return ($count_verf == $count) ? (file_put_contents($file, 1) != false ? true : false) : false;
//     }
// };