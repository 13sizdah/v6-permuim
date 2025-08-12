<?php
/*
Bot : Management Group pro
Dev : Factweb team
Website: Factweb.ir
Channel : @factweb
*/
// msg check
// add
if($settings["information"]["add"] == "| فعال | ✅") {
if($newchatmemberid == true){
$add = $settings["addlist"]["$from_id"]["add"];
$addplus = $add +1;
$settings["addlist"]["$from_id"]["add"]="$addplus";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
}
}
if($settings["information"]["add"] == "| فعال | ✅"){
if ($status != "creator" && $status != "administrator" && !in_array($from_id,$Dev)){
if ($tc == 'group' || $tc == 'supergroup'){
$youadding = $settings["addlist"]["$from_id"]["add"];
$setadd = $settings["information"]["setadd"];
$addtext = $settings["addlist"]["$from_id"]["addtext"];
$msg = $settings["information"]["lastmsgadd"];
            if($youadding < $setadd){
      if($addtext == false){
            botevoobot('SendMessage',[
                'chat_id'=>$chat_id,
                'text'=>"
                 ❌ دوست عزیز 

🔹نام : [$first_name]
🔸ایدی : [$from_id]
🔅یوزرنیم : [@$username]

⚠️ تعداد افرادی که شما به گروه دعوت کرده اید برابر : 0
🌟 برای باز شدن چت شما باید $setadd نفر را به گروه دعوت کنید
",
'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
           [
                   ['text'=>"❌ معاف کاربر| توسط ادمین 👮🏻‍♂️",'callback_data'=>"moaf|$from_id"]
           ],
                     ]
               ])
            ]);
            botevoobot('deletemessage',[
                'chat_id'=>$chat_id,
            'message_id'=>$message_id
            ]);
                  botevoobot('deletemessage',[
                'chat_id'=>$chat_id,
            'message_id'=>$msg
            ]);
$msgplus = $message_id + 1;
$settings["information"]["lastmsgadd"]="$msgplus";
$settings["addlist"]["$from_id"]["addtext"]="true";
$settings["addlist"]["$from_id"]["add"]=0;
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
          }
      else
      {
          $moaf = $settings["information"]["moaf-ad"]["$from_id"];
          if($moaf !== "true"){
                    botevoobot('deletemessage',[
                'chat_id'=>$chat_id,
            'message_id'=>$message_id
       ]);
       }
    }
      }
    }
    }
}
elseif(strpos($data,'moaf|') !== false) {
 $id = str_replace("moaf|","",$data);
    if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$Dev) ){        
          botevoobot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"🌟 این کاربر $id توسط مدیر از اد اجباری معاف شد",
    ]);
$settings2["information"]["moaf-ad"]["$id"]="true";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);    
    }
  }
//  game
if($settings["lock"]["game"] == "| فعال | ✅"){
if($update->message->game){
if ($tc == 'group' || $tc == 'supergroup'){
if ( $status != 'creator' && $status != 'administrator' && !in_array($from_id,$Dev) ){
	botevoobot('deletemessage',[
    'chat_id'=>$chat_id,
    'message_id'=>$message_id
    ]);
	}
}
}
}
// location
if ($settings["lock"]["location"] == "| فعال | ✅"){
if($update->message->location){
if ($tc == 'group' || $tc == 'supergroup'){
if ( $status != 'creator' && $status != 'administrator' && !in_array($from_id,$Dev) ){
	botevoobot('deletemessage',[
    'chat_id'=>$chat_id,
    'message_id'=>$message_id
    ]);
	}
}
}
}
// filter
if($settings["filterlist"] != false){
if ($status != 'creator' && $status != 'administrator' ) {
$check = check_filter("$textmassage");
if ($check == true) {
botevoobot('deletemessage',[
    'chat_id'=>$chat_id,
    'message_id'=>$message_id
    ]);
}
}
}
// setrules
if($settings["information"]["step"] == "setrules"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev) ){
if ($tc == 'group' || $tc == 'supergroup'){
$plus = mb_strlen("$textmassage");
if($plus < 600) {
botevoobot('sendmessage',[
 'chat_id'=>$chat_id,
 'text'=>"قوانین گروه شما ثبت شد ✅",
  'reply_to_message_id'=>$message_id,
 ]);
$settings["information"]["rules"]="$textmassage";
$settings["information"]["step"]="none";
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
}
}
// lock channel 
if($settings["information"]["lockchannel"] == "| فعال | ✅"){
if ($status != "creator" && $status != "administrator" && !in_array($from_id,$Dev)){
if ($tc == 'group' || $tc == 'supergroup'){
$usernamechannel = $settings["information"]["setchannel"];
@$forchannel = json_decode(file_get_contents("https://api.telegram.org/bot".$token."/getChatMember?chat_id=".$usernamechannel."&user_id=".$from_id));
@$tch = $forchannel->result->status;
if($tch != 'member' && $tch != 'creator' && $tch != 'administrator'){
$msg = $settings["information"]["lastmsglockchannel"];
$channeltext = $settings["channellist"]["$from_id"]["channeltext"];
      if($channeltext == false){
            botevoobot('SendMessage',[
                'chat_id'=>$chat_id,
                'text'=>"
 ❌ دوست عزیز 
               
🔹نام : [$first_name]
🔸ایدی : [$from_id]
🔅یوزرنیم : [@$username]

❗️ شما برای ارسال در این گروه باید در کانال $usernamechannel عضو باشید . 
🌟 بعد از عضویت در کانال شما میتوانید در گروه فعالیت کنید
",
'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
          [
                   ['text'=>"❌ معاف کاربر| توسط ادمین 👮🏻‍♂️",'callback_data'=>"moafch|$from_id"]
           ],
                     ]
               ])
            ]);
            botevoobot('deletemessage',[
                'chat_id'=>$chat_id,
            'message_id'=>$message_id
            ]);
                  botevoobot('deletemessage',[
                'chat_id'=>$chat_id,
            'message_id'=>$msg
            ]);
$msgplus = $message_id + 1;
$settings["information"]["lastmsglockchannel"]="$msgplus";
$settings["channellist"]["$from_id"]["channeltext"]="true";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
          }
      else
      {
          $moaf = $settings["information"]["moaf-ch"]["$from_id"];
          if($moaf !== "true"){
                    botevoobot('deletemessage',[
                'chat_id'=>$chat_id,
            'message_id'=>$message_id
       ]);
       }
    }
      }
    }
    }
}
elseif(strpos($data,'moafch|') !== false) {
 $id = str_replace("moafch|","",$data);
    if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$Dev) ){        
          botevoobot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"🌟 این کاربر $id توسط مدیر از اد اجباری معاف شد",
    ]);
