<?php
function redirect($url) {
    if (!headers_sent()) {
        header('Location: ' . $url);
    } else {
        echo '<script type="text/javascript">';
        echo 'window.location.href="' . $url . '";';
        echo '</script>';
        echo '<noscript>';
        echo '<meta http-equiv="refresh" content="0;url=' . $url . '" />';
        echo '</noscript>';
    }
    exit;
}


function UTFencoder($string)
{


//$string = utf8_decode($string);get_total()*(1-$discount)ship


if(mb_detect_encoding($string, 'UTF-8', true) != 'UTF-8') {          $string = utf8_decode($string); }

return $string;

}

function UTFencoder2($string)
{
 $string = utf8_decode($string);
//if(mb_detect_encoding($string, 'UTF-8', true) != 'UTF-8') {          $string = utf8_decode($string); }
//if(mb_detect_encoding($string, 'UTF-8', true) != 'UTF-8') {          $string = utf8_decode($string); }

return $string;

}


function pr($array, $exit = true) {
    echo "<pre>";
    print_r($array);
    if ($exit) {
        exit;
    } else {
        echo "</pre>";
    }
    return;
}

function filter($data) { //Filters data against security risks.
    if (is_array($data)) {
        foreach ($data as $key => $element) {
            $data[$key] = filter($element);
        }
    } else {
        //$data = trim(htmlentities(strip_tags($data)));
        $data = trim($data);
        // Magic quotes were removed in PHP 5.4.0, so this check is no longer needed
        // if (get_magic_quotes_gpc()) {
        //     $data = stripslashes($data);
        // }
    }
    return $data;
}

function generateHash($password) {
    if (defined("CRYPT_BLOWFISH") && CRYPT_BLOWFISH) {
        // $salt = substr(md5(uniqid(rand(), true)), 0, 10);
        //return $salt;
        $salt = substr(md5("higotec"), 0, 16);
        //return $salt;
        return crypt($password, $salt);
    }
}

function shipingCost($amount) {
    $output = '';
    if (IS_SHIPPING_FREE == '0') {
	if($amount>250)
	{
        $output = 0.00;
	}
	else
	{
        $output = SHIPING_COST;
	}

    } else {

        $output = 0.00;
    }
    return $output;
}

function shipingCostWithArea($amount, $area) {
    $output = '';
    if (IS_SHIPPING_FREE == '0') {
	if($amount>250)
	{
        $output = 0.00;
	}
	else
	{
if($area==2)
{
        $output = 12;
}
else
{
 	$output = SHIPING_COST;
}
	}

    } else {

        $output = 0.00;
    }
    return $output;
}


function check_user_exitance($username, $password) {
    $queryObj = new query('admin_users');
    $queryObj->Field = " id,is_active";
    $queryObj->Where = " where username = '$username' and password = '$password'";
    $object = $queryObj->DisplayOne();
    if (is_object($object) && count($object)) {
        return $object;
    }
    return false;
}

function set_admin_login($clientid) {
    $queryObj = new query('admin_users');
    $queryObj->Data['last_access_date'] = "now()";
    $queryObj->Data['last_access_ip'] = $_SERVER['REMOTE_ADDR'];
    $queryObj->Data['id'] = $clientid;
    $object = $queryObj->Update();
    $_SESSION['admin_clientid'] = $clientid;
    return true;
}

function set_admin_logout() {
    unset($_SESSION['admin_clientid']);
    return true;
}

function set_user_login($userid) {
    // Just set the session - no database update needed
    // If you need to track last login, add fields like:
    // $queryObj->Data['last_login_date'] = "now()";
    // $queryObj->Data['last_login_ip'] = $_SERVER['REMOTE_ADDR'];
    $_SESSION['user_id'] = $userid;
    return true;
}

function set_user_logout() {
    unset($_SESSION['user_id']);
    return true;
}

