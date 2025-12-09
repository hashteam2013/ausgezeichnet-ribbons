<?php //pr($trust); 
require('fpdf.php');


function listBatchAdmin($show) {
    global $app;
$id = isset($app['GET']['id'])?$app['GET']['id']:"0";

    $output = array();
    $batch_data_store = array();
    $showing_b_id = array();
    $showing_b_id_1 = array();
    $showing_b_id_2 = array();
    $showing_b_id_3 = array();
    $showing_b_id_4 = array();
    $showing_b_id_5 = array();

    $batch_id = new query("users");
    $batch_id->Field = "district,organization,community,subdistrict,department_new";
    $batch_id->Where = " where id = '" . $id . "'";
    $districtID = $batch_id->DisplayOne();

    $userid =$id;
    $Dbatch_id = new query("districts ");
    $Dbatch_id->Field = "name_" . $app['language'] . " as name_en";
    $Dbatch_id->Where = " where id = '" . $districtID->district . "'";
    $DdistrictID = $Dbatch_id->DisplayOne();
    if (!empty($DdistrictID->name_en)) {
        $username_en = $DdistrictID->name_en;
    } else {
        $username_en = '';
    }
    $Departbatch_id = new query("departments_new ");
    $Departbatch_id->Field = "name_" . $app['language'] . " as name_en, serious_level as serious_level";
    $Departbatch_id->Where = " where id = '" . $districtID->department_new . "'";
    $DdeaprtID = $Departbatch_id->DisplayOne();
    if (!empty($DdeaprtID->name_en)) {
        $userdepart_en = $DdeaprtID->name_en;
    } else {
        $userdepart_en = '';
    }
    $Commbatch_id = new query("communities ");
    $Commbatch_id->Field = "name_" . $app['language'] . " as name_en";
    $Commbatch_id->Where = " where id = '" . $districtID->community . "'";
    $CommID = $Commbatch_id->DisplayOne();
    if (!empty($CommID->name_en)) {
        $usercomm_en = $CommID->name_en;
    } else {
        $usercomm_en = '';
    }
    $subbatch_id = new query("sub_districts ");
    $subbatch_id->Field = "name_" . $app['language'] . " as name_en";
    $subbatch_id->Where = " where id = '" . $districtID->subdistrict . "'";
    $subdistrictID = $subbatch_id->DisplayOne();
    if (!empty($subdistrictID->name_en)) {
        $usersubdist_en = $subdistrictID->name_en;
    } else {
        $usersubdist_en = '';
    }


    
    
    /*     * ****** Level 1 for batchtype = 0 ******** */
    $query_1 = new query("batches as batch");
    $query_1->Field = "batch.id as batch_id,batch.batch_image,batch.type,batch.value,"
            . "batch.grade,batch.batch_position,batch.level,batch.ribbon_name_" . $app['language'] . " as ribbon_name_en,bfr.filter_id as depart_id,depart_new.name_" . $app['language'] . " as depart_name,bfr2.filter_id as dist_id,distt.name_" . $app['language'] . " as dist_name,bfr3.filter_id as subdist_id,subdist.name_" . $app['language'] . " as subdist_name,bfr4.filter_id as comm_id,comm.name_" . $app['language'] . " as comm_name,cust.customer_id,cust.id as id,cust.number,cust.country,cust.year";
    $query_1->Where = " LEFT JOIN customer_batches as cust ON batch.id = cust.batch_id";
    $query_1->Where .= " LEFT JOIN batch_filter_relation as bfr ON batch.id = bfr.batch_id and bfr.rel_type = 'departments_new'";
    $query_1->Where .= " LEFT JOIN batch_filter_relation as bfr2 ON batch.id = bfr2.batch_id and bfr2.rel_type = 'districts'";
    $query_1->Where .= " LEFT JOIN batch_filter_relation as bfr3 ON batch.id = bfr3.batch_id and bfr3.rel_type = 'subdistricts'";
    $query_1->Where .= " LEFT JOIN batch_filter_relation as bfr4 ON batch.id = bfr4.batch_id and bfr4.rel_type = 'communities'";
    $query_1->Where .= " LEFT JOIN departments_new as depart_new ON depart_new.id = bfr.filter_id";
    $query_1->Where .= " LEFT JOIN districts as distt ON distt.id = bfr2.filter_id";
    $query_1->Where .= " LEFT JOIN sub_districts as subdist ON subdist.id = bfr3.filter_id";
    $query_1->Where .= " LEFT JOIN communities as comm ON comm.id = bfr4.filter_id";
    $query_1->Where .= " where cust.customer_id = '" . $show . "' and batch.level ='1' order by batch.value asc";
    //$query_1->print=1;
    $showing_b_id_1 = $query_1->ListOfAllRecords();
    //echo "<pre>";print_r($showing_b_id_1);

    /*     * ****** Level 2 for batchtype = 0  ******** */
    $query_2 = new query("batches as batch");
    $query_2->Field = "batch.id as batch_id, orgNmae.name_" . $app['language'] . ",filter.filter_id as dist_id, dist.name_" . $app['language'] . " as dist_name,bfr1.filter_id as depart_id,depart.name_" . $app['language'] . " as depart_name,bfr2.filter_id as comm_id,comm.name_" . $app['language'] . " as comm_name,bfr3.filter_id as subdist_id,subdist.name_" . $app['language'] . " as subdist_name,filter.rel_type,filter1.filter_id as org_id,filter1.rel_type,batch.batch_image,batch.type,batch.value,batch.grade,batch.batch_position,cust.batch_id,batch.level,batch.ribbon_name_" . $app['language'] . " as ribbon_name_en,cust.customer_id,cust.id as id,cust.number,cust.country,cust.year,(CASE WHEN dist.name_" . $app['language'] . " ='" . $username_en . "' THEN 1 ELSE 2 END) as district_level";
    $query_2->Where = " LEFT JOIN customer_batches as cust ON batch.id = cust.batch_id";
    $query_2->Where .= " LEFT JOIN batch_filter_relation as filter ON batch.id = filter.batch_id and filter.rel_type = 'districts' ";
    $query_2->Where .= " LEFT JOIN batch_filter_relation as filter1 ON batch.id = filter1.batch_id and filter1.rel_type = 'organizations' ";
    $query_2->Where .= " LEFT JOIN batch_filter_relation as bfr1 ON batch.id = bfr1.batch_id and bfr1.rel_type = 'departments_new'";
    $query_2->Where .= " LEFT JOIN departments_new as depart ON bfr1.filter_id = depart.id ";
    $query_2->Where .= " LEFT JOIN batch_filter_relation as bfr2 ON batch.id = bfr2.batch_id and bfr2.rel_type = 'communities'";
    $query_2->Where .= " LEFT JOIN communities as comm ON bfr2.filter_id = comm.id ";
    $query_2->Where .= " LEFT JOIN batch_filter_relation as bfr3 ON batch.id = bfr3.batch_id and bfr3.rel_type = 'subdistricts'";
    $query_2->Where .= " LEFT JOIN sub_districts as subdist ON bfr3.filter_id = subdist.id ";
    $query_2->Where .= " LEFT JOIN organizations as orgNmae ON filter1.filter_id = orgNmae.id ";
    $query_2->Where .= " LEFT JOIN districts as dist ON dist.id = filter.filter_id, ";
    $query_2->Where .= " (SELECT distt.name_" . $app['language'] . " as distt_name,MIN(b.value) as min from batches as b"
            . " LEFT JOIN customer_batches as cust ON b.id = cust.batch_id"
            . " LEFT JOIN batch_filter_relation as bfr ON b.id = bfr.batch_id and bfr.rel_type ='districts'"
            . " LEFT JOIN districts as distt ON distt.id = bfr.filter_id"
            . " GROUP BY distt.name_" . $app['language'] . ") x";
    $query_2->Where .= " where dist.name_" . $app['language'] . " = distt_name and cust.customer_id = '" . $show . "' and batch.level ='2' ORDER BY district_level, convert(`min`, decimal),dist.name_" . $app['language'] . ", batch.value";
    //$query_2->print=1;
    $showing_b_id_2 = $query_2->ListOfAllRecords();
    //echo "<pre>";print_r($showing_b_id_2);


    /**     * *****Get all batch from level 3 ******** */
    $showing_b_id_3 = levelTypeThreeAdmin($show, $username_en, $usercomm_en);

    /*     * ******Level 4 AND 5******** */

    $showing_b_id_4 = levelTypeFourAdmin($show, $districtID, $userid, $username_en, $userdepart_en, $usersubdist_en);
    $showing_b_id_5 = levelTypeFiveAdmin($show, $districtID, $userid, $username_en);

    $showing_b_id = array_merge($showing_b_id_1, $showing_b_id_2, $showing_b_id_3, $showing_b_id_4, $showing_b_id_5);

//    if(!empty($showing_b_id)){
//        //echo "<pre>";print_r($showing_b_id);echo "</pre>";
//    foreach ($showing_b_id as $show_data) {
//       
//       $ribbon_type = show_ribbon_images($show_data['type'], $show_data['batch_image'], $show_data['number'], $show_data['country'], $show_data['batch_id']);
//       if (!empty($ribbon_type)) {
//            $output[] = array(
//                'ribbon_name_en' => $show_data['ribbon_name_'.$app['language']],
//                //'custId' => $show_data['id'],
//                'batch_id' => $show_data['batch_id'],
//                'level' => $show_data['level'],
//                'number' => $show_data['number'],
//                'country' => $show_data['country'],
//                'year' => $show_data['year'],
//                'ribbon_type' => $ribbon_type,
//            );
//        }
//    }


    /*     * ******4-10********** */
    $queryMax = new query("customer_batches as cBatch");
    $queryMax->Field = "id,customer_id,batch_id,type,number,country";
    $queryMax->Where .= " where cBatch.customer_id = '" . $show . "'";
    $querycust = $queryMax->ListOfAllRecords();
    $type = $typesort = array();
    foreach ($showing_b_id as $k => $v) {
        if ($v['type'] == '1') {
            $type[] = $v['batch_id'];
        }
    }
    $key_record = array_unique($type);
    foreach ($key_record as $v) {
        if (!in_array_r($v, $typesort)) {
            $typesort[$v] = array();
        }
        foreach ($showing_b_id as $key => $value) {//pr($value,false);
            if ($value['batch_id'] == $v) {
                $typesort[$v][$value['id']] = $value['number'];
            }
        }
        $typesort[$v] = array_search(max($typesort[$v]), $typesort[$v]);
        
    }
    //echo "<pre>";print_r($showing_b_id);
    if (!empty($showing_b_id)) {
        foreach ($showing_b_id as $show_data) {
            $ribbon_type = show_ribbon_images($show_data['type'], $show_data['batch_image'], $show_data['number'], $show_data['country'], $show_data['batch_id']);
            if ($show_data['type'] == 1) {
                if (in_array($show_data['id'], $typesort)) {
                    if (!empty($ribbon_type)) {
                        $output[] = array(
                            'ribbon_name_en' => $show_data['ribbon_name_en'],
                            'batch_id' => $show_data['batch_id'],
                            'level' => $show_data['level'],
                            'value' => $show_data['value'],
                            'grade' => $show_data['grade'],
                            'number' => $show_data['number'],
                            'depart_id' => isset($show_data['depart_id']) ? $show_data['depart_id'] : '',
                            'dist_id' => isset($show_data['dist_id']) ? $show_data['dist_id'] : '',
                            'subdist_id' => isset($show_data['subdist_id']) ? $show_data['subdist_id'] : '',
                            'comm_id' => isset($show_data['comm_id']) ? $show_data['comm_id'] : '',
                            'country' => $show_data['country'],
                            'year' => $show_data['year'],
                            'ribbon_type' => $ribbon_type,
                        );
                    }
                }
            } else if ($show_data['type'] == 0 || $show_data['type'] == 2) {
                if (!empty($ribbon_type)) {
                    $output[] = array(
                        'ribbon_name_en' => $show_data['ribbon_name_en'],
                        'batch_id' => $show_data['batch_id'],
                        'level' => $show_data['level'],
                        'value' => $show_data['value'],
                        'grade' => $show_data['grade'],
                        'number' => $show_data['number'],
                        'depart_id' => isset($show_data['depart_id']) ? $show_data['depart_id'] : '',
                        'dist_id' => isset($show_data['dist_id']) ? $show_data['dist_id'] : '',
                        'subdist_id' => isset($show_data['subdist_id']) ? $show_data['subdist_id'] : '',
                        'comm_id' => isset($show_data['comm_id']) ? $show_data['comm_id'] : '',
                        'country' => $show_data['country'],
                        'year' => $show_data['year'],
                        'ribbon_type' => $ribbon_type,
                    );
                }
            }
        }
        //pr($output);
        /* start presorting */
        $allowed_max;
        $presortedElements;
        $highclass;
        $query_pre = new query("users as usr");
        $query_pre->Field = "usr.id as userid,usr.department_new,depart.max_ribbon as depart_max,depart.is_allowed as depart_class,usr.district,dist.max_ribbon as dist_max,dist.is_allowed as dist_class";
        $query_pre->Where .= " LEFT JOIN departments_new as depart ON depart.id = usr.department_new";
        $query_pre->Where .= " LEFT JOIN districts as dist ON dist.id = usr.district";
        $query_pre->Where .= " where usr.id = '" . $id . "'";
        //$query_pre->print=1;
        $presort = $query_pre->DisplayOne();
        $match_arr = $recordd = $common_arr = array();
    /**    if ($presort->depart_class == '1' || $presort->dist_class == '1') {
            //echo "hii";exit();
            foreach ($output as $k => $v) {
                $min = 0;
                $change = 0;
                foreach ($output as $kk => $vv) {
                    if ($v['depart_id'] == $vv['depart_id'] && $v['dist_id'] == $vv['dist_id'] && $v['subdist_id'] == $vv['subdist_id'] && $v['comm_id'] == $vv['comm_id'] && $v['grade'] == $vv['grade']) {
                        $common_arr[] = $vv['batch_id'];
                        $key = $v['depart_id'] . "_" . "_" . $v['dist_id'] . "_" . $v['subdist_id'] . "_" . $v['comm_id']. "_" . $v['grade'];
                        $match_arr[$key][$vv['batch_id']] = $vv['value'];
                    }
                }
                $change ++;
            }
            //echo "hello";exit();
            //pr($match_arr);
            $ckey = array();
            foreach ($match_arr as $k => $v) {
                $ckey[] = array_keys($v, min($v));
            }
            $arr = array_map("array_keys", $ckey);
            $arr = array_reduce($ckey, "array_merge", array());
            foreach ($output as $k => $v) {
                if (!in_array($v['batch_id'], $common_arr)) {
                    $recordd[] = $v;
                }
                if (in_array($v['batch_id'], $arr)) {
                    $recordd[] = $v;
                }
            }
            $output = $recordd;
        } **/
        
        
        //pr($recordd);
        if ($presort->depart_max < $presort->dist_max) {
            $allowed_max = $presort->depart_max;
        } else {
            $allowed_max = $presort->dist_max;
        }
        //echo $allowed_max;
        $presortedElements = array_slice($output, 0, $allowed_max);
        //print_r($presortedElements);
        return $presortedElements;
        /* End presorting */
    }
}

