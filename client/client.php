<?php
	include "./vendor/autoload.php";
	include "./setsing.php";

	//定义秘钥
	$token="test";

	//生成一个加密签名
	$sing=setsing($token);

	//请求的api地址
	$url="http://localhost/api/server/server.php?sing=".$sing;

	$curl = new Curl\Curl();
	$curl->post($url, array(
		"name"=>"a",
		"age"=>"1",
		"sex"=>""
	));

	if ($curl->error) {
	    echo $curl->error_code;
	}else{
	    echo $curl->response;
	}
	//客户端发起api请求
?>