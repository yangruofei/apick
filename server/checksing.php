<?php
	include "./aes.php";

	//使用redis存储$sing
	$red=new Redis();
	$red->connect("127.0.0.1",6379);

	//检测秘钥
	try{
		if(empty($_GET["sing"])){
			throw new Exception("加密签名不存在");
		}
		
		check($_GET["sing"],$red);
		
	}catch(Exception $e){
		echo resp([],401,$e->getMessage());
		exit;
	}

	//校验签名
	function check($sing,$red){
		$aes = new AESMcrypt($bit = 128, $key = 'abcdef1234567890', $iv = '0987654321fedcba', $mode = 'cbc');
		
		// echo $sing."<br>";

		//将sing中的空格替换为+号
		$sing=str_replace(" ","+",$sing);

		$sing_tmp=$aes->decrypt($sing);
		//分割字符串
		$sing_arr=explode("/",$sing_tmp);

		//用户身份识别
		if($sing_arr[0]!=Token){
			throw new Exception("加密签名不正确");
		}

		//防止api暴露
		if((time()-$sing_arr[1])>5){
			throw new Exception("加密签名失效");
		}
		echo $sing."<br>";
		//多次请求
		if($red->get($sing)){
			throw new Exception("签名已经被使用");
			exit;
		}

		//第二个参数可以随便设置
		$red->set($sing,"true");
		
	}
?>