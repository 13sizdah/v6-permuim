<?php
/*
Bot : Management Group pro
Dev : Factweb team
Website: Factweb.ir
Channel : @factweb
*/
//leave and rem
if($textmassage == '/leave'  or $textmassage == 'leave'  or $textmassage == 'ترک'){
if (in_array($from_id,$Dev)){
botevoobot('sendMessage',[
  'chat_id'=>$chat_id,
  'text'=>"🔆 ربات از گروه 
▪️ایدی گروه : [$chat_id]
▪️نام گروه : [$namegroup]
▪️ارسال کننده دستور : [ @$username ]
✅ در حال خروج است",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
   ]);
botevoobot('LeaveChat',[
  'chat_id'=>$chat_id,
  ]);
  }
}
  elseif($textmassage == '/rem' or $textmassage == 'rem'  or  $textmassage == 'حذف' ){
	  if (in_array($from_id,$Dev)){
botevoobot('sendMessage',[
  'chat_id'=>$chat_id,
  'text'=>"
✅ گروه از لیست گروه های پشتیبانی ربات حذف شد
▪️ایدی گروه : [$chat_id]
▪️نام گروه : [$namegroup]
🔆 دیگر پیام های این گروه برسی نمیشود
توسط : @$username
$nemechannel : @$channel

",
'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
   ]);
unlink("data/$chat_id.json");
   }  
  }   
 // tools and cmd
 //rules
elseif($textmassage=="/rules" or $textmassage=="rules" or $textmassage=="قوانین"){
if ( $status != 'creator' && $status != 'administrator' && !in_array($from_id,$Dev) ){
if ($tc == 'group' | $tc == 'supergroup'){  
$lockcmd = $settings["lock"]["cmd"];
if ($lockcmd == "| غیر فعال | ❌") {
$text = $settings["information"]["rules"];
 botevoobot('sendMessage',[
    'chat_id'=>$chat_id,
    'text'=>"🔖قوانین گروه شما :

$text",
		 
		 'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
   ]);
   }   
}
}
else
{
$text = $settings["information"]["rules"];
 botevoobot('sendMessage',[
    'chat_id'=>$chat_id,
    'text'=>"🔖قوانین گروه شما :

$text",
		 
		 'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
   ]);
}
}
elseif (strpos($textmassage , '/setrules ') !== false or strpos($textmassage , 'تنظیم قوانین ') !== false) {
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev)){
$add = $settings["information"]["added"];
if ($add == true) {
$code = str_replace(['/setrules ','تنظیم قوانین '],'',$textmassage);
$plus = mb_strlen("$code");
if($plus < 600) {
 botevoobot('sendMessage',[
    'chat_id'=>$chat_id,
    'text'=>"قوانین جدید  گروه با موفقیت ثبت شد ✅
➖➖➖➖➖➖
🔖توسط : [ @$username ]",
'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
   ]);
$settings["information"]["rules"]="$code";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
	}
else
{
	botevoobot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"📍 تعداد کلمات وارد شد بیش از حد مجاز است حداکثر میتوانید 600 حرف را وارد کنید",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
}
}
else
{
botevoobot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"⚠️ توجه کنید : ربات در گروه شما نصب نیست ! لطفا ابتدا نسبت به نصب ربات اقدام کنید  ☀️
❗️ میتوانید ربات را $freedays روز رایگان فعال کنید با دستور { نصب رایگان }",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);	
}
}
}
//pin
elseif($rt && $textmassage=="/pin"  or $rt && $textmassage=="pin" or $rt && $textmassage=="سنجاق"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev)){
 botevoobot('pinChatMessage',[
    'chat_id'=>$chat_id,
    'message_id'=>$replyid
      ]);
botevoobot('sendmessage',[
 'chat_id'=>$chat_id,
 'text'=>"پیام  با موفقیت سنجاق شد✅
🔖توسط : [ @$username ]",
'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
 }
}
elseif($textmassage=="/unpin"  or  $textmassage=="unpin"  or  $textmassage=="حذف سنجاق"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev)){
 botevoobot('unpinChatMessage',[
    'chat_id'=>$chat_id,
    'message_id'=>$replyid
      ]);
botevoobot('sendmessage',[
 'chat_id'=>$chat_id,
 'text'=>"پیام  با موفقیت از حالت سنجاق برداشته شد✅
🔖توسط : [ @$username ]",
'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
 }
}
// kick
elseif(strpos($textmassage ,"/kick ") !== false or strpos($textmassage ,"اخراج فرد ") !== false) {
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev)){
$text = str_replace(['/kick ','اخراج فرد '],'',$textmassage);
$stat = file_get_contents("https://api.telegram.org/bot$token/getChatMember?chat_id=$text&user_id=".$text);
$statjson = json_decode($stat, true);
$name = $statjson['result']['user']['first_name'];
$username = $statjson['result']['user']['username'];
$id = $statjson['result']['user']['id'];
	botevoobot('KickChatMember',[
    'chat_id'=>$chat_id,
    'user_id'=>$text
      ]);
              botevoobot('sendmessage', [
                'chat_id' => $chat_id,
             'text'=>"🔆 کاربر 
▪️ نام : [$name]
▪️ یوزرنیم : [ @$username ]
▪️ ایدی : [$id]
✅ از گروه اخراج شد
",
'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
   ]);

   }
}
 elseif($rt && $textmassage=="/kick"  or $rt && $textmassage=="kick" or $rt && $textmassage== "اخراج فرد"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev)){
if ( $statusrt != 'creator' && $statusrt != 'administrator' && !in_array($re_id,$Dev)) {
	botevoobot('KickChatMember',[
    'chat_id'=>$chat_id,
    'user_id'=>$re_id
      ]);
botevoobot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"🔆 کاربر 
▪️ نام : [$name]
▪️ یوزرنیم : [ @$username ]
▪️ ایدی : [$id]
✅ از گروه اخراج شد",
'reply_to_message_id'=>$message_id,
	 'reply_markup'=>$inlinebutton,
   ]);
   } 
