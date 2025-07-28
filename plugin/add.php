<?php
// add kon and dell msg
if($textmassage == "/add on" or $textmassage == "add on" or $textmassage == "دعوت روشن"){
if ($tc == 'group' | $tc == 'supergroup'){  
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev)){
$add = $settings["information"]["added"];
if ($add == true) {
$setadd = $settings["information"]["setadd"];
 botevoobot('sendMessage',[
    'chat_id'=>$chat_id,
    'text'=>"
🌟 قفل اد اجباری در گروه فعال شد .
✅  از این پس هر کاربر برای چت کردن در گروه باید $setadd را به گروه دعوت کند تا توانایی چت کردن را داشته باشد .
☀️ فعال شد توسط [ @$username ]
    ",
		 'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
   ]);
$settings["information"]["add"]="| فعال | ✅";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
   } 
else
{
botevoobot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"⚠️ توجه کنید : ربات در گروه شما نصب نیست ! لطفا ابتدا نسبت به نصب ربات اقدام کنید  ☀️
❗️ میتوانید ربات را $freedays روز رایکان فعال کنید با دستور { نصب رایگان } ",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
	}   
}
	}
}
elseif($textmassage == "/add off" or $textmassage == "add off" or $textmassage == "دعوت خاموش"){
if ($tc == 'group' | $tc == 'supergroup'){  
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev)){
$add = $settings["information"]["added"];
if ($add == true) {
$setadd = $settings["information"]["setadd"];
 botevoobot('sendMessage',[
    'chat_id'=>$chat_id,
    'text'=>"
❌ قفل اد اجباری در گروه غیرفعال شد .
✅  از این پس لازم نیست کاربران برای چت کردن در گروه کاربر دیگر را اد کنند .
☀️ فعال شد توسط [ @$username ]
    ",
		 'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
   ]);
$settings["information"]["add"]="| غیر فعال | ❌";
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
}
elseif (strpos($textmassage , '/setadd ') !== false or strpos($textmassage , 'تنظیم دعوت ') !== false ) {
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev)){
$add = $settings["information"]["added"];
if ($add == true) {
$code = str_replace(['/setadd ','تنظیم دعوت '],'',$textmassage);
if($code <= 20 && $code >= 1){
 botevoobot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"
✅ تعداد افرادی که توسط اعضای گروه باید دعوت شوند تغییر کرد.
📊 تعداد اعضای دعوت : $code
☀️ فعال شد توسط [ @$username ]
",
'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
   ]);
$settings["information"]["setadd"]="$code";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
   } 
