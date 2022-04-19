<?php
date_default_timezone_set('Africa/Cairo');
if(!file_exists('config.json')){
	$token = readline('HI MARO Enter Token: ');
	$id = readline('HI MARO Enter Id: ');
	file_put_contents('config.json', json_encode(['id'=>$id,'token'=>$token]));
	
} else {
		  $config = json_decode(file_get_contents('config.json'),1);
	$token = $config['token'];
	$id = $config['id'];
}

if(!file_exists('accounts.json')){
    file_put_contents('accounts.json',json_encode([]));
}
include 'index.php';
try {
	$callback = function ($update, $bot) {
		global $id;
		if($update != null){
		  $config = json_decode(file_get_contents('config.json'),1);
		  $config['filter'] = $config['filter'] != null ? $config['filter'] : 1;
      $accounts = json_decode(file_get_contents('accounts.json'),1);
			if(isset($update->message)){
				$message = $update->message;
				$chatId = $message->chat->id;
				$text = $message->text;
				if($chatId == $id){
					if($text == '/start'){
              $bot->sendphoto([ 'chat_id'=>$chatId,
                  'photo'=>"https://t.me/N9JN9j/7",
                   'caption'=>'𝙬𝙚𝙡𝙘𝙤𝙢𝙚 𝙞𝙣 𝙗𝙤𝙩 𝙝𝙪𝙣𝙩𝙚𝙧 𝙗𝙮 ꙰𝙢𝙖𝙧𝙤꙰ 🇲🇽',
                  'reply_markup'=>json_encode([
                      'inline_keyboard'=>[
                            [['text'=>'• 𝙖𝙙𝙙 𝙖𝙘𝙘𝙤𝙪𝙣𝙩 📬','callback_data'=>'login']],
                            [['text'=>"𝙗𝙤𝙩 𝙙𝙚𝙨𝙘𝙧𝙞𝙥𝙩𝙞𝙤𝙣  👑️", 'url'=>"t.me/YXUYT/3"]],
                      ]
                  ])
                ]);   
             
             $bot->sendvideo([ 'chat_id'=>$chatId,
                  'video'=>"https://t.me/YXUYuuuytrrttT/3",
                   'caption'=>'maro',

                ]);

               
                 $bot->sendvoice([ 'chat_id'=>$chatId,
                  'voice'=>"https://t.me/YXUhldodykdulduYT/3",
                   'caption'=>'maro',

                ]);
                
                $bot->sendvoice([ 'chat_id'=>$chatId,
                  'voice'=>"https://t.me/YhkxgkdhkxhXUYT/3",
                   'caption'=>'maro️',

                ]);

          } elseif($text != null){
          	if($config['mode'] != null){
          		$mode = $config['mode'];
          		if($mode == 'addL'){
          			$ig = new ig(['file'=>'','account'=>['useragent'=>'Instagram 27.0.0.7.97 (iPhone; CPU iPhone OS 9.1 like Mac OS X; en_US)']]);
          			list($user,$pass) = explode(':',$text);
          			list($headers,$body) = $ig->login($user,$pass);
          			// echo $body;
          			$body = json_decode($body);
          			if(isset($body->message)){
          				if($body->message == 'challenge_required'){
          					$bot->sendMessage([
          							'chat_id'=>$chatId,
          							'parse_mode'=>'markdown',
          							'text'=>"The account has been rejected because it is blocked🔒"
          					]);
          				} else {
          					$bot->sendMessage([
          							'chat_id'=>$chatId,
          							'parse_mode'=>'markdown',
          							'text'=>"User and password error🔑"
          					]);
          				}
          			} elseif(isset($body->logged_in_user)) {
          				$body = $body->logged_in_user;
          				preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', $headers, $matches);
								  $CookieStr = "";
								  foreach($matches[1] as $item) {
								      $CookieStr .= $item."; ";
								  }
          				$account = ['cookies'=>$CookieStr,'useragent'=>'Instagram 27.0.0.7.97 (iPhone; CPU iPhone OS 9.1 like Mac OS X; en_US)'];
          				
          				$accounts[$text] = $account;
          				file_put_contents('accounts.json', json_encode($accounts));
          				$mid = $config['mid'];
          				$bot->sendMessage([
          				      'parse_mode'=>'markdown',
          							'chat_id'=>$chatId,
          							'text'=>"𝙳𝙾𝙽 𝙰𝙳𝙳 𝙰𝙲𝙲𝙾𝚄𝙽𝚃 💣.*\n _Username_ : [$user])(instagram.com/$user)\n_Account Name_ : _{$body->full_name}_",
												'reply_to_message_id'=>$mid		
          					]);
          				$keyboard = ['inline_keyboard'=>[
										[['text'=> "𝗔𝗗𝗗 𝗔𝗖𝗖𝗢𝗨𝗡𝗧 𝗙𝗔𝗞𝗘🌿",'callback_data'=>'addL']]
									]];
		              foreach ($accounts as $account => $v) {
		                  $keyboard['inline_keyboard'][] = [['text'=>$account,'callback_data'=>'ddd'],['text'=>"𝙡𝙤𝙜𝙤𝙪𝙩 🦑",'callback_data'=>'del&'.$account]];
		              }
		              $keyboard['inline_keyboard'][] = [['text'=>'𝙝𝙤𝙢𝙚 𝙥𝙖𝙜𝙚 🌍 ','callback_data'=>'back']];
		              $bot->editMessageText([
		                  'chat_id'=>$chatId,
		                  'message_id'=>$mid,
		                  'text'=>"•𝙛𝙖𝙠𝙚 𝙖𝙘𝙘𝙤𝙪𝙣𝙩 𝙘𝙤𝙣𝙩𝙧𝙤𝙡 𝙥𝙖𝙜𝙚 📬",
		                  'reply_markup'=>json_encode($keyboard)
		              ]);
		              $config['mode'] = null;
		              $config['mid'] = null;
		              file_put_contents('config.json', json_encode($config));
          			}
          		}  elseif($mode == 'selectFollowers'){
          		  if(is_numeric($text)){
          		    bot('sendMessage',[
          		        'chat_id'=>$chatId,
          		        'text'=>"tm eidd.",
          		        'reply_to_message_id'=>$config['mid']
          		    ]);
          		    $config['filter'] = $text;
          		    $bot->editMessageText([
                      'chat_id'=>$chatId,
                      'message_id'=>$mid,
                      'text'=>"• 𝙬𝙚𝙡𝙘𝙤𝙢𝙚 𝙞𝙣 𝙗𝙤𝙩 𝙝𝙪𝙣𝙩𝙚𝙧 𝙗𝙮 ꙰𝙢𝙖𝙧𝙤꙰ 🍻️
𝙳𝙴𝚅  ~» @MA_RO1",
                  'reply_markup'=>json_encode([
                      'inline_keyboard'=>[
                          [['text'=>'𝙖𝙙𝙙 𝙖𝙘𝙘𝙤𝙪𝙣𝙩 🚦','callback_data'=>'login']],
                          [['text'=>'𝙛𝙞𝙨𝙝𝙞𝙣𝙜 𝙢𝙚𝙩𝙝𝙤𝙙𝙨 🌀','callback_data'=>'grabber']],
                          [['text'=>'𝙨𝙩𝙖𝙧𝙩 𝙛𝙞𝙨𝙝𝙞𝙣𝙜 ⏸','callback_data'=>'run'],['text'=>'𝙨𝙩𝙤𝙥 𝙛𝙞𝙨𝙝𝙞𝙣𝙜 ▶️','callback_data'=>'stop']],
                          [['text'=>'𝙖𝙘𝙘𝙤𝙪𝙣𝙩 𝙨𝙩𝙖𝙩𝙪𝙨 ♻️','callback_data'=>'status']]
                      ]
                  ])
                  ]);
          		    $config['mode'] = null;
		              $config['mid'] = null;
		              file_put_contents('config.json', json_encode($config));
          		  } else {
          		    bot('sendMessage',[
          		        'chat_id'=>$chatId,
          		        'text'=>'- seend nu .'
          		    ]);
          		  }
          		} else {
          		  switch($config['mode']){
          		    case 'search': 
          		      $config['mode'] = null; 
          		      $config['words'] = $text;
          		      file_put_contents('config.json', json_encode($config));
          		      exec('screen -dmS gr php search.php');
          		      break;
          		      case 'followers': 
          		      $config['mode'] = null; 
          		      $config['words'] = $text;
          		      file_put_contents('config.json', json_encode($config));
          		      exec('screen -dmS gr php followers.php');
          		      break;
          		      case 'following': 
          		      $config['mode'] = null; 
          		      $config['words'] = $text;
          		      file_put_contents('config.json', json_encode($config));
          		      exec('screen -dmS gr php following.php');
          		      break;
          		      case 'hashtag': 
          		      $config['mode'] = null; 
          		      $config['words'] = $text;
          		      file_put_contents('config.json', json_encode($config));
          		      exec('screen -dmS gr php hashtag.php');
          		      break;
          		  }
          		}
          	}
          }
				} else {
				    $bot->sendvideo([
       'chat_id'=>$chatId,
       'video'=> "https://t.me/N9JN9j/4",
        'caption'=>'𝙚𝙧𝙧𝙤𝙧 𝙣𝙤 𝙙𝙖𝙩𝙖 ツ 𝙲𝙰𝙻𝙻 𝙳𝙴𝚅✓',
                  'reply_markup'=>json_encode([
                      'inline_keyboard'=>[
                          [['text'=>'▫️MARO~','url'=>'t.me/MA_RO1']],
                       [['text'=>"𝙗𝙤𝙩 𝙙𝙚𝙨𝙘𝙧𝙞𝙥𝙩𝙞𝙤𝙣!", 'url'=>"t.me/YXUYT/3"]],
                      ]
                  ])
              ]);   
				}
			} elseif(isset($update->callback_query)) {
          $chatId = $update->callback_query->message->chat->id;
          $mid = $update->callback_query->message->message_id;
          $data = $update->callback_query->data;
          echo $data;
          if($data == 'login'){
              
        		$keyboard = ['inline_keyboard'=>[
									[['text'=>"𝙖𝙙𝙙 𝙖𝙘𝙘𝙤𝙪𝙣𝙩  💢",'callback_data'=>'addL']]
									]];
		              foreach ($accounts as $account => $v) {
		                  $keyboard['inline_keyboard'][] = [['text'=>$account,'callback_data'=>'ddd'],['text'=>"𝙡𝙤𝙜𝙤𝙪𝙩 🦑",'callback_data'=>'del&'.$account]];
		              }
		              $keyboard['inline_keyboard'][] = [['text'=>'𝙝𝙤𝙢𝙚 𝙥𝙖𝙜𝙚 📌','callback_data'=>'back']];
		              $bot->sendMessage([
		                  'chat_id'=>$chatId,
		                  'message_id'=>$mid,
		                   'text'=>"• 𝙛𝙖𝙠𝙚 𝙖𝙘𝙘𝙤𝙪𝙣𝙩 𝙘𝙤𝙣𝙩𝙧𝙤𝙡 𝙥𝙖𝙜𝙚  ⚙",
		                  'reply_markup'=>json_encode($keyboard)
		              ]);
          } elseif($data == 'addL'){
          	
          	$config['mode'] = 'addL';
          	$config['mid'] = $mid;
          	file_put_contents('config.json', json_encode($config));
          	$bot->sendMessage([
          			'chat_id'=>$chatId,
          			'text'=>" 𝙨𝙪𝙗𝙢𝙞𝙩 𝙩𝙝𝙚 𝙖𝙘𝙘𝙤𝙪𝙣𝙩 𝙡𝙞𝙠𝙚 𝙩𝙝𝙞𝙨  `user:pass`",
          			'parse_mode'=>'markdown'
          	]);
          } elseif($data == 'grabber'){
            
            $for = $config['for'] != null ? $config['for'] : '𝙨𝙚𝙡𝙚𝙘𝙩 𝙩𝙝𝙚 𝙖𝙘𝙘𝙤𝙪𝙣𝙩 †';
            $count = count(explode("\n", file_get_contents($for)));
            $bot->editMessageText([
                'chat_id'=>$chatId,
                'message_id'=>$mid,
                'text'=>"Users collection page. \n - Users : $count \n - For Account : $for",
                'reply_markup'=>json_encode([
                    'inline_keyboard'=>[
                        [['text'=>'𝙪𝙨𝙚𝙧 𝙛𝙤𝙧 𝙝𝙪𝙣𝙩𝙞𝙣𝙜  🔎','callback_data'=>'usermaro']],
                        [['text'=>'𝙛𝙧𝙤𝙢 𝙨𝙚𝙖𝙧𝙘𝙝 ⌨','callback_data'=>'search']],
                        [['text'=>'𝙛𝙧𝙤𝙢 𝙝𝙖𝙨𝙝𝙩𝙖𝙜 #🏷','callback_data'=>'hashtag'],['text'=>'𝙛𝙧𝙤𝙢 𝙚𝙭𝙥𝙡𝙤𝙧𝙚𝙧 📊','callback_data'=>'explore']],
                        [['text'=>'𝙛𝙧𝙤𝙢 𝙛𝙤𝙡𝙡𝙤𝙬𝙚𝙧𝙨 👥','callback_data'=>'followers'],['text'=>"𝙛𝙧𝙤𝙢 𝙛𝙤𝙡𝙡𝙤𝙬𝙞𝙣𝙜 👤",'callback_data'=>'following']],
                        [['text'=>"𝙩𝙝𝙚 𝙖𝙘𝙘𝙤𝙪𝙣𝙩 † ♾ : $for",'callback_data'=>'for']],
                        [['text'=>'𝙣𝙚𝙬 𝙡𝙞𝙨𝙩  📮','callback_data'=>'newList'],['text'=>'𝙤𝙡𝙙 𝙡𝙞𝙨𝙩 🗂','callback_data'=>'append']],
                        [['text'=>'𝙝𝙤𝙢𝙚 𝙥𝙖𝙜𝙚 📌','callback_data'=>'back']]
                    ]
                ])
            ]);
          } if($data == 'usermaro'){
            $bot->sendmessage([ 
               'chat_id'=>$chatId,
               'message'=>"https://t.me/fhhunter/3",
               'caption'=>'maro️',
                 
             ]);    
          } elseif($data == 'search'){
            $bot->sendMessage([
                'chat_id'=>$chatId,
                'text'=>"𝙣𝙤𝙬 𝙨𝙚𝙣𝙙 𝙩𝙝𝙚 𝙬𝙤𝙧𝙙 𝙮𝙤𝙪 𝙬𝙖𝙣𝙩 𝙩𝙤 𝙨𝙚𝙖𝙧𝙘𝙝 𝙖𝙣𝙙 𝙖𝙡𝙨𝙤 𝙚𝙣𝙖𝙗𝙡𝙚𝙨 𝙮𝙤𝙪 𝙩𝙤 𝙪𝙨𝙚 𝙢𝙤𝙧𝙚 𝙩𝙝𝙖𝙣 𝙤𝙣𝙚 𝙬𝙤𝙧𝙙 𝙗𝙮 𝙥𝙪𝙩𝙩𝙞𝙣𝙜 𝙨𝙥𝙖𝙘𝙚𝙨 𝙗𝙚𝙩𝙬𝙚𝙚𝙣 𝙬𝙤𝙧𝙙𝙨 𓅃"
            ]);
            $config['mode'] = 'search';
            file_put_contents('config.json', json_encode($config));
          } elseif($data == 'followers'){
            $bot->sendMessage([
                'chat_id'=>$chatId,
                'text'=>"𝙣𝙤𝙬, 𝙨𝙚𝙣𝙙 𝙩𝙝𝙚 𝙪𝙨𝙚𝙧 𝙮𝙤𝙪 𝙬𝙖𝙣𝙩 𝙩𝙤 𝙬𝙞𝙩𝙝𝙙𝙧𝙖𝙬 𝙛𝙤𝙡𝙡𝙤𝙬𝙚𝙧𝙨, 𝙖𝙣𝙙 𝙮𝙤𝙪 𝙘𝙖𝙣 𝙖𝙡𝙨𝙤 𝙪𝙨𝙚 𝙢𝙤𝙧𝙚 𝙩𝙝𝙖𝙣 𝙤𝙣𝙚 𝙪𝙨𝙚𝙧 𝙗𝙮 𝙥𝙡𝙖𝙘𝙞𝙣𝙜 𝙗𝙧𝙚𝙖𝙠𝙨 𝙗𝙚𝙩𝙬𝙚𝙚𝙣 𝙩𝙝𝙚 𝙪𝙨𝙚𝙧𝙨."
            ]);
            $config['mode'] = 'followers';
            file_put_contents('config.json', json_encode($config));
          } elseif($data == 'following'){
            $bot->sendMessage([
                'chat_id'=>$chatId,
                'text'=>"𝙣𝙤𝙬, 𝙨𝙚𝙣𝙙 𝙩𝙝𝙚 𝙪𝙨𝙚𝙧 𝙮𝙤𝙪 𝙬𝙖𝙣𝙩 𝙩𝙤 𝙬𝙞𝙩𝙝𝙙𝙧𝙖𝙬 𝙛𝙤𝙡𝙡𝙤𝙬𝙞𝙣𝙜 ،, 𝙖𝙣𝙙 𝙮𝙤𝙪 𝙘𝙖𝙣 𝙖𝙡𝙨𝙤 𝙪𝙨𝙚 𝙢𝙤𝙧𝙚 𝙩𝙝𝙖𝙣 𝙤𝙣𝙚 𝙪𝙨𝙚𝙧 𝙗𝙮 𝙥𝙡𝙖𝙘𝙞𝙣𝙜 𝙗𝙧𝙚𝙖𝙠𝙨 𝙗𝙚𝙩𝙬𝙚𝙚𝙣 𝙩𝙝𝙚 𝙪𝙨𝙚𝙧𝙨."
            ]);
            $config['mode'] = 'following';
            file_put_contents('config.json', json_encode($config));
          } elseif($data == 'hashtag'){
            $bot->sendMessage([
                'chat_id'=>$chatId,
                'text'=>"𝙣𝙤𝙬 𝙨𝙚𝙣𝙙 𝙩𝙝𝙚 𝙝𝙖𝙨𝙝𝙩𝙖𝙜 𝙬𝙞𝙩𝙝𝙤𝙪𝙩 𝙩𝙝𝙚 𝙝𝙖𝙨𝙝𝙩𝙖𝙜 # 𝙮𝙤𝙪 𝙘𝙖𝙣 𝙤𝙣𝙡𝙮 𝙪𝙨𝙚 𝙤𝙣𝙚 𝙝𝙖𝙨𝙝𝙩𝙖𝙜"
            ]);
            $config['mode'] = 'hashtag';
            file_put_contents('config.json', json_encode($config));
          } elseif($data == 'newList'){
            file_put_contents('a','new');
            $bot->answerCallbackQuery([
							'callback_query_id'=>$update->callback_query->id,
							'text'=>"𝙖 𝙣𝙚𝙬 𝙡𝙞𝙨𝙩 𝙝𝙖𝙨 𝙗𝙚𝙚𝙣 𝙨𝙚𝙡𝙚𝙘𝙩𝙚𝙙 𝙨𝙪𝙘𝙘𝙚𝙨𝙨𝙛𝙪𝙡𝙡𝙮 🥴",
							'show_alert'=>1
						]);
          } elseif($data == 'append'){ 
            file_put_contents('a', 'ap');
            $bot->answerCallbackQuery([
							'callback_query_id'=>$update->callback_query->id,
							'text'=>"𝙩𝙝𝙚 𝙤𝙡𝙙 𝙡𝙞𝙨𝙩 𝙝𝙖𝙨 𝙗𝙚𝙚𝙣 𝙨𝙚𝙡𝙚𝙘𝙩𝙚𝙙 𝙨𝙪𝙘𝙘𝙚𝙨𝙨𝙛𝙪𝙡𝙡𝙮 💤",
							'show_alert'=>1
						]);
						
          } elseif($data == 'for'){
            if(!empty($accounts)){
            $keyboard = [];
             foreach ($accounts as $account => $v) {
                $keyboard['inline_keyboard'][] = [['text'=>$account,'callback_data'=>'forg&'.$account]];
              }
              $bot->editMessageText([
                  'chat_id'=>$chatId,
                  'message_id'=>$mid,
                  'text'=>"𝙘𝙝𝙤𝙤𝙨𝙚 𝙩𝙝𝙚 𝙖𝙘𝙘𝙤𝙪𝙣𝙩",
                  'reply_markup'=>json_encode($keyboard)
              ]);
            } else {
              $bot->answerCallbackQuery([
							'callback_query_id'=>$update->callback_query->id,
							'text'=>"𝙖𝙙𝙙 𝙖𝙣 𝙖𝙘𝙘𝙤𝙪𝙣𝙩 𝙞𝙣 𝙩𝙝𝙚 𝙗𝙖𝙘𝙠 ،🥀",
							'show_alert'=>1
						]);
            }
          } elseif($data == 'selectFollowers'){
            bot('sendMessage',[
                'chat_id'=>$chatId,
                'text'=>'sebd num .'  
            ]);
            $config['mode'] = 'selectFollowers';
          	$config['mid'] = $mid;
          	file_put_contents('config.json', json_encode($config));
          } elseif($data == 'run'){
            if(!empty($accounts)){
            $keyboard = [];
             foreach ($accounts as $account => $v) {
                $keyboard['inline_keyboard'][] = [['text'=>$account,'callback_data'=>'start&'.$account]];
              }
              $bot->editMessageText([
                  'chat_id'=>$chatId,
                  'message_id'=>$mid,
                  'text'=>"حدد حساب",
                  'reply_markup'=>json_encode($keyboard)
              ]);
            } else {
              $bot->answerCallbackQuery([
							'callback_query_id'=>$update->callback_query->id,
							'text'=>"𝙖𝙙𝙙 𝙖𝙣 𝙖𝙘𝙘𝙤𝙪𝙣𝙩 𝙞𝙣 𝙩𝙝𝙚 𝙗𝙖𝙘𝙠 ،🥀",
							'show_alert'=>1
						]);
            }
          }elseif($data == 'stop'){
            if(!empty($accounts)){
            $keyboard = [];
             foreach ($accounts as $account => $v) {
                $keyboard['inline_keyboard'][] = [['text'=>$account,'callback_data'=>'stop&'.$account]];
              }
              $bot->editMessageText([
                  'chat_id'=>$chatId,
                  'message_id'=>$mid,
                  'text'=>"𝙘𝙝𝙤𝙤𝙨𝙚 𝙩𝙝𝙚 𝙖𝙘𝙘𝙤𝙪𝙣𝙩",
                  'reply_markup'=>json_encode($keyboard)
              ]);
            } else {
              $bot->answerCallbackQuery([
							'callback_query_id'=>$update->callback_query->id,
							'text'=>"𝙖𝙙𝙙 𝙖𝙣 𝙖𝙘𝙘𝙤𝙪𝙣𝙩 𝙞𝙣 𝙩𝙝𝙚 𝙗𝙖𝙘𝙠 ،🥀",
							'show_alert'=>1
						]);
            }
          }elseif($data == 'stopgr'){
            shell_exec('screen -S gr -X quit');
            $bot->answerCallbackQuery([
							'callback_query_id'=>$update->callback_query->id,
							'text'=>"𝙙𝙧𝙖𝙬 𝙝𝙖𝙨 𝙗𝙚𝙚𝙣 𝙘𝙤𝙢𝙥𝙡𝙚𝙩𝙚𝙙 𖤍",
						// 	'show_alert'=>1
						]);
						$for = $config['for'] != null ? $config['for'] : 'Select Account';
            $count = count(explode("\n", file_get_contents($for)));
						$bot->editMessageText([
                'chat_id'=>$chatId,
                'message_id'=>$mid,
                'text'=>"Users collection page. \n - Users : $count \n - For Account : $for",
                'reply_markup'=>json_encode([
                    'inline_keyboard'=>[
                        [['text'=>'𝙪𝙨𝙚𝙧 𝙛𝙤𝙧 𝙝𝙪𝙣𝙩𝙞𝙣𝙜  🔎','callback_data'=>'usermaro']],
                        [['text'=>'𝙛𝙧𝙤𝙢 𝙨𝙚𝙖𝙧𝙘𝙝 ⌨','callback_data'=>'search']],
                        [['text'=>'𝙛𝙧𝙤𝙢 𝙝𝙖𝙨𝙝𝙩𝙖𝙜 🏷','callback_data'=>'hashtag'],['text'=>'𝙛𝙧𝙤𝙢 𝙚𝙭𝙥𝙡𝙤𝙧𝙚𝙧 📊','callback_data'=>'explore']],
                        [['text'=>'𝙛𝙧𝙤𝙢 𝙛𝙤𝙡𝙡𝙤𝙬𝙚𝙧𝙨 👥','callback_data'=>'followers'],['text'=>"𝙛𝙧𝙤𝙢 𝙛𝙤𝙡𝙡𝙤𝙬𝙞𝙣𝙜 👤",'callback_data'=>'following']],
                        [['text'=>"𝙩𝙝𝙚 𝙖𝙘𝙘𝙤𝙪𝙣𝙩 ♾ : $for",'callback_data'=>'for']],
                        [['text'=>'𝙣𝙚𝙬 𝙡𝙞𝙨𝙩 ??','callback_data'=>'newList'],['text'=>'𝙤𝙡𝙙 𝙡𝙞𝙨𝙩 🗂','callback_data'=>'append']],
                        [['text'=>'𝙝𝙤𝙢𝙚 𝙥𝙖𝙜𝙚 📌','callback_data'=>'back']]
                    ]
                ])
            ]);
          } elseif($data == 'explore'){
            exec('screen -dmS gr php explore.php');
          } elseif($data == 'status'){
					$status = '';
					foreach($accounts as $account => $ac){
						$c = explode(':', $account)[0];
						$x = exec('screen -S '.$c.' -Q select . ; echo $?');
						if($x == '0'){
				        $status .= "*$account* ~> _Working_\n";
				    } else {
				        $status .= "*$account* ~> _Stop_\n";
				    }
					}
					$bot->sendMessage([
							'chat_id'=>$chatId,
							'text'=>"𝙖𝙘𝙘𝙤𝙪𝙣𝙩 𝙨𝙩𝙖𝙩𝙪𝙨 ✹ : \n\n $status",
							'parse_mode'=>'markdown'
						]);
				} elseif($data == 'back'){
          	$bot->editMessageText([
                      'chat_id'=>$chatId,
                      'message_id'=>$mid,
                     'text'=>"• 𝙬𝙚𝙡𝙘𝙤𝙢𝙚 𝙞𝙣 𝙗𝙤𝙩 𝙝𝙪𝙣𝙩𝙚𝙧 𝙗𝙮 ꙰𝙢𝙖𝙧𝙤꙰ 🍻️
𝙳𝙴𝚅  ~» @MA_RO1",
                  'reply_markup'=>json_encode([
                      'inline_keyboard'=>[
                          [['text'=>'𝙖𝙙𝙙 𝙖𝙘𝙘𝙤𝙪𝙣𝙩 🚦','callback_data'=>'login']],
                          [['text'=>'𝙛𝙞𝙨𝙝𝙞𝙣𝙜 𝙢𝙚𝙩𝙝𝙤𝙙𝙨 🌀','callback_data'=>'grabber']],
                          [['text'=>'𝙨𝙩𝙖𝙧𝙩 𝙛𝙞𝙨𝙝𝙞𝙣𝙜 ⏸','callback_data'=>'run'],['text'=>'𝙨𝙩𝙤𝙥 𝙛𝙞𝙨𝙝𝙞𝙣𝙜 ▶️','callback_data'=>'stop']],
                          [['text'=>'𝙖𝙘𝙘𝙤𝙪𝙣𝙩 𝙨𝙩𝙖𝙩𝙪𝙨 ♻️','callback_data'=>'status']]
                      ]
                  ])
                  ]);
          } else {
          	$data = explode('&',$data);
          	if($data[0] == 'del'){
          		
          		unset($accounts[$data[1]]);
          		file_put_contents('accounts.json', json_encode($accounts));
              $keyboard = ['inline_keyboard'=>[
							[['text'=>"𝙖𝙙𝙙 𝙖𝙘𝙘𝙤𝙪𝙣𝙩 💢",'callback_data'=>'addL']]
									]];
		              foreach ($accounts as $account => $v) {
		                  $keyboard['inline_keyboard'][] = [['text'=>$account,'callback_data'=>'ddd'],['text'=>"𝙡𝙤𝙜𝙤𝙪𝙩 🦑",'callback_data'=>'del&'.$account]];
		              }
		              $keyboard['inline_keyboard'][] = [['text'=>'𝙝𝙤𝙢𝙚 𝙥𝙖𝙜𝙚 📌','callback_data'=>'back']];
		              $bot->editMessageText([
		                  'chat_id'=>$chatId,
		                  'message_id'=>$mid,
		                    'text'=>"• 𝙛𝙖𝙠𝙚 𝙖𝙘𝙘𝙤𝙪𝙣𝙩 𝙘𝙤𝙣𝙩𝙧𝙤𝙡 𝙥𝙖𝙜𝙚 ⚙",
		                  'reply_markup'=>json_encode($keyboard)
		              ]);
          	} elseif($data[0] == 'forg'){
          	  $config['for'] = $data[1];
          	  file_put_contents('config.json',json_encode($config));
              $for = $config['for'] != null ? $config['for'] : 'Select';
              $count = count(explode("\n", file_get_contents($for)));
              $bot->editMessageText([
                'chat_id'=>$chatId,
                'message_id'=>$mid,
                'text'=>"Users collection page. \n - Users : $count \n - For Account : $for",
                'reply_markup'=>json_encode([
                    'inline_keyboard'=>[
                        [['text'=>'𝙛𝙧𝙤𝙢 𝙨𝙚𝙖𝙧𝙘𝙝 ⌨','callback_data'=>'search']],
                        [['text'=>'𝙛𝙧𝙤𝙢 𝙝𝙖𝙨𝙝𝙩𝙖𝙜 #🏷','callback_data'=>'hashtag'],['text'=>'𝙛𝙧𝙤𝙢 𝙚𝙭𝙥𝙡𝙤𝙧𝙚𝙧 📊','callback_data'=>'explore']],
                        [['text'=>'𝙛𝙧𝙤𝙢 𝙛𝙤𝙡𝙡𝙤𝙬𝙚𝙧𝙨 👥','callback_data'=>'followers'],['text'=>"𝙛𝙧𝙤𝙢 𝙛𝙤𝙡𝙡𝙤𝙬𝙞𝙣𝙜 👤",'callback_data'=>'following']],
                        [['text'=>"𝙩𝙝𝙚 𝙖𝙘𝙘𝙤𝙪𝙣𝙩 ♾ : $for",'callback_data'=>'for']],
                        [['text'=>'𝙣𝙚𝙬 𝙡𝙞𝙨𝙩 📮','callback_data'=>'newList'],['text'=>'𝙤𝙡𝙙 𝙡𝙞𝙨𝙩 🗂','callback_data'=>'append']],
                        [['text'=>'𝙝𝙤𝙢𝙚 𝙥𝙖𝙜𝙚 📌','callback_data'=>'back']]
                    ]
                ])
            ]);
          	} elseif($data[0] == 'start'){
          	  file_put_contents('screen', $data[1]);
          	  $bot->editMessageText([
                      'chat_id'=>$chatId,
                      'message_id'=>$mid,
                       'text'=> "• 𝙬𝙚𝙡𝙘𝙤𝙢𝙚 𝙞𝙣 𝙗𝙤𝙩 𝙝𝙪𝙣𝙩𝙚𝙧 𝙗𝙮 ꙰𝙢𝙖𝙧𝙤꙰ 🍻️
𝙳𝙴𝚅  ~» @MA_RO1",
                  'reply_markup'=>json_encode([
                      'inline_keyboard'=>[
                          [['text'=>'𝙖𝙙𝙙 𝙖𝙘𝙘𝙤𝙪𝙣𝙩 🚦','callback_data'=>'login']],
                          [['text'=>'𝙛𝙞𝙨𝙝𝙞𝙣𝙜 𝙢𝙚𝙩𝙝𝙤𝙙𝙨 🌀','callback_data'=>'grabber']],
                          [['text'=>'𝙨𝙩𝙖𝙧𝙩 𝙛𝙞𝙨𝙝𝙞𝙣𝙜 ⏸','callback_data'=>'run'],['text'=>'𝙨𝙩𝙤𝙥 𝙛𝙞𝙨𝙝𝙞𝙣𝙜 ▶️','callback_data'=>'stop']],
                          [['text'=>'𝙖𝙘𝙘𝙤𝙪𝙣𝙩 𝙨𝙩𝙖𝙩𝙪𝙨 ♻️','callback_data'=>'status']]
                      ]
                  ])
                  ]);
              exec('screen -dmS '.explode(':',$data[1])[0].' php start.php');
              $bot->sendMessage([
                'chat_id'=>$chatId,
                'text'=>"*𝙨𝙩𝙖𝙧𝙩 𝙛𝙞𝙨𝙝𝙞𝙣𝙜 .*\n Account: `".explode(':',$data[1])[0].'`',
                'parse_mode'=>'markdown'
              ]);
          	} elseif($data[0] == 'stop'){
          	  $bot->editMessageText([
                      'chat_id'=>$chatId,
                      'message_id'=>$mid,
                      'text'=>"• 𝙬𝙚𝙡𝙘𝙤𝙢𝙚 𝙞𝙣 𝙗𝙤𝙩 𝙝𝙪𝙣𝙩𝙚𝙧 𝙗𝙮 ꙰𝙢𝙖𝙧𝙤꙰ 🍻️
𝙳𝙴𝚅 ~» @MA_RO1",
                  'reply_markup'=>json_encode([
                      'inline_keyboard'=>[
                          [['text'=>'𝙖𝙙𝙙 𝙖𝙘𝙘𝙤𝙪𝙣𝙩 🚦','callback_data'=>'login']],
                          [['text'=>'𝙛𝙞𝙨𝙝𝙞𝙣𝙜 𝙢𝙚𝙩𝙝𝙤𝙙𝙨 🌀','callback_data'=>'grabber']],
                          [['text'=>'𝙨𝙩𝙖𝙧𝙩 𝙛𝙞𝙨𝙝𝙞𝙣𝙜 ⏸','callback_data'=>'run'],['text'=>'𝙨𝙩𝙤𝙥 𝙛𝙞𝙨𝙝𝙞𝙣𝙜 ▶️','callback_data'=>'stop']],
                          [['text'=>'𝙖𝙘𝙘𝙤𝙪𝙣𝙩 𝙨𝙩𝙖𝙩𝙪𝙨 ♻️','callback_data'=>'status']]
                      ]
                    ])
                  ]);
              exec('screen -S '.explode(':',$data[1])[0].' -X quit');
          	}
          }
			}
		}
	};
	$bot = new EzTG(array('throw_telegram_errors'=>false,'token' => $token, 'callback' => $callback));
} catch(Exception $e){
	echo $e->getMessage().PHP_EOL;
	sleep(1);
}
