<?php
include "confing.php";
require_once "includes/database_helpers.php";
include "plugin/add.php";
include "plugin/fun.php";
include "plugin/lock.php";
include "plugin/msgcheck.php";
include "plugin/panel.php";
include "plugin/panelplus.php";
include "plugin/plus.php";
include "plugin/plusmsgcheck.php";
include "plugin/settings.php";
include "plugin/start.php";
include "plugin/tools.php";
include "plugin/upmsgcheck.php";
include "plugin/link.php";

//-----------------------------------------------------------------------------------------
// Secure user management with database
if ($tc == 'private') {
    // Save user to database
    saveUser($from_id, $username ?? null, $first_name ?? null, $last_name ?? null);
} elseif ($tc == 'group' || $tc == 'supergroup') {
    // Save group to database
    saveGroup($chat_id, $gpname ?? "Group $chat_id", $username ?? null, $tc, $from_id);
}

//-----------------------------------------------------------------------------------------
// Secure settings inline
elseif ($data == "media") {
    if ($statusq == 'creator' || $statusq == 'administrator' || in_array($fromid, $Dev)) {
        $lockdocument = $settings2["lock"]["document"] ?? "| غیر فعال | ❌";
        $lockgif = $settings2["lock"]["gif"] ?? "| غیر فعال | ❌";
        $lockvideo_note = $settings2["lock"]["video_msg"] ?? "| غیر فعال | ❌";
        $locklocation = $settings2["lock"]["location"] ?? "| غیر فعال | ❌";
        $lockphoto = $settings2["lock"]["photo"] ?? "| غیر فعال | ❌";
        $lockcontact = $settings2["lock"]["contact"] ?? "| غیر فعال | ❌";
        $lockaudio = $settings2["lock"]["audio"] ?? "| غیر فعال | ❌";
        $lockvoice = $settings2["lock"]["voice"] ?? "| غیر فعال | ❌";
        $locksticker = $settings2["lock"]["sticker"] ?? "| غیر فعال | ❌";
        $lockgame = $settings2["lock"]["game"] ?? "| غیر فعال | ❌";
        $lockvideo = $settings2["lock"]["video"] ?? "| غیر فعال | ❌";
        $locktext = $settings2["lock"]["text"] ?? "| غیر فعال | ❌";

        botevoobot('editmessagetext', [
            'chat_id' => $chatid,
            'message_id' => $messageid,
            'text' => "
☀️ تنظیمات گروه :

▪️ایدی گروه : [$chatid]
▪️نام گروه : [$gpname]

| فعال | ✅ = حذف پیام
| غیر فعال | ❌ = حذف نشدن پیام
",
            'reply_markup' => json_encode([
                'resize_keyboard' => true,
                'inline_keyboard' => [
                    [
                        ['text' => "• فایل", 'callback_data' => 'text'], ['text' => "$lockdocument", 'callback_data' => 'lockdocument']
                    ],
                    [
                        ['text' => "• گیف", 'callback_data' => 'text'], ['text' => "$lockgif", 'callback_data' => 'lockgif']
                    ],
                    [
                        ['text' => "• پیام ویدیویی", 'callback_data' => 'text'], ['text' => "$lockvideo_note", 'callback_data' => 'lockself']
                    ],
                    [
                        ['text' => "• ارسال مکان", 'callback_data' => 'text'], ['text' => "$locklocation", 'callback_data' => 'locklocation']
                    ],
                    [
                        ['text' => "• تصویر", 'callback_data' => 'text'], ['text' => "$lockphoto", 'callback_data' => 'lockphoto']
                    ],
                    [
                        ['text' => "• ارسال شماره", 'callback_data' => 'text'], ['text' => "$lockcontact", 'callback_data' => 'lockcontact']
                    ],
                    [
                        ['text' => "• موسیقی", 'callback_data' => 'text'], ['text' => "$lockaudio", 'callback_data' => 'lockaudio']
                    ],
                    [
                        ['text' => "• صدا", 'callback_data' => 'text'], ['text' => "$lockvoice", 'callback_data' => 'lockvoice']
                    ],
                    [
                        ['text' => "• استیکر", 'callback_data' => 'text'], ['text' => "$locksticker", 'callback_data' => 'locksticker']
                    ],
                    [
                        ['text' => "• بازی", 'callback_data' => 'text'], ['text' => "$lockgame", 'callback_data' => 'lockgame']
                    ],
                    [
                        ['text' => "• فیلم", 'callback_data' => 'text'], ['text' => "$lockvideo", 'callback_data' => 'lockvideo']
                    ],
                    [
                        ['text' => "• متن", 'callback_data' => 'text'], ['text' => "$locktext", 'callback_data' => 'locktext']
                    ],
                    [
                        ['text' => "🔑 تنظیمات مدیریت", 'callback_data' => 'other']
                    ],
                    [
                        ['text' => "🔙 برگشت", 'callback_data' => 'settings'], ['text' => "$nemechannel", 'url' => "https://telegram.me/$channel"]
                    ],
                ]
            ])
        ]);
    } else {
        botevoobot('answerCallbackQuery', [
            'callback_query_id' => $membercall,
            'text' => "شما مدیر ربات نیستید ⚠️",
        ]);
    }
}

