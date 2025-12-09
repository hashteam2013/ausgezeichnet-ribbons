<?php
global $app;
$redirect_url = (isset($app['GET']['redirect']) && $app['GET']['redirect']!='')?make_url().'?'.getURLfromRedirectKey($app['GET']['redirect']):make_url();
if(isset($app['GET']['code'])){
    echo $app['GET']['code'];
    if($app['language'] != $app['GET']['code']){
        setcookie('lang',$app['GET']['code'],time()+31556926, "/");
    }
}
redirect($redirect_url);
exit;