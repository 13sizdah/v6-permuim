<?php
// Cod Hedyeh
if($textmassage=="کد رایگان"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev) ){
$tedad = $settings["steps"]["tedad"];
if($tedad != '2'){
  botevoobot('sendmessage',[
  'chat_id'=>$chat_id,
  'text'=>" ✅ کد شارژ رایگان خود را به گروه ارسال کنید ",
  'reply_to_message_id'=>$message_id,
 ]);
$settings["steps"]["com"]="code-daram";
$settings["steps"]["id"]="$from_id";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
}else{
  botevoobot('sendmessage',[
  'chat_id'=>$chat_id,
  'text'=>" ❌ هر گروه فقط میتواند دوبار از کد رایگان $botnamef استفاده کند",
  'reply_to_message_id'=>$message_id,
 ]);    
}
}
}
if($settings["steps"]["com"]=="code-daram"){
$id =$settings["steps"]["id"];
$rand = rand(1,10);
$code = $user["code"];
$date = $settings["information"]["expire"];
$rand = rand(1,10);
$result=date('Y/m/d', strtotime($date. ' + '.$rand.' days'));
if($from_id==$id){
if($textmassage==$code){    
botevoobot('sendmessage',[
  'chat_id'=>$chat_id,
  'text'=>"🎁 مبارک باشه 😍 موفق شدی گروهت رو $rand روز شارژ کنی 👌😁",
  'reply_to_message_id'=>$message_id,
 ]);    
 botevoobot('sendmessage',[
  'chat_id'=>$Dev[0],
  'text'=>"✅ گروه $namegroup از کد هدیه استفاده کرد",
 ]);    
$tedad = $settings["steps"]["tedad"];
$tedad2 = $tedad +1;
$settings["information"]["expire"]="$result";
$settings["steps"]["com"]="";
$settings["steps"]["id"]="";
$settings["steps"]["tedad"]="$tedad2";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings); 
$user["code"]=""; 
$user = json_encode($user,true);
file_put_contents("data/user.json",$user); 
}
else
{
botevoobot('sendmessage',[
  'chat_id'=>$chat_id,
  'text'=>"❌ متاسفانه کد معتبر نیست",
  'reply_to_message_id'=>$message_id,
 ]);    
$settings["steps"]["com"]="";
$settings["steps"]["id"]=""; 
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings); 
}
}
}
 // بگو فارسی
elseif(strpos($textmassage , '! ') !== false ) {
if ($status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev) ){
if($update->message->reply_to_message){      
$matn = str_replace(['! '],'',$textmassage);
 botevoobot('deletemessage',[
    'chat_id'=>$chat_id,
    'message_id'=>$message_id,
    ]);
   botevoobot('sendmessage',[
  'chat_id'=>$chat_id,
  'text'=>"$matn",
  'reply_to_message_id'=>$re_msgid,
    ]);
 }else{
  botevoobot('deletemessage',[
    'chat_id'=>$chat_id,
    'message_id'=>$message_id,
    ]);
    $matn = str_replace(['! '],'',$textmassage);
        botevoobot('sendmessage',[
  'chat_id'=>$chat_id,
  'text'=>"$matn",
    ]);
 }
 }
}
// لیست تبچی
elseif($textmassage == "list tab"  or $textmassage == "لیست تبچی") {
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev)) {
if($settings["tabchilist"] != null){     
$silent = $settings["tabchilist"];
for($z = 0;$z <= count($silent)-1;$z++){
$result = $result."[$silent[$z]](tg://user?id=$silent[$z])"."\n";
}
    botevoobot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"✅ لیست تبجی های اخراج شده : 
➖➖➖➖➖

$result
🔸🔹🔸🔹🔸🔹",
'parse_mode'=>"MarkDown",
'reply_to_message_id'=>$message_id,
 ]);
}else{
    botevoobot('sendMessage',[
'chat_id'=>$chat_id,
'text'=>"❌ لیست خالی است کاربر تبچی ثبت نشده",
'reply_to_message_id'=>$message_id,
]);
}
}
}
 // تبچی نیست 
 elseif(strpos($textmassage , 'تبچی نیست ') !== false ) {
$id = str_replace(['تبچی نیست '],'',$textmassage);
 if(is_numeric($id)){
        botevoobot('sendmessage',[
  'chat_id'=>$chat_id,
  'text'=>"✅ کاربر از لیست تبچی خارج شد",
  'reply_to_message_id'=>$message_id,
    ]);
$settings["hoviatha"]["$id"]="true";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);    
 }
 }
 // فان سخنگو
