<?php
//事件处理中心

class Handle{

	static public function doHandle($data)
	{
		$dataArr = json_decode($data,true);
		if(is_array($dataArr) && array_key_exists('event', $dataArr) && array_key_exists('data', $dataArr)){
			switch (strtolower($dataArr['event'])) {
				case 'email':
					Email::send($dataArr['data']);
					break;
				case 'curl':
					
				default:
					# code...
					break;
			}
		}
	}

}