<?php
defined('BASE_PATH') OR exit('No direct script access allowed');
/**
* 异步任务分发中心
*/
class TaskFactory
{

	/**
	 * 异步任务调度中心
	 * @param  arrary $data 异步任务传输数据，里面必须带event字段
	 * @return [type]       [description]
	 */
	public static function dispatch($data){

		if(is_array($data) && isset($data['event'])){
			$event = strtolower(trim($data['event']));
			$event = ucfirst($event);
			$taskPath = TASK_PATH.$event.'.php';
			if(is_file($taskPath)){
				require_once $taskPath;
				$event::doTask($data);
			}

		}
	}
	
}