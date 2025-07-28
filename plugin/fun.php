<?php
// fun and for all
// time
if($textmassage=="/time" or $textmassage=="ساعت" or $textmassage=="time"){
date_default_timezone_set(‘Asia/Tehran’);
$timestamp = time();
$date_time = date('H:i:s', $timestamp);
$datet = date('d-m-Y', $timestamp);
$result = json_decode($get, true);
botevoobot('Sendmessage',[
'chat_id'=>$chat_id,
'reply_to_message_id'=>$message_id,
'text'=>"🔻تاریخ و ساعت امروز عبارت اند از🔻:

» ساعت : $date_time
» تاریخ : $datet",
]);
}

//font
if(strpos($textmassage , "/font ") !== false or strpos($textmassage , "فونت ") !== false){

    if ( $status != 'creator' && $status != 'administrator' ){
$lockcmd = $settings["lock"]["cmd"];
if ($lockcmd == "| غیر فعال | ❌") {
if ($tc == 'group' | $tc == 'supergroup'){
     
      $matntrtoen1 =str_replace(['/font ','ساخت فونت '],'',$textmassage);
     
      $matntrtoen2 =str_replace(' ','+',$matntrtoen1);
   $fonts=   file_get_contents("http://api.eliyateam.ir/font.php?output=txt&text=$matntrtoen2");
   
            botevoobot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"اینم فونت های شما:
$fonts
",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
}  
}
}
else

{
      
           
      $matntrtoen1 =str_replace(['/font ','فونت '],'',$textmassage);
     
      $matntrtoen2 =str_replace(' ','+',$matntrtoen1);
      
   $fonts=   file_get_contents("http://api.eliyateam.ir/font.php?output=txt&text=$matntrtoen2");
            botevoobot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"اینم فونت های شما:
$fonts
",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);

}
}


// Fall
elseif($textmassage=="فال حافظ"){
 $pic = "http://www.beytoote.com/images/Hafez/".rand(1,149).".gif";    
 botevoobot('sendphoto',[
  'chat_id'=>$chat_id,
'photo'=>$pic,
  'caption'=>"■ با ذکر صلوات و فاحته ای جهت شادی روح 'حافظ شیرازی' فال تان را بخوانید .",
]);
}
////////////////////////////////////////////////////
elseif($textmassage=="ارز دیجیتال" or $textmassage=="arz" or $textmassage=="/arz" or $textmassage=="ارز"){
$datenow =date('d-m-Y');
$timestamp = time();
$date_time = date('H:i:s', $timestamp);
            botevoobot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"♻️ قیمت ارزهای شاخص دیجیتال در تاریخ $datenow / ساعت $date_time :

⚠️ قیمت ها لحظه ای به روز می شود.",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$arzdigitalk,
 ]);
}
///////////////////////////////////////////////////
elseif($textmassage=="پروکسی" or $textmassage=="proxy" or $textmassage=="/proxy"){
$get = file_get_contents("https://free-proxy-list.net/anonymous-proxy.html");
preg_match_all('#<td>([0-9.]+)</td>#i', $get, $Ice);
for ($i = 0 ; $i <= count($Ice[1]) ; $i += 2){
    $d = [ 'ip' => $Ice[1][$i] ,
    'port' => $Ice[1][$i+1] ,
    'proxy' => $Ice[1][$i].':'.$Ice[1][$i+1] ];
    $arr[]=$d;
 $result = $result.$arr[$d]."\n";
}
     
            botevoobot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"$result",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
}
///////////////////////////////////////////////////
elseif($textmassage=="/id" or $textmassage=="ایدی" or $textmassage=="id"){
if ( $status != 'creator' && $status != 'administrator' && !in_array($from_id,$Dev) ){
$lockcmd = $settings["lock"]["cmd"];
if ($lockcmd == "| غیر فعال | ❌") {
$getuserprofile = getUserProfilePhotos($token,$from_id);
$cuphoto = $getuserprofile->total_count;
$getuserphoto = $getuserprofile->photos[0][0]->file_id;
if ($getuserphoto != false) {
  botevoobot('sendphoto',[
  'chat_id'=>$chat_id,
'photo'=>$getuserphoto,
  'caption'=>"
• Chatid: [$chat_id]
• Name: [$first_name]
• Id: [$from_id]
• Username: [ @$username ]",
'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
   ]);
   }
else
{
	botevoobot('sendphoto',[
  'chat_id'=>$chat_id,
'photo'=>new CURLFile("other/nophoto.png"),
  'caption'=>"
• Chatid: [$chat_id]
• Name: [$first_name]
• Id: [$from_id]
• Username: [ @$username ]",
'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
   ]);
   }
}
}
else
{
$getuserprofile = getUserProfilePhotos($token,$from_id);
$cuphoto = $getuserprofile->total_count;
$getuserphoto = $getuserprofile->photos[0][0]->file_id;
  botevoobot('sendphoto',[
  'chat_id'=>$chat_id,
'photo'=>$getuserphoto,
  'caption'=>"
• Chatid: [$chat_id]
• Name: [$first_name]
• Id: [$from_id]
• Username: [ @$username ]",
'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
   ]);
}
}
// getpro
elseif(strpos($textmassage ,"/getpro ") !== false or strpos($textmassage ,"عکس پروفایل ") !== false) {
if ( $status != 'creator' && $status != 'administrator' && !in_array($from_id,$Dev) ){
$lockcmd = $settings["lock"]["cmd"];
if ($lockcmd == "| غیر فعال | ❌") {
$text = str_replace(['/getpro ','عکس پروفایل '],'',$textmassage);
$getuserprofile = getUserProfilePhotos($token,$from_id);
$cuphoto = $getuserprofile->total_count;
$getuserphoto = $getuserprofile->photos[$text - 1][0]->file_id;
if ($getuserphoto != false) {
  botevoobot('sendphoto',[
  'chat_id'=>$chat_id,
'photo'=>$getuserphoto,
  'caption'=>"🔹ایدی : [$from_id]
🔸یوزرنیم : [ @$username ]
🖼 تعداد عکس پروفایل : [$cuphoto]
🌠شماره عکس پروفایل : [$text]",
'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
   ]);
   }
else
{
	botevoobot('sendphoto',[
  'chat_id'=>$chat_id,
'photo'=>new CURLFile("other/nophoto.png"),
  'caption'=>"
• Chatid [$chat_id]
• Name: [$re_name]
• Id : [$re_id]
• Username [ @$re_user ]
  ",
'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
   ]);
   }
}
}
else
{
$text = str_replace(['/getpro ','عکس پروفایل '],'',$textmassage);
$getuserprofile = getUserProfilePhotos($token,$from_id);
$cuphoto = $getuserprofile->total_count;
$getuserphoto = $getuserprofile->photos[$text - 1][0]->file_id;
  botevoobot('sendphoto',[
  'chat_id'=>$chat_id,
'photo'=>$getuserphoto,
  'caption'=>"🔹ایدی : [$from_id]
🔸یوزرنیم : [ @$username ]
🖼 تعداد عکس پروفایل : [$cuphoto]
🌠شماره عکس پروفایل : [$text]",
'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
   ]);
}
}
// me
elseif($textmassage=="/me"  or $textmassage=="من"  or $textmassage=="me"){
if ( $status != 'creator' && $status != 'administrator' && !in_array($from_id,$Dev) ){
$lockcmd = $settings["lock"]["cmd"];
if ($lockcmd == "| غیر فعال | ❌") {
$getuserprofile = getUserProfilePhotos($token,$from_id);
$cuphoto = $getuserprofile->total_count;
if (in_array($from_id,$Dev)) {
	botevoobot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"
Your information :
➖➖➖➖
• Name : [$first_name]
• id : [$from_id]
• Username [@$username]
• Profile count : [$cuphoto]
• Total number of messages: [$tedadmsg]
➖➖➖
🚩 Your Position: Admin Botevoo
",
'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
   ]);
   }  
else
{
if ( $status == 'creator' or $status == 'administrator') {
		botevoobot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"
Your information :
➖➖➖➖
• Name : [$first_name]
• id : [$from_id]
• Username [@$username]
• Profile count : [$cuphoto]
• Total number of messages: [$tedadmsg]
➖➖➖
🚩 Your position: Admin group ",
'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
   ]);
}
else
{
		botevoobot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"
Your information :
➖➖➖➖
• Name : [$first_name]
• id : [$from_id]
• Username [@$username]
• Profile count : [$cuphoto]
• Total number of messages: [$tedadmsg]
➖➖➖
🚩 Your position: Regular member",
'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
   ]);
   }
}
}
}
else
{
$getuserprofile = getUserProfilePhotos($token,$from_id);
$cuphoto = $getuserprofile->total_count;
		botevoobot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"
Your information :
➖➖➖➖
• Name : [$first_name]
• id : [$from_id]
• Username [@$username]
• Profile count : [$cuphoto]
• Total number of messages: [$tedadmsg]
➖➖➖
🚩 Your position: Admin group",
'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
   ]);
}
}
   // nerkh
