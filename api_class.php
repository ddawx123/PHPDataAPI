<?php

class Response {
	
	/**
	* 使用json方式输出通信数据
	* @param integer $code 状态码
	* @param string $message 提示信息
	* @param array $data 数据
	* return string
	*/
	public static function jsonEncode($code, $message = '', $data = array()) {
		if(!is_numeric($code)) {
			return '';
		}
		
		$result = array(
			'code' => $code,
			'message' => $message,
			'data' => $data,
			'requestID' => date("Ymd".time())
		);
		
		header("Content-Type: application/json; charset=UTF-8");
		echo json_encode($result);
		exit;
	}
	
	/**
	* 使用xml方式输出通信数据
	* @param integer $code 状态码
	* @param string $message 提示信息
	* @param array $data 数据
	* return string
	*/
	public static function xmlEncode($code, $message = '', $data = array()) {
		if(!is_numeric($code)) {
			return '';
		}
		
		$result = array(
			'code' => $code,
			'message' => $message,
			'data' => $data
		);
		$requestId = date("Ymd".time());
		header("Content-Type: text/xml; charset=UTF-8");
		$xml = "<?xml version='1.0' encoding='UTF-8'?>";
		$xml .= "<root>";
		
		$xml .= self::xmlToEncode($result);
		$xml .= "<requestId>{$requestId}</requestId>\n";
		$xml .= "</root>";
		
		echo $xml;
		exit;
	}
	
	/**
	* xml数据内容封装
	* @param array $data 数据
	* return string
	*/
	public static function xmlToEncode($data) {
		$xml = $attr = "";
		foreach($data as $key => $value) {
			if(is_numeric($key)) {
				$attr = " id='{$key}'";
				$key = "item";
			}
			$xml .= "<{$key}{$attr}>";
			$xml .= is_array($value) ? self::xmlToEncode($value) : $value;
			$xml .= "</{$key}>\n";
		}
		return $xml;
		exit;
	}
	
	public static function errorHandler() {
		$requestId = date("Ymd".time());
		header("Content-Type: text/xml; charset=UTF-8");
		$xml = "<?xml version='1.0' encoding='UTF-8'?>\n";
		$xml .= "<root>\n";
		$xml .= "<code>405</code>\n";
		$xml .= "<message>Method not allow.</message>\n";
		$xml .= "<requestId>{$requestId}</requestId>\n";
		$xml .= "</root>\n";
		echo $xml;
		exit;
	}

}
