<?
require_once "../config.php";
require_once "../funcs.php";
header("Content-Type: application/json;charset=utf-8");
file_put_contents("store_log.json", reformat(file_get_contents('php://input')));

$request = json_decode(file_get_contents('php://input'), true); 
if(isset($request['user']) && isset($request['orderPrice'])){
    $res_db = order(['new_order' => $request]);
    if ($res_db) {
        // bot('sendInvoice', [
        //     'chat_id' => $request['user']['id'],
        //     'title' => "Green Marketga to'lov",
        //     'description' => "Green Marketdan eco mahsulotlar uchun to'lov",
        //     'payload' => "pay-A3045",
        //     'provider_token' => "371317599:TEST:1652009687817",
        //     'currency' => 'UZS',
        //     'max_tip_amount' => 100000*100,
        //     'prices' => json_encode([
        //         [ 'label' => "Mahsulot 1 ", 'amount' => 12000*100],
        //         [ 'label' => "Mahsulot 2", 'amount' => 16000*100],
        //     ]),
        //     'suggested_tip_amounts' => json_encode([
        //         3000*100, 5000*100, 10000*100, 50000*100, 
        //     ]),
        //     'photo_url' => "https://mproweb.uz/YTless/greenMarket/store/img/pay.jpg",
        //     'photo_width' => 735,
        //     'photo_height' => 490,

        //     'need_name' => true,
        //     'need_phone_number' => true,
        //     'need_email' => true,
        //     'need_shipping_address' => true,
        //     'send_phone_number_to_provider' => true,
        //     'is_flexible' => true,
        //     'reply_markup' => json_encode([
        //         'inline_keyboard' => [
        //             [
        //                 [ 'text' => "🎁 Chegirma bilan olish, to'lov 25000 sum", 'pay' => true]
        //             ],
        //             [
        //                 [ 'text' => "⭕️ Bekor qilish", 'callback_data' => "pay||cancel"]
        //             ],
        //             [
        //                 [ 'text' => "♻️ Do'konga qaytish", 'web_app' => ['url' => 'https://mproweb.uz/YTless/greenMarket/store/']]
        //             ]
        //         ]
        //     ]),
        // ]);
        // Paycom uz test
        // $products = [];
        // foreach ($request['orderData'] as $product) {
        //     array_push($products,[
        //         'label' => $product['title'],
        //         'amount' => $product['price']*100
        //     ]);
        // };
        // bot('sendInvoice', [
        //     'chat_id' => $request['user']['id'],
        //     'title' => "Green Marketga to'lov",
        //     'description' => "Green Marketdan eco mahsulotlar uchun to'lov",
        //     'payload' => "order_id=".$res_db['id'],
        //     'provider_token' => "371317599:TEST:1652009687817",
        //     'currency' => 'UZS',
        //     'max_tip_amount' => 100000*100,
        //     'prices' => json_encode($products),
        //     'suggested_tip_amounts' => json_encode([
        //         3000*100, 5000*100, 10000*100, 50000*100, 
        //     ]),
        //     'photo_url' => "https://mproweb.uz/YTless/greenMarket/store/img/pay.jpg",
        //     'photo_width' => 735,
        //     'photo_height' => 490,

        //     'need_name' => true,
        //     'need_phone_number' => true,
        //     'need_email' => true,
        //     'need_shipping_address' => true,
        //     'send_phone_number_to_provider' => true,
        //     'is_flexible' => true,
        //     'reply_markup' => json_encode([
        //         'inline_keyboard' => [
        //             [
        //                 [ 'text' => "🎁 Chegirma bilan olish, to'lov ".$request['orderPrice']." ".$request['currence']."", 'pay' => true]
        //             ],
        //             [
        //                 [ 'text' => "⭕️ Bekor qilish", 'callback_data' => "pay||cancel"]
        //             ],
        //             [
        //                 [ 'text' => "♻️ Do'konga qaytish", 'web_app' => ['url' => 'https://mproweb.uz/YTless/greenMarket/store/']]
        //             ]
        //         ]
        //     ]),
        // ]);
        $kurs_rub = 140;
        $products = [];
        foreach ($request['orderData'] as $product) {
            $price = intval(round(($product['price'] * 100) / $kurs_rub));
            // $price = 35*100;
            array_push($products,[
                'label' => $product['title'],
                'amount' => $price,
            ]);
        };
        bot('sendInvoice', [
            'chat_id' => $request['user']['id'],
            'title' => "Green Marketga to'lov",
            'description' => "Green Marketdan eco mahsulotlar uchun to'lov",
            'payload' => "order_id=".$res_db['id'],
            'provider_token' => "381764678:TEST:36893",
            'currency' => 'RUB',
            'max_tip_amount' => 1000*100,
            'prices' => json_encode($products),
            'suggested_tip_amounts' => json_encode([
                30*100, 50*100, 100*100, 500*100, 
            ]),
            'photo_url' => "https://mproweb.uz/YTless/greenMarket/store/img/pay.jpg",
            'photo_width' => 735,
            'photo_height' => 490,

            'need_name' => true,
            'need_phone_number' => true,
            'need_email' => true,
            'need_shipping_address' => true,
            'send_phone_number_to_provider' => true,
            'is_flexible' => true,
            'reply_markup' => json_encode([
                'inline_keyboard' => [
                    [
                        [ 'text' => "🎁 Chegirma bilan olish, to'lov ".intVal(round($request['orderPrice'] / $kurs_rub, 0))." RUB", 'pay' => true]
                    ],
                    [
                        [ 'text' => "⭕️ Bekor qilish", 'callback_data' => "pay||cancel"]
                    ],
                    [
                        [ 'text' => "♻️ Do'konga qaytish", 'web_app' => ['url' => 'https://mproweb.uz/YTless/greenMarket/store/']]
                    ]
                ]
            ]),
        ]);
        $res = ['result' => true, 'data' => $res_db];
    }else{
        $res = ['result' => false];
    }
}else{ 
    $res = ['result' => false];
};
echo json_encode($res, JSON_PRETTY_PRINT);
?>