elseif($textmassage=="/tamdid" or $textmassage=="تمدید" or $textmassage=="tamdid"){
if ( $status != 'creator' && $status != 'administrator' && !in_array($from_id,$Dev) ){
$lockcmd = $settings["lock"]["cmd"];
if ($lockcmd == "| غیر فعال | ❌") {
	botevoobot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>" ✅ برای افزایش اعتبار گروه خود بر روی دکمه زیر ضربه بزنید . 
	
        🏵 $firstname  به بخش خرید اشتراک خوش آمدید 🌹
در این قسمت با تهیه اشتراک میتوانید مدیریت گروه خود را به آنتی اسپم $botnamef بسپارید


🥇 یک ماه : 5 هزارتومان
🥇 دو ماه : 10 هزارتومان
🥇 سه ماه : 20 هزارتومان
🥇 شش ماه : 30 هزارتومان

بعد از پرداخت گروه به صورت مستقیم شارژ خواهد شد
",
'reply_to_message_id'=>$message_id,
   'reply_markup'=>json_encode([
   'inline_keyboard'=>[
	[
	['text'=>"☀یک ماهه ☀️",'url'=>"$web/pay/pay.php?&callback=$web/pay/by5000.php?gpid=$chatid&amount=5000"],['text'=>"☀دو ماهه ☀️",'url'=>"$web/pay/pay.php?&callback=$web/pay/by10000.php?gpid=$chatid&amount=10000"]],
		[
	['text'=>"☀سه ماهه ☀️",'url'=>"$web/pay/pay.php?&callback=$web/pay/by20000.php?gpid=$chatid&amount=20000"],['text'=>"☀شش ماهه ☀️",'url'=>"$web/pay/pay.php?&callback=$web/pay/by30000.php?gpid=$chatid&amount=30000"]],
	[['text'=>"🎯 درخواست شارژ",'callback_data'=>'requstcheck']],
					 [
					 ['text'=>"$nemechannel",'url'=>"https://telegram.me/$channel"],['text'=>"🔙 برگشت",'callback_data'=>'groupe']
					 ],
              ]
        ])
   ]);
   }  
}
else
{
	botevoobot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"   
✅ برای افزایش اعتبار گروه خود بر روی دکمه زیر ضربه بزنید . 

        🏵 $firstname  به بخش خرید اشتراک خوش آمدید 🌹
در این قسمت با تهیه اشتراک میتوانید مدیریت گروه خود را به آنتی اسپم $botnamef بسپارید


🥇 یک ماه : 5 هزارتومان
🥇 دو ماه : 10 هزارتومان
🥇 سه ماه : 20 هزارتومان
🥇 شش ماه : 30 هزارتومان

بعد از پرداخت گروه به صورت مستقیم شارژ خواهد شد
",
'reply_to_message_id'=>$message_id,
   'reply_markup'=>json_encode([
   'inline_keyboard'=>[
	[
	['text'=>"☀یک ماهه ☀️",'url'=>"$web/pay/pay.php?&callback=$web/pay/by5000.php?gpid=$chatid&amount=5000"],['text'=>"☀دو ماهه ☀️",'url'=>"$web/pay/pay.php?&callback=$web/pay/by10000.php?gpid=$chatid&amount=10000"]],
		[
	['text'=>"☀سه ماهه ☀️",'url'=>"$web/pay/pay.php?&callback=$web/pay/by20000.php?gpid=$chatid&amount=20000"],['text'=>"☀شش ماهه ☀️",'url'=>"$web/pay/pay.php?&callback=$web/pay/by30000.php?gpid=$chatid&amount=30000"]],
	[['text'=>"🎯 درخواست شارژ",'callback_data'=>'requstcheck']],
					 [
					 ['text'=>"$nemechannel",'url'=>"https://telegram.me/$channel"],['text'=>"🔙 برگشت",'callback_data'=>'groupe']
					 ],
              ]
        ])
   ]);
}
}
// info
elseif($textmassage=="/info" && $rt or $textmassage=="اطلاعات" && $rt or $textmassage=="info" && $rt){
if ( $status != 'creator' && $status != 'administrator' && !in_array($from_id,$Dev) ){
$lockcmd = $settings["lock"]["cmd"];
if ($lockcmd == "| غیر فعال | ❌") {
$getuserprofile = getUserProfilePhotos($token,$from_id);
$cuphoto = $getuserprofile->total_count;
	botevoobot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"
Information :
➖➖➖➖➖
• Name: [$re_name]
• Id: [$re_id]
• Username: [@$re_user]
• Profile count : [$cuphoto]
➖➖➖
• Link : [http://t.me/$re_user]",
'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
   ]);
   } 
}
else
{
$getuserprofile = getUserProfilePhotos($token,$from_id);
$cuphoto = $getuserprofile->total_count;
	botevoobot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"
Information :
➖➖➖➖➖
• Name: [$re_name]
• Id: [$re_id]
• Username: [@$re_user]
• Profile count : [$cuphoto]
➖➖➖
• Link : [http://t.me/$re_user]",
'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
   ]);
}
}
elseif($textmassage=="/info"  or $textmassage=="اطلاعات"  or $textmassage=="info" ){
if ( $status != 'creator' && $status != 'administrator' && !in_array($from_id,$Dev) ){
$lockcmd = $settings["lock"]["cmd"];
if ($lockcmd == "| غیر فعال | ❌") {
$getuserprofile = getUserProfilePhotos($token,$from_id);
$cuphoto = $getuserprofile->total_count;
	botevoobot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"
Information :
➖➖➖➖➖➖➖➖
• Chatid: [$chat_id]
• Number of messages: [$tedadmsg]
• Category:[$tc]
➖➖➖➖➖
• Name: [$first_name]
• Id: [$from_id]
• username: [@$username]
• Profile count : [$cuphoto]
➖➖➖
• Link : [http://t.me/$username]",
'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
   ]);
   } 
}   
 else
 {
$getuserprofile = getUserProfilePhotos($token,$from_id);
$cuphoto = $getuserprofile->total_count;
	botevoobot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"
Information :
➖➖➖➖➖➖➖➖
• Chatid: [$chat_id]
• Number of messages: [$tedadmsg]
• Category:[$tc]
➖➖➖➖➖
• Name: [$first_name]
• Id: [$from_id]
• username: [@$username]
• Profile count : [$cuphoto]
➖➖➖
• Link : [http://t.me/$username]",
'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
   ]);
} 
}
if(strpos($textmassage ,"/info ") !== false or strpos($textmassage ,"اطلاعات فرد ") !== false) {
if ( $status != 'creator' && $status != 'administrator' && !in_array($from_id,$Dev) ){
$lockcmd = $settings["lock"]["cmd"];
if ($lockcmd == "| غیر فعال | ❌") {
$text = str_replace(['/info ','اطلاعات فرد '],'',$textmassage);
if($text > 0){
              botevoobot('sendmessage', [
                'chat_id' => $chat_id,
             'text'=>"⭐️ پروفایل فرد : [$text](tg://user?id=$text)",
			 'parse_mode'=>"MarkDown",
'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
   ]);
   }
}
}
else
{
$text = str_replace(['/info ','اطلاعات فرد '],'',$textmassage);
              botevoobot('sendmessage', [
                'chat_id' => $chat_id,
             'text'=>"⭐️ پروفایل فرد : [$text](tg://user?id=$text)",
			 'parse_mode'=>"MarkDown",
'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
   ]);
}
}

// fun and for all
// ping
if($textmassage=="/ping" or $textmassage=="$botnamef"  or $textmassage=="ping"  or $textmassage=="$botnamef" or $textmassage=="ربات" or $textmassage=="انلاینی"){
if ( $status != 'creator' && $status != 'administrator' && !in_array($from_id,$Dev) ){
$lockcmd = $settings["lock"]["cmd"];
if ($lockcmd == "| غیر فعال | ❌") {
   botevoobot('sendmessage',[
  'chat_id'=>$chat_id,
  'text'=>"<a href='tg://user?id=$from_id'>!Online</a>",
  'parse_mode'=>"html",
		'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
        ]);
   } 
}
else
{
   botevoobot('sendmessage',[
  'chat_id'=>$chat_id,
  'text'=>"<a href='tg://user?id=$from_id'>!Online</a>",
  'parse_mode'=>"html",
		'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
        ]);	
}
}
// gif
elseif ( strpos($textmassage , '/gif ') !== false  ) {
if ( $status != 'creator' && $status != 'administrator' && !in_array($from_id,$Dev) ){
$lockcmd = $settings["lock"]["cmd"];
if ($lockcmd == "| غیر فعال | ❌") {
$text = str_replace("/gif ","",$textmassage);
$ran = rand(1,3);
if ($ran == "1") {
$info_user = file_get_contents("http://www.flamingtext.com/net-fu/image_output.cgi?_comBuyRedirect=false&script=memories-anim-logo&text=$text&symbol_tagname=popular&fontsize=70&fontname=futura_poster&fontname_tagname=cool&textBorder=15&growSize=0&antialias=on&hinting=on&justify=2&letterSpacing=0&lineSpacing=0&textSlant=0&textVerticalSlant=0&textAngle=0&textOutline=off&textOutline=false&textOutlineSize=2&textColor=%230000CC&angle=0&blueFlame=on&blueFlame=false&framerate=75&frames=5&pframes=5&oframes=4&distance=2&transparent=off&transparent=false&extAnim=gif&animLoop=on&animLoop=false&defaultFrameRate=75&doScale=off&scaleWidth=240&scaleHeight=120&&_=1469943010141");
$getchat = json_decode($info_user, true);
$gif = $getchat["src"];
 botevoobot('senddocument',[
    'chat_id'=>$chat_id,
    'document'=>"$gif",
	'caption'=>"@$usernamebot",
	'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
     ]);
}
if ($ran == "2") {
	$info_user = file_get_contents("http://www.flamingtext.com/net-fu/image_output.cgi?_comBuyRedirect=false&script=flash-anim-logo&text=$text&symbol_tagname=popular&fontsize=70&fontname=futura_poster&fontname_tagname=cool&textBorder=15&growSize=0&antialias=on&hinting=on&justify=2&letterSpacing=0&lineSpacing=0&textSlant=0&textVerticalSlant=0&textAngle=0&textOutline=off&textOutline=false&textOutlineSize=2&textColor=%230000CC&angle=0&blueFlame=on&blueFlame=false&framerate=75&frames=5&pframes=5&oframes=4&distance=2&transparent=off&transparent=false&extAnim=gif&animLoop=on&animLoop=false&defaultFrameRate=75&doScale=off&scaleWidth=240&scaleHeight=120&&_=1469943010141");
$getchat = json_decode($info_user, true);
$gif = $getchat["src"];
 botevoobot('senddocument',[
    'chat_id'=>$chat_id,
    'document'=>"$gif",
	'caption'=>"@$usernamebot",
	'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
     ]);
}
if ($ran == "3") {
		$info_user = file_get_contents("http://www.flamingtext.com/net-fu/image_output.cgi?_comBuyRedirect=false&script=alien-glow-anim-logo&text=$text&symbol_tagname=popular&fontsize=70&fontname=futura_poster&fontname_tagname=cool&textBorder=15&growSize=0&antialias=on&hinting=on&justify=2&letterSpacing=0&lineSpacing=0&textSlant=0&textVerticalSlant=0&textAngle=0&textOutline=off&textOutline=false&textOutlineSize=2&textColor=%230000CC&angle=0&blueFlame=on&blueFlame=false&framerate=75&frames=5&pframes=5&oframes=4&distance=2&transparent=off&transparent=false&extAnim=gif&animLoop=on&animLoop=false&defaultFrameRate=75&doScale=off&scaleWidth=240&scaleHeight=120&&_=1469943010141");
$getchat = json_decode($info_user, true);
$gif = $getchat["src"];
 botevoobot('senddocument',[
    'chat_id'=>$chat_id,
    'document'=>"$gif",
	'caption'=>"@$usernamebot",
	'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
     ]);
   }  
}
}
else
{
$text = str_replace("/gif ","",$textmassage);
$info_user = file_get_contents("http://www.flamingtext.com/net-fu/image_output.cgi?_comBuyRedirect=false&script=memories-anim-logo&text=$text&symbol_tagname=popular&fontsize=70&fontname=futura_poster&fontname_tagname=cool&textBorder=15&growSize=0&antialias=on&hinting=on&justify=2&letterSpacing=0&lineSpacing=0&textSlant=0&textVerticalSlant=0&textAngle=0&textOutline=off&textOutline=false&textOutlineSize=2&textColor=%230000CC&angle=0&blueFlame=on&blueFlame=false&framerate=75&frames=5&pframes=5&oframes=4&distance=2&transparent=off&transparent=false&extAnim=gif&animLoop=on&animLoop=false&defaultFrameRate=75&doScale=off&scaleWidth=240&scaleHeight=120&&_=1469943010141");
$getchat = json_decode($info_user, true);
$gif = $getchat["src"];
 botevoobot('senddocument',[
    'chat_id'=>$chat_id,
    'document'=>"$gif",
	'caption'=>"@$usernamebot",
	'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
     ]);
}
}

// Admin Karbar
if ($rt && $textmassage == "مدیریت کاربر"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev)){
if ( $statusrt != 'creator' && $statusrt != 'administrator' && !in_array($re_id,$Dev)) {
 botevoobot('sendMessage',[
    'chat_id'=>$chat_id,
    'text'=>"از منوی زیر انتخاب کن با این کاربر چکار کنیم 😃\n\n پنل مدیریت کاربر : $re_name ☀️
    ",
'reply_to_message_id'=>$message_id,
'reply_markup'=>json_encode([
    'inline_keyboard'=>[
 	[
	  ['text'=>"محدودیت کاربر",'callback_data'=>"silent|$re_id"],['text'=>"ارتقا به ادمین",'callback_data'=>"promot|$re_id"]
	  ],
	  	  	 [
	  	['text'=>"اخراج از گروه",'callback_data'=>"kick|$re_id"],['text'=>"مشخصات کاربر",'callback_data'=>"info|$re_id"]
	  	],
	  	[
	  	    	['text'=>"حذف اخطار ها",'callback_data'=>"unwarn|$re_id"],['text'=>"بخش معافیت",'callback_data'=>"unmoaf|$re_id"]
	  	],
	  	[
				 ['text'=>"$nemechannel",'url'=>"https://telegram.me/$channel"],['text'=>"✖️ خروج",'callback_data'=>'exit']
		 ],
   ]
   ])
   ]);
	}else{
	 botevoobot('sendMessage',[
    'chat_id'=>$chat_id,
    'text'=>"❌ این دستور روی مدیران قابل اجرا نیست❌ ",
    'reply_to_message_id'=>$message_id,
    ]);
	}
}
}
elseif(strpos($data,'silent|') !== false) {
 $id = str_replace("silent|","",$data);
    if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$Dev) ){        
          botevoobot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"✅ این کاربر $id در گروه محدود شد . ",
             'reply_markup'=>json_encode([
    'inline_keyboard'=>[
 	[  
 	    ['text'=>"✖️ برگشت",'callback_data'=>"back|$id"]
		 ],
   ]
   ]) 
    ]);
       botevoobot('restrictChatMember',[
   'user_id'=>$id,   
   'chat_id'=>$chatid,
   'can_post_messages'=>false,
         ]);
    }
  }
  elseif(strpos($data,'promot|') !== false) {
 $id = str_replace("promot|","",$data);
    if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$Dev) ){        
          botevoobot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"🌟 این کاربر $id به ادمین گروه ارتقا یافت .",
             'reply_markup'=>json_encode([
    'inline_keyboard'=>[
 	[  
 	    ['text'=>"✖️ برگشت",'callback_data'=>"back|$id"]
		 ],
   ]
   ])   
    ]);
    botevoobot('promoteChatMember',[
 'chat_id'=>$chatid,
  'user_id'=>$id,
  'can_change_info'=>True,
  'can_delete_messages'=>True,
  'can_invite_users'=>True,
  'can_restrict_members'=>True,
  'can_pin_messages'=>True,
  'can_promote_members'=>false
]);
    }
  }
  elseif(strpos($data,'kick|') !== false) {
 $id = str_replace("kick|","",$data);
    if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$Dev) ){        
          botevoobot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"❌ این کاربر $id از گروه اخراج شد .",
              'reply_markup'=>json_encode([
    'inline_keyboard'=>[
 	[  
 	    ['text'=>"✖️ برگشت",'callback_data'=>"back|$id"]
		 ],
   ]
   ])  
    ]);
    botevoobot('KickChatMember',[
    'chat_id'=>$chatid,
    'user_id'=>$id
	]);
    }
  }
