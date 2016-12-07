<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/**
* 异步任务分发中心
*/
class TaskFactory
{

	/**
	 *创建异步任务
	 */
	public static function createTask($data){

		if(is_array($data) && isset($data['event'])){
			$event = strtolower(trim($data['event']));
			$event = ucfirst($event);
			$taskPath = dirname(__FILE__).'/task/'.$event.'.php';
			if(is_file($taskPath)){
				require_once $taskPath;
				$event::doTask($data);
			}

		}
	}
	
}