function app_url($page = '', $action = '', $view = '', $data = array(), $return = false) {
    $url = "";
    $url .= WS_PATH_ADMIN;
    if ($page != '') {
        $url .= "app.php?page=" . $page;
        $url .= ($view != '') ? '&view=' . $view : '';
        $url .= ($action != '') ? '&action=' . $action : '';
        if (!empty($data)) {
            foreach ($data as $kk => $vv) {
                $url .= "&$kk=" . $vv;
            }
        }
    }
    if ($return) {
        return $url;
    } else {
        echo $url;
        return "";
    }
}

function getSettingsByName($name) {
    $QueryObj = new query('setting');
    $QueryObj->Where = "where name='$name' and status = '1' order by position asc";
    $QueryObj->DisplayAll();
    $ObjArray = array();
    if ($QueryObj->GetNumRows()):
        while ($object = $QueryObj->GetArrayFromRecord()):
            $ObjArray[] = $object;
        endwhile;
    endif;
    return $ObjArray;
}

function get_setting_name($name) {
    $return = $name;
    preg_match('~%(.*?)%~', $name, $output);
    if (count($output)):
        $constant = trim($output['0'], '%');
        $constant_value = (defined($constant)) ? constant($constant) : '';
        if ($constant_value != ''):
            $return = str_replace('%' . $constant . '%', $constant_value, $name);
        endif;
    endif;

    return ucfirst($return);
}

function get_setting_control($key, $type, $value, $options = '') {
    switch ($type) {
        case 'text':
            echo '<input class="form-control" type="text" name="key[' . $key . ']" value="' . $value . '" size="30">';
            break;
        case 'textarea':
            echo '<textarea class="form-control" name="key[' . $key . ']">' . $value . '</textarea>';
            break;
        case 'radio':
            $options_array = array();
            $options_array = explode(",", $options);
            echo "<div class='radio-list'>";
            foreach ($options_array as $option):
                echo '<label class="radio-inline"><input type="radio" class="form-control" value="' . $option . '" name="key[' . $key . ']"';
                echo ($option == $value) ? "checked" : "";
                echo '/>' . ucfirst($option) . '</label>';
            endforeach;
            echo "</div>";
            break;
        case 'select':
            if ($options == ''):
                echo get_y_n_drop_down('key[' . $key . ']', $value);
            else:
                $options_array = array();
                $options_array = explode(",", $options);
                echo '<select class="span6  form-control" name="key[' . $key . ']">';
                foreach ($options_array as $option):
                    echo '<option value="' . $option . '" ';
                    echo (html_entity_decode($option) == $value) ? "selected" : "";
                    echo '>' . str_replace('_', ' ', $option) . '</option>';
                endforeach;
                echo "</select>";
            endif;
            break;
        default:
            echo get_y_n_drop_down('key[' . $key . ']', $value);
            break;
    }
}

function get_y_n_drop_down($name, $selected) {
    echo '<select class="form-control span4"  name="' . $name . '" size="1">';
    if ($selected):
        echo '<option value="1" selected>Yes</option>';
        echo '<option value="0">No</option>';
    else:
        echo '<option value="0" selected>No</option>';
        echo '<option value="1">Yes</option>';
    endif;
    echo '</select>';
}

function is_active_nav($link_page, $current_page, $link_view = '', $current_view = '', $open = true) {
    $output = '';
    if ($link_page == $current_page) {
        if ($current_view != '' && $link_view != '') {
            if ($current_view == $link_view) {
                $output = ' active ';
            }
        } else {
            $output = ' active ';
        }
    }
    if ($output != '' && $open == true) {
        $output .= " open ";
    }
    return $output;
}

function set_alert($status, $msg) {
    if (!(isset($_SESSION['alert']))) {
        $_SESSION['alert'] = array();
    }
    $new_msg = array(
        'status' => $status,
        'msg' => trim($msg),
    );
    $_SESSION['alert'][] = $new_msg;
    return true;
}

