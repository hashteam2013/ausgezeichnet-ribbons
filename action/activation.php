<?php
   global $app;
   $msg = '';
   $url1 = WS_PATH;
   $url = $app['GET'];
   $activation_key = $url['key'];
    $query = new query('users');
    $query->Field = "id,activation_key";
    $query->Where = "where activation_key = '" . $activation_key ."'";
   // $query->print=1;
    $record = $query->DisplayOne();
   //print_r($record);
    if(!empty($record)){
         $query = new query('users');
         $query->Data['is_verified'] = 1;
         $query->Data['id'] = $record->id;
        if ($query->Update()) {
            set_alert('success', "Your Registeration is verified");
            //redirect(make_url($url1,array(),true));
        }
    }
    else{
        $msg = 'Error occurred while verified account info. Please try again!';
    }
    set_alert('error', $msg);
    
?>
