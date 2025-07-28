<?php
include("jdf.php");
/*
Bot : Management Group pro
Dev : Factweb team
Website: Factweb.ir
Channel : @factweb
*/
// panel admin
if($textmassage=="/panel admin" or $textmassage=="panel admin" or $textmassage=="panel"  or $textmassage=="/panel"  or $textmassage=="پنل مدیریت"){
if ($tc == "private") {
if (in_array($from_id,$Dev)) {
botevoobot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"🔥 ادمین عزیز به پنل مدریت ربات $botnamef خوش آمدید

لطفا از دکمه های زیر برای مدیریت گروه ها  استفاده کنید✅",
         'reply_to_message_id'=>$message_id,
	  'reply_markup'=>json_encode([
    'keyboard'=>[
        	[
	  	['text'=>"👥 مدیریت گروه ها"],['text'=>"👨🏻‍💼 مدیریت کاربران"] 
	  ],
	[
	['text'=>"🔥 راهنما مدیریتی"],	['text'=>"👮🏻‍♂️ مدیریت کلی"]
	],
		 	  	  	 [
					 ['text'=>"🔙 برگشت"]                            
		 ],
   ],
      'resize_keyboard'=>true
   ])
 ]);
}
}
}
elseif ($textmassage == '🎁 ساخت کد هدیه' && in_array($from_id,$Dev)) {
         botevoobot('sendmessage',[
          'chat_id'=>$chat_id,
          'text'=>"لطفا کد رو بده 🚀",
    'reply_to_message_id'=>$message_id,
     'reply_markup'=>json_encode([
    'keyboard'=>[
  [
  ['text'=>"🔙 برگشت"] 
  ]
   ],
      'resize_keyboard'=>true
   ])
 ]);
$user["userjop"]["$from_id"]["file"]="code-h";
$user = json_encode($user,true);
file_put_contents("data/user.json",$user);
}
elseif ($user["userjop"]["$from_id"]["file"] == 'code-h') {
$ch = $idchannel;
$h =  jdate('G:i:s');
$l = jdate('Y/n/j');
$user["code"]="$textmassage";    
$user["userjop"]["$from_id"]["file"]="none";
$user = json_encode($user,true);
file_put_contents("data/user.json",$user);  
if ($textmassage != "لطفا کد رو ارسال کنید ✅") {
         botevoobot('sendmessage',[
          'chat_id'=>$chat_id,
          'text'=>"کد هدیه ساخته شد 😍",
        'reply_to_message_id'=>$message_id,
 ]);
  botevoobot('sendmessage',[
        'chat_id'=>$chat_id,
        'text'=>"
✅ ارسال شد
",
    ]);
}
 botevoobot('sendphoto',[
  'chat_id'=>$ch,
  'photo'=>new CURLFile("other/cod1.jpg"),
  'caption'=>"🎁 کارت شارژ جدید 🎈

( 📅 $l) ( ⏱ $h)

🛑 کد : $textmassage 🥰

^ فقط برای یک گروه در اولین فرصت ^

[👥 اگه اشتراک ندارید بعد از کلیک روی این متن، گروه مورد نظرتون رو برای تهیه اشتراک انتخاب و تایید کنید](https://t.me/$usernamebot?startgroup=new)
➖➖➖➖➖➖➖➖
با $botnamef بهترین باشید ❤️
  ",
  'parse_mode'=>'MarkDown',
'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
                                  [
      ['text'=>"آموزش استفاده 🤔",'callback_data'=>"use"]
      ],
           [
      ['text'=>"✅ بردن ربات به گروه",'url'=>"https://t.me/$usernamebot?startgroup=new"]
      ],
                     ]
               ])
            ]);
}
  elseif($data == "use"){
            botevoobot('answercallbackquery',['callback_query_id'=>$update->callback_query->id,'text'=>"
🎁 داخل گروه کلمه { کد رایگان } رو ارسال کنید
🔥 بعد کد رو ارسال کنید توی گروه
🌟 گروهتون شارژ میشه به همین راحتی
✅ با $botnamef بهترین باشید 😃🖐🏻
",'show_alert'=>true,
        ]);
        }
elseif($textmassage=="✅ شارژ گروه"){
if (in_array($from_id,$Dev)) {
				botevoobot('sendmessage',[
		'chat_id'=>$chat_id,
		'text'=>"
🎀 جهت شارژ گروهی لطفا به صورت زیر عمل کنید
✅ ارسال شارژ  Idgroup

مثال : ارسال شارژ -1001073837688
",
                'hide_keyboard'=>true,
		]);
		}
}

