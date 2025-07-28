<?php
/*
Bot : Management Group pro
Dev : Factweb team
Website: Factweb.ir
Channel : @factweb
*/
if(
$data=="lockphoto" && $settings2["lock"]["photo"] == "| فعال | ✅" or 
$data=="lockvideo" && $settings2["lock"]["video"] =="| فعال | ✅" or 
$data=="lockgame" && $settings2["lock"]["game"] =="| فعال | ✅" or 
$data=="locksticker" && $settings2["lock"]["sticker"] =="| فعال | ✅" or 
$data=="lockvoice" && $settings2["lock"]["voice"] =="| فعال | ✅" or 
$data=="lockaudio" && $settings2["lock"]["audio"] =="| فعال | ✅"  or 
$data=="lockcontact" && $settings2["lock"]["contact"] =="| فعال | ✅" or 
$data=="locklocation" && $settings2["lock"]["location"] =="| فعال | ✅" or 
$data=="lockdocument" &&  $settings2["lock"]["document"] =="| فعال | ✅" or 
$data=="lockgif" && $settings2["lock"]["gif"] =="| فعال | ✅" or 
$data=="lockself" && $settings2["lock"]["video_msg"] =="| فعال | ✅" or 
$data=="locktext" && $settings2["lock"]["text"] =="| فعال | ✅"  
){
if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$Dev) ){
$getlock = array(
    "lockphoto","lockvideo","lockgame","locksticker","lockvoice","lockaudio","lockcontact","locklocation","lockdocument","lockgif","lockself","locktext"
    );
$howlock = array(
    "photo","video","game","sticker","voice","audio","contact","location","document","gif","video_msg","text"
    );
$text = array(
    "عکس","ویدیو","بازی","استیکر","ویس","اهنگ","مخاطب","مکان","فایل","گیف","پیام ویدیویی","متن")
    ;
$lock = str_replace($getlock,$howlock,$data);
$gettext = str_replace($getlock,$text,$data);
$settings2["lock"]["$lock"]="| غیر فعال | ❌";
$lockdocument = $settings2["lock"]["document"];
$lockgif = $settings2["lock"]["gif"];
$lockvideo_note = $settings2["lock"]["video_msg"];
$locklocation = $settings2["lock"]["location"];
$lockphoto = $settings2["lock"]["photo"];
$lockcontact = $settings2["lock"]["contact"];
$lockaudio = $settings2["lock"]["audio"];
$lockvoice = $settings2["lock"]["voice"];
$locksticker = $settings2["lock"]["sticker"];
$lockgame = $settings2["lock"]["game"];
$lockvideo = $settings2["lock"]["video"];
$locktext = $settings2["lock"]["text"];
          botevoobot('editMessageReplyMarkup',[
              'chat_id'=>$chatid,
   'message_id'=>$messageid,
             'reply_markup'=>json_encode([
                 'inline_keyboard'=>[
 [
['text'=>"• فایل",'callback_data'=>'text'],['text'=>"$lockdocument",'callback_data'=>'lockdocument']
],
[
['text'=>"• گیف",'callback_data'=>'text'],['text'=>"$lockgif",'callback_data'=>'lockgif']
],
[
['text'=>"• پیام ویدیویی",'callback_data'=>'text'],['text'=>"$lockvideo_note",'callback_data'=>'lockself']
],
  [
 ['text'=>"• ارسال مکان",'callback_data'=>'text'],['text'=>"$locklocation",'callback_data'=>'locklocation']
 ],
   [
 ['text'=>"• تصویر",'callback_data'=>'text'],['text'=>"$lockphoto",'callback_data'=>'lockphoto']
 ],
  [
 ['text'=>"• ارسال شماره",'callback_data'=>'text'],['text'=>"$lockcontact",'callback_data'=>'lockcontact']
 ],
  [
 ['text'=>"• موسیقی",'callback_data'=>'text'],['text'=>"$lockaudio",'callback_data'=>'lockaudio']
 ],
  [
 ['text'=>"• صدا",'callback_data'=>'text'],['text'=>"$lockvoice",'callback_data'=>'lockvoice']
 ],
  [
 ['text'=>"• استیکر",'callback_data'=>'text'],['text'=>"$locksticker",'callback_data'=>'locksticker']
 ],
  [
 ['text'=>"• بازی",'callback_data'=>'text'],['text'=>"$lockgame",'callback_data'=>'lockgame']
 ],
 [
['text'=>"• فیلم",'callback_data'=>'text'],['text'=>"$lockvideo",'callback_data'=>'lockvideo']
],
 [
['text'=>"• متن",'callback_data'=>'text'],['text'=>"$locktext",'callback_data'=>'locktext']
],
[
['text'=>"🔑 تنظیمات مدیریت",'callback_data'=>'other']
],
[
['text'=>"🔙 برگشت",'callback_data'=>'settings'],['text'=>"$nemechannel",'url'=>"https://telegram.me/$channel"]
],
                    ]
             ])
         ]);
	 botevoobot('answercallbackquery', [
	            'callback_query_id' =>$membercall,
            'text' => "قفل ارسال $gettext غیر فعال شد 🔓",
            'show_alert' =>false
        ]);	
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
		 }else{
			botevoobot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"شما مدیر ربات نیستید ⚠️",
]);
  }
  }