elseif($settings['words'][$textmassage] != null and $tc != 'private'){
  $answer = $settings['words'][$textmassage];
  $lockanswer = $settings["lock"]["answer"];
if ($lockanswer == "| غیر فعال | ❌") {
  botevoobot('sendmessage',[
  'chat_id'=>$chat_id,
  'text'=>"$answer",
  'reply_to_message_id'=>$message_id,
  ]);
}
}
 elseif($textmassage == 'چیا بلدی'){
  $words = $settings['words'];
  if($words != null){
    $str = null;
    foreach($words as $word => $answer){
      $str .= "کلمه ($word) | پاسخ ($answer)\n";
    }
         botevoobot('sendmessage',[
  'chat_id'=>$chat_id,
  'text'=>"🌟 الان اینارو بلدم :) :\n$str",
  'reply_to_message_id'=>$message_id,
    ]);
  }else{
              botevoobot('sendmessage',[
  'chat_id'=>$chat_id,
  'text'=>"❌ هنوز چیزی بلد نیستم :(",
  'reply_to_message_id'=>$message_id,
    ]);
  }
  }
     elseif(strpos($textmassage,"یاد بگیر") !== false){
        $ex = explode("\n",$textmassage);
        $word = $ex[1];
        $answer = $ex[2];
        if($word != false){
        botevoobot('sendmessage',[
  'chat_id'=>$chat_id,
  'text'=>"یاد گرفتم هر وقت کلمه ی ( $word ) رو دیدم در جوابش بگم ( $answer )",
  'reply_to_message_id'=>$message_id,
  ]);
  $settings['words'][$word] = "$answer";
  file_put_contents("data/$chat_id.json",json_encode($settings));
        }
     }
          elseif(strpos($textmassage,"فراموش کن") !== false){
        $ex = explode("\n",$textmassage);
        $word = $ex[1];
        if($word != false){
              botevoobot('sendmessage',[
  'chat_id'=>$chat_id,
  'text'=>"کلمه ی $word  رو فراموش کردم",
  'reply_to_message_id'=>$message_id,
  ]);
  unset($settings['words'][$word]);
  file_put_contents("data/$chat_id.json",json_encode($settings));
        }
  }
    elseif($textmassage=="الزایمر بگیر"){
              botevoobot('sendmessage',[
  'chat_id'=>$chat_id,
  'text'=>"من الزایمر گرفتم و هر چی بلد بودم یادم رفت 🤦🏻‍♂️",
  'reply_to_message_id'=>$message_id,
  ]);
  unset($settings['words']);
  file_put_contents("data/$chat_id.json",json_encode($settings));
        }
        