elseif(strpos($data,'info|') !== false) { 
 $id = str_replace("info|","",$data); 
    if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$Dev) ){         
if($settings2["addlist"]["$id"]["addtext"] == false){ 
$add = "نا معلوم";     
}else{ 
$add = $settings2["addlist"]["$id"]["add"];     
}  
$stat = file_get_contents("https://api.telegram.org/bot$token/getChatMember?chat_id=$id&user_id=".$id); 
$statjson = json_decode($stat, true); 
$name = $statjson['result']['user']['first_name']; 
$username = $statjson['result']['user']['username']; 
          botevoobot('editmessagetext',[ 
                'chat_id'=>$chatid, 
     'message_id'=>$messageid, 
               'text'=>"مشخصات کاربر : \n\n نام : $name\nنام کاربری : @$username\nایدی : $id\nتعداد افرادی ک اد کرده : $add", 
               'reply_markup'=>json_encode([ 
    'inline_keyboard'=>[ 
  [   
      ['text'=>"✖️ برگشت",'callback_data'=>"back|$id"] 
   ], 
   ] 
   ])  
    ]); 
    } 
   }
     elseif(strpos($data,'back|') !== false) {
 $id = str_replace("back|","",$data);
    if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$Dev) ){        
          botevoobot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"✅ از منوی زیر انتخاب کن با این کاربر چکار کنم",
              'reply_markup'=>json_encode([
    'inline_keyboard'=>[
 	[  
	  ['text'=>"محدودیت کاربر",'callback_data'=>"silent|$id"],['text'=>"ارتقا به ادمین",'callback_data'=>"promot|$id"]
	  ],
	  	  	 [
	  	['text'=>"اخراج از گروه",'callback_data'=>"kick|$id"],['text'=>"مشخصات کاربر",'callback_data'=>"info|$id"]
	  	],
	  	[
	  	    	['text'=>"حذف اخطار ها",'callback_data'=>"unwarn|$id"],['text'=>"بخش معافیت",'callback_data'=>"unmoaf|$id"]
	  	],
	  	[
				 ['text'=>"$nemechannel",'url'=>"https://telegram.me/$channel"],['text'=>"✖️ خروج",'callback_data'=>'exit']
		 ],
   ]
   ])
    ]);
    }
  }
    elseif(strpos($data,'unwarn|') !== false) {
 $id = str_replace("unwarn|","",$data);
    if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$Dev) ){        
          botevoobot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"✅ تمامی اخطار های کاربر $id پاک شد",
              'reply_markup'=>json_encode([
    'inline_keyboard'=>[
 	[  
 	    ['text'=>"✖️ برگشت",'callback_data'=>"back|$id"]
		 ],
   ]
   ])  
    ]);
    $settings2["warnlist"]["{$id}"]=0;
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
    }
  }
      elseif(strpos($data,'unmoaf|') !== false) {
 $id = str_replace("unmoaf|","",$data);
    if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$Dev) ){        
          botevoobot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"بخش مورد نظر را انتخاب کنید 😊",
              'reply_markup'=>json_encode([
    'inline_keyboard'=>[
 	[  
 	   ['text'=>"حذف معافیت اد اجباری",'callback_data'=>"unmoaf-ad|$id"]
 	     ],
 	     [
 	['text'=>"حذف معافیت جوین اجباری",'callback_data'=>"unmoaf-ch|$id"]
 	     ],
 	     [ 
 	    ['text'=>"✖️ برگشت",'callback_data'=>"back|$id"]
		 ],
   ]
   ])  
    ]);
    }
      }
          elseif(strpos($data,'unmoaf-ad|') !== false) {
 $id = str_replace("unmoaf-ad|","",$data);
    if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$Dev) ){        
          botevoobot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"❌ کاربر $id دیگه معاف نیست",
              'reply_markup'=>json_encode([
    'inline_keyboard'=>[
 	[  
 	    ['text'=>"✖️ برگشت",'callback_data'=>"back|$id"]
		 ],
   ]
   ])  
    ]);
    $settings2["informatoin"]["moaf-ad"]["$id"]="false";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);    
    }
          }
          elseif(strpos($data,'unmoaf-ch|') !== false) {
 $id = str_replace("unmoaf-ch|","",$data);
    if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$Dev) ){        
          botevoobot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"❌ کاربر $id دیگه معاف نیست",
              'reply_markup'=>json_encode([
    'inline_keyboard'=>[
 	[  
 	    ['text'=>"✖️ برگشت",'callback_data'=>"back|$id"]
		 ],
   ]
   ])  
    ]);
    $settings2["informatoin"]["moaf-ch"]["$id"]="false";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);    
    }
          } 
          
 if($textmassage=="/help" or $textmassage=="راهنما" or $textmassage=="help"){
	 if ($tc == 'group' | $tc == 'supergroup'){  
	botevoobot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"
🚩به راهنمای ربات مدیریت گروه خوش امدید
➖➖➖➖➖➖➖➖
🔖لطفا زبان مورد نظر برای دستورات را انتخاب کنید

💥در راهنما به نکات زیر توجه کنید

🔹🔸🔹🔸🔹🔸🔹🔸🔹🔸🔹

🔹برای دستورات انگلیسی ان هارو تایپ کنید و روی ان ها کلیک نکنید!

🔸در جای که علامت های [] وجود دارد در دستورات از ان ها استفاده نکنید
➖➖➖
",
	   'reply_markup'=>json_encode([
    'inline_keyboard'=>[
 	[
	  ['text'=>"🇮🇷 فارسی",'callback_data'=>"farsi"],['text'=>"🇬🇧 انگلیسی",'callback_data'=>"english"]
	  ],
	  	  	 [
				 ['text'=>"$nemechannel",'url'=>"https://telegram.me/$channel"],['text'=>"✖️ خروج",'callback_data'=>'exit']
		 ],
   ]
   ])
   ]);
   }  
  }
   	    elseif($data=="help"){
            botevoobot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"🚩به راهنمای ربات مدیریت گروه خوش امدید
➖➖➖➖➖➖➖➖
🔖لطفا زبان مورد نظر برای دستورات را انتخاب کنید

💥در راهنما به نکات زیر توجه کنید

🔹🔸🔹🔸🔹🔸🔹🔸🔹🔸🔹

🔹برای دستورات انگلیسی ان هارو تایپ کنید و روی ان ها کلیک نکنید!

🔸در جای که علامت های [] وجود دارد در دستورات از ان ها استفاده نکنید
➖➖➖",
	   'reply_markup'=>json_encode([
    'inline_keyboard'=>[
 	[
	  ['text'=>"🇮🇷 فارسی",'callback_data'=>"farsi"],['text'=>"🇬🇧 انگلیسی",'callback_data'=>"english"]
	  ],
	  	  	 [
				 ['text'=>"$nemechannel",'url'=>"https://telegram.me/$channel"],['text'=>"✖️ خروج",'callback_data'=>'exit']
		 ],
   ]
   ])
   ]);
   } 
	    elseif($data=="english"){
            botevoobot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"به بخش دریافت دستورات انگلیسی خوش امدید❤️
➖➖➖➖➖➖➖➖
🔖لطفا بخش مورد نظر خورد را انتخاب کنید

➖➖➖➖

⚠️به نکات زیر توجه کنید :

🔹برای دیدن دستورات قفلی و مدیریتی شما باید حتما مدیر ربات باشید و کابران عادی اجازه ورود به این بخش را ندارند

💥دستورات عمومی برای همه کاربران است و همه اجازه استفاده از این دستورات را دارند

🎉دستورات صاحب ربات فقط برای سودو ربات هست و دیگر کاربران  اجازه ورود ندارند
➖➖➖",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				    	[
	  ['text'=>"🚦 عمومی",'callback_data'=>"allen"],['text'=>"🔖 مدیریتی",'callback_data'=>"manageen"]
	  ],
	  				    	[
	  ['text'=>"🔐 قفل ها",'callback_data'=>"locken"]
	  ],
					 [
					 ['text'=>"$nemechannel",'url'=>"https://telegram.me/$channel"],['text'=>"🔙 برگشت",'callback_data'=>'help']
					 ],
                     ]
               ])
           ]);
    }
		
		    elseif($data=="farsi"){
            botevoobot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"به بخش دریافت دستورات فارسی خوش امدید❤️
➖➖➖➖➖➖➖➖
🔖لطفا بخش مورد نظر خورد را انتخاب کنید

➖➖➖➖

⚠️به نکات زیر توجه کنید :

🔹برای دیدن دستورات قفلی و مدیریتی شما باید حتما مدیر ربات باشید و کابران عادی اجازه ورود به این بخش را ندارند

💥دستورات عمومی برای همه کاربران است و همه اجازه استفاده از این دستورات را دارند

🎉دستورات صاحب ربات فقط برای سودو ربات هست و دیگر کاربران  اجازه ورود ندارند
➖➖➖",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				    	[
	  ['text'=>"🚦 عمومی",'callback_data'=>"allfa"],['text'=>"🔖 مدیریتی",'callback_data'=>"managefa"]
	  ],
	  				    	[
	  ['text'=>"🔐 قفل ها",'callback_data'=>"lockfa"]
	  ],
					 [
					 ['text'=>"$nemechannel",'url'=>"https://telegram.me/$channel"],['text'=>"🔙 برگشت",'callback_data'=>'help']
					 ],
                     ]
               ])
           ]);
    }
			    elseif($data=="manageen"){
			 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$Dev)){
            botevoobot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"
📍 راهنمای دستورات مدیریتی :

/panel
💭دریافت پنل تنظیمات و پنل مدیریت گروه

/settings
💭دریافت تنظیمات گروه به صورت متنی

/promote [ریپلای]
💭ادمین کرد فرد مورد نظر

/demote [ریپلای]
💭تنزل مقام فرد مورد نظر

/admin list 
💭دریافت لیست ادمین های گروه

/pin [ریپلای]
💭سنحاق کردن پیام مورد نظر توسط ربات

/unpin 
💭برداشتن پیام از حالت سنجاق

/kick [ریپلای | ایدی]
💭اخراج فرد مورد نظر از گروه

/del [ریپلای]
💭حذف پیام مورد نظر

/rmsg [1-300]
💭پاک کردن پیام های اخیر گروه

/setname [نام]
💭تنظیم نام گروه

/setdescription [متن]
💭تنظیم اطلاعات گروه

/delphoto 
💭حذف عکس گروه

/setphoto [ریپلای]
💭تنظیم عکس گروه

/check
💭دریافت میزان شارژ گروه

/automatic
💭فعال کردن قفل ها به صورت خودکار و مدیریت خود کار گروه

/mute all
💭ساکت کردن همه گروه

/unmute all
💭غیر فعال کردن سکوت گروه

/welcome [enable |disable]
💭روشن و خاموش کردن خوش امد

/setwelcome [متن]
💭تنظیم پیام خوش امد

/silent
💭افزودن فرد به لیست سکوت گروه

/silent [دقیقه]
💭افزودن فرد به لیست سکوت گروه به صورت زمان داره

/unsilent
💭خارج کردن فرد از لیست سکوت گروه

/list silent
💭دریافت لیست سکوت گروه

/clean silentlist
💭 پاک کردن لیست سکوت گروه

/request
💭درخواست تمدید شارژ برای گروه

/filter
💭افزودن کلمه به لیست کلمات فیلترشده

/unfilter
💭حذف کلمه از لیست کلمات فیلتر شده

/filterlist
💭دریافت لیست کلمات فیلتر شد

/clean filterlist
💭پاک کردن تمام کلمات درون لیست فیلتر

/restart settings
💭ریستارت کردن تنظیمات گروه به حالت اولیه

/add [on | off]
💭روشن و خاموش کردن اد اجباری در گروه

/setadd [عدد]
💭تنظیم مقدار کاربری که یک فرد باید دعوت کند تا بتواند در گروه چت کند

/setwarn [عدد]
💭 تنظیم حداکثر اخطار برای کاربر

/warn [ریپلای]
💭اخطار دادن به کاربر مورد نظر

/unwarn [ریپلای]
💭کم کردن اخطار های کاربر مورد نظر

/warn info [ریپلای]
💭به دست اوردن تعداد اخطار های کاربر

/setrules [متن]
💭تنظیم قوانین گروه

/muteall [دقیقه]
💭سکوت همه به صورت زمان دار

/channel [on | off]
💭روشن و خاموش کردن قفل کانال

/setchannel [@یوزرنیم کانال]
💭 قفل کردن ربات روی کانال تنظیم شد

/modebot [on | off]
💭 روشن و خاموش کردن حالت سختگیرانه اضافه کردن ربات

/modewarn [on | off]
💭 روشن و خاموش کردن حالت سختگیرانه اخراج کاربر پس از رسیدن به حداکثر اخطار


➖➖➖
🔹برای دستورات انگلیسی ان هارو تایپ کنید و روی ان ها کلیک نکنید!

🔸در جای که علامت های [] وجود دارد در دستورات از ان ها استفاده نکنید

🔹میتوانید در متن خوش امد و قوانین برای گرفتن نام و ایدی فرد از موارد زیر استفاده کنید
gpname = دریافت نام گروه
username = دریافت یوزرنیم طرف

✨مثال :
/setrules hi

",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
					 [
					 ['text'=>"$nemechannel",'url'=>"https://telegram.me/$channel"],['text'=>"🔙 برگشت",'callback_data'=>'english']
					 ],
                     ]
               ])
           ]);
		   		 }else{
			botevoobot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"شما مدیر ربات نیستید ⚠️",
]);
    }
				}
				    elseif($data=="managefa"){
				 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$Dev) ){
            botevoobot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"
🔆 راهنمای دستورات مدیریتی :

✅پنل
🔆دریافت پنل تنظیمات و پنل مدیریت گروه

✅تنظیمات
🔆دریافت تنظیمات گروه به صورت متنی

✅ترفیع [ریپلای]
💭ادمین کرد فرد مورد نظر

✅تنزل [ریپلای]
🔆تنزل مقام فرد مورد نظر

✅لیست ادمین
🔆دریافت لیست ادمین های گروه

✅سنجاق [ریپلای]
🔆سنحاق کردن پیام مورد نظر توسط ربات

✅حذف سنجاق
🔆حذف سنجاق پیام سنجاق شده

✅اخراج فرد
🔆اخراج فرد مورد نظر از گروه

✅حذف [ریپلای]
🔆حذف پیام مورد نظر

✅پاک کردن [1-300]
🔆پاک کردن پیام های اخیر گروه

✅تنظیم نام [نام]
🔆تنظیم نام گروه

✅تنظیم اطلاعات [متن]
🔆تنظیم اطلاعات گروه

✅حذف عکس
🔆حذف عکس گروه

✅تنظیم عکس [ریپلای]
🔆تنظیم عکس گروه

✅میزان شارژ
🔆دریافت میزان شارژ گروه

✅اتوماتیک فعال
🔆فعال کردن قفل ها به صورت خودکار و مدیریت خود کار گروه

✅بیصدا همه
🔆ساکت کردن همه گروه

✅باصدا همه
🔆غیر فعال کردن سکوت گروه

✅خوش امد [روشن - خاموش]
🔆روشن . خاموش کردن خوش امد گویی گروه

✅تنظیم خوش امد [متن]
🔆تنظیم پیام خوش امد

✅بیصدا
🔆افزودن فرد به لیست سکوت گروه

✅بیصدا [دقیقه]
🔆 افزودن فرد به لیست سکوت گروه به صورت زمان داره

✅باصدا
🔆خارج کردن فرد از لیست سکوت گروه

✅لیست سکوت
🔆دریافت لیست سکوت گروه

✅حذف لیست سکوت
🔆 پاک کردن لیست سکوت گروه

✅درخواست شارژ
💭درخواست تمدید شارژ برای گروه

✅افزودن فیلتر [کلمه]
🔆افزودن کلمه به لیست کلمات فیلترشده

✅حذف فیلتر [کلمه]
🔆حذف کلمه از لیست کلمات فیلتر شده

✅لیست فیلتر
🔆دریافت لیست کلمات فیلتر شد

✅حذف لیست فیلتر
🔆پاک کردن تمام کلمات درون لیست فیلتر

✅ریستارت تنظیمات
🔆ریستارت کردن تنظیمات گروه به حالت اولیه

✅دعوت [روشن | خاموش]
🔆روشن و خاموش کردن اد اجباری در گروه

✅تنظیم دعوت [عدد]
🔆تنظیم مقدار کاربری که یک فرد باید دعوت کند تا بتواند در گروه چت کند

✅تنظیم اخطار [عدد]
🔆 تنظیم حداکثر اخطار برای کاربر

✅اخطار [ریپلای]
🔆 اخطار دادن به کاربر مورد نظر

✅حذف اخطار [ریپلای]
🔆 کم کردن اخطار های کاربر مورد نظر

✅اطلاعات اخطار [ریپلای]
🔆 به دست اوردن تعداد اخطار های کاربر

✅تنظیم قوانین [متن]
🔆 تنظیم قوانین گروه

✅بیصدا همه [دقیقه]
🔆سکوت همه به صورت زمان دار

✅قفل کانال [روشن | خاموش]
🔆روشن و خاموش کردن قفل کانال

✅تنظیم کانال [@یوزرنیم کانال]
🔆 قفل کردن ربات روی کانال تنظیم شد

✅سختگیرانه ربات [روشن | خاموش]
🔆 روشن و خاموش کردن حالت سختگیرانه اضافه کردن ربات

✅سختگیرانه اخطار [روشن | خاموش]
🔆 روشن و خاموش کردن حالت سختگیرانه اخراج کاربر پس از رسیدن به حداکثر اخطار

✅ مدیریت کاربر ( ریپلای )
🔆 مدیریت کردن فرد مورد نظر

✅ فان روشن / خاموش
🔆 روشن و خاموش کردن حالت صحبت کردن ربات

⚠️ ایموجی های ابتدای دستورات را وارد کنید
🔆 در جای که علامت های () وجود دارد در دستور از آن ها استفاده نکنید
🎉 میتوانید در متن خوش امد و قوانین برای گرفتن نام و ایدی فرد مورد نظر از موارد زیر استفاده کنید .
🎈gpname = دریافت نام‌ گروه
🎈username = دریافت یوزرنیم طرف

🔸 مثال دستورات :
خوش امد روشن
",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
					 [
					 ['text'=>"$nemechannel",'url'=>"https://telegram.me/$channel"],['text'=>"🔙 برگشت",'callback_data'=>'farsi']
					 ],
                     ]
               ])
           ]);
		   		 }else{
			botevoobot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"شما مدیر ربات نیستید ⚠️",
]);
    }
					}
					 elseif($data=="allen"){
            botevoobot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"
📍 راهنمای دستورات عمومی :

/rules
💭دریافت قوانین گروه

/link
💭دریافت لینک گروه

/time
💭دریافت تاریخ و ساعت

/id
💭دریافت اطلاعات خودتان

/me
💭دریافت اطلاعات شما به همراه مقام شما در ربات

/tamdid
💭شارژ مجدد ربات

/info
💭دریافت اطلاعات گروه و خودتان

/info [ریپلای| ایدی]
💭دریافت اطلاعات فرد مورد نظر

/ping
💭اطمینان حاصل کردن از انلاینی ربات

/support
💭در صورت وجود مشکل با ارسال این دستور پشتیبانی به گروه شما اعزام میشود

/report [ریپلای]
💭ارسال گزارش برای مدیر گروه

/kickme
💭اخراج شما از گروه

/getpro [عدد]
💭دریافت عکس پروفایل شما به عدد

/gif [کلمه انگلیسی]
💭تبدیل کلمه به گیف

/font 
💭زیباسازی فونت های انگلیسی

➖➖➖
🔹برای دستورات انگلیسی ان هارو تایپ کنید و روی ان ها کلیک نکنید!

🔸در جای که علامت های [] وجود دارد در دستورات از ان ها استفاده نکنید

🔅دستورات voice و bachekojai به خاطر جلوگیری از اسپم معادل فارسی ندارند

✨مثال :
/setrules hi
➖➖➖",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
					 [
					 ['text'=>"$nemechannel",'url'=>"https://telegram.me/$channel"],['text'=>"🔙 برگشت",'callback_data'=>'english']
					 ],
                     ]
               ])
           ]);
    }
						 elseif($data=="allfa"){
            botevoobot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"
🔆 راهنمای دستورات عمومی :

✅قوانین
🔆دریافت قوانین گروه

✅لینک
🔆دریافت لینک گروه

✅ساعت
🔆دریافت تاریخ و ساعت

✅ایدی
🔆دریافت اطلاعات خودتان

✅من
🔆دریافت اطلاعات شما به همراه مقام شما در ربات

✅ تمدید
🔆دریافت نرخ برای خرید ربات

✅ اطلاعات
🔆دریافت اطلاعات گروه و خودتان

✅اطلاعات فرد [ریپلای| ایدی]
🔆دریافت اطلاعات فرد مورد نظر

✅ انلاینی
🔆اطمینان حاصل کردن از انلاینی ربات


✅درخواست پشتیبانی
🔆در صورت وجود مشکل با ارسال این دستور پشتیبانی به گروه شما اعزام میشود

✅ریپورت [ریپلای]
🔆ارسال گزارش برای مدیر گروه

✅اخراج من
🔆اخراج شما از گروه

✅عکس پروفایل [عدد]
🔆دریافت عکس پروفایل شما به عدد

✅ ! ( ریپلای و تایپ )
🔆 گفتن حرف شما با ربات

✅ کد رایگان
🔆  شارژ کردن گروه با استفاده از کد شارژ رایگان

✅  ارز دیجیتال
🔆 مشاهده قیمت های آنلاین ارز دیجیتال

✅ فونت botevoo
🔆  50 مدل فونت قشنگ و زیبا دریافت کنید

⚠️ ایموجی های ابتدای دستور را وارد نکنید

❇️ در جای که علامت های () وجود دارد در دستورات از آن ها استفاده نکنید

🔅 مثال : $botnamef

",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
					 [
					 ['text'=>"$nemechannel",'url'=>"https://telegram.me/$channel"],['text'=>"🔙 برگشت",'callback_data'=>'farsi']
					 ],
                     ]
               ])
           ]);
    }	
				    elseif($data=="lockfa"){
				 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$Dev) ){
            botevoobot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"
🔅 راهنمای دستورات قفلی :

❌ پاک کردن و پاک نکردن دستورات زیر

✅ مثال : ( قفل لینک ) ( بازکردن لینک )

🔅 لیست قفل ها : 

( لینک / تگ / یوزرنیم / متن / ویرایش / ربات / فحش / گیف / عکس / ویدیو / اهنگ / ویس / استیکر / مخاطب / فوروارد / مکان / فایل /بازی / پیام ویدیویی / ریپلای / دستورات / خدمات / کاراکتر / انگلیسی / تبچی / عضویت / گروه )

✅ روشن و خاموش کردت قفل خودکار گروه
🔅قفل خودکار ( روشن / خاموش )
🔅 تنظیم قفل خودکار 00:00 07:00 

✅ تنظیم قفل کاراکتر
🔅تنظیم کاراکتر 10 320 

❌ ایموجی های ابتدایی دستورات را وارد کنید
",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
					 [
					 ['text'=>"$nemechannel",'url'=>"https://telegram.me/$channel"],['text'=>"🔙 برگشت",'callback_data'=>'farsi']
					 ],
                     ]
               ])
           ]);
		   		 }else{
			botevoobot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"شما مدیر ربات نیستید ⚠️",
]);
    }
					}	
									    elseif($data=="locken"){
				 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$Dev) ){
            botevoobot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"📍 راهنمای دستورات قفلی :
➖➖➖➖➖

📌پاک کردن لینک 
/lock link
/unlock link
〰〰〰
📌پاک کرد هشتگ
/lock tag
/unlock tag
〰〰〰
📌پاک کردن یوزرنیم
/lock username
/unlock username
〰〰〰
📌پاک کردن متن
/lock text
/unlock text
〰〰〰
📌پاک کردن ویرایش پیام
/lock edit
/unlock edit
〰〰〰
📌پاک کردن ربات های مخرب
/lock bots
/unlock bots
〰〰〰
📌پاک کردن کلمات رکیک
/lock fosh
/unlock fosh
〰〰〰
📌پاک کردن تصاویر متحرک
/lock gif
/unlock gif
〰〰〰
📌پاک کردن عکس
/lock photo
/unlock photo
〰〰〰
📌پاک کردن فیلم
/lock video
/unlock video
〰〰〰
📌پاک کردن اهنگ
/lock audio
/unlock audio
〰〰〰
📌پاک کردن ویس
/lock voice
/unlock voice
〰〰〰
📌پاک کردن استیکر
/lock sticker
/unlock sticker
〰〰〰
📌پاک کردن ارسال مخاطب
/lock contact
/unlock contact
〰〰〰
📌پاک کردن فوروارد
/lock forward
/unlock forward
〰〰〰
📌پاک کردن ارسال مکان
/lock location
/unlock location
〰〰〰
📌پاک کردن ارسال فایل
/lock document
/unlock document
〰〰〰
📌پاک کردن بازی تحت وب
/lock game
/unlock game
〰〰〰
📌پاک کردن پیام ویدیویی
/lock videonote
/unlock videonote
〰〰〰
📌پاک کردن ریپلای کردن پیام
/lock reply
/unlock reply
〰〰〰
📌جلو گیری از دستورات عمومی
/lock cmd
/unlock cmd
〰〰〰
📌قفل خدمات تلگرام
/lock tgservic
/unlock tgservic
〰〰〰
📌خاموش و روشن کردن قفل خودکار گروه
/lock auto
/unlock auto
/setlockauto [زمان پایان زمان شروع]
📍 زمان را باید با فرمت صحیح استفاده کنید مثال :
/setlockauto 13:36 19:05
〰〰〰
📌خاموش و روشن کردن و تنظیم کاراکتر پیام
/lock character
/unlock character
/setlockcharacter [حداقل کاراکتر حداکثر کاراکتر]
📍 باید حتما به عدد وارد کنید مثال :
/setlockcharacter 10 320

➖➖➖
🔹برای دستورات انگلیسی ان هارو تایپ کنید و روی ان ها کلیک نکنید!

🔖بازکردن و قفل کردن هم از طریق پنل و هم از طریق دستور ممکن است

🔸مثال :
/lock link
/unlock link
➖➖➖",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
					 [
					 ['text'=>"$nemechannel",'url'=>"https://telegram.me/$channel"],['text'=>"🔙 برگشت",'callback_data'=>'english']
					 ],
                     ]
               ])
           ]);
		   		 }else{
			botevoobot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"شما مدیر ربات نیستید ⚠️",
]);
    }
					}
						
  elseif($data=="helppanel"){
									 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$Dev) ){
            botevoobot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"🚩به راهنمای ربات مدیریت گروه خوش امدید
➖➖➖➖➖➖➖➖
🔖لطفا زبان مورد نظر برای دستورات را انتخاب کنید

💥در راهنما به نکات زیر توجه کنید

🔹🔸🔹🔸🔹🔸🔹🔸🔹🔸🔹

🔹برای دستورات انگلیسی ان هارو تایپ کنید و روی ان ها کلیک نکنید!

🔸در جای که علامت های [] وجود دارد در دستورات از ان ها استفاده نکنید
➖➖➖",
	   'reply_markup'=>json_encode([
    'inline_keyboard'=>[
 	[
	  ['text'=>"🇮🇷 فارسی",'callback_data'=>"farsipanel"],['text'=>"🇬🇧 انگلیسی",'callback_data'=>"englishpanel"]
	  ],
	  	  	 [
				 ['text'=>"$nemechannel",'url'=>"https://telegram.me/$channel"],['text'=>"🔙 برگشت",'callback_data'=>'back']
		 ],
		      [
   ['text'=>"✖️ خروج",'callback_data'=>'exit']
   ],
   ]
   ])
   ]);
   }else{
			botevoobot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"شما مدیر ربات نیستید ⚠️",
]);
   } 
						}
   	    elseif($data=="englishpanel"){
					 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$Dev) ){
            botevoobot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"به بخش دریافت دستورات انگلیسی خوش امدید❤️
➖➖➖➖➖➖➖➖
🔖لطفا بخش مورد نظر خورد را انتخاب کنید

➖➖➖➖

⚠️به نکات زیر توجه کنید :

🔹برای دیدن دستورات قفلی و مدیریتی شما باید حتما مدیر ربات باشید و کابران عادی اجازه ورود به این بخش را ندارند

💥دستورات عمومی برای همه کاربران است و همه اجازه استفاده از این دستورات را دارند

🎉دستورات صاحب ربات فقط برای سودو ربات هست و دیگر کاربران  اجازه ورود ندارند
➖➖➖",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				    	[
	  ['text'=>"🚦 عمومی",'callback_data'=>"allenpanel"],['text'=>"🔖 مدیریتی",'callback_data'=>"manageenpanel"]
	  ],
	  				    	[
	  ['text'=>"🔐 قفل ها",'callback_data'=>"lockenpanel"]
	  ],
					 [
					 ['text'=>"$nemechannel",'url'=>"https://telegram.me/$channel"],['text'=>"🔙 برگشت",'callback_data'=>'helppanel']
					 ],
                     ]
               ])
           ]);
		   }else{
			botevoobot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"شما مدیر ربات نیستید ⚠️",
]);
    }
		}
		    elseif($data=="farsipanel"){
						 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$Dev) ){
            botevoobot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"به بخش دریافت دستورات فارسی خوش امدید❤️
➖➖➖➖➖➖➖➖
🔖لطفا بخش مورد نظر خورد را انتخاب کنید

➖➖➖➖

⚠️به نکات زیر توجه کنید :

🔹برای دیدن دستورات قفلی و مدیریتی شما باید حتما مدیر ربات باشید و کابران عادی اجازه ورود به این بخش را ندارند

💥دستورات عمومی برای همه کاربران است و همه اجازه استفاده از این دستورات را دارند

🎉دستورات صاحب ربات فقط برای سودو ربات هست و دیگر کاربران  اجازه ورود ندارند
➖➖➖",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				    	[
	  ['text'=>"🚦 عمومی",'callback_data'=>"allfapanel"],['text'=>"🔖 مدیریتی",'callback_data'=>"managefapanel"]
	  ],
	  				    	[
	  ['text'=>"🔐 قفل ها",'callback_data'=>"lockfapanel"]
	  ],
					 [
					 ['text'=>"$nemechannel",'url'=>"https://telegram.me/$channel"],['text'=>"🔙 برگشت",'callback_data'=>'helppanel']
					 ],
                     ]
               ])
           ]);
		   }else{
			botevoobot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"شما مدیر ربات نیستید ⚠️",
]);
    }
			}
			elseif($data=="manageenpanel"){
			 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$Dev) ){
            botevoobot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"

📍 راهنمای دستورات مدیریتی :

/panel
💭دریافت پنل تنظیمات و پنل مدیریت گروه

/settings
💭دریافت تنظیمات گروه به صورت متنی

/promote [ریپلای]
💭ادمین کرد فرد مورد نظر

/demote [ریپلای]
💭تنزل مقام فرد مورد نظر

/admin list 
💭دریافت لیست ادمین های گروه

/pin [ریپلای]
💭سنحاق کردن پیام مورد نظر توسط ربات

/unpin 
💭برداشتن پیام از حالت سنجاق

/kick [ریپلای | ایدی]
💭اخراج فرد مورد نظر از گروه

/del [ریپلای]
💭حذف پیام مورد نظر

/rmsg [1-300]
💭پاک کردن پیام های اخیر گروه

/setname [نام]
💭تنظیم نام گروه

/setdescription [متن]
💭تنظیم اطلاعات گروه

/delphoto 
💭حذف عکس گروه

/setphoto [ریپلای]
💭تنظیم عکس گروه

/check
💭دریافت میزان شارژ گروه

/automatic
💭فعال کردن قفل ها به صورت خودکار و مدیریت خود کار گروه

/mute all
💭ساکت کردن همه گروه

/unmute all
💭غیر فعال کردن سکوت گروه

/welcome [enable |disable]
💭روشن و خاموش کردن خوش امد

/setwelcome [متن]
💭تنظیم پیام خوش امد

/silent
💭افزودن فرد به لیست سکوت گروه

/silent [دقیقه]
💭افزودن فرد به لیست سکوت گروه به صورت زمان داره

/unsilent
💭خارج کردن فرد از لیست سکوت گروه

/list silent
💭دریافت لیست سکوت گروه

/clean silentlist
💭 پاک کردن لیست سکوت گروه

/request
💭درخواست تمدید شارژ برای گروه

/filter
💭افزودن کلمه به لیست کلمات فیلترشده

/unfilter
💭حذف کلمه از لیست کلمات فیلتر شده

/filterlist
💭دریافت لیست کلمات فیلتر شد

/clean filterlist
💭پاک کردن تمام کلمات درون لیست فیلتر

/restart settings
💭ریستارت کردن تنظیمات گروه به حالت اولیه

/add [on | off]
💭روشن و خاموش کردن اد اجباری در گروه

/setadd [عدد]
💭تنظیم مقدار کاربری که یک فرد باید دعوت کند تا بتواند در گروه چت کند

/setwarn [عدد]
💭 تنظیم حداکثر اخطار برای کاربر

/warn [ریپلای]
💭اخطار دادن به کاربر مورد نظر

/unwarn [ریپلای]
💭کم کردن اخطار های کاربر مورد نظر

/warn info [ریپلای]
💭به دست اوردن تعداد اخطار های کاربر

/setrules [متن]
💭تنظیم قوانین گروه

/muteall [دقیقه]
💭سکوت همه به صورت زمان دار

/channel [on | off]
💭روشن و خاموش کردن قفل کانال

/setchannel [@یوزرنیم کانال]
💭 قفل کردن ربات روی کانال تنظیم شد

/modebot [on | off]
💭 روشن و خاموش کردن حالت سختگیرانه اضافه کردن ربات

/modewarn [on | off]
💭 روشن و خاموش کردن حالت سختگیرانه اخراج کاربر پس از رسیدن به حداکثر اخطار

➖➖➖
🔹برای دستورات انگلیسی ان هارو تایپ کنید و روی ان ها کلیک نکنید!

🔸در جای که علامت های [] وجود دارد در دستورات از ان ها استفاده نکنید

🔹میتوانید در متن خوش امد و قوانین برای گرفتن نام و ایدی فرد از موارد زیر استفاده کنید
gpname = دریافت نام گروه
username = دریافت یوزرنیم طرف

✨مثال :
/setrules hi

               ",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
					 [
					 ['text'=>"$nemechannel",'url'=>"https://telegram.me/$channel"],['text'=>"🔙 برگشت",'callback_data'=>'englishpanel']
					 ],
                     ]
               ])
           ]);
		   }else{
			botevoobot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"شما مدیر ربات نیستید ⚠️",
]);
    }
				}
				    elseif($data=="managefapanel"){
				 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$Dev) ){
            botevoobot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"🔆 راهنمای دستورات مدیریتی :

✅پنل
🔆دریافت پنل تنظیمات و پنل مدیریت گروه

✅تنظیمات
🔆دریافت تنظیمات گروه به صورت متنی

✅ترفیع [ریپلای]
💭ادمین کرد فرد مورد نظر

✅تنزل [ریپلای]
🔆تنزل مقام فرد مورد نظر

✅لیست ادمین
🔆دریافت لیست ادمین های گروه

✅سنجاق [ریپلای]
🔆سنحاق کردن پیام مورد نظر توسط ربات

✅حذف سنجاق
🔆حذف سنجاق پیام سنجاق شده

✅اخراج فرد
🔆اخراج فرد مورد نظر از گروه

✅حذف [ریپلای]
🔆حذف پیام مورد نظر

✅پاک کردن [1-300]
🔆پاک کردن پیام های اخیر گروه

✅تنظیم نام [نام]
🔆تنظیم نام گروه

✅تنظیم اطلاعات [متن]
🔆تنظیم اطلاعات گروه

✅حذف عکس
🔆حذف عکس گروه

✅تنظیم عکس [ریپلای]
🔆تنظیم عکس گروه

✅میزان شارژ
🔆دریافت میزان شارژ گروه

✅اتوماتیک فعال
🔆فعال کردن قفل ها به صورت خودکار و مدیریت خود کار گروه

✅بیصدا همه
🔆ساکت کردن همه گروه

✅باصدا همه
🔆غیر فعال کردن سکوت گروه

✅خوش امد [روشن - خاموش]
🔆روشن . خاموش کردن خوش امد گویی گروه

✅تنظیم خوش امد [متن]
🔆تنظیم پیام خوش امد

✅بیصدا
🔆افزودن فرد به لیست سکوت گروه

✅بیصدا [دقیقه]
🔆 افزودن فرد به لیست سکوت گروه به صورت زمان داره

✅باصدا
🔆خارج کردن فرد از لیست سکوت گروه

✅لیست سکوت
🔆دریافت لیست سکوت گروه

✅حذف لیست سکوت
🔆 پاک کردن لیست سکوت گروه

✅درخواست شارژ
💭درخواست تمدید شارژ برای گروه

✅افزودن فیلتر [کلمه]
🔆افزودن کلمه به لیست کلمات فیلترشده

✅حذف فیلتر [کلمه]
🔆حذف کلمه از لیست کلمات فیلتر شده

✅لیست فیلتر
🔆دریافت لیست کلمات فیلتر شد

✅حذف لیست فیلتر
🔆پاک کردن تمام کلمات درون لیست فیلتر

✅ریستارت تنظیمات
🔆ریستارت کردن تنظیمات گروه به حالت اولیه

✅دعوت [روشن | خاموش]
🔆روشن و خاموش کردن اد اجباری در گروه

✅تنظیم دعوت [عدد]
🔆تنظیم مقدار کاربری که یک فرد باید دعوت کند تا بتواند در گروه چت کند

✅تنظیم اخطار [عدد]
🔆 تنظیم حداکثر اخطار برای کاربر

✅اخطار [ریپلای]
🔆 اخطار دادن به کاربر مورد نظر

✅حذف اخطار [ریپلای]
🔆 کم کردن اخطار های کاربر مورد نظر

✅اطلاعات اخطار [ریپلای]
🔆 به دست اوردن تعداد اخطار های کاربر

✅تنظیم قوانین [متن]
🔆 تنظیم قوانین گروه

✅بیصدا همه [دقیقه]
🔆سکوت همه به صورت زمان دار

✅قفل کانال [روشن | خاموش]
🔆روشن و خاموش کردن قفل کانال

✅تنظیم کانال [@یوزرنیم کانال]
🔆 قفل کردن ربات روی کانال تنظیم شد

✅سختگیرانه ربات [روشن | خاموش]
🔆 روشن و خاموش کردن حالت سختگیرانه اضافه کردن ربات

✅سختگیرانه اخطار [روشن | خاموش]
🔆 روشن و خاموش کردن حالت سختگیرانه اخراج کاربر پس از رسیدن به حداکثر اخطار

✅ مدیریت کاربر ( ریپلای )
🔆 مدیریت کردن فرد مورد نظر

✅ فان روشن / خاموش
🔆 روشن و خاموش کردن حالت صحبت کردن ربات

⚠️ ایموجی های ابتدای دستورات را وارد کنید
🔆 در جای که علامت های () وجود دارد در دستور از آن ها استفاده نکنید
🎉 میتوانید در متن خوش امد و قوانین برای گرفتن نام و ایدی فرد مورد نظر از موارد زیر استفاده کنید .
🎈gpname = دریافت نام‌ گروه
🎈username = دریافت یوزرنیم طرف

🔸 مثال دستورات :
خوش امد روشن
",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
					 [
					 ['text'=>"$nemechannel",'url'=>"https://telegram.me/$channel"],['text'=>"🔙 برگشت",'callback_data'=>'farsipanel']
					 ],
                     ]
               ])
           ]);
		   }else{
			botevoobot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"شما مدیر ربات نیستید ⚠️",
]);
    }
					}
					 elseif($data=="allenpanel"){
						 	 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$Dev) ){
            botevoobot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"
📍 راهنمای دستورات عمومی :

/rules
💭دریافت قوانین گروه

/link
💭دریافت لینک گروه

/time
💭دریافت تاریخ و ساعت

/id
💭دریافت اطلاعات خودتان

/me
💭دریافت اطلاعات شما به همراه مقام شما در ربات

/tamdid
💭شارژ مجدد ربات

/info
💭دریافت اطلاعات گروه و خودتان

/info [ریپلای| ایدی]
💭دریافت اطلاعات فرد مورد نظر

/ping
💭اطمینان حاصل کردن از انلاینی ربات

/support
💭در صورت وجود مشکل با ارسال این دستور پشتیبانی به گروه شما اعزام میشود

/report [ریپلای]
💭ارسال گزارش برای مدیر گروه

/kickme
💭اخراج شما از گروه

/getpro [عدد]
💭دریافت عکس پروفایل شما به عدد

/font 
💭زیباسازی فونت های انگلیسی

➖➖➖
🔹برای دستورات انگلیسی ان هارو تایپ کنید و روی ان ها کلیک نکنید!

🔸در جای که علامت های [] وجود دارد در دستورات از ان ها استفاده نکنید

🔅دستورات voice و bachekojai به خاطر جلوگیری از اسپم معادل فارسی ندارند

✨مثال :
/setrules hi
               ",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
					 [
					 ['text'=>"$nemechannel",'url'=>"https://telegram.me/$channel"],['text'=>"🔙 برگشت",'callback_data'=>'englishpanel']
					 ],
                     ]
               ])
           ]);
		   }else{
			botevoobot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"شما مدیر ربات نیستید ⚠️",
]);
    }
					 }
						 elseif($data=="allfapanel"){
							 	 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$Dev) ){
            botevoobot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"
🔆 راهنمای دستورات عمومی :

✅قوانین
🔆دریافت قوانین گروه

✅لینک
🔆دریافت لینک گروه

✅ساعت
🔆دریافت تاریخ و ساعت

✅ایدی
🔆دریافت اطلاعات خودتان

✅من
🔆دریافت اطلاعات شما به همراه مقام شما در ربات

✅ تمدید
🔆دریافت نرخ برای خرید ربات

✅ اطلاعات
🔆دریافت اطلاعات گروه و خودتان

✅اطلاعات فرد [ریپلای| ایدی]
🔆دریافت اطلاعات فرد مورد نظر

✅ انلاینی
🔆اطمینان حاصل کردن از انلاینی ربات


✅درخواست پشتیبانی
🔆در صورت وجود مشکل با ارسال این دستور پشتیبانی به گروه شما اعزام میشود

✅ریپورت [ریپلای]
🔆ارسال گزارش برای مدیر گروه

✅اخراج من
🔆اخراج شما از گروه

✅عکس پروفایل [عدد]
🔆دریافت عکس پروفایل شما به عدد

✅ ! ( ریپلای و تایپ )
🔆 گفتن حرف شما با ربات

✅ کد رایگان
🔆  شارژ کردن گروه با استفاده از کد شارژ رایگان

✅  ارز دیجیتال
🔆 مشاهده قیمت های آنلاین ارز دیجیتال

✅ فونت botevoo
🔆  50 مدل فونت قشنگ و زیبا دریافت کنید

⚠️ ایموجی های ابتدای دستور را وارد نکنید

❇️ در جای که علامت های () وجود دارد در دستورات از آن ها استفاده نکنید

🔅 مثال : $botnamef

",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
					 [
					 ['text'=>"$nemechannel",'url'=>"https://telegram.me/$channel"],['text'=>"🔙 برگشت",'callback_data'=>'farsipanel']
					 ],
                     ]
               ])
           ]);
		   }else{
			botevoobot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"شما مدیر ربات نیستید ⚠️",
]);
    }	
						 }
				    elseif($data=="lockfapanel"){
				 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$Dev) ){
            botevoobot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"
🔅 راهنمای دستورات قفلی :

❌ پاک کردن و پاک نکردن دستورات زیر

✅ مثال : ( قفل لینک ) ( بازکردن لینک )

🔅 لیست قفل ها : 

( لینک / تگ / یوزرنیم / متن / ویرایش / ربات / فحش / گیف / عکس / ویدیو / اهنگ / ویس / استیکر / مخاطب / فوروارد / مکان / فایل /بازی / پیام ویدیویی / ریپلای / دستورات / خدمات / کاراکتر / انگلیسی / تبچی / عضویت / گروه )

✅ روشن و خاموش کردت قفل خودکار گروه
🔅قفل خودکار ( روشن / خاموش )
🔅 تنظیم قفل خودکار 00:00 07:00 

✅ تنظیم قفل کاراکتر
🔅تنظیم کاراکتر 10 320 

❌ ایموجی های ابتدایی دستورات را وارد کنید
",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
					 [
					 ['text'=>"$nemechannel",'url'=>"https://telegram.me/$channel"],['text'=>"🔙 برگشت",'callback_data'=>'farsipanel']
					 ],
                     ]
               ])
           ]);
		   }else{
			botevoobot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"شما مدیر ربات نیستید ⚠️",
]);
    }
					}	
									    elseif($data=="lockenpanel"){
				 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$Dev) ){
            botevoobot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"📍 راهنمای دستورات قفلی :
➖➖➖➖➖

📌پاک کردن لینک 
/lock link
/unlock link
〰〰〰
📌پاک کرد هشتگ
/lock tag
/unlock tag
〰〰〰
📌پاک کردن یوزرنیم
/lock username
/unlock username
〰〰〰
📌پاک کردن متن
/lock text
/unlock text
〰〰〰
📌پاک کردن ویرایش پیام
/lock edit
/unlock edit
〰〰〰
📌پاک کردن ربات های مخرب
/lock bots
/unlock bots
〰〰〰
📌پاک کردن کلمات رکیک
/lock fosh
/unlock fosh
〰〰〰
📌پاک کردن تصاویر متحرک
/lock gif
/unlock gif
〰〰〰
📌پاک کردن عکس
/lock photo
/unlock photo
〰〰〰
📌پاک کردن فیلم
/lock video
/unlock video
〰〰〰
📌پاک کردن اهنگ
/lock audio
/unlock audio
〰〰〰
📌پاک کردن ویس
/lock voice
/unlock voice
〰〰〰
📌پاک کردن استیکر
/lock sticker
/unlock sticker
〰〰〰
📌پاک کردن ارسال مخاطب
/lock contact
/unlock contact
〰〰〰
📌پاک کردن فوروارد
/lock forward
/unlock forward
〰〰〰
📌پاک کردن ارسال مکان
/lock location
/unlock location
〰〰〰
📌پاک کردن ارسال فایل
/lock document
/unlock document
〰〰〰
📌پاک کردن بازی تحت وب
/lock game
/unlock game
〰〰〰
📌پاک کردن پیام ویدیویی
/lock videonote
/unlock videonote
〰〰〰
📌پاک کردن ریپلای کردن پیام
/lock reply
/unlock reply
〰〰〰
📌جلو گیری از دستورات عمومی
/lock cmd
/unlock cmd
〰〰〰
📌قفل خدمات تلگرام
/lock tgservic
/unlock tgservic
〰〰〰
📌خاموش و روشن کردن قفل خودکار گروه
/lock auto
/unlock auto
/setlockauto [زمان پایان زمان شروع]
📍 زمان را باید با فرمت صحیح استفاده کنید مثال :
/setlockauto 13:36 19:05
〰〰〰
📌خاموش و روشن کردن و تنظیم کاراکتر پیام
/lock character
/unlock character
/setlockcharacter [حداقل کاراکتر حداکثر کاراکتر]
📍 باید حتما به عدد وارد کنید مثال :
/setlockcharacter 10 320

➖➖➖
🔹برای دستورات انگلیسی ان هارو تایپ کنید و روی ان ها کلیک نکنید!

🔖بازکردن و قفل کردن هم از طریق پنل و هم از طریق دستور ممکن است

🔸مثال :
/lock link
/unlock link
➖➖➖",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
					 [
					 ['text'=>"$nemechannel",'url'=>"https://telegram.me/$channel"],['text'=>"🔙 برگشت",'callback_data'=>'englishpanel']
					 ],
                     ]
               ])
           ]);
		   }else{
			botevoobot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"شما مدیر ربات نیستید ⚠️",
]);
    }
					}
					
					
