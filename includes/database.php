<?php
$mysqllink = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD,DB_DATABASE) or die("Connection close"); 
/*for french lang storage*/
$mysqllink->set_charset('utf8');
/*end french lang storage*/
/* start -> for max_join_size issue */
mysqli_query($mysqllink, "SET SQL_BIG_SELECTS=1");
/* end -> for max_join_size issue */

$app['mysqllink'] =  $mysqllink;

class Connection {
    var $Recordset, $Query;
    var $PageSize = 0, $AllowPaging = false, $PageNo, $TotalRecords = 0, $TotalPages = 0;
    var $ConRe;

    /* declare constuctor */

    function __construct() {
        global $app;
        $this->ConRe = $app['mysqllink'];
    }

    /* close connection */

    function CloseConnection() {
        //mysql_close($this->ConRe);
    }

    function ExecuteQuery($Query) {
        $this->Query = $Query;
        if ($this->Recordset = mysqli_query($this->ConRe,$Query)) {
            if ($this->AllowPaging and $this->PageSize > 0 and $this->GetNumRows() > 0) {
                $this->TotalRecords = $this->GetNumRows();
                $this->TotalPages = intval($this->TotalRecords / $this->PageSize);

                $this->TotalPages = ($this->TotalRecords % $this->PageSize) > 0 ? $this->TotalPages + 1 : $this->TotalPages;
                $this->PageNo = (empty($this->PageNo) or $this->PageNo == 0) ? 1 : $this->PageNo;
                $this->Query .= " LIMIT " . ($this->PageNo - 1) * $this->PageSize . "," . $this->PageSize;
                if ($this->Recordset = mysqli_query($this->ConRe, $this->Query))
                    return true;
                else {
                    $ParameterArray = array("Query" => $Query,
                        "FunctionName" => "ExecuteQuery");
                    //$this->SendErrorMail(ERROR_EMAIL,mysql_error(),$ParameterArray);
                    //die(ERROR_MESSAGE);
                }
            } else
                return true;
        }
        else {
            $ParameterArray = array("Query" => $Query,
                "FunctionName" => "ExecuteQuery");
            //$this->SendErrorMail(ERROR_EMAIL,mysql_error(),$ParameterArray);
            //die(ERROR_MESSAGE);
        }
    }

    function DbQuery($Query) {
        $resultset = mysqli_query($this->ConRe, $Query);
        if (mysqli_num_rows($resultset) > 0) {
            return mysqli_fetch_assoc($resultset);
        } else {
            return false;
        }
    }

    function GetObjectFromRecord() {
        if ($this->Recordset) {
            if (mysqli_num_rows($this->Recordset) > 0) {
                return mysqli_fetch_object($this->Recordset);
            }
            return false;
        } else {
            $ParameterArray = array("Query" => $this->Query,
                "FunctionName" => "GetObjectFromRecord");
            $this->SendErrorMail(ERROR_EMAIL, mysqli_error($this->ConRe), $ParameterArray);
            die(ERROR_MESSAGE);
        }
    }

    function GetArrayFromRecord() {
        if ($this->Recordset) {
            if (mysqli_num_rows($this->Recordset) > 0) {
                return mysqli_fetch_assoc($this->Recordset);
            } else {
                $ParameterArray = array("Query" => $this->Query,
                    "FunctionName" => "GetArrayFromRecord");
                $this->SendErrorMail(ERROR_EMAIL, mysqli_error($this->ConRe), $ParameterArray);
                die(ERROR_MESSAGE);
            }
        }
    }

    function GetNumRows() {
        if ($this->Recordset) {
            return mysqli_num_rows($this->Recordset);
        } else {
            $ParameterArray = array("Query" => $this->Query,
                "FunctionName" => "GetNumRows");
            $this->SendErrorMail(ERROR_EMAIL, mysqli_error($this->ConRe), $ParameterArray);
            die(ERROR_MESSAGE);
        }
    }

    function SendErrorMail($EmailAddress, $MySQLError, $SupportParms) {
        echo "<font color='Maroon'>$MySQLError</font><br>";
        $Body = "";
        foreach ($SupportParms as $key => $value) {
            $Body .= $key . "===========" . $value . "<br>";
        }
        if (!SendEmail($MySQLError, ERROR_EMAIL, ADMIN_EMAIL, SITE_NAME, $Body))
            echo $Body . "<br><br>" . $MySQLError;
    }

}

