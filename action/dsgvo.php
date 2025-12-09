<?php 
add_css(DIR_WS_ASSETS_CSS . 'account.css');
add_css(DIR_WS_ASSETS_CSS . 'component.css');
add_js(DIR_WS_ASSETS_JS . 'dsgvo.js');
if (!LOGGED_IN_USER) {
    redirect(make_url());
}

global $app;
$action = "";
if (isset($app['GET']["action"]) && !empty($app['GET']["action"])) {
    $action = isset($app['GET']["action"]) ? $app['GET']["action"] : "0";
}

$output = array();
switch ($action):
    case 'update_terms_conditions':
        $agreedsgvo = isset($app['POST']['accepted_dsgvo'])?$app['POST']['accepted_dsgvo']:'0';
        $agreedeMail = '1';
        $agreedPhone = isset($app['POST']['accepted_phone'])?$app['POST']['accepted_phone']:'0';

         $query = new query("users");
        $query->Data['id'] = $app['user_info']->id;
        $query->Data['accepted_dsgvo1'] =$agreedsgvo;
        $query->Data['accepted_eMail'] =$agreedeMail;
        $query->Data['accepted_phone'] = $agreedPhone;

        if ($query->Update()) {
            $output['status'] = "success";
           $output['msg'] = _e("Informationen erfolgreich geaendert.",true);

           $to = "datenschutz@ausgezeichnet.cc";
           $subject = "Ausgezeichnet.cc - " . $logged_in_user_info->first_name ." " .  $logged_in_user_info->last_name . " hat Datenschutzeinstellungen geaendert";
           $txt =  $logged_in_user_info->first_name ." " .  $logged_in_user_info->last_name .  " hat seine Datenschutzvereinbarungen folgendermassen geandert:		\r\n";
           $txt .=  "\r\nAkzeptiert DSGVO:" . $agreedsgvo . "		";
           $txt .=  "\r\nAkzeptiert unverschluesselte eMail:" . $agreedeMail . "		";
           $txt .=  "\r\nAkzeptiert Telefon:" . $agreedPhone;

           SendEmail($subject, $to, FROM_EMAIL, 'Ausgezeichnet.cc', $txt );

        } else{
             $output['msg'] = _e("An error occurred while updating information in the database",true);
        }
     echo json_encode($output);


        die();


        break;


    default:
    break;
endswitch;


      $id = $logged_in_user_info->id;
      $query = new query("users");
        $query->Field = " accepted_dsgvo1, accepted_eMail, accepted_phone";
        $query->Where = " where id =" . $id ;
        $dsgvo = $query->DisplayOne();


?>