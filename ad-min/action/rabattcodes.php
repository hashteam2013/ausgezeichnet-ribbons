<?php
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL); 
global $app;

/**
 * Resolve the maximum allowed length for the rabattcodes.code column directly
 * from the database. Falls back to 0 (no check) if the lookup fails.
 */
function rabattcodes_code_max_length($dbLink) {
    if (!$dbLink) {
        return 0;
    }

    $sql = "SELECT CHARACTER_MAXIMUM_LENGTH AS len
            FROM information_schema.COLUMNS
            WHERE table_schema = DATABASE()
              AND table_name = 'rabattcodes'
              AND column_name = 'code'
            LIMIT 1";

    if ($result = mysqli_query($dbLink, $sql)) {
        if ($row = mysqli_fetch_assoc($result)) {
            return (int)$row['len'];
        }
    }

    return 0;
}

function rabattcodes_strlen($value) {
    return function_exists('mb_strlen') ? mb_strlen($value, 'UTF-8') : strlen($value);
}

function rabattcodes_validate_rabatt($rawValue, &$normalizedValue) {
    $trimmed = trim($rawValue);
    if ($trimmed === '') {
        return 'Please enter rabatt';
    }
    if (!is_numeric($trimmed)) {
        return 'Rabatt must be a number';
    }
    // store as integer to satisfy the rabatt column type
    $normalizedValue = (int)$trimmed;
    return '';
}

$codeMaxLength = rabattcodes_code_max_length($app['mysqllink']);
$id = isset($app['GET']['id'])?$app['GET']['id']:"0";
switch ($action):
    case 'add':
        if (isset($app['POST']['add']))
        {

            $msg = '';
            $submittedCode = trim($app['POST']['code']);
            $submittedRabatt = null;
            if ($submittedCode == '') {
                $msg = 'Please enter code';
            } elseif ($codeMaxLength > 0 && rabattcodes_strlen($submittedCode) > $codeMaxLength) {
                $msg = "Code is too long (max {$codeMaxLength} characters)";
            } else {
                $msg = rabattcodes_validate_rabatt($app['POST']['rabatt'], $submittedRabatt);
            }
            if ($msg === '') {
                    $queryObj = new query('rabattcodes');
                    $queryObj->Field = " id, code";
                    $queryObj->Where = " where code = '".$app['POST']['code']."'";
                    $object = $queryObj->DisplayOne();
                    if(!is_object($object)){
                            $query = new query('rabattcodes');
                            $query->Data['code'] = ucwords($app['POST']['code']);
                            $query->Data['rabatt'] = $submittedRabatt;
                            $query->Data['is_active'] = '1';
                            $query->Data['date_add'] = '1';
                            if ($query->Insert()) {
                                set_alert('success', "New code successfully");
                                redirect(app_url('rabattcodes','list','list',array(),true));
                            } else {
                                $msg = 'Error occurred while updating account info. Please try again!';
                            }
                        } else{
                            $msg = 'Code already in use';   
                        }
            }
            set_alert('error', $msg);
        }
        
        break;
        
    case 'edit':
        
        if (isset($app['POST']['update']))
        {

            $msg = '';
            $submittedCode = trim($app['POST']['code']);
            $submittedRabatt = null;
            if ($submittedCode == '') {
                $msg = 'Please enter code';
            } elseif ($codeMaxLength > 0 && rabattcodes_strlen($submittedCode) > $codeMaxLength) {
                $msg = "Code is too long (max {$codeMaxLength} characters)";
            } else {
                $msg = rabattcodes_validate_rabatt($app['POST']['rabatt'], $submittedRabatt);
            }
            if ($msg === '') {

                    $queryObj = new query('rabattcodes');
                    $queryObj->Field = " id";
                    $queryObj->Where = " where code !=" .$app['POST']['code'];
                    $object = $queryObj->DisplayOne();
                    if(!is_object($object))
			{

                            $query = new query('rabattcodes');
                            $query->Data['id'] = $id;
                            $query->Data['code'] = ucwords($app['POST']['code']);
                            $query->Data['rabatt'] = $submittedRabatt;

                            if ($query->Update()) {
                                set_alert('success', "Code updated successfully");
                                redirect(app_url('rabattcodes','edit','edit',array('id'=>$id),true));
                            } else {
                                $msg = 'Error occurred while updating code. Please try again!';
                            }
                        } else
                        {
                            $msg = 'code already in use';   
                        }
            }
            
            set_alert('error', 'FEHLER:' . $msg);
        }
        $query = new query('rabattcodes');
        $query->Where = "where id = ".$id;
        $rabattcode = $query->DisplayOne();
            
        if(!(is_object($rabattcode)))
        {
            redirect(app_url('rabattcodes','list','list',array(),true));
        }
        
        break;
        
    case 'delete_code':
        if(isset($app['GET']['del']) && $app['GET']['del']!='' ){
            $query = new query('rabattcodes');
            $query->id = $app['GET']['del'];
            $rabattcodes = $query->Delete();
        } else{
            set_alert('error', 'Incorrect information');
        }
        redirect(app_url('rabattcodes','list','list',array(),true));
        break;
        
    case 'suspend_code':
        if(isset($app['GET']['suspend']) && $app['GET']['suspend']!=''){
            $query = new query('rabattcodes');
            $query->Data['id'] = $app['GET']['suspend'];
            $query->Data['is_active'] = '0';
            $rabattcodes = $query->Update();
        } else{
            set_alert('error', 'Incorrect information');
        }
        redirect(app_url('rabattcodes','list','list',array(),true));
        break;
    
    case 'unsuspend_code':
        if(isset($app['GET']['unsuspend']) && $app['GET']['unsuspend']!=''){
            $query = new query('rabattcodes');
            $query->Data['id'] = $app['GET']['unsuspend'];
            $query->Data['is_active'] = '1';
            $rabattcodes = $query->Update();
        } else{
            set_alert('error', 'Incorrect information');
        }
        redirect(app_url('rabattcodes','list','list',array(),true));
        break;
        
    default:
    
        case 'list':
        $query = new query('rabattcodes');
        $query->Where = " order by id asc";
        $rabattcodes = $query->ListOfAllRecords('object');
        break;
endswitch;
