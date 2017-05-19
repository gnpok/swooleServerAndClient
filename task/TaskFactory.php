<?php
namespace task;
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
			    $taskclass = 'task\\'.$event;
				$taskclass::doTask($data);
			}else{
			    echo '异步处理类不存在';
            }

		}
	}
	
}