/* * *****************************have to select atleast one district for batchtype = 0 ************************************************ */

function levelTypeThreeAdmin($show, $username_en, $usercomm_en) {
    global $app;
    $query_3 = new query("batches as batch");
    $query_3->Field = "batch.id as batch_id,commBatch.filter_id as cat_id,cName.id as com_id,cName.name_" . $app['language'] . " as community,bfr1.filter_id as depart_id,depart.name_" . $app['language'] . " as depart_name,distName.id as dist_id,distName.name_" . $app['language'] . " as dist,bfr2.filter_id as subdist_id,subdist.name_" . $app['language'] . " as subdist_name,commBatch.rel_type,batch.id,batch.level,batch.value,batch.batch_image,batch.type,batch.value,"
            . "batch.grade,batch.batch_position,"
            . "batch.ribbon_name_" . $app['language'] . " as ribbon_name_en,cust.id as id,cust.number,cust.country,cust.year,(CASE WHEN distName.name_" . $app['language'] . " ='" . $username_en . "' THEN 1 ELSE 2 END) as homedist,(CASE WHEN cName.name_" . $app['language'] . " ='" . $usercomm_en . "' THEN 1 ELSE 2 END) as homecomm";
    $query_3->Where .= " LEFT JOIN batch_filter_relation as distBatch ON batch.id = distBatch.batch_id and distBatch.rel_type ='districts'";
    $query_3->Where .= " LEFT JOIN districts as distName ON distName.id = distBatch.filter_id";
    $query_3->Where .= " LEFT JOIN batch_filter_relation as commBatch ON batch.id = commBatch.batch_id and commBatch.rel_type = 'communities'";
    $query_3->Where .= " LEFT JOIN communities as cName ON cName.id = commBatch.filter_id";
    $query_3->Where .= " LEFT JOIN batch_filter_relation as bfr1 ON batch.id = bfr1.batch_id and bfr1.rel_type = 'departments_new'";
    $query_3->Where .= " LEFT JOIN departments_new as depart ON depart.id = bfr1.filter_id";
    $query_3->Where .= " LEFT JOIN batch_filter_relation as bfr2 ON batch.id = bfr2.batch_id and bfr2.rel_type = 'subdistricts'";
    $query_3->Where .= " LEFT JOIN sub_districts as subdist ON subdist.id = bfr2.filter_id";
    $query_3->Where .= " LEFT JOIN customer_batches as cust ON batch.id = cust.batch_id,";
    $query_3->Where .= " (SELECT b.id,b.value,distt.name_" . $app['language'] . " as District,MIN(b.value) as minimum_value from batches as b"
            . " LEFT JOIN batch_filter_relation as bfr ON b.id = bfr.batch_id and bfr.rel_type ='districts'"
            . " LEFT JOIN customer_batches as cust ON b.id = cust.batch_id"
            . " LEFT JOIN districts as distt ON distt.id = bfr.filter_id"
            . " where cust.customer_id = " . $show . " and b.level ='3' GROUP BY distt.name_" . $app['language'] . ") as x";
    $query_3->Where .= " where cust.customer_id = '" . $show . "' and batch.level ='3' and x.District = distName.name_" . $app['language'] . " order by convert(x.minimum_value, decimal),batch.value,community";
    //$query_3->print=1;
    $level3 = $query_3->ListOfAllRecords();
    //print_r($level3);
    $arr3 = $arr_com = $finalArr3 = $sorted = $finalsorted = array();
    foreach ($level3 as $lev3) {
        $arr3[] = $lev3['dist'];
    }
    $key_record = array_unique($arr3);
    $listsort3 = array();
    foreach ($key_record as $v) {
        if (!in_array_r($v, $listsort3)) {
            $listsort3[$v] = array();
        }
        foreach ($level3 as $key => $value) {
            if ($value['dist'] == $v) {
                $listsort3[$v][] = $value;
            }
        }
    }
    $newalpha_arr = array();
    foreach ($listsort3 as $k => $v) {
        foreach ($v as $key => $value) {
            $alpha = substr($value['community'], 0, 1);
            $newalpha_arr[$alpha][] = $value;
        }
    }
    foreach ($newalpha_arr as $s) {
        foreach ($s as $v) {
            $sorted[] = $v;
        }
    }
    /*     * *** */
    $match_arr = array();
    $not_match_arr = array();
    foreach ($sorted as $k => $value) {
        if ($value['dist'] == $username_en) {
            $match_arr[$k] = $value;
        } else {
            $not_match_arr[$k] = $value;
        }
    }
    $sorted = $match_arr + $not_match_arr;
    foreach ($sorted as $k => $v) {
        //echo "<pre>";print_r($usercomm_en);
        if ($v['community'] == $usercomm_en) {
            unset($sorted[$k]);
            array_unshift($sorted, $v);
        }
    }
    foreach ($sorted as $data1) {
        $finalArr3[] = $data1;
    }
    //echo "**************************";
    //echo "<pre>";print_r($finalArr3);
    /*     * ***not having district merge them ************* */
    $query_31 = new query("batches as batch");
    $query_31->Field = "commBatch.filter_id as cat_id,cName.id as comm_id,cName.name_" . $app['language'] . " as community,bfr1.filter_id as depart_id,depart.name_" . $app['language'] . " as depart_name,bfr2.filter_id as subdist_id,subdist.name_" . $app['language'] . " as subdist_name,commBatch.rel_type,batch.id,batch.value,batch.level,batch.batch_image,batch.type,batch.value,"
            . "batch.grade,batch.batch_position,"
            . "batch.ribbon_name_" . $app['language'] . " as ribbon_name_en,batch.level,cust.id as id,cust.number,cust.country,cust.year,distName.name_" . $app['language'] . " as dist";
    $query_31->Where .= " LEFT JOIN batch_filter_relation as distBatch ON batch.id = distBatch.batch_id and distBatch.rel_type ='districts'";
    $query_31->Where .= " LEFT JOIN districts as distName ON distName.id = distBatch.filter_id";
    $query_31->Where .= " LEFT JOIN batch_filter_relation as commBatch ON batch.id = commBatch.batch_id and commBatch.rel_type = 'communities'";
    $query_31->Where .= " LEFT JOIN communities as cName ON cName.id = commBatch.filter_id";
    $query_31->Where .= " LEFT JOIN batch_filter_relation as bfr1 ON batch.id = bfr1.batch_id and bfr1.rel_type = 'departments_new'";
    $query_31->Where .= " LEFT JOIN departments_new as depart ON depart.id = bfr1.filter_id";
    $query_31->Where .= " LEFT JOIN batch_filter_relation as bfr2 ON batch.id = bfr2.batch_id and bfr2.rel_type = 'subdistricts'";
    $query_31->Where .= " LEFT JOIN sub_districts as subdist ON subdist.id = bfr2.filter_id";
    $query_31->Where .= " LEFT JOIN customer_batches as cust ON batch.id = cust.batch_id";
    $query_31->Where .= " where cust.customer_id = '" . $show . "' and batch.level ='3' and distName.name_" . $app['language'] . " IS NULL order by batch.value";
    $distblank = $query_31->ListOfAllRecords();
    $finalResult = array_merge($finalArr3, $distblank);
    return $finalResult;
}

