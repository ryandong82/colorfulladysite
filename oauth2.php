<?php
//001A1zGO0J7qJg28LLJO0TYBGO0A1zGh
$appid='wxb9c56b3350603e7c';
$secret='f73eff32abc430cbdc45c405a8be0ce6';
$code=$_GET['code'];
$url = "https://api.weixin.qq.com/sns/oauth2/access_token?appid=$appid&secret=$secret&code=$code&grant_type=authorization_code";
$curl = curl_init($url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$content = curl_exec($curl);
//echo $_G'code'];

$response = json_decode($content);
var_dump($response);
echo "-------------------\n";
$user_info_url = "https://api.weixin.qq.com/sns/userinfo?access_token=$response->access_token&openid=$response->openid&lang=zh_CN";
$curl = curl_init($user_info_url);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$content = curl_exec($curl);
$response = json_decode($content);
var_dump($response);

/**
 * Created by PhpStorm.
 * User: ryan
 * Date: 2016/6/7
 * Time: 22:32
 */