<?php
	include "./vendor/autoload.php";

	//请求的api地址
	$url="http://localhost/api/server/server.php";

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