else
{
botevoobot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"📍 عدد وارد شده بین 1 تا 20 باید باشد",
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
❗️ میتوانید ربات را $freedays روز رایکان فعال کنید با دستور { نصب رایگان }",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);   
}	   
}
}
elseif($data=="addbzn"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$Dev)){
$add = $settings2["information"]["add"];
$setadd = $settings2["information"]["setadd"];
          botevoobot('editmessagetext',[
              'chat_id'=>$chatid,
   'message_id'=>$messageid,
             'text'=>"به بخش تنظیمات ادد اجباری خوش آمدید🍃
🔻از دکمه های زیر استفاده کنید",
             'reply_markup'=>json_encode([
                 'inline_keyboard'=>[
    [
                     ['text'=>"👥 ادد اجباری",'callback_data'=>'text'],['text'=>"$add",'callback_data'=>'lockadd']
					 ],
					 [
					 ['text'=>"🚸 میزان دعوت",'callback_data'=>'text'],['text'=>"🔸 $setadd 🔹",'callback_data'=>'text']
					 ],
					 [
					 ['text'=>"➕ ",'callback_data'=>'add+'],['text'=>"➖",'callback_data'=>'add-']
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
		elseif($data=="lockadd" && $settings2["information"]["add"] == "| فعال | ✅"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$Dev)){
$setadd = $settings2["information"]["setadd"];
          botevoobot('editmessagetext',[
              'chat_id'=>$chatid,
   'message_id'=>$messageid,
             'text'=>"به بخش تنظیمات ادد اجباری خوش آمدید🍃
✅ادد اجباری خاموش شد",
             'reply_markup'=>json_encode([
                 'inline_keyboard'=>[
    [
                     ['text'=>"👥 ادد اجباری",'callback_data'=>'text'],['text'=>"| غیر فعال | ❌",'callback_data'=>'lockadd']
					 ],
					 [
					 ['text'=>"🚸 میزان دعوت",'callback_data'=>'text'],['text'=>"🔸 $setadd 🔹",'callback_data'=>'text']
					 ],
					 [
					 ['text'=>"➕ ",'callback_data'=>'add+'],['text'=>"➖",'callback_data'=>'add-']
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
$settings2["information"]["add"]="| غیر فعال | ❌";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
	}else{
			botevoobot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"شما مدیر ربات نیستید ⚠️",
]);
	}
		  }
		  		elseif($data=="lockadd" && $settings2["information"]["add"] == "| غیر فعال | ❌"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$Dev)){
$setadd = $settings2["information"]["setadd"];
          botevoobot('editmessagetext',[
              'chat_id'=>$chatid,
   'message_id'=>$messageid,
             'text'=>"به بخش تنظیمات ادد اجباری خوش آمدید🍃
✅ادد اجباری روشن شد",
             'reply_markup'=>json_encode([
                 'inline_keyboard'=>[
    [
                     ['text'=>"👥 ادد اجباری",'callback_data'=>'text'],['text'=>"| فعال | ✅",'callback_data'=>'lockadd']
					 ],
					 [
					 ['text'=>"🚸 میزان دعوت",'callback_data'=>'text'],['text'=>"🔸 $setadd 🔹",'callback_data'=>'text']
					 ],
					 [
					 ['text'=>"➕ ",'callback_data'=>'add+'],['text'=>"➖",'callback_data'=>'add-']
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
$settings2["information"]["add"]="| فعال | ✅";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
	}else{
			botevoobot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"شما مدیر ربات نیستید ⚠️",
]);
	}
		  }
		  		  		elseif($data=="add+"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$Dev)){
$setadd = $settings2["information"]["setadd"];
$add = $settings2["information"]["add"];
$manfi = $setadd + 1;
if($manfi <= 20 && $manfi >= 1){
          botevoobot('editmessagetext',[
              'chat_id'=>$chatid,
   'message_id'=>$messageid,
             'text'=>"به بخش تنظیمات ادد اجباری خوش آمدید🍃
افزایش یافت✔️",
             'reply_markup'=>json_encode([
                 'inline_keyboard'=>[
    [
                     ['text'=>"👥 ادد اجباری",'callback_data'=>'text'],['text'=>"$add",'callback_data'=>'lockadd']
					 ],
					 [
					 ['text'=>"🚸 میزان دعوت",'callback_data'=>'text'],['text'=>"🔸 $manfi 🔹",'callback_data'=>'text']
					 ],
					 [
					 ['text'=>"➕ ",'callback_data'=>'add+'],['text'=>"➖",'callback_data'=>'add-']
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
$settings2["information"]["setadd"]="$manfi";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
}
else
{
			botevoobot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"امکان تغییر دیگر وجود ندارد ⚠️",
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
								  		  		elseif($data=="add-"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$Dev)){
$setadd = $settings2["information"]["setadd"];
$add = $settings2["information"]["add"];
$manfi = $setadd - 1;
    if ($manfi <= 20 && $manfi >= 1){
          botevoobot('editmessagetext',[
              'chat_id'=>$chatid,
   'message_id'=>$messageid,
             'text'=>"به بخش تنظیمات ادد اجباری خوش آمدید🍃
کاهش یافت✔️",
             'reply_markup'=>json_encode([
                 'inline_keyboard'=>[
    [
                     ['text'=>"👥 ادد اجباری",'callback_data'=>'text'],['text'=>"$add",'callback_data'=>'lockadd']
					 ],
					 [
					 ['text'=>"🚸 میزان دعوت",'callback_data'=>'text'],['text'=>"🔸 $manfi 🔹",'callback_data'=>'text']
					 ],
					 [
					 ['text'=>"➕ ",'callback_data'=>'add+'],['text'=>"➖",'callback_data'=>'add-']
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
$settings2["information"]["setadd"]="$manfi";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
}
else
{
			botevoobot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"امکان تغییر دیگر وجود ندارد ⚠️",
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
		
?>