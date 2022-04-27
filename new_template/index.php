<?
require_once "config.php";
require_once "funcs.php";
if(isset($_POST['login_btn']) && $_POST['password']){
    if(trim($_POST['password']) == $system_pass){
        $_SESSION['pass'] = $system_pass;
    }else{
        $error = "Xatolik, parol xato kiritilgan !";
    };
};
?>
<!DOCTYPE html>
<html lang="uz">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="icon.png" type="image/png">
    <title>Infomir.uz BotCms - Botlarni boshqarish tizimi.</title>
    <!-- bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <!-- fontawesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v6.1.1/css/all.css">
    <script defer src="https://use.fontawesome.com/releases/v6.1.1/js/all.js"></script>
    <!-- fontawesome -->
</head>

<body>
    <style>
        .login-form {
            margin: 120px 0;
            padding: 40px 50px;
            border-radius: 8px;
            background: cornsilk;
        }
        .footer {
            text-align: end;
            padding: 20px;
        }

        .form-group {
            padding-bottom: 30px;
        }

        h3.title {
            font-size: larger;
        }

        .errors {
            color: red;
            text-align: center;
        }

        .container-fluid {
            min-height: 90vh;
        }

        p.description {
            background: bisque;
            padding: 10px;
        }

        p.attention-text {
            font-size: small;
            text-align: center;
        }

        .custom-menu a {
            text-decoration: none;
            background: bisque;
            border-radius: 10px;
            padding: 0 5px;
            color: black;
        }

        .col-12.align-middle {
            box-shadow: 0 0 20px 0px grey;
            margin: 30px auto;
            padding: 30px 20px 20px;
            border-radius: 10px;
        }

        pre {
            font-size: 12px;
            border: 1px solid;
            padding: 5px;
        }
        a.attention-text {
            text-decoration: none;
            font-size: small;
        }
        span.small {
            background: antiquewhite;
            padding: 0 7px;
            border-radius: 10px;
            font-size: small;
        }
    </style>
    <div class="container">
        <div class="row justify-content-center">
            <?if(!$_SESSION['pass'] || $_SESSION['pass'] != $system_pass){?>
            <div class="col-md-8 col-lg-5 login-form align-middle">
                <h3 class="title text-center">Infomir.uz BotCms - Botlarni boshqarish tizimi.</h3>
                <p class="errors">
                    <? if($error) echo $error;?>
                </p>
                <form method="POST">
                    <div class="form-group">
                        <label for="password">Parol: <span style="color:red;">*</span></label>
                        <input type="password" class="form-control" id="password" name="password" required
                            placeholder="Parolni kiriting:">
                    </div>
                    <div class="form-group">
                        <button type="submit" name="login_btn" class="btn btn-primary form-control">Kirish</button>
                    </div>
                    <p class="attention-text">
                        Diqqat, agarda nima qilayotganingizni bilmasangiz tizimdan foydalanish qo'llanmasini ko'rib
                        chiqing ! <br>
                        <a href="https://www.youtube.com/c/infomiruz/videos">Qo'llanmani ko'rish.</a>
                    </p>
                </form>
            </div>
            <?}else if($_SESSION['pass'] == $system_pass){
                $app_url = str_replace("?reset", "app.php", $_SERVER['REQUEST_SCHEME']."://".$_SERVER['HTTP_HOST']."".$_SERVER['REQUEST_URI']);
                if (isset($_GET['log'])){
                    $file = "log.json";
                    $result = file_exists($file) ? file_get_contents($file) : "log file topilmadi !";
                }else if (isset($_GET['info'])){
                    $result = json(bot());
                }else if (isset($_GET['admin'])){
                    $result = json(bot('getChat', ['chat_id' => $admin]));
                }else if (isset($_GET['group_info'])){
                    $result = json(bot('getChat', ['chat_id' => $my_group]));
                }else if (isset($_GET['channel_info'])){
                    $result = json(bot('getChat', ['chat_id' => $my_channel]));
                }else if (isset($_GET['webhook_info'])){
                    $result = json(bot('getWebhookInfo'));
                }else if (isset($_GET['kill'])){
                    $result = json(bot('deleteWebhook', ['drop_pending_updates' => true]));
                }else if (isset($_GET['getUpdates'])){
                    $result = json(bot('getUpdates'));
                }else if (isset($_GET['reset'])){
                    $result = json(bot('setWebhook', [
                        'url' => $app_url,
                        "drop_pending_updates" => true,
                        "allowed_updates" => json_encode([
                            'message'
                        ])
                    ]));
                }else if (isset($_GET['setComands'])){
                    foreach ($comands as $comand) {
                        $result .= json(bot('setMyCommands', $comand));
                    }
                }else if (isset($_GET['clearComands'])){
                    foreach ($comands as $comand) {
                        $result .= json(bot('deleteMyCommands', $comand));
                    }
                };
            ?>
            <div class="col-12 align-middle">
                <h3>Bot manager menusi:</h3>
                <ul class='custom-menu'>
                    <li>
                        <a href="?log"><b>?log</b></a> - loglarni ko'rish.
                    </li>
                    <li>
                        <a href="?info"><b>?info</b></a> - Bot haqida ma'lumot olish.
                    </li>
                    <li>
                        <a href="?webhook_info"><b>?webhook_info</b></a> - Webhook haqida ma'lumot olish.
                    </li>
                    <li>
                        <a href="?kill"><b>?kill</b></a> - Webhookni bekor qilish, bot ishni to'xtatadi.
                    </li>
                    <li>
                        <a href="?reset"><b>?reset</b></a> - Botni ushbu manzilga qayta webhook qilish, manzil: <span class="small"><?=$app_url?></span>
                    </li>
                    <li>
                        <a href="?getUpdates"><b>?getUpdates</b></a> - Webhook qilishdan avval ishlatib ko'rish.
                    </li>
                    <li style="list-style-type: disclosure-open;">
                        Admin va guruh haqida malumot olish, agar config fileda kirtilgan bo'lsa !!!
                    </li>
                    <li>
                        <a href="?admin"><b>?admin</b></a> - Bot haqida ma'lumot olish.
                    </li>
                    <li>
                        <a href="?group_info"><b>?group_info</b></a> - Guruh haqida ma'lumot olish.
                    </li>
                    <li>
                        <a href="?channel_info"><b>?channel_info</b></a> - Kanal haqida ma'lumot olish.
                    </li>
                    <li>
                        <a href="?setComands"><b>?setComands</b></a> - Configda kiritilgan barcha comandlarni o'rnatadi.
                    </li>
                    <li>
                        <a href="?clearComands"><b>?clearComands</b></a> - Hamma comandlarni tozalash.
                    </li>
                </ul>
                <h5>So'rovlar natijasi (JSON):</h5>
<code>
<pre>
<?= $result ?: "Natijani ko'rish uchun kerakli tugmani bosing !"?>
</pre>
</code>
<a class = "attention-text" href="https://www.youtube.com/watch?v=AIhufPN4Zu4&list=PLmYtzpKf4ieqwj-NZNu2euI53tdz6Pd7r">Natijalarni tahlil qilish bo'yicha qo'llanma.</a>
            </div>
            <?};?>
        </div>
        <div class="footer">Maked by <a href="https://www.youtube.com/c/infomiruz">infomir.uz</a></div>
    </div>
</body>

</html>