elseif(
$data=="lockphoto" && $settings2["lock"]["photo"] == "| غیر فعال | ❌" or 
$data=="lockvideo" && $settings2["lock"]["video"] =="| غیر فعال | ❌" or 
$data=="lockgame" && $settings2["lock"]["game"] =="| غیر فعال | ❌" or 
$data=="locksticker" && $settings2["lock"]["sticker"] =="| غیر فعال | ❌" or
$data=="lockvoice" && $settings2["lock"]["voice"] =="| غیر فعال | ❌" or 
$data=="lockaudio" && $settings2["lock"]["audio"] =="| غیر فعال | ❌"  or 
$data=="lockcontact" && $settings2["lock"]["contact"] =="| غیر فعال | ❌" or
$data=="locklocation" && $settings2["lock"]["location"] =="| غیر فعال | ❌" or
$data=="lockdocument" &&  $settings2["lock"]["document"] =="| غیر فعال | ❌" or
$data=="lockgif" && $settings2["lock"]["gif"] =="| غیر فعال | ❌" or 
$data=="lockself" && $settings2["lock"]["video_msg"] =="| غیر فعال | ❌" or 
$data=="locktext" && $settings2["lock"]["text"] =="| غیر فعال | ❌" 
){
if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$Dev) ){
$getlock = array(
    "lockphoto","lockvideo","lockgame","locksticker","lockvoice","lockaudio","lockcontact","locklocation","lockdocument","lockgif","lockself","locktext"
    );
$howlock = array(
    "photo","video","game","sticker","voice","audio","contact","location","document","gif","video_msg","text"
    );
$text = array(
    "عکس","ویدیو","بازی","استیکر","ویس","اهنگ","مخاطب","مکان","فایل","گیف","پیام ویدیویی","متن")
    ;
$lock = str_replace($getlock,$howlock,$data);
$gettext = str_replace($getlock,$text,$data);
$settings2["lock"]["$lock"]="| فعال | ✅";
$lockdocument = $settings2["lock"]["document"];
$lockgif = $settings2["lock"]["gif"];
$lockvideo_note = $settings2["lock"]["video_msg"];
$locklocation = $settings2["lock"]["location"];
$lockphoto = $settings2["lock"]["photo"];
$lockcontact = $settings2["lock"]["contact"];
$lockaudio = $settings2["lock"]["audio"];
$lockvoice = $settings2["lock"]["voice"];
$locksticker = $settings2["lock"]["sticker"];
$lockgame = $settings2["lock"]["game"];
$lockvideo = $settings2["lock"]["video"];
$locktext = $settings2["lock"]["text"];
          botevoobot('editMessageReplyMarkup',[
              'chat_id'=>$chatid,
   'message_id'=>$messageid,
             'reply_markup'=>json_encode([
                 'inline_keyboard'=>[
 [
['text'=>"• فایل",'callback_data'=>'text'],['text'=>"$lockdocument",'callback_data'=>'lockdocument']
],
[
['text'=>"• گیف",'callback_data'=>'text'],['text'=>"$lockgif",'callback_data'=>'lockgif']
],
[
['text'=>"• پیام ویدیویی",'callback_data'=>'text'],['text'=>"$lockvideo_note",'callback_data'=>'lockself']
],
  [
 ['text'=>"• ارسال مکان",'callback_data'=>'text'],['text'=>"$locklocation",'callback_data'=>'locklocation']
 ],
   [
 ['text'=>"• تصویر",'callback_data'=>'text'],['text'=>"$lockphoto",'callback_data'=>'lockphoto']
 ],
  [
 ['text'=>"• ارسال شماره",'callback_data'=>'text'],['text'=>"$lockcontact",'callback_data'=>'lockcontact']
 ],
  [
 ['text'=>"• موسیقی",'callback_data'=>'text'],['text'=>"$lockaudio",'callback_data'=>'lockaudio']
 ],
  [
 ['text'=>"• صدا",'callback_data'=>'text'],['text'=>"$lockvoice",'callback_data'=>'lockvoice']
 ],
  [
 ['text'=>"• استیکر",'callback_data'=>'text'],['text'=>"$locksticker",'callback_data'=>'locksticker']
 ],
  [
 ['text'=>"• بازی",'callback_data'=>'text'],['text'=>"$lockgame",'callback_data'=>'lockgame']
 ],
 [
['text'=>"• فیلم",'callback_data'=>'text'],['text'=>"$lockvideo",'callback_data'=>'lockvideo']
],
 [
['text'=>"• متن",'callback_data'=>'text'],['text'=>"$locktext",'callback_data'=>'locktext']
],
[
['text'=>"🔑 تنظیمات مدیریت",'callback_data'=>'other']
],
[
['text'=>"🔙 برگشت",'callback_data'=>'settings'],['text'=>"$nemechannel",'url'=>"https://telegram.me/$channel"]
],
                    ]
             ])
         ]);
	 botevoobot('answercallbackquery', [
	            'callback_query_id' =>$membercall,
            'text' => "قفل ارسال $gettext فعال شد 🔐",
            'show_alert' =>false
        ]);	
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
		 }else{
			botevoobot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"شما مدیر ربات نیستید ⚠️",
]);
  }
  }