// charge
if (strpos($textmassage , "/charge ") !== false && in_array($from_id,$Dev) or strpos($textmassage , "تنظیم شارژ ") !== false && in_array($from_id,$Dev)) {
  $num = str_replace(['/charge ','تنظیم شارژ '],'',$textmassage);
  if ($num <= 1000 && $num >= 1){
    date_default_timezone_set('Asia/Tehran');
    $date1 = date('Y-m-d', time());
      $date2 = $settings["information"]["expire"];
$next_date=date('Y-m-d', strtotime($date2. ' + '.$num.' days'));
        botevoobot('sendmessage',[
            'chat_id'=>$chat_id,
            'text'=>"✅ گروه با موفقیت $num روز شارژ شد
🔅تاریخ شارژ قبلی : $date2
▪️تاریخ اتمام شارژ : $next_date
🔅ایدی گروه : [$chat_id]
▪️نام گروه : [$namegroup]
☀️توسط : [ @$username ]
",
'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
   ]);
$settings["information"]["expire"]="$next_date";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
   }else{
botevoobot('sendmessage',[
 'chat_id' => $chat_id,
 'text'=>"خطا ⚠️
➖➖➖➖➖➖
💭عدد وارد شده باید بین 1 تا 1000 باشد",
'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
   ]);
}
}
// check charge
elseif($textmassage == "میزان شارژ" or $textmassage == "/check"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev)){
date_default_timezone_set('Asia/Tehran');
$date3 = date('Y-m-d');
$date2 = date('d');
$date1 = date('m');
$ndate = $settings["information"]["expire"];
$rdate = $settings["information"]["dataadded"];
$gettime2 = date('d', strtotime($ndate));
$gettime1 = date('m', strtotime($ndate));
$gettime = $gettime1 - $date1 ;
$gettime2 = $gettime2 - $date2 ;
$ingettime = $gettime * 30 ;
$endtime = $ingettime + $gettime2 ;
        botevoobot('sendmessage', [
            "chat_id" => $chat_id,
            "text" => "💎 به بخش میزان شارژ گروه خوش آمدید
☀️ایدی گروه : [$chat_id]
☀️نام گروه : [$namegroup]
🔻اطلاعات تاریخ انقضای گروه
",
            'reply_to_message_id'=>$message_id,
        'reply_markup'=>json_encode([
            'resize_keyboard'=>true,
            'inline_keyboard'=>[
                [
                    ['text'=>"📅 تاریخ امروز",'callback_data'=>'text'], ['text'=>"🔹 $date3 🔸",'callback_data'=>'text']
                ],
                [
                    ['text'=>"📅 تاریخ اتمام شارژ",'callback_data'=>'text'],                   ['text'=>"🔹 $ndate 🔸",'callback_data'=>'text']
                ],
                [
                    ['text'=>"📅 تاریخ ثبت شارژ",'callback_data'=>'text'],                   ['text'=>"🔹 $rdate 🔸",'callback_data'=>'text']
                ],
				                [
                    ['text'=>"🎊 میزان شارژ گروه",'callback_data'=>'text'],                   ['text'=>"📶 $endtime روز دیگر",'callback_data'=>'text']
                ],
					 [
					 ['text'=>"📦 خرید شارژ",'callback_data'=>'requstcharge']
					 ],
					 									 [
					 ['text'=>"$nemechannel",'url'=>"https://telegram.me/$channel"],['text'=>"✖️ خروج",'callback_data'=>'exit']
					 ],
            ]
        ])
        ]);
}
}
  elseif($data=="charge"){
if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$Dev)){
date_default_timezone_set('Asia/Tehran');
$date3 = date('Y-m-d');
$date2 = date('d');
$date1 = date('m');
$ndate = $settings2["information"]["expire"];
$rdate = $settings2["information"]["dataadded"];
$gettime2 = date('d', strtotime($ndate));
$gettime1 = date('m', strtotime($ndate));
$gettime = $gettime1 - $date1 ;
$gettime2 = $gettime2 - $date2 ;
$ingettime = $gettime * 30 ;
$endtime = $ingettime + $gettime2 ;
            botevoobot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"
💎 به بخش میزان شارژ گروه خوش آمدید
☀️ایدی گروه : [$chat_id]
☀️نام گروه : [$namegroup]
🔻اطلاعات تاریخ انقضای گروه",
        'reply_markup'=>json_encode([
            'resize_keyboard'=>true,
            'inline_keyboard'=>[
                [
                ['text'=>"📅 تاریخ امروز",'callback_data'=>'text'],
                ['text'=>"🔹 $date3 🔸",'callback_data'=>'text']
                ],
                [
                ['text'=>"📅 تاریخ اتمام شارژ",'callback_data'=>'text'],  
                ['text'=>"🔹 $ndate 🔸",'callback_data'=>'text']
                ],
                [
                ['text'=>"📅 تاریخ ثبت شارژ",'callback_data'=>'text'],  
                ['text'=>"🔹 $rdate 🔸",'callback_data'=>'text']
                ],
				[
                ['text'=>"🎊 میزان شارژ گروه",'callback_data'=>'text'],  
                ['text'=>"📶 $endtime روز دیگر",'callback_data'=>'text']
                ],
					      [
   ['text'=>"✖️ خروج",'callback_data'=>'exit'],['text'=>"📦 خرید شارژ",'callback_data'=>'requstcharge']
   ],
            ]
        ])
        ]);
				 }else{
			botevoobot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"شما مدیر ربات نیستید ⚠️",
]);
}
  }