function user_role_lable($slug) {
    $roles = array(
        'super_admin' => 'Master Admin',
        'admin' => 'Admin',
        'subscriber' => 'Subscriber'
    );
    $output = "";
    if ($slug != '' && isset($roles[$slug])) {
        $output = $roles[$slug];
    }
    return $output;
}

function return_bytes($val) {
    $val = trim($val);
    $last = strtolower($val[strlen($val) - 1]);
    $val1 = substr(trim($val), 0, -1);
    //echo $val1;
    switch ($last) {
        // The 'G' modifier is available since PHP 5.1.0
        case 'g':
            $val1 *= 1024;
        case 'm':
            $val1 *= 1024;
        case 'k':
            $val1 *= 1024;
    }
    return $val1;
}

function getfilesize($size) {
    if ($size < 2)
        return "$size byte";
    $units = array(' bytes', ' Kb', ' MB', ' GB', ' TB');
    for ($i = 0; $size > 1024; $i++) {
        $size /= 1024;
    }
    return round($size, 2) . $units[$i];
}

function make_file_name($name, $id) {
    $file_name_parts = explode('.', $name);
    $file_name_parts['0'] .= $id;
    $file = $file_name_parts['0'] . '.' . $file_name_parts['1'];
    return $file;
}

function uploadfile($file, $allowed_mime_types, $to_upload_path, $random = '', &$msg) {
    if ($file['error'] == 0):
        if ($file['size'] == '' || $file['size'] > MAX_UPLOAD_FILE_SIZE) :
            $msg = "File size is greater than the max file size limit (" . getfilesize(MAX_UPLOAD_FILE_SIZE) . ").";
            return false;
        else:
            if (in_array($file['type'], $allowed_mime_types)):

                $filename = make_file_name($file['name'], $random);

                if (!is_dir($to_upload_path)):
                    @mkdir($to_upload_path);
                endif;
                if (!file_exists($to_upload_path . '/' . $filename)):
                    if (move_uploaded_file($file['tmp_name'], $to_upload_path . '/' . $filename)):
                        return true;
                    else:
                        $msg = 'unable to upload!!';
                    endif;
                else:
                    $msg = 'File with same name already exists.';
                endif;
            else:
                $msg = 'Wrong file format.';
            endif;
        endif;
    else:
        $msg = file_upload_error_codes($file['error']);
    endif;
    return false;
}

function file_upload_error_codes($code) {
    switch ($code):
        case '1':#UPLOAD_ERR_INI_SIZE
            return 'File size limit exceeds. Max file size: 2MB.';
            break;
        case '2': #UPLOAD_ERR_FORM_SIZE
            return 'Max file size limit set in page has crossed.';
            break;
        case '3': #UPLOAD_ERR_PARTIAL 
            return 'File was only partially uploaded';
            break;
        case '4': #UPLOAD_ERR_NO_FILE
            return 'No file was uploaded';
            break;
        case '6': #UPLOAD_ERR_NO_FILE
            return 'Missing a temporary folder';
            break;
        default: return 'No Message Found!';
    endswitch;
}

function GetMaxId() {
    $query = "select Max(id) as id from " . $this->TableName;
    $this->Query = $query;
    if ($this->ExecuteQuery($query)):
        if ($this->GetNumRows() == 1):
            $row = $this->GetObjectFromRecord();
            $this->CloseConnection();
            return $row->id;
        else:
            return false;
        endif;
    else:
        return false;
    endif;
}

function create_random_key($length = 30) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
    $activationKey = '';
    for ($i = 0; $i < $length; $i++) {
        $activationKey .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $activationKey;
}

function add_css($css_file_path) {
    global $app;
    if ($css_file_path != '') {
        if (!isset($app['page_specific_css'])) {
            $app['page_specific_css'] = array();
        }
        $app['page_specific_css'][] = $css_file_path;
    }
}

