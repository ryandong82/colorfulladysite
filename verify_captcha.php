<?php
session_start();
$pic_code = $_POST["pic_code"];
header('Content-type: application/json');
if (isset($pic_code)) {
    if (strtoupper($pic_code) == strtoupper($_SESSION["VerifyCode"])) {
        echo json_encode(array('result' => 'OK'));
    }
    else
        echo json_encode(array('result'=>'false', 'vcode'=>strtoupper($_SESSION["VerifyCode"])));

}