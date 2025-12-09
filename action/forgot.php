<?php
global $app;
$msg = '';
$status = '';
$url = $app['GET'];
//pr($url);
$activation_key = $url['key'];
$email = $url['email'];
$query = new query('users');
$query->Field = "id,activation_key,email,password";
$query->Where = "where activation_key = '" . $activation_key . "' and email = '" . $email . "' ";
$record = $query->DisplayOne();
if (!empty($record)) {
    if (isset($app['POST']['reset'])) {
        if(isset($app['POST']['new_pass'])&& $app['POST']['new_pass']!=""){
            if(isset($app['POST']['new_pass'])&& strlen($app['POST']['new_pass']) >'4'){
            if(isset($app['POST']['con_pass'])&& $app['POST']['con_pass']!=""){
                 if($app['POST']['new_pass']== $app['POST']['con_pass']){
                $query = new query('users');
                $query->Data['id']= $record->id;
                $query->Data['password'] = generateHash($app['POST']['new_pass']);
                if ($query->Update()) {
                    $status = "success";
                    $msg = "Your password has been updated successfully";
                }else{
                    $status = "error";
                    $msg = "Please try again!";
                }
            }else{
                $status = "error";
                $msg = "password and confirm password doesn't match!!";
            }
        }else{
             $status = "error";
            $msg = "confirm password is required!!";
        }
        }else{
            $status = "error";
            $msg = "password length must be greater than 4!!";
        }
        }else{
            $status = "error";
            $msg = "password is required!!";
        }
    }
} else {
    $msg = "false";
    $status = "error";
}
?>