elseif ($data == "other") {
    if ($statusq == 'creator' || $statusq == 'administrator' || in_array($fromid, $Dev)) {
        $locklink = $settings2["lock"]["link"] ?? "| غیر فعال | ❌";
        $lockurl = $settings2["lock"]["url"] ?? "| غیر فعال | ❌";
        $lockusername = $settings2["lock"]["username"] ?? "| غیر فعال | ❌";
        $locktag = $settings2["lock"]["tag"] ?? "| غیر فعال | ❌";
        $lockedit = $settings2["lock"]["edit"] ?? "| غیر فعال | ❌";
        $lockfosh = $settings2["lock"]["fosh"] ?? "| غیر فعال | ❌";
        $lockbots = $settings2["lock"]["bot"] ?? "| غیر فعال | ❌";
        $lockforward = $settings2["lock"]["forward"] ?? "| غیر فعال | ❌";
        $locktg = $settings2["lock"]["tgservic"] ?? "| غیر فعال | ❌";
        $lockreply = $settings2["lock"]["reply"] ?? "| غیر فعال | ❌";
        $lockcmd = $settings2["lock"]["cmd"] ?? "| غیر فعال | ❌";
        $lockjoin = $settings2["lock"]["join"] ?? "| غیر فعال | ❌";
        $locktabchi = $settings2["lock"]["tabchi"] ?? "| غیر فعال | ❌";
        $lockgroup = $settings2["lock"]["group"] ?? "| غیر فعال | ❌";

        botevoobot('editmessagetext', [
            'chat_id' => $chatid,
            'message_id' => $messageid,
            'text' => "
☀️ تنظیمات گروه :

▪️ایدی گروه : [$chatid]
▪️نام گروه : [$gpname]

| فعال | ✅ = حذف پیام
| غیر فعال | ❌ = حذف نشدن پیام
",
            'reply_markup' => json_encode([
                'resize_keyboard' => true,
                'inline_keyboard' => [
                    [
                        ['text' => "• لينک", 'callback_data' => 'text'], ['text' => "$locklink", 'callback_data' => 'locklink']
                    ],
                    [
                        ['text' => "• لینک سایت", 'callback_data' => 'text'], ['text' => "$lockurl", 'callback_data' => 'lockurl']
                    ],
                    [
                        ['text' => "• هشتگ [#]", 'callback_data' => 'text'], ['text' => "$locktag", 'callback_data' => 'locktag']
                    ],
                    [
                        ['text' => "• یوزرنیم [@]", 'callback_data' => 'text'], ['text' => "$lockusername", 'callback_data' => 'lockusername']
                    ],
                    [
                        ['text' => "• ویرایش پیام", 'callback_data' => 'text'], ['text' => "$lockedit", 'callback_data' => 'lockedit']
                    ],
                    [
                        ['text' => "•️ فحش", 'callback_data' => 'text'], ['text' => "$lockfosh", 'callback_data' => 'lockfosh']
                    ],
                    [
                        ['text' => "• ورود ربات ها", 'callback_data' => 'text'], ['text' => "$lockbots", 'callback_data' => 'lockbot']
                    ],
                    [
                        ['text' => "• فوروارد", 'callback_data' => 'text'], ['text' => "$lockforward", 'callback_data' => 'lockforward']
                    ],
                    [
                        ['text' => "• خدمات تلگرام", 'callback_data' => 'text'], ['text' => "$locktg", 'callback_data' => 'locktgservic']
                    ],
                    [
                        ['text' => "• ریپلای", 'callback_data' => 'text'], ['text' => "$lockreply", 'callback_data' => 'lockreply']
                    ],
                    [
                        ['text' => "• دستورات عمومی", 'callback_data' => 'text'], ['text' => "$lockcmd", 'callback_data' => 'lockcmd']
                    ],
                    [
                        ['text' => "• عضویت", 'callback_data' => 'text'], ['text' => "$lockjoin", 'callback_data' => 'lockjoin']
                    ],
                    [
                        ['text' => "• تبچی", 'callback_data' => 'text'], ['text' => "$locktabchi", 'callback_data' => 'locktabchi']
                    ],
                    [
                        ['text' => "• گروه", 'callback_data' => 'text'], ['text' => "$lockgroup", 'callback_data' => 'lockgroup']
                    ],
                    [
                        ['text' => "🔑 تنظیمات رسانه", 'callback_data' => 'media']
                    ],
                    [
                        ['text' => "🔙 برگشت", 'callback_data' => 'settings'], ['text' => "$nemechannel", 'url' => "https://telegram.me/$channel"]
                    ],
                ]
            ])
        ]);
    } else {
        botevoobot('answerCallbackQuery', [
            'callback_query_id' => $membercall,
            'text' => "شما مدیر ربات نیستید ⚠️",
        ]);
    }
} elseif ($data == "settings") {
    if ($statusq == 'creator' || $statusq == 'administrator' || in_array($fromid, $Dev)) {
        $mute_all = $settings2["lock"]["mute_all"] ?? "| غیر فعال | ❌";

        botevoobot('editmessagetext', [
            'chat_id' => $chatid,
            'message_id' => $messageid,
            'text' => "☀️ تنظیمات گروه :

🔖لطفا بخش مورد نظر خود را انتخاب کنید",
            'reply_markup' => json_encode([
                'resize_keyboard' => true,
                'inline_keyboard' => [
                    [
                        ['text' => "🔗 تنظیمات رسانه", 'callback_data' => 'media'], ['text' => "⚒ تنظیمات مدیریت", 'callback_data' => 'other']
                    ],
                    [
                        ['text' => "📌 قفل همه", 'callback_data' => 'text'], ['text' => "$mute_all", 'callback_data' => 'lockall']
                    ],
                    [
                        ['text' => "🔙 برگشت", 'callback_data' => 'back'], ['text' => "$nemechannel", 'url' => "https://telegram.me/$channel"]
                    ],
                ]
            ])
        ]);
    } else {
        botevoobot('answerCallbackQuery', [
            'callback_query_id' => $membercall,
            'text' => "شما مدیر ربات نیستید ⚠️",
        ]);
    }
} elseif ($data == "back") {
    if ($statusq == 'creator' || $statusq == 'administrator' || in_array($fromid, $Dev)) {
        botevoobot('editmessagetext', [
            'chat_id' => $chatid,
            'message_id' => $messageid,
            'text' => "به پنل مدیریت ربات خوش آمدید 😀🙏

",
            'reply_to_message_id' => $message_id,
            'reply_markup' => json_encode([
                'resize_keyboard' => true,
                'inline_keyboard' => [
                    [
                        ['text' => "🔶 تنظیمات", 'callback_data' => 'settings']
                    ],
                    [
                        ['text' => "🚦 اطلاعات گروه", 'callback_data' => 'groupe'], ['text' => "📝 قفل کاراکتر", 'callback_data' => 'character']
                    ],
                    [
                        ['text' => "🛃 قفل خودکار", 'callback_data' => 'lockauto'], ['text' => "💭 خوش امد گویی", 'callback_data' => 'welcome']
                    ],
                    [
                        ['text' => "📊 ادد اجباری", 'callback_data' => 'addbzn'], ['text' => "📣 قفل کانال", 'callback_data' => 'lockchannel']
                    ],
                    [
                        ['text' => "♨️ حالت سختگیرانه", 'callback_data' => 'hardmode'], ['text' => "⚠️حساسیت اخطار", 'callback_data' => 'warn']
                    ],
                    [
                        ['text' => "⛑ پشتیبانی", 'callback_data' => 'support'], ['text' => "$nemechannel", 'url' => "https://telegram.me/$channel"]
                    ],
                    [
                        ['text' => "✖️ خروج", 'callback_data' => 'exit']
                    ],
                ]
            ])
        ]);
    } else {
        botevoobot('answerCallbackQuery', [
            'callback_query_id' => $membercall,
            'text' => "شما مدیر ربات نیستید ⚠️",
        ]);
    }
}

