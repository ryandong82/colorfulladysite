<?php
include "../ali-api/TopSdk.php";
date_default_timezone_set('Asia/Shanghai');

/**
 * Created by PhpStorm.
 * User: dong_rui
 * Date: 2016-01-29
 * Time: 14:56
 */
$ran_num = rand(1000, 9999);
$_SESSION["VERIFY_CODE"] = $ran_num;
$_SESSION["VERIFY_EXPIRE"] = strtotime("+1 minutes");
$c = new TopClient;
$c->appkey = '23305908';
$c->secretKey = '9655a0b98c6f8f3bfaf9a40cad1b5696';
$req = new AlibabaAliqinFcSmsNumSendRequest;
$req->setExtend("123456");
$req->setSmsType("normal");
$req->setSmsFreeSignName("百变女人");
$req->setSmsParam("{\"code\":\"$ran_num\", \"product\":\"百变女人\"}");
$req->setRecNum($_POST["phone_number"]);
$req->setSmsTemplateCode("SMS_5000839");
$resp = $c->execute($req);
var_dump($resp);