<?php
global $app;
$id = $logged_in_user_info->id;
add_css(DIR_WS_ASSETS_CSS . 'account.css');
add_css(DIR_WS_ASSETS_CSS . 'component.css');
add_js(DIR_WS_ASSETS_JS . 'component.js');
if (!LOGGED_IN_USER) {
    redirect(make_url());
}
//
//echo $app['user_info']->district.'<br/>';
//echo $app['user_info']->subdistrict.'<br/>';
//echo $app['user_info']->community;
//exit();

/*get only user's subdistrict*/
$query = new query('sub_districts');
$query->Field = "id,name_" . $app['language'] . " as name_en";
$query->Where = " where id =".$app['user_info']->subdistrict;
$user_subdist = $query->DisplayOne();
//pr($user_subdist);


/*get only user's community*/
$query = new query('communities');
$query->Field = "id,name_" . $app['language'] . " as name_en";
$query->Where = " where id =".$app['user_info']->community;
$user_comm = $query->DisplayOne();
//pr($user_comm);

$query = new query('departments_new');
$query->Field = "id,name_" . $app['language'] . " as name_en";
$query->Where = " where is_active = 1 and is_selected = 1";
$get_department = $query->ListOfAllRecords();


$query = new query('districts');
$query->Field = "id, full_name, name_" . $app['language'] . " as name_en";
$query->Where = " where is_active = 1";
$get_district = $query->ListOfAllRecords();

/*get all community according to user's subdistrict*/
$query = new query('communities');
$query->Field = "id,name_" . $app['language'] . " as name_en";
$query->Where = " where is_active = 1 and subdist_id =" .$app['user_info']->subdistrict;
$get_community = $query->ListOfAllRecords();
//echo "<pre>";print_r($get_community);

/*get all community according to user's district*/
$query = new query('sub_districts');
$query->Field = "id,name_" . $app['language'] . " as name_en";
$query->Where = " where is_active = 1 and district_id =" .$app['user_info']->district;
$get_subdist = $query->ListOfAllRecords();
//echo "<pre>";print_r($get_subdist);

/*get all borough according to user's comm*/
$query = new query('boroughs');
$query->Field = "id,name_" . $app['language'] . " as name_en";
$query->Where = " where is_active = 1 and dist_id =" .$app['user_info']->district. " and subdist_id =" .$app['user_info']->subdistrict. " and comm_id =" .$app['user_info']->community;
$get_boro = $query->ListOfAllRecords();
//echo "<pre>";print_r($get_subdist);

$msg ='';
$msgWearAll='Test';

if (isset($app['POST']['update'])) {
    //pr($app['POST']);
    $msg = '';
    if (trim($app['POST']['firstname']) == '') {
        $msg = 'Bitte Vornamen eingeben ';
    } elseif (trim($app['POST']['lastname']) == '') {
        $msg = 'Bitte Nachnamen eingeben';
    } else if (is_zipcode_valid(trim($app['POST']['zip']))==false) {
        $msg = "Ungueltige Postleitzahl!";

    } elseif (trim($app['POST']['zip']) == '') {
        $msg = 'Bitte Postleitzahl eingeben';
    } elseif (trim($app['POST']['org']) == '') {
        $msg = 'Bitte Organisation eingeben';
    } elseif (trim($app['POST']['org']) == trim($app['POST']['org2'])) {
        $msg = 'Hauptorganisation kann nicht gleich Zweitorganisation sein!';
    } elseif (trim($app['POST']['district']) == '') {
        $msg = 'Bitte Bezirk eingeben';
    } 
//    elseif (trim($app['POST']['community']) == '') {
//        $msg = 'Please enter community';
//    } elseif (trim($app['POST']['subdist']) == '') {
//        $msg = 'Please enter subdistrict';
//    } 
    else {

        $query = new query('users');
        $query->Data['id'] = $id;
        $query->Data['company'] = isset($app['POST']['company'])?$app['POST']['company']:'';
        $query->Data['first_name'] = ucwords($app['POST']['firstname']);
        $query->Data['last_name'] = ucwords($app['POST']['lastname']);
        $query->Data['phone'] = isset($app['POST']['fone'])?$app['POST']['fone']:'';
        $query->Data['email'] = isset($app['POST']['mail'])?$app['POST']['mail']:'';
        $query->Data['address1'] = isset($app['POST']['address1'])?$app['POST']['address1']:'';
        $query->Data['address2'] = isset($app['POST']['address2'])?$app['POST']['address2']:'';
        $query->Data['is_address_status'] = 1;
        $query->Data['city'] = isset($app['POST']['city'])?$app['POST']['city']:'';
        $query->Data['state'] = isset($app['POST']['state'])?$app['POST']['state']:'';
        $query->Data['country'] = isset($app['POST']['country'])?$app['POST']['country']:'';
        $query->Data['zipcode'] = isset($app['POST']['zip'])?$app['POST']['zip']:'';
        $query->Data['department_new'] = isset($app['POST']['org'])?$app['POST']['org']:"";
        $query->Data['department_new2'] = isset($app['POST']['org2'])?$app['POST']['org2']:"";
        $query->Data['district'] = isset($app['POST']['district'])?$app['POST']['district']:'';
        $query->Data['community'] = isset($app['POST']['community'])?$app['POST']['community']:'';
        $query->Data['borough'] = isset($app['POST']['name_boro'])?$app['POST']['name_boro']:'';
        $query->Data['subdistrict'] = isset($app['POST']['subdist'])?$app['POST']['subdist']:'';
        $query->Data['forcewearall']=isset($app['POST']['forcewearall'])?$app['POST']['forcewearall']:'';

        //$query->print=1;
        if ($query->Update()) {
            set_alert('success', "Account info updated successfully");
            redirect(make_url('profile'));
        } else {
            $msg = 'Error occurred while updating account info. Please try again!';
        }

    }
    set_alert('error', $msg);
}



        $query_pre = new query("users as usr");
        $query_pre->Field = "usr.id as userid,usr.department_new, usr.department_new2,depart.max_ribbon as depart_max,depart.is_allowed as depart_class,usr.district,dist.max_ribbon as dist_max,dist.is_allowed as dist_class";
        $query_pre->Where .= " LEFT JOIN departments_new as depart ON depart.id = usr.department_new";
        $query_pre->Where .= " LEFT JOIN districts as dist ON dist.id = usr.district";
        $query_pre->Where .= " where usr.id = '" . $id . "'";
        //$query_pre->print=1;
        $presort = $query_pre->DisplayOne();
    

	$msgWearAll='';
        if ($presort->depart_class == '1' || $presort->dist_class == '1') 
	{
		$msgWearAll='<h5>Ihrer Auswahl zufolge sollten Sie lt. Tragevorschrift nur die jeweils h&ouml;chste Stufe einer Auszeichnung tragen. Dadurch werden Ihnen m&ouml;glicherweise nicht alle Auszeichnungen in Ihrer Spangenansicht angezeigt.</h5>';
	}

?>
