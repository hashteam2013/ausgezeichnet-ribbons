<?php
/*get all districts from district table in register case */
function getDistrict(){
$query = new query('districts');
$query->Where = " order by position";
$get_districts = $query->ListOfAllRecords();
return $get_districts;
}

function show_customers_ribbons($id,$image,$name){
echo '<li id ='.$id.'>
        <div>
            <img src="'.DIR_WS_UPLOADS.'batch/'.$image.'" class="img-responsive">
        </div>
        <span><label><input type="checkbox" class="chkid" value='.$id.'>'.$name.'</label></span>
   </li>';
}

function show_ribbon_images($type, $imgpath, $number, $country, $batch_id) {
    global $app;
    $htmlMsg = "";
    $img = DIR_WS_UPLOADS . 'batch/' . $imgpath;
    if ($type == '0' or $type=='10') {
        $htmlMsg = '<div class="ribbon_outer"><img src="' . $img . '" class="img-responsive"></div>';
    } else if ($type == '1') {
        // Only query if number and batch_id are provided
        if (!empty($number) && !empty($batch_id)) {
            $object_q = new query('batch_images');
            $object_q->Field = "id,batch_image,batch_id,number";
            $object_q->Where = " Where id = ";
            $object_q->Where .= " (SELECT Max(id) from batch_images";
            $object_q->Where .= " Where number = " . intval($number) . " and batch_id = " . intval($batch_id) . ")";
            $number_result = $object_q->DisplayOne();
            if (is_object($number_result)) {
                $htmlMsg = '<div class="ribbon_outer"><img src="' . DIR_WS_UPLOADS . 'batch/' . $number_result->batch_image . '" class="img-responsive"></div>';
            }
        } else {
            // Fallback to default image if number/batch_id not provided
            $htmlMsg = '<div class="ribbon_outer"><img src="' . $img . '" class="img-responsive"></div>';
        }
    } else if ($type == '2') {
        // Only query if batch_id and country are provided
        if (!empty($batch_id) && !empty($country)) {
            $query = new query("batch_images");
            $query->Field = "batch_image";
            $query->Where = " where batch_id = " . intval($batch_id) . " and location_id = " . intval($country);
            $location_result = $query->DisplayOne();
            //pr($location_result);
            if (is_object($location_result)) {
                $htmlMsg = '<div class="ribbon_outer"><img src="' . DIR_WS_UPLOADS . 'batch/' . $location_result->batch_image . '" class="img-responsive"></div>';
            }
        } else {
            // Fallback to default image if batch_id/country not provided
            $htmlMsg = '<div class="ribbon_outer"><img src="' . $img . '" class="img-responsive"></div>';
        }
    }
    return $htmlMsg;
}




function getDistrictRelatedCategoryBatches($cat_id,$district_ids){
    global $app;
    $return = array();
    if(empty($district_ids)){
        $query_one = new query('batch_filter_relation as relation');
        $query_one->Field = "relation.filter_id,relation.batch_id,batch.is_active,batch.webshop_title_" . $app['language'] . " as webshop_title_en,batch.batch_position,o.position,batch.id,batch.ribbon_name_".$app['language']." as name_en,batch.unit_price as unit_price,batch.batch_image,batch.desc_".$app['language']." as desc_en,cat.name_".$app['language']." as name_en,batch.type,bfr.filter_id as org_id,o.name_".$app['language']." as org_name, batch.comment as comment";
        $query_one->Where = " LEFT JOIN batches as batch ON batch.id = relation.batch_id";
        $query_one->Where.= " LEFT JOIN categories as cat ON cat.id = relation.filter_id";
        $query_one->Where.= " LEFT JOIN batch_filter_relation as bfr ON bfr.batch_id = relation.batch_id and bfr.rel_type = 'organizations'";
        $query_one->Where.= " LEFT JOIN organizations as o ON bfr.filter_id = o.id";
        $query_one->Where.= " where relation.filter_id = $cat_id and relation.rel_type = 'categories' order by o.position,org_name, batch.batch_position";
        //$query_one->Where .= " where filter_id = $cat_id and rel_type = 'categories' order by batch_position";
        //$query_one->print=1;
        $return = $query_one->ListOfAllRecords('object');
    } else { 
        $ids_str = implode(",", $district_ids);
        $queryCat = new query('categories');
        $queryCat->Field = "name_".$app['language']." as name_en";
        $queryCat->Where = " where id = $cat_id";
        $catObj = $queryCat->DisplayOne();
        $cat_name_en = "";
        if(is_object($catObj)){
            $cat_name_en = $catObj->name_en;
        }
        $query_one = new query('batch_filter_relation as relation');
        // group to one row per batch; omit non-grouped filter_id to satisfy ONLY_FULL_GROUP_BY
        $query_one->Field = "relation.batch_id,batch.is_active,batch.batch_position,batch.webshop_title_" . $app['language'] . " as webshop_title_en,o.position,batch.id,batch.ribbon_name_".$app['language']." as name_en,batch.batch_image,batch.desc_".$app['language']." as desc_en, batch.unit_price as unit_price, batch.type,bfr.filter_id as org_id,o.name_".$app['language']." as org_name, batch.comment as comment";
        $query_one->Where = " LEFT JOIN batches as batch ON batch.id = relation.batch_id";
        $query_one->Where.= " LEFT JOIN batch_filter_relation as bfr ON bfr.batch_id = relation.batch_id and bfr.rel_type = 'organizations'";
        $query_one->Where.= " LEFT JOIN organizations as o ON bfr.filter_id = o.id";
        $query_one->Where .= " where relation.rel_type = 'districts' and relation.filter_id IN ($ids_str) and relation.batch_id IN";
        $query_one->Where .= " (SELECT r1.batch_id FROM batch_filter_relation as r1 WHERE r1.rel_type = 'categories' and r1.filter_id = '$cat_id`')";
        $query_one->Where .= " GROUP BY relation.batch_id,batch.is_active,batch.batch_position,batch.webshop_title_" . $app['language'] . ",o.position,batch.id,batch.ribbon_name_".$app['language'].",batch.batch_image,batch.desc_".$app['language'].",batch.unit_price,batch.type,bfr.filter_id,o.name_".$app['language'].",batch.comment order by o.position, org_name, batch.batch_position ";
        //$query_one->print=1;
        $return = $query_one->ListOfAllRecords('object');
        foreach($return as $key => $batch){
            $return[$key]->filter_id = $cat_id;
            $return[$key]->name_en = $cat_name_en;
        }
    }
    return $return;
}
?>
