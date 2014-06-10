<?php
error_reporting(E_ALL & ~E_NOTICE);

$host = isset($_POST["host"]) ? $_POST["host"] : "10.0.11.224";
$port = isset($_POST["port"]) ? $_POST["port"] : "11211";
$method = isset($_POST["method"]) ? $_POST["method"] : "read";
$key = isset($_POST["key"]) ? $_POST["key"] : "foo";
$value = isset($_POST["value"]) ? urldecode($_POST["value"]) : "bar";
$expireTime = isset($_POST["expireTime"]) ? $_POST["expireTime"] : 7200;
$mc = new Memcached();
$mc -> addServer($host, $port);

$result = new StdClass;
$result -> code = 200;

if($method == "read") {
	$result -> data = $mc -> get($key);
} else if($method == "changeExpireTime") {
    $val = $mc -> get($key);
	$mc -> set($key, $val, $expireTime);
} else if($method == "write") {
    if($key.indexOf("YC_Limit_YC_Limit") === 0) {
        $value = json_decode($value);
        $val = array(
            'times' => $value -> times,
            'first_time' => $value -> first_time,
            'last_time' => $value -> last_time
        );
        $mc -> set($key, $val, 7200);
    } else {
        $mc -> set($key, $value);
    }

} else if($method == "delete") {
	$mc -> delete($key);
} else if($method == "flush") {
	$mc -> flush();
}

echo json_encode($result);

$mc -> quit();