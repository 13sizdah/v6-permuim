<?php

// msg check
// lock link
if($settings["lock"]["link"] == "| فعال | ✅"){
if ($status != 'creator' && $status != 'administrator' && !in_array($from_id,$Dev)){
if (strstr($textmassage,"t.me") == true or strstr($textmassage,"T.me") == true or strstr($textmassage,"telegram.me") == true or strstr($caption,"t.me") == true or strstr($caption,"telegram.me")  or strpos($edit,"t.me") != false or strpos($edit,"telegram.me") != false or strpos($edit,"T.me") != false) {   
botevoobot('deletemessage',[
    'chat_id'=>$chat_id,
    'message_id'=>$message_id
    ]);
  }
}
}
// lock url
if($settings["lock"]["url"] == "| فعال | ✅"){
if ($status != 'creator' && $status != 'administrator' && !in_array($from_id,$Dev)){
if (preg_match("/((http|https)\:\/\/)?[a-zA-Z\.\/\?\:@\-_=#]+\.([a-zA-Z\&\.\/\?\:@\-_=#])+/", $textmassage) ) {   
botevoobot('deletemessage',[
    'chat_id'=>$chat_id,
    'message_id'=>$message_id
    ]);
  }
  elseif ($update->edited_message) {
      if (preg_match("/((http|https)\:\/\/)?[a-zA-Z\.\/\?\:@\-_=#]+\.([a-zA-Z\&\.\/\?\:@\-_=#])+/", $edit) ) {   
botevoobot('deletemessage',[
    'chat_id'=>$chat_id,
    'message_id'=>$message_id
    ]);
  }
  }
}
}
// lock photo
if($settings["lock"]["photo"] == "| فعال | ✅"){
if ($status != 'creator' && $status != 'administrator' && !in_array($from_id,$Dev)){
if ($update->message->photo){  
botevoobot('deletemessage',[
    'chat_id'=>$chat_id,
    'message_id'=>$message_id
    ]);
  }
}
}
// gif
if($settings["lock"]["gif"] == "| فعال | ✅"){
if ($status != 'creator' && $status != 'administrator' && !in_array($from_id,$Dev)){
if ($update->message->document){  
botevoobot('deletemessage',[
    'chat_id'=>$chat_id,
    'message_id'=>$message_id
    ]);
  }
}
}
// document
if($settings["lock"]["document"] == "| فعال | ✅"){
if ($status != 'creator' && $status != 'administrator' && !in_array($from_id,$Dev)){
if ($update->message->document){  
botevoobot('deletemessage',[
    'chat_id'=>$chat_id,
    'message_id'=>$message_id
    ]);
  }
}
}
// video
if($settings["lock"]["video"] == "| فعال | ✅"){
if ($status != 'creator' && $status != 'administrator' && !in_array($from_id,$Dev)){
if ($update->message->video){  
botevoobot('deletemessage',[
    'chat_id'=>$chat_id,
    'message_id'=>$message_id
    ]);
  }
}
}
// edit 
if($editgetsettings["lock"]["edit"] == "| فعال | ✅"){
if ( $you != 'creator' && $you != 'administrator' && $edit_for_id != $Dev){
if ($update->edited_message->text){  
botevoobot('deletemessage',[
    'chat_id'=>$chat_edit_id,
    'message_id'=>$message_edit_id
    ]);
  }
}
}
// contact
if ($settings["lock"]["contact"] == "| فعال | ✅"){
if($update->message->contact){
if ($tc == 'group' | $tc == 'supergroup'){
if ( $status != 'creator' && $status != 'administrator' && !in_array($from_id,$Dev) ){
	botevoobot('deletemessage',[
    'chat_id'=>$chat_id,
    'message_id'=>$message_id
    ]);
	}
}
}
}
// tag
if ($settings["lock"]["tag"] == "| فعال | ✅"){
if (strstr($textmassage,"#") == true or strstr($caption,"#") == true) {
if ($tc == 'group' | $tc == 'supergroup'){
if ( $status != 'creator' && $status != 'administrator' && !in_array($from_id,$Dev) ){
	botevoobot('deletemessage',[
    'chat_id'=>$chat_id,
    'message_id'=>$message_id
    ]);
	}
}
}
}// username 
if ($settings["lock"]["username"] == "| فعال | ✅"){
if (strstr($textmassage,"@") == true or strstr($caption,"@") == true) {
if ($tc == 'group' | $tc == 'supergroup'){
if ( $status != 'creator' && $status != 'administrator' && !in_array($from_id,$Dev) ){
	botevoobot('deletemessage',[
    'chat_id'=>$chat_id,
    'message_id'=>$message_id
    ]);
	}
}
}
}
// audio
if ($settings["lock"]["audio"] == "| فعال | ✅"){
if($update->message->audio){
if ($tc == 'group' | $tc == 'supergroup'){
if ( $status != 'creator' && $status != 'administrator' && !in_array($from_id,$Dev) ){
	botevoobot('deletemessage',[
    'chat_id'=>$chat_id,
    'message_id'=>$message_id
    ]);
	}
}
}
}
// voice 
if ($settings["lock"]["voice"] == "| فعال | ✅"){
if($update->message->voice){
if ($tc == 'group' | $tc == 'supergroup'){
if ( $status != 'creator' && $status != 'administrator' && !in_array($from_id,$Dev) ){
	botevoobot('deletemessage',[
    'chat_id'=>$chat_id,
    'message_id'=>$message_id
    ]);
	}
}
}
}
// join 
if ($settings["lock"]["join"] == "| فعال | ✅"){
if($update->message->new_chat_member){
if ($tc == "group" | $tc == "supergroup"){
    botevoobot('KickChatMember',[
    'chat_id'=>$chat_id,
    'user_id'=>$newchatmemberid
      ]);
}
}
}
// lock animated
if ($settings["lock"]["animated"] == "| فعال | ✅"){
if( $update->message->sticker->is_sticker){
if ($tc == 'group' | $tc == 'supergroup'){
if ($status != 'creator' && $status != 'administrator' && !in_array($from_id,$Dev)){
botevoobot('deletemessage',[
        'chat_id'=>$chat_id,
        'message_id'=>$message_id
]);
}
}
}
}
// tabchi 
if ($settings["lock"]["tabchi"] == "| فعال | ✅"){
if($update->message->new_chat_member){
if ($tc == "group" | $tc == "supergroup"){
$hoviat = $settings["hoviatha"]["$from_id"];
   if($hoviat == false){   
botevoobot('sendmessage',[
  'chat_id'=>$chat_id,
  'text'=>"
  ❌ لطفا هویت خود را تایید کنید در غیر اینصورت اخراج میشوید
",
'reply_to_message_id'=>$message_id,
  'reply_markup'=>json_encode([
    'inline_keyboard'=>[
   [
         ['text'=>"✅ تایید هویت",'callback_data'=>"hoviat|$from_id"],
     ],
   [
        ['text'=>"👮🏻‍♂️ تایید هویت توسط ادمین",'callback_data'=>"hoviat-ad|$from_id"]
        ],
        ]
   ])
  ]);
  $settings["hoviatha"]["$from_id"]="none";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
   }
}
}
}