else	
{
	botevoobot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"📍 من نمیتوانم ادمین ها , صاحبان و مدیران گروه و خود را اخراج کنم",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
   }
}
 }
   //del
elseif($rt && $textmassage == "/del" or $rt && $textmassage == "del" or $rt && $textmassage == "حذف"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev)){
 botevoobot('deletemessage',[
    'chat_id'=>$chat_id,
    'message_id'=>$re_msgid
    ]);
	 botevoobot('deletemessage',[
    'chat_id'=>$chat_id,
    'message_id'=>$message_id
    ]);
 }
}
// rmsg
elseif ( strpos($textmassage , '/rmsg ') !== false or strpos($textmassage , 'پاک کردن ') !== false  ) {
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev)){
$num = str_replace(['/rmsg ','پاک کردن '],'',$textmassage);
if ($num <= 300 && $num >= 1){
$add = $settings["information"]["added"];
if ($add == true) {
for($i=$message_id; $i>=$message_id-$num; $i--){
botevoobot('deletemessage',[
 'chat_id' => $chat_id,
 'message_id' =>$i,
              ]);
}
botevoobot('sendmessage',[
 'chat_id' => $chat_id,
 'text' =>"🔆 تعداد : $num
✅ پیام اخیر گروه با موفقیت پاکشد
👮🏻‍♂️ توسط : [ @$username ]",
'reply_markup'=>$inlinebutton,
   ]);
}
else
{
botevoobot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"⚠️ توجه کنید : ربات در گروه شما نصب نیست ! لطفا ابتدا نسبت به نصب ربات اقدام کنید  ☀️
❗️ میتوانید ربات را $freedays روز رایگان فعال کنید با دستور { نصب رایگان }",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
}
}
else
{
botevoobot('sendmessage',[
 'chat_id' => $chat_id,
 'text'=>"خطا⚠️
➖➖➖➖➖➖
عدد وارد شده باید بین 1 تا 300 باشد",
'reply_markup'=>$inlinebutton,
   ]);
}
}
}
//  setname
elseif ( strpos($textmassage , '/setname ') !== false or strpos($textmassage , 'تنظیم نام ') !== false  ) {
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev)){
$newname= str_replace(['/setname ','تنظیم نام '],'',$textmassage);
 botevoobot('setChatTitle',[
    'chat_id'=>$chat_id,
    'title'=>$newname
      ]);
botevoobot('sendmessage',[
 'chat_id'=>$chat_id,
 'text'=>"
✅ نام گروه تعویض شد
💥نام جدید :  [$newname]
🔖توسط : [ @$username ]
",
'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
   ]);
 }
}
// description
elseif ( strpos($textmassage , '/setdescription ') !== false or strpos($textmassage , 'تنظیم اطلاعات ') !== false  ) {
$newdec= str_replace(['/setdescription ','تنظیم اطلاعات '],'',$textmassage);
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev)){
 botevoobot('setChatDescription',[
    'chat_id'=>$chat_id,
    'description'=>$newdec
      ]);
botevoobot('sendmessage',[
 'chat_id'=>$chat_id,
 'text'=>"اطلاعات جدید گروه با موفقیت تغییر کرد✅
🔖توسط : [ @$username ]",
'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
   ]);
 }
}
// set photo
elseif($textmassage=="/delphoto" or $textmassage=="delphoto" or $textmassage=="حذف عکس"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev)){
botevoobot('deleteChatPhoto',[
   'chat_id'=>$chat_id,
     ]);
botevoobot('sendmessage',[
 'chat_id'=>$chat_id,
 'text'=>"عکس گروه با موفقیت حذف شد ✅
🔖توسط : [ @$username ]
💥جهت تنظیم عکس گروه دستور [/setphoto] را ارسال کنید",
'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
   ]);
 }
}
elseif($textmassage=="/setphoto" or $textmassage=="setphoto" or $textmassage=="تنظیم عکس"){

if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev)){
$photo = $update->message->reply_to_message->photo;
$file = $photo[count($photo)-1]->file_id;
      $get = botevoobot('getfile',['file_id'=>$file]);
      	  $getchat = json_decode($get, true);
      $patch = $getchat["result"]["file_path"];
    file_put_contents("data/photogp.png",file_get_contents("https://api.telegram.org/file/bot$token/$patch"));
botevoobot('setChatPhoto',[
   'chat_id'=>$chat_id,
   'photo'=>new CURLFile("data/photogp.png")
     ]);
botevoobot('sendmessage',[
 'chat_id'=>$chat_id,
 'text'=>"عکس گروه با موفقیت تغییر کرد ✅
🔖توسط : [ @$username ]",
'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
   ]);
unlink("data/photogp.png");
 }
}
// link
 elseif($textmassage=="/link" or $textmassage=="link" or $textmassage=="لینک"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev)){
if ($tc == 'group' | $tc == 'supergroup'){  
$lockcmd = $settings["lock"]["cmd"];
if ($lockcmd == "| غیر فعال | ❌") {
$getlink = file_get_contents("https://api.telegram.org/bot$token/exportChatInviteLink?chat_id=$chat_id");
$jsonlink = json_decode($getlink, true);
$getlinkde = $jsonlink['result'];
botevoobot('sendmessage',[
   'chat_id'=>$chat_id,
   'text'=>"🔆 لینک گروه  :
$getlinkde",
'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
   ]);
 }
 }
 }