elseif($textmassage=="🔥 راهنما مدیریتی"){
if (in_array($from_id,$Dev)) {
				botevoobot('sendmessage',[
		'chat_id'=>$chat_id,
		'text'=>"
🔸پنل مدیریت
💭دریافت پنل مدیریت ربات و ارسال پیام به گروه ها و ممبر ها

🔹مدیریت گروه ها
💭دریافت پنل مدیریت گروه های ربات

🔹مدیریت  کاربران
💭دریافت پنل مدیریت کاربر های ربات

🔹آمار و ارسالی  
💭دریافت پنل مدیریت آمار و ارسالی های ربات

🔸ترک
💭خروج ربات از گروه

🔹حذف
💭حدف گروه از لیست گروه های پشتیبانی

🔸نصب
💭اضافه کردن گروه به لیست گروه های پشتیبانی

🔹تنظیم شارژ
💭تنظیم شارژ برای گروه مورد نظر

🔸ارسال شارژ [ایدی گروه]
💭فعال سازی شارژ برای گروه مورد نظر به مدت 30 روز

🔹ترک [ایدی گروه]
💭ترک ربات از گروه مورد نظر

🔸 مسدود همگانی [ایدی]
💭 مسدود کردن فرد هم از پیوی و هم از تمام گروه های ربات

🔹 ازاد همگانی [ایدی]
💭 خارج کردن فرد از لیست مسدودت همگانی

🔸 لیست مسدود همگانی
💭 مشاهده لیست مسدود همگانی ربات

/panel admin
💭دریافت پنل مدیریت ربات و ارسال پیام به گروه ها و ممبر ها

/panel group
💭دریافت پنل مدیریت گروه های ربات

/panel karbar
💭دریافت پنل مدیریت کاربر های ربات

/panel amar
💭دریافت پنل مدیریت کاربر های ربات

/leave
💭خروج ربات از گروه

/rem
💭حدف گروه از لیست گروه های پشتیبانی

/add
💭اضافه کردن گروه به لیست گروه های پشتیبانی

/charge
💭تنظیم شارژ برای گروه مورد نظر

/sendcharge [ایدی گروه]
💭فعال سازی شارژ برای گروه مورد نظر به مدت 30 روز

/left [ایدی گروه]
💭ترک ربات از گروه مورد نظر

/banall [ایدی]
💭 مسدود کردن فرد هم از پیوی و هم از تمام گروه های ربات

/unbanall [ایدی]
💭 خارج کردن فرد از لیست مسدودت همگانی

/banlist
💭 مشاهده لیست مسدود همگانی ربات

",
                'hide_keyboard'=>true,
		]);
		}
}
elseif($textmassage=="👮🏻‍♂️ مدیریت کلی" or $textmassage=="مدیریت کلی" or $textmassage=="/panel koli"){
if ($tc == "private") {
if (in_array($from_id,$Dev)) {
botevoobot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"
🚦ادمین عزیز به پنل مدیریت آمار و ارسالی خوش آمدید

لطفا از دکمه های زیر برای آمار و ارسالی استفاده کنید✅
",
         'reply_to_message_id'=>$message_id,
	  'reply_markup'=>json_encode([
    'keyboard'=>[
        	  [
	      ['text'=>"💥 امار ربات"],['text'=>"🎁 ساخت کد هدیه"]
	      ],
	      [['text'=>"♻️ تنظیم متن شروع ربات"],['text'=>"🕐 تغییر روزهای رایگان"]],
	[
	['text'=>"پنل مدیریت"] 
	]
   ],
      'resize_keyboard'=>true
   ])
 ]);
}
}
}
//--------------------------------------
elseif($textmassage=="♻️ تنظیم متن شروع ربات" ){
if ($tc == "private") {
if (in_array($from_id,$Dev)) {
botevoobot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"🔹 متن شروع ربات  را ارسال کنید؛

🔻 متن پیشفرض هم اکنون :
<code>
$startbot6
</code>
➖➖➖➖➖➖➖➖➖
@$usernamebot",
'parse_mode'=>'HTML',
  'reply_to_message_id'=>$message_id,
  	   'reply_markup'=>json_encode([
    'keyboard'=>[
	[
	['text'=>"🔙 برگشت"] 
	]
   ],

      'resize_keyboard'=>true,
   
   ])
  ]);
  $user["userjop"]["$from_id"]["file"]="startbot";
$user = json_encode($user,true);
file_put_contents("data/user.json",$user);
}
}
}
//---------------------------------------------
elseif($textmassage=="🕐 تغییر روزهای رایگان" ){
if ($tc == "private") {
if (in_array($from_id,$Dev)) {
botevoobot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"🔹 تعداد روزهای نصب رایگان  را ارسال کنید؛

🔻  تعداد روزها هم اکنون :
<code>
$freedays
</code>
➖➖➖➖➖➖➖➖➖
@$usernamebot",
'parse_mode'=>'HTML',
  'reply_to_message_id'=>$message_id,
  	   'reply_markup'=>json_encode([
    'keyboard'=>[
	[['text'=>"🔙 برگشت"] ,['text'=>"1"] ,['text'=>"2"],['text'=>"3"],['text'=>"4"]	],
[['text'=>"5"] ,['text'=>"6"] ,['text'=>"7"],['text'=>"8"],['text'=>"9"],['text'=>"10"],['text'=>"11"]	],
[['text'=>"12"] ,['text'=>"13"] ,['text'=>"14"],['text'=>"15"],['text'=>"16"],['text'=>"17"],['text'=>"18"]	],
[['text'=>"19"] ,['text'=>"20"] ,['text'=>"21"],['text'=>"22"],['text'=>"23"],['text'=>"24"],['text'=>"25"]	],
[['text'=>"26"] ,['text'=>"27"] ,['text'=>"28"],['text'=>"29"],['text'=>"30"],['text'=>"31"],['text'=>"32"]	],
[['text'=>"33"] ,['text'=>"34"] ,['text'=>"35"],['text'=>"36"],['text'=>"37"],['text'=>"38"],['text'=>"39"],['text'=>"40"]],

   ],

      'resize_keyboard'=>true,
   
   ])
  ]);
  $user["userjop"]["$from_id"]["file"]="freedaysme";
$user = json_encode($user,true);
file_put_contents("data/user.json",$user);
}
}
}
//---------------------------------------
elseif($textmassage=="👨🏻‍💼 مدیریت کاربران" or $textmassage=="مدیریت کاربران" or $textmassage=="/panel karbar"){
if ($tc == "private") {
if (in_array($from_id,$Dev)) {
botevoobot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"🚦ادمین عزیز به پنل مدیریت کاربران خوش آمدید

لطفا از دکمه های زیر برای مدیریت کاربران استفاده کنید✅",
         'reply_to_message_id'=>$message_id,
	  'reply_markup'=>json_encode([
    'keyboard'=>[
 	[
	  	['text'=>"👤 ارسال به کابران"],['text'=>"📍 فوروارد به کاربران"]
	  ],
	[
	['text'=>"پنل مدیریت"] 
	]
   ],
      'resize_keyboard'=>true
   ])
 ]);
}
}
}
elseif($textmassage=="👥 مدیریت گروه ها" or $textmassage=="مدیریت گروه ها" or $textmassage=="/panel group"){
if ($tc == "private") {
if (in_array($from_id,$Dev)) {
botevoobot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"🚦ادمین عزیز به پنل مدیریت گروه ها خوش آمدید

لطفا از دکمه های زیر برای مدیریت گروه ها  استفاده کنید✅",
         'reply_to_message_id'=>$message_id,
	  'reply_markup'=>json_encode([
    'keyboard'=>[
	[
	['text'=>"📜 لیست گروه ها"]
	],
		[
	['text'=>"📢 متن تبلیغات در گروه ها"]
	],
		[
	['text'=>"📌 فوروارد به گروه"],['text'=>"🔅 ارسال به گروه ها"]
	],
			[
	['text'=>"✅ شارژ گروه"],['text'=>"❗️ خروج ربات از گروه"]
	],
	[
	['text'=>"پنل مدیریت"] 
	]
   ],
      'resize_keyboard'=>true
   ])
 ]);
}
}
}
//--------------------------------------
elseif($textmassage=="📢 متن تبلیغات در گروه ها" ){
$bib = file_get_contents("data/group.txt");    
if ($tc == "private") {
if (in_array($from_id,$Dev)) {
botevoobot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"🔹 متن تبلیغاتی خود را ارسال کنید؛

🔻 متن تبلیغی هم اکنون :
<code>
$adsbot6
</code>
➖➖➖➖➖➖➖➖➖
@$usernamebot",
'parse_mode'=>'HTML',
  'reply_to_message_id'=>$message_id,
  	   'reply_markup'=>json_encode([
    'keyboard'=>[
	[
	['text'=>"🔙 برگشت"] 
	]
   ],

      'resize_keyboard'=>true,
   
   ])
  ]);
  $user["userjop"]["$from_id"]["file"]="adsusers";
$user = json_encode($user,true);
file_put_contents("data/user.json",$user);
}
}
}
//---------------------------------------
elseif($textmassage=="📜 لیست گروه ها" ){
$bib = file_get_contents("data/group.txt");    
if ($tc == "private") {
if (in_array($from_id,$Dev)) {
botevoobot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"$bib",
  'reply_to_message_id'=>$message_id,
  ]);
}
}
}
elseif($textmassage=="📜  لیست سودو" ){
$bib = file_get_contents("sudo.txt");    
if ($tc == "private") {
if (in_array($from_id,$Dev)) {
botevoobot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"$bib",
  'reply_to_message_id'=>$message_id,
  ]);
}
}
}
elseif($textmassage=="❌ پاک کردن سودو" ){
if ($tc == "private") {
if (in_array($from_id,$Dev)) {
botevoobot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"
🛑 جهت اضافه کردن مدیر جدید لطفا به صورت زیر ارسال کنید
➖➖➖
✅  remsudoID استفاده کنید
➖➖➖➖
🔆 مثال : setsudo00000000
",
'reply_to_message_id'=>$message_id,
 ]);
}
}
}
elseif($textmassage=="✅ اضافه کردن سودو" ){
if ($tc == "private") {
if (in_array($from_id,$Dev)) {
botevoobot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"
🛑 جهت حذف کردن مدیر لطفا به صورت زیر ارسال کنید
➖➖➖
✅ setsudoID استفاده کنید
➖➖➖➖
🔆 مثال : setsudo00000000
",
'reply_to_message_id'=>$message_id,
 ]);
}
}
}
elseif($textmassage=="❗️ خروج ربات از گروه" ){
if ($tc == "private") {
if (in_array($from_id,$Dev)) {
botevoobot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"📍 ادمین عزیز جهت خروج ربات ار گروه مورد نظر میتوانید از دستور :
➖➖➖
/left [ایدی گروه]
یا

ترک [ایدی گروه]

استفاده کنید ✅
➖➖➖➖
مثال : left -1001073837688/",
'reply_to_message_id'=>$message_id,
 ]);
}
}
}
elseif(strpos($textmassage , "ترک " ) !== false or strpos($textmassage , "/left " ) !== false) {
$text = str_replace(['/left ','ترک '],'',$textmassage);
if ($tc == "private") {
if (in_array($from_id,$Dev)) {
botevoobot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"🤖ربات از گروه با ایدی :

$text

خارج شد ✅",
  ]);
botevoobot('LeaveChat',[
  'chat_id'=>$text,
  ]);
unlink("data/$text.json");
}
}
}
elseif($textmassage=="💥 امار ربات"){
if (in_array($from_id,$Dev)) {
$h =  jdate('G:i:s');
$l = jdate('Y/n/j');
$users = count($user["userlist"]);
$group = count($user["grouplist"]);
				botevoobot('sendmessage',[
		'chat_id'=>$chat_id,
		'text'=>"
📍آمار کلی ربات $botnamef در ساعت $h و در تاریخ  $l

🔷 آمار کلی کاربران: $users
⏳ آمار کلی گروه ها: $group
",
                'hide_keyboard'=>true,
		]);
		}
}
elseif ($textmassage == '👤 ارسال به کابران' && in_array($from_id,$Dev)) {
         botevoobot('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"لطفا متن خود را ارسال کنید 🚀",
	  'reply_to_message_id'=>$message_id,
	   'reply_markup'=>json_encode([
    'keyboard'=>[
	[
	['text'=>"🔙 برگشت"] 
	]
   ],
      'resize_keyboard'=>true
   ])
 ]);