/* * ********************level 4 for batchtype = 0 ************************* */

function in_array_rAdmin($needle, $haystack, $strict = false) {
    if (is_array($haystack)) {
        foreach ($haystack as $item) {
            if (($strict ? $item === $needle : $item == $needle) || (is_array($item) && in_array_rAdmin($needle, $item, $strict))) {
                return true;
            }
        }
    }
    return false;
}

/**   Level 4 for batchtype = 0  * */
function levelTypeFourAdmin($show, $districtID, $userid, $username_en, $userdepart_en, $usersubdist_en) {
    global $app;
    $query_4 = new query("batches as batch");
    $query_4->Field = " batch.id as batch_id,batch.value,"
            . "batch.grade,batch.ribbon_name_" . $app['language'] . " as ribbon_name_en,batch.level,batch.type,batch.batch_image,cust.number,depart.position as depart_pos,cust.country,cust.id as id,cust.year,depart.id as depart_id,depart.name_" . $app['language'] . " as department, ds.id as dist_id,ds.name_" . $app['language'] . " as distname ,sbds.id as subdist_id,sbds.name_" . $app['language'] . " as subdist,comm.id as comm_id,comm.name_" . $app['language'] . " as comm_name";
    $query_4->Where = " LEFT JOIN customer_batches as cust ON batch.id = cust.batch_id";
    $query_4->Where .= " LEFT JOIN batch_filter_relation as filter1 ON batch.id = filter1.batch_id and filter1.rel_type = 'departments_new' ";
    $query_4->Where .= " LEFT JOIN batch_filter_relation as dist ON dist.batch_id = cust.batch_id and dist.rel_type='districts' ";
    $query_4->Where .= " LEFT JOIN batch_filter_relation as sbdist ON sbdist.batch_id = cust.batch_id and sbdist.rel_type='subdistricts' ";
    $query_4->Where .= " LEFT JOIN sub_districts as sbds ON sbds.id = sbdist.filter_id ";
    $query_4->Where .= " LEFT JOIN batch_filter_relation as bfr1 ON bfr1.batch_id = cust.batch_id and bfr1.rel_type='communities' ";
    $query_4->Where .= " LEFT JOIN communities as comm ON comm.id = bfr1.filter_id ";
    $query_4->Where .= " LEFT JOIN districts as ds ON ds.id = dist.filter_id ";
    $query_4->Where .= " LEFT JOIN departments_new as depart ON depart.id = filter1.filter_id ";
    $query_4->Where .= " where cust.customer_id = '" . $show . "' and batch.level ='4' order by depart_pos, subdist,  distname, batch.value";

    $records = $query_4->ListOfAllRecords();

if(empty($records))
{
	return $records ;
}


 //    get minimum values from array if having same dist,depart and subdist 
$queryList= array();
$departmentIDList = array();


$records_size=count($records);


//build query list and department list
    
$queryList[] = $records[0];
//$departmentIDList[]=$districtID->department_new;    
//$departmentIDList[]=$records[0]['depart_id'];

if($records_size>1)
{

    for ($i=1;$i<=$records_size-1;$i++)
    {

        if (($records[$i]['depart_id']!=$records[$i-1]['depart_id']) || ($records[$i]['dist_id']!=$records[$i-1]['dist_id']) || ($records[$i]['subdist_id']!=$records[$i-1]['subdist_id']))
        {
            $queryList[] = $records[$i];

        }
    }
    
    
    
    $departmentIDList[0]= $records[0]['depart_id'];
    for ($i=0;$i<=$records_size-1;$i++)
    {
        if($records[$i]['depart_id']==$districtID->department_new)
        {
            $departmentIDList[0]=$districtID->department_new; 
            break;
        }
    }  
    
    for ($i=0;$i<=$records_size-1;$i++)
    {

        if($records[$i]['depart_id']!=$departmentIDList[count($departmentIDList)-1] && $records[$i]['depart_id']!=$departmentIDList[0])
        {
            $departmentIDList[]=$records[$i]['depart_id'];
        }
    } 


}
else
{
     return $queryList;
}


    //sort query list by department and values -> queryList2
    $queryList2 = $queryList;
    usort($queryList2,"compare_ribbon_departmentAndValueAdmin");
    
    
    
$queryList=array();
    if(!empty($districtID->subdistrict))
    {
        $usersubdistrict=$districtID->subdistrict;
    }
    else
    {
        $usersubdistrict=0;
    }
    
    //query all items by department list and split to sublevels

    
    foreach($departmentIDList as $depID)
    {
    $queryListNational= array();
    $queryListDistrict= array();
    $queryListDistrict2=array();
    $queryListSubdistrict= array();
    
        foreach($queryList2 as $queryItem)
        {
            if($queryItem['depart_id']==$depID)
            {
                if ($queryItem['dist_id']==0)
                {
                    $queryListNational[] = $queryItem;
                }
                elseif ($queryItem['subdist_id']==0)
                {
                    if($queryItem['dist_id']==$districtID)
                    {
                        $queryListDistrict2[]=$queryItem;
                    }
                   else
                  {
                        $queryListDistrict[] = $queryItem;
                    }
                

                }
                else 
                {
                    $queryListSubdistrict[] = $queryItem;
                }
            }         
        }
        
        
        
        $queryListSubdistrict2=array();
        $queryListSubdistrict3=array();
        
        
        
        
        if (!empty($queryListSubdistrict))
        {
            $districtList=array(); 

 
            if ($districtID->district!=0)
            {
                $districtList[]=$districtID->district;
            }
            else
            {
                $districtList[] = $queryListSubdistrict[0]['dist_id'];
            }

            foreach($queryListSubdistrict as $subdistrictItem)
            {
                $add=true;
                foreach($districtList as $districtID)
                {
                    if($districtID==$subdistrictItem['dist_id'])
                    {
                        $add=false;
                        break;
                    }
                }
                if ($add==true)
                {$districtList[]=$subdistrictItem['dist_id'];}
            }
                


            foreach($districtList as $districtID)
            {
                foreach($queryListSubdistrict as $subdistrictItem)
                {   

                    
                    if($districtID==$subdistrictItem['dist_id'] && $usersubdistrict!=$subdistrictItem['subdist_id'])
                    {
                        $queryListSubdistrict2[]=$subdistrictItem;
                    }
                    elseif($districtID==$subdistrictItem['dist_id'] && $usersubdistrict==$subdistrictItem['subdist_id'])
                    {
                        $queryListSubdistrict3[] = $subdistrictItem;
                    }
            
                }
            }
            
        }
        

        $queryList = array_merge($queryList,$queryListNational,$queryListDistrict2,$queryListDistrict,$queryListSubdistrict3,$queryListSubdistrict2);

     
    }
    

    
    // Start Loop through that list. Query every element in that list from List#1 by Department and District and insert the results.

    $merge2_1final = array();
    
    
    if (!empty($queryList) && !empty($records))
    {
        foreach ($queryList as $queryItem)
        {
            foreach ($records as $recordItem) {
                if ($recordItem['depart_id'] == $queryItem['depart_id'] && $recordItem['dist_id'] == $queryItem['dist_id'] && $recordItem['subdist_id'] == $queryItem['subdist_id'])
                {
                    $merge2_1final[] = $recordItem;
                }
            }
        }

    }


    return $merge2_1final;
}



  function compare_ribbon_departmentAndValueAdmin($ribbon1, $ribbon2)
  {
    // sort by department Position
      
    if($ribbon1['depart_pos'] > $ribbon2['depart_pos'])
    {
        return 1;
    }
    else if ($ribbon1['depart_pos'] < $ribbon2['depart_pos'])
    {
            return -1;
    }
      
      
      
    if($ribbon1['value'] > $ribbon2['value'])
    {
        return 1;
    }
    else if ($ribbon1['value'] < $ribbon2['value'])
    {
            return -1;
    }
      
        if (strcmp($ribbon1['distname'], $ribbon2['distname']) != 0){return strcmp($ribbon1['distname'], $ribbon2['distname']);}
        if (strcmp($ribbon1['subdist'], $ribbon2['subdist']) != 0){return strcmp($ribbon1['subdist'], $ribbon2['subdist']);}      
      
      
    return 0;
      
}
      