elseif($textmassage=="پینگ"){
$load = sys_getloadavg();
$mem = memory_get_usage();
$ver = phpversion();
botevoobot('sendmessage',['chat_id'=>$chat_id,'text'=>"
CPU: $load[0]
PHP VERSION: $ver
Memory USAGE: $mem KB",'reply_to_message_id'=>$message_id]);
        }
        

if($textmassage=="/filterlist" or $textmassage=="filterlist" or $textmassage=="لیست فیلتر"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev)) {
$filter = $settings["filterlist"];
for($z = 0;$z <= count($filter)-1;$z++){
$result = $result.$filter[$z]."\n";
}
botevoobot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"
🌟 لیست کلمات فیلتر گروه :

$result
",
         'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
}
}
elseif (strpos($textmassage , "/filter ") !== false or strpos($textmassage , "افزودن فیلتر ") !== false) {
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev)) {
$add = $settings["information"]["added"];
if ($add == true) {
$text = str_replace(['/filter ','افزودن فیلتر '],'',$textmassage);
botevoobot('sendmessage',[
            'chat_id'=>$chat_id,
            'text'=>"
✅ کلمه $text به لیست کلمات فیلتر اضافه شد .
❌ از این پس این کلمه پاک میشود .
👮🏻‍♂️ توسط : @$username 
",
         'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
$settings = getGroupSettings($chat_id);
addFilteredWord($chat_id, $text);
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
elseif (strpos($textmassage , "/unfilter " ) !== false or strpos($textmassage , "حذف فیلتر ") !== false) {
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev)) {
$text = str_replace(['/unfilter ','حذف فیلتر '],'',$textmassage);
botevoobot('sendmessage',[
            'chat_id'=>$chat_id,
            'text'=>"
✅ کلمه $text به لیست کلمات فیلتر حذف شد .
❌ از این پس این کلمه پاک نیشود .
👮🏻‍♂️ توسط : @$username
",
         'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
$settings = getGroupSettings($chat_id);
$db = getDB();
$group = $db->getGroup($chat_id);
if ($group) {
    $db->delete('filtered_words', 'group_id = ? AND word = ?', [$group['id'], $text]);
}
}
}
elseif($textmassage=="/clean filterlist" or $textmassage=="clean filterlist" or $textmassage=="حذف لیست فیلتر"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev) ) {
$add = $settings["information"]["added"];
if ($add == true) {
botevoobot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"✅ لیست کلمات فیلتر گروه پاک شد
👮🏻‍♂️ توسط  :  @$username 
",
         'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
$settings = getGroupSettings($chat_id);
$db = getDB();
$group = $db->getGroup($chat_id);
if ($group) {
    $db->delete('filtered_words', 'group_id = ?', [$group['id']]);
}
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
// lock auto 
elseif($data=="lockauto"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$Dev) ){
$lockauto = $settings2["lock"]["lockauto"];
$timelockauto = $settings2["information"]["timelock"];
$timeunlockauto = $settings2["information"]["timeunlock"];
            botevoobot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"❄️ به بخش قفل خودکار گروه خوش امدید
📍 در این قسمت میتوانید سکوت گروه را به صورت خودکار تعیین کنید تا در زمان معین شده گروه از حالت سکوت خارج یا سکوت شود 
🚩 از دکمه های زیر استفاده کنید",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
                     [
                     ['text'=>"🔐 وضعیت قفل",'callback_data'=>'text'],['text'=>"$lockauto",'callback_data'=>'lockautostats']
					 ],
					            [
                     ['text'=>"🔻⏰ زمان فعال شدن ⏰🔻",'callback_data'=>'text']
					 ],
					 					            [
                     ['text'=>"$timelockauto",'callback_data'=>'text']
					 ],
					               [
                     ['text'=>"➕ یک ساعت",'callback_data'=>'hourlockautoplus'],['text'=>"➕ پنج دقیقه",'callback_data'=>'minlockautoplus']
					 ],
					 				               [
                     ['text'=>"➖ یک ساعت",'callback_data'=>'hourlockautodown'],['text'=>"➖ پنج دقیقه",'callback_data'=>'minlockautodown']
					 ],
					 		            [
                     ['text'=>"🔻⏰ زمان خاموش شدن ⏰🔻",'callback_data'=>'text']
					 ],
					 			 					            [
                     ['text'=>"$timeunlockauto",'callback_data'=>'text']
					 ],
					 					               [
                     ['text'=>"➕ یک ساعت",'callback_data'=>'hourunlockautoplus'],['text'=>"➕ پنج دقیقه",'callback_data'=>'minunlockautoplus']
					 ],
					 				               [
                     ['text'=>"➖ یک ساعت",'callback_data'=>'hourunlockautodown'],['text'=>"➖ پنج دقیقه",'callback_data'=>'minunlockautodown']
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
											    elseif($data=="lockautostats" &&  $settings2["lock"]["lockauto"] == "| غیر فعال | ❌"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$Dev) ){
$lockauto = $settings2["lock"]["lockauto"];
$timelockauto = $settings2["information"]["timelock"];
$timeunlockauto = $settings2["information"]["timeunlock"];
            botevoobot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"❄️ به بخش قفل خودکار گروه خوش امدید
📍 قفل خودکار گروه فعال شد",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
                     [
                     ['text'=>"🔐 وضعیت قفل",'callback_data'=>'text'],['text'=>"| فعال | ✅",'callback_data'=>'lockautostats']
					 ],
					            [
                     ['text'=>"🔻⏰ زمان فعال شدن ⏰🔻",'callback_data'=>'text']
					 ],
					 					            [
                     ['text'=>"$timelockauto",'callback_data'=>'text']
					 ],
					               [
                     ['text'=>"➕ یک ساعت",'callback_data'=>'hourlockautoplus'],['text'=>"➕ پنج دقیقه",'callback_data'=>'minlockautoplus']
					 ],
					 				               [
                     ['text'=>"➖ یک ساعت",'callback_data'=>'hourlockautodown'],['text'=>"➖ پنج دقیقه",'callback_data'=>'minlockautodown']
					 ],
					 		            [
                     ['text'=>"🔻⏰ زمان خاموش شدن ⏰🔻",'callback_data'=>'text']
					 ],
					 			 					            [
                     ['text'=>"$timeunlockauto",'callback_data'=>'text']
					 ],
					 					               [
                     ['text'=>"➕ یک ساعت",'callback_data'=>'hourunlockautoplus'],['text'=>"➕ پنج دقیقه",'callback_data'=>'minunlockautoplus']
					 ],
					 				               [
                     ['text'=>"➖ یک ساعت",'callback_data'=>'hourunlockautodown'],['text'=>"➖ پنج دقیقه",'callback_data'=>'minunlockautodown']
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
$settings2["lock"]["lockauto"]="| فعال | ✅";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
		   }else{
			botevoobot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"شما مدیر ربات نیستید ⚠️",
]);
    }
				}
															    elseif($data=="lockautostats" &&  $settings2["lock"]["lockauto"] == "| فعال | ✅"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$Dev) ){
$lockauto = $settings2["lock"]["lockauto"];
$timelockauto = $settings2["information"]["timelock"];
$timeunlockauto = $settings2["information"]["timeunlock"];
            botevoobot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"❄️ به بخش قفل خودکار گروه خوش امدید
📍 قفل خودکار گروه خاموش شد",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
                     [
                     ['text'=>"🔐 وضعیت قفل",'callback_data'=>'text'],['text'=>"| غیر فعال | ❌",'callback_data'=>'lockautostats']
					 ],
					            [
                     ['text'=>"🔻⏰ زمان فعال شدن ⏰🔻",'callback_data'=>'text']
					 ],
					 					            [
                     ['text'=>"$timelockauto",'callback_data'=>'text']
					 ],
					               [
                     ['text'=>"➕ یک ساعت",'callback_data'=>'hourlockautoplus'],['text'=>"➕ پنج دقیقه",'callback_data'=>'minlockautoplus']
					 ],
					 				               [
                     ['text'=>"➖ یک ساعت",'callback_data'=>'hourlockautodown'],['text'=>"➖ پنج دقیقه",'callback_data'=>'minlockautodown']
					 ],
					 		            [
                     ['text'=>"🔻⏰ زمان خاموش شدن ⏰🔻",'callback_data'=>'text']
					 ],
					 			 					            [
                     ['text'=>"$timeunlockauto",'callback_data'=>'text']
					 ],
					 					               [
                     ['text'=>"➕ یک ساعت",'callback_data'=>'hourunlockautoplus'],['text'=>"➕ پنج دقیقه",'callback_data'=>'minunlockautoplus']
					 ],
					 				               [
                     ['text'=>"➖ یک ساعت",'callback_data'=>'hourunlockautodown'],['text'=>"➖ پنج دقیقه",'callback_data'=>'minunlockautodown']
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
$settings2["lock"]["lockauto"]="| غیر فعال | ❌";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
		   }else{
			botevoobot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"شما مدیر ربات نیستید ⚠️",
]);
    }
				}
											    elseif($data=="hourlockautoplus"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$Dev) ){
$lockauto = $settings2["lock"]["lockauto"];
$timelockauto = $settings2["information"]["timelock"];
$timeunlockauto = $settings2["information"]["timeunlock"];
$next_date = date('H:i', strtotime($timelockauto ."+60 Minutes"));
            botevoobot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"❄️ به بخش قفل خودکار گروه خوش امدید
🚩 زمان فعال سازی قفل یک ساعت افزایش یافت",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
                     [
                     ['text'=>"🔐 وضعیت قفل",'callback_data'=>'text'],['text'=>"$lockauto",'callback_data'=>'lockautostats']
					 ],
					            [
                     ['text'=>"🔻⏰ زمان فعال شدن ⏰🔻",'callback_data'=>'text']
					 ],
					 					            [
                     ['text'=>"$next_date",'callback_data'=>'text']
					 ],
					               [
                     ['text'=>"➕ یک ساعت",'callback_data'=>'hourlockautoplus'],['text'=>"➕ پنج دقیقه",'callback_data'=>'minlockautoplus']
					 ],
					 				               [
                     ['text'=>"➖ یک ساعت",'callback_data'=>'hourlockautodown'],['text'=>"➖ پنج دقیقه",'callback_data'=>'minlockautodown']
					 ],
					 		            [
                     ['text'=>"🔻⏰ زمان خاموش شدن ⏰🔻",'callback_data'=>'text']
					 ],
					 			 					            [
                     ['text'=>"$timeunlockauto",'callback_data'=>'text']
					 ],
					 					               [
                     ['text'=>"➕ یک ساعت",'callback_data'=>'hourunlockautoplus'],['text'=>"➕ پنج دقیقه",'callback_data'=>'minunlockautoplus']
					 ],
					 				               [
                     ['text'=>"➖ یک ساعت",'callback_data'=>'hourunlockautodown'],['text'=>"➖ پنج دقیقه",'callback_data'=>'minunlockautodown']
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
$settings2["information"]["timelock"]="$next_date";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
		   }else{
			botevoobot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"شما مدیر ربات نیستید ⚠️",
]);
    }
				}
															    elseif($data=="hourlockautodown"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$Dev) ){
$lockauto = $settings2["lock"]["lockauto"];
$timelockauto = $settings2["information"]["timelock"];
$timeunlockauto = $settings2["information"]["timeunlock"];
$next_date = date('H:i', strtotime($timelockauto ."-60 Minutes"));
            botevoobot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"❄️ به بخش قفل خودکار گروه خوش امدید
🚩 زمان فعال سازی قفل یک ساعت کاهش یافت",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
                     [
                     ['text'=>"🔐 وضعیت قفل",'callback_data'=>'text'],['text'=>"$lockauto",'callback_data'=>'lockautostats']
					 ],
					            [
                     ['text'=>"🔻⏰ زمان فعال شدن ⏰🔻",'callback_data'=>'text']
					 ],
					 					            [
                     ['text'=>"$next_date",'callback_data'=>'text']
					 ],
					               [
                     ['text'=>"➕ یک ساعت",'callback_data'=>'hourlockautoplus'],['text'=>"➕ پنج دقیقه",'callback_data'=>'minlockautoplus']
					 ],
					 				               [
                     ['text'=>"➖ یک ساعت",'callback_data'=>'hourlockautodown'],['text'=>"➖ پنج دقیقه",'callback_data'=>'minlockautodown']
					 ],
					 		            [
                     ['text'=>"🔻⏰ زمان خاموش شدن ⏰🔻",'callback_data'=>'text']
					 ],
					 			 					            [
                     ['text'=>"$timeunlockauto",'callback_data'=>'text']
					 ],
					 					               [
                     ['text'=>"➕ یک ساعت",'callback_data'=>'hourunlockautoplus'],['text'=>"➕ پنج دقیقه",'callback_data'=>'minunlockautoplus']
					 ],
					 				               [
                     ['text'=>"➖ یک ساعت",'callback_data'=>'hourunlockautodown'],['text'=>"➖ پنج دقیقه",'callback_data'=>'minunlockautodown']
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
$settings2["information"]["timelock"]="$next_date";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
		   }else{
			botevoobot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"شما مدیر ربات نیستید ⚠️",
]);
    }
				}
											    elseif($data=="minlockautoplus"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$Dev) ){
$lockauto = $settings2["lock"]["lockauto"];
$timelockauto = $settings2["information"]["timelock"];
$timeunlockauto = $settings2["information"]["timeunlock"];
$next_date = date('H:i', strtotime($timelockauto ."+5 Minutes"));
            botevoobot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"❄️ به بخش قفل خودکار گروه خوش امدید
🚩 زمان فعال سازی قفل پنج دقیقه افزایش یافت",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
                     [
                     ['text'=>"🔐 وضعیت قفل",'callback_data'=>'text'],['text'=>"$lockauto",'callback_data'=>'lockautostats']
					 ],
					            [
                     ['text'=>"🔻⏰ زمان فعال شدن ⏰🔻",'callback_data'=>'text']
					 ],
					 					            [
                     ['text'=>"$next_date",'callback_data'=>'text']
					 ],
					               [
                     ['text'=>"➕ یک ساعت",'callback_data'=>'hourlockautoplus'],['text'=>"➕ پنج دقیقه",'callback_data'=>'minlockautoplus']
					 ],
					 				               [
                     ['text'=>"➖ یک ساعت",'callback_data'=>'hourlockautodown'],['text'=>"➖ پنج دقیقه",'callback_data'=>'minlockautodown']
					 ],
					 		            [
                     ['text'=>"🔻⏰ زمان خاموش شدن ⏰🔻",'callback_data'=>'text']
					 ],
					 			 					            [
                     ['text'=>"$timeunlockauto",'callback_data'=>'text']
					 ],
					 					               [
                     ['text'=>"➕ یک ساعت",'callback_data'=>'hourunlockautoplus'],['text'=>"➕ پنج دقیقه",'callback_data'=>'minunlockautoplus']
					 ],
					 				               [
                     ['text'=>"➖ یک ساعت",'callback_data'=>'hourunlockautodown'],['text'=>"➖ پنج دقیقه",'callback_data'=>'minunlockautodown']
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
$settings2["information"]["timelock"]="$next_date";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
		   }else{
			botevoobot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"شما مدیر ربات نیستید ⚠️",
]);
    }
				}
															    elseif($data=="minlockautodown"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$Dev) ){
$lockauto = $settings2["lock"]["lockauto"];
$timelockauto = $settings2["information"]["timelock"];
$timeunlockauto = $settings2["information"]["timeunlock"];
$next_date = date('H:i', strtotime($timelockauto ."-5 Minutes"));
            botevoobot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"❄️ به بخش قفل خودکار گروه خوش امدید
🚩 زمان فعال سازی قفل پنج دقیقه کاهش یافت",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
                     [
                     ['text'=>"🔐 وضعیت قفل",'callback_data'=>'text'],['text'=>"$lockauto",'callback_data'=>'lockautostats']
					 ],
					            [
                     ['text'=>"🔻⏰ زمان فعال شدن ⏰🔻",'callback_data'=>'text']
					 ],
					 					            [
                     ['text'=>"$next_date",'callback_data'=>'text']
					 ],
					               [
                     ['text'=>"➕ یک ساعت",'callback_data'=>'hourlockautoplus'],['text'=>"➕ پنج دقیقه",'callback_data'=>'minlockautoplus']
					 ],
					 				               [
                     ['text'=>"➖ یک ساعت",'callback_data'=>'hourlockautodown'],['text'=>"➖ پنج دقیقه",'callback_data'=>'minlockautodown']
					 ],
					 		            [
                     ['text'=>"🔻⏰ زمان خاموش شدن ⏰🔻",'callback_data'=>'text']
					 ],
					 			 					            [
                     ['text'=>"$timeunlockauto",'callback_data'=>'text']
					 ],
					 					               [
                     ['text'=>"➕ یک ساعت",'callback_data'=>'hourunlockautoplus'],['text'=>"➕ پنج دقیقه",'callback_data'=>'minunlockautoplus']
					 ],
					 				               [
                     ['text'=>"➖ یک ساعت",'callback_data'=>'hourunlockautodown'],['text'=>"➖ پنج دقیقه",'callback_data'=>'minunlockautodown']
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
$settings2["information"]["timelock"]="$next_date";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
		   }else{
			botevoobot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"شما مدیر ربات نیستید ⚠️",
]);
    }
				}
												    elseif($data=="hourunlockautoplus"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$Dev) ){
$lockauto = $settings2["lock"]["lockauto"];
$timelockauto = $settings2["information"]["timelock"];
$timeunlockauto = $settings2["information"]["timeunlock"];
$next_date = date('H:i', strtotime($timeunlockauto ."+60 Minutes"));
            botevoobot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"❄️ به بخش قفل خودکار گروه خوش امدید
🚩 زمان خاموش شدن قفل یک ساعت افزایش یافت",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
                     [
                     ['text'=>"🔐 وضعیت قفل",'callback_data'=>'text'],['text'=>"$lockauto",'callback_data'=>'lockautostats']
					 ],
					            [
                     ['text'=>"🔻⏰ زمان فعال شدن ⏰🔻",'callback_data'=>'text']
					 ],
					 					            [
                     ['text'=>"$timelockauto",'callback_data'=>'text']
					 ],
					               [
                     ['text'=>"➕ یک ساعت",'callback_data'=>'hourlockautoplus'],['text'=>"➕ پنج دقیقه",'callback_data'=>'minlockautoplus']
					 ],
					 				               [
                     ['text'=>"➖ یک ساعت",'callback_data'=>'hourlockautodown'],['text'=>"➖ پنج دقیقه",'callback_data'=>'minlockautodown']
					 ],
					 		            [
                     ['text'=>"🔻⏰ زمان خاموش شدن ⏰🔻",'callback_data'=>'text']
					 ],
					 			 					            [
                     ['text'=>"$next_date",'callback_data'=>'text']
					 ],
					 					               [
                     ['text'=>"➕ یک ساعت",'callback_data'=>'hourunlockautoplus'],['text'=>"➕ پنج دقیقه",'callback_data'=>'minunlockautoplus']
					 ],
					 				               [
                     ['text'=>"➖ یک ساعت",'callback_data'=>'hourunlockautodown'],['text'=>"➖ پنج دقیقه",'callback_data'=>'minunlockautodown']
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
$settings2["information"]["timeunlock"]="$next_date";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
		   }else{
			botevoobot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"شما مدیر ربات نیستید ⚠️",
]);
    }
				}
																    elseif($data=="hourunlockautodown"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$Dev) ){
$lockauto = $settings2["lock"]["lockauto"];
$timelockauto = $settings2["information"]["timelock"];
$timeunlockauto = $settings2["information"]["timeunlock"];
$next_date = date('H:i', strtotime($timeunlockauto ."-60 Minutes"));
            botevoobot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"❄️ به بخش قفل خودکار گروه خوش امدید
🚩 زمان خاموش شدن قفل یک ساعت کاهش یافت",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
                     [
                     ['text'=>"🔐 وضعیت قفل",'callback_data'=>'text'],['text'=>"$lockauto",'callback_data'=>'lockautostats']
					 ],
					            [
                     ['text'=>"🔻⏰ زمان فعال شدن ⏰🔻",'callback_data'=>'text']
					 ],
					 					            [
                     ['text'=>"$timelockauto",'callback_data'=>'text']
					 ],
					               [
                     ['text'=>"➕ یک ساعت",'callback_data'=>'hourlockautoplus'],['text'=>"➕ پنج دقیقه",'callback_data'=>'minlockautoplus']
					 ],
					 				               [
                     ['text'=>"➖ یک ساعت",'callback_data'=>'hourlockautodown'],['text'=>"➖ پنج دقیقه",'callback_data'=>'minlockautodown']
					 ],
					 		            [
                     ['text'=>"🔻⏰ زمان خاموش شدن ⏰🔻",'callback_data'=>'text']
					 ],
					 			 					            [
                     ['text'=>"$next_date",'callback_data'=>'text']
					 ],
					 					               [
                     ['text'=>"➕ یک ساعت",'callback_data'=>'hourunlockautoplus'],['text'=>"➕ پنج دقیقه",'callback_data'=>'minunlockautoplus']
					 ],
					 				               [
                     ['text'=>"➖ یک ساعت",'callback_data'=>'hourunlockautodown'],['text'=>"➖ پنج دقیقه",'callback_data'=>'minunlockautodown']
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
$settings2["information"]["timeunlock"]="$next_date";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
		   }else{
			botevoobot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"شما مدیر ربات نیستید ⚠️",
]);
    }
				}
																    elseif($data=="minunlockautoplus"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$Dev) ){
$lockauto = $settings2["lock"]["lockauto"];
$timelockauto = $settings2["information"]["timelock"];
$timeunlockauto = $settings2["information"]["timeunlock"];
$next_date = date('H:i', strtotime($timeunlockauto ."+5 Minutes"));
            botevoobot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"❄️ به بخش قفل خودکار گروه خوش امدید
🚩 زمان خاموش شدن قفل پنج دقیقه افزایش یافت",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
                     [
                     ['text'=>"🔐 وضعیت قفل",'callback_data'=>'text'],['text'=>"$lockauto",'callback_data'=>'lockautostats']
					 ],
					            [
                     ['text'=>"🔻⏰ زمان فعال شدن ⏰🔻",'callback_data'=>'text']
					 ],
					 					            [
                     ['text'=>"$timelockauto",'callback_data'=>'text']
					 ],
					               [
                     ['text'=>"➕ یک ساعت",'callback_data'=>'hourlockautoplus'],['text'=>"➕ پنج دقیقه",'callback_data'=>'minlockautoplus']
					 ],
					 				               [
                     ['text'=>"➖ یک ساعت",'callback_data'=>'hourlockautodown'],['text'=>"➖ پنج دقیقه",'callback_data'=>'minlockautodown']
					 ],
					 		            [
                     ['text'=>"🔻⏰ زمان خاموش شدن ⏰🔻",'callback_data'=>'text']
					 ],
					 			 					            [
                     ['text'=>"$next_date",'callback_data'=>'text']
					 ],
					 					               [
                     ['text'=>"➕ یک ساعت",'callback_data'=>'hourunlockautoplus'],['text'=>"➕ پنج دقیقه",'callback_data'=>'minunlockautoplus']
					 ],
					 				               [
                     ['text'=>"➖ یک ساعت",'callback_data'=>'hourunlockautodown'],['text'=>"➖ پنج دقیقه",'callback_data'=>'minunlockautodown']
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
$settings2["information"]["timeunlock"]="$next_date";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
		   }else{
			botevoobot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"شما مدیر ربات نیستید ⚠️",
]);
    }
				}
																				    elseif($data=="minunlockautodown"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$Dev) ){
$lockauto = $settings2["lock"]["lockauto"];
$timelockauto = $settings2["information"]["timelock"];
$timeunlockauto = $settings2["information"]["timeunlock"];
$next_date = date('H:i', strtotime($timeunlockauto ."-5 Minutes"));
            botevoobot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"❄️ به بخش قفل خودکار گروه خوش امدید
🚩 زمان خاموش شدن قفل پنج دقیقه کاهش یافت",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
                     [
                     ['text'=>"🔐 وضعیت قفل",'callback_data'=>'text'],['text'=>"$lockauto",'callback_data'=>'lockautostats']
					 ],
					            [
                     ['text'=>"🔻⏰ زمان فعال شدن ⏰🔻",'callback_data'=>'text']
					 ],
					 					            [
                     ['text'=>"$timelockauto",'callback_data'=>'text']
					 ],
					               [
                     ['text'=>"➕ یک ساعت",'callback_data'=>'hourlockautoplus'],['text'=>"➕ پنج دقیقه",'callback_data'=>'minlockautoplus']
					 ],
					 				               [
                     ['text'=>"➖ یک ساعت",'callback_data'=>'hourlockautodown'],['text'=>"➖ پنج دقیقه",'callback_data'=>'minlockautodown']
					 ],
					 		            [
                     ['text'=>"🔻⏰ زمان خاموش شدن ⏰🔻",'callback_data'=>'text']
					 ],
					 			 					            [
                     ['text'=>"$next_date",'callback_data'=>'text']
					 ],
					 					               [
                     ['text'=>"➕ یک ساعت",'callback_data'=>'hourunlockautoplus'],['text'=>"➕ پنج دقیقه",'callback_data'=>'minunlockautoplus']
					 ],
					 				               [
                     ['text'=>"➖ یک ساعت",'callback_data'=>'hourunlockautodown'],['text'=>"➖ پنج دقیقه",'callback_data'=>'minunlockautodown']
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
$settings2["information"]["timeunlock"]="$next_date";
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