else
{
$getlink = file_get_contents("https://api.telegram.org/bot$token/exportChatInviteLink?chat_id=$chat_id");
$jsonlink = json_decode($getlink, true);
$getlinkde = $jsonlink['result'];
botevoobot('sendmessage',[
   'chat_id'=>$chat_id,
   'text'=>"🔆 لینک گروه  :
$getlinkde",
'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
   ]);
 }
 }
// warn
elseif($textmassage=="/warn" && $rt or $textmassage=="warn" && $rt or $textmassage=="اخطار" && $rt){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev)){
if ($tc == 'group' | $tc == 'supergroup'){
if ( $statusrt != 'creator' && $statusrt != 'administrator' && !in_array($re_id,$Dev)) {
$add = $settings["information"]["added"];
if ($add == true) {
$warn = $settings["warnlist"]["$re_id"];
$setwarn = $settings["information"]["setwarn"];
$warnplus = $warn + 1;	
if ($warnplus >= $setwarn) {
$hardmodewarn = $settings["information"]["hardmodewarn"];
if($hardmodewarn == "🚷 اخراج کاربر"){
botevoobot('KickChatMember',[
    'chat_id'=>$chat_id,
    'user_id'=>$re_id
	]);
	botevoobot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"🔆کاربر 
📮 نام : [$re_name]
🔹 یوزرنیم : [ @$re_user ]
🔸 ایدی : [$re_id]
✅ به خاطر رسیدن اخطار ها به حداکثر اخراج شد
",
   ]);
 }
else
{
   botevoobot('restrictChatMember',[
   'user_id'=>$re_id,   
   'chat_id'=>$chat_id,
   'can_post_messages'=>false,
         ]);
		 	botevoobot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"🔆کاربر 
📮 نام : [$re_name]
🔹 یوزرنیم : [ @$re_user ]
🔸 ایدی : [$re_id]
✅ به خاطر رسیدن اخطار ها به حداکثر در حالت سکوت قرار گرفت",
   ]);
$settings["silentlist"][]="$re_id";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
}
}
else
{
botevoobot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"🔆کاربر
📮 نام : [$re_name]
🔹 یوزرنیم : [ @$re_user ]
🔸 ایدی : [$re_id]
✅  یک اخطار گرفت
🔹 تعداد اخطار ها : $warnplus
🔸 حداکثر اخطار : $setwarn
",
'reply_to_message_id'=>$message_id,
	 'reply_markup'=>$inlinebutton,
   ]);
$settings["warnlist"]["{$re_id}"]=$warnplus;
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
}
}
 else
 {
botevoobot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"⚠️ توجه کنید : ربات در گروه شما نصب نیست ! لطفا ابتدا نسبت به نصب ربات اقدام کنید  ☀️
❗️ میتوانید ربات را $freedays روز رایگان فعال کنید با دستور { نصب رایگان }",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
 }
 }
