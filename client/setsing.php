<?php
	include "./aes.php";
	//加密签名
	function setsing($token){
		$aes = new AESMcrypt($bit = 128, $key = 'abcdef1234567890', $iv = '0987654321fedcba', $mode = 'cbc');
		$sing=$aes->encrypt($token);
		return $sing;
	}
?>