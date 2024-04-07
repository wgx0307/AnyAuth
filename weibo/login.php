<?php

error_reporting(0);

require 'login.class.php';
$login=new WeiboLogin();
if($_GET['do']=='getqrcode'){
	$array=$login->getqrcode();
}
if($_GET['do']=='qrlogin'){
	$array=$login->qrlogin($_POST['qrid']);
}
if($_GET['do']=='prelogin'){
	$array=$login->prelogin($_POST['user']);
}
if($_GET['do']=='getpin'){
	header('content-type:image/jpeg');
	echo $login->getpin($_GET['pcid']);
	exit;
}
if($_GET['do']=='login'){
	$array=$login->login($_POST['user'],$_POST['pwd'],$_POST['servertime'],$_POST['nonce'],$_POST['rsakv'],$_POST['pcid'],$_POST['door']);
}
if($_GET['do']=='sendcode'){
	$array=$login->sendcode($_POST['token'],$_POST['encrypt_mobile']);
}
if($_GET['do']=='confirmcode'){
	$array=$login->confirmcode($_POST['token'],$_POST['encrypt_mobile'],$_POST['code']);
}
if($_GET['do']=='sendsms'){
	$array=$login->sendsms($_POST['mobile'],$_POST['token']);
}
if($_GET['do']=='smslogin'){
	$array=$login->smslogin($_POST['user'],$_POST['pwd'],$_POST['servertime'],$_POST['nonce'],$_POST['rsakv']);
}
if($_GET['do']=='qq_getqrcode'){
	$array=$login->qq_getqrcode();
}
if($_GET['do']=='qq_qrlogin'){
	$array=$login->qq_qrlogin($_GET['qrsig']);
}
if($_GET['do']=='qq_connect'){
	$array=$login->qq_connect($_POST['redirect_uri'],$_POST['crossidccode']);
}
if($_GET['do']=='cookielogin'){
	$cookie=[];
	$rows = explode(';', $_POST['cookie']);
	foreach ($rows as $val) {
		$val = trim($val);
		if(empty($val)) continue;
		$key = substr($val, 0, strpos($val, '='));
		$cookie[$key]=substr($val, strpos($val, '=')+1);
	}
	$array=$login->cookielogin($cookie);
}
if($_GET['do']=='getbasicinfo'){
	$cookie=[];
	$rows = explode(';', $_POST['cookie']);
	foreach ($rows as $val) {
		$val = trim($val);
		if(empty($val)) continue;
		$key = substr($val, 0, strpos($val, '='));
		$cookie[$key]=substr($val, strpos($val, '=')+1);
	}
	$array=$login->getBasicInfo($cookie);
}

echo json_encode($array);