// panel for sharge
if (strpos($textmassage , "/sendcharge ") !== false && in_array($from_id,$Dev) or strpos($textmassage , "ارسال شارژ ") !== false && in_array($from_id,$Dev)) {
    $panels = str_replace(['/sendcharge ','ارسال شارژ '],'',$textmassage);
	$modified = ltrim($panels);
    $jam = "$modified";
    date_default_timezone_set('Asia/Tehran');
    $date1 = date('Y-m-d', time());
    $date2 = isset($_GET['date']) ? $_GET['date'] : date('Y-m-d');
    $next_date = date('Y-m-d', strtotime($date2 ." +30 day"));
			       botevoobot('sendmessage',[
            'chat_id'=>$panels,
            'text'=>"گروه با موفقیت 30 روز شارژ شد✅"
   ]);
        botevoobot('sendmessage',[
            'chat_id'=>$chat_id,
            'text'=>"✅ گروه مورد نظر با موفقیت 30 روز شارژ شد
☀️ایدی گروه : [$panels]
☀️تاریخ امروز : [$date1]
☀️تاریخ انقضای شارژ گروه : [$next_date]
☀️توسط : [ @$username ]
",
'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
   ]);
$settings = getGroupSettings($jam);
setGroupSetting($jam, "expire", $next_date);
}
// panel charge in pv
if ($textmassage == "/request" or $textmassage == "درخواست شارژ"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev)) {
$getlink = file_get_contents("https://api.telegram.org/bot$token/exportChatInviteLink?chat_id=$chat_id");
$jsonlink = json_decode($getlink, true);
$getlinkde = $jsonlink['result'];
$ndate = $settings["information"]["expire"];
$charge = $settings["information"]["charge"];
$rdate = $settings["information"]["dataadded"];
	botevoobot('sendmessage',[
  'chat_id'=>$chat_id,
  'reply_to_message_id'=>$message_id,
        'text'=>"درخواست شما برای شارژ گروه ارسال شد لطفا با پشتیبانی در ارتباط باشید✅",
  ]);
 botevoobot('sendmessage',[
  'chat_id'=>$Dev[0],
        'text'=>"✅ گروه🔻 $namegroup 🔻تقاظایی شارژ 🔝گروه کرده اند😃

📍 ثبت ربات در تاریخ : [$rdate]
📍 تاریخ شارژ آخر گروه : [$charge]
📍 مقدار شارژ فعلی : [$ndate]
📍 ایدی : [ $from_id ]
📍 نام : [ $first_name ]
📍 یوزرنیم : [ @$username ]
📍 ایدی گروه : [ $chat_id ]
📍 لینک گروه : [ $getlinkde  ]
",
        ]);
}
}
// lock character
		    elseif($data=="character"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$Dev) ){
$lockcharacter = $settings2["lock"]["lockcharacter"];
$pluscharacter = $settings2["information"]["pluscharacter"];
$downcharacter = $settings2["information"]["downcharacter"];
            botevoobot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"🖍 به بخش تنظیم تعداد کارکتر یا حروف پیام خوش امدید
📍 شما در این قسمت میتوانید حداکثر یا حداقل تعداد حروف پیام را تایین کنید
🚩 از دکمه های زیر استفاده کنید",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
                     [
                     ['text'=>"🔐 وضعیت قفل",'callback_data'=>'text'],['text'=>"$lockcharacter",'callback_data'=>'lockcharacter']
					 ],
					            [
                     ['text'=>"✒️ حداکثر کاراکتر",'callback_data'=>'text'],['text'=>"$pluscharacter",'callback_data'=>'text']
					 ],
					               [
                     ['text'=>"➕ ده عدد",'callback_data'=>'uppluscharacter'],['text'=>"➖ ده عدد",'callback_data'=>'dempluscharacter']
					 ],
					 		            [
                     ['text'=>"حداقل کاراکتر",'callback_data'=>'text'],['text'=>"$downcharacter",'callback_data'=>'text']
					 ],
					               [
                     ['text'=>"➕ ده عدد",'callback_data'=>'updowncharacter'],['text'=>"➖ ده عدد",'callback_data'=>'demdowncharacter']
					 ],
					 [
					 ['text'=>"$nemechannel",'url'=>"https://telegram.me/$channel"],['text'=>"🔙 برگشت",'callback_data'=>'back']
					 ],
					      [
   ['text'=>"✖️ خروج",'callback_data'=>'exit']
   ],
                     ]
               ])
           ]);
		   }else{
			botevoobot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"شما مدیر ربات نیستید ⚠️",
]);
    }
				}
						    elseif($data=="lockcharacter" &&  $settings2["lock"]["lockcharacter"] == "| غیر فعال | ❌"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$Dev) ){
$lockcharacter = $settings2["lock"]["lockcharacter"];
$pluscharacter = $settings2["information"]["pluscharacter"];
$downcharacter = $settings2["information"]["downcharacter"];
            botevoobot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"🖍 به بخش تنظیم تعداد کارکتر یا حروف پیام خوش امدید
📍 قفل کاراکتر پیام فعال شد",
'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
                     [
                     ['text'=>"🔐 وضعیت قفل",'callback_data'=>'text'],['text'=>"| فعال | ✅",'callback_data'=>'lockcharacter']
					 ],
					            [
                     ['text'=>"✒️ حداکثر کاراکتر",'callback_data'=>'text'],['text'=>"$pluscharacter",'callback_data'=>'text']
					 ],
					               [
                     ['text'=>"➕ ده عدد",'callback_data'=>'uppluscharacter'],['text'=>"➖ ده عدد",'callback_data'=>'dempluscharacter']
					 ],
					 		            [
                     ['text'=>"حداقل کاراکتر",'callback_data'=>'text'],['text'=>"$downcharacter",'callback_data'=>'text']
					 ],
					               [
                     ['text'=>"➕ ده عدد",'callback_data'=>'updowncharacter'],['text'=>"➖ ده عدد",'callback_data'=>'demdowncharacter']
					 ],
					 [
					 ['text'=>"$nemechannel",'url'=>"https://telegram.me/$channel"],['text'=>"🔙 برگشت",'callback_data'=>'back']
					 ],
					      [
   ['text'=>"✖️ خروج",'callback_data'=>'exit']
   ],
                     ]
               ])
           ]);