function compare_ribbon_ValueAdmin($ribbon1, $ribbon2)
  {
      
    if($ribbon1['value'] > $ribbon2['value'])
    {
        return 1;
    }
    else if ($ribbon1['value'] < $ribbon2['value'])
    {
            return -1;
    }
      
    return 0;
      
}
   





function levelTypeFiveAdmin($show, $districtID, $userid, $DdistrictID) {
    global $app;
    $query_5 = new query("batches as batch");
    $query_5->Field = "batch.id as batch_id,batch.batch_image,batch.value,"
            . "batch.grade,batch.level,batch.ribbon_name_" . $app['language'] . " as ribbon_name_en,Inter.name_" . $app['language'] . " as inter,Inter1.name_" . $app['language'] . " as intersublevel1,Inter2.name_" . $app['language'] . " as intersublevel2,batch.type,orgNmae.name_" . $app['language'] . " as ORGANIZATION,ds.id as dist_id,ds.name_" . $app['language'] . " as distname,depart.id as depart_id,depart.name_" . $app['language'] . " as depart_name,subdist.id as subdist_id,subdist.name_" . $app['language'] . " as subdist_name,comm.id as comm_id,comm.name_" . $app['language'] . " as comm_name,cust.customer_id,cust.id as id,cust.number,cust.country,cust.year ";
    $query_5->Where = " LEFT JOIN customer_batches as cust ON batch.id = cust.batch_id";
    $query_5->Where .= " LEFT JOIN batch_filter_relation as org ON batch.id = org.batch_id and org.rel_type='ia'";
    $query_5->Where .= " LEFT JOIN international_authorities as Inter ON Inter.id = org.filter_id";
    $query_5->Where .= " LEFT JOIN batch_filter_relation as ia1_bfr ON batch.id = ia1_bfr.batch_id and ia1_bfr.rel_type='ia_lev1'";
    $query_5->Where .= " LEFT JOIN international_authorities_sublevel1 as Inter1 ON Inter1.id = ia1_bfr.filter_id";
    $query_5->Where .= " LEFT JOIN batch_filter_relation as ia2_bfr ON batch.id = ia2_bfr.batch_id and ia2_bfr.rel_type='ia_lev2'";
    $query_5->Where .= " LEFT JOIN international_authorities_sublevel2 as Inter2 ON Inter2.id = ia2_bfr.filter_id";
    $query_5->Where .= " LEFT JOIN batch_filter_relation as filter1 ON batch.id = filter1.batch_id and filter1.rel_type='organizations'";
    $query_5->Where .= " LEFT JOIN organizations as orgNmae ON filter1.filter_id = orgNmae.id ";
    $query_5->Where .= " LEFT JOIN batch_filter_relation as dist ON dist.batch_id = cust.batch_id and dist.rel_type='districts' ";
    $query_5->Where .= " LEFT JOIN districts as ds ON ds.id = dist.filter_id ";
    $query_5->Where .= " LEFT JOIN batch_filter_relation as bfr1 ON bfr1.batch_id = cust.batch_id and bfr1.rel_type='departments_new' ";
    $query_5->Where .= " LEFT JOIN departments_new as depart ON depart.id = bfr1.filter_id ";
    $query_5->Where .= " LEFT JOIN batch_filter_relation as bfr2 ON bfr2.batch_id = cust.batch_id and bfr2.rel_type='subdistricts' ";
    $query_5->Where .= " LEFT JOIN sub_districts as subdist ON subdist.id = bfr2.filter_id ";
    $query_5->Where .= " LEFT JOIN batch_filter_relation as bfr3 ON bfr3.batch_id = cust.batch_id and bfr3.rel_type='communities' ";
    $query_5->Where .= " LEFT JOIN communities as comm ON comm.id = bfr3.filter_id ";
    $query_5->Where .= " where cust.customer_id = '" . $show . "'  and org.rel_type='ia' and batch.level = '5' order by batch.value";
    //$query_5->print=1;
    $records = $query_5->ListOfAllRecords();
    //pr($records);

    /* get minimum values from array if having same dist,depart and subdist */
    $match_arr = $recordd = $common_arr = array();
    foreach ($records as $k => $v) {
        //print_r($v);
        $min = 0;
        $change = 0;
        foreach ($records as $kk => $vv) {
            //echo "<pre>";print_r($vv);exit();
            if ($v['inter'] == $vv['inter'] && $v['intersublevel1'] == $vv['intersublevel1'] && $v['intersublevel2'] == $vv['intersublevel2'] && $k != $kk) {
                $common_arr[] = $vv['batch_id'];
                $key = $v['inter'] . "_" . "_" . $v['intersublevel1'] . "_" . $v['intersublevel2'];
                $match_arr[$key][$vv['batch_id']] = $vv['value'];
            }
        }
        $change ++;
    }
    $ckey = array();
    foreach ($match_arr as $k => $v) {
        $ckey[] = array_keys($v, min($v));
    }
    $arr = array_map("array_keys", $ckey);
    $arr = array_reduce($ckey, "array_merge", array());
    foreach ($records as $k => $v) {
        if (!in_array($v['batch_id'], $common_arr)) {
            $recordd[] = $v;
        }
        if (in_array($v['batch_id'], $arr)) {
            $recordd[] = $v;
        }
    }
    //echo "<pre>";pr($recordd);

    /* separate recordd to three lists */
    $list1 = $list2 = $list3 = $list4 = array();
    if (!empty($recordd)) {
        foreach ($recordd as $key => $record) {
            $record['row_number'] = $key;
            if (!empty($record['intersublevel2'])) {
                $list1[] = $record;
            }if (empty($record['intersublevel2']) && (!empty($record['intersublevel1']))) {
                $list2[] = $record;
            }if (empty($record['intersublevel1'])) {
                $list3[] = $record;
            }
        }
    }
//        echo "<pre>";print_r($list1);
//        echo "*******************";
//        echo "<pre>";print_r($list2);
//        echo "|||||||||||||||||||||";
//        echo "<pre>";print_r($list3);
    $list2final = $list2;

    /*     * ******** */
    $finallArr1 = $finallArr2 = array();
    //echo "<pre>";print_r($list1);
    if (!empty($list1)) {
        $finallArr1 = $list1;
    }
    if (!empty($list2final)) {
        $finallArr2 = $list2final;
    }
    $finallArr3 = array();

//      echo "<pre>";print_r($list3);
//     echo "++++++++++++++++++";
//     echo "<pre>";print_r($finallArr2);

    if (!empty($finallArr2) || !empty($list3)) {
        foreach ($finallArr2 as $i => $j) {
            foreach ($list3 as $ii => $jj) {
                if ($jj['inter'] == $j['inter']) {
                    $finallArr3[] = $jj;
                    unset($list3[$ii]);
                }
            }
            $finallArr3[] = $j;
        }
        foreach ($list3 as $k => $v) {
            $finallArr3[] = $v;
        }
    }
//     echo "<pre>";print_r($finallArr3);
//     echo "++++++++++++++++++";
//     echo "<pre>";print_r($finallArr1);

    $merge2_1final = array();
    if (!empty($finallArr3) || !empty($finallArr1)) {
        foreach ($finallArr3 as $ii => $jj) {
            $merge2_1final[] = $jj;
            if (!empty($finallArr1)) {
                foreach ($finallArr1 as $i => $j) {
                    //echo "<pre>";print_r($merge2_3as);
                    if ($j['inter'] == $jj['inter'] && $j['intersublevel1'] == $jj['intersublevel1']) {
                        $merge2_1final[] = $j;
                        unset($finallArr1[$i]);
                    }
                }
            }
        }
    }
    $merge2_1final = array_merge($merge2_1final, $finallArr1);
    //echo "<pre>";print_r($merge2_1final);

    $query_5_2 = new query("batches as batch");
    $query_5_2->Field = "batch.id as batch_id,batch.batch_image,batch.value,"
            . "batch.grade,batch.level,batch.ribbon_name_" . $app['language'] . " as ribbon_name_en,Inter.name_" . $app['language'] . " as inter,Inter1.name_" . $app['language'] . " as intersublevel1,Inter2.name_" . $app['language'] . " as intersublevel2,batch.type,orgNmae.name_" . $app['language'] . " as ORGANIZATION,ds.id as dist_id,ds.name_" . $app['language'] . " as distname,depart.id as depart_id,depart.name_" . $app['language'] . " as depart_name,subdist.id as subdist_id,subdist.name_" . $app['language'] . " as subdist_name,comm.id as comm_id,comm.name_" . $app['language'] . " as comm_name,cust.customer_id,cust.id as id,cust.number,cust.country,cust.year ";
    $query_5_2->Where = " LEFT JOIN customer_batches as cust ON batch.id = cust.batch_id";
    $query_5_2->Where .= " LEFT JOIN batch_filter_relation as org ON batch.id = org.batch_id and org.rel_type='ia'";
    $query_5_2->Where .= " LEFT JOIN international_authorities as Inter ON Inter.id = org.filter_id";
    $query_5_2->Where .= " LEFT JOIN batch_filter_relation as ia1_bfr ON batch.id = ia1_bfr.batch_id and ia1_bfr.rel_type='ia_lev1'";
    $query_5_2->Where .= " LEFT JOIN international_authorities_sublevel1 as Inter1 ON Inter1.id = ia1_bfr.filter_id";
    $query_5_2->Where .= " LEFT JOIN batch_filter_relation as ia2_bfr ON batch.id = ia2_bfr.batch_id and ia2_bfr.rel_type='ia_lev2'";
    $query_5_2->Where .= " LEFT JOIN international_authorities_sublevel2 as Inter2 ON Inter2.id = ia2_bfr.filter_id";
    $query_5_2->Where .= " LEFT JOIN batch_filter_relation as filter1 ON batch.id = filter1.batch_id and filter1.rel_type='organizations'";
    $query_5_2->Where .= " LEFT JOIN organizations as orgNmae ON filter1.filter_id = orgNmae.id ";
    $query_5_2->Where .= " LEFT JOIN batch_filter_relation as dist ON dist.batch_id = cust.batch_id and dist.rel_type='districts' ";
    $query_5_2->Where .= " LEFT JOIN districts as ds ON ds.id = dist.filter_id ";
    $query_5_2->Where .= " LEFT JOIN batch_filter_relation as bfr1 ON bfr1.batch_id = cust.batch_id and bfr1.rel_type='departments_new' ";
    $query_5_2->Where .= " LEFT JOIN departments_new as depart ON depart.id = bfr1.filter_id ";
    $query_5_2->Where .= " LEFT JOIN batch_filter_relation as bfr2 ON bfr2.batch_id = cust.batch_id and bfr2.rel_type='subdistricts' ";
    $query_5_2->Where .= " LEFT JOIN sub_districts as subdist ON subdist.id = bfr2.filter_id ";
    $query_5_2->Where .= " LEFT JOIN batch_filter_relation as bfr3 ON bfr3.batch_id = cust.batch_id and bfr3.rel_type='communities' ";
    $query_5_2->Where .= " LEFT JOIN communities as comm ON comm.id = bfr3.filter_id ";
    $query_5_2->Where .= " where cust.customer_id = '" . $show . "'  and org.rel_type='ia' and batch.level = '5' order by batch.value";
    $final_record = $query_5_2->ListOfAllRecords();

    /** get eleminated items * */
    $eleminated_items = array();
    foreach ($final_record as $data1) {
        $duplicate = false;
        foreach ($merge2_1final as $data2) {
            if ($data1['batch_id'] === $data2['batch_id'] && $data1['value'] === $data2['value'] && $data1['inter'] === $data2['inter'] && $data1['intersublevel1'] === $data2['intersublevel1'] && $data1['intersublevel2'] === $data2['intersublevel2']) {
                $duplicate = true;
            }
        }
        if ($duplicate === false)
            $eleminated_items[] = $data1;
    }

//        echo "<pre>";print_r($merge2_1final);
//        echo "**********";
//        echo "<pre>";print_r($eleminated_items);

    /** append eleminated items on merge2_1 * */
    $final_result = array();
    foreach ($merge2_1final as $k => $v) {
        $status = false;
        foreach ($eleminated_items as $kk => $vv) {
            if ($vv['inter'] == $v['inter'] && $vv['intersublevel1'] == $v['intersublevel1'] && $vv['intersublevel2'] == $v['intersublevel2']) {
                if ($status == false) {
                    $final_result[] = $v;
                }
                $final_result[] = $vv;
                unset($eleminated_items[$kk]);
                $status = true;
            }
        }
        if ($status == false) {
            $final_result[] = $v;
        }
    }
    return $final_result;
}