else
{
		botevoobot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"📍 من نمیتوانم ادمین ها , صاحبان و مدیران گروه و خود را اخطار بدهم",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
}
}
}
}
/*
Bot : Management Group pro
Dev : Factweb team
Website: Factweb.ir
Channel : @factweb
*/
 elseif($textmassage=="/unwarn" && $rt or $textmassage=="unwarn" && $rt or $textmassage=="حذف اخطار"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev)){
if ($tc == 'group' | $tc == 'supergroup'){  
$add = $settings["information"]["added"];
if ($add == true) {
$warn = $settings["warnlist"]["$re_id"];
$setwarn = $settings["information"]["setwarn"];
$warnplus = $warn - 1;	
botevoobot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"🔆کاربر
📮 نام : [$re_name]
🔹 یوزرنیم : [ @$re_user ]
🔸 ایدی : [$re_id]
✅  یک اخطارش حذف شد
🔹 تعداد اخطار ها : $warnplus
🔸 حداکثر اخطار : $setwarn",
'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
   ]);
$settings["warnlist"]["{$re_id}"]=$warnplus;
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
 }
 else
 {
botevoobot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"⚠️ توجه کنید : ربات در گروه شما نصب نیست ! لطفا ابتدا نسبت به نصب ربات اقدام کنید  ☀️
❗️ میتوانید ربات را $freedays روز رایگان فعال کنید با دستور { نصب رایگان }",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
 }
 }
}
}
elseif ( strpos($textmassage , '/setwarn ') !== false or strpos($textmassage , 'تنظیم اخطار ') !== false  ) {
$newdec = str_replace(['/setwarn ','تنظیم اخطار '],'',$textmassage);
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev)){
$add = $settings["information"]["added"];
if ($add == true) {
if ($newdec <= 20 && $newdec >= 1){
botevoobot('sendmessage',[
 'chat_id'=>$chat_id,
 'text'=>"🔖 تعداد اخطار ها تغییر کرد
🔸حداکثر تعداد اخطار : $newdec
🚩توسط : [ @$username ]",
'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
   ]);
$settings["information"]["setwarn"]="$newdec";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
   }else{
botevoobot('sendmessage',[
 'chat_id' => $chat_id,
 'text'=>"خطا⚠️
عدد وارد شده باید بین 1 تا 20 باشد",
'reply_markup'=>$inlinebutton,
   ]);
 }
}
else
{
botevoobot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"⚠️ توجه کنید : ربات در گروه شما نصب نیست ! لطفا ابتدا نسبت به نصب ربات اقدام کنید  ☀️
❗️ میتوانید ربات را $freedays روز رایگان فعال کنید با دستور { نصب رایگان }",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
}
}
}
elseif($textmassage=="/warn info" or $textmassage=="warn info" or $textmassage=="اطلاعات اخطار"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev) ){
if ($tc == 'group' | $tc == 'supergroup'){  
$warn = $settings["warnlist"]["$re_id"];
$setwarn = $settings["information"]["setwarn"];
botevoobot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"🔆 کاربر
📮 نام : [$re_name]
🔹 یوزرنیم : [ @$re_user ]
🔸 ایدی : [$re_id]
🔹 تعداد اخطار ها : $warn
🔸 حداکثر اخطار : $setwarn",
'reply_to_message_id'=>$message_id,
	 'reply_markup'=>$inlinebutton,
   ]);
 }
 }
 }
 
 /*
Bot : Management Group pro
Dev : Factweb team
Website: Factweb.ir
Channel : @factweb
*/
 // setup and setowner
// addfree
if($textmassage == "/addfree" or $textmassage == "addfree" or $textmassage == "نصب رایگان" or $textmassage == "/start@$usernamebot addfree" or $textmassage == "/addfree@$usernamebot") {
if ($status == 'creator'or $status=='administrator'){
$url = file_get_contents("https://api.telegram.org/bot$token/getChatMembersCount?chat_id=$chat_id");
$getchat = json_decode($url, true);
$howmember = $getchat["result"];
$add = $settings["information"]["added"];
$dataadd = $settings["information"]["dataadded"];
if ($add == true) {
botevoobot('sendMessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"☀️ گروه قبلا در لیست گروه های پشتیبانی ربات بوده است .
🔅ایدی گروه : [$chat_id]
🔅نام گروه : [$namegroup]
🔅 تاریخ اضافه شدن گروه : [$dataadd]
",
  'reply_to_message_id'=>$message_id,
		  	  'reply_markup'=>json_encode([
    'inline_keyboard'=>[
 	[
['text'=>"$nemechannel",'url'=>"https://telegram.me/$channel"],['text'=>"$dataadd",'callback_data'=>"text"]
	  ],
   ]
   ])
     ]); 
}
else
{
if($howmember >= 1){
botevoobot('sendMessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"✅ گروه با موفقیت به لیست پشتیبانی ربات اضافه شد
🔆ایدی گروه : [$chat_id]
🔆نام گروه : [$namegroup]
👮🏻‍♂️ برای دریافت پنل تنظیمات و راهنما دستور < پنل > را ارسال کنید 
✅ نصب رایگان انجام شد گروه $freedays روز شارژ شد .
🌟 توسط   @$username ",
'reply_to_message_id'=>$message_id,
		  	  'reply_markup'=>json_encode([
    'inline_keyboard'=>[
	  	  	 [
				 ['text'=>"⚙️ مدیریت گروه",'callback_data'=>"back"],['text'=>"🚦 راهنما",'callback_data'=>"help"]
		 ],
		            [
         ['text'=>"$nemechannel",'url'=>"https://telegram.me/$channel"]
     ],
	 ],
	   ])
 ]); 
		        botevoobot('sendmessage',[
            'chat_id'=>$Dev[0],
            'text'=>"✅ یک گروه به لیست گروه های مدیریتی رایگان من اضافه شد
🔅ایدی گروه : [$chat_id]
🔅نام گروه : [$namegroup]
🔅توسط  [ @$username ] 
", 
        ]); 
$dateadd = date('Y-m-d', time());
$dateadd2 = isset($_GET['date']) ? $_GET['date'] : date('Y-m-d');
$next_date = date('Y-m-d', strtotime($dateadd2 ." +$freedays day"));
        $settings = '{"lock": {
                "text": "| غیر فعال | ❌",
                "photo": "| غیر فعال | ❌",
                "link": "| غیر فعال | ❌",
                "tag": "| غیر فعال | ❌",
				"username": "| غیر فعال | ❌",
                "sticker": "| غیر فعال | ❌",
                "video": "| غیر فعال | ❌",
                "voice": "| غیر فعال | ❌",
                "audio": "| غیر فعال | ❌",
                "gif": "| غیر فعال | ❌",
                "bot": "| غیر فعال | ❌",
                "forward": "| غیر فعال | ❌",
                "document": "| غیر فعال | ❌",
                "tgservic": "| غیر فعال | ❌",
				"edit": "| غیر فعال | ❌",
				"reply": "| غیر فعال | ❌",
				"contact": "| غیر فعال | ❌",
				"location": "| غیر فعال | ❌",
				"game": "| غیر فعال | ❌",
				"cmd": "| غیر فعال | ❌",
				"join": "| غیر فعال | ❌",
				"tabchi": "| غیر فعال | ❌",
				"group": "| غیر فعال | ❌",
				"mute_all": "| غیر فعال | ❌",
				"mute_all_time": "| غیر فعال | ❌",
				"fosh": "| غیر فعال | ❌",
				"lockauto": "| غیر فعال | ❌",
				"lockcharacter": "| غیر فعال | ❌",
				"url": "| غیر فعال | ❌",
				"video_msg": "| غیر فعال | ❌"
			},
			"information": {
            "added": "true",
			"welcome": "| غیر فعال | ❌",
			"add": "| غیر فعال | ❌",
			"lockchannel": "| غیر فعال | ❌",
			"hardmodebot": "| غیر فعال | ❌",
			"hardmodewarn": "سکوت کاربر ♨️",
			"charge": "'.$freedays.' روز",
			"setadd": "3",
			"dataadded": "",
			"expire": "",
			"textwelcome": "خوش امدید",
			"rules": "ثبت نشده",
			"msg": "",
			"timelock": "00:00",
			"timeunlock": "00:00",
			"pluscharacter": "300",
			"downcharacter": "0",
			"setwarn": "3"
			}
}';
        $settings = json_decode($settings,true);
		$settings["information"]["expire"]="$next_date";
		$settings["information"]["dataadded"]="$dateadd";
		$settings["information"]["msg_id"]="$message_id";
        $settings = json_encode($settings,true);
        file_put_contents("data/$chat_id.json",$settings);
