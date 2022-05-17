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

function save_file($file_id){
    global $work_folder;
    $result = bot('getFile', ['file_id' => $file_id]);
    if($result["ok"]){
        $file = $result["result"];
        $file = [
            "name" => $file['file_unique_id'],
            "format" => array_pop(explode(".", $file['file_path'])),
            "telegram_path" => "https://api.telegram.org/file/bot".API_KEY."/".$file['file_path'],
            "file_size" => round($file['file_size'] / 1024, 0, PHP_ROUND_HALF_UP)
        ];
        $new_path = "files/".$file['name'].".".$file['format'];
        if(copy($file['telegram_path'], $new_path)) $file['local_path'] = $work_folder."".$new_path;
        return $file;
    }else{
        return false;
    };
};