$settings2["information"]["moaf-ch"]["$id"]="true";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);    
    }
  }
if($settings["information"]["step"] == "setchannel"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev) ){
if ($tc == 'group' || $tc == 'supergroup'){
if(strpos($textmassage , '@') !== false) {
$plus = mb_strlen("$textmassage");
if($plus < 25) {
botevoobot('sendmessage',[
 'chat_id'=>$chat_id,
 'text'=>"کانال شما با موفقیت تنظیم شد ✅
 
📍 کانال تنظیم شد : $textmassage

📌 توجه ربات حتما باید در کانال تنظیم شده ادمین شود تا بتواند عمل کند",
  'reply_to_message_id'=>$message_id,
 ]);
$settings["information"]["setchannel"]="$textmassage";
$settings["information"]["step"]="none";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
}
else
{
		botevoobot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"📍 خطا ! یوزرنیم کانال وارد شد بیش از حد مجاز بلند است",
  'reply_to_message_id'=>$message_id,
            'reply_markup'=>json_encode([
                 'inline_keyboard'=>[
					 [
					 ['text'=>"🔙 برگشت",'callback_data'=>'lockchannel']
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
	'text'=>"📍 خطا در ابتدا یوزرنیم کانال حتما باید عبارت @ باشد 
🔘 ماننده : @$channel",
  'reply_to_message_id'=>$message_id,
            'reply_markup'=>json_encode([
                 'inline_keyboard'=>[
					 [
					 ['text'=>"🔙 برگشت",'callback_data'=>'lockchannel']
					 ],
                     ]
               ])
 ]);
}
}
}
}
// banall
elseif ($tc == 'private'){ 
if(in_array($from_id, $user["banlist"])) {
botevoobot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"🛑شما به خاطر رعایت نکردن قوانین از ربات مسدود شدید 

❇️ لطفا پیام دوباره ارسال نکنید",
'reply_markup'=>json_encode(['KeyboardRemove'=>[
],'remove_keyboard'=>true
])
]);
    }
}
elseif ($tc == 'group' || $tc == 'supergroup'){ 
if(in_array($from_id, $user["banlist"])) {
		botevoobot('KickChatMember',[
    'chat_id'=>$chat_id,
    'user_id'=>$from_id
      ]);
}
}
	// sup
if($user["userjop"]["$from_id"]["file"] == "sup"&& $tc == "private"){   
if ($textmassage != "❌قطع ارتباط") {	
botevoobot('ForwardMessage',[
'chat_id'=>$Dev[0],
'from_chat_id'=>$chat_id,
'message_id'=>$message_id
]);
			botevoobot('sendmessage',[       
			'chat_id'=>$chat_id,
			'text'=>"
⏳ پیام شما دریافت شد
منتظر پاسخ باشید ...",
	]);	
	}
	}
if($user["userjop"]["$from_id"]["file"] == "linkk"&& $tc == "private"){   
if ($textmassage != "🔙 برگشت") {  
botevoobot('ForwardMessage',[
'chat_id'=>$Dev[0],
'from_chat_id'=>$chat_id,
'message_id'=>$message_id
]);
      botevoobot('sendmessage',[       
      'chat_id'=>$chat_id,
      'text'=>"🌟 لینک شما برای مدیریت ارسال شد پس از بازبینی در کانال گذاشته خواهد شد 👌 ",
      'reply_markup'=>json_encode(['KeyboardRemove'=>[
],'remove_keyboard'=>true
])
  ]);  
  $user["userjop"]["{$from_id}"]["file"]="none";
$user = json_encode($user,true);
file_put_contents("data/user.json",$user);
  }
  }
  /*
Bot : Management Group pro
Dev : Factweb team
Website: Factweb.ir
Channel : @factweb
*/
?>