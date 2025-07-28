<?php
/*
Bot : Management Group pro
Dev : Factweb team
Website: Factweb.ir
Channel : @factweb
*/
if($data=="panel2"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$Dev) ){
            botevoobot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"به پنل مدیریت گروه خوش امدید❤️[بخش دوم]
🔻از دکمه های زیر استفاده کنید",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
                     [
                     ['text'=>"🎮 سرگرمی",'callback_data'=>'game'],['text'=>"🛃 قفل خودکار",'callback_data'=>'lockauto']
					 ],
					 [
					 ['text'=>"💭 خوش امد گویی",'callback_data'=>'welcome'],['text'=>"🔃 ریستارت تنظیمات",'callback_data'=>'restart']
					 ],
					 [
					 ['text'=>"📊 ادد اجباری",'callback_data'=>'addbzn'],['text'=>"⚠️حساسیت اخطار",'callback_data'=>'warn']
					 ],
					 					 [
					 ['text'=>"📣 قفل کانال",'callback_data'=>'lockchannel'],['text'=>"♨️ حالت سختگیرانه",'callback_data'=>'hardmode']
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
 elseif($data=="restart"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$Dev) ){
            botevoobot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"✅ درصورتی که میخواهید تنظیمات گروه به حالت اولیه بازگردد
🌟تایید را انتخاب کنید",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[

					 [
					 ['text'=>"تایید ✅",'callback_data'=>'yes']
					 ],
					 [
					 ['text'=>"$nemechannel",'url'=>"https://telegram.me/$channel"],['text'=>"🔙 برگشت",'callback_data'=>'back']
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
													    elseif($data=="yes"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$Dev) ){
$settings2["lock"]["link"]="| غیر فعال | ❌";
$settings2["lock"]["photo"]="| غیر فعال | ❌";
$settings2["lock"]["text"]="| غیر فعال | ❌";
$settings2["lock"]["tag"]="| غیر فعال | ❌";
$settings2["lock"]["username"]="| غیر فعال | ❌";
$settings2["lock"]["sticker"]="| غیر فعال | ❌";
$settings2["lock"]["video"]="| غیر فعال | ❌";
$settings2["lock"]["voice"]="| غیر فعال | ❌";
$settings2["lock"]["audio"]="| غیر فعال | ❌";
$settings2["lock"]["forward"]="| غیر فعال | ❌";
$settings2["lock"]["tgservices"]="| غیر فعال | ❌";
$settings2["lock"]["gif"]="| غیر فعال | ❌";
$settings2["lock"]["bot"]="| غیر فعال | ❌";
$settings2["lock"]["document"]="| غیر فعال | ❌";
$settings2["lock"]["tgservic"]="| غیر فعال | ❌";
$settings2["lock"]["edit"]="| غیر فعال | ❌";
$settings2["lock"]["reply"]="| غیر فعال | ❌";
$settings2["lock"]["contact"]="| غیر فعال | ❌";
$settings2["lock"]["game"]="| غیر فعال | ❌";
$settings2["lock"]["cmd"]="| غیر فعال | ❌";
$settings2["lock"]["join"]="| غیر فعال | ❌";
$settings2["lock"]["tabchi"]="| غیر فعال | ❌";
$settings2["lock"]["group"]="| غیر فعال | ❌";
$settings2["lock"]["answer"]="| غیر فعال | ❌";
$settings2["lock"]["mute_all"]="| غیر فعال | ❌";
$settings2["lock"]["mute_all_time"]="| غیر فعال | ❌";
$settings2["lock"]["fosh"]="| غیر فعال | ❌";
$settings2["lock"]["lockauto"]="| غیر فعال | ❌";
$settings2["lock"]["lockcharacter"]="| غیر فعال | ❌";
$settings2["lock"]["video_msg"]="| غیر فعال | ❌";
$settings2["information"]["welcome"]="| غیر فعال | ❌";
$settings2["information"]["add"]="| غیر فعال | ❌";
$settings2["information"]["lockchannel"]="| غیر فعال | ❌";
$settings2["information"]["setadd"]="3";
$settings2["information"]["setwarn"]="3";
$settings2["information"]["textwelcome"]="خوش امدید";
$settings2["information"]["rules"]="ثبت نشده";
$settings2["information"]["timelock"]="00:00";
$settings2["information"]["timeunlock"]="00:00";
$settings2["information"]["pluscharacter"]="300";
$settings2["information"]["downcharacter"]="0";
$settings2["information"]["step"]="none";
$settings = json_encode($settings,true);
file_put_contents("data/$chatid.json",$settings); 
            botevoobot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"
✅ تنظیمات گروه با موفقیت ریستارت شد
▪️نام  : [$firstname]
▪️ایدی  : [$fromid]
▪️یوزرنیم  : [@$usernames]
",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
					 [
					 ['text'=>"$nemechannel",'url'=>"https://telegram.me/$channel"],['text'=>"🔙 برگشت",'callback_data'=>'back']
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
							    elseif($data=="game"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$Dev) ){
            botevoobot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"✨به بخش سرگرمی خوش امدید
🚩 از دکمه های زیر استفاده کنید",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
                     [
                     ['text'=>"🕜 ساعت و تاریخ",'callback_data'=>'td'],['text'=>"😂 جک",'callback_data'=>'jock']
					 ],
					 [
					 ['text'=>"📢 ایا میدانستید؟",'callback_data'=>'aya']
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
			    elseif($data=="welcome"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$Dev) ){
$welcome = $settings2["information"]["welcome"];
            botevoobot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"✨به بخش خوش امد گویی خوش امدید
🚩 از دکمه های زیر استفاده کنید",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
                     [
                     ['text'=>"🎗خوش امدگویی",'callback_data'=>'text'],['text'=>"$welcome",'callback_data'=>'pwelcome']
					 ],
					 [
					 ['text'=>"📜 متن خوش امد",'callback_data'=>'textwelcome']
					 ],
					 [
					 ['text'=>"$nemechannel",'url'=>"https://telegram.me/$channel"],['text'=>"🔙 برگشت",'callback_data'=>'back']
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
				    elseif($data=="textwelcome"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$Dev) ){
$textwelcome = $settings2["information"]["textwelcome"];
            botevoobot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"✅ متن خوش امد گویی گروه   
$textwelcome",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
					 [
					 ['text'=>"$nemechannel",'url'=>"https://telegram.me/$channel"],['text'=>"🔙 برگشت",'callback_data'=>'welcome']
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
					    elseif($data=="pwelcome" && $settings2["information"]["welcome"] =="| فعال | ✅" ){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$Dev) ){
            botevoobot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"
🚩 از دکمه های زیر استفاده کنید
خوش امد گویی خاموش شد ❌",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				     [
                     ['text'=>"🎗خوش امدگویی",'callback_data'=>'text'],['text'=>"| غیر فعال | ❌",'callback_data'=>'pwelcome']
					 ],
			    	 [
					 ['text'=>"📜 متن خوش امد",'callback_data'=>'textwelcome']
					 ],
					 [
					 ['text'=>"$nemechannel",'url'=>"https://telegram.me/$channel"],['text'=>"🔙 برگشت",'callback_data'=>'back']
					 ],
                     ]
               ])
           ]);
$settings2["information"]["welcome"]="| غیر فعال | ❌";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
		   }
		  else{
			botevoobot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"شما مدیر ربات نیستید ⚠️",
]);
    }
						}
						    elseif($data=="pwelcome" && $settings2["information"]["welcome"] == "| غیر فعال | ❌"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$Dev) ){
            botevoobot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"
🚩 از دکمه های زیر استفاده کنید
خوش امد گویی روشن شد ✅",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
				     [
                     ['text'=>"🎗خوش امدگویی",'callback_data'=>'text'],['text'=>"| فعال | ✅",'callback_data'=>'pwelcome']
					 ],
					 [
					 ['text'=>"📜 متن خوش امد",'callback_data'=>'textwelcome']
					 ],
					 [
					 ['text'=>"$nemechannel",'url'=>"https://telegram.me/$channel"],['text'=>"🔙 برگشت",'callback_data'=>'back']
					 ],
                     ]
               ])
           ]);
