<?php
/*
Bot : Management Group pro
Dev : Factweb team
Website: Factweb.ir
Channel : @factweb
*/
// msg check
// bots
if($settings["lock"]["bot"] == "| فعال | ✅"){
if ($message->new_chat_member->is_bot) {
$hardmodebot = $settings["information"]["hardmodebot"];
if($hardmodebot == "| غیر فعال | ❌"){
 botevoobot('kickChatMember',[
 'chat_id'=>$chat_id,
  'user_id'=>$update->message->new_chat_member->id
  ]);
  }
else
{
 botevoobot('kickChatMember',[
 'chat_id'=>$chat_id,
  'user_id'=>$update->message->new_chat_member->id
  ]);
   botevoobot('kickChatMember',[
 'chat_id'=>$chat_id,
  'user_id'=>$from_id
  ]);
}
}
}
// sticker
if ($settings["lock"]["sticker"] == "| فعال | ✅"){
if($update->message->sticker){
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
// forward
if ($settings["lock"]["forward"] == "| فعال | ✅"){
if($update->message->forward_from | $update->message->forward_from_chat){
if ($tc == 'group' | $tc == 'supergroup'){
if ( $status != 'creator' && $status != 'administrator' && !in_array($from_id,$Dev) ){
 botevoobot('deletemessage',[
    'chat_id'=>$chat_id,
    'message_id'=>$message->message_id
    ]);
 }
}
}
}
// fosh 
if ($settings["lock"]["fosh"] == "| فعال | ✅"){
if (strstr($textmassage,"کسده") == true  or strstr($textmassage,"جنده") == true or strstr($textmassage,"کیر") == true  or  strstr($textmassage,"سکسی") == true   or strstr($textmassage,"ناموس") == true) {
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
// Grouplock
if ($settings["lock"]["group"] == "| فعال | ✅"){
if($update->message){
if ( $status != 'creator' && $status != 'administrator' && !in_array($from_id,$Dev) ){
 botevoobot('deletemessage',[
    'chat_id'=>$chat_id,
    'message_id'=>$message->message_id
    ]);
 }
}
}
// muteall
if ($settings["lock"]["mute_all"] == "| فعال | ✅"){
if($update->message){
if ( $status != 'creator' && $status != 'administrator' && !in_array($from_id,$Dev) ){
 botevoobot('deletemessage',[
    'chat_id'=>$chat_id,
    'message_id'=>$message->message_id
    ]);
 }
}
}
// muteall time
if ($settings["lock"]["mute_all_time"] == "| فعال | ✅"){
$locktime = $settings["information"]["mute_all_time"];
date_default_timezone_set('Asia/Tehran');
$date1 = date("h:i:s");
if($date1 < $locktime){
if($update->message){
if ( $status != 'creator' && $status != 'administrator' && !in_array($from_id,$Dev) ){
 botevoobot('deletemessage',[
    'chat_id'=>$chat_id,
    'message_id'=>$message->message_id
    ]);
 }
else
{
$settings["lock"]["mute_all_time"]="| غیر فعال | ❌";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
}
}
}
}
// replay
if ($settings["lock"]["reply"] == "| فعال | ✅"){
if($update->message->reply_to_message){
if ($tc == 'group' | $tc == 'supergroup'){
if ( $status != 'creator' && $status != 'administrator' && !in_array($from_id,$Dev) ){
 botevoobot('deletemessage',[
    'chat_id'=>$chat_id,
    'message_id'=>$message->message_id
    ]);
 }
}
}
}
// tg
if ($settings["lock"]["tgservic"] == "| فعال | ✅"){
if($update->message->new_chat_member | $update->message->new_chat_photo | $update->message->new_chat_title | $update->message->left_chat_member | $update->message->pinned_message){
if ($tc == 'group' | $tc == 'supergroup'){
 botevoobot('deletemessage',[
    'chat_id'=>$chat_id,
    'message_id'=>$message->message_id
    ]);
 }
}
}
// text
if ($settings["lock"]["text"] == "| فعال | ✅"){
if($update->message->text){
if ($tc == 'group' | $tc == 'supergroup'){
if ( $status != 'creator' && $status != 'administrator' && !in_array($from_id,$Dev) ){
 botevoobot('deletemessage',[
    'chat_id'=>$chat_id,
    'message_id'=>$message->message_id
    ]);
 }
}
}
}

// video note
if ($settings["lock"]["video_msg"] == "| فعال | ✅"){
if($update->message->video_note){
if ($tc == 'group' | $tc == 'supergroup'){
if ( $status != 'creator' && $status != 'administrator' && !in_array($from_id,$Dev) ) {
 botevoobot('deletemessage',[
    'chat_id'=>$chat_id,
    'message_id'=>$message->message_id
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
// restart settings 
if($settings["information"]["step"] == "reset"){
if($textmassage == "بله"){
              botevoobot('sendmessage', [
                'chat_id' => $chat_id,
             'text'=>"✅ تنظیمات گروه با موفقیت ریستارت شد
🔅 نام : [$first_name]
🔅 یوزرنیم : [ @$username ]
🔅 ایدی : [$from_id]
",
'reply_markup'=>$inlinebutton,
 ]);
$settings["lock"]["link"]="| غیر فعال | ❌";
$settings["lock"]["url"]="| غیر فعال | ❌";
$settings["lock"]["photo"]="| غیر فعال | ❌";
$settings["lock"]["text"]="| غیر فعال | ❌";
$settings["lock"]["tag"]="| غیر فعال | ❌";
$settings["lock"]["username"]="| غیر فعال | ❌";
$settings["lock"]["sticker"]="| غیر فعال | ❌";
$settings["lock"]["video"]="| غیر فعال | ❌";
$settings["lock"]["voice"]="| غیر فعال | ❌";
$settings["lock"]["audio"]="| غیر فعال | ❌";
$settings["lock"]["forward"]="| غیر فعال | ❌";
$settings["lock"]["tgservices"]="| غیر فعال | ❌";
$settings["lock"]["gif"]="| غیر فعال | ❌";
$settings["lock"]["bot"]="| غیر فعال | ❌";
$settings["lock"]["document"]="| غیر فعال | ❌";
$settings["lock"]["tgservic"]="| غیر فعال | ❌";
$settings["lock"]["edit"]="| غیر فعال | ❌";
$settings["lock"]["reply"]="| غیر فعال | ❌";
$settings["lock"]["contact"]="| غیر فعال | ❌";
$settings["lock"]["game"]="| غیر فعال | ❌";
$settings["lock"]["cmd"]="| غیر فعال | ❌";
$settings["lock"]["join"]="| غیر فعال | ❌";
$settings["lock"]["tabchi"]="| غیر فعال | ❌";
$settings["lock"]["group"]="| غیر فعال | ❌";
$settings["lock"]["mute_all"]="| غیر فعال | ❌";
$settings["lock"]["mute_all_time"]="| غیر فعال | ❌";
$settings["lock"]["fosh"]="| غیر فعال | ❌";
$settings["lock"]["video_msg"]="| غیر فعال | ❌";
$settings["lock"]["lockauto"]="| غیر فعال | ❌";
$settings["lock"]["lockcharacter"]="| غیر فعال | ❌";
$settings["information"]["welcome"]="| غیر فعال | ❌";
$settings["information"]["add"]="| غیر فعال | ❌";
$settings["information"]["lockchannel"]="| غیر فعال | ❌";
$settings["information"]["setadd"]="3";
$settings["information"]["setwarn"]="3";
$settings["information"]["textwelcome"]="خوش امدید";
$settings["information"]["rules"]="ثبت نشده";
$settings["information"]["timelock"]="00:00";
$settings["information"]["timeunlock"]="00:00";
$settings["information"]["pluscharacter"]="300";
$settings["information"]["downcharacter"]="0";
$settings["information"]["step"]="none";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
}else{
	botevoobot('sendmessage',[
          'chat_id' => $chat_id,
'text'=>"درخواست شما با موفقیت رد شد ✅",
]);
$settings["information"]["step"]="none";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
 }
}
// buy charge
if(file_exists("data/$from_id.txt") && $tc == "private"){
		date_default_timezone_set('Asia/Tehran');
		$date1 = date('Y-m-d', time());
		$date2 = isset($_GET['date']) ? $_GET['date'] : date('Y-m-d');
		$next_date = date('Y-m-d', strtotime($date2 ." +30 day"));
	botevoobot('sendmessage',[
        "chat_id"=>$chat_id,
        "text"=>"✅ گروه شما با موفقیت شارژ شد"
		]);
			botevoobot('sendmessage',[
        "chat_id"=>$textmassage,
        "text"=>"✅ شارژ با موفقیت برای این گروه خریداری شد"
		]);
$settings = getGroupSettings($textmassage);
$settings["information"]["expire"]="$next_date";
$settings["information"]["charge"]="30 روز";
$settings = json_encode($settings,true);
file_put_contents("data/$textmassage.json",$settings);
unlink("data/$from_id.txt");
}
 // left group when end charge
date_default_timezone_set('Asia/Tehran');
$date4 = date('Y-m-d', time());
if ($tc == 'group' | $tc == 'supergroup'){ 
if($settings["information"]["expire"] != false){
if($date4 > $settings["information"]["expire"]){
			botevoobot('sendmessage',[
            'chat_id'=>$Dev[0],
            'text'=>"☀️شارژ یک گروه به پایان رسید
☀️ربات این گروه را ترک کرد
☀️ایدی گروه : [$chat_id]
☀️نام گروه : [$namegroup]

",
        ]); 
			 botevoobot('sendmessage',[
            'chat_id'=>$chat_id,
            'text'=>"☀️شارژ یک گروه به پایان رسید
☀️ربات این گروه را ترک کرد
☀️ایدی گروه : [$chat_id]
☀️نام گروه : [$namegroup]

پیام های گروه دیگر بررسی نمی شوند 🚧
👇 لطفا پس از شارژ ربات از طریق دکمه های زیر اقدام به اضافه کردن ربات به گروه کنید 👇",
 'reply_markup'=>json_encode([
            'inline_keyboard'=>[
	[
	['text'=>"☀️یک ماهه ☀️",'url'=>"$web/pay/pay.php?id=$chatid&amount=5000&time=30&from=$from_id"]
	],
]
])
]);
        botevoobot('LeaveChat', [
        'chat_id' =>$chat_id,
    ]);
    }
}
}
// welcome
if ($settings["information"]["welcome"] == "| فعال | ✅"){
if($update->message->new_chat_member){
if ($message->new_chat_member->is_bot == false){
if ($tc == "group" | $tc == "supergroup"){
$text2 = $settings["information"]["textwelcome"];
$newmemberuser = $update->message->new_chat_member->username;
$text = str_replace("gpname","$namegroup","$text2");
$text1 = str_replace("username","$newmemberuser","$text");
botevoobot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"$text1",
	]);
}
}
}
}
// lock character
if($settings["lock"]["lockcharacter"] == "| فعال | ✅"){
if ($status != 'creator' && $status != 'administrator' && !in_array($from_id,$Dev)){
$plus = mb_strlen("$textmassage");
$pluscharacter = $settings["information"]["pluscharacter"];
$downcharacter = $settings["information"]["downcharacter"];
if ($pluscharacter < $plus or $plus < $downcharacter) {   
botevoobot('deletemessage',[
    'chat_id'=>$chat_id,
    'message_id'=>$message_id
    ]);
  }
}
}
// autolock 
if ($settings["lock"]["lockauto"] == "| فعال | ✅"){
date_default_timezone_set('Asia/Tehran');
$date1 = date("H:i");
$timelockauto = $settings["information"]["timelock"];
$unlocktime = $settings["information"]["timeunlock"];
if($unlocktime > $date1 && $date1 > $timelockauto){
if ($tc == 'group' | $tc == 'supergroup'){
if ( $status != 'creator' && $status != 'administrator' && !in_array($from_id,$Dev) ) {
$timeremmber = $settings["information"]["timeremmber"];
if($date1 < $timeremmber){
 botevoobot('deletemessage',[
    'chat_id'=>$chat_id,
    'message_id'=>$message->message_id
    ]);
}
else
{
	 botevoobot('deletemessage',[
    'chat_id'=>$chat_id,
    'message_id'=>$message->message_id
    ]);

		botevoobot('sendmessage',[
            'chat_id'=>$chat_id,
            'text'=>"🔕 قفل خودکار در گروه فعال است 

🔆زمان الان : $date1
🔆زمان شروع قفل : $timelockauto
🔆زمان پایان قفل : $unlocktime",
'reply_markup'=>$inlinebutton,
   ]);
$next_date = date('H:i', strtotime($date1 ."+180 Minutes"));
$settings["information"]["timeremmber"]="$next_date";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
}
}
}
}
}
// panel
elseif ($user["userjop"]["$from_id"]["file"] == 'adsusers') {
$user["userjop"]["$from_id"]["file"]="none";
$numbers = $user["userlist"];
$user = json_encode($user,true);
file_put_contents("data/user.json",$user);	
if ($textmassage != "🔙 برگشت") {
         botevoobot('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"✔️ متن با موفقیت تنظیم شد️",
	  'reply_to_message_id'=>$message_id,
 ]);
file_put_contents("data/tablighat.txt",$textmassage);
/*
Bot : Management Group pro
Dev : Factweb team
Website: Factweb.ir
Channel : @factweb
*/
}
}
elseif ($user["userjop"]["$from_id"]["file"] == 'startbot') {
$user["userjop"]["$from_id"]["file"]="none";
$numbers = $user["userlist"];
$user = json_encode($user,true);
file_put_contents("data/user.json",$user);	
if ($textmassage != "🔙 برگشت") {
         botevoobot('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"✔️ متن با موفقیت تنظیم شد️",
	  'reply_to_message_id'=>$message_id,
 ]);
file_put_contents("data/start.txt",$textmassage);
/*
Bot : Management Group pro
Dev : Factweb team
Website: Factweb.ir
Channel : @factweb
*/
}
}
elseif ($user["userjop"]["$from_id"]["file"] == 'freedaysme') {
$user["userjop"]["$from_id"]["file"]="none";
$numbers = $user["userlist"];
$user = json_encode($user,true);
file_put_contents("data/user.json",$user);	
$outputString = preg_replace('/[^0-9]/', '', $textmassage);  
if ($textmassage != "🔙 برگشت" && $textmassage == $outputString) {
         botevoobot('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"✔️ تعداد روزها با موفقیت تنظیم شد️",
	  'reply_to_message_id'=>$message_id,
 ]);
file_put_contents("data/fredays.txt",$textmassage);
/*
Bot : Management Group pro
Dev : Factweb team
Website: Factweb.ir
Channel : @factweb
*/
}
}
elseif ($user["userjop"]["$from_id"]["file"] == 'forwarduser') {
$user["userjop"]["$from_id"]["file"]="none";
$numbers = $user["userlist"];
$user = json_encode($user,true);
file_put_contents("data/user.json",$user);	
if ($textmassage != "🔙 برگشت") {
         botevoobot('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"پیام با موفقیت ارسال شد ✔️",
	  'reply_to_message_id'=>$message_id,
 ]);
for($z = 0;$z <= count($numbers)-1;$z++){
Forward($numbers[$z], $chat_id,$message_id);
}
}
}
elseif ($user["userjop"]["$from_id"]["file"] == 'forwardgroup') {
$user["userjop"]["$from_id"]["file"]="none";
$numbers = $user["grouplist"];
$user = json_encode($user,true);
file_put_contents("data/user.json",$user);	
if ($textmassage != "برگشت 🔙") {
         botevoobot('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"پیام با موفقیت ارسال شد ✔️",
	  'reply_to_message_id'=>$message_id,
 ]);
for($z = 0;$z <= count($numbers)-1;$z++){
Forward($numbers[$z], $chat_id,$message_id);
}
}
}
elseif ($user["userjop"]["$from_id"]["file"] == 'sendgroup') {
$user["userjop"]["$from_id"]["file"]="none";
$numbers = $user["grouplist"];
$user = json_encode($user,true);
file_put_contents("data/user.json",$user);	
if ($textmassage != "برگشت 🔙") {
         botevoobot('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"پیام با موفقیت ارسال شد ✔️",
	  'reply_to_message_id'=>$message_id,
 ]);
for($z = 0;$z <= count($numbers)-1;$z++){
     botevoobot('sendmessage',[
          'chat_id'=>$numbers[$z],        
		  'text'=>"$textmassage",
        ]);
}
}
}
elseif ($user["userjop"]["$from_id"]["file"] == 'senduser') {
$user["userjop"]["$from_id"]["file"]="none";
$numbers = $user["userlist"];
$user = json_encode($user,true);
file_put_contents("data/user.json",$user);	
if ($textmassage != "برگشت 🔙") {
         botevoobot('sendmessage',[
        	'chat_id'=>$chat_id,
        	'text'=>"پیام با موفقیت ارسال شد ✔️",
	  'reply_to_message_id'=>$message_id,
 ]);
for($z = 0;$z <= count($numbers)-1;$z++){
     botevoobot('sendmessage',[
          'chat_id'=>$numbers[$z],        
		  'text'=>"$textmassage",
        ]);
}
/*
Bot : Management Group pro
Dev : Factweb team
Website: Factweb.ir
Channel : @factweb
*/
}
}
?>