class PDF extends FPDF
{






function LoadData($file)
{
    // Read file lines
    $lines = file($file);
    $data = array();
    foreach($lines as $line)
        $data[] = explode(';',trim($line));
    return $data;
}
}



class PDF_MC_Table extends FPDF
{
var $widths;
var $aligns;

function footer()
{
    
    $this->SetTextColor(0,0,0); 
    $this->SetY(-23);
    $this->SetFont('','',8);
    $this->Line(20, 272, 190, 272);
    $this->Cell(56.7,4,'Hatzmann Hell OG',0,0,'L');
    $this->Cell(56.7,4,'IBAN: AT69 1420 0200 1097 0173',0,1,'L');
    $this->Cell(56.7,4,utf8_decode('Dr.-Karl-Rennerstraße 44'),0,0,'L');
    $this->Cell(56.7,4,'BIC: EASYATW1',0,1,'L');
    $this->Cell(56.7,4,'8600 Bruck an der Mur',0,0,'L');
    $this->Cell(56.7,4,'UID: ATU71872208',0,0,'L');
    $this->Cell(56.6,4,'Seite '.$this->PageNo().'/{nb}',0,0,'R');
      
}
function header()
{
    // -------  logo and address  ---------
    $this->SetTextColor(0,0,0); 
    $this->Image('logo.jpg',20,15,180);
    $this->Ln(25);
}
    
function SetWidths($w)
{
    //Set the array of column widths
    $this->widths=$w;
}

function SetAligns($a)
{
    //Set the array of column alignments
    $this->aligns=$a;
}

function Row($data)
{
    //Calculate the height of the row
    $nb=0;
    for($i=0;$i<count($data);$i++)
        $nb=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
    $h=5*$nb;
    //Issue a page break first if needed
    $this->CheckPageBreak($h);
    //Draw the cells of the row
    for($i=0;$i<count($data);$i++)
    {
        $w=$this->widths[$i];
        $a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
        //Save the current position
        $x=$this->GetX();
        $y=$this->GetY();
        //Draw the border
        $this->Rect($x,$y,$w,$h);
        //Print the text
        $this->MultiCell($w,5,$data[$i],0,$a);
        //Put the position to the right of the cell
        $this->SetXY($x+$w,$y);
    }
    //Go to the next line
    $this->Ln($h);
}

function CheckPageBreak($h)
{
    //If the height h would cause an overflow, add a new page immediately
    if($this->GetY()+$h>$this->PageBreakTrigger)
        $this->AddPage($this->CurOrientation);
}

function NbLines($w,$txt)
{
    //Computes the number of lines a MultiCell of width w will take
    $cw=&$this->CurrentFont['cw'];
    if($w==0)
        $w=$this->w-$this->rMargin-$this->x;
    $wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
    $s=str_replace("\r",'',$txt);
    $nb=strlen($s);
    if($nb>0 and $s[$nb-1]=="\n")
        $nb--;
    $sep=-1;
    $i=0;
    $j=0;
    $l=0;
    $nl=1;
    while($i<$nb)
    {
        $c=$s[$i];
        if($c=="\n")
        {
            $i++;
            $sep=-1;
            $j=$i;
            $l=0;
            $nl++;
            continue;
        }
        if($c==' ')
            $sep=$i;
        $l+=$cw[$c];
        if($l>$wmax)
        {
            if($sep==-1)
            {
                if($i==$j)
                    $i++;
            }
            else
                $i=$sep+1;
            $sep=-1;
            $j=$i;
            $l=0;
            $nl++;
        }
        else
            $i++;
    }
    return $nl;
}
}




    
    