;
$conn = new Connection();

class query extends Connection {

    var $TableName;
    var $Data;
    var $Where;
    var $Field = '*';
    var $print = 0;
    var $filter = 1;
    var $restricted_words_in_where;

    function __construct($tablename = '') {
        parent::__construct();
        $this->TableName = $tablename;
        $this->Field = '*';
        $this->Data = array();
        $this->Where = '';
        $this->print = 0;
        $this->restricted_words_in_where = array('insert', 'update', 'delete', '--');
        $this->filter = 1;
    }

    function Insert() {
        $query1 = "INSERT INTO " . $this->TableName . " SET ";
        foreach ($this->Data as $key => $value):
            if ($value != ''):
                if($key == "date_add"){
                    $query1.=$key . "=" . "now()" . ', ';
                } else{
                    $query1.=$key . "=" . "'" . mysqli_real_escape_string($this->ConRe,$value) . "'" . ', ';
                }
            endif;
        endforeach;
        $query = substr($query1, 0, strlen($query1) - 2);
        $this->Query = $query;
        if ($this->print):
            echo $this->Query;
            exit;
        endif;
        if ($this->ExecuteQuery($query)):
            return true;
        else:
            return false;
        endif;
    }

    function Delete() {
        $query = "DELETE FROM " . $this->TableName . " 
		             WHERE id='$this->id'";
        $this->Query = $query;
        if ($this->print):
            echo $this->Query;
            exit;
        endif;

        if ($this->ExecuteQuery($query)):
            $this->CloseConnection();
            return true;
        else:
            return false;
        endif;
    }

    function Delete_where() {
        $query = "DELETE FROM " . $this->TableName . " $this->Where";
        $this->Query = $query;
        if ($this->print):
            echo $this->Query;
            exit;
        endif;
        if ($this->ExecuteQuery($query)):
            $this->CloseConnection();
            return true;
        else:
            return false;
        endif;
    }

    function DisplayAll() {
        if ($this->filter):
            if (!$this->filter_data()):
                echo 'Invalid data submission detected. Please try again.';
                exit;
            endif;
        endif;
        $query = "SELECT $this->Field FROM " . $this->TableName . " $this->Where";
        $this->Query = $query;
        if ($this->print):
            echo $query;
            exit;
        endif;
        if ($this->ExecuteQuery($query)):
            return true;
        else:
            return false;
        endif;
    }

    function DisplayOne($type = 'object') {
        if ($this->filter):
            if (!$this->filter_data()):
                echo 'Invalid data submission detected. Please try again.';
                exit;
            endif;
        endif;

        $query = "SELECT $this->Field FROM " . $this->TableName . " $this->Where";
        $this->Query = $query;
        if ($this->print):
            echo $this->Query;
            exit;
        endif;
        if ($this->ExecuteQuery($query)):
            if ($this->GetNumRows() > 0 && $type == 'object'):
                $object = $this->GetObjectFromRecord();
                $this->CloseConnection();
                return $object;
            elseif ($this->GetNumRows() > 0 && $type != 'object'):
                $object = $this->GetArrayFromRecord();
                $this->CloseConnection();
                return $object;
            else:
                return false;
            endif;
        else:
            return false;
        endif;
    }