$user["userjop"]["$from_id"]["file"]="senduser";
$user = json_encode($user,true);
file_put_contents("data/user.json",$user);
}
elseif ($textmassage == '🔅 ارسال به گروه ها' && in_array($from_id,$Dev)) {
         botevoobot('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"لطفا متن خود را ارسال کنید 🚀",
	  'reply_to_message_id'=>$message_id,
	   'reply_markup'=>json_encode([
    'keyboard'=>[
	[
	['text'=>"🔙 برگشت"] 
	]
   ],
      'resize_keyboard'=>true
   ])
 ]);
$user["userjop"]["$from_id"]["file"]="sendgroup";
$user = json_encode($user,true);
file_put_contents("data/user.json",$user);
}
elseif ($textmassage == '📌 فوروارد به گروه' && in_array($from_id,$Dev)) {
         botevoobot('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"لطفا متن خود را ارسال کنید 🚀",
	  'reply_to_message_id'=>$message_id,
	   'reply_markup'=>json_encode([
    'keyboard'=>[
	[
	['text'=>"🔙 برگشت"] 
	]
   ],
      'resize_keyboard'=>true
   ])
 ]);
$user["userjop"]["$from_id"]["file"]="forwardgroup";
$user = json_encode($user,true);
file_put_contents("data/user.json",$user);
}
elseif ($textmassage == '📍 فوروارد به کاربران' && in_array($from_id,$Dev)) {
         botevoobot('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"لطفا متن خود را فوروارد کنید 🚀",
				  'reply_to_message_id'=>$message_id,
				   'reply_markup'=>json_encode([
    'keyboard'=>[
	[
	['text'=>"🔙 برگشت"] 
	]
   ],
      'resize_keyboard'=>true
   ])
    		]);