if ($textmassage == "/panel" || $textmassage == "panel" || $textmassage == "پنل" || $textmassage == "/panel@$usernamebot") {
    if ($status == 'creator' || $status == 'administrator' || in_array($from_id, $Dev)) {
        if ($tc == 'group' || $tc == 'supergroup') {
            $add = $settings["information"]["added"] ?? false;
            if ($add == true) {
                botevoobot('sendmessage', [
                    'chat_id' => $chat_id,
                    'text' => "
به پنل مدیریت ربات خوش آمدید 😀🙏

",
                    'reply_to_message_id' => $message_id,
                    'reply_markup' => json_encode([
                        'resize_keyboard' => true,
                        'inline_keyboard' => [
                            [
                                ['text' => "🔶 تنظیمات", 'callback_data' => 'settings']
                            ],
                            [
                                ['text' => "🚦 اطلاعات گروه", 'callback_data' => 'groupe'], ['text' => "📝 قفل کاراکتر", 'callback_data' => 'character']
                            ],
                            [
                                ['text' => "🛃 قفل خودکار", 'callback_data' => 'lockauto'], ['text' => "💭 خوش امد گویی", 'callback_data' => 'welcome']
                            ],
                            [
                                ['text' => "📊 ادد اجباری", 'callback_data' => 'addbzn'], ['text' => "📣 قفل کانال", 'callback_data' => 'lockchannel']
                            ],
                            [
                                ['text' => "♨️ حالت سختگیرانه", 'callback_data' => 'hardmode'], ['text' => "⚠️حساسیت اخطار", 'callback_data' => 'warn']
                            ],
                            [
                                ['text' => "⛑ پشتیبانی", 'callback_data' => 'support'], ['text' => "$nemechannel", 'url' => "https://telegram.me/$channel"]
                            ],
                            [
                                ['text' => "✖️ خروج", 'callback_data' => 'exit']
                            ],
                        ]
                    ])
                ]);
            } else {
                botevoobot('sendmessage', [
                    'chat_id' => $chat_id,
                    'text' => "⚠️ توجه کنید : ربات در گروه شما نصب نیست ! لطفا ابتدا نسبت به نصب ربات اقدام کنید  ☀️
❗️ میتوانید ربات را $freedays روز رایکان فعال کنید با دستور { نصب رایگان }",
                    'reply_to_message_id' => $message_id,
                    'reply_markup' => $inlinebutton,
                ]);
            }
        }
    }
} elseif ($data == "exit") {
    if ($statusq == 'creator' || $statusq == 'administrator' || in_array($fromid, $Dev)) {
        botevoobot('deletemessage', [
            'chat_id' => $chatid,
            'message_id' => $messageid,
        ]);
    } else {
        botevoobot('answerCallbackQuery', [
            'callback_query_id' => $membercall,
            'text' => "شما مدیر ربات نیستید ⚠️",
        ]);
    }
} elseif ($data == "groupe") {
    if ($statusq == 'creator' || $statusq == 'administrator' || in_array($fromid, $Dev)) {
        $url = file_get_contents("https://api.telegram.org/bot$token/getChatMembersCount?chat_id=$chatid");
        $getchat = json_decode($url, true);
        $howmember = $getchat["result"] ?? 0;

        botevoobot('editmessagetext', [
            'chat_id' => $chatid,
            'message_id' => $messageid,
            'text' => "
🌟 به بخش اطلاعت گروه خوش آمدید

▪️نام گروه : [$gpname]
▪️ایدی گروه : [$chatid]
▪️تعداد پیام ها : [$messageid]

🕵️‍♂️تعداد کل عضو های گروه :[$howmember]
",
            'reply_markup' => json_encode([
                'inline_keyboard' => [
                    [
                        ['text' => "🔗 لینک گروه", 'callback_data' => "link"], ['text' => "🚩 قوانین گروه", 'callback_data' => 'rules']
                    ],
                    [
                        ['text' => "🏵 لیست ساکت گروه", 'callback_data' => 'silentlist'], ['text' => "🛑 لیست کلمات فیلتر", 'callback_data' => 'filterword']
                    ],
                    [
                        ['text' => "❌ لیست تبچی", 'callback_data' => 'tabchilist']
                    ],
                    [
                        ['text' => "📦 خرید شارژ", 'callback_data' => 'requstcharge'],
                        ['text' => "👮🏻 لیست ادمین ها", 'callback_data' => 'adminlist']
                    ],
                    [
                        ['text' => "$nemechannel", 'url' => "https://telegram.me/$channel"], ['text' => "🔙 برگشت", 'callback_data' => 'back']
                    ],
                    [
                        ['text' => "✖️ خروج", 'callback_data' => 'exit']
                    ],
                ]
            ])
        ]);

        $settings2["information"]["step"] = "none";
        $settings = json_encode($settings2, JSON_PRETTY_PRINT);
        secureFilePutContents("data/$chatid.json", $settings);
    } else {
        botevoobot('answerCallbackQuery', [
            'callback_query_id' => $membercall,
            'text' => "شما مدیر ربات نیستید ⚠️",
        ]);
    }
} elseif ($data == "adminlist") {
    if ($statusq == 'creator' || $statusq == 'administrator' || in_array($fromid, $Dev)) {
        $up = json_decode(file_get_contents("https://api.telegram.org/bot$token/getChatAdministrators?chat_id=" . $chatid), true);
        $result = $up['result'] ?? [];
        $msg = "";
        $owner = "";
        $owner2 = "";

        foreach ($result as $key => $value) {
            $found = $result[$key]['status'];
            if ($found == "creator") {
                $owner = $result[$key]['user']['id'];
                $owner2 = $result[$key]['user']['username'] ?? "";
            }
            if ($found == "administrator") {
                if (isset($result[$key]['user']['first_name'])) {
                    $innames = str_replace(['[', ']'], '', $result[$key]['user']['first_name']);
                    $msg = $msg . "\n" . "📍" . "[{$innames}](tg://user?id={$result[$key]['user']['id']})";
                }
            }
        }

        botevoobot('editmessagetext', [
            'chat_id' => $chatid,
            'message_id' => $messageid,
            'text' => "
🌟 سازنده گروه :
🔑 $owner | @$owner2

👮🏻‍♂️ لیست ادمین های گروه :
🔑 $msg
",
            'parse_mode' => "MarkDown",
            'reply_markup' => json_encode([
                'inline_keyboard' => [
                    [
                        ['text' => "$nemechannel", 'url' => "https://telegram.me/$channel"], ['text' => "🔙 برگشت", 'callback_data' => 'groupe']
                    ],
                ]
            ])
        ]);
    } else {
        botevoobot('answerCallbackQuery', [
            'callback_query_id' => $membercall,
            'text' => "شما مدیر ربات نیستید ⚠️",
        ]);
    }
} elseif ($data == "support") {
    if ($statusq == 'creator' || $statusq == 'administrator' || in_array($fromid, $Dev)) {
        botevoobot('editmessagetext', [
            'chat_id' => $chatid,
            'message_id' => $messageid,
            'text' => "

💡قبل از ارسال درخواست ورود پشتیبانی به گروه به نکات زیر توجه داشته باشید.

🔴 قبل از ارسال درخواست حتما ربات را ادمین گروه کنید سپس به ارسال درخواست بپردازید
🔴 از ارسال درخواست بی مورد خودداری کنید و اول راهنمای ربات را به صورت کامل مطالعه کنید
🔴پس از ارسال درخواست پشتیبانی از ارسال دوباره درخواست خودداری کنید و منتظر باشید تا پشتیبانی وارد گروه شما شود و به درخواست شما رسیدگی کند

🔻برای ورود پشتیبان به گروه در صورت وجود مشکل در ربات یا ایراد برای گروه شما ارسال درخواست را لمس کنید
",
            'reply_markup' => json_encode([
                'inline_keyboard' => [
                    [
                        ['text' => "✅ ارسال درخواست ", 'callback_data' => 'yessup']
                    ],
                    [
                        ['text' => "$nemechannel", 'url' => "https://telegram.me/$channel"], ['text' => "🔙 برگشت", 'callback_data' => 'back']
                    ],
                ]
            ])
        ]);
    } else {
        botevoobot('answerCallbackQuery', [
            'callback_query_id' => $membercall,
            'text' => "شما مدیر ربات نیستید ⚠️",
        ]);
    }
} elseif ($data == "requstcharge") {
    if ($statusq == 'creator' || $statusq == 'administrator' || in_array($fromid, $Dev)) {
        botevoobot('editmessagetext', [
            'chat_id' => $chatid,
            'message_id' => $messageid,
            'text' => "️
        🏵 $firstname  به بخش خرید اشتراک خوش آمدید 🌹
در این قسمت با تهیه اشتراک میتوانید مدیریت گروه خود را به آنتی اسپم $botnamef بسپارید

🥇 یک ماه : 5 هزارتومان
🥇 دو ماه : 10 هزارتومان
🥇 سه ماه : 20 هزارتومان
🥇 شش ماه : 30 هزارتومان

بعد از پرداخت گروه به صورت مستقیم شارژ خواهد شد
",
            'reply_markup' => json_encode([
                'inline_keyboard' => [
                    [
                        ['text' => "☀یک ماهه ☀️", 'url' => "$web/pay/pay.php?&callback=$web/pay/by5000.php?gpid=$chatid&amount=5000"], ['text' => "☀دو ماهه ☀️", 'url' => "$web/pay/pay.php?&callback=$web/pay/by10000.php?gpid=$chatid&amount=10000"]
                    ],
                    [
                        ['text' => "☀سه ماهه ☀️", 'url' => "$web/pay/pay.php?&callback=$web/pay/by20000.php?gpid=$chatid&amount=20000"], ['text' => "☀شش ماهه ☀️", 'url' => "$web/pay/pay.php?&callback=$web/pay/by30000.php?gpid=$chatid&amount=30000"]
                    ],
                    [['text' => "🎯 درخواست شارژ", 'callback_data' => 'requstcheck']],
                    [
                        ['text' => "$nemechannel", 'url' => "https://telegram.me/$channel"], ['text' => "🔙 برگشت", 'callback_data' => 'groupe']
                    ],
                ]
            ])
        ]);
    } else {
        botevoobot('answerCallbackQuery', [
            'callback_query_id' => $membercall,
            'text' => "شما مدیر ربات نیستید ⚠️",
        ]);
    }
} elseif ($data == "yessup") {
    if ($statusq == 'creator' || $statusq == 'administrator' || in_array($fromid, $Dev)) {
        $getlink = file_get_contents("https://api.telegram.org/bot$token/exportChatInviteLink?chat_id=$chatid");
        $jsonlink = json_decode($getlink, true);
        $getlinkde = $jsonlink['result'] ?? "";

        botevoobot('sendmessage', [
            'chat_id' => $Dev[0],
            'text' => "
👨‍👩‍👧‍👦 گروهه : [$gpname]
✅ درخواست پشتیبانی کرده است

📍 ایدی : [ $fromid ]
📍 نام : [ $firstname ]
📍 یوزرنیم : [ @$usernames ]
📍 ایدی گروه : [ $chatid ]
📍 لینک گروه : [ $getlinkde  ]
",
        ]);

        botevoobot('editmessagetext', [
            'chat_id' => $chatid,
            'message_id' => $messageid,
            'text' => "درخواست شما برای پشتیبانی ارسال شد✅
🔖لطفا منتظر بمانید تا پشتیبان وارد گروه شود",
            'reply_markup' => json_encode([
                'inline_keyboard' => [
                    [
                        ['text' => "$nemechannel", 'url' => "https://telegram.me/$channel"], ['text' => "🔙 برگشت", 'callback_data' => 'back']
                    ],
                ]
            ])
        ]);
    } else {
        botevoobot('answerCallbackQuery', [
            'callback_query_id' => $membercall,
            'text' => "شما مدیر ربات نیستید ⚠️",
        ]);
    }
} elseif ($data == "requstcheck") {
    if ($statusq == 'creator' || $statusq == 'administrator' || in_array($fromid, $Dev)) {
        $getlink = file_get_contents("https://api.telegram.org/bot$token/exportChatInviteLink?chat_id=$chatid");
        $jsonlink = json_decode($getlink, true);
        $getlinkde = $jsonlink['result'] ?? "";
        $ndate = $settings2["information"]["expire"] ?? "";
        $charge = $settings2["information"]["charge"] ?? "";
        $rdate = $settings2["information"]["dataadded"] ?? "";

        botevoobot('editmessagetext', [
            'chat_id' => $chatid,
            'message_id' => $messageid,
            'text' => "درخواست شما برای پشتیبانی ارسال شد✅
🔖به زودی پشتیبان درخواست شمارا برسی میکند",
            'reply_markup' => json_encode([
                'inline_keyboard' => [
                    [
                        ['text' => "🎉 کانال $botnamef", 'url' => "https://telegram.me/$channel"], ['text' => "🔙 برگشت", 'callback_data' => 'groupe']
                    ],
                ]
            ])
        ]);

        botevoobot('sendmessage', [
            'chat_id' => $Dev[0],
            'text' => "
گروه 🔻 $gpname 🔻تقاظایی شارژ 🔝گروه کرده اند😃✔️

📍 ثبت ربات در تاریخ : [$rdate]
📍 تاریخ شارژ آخر گروه : [$charge]
📍 مقدار شارژ فعلی : [$ndate]
📍 ایدی : [ $fromid ]
📍 نام : [ $firstname ]
📍 یوزرنیم : [ @$usernames ]
📍 ایدی گروه : [ $chatid ]
📍 لینک گروه : [ $getlinkde  ]
",
        ]);
    } else {
        botevoobot('answerCallbackQuery', [
            'callback_query_id' => $membercall,
            'text' => "شما مدیر ربات نیستید ⚠️",
        ]);
    }
} elseif ($data == "filterword") {
    if ($statusq == 'creator' || $statusq == 'administrator' || in_array($fromid, $Dev)) {
        $filter = $settings2["filterlist"] ?? [];
        $result = "";
        for ($z = 0; $z < count($filter); $z++) {
            $result = $result . $filter[$z] . "\n";
        }

        botevoobot('editmessagetext', [
            'chat_id' => $chatid,
            'message_id' => $messageid,
            'text' => "🔖لیست کلمات فیلتر گروه :

$result",
            'reply_markup' => json_encode([
                'inline_keyboard' => [
                    [
                        ['text' => "🗑 پاک کردن لیست فیلتر", 'callback_data' => 'cleanfilterlist']
                    ],
                    [
                        ['text' => "$nemechannel", 'url' => "https://telegram.me/$channel"], ['text' => "🔙 برگشت", 'callback_data' => 'groupe']
                    ],
                ]
            ])
        ]);
    } else {
        botevoobot('answerCallbackQuery', [
            'callback_query_id' => $membercall,
            'text' => "شما مدیر ربات نیستید ⚠️",
        ]);
    }
} elseif ($data == "cleanfilterlist") {
    if ($statusq == 'creator' || $statusq == 'administrator' || in_array($fromid, $Dev)) {
        botevoobot('editmessagetext', [
            'chat_id' => $chatid,
            'message_id' => $messageid,
            'text' => "لیست کلمات فیلتر گروه با موفقیت پاکسازی شد ✔️",
            'reply_markup' => json_encode([
                'inline_keyboard' => [
                    [
                        ['text' => "$nemechannel", 'url' => "https://telegram.me/$channel"], ['text' => "🔙 برگشت", 'callback_data' => 'groupe']
                    ],
                ]
            ])
        ]);

        unset($settings2["filterlist"]);
        $settings = json_encode($settings2, JSON_PRETTY_PRINT);
        secureFilePutContents("data/$chatid.json", $settings);
    } else {
        botevoobot('answerCallbackQuery', [
            'callback_query_id' => $membercall,
            'text' => "شما مدیر ربات نیستید ⚠️",
        ]);
    }
} elseif ($data == "link") {
    if ($statusq == 'creator' || $statusq == 'administrator' || in_array($fromid, $Dev)) {
        $getlink = file_get_contents("https://api.telegram.org/bot$token/exportChatInviteLink?chat_id=$chatid");
        $jsonlink = json_decode($getlink, true);
        $getlinkde = $jsonlink['result'] ?? "";

        botevoobot('editmessagetext', [
            'chat_id' => $chatid,
            'message_id' => $messageid,
            'text' => "💭 لینک گروه شما :
🔸 $getlinkde ",
            'reply_markup' => json_encode([
                'inline_keyboard' => [
                    [
                        ['text' => "$nemechannel", 'url' => "https://telegram.me/$channel"], ['text' => "🔙 برگشت", 'callback_data' => 'groupe']
                    ],
                ]
            ])
        ]);
    } else {
        botevoobot('answerCallbackQuery', [
            'callback_query_id' => $membercall,
            'text' => "شما مدیر ربات نیستید ⚠️",
        ]);
    }
} elseif ($data == "rules") {
    $text = $settings2["information"]["rules"] ?? "";
    if ($statusq == 'creator' || $statusq == 'administrator' || in_array($fromid, $Dev)) {
        botevoobot('editmessagetext', [
            'chat_id' => $chatid,
            'message_id' => $messageid,
            'text' => "💭 قوانین گروه شما :
$text",
            'reply_markup' => json_encode([
                'inline_keyboard' => [
                    [
                        ['text' => "🌟 تنظیم قوانین", 'callback_data' => 'setrules']
                    ],
                    [
                        ['text' => "$nemechannel", 'url' => "https://telegram.me/$channel"], ['text' => "🔙 برگشت", 'callback_data' => 'groupe']
                    ],
                ]
            ])
        ]);
    } else {
        botevoobot('answerCallbackQuery', [
            'callback_query_id' => $membercall,
            'text' => "شما مدیر ربات نیستید ⚠️",
        ]);
    }
} elseif ($data == "setrules") {
    $text = $settings2["information"]["rules"] ?? "";
    if ($statusq == 'creator' || $statusq == 'administrator' || in_array($fromid, $Dev)) {
        botevoobot('editmessagetext', [
            'chat_id' => $chatid,
            'message_id' => $messageid,
            'text' => "💭 قوانین گروه خود را ارسال کنید",
            'reply_markup' => json_encode([
                'inline_keyboard' => [
                    [
                        ['text' => "$nemechannel", 'url' => "https://telegram.me/$channel"], ['text' => "🔙 برگشت", 'callback_data' => 'groupe']
                    ],
                ]
            ])
        ]);

        $settings2["information"]["step"] = "setrules";
        $settings = json_encode($settings2, JSON_PRETTY_PRINT);
        secureFilePutContents("data/$chatid.json", $settings);
    } else {
        botevoobot('answerCallbackQuery', [
            'callback_query_id' => $membercall,
            'text' => "شما مدیر ربات نیستید ⚠️",
        ]);
    }
} elseif ($data == "silentlist") {
    if ($statusq == 'creator' || $statusq == 'administrator' || in_array($fromid, $Dev)) {
        $silent = $settings2["silentlist"] ?? [];
        $result = "";
        for ($z = 0; $z < count($silent); $z++) {
            $result = $result . $silent[$z] . "\n";
        }

        botevoobot('editmessagetext', [
            'chat_id' => $chatid,
            'message_id' => $messageid,
            'text' => "💭 لیست افراد ساکت گروه :

$result ",
            'reply_markup' => json_encode([
                'inline_keyboard' => [
                    [
                        ['text' => "🗑 پاک کردن لیست سکوت", 'callback_data' => 'cleansilentlist']
                    ],
                    [
                        ['text' => "$nemechannel", 'url' => "https://telegram.me/$channel"], ['text' => "🔙 برگشت", 'callback_data' => 'groupe']
                    ],
                ]
            ])
        ]);
    } else {
        botevoobot('answerCallbackQuery', [
            'callback_query_id' => $membercall,
            'text' => "شما مدیر ربات نیستید ⚠️",
        ]);
    }
} elseif ($data == "cleansilentlist") {
    if ($statusq == 'creator' || $statusq == 'administrator' || in_array($fromid, $Dev)) {
        $silent = $settings2["silentlist"] ?? [];
        for ($z = 0; $z < count($silent); $z++) {
            botevoobot('restrictChatMember', [
                'user_id' => $silent[$z],
                'chat_id' => $chatid,
                'can_post_messages' => true,
                'can_add_web_page_previews' => false,
                'can_send_other_messages' => true,
                'can_send_media_messages' => true,
            ]);
        }

        botevoobot('editmessagetext', [
            'chat_id' => $chatid,
            'message_id' => $messageid,
            'text' => "لیست افراد سکوت گروه با موفقیت پاکسازی شد ✔️",
            'reply_markup' => json_encode([
                'inline_keyboard' => [
                    [
                        ['text' => "$nemechannel", 'url' => "https://telegram.me/$channel"], ['text' => "🔙 برگشت", 'callback_data' => 'groupe']
                    ],
                ]
            ])
        ]);

        unset($settings2["silentlist"]);
        $settings = json_encode($settings2, JSON_PRETTY_PRINT);
        secureFilePutContents("data/$chatid.json", $settings);
    } else {
        botevoobot('answerCallbackQuery', [
            'callback_query_id' => $membercall,
            'text' => "شما مدیر ربات نیستید ⚠️",
        ]);
    }
}


elseif ($data == "tabchilist") {
    if ($statusq == 'creator' || $statusq == 'administrator' || in_array($fromid, $Dev)) {
        $silent = $settings2["tabchilist"] ?? [];
        $result = "";
        for ($z = 0; $z < count($silent); $z++) {
            $result = $result . "[$silent[$z]](tg://user?id=$silent[$z])" . "\n";
        }

        botevoobot('editmessagetext', [
            'chat_id' => $chatid,
            'message_id' => $messageid,
            'text' => "💭 لیست تبچی های اخراج شده :

$result ",
            'reply_markup' => json_encode([
                'inline_keyboard' => [
                    [
                        ['text' => "$nemechannel", 'url' => "https://telegram.me/$channel"], ['text' => "🔙 برگشت", 'callback_data' => 'groupe']
                    ],
                ]
            ])
        ]);
    }
}


?>