elseif(
$data=="lockforward" && $settings2["lock"]["forward"] =="| فعال | ✅" or 
$data=="lockfosh" && $settings2["lock"]["fosh"] =="| فعال | ✅" or 
$data=="lockedit" && $settings2["lock"]["edit"] =="| فعال | ✅" or 
$data=="lockusername" && $settings2["lock"]["username"] =="| فعال | ✅" or 
$data=="locklink" && $settings2["lock"]["link"] == "| فعال | ✅" or 
$data=="lockbot" && $settings2["lock"]["bot"] =="| فعال | ✅"  or 
$data=="locktgservic" && $settings2["lock"]["tgservic"] =="| فعال | ✅" or 
$data=="lockreply" && $settings2["lock"]["reply"] =="| فعال | ✅" or 
$data=="lockcmd" && $settings2["lock"]["cmd"] =="| فعال | ✅" or 
$data=="locktag" && $settings2["lock"]["tag"] =="| فعال | ✅" or 
$data=="lockurl" && $settings2["lock"]["url"] =="| فعال | ✅" or
$data=="lockjoin" && $settings2["lock"]["join"] =="| فعال | ✅" or
$data=="locktabchi" && $settings2["lock"]["tabchi"] =="| فعال | ✅" or
$data=="lockgroup" && $settings2["lock"]["group"] =="| فعال | ✅"  
){
if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$Dev) ){
$getlock = array(
    "lockforward","lockfosh","lockedit","lockusername","locklink","lockbot","locktgservic","lockreply","lockcmd","locktag","lockurl","lockjoin","locktabchi","lockgroup"
    );
$howlock = array(
    "forward","fosh","edit","username","link","bot","tgservic","reply","cmd","tag","url","join","tabchi","group"
    );
$text = array(
    "فوروارد","کلمات رکیک","ویرایش","یوزرنیم","لینک","ورود ربات","خدمت تلگرام","ریپلای","دستورات عمومی","هشتگ","سایت","عضویت","تبچی","گروه"
);
$lock = str_replace($getlock,$howlock,$data);
$gettext = str_replace($getlock,$text,$data);
$settings2["lock"]["$lock"]="| غیر فعال | ❌";
$locklink = $settings2["lock"]["link"];
$lockusername = $settings2["lock"]["username"];
$locktag = $settings2["lock"]["tag"];
$lockedit = $settings2["lock"]["edit"];
$lockfosh = $settings2["lock"]["fosh"];
$lockbots = $settings2["lock"]["bot"];
$lockforward = $settings2["lock"]["forward"];
$locktg = $settings2["lock"]["tgservic"];
$lockreply = $settings2["lock"]["reply"];
$lockcmd = $settings2["lock"]["cmd"];
$lockurl = $settings2["lock"]["url"];
$lockjoin = $settings2["lock"]["join"];
$locktabchi = $settings2["lock"]["tabchi"];
$lockgroup = $settings2["lock"]["group"];

          botevoobot('editMessageReplyMarkup',[
              'chat_id'=>$chatid,
   'message_id'=>$messageid,
              'reply_markup'=>json_encode([
                 'inline_keyboard'=>[
 [
 ['text'=>"• لينک",'callback_data'=>'text'],['text'=>"$locklink",'callback_data'=>'locklink']
 ],
  [
['text'=>"• لینک سایت",'callback_data'=>'text'],['text'=>"$lockurl",'callback_data'=>'lockurl']
],
  [
 ['text'=>"• هشتگ [#]",'callback_data'=>'text'],['text'=>"$locktag",'callback_data'=>'locktag']
 ],
   [
 ['text'=>"• یوزرنیم [@]",'callback_data'=>'text'],['text'=>"$lockusername",'callback_data'=>'lockusername']
 ],
  [
 ['text'=>"• ویرایش پیام",'callback_data'=>'text'],['text'=>"$lockedit",'callback_data'=>'lockedit']
 ],
  [
 ['text'=>"• فحش",'callback_data'=>'text'],['text'=>"$lockfosh",'callback_data'=>'lockfosh']
 ],
 [
['text'=>"• ورود ربات ها",'callback_data'=>'text'],['text'=>"$lockbots",'callback_data'=>'lockbot']
],
  [
 ['text'=>"• فوروارد",'callback_data'=>'text'],['text'=>"$lockforward",'callback_data'=>'lockforward']
 ],
[
['text'=>"• خدمات تلگرام",'callback_data'=>'text'],['text'=>"$locktg",'callback_data'=>'locktgservic']
],
[
['text'=>"• ریپلای",'callback_data'=>'text'],['text'=>"$lockreply",'callback_data'=>'lockreply']
],
[
['text'=>"• دستورات عمومی",'callback_data'=>'text'],['text'=>"$lockcmd",'callback_data'=>'lockcmd']
],
[
['text'=>"• عضویت",'callback_data'=>'text'],['text'=>"$lockjoin",'callback_data'=>'lockjoin']
],
[
['text'=>"• تبچی",'callback_data'=>'text'],['text'=>"$locktabchi",'callback_data'=>'locktabchi']
],
[
['text'=>"• گروه",'callback_data'=>'text'],['text'=>"$lockgroup",'callback_data'=>'lockgroup']
],
[
['text'=>"🔑 تنظیمات رسانه",'callback_data'=>'media']
],
[
['text'=>"🔙 برگشت",'callback_data'=>'settings'],['text'=>"$nemechannel",'url'=>"https://telegram.me/$channel"]
],
                    ]
             ])
         ]);
	 botevoobot('answercallbackquery', [
	            'callback_query_id' =>$membercall,
            'text' => "قفل $gettext غیر فعال شد 🔓",
            'show_alert' =>false
        ]);	
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
		 }else{
			botevoobot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"شما مدیر ربات نیستید ⚠️",
]);
  }
  }
