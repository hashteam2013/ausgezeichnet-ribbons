<?php
// ini_set('display_errors', '1');
// ini_set('display_startup_errors', '1');
// error_reporting(E_ALL);
global $app;
$id = isset($app['GET']['id'])?$app['GET']['id']:"0";
$page_no = (isset($app['GET']['page_no']) && $app['GET']['page_no'] != "")? $app['GET']['page_no'] : 1;
$limit = PAGE_CONTENT_LIMIT;
switch ($action):
    case 'search':
    if (isset($app['POST']['search'])) {
        $query = new query('customers');
      	$query->Field = " customers.first_name, customers.last_name, customers.user_id, users.first_name as user_first_name, users.last_name as user_last_name, users.id as userid,orders.id as orderid ";
		$query->Where = " LEFT JOIN users ON customers.user_id = users.id  LEFT JOIN orders ON orders.user_id = users.id";
		
		// Build WHERE conditions
		$whereConditions = array();
		
		if (trim($app['POST']['firstname']) != '')
		{
			$whereConditions[] = " customers.first_name = '" . mysqli_real_escape_string($app['mysqllink'], trim($app['POST']['firstname'])) . "'";
		}

		if (trim($app['POST']['lastname']) != '')
		{
			$whereConditions[] = " customers.last_name = '" . mysqli_real_escape_string($app['mysqllink'], trim($app['POST']['lastname'])) . "'";
		}

		// Only add WHERE clause if there are conditions
		if (!empty($whereConditions))
		{
			$query->Where .= " WHERE " . implode(" AND ", $whereConditions);
		}

       		$customers = $query->ListOfAllRecords('object');
		

        break;  

	}


    case 'add':
        if (isset($app['POST']['add'])) {
            $msg = '';
            if (trim($app['POST']['firstname']) == '') {
                $msg = 'Please enter firstname';
            }elseif (trim($app['POST']['lastname']) == '') {
                $msg = 'Please enter lastname';
            }elseif (trim($app['POST']['email']) == '') {
                $msg = 'Please enter email';
            }elseif (!filter_var($app['POST']['email'], FILTER_VALIDATE_EMAIL)){
                $msg = 'Please enter valid email';
            }elseif (strlen($app['POST']['password']) == '') {
                $msg = 'Please enter password';
            }elseif (strlen($app['POST']['password']) <= '4') {
                $msg = 'Password lenght must be five or more';
            }elseif (strlen($app['POST']['password']) > '20') {
                $msg = 'Password lenght cannot be more than 20';
            }
            else{
                $queryObj = new query('users');
                $queryObj->Field = " id";
                $queryObj->Where = " where email = '".$app['POST']['email']."'";
                $object = $queryObj->DisplayOne();
                if(!is_object($object)){
                    $query = new query('users');
                    $query->Data['first_name'] = $app['POST']['firstname'];
                    $query->Data['last_name'] = $app['POST']['lastname'];
                    $query->Data['email'] = $app['POST']['email'];
                    $query->Data['password'] = generateHash($app['POST']['password']);
                    $query->Data['is_trustworthy'] = isset($app['POST']['trustworthy'])? $app['POST']['trustworthy']:'0';
                    $query->Data['is_verified'] = isset($app['POST']['verified'])? $app['POST']['verified']:'0';
                    $query->Data['is_active'] = isset($app['POST']['active'])? $app['POST']['active']: '0';
                    if ($query->Insert()) {
                        set_alert('success', "New user added successfully");
                        redirect(app_url('users_customers','list','list',array(),true));
                    } else {
                        $msg = 'Error occurred while updating account info. Please try again!';
                    }
                } else{
                    $msg = 'Account already associated with same email';   
                }
            }
            set_alert('error', $msg);
        }
        break;
        
     case 'edit':
        if (isset($app['POST']['update'])) {
            $msg = '';
            if (trim($app['POST']['firstname']) == '') {
                $msg = 'Please enter firstname';
            }elseif (trim($app['POST']['lastname']) == '') {
                $msg = 'Please enter lastname';
            }elseif (trim($app['POST']['email']) == '') {
                $msg = 'Please enter email';
            }elseif (!filter_var($app['POST']['email'], FILTER_VALIDATE_EMAIL)){
                $msg = 'Please enter valid email';
            }elseif (trim($app['POST']['password']) != '' && strlen($app['POST']['password']) <= '4') {
                $msg = 'Password lenght must be five or more';
            }else{
               // if (filter_var($app['POST']['email'], FILTER_VALIDATE_EMAIL)){
//                    $queryObj = new query('users');
//                    $queryObj->Field = " id";
//                    $queryObj->Where = " where id != '".$id."' and email = '".$app['POST']['email']."'";
//                    $object = $queryObj->DisplayOne();
//                        if(!is_object($object)){
                            $query = new query('users');
                            $query->Data['id'] = $id;
                            $query->Data['first_name'] = ucwords($app['POST']['firstname']);
                            $query->Data['last_name'] = ucwords($app['POST']['lastname']);
                            $query->Data['comment'] = $app['POST']['comment'];
                            $query->Data['email'] = $app['POST']['email'];
                            $query->Data['is_trustworthy'] = isset($app['POST']['trustworthy'])? $app['POST']['trustworthy']:'0';
                            $query->Data['is_verified'] = isset($app['POST']['verified'])? $app['POST']['verified']:'0';
                            $query->Data['is_active'] = isset($app['POST']['active'])? $app['POST']['active']: '0';
                            //$query->Data['is_deleted'] = isset($app['POST']['delete'])? $app['POST']['delete']: '0';
                            if(trim($app['POST']['password']) != '' ){
                                $query->Data['password'] = generateHash($app['POST']['password']);
                            }
                            if ($query->Update()) {
                                set_alert('success', "Account info updated successfully");
                            } else {
                                $msg = 'Error occurred while updating account info. Please try again!';
                            }
//                        } else{
//                            $msg = 'Account already associated with same username';   
//                        }
                    
//                } else{
//                    $msg = 'Please enter valid email';
//                }
            }
            set_alert('error', $msg);
        }
        $query = new query('users');
        $query->Where = "where id = ".$id;
        $users_customers = $query->DisplayOne();
        if(!(is_object($users_customers))){
            redirect(app_url('users_customers','list','list',array(),true));
        }
        break;
       
    case 'delete_user':
        if(isset($app['GET']['del']) && $app['GET']['del']!=''){
            $query = new query('users');
            $query->Data['id'] = $app['GET']['del'];
            $query->Data['is_deleted'] = '1';
            $users_customers = $query->Update();
        } else{
            set_alert('error', 'Incorrect information');
        }
        redirect(app_url('users_customers','list','list',array(),true));
        break;   
    
    case 'list_deep':



        $query = new query('users');
        $query->Field = " users.id as id, users.is_deleted as is_deleted, users.first_name as first_name, users.last_name as last_name, users.email as email, users.is_verified as is_verified, users.date_upd as date_upd, users.accepted_dsgvo1 as accepted_dsgvo1, users.accepted_eMail as accepted_eMail, users.accepted_phone as accepted_phone, o.total as total, cb.batches_total as batches_total";
        $query->Where = " LEFT JOIN (SELECT orders.user_id, SUM(if(orders.is_order_valid=1,orders.grand_total,0)) as total FROM orders GROUP BY orders.user_id)  o ON (users.id = o.user_id) LEFT JOIN (SELECT customer_batches.user_id, COUNT(customer_batches.id) as batches_total  FROM customer_batches GROUP BY customer_batches.user_id)  cb ON (users.id = cb.user_id)  where users.is_deleted = 0 GROUP BY users.id ORDER BY users.id desc ";
        $users_customers = $query->ListOfAllRecords('object');
        $data =   pagination('users',$limit,$page_no,$url='');
        $users= $data['show_record'];
        $pagination = $data['pagination'];
        break;

   default:
    case 'list':
        $query = new query('users');
        $query->Field = " users.id as id, users.is_deleted as is_deleted, users.first_name as first_name, users.last_name as last_name, users.email as email, users.is_verified as is_verified, users.date_upd as date_upd, users.accepted_dsgvo1 as accepted_dsgvo1, users.accepted_eMail as accepted_eMail, users.accepted_phone as accepted_phone, o.total as total, cb.batches_total as batches_total, users.comment as comment ";
        $query->Where = " LEFT JOIN (SELECT orders.user_id, ROUND(SUM(if(orders.is_order_valid=1,orders.grand_total,0)),2) as total FROM orders GROUP BY orders.user_id)  o ON (users.id = o.user_id) LEFT JOIN (SELECT customer_batches.user_id, COUNT(customer_batches.id) as batches_total  FROM customer_batches GROUP BY customer_batches.user_id)  cb ON (users.id = cb.user_id)  where users.is_deleted = 0  GROUP BY users.id ORDER BY users.id desc ";
        $users_customers = $query->ListOfAllRecords('object');
        $data =   pagination('users',$limit,$page_no,$url='');
        $users= $data['show_record'];
        $pagination = $data['pagination'];


       $query = new query('users');
       $query->Field = "  count(users.id) as users_verified ";
       $query->Where = " WHERE users.is_verified=1 AND users.is_deleted=0";
       $users_customers2 = $query->DisplayOne();
       $users_verified=$users_customers2->users_verified;



       $query3 = new query('users');
       $query3->Field = " count(users.id) as users_dsgvo  ";
       $query3->Where = " WHERE users.accepted_dsgvo1=1 ";
       $users_customers3 = $query3->DisplayOne();
	   $users_dsgvo=$users_customers3->users_dsgvo;

       break;
endswitch;