$settings2["lock"]["lockcharacter"]="| فعال | ✅";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
		   }else{
			botevoobot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"شما مدیر ربات نیستید ⚠️",
]);
    }
				}
		    elseif($data=="lockcharacter" &&  $settings2["lock"]["lockcharacter"] == "| فعال | ✅"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$Dev) ){
$lockcharacter = $settings2["lock"]["lockcharacter"];
$pluscharacter = $settings2["information"]["pluscharacter"];
$downcharacter = $settings2["information"]["downcharacter"];
            botevoobot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"🖍 به بخش تنظیم تعداد کارکتر یا حروف پیام خوش امدید
📍 قفل کاراکتر پیام غیر فعال شد",
'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
                     [
                     ['text'=>"🔐 وضعیت قفل",'callback_data'=>'text'],['text'=>"| غیر فعال | ❌",'callback_data'=>'lockcharacter']
					 ],
					            [
                     ['text'=>"✒️ حداکثر کاراکتر",'callback_data'=>'text'],['text'=>"$pluscharacter",'callback_data'=>'text']
					 ],
					               [
                     ['text'=>"➕ ده عدد",'callback_data'=>'uppluscharacter'],['text'=>"➖ ده عدد",'callback_data'=>'dempluscharacter']
					 ],
					 		            [
                     ['text'=>"حداقل کاراکتر",'callback_data'=>'text'],['text'=>"$downcharacter",'callback_data'=>'text']
					 ],
					               [
                     ['text'=>"➕ ده عدد",'callback_data'=>'updowncharacter'],['text'=>"➖ ده عدد",'callback_data'=>'demdowncharacter']
					 ],
					 [
					 ['text'=>"$nemechannel",'url'=>"https://telegram.me/$channel"],['text'=>"🔙 برگشت",'callback_data'=>'back']
					 ],
					      [
   ['text'=>"✖️ خروج",'callback_data'=>'exit']
   ],
                     ]
               ])
           ]);