elseif(
$data=="lockforward" && $settings2["lock"]["forward"] =="| غیر فعال | ❌" or
$data=="lockfosh" && $settings2["lock"]["fosh"] =="| غیر فعال | ❌" or
$data=="lockedit" && $settings2["lock"]["edit"] =="| غیر فعال | ❌" or
$data=="lockusername" && $settings2["lock"]["username"] =="| غیر فعال | ❌" or
$data=="locklink" && $settings2["lock"]["link"] == "| غیر فعال | ❌" or
$data=="lockbot" && $settings2["lock"]["bot"] =="| غیر فعال | ❌"  or
$data=="locktgservic" && $settings2["lock"]["tgservic"] =="| غیر فعال | ❌" or
$data=="lockreply" && $settings2["lock"]["reply"] =="| غیر فعال | ❌" or
$data=="lockcmd" && $settings2["lock"]["cmd"] =="| غیر فعال | ❌" or
$data=="locktag" && $settings2["lock"]["tag"] =="| غیر فعال | ❌"  or 
$data=="lockurl" && $settings2["lock"]["url"] =="| غیر فعال | ❌" or
$data=="lockjoin" && $settings2["lock"]["join"] =="| غیر فعال | ❌" or
$data=="locktabchi" && $settings2["lock"]["tabchi"] =="| غیر فعال | ❌"  or
$data=="lockgroup" && $settings2["lock"]["group"] =="| غیر فعال | ❌" 
){
if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$Dev) ){
$getlock = array(
    "lockforward","lockfosh","lockedit","lockusername","locklink","lockbot","locktgservic","lockreply","lockcmd","locktag","lockurl","lockjoin","locktabchi","lockgroup"
    );
$howlock = array(
    "forward","fosh","edit","username","link","bot","tgservic","reply","cmd","tag","url","join","tabchi","group"
    );
$text = array(
    "فوروارد","کلمات رکیک","ویرایش","یوزرنیم","لینک","ورود ربات","خدمت تلگرام","ریپلای","دستورات عمومی","هشتگ","سایت","عضویت","تبچی","گروه"
    );
$lock = str_replace($getlock,$howlock,$data);
$gettext = str_replace($getlock,$text,$data);
$settings2["lock"]["$lock"]="| فعال | ✅";
$locklink = $settings2["lock"]["link"];
$lockusername = $settings2["lock"]["username"];
$locktag = $settings2["lock"]["tag"];
$lockedit = $settings2["lock"]["edit"];
$lockfosh = $settings2["lock"]["fosh"];
$lockbots = $settings2["lock"]["bot"];
$lockforward = $settings2["lock"]["forward"];
$locktg = $settings2["lock"]["tgservic"];
$lockreply = $settings2["lock"]["reply"];
$lockcmd = $settings2["lock"]["cmd"];
$lockurl = $settings2["lock"]["url"];
$lockjoin = $settings2["lock"]["join"];
$locktabchi = $settings2["lock"]["tabchi"];
$lockgroup = $settings2["lock"]["group"];

          botevoobot('editMessageReplyMarkup',[
              'chat_id'=>$chatid,
   'message_id'=>$messageid,
              'reply_markup'=>json_encode([
                 'inline_keyboard'=>[
 [
 ['text'=>"• لينک",'callback_data'=>'text'],['text'=>"$locklink",'callback_data'=>'locklink']
 ],
  [
['text'=>"• لینک سایت",'callback_data'=>'text'],['text'=>"$lockurl",'callback_data'=>'lockurl']
],
  [
 ['text'=>"• هشتگ [#]",'callback_data'=>'text'],['text'=>"$locktag",'callback_data'=>'locktag']
 ],
   [
 ['text'=>"• یوزرنیم [@]",'callback_data'=>'text'],['text'=>"$lockusername",'callback_data'=>'lockusername']
 ],
  [
 ['text'=>"• ویرایش پیام",'callback_data'=>'text'],['text'=>"$lockedit",'callback_data'=>'lockedit']
 ],
  [
 ['text'=>"• فحش",'callback_data'=>'text'],['text'=>"$lockfosh",'callback_data'=>'lockfosh']
 ],
 [
['text'=>"• ورود ربات ها",'callback_data'=>'text'],['text'=>"$lockbots",'callback_data'=>'lockbot']
],
  [
 ['text'=>"• فوروارد",'callback_data'=>'text'],['text'=>"$lockforward",'callback_data'=>'lockforward']
 ],
[
['text'=>"• خدمات تلگرام",'callback_data'=>'text'],['text'=>"$locktg",'callback_data'=>'locktgservic']
],
[
['text'=>"• ریپلای",'callback_data'=>'text'],['text'=>"$lockreply",'callback_data'=>'lockreply']
],
[
['text'=>"• دستورات عمومی",'callback_data'=>'text'],['text'=>"$lockcmd",'callback_data'=>'lockcmd']
],
[
['text'=>"• عضویت",'callback_data'=>'text'],['text'=>"$lockjoin",'callback_data'=>'lockjoin']
],
[
['text'=>"• تبچی",'callback_data'=>'text'],['text'=>"$locktabchi",'callback_data'=>'locktabchi']
],
[
['text'=>"• گروه",'callback_data'=>'text'],['text'=>"$lockgroup",'callback_data'=>'lockgroup']
],
[
['text'=>"🔑 تنظیمات رسانه",'callback_data'=>'media']
],
[
['text'=>"🔙 برگشت",'callback_data'=>'settings'],['text'=>"$nemechannel",'url'=>"https://telegram.me/$channel"]
],
                    ]
             ])
         ]);
	 botevoobot('answercallbackquery', [
	            'callback_query_id' =>$membercall,
            'text' => "قفل $gettext فعال شد 🔒",
            'show_alert' =>false
        ]);	
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
		 }else{
			botevoobot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"شما مدیر ربات نیستید ⚠️",
]);
  }
  }
  elseif($textmassage=="/settings" or $textmassage=="settings" or $textmassage=="تنظیمات"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev)){
$locklink = $settings["lock"]["link"];
$lockusername = $settings["lock"]["username"];
$locktag = $settings["lock"]["tag"];
$lockedit = $settings["lock"]["edit"];
$lockfosh = $settings["lock"]["fosh"];
$lockbots = $settings["lock"]["bot"];
$lockforward = $settings["lock"]["forward"];
$locktg = $settings["lock"]["tgservic"];
$lockreply = $settings["lock"]["reply"];
$lockcmd = $settings["lock"]["cmd"];
$lockjoin = $settings["lock"]["join"];
$locktabchi = $settings["lock"]["tabchi"];
$lockgroup = $settings["lock"]["group"];
$lockdocument = $settings["lock"]["document"];
$lockgif = $settings["lock"]["gif"];
$lockvideo_note = $settings["lock"]["video_msg"];
$locklocation = $settings["lock"]["location"];
$lockphoto = $settings["lock"]["photo"];
$lockcontact = $settings["lock"]["contact"];
$lockaudio = $settings["lock"]["audio"];
$lockvoice = $settings["lock"]["voice"];
$locksticker = $settings["lock"]["sticker"];
$lockgame = $settings["lock"]["game"];
$lockvideo = $settings["lock"]["video"];
$locktext = $settings["lock"]["text"];
$mute_all = $settings["lock"]["mute_all"];
$welcome = $settings["information"]["welcome"];
$add = $settings["information"]["add"];
$setwarn = $settings["information"]["setwarn"];
$charge = $settings["information"]["charge"];
$lockauto = $settings["lock"]["lockauto"];
$lockcharacter = $settings["lock"]["lockcharacter"];
$startlock = $settings["information"]["timelock"];
$endlock = $settings["information"]["timeunlock"];
$startlockcharacter = $settings["information"]["pluscharacter"];
$endlockcharacter = $settings["information"]["downcharacter"];
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
$text = str_replace("| فعال |","","

🛠قفل های مدیریتی :

🎗》🔒لینک : $locklink
🎗》🔒هشتگ : $locktag
🎗》🔒یوزرنیم : $lockusername
🎗》🔒ویرایش پیام : $lockedit
🎗》🔒فحش : $lockfosh
🎗》🔒ورود ربات : $lockbots
🎗》🔒فوروارد : $lockforward
🎗》🔒خدمات تلگرام : $locktg
🎗》🔒ریپلای : $lockreply
🎗》🔒دستورات عمومی : $lockcmd
🎗》🔒عضویت : $lockjoin
🎗》🔒تبچی : $locktabchi
🎗》🔒گروه : $lockgroup

📂قفل های رسانه :

🎗》🔒فایل : $lockdocument
🎗》🔒گیف : $lockgif
🎗》🔒پیام ویدیویی : $lockvideo_note
🎗》🔒ارسال مکان : $locklocation
🎗》🔒تصویر : $lockphoto
🎗》🔒ارسال شماره : $lockcontact
🎗》🔒موسیقی : $lockaudio
🎗》🔒صدا : $lockvoice
🎗》🔒استیکر : $locksticker
🎗》🔒بازی : $lockgame
🎗》🔒فیلم : $lockvideo
🎗》🔒متن : $locktext

🚦قفل های دیگر :

♨️سکوت همه :  $mute_all
🔅خوش امد گویی : $welcome
🔱 اد اجباری : $add
⚠️حداکثر اخطار : $setwarn
قفل خودکار : $lockauto
⏲زمان الان : $date1
⏰زمان شروع سکوت گروه : $startlock
🕰زمان خاموش شدن سکوت گروه : $endlock
📝قفل کاراکتر : $lockcharacter
🖍حداقل تعداد کاراکتر پیام : $startlockcharacter
🖌حداکثر تعداد کراکتر پیام : $endlockcharacter

📌اطلاعات گروه :

🔸نام گروه : $namegroup
🔹ایدی گروه : [$chat_id]
📦میزان شارژ گروه : $endtime
📍یوزرنیم شما : @$username
");
$text2 = str_replace("| غیر فعال |","","$text");
	botevoobot('sendmessage',[ 
 'chat_id'=>$chat_id,
 'text'=>"$text2",
'reply_to_message_id'=>$message_id,
	   'reply_markup'=>json_encode([
    'inline_keyboard'=>[
 	[
['text'=>"🚧 حالت شیشه ای",'callback_data'=>'back']
	  ],
	  	  	 [
				 ['text'=>"$nemechannel",'url'=>"https://telegram.me/$channel"]
		 ],
   ]
   ])
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