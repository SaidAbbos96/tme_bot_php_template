<?
header('Content-Type: text/html; charset=utf-8');
date_default_timezone_set('Asia/Tashkent');

define('API_KEY','Token');
// admin akkounti id raqamini ushbu bot orqali bilishingiz mumkin @infomiruz_idbot
$Manager = "admin id";
$company_name = "bot yoki tizim nomi";
$logging = true; 
$local_db_sqlite = [
    "status" => true
];
// monitoring
$monitoring = [
    "status" => true,
    "work_start" => 6,
    "work_end" => 1,
    "url" => "test",
];

