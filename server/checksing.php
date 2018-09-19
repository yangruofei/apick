<?php
	include "./aes.php";

	//检测秘钥
	try{
		if(empty($_GET["sing"])){
			throw new Exception("加密签名不存在");
		}
		
		check($_GET["sing"]);
		
	}catch(Exception $e){
		echo resp([],401,$e->getMessage());
		exit;
	}

	//校验签名
	function check($sing){
		$aes = new AESMcrypt($bit = 128, $key = 'abcdef1234567890', $iv = '0987654321fedcba', $mode = 'cbc');
		if($aes->decrypt($sing)!=Token){
			throw new Exception("加密签名不正确");
		}
		
	}
?>