$settings2["lock"]["lockcharacter"]="| غیر فعال | ❌";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
		   }else{
			botevoobot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"شما مدیر ربات نیستید ⚠️",
]);
    }
				}
		    elseif($data=="uppluscharacter"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$Dev) ){
$lockcharacter = $settings2["lock"]["lockcharacter"];
$pluscharacter = $settings2["information"]["pluscharacter"];
$pluscharacterplus = $pluscharacter + 10 ;
$downcharacter = $settings2["information"]["downcharacter"];
            botevoobot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"🖍 به بخش تنظیم تعداد کارکتر یا حروف پیام خوش امدید
🚩 حداکثر تعداد کاراکتر 10 عدد افزایش یافت",
'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
                     [
                     ['text'=>"🔐 وضعیت قفل",'callback_data'=>'text'],['text'=>"$lockcharacter",'callback_data'=>'lockcharacter']
					 ],
					            [
                     ['text'=>"✒️ حداکثر کاراکتر",'callback_data'=>'text'],['text'=>"$pluscharacterplus",'callback_data'=>'text']
					 ],
					               [
                     ['text'=>"➕ ده عدد",'callback_data'=>'uppluscharacter'],['text'=>"➖ ده عدد",'callback_data'=>'dempluscharacter']
					 ],
					 		            [
                     ['text'=>"حداقل کاراکتر",'callback_data'=>'text'],['text'=>"$downcharacter",'callback_data'=>'text']
					 ],
					               [
                     ['text'=>"➕ ده عدد",'callback_data'=>'updowncharacter'],['text'=>"➖ ده عدد",'callback_data'=>'demdowncharacter']
					 ],
					 [
					 ['text'=>"$nemechannel",'url'=>"https://telegram.me/$channel"],['text'=>"🔙 برگشت",'callback_data'=>'back']
					 ],
					      [
   ['text'=>"✖️ خروج",'callback_data'=>'exit']
   ],
                     ]
               ])
           ]);
