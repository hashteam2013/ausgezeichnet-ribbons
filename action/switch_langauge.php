<?php
global $app;
$redirect_url = (isset($app['GET']['redirect']) && $app['GET']['redirect']!='')?make_url().'?'.getURLfromRedirectKey($app['GET']['redirect']):make_url();
if(isset($app['GET']['code'])){
    // Normalize the language code to lowercase for consistency
    $new_lang_code = strtolower(trim($app['GET']['code']));
    $current_lang_code = strtolower(trim($app['language']));
    
    if($current_lang_code != $new_lang_code){
        setcookie('lang',$new_lang_code,time()+31556926, "/");
    }
}
redirect($redirect_url);
exit;