    function Update() {
        if ($this->filter):
            if (!$this->filter_data()):
                echo 'Invalid data submission detected. Please try again.';
                exit;
            endif;
        endif;

        $query1 = "UPDATE " . $this->TableName . " SET ";
        $ID = null;
        $hasFields = false;
        foreach ($this->Data as $key => $value):
            if ($key != 'id'):
                $hasFields = true;
                if($value == 'now()'):
                    $query1.=$key . "= NOW(), ";
                elseif ($value == 'NULL'):
                    $query1.=$key . "= NULL , ";
                else:
                    $query1.=$key . "=" . "'" . mysqli_real_escape_string($this->ConRe,$value) . "'" . ', ';
                endif;
            elseif ($key == 'id'):
                $ID = $value;
            endif;
        endforeach;
        
        // If no fields to update (only id was provided), return true without executing query
        if (!$hasFields) {
            return true;
        }
        
        $query = substr($query1, 0, strlen($query1) - 2);
        $query.=' WHERE id=' . $ID;
        $this->Query = $query;
        if ($this->print):
            echo $this->Query;
            exit;
        endif;
        if ($this->ExecuteQuery($query)):
            $this->CloseConnection();
            return true;
        else:
            return false;
        endif;
    }
    function UpdateCustom() {
        // If no data to update, return true without executing query
        if (empty($this->Data)) {
            return true;
        }
        
        $query1 = "UPDATE " . $this->TableName . " SET ";
        $hasFields = false;
        foreach ($this->Data as $key => $value):
            if ($key != 'id'):
                $hasFields = true;
                if($value == 'now()'):
                    $query1.=$key . "= NOW(), ";
                elseif ($value == 'NULL'):
                    $query1.=$key . "= NULL , ";
                else:
                    $query1.=$key . "=" . "'" . mysqli_real_escape_string($this->ConRe,$value) . "'" . ', ';
                endif;
            endif;
        endforeach;
        
        // If no fields to update (only id was provided), return true
        if (!$hasFields) {
            return true;
        }
        
        $query = substr($query1, 0, strlen($query1) - 2);
        $query.=$this->Where;
        $this->Query = $query;
        if ($this->print):
            echo $this->Query;
            exit;
        endif;
        if ($this->ExecuteQuery($query)):
            $this->CloseConnection();
            return true;
        else:
            return false;
        endif;
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

    function InitilizeSQL() {
        $this->TableName = "";
        $this->Data = "";
        $this->Where = "";
        $this->Fields = "*";
        $this->print = 0;
    }

    function count() {
        $query = "select count(*) as total from " . $this->TableName . ' ' . $this->Where;
        if ($this->ExecuteQuery($query)):
            if ($this->GetNumRows() > 0):
                $row = $this->GetObjectFromRecord();
                $this->CloseConnection();
                return $row->total;
            else:
                return false;
            endif;
        else:
            return false;
        endif;
    }

    function filter_data() {
        # Convert all applicable characters to html entities:
#        if (is_array($this->Data)):
#            foreach ($this->Data as $k => $v):
#                if ($v != ''):
#                    $this->Data[$k] = htmlentities($v);
#                endif;
#            endforeach;
#        endif;

        # Check where statement for restricted words:
#        $array = explode(' ', $this->Where);
#        foreach ($array as $k => $v):
#            if (in_array($v, $this->restricted_words_in_where)):
#                return false;
#            endif;
#        endforeach;
        return true;
    }

    function empty_table() {
        $query = "truncate table `" . $this->TableName . "`";
        if ($this->print):
            echo $query;
            exit;
        endif;
        if ($this->ExecuteQuery($query)):
            return true;
        else:
            return false;
        endif;
    }

    function ListOfAllRecords($result_type = 'array') {
        $list = array();
        if ($this->filter):
            if (!$this->filter_data()):
                echo 'Invalid data submission detected. Please try again.';
                exit;
            endif;
        endif;
        $query = "SELECT $this->Field FROM " . $this->TableName . " $this->Where";
        $query = html_entity_decode($query);
        $this->Query = $query;
        if ($this->print):
            echo $query;
            exit;
        endif;
        if ($this->ExecuteQuery($query)):
            if ($this->GetNumRows()):
                if ($result_type == 'array'):
                    while ($obj = $this->GetArrayFromRecord()):
                        array_push($list, $obj);
                    endwhile;
                else:
                    while ($obj = $this->GetObjectFromRecord()):
                        array_push($list, $obj);
                    endwhile;
                endif;
            endif;
        endif;
        $this->CloseConnection();
        return $list;
    }

    function _getObject($table, $id) {
        if ($table != '' && $id != '') {
            $query = "SELECT * FROM " . $table . " Where id='" . mysqli_real_escape_string($this->ConRe, $id) . "'";
            $this->Query = $query;
            if ($this->print):
                echo $query;
                exit;
            endif;
            if ($this->ExecuteQuery($query)):
                if ($this->GetNumRows()):
                    return $this->GetObjectFromRecord();
                endif;
            endif;
        }
        return false;
    }

    function _makeData($array, $required = array()) {
        $finalArray = array();
        foreach ($array as $k => $v) {
            if (in_array($k, $required)) {
                $finalArray[$k] = $v;
            }
        }
        return $finalArray;
    }

    function _sanitize($value) {
        $prohibited_chars = array(" ", "/", "$", "&", "'", '%', '"', "@");
        foreach ($prohibited_chars as $k => $v):
            $value = str_replace($v, '-', $value);
        endforeach;
        return strtolower($value);
    }

};
$QueryObj = new query();