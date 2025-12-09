<?php

if (isset($app['POST']['submit'])) {
    $result = user_login($app['POST']['email'], $app['POST']['password']);
    //pr($result);
}
