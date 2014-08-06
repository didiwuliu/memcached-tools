<?php
/**
 * @title index
 * @description
 * index
 * @email zhangchunsheng423@gmail.com
 * @version V1.0
 * @date 2014-08-06
 * @copyright  Copyright (c) 2010-2014 Luomor Inc. (http://www.luomor.com)
 */
$host = "211.151.49.168";
$port = 11211;

$mc = new Memcached();
$mc->addServer($host, $port);

$citys = yc_geo_get_city_list();
foreach($citys as $city) {
    $key = "YC_DEVICE_DRIVER_CAR_COUNT_11_" . $city["short"];
    $mc->delete($key);
}

$mc->quit();