<?php
include("../bot.php");
$MerchantID = 'مریچنت';//مریچنت زرین پال را اینجا وارد کنید
$Amount = 5000;
$Authority = $_GET['Authority'];
$user = $_GET['id'];
if ($_GET['Status'] == 'OK'){
$client = new SoapClient('https://www.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);
$result = $client->PaymentVerification(
[
'MerchantID' => $MerchantID,
'Authority' => $Authority,
'Amount' => $Amount,

]
);

if ($result->Status == 100){
echo file_get_contents("payComplete30.html");
        botevoobot('sendmessage',[
	'chat_id'=>$Dev[0],
	'text'=>"#پرداخت موفق ✅	
🎉 میزارن شارژ خریداری شد : 30 روز
💰 مقدار خرید : $Amount تومان
📌 توسط : [$user](tg://user?id=$user)
",
'parse_mode'=>'Markdown',
            ]);
    botevoobot('sendmessage',[
	'chat_id'=>$user,
	'text'=>"#پرداخت موفق ✅	
💰 مقدار خرید : $Amount تومان
❤️ از خرید شما متشکریم

ℹ️اگر ایدی گروه خود را نمیدانید من را به گروهتان دعوت کنید
📌 لطفا ایدی گروه خود را ارسال کنید 
🔆 مثال :
-1001073263482
",
'parse_mode'=>'Markdown',
            ]);
            file_put_contents("../data/$user.txt","true");
} else {
       echo file_get_contents("paysend.html");
}
}
else{
     echo file_get_contents("payment.html");
}
?>
