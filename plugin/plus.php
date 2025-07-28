<?php
/*
Bot : Management Group pro
Dev : Factweb team
Website: Factweb.ir
Channel : @factweb
*/
// restart settings
if($textmassage=="/restart settings" or $textmassage=="restart settings" or $textmassage=="ریستارت تنظیمات"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev)) {
$add = $settings["information"]["added"];
if ($add == true) {
botevoobot('sendmessage',[
'reply_to_message_id'=>$message_id,
 'chat_id'=>$chat_id,
 'text'=>"✅ مدیر عزیز در صورت رضایت شما برای ریستارت تنظیمات بله را ارسال کنید
❌ در غیر این صورت میتوانید با ارسال خیر از درخواست خود صرف نظر کنید ",
 ]);
$settings["information"]["step"]="reset";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
}
else
{
botevoobot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"⚠️ توجه کنید : ربات در گروه شما نصب نیست ! لطفا ابتدا نسبت به نصب ربات اقدام کنید  ☀️
❗️ میتوانید ربات را $freedays روز رایکان فعال کنید با دستور { نصب رایگان }",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
	}
 }
}
// kick me
elseif($textmassage=="/kickme" or $textmassage=="kickme" or $textmassage=="اخراج من"){
$lockcmd = $settings["lock"]["cmd"];
if ($lockcmd == "| غیر فعال | ❌") {
if ( $status != 'creator' && $status != 'administrator' && !in_array($from_id,$Dev) ){
botevoobot('KickChatMember',[
    'chat_id'=>$chat_id,
    'user_id'=>$from_id
	]);
              botevoobot('sendmessage', [
                'chat_id' => $chat_id,
             'text'=>"☀️ نام : [$first_name]
☀️ یوزرنیم : [ @$username ]
☀️ ایدی : [$from_id]
✅ از گروه اخراج شد",
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
// silent
elseif($textmassage == "/silent"&& $rt or $textmassage == "silent" && $rt or $textmassage == "بیصدا" && $rt){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev)) {
if ( $statusrt != 'creator' && $statusrt != 'administrator' && !in_array($re_id,$Dev)) {
$add = $settings["information"]["added"];
if ($add == true){
   botevoobot('restrictChatMember',[
   'user_id'=>$re_id,   
   'chat_id'=>$chat_id,
   'can_post_messages'=>false,
         ]);
  botevoobot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"☀️نام : [$re_name]
☀️یوزرنیم : [ @$re_user ]
☀️ایدی : [$re_id]
👮🏻‍♂️توسط : [ @$username ]
✅ کاربر به لیست سکوت گروه اضافه شد
",
'reply_to_message_id'=>$re_msgid,
   'reply_markup'=>json_encode([
      'inline_keyboard'=>[
     [
    ['text'=>"$re_name", 'url'=>"https://telegram.me/$re_user"]
    ],
	[
	['text'=>"$nemechannel",'url'=>"https://telegram.me/$channel"]
	]
    ]
    ])
]);
$settings["silentlist"][]="$re_id";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
}
else
{
botevoobot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"⚠️ توجه کنید : ربات در گروه شما نصب نیست ! لطفا ابتدا نسبت به نصب ربات اقدام کنید  ☀️
❗️ میتوانید ربات را $freedays روز رایکان فعال کنید با دستور { نصب رایگان }",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
 }
}
else
{
botevoobot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"📍 من نمیتوانم ادمین ها , صاحبان و مدیران گروه و خود را سکوت کنم",
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
elseif (strpos($textmassage , "/silent ") !== false && $rt or strpos($textmassage , "بیصدا ") !== false && $rt) {
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev)) {
if ( $statusrt != 'creator' && $statusrt != 'administrator' && !in_array($re_id,$Dev)) {
$add = $settings["information"]["added"];
$we = str_replace(['/silent ','بیصدا '],'',$textmassage);
if ($we <= 1000 && $we >= 1){
if ($add == true) {
$weplus = $we ;
	botevoobot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"
☀️نام : [$re_name]
☀️یوزرنیم : [ @$re_user ]
☀️ایدی : [$re_id]
☀️زمان محدودیت : $we دقیقه
👮🏻‍♂️توسط : [ @$username ]
کاربر به لیست سکوت گروه اضافه شد✅
",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
    botevoobot('restrictChatMember',[
   'user_id'=>$re_id,   
   'chat_id'=>$chat_id,
   'can_post_messages'=>false,
   'until_date'=>time()+$weplus*60,
         ]);
$settings["silentlist"][]="$re_id";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
}
else
{
botevoobot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"⚠️ توجه کنید : ربات در گروه شما نصب نیست ! لطفا ابتدا نسبت به نصب ربات اقدام کنید  ☀️
❗️ میتوانید ربات را $freedays روز رایکان فعال کنید با دستور { نصب رایگان }",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
}
}
else
{
botevoobot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"حطا⚠️
➖➖➖➖➖➖
عدد وارد شده باید بین 1 تا 100 باشد",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
}
}
else
{
botevoobot('sendmessage',[
 'chat_id' => $chat_id,
 'text'=>"📍 من نمیتوانم ادمین ها , صاحبان و مدیران گروه و خود را سکوت کنم",
'reply_markup'=>$inlinebutton,
   ]);
}
}
}
elseif($textmassage == "/unsilent" && $rt or $textmassage == "unsilent" && $rt or $textmassage == "باصدا" && $rt){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev) ) {
$add = $settings["information"]["added"];
if ($add == true) {
 botevoobot('restrictChatMember',[
   'user_id'=>$re_id,   
   'chat_id'=>$chat_id,
   'can_post_messages'=>true,
   'can_add_web_page_previews'=>false,
   'can_send_other_messages'=>true,
   'can_send_media_messages'=>true,
         ]);
  botevoobot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"☀️نام : [$re_name]
☀️یوزرنیم : [ @$re_user ]
☀️ایدی : [$re_id]
👮🏻‍♂️توسط : [ @$username ]
✅کاربر از لیست سکوت گروه حذف شد
",
'reply_to_message_id'=>$re_msgid,
 
   'reply_markup'=>json_encode([
      'inline_keyboard'=>[
     [
    ['text'=>"$re_name", 'url'=>"https://telegram.me/$re_user"]
    ],
	[
	['text'=>"$nemechannel",'url'=>"https://telegram.me/$channel"]
	]
    ]
    ])
]);
$key = array_search($re_id,$settings["silentlist"]);
unset($settings["silentlist"][$key]);
$settings["silentlist"] = array_values($settings["silentlist"]); 
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
}
else
{
botevoobot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"⚠️ توجه کنید : ربات در گروه شما نصب نیست ! لطفا ابتدا نسبت به نصب ربات اقدام کنید  ☀️
❗️ میتوانید ربات را $freedays روز رایکان فعال کنید با دستور { نصب رایگان }",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
}
}
}
elseif($textmassage == "/list silent"  or $textmassage == "list silent" or $textmassage == "لیست سکوت") {
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev)) {
$silent = $settings["silentlist"];
for($z = 0;$z <= count($silent)-1;$z++){
$result = $result.$silent[$z]."\n";
}
	  botevoobot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"🔖لیست کابران ساکت گروه : 

$result
🔸🔹🔸🔹🔸🔹",
'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
}
}
elseif($textmassage == "/clean silentlist"  or $textmassage == "clean silentlist" or $textmassage == "حذف لیست سکوت") {
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev)) {
$add = $settings["information"]["added"];
if ($add == true) {
$silent = $settings["silentlist"];
for($z = 0;$z <= count($silent)-1;$z++){
 botevoobot('restrictChatMember',[
   'user_id'=>$silent[$z],   
   'chat_id'=>$chat_id,
   'can_post_messages'=>true,
   'can_add_web_page_previews'=>false,
   'can_send_other_messages'=>true,
   'can_send_media_messages'=>true,
         ]);
}
	  botevoobot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"✅ لیست کابران ساکت گروه با موفقیت پاکسازی شد",
'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
unset($settings["silentlist"]);
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
}
else
{
botevoobot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"⚠️ توجه کنید : ربات در گروه شما نصب نیست ! لطفا ابتدا نسبت به نصب ربات اقدام کنید  ☀️
❗️ میتوانید ربات را $freedays روز رایکان فعال کنید با دستور { نصب رایگان }",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
}
}
}
// promote
elseif($textmassage=="/promote" or $textmassage=="promote" or $textmassage=="ترفیع"){
if ( $status == 'creator' or in_array($from_id,$Dev)) {
botevoobot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"☀️نام : [$re_name]
☀️یوزرنیم : [ @$re_user ]
☀️ایدی: [$re_id] 
👮🏻‍♂️توسط : [ @$username ]
✅کاربر با موفقیت مدیر گروه شد
",
'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
 botevoobot('promoteChatMember',[
 'chat_id'=>$chat_id,
  'user_id'=>$re_id,
 'can_change_info'=>True,
  'can_delete_messages'=>True,
  'can_invite_users'=>True,
  'can_restrict_members'=>True,
  'can_pin_messages'=>True,
  'can_promote_members'=>false
]);
	}
}
elseif($textmassage=="/demote" or $textmassage=="demote" or $textmassage=="تنزل"){
if ( $status == 'creator' or in_array($from_id,$Dev)) {
botevoobot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"☀️نام : [$re_name]
☀️یوزرنیم : [ @$re_user ]
☀️ایدی: [$re_id] 
👮🏻‍♂️توسط : [ @$username ]
✅کاربر با موفقیت تنزل مقام پیدا کرد
",
'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
 botevoobot('restrictChatMember',[
   'user_id'=>$re_id,   
   'chat_id'=>$chat_id,
   'can_post_messages'=>true,
   'can_add_web_page_previews'=>false,
   'can_send_other_messages'=>true,
   'can_send_media_messages'=>true,
         ]);
	}
}
// admin list
elseif($textmassage=="/admin list" or $textmassage=="admin list" or $textmassage=="لیست ادمین"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev)) {
  $up = json_decode(file_get_contents("https://api.telegram.org/bot$token/getChatAdministrators?chat_id=".$chat_id),true);
  $result = $up['result'];
  foreach($result as $key=>$value){
    $found = $result[$key]['status'];
    if($found == "creator"){
      $owner = $result[$key]['user']['id'];
	  $owner2 = $result[$key]['user']['username'];
    }
if($found == "administrator"){
if($result[$key]['user']['first_name'] == true){
$innames = str_replace(['[',']'],'',$result[$key]['user']['first_name']);
$msg = $msg."\n"."📍"."[{$innames}](tg://user?id={$result[$key]['user']['id']})";
}
  }
		 }
botevoobot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"📍 سازنده گروه : $owner | @$owner2 🌟
➖➖➖
👮🏻 لیست ادمین های گروه :
$msg",
'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
'parse_mode'=>"MarkDown",
 ]);
	}
}
  // text callback
elseif ($data == 'text'){
botevoobot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"امکان تغییر این بخش وجود ندارد ⚠️",
]);
}
?>