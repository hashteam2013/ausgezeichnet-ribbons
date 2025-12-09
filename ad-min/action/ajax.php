<?php
global $app;
$output = array();
//$output['status'] = "error";
//$output['msg'] = "Error occurred while performing action.";
switch ($action):
    case 'show_image_number':
        $batch_id = (isset($app['POST']['batch_id']) && $app['POST']['batch_id'] != '') ? $app['POST']['batch_id'] : 0;
        if ($batch_id != 0) {
            $query = new query("batches");
            $query->Where = "where id = '" . $batch_id . "'";
            $showing = $query->DisplayOne();
            $query1 = new query('batch_images');
            $query1->Where = "where batch_id = '" . $showing->id . "' and number IN (1,2,3,4,5,6,7,8,9,10,11,12,13,14,15,16,17,18,19,20)";
            $batch_image = $query1->ListOfAllRecords();
            $output['batch_one'] = $batch_image;
        } else {
            $output['status'] = "error";
            $output['msg'] = "Error occurred while choosing batch.";
        }
        break;

    case 'show_image_location':
        $batch_id = (isset($app['POST']['batch_id']) && $app['POST']['batch_id'] != '') ? $app['POST']['batch_id'] : 0;
        if ($batch_id != 0) {

            $query = new query("batches");
            $query->Where = "where id = '" . $batch_id . "'";
            $showing = $query->DisplayOne();

            $query = new query("ribbon_location");
	    $query->Where = " INNER JOIN batch_images ON batch_images.location_id=ribbon_location.id "; 
            $query->Where .= " WHERE batch_images.batch_id = '" . $batch_id . "'";


  //          $query->Where .= " AND ribbon_location.SetID = '" . $showing->SetID . "'";

            $location_ids = $query->ListOfAllRecords();

            $output = $location_ids;
        } else {
            $output['status'] = "error";
            $output['msg'] = "Error occurred while choosing batch.";
        }
        break;
        
        case 'add_organization_list': 
      global $app;
      $depart_id = (isset($app['POST']['depart_id']) && $app['POST']['depart_id'] != '') ? $app['POST']['depart_id'] : 0;
     if($depart_id != 0){
       $query = new query("organizations");
       $query->Field = "id,name_en";
       $query->Where = "where department_id = '".$depart_id."'";
       //$query->print=1;
       $output = $query->ListOfAllRecords();
    }else {
        $output['status'] = "error";
        $output['msg'] = "Error occurred.";
    }
      break;
      
      case 'edit_organization_list': 
      global $app;
      $batch_id = (isset($app['POST']['batch_id']) && $app['POST']['batch_id'] != '') ? $app['POST']['batch_id'] : 0;
      $depart_id = (isset($app['POST']['depart_id']) && $app['POST']['depart_id'] != '') ? $app['POST']['depart_id'] : 0;
      if($depart_id != 0 && $batch_id != 0){
       $query = new query("organizations");
       $query->Field = "id,name_en";
       $query->Where = "where department_id = '".$depart_id."'";
       $output['org_name'] = $query->ListOfAllRecords();
       $querycs = new query("batch_filter_relation");
       $querycs->Field = "batch_id,filter_id";
       $querycs->Where = "where batch_id = $batch_id and rel_type = 'organizations'";
       $output['sel_org'] = $querycs->ListOfAllRecords();
    }else {
        $output['status'] = "error";
        $output['msg'] = "Error occurred.";
    }
      break;
      
      case 'edit_add_cat_sub_list': 
      global $app;
      $batch_id = (isset($app['POST']['batch_id']) && $app['POST']['batch_id'] != '') ? $app['POST']['batch_id'] : 0;
      $add_cat_id = (isset($app['POST']['add_cat_id']) && $app['POST']['add_cat_id'] != '') ? $app['POST']['add_cat_id'] : 0;
      if($add_cat_id != 0 && $batch_id != 0){
       $query = new query("add_cat_sub");
       $query->Field = "id,name_en";
       $query->Where = "where add_cat_id = '".$add_cat_id."'";
       $output['add_cat_sub_name'] = $query->ListOfAllRecords();
       $querycs = new query("batch_filter_relation");
       $querycs->Field = "batch_id,filter_id";
       $querycs->Where = "where batch_id = $batch_id and rel_type = 'add_cat_sub'";
       $output['sel_add_cat_sub'] = $querycs->ListOfAllRecords();
    }else {
        $output['status'] = "error";
        $output['msg'] = "Error occurred.";
    }
      break;


    case 'getSubistrict':
        global $app;
        $dist_id = (isset($app['POST']['q']) && $app['POST']['q'] != '') ? $app['POST']['q'] : 0;
        $query = new query("sub_districts");
        $query->Field = "id,name_en";
        $query->Where = "where is_active = 1 and district_id = '".$dist_id."'";
        $record = $query->ListOfAllRecords();
        if(!empty($record)){
           $output['status'] = "true";
           $output['record'] = $record;
        }else{
            $output['status'] = 'false';
        }
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
        
    case 'getBorough':
        global $app;
        $dist_id = (isset($app['POST']['d_id']) && $app['POST']['d_id'] != '') ? $app['POST']['d_id'] : 0;
        $subdist_id = (isset($app['POST']['s_id']) && $app['POST']['s_id'] != '') ? $app['POST']['s_id'] : 0;
        $comm_id = (isset($app['POST']['c_id']) && $app['POST']['c_id'] != '') ? $app['POST']['c_id'] : 0;
        $query = new query("boroughs as boro");
        $query->Field = "boro.id,boro.name_" . $app['language'] . " as name_en,boro.is_active,boro.dist_id as dist_id,boro.subdist_id as subdist_id,boro.comm_id as comm_id,"
                . "dis.name_" . $app['language'] . " as dist_name,sub.name_" . $app['language'] . " as subdist_name,com.name_" . $app['language'] . " as comm_name";
        $query->Where = " LEFT JOIN districts as dis ON dis.id = boro.dist_id";
        $query->Where .= " LEFT JOIN sub_districts as sub ON sub.id = boro.subdist_id";
        $query->Where .= " LEFT JOIN communities as com ON com.id = boro.comm_id";
        $query->Where .= " where boro.is_active = 1 and boro.dist_id = '" . $dist_id . "' and boro.subdist_id = '" . $subdist_id . "' and boro.comm_id = '".$comm_id."'";
        $record = $query->ListOfAllRecords();
        if (!empty($record)) {
            $output['status'] = "true";
            $output['record'] = $record;
        } else {
            $output['status'] = 'false';
        }
        break;
    
    case 'getinterone':
        global $app;
        $dist_id = (isset($app['POST']['q']) && $app['POST']['q'] != '') ? $app['POST']['q'] : 0;
        $query = new query("international_authorities_sublevel1");
        $query->Field = "id,name_en";
        $query->Where = "where is_active = 1 and ia_id = '".$dist_id."'";
        $record = $query->ListOfAllRecords();
        if(!empty($record)){
           $output['status'] = "true";
           $output['record'] = $record;
        }else{
            $output['status'] = 'false';
        }
        echo json_encode($output);
        exit();
    break;
    
    case 'getia2':
        global $app;
        $ia_id = (isset($app['POST']['d_id']) && $app['POST']['d_id'] != '') ? $app['POST']['d_id'] : 0;
        $ia1_id = (isset($app['POST']['s_id']) && $app['POST']['s_id'] != '') ? $app['POST']['s_id'] : 0;
        $query = new query("international_authorities_sublevel2 as ia2");
        $query->Field = "ia2.id,ia2.name_". $app['language'] . " as name_en,ia2.is_active,ia2.ia_id as ia_id,ia2.ia_lev1_id as ia1_id,"
                . "inter.name_". $app['language'] . " as ia_name,ia2.name_".$app['language']." as ia2_name";
        $query->Where = " LEFT JOIN international_authorities as inter ON inter.id = ia2.ia_id";
        $query->Where .= " LEFT JOIN international_authorities_sublevel1 as inter1 ON inter1.id = ia2.ia_lev1_id";
        $query->Where .= " where ia2.is_active = 1 and ia2.ia_id = '".$ia_id."' and ia2.ia_lev1_id = '".$ia1_id."'";
        $record = $query->ListOfAllRecords();
        if(!empty($record)){
           $output['status'] = "true";
           $output['record'] = $record;
        }else{
           $output['status'] = 'false';
        }
        break;

    default:
	break;
endswitch;
echo json_encode($output);
exit();
