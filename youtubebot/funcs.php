<?
function dump($what){
    echo '<pre>'; 
        print_r($what); 
    echo '</pre>';
};
function youtuber($query = "infomiruz"){
    $you_api_url = "https://www.googleapis.com/youtube/v3/search";
    $params = [
        'key' => YOUTUBE_API_KEY,
        'part' => "snippet",
        'maxResults' => 20,
        'type' => "video",
        'q' => $query,
    ];
    $request = file_get_contents($you_api_url."?".http_build_query($params));
    return $request ? json_decode($request, true) : false;  
};

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

function reformat($json){
    return json_encode(json_decode($json, true), JSON_PRETTY_PRINT);
};
function json($arr){
    return json_encode($arr, JSON_PRETTY_PRINT);
};