function sign($n) {
  //  return ($n > 0) - ($n < 0);
if ( $n< 0 )
{
  return -1;
}
else if ( $n== 0 )
{
  return 0;
}
else
{
  return 1;
}
}









global $app;

//if (!LOGGED_IN_USER) {
//    redirect(make_url('shop'));
//}

    $id = isset($app['GET']['id'])?$app['GET']['id']:"0";

    $orderid = isset($app['GET']['orderid'])?$app['GET']['orderid']:"0";


    $batch_id = new query("users");
    $batch_id->Field = "district,organization,community,subdistrict,department_new";
    $batch_id->Where = " where id = '" . $id . "'";
    $districtID = $batch_id->DisplayOne();
 
    $Dbatch_id = new query("districts ");
    $Dbatch_id->Field = "name_" . $app['language'] . " as name_en";
    $Dbatch_id->Where = " where id = '" . $districtID->district . "'";
    $DdistrictID = $Dbatch_id->DisplayOne();
    if (!empty($DdistrictID->name_en)) {
        $username_en = $DdistrictID->name_en;
    } else {
        $username_en = '';
    }
    $Departbatch_id = new query("departments_new ");
    $Departbatch_id->Field = "name_" . $app['language'] . " as name_en";
    $Departbatch_id->Where = " where id = '" . $districtID->department_new . "'";
    $DdeaprtID = $Departbatch_id->DisplayOne();
    if (!empty($DdeaprtID->name_en)) {
        $userdepart_en = $DdeaprtID->name_en;
    } else {
        $userdepart_en = '';
    }
    $Commbatch_id = new query("communities ");
    $Commbatch_id->Field = "name_" . $app['language'] . " as name_en";
    $Commbatch_id->Where = " where id = '" . $districtID->community . "'";
    $CommID = $Commbatch_id->DisplayOne();
    if (!empty($CommID->name_en)) {
        $usercomm_en = $CommID->name_en;
    } else {
        $usercomm_en = '';
    }
    $subbatch_id = new query("sub_districts ");
    $subbatch_id->Field = "name_" . $app['language'] . " as name_en";
    $subbatch_id->Where = " where id = '" . $districtID->subdistrict . "'";
    $subdistrictID = $subbatch_id->DisplayOne();
    if (!empty($subdistrictID->name_en)) {
        $usersubdist_en = $subdistrictID->name_en;
    } else {
        $usersubdist_en = '';
    }