function add_js($js_file_path) {
    global $app;
    if ($js_file_path != '') {
        if (!isset($app['page_specific_js'])) {
            $app['page_specific_js'] = array();
        }
        $app['page_specific_js'][] = $js_file_path;
    }
}

function show_price($price,$return = FALSE){
$output = '';
$price = round($price, '2'); 
    if((substr($price, 0, 1)=='-')){
        $output = '-';
        
    }
     $strlen = strlen(substr(strrchr($price, "."), 2));
     if($strlen == 1){
         $price = $price.'0';
         
     }
     $price = number_format((float)$price, 2, '.', '');
    if(	CURRENCY_SYMBOL_LOCATION =='after'){
        $output.= CURRENCY_SYMBOL.str_replace('-','',$price);
    }else{
         $output.= str_replace('-','',$price).CURRENCY_SYMBOL;
    }
         
     if($return){
          return $output;
           } else{
                echo $output;
     }
}

function show_date($sqldate) {
    $date = strtotime($sqldate);
echo date(DATE_FORMAT_SETTINGS, $date);
    
}

function show_time($sqltime){
    $time=  strtotime($sqltime);
    echo date(TIME_FORMAT_SETTINGS, $time);
}

function show_datetime($sqldatetime){
    $time=  strtotime($sqldatetime);
    $format = DATE_FORMAT_SETTINGS.' '.TIME_FORMAT_SETTINGS;
     echo date($format, $time);
}

function createRedirectURL($url){
    $url = str_replace('&','!',str_replace('=','@',$url));
    return $url;
}

function getURLfromRedirectKey($redirect){
    $redirect = str_replace('!','&',str_replace('@','=',$redirect));
    return $redirect;
}