$settings2["information"]["pluscharacter"]="$pluscharacterplus";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
		   }else{
			botevoobot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"شما مدیر ربات نیستید ⚠️",
]);
    }
				}
			    elseif($data=="dempluscharacter"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$Dev) ){
$lockcharacter = $settings2["lock"]["lockcharacter"];
$pluscharacter = $settings2["information"]["pluscharacter"];
$pluscharacterplus = $pluscharacter - 10 ;
if($pluscharacterplus >= 0){
$downcharacter = $settings2["information"]["downcharacter"];
            botevoobot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"🖍 به بخش تنظیم تعداد کارکتر یا حروف پیام خوش امدید
🚩 حداکثر تعداد کاراکتر 10 عدد کاهش یافت",
'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
                     [
                     ['text'=>"🔐 وضعیت قفل",'callback_data'=>'text'],['text'=>"$lockcharacter",'callback_data'=>'lockcharacter']
					 ],
					            [
                     ['text'=>"✒️ حداکثر کاراکتر",'callback_data'=>'text'],['text'=>"$pluscharacterplus",'callback_data'=>'text']
					 ],
					               [
                     ['text'=>"➕ ده عدد",'callback_data'=>'uppluscharacter'],['text'=>"➖ ده عدد",'callback_data'=>'dempluscharacter']
					 ],
					 		            [
                     ['text'=>"حداقل کاراکتر",'callback_data'=>'text'],['text'=>"$downcharacter",'callback_data'=>'text']
					 ],
					               [
                     ['text'=>"➕ ده عدد",'callback_data'=>'updowncharacter'],['text'=>"➖ ده عدد",'callback_data'=>'demdowncharacter']
					 ],
					 [
					 ['text'=>"$nemechannel",'url'=>"https://telegram.me/$channel"],['text'=>"🔙 برگشت",'callback_data'=>'back']
					 ],
					      [
   ['text'=>"✖️ خروج",'callback_data'=>'exit']
   ],
                     ]
               ])
           ]);
$settings2["information"]["pluscharacter"]="$pluscharacterplus";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
		   }
		   else
		   {
			  			botevoobot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"امکان تغییر به پایین تر از عدد 0 وجود ندارد ⚠️",
]); 
		 }
				}
		   else{
			botevoobot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"شما مدیر ربات نیستید ⚠️",
]);
    }
				}
						 elseif($data=="demdowncharacter"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$Dev) ){
$lockcharacter = $settings2["lock"]["lockcharacter"];
$pluscharacter = $settings2["information"]["pluscharacter"];
$downcharacter = $settings2["information"]["downcharacter"];
$downcharacterplus = $downcharacter - 10 ;
if($downcharacterplus >= 0){
            botevoobot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"🖍 به بخش تنظیم تعداد کارکتر یا حروف پیام خوش امدید
🚩 حداقل تعداد کاراکتر 10 عدد کاهش یافت",
'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
                     [
                     ['text'=>"🔐 وضعیت قفل",'callback_data'=>'text'],['text'=>"$lockcharacter",'callback_data'=>'lockcharacter']
					 ],
					            [
                     ['text'=>"✒️ حداکثر کاراکتر",'callback_data'=>'text'],['text'=>"$pluscharacter",'callback_data'=>'text']
					 ],
					               [
                     ['text'=>"➕ ده عدد",'callback_data'=>'uppluscharacter'],['text'=>"➖ ده عدد",'callback_data'=>'dempluscharacter']
					 ],
					 		            [
                     ['text'=>"حداقل کاراکتر",'callback_data'=>'text'],['text'=>"$downcharacterplus",'callback_data'=>'text']
					 ],
					               [
                     ['text'=>"➕ ده عدد",'callback_data'=>'updowncharacter'],['text'=>"➖ ده عدد",'callback_data'=>'demdowncharacter']
					 ],
					 [
					 ['text'=>"$nemechannel",'url'=>"https://telegram.me/$channel"],['text'=>"🔙 برگشت",'callback_data'=>'back']
					 ],
					      [
   ['text'=>"✖️ خروج",'callback_data'=>'exit']
   ],
                     ]
               ])
           ]);
$settings2["information"]["downcharacter"]="$downcharacterplus";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
		   }
		   else
		   {
			  			botevoobot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"امکان تغییر به پایین تر از عدد 0 وجود ندارد ⚠️",
]); 
		 }
				}
		   else{
			botevoobot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"شما مدیر ربات نیستید ⚠️",
]);
    }
				}
							elseif($data=="updowncharacter"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$Dev) ){
$lockcharacter = $settings2["lock"]["lockcharacter"];
$pluscharacter = $settings2["information"]["pluscharacter"];
$downcharacter = $settings2["information"]["downcharacter"];
$downcharacterplus = $downcharacter + 10 ;
            botevoobot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"🖍 به بخش تنظیم تعداد کارکتر یا حروف پیام خوش امدید
🚩 حداقل تعداد کاراکتر 10 عدد افزایش یافت",
'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
                     [
                     ['text'=>"🔐 وضعیت قفل",'callback_data'=>'text'],['text'=>"$lockcharacter",'callback_data'=>'lockcharacter']
					 ],
					            [
                     ['text'=>"✒️ حداکثر کاراکتر",'callback_data'=>'text'],['text'=>"$pluscharacter",'callback_data'=>'text']
					 ],
					               [
                     ['text'=>"➕ ده عدد",'callback_data'=>'uppluscharacter'],['text'=>"➖ ده عدد",'callback_data'=>'dempluscharacter']
					 ],
					 		            [
                     ['text'=>"حداقل کاراکتر",'callback_data'=>'text'],['text'=>"$downcharacterplus",'callback_data'=>'text']
					 ],
					               [
                     ['text'=>"➕ ده عدد",'callback_data'=>'updowncharacter'],['text'=>"➖ ده عدد",'callback_data'=>'demdowncharacter']
					 ],
					 [
					 ['text'=>"$nemechannel",'url'=>"https://telegram.me/$channel"],['text'=>"🔙 برگشت",'callback_data'=>'back']
					 ],
					      [
   ['text'=>"✖️ خروج",'callback_data'=>'exit']
   ],
                     ]
               ])
           ]);
$settings2["information"]["downcharacter"]="$downcharacterplus";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
		   }else{
			botevoobot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"شما مدیر ربات نیستید ⚠️",
]);
    }
				}	
			
?>