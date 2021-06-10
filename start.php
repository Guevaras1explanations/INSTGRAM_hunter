<?php
date_default_timezone_set('Asia/Baghdad');
$config = json_decode(file_get_contents('config.json'),1);
$id = $config['id'];
$token = $config['token'];
$config['filter'] = $config['filter'] != null ? $config['filter'] : 1;
$screen = file_get_contents('screen');
exec('kill -9 ' . file_get_contents($screen . 'pid'));
file_put_contents($screen . 'pid', getmypid());
include 'index.php';
$accounts = json_decode(file_get_contents('accounts.json') , 1);
$cookies = $accounts[$screen]['cookies'];
$useragent = $accounts[$screen]['useragent'];
$users = explode("\n", file_get_contents($screen));
$uu = explode(':', $screen) [0];
$se = 100;
$i = 0;
$gmail = 0;
$hotmail = 0;
$yahoo = 0;
$mailru = 0;
$aol = 0;
$true = 0;
$false = 0;
$edit = bot('sendMessage',[
    'chat_id'=>$id,
    'text'=>"*Status:-*",
    'parse_mode'=>'markdown',
    'reply_markup'=>json_encode([
            'inline_keyboard'=>[
                [['text'=>'Checked  : '.$i,'callback_data'=>'fgf']],
                [['text'=>'On User : '.$user,'callback_data'=>'fgdfg']],
                [['text'=>"Gmail: $gmail",'callback_data'=>'dfgfd'],['text'=>"Yahoo: $yahoo",'callback_data'=>'gdfgfd']],
                [['text'=>'MailRu: '.$mailru,'callback_data'=>'fgd'],['text'=>'Hotmail: '.$hotmail,'callback_data'=>'ghj']],
                [['text'=>'Aol: '.$aol,'callback_data'=>'fahmyaol']],
                [['text'=>'Live ✅ : '.$true,'callback_data'=>'gj']],
                [['text'=>'Died ❎: '.$false,'callback_data'=>'dghkf']]
            ]
        ])
]);
$se = 100;
$editAfter = 1;
foreach ($users as $user) {
    $info = getInfo($user, $cookies, $useragent);
    if ($info != false and !is_string($info)) {
        $mail = trim($info['mail']);
        $usern = $info['user'];
        $e = explode('@', $mail);
               if (preg_match('/(live|hotmail|outlook|yahoo|Yahoo|aol|Aol)\.(com)|(gmail)\.(com)|(mail|bk|yandex|inbox|list)\.(ru)/i', $mail,$m)) {
            echo 'check ' . $mail . PHP_EOL;
                    if(checkMail($mail)){
                        $inInsta = inInsta($mail);
                        if ($inInsta !== false) {
                            // if($config['filter'] <= $follow){
                                echo "True - $user - " . $mail . "\n";
                                if(strpos($mail, 'gmail.com')){
                                    $gmail += 1;
                                } elseif(strpos($mail, 'hotmail.com') or strpos($mail,'outlook.com') or strpos($mail,'live.com')){
                                    $hotmail += 1;
                                } elseif(strpos($mail, 'yahoo.com')){
                                    $yahoo += 1;
                                } elseif(preg_match('/(mail|bk|yandex|inbox|list)\.(ru)/i', $mail)){
                                    $mailru += 1;
                                } elseif(strpos($mail, 'aol.com')){ 
                                	$aol += 1;
                                }
                                $follow = $info['f'];
                                $following = $info['ff'];
                                $media = $info['m'];
                                bot('sendMessage', ['disable_web_page_preview' => true, 'chat_id' => $id, 'text' => "*تم صيد متاح بواسطة المهيب* ✅\n━━━━━━━━━━━━\n*.✥. UserName :* [$usern](instagram.com/$usern)\n*.✥. Email :* [$mail]\n*.✥. Followers :* $follow\n*.✥. Following :* $following\n*.✥. Post :* $media\n━━━━━━━━━━━━\n*Ch :* [@E999G]\n*By :* [@X888E]",
                                
                                'parse_mode'=>'markdown']);
                                
                                bot('editMessageReplyMarkup',[
                                    'chat_id'=>$id,
                                    'message_id'=>$edit->result->message_id,
                                    'reply_markup'=>json_encode([
                                        'inline_keyboard'=>[
                                            [['text'=>'Checked : '.$i,'callback_data'=>'fgf']],
                                            [['text'=>'On User : '.$user,'callback_data'=>'fgdfg']],
                                            [['text'=>"Gmail: $gmail",'callback_data'=>'dfgfd'],['text'=>"Yahoo: $yahoo",'callback_data'=>'gdfgfd']],
                                            [['text'=>'MailRu: '.$mailru,'callback_data'=>'fgd'],['text'=>'Hotmail: '.$hotmail,'callback_data'=>'ghj']],
                                            [['text'=>'Aol: '.$aol,'callback_data'=>'fahmyaol']],
                                            [['text'=>'Live ✅ : '.$true,'callback_data'=>'gj']],
                                            [['text'=>'Died ❎ : '.$false,'callback_data'=>'dghkf']]
                                        ]
                                    ])
                                ]);
                                $true += 1;
                            // } else {
                            //     echo "Filter , ".$mail.PHP_EOL;
                            // }
                            
                        } else {
                          echo "No Rest $mail\n";
                        }
                    } else {
                        $false +=1;
                        echo "Not Vaild 2 - $mail\n";
                    }
        } else {
          echo "BlackList - $mail\n";
        }
    } elseif(is_string($info)){
        bot('sendMessage',[
            'chat_id'=>$id,
            'text'=>"الحساب - `$screen`\n تم حظره من *الفحص*",
            'reply_markup'=>json_encode([
                'inline_keyboard'=>[
                        [['text'=>'نقل اللسته الي حساب اخر 🔄','callback_data'=>'moveList&'.$screen]],
                        [['text'=>'حذف الحساب ⛔','callback_data'=>'del&'.$screen]]
                    ]    
            ]),
            'parse_mode'=>'markdown'
        ]);
        exit;
    } else {
        echo "Not Bussines - $user\n";
    }
    usleep(750000);
    $i++;
    if($i == $editAfter){
        bot('editMessageReplyMarkup',[
            'chat_id'=>$id,
            'message_id'=>$edit->result->message_id,
            'reply_markup'=>json_encode([
                'inline_keyboard'=>[
                    [['text'=>'Checked : '.$i,'callback_data'=>'fgf']],
                    [['text'=>'On User : '.$user,'callback_data'=>'fgdfg']],
                    [['text'=>"Gmail: $gmail",'callback_data'=>'dfgfd'],['text'=>"Yahoo: $yahoo",'callback_data'=>'gdfgfd']],
                    [['text'=>'MailRu: '.$mailru,'callback_data'=>'fgd'],['text'=>'Hotmail: '.$hotmail,'callback_data'=>'ghj']],
                    [['text'=>'Aol: '.$aol,'callback_data'=>'fahmyaol']],
                    [['text'=>'Live ✅ : '.$true,'callback_data'=>'gj']],
                    [['text'=>'Died ❎ : '.$false,'callback_data'=>'dghkf']]
                ]
            ])
        ]);
        $editAfter += 1;
    }
}
bot('sendMessage', ['chat_id' => $id, 'text' =>"انتهى الفحص : ".explode(':',$screen)[0]]);