function pagination($table, $per_page = PAGE_CONTENT_LIMIT, $page = 1, $url = 'abc', $order_by = "", $text="",$where="") {
    
    $query = new query($table);
    if($text!=""){
        $query->Where = $where;
    }
    $get_record = $query->ListOfAllRecords('object');
    $count_record = count($get_record);
    //pr($count_record);
    $adjacents = "2";

    $prevlabel = "&lsaquo; Prev";
    $nextlabel = "Next &rsaquo;";
    $lastlabel = "Last &rsaquo;&rsaquo;";

    $page = ($page == 0 ? 1 : $page);
    if ($page > 1) {
        $start = ($page - 1) * $per_page;
    }
    $per_page = PAGE_CONTENT_LIMIT;
    $startpoint = ($page * $per_page) - $per_page;
    $query1 = new query($table);
    $query1->Where = "";
    if($text!=""){ 
        $query1->Where.= $where;
    }
    if($order_by!="" && $text==""){
        $query1->Where.= ' order by '.$order_by.' ';
    }
    
    $query1->Where.= "LIMIT {$startpoint}, {$per_page}";
    //$query1->print=1;
    $show_record = $query1->ListOfAllRecords('object');
    //pr($show_record);
    $prev = $page - 1;
    $next = $page + 1;
    //$total_records = get_pagination($table);
    //pr($total_records);
    $lastpage = ceil($count_record / $per_page);
   // $urlText = "";
   // if($text!=''){
   //     $urlText = "&content=".$text;
   // }
    $lpm1 = $lastpage - 1; // //last page minus 1
    $lpp1 = $lastpage + 1; // // last page plus 1  
    $pagination = "";
    if ($lastpage > 1) {
        $pagination .= "<ul class='pagination'>";
        $pagination .= "<li class='page_info'>Page {$page} of {$lastpage}</li>";
        if ($page > 1)
            $pagination.= "<li><a href='" . app_url($table, 'list', 'list', array("page_no" => $page - 1,"content"=>$text), TRUE) . "'>{$prevlabel}</a></li>";

        if ($lastpage < 7 + ($adjacents * 2)) {
            for ($counter = 1; $counter <= $lastpage; $counter++) {
                if ($counter == $page)
                    $pagination.= "<li><a href='" . app_url($table, 'list', 'list', array("page_no" => $counter,"content"=>$text), TRUE) . "' class='current'>{$counter}</a></li>";
                else
                    $pagination.= "<li><a href='" . app_url($table, 'list', 'list', array("page_no" => $counter,"content"=>$text), TRUE) . "'>{$counter}</a></li>";
            }
        }elseif ($lastpage > 5 + ($adjacents * 2)) {

            if ($page < 1 + ($adjacents * 2)) {

                for ($counter = 1; $counter < 4 + ($adjacents * 2); $counter++) {
                    if ($counter == $page)
                        $pagination.= "<li><a class='current'>{$counter}</a></li>";
                    else
                        $pagination.= "<li><a href='" . app_url($table, 'list', 'list', array("page_no" => $counter,"content"=>$text), TRUE) . "'>{$counter}</a></li>";
                }
                $pagination.= "<li class='dot'>...</li>";
                $pagination.= "<li><a href='" . app_url($table, 'list', 'list', array("page_no" => $lpm1,"content"=>$text), TRUE) . "'>{$lpm1}</a></li>";
                $pagination.= "<li><a href='" . app_url($table, 'list', 'list', array("page_no" => $lastpage,"content"=>$text), TRUE) . "'>{$lastpage}</a></li>";
            } elseif ($lastpage - ($adjacents * 2) > $page && $page > ($adjacents * 2)) {

                $pagination.= "<li><a href='" . app_url($table, 'list', 'list', array("page_no" => 1,"content"=>$text), TRUE) . "'>1</a></li>";
                $pagination.= "<li><a href='" . app_url($table, 'list', 'list', array("page_no" => 2,"content"=>$text), TRUE) . "'>2</a></li>";
                $pagination.= "<li class='dot'>...</li>";
                for ($counter = $page - $adjacents; $counter <= $page + $adjacents; $counter++) {
                    if ($counter == $page)
                        $pagination.= "<li><a class='current'>{$counter}</a></li>";
                    else
                        $pagination.= "<li><a href='" . app_url($table, 'list', 'list', array("page_no" => $counter,"content"=>$text), TRUE) . "'>{$counter}</a></li>";
                }

                $pagination.= "<li class='dot'>..</li>";
                $pagination.= "<li><a href='" . app_url($table, 'list', 'list', array("page_no" => $lpm1,"content"=>$text), TRUE) . "'>{$lpm1}</a></li>";
                $pagination.= "<li><a href='" . app_url($table, 'list', 'list', array("page_no" => $lastpage,"content"=>$text), TRUE) . "'>{$lastpage}</a></li>";
            } else {
                $pagination.= "<li><a href='" . app_url($table, 'list', 'list', array("page_no" => 1,"content"=>$text), TRUE) . "'>1</a></li>";
                $pagination.= "<li><a href='" . app_url($table, 'list', 'list', array("page_no" => 2,"content"=>$text), TRUE) . "'>2</a></li>";
                $pagination.= "<li class='dot'>..</li>";
                for ($counter = $lastpage - (2 + ($adjacents * 2)); $counter <= $lastpage; $counter++) {
                    if ($counter == $page)
                        $pagination.= "<li><a class='current'>{$counter}</a></li>";
                    else
                        $pagination.= "<li><a href='" . app_url($table, 'list', 'list', array("page_no" => $counter,"content"=>$text), TRUE) . "'>{$counter}</a></li>";
                }
            }
        }


        if ($page < $counter - 1) {
            $pagination.= "<li><a href='" . app_url($table, 'list', 'list', array("page_no" => $page + 1,"content"=>$text), TRUE) . "'>{$nextlabel}</a></li>";
            $pagination.= "<li><a href='" . app_url($table, 'list', 'list', array("page_no" => $lastpage,"content"=>$text), TRUE) . "'>{$lastlabel}</a></li>";
        }

        $pagination.= "</ul>";
    }
    
    return array("show_record" => $show_record, "pagination" => $pagination);
}
