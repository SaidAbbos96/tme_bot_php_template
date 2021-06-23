<?
header('Content-Type: application/json; charset=utf-8');
$file = "log.json";
if(file_exists($file)) {
    echo file_get_contents($file);
}else{
    echo "log file topilmadi !";
};