$gpadd = fopen("data/group.txt",'a') or die("Unable to open file!");  
fwrite($gpadd, "نام گروه : [$namegroup] | ایدی گروه : [$chat_id]\n");
fclose($gpadd);
$user["gps"]["{$from_id}"][]="$namegroup";
        $user = json_encode($user,true);
file_put_contents("data/user.json",$user);
}
else
{
if ($add != true) {
botevoobot('sendMessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"🔆 تعداد اعضا کافی نمیباشد 😞
👮🏻‍♂️برای استفاده از ربات گروه شما باید حداقل 10 عضو را داشته باشد
☀️ اگر نیاز به تست ربات و دیدن امکانات ربات دارید به گروه پشتیبانی ما مراجعه 
کنید
",
  'reply_to_message_id'=>$message_id,
		  	  'reply_markup'=>json_encode([
    'inline_keyboard'=>[
	 	[
['text'=>"🔥 گروه پشتیبانی",'url'=>"$linkgrop"]
	  ],
 	[
['text'=>"$nemechannel",'url'=>"https://telegram.me/$channel"]
	  ],
   ]
   ])
     ]); 
}
}
}
}
}
//add
elseif ($textmassage == "/add"  or $textmassage == "add" or $textmassage == "نصب") {
if (in_array($from_id,$Dev)){
if ($tc == 'group' | $tc == 'supergroup'){
$add = $settings["information"]["added"];
if ($add != true) {
botevoobot('sendMessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"
✅ گروه با موفقیت به لیست پشتیبانی ربات اضافه شد
🔆ایدی گروه : [$chat_id]
🔆نام گروه : [$namegroup]
👮🏻‍♂️ برای دریافت پنل تنظیمات و راهنما دستور < پنل > را ارسال کنید 
✅ نصب رایگان انجام شد گروه $freedays روز شارژ شد .
🌟 توسط   @$username ",
'reply_to_message_id'=>$message_id,
		  	  'reply_markup'=>json_encode([
    'inline_keyboard'=>[
	  	  	 [
				 ['text'=>"⚙️ مدیریت گروه",'callback_data'=>"back"],['text'=>"🚦 راهنما",'callback_data'=>"help"]
		 ],
		            [
         ['text'=>"$nemechannel",'url'=>"https://telegram.me/$channel"]
     ],
	 ],
	   ])
 ]);  
 		        botevoobot('sendmessage',[
            'chat_id'=>$Dev[0],
            'text'=>"✅ یک گروه توسط ادمین اضافه شد

🔅ایدی گروه : [$chat_id]
🔅نام گروه : [$namegroup]
🔅توسط : [ @$username ] 
", 
        ]); 
$dateadd = date('Y-m-d', time());
$dateadd2 = isset($_GET['date']) ? $_GET['date'] : date('Y-m-d');
$next_date = date('Y-m-d', strtotime($dateadd2 ." +7 day"));
        $settings = '{"lock": {
                "text": "| غیر فعال | ❌",
                "photo": "| غیر فعال | ❌",
                "link": "| غیر فعال | ❌",
                "tag": "| غیر فعال | ❌",
				"username": "| غیر فعال | ❌",
                "sticker": "| غیر فعال | ❌",
                "video": "| غیر فعال | ❌",
                "voice": "| غیر فعال | ❌",
                "audio": "| غیر فعال | ❌",
                "gif": "| غیر فعال | ❌",
                "bot": "| غیر فعال | ❌",
                "forward": "| غیر فعال | ❌",
                "document": "| غیر فعال | ❌",
                "tgservic": "| غیر فعال | ❌",
				"edit": "| غیر فعال | ❌",
				"reply": "| غیر فعال | ❌",
				"contact": "| غیر فعال | ❌",
				"location": "| غیر فعال | ❌",
				"game": "| غیر فعال | ❌",
				"cmd": "| غیر فعال | ❌",
				"join": "| غیر فعال | ❌",
				"tabchi": "| غیر فعال | ❌",
		    	"group": "| غیر فعال | ❌",
				"mute_all": "| غیر فعال | ❌",
				"mute_all_time": "| غیر فعال | ❌",
				"fosh": "| غیر فعال | ❌",
				"lockauto": "| غیر فعال | ❌",
				"lockcharacter": "| غیر فعال | ❌",
				"url": "| غیر فعال | ❌",
				"video_msg": "| غیر فعال | ❌"
			},
			"information": {
            "added": "true",
			"welcome": "| غیر فعال | ❌",
			"add": "| غیر فعال | ❌",
			"lockchannel": "| غیر فعال | ❌",
			"hardmodebot": "| غیر فعال | ❌",
			"hardmodewarn": "سکوت کاربر ♨️",
			"charge": "'.$freedays.' روز",
			"setadd": "3",
			"dataadded": "",
			"expire": "",
			"msg": "",
			"timelock": "00:00",
			"timeunlock": "00:00",
			"pluscharacter": "300",
			"downcharacter": "0",
			"textwelcome": "خوش امدید",
			"rules": "ثبت نشده",
			"setwarn": "3"
			}
}';
        $settings = json_decode($settings,true);
		$settings["information"]["expire"]="$next_date";
		$settings["information"]["dataadded"]="$dateadd";
		$settings["information"]["msg_id"]="$message_id";
        $settings = json_encode($settings,true);
        file_put_contents("data/$chat_id.json",$settings);
$gpadd = fopen("data/group.txt",'a') or die("Unable to open file!");  
fwrite($gpadd, "نام گروه : [$namegroup] | ایدی گروه : [$chat_id]\n");
fclose($gpadd);
$user["gps"]["{$from_id}"][]="$namegroup";
        $user = json_encode($user,true);
file_put_contents("data/user.json",$user);
}
else
{
$dataadd = $settings["information"]["dataadded"];
botevoobot('sendMessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"✅ گروه قبلا در لیست گروه های پشتیبانی ربات بوده است 

🔅ایدی گروه : [$chat_id]
🔅نام گروه : [$namegroup]
🔅 تاریخ اضافه شدن گروه : [$dataadd]
",
  'reply_to_message_id'=>$message_id,
		  	  'reply_markup'=>json_encode([
    'inline_keyboard'=>[
 	[
['text'=>"$nemechannel",'url'=>"https://telegram.me/$channel"],['text'=>"$dataadd",'callback_data'=>"text"]
	  ],
   ]
   ])
     ]); 
}
}
}
}
//automatic
elseif ($textmassage == "/automatic"  or $textmassage == "automatic" or $textmassage == "اتوماتیک فعال") {
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev)){
if ($tc == 'group' | $tc == 'supergroup'){
$add = $settings["information"]["added"];
if ($add == true) {
botevoobot('sendMessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"✅ قفل ها برای مدیریت خودکار گروه فعال شدند	
💥اکنون گروه به صورت خودکار در حال مدیریت است
☀️توسط : [ @$username ]
",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
		$settings["lock"]["link"]="| فعال | ✅";
		$settings["lock"]["username"]="| فعال | ✅";
		$settings["lock"]["bot"]="| فعال | ✅";
		$settings["lock"]["forward"]="| فعال | ✅";
		$settings["lock"]["tgservices"]="| فعال | ✅";
		$settings["lock"]["contact"]="| فعال | ✅";
        $settings = json_encode($settings,true);
        file_put_contents("data/$chat_id.json",$settings);
}
else
{
botevoobot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"⚠️ توجه کنید : ربات در گروه شما نصب نیست ! لطفا ابتدا نسبت به نصب ربات اقدام کنید  ☀️
❗️ میتوانید ربات را $freedays روز رایگان فعال کنید با دستور { نصب رایگان }",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
}
}
}
}
// setwelcome
if (strpos($textmassage , "/setwelcome ") !== false or strpos($textmassage , "تنظیم خوش امد ") !== false ) {
if ($status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev)) {
$add = $settings["information"]["added"];
if ($add == true) {
$we = str_replace(['/setwelcome ','تنظیم خوش امد '],'',$textmassage);
$plus = mb_strlen("$we");
if($plus < 600) {
botevoobot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"متن خوش امد گویی با موفقیت تغییر کرد✔️
📍متن جدید خوش امد [$we]
🔖توسط : [ @$username ]",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
$settings["information"]["textwelcome"]="$we";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
	}
else
{
	botevoobot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"📍 تعداد کلمات وارد شد بیش از حد مجاز است حداکثر میتوانید 600 حرف را وارد کنید",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
}
}
else
{
botevoobot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"⚠️ توجه کنید : ربات در گروه شما نصب نیست ! لطفا ابتدا نسبت به نصب ربات اقدام کنید  ☀️
❗️ میتوانید ربات را $freedays روز رایگان فعال کنید با دستور { نصب رایگان }",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);	
}
}
}
// welcome enbale and disable
elseif ($textmassage == "/welcome enable"  or $textmassage == "welcome enable" or $textmassage == "خوش امد روشن") {
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev)) {
$add = $settings["information"]["added"];
if ($add == true) {
$text = $settings["information"]["textwelcome"];
botevoobot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"خوش امد گویی روشن شد ✅
ℹ️متن خوش امد [$text]
🔖توسط : [ @$username ]",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
$settings["information"]["welcome"]="| فعال | ✅";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
	}
else
{
botevoobot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"⚠️ توجه کنید : ربات در گروه شما نصب نیست ! لطفا ابتدا نسبت به نصب ربات اقدام کنید  ☀️
❗️ میتوانید ربات را $freedays روز رایگان فعال کنید با دستور { نصب رایگان }",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
}
}
}
elseif ($textmassage == "/welcome disable"  or $textmassage == "welcome disable" or $textmassage == "خوش امد خاموش") {
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev)) {
$add = $settings["information"]["added"];
if ($add == true) {
botevoobot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"خوش امد گویی خاموش شد✅
🔖توسط : [ @$username ]",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
$settings["information"]["welcome"]="| غیر فعال | ❌";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
	}
else
{
botevoobot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"⚠️ توجه کنید : ربات در گروه شما نصب نیست ! لطفا ابتدا نسبت به نصب ربات اقدام کنید  ☀️
❗️ میتوانید ربات را $freedays روز رایگان فعال کنید با دستور { نصب رایگان }",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
}
}
}
// report
elseif ($rt && $textmassage=="/report" or $rt && $textmassage=="report" or $rt && $textmassage=="ارسال گزارش" ) {
$lockcmd = $settings["lock"]["cmd"];
if ($lockcmd == "| غیر فعال | ❌") {
$getlink = file_get_contents("https://api.telegram.org/bot$token/exportChatInviteLink?chat_id=$chat_id");
$jsonlink = json_decode($getlink, true);
$getlinkde = $jsonlink['result'];
$up = json_decode(file_get_contents("https://api.telegram.org/bot$token/getChatAdministrators?chat_id=".$chat_id),true);
$result = $up['result'];
        botevoobot('sendmessage',[
            'chat_id'=>$chat_id,
            'text'=>"گزارش شما برای سازنده گروه ارسال شد ✅",
'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
  foreach($result as $key=>$value){
    $found = $result[$key]['status'];
    if($found == "creator"){
      $owner = $result[$key]['user']['id'];
    }
	        botevoobot('sendmessage',[
            'chat_id'=>$owner,
            'text'=>"✅ یک گزارش برای شما ارسال شد 
🔻 متن پیام گزارش شده در پیام زیر برای شما فوروارد میشود 🔻
🔖اطلاعات کابر ارسال کننده گزارش :
📍 ایدی : [ $from_id ]
📍 نام : [ $first_name ]
📍 یوزرنیم : [ @$username ]
📍 ایدی گروه : [ $chat_id ]
📍 نام گروه : [ $namegroup ]
📍 لینک گروه : [ $getlinkde  ]
🔖اطلاعات کابر خاطی :
📍 ایدی : [ $re_id ]
📍 نام : [ $re_name ]
📍 یوزرنیم : [ @$re_user ]
",
        ]);
        botevoobot('forwardMessage',[
            'chat_id'=>$owner,
            'from_chat_id'=>$chat_id,
            'message_id'=>$replyid,
        ]);
}
}
}
// support 
elseif ($textmassage=="/support" or $textmassage=="support" or $textmassage=="درخواست پشتیبانی" ) {
$lockcmd = $settings["lock"]["cmd"];
if ($lockcmd == "| غیر فعال | ❌") {
$getlink = file_get_contents("https://api.telegram.org/bot$token/exportChatInviteLink?chat_id=$chat_id");
$jsonlink = json_decode($getlink, true);
$getlinkde = $jsonlink['result'];
            botevoobot('sendmessage', [
                'chat_id' =>$Dev[0],
                'text' => "☀️ گروه : [$namegroup]
✅ درخواست پشتیبانی کرده است 
💥مشخصات فرد ارسال کننده :
📍 ایدی : [ $from_id ]
📍 نام : [ $first_name ]
📍 یوزرنیم : [ @$username ]
📍 ایدی گروه : [ $chat_id ]
📍 لینک گروه : [ $getlinkde  ]
",
            ]);
            botevoobot('sendmessage', [
                'chat_id'=>$chat_id,
                'text'=>"✅ درخواست شما به پشتیبانی ارسال شد
☀️به زودی پشتیبانی وارد گروه میشود
🔥 گروه پشتیبانی : $linkgrop
",
'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
        }
}
// hardmode
elseif($textmassage=="/modebot on" or $textmassage=="سختگیرانه ربات روشن"){
if ($status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev) ){
$add = $settings["information"]["added"];
if ($add == true) {
	botevoobot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"✅ قفل حالت سختگیرانه فعال شد
🔴 از این پس اضافه کننده ربات حذف خواهد شد .
🌟 توسط  @$username",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
$settings["information"]["hardmodebot"]="🚷 اخراج کاربر";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
}
else
{
botevoobot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"⚠️ توجه کنید : ربات در گروه شما نصب نیست ! لطفا ابتدا نسبت به نصب ربات اقدام کنید  ☀️
❗️ میتوانید ربات را $freedays روز رایگان فعال کنید با دستور { نصب رایگان }",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
	}
}
}
elseif($textmassage=="/modebot off" or $textmassage=="سختگیرانه ربات خاموش"){
if ($status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev) ){
$add = $settings["information"]["added"];
if ($add == true) {
	botevoobot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"✅ قفل حالت سختگیرانه آزاد شد
🔴 از این پس اضافه کننده ربات حذف نخواهد شد .
🌟 توسط  @$username",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
$settings["information"]["hardmodebot"]="| غیر فعال | ❌";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
}
else
{
botevoobot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"⚠️ توجه کنید : ربات در گروه شما نصب نیست ! لطفا ابتدا نسبت به نصب ربات اقدام کنید  ☀️
❗️ میتوانید ربات را $freedays روز رایگان فعال کنید با دستور { نصب رایگان }",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
	}
}
}
elseif($textmassage=="/modewarn on" or $textmassage=="سختگیرانه اخطار روشن"){
if ($status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev) ){
$add = $settings["information"]["added"];
if ($add == true) {
	botevoobot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"✅ قفل حالت سختگیرانه فعال شد
🔴 از این پس  کاربر پس از رسیدن به حداکثر اخطار اخراج میشود .
🌟 توسط  @$username",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
$settings["information"]["hardmodewarn"]="🚷 اخراج کاربر";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
}
else
{
botevoobot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"⚠️ توجه کنید : ربات در گروه شما نصب نیست ! لطفا ابتدا نسبت به نصب ربات اقدام کنید  ☀️
❗️ میتوانید ربات را $freedays روز رایگان فعال کنید با دستور { نصب رایگان }",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
	}
}
}
elseif($textmassage=="/modewarn off" or $textmassage=="سختگیرانه اخطار خاموش"){
if ($status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev) ){
$add = $settings["information"]["added"];
if ($add == true) {
	botevoobot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"✅ قفل حالت سختگیرانه آزاد شد
🔴 از این پس  کاربر پس از رسیدن به حداکثر اخطار اخراج نمیشود .
🌟 توسط  @$username",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
$settings["information"]["hardmodewarn"]="سکوت کاربر ♨️";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
}
else
{
botevoobot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"⚠️ توجه کنید : ربات در گروه شما نصب نیست ! لطفا ابتدا نسبت به نصب ربات اقدام کنید  ☀️
❗️ میتوانید ربات را $freedays روز رایگان فعال کنید با دستور { نصب رایگان }",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
	}
}
}
// نصب گروه
 if($update->message->new_chat_member){
if ($tc == "group" | $tc == "supergroup"){
if($newchatmemberid == $idbot){   
if ($add !== true){    
botevoobot('sendmessage',[  
  'chat_id'=>$chat_id,
  'text'=>"
سلام ممنونیم که ربات $botnamefو رو برای گروهتون انتخاب کردید  ❤️ 

✅ خب دوست عزیز برای اینکه $botnamefو در این گروه فعالیت داشته باشد لطفا به دستور زیر عمل کنید .

1️⃣ لطفا $botnamefو رو ادمین کنید و تمام دسترسی های $botnamefو رو فعال کنید 🌟
2️⃣ بعدش دستور < نصب رایگان > را ارسال کنید 🌟

❌ در صورتی که مشکل داشتید اطلاع دهید .
",
'reply_to_message_id'=>$message_id,
'reply_markup'=>json_encode([
    'inline_keyboard'=>[
   [  
       ['text'=>"❌ در نصب ربات مشکل دارید ؟ ",'url'=>"$linkgrop"]
     ],
        [  
       ['text'=>"$nemechannel",'url'=>"https://telegram.me/$channel"]
     ],
   ]
   ])  
  ]);
}
}
}
}
?>