$settings2["information"]["welcome"]="| فعال | ✅";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
		   }else{
			botevoobot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"شما مدیر ربات نیستید ⚠️",
]);
    }
							}
		    elseif($data=="td"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$Dev) ){
            botevoobot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"به بخش دریافت ساعت و تاریخ خوش امدید😃
🔻از دکمه های زیر استفاده کنید",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
                     [
                     ['text'=>"⏰ ساعت",'callback_data'=>'time'],['text'=>"📅 تاریخ",'callback_data'=>'data']
					 ],
					 [
					 ['text'=>"$nemechannel",'url'=>"https://telegram.me/$channel"],['text'=>"🔙 برگشت",'callback_data'=>'back']
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
						    elseif($data=="jock"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$Dev) ){
				$jock = file_get_contents("http://beyondteam.000webhostapp.com/PersianJoke.php");
            botevoobot('editmessagetext',[
                'chat_id'=>$chatid,
		 
     'message_id'=>$messageid,
               'text'=>"$jock",
		 
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
                     [
                     ['text'=>"😆 یه جک دیگه",'callback_data'=>'jock']
					 ],
					 [
					 ['text'=>"$nemechannel",'url'=>"https://telegram.me/$channel"],['text'=>"🔙 برگشت",'callback_data'=>'game']
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
						 elseif($data=="aya"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$Dev) ){
				$aya = file_get_contents("https://api.bot-dev.org/danestani/");
            botevoobot('editmessagetext',[
                'chat_id'=>$chatid,
		 
     'message_id'=>$messageid,
               'text'=>"$aya",
		 
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
                     [
                     ['text'=>"📢 یکی دیگه!",'callback_data'=>'aya']
					 ],
					 [
					 ['text'=>"$nemechannel",'url'=>"https://telegram.me/$channel"],['text'=>"🔙 برگشت",'callback_data'=>'game']
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
			    elseif($data=="time"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$Dev) ){
$get = file_get_contents('http://apisaaz.ir/api/time/');
$result = json_decode($get, true);
#--Result
$time = $result['time'];
$date = $result['date'];
$today = $result['today'];
            botevoobot('editmessagetext',[
                'chat_id'=>$chatid,
		 
     'message_id'=>$messageid,
               'text'=>"⏱ ساعت :$time",
		 
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
                     [
                     ['text'=>"⏰ ساعت",'callback_data'=>'time'],['text'=>"📅 تاریخ",'callback_data'=>'data']
					 ],
					 [
					 ['text'=>"$nemechannel",'url'=>"https://telegram.me/$channel"],['text'=>"🔙 برگشت",'callback_data'=>'back']
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
				    elseif($data=="data"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$Dev) ){
$get = file_get_contents('http://apisaaz.ir/api/time/');
$result = json_decode($get, true);
#--Result
$time = $result['time'];
$date = $result['date'];
$today = $result['today'];
            botevoobot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"📆 تاریخ :$today , $date",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
                     [
                     ['text'=>"⏰ ساعت",'callback_data'=>'time'],['text'=>"📅 تاریخ",'callback_data'=>'data']
					 ],
					 [
					 ['text'=>"$nemechannel",'url'=>"https://telegram.me/$channel"],['text'=>"🔙 برگشت",'callback_data'=>'back']
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
		  elseif($data=="lockall" && $settings2["lock"]["mute_all"] =="| فعال | ✅"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$Dev) ){
          botevoobot('editmessagetext',[
              'chat_id'=>$chatid,
   'message_id'=>$messageid,
             'text'=>"🌟تنظیمات گروه :
▪️ایدی گروه : [$chatid]
▪️نام گروه : [$gpname]
✅لطفا بخش مورد نظر خود را انتخاب کنید
",
             'reply_markup'=>json_encode([
                 'inline_keyboard'=>[
 [
 ['text'=>"🔗 تنظیمات رسانه",'callback_data'=>'media'],['text'=>"⚒ تنظیمات مدیریت",'callback_data'=>'other']
 ],
 [
 ['text'=>"📌 قفل همه",'callback_data'=>'text'],['text'=>"| غیر فعال | ❌",'callback_data'=>'lockall']
 ],
[
['text'=>"🔙 برگشت",'callback_data'=>'back'],['text'=>"$nemechannel",'url'=>"https://telegram.me/$channel"]
],
	]
	])
	]);
$settings2["lock"]["mute_all"]="| غیر فعال | ❌";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
	}else{
			botevoobot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"شما مدیر ربات نیستید ⚠️",
]);
	}
		  }
			  elseif($data=="lockall" && $settings2["lock"]["mute_all"] =="| غیر فعال | ❌"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$Dev) ){
          botevoobot('editmessagetext',[
              'chat_id'=>$chatid,
   'message_id'=>$messageid,
             'text'=>"🌟تنظیمات گروه :
▪️ایدی گروه : [$chatid]
▪️نام گروه : [$gpname]
✅لطفا بخش مورد نظر خود را انتخاب کنید
",
             'reply_markup'=>json_encode([
                 'inline_keyboard'=>[
 [
 ['text'=>"🔗 تنظیمات رسانه",'callback_data'=>'media'],['text'=>"⚒ تنظیمات مدیریت",'callback_data'=>'other']
 ],
 [
 ['text'=>"📌 قفل همه",'callback_data'=>'text'],['text'=>"| فعال | ✅",'callback_data'=>'lockall']
 ],
[
['text'=>"🔙 برگشت",'callback_data'=>'back'],['text'=>"$nemechannel",'url'=>"https://telegram.me/$channel"]
],
	]
	])
	]);
$settings2["lock"]["mute_all"]="| فعال | ✅";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
	}else{
			botevoobot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"شما مدیر ربات نیستید ⚠️",
]);
	}
			  }
			      elseif($data=="warn"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$Dev) ){
$setwarn = $settings2["information"]["setwarn"];
            botevoobot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"به بخش اخطار خوش امدید❤️
🔹در این بخش شما میتوانید حداکثر اخطار برای کاربر را تایین کنید
🔸توجه داشته باشید عدد باید بین 1 تا 20 باشد",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
					 [
					 ['text'=>"⚠️ میزان اخطار",'callback_data'=>'text'],['text'=>"🔸 $setwarn 🔹",'callback_data'=>'text']
					 ],
					 [
					 ['text'=>"➕ افزایش دادن",'callback_data'=>'warn+'],['text'=>"➖ کاهش دادن",'callback_data'=>'warn-']
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
	elseif($data=="warn+"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$Dev) ){
$setwarn = $settings2["information"]["setwarn"];
    $manfi = $setwarn + 1;
    if ($manfi <= 20 && $manfi >= 1){
          botevoobot('editmessagetext',[
              'chat_id'=>$chatid,
   'message_id'=>$messageid,
             'text'=>"به بخش اخطار خوش امدید❤️
افزایش یافت✔️",
             'reply_markup'=>json_encode([
                 'inline_keyboard'=>[
 [
					 ['text'=>"⚠️ میزان اخطار",'callback_data'=>'text'],['text'=>"🔸 $manfi 🔹",'callback_data'=>'text']
					 ],
					 [
					 ['text'=>"➕ افزایش دادن",'callback_data'=>'warn+'],['text'=>"➖ کاهش دادن",'callback_data'=>'warn-']
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
$settings2["information"]["setwarn"]="$manfi";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
	}else{
			botevoobot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"شما مدیر ربات نیستید ⚠️",
]);
	}
		  }
						}
								  		  		elseif($data=="warn-"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$Dev) ){
$setwarn = $settings2["information"]["setwarn"];
    $manfi = $setwarn - 1;
    if ($manfi <= 20 && $manfi >= 1){
          botevoobot('editmessagetext',[
              'chat_id'=>$chatid,
   'message_id'=>$messageid,
             'text'=>"به بخش اخطار خوش امدید❤️
کاهش یافت✔️",
             'reply_markup'=>json_encode([
                 'inline_keyboard'=>[
 [
					 ['text'=>"⚠️ میزان اخطار",'callback_data'=>'text'],['text'=>"🔸 $manfi 🔹",'callback_data'=>'text']
					 ],
					 [
					 ['text'=>"➕ افزایش دادن",'callback_data'=>'warn+'],['text'=>"➖ کاهش دادن",'callback_data'=>'warn-']
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
$settings2["information"]["setwarn"]="$manfi";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
	}else{
			botevoobot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"شما مدیر ربات نیستید ⚠️",
]);
	}
		  }
						}
											    elseif($data=="hardmode"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$Dev) ){
$hardmodebot = $settings2["information"]["hardmodebot"];
$hardmodewarn = $settings2["information"]["hardmodewarn"];
            botevoobot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"♨️ به بخش حالت سخت گیرانه خوش امدید
🚩 از دکمه های زیر استفاده کنید",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
                     [
                     ['text'=>"🤖 اضافه کردن ربات",'callback_data'=>'text'],['text'=>"$hardmodebot",'callback_data'=>'hardmodebot']
					 ],
					            [
                     ['text'=>"❗️ حداکثر اخطار",'callback_data'=>'text'],['text'=>"$hardmodewarn",'callback_data'=>'hardmodewarn']
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
						  elseif($data=="hardmodebot" && $settings2["information"]["hardmodebot"] == "🚷 اخراج کاربر"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$Dev) ){
$hardmodewarn = $settings2["information"]["hardmodewarn"];
                    botevoobot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"♨️ به بخش حالت سخت گیرانه خوش امدید
🚩 حالت سخت گیرانه اضافه کردن ربات غیرفعال شد",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
                     [
                     ['text'=>"🤖 اضافه کردن ربات",'callback_data'=>'text'],['text'=>"| غیر فعال | ❌",'callback_data'=>'hardmodebot']
					 ],
					            [
                     ['text'=>"❗️ حداکثر اخطار",'callback_data'=>'text'],['text'=>"$hardmodewarn",'callback_data'=>'hardmodewarn']
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
$settings2["information"]["hardmodebot"]="| غیر فعال | ❌";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
	}else{
			botevoobot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"شما مدیر ربات نیستید ⚠️",
]);
	}
		  }
		  						  elseif($data=="hardmodebot" && $settings2["information"]["hardmodebot"] == "| غیر فعال | ❌"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$Dev) ){
$hardmodewarn = $settings2["information"]["hardmodewarn"];
                    botevoobot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"♨️ به بخش حالت سخت گیرانه خوش امدید
🚩 حالت سخت گیرانه اضافه کردن ربات فعال شد",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
                     [
                     ['text'=>"🤖 اضافه کردن ربات",'callback_data'=>'text'],['text'=>"🚷 اخراج کاربر",'callback_data'=>'hardmodebot']
					 ],
					            [
                     ['text'=>"❗️ حداکثر اخطار",'callback_data'=>'text'],['text'=>"$hardmodewarn",'callback_data'=>'hardmodewarn']
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
$settings2["information"]["hardmodebot"]="🚷 اخراج کاربر";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
	}else{
			botevoobot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"شما مدیر ربات نیستید ⚠️",
]);
	}
		  }
		  						  elseif($data=="hardmodewarn" && $settings2["information"]["hardmodewarn"] == "🚷 اخراج کاربر"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$Dev) ){
$hardmodebot = $settings2["information"]["hardmodebot"];
                    botevoobot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"♨️ به بخش حالت سخت گیرانه خوش امدید
🚩 حالت سخت گیرانه رسیدن به حداکثر اخطار و سکوت کاربر فعال شد",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
                     [
                     ['text'=>"🤖 اضافه کردن ربات",'callback_data'=>'text'],['text'=>"$hardmodebot",'callback_data'=>'hardmodebot']
					 ],
					            [
                     ['text'=>"❗️ حداکثر اخطار",'callback_data'=>'text'],['text'=>"سکوت کاربر ♨️",'callback_data'=>'hardmodewarn']
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
$settings2["information"]["hardmodewarn"]="سکوت کاربر ♨️";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
	}else{
			botevoobot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"شما مدیر ربات نیستید ⚠️",
]);
	}
		  }
		  						  elseif($data=="hardmodewarn" && $settings2["information"]["hardmodewarn"] == "سکوت کاربر ♨️"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$Dev) ){
$hardmodebot = $settings2["information"]["hardmodebot"];
                    botevoobot('editmessagetext',[
                'chat_id'=>$chatid,
     'message_id'=>$messageid,
               'text'=>"♨️ به بخش حالت سخت گیرانه خوش امدید
🚩 حالت سخت گیرانه رسیدن به حداکثر اخطار و اخراج کاربر فعال شد",
               'reply_markup'=>json_encode([
                   'inline_keyboard'=>[
                     [
                     ['text'=>"🤖 اضافه کردن ربات",'callback_data'=>'text'],['text'=>"$hardmodebot",'callback_data'=>'hardmodebot']
					 ],
					            [
                     ['text'=>"❗️ حداکثر اخطار",'callback_data'=>'text'],['text'=>"🚷 اخراج کاربر",'callback_data'=>'hardmodewarn']
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
$settings2["information"]["hardmodewarn"]="🚷 اخراج کاربر";
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