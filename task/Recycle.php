<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once dirname(__FILE__) . '/TaskInterface.php';

/**
 * 提交到回收平台
 */
class Recycle implements TaskInterface
{

    public static function doTask($data = array())
    {
        echo file_get_contents('http://www.baidu.com');
        return false;
        //1.校验接收的data
        if (empty($data) || !is_array($data)) {
            echo '参数错误--1';
            return false;
        }

        $arrayKeys = array('cardType', 'cardno', 'cardpwd', 'amount', 'orderid');
        foreach ($arrayKeys as $v) {
            if (!array_key_exists($v, $data)) {
                echo '缺少参数--2';
                return false;
            }
        }

        $cardType = $data['cardType'];//卡类型
        $cardno = trim($data['cardno']);//卡号
        $cardpwd = trim($data['cardpwd']);//卡密
        $price = trim($data['amount']); //充值金额
        $restrict = 0; //卡能使用的地理范围。(默认为 0)
        $orderid = trim($data['orderid']);

        if (empty($orderid)) {
            $yCode = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J');
            $orderSn = $yCode[intval(date('Y')) - 2011] . strtoupper(dechex(date('m'))) . date('d') . substr(time(), -5) . substr(microtime(), 2, 5) . sprintf('%02d', rand(0, 99));
            $orderid = $orderSn;    //生成商户订单号,商户可自行定义
        }

        //2.获取商户信息
        $allConfig = require_once BASEPATH . '/Config.php';
        $config = $allConfig['i3ka'];
        $parter = $config['parterId'];//商户ID
        $userkey = $config['userKey'];//商户密钥
        $callbackurl = $config['callBackUrl'];//支付结果回调地址
        $sendUrl = $config['sendUrl'];//提交地址

        //3.校验提交到回收平台参数
        if ($parter == "" || $cardno == "" || $cardpwd == "" || $price == "" || $callbackurl == "" || $userkey == "" || $orderid == "") {
            echo '参数错误--3';
            return false;
        }

        //4.参数进行签名
        $sign = md5("parter=" . $parter . "&cardtype=" . $cardType . "&cardno=" . $cardno . "&cardpwd=" . $cardpwd . "&orderid=" . $orderid . "&callbackurl=" . $callbackurl . "&restrict=" . $restrict . "&price=" . $price . $userkey);
        $sendXyUrl = $sendUrl . "?parter=" . $parter . "&cardtype=" . $cardType . "&cardno=" . $cardno . "&cardpwd=" . $cardpwd . "&orderid=" . $orderid . "&callbackurl=" . $callbackurl . "&restrict=" . $restrict . "&price=" . $price . "&sign=" . $sign;


        //++++++++++++++++++++++++++++
        //商户写入自己平台的逻辑
        //++++++++++++++++++++++++++++

        //提交到服务器并获取返回信息
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $sendXyUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // 当设置为0时$ch没有返回值，直接输出请求的内容
        curl_setopt($ch, CURLOPT_HEADER, 0); //如果你想把一个头包含在输出中，设置这个选项为一个非零值
        curl_setopt($ch, CURLOPT_TIMEOUT, 10); //设置10秒超时
        $resultStr = curl_exec($ch);
        $errorno = curl_errno($ch);
        curl_close($ch);
    }
}
