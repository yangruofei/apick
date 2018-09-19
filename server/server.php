<?php
	//接收请求响应数据 json
	$pdo=new PDO("mysql:host=localhost;dbname=api;charset=utf8","root","413466");
	$stmt=$pdo->query("select * from user");
	$data=$stmt->fetchAll(PDO::FETCH_ASSOC);

	//第一标准化产出数据格式函数
	function resp($data,$status,$message){
		$res=[
			"status"=>$status,//服务器响应状态码  20
			"message"=>$message,//此次api请求的描述
			"data"=>$data
		];
		echo json_encode($res,JSON_UNESCAPED_UNICODE);
	}
	
	resp($data,200,"ok");
	
?>