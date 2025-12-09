<?php
global $app;
$id = isset($app['GET']['id'])?$app['GET']['id']:"0";
$page_no = (isset($app['GET']['page_no']) && $app['GET']['page_no'] != "")? $app['GET']['page_no'] : 1;
$limit = PAGE_CONTENT_LIMIT;

 $query3 = new query('order_items');
 $query3->Field = "product_id, sum(order_items.quantity) as numberofitems, ribbon_name_dr";
 $query3->Where = "INNER JOIN batches ON product_id = batches.id WHERE customer_id IN( SELECT `customer_id` FROM `customers` WHERE `user_id` IN (SELECT `user_id` FROM `users`  WHERE `email` NOT IN('monika@gmail.com','silenoz@gmx.at','hashmonika@gmail.com','fghdfgh@gmail.com','joek@battrx.com','rrrrr@gmail.com','parasmaluja94@gmail.com','parasmaluja99@gmail.com','a@gmail.com','hfgh@gmail.com','x@gmail.com','l@gmail.com','jlll@battrx.com','joek2@battrx.com','paras1@gmail.com','parasmaluja94@gmail.comdf','joe@battrx.com','jp@battrx.com','joeky@battrx.com','joey@battrx.com','joekyy@battrx.com','joekyyy@battrx.com','jo@battrx.com','jo1@battrx.com','jo2@battrx.com','ffgg@hotmail.com','fg@def.gfh','hashkapilkalra@gmail.com','florian.hell@gmx.at','florian.hell@ausgezeichnet.cc','hashgaurav@gmail.com','office@zblh.at'))) GROUP BY (`product_id`)";

        
$validorderitems = $query3->ListOfAllRecords('object');




?>