//    $query= new query('users'); 
//    $query->Where = "where id =$id";
//    $user = $query->DisplayOne();


    $query= new query('customers'); 
    $query->Where = "where user_id =$id";
    $customers = $query->ListOfAllRecords('object'); 

    //get old orders to crosscheck
    $query2= new query('order_items'); 
    $query2->Field="order_items.id, order_items.customer_id, order_items.order_id , order_items.product_id, order_items.quantity, batches.level, batches.ribbon_name_en as name, orders.is_order_valid ";
    $query2->Where = " LEFT JOIN batches on order_items.product_id=batches.id LEFT JOIN orders on order_items.order_id=orders.id WHERE orders.is_order_valid='1'  AND order_items.customer_id IN(Select customers.id from customers WHERE customers.user_id=$id)  ORDER BY order_id ";
    $customer_order_items = $query2->ListOfAllRecords('object');
    


if(empty($customers )==false)
{

    // Instanciation of inherited class
    $pdf = new PDF_MC_Table();
    $pdf->AliasNbPages();

$onedone=0;
foreach($customers as $customer)
{
        $customer_id=$customer->id;
        $output = listBatchAdmin($customer_id);

        
    $total = 0;

if(empty($output)==false)
{	


$onedone=1;
    $pdf->SetMargins(20, 20,20);
    $pdf->AddPage();

//    $pdf->SetAutoPageBreak(false, 20);

    $pdf->SetFont('Arial','',10);
//    $pdf->Cell(0,10,'',0,1);
    $pdf->Cell(0,6,'Spangenansicht',0,1);
    $pdf->SetFont('Arial','B',10);
    $pdf->Cell(0,6,UTFencoder2($customer->first_name . ' ' . $customer->last_name),0,1);
    if($userdepart_en=="")
    {
        $pdf->SetTextColor(255,0,0);
        $pdf->Cell(0,6,UTFencoder2(html_entity_decode('Nicht angegeben / '.$username_en.' / '.$usersubdist_en.' / '.$usercomm_en)),0,1);
        $pdf->SetTextColor(0,0,0);
    }
    else
    {
        $pdf->Cell(0,6,UTFencoder2(html_entity_decode($userdepart_en.' / '.$username_en.' / '.$usersubdist_en.' / '.$usercomm_en)),0,1);     
    }
    
    $pdf->Ln(3);




// -------  items  ---------

    // Colors, line width and bold font
    $pdf->SetFillColor(230,230,230);
    $pdf->SetTextColor(0);
    $pdf->SetDrawColor(0,0,0);
    $pdf->SetLineWidth(.1);
      
        $imageheight=10;
        $n=0;

        $x=0;
        $xOffset=140;

        $y=$pdf->GetY()+$imageheight*88/144*(sizeof($output) - sizeof($output)%3)/3;

     	
        $maxWidth=80;


    for ($i = sizeof($output)-1; $i >= 0 ; $i--)
    {

            $tempoutput=$output[$i];
            if ( isset($tempoutput['ribbon_type'])) 
            {
        
                if ($n==0)
                {
                    $totalwidth=0;
                    for($j=0;$j<3;$j++)
                    {
                        if($i-$j<0) break;
                        $imagepath=str_replace('<div class="ribbon_outer"><img src="','',$output[$i-$j]['ribbon_type']);
                        $imagepath=str_replace('" class="img-responsive"></div>','',$imagepath);
                        $imagedata = getimagesize($imagepath);

                        $totalwidth = $totalwidth + $imageheight*$imagedata[0]/ $imagedata[1];
                    }

                    $x=$xOffset-($maxWidth-$totalwidth)/2;

                }
     
                $n=$n+1;

                
                $imagepath=str_replace('<div class="ribbon_outer"><img src="','',$tempoutput['ribbon_type']);
                $imagepath=str_replace('" class="img-responsive"></div>','',$imagepath);
                $imagedata = getimagesize($imagepath);

                $width = $imageheight*$imagedata[0]/ $imagedata[1];

                $x=$x-$width;



                $pdf->Image($imagepath,$x,$y,0,$imageheight,'PNG');

                
                if ($n==3)
                {
                    $n=0;
                    $y=$y-$imageheight*88/144;

                }



            }

        }

        $pdf->SetY( $pdf->GetY() + $imageheight + $imageheight*88/144*(sizeof($output) - sizeof($output)%3)/3);
$y= $pdf->GetY();
      $yOffset= $pdf->GetY();

    $pdf->SetFont('','',8);


       $xOffset=25;
        $count=0;
      $border=5;

    foreach ($output as $tempoutput)
    {
        $count=$count+1;
    	$imagepath=str_replace('<div class="ribbon_outer"><img src="','',$tempoutput['ribbon_type']);
    	$imagepath=str_replace('" class="img-responsive"></div>','',$imagepath);
      	$imagedata = getimagesize($imagepath);
        $y=$y+$imageheight+6;

        if($count<=9)
        {
            $pdf->Line($xOffset-$border, $y-$border, 185, $y-$border);
        }

        if(strlen($tempoutput['ribbon_name_en'])>55)
        {
            $writestr=substr($tempoutput['ribbon_name_en'],0,52).'...';
        }
        else
        {
            $writestr=$tempoutput['ribbon_name_en'];
        }




        $pdf->Text($xOffset,$y,utf8_decode($writestr),0,1);
        $pdf->Image($imagepath,$xOffset,$y,0,$imageheight,'PNG');

        $bestellt = "Nicht Bestellt";
        $pdf->SetTextColor(255,0,0);  

        for ($n=0;$n<count($customer_order_items);$n++)
        {
            if (empty($customer_order_items[$n]))
            {
                continue;
            }
            $customer_order_item=$customer_order_items[$n];
            if($customer_order_item->customer_id==$customer_id)
            {
                 if($customer_order_item->product_id==$tempoutput['batch_id'])
                 {
                     if ($customer_order_item->order_id==$orderid)
                     {
                         $bestellt = "In dieser Bestellung";
                         $pdf->SetTextColor(0,0,160);         
                     }
                     else
                     {
                         $bestellt = "Bestellt in " . $customer_order_item->order_id;
                         $pdf->SetTextColor(135,135,135);         
                     }
                    $customer_order_items[$n]=null;
                     break;
                 }

            }
        }

        $pdf->Text($xOffset+40,$y+6,utf8_decode($bestellt),0,1);     

                $pdf->SetTextColor(0,0,0);    

        if($count==9)
        {
            $pdf->Line($xOffset-$border, $y-$border+$imageheight+6, 185, $y-$border+$imageheight+6);
            $pdf->Line($xOffset-$border, $yOffset+$imageheight+6-$border, $xOffset-$border, $y-$border+$imageheight+6);
            $pdf->Line(185, $yOffset+$imageheight+6-$border, 185, $y-$border+$imageheight+6);
            $pdf->Line(105, $yOffset+$imageheight+6-$border, 105, $y-$border+$imageheight+6);

            $xOffset=110;
            $pdf->SetY($y+15);
            $y=$yOffset;

        }


    }

	if($count<9)
	{
		$pdf->Line($xOffset-$border, $y-$border+$imageheight+6, 185, $y-$border+$imageheight+6);
		$pdf->Line($xOffset-$border, $yOffset+$imageheight+6-$border, $xOffset-$border, $y-$border+$imageheight+6);
		$pdf->Line(185, $yOffset+$imageheight+6-$border, 185, $y-$border+$imageheight+6);
		$pdf->Line(105, $yOffset+$imageheight+6-$border, 105, $y-$border+$imageheight+6);
        $pdf->SetY($y+15);
	}
    
    
    $total = sizeof($output);
}
    else
    {
        $pdf->SetMargins(20, 20,20);
        $pdf->AddPage();
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(0,6,UTFencoder2($customer->first_name . ' ' . $customer->last_name),0,1);
        $pdf->Cell(0,6,'Dieser Kunde hat anscheinend alle Auszeichnungen geloescht',0,1);
        $pdf->SetFont('Arial','',10);
    }

    
    

                    $tempvar1 = $total % 3;
                    $tempvar2 = $total - $tempvar1;
                    $tempvar3 = $tempvar2 * 2 / 3;
                    $tempvar4 = sign($tempvar1);
                    $tempvar5 = sign(3 * sign($tempvar3) + $tempvar1 - 1);
                    $tempvar6 = $tempvar3 + $tempvar4;

                    $LConnectors = $tempvar5 + $tempvar6 - 1;
                    $QConnectors = (($total - 3) + ($total - 3) * sign($total - 3)) / 2;
                    if ($total == 4 || $total == 7 || $total == 10 || $total == 13 || $total == 16)
                    {
                        $QConnectors =$QConnectors + 1;
                    }

                    if ($total < 8)
                    {
                        $nails = 2;
                    }
                    else
                    {
                        $nails = 4;
                    }
    
   $QConnectorsActual=0;
   $LConnectorsActual=0;
   $nailsActual=0;
    
    
    
    for ($n=0;$n<count($customer_order_items);$n++)
    {
        if (empty($customer_order_items[$n]))
        {
            continue;
        }
        if ($customer_order_items[$n]->customer_id!=$customer_id)
        {
            continue;
        }
        
        $pdf->SetTextColor(0,0,0); 
        
        $customer_order_item=$customer_order_items[$n];
        if($customer_order_item->customer_id==$customer_id && $customer_order_item->level==6)
        {
            if($customer_order_item->product_id==463)
            {
                   $LConnectorsActual=$LConnectorsActual+$customer_order_item->quantity;
            }
            elseif($customer_order_item->product_id==461)
            {
                    $QConnectorsActual=$QConnectorsActual+$customer_order_item->quantity;
            }
            elseif($customer_order_item->product_id==462)
            {
                    $nailsActual=$nailsActual+$customer_order_item->quantity;
            }
            
            if ($customer_order_item->order_id==$orderid)
            {
                $bestellt = " in dieser Bestellung";
                $pdf->SetTextColor(0,0,160);         
            }
            else
            {
                $bestellt = " bestellt in " . $customer_order_item->order_id .  $customer_order_item->customer_id;
                $pdf->SetTextColor(135,135,135);         
            }
            $pdf->Cell(0,6,$customer_order_item->quantity . ' ' . UTFencoder2($customer_order_item->name) . $bestellt,0,1);
         
        }
        else
        {
            if ($customer_order_item->order_id==$orderid)
            {
                $bestellt = " (in dieser Bestellung)";
                $pdf->SetTextColor(0,0,160);         
            }
            else
            {
                $bestellt = " (bestellt in " . $customer_order_item->order_id.")" .  $customer_order_item->customer_id ;
                $pdf->SetTextColor(135,135,135);         
            }
            $pdf->SetTextColor(255,0,0); 
            
            $pdf->SetFont('','B');
            $pdf->Cell(0,6,'WEITERE BESTELLUNG: '.UTFencoder2($customer_order_item->name).$bestellt,0,1);
                                $pdf->SetFont('','');
        }
        
                
        $pdf->SetTextColor(0,0,0); 
        
    }
    
    if($total==0)
    {
        $LConnectors=0;
        $QConnectors=0;
        $nails=0;
        
    }
    
        if($LConnectorsActual==$LConnectors)
        {
                    $pdf->SetTextColor(0,160,0); 
        }
        else
        {
                        $pdf->SetTextColor(255,0,0);  
        }
        $pdf->Cell(0,6, 'Gesamt ' . $LConnectorsActual . UTFencoder2(' Längsverbinder bestellt. ') . $LConnectors . UTFencoder2(' benötigt' ),0,1);
    
            if($QConnectorsActual==$QConnectors)
        {
                    $pdf->SetTextColor(0,160,0); 
        }
        else
        {
                        $pdf->SetTextColor(255,0,0);  
        }
    
        $pdf->Cell(0,6, 'Gesamt ' . $QConnectorsActual . UTFencoder2(' Querverbinder bestellt. ') . $QConnectors . UTFencoder2(' benötigt' ),0,1);
    
        if($nailsActual==$nails)
        {
                    $pdf->SetTextColor(0,160,0); 
        }
        else
        {
        $pdf->SetTextColor(255,0,0);  
        }
        $pdf->Cell(0,6, 'Gesamt ' . $nailsActual . UTFencoder2(' Nägel bestellt. ') . $nails . UTFencoder2(' benötigt' ),0,1);

    
        $pdf->SetTextColor(0,0,0); 

    
}

if($onedone==0)
{


}

    $pdf->Output('', 'Spangenansicht komplett.pdf');
}

?>

    

    



<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 
<script src="js/bootstrap.min.js"></script>

