<?php

// Enable error display for debugging (remove in production)
if (ENVIRONMENT == 'sandbox') {
    error_reporting(E_ALL);
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
}

// Capture errors and warnings for debugging
$ajax_errors = array();
set_error_handler(function($errno, $errstr, $errfile, $errline) use (&$ajax_errors) {
    $ajax_errors[] = array(
        'type' => $errno,
        'message' => $errstr,
        'file' => basename($errfile),
        'line' => $errline
    );
    return false; // Let PHP handle the error normally too
});

header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
global $app;
$action = isset($app['GET']["action"]) && !empty($app['GET']["action"]) ? $app['GET']["action"] : "0";
switch ($action):
    case 'login':
        $output = array();
        $useremail = isset($app['POST']['email']) ? $app['POST']['email'] : "";
        $password = isset($app['POST']['password']) ? $app['POST']['password'] : "";
        if ($useremail == "") {
            //message here
            $output['status'] = "error";
            $output['msg'] = _e('Username is required!!', true);
        } elseif ($password == "") {
            //message here
            $output['status'] = "error";
            $output['msg'] = _e("Password is required!!", true);
        } else {
            $query = new query("users");
            $query->Field = "id,email,password,is_active,is_verified,first_name, zipcode";
            $query->Where = " where email = '" . $useremail . "' and password ='" . generateHash($password) . "'";
            //$query->print=1;
            $user_info = $query->DisplayOne('object');
            //pr($login_form);
            if (!empty($user_info)) {
                if ($user_info->is_active == '1' && $user_info->is_verified == '1') {
                    set_user_login($user_info->id);
                    $query1 = new query('customers');
                    $query1->Field = " id,user_id,first_name,last_name";
                    $query1->Where = "where user_id = " . $user_info->id . " ORDER BY last_name";
                    $customers = $query1->ListOfAllRecords();
                    $customer_batches = array();
                    $ribbon_type = array();
                    if (!empty($customers)) {
                        $obj = new query('customer_batches as cust_batch');
                        $obj->Field = "cust_batch.id,cust_batch.batch_id,batch.ribbon_name_" . $app['language'] . " as ribbon_name_en,cust_batch.type,cust_batch.number,cust_batch.country,cust_batch.year,batch.batch_image";
                        $obj->Where = " LEFT JOIN batches as batch ON batch.id = cust_batch.batch_id";
                        $obj->Where .= " where cust_batch.customer_id =" . $customers[0]['id'];
                        $customer_batches = $obj->ListOfAllRecords();
                        if (!empty($customer_batches)) {
                            foreach ($customer_batches as $key => $type) {
                                $customer_batches[$key]['ribbon_type'] = show_ribbon_images($type['type'], $type['batch_image'], $type['number'], $type['country'], $type['year']);
                            }
                        }
                    }
                    $output['login_form'] = $user_info;
                    $output['first_name'] = $user_info->first_name;
                    $output['customers'] = $customers;
                    $output['customer_batches'] = $customer_batches;
                    //$output['ribbon_type'] = $ribbon_type;
                    $output['msg'] = "";
                    $output['status'] = "Sucessfully";
                    if ($user_info->zipcode == '') {
                        $output['status'] = "Sucessfully_InfoMissing";
                    }
                    //pr($output);
                } else {
                    $output['status'] = "error";
                    $output['msg'] = _e("your account has deactivated or not verified, Please try after some time!!", true);
                }
            } else {
                $output['status'] = "error";
                $output['msg'] = _e("Username or Password is incorrect", true);
            }
        }
        
        // Add errors to output if any occurred (for debugging)
        if (!empty($ajax_errors)) {
            $output['php_errors'] = $ajax_errors;
            $output['debug'] = true;
        }
        
        echo json_encode($output, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        break;

    case 'forgot':
        $email = isset($app['POST']['email']) ? $app['POST']['email'] : "";
        if ($email == "") {
            $output['status'] = "error";
            $output['msg'] = _e("email is required!!", true);
        } else {
            $query = new query('users');
            $query->Field = "id,email,password,activation_key,first_name, last_name,accepted_eMail";
            $query->Where = " where email = '" . $email . "'";
            $record = $query->DisplayOne();
            if (!empty($record)) {
                if ($record->accepted_eMail == '1') {
                    $to = $email;
                    $subject = "Ausgezeichnet.cc - Passwort vergessen";
                    $txt = 'Sehr geehrte/r '.  $record->first_name .' ' .  $record->last_name .  '. Um Ihr Passwort zu aendern,  <a href="' . make_url('forgot', array('key' => $record->activation_key, 'email' => $record->email)) . '">klicken Sie bitte hier</a> ';
                    if (SendEmail($subject, $to, FROM_EMAIL, 'Ausgezeichnet.cc', $txt)) {
                        $output['status'] = "Sucessfully";
                        $output['msg'] = _e("Change password email has been sent successfully!", true);
                    } else {
                        $output['status'] = "error";
                        $output['msg'] = _e("Something wrong while updating password, Try Again!!", true);
                    }
                } else {
                    $to = "office@ausgezeichnet.cc";
                    $subject = "Ausgezeichnet.cc - Kunde hat Passwort vergessen";
                    $txt = $record->first_name .' ' .  $record->last_name .  ' hat sein Passwort vergessen und akzeptiert nur verschluesselte eMails.';

                    if (SendEmail($subject, $to, FROM_EMAIL, 'Ausgezeichnet.cc', $txt)) {
                        $output['status'] = "Sucessfully";
                        $output['msg'] = _e("Da Sie unverschluesselten eMails widersprochen haben, wird unser Systemadministrator versuchen, Sie andernweitig zu erreichen.", true);
                    } else {
                        $output['status'] = "error";
                        $output['msg'] = _e("Vorgang war leider nicht erfolgreich. Bitte wenden Sie sich an den Systemadministrator", true);
                    }
                }

            } else {
                $output['status'] = "error";
                $output['msg'] = _e("Vorgang war leider nicht erfolgreich. Bitte wenden Sie sich an den Systemadministrator", true);
            }
        }
        echo json_encode($output);
        break;

    case 'getSubistrict':
        global $app;
        $dist_id = (isset($app['POST']['q']) && $app['POST']['q'] != '') ? $app['POST']['q'] : 0;
        $query = new query("sub_districts");
        $query->Field = "id,name_en";
        $query->Where = "where is_active = 1 and district_id = '" . $dist_id . "'";
        $record = $query->ListOfAllRecords();
        if (!empty($record)) {
            $output['status'] = "true";
            $output['record'] = $record;
        } else {
            $output['status'] = 'false';
        }
        echo json_encode($output);
        break;

    case 'getCommunity':
        global $app;
        $dist_id = (isset($app['POST']['d_id']) && $app['POST']['d_id'] != '') ? $app['POST']['d_id'] : 0;
        $subdist_id = (isset($app['POST']['s_id']) && $app['POST']['s_id'] != '') ? $app['POST']['s_id'] : 0;
        $query = new query("communities as comm");
        $query->Field = "comm.id,comm.name_" . $app['language'] . " as name_en,comm.is_active,comm.dist_id as dist_id,comm.subdist_id as subdist_id,"
                . "dis.name_" . $app['language'] . " as dist_name,sub.name_" . $app['language'] . " as subdist_name";
        $query->Where = " LEFT JOIN districts as dis ON dis.id = comm.dist_id";
        $query->Where .= " LEFT JOIN sub_districts as sub ON sub.id = comm.subdist_id";
        $query->Where .= " where comm.is_active = 1 and comm.dist_id = '" . $dist_id . "' and comm.subdist_id = '" . $subdist_id . "'";
        $record = $query->ListOfAllRecords();
        //pr($record);
        if (!empty($record)) {
            $output['status'] = "true";
            $output['record'] = $record;
        } else {
            $output['status'] = 'false';
        }
        echo json_encode($output);
        break;

    case 'getborough':
        global $app;
        $dist_id = (isset($app['POST']['d_id']) && $app['POST']['d_id'] != '') ? $app['POST']['d_id'] : 0;
        $subdist_id = (isset($app['POST']['s_id']) && $app['POST']['s_id'] != '') ? $app['POST']['s_id'] : 0;
        $comm_id = (isset($app['POST']['c_id']) && $app['POST']['c_id'] != '') ? $app['POST']['c_id'] : 0;
        $query = new query("boroughs as boro");
        $query->Field = "boro.id,boro.name_" . $app['language'] . " as name_en,boro.is_active,boro.dist_id as dist_id,boro.subdist_id as subdist_id,boro.comm_id as comm_id,"
                . "dis.name_" . $app['language'] . " as dist_name,sub.name_" . $app['language'] . " as subdist_name";
        $query->Where = " LEFT JOIN districts as dis ON dis.id = boro.dist_id";
        $query->Where .= " LEFT JOIN sub_districts as sub ON sub.id = boro.subdist_id";
        $query->Where .= " LEFT JOIN communities as com ON com.id = boro.comm_id";
        $query->Where .= " where boro.is_active = 1 and boro.dist_id = '" . $dist_id . "' and boro.subdist_id = '" . $subdist_id . "' and boro.comm_id = '" . $comm_id . "'";
        //$query->print=1;
        $record = $query->ListOfAllRecords();
        if (!empty($record)) {
            $output['status'] = "true";
            $output['record'] = $record;
        } else {
            $output['status'] = 'false';
        }
        echo json_encode($output);
        break;

    case 'register':
        $fname = isset($app['POST']['firstname']) ? $app['POST']['firstname'] : "";
        $lname = isset($app['POST']['lastname']) ? $app['POST']['lastname'] : "";
        $useremail = isset($app['POST']['email']) ? $app['POST']['email'] : "";
        $dist_id = isset($app['POST']['name_dist']) ? $app['POST']['name_dist'] : "";
        $subdist_id = isset($app['POST']['name_subdist']) ? $app['POST']['name_subdist'] : "";
        $comm_id = isset($app['POST']['name_comm']) ? $app['POST']['name_comm'] : "";
        $boro_id = isset($app['POST']['name_boro']) ? $app['POST']['name_boro'] : "";
        $password = isset($app['POST']['password']) ? $app['POST']['password'] : "";
        $cpassword = isset($app['POST']['cpassword']) ? $app['POST']['cpassword'] : "";
        $agreeAGB = isset($app['POST']['agreeAGB']) ? $app['POST']['agreeAGB'] : "0";
        $agreeDSGVO = isset($app['POST']['agreeDSGVO']) ? $app['POST']['agreeDSGVO'] : "0";
        $agreeeMail = '1';
        $agreePhone = isset($app['POST']['agreePhone']) ? $app['POST']['agreePhone'] : "0";

        $output = array();
        if ($fname == "") {
            //message here
            $output['status'] = "error";
            $output['msg'] = _e("Firstname is required!", true);
        } elseif ($lname == "") {
            //message here
            $output['status'] = "error";
            $output['msg'] = _e("Lastname is required!", true);
        } elseif ($useremail == "") {
            //message here
            $output['status'] = "error";
            $output['msg'] = _e("Username or email is required!", true);
        } elseif (!filter_var($useremail, FILTER_VALIDATE_EMAIL)) {
            $output['status'] = "error";
            $output['msg'] = _e("Please enter valid email!", true);
        } elseif ($password == "") {
            //message here
            $output['status'] = "error";
            $output['msg'] = _e("Password is required!", true);
        } elseif (strlen($password) <= '4') {
            $output['status'] = "error";
            $output['msg'] = _e("Password length must be five or more!", true);
        } elseif ($password != $cpassword) {
            //message here20:14 21.05.2018
            $output['status'] = "error";
            $output['msg'] = _e("Password or confirm password does not match!", true);
        } elseif ($dist_id == "") {
            //message here
            $output['status'] = "error";
            $output['msg'] = _e("Please choose district name!", true);
        } elseif ($agreeAGB !== '1') {
            //message here
            $output['status'] = "error";
            $output['msg'] = _e("Please agree terms and conditions!", true);
        } elseif ($agreeDSGVO !== '1') {
            //message here
            $output['status'] = "error";
            $output['msg'] = _e("Please agree dgsvo", true);
        } else {

            $query = new query('`users`');
            $query->Field = " username";
            $query->Where = " WHERE email = '" . $useremail . "'";
            $user_info = $query->DisplayOne();
            //    pr($user_info);
            if (empty($user_info)) {
                $key = create_random_key('10');
                $query = new query('users');
                $query->Data['first_name'] = ucwords($fname);
                $query->Data['last_name'] = ucwords($lname);
                $query->Data['username'] = strtolower($fname . $lname) . rand(10, 99);
                $query->Data['email'] = strtolower($useremail);
                $query->Data['district'] = $dist_id;
                $query->Data['subdistrict'] = $subdist_id;
                $query->Data['community'] = $comm_id;
                $query->Data['borough'] = $boro_id;
                $query->Data['password'] = generateHash($password);
                $query->Data['activation_key'] = $key;
                $query->Data['is_active'] = '1';
                $query->Data['is_verified'] = '0';
                $query->Data['date_add'] = '1';
                $query->Data['accepted_dsgvo1'] = $agreeDSGVO;
                $query->Data['accepted_eMail'] = '1';
                $query->Data['accepted_phone'] = $agreePhone;
                $reg_form = $query->DisplayOne('object');
                if ($query->Insert()) {
                    //die("hello");
                    $queryone = new query('customers');
                    $u_id = $query->GetMaxId();
                    $queryone->Data['user_id'] = $u_id;
                    $queryone->Data['first_name'] = ucwords($fname);
                    $queryone->Data['last_name'] = ucwords($lname);
                    $query->Data['date_add'] = '1';
                    $queryone->Data['is_active'] = '1';
                    $queryone->Insert();
                    $output['status'] = "Sucessfully";
                    $output['msg'] = _e("Your account was created successfully!", true);
                    $insrtcustId = $queryone->GetMaxId();
                    $query = new query('batch_filter_relation');
                    $query->Field = "batch_id";
                    $query->Where = " where rel_type = 'categories' and filter_id = '7'";
                    $connectors = $query->ListOfAllRecords();
                    if (!empty($connectors)) {
                        foreach ($connectors as $k => $v) {
                            if ($v['batch_id'] != 2122) {
                                $query = new query('customer_batches');
                                $query->Data['user_id'] = $u_id;
                                $query->Data['customer_id'] = $insrtcustId;
                                $query->Data['batch_id'] = $v['batch_id'];
                                $query->Data['date_add'] = 1;
                                //$query->print=1;
                                $query->insert();
                            }
                        }
                    }

                    if ($agreeeMail == '1') {
                        $to = $useremail;
                        $subject = "Ausgezeichnet.cc - Account Verifizierung";
                        $message = 'Sehr geehrte/r ' . ucwords($fname) . ' ' . ucwords($lname) . ', Sie haben sich erfolgreich bei Ausgezeichnet.cc registriert. Um Ihren Account zu verifizieren, benutzen Sie bitte folgenden link:<br><a href="' . make_url('activation', array('key' => $key)) . '">Account verifizieren</a>';
                        $move = SendEmail($subject, $to, FROM_EMAIL, 'Ausgezeichnet.cc', $message);

                        if ($move) {
                            $output['status'] = "Sucessfully";
                            $output['msg'] = _e("Ihr Account wurde erstellt, zur Verifizierung wurde Ihnen ein Link per eMail zugesandt.", true);
                        } else {
                            $output['status'] = "error";
                            $output['msg'] = _e("Fehler beim Versand des Aktivierungsemails!", true);
                        }

                    } else {
                        $output['status'] = "Sucessfully";
                        $output['msg'] = _e("Ihr Account wurde erstellt. Da wir Ihnen kein eMail aus dem System uebermitteln duerfen, werden wir versuchen, im bestmoeglichen Rahmen mit Ihnen in Kontakt zu treten.", true);

                    }




                    $to_admin = "office@ausgezeichnet.cc";
                    $subject_admin = "Ausgezeichnet.cc";
                    $txt_admin = $useremail . ' ' . 'registered on your account';
                    $headers_admin = "MIME-Version: 1.0" . "\r\n";
                    $headers_admin .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                    $headers_admin .= 'FROM:' . FROM_EMAIL . "\r\n" . 'Reply-To:' . REPLY_TO_EMAIL . "\r\n" . 'X-Mailer: PHP/' . phpversion();
                    //  $move = SendEmail($subject_admin, $to_admin, FROM_EMAIL, 'Ausgezeichnet.cc', $txt_admin);


                    $to_admin = "datenschutz@ausgezeichnet.cc";
                    $subject_admin = "Ausgezeichnet.cc";
                    $txt_admin = $useremail . ' hat sich mit folgenden Einstellungen registriert: ';
                    $txt_admin .=  "\r\nAkzeptiert AGB:" . $agreeAGB . "		";
                    $txt_admin .=  "\r\nAkzeptiert DSGVO:" . $agreeDSGVO . "		";
                    $txt_admin .=  "\r\nAkzeptiert unverschluesselte eMail:" . $agreeeMail . "		";
                    $txt_admin .=  "\r\nAkzeptiert Telefon:" . $agreePhone;

                    // $move = SendEmail($subject_admin, $to_admin, FROM_EMAIL, 'Ausgezeichnet.cc', $txt_admin);



                } else {
                    $output['status'] = "error";
                    $output['msg'] = _e("Your account is not created, Try Again !!!", true);
                }
            } else {
                $output['status'] = "error";
                $output['msg'] = _e("A user with this email already exists.", true);
            }
        }
        echo json_encode($output);
        break;

    case 'cat_list':
        if (isset($app['POST']['ids']) && $app['POST']['ids'] != '') {
            $selected_id = $app['POST']['ids'];
            $selected_cat = array();
            if (isset($app['POST']['district_related']) && $app['POST']['district_related'] == '1') {
                $district_ids = array();
                if (isset($app['POST']['district_ids'])) {
                    $district_ids = $app['POST']['district_ids'];
                }
                $selected_cat[] = getDistrictRelatedCategoryBatches($app['POST']['ids'][0], $district_ids);
            } else {
                foreach ($selected_id as $k => $v) {
                    $query_one = new query('batch_filter_relation as relation');
                    $query_one->Field = "relation.filter_id,relation.batch_id,batch.id,batch.is_active, batch.unit_price as unit_price,batch.webshop_title_" . $app['language'] . " as webshop_title_en,batch.batch_position,o.position,batch.ribbon_name_" . $app['language'] . " as name_en,batch.batch_image,batch.desc_" . $app['language'] . " as desc_en, cat.name_" . $app['language'] . " as cat ,batch.type,bfr.filter_id as org_id,o.name_" . $app['language'] . " as org_name, batch.comment as comment, comm.position as comm_pos, batch.ItemType as ItemType";
                    $query_one->Where = " LEFT JOIN batches as batch ON batch.id = relation.batch_id";
                    $query_one->Where .= " LEFT JOIN categories as cat ON cat.id = relation.filter_id";
                    $query_one->Where .= " LEFT JOIN batch_filter_relation as bfr ON bfr.batch_id = relation.batch_id and bfr.rel_type = 'organizations'";
                    $query_one->Where .= " LEFT JOIN batch_filter_relation as bfr2 ON bfr2.batch_id = relation.batch_id and bfr2.rel_type = 'communities'";
                    $query_one->Where .= " LEFT JOIN organizations as o ON bfr.filter_id = o.id";
                    $query_one->Where .= " LEFT JOIN communities as comm ON bfr2.filter_id = comm.id";
                    $query_one->Where .= " where relation.filter_id = $v and relation.rel_type = 'categories' order by o.position, comm_pos,  batch_position";
                    $selected_cat[] = $query_one->ListOfAllRecords('object');
                }
            }
            echo json_encode($selected_cat);
        }
        break;

    case 'add_cat_list':
        if (isset($app['POST']['ids']) && $app['POST']['ids'] != '') {
            $selected_id = $app['POST']['ids'];
            $selected_add_cat = array();

            foreach ($selected_id as $k => $v) {


                $query_one = new query('batch_filter_relation as relation');
                $query_one->Field = "relation.filter_id,relation.batch_id,batch.id,batch.is_active, batch.unit_price as unit_price,batch.webshop_title_" . $app['language'] . " as webshop_title_en,batch.batch_position,o.position,batch.ribbon_name_" . $app['language'] . " as name_en,batch.batch_image,batch.desc_" . $app['language'] . " as desc_en, add_cat.name_" . $app['language'] . " as add_cat ,batch.type,bfr.filter_id as add_cat_sub_id,o.name_" . $app['language'] . " as add_cat_sub_name, batch.comment as comment,  batch.ItemType as ItemType";
                $query_one->Where = " LEFT JOIN batches as batch ON batch.id = relation.batch_id";
                $query_one->Where .= " LEFT JOIN additional_categories as add_cat ON add_cat.id = relation.filter_id";
                $query_one->Where .= " LEFT JOIN batch_filter_relation as bfr ON bfr.batch_id = relation.batch_id and bfr.rel_type = 'add_cat_sub'";
                $query_one->Where .= " LEFT JOIN add_cat_sub as o ON bfr.filter_id = o.id";
                $query_one->Where .= " where relation.filter_id = $v and relation.rel_type = 'additional_categories' order by o.position, batch.batch_position";
                $selected_add_cat[] = $query_one->ListOfAllRecords('object');

            }
            echo json_encode($selected_add_cat);
        }


        break;

    case 'depart_list':
        if (isset($app['POST']['ids']) && $app['POST']['ids'] != '') {
            $selected_id = $app['POST']['ids'];
            $selected_depart = array();
            foreach ($selected_id as $k => $v) {
                $query_one = new query('batch_filter_relation as relation');
                $query_one->Field = "relation.filter_id,relation.batch_id,batch.id,batch.is_active,batch.batch_position, batch.unit_price as unit_price,batch.ribbon_name_" . $app['language'] . " as name_en,batch.webshop_title_" . $app['language'] . " as webshop_title_en,batch.batch_image,batch.desc_" . $app['language'] . " as desc_en,depart.name_" . $app['language'] . " as name_en,batch.type,  batch.comment as comment, batch.ItemType as ItemType";
                $query_one->Where = " LEFT JOIN batches as batch ON batch.id = relation.batch_id";
                $query_one->Where .= " LEFT JOIN departments as depart ON depart.id = relation.filter_id";
                $query_one->Where .= " where filter_id = $v and rel_type = 'departments' order by batch_position";
                //$query_one->print=1;
                $selected_depart[] = $query_one->ListOfAllRecords('object');
            }
            echo json_encode($selected_depart);
        }
        break;

    case 'dist_list':
        $cat_id = isset($app['POST']['cat_id']) ? $app['POST']['cat_id'] : 0;
        $district_ids = isset($app['POST']['district_ids']) ? $app['POST']['district_ids'] : array();
        $selected_dist = array();
        $selected_dist[] = getDistrictRelatedCategoryBatches($cat_id, $district_ids);
        echo json_encode($selected_dist);
        break;

    case 'cust_detail':
        $cust_id = isset($app['POST']['id']) ? $app['POST']['id'] : 0;
        if (!empty($cust_id)) {
            $query = new query('customers');
            $query->Field = " first_name,last_name, ShownName, user_id";
            $query->Where = " where id = $cust_id";
            $cust_detail = $query->DisplayOne();
            if ($cust_detail->ShownName == '') {
                $query = new query('users');
                $query->Field = " district, department_new ";
                $query->Where = " where id = $cust_detail->user_id";
                $cust_district = $query->DisplayOne();

                if ($cust_district->department_new == 1) {
                    if ($cust_district->district == 4 || $cust_district->district == 11) {
                        $cust_detail->ShownName = strtoupper($cust_detail->last_name . " " . substr($cust_detail->first_name, 0, 1) . ".");
                    } elseif ($cust_district->district == 19) {
                        $cust_detail->ShownName = strtoupper(substr($cust_detail->first_name, 0, 1) . ". " . $cust_detail->last_name);
                    } else {
                        $cust_detail->ShownName = strtoupper($cust_detail->last_name);
                    }
                } else {
                    $cust_detail->ShownName = strtoupper($cust_detail->last_name);
                }
            }

        }

        echo json_encode($cust_detail);
        break;

    case 'cust_detail_reduced':
        $cust_id = isset($app['POST']['id']) ? $app['POST']['id'] : 0;
        if (!empty($cust_id)) {
            $query = new query('customers');
            $query->Field = " first_name,last_name";
            $query->Where = " where id = $cust_id";
            $cust_detail = $query->DisplayOne();

        }

        echo json_encode($cust_detail);
        break;

    case 'rename_cust':
        $output = array();
        $cust_id = isset($app['POST']['id']) ? $app['POST']['id'] : 0;
        $cust_fname = isset($app['POST']['fname']) ? $app['POST']['fname'] : 0;
        $cust_lname = isset($app['POST']['lname']) ? $app['POST']['lname'] : 0;
        if (!empty($cust_id) && !empty($cust_fname) && !empty($cust_lname)) {
            $query = new query('customers');
            $query->Data['id'] = $cust_id;
            $query->Data['first_name'] = $cust_fname;
            $query->Data['last_name'] = $cust_lname;
            //$query->print=1;
            if ($query->Update()) {
                $output['msg'] = _e('Rename customer successfully', true);
                $output['status'] = 'Sucessfully';
            } else {
                $output['msg'] = _e('There is some error while renaming customer', true);
                $output['status'] = 'error';
            }
        } else {
            $output['msg'] = _e('Something went wrong!', true);
            $output['status'] = 'error';
        }
        echo json_encode($output);
        break;

    case 'rename_cust_ShownName':
        $output = array();
        $cust_id = isset($app['POST']['id']) ? $app['POST']['id'] : 0;

        $cust_ShownName = isset($app['POST']['ShownName']) ? $app['POST']['ShownName'] : 0;
        if (!empty($cust_id) && !empty($cust_ShownName)) {
            $query = new query('customers');
            $query->Data['id'] = $cust_id;
            $query->Data['ShownName'] = $cust_ShownName;
            //$query->print=1;
            if ($query->Update()) {
                $output['msg'] = _e('Rename customer successfully', true);
                $output['status'] = 'Sucessfully';
            } else {
                $output['msg'] = _e('There is some error while renaming customer', true);
                $output['status'] = 'error';
            }
        } else {
            $output['msg'] = _e('Something went wrong!', true);
            $output['status'] = 'error';
        }
        echo json_encode($output);
        break;

    case 'add_customer':
        $fname = isset($app['POST']['firstname']) ? $app['POST']['firstname'] : "";
        $lname = isset($app['POST']['lastname']) ? $app['POST']['lastname'] : "";

        $output = array();
        if ($fname == "") {
            //message here
            $output['status'] = "error";
            $output['msg'] = _e("firstname is required!!", true);
        } elseif ($lname == "") {
            //message here
            $output['status'] = "error";
            $output['msg'] = _e("lastname is required!!", true);
        } else {
            $query = new query("customers");
            $query->Field = "first_name,last_name, ShownName";
            $query->Where = " where first_name = '" . $app['POST']['firstname'] . "' and last_name='" . $app['POST']['lastname'] . "' and user_id = '" . $app['user_info']->id . "'";
            $cust_info = $query->DisplayOne();
            if (empty($cust_info)) {
                $query = new query('customers');
                $query->Data['first_name'] = ucwords($app['POST']['firstname']);
                $query->Data['last_name'] = ucwords($app['POST']['lastname']);

                $query->Data['user_id'] = $logged_in_user_info->id;
                $query->Data['date_add'] = '1';
                $query->Data['is_active'] = '1';
                if ($query->Insert()) {
                    $insrtcustId = $query->GetMaxId();
                    $query = new query('batch_filter_relation');
                    $query->Field = "batch_id";
                    $query->Where = " where rel_type = 'categories' and filter_id = '7'";
                    $connectors = $query->ListOfAllRecords();
                    if (!empty($connectors)) {
                        foreach ($connectors as $k => $v) {
                            if ($v['batch_id'] != 2122) {
                                $query = new query('customer_batches');
                                $query->Data['user_id'] = $logged_in_user_info->id;
                                $query->Data['customer_id'] = $insrtcustId;
                                $query->Data['batch_id'] = $v['batch_id'];
                                $query->Data['date_add'] = 1;
                                $query->insert();
                            }
                        }
                    }
                    $output['id'] = $insrtcustId;
                    $output['first_name'] = ucwords($app['POST']['firstname']);
                    $output['last_name'] = ucwords($app['POST']['lastname']);

                    $output['msg'] = _e('New customer added successfully', true);
                    $output['status'] = 'Sucessfully';
                } else {
                    $output['msg'] = _e('Error occurred while updating account info. Please try again!', true);
                    $output['status'] = 'error';
                }
            } else {
                $output['msg'] = _e('Same customer already added!', true);
                $output['status'] = 'error';
            }
        }echo json_encode($output);
        break;

    case 'add_list':
        if ($app['POST']['cust_id'] != '') {


            $query = new query("customers as customers");
            $query->Field = " ShownName ";
            $query->Where = " WHERE id = '" . $app['POST']['cust_id'] . "'";
            $currentCustomer = $query->DisplayOne();
            $name_addition = "";

            $object = new query('customer_batches');
            $object->Where = "Where user_id =" . $app['POST']['user_id'] . " and customer_id =" . $app['POST']['cust_id'] . " and batch_id=" . $app['POST']['batch_id'];
            // $object->print=1;
            $record = $object->ListOfAllRecords();
            if (empty($record) || $app['POST']['batch_id'] == '548' || $app['POST']['batch_id'] == '549' || $app['POST']['batch_id'] == '551' || $app['POST']['batch_id'] == '188') {
                $query = new query('customer_batches');
                $query->Data['user_id'] = $app['POST']['user_id'];
                $query->Data['customer_id'] = $app['POST']['cust_id'];
                $query->Data['batch_id'] = $app['POST']['batch_id'];
                $query->Data['type'] = isset($app['POST']['batchType']) ? $app['POST']['batchType'] : '0';
                $query->Data['date_add'] = '1';
                if ($query->Insert()) {
                    $show_batch = array();
                    $query = new query("customer_batches as cust_detail");
                    $query->Field = "batch.id,batch.batch_image,batch.type,batch.value,batch.ribbon_name_" . $app['language'] . " as batchname,cust_detail.id,cust_detail.type,cust_detail.batch_id, batch.ItemType as ItemType";
                    $query->Where = "LEFT JOIN batches as batch ON batch.id = cust_detail.batch_id";
                    $query->Where .= " where cust_detail.customer_id = '" . $app['POST']['cust_id'] . "' order by batch.value DESC";
                    $show_batch = $query->ListOfAllRecords();


                    $show = $app['POST']['cust_id'];
                    $query2 = new query('order_items');
                    $query2->Field = "order_items.id, order_items.customer_id, order_items.order_id , order_items.product_id,  orders.is_order_valid ";
                    $query2->Where = " LEFT JOIN batches on order_items.product_id=batches.id LEFT JOIN orders on order_items.order_id=orders.id WHERE orders.is_order_valid='1'  AND order_items.customer_id IN(Select customers.id from customers WHERE customers.id=$show)  ORDER BY order_id ";
                    $customer_order_items = $query2->ListOfAllRecords('object');

                    foreach ($show_batch as $key => $show) {

                        $name_addition = "";
                        if ($show['ItemType'] == '10') {
                            $name_addition = ' "' . $currentCustomer->ShownName . '"';
                        }


                        $ordered_str = '';
                        $ordered_int = 0;
                        foreach ($customer_order_items as $ordered_item) {

                            if ($ordered_item->product_id == $show['batch_id']) {
                                $ordered_str = 'style="background-color: #DDDDFF;"';
                                $ordered_int = 1;

                            }
                        }




                        $ribbon_type = show_ribbon_images($show['type'], $show['batch_image'], '', '', '');
                        $output['result'][$key]['batch_image'] = $show['batch_image'];
                        $output['result'][$key]['ribbon_name_en'] = $show['batchname'];
                        $output['result'][$key]['name_addition'] = $name_addition;
                        $output['result'][$key]['custId'] = $show['id'];
                        $output['result'][$key]['ribbon_type'] = $ribbon_type;
                        $output['result'][$key]['ordered'] = $ordered_int;
                        $output['result'][$key]['ordered_str'] = $ordered_str;
                        $output['msg'] = _e('New ribbon added successfully', true);
                        $output['status'] = 'Sucessfully';


                    }
                } else {
                    $output['msg'] = _e('Error occurred while updating account info. Please try again!', true);
                    $output['status'] = 'error';
                }
            } else {
                $show_batch = array();
                $query = new query("customer_batches as cust_detail");
                $query->Field = "batch.id,batch.batch_image,batch.type,batch.value,batch.ribbon_name_" . $app['language'] . " as batchname,cust_detail.id as cust_id,cust_detail.type,  batch.ItemType as ItemType ";
                $query->Where = "LEFT JOIN batches as batch ON batch.id = cust_detail.batch_id ";
                $query->Where .= " where cust_detail.customer_id = '" . $app['POST']['cust_id'] . "' order by batch.value DESC";
                //$query->print= 1;
                $show_batch = $query->ListOfAllRecords();
                //pr($show_batch);
                foreach ($show_batch as $key => $show) {



                    $name_addition = "";
                    if ($show['ItemType'] == '10') {
                        $name_addition = ' "' . $currentCustomer->ShownName . '"';
                    }

                    $ribbon_type = show_ribbon_images($show['type'], $show['batch_image'], '', '', '');
                    $output['result'][$key]['batch_image'] = $show['batch_image'];
                    $output['result'][$key]['ribbon_name_en'] = $show['batchname'];
                    $output['result'][$key]['name_addition'] = $name_addition;
                    $output['result'][$key]['custId'] = $show['cust_id'];
                    $output['result'][$key]['ribbon_type'] = $ribbon_type;
                    $output['msg'] = _e('This ribbon already added to this customer!', true);
                    $output['status'] = 'error';
                }
            }
        } else {
            $output['msg'] = _e('Please add customer first', true);
            $output['status'] = 'error';
        }
        echo json_encode($output);
        break;


    case 'add_list_type':
        if (isset($app['POST']['batch_id'])) {
            $object_q = new query('batch_images');
            $object_q->Field = "id,batch_image,number";
            $object_q->Where = " Where id = ";
            $object_q->Where .= " (SELECT Max(id) from batch_images";
            $object_q->Where .= " Where number =" . $app['POST']['number'] . " and batch_id =" . $app['POST']['batch_id'] . ")";
            //$object_q->print=1;
            $record_q = $object_q->DisplayOne();
            //echo "<pre>";print_r($record_q);
            if (!empty($record_q)) {
                //echo $app['POST']['cust_id']."<br/>".$app['POST']['number']."<br/>".$app['POST']['batch_id'];
                $object = new query('customer_batches');
                $object->Where = "Where customer_id =" . $app['POST']['cust_id'] . " and number =" . $app['POST']['number'] . " and batch_id=" . $app['POST']['batch_id'];
                //$object->print=1;
                $record = $object->ListOfAllRecords();
                //echo "<pre>";print_r($record);
                if (empty($record)) {
                    $query = new query('customer_batches');
                    $query->Data['user_id'] = $app['POST']['user_id'];
                    $query->Data['customer_id'] = $app['POST']['cust_id'];
                    $query->Data['batch_id'] = $app['POST']['batch_id'];
                    $query->Data['type'] = '1';
                    $query->Data['number'] = $app['POST']['number'];
                    $query->Data['country'] = '';
                    $query->Data['year'] = '';
                    $query->Data['date_add'] = '1';
                    if ($query->Insert()) {
                        $show_batch = array();
                        $query = new query("customer_batches as cust_detail");
                        $query->Field = " batch.id,b.batch_image,cust_detail.batch_id,batch.type,batch.ribbon_name_en,batch.ribbon_name_dr,cust_detail.id,cust_detail.type,cust_detail.number";
                        $query->Where = " LEFT JOIN batches as batch ON batch.id = cust_detail.batch_id";
                        $query->Where .= " LEFT JOIN batch_images as b ON b.batch_id = batch.id and b.id =" . $record_q->id . "";
                        $query->Where .= " where cust_detail.id = " . $query->GetMaxId();
                        //$query->print=1;
                        $show_batch = $query->ListOfAllRecords();
                        //echo "<pre>";print_r($show_batch);
                        foreach ($show_batch as $show) {
                            $ribbon_type = show_ribbon_images($show['type'], $show['batch_image'], $show['number'], '', $show['batch_id']);
                            if (!empty($ribbon_type)) {
                                $output['batch_image'] = $show['batch_image'];
                                $output['ribbon_name_en'] = $show['ribbon_name_' . $app['language']];
                                $output['custId'] = $show['id'];
                                $output['ribbon_type'] = $ribbon_type;
                                $output['msg'] = _e('New ribbon added successfully', true);
                                $output['status'] = 'Sucessfully';
                            }
                        }
                    } else {
                        $output['msg'] = _e('Error occurred while updating account info. Please try again!', true);
                        $output['status'] = 'error';
                    }
                } else {
                    $output['msg'] = _e('This ribbon already added to this customer!', true);
                    $output['status'] = 'error';
                }
            } else {
                $output['msg'] = _e('There is no image added for this batch!', true);
                $output['status'] = 'error';
            }
        }
        echo json_encode($output);
        break;

    case 'ribbon_location':
        if (isset($app['POST']['batchType']) && $app['POST']['batchType'] == '2' && isset($app['POST']['batch_id'])) {

            $query = new query("batches");
            $query->Where = " WHERE id=".$app['POST']['batch_id'];
            $temp = $query->DisplayOne();

            $query = new query("ribbon_location");
            $query->Where = " WHERE SetID=" . $temp->SetID .  " order by position";
            $locations = $query->ListOfAllRecords();
        }
        echo json_encode($locations);
        break;

    case 'add_list_country':
        if (isset($app['POST']['loc_val'])) {
            $object_q = new query('batch_images');
            $object_q->Where = "Where location_id =" . $app['POST']['loc_val'] . " and batch_id =" . $app['POST']['batch_id'] . "";
            $record_q = $object_q->ListOfAllRecords();
            if (!empty($record_q)) {
                $object = new query('customer_batches');
                $object->Where = "Where customer_id =" . $app['POST']['cust_id'] . " and batch_id =" . $app['POST']['batch_id'] . " and country = '" . $app['POST']['loc_val'] . "'";
                $record = $object->ListOfAllRecords();
                //print_r($record);
                if (empty($record)) {
                    $query = new query('customer_batches');
                    $query->Data['user_id'] = $app['POST']['user_id'];
                    $query->Data['customer_id'] = $app['POST']['cust_id'];
                    $query->Data['batch_id'] = $app['POST']['batch_id'];
                    $query->Data['type'] = '2';
                    $query->Data['number'] = '';
                    $query->Data['country'] = $app['POST']['loc_val'];
                    $query->Data['date_add'] = '1';
                    if ($query->Insert()) {
                        $show_batch = array();
                        $query = new query("customer_batches as cust_detail");
                        $query->Field = "batch.id,batch.batch_image,cust_detail.batch_id,batch.type,batch.ribbon_name_en,batch.ribbon_name_dr,cust_detail.id,cust_detail.type,cust_detail.number,cust_detail.country,cust_detail.year,batch.ItemType as ItemType";
                        $query->Where = "LEFT JOIN batches as batch ON batch.id = cust_detail.batch_id";
                        $query->Where .= " where cust_detail.batch_id = " . $app['POST']['batch_id'] . " and cust_detail.country = " . $app['POST']['loc_val'];
                        //$query->print=1;
                        $show_batch = $query->ListOfAllRecords();
                        //echo "<pre>";print_r($show_batch);
                        foreach ($show_batch as $show) {
                            $ribbon_type = show_ribbon_images($show['type'], $show['batch_image'], $show['number'], $show['country'], $show['batch_id']);
                            $output['batch_image'] = $show['batch_image'];
                            $output['ribbon_name_en'] = $show['ribbon_name_' . $app['language']];
                            $output['custId'] = $show['id'];
                            $output['ribbon_type'] = $ribbon_type;

                            $output['msg'] = _e('New customer added successfully', true);
                            $output['status'] = 'Sucessfully';
                        }
                    } else {
                        $output['msg'] = _e('Error occurred while updating account info. Please try again!', true);
                        $output['status'] = 'error';
                    }
                } else {
                    $output['msg'] = _e('This ribbon already added to this customer!', true);
                    $output['status'] = 'error';
                }
            } else {
                $output['msg'] = _e('There is no image added for this batch!', true);
                $output['status'] = 'error';
            }
        }
        //print_r($output);
        echo json_encode($output);
        break;
        /* for selected items section */
    case 'show_list':
        $output = array();
        if (isset($app['POST']['customer_id']) && $app['POST']['customer_id'] != '') {
            $show = $app['POST']['customer_id'];

            $query = new query("batches as batch");
            $query->Field = "batch.id,batch.grade, batch.value,batch.batch_image,batch.type,cust.batch_id,batch.level,batch.ribbon_name_en,batch.ribbon_name_dr,cust.customer_id,cust.id,cust.number,cust.country,cust.year, batch.ItemType as ItemType";
            $query->Where = "LEFT JOIN customer_batches as cust ON batch.id = cust.batch_id";
            $query->Where .= " where cust.customer_id = '" . $show . "' order by batch.value DESC";
            $showing = $query->ListOfAllRecords();

            $query = new query("customers as customers");
            $query->Field = " ShownName ";
            $query->Where = " WHERE id = '" . $app['POST']['customer_id'] . "'";
            $currentCustomer = $query->DisplayOne();
            $name_addition = "";

            $query2 = new query('order_items');
            $query2->Field = "order_items.id, order_items.customer_id, order_items.order_id , order_items.product_id,  orders.is_order_valid ";
            $query2->Where = " LEFT JOIN batches on order_items.product_id=batches.id LEFT JOIN orders on order_items.order_id=orders.id WHERE orders.is_order_valid='1'  AND order_items.customer_id IN(Select customers.id from customers WHERE customers.id=$show)  ORDER BY order_id ";
            $customer_order_items = $query2->ListOfAllRecords('object');




            foreach ($showing as $show) {

                $name_addition = "";
                if ($show['ItemType'] == '10') {
                    $name_addition = ' "' . $currentCustomer->ShownName . '"';
                }

                $ordered_str = 'style="background-color: #F6F6F6;"';
                $ordered_int = 0;
                foreach ($customer_order_items as $ordered_item) {
                    if ($ordered_item->product_id == $show['batch_id']) {
                        $ordered_str = 'style="background-color: #DDDDFF;"';
                        $ordered_int = 1;

                    }

                }


                $output[] = array(
                'ribbon_name_en' => $show['ribbon_name_' . $app['language']],
            'name_addition' => $name_addition,
                'custId' => $show['id'],
                'level' => $show['level'],
                'ribbon_type' => show_ribbon_images($show['type'], $show['batch_image'], $show['number'], $show['country'], $show['batch_id']),
         'ordered' =>  $ordered_int,
         'ordered_str' => $ordered_str,
                );
            }
        }
        //print_r($output);
        echo json_encode($output);
        break;
        /* for badges placed section */
    case 'show_list_1':
        $output = array();
        if (isset($app['POST']['customer_id']) && $app['POST']['customer_id'] != '') {
            $show = $app['POST']['customer_id'];
            $output = listBatch($show);

        }

        //print_r($output);
        echo json_encode($output);


        break;
    case 'add_to_cart':
        $output['msgs'] = array();
        if (isset($app['POST']['values']) && !empty($app['POST']['values'])) {
            $customer_id = $app['POST']['customer_id'];

            $safety2 = new query('customers');
            $safety2->Field = " user_id ";
            $safety2->Where = " WHERE id = " . $customer_id;
            $temp2 = $safety2->DisplayOne();

            $user_id = $app['user_info']->id;

            if ($temp2->user_id != $user_id) {


                $output['msgs'][] = array(
                    'msg' => _e("Sie wurden ausgeloggt. Bitte einloggen und erneut versuchen.", true),
                    'status' => 'error'
                );

                echo json_encode($output);
                break;
            }






            if (isset($app['user_key'])) {


                $cart_id = get_cart_id();
                $cust_id = $app['POST']['values'];
                //pr($cust_id);
                //                foreach ($batch_id as $k => $v) {
                //                    $query1 = new query('batches');
                //                    $query1->Field = "id,ribbon_name_en,unit_price";
                //                    $query1->Where = "where id = $v ";
                //                    $batch_details = $query1->DisplayOne();
                foreach ($cust_id as $k => $v) {
                    $obj = new query('customer_batches as cust_batch');
                    $obj->Field = "batch.id,batch.batch_image,batch.is_active,batch.ribbon_name_en,batch.ribbon_name_dr,batch.unit_price,cust_batch.type,cust_batch.number,cust_batch.country,cust_batch.year";
                    $obj->Where = "LEFT JOIN batches as batch ON batch.id = cust_batch.batch_id";
                    $obj->Where .= " where cust_batch.id = " . $v;
                    $cust = $obj->DisplayOne();
                    //check if same product already added in cart for same customer


                    $query2 = new query('cart_items');
                    $query2->Data['cart_id'] = $cart_id;
                    $query2->Data['customer_id'] = $customer_id;
                    $query2->Data['product_id'] = $cust->id;


                    if ($cust->type == 0 || $cust->type == 10) {
                        $query2->Where = "where cart_id = " . $cart_id . " and customer_id = " . $app['POST']['customer_id'] . " and product_id = " . $cust->id . "";
                    } elseif ($cust->type == 1) {
                        $query2->Where = "where cart_id = " . $cart_id . " and customer_id = " . $app['POST']['customer_id'] . " and product_id = " . $cust->id . " and number = " . $cust->number . "";
                    } elseif ($cust->type == 2) {
                        $query2->Where = "where cart_id = " . $cart_id . " and customer_id = " . $app['POST']['customer_id'] . " and product_id = " . $cust->id . " and country = " . $cust->country . "";
                    }

                    $check_cart_entry = $query2->DisplayOne();


                    if (is_object($check_cart_entry) && $cust->id != '548' && $cust->id != '549' && $cust->id != '551' && $cust->id != '188') {
                        $output['msgs'][] = array(
                            'msg' => $cust->{'ribbon_name_' . $app['language']} . _e(" - Batch already added in cart for same customer.", true) ,
                            'status' => 'error'
                        );

                    } elseif ($cust->is_active == '0') {
                        $output['msgs'][] = array(
                            'msg' => $cust->{'ribbon_name_' . $app['language']} . _e("Batch currently not available", true) ,
                            'status' => 'error'
                        );
                    } elseif (is_object($check_cart_entry) && ($cust->id == '548' || $cust->id == '549' || $cust->id == '551'  || $cust->id == '188')) {

                        $query2->Data['quantity'] = $check_cart_entry->quantity + 1;
                        $query2->Data['quantity_initial'] = $check_cart_entry->quantity + 1;
                        $query2->Data['total_price_tax_excl'] = $cust->unit_price * ($check_cart_entry->quantity + 1);

                        if ($query2->UpdateCustom()) {
                            $output['msgs'][] = array(
                                'msg' => $cust->{'ribbon_name_' . $app['language']} . _e(" - Batch added in cart successfully.", true),
                                'status' => 'success' );
                        } else {
                            $output['msgs'][] = array(
                                'msg' => $cust->{'ribbon_name_' . $app['language']} . _e(" - Error occurred while adding batch in cart! Try again!", true),
                                'status' => 'error'
                            );
                        }


                    } else {
                        $query2 = new query('cart_items');
                        $query2->Data['cart_id'] = $cart_id;
                        $query2->Data['customer_id'] = $app['POST']['customer_id'];
                        $query2->Data['product_id'] = $cust->id;
                        $query2->Data['type'] = $cust->type;
                        $query2->Data['number'] = $cust->number;
                        $query2->Data['country'] = $cust->country;
                        //$query2->Data['year'] = $cust->year;
                        $query2->Data['quantity'] = '1';
                        $query2->Data['quantity_initial'] = '1';

                        if ($cust->type == 1 and $cust->number == 1) {

                            $query2->Data['unit_price'] = $cust->unit_price - 3;
                            $query2->Data['total_price_tax_excl'] = $cust->unit_price - 3;
                        } else {

                            $query2->Data['unit_price'] = $cust->unit_price;
                            $query2->Data['total_price_tax_excl'] = $cust->unit_price;
                        }


                        $query2->Data['date_add'] = '1';
                        if ($query2->Insert()) {
                            $output['msgs'][] = array(
                                'msg' => $cust->{'ribbon_name_' . $app['language']} . _e(" - Batch added in cart successfully.", true),
                                'status' => 'success'
                            );
                        } else {
                            $output['msgs'][] = array(
                                'msg' => $cust->{'ribbon_name_' . $app['language']} . _e(" - Error occurred while adding batch in cart! Try again!", true),
                                'status' => 'error'
                            );
                        }
                    }
                }
            }
        } else {
            $output['msgs'][] = array(
                'msg' => _e("Please add ribbon first!", true),
                'status' => 'error'
            );
        }
        echo json_encode($output);
        break;

    case 'del_from_cart':
        $output = array();
        if (isset($app['POST']['id']) && $app['POST']['id'] != '') {
            $id = intval($app['POST']['id']);
            if ($id > 0) {
                $query1 = new query('cart_items');
                $query1->Where = "Where id = $id ";
                $del = $query1->Delete_where();
                ///$output['msg'] = 'This ribbon has been deleted from your cart!';
                //$output['status'] = 'success';
            }
        } echo json_encode($output);
        break;

    case 'cust_batch':
        if (isset($app['POST']['id']) && $app['POST']['id'] != '') {
            $query = new query("customer_batches as cust_detail");
            $query->Field = "batch.id,batch.batch_image,batch.ribbon_name_en,batch.ribbon_name_dr,batch.ribbon_name_" . $app['language'] . " as batchname";
            $query->Where = "LEFT JOIN batches as batch ON batch.id = cust_detail.batch_id";
            $query->Where .= " where cust_detail.customer_id = " . $app['POST']['id'];
            $show_batch = $query->ListOfAllRecords();
            echo json_encode($show_batch);
        }
        break;

    case 'delete_customer':
        if (isset($app['POST']['values']) && $app['POST']['values'] != '') {
            $val = $app['POST']['values'];
            $cust_id = isset($app['POST']['cust_id']) ? intval($app['POST']['cust_id']) : 0;
            $output['del_id'] = $val;
            if ($cust_id > 0 && is_array($val)) {
                foreach ($val as $k => $v) {
                    $batchId = intval($v);
                    if ($batchId > 0) {
                        $query1 = new query('customer_batches');
                        $query1->Where = "Where id = $batchId and customer_id = $cust_id ";
                        $del = $query1->Delete_where();
                    }
                }
            }
        } echo json_encode($output);
        break;

    case 'search':
        if (isset($app['POST']['q']) && $app['POST']['q'] != '') {
            $text = $app['POST']['q'];
            $text = htmlentities($text, ENT_QUOTES, 'UTF-8');
            $query = new query('batches');
            // Include fields used by the search results template (image + type) so
            // the rendered "Add to list" buttons carry the correct data attributes.
            $query->Field = "id,ribbon_name_en,ribbon_name_dr,is_active,desc_en,batch_image,type";
            $query->Where = "where (ribbon_name_en LIKE '%$text%'or ribbon_name_dr LIKE '%$text%' or webshop_title_en LIKE '%$text%' or webshop_title_dr  LIKE '%$text%') AND is_batch=1 order by ribbon_name_en,ribbon_name_dr ASC ";
            $searched_ribbons = $query->ListOfAllRecords();
        }
        echo json_encode($searched_ribbons);
        break;

    case 'updateLastactivity':
        if (isset($app['POST']) && $app['POST'] != '') {
            $user_id = isset($logged_in_user_info->id) ? $logged_in_user_info->id : '';
            $query = new query("lastactivity");
            $query->Where = " where user_id = $user_id";
            $is_data = $query->DisplayOne();
            if (!empty($is_data)) {
                $query = new query("lastactivity");
                //$query->Data['user_id'] = $user_id;
                $query->Data['shop_data'] = isset($app['POST']) ? json_encode($app['POST']) : '';
                //$query->print=1;
                $query->Where = " where user_id = " . $user_id . "";
                if ($query->updateCustom()) {
                    echo "updated successfully.";
                }
            } else {
                $query = new query("lastactivity");
                $query->Data['user_id'] = $user_id;
                $query->Data['shop_data'] = isset($app['POST']) ? json_encode($app['POST']) : '';
                $query->Data['date_add'] = 1;
                if ($query->insert()) {
                    echo "inserted successfully.";
                }
            }
        }
        break;

    case 'getShopInfo':
        if (isset($app['POST']['sess_id']) && $app['POST']['sess_id'] != '') {
            $sess_id = $app['POST']['sess_id'];
            $query = new query("lastactivity");
            $query->Where = " where user_id = $sess_id ";
            $user_info = $query->DisplayOne('object');
            if (!empty($user_info)) {
                echo($user_info->shop_data);
            } else {
                die("false");
            }
        }
        break;

    case 'getShippingCost':
        if (isset($app['POST']['total_amount_befr_ship']) && $app['POST']['total_amount_befr_ship'] != '') {
            $result = array();
            $total_amount_befr_ship = isset($app['POST']['total_amount_befr_ship']) ? $app['POST']['total_amount_befr_ship'] : '0';
            $total_amount = (preg_replace('/[^A-Za-z0-9\-.]/', '', $total_amount_befr_ship));
            $area_id = isset($app['POST']['area']) ? $app['POST']['area'] : '';
            $query = new query("shippingcosts");
            $query->Where = " where id = $area_id ";
            $shipping_info = $query->DisplayOne('object');
            $result['shipping_code'] = $shipping_info->cost;
            $result['total_amnt'] = $total_amount + $shipping_info->cost;
            echo json_encode($result);
        }
        break;

    default:
        $output = array();
        $output['status'] = 'error';
        $output['msg'] = 'Invalid action specified';
        if (isset($ajax_errors) && !empty($ajax_errors)) {
            $output['php_errors'] = $ajax_errors;
        }
        echo json_encode($output);
        break;

endswitch;
