<?php

// lock
// lock link
if($textmassage=="/lock link" or $textmassage=="قفل لینک"){
    if ($status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev) ){
        $add = $settings["information"]["added"];
        if ($add == true) {
            botevoobot('sendmessage',[
                'chat_id'=>$chat_id,
                'text'=>"✅ قفل لینک فعال شد
🔴 از این پس پیام های حاوی لینک خواهد شد .
🌟 توسط  @$username",
                'reply_to_message_id'=>$message_id,
                'reply_markup'=>$inlinebutton,
            ]);
            $settings["lock"]["link"]="| فعال | ✅";
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
elseif($textmassage=="/unlock link" or $textmassage=="بازکردن لینک"){
    if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev) ){
        $add = $settings["information"]["added"];
        if ($add == true) {
            botevoobot('sendmessage',[
                'chat_id'=>$chat_id,
                'text'=>"✅ قفل لینک آزاد شد
🔴 از این پس پیام های حاوی لینک نخواهد شد .
🌟 توسط  @$username",
                'reply_to_message_id'=>$message_id,
                'reply_markup'=>$inlinebutton,
            ]);
            $settings["lock"]["link"]="| غیر فعال | ❌";
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
// lock url
if($textmassage=="/lock url" or $textmassage=="قفل سایت"){
if ($status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev) ){
$add = $settings["information"]["added"];
if ($add == true) {
botevoobot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"✅ قفل سایت فعال شد
🔴 از این پس پیام های حاوی سایت پاک خواهد شد .
🌟 توسط  @$username",
'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
]);
$settings["lock"]["url"]="| فعال | ✅";
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
elseif($textmassage=="/unlock url" or $textmassage=="بازکردن سایت"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev) ){
$add = $settings["information"]["added"];
if ($add == true) {
botevoobot('sendmessage',[
'chat_id'=>$chat_id,
'text'=>"✅ قفل سایت آزاد شد
🔴 از این پس پیام های حاوی سایت پاک نخواهد شد .
🌟 توسط  @$username",
'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
]);
$settings["lock"]["url"]="| غیر فعال | ❌";
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
// lock photo
elseif($textmassage=="/lock photo" or $textmassage=="قفل عکس"){
    if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev) ){
        $add = $settings["information"]["added"];
        if ($add == true) {
            botevoobot('sendmessage',[
                'chat_id'=>$chat_id,
                'text'=>"✅ قفل عکس فعال شد
🔴 از این پس پیام های حاوی عکس پاک خواهد شد .
🌟 توسط  @$username",
                'reply_to_message_id'=>$message_id,
                'reply_markup'=>$inlinebutton,
            ]);
            $settings["lock"]["photo"]="| فعال | ✅";
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
elseif($textmassage=="/unlock photo" or $textmassage=="بازکردن عکس"){
    if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev) ){
        $add = $settings["information"]["added"];
        if ($add == true) {
            botevoobot('sendmessage',[
                'chat_id'=>$chat_id,
                'text'=>"✅ قفل عکس آزاد شد
🔴 از این پس پیام های حاوی عکس پاک نخواهد شد .
🌟 توسط  @$username",
                'reply_to_message_id'=>$message_id,
                'reply_markup'=>$inlinebutton,
            ]);
            $settings["lock"]["photo"]="| غیر فعال | ❌";
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
// gif
elseif($textmassage=="/lock gif" or $textmassage=="قفل گیف"){
    if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev) ){
        $add = $settings["information"]["added"];
        if ($add == true) {
            botevoobot('sendmessage',[
                'chat_id'=>$chat_id,
                'text'=>"✅ قفل گیف فعال شد
🔴 از این پس پیام های حاوی گیف پاک خواهد شد .
🌟 توسط  @$username",
                'reply_to_message_id'=>$message_id,
                'reply_markup'=>$inlinebutton,
            ]);
            $settings["lock"]["gif"]="| فعال | ✅";
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
elseif($textmassage=="/unlock gif" or $textmassage=="بازکردن گیف"){
    if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev) ){
        $add = $settings["information"]["added"];
        if ($add == true) {
            botevoobot('sendmessage',[
                'chat_id'=>$chat_id,
                'text'=>"✅ قفل گیف آزاد شد
🔴 از این پس پیام های حاوی گیف پاک نخواهد شد .
🌟 توسط  @$username",
                'reply_to_message_id'=>$message_id,
                'reply_markup'=>$inlinebutton,
            ]);
            $settings["lock"]["gif"]="| غیر فعال | ❌";
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
// document
elseif($textmassage=="/lock document" or $textmassage=="قفل فایل"){
    if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev) ){
        $add = $settings["information"]["added"];
        if ($add == true) {
            botevoobot('sendmessage',[
                'chat_id'=>$chat_id,
                'text'=>"✅ قفل فایل فعال شد
🔴 از این پس پیام های حاوی فایل پاک خواهد شد .
🌟 توسط  @$username",
                'reply_to_message_id'=>$message_id,
                'reply_markup'=>$inlinebutton,
            ]);
            $settings["lock"]["document"]="| فعال | ✅";
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
elseif($textmassage=="/unlock document" or $textmassage=="بازکردن فایل"){
    if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev) ){
        $add = $settings["information"]["added"];
        if ($add == true) {
            botevoobot('sendmessage',[
                'chat_id'=>$chat_id,
                'text'=>"✅ قفل فایل آزاد شد
🔴 از این پس پیام های حاوی فایل پاک نخواهد شد .
🌟 توسط  @$username",
                'reply_to_message_id'=>$message_id,
                'reply_markup'=>$inlinebutton,
            ]);
            $settings["lock"]["document"]="| غیر فعال | ❌";
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
// video
elseif($textmassage=="/lock video" or $textmassage=="قفل ویدیو"){
    if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev) ){
        $add = $settings["information"]["added"];
        if ($add == true) {
            botevoobot('sendmessage',[
                'chat_id'=>$chat_id,
                'text'=>"✅ قفل ویدیو فعال شد
🔴 از این پس پیام های حاوی ویدیو پاک خواهد شد .
🌟 توسط  @$username",
                'reply_to_message_id'=>$message_id,
                'reply_markup'=>$inlinebutton,
            ]);
            $settings["lock"]["video"]="| فعال | ✅";
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
elseif($textmassage=="/unlock video" or $textmassage=="بازکردن ویدیو"){
    if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev) ){
        $add = $settings["information"]["added"];
        if ($add == true) {
            botevoobot('sendmessage',[
                'chat_id'=>$chat_id,
                'text'=>"✅ قفل ویدیو آزاد شد
🔴 از این پس پیام های حاوی ویدیو پاک نخواهد شد .
🌟 توسط  @$username",
                'reply_to_message_id'=>$message_id,
                'reply_markup'=>$inlinebutton,
            ]);
            $settings["lock"]["video"]="| غیر فعال | ❌";
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
// edit
elseif($textmassage=="/lock edit" or $textmassage=="قفل ویرایش"){
    if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev) ){
        $add = $settings["information"]["added"];
        if ($add == true) {
            botevoobot('sendmessage',[
                'chat_id'=>$chat_id,
                'text'=>"✅ قفل ویرایش پیام فعال شد
🔴 از این پس پیام های حاوی ویرایش پیام پاک خواهد شد .
🌟 توسط  @$username",
                'reply_to_message_id'=>$message_id,
                'reply_markup'=>$inlinebutton,
            ]);
            $settings["lock"]["edit"]="| فعال | ✅";
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
elseif($textmassage=="/unlock edit" or $textmassage=="بازکردن ویرایش"){
    if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev) ){
        $add = $settings["information"]["added"];
        if ($add == true) {
            botevoobot('sendmessage',[
                'chat_id'=>$chat_id,
                'text'=>"✅ قفل ویرایش پیام آزاد شد
🔴 از این پس پیام های حاوی ویرایش پیام پاک نخواهد شد .
🌟 توسط  @$username",
                'reply_to_message_id'=>$message_id,
                'reply_markup'=>$inlinebutton,
            ]);
            $settings["lock"]["edit"]="| غیر فعال | ❌";
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
// game
elseif($textmassage=="/lock game" or $textmassage=="قفل بازی"){
    if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev) ){
        $add = $settings["information"]["added"];
        if ($add == true) {
            botevoobot('sendmessage',[
                'chat_id'=>$chat_id,
                'text'=>"✅ قفل بازی فعال شد
🔴 از این پس پیام های حاوی بازی پاک خواهد شد .
🌟 توسط  @$username",
                'reply_to_message_id'=>$message_id,
                'reply_markup'=>$inlinebutton,
            ]);
            $settings["lock"]["game"]="| فعال | ✅";
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
elseif($textmassage=="/unlock game" or $textmassage=="بازکردن بازی"){
    if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev) ){
        $add = $settings["information"]["added"];
        if ($add == true) {
            botevoobot('sendmessage',[
                'chat_id'=>$chat_id,
                'text'=>"✅ قفل بازی آزاد شد
🔴 از این پس پیام های حاوی بازی پاک نخواهد شد .
🌟 توسط  @$username",
                'reply_to_message_id'=>$message_id,
                'reply_markup'=>$inlinebutton,
            ]);
            $settings["lock"]["game"]="| غیر فعال | ❌";
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
// location
elseif($textmassage=="/lock location" or $textmassage=="قفل مکان"){
    if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev) ){
        $add = $settings["information"]["added"];
        if ($add == true) {
            botevoobot('sendmessage',[
                'chat_id'=>$chat_id,
                'text'=>"✅ قفل مکان فعال شد
🔴 از این پس پیام های حاوی مکان پاک خواهد شد .
🌟 توسط  @$username",
                'reply_to_message_id'=>$message_id,
                'reply_markup'=>$inlinebutton,
            ]);
            $settings["lock"]["location"]="| فعال | ✅";
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
elseif($textmassage=="/unlock location" or $textmassage=="بازکردن مکان"){
    if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev) ){
        $add = $settings["information"]["added"];
        if ($add == true) {
            botevoobot('sendmessage',[
                'chat_id'=>$chat_id,
                'text'=>"✅ قفل مکان آزاد شد
🔴 از این پس پیام های حاوی مکان پاک نخواهد شد .
🌟 توسط  @$username",
                'reply_to_message_id'=>$message_id,
                'reply_markup'=>$inlinebutton,
            ]);
            $settings["lock"]["location"]="| غیر فعال | ❌";
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
// contact
elseif($textmassage=="/lock contact" or $textmassage=="قفل مخاطب"){
    if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev) ){
        $add = $settings["information"]["added"];
        if ($add == true) {
            botevoobot('sendmessage',[
                'chat_id'=>$chat_id,
                'text'=>"✅ قفل مخاطب فعال شد
🔴 از این پس پیام های حاوی مخاطب پاک خواهد شد .
🌟 توسط  @$username",
                'reply_to_message_id'=>$message_id,
                'reply_markup'=>$inlinebutton,
            ]);
            $settings["lock"]["contact"]="| فعال | ✅";
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
elseif($textmassage=="/unlock contact" or $textmassage=="بازکردن مخاطب"){
    if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev) ){
        $add = $settings["information"]["added"];
        if ($add == true) {
            botevoobot('sendmessage',[
                'chat_id'=>$chat_id,
                'text'=>"✅ قفل مخاطب آزاد شد
🔴 از این پس پیام های حاوی مخاطب پاک نخواهد شد .
🌟 توسط  @$username",
                'reply_to_message_id'=>$message_id,
                'reply_markup'=>$inlinebutton,
            ]);
            $settings["lock"]["contact"]="| غیر فعال | ❌";
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
// tag
elseif($textmassage=="/lock tag" or $textmassage=="قفل تگ"){
    if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev) ){
        $add = $settings["information"]["added"];
        if ($add == true) {
            botevoobot('sendmessage',[
                'chat_id'=>$chat_id,
                'text'=>"✅ قفل تگ فعال شد
🔴 از این پس پیام های حاوی تگ پاک خواهد شد .
🌟 توسط  @$username",
                'reply_to_message_id'=>$message_id,
                'reply_markup'=>$inlinebutton,
            ]);
            $settings["lock"]["tag"]="| فعال | ✅";
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
elseif($textmassage=="/unlock tag" or $textmassage=="بازکردن تگ"){
    if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev) ){
        $add = $settings["information"]["added"];
        if ($add == true) {
            botevoobot('sendmessage',[
                'chat_id'=>$chat_id,
                'text'=>"✅ قفل تگ آزاد شد
🔴 از این پس پیام های حاوی تگ پاک نخواهد شد .
🌟 توسط  @$username",
                'reply_to_message_id'=>$message_id,
                'reply_markup'=>$inlinebutton,
            ]);
            $settings["lock"]["tag"]="| غیر فعال | ❌";
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
// username 
elseif($textmassage=="/lock username" or $textmassage=="قفل یوزرنیم"){
    if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev) ){
        $add = $settings["information"]["added"];
        if ($add == true) {
            botevoobot('sendmessage',[
                'chat_id'=>$chat_id,
                'text'=>"✅ قفل یوزرنیم فعال شد
🔴 از این پس پیام های حاوی یوزرنیم پاک خواهد شد .
🌟 توسط  @$username",
                'reply_to_message_id'=>$message_id,
                'reply_markup'=>$inlinebutton,
            ]);
            $settings["lock"]["username"]="| فعال | ✅";
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
elseif($textmassage=="/unlock username" or $textmassage=="بازکردن یوزرنیم"){
    if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev) ){
        $add = $settings["information"]["added"];
        if ($add == true) {
            botevoobot('sendmessage',[
                'chat_id'=>$chat_id,
                'text'=>"✅ قفل یوزرنیم آزاد شد
🔴 از این پس پیام های حاوی یوزرنیم پاک نخواهد شد .
🌟 توسط  @$username",
                'reply_to_message_id'=>$message_id,
                'reply_markup'=>$inlinebutton,
            ]);
            $settings["lock"]["username"]="| غیر فعال | ❌";
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
// audio
elseif($textmassage=="/lock audio" or $textmassage=="قفل اهنگ"){
    if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev) ){
        $add = $settings["information"]["added"];
        if ($add == true) {
            botevoobot('sendmessage',[
                'chat_id'=>$chat_id,
                'text'=>"✅ قفل آهنگ فعال شد
🔴 از این پس پیام های حاوی آهنگ پاک خواهد شد .
🌟 توسط  @$username",
                'reply_to_message_id'=>$message_id,
                'reply_markup'=>$inlinebutton,
            ]);
            $settings["lock"]["audio"]="| فعال | ✅";
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
elseif($textmassage=="/unlock audio" or $textmassage=="بازکردن اهنگ"){
    if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev) ){
        $add = $settings["information"]["added"];
        if ($add == true) {
            botevoobot('sendmessage',[
                'chat_id'=>$chat_id,
                'text'=>"✅ قفل آهنگ آزاد شد
🔴 از این پس پیام های حاوی آهنگ پاک نخواهد شد .
🌟 توسط  @$username",
                'reply_to_message_id'=>$message_id,
                'reply_markup'=>$inlinebutton,
            ]);
            $settings["lock"]["audio"]="| غیر فعال | ❌";
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


if($textmassage == "/channel on" or $textmassage == "channel on" or $textmassage == "قفل کانال روشن"){
if ($tc == 'group' | $tc == 'supergroup'){  
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev)){
$add = $settings["information"]["added"];
if ($add == true) {
 botevoobot('sendMessage',[
    'chat_id'=>$chat_id,
    'text'=>"✅ قفل کانال فعال شد
🔴 از این پس باید در کانال تنظیم شده عضو شوند تا بتوانند پیام ارسال کنند .
🌟 توسط  @$username",
		 'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
   ]);
$settings["information"]["lockchannel"]="| فعال | ✅";
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
elseif($textmassage == "/channel off" or $textmassage == "channel off" or $textmassage == "قفل کانال خاموش"){
if ($tc == 'group' | $tc == 'supergroup'){  
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev)){
$add = $settings["information"]["added"];
if ($add == true) {
 botevoobot('sendMessage',[
    'chat_id'=>$chat_id,
    'text'=>"✅ قفل کانال آزاد شد
🔴 دیگر نیاز اجباری کانال فعال نیست 
🌟 توسط  @$username",
		 'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
   ]);
$settings["information"]["lockchannel"]="| غیر فعال | ❌";
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
elseif ( strpos($textmassage , '/setchannel ') !== false or strpos($textmassage , 'تنظیم کانال ') !== false) {
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev)){
$add = $settings["information"]["added"];
if ($add == true) {
$code = $num = str_replace(['/setchannel ','تنظیم کانال '],'',$textmassage);
 botevoobot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"
🔆 کانال عضویت اجباری تنظیم شد
📍 از این پس برای فعالیت داشتن در گروه باید عضو کانال  $code باشند .
🌟 توسط  @$username 

⚠️ توجه ربات حتما باید در کانال تنظیم شده ادمین شود تا بتواند عمل کند .
",
'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
   ]);
$settings["information"]["setchannel"]="$code";
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
					elseif($data=="lockchannel"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$Dev)){
$add = $settings2["information"]["lockchannel"];
$setadd = $settings2["information"]["setchannel"];
          botevoobot('editmessagetext',[
              'chat_id'=>$chatid,
   'message_id'=>$messageid,
             'text'=>"به بخش تنظیمات ادد اجباری خوش امدید🍃
🔻از دکمه های زیر استفاده کنید",
             'reply_markup'=>json_encode([
                 'inline_keyboard'=>[
    [
                     ['text'=>"📣 قفل کانال",'callback_data'=>'text'],['text'=>"$add",'callback_data'=>'channellock']
					 ],
					 [
					 ['text'=>"📢 کانال تنظیم شده",'callback_data'=>'text'],['text'=>"$setadd",'callback_data'=>'text']
					 ],
					 [
					 ['text'=>"🔔 تنظیم کانال",'callback_data'=>'setchannel']
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
$settings2["information"]["step"]="none";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
	}else{
			botevoobot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"شما مدیر ربات نیستید ⚠️",
]);
	}
		  }
		elseif($data=="channellock" && $settings2["information"]["lockchannel"] == "| فعال | ✅"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$Dev)){
$setadd = $settings2["information"]["setchannel"];
          botevoobot('editmessagetext',[
              'chat_id'=>$chatid,
   'message_id'=>$messageid,
             'text'=>"به بخش تنظیمات قفل کانال خوش امدید 🍃
✅ قفل کانال خاموش شد",
             'reply_markup'=>json_encode([
                 'inline_keyboard'=>[
    [
                     ['text'=>"📣 قفل کانال",'callback_data'=>'text'],['text'=>"| غیر فعال | ❌",'callback_data'=>'channellock']
					 ],
 [
					 ['text'=>"📢 کانال تنظیم شده",'callback_data'=>'text'],['text'=>"$setadd",'callback_data'=>'text']
					 ],
					 [
					 ['text'=>"🔔 تنظیم کانال",'callback_data'=>'setchannel']
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
$settings2["information"]["lockchannel"]="| غیر فعال | ❌";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
	}else{
			botevoobot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"شما مدیر ربات نیستید ⚠️",
]);
	}
		  }
		  		elseif($data=="channellock" && $settings2["information"]["lockchannel"] == "| غیر فعال | ❌"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$Dev)){
$setadd = $settings2["information"]["setchannel"];
          botevoobot('editmessagetext',[
              'chat_id'=>$chatid,
   'message_id'=>$messageid,
             'text'=>"به بخش تنظیمات قفل کانال خوش امدید 🍃
✅ قفل کانال روشن شد",
             'reply_markup'=>json_encode([
                 'inline_keyboard'=>[
    [
                     ['text'=>"📣 قفل کانال",'callback_data'=>'text'],['text'=>"| فعال | ✅",'callback_data'=>'channellock']
					 ],
 [
					 ['text'=>"📢 کانال تنظیم شده",'callback_data'=>'text'],['text'=>"$setadd",'callback_data'=>'text']
					 ],
					 [
					 ['text'=>"🔔 تنظیم کانال",'callback_data'=>'setchannel']
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
$settings2["information"]["lockchannel"]="| فعال | ✅";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
	}else{
			botevoobot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"شما مدیر ربات نیستید ⚠️",
]);
	}
		  }
		  		  		elseif($data=="setchannel"){
		 if ($statusq == 'creator' or $statusq == 'administrator' or in_array($fromid,$Dev)){
          botevoobot('editmessagetext',[
              'chat_id'=>$chatid,
   'message_id'=>$messageid,
             'text'=>"🍃 یوزرنیم کانال خود را ارسال کنید 
📍 مثال : @$channel

📌 توجه ربات حتما باید در کانال تنظیم شده ادمین شود تا بتواند عمل کند",
             'reply_markup'=>json_encode([
                 'inline_keyboard'=>[
					 [
					 ['text'=>"🔙 برگشت",'callback_data'=>'lockchannel']
					 ],
                     ]
               ])
	]);
$settings2["information"]["step"]="setchannel";
$settings = json_encode($settings2,true);
file_put_contents("data/$chatid.json",$settings);
	}else{
			botevoobot('answerCallbackQuery',[
'callback_query_id'=>$membercall,
'text'=>"شما مدیر ربات نیستید ⚠️",
]);
	}
		  }
// lock auto cmd 
if($textmassage=="/lock auto" or $textmassage=="قفل خودکار روشن"){
if ($status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev) ){
$add = $settings["information"]["added"];
if ($add == true) {
	botevoobot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"✅ قفل خاموشی خودکار فعال شد
🔴 از این پس گروه در ساعت تنظیم شده قفل خواهد شد .
🌟 توسط  @$username",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
$settings["lock"]["lockauto"]="| فعال | ✅";
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
elseif($textmassage=="/unlock auto" or $textmassage=="قفل خودکار خاموش"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev) ){
$add = $settings["information"]["added"];
if ($add == true) {
	botevoobot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"✅ قفل خاموشی خودکار آزاد شد
🔴 از این پس گروه در ساعت تنظیم شده قفل نخواهد شد .
🌟 توسط  @$username",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
$settings["lock"]["lockauto"]="| غیر فعال | ❌";
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
elseif (strpos($textmassage , "/setlockauto ") !== false or strpos($textmassage , "تنظیم قفل خودکار ") !== false) {
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev) ) {
$num = str_replace(['/setlockauto ','تنظیم قفل خودکار '],'',$textmassage);
$add = $settings["information"]["added"];
if ($add == true) {
$te = explode(" ",$num);
date_default_timezone_set('Asia/Tehran');
$date1 = date("H:i:s");
$startlock = $te[0];
$endlock = $te[1];
			  botevoobot('sendmessage',[
            'chat_id'=>$chat_id,
            'text'=>"✅ قفل خودکار تنظیم شد
🔆 زمان قفل خودکار در گروه به صورت زیر است :
⏲زمان الان : $date1
⏰زمان شروع سکوت گروه : $startlock
🕰زمان خاموش شدن سکوت گروه : $endlock
🌟توسط  @$username
",
'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
   ]);
$settings["information"]["timelock"]="$startlock";
$settings["information"]["timeunlock"]="$endlock";
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



// voice
if($textmassage=="/lock voice" or $textmassage=="قفل ویس"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev) ){
$add = $settings["information"]["added"];
if ($add == true) {
	botevoobot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"✅ قفل ویس فعال شد
🔴 از این پس پیام های حاوی ویس پاک خواهد شد .
🌟 توسط  @$username",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
$settings["lock"]["voice"]="| فعال | ✅";
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
elseif($textmassage=="/unlock voice" or $textmassage=="بازکردن ویس"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev) ){
$add = $settings["information"]["added"];
if ($add == true) {
	botevoobot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"✅ قفل ویس آزاد شد
🔴 از این پس پیام های حاوی ویس پاک نخواهد شد .
🌟 توسط  @$username",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
$settings["lock"]["voice"]="| غیر فعال | ❌";
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
// sticker
elseif($textmassage=="/lock sticker" or $textmassage=="قفل استیکر"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev) ){
$add = $settings["information"]["added"];
if ($add == true) {
	botevoobot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"✅ قفل استیکر فعال شد
🔴 از این پس پیام های حاوی استیکر پاک خواهد شد .
🌟 توسط  @$username",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
$settings["lock"]["sticker"]="| فعال | ✅";
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
elseif($textmassage=="/unlock sticker" or $textmassage=="بازکردن استیکر"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev) ) {
$add = $settings["information"]["added"];
if ($add == true) {
  	botevoobot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"✅ قفل استیکر آزاد شد
🔴 از این پس پیام های حاوی استیکر پاک نخواهد شد .
🌟 توسط  @$username",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
$settings["lock"]["sticker"]="| غیر فعال | ❌";
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
// forward
elseif($textmassage=="/lock forward" or $textmassage=="قفل فوروارد"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev) ) {
$add = $settings["information"]["added"];
if ($add == true) {
	botevoobot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"✅ قفل فوروارد فعال شد
🔴 از این پس پیام های حاوی فوروارد پاک خواهد شد .
🌟 توسط  @$username",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
$settings["lock"]["forward"]="| فعال | ✅";
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
elseif($textmassage=="/unlock forward" or $textmassage=="بازکردن فوروارد"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev) ) {
$add = $settings["information"]["added"];
if ($add == true) {
	botevoobot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"✅ قفل فوروارد آزاد شد
🔴 از این پس پیام های حاوی فوروارد پاک نخواهد شد .
🌟 توسط  @$username",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
$settings["lock"]["forward"]="| غیر فعال | ❌";
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
// fosh
elseif($textmassage=="/lock fosh" or $textmassage=="قفل فحش"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev) ) {
$add = $settings["information"]["added"];
if ($add == true) {
	botevoobot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"✅ قفل فحش فعال شد
🔴 از این پس پیام های حاوی فحش پاک خواهد شد .
🌟 توسط  @$username",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
$settings["lock"]["fosh"]="| فعال | ✅";
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
elseif($textmassage=="/unlock fosh" or $textmassage=="بازکردن فحش"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev) ) {
$add = $settings["information"]["added"];
if ($add == true) {
	botevoobot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"✅ قفل فحش آزاد شد
🔴 از این پس پیام های حاوی فحش پاک نخواهد شد .
🌟 توسط  @$username",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
$settings["lock"]["fosh"]="| غیر فعال | ❌";
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
// muteall
elseif($textmassage=="/mute all"  or $textmassage=="mute all" or $textmassage=="بیصدا همه"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev) ) {
$add = $settings["information"]["added"];
if ($add == true) {
	botevoobot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"✅ قفل بیصدا همه فعال شد
🔴 از این پس کل پیام های گروه پاک میشود 
🌟 توسط  @$username",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
$settings["lock"]["mute_all"]="| فعال | ✅";
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
elseif($textmassage=="/unmute all"  or $textmassage=="unmute all" or $textmassage=="باصدا همه"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev) ) {
$add = $settings["information"]["added"];
if ($add == true) {
	botevoobot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"✅ قفل باصدا همه آزاد شد
🔴 از این پس کل پیام های گروه پاک نمیشود 
🌟 توسط  @$username",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
$settings["lock"]["mute_all"]="| غیر فعال | ❌";
$settings["lock"]["mute_all_time"]="| غیر فعال | ❌";
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
// muteall time
elseif (strpos($textmassage , "/muteall ") !== false or strpos($textmassage , "بیصدا همه ") !== false) {
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev) ) {
	$num = str_replace(['/muteall ','بیصدا همه '],'',$textmassage);
	$add = $settings["information"]["added"];
if ($add == true) {
	if ($num <= 100000 && $num >= 1){
		date_default_timezone_set('Asia/Tehran');
        $date1 = date("h:i:s");
        $date2 = isset($_GET['date']) ? $_GET['date'] : date("h:i:s");
        $next_date = date('h:i:s', strtotime($date2 ."+$num Minutes"));
			  botevoobot('sendmessage',[
            'chat_id'=>$chat_id,
            'text'=>"✅ قفل بیصدا همه فعال شد
🔴 گروه به مدت $num دقیقه بیصدا شد
⏲زمان الان : $date1
⏰زمان پایان : $next_date\n
🌟 توسط  @$username",
'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
   ]);
$settings["information"]["mute_all_time"]="$next_date";
$settings["lock"]["mute_all_time"]="| فعال | ✅";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings); 
   }else{
botevoobot('sendmessage',[
 'chat_id' => $chat_id,
 'text'=>"خطا ⚠️
➖➖➖➖➖➖
💭عدد وارد شده باید بین 1 تا 1000 باشد
$date1
$nextdata",
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
// farsi
if($textmassage=="/lock text" or $textmassage=="قفل متن"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev) ) {
$add = $settings["information"]["added"];
if ($add == true) {
	botevoobot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"✅ قفل متن فعال شد
🔴 از این پس پیام های حاوی متن پاک خواهد شد .
🌟 توسط  @$username",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
$settings["lock"]["text"]="| فعال | ✅";
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
elseif($textmassage=="/unlock text" or $textmassage=="بازکردن متن"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev) ) {
$add = $settings["information"]["added"];
if ($add == true) {
	botevoobot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"✅ قفل متن آزاد شد
🔴 از این پس پیام های حاوی متن پاک نخواهد شد .
🌟 توسط  @$username",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
$settings["lock"]["text"]="| غیر فعال | ❌";
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
// cmd
elseif($textmassage=="/lock cmd" or $textmassage=="قفل دستورات"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev) ) {
$add = $settings["information"]["added"];
if ($add == true) {
	botevoobot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"✅ قفل دستورات فعال شد
🔴 از این پس پیام های حاوی دستورات عمومی پاک خواهد شد .
🌟 توسط  @$username",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
$settings["lock"]["cmd"]="| فعال | ✅";
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
elseif($textmassage=="/unlock cmd" or $textmassage=="بازکردن دستورات"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev) ) {
$add = $settings["information"]["added"];
if ($add == true) {
	botevoobot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"✅ قفل دستورات آزاد شد
🔴 از این پس پیام های حاوی دستورات عمومی پاک نخواهد شد .
🌟 توسط  @$username",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
$settings["lock"]["cmd"]="| غیر فعال | ❌";
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
// replay
elseif($textmassage=="/lock reply" or $textmassage=="قفل ریپلای"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev) ) {
$add = $settings["information"]["added"];
if ($add == true) {
	botevoobot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"✅ قفل ریپلای فعال شد
🔴 از این پس پیام های حاوی ریپلای پاک خواهد شد .
🌟 توسط  @$username",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
$settings["lock"]["reply"]="| فعال | ✅";
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
elseif($textmassage=="/unlock reply" or $textmassage=="بازکردن ریپلای"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev) ) {
$add = $settings["information"]["added"];
if ($add == true) {
	botevoobot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"✅ قفل ریپلای آزاد شد
🔴 از این پس پیام های حاوی ریپلای پاک نخواهد شد .
🌟 توسط  @$username",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
$settings["lock"]["reply"]="| غیر فعال | ❌";
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
// tgservic
elseif($textmassage=="/lock tgservic" or $textmassage=="قفل خدمات"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev) ) {
$add = $settings["information"]["added"];
if ($add == true) {
	botevoobot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"✅ قفل خدمات فعال شد
🔴 از این پس پیام های حاوی خدمات تلگرام پاک خواهد شد .
🌟 توسط  @$username",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
$settings["lock"]["tgservic"]="| فعال | ✅";
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
elseif($textmassage=="/unlock tgservic" or $textmassage=="بازکردن خدمات"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev) ) {
$add = $settings["information"]["added"];
if ($add == true) {
	botevoobot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"✅ قفل خدمات آزاد شد
🔴 از این پس پیام های حاوی خدمات تلگرام پاک نخواهد شد .
🌟 توسط  @$username",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
$settings["lock"]["tgservic"]="| غیر فعال | ❌";
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
// video note
elseif($textmassage=="/lock videonote" or $textmassage=="قفل پیام ویدیویی"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev) ) {
$add = $settings["information"]["added"];
if ($add == true) {
	botevoobot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"✅ قفل پیام  ویدیویی فعال شد
🔴 از این پس پیام های حاوی پیام ویدیویی پاک خواهد شد .
🌟 توسط  @$username",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
$settings["lock"]["video_msg"]="| فعال | ✅";
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
elseif($textmassage=="/unlock videonote" or $textmassage=="بازکردن پیام ویدیویی"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev) ) {
$add = $settings["information"]["added"];
if ($add == true) {
	botevoobot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"✅ قفل پیام  ویدیویی آزاد شد
🔴 از این پس پیام های حاوی پیام ویدیویی پاک نخواهد شد .
🌟 توسط  @$username",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
$settings["lock"]["video_msg"]="| غیر فعال | ❌";
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
// lock bots
elseif ($textmassage == "/lock bots" or $textmassage == "lock bots" or $textmassage == "قفل ربات") {
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev)) {
$add = $settings["information"]["added"];
if ($add == true) {
	botevoobot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"✅ قفل ربات  فعال شد
🔴 از این پس پیام های حاوی ربات  پاک خواهد شد .
🌟 توسط  @$username",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
$settings["lock"]["bot"]="| فعال | ✅";
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
elseif ($textmassage == "/unlock bots" or $textmassage == "unlock bots"  or $textmassage == "بازکردن ربات") {
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev) ) {
$add = $settings["information"]["added"];
if ($add == true) {
	botevoobot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"✅ قفل ربات  آزاد شد
🔴 از این پس پیام های حاوی ربات  پاک نخواهد شد .
🌟 توسط  @$username",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
$settings["lock"]["bot"]="| غیر فعال | ❌";
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
// end lock

elseif($textmassage=="/lock join" or $textmassage=="قفل عضویت"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev) ){
$add = $settings["information"]["added"];
if ($add == true) {  
  botevoobot('sendmessage',[
  'chat_id'=>$chat_id,
  'text'=>"
✅ قفل عضویت  فعال شد
🔴 از این پس عضویت جدید ممنوع میباشد .
🌟 توسط  @$username
",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
$settings["lock"]["join"]="| فعال | ✅";
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
elseif($textmassage=="/unlock join" or $textmassage=="بازکردن عضویت"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev) ){
$add = $settings["information"]["added"];
if ($add == true) {
  botevoobot('sendmessage',[
  'chat_id'=>$chat_id,
  'text'=>"
✅ قفل عضویت  آزاد شد
🔴 از این پس عضویت جدید ممنوع نمیباشد .
🌟 توسط  @$username
",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
$settings["lock"]["join"]="| غیر فعال | ❌";
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
elseif($textmassage=="/lock tabchi" or $textmassage=="قفل تبچی"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev) ){
$add = $settings["information"]["added"];
if ($add == true) {  
  botevoobot('sendmessage',[
  'chat_id'=>$chat_id,
  'text'=>"
✅ قفل تبچی  فعال شد
🔴 از این پس کاربر پس از ورود به گروه باید هویت خود را تایید کند در غیر اینصورت پس از چند دقیقه اخراج خواهد شد .
🌟 توسط  @$username
  ",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
$settings["lock"]["tabchi"]="| فعال | ✅";
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
elseif($textmassage=="/unlock tabchi" or $textmassage=="بازکردن تبچی"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev) ){
$add = $settings["information"]["added"];
if ($add == true) {
  botevoobot('sendmessage',[
  'chat_id'=>$chat_id,
  'text'=>"
✅ قفل تبچی  آزاد شد
🔴 از این پس کاربر پس از ورود به گروه نیاز نیست هویت کاربری خود را تایید کند .
🌟 توسط  @$username
  ",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
$settings["lock"]["tabchi"]="| غیر فعال | ❌";
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
elseif($textmassage=="/lock en" or $textmassage=="قفل انگلیسی"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev) ){
$add = $settings["information"]["added"];
if ($add == true) {  
  botevoobot('sendmessage',[
  'chat_id'=>$chat_id,
  'text'=>"
✅ قفل انگلیسی  فعال شد
🔴 از این پس پیام های حاوی انگلیسی پاک خواهد شد
🌟 توسط  @$username
  ",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
$settings["lock"]["eng"]="| فعال | ✅";
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
elseif($textmassage=="/unlock en" or $textmassage=="بازکردن انگلیسی"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev) ){
$add = $settings["information"]["added"];
if ($add == true) {
  botevoobot('sendmessage',[
  'chat_id'=>$chat_id,
  'text'=>"
✅ قفل انگلیسی  آزاد شد
🔴 از این پس پیام های حاوی انگلیسی پاک نخواهد شد
🌟 توسط  @$username
  ",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
$settings["lock"]["eng"]="| غیر فعال | ❌";
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
// Grouplock
elseif($textmassage=="/lock group"  or $textmassage=="lock group" or $textmassage=="قفل گروه"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev) ) {
$add = $settings["information"]["added"];
if ($add == true) {
	botevoobot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"
✅ قفل گروه فعال شد 

❗️کاربران گروه توجه کنید : 

گروه قفل شد ❌
برای حفظ نظم و آرامش گروه تا باز شدن گروه پیامی ارسال نکنید 🙏
چون حذف میشه 📛

🌟 توسط  @$username
	",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
$settings["lock"]["group"]="| فعال | ✅";
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
elseif($textmassage=="/lock group"  or $textmassage=="lock group" or $textmassage=="بازکردن گروه"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev) ) {
$add = $settings["information"]["added"];
if ($add == true) {
	botevoobot('sendmessage',[
	'chat_id'=>$chat_id,
	'text'=>"
✅ قفل گروه  آزاد شد
🔴 از این پس پیامی پاک نخواهد شد .
🌟 توسط  @$username
	",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
$settings["lock"]["group"]="| غیر فعال | ❌";
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
elseif($textmassage=="fun off" or $textmassage=="فان خاموش"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev) ){
$add = $settings["information"]["added"];
if ($add == true) {  
  botevoobot('sendmessage',[
  'chat_id'=>$chat_id,
  'text'=>"
✅ قفل فان سخنگو  فعال شد
🔴 از این پس ربات چیزی یاد نخواهد گرفت .
🌟 توسط  @$username
  ",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
$settings["lock"]["answer"]="| فعال | ✅";
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
elseif($textmassage=="fun on" or $textmassage=="فان روشن"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev) ){
$add = $settings["information"]["added"];
if ($add == true) {
  botevoobot('sendmessage',[
  'chat_id'=>$chat_id,
  'text'=>"
✅ قفل فان سخنگو  آزاد شد
🔴 از این پس ربات چیزی یاد خواهد گرفت .
🌟 توسط  @$username
  ",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
$settings["lock"]["answer"]="| غیر فعال | ❌";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
}
else
{
botevoobot('sendmessage',[
  'chat_id'=>$chat_id,
  'text'=>"
 ⚠️ توجه کنید : ربات در گروه شما نصب نیست ! لطفا ابتدا نسبت به نصب ربات اقدام کنید  ☀️
❗️ میتوانید ربات را $freedays روز رایکان فعال کنید با دستور { نصب رایگان 
    
}",
  'reply_to_message_id'=>$message_id,
'reply_markup'=>$inlinebutton,
 ]);
  }
}
}
// lock animated
elseif($textmassage=="/lock animated" or $textmassage=="قفل استیکر متحرک"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev) ){
$add = $settings["information"]["added"];
if ($add == true) {	
botevoobot('sendmessage',[
	    'chat_id'=>$chat_id,
	    'text'=>"
✅  استیکر متحرک فعال شد
🔴 از این پس ارسال استیکر متحرک ممنوع میباشد
🌟 توسط  @$username
	    ",
        'reply_to_message_id'=>$message_id,
        'reply_markup'=>$inlinebutton,
]);
$settings["lock"]["animated"]="| فعال | ✅";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
}else{
botevoobot('sendmessage',[
	    'chat_id'=>$chat_id,
	    'text'=>" ⚠️ توجه کنید : ربات در گروه شما نصب نیست ! لطفا ابتدا نسبت به نصب ربات اقدام کنید  ☀️
❗️ میتوانید ربات را $freedays روز رایکان فعال کنید با دستور { نصب رایگان ",
       'reply_to_message_id'=>$message_id,
       'reply_markup'=>$inlinebutton,
]);
}
}
}
elseif($textmassage=="/unlock animated" or $textmassage=="بازکردن استیکر متحرک"){
if ( $status == 'creator' or $status == 'administrator' or in_array($from_id,$Dev) ){
$add = $settings["information"]["added"];
if ($add == true) {
botevoobot('sendmessage',[
	    'chat_id'=>$chat_id,
	    'text'=>"
✅  استیکر متحرک غیرفعال شد
🔴 از این پس ارسال استیکر متحرک ممنوع نمیباشد
🌟 توسط  @$username
	    ",
        'reply_to_message_id'=>$message_id,
        'reply_markup'=>$inlinebutton,
]);
$settings["lock"]["animated"]="| غیر فعال | ❌";
$settings = json_encode($settings,true);
file_put_contents("data/$chat_id.json",$settings);
}else{
botevoobot('sendmessage',[
    	'chat_id'=>$chat_id,
	    'text'=>" ⚠️ توجه کنید : ربات در گروه شما نصب نیست ! لطفا ابتدا نسبت به نصب ربات اقدام کنید  ☀️
❗️ میتوانید ربات را $freedays روز رایکان فعال کنید با دستور { نصب رایگان ",
       'reply_to_message_id'=>$message_id,
       'reply_markup'=>$inlinebutton,
 ]);
}
}
}


?>