$user["userjop"]["$from_id"]["file"]="forwarduser";
$user = json_encode($user,true);
file_put_contents("data/user.json",$user);
}
// banall
elseif (strpos($textmassage , "/banall ") !== false or strpos($textmassage , "مسدود همگانی ") !== false) {
if (in_array($from_id,$Dev)) {
$text = str_replace(['/banall ','مسدود همگانی '],'',$textmassage);
$stat = file_get_contents("https://api.telegram.org/bot$token/getChatMember?chat_id=$text&user_id=".$text);
$statjson = json_decode($stat, true);
$name = $statjson['result']['user']['first_name'];
$username = $statjson['result']['user']['username'];
$id = $statjson['result']['user']['id'];
botevoobot('sendmessage',[
            'chat_id'=>$chat_id,
            'text'=>"⛔️ فرد مسدود همگانی شد
			
🔖 اطلاعات کاربر :			
📮 نام : [$name]
🔹 یوزرنیم : [ @$username ]
🔸 ایدی : [$id]",
    'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
$user["banlist"][]="$text";
$user = json_encode($user,true);
file_put_contents("data/user.json",$user);
}
}
elseif (strpos($textmassage , "/unbanall ") !== false or strpos($textmassage , "ازاد همگانی ") !== false) {
if (in_array($from_id,$Dev)) {
$text = str_replace(['/unbanall ','ازاد همگانی '],'',$textmassage);
$stat = file_get_contents("https://api.telegram.org/bot$token/getChatMember?chat_id=$text&user_id=".$text);
$statjson = json_decode($stat, true);
$name = $statjson['result']['user']['first_name'];
$username = $statjson['result']['user']['username'];
$id = $statjson['result']['user']['id'];
botevoobot('sendmessage',[
            'chat_id'=>$chat_id,
            'text'=>"فرد از مسدودیت همگانی ازاد شد ✅
			
🔖 اطلاعات کاربر :			
📮 نام : [$name]
🔹 یوزرنیم : [ @$username ]
🔸 ایدی : [$id]",
    'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
$key = array_search($text,$user["banlist"]);
unset($user["banlist"][$key]);
$user["banlist"] = array_values($user["banlist"]); 
$user = json_encode($user,true);
file_put_contents("data/user.json",$user);
}
}
elseif($textmassage == "/banlist"  or $textmassage == "banlist" or $textmassage == "لیست مسدود همگانی") {
if ( in_array($from_id,$Dev)) {
$silent = $user["banlist"];
for($z = 0;$z <= count($silent)-1;$z++){
$result = $result.$silent[$z]."\n";
}
	  botevoobot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"🔖 لیست مسدود همگانی : 
➖➖➖➖➖

$result
🔸🔹🔸🔹🔸🔹",
'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
}
}
// lock character
// lock photo
elseif($textmassage=="/lock character" or $textmassage=="قفل کاراکتر"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev) ){
$add = $settings["information"]["added"];
if ($add == true) {	
$pluscharacter = $settings["information"]["pluscharacter"];
$downcharacter = $settings["information"]["downcharacter"];
	botevoobot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"☆》قفل کاراکتر #پیام فعال شد🔇\n➖➖➖➖➖➖➖\nℹ️قفل کاراکتر فعال شد  از این پس متن ارسال توسط کاربران باید بیش تر از $pluscharacter و کم تر از $downcharacter باشد\nتوسط ☆> [ @$username ]",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
$settings["lock"]["lockcharacter"]="| فعال | ✅";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
}
else
{
botevoobot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"📍 ربات در گروه شما نصب نیست ! لطفا ابتدا نسبت به نصب ربات اقدام کنید 

ℹ️ با دستور /addfree میتوانید ربات را $freedays روز رایگان فعال کنید ",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
	}
}
}
elseif($textmassage=="/unlock character" or $textmassage=="بازکردن کاراکتر"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev) ){
$add = $settings["information"]["added"];
if ($add == true) {
	botevoobot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"☆》قفل کاراکتر #پیام غیر فعال شد🔊\n➖➖➖➖➖➖➖\nℹ️پاک کردن کاراکتر غیر فعال شد و  محدودیتی دیگر در پیام ارسالی وجود ندارد\nتوسط ☆> [ @$username ]",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
$settings["lock"]["lockcharacter"]="| غیر فعال | ❌";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
}
else
{
botevoobot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"📍 ربات در گروه شما نصب نیست ! لطفا ابتدا نسبت به نصب ربات اقدام کنید 

ℹ️ با دستور /addfree میتوانید ربات را $freedays روز رایگان فعال کنید ",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
	}
}
}
elseif (strpos($textmassage , "/setlockcharacter ") !== false or strpos($textmassage , "تنظیم کاراکتر ") !== false) {
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev) ) {
	$num = str_replace(['/setlockcharacter ','تنظیم کاراکتر '],'',$textmassage);
$add = $settings["information"]["added"];
if ($add == true) {
$te = explode(" ",$num);
$startlock = $te[0];
$endlock = $te[1];
			  botevoobot('sendmessage',[
            'chat_id'=>$chat_id,
            'text'=>"☆》قفل کاراکتر پیام تنظیم شد🔇\n➖➖➖➖➖➖➖
ℹ️محدودیت در پیام های ارسالی به شکل زیر است :

🖍حداقل تعداد کاراکتر پیام : $startlock
🖌حداکثر تعداد کراکتر پیام : $endlock\n➖➖➖➖\nتوسط ☆> [ @$username ]",
'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
   ]);
$settings["information"]["downcharacter"]="$startlock";
$settings["information"]["pluscharacter"]="$endlock";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings); 
}
else
{
botevoobot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"📍 ربات در گروه شما نصب نیست ! لطفا ابتدا نسبت به نصب ربات اقدام کنید 

ℹ️ با دستور /addfree میتوانید ربات را $freedays روز رایگان فعال کنید ",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
}
}
}
// setsudo
elseif(strpos($textmassage , "setsudo ") !== false && $from_id == $admin){
$id = str_replace(['setsudo '],'',$textmassage);    
  $sudo = file_get_contents('sudo.txt');
    $sudos = explode("\n",$sudo);
    if (!in_array($id,$sudos)){
      $add_user = file_get_contents('sudo.txt');
      $add_user .= $id."\n";
     file_put_contents('sudo.txt',$add_user);
     botevoobot('sendMessage',[ 
         'chat_id'=>$chat_id, 
         'text'=>"✅ کاربر $id به لیست سودو اضافه شد",
         ]);  
    }
}
elseif(strpos($textmassage , "remsudo ") !== false && $from_id == $admin){
$id = str_replace(['remsudo '],'',$textmassage);    
 $sudo = file_get_contents('sudo.txt');
      $sudos = explode("\n",$sudo);
      if (in_array($id,$sudos)){
      $rem_user = file_get_contents('sudo.txt');
      $rem_user = str_replace($id."\n","",$rem_user);
      file_put_contents('sudo.txt',$rem_user);
     botevoobot('sendMessage',[ 
         'chat_id'=>$chat_id, 
         'text'=>"❌ کاربر $id از لیست سودو حذف شد",
         ]);  
    }
}
/*
Bot : Management Group pro
Dev : Factweb team
Website: Factweb.ir
Channel : @factweb
*/
?>