if ($settings["lock"]["tabchi"] == "| فعال | ✅"){
    if ($status != 'creator' && $status != 'administrator' && !in_array($from_id,$Dev)){  
   if($update->message->text){   
   $hoviat = $settings["hoviatha"]["$from_id"];
   if($hoviat == false){
      botevoobot('deletemessage',[
    'chat_id'=>$chat_id,
    'message_id'=>$message_id
    ]); 
   botevoobot('KickChatMember',[
    'chat_id'=>$chat_id,
    'user_id'=>$from_id
  ]);
  $settings["tabchilist"][]="$from_id";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
   }
   }
  }
  }
elseif(strpos($data,'hoviat|') !== false) {
 $id = str_replace("hoviat|","",$data);
    if ($id == $fromid){        
          botevoobot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"کاربر $id تایید شد",
    ]);
    $settings2["hoviatha"]["$id"]="true";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
    }else{
         botevoobot('answercallbackquery',['callback_query_id'=>$update->callback_query->id,'text'=>"🌟 تبریک هویت شما تایید شد",'show_alert'=>true,
        ]);
    }
  }
  elseif(strpos($data,'hoviat-ad|') !== false) {
 $id = str_replace("hoviat-ad|","",$data);
 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$Dev) ){       
          botevoobot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"✅ کاربر $id تایید شد ",
    ]);
    $settings2["hoviatha"]["$id"]="true";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
    }else{
         botevoobot('answercallbackquery',['callback_query_id'=>$update->callback_query->id,'text'=>"❗️ شما نمیتوانید هویت کاربر رو تایید کنید",'show_alert'=>true,
        ]);
    }
  }
  // engliesh 
if($settings["lock"]["eng"] == "| فعال | ✅"){
if ($status != 'creator' && $status != 'administrator' && !in_array($from_id,$Dev)){
if(preg_match('/^([A-Za-z])/',$textmassage)){ 
botevoobot('deletemessage',[
    'chat_id'=>$chat_id,
    'message_id'=>$message_id
    ]);
  }
}
}

?>