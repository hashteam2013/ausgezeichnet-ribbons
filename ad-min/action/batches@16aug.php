<?php
global $app;
$id = isset($app['GET']['id']) ? $app['GET']['id'] : "0";
$id_loc = isset($app['GET']['id_loc']) ? $app['GET']['id_loc'] : "0";
$page_no = (isset($app['GET']['page_no']) && $app['GET']['page_no'] != "") ? $app['GET']['page_no'] : 1;
$limit = PAGE_CONTENT_LIMIT;
switch ($action):
    case 'add':
        if (isset($app['POST']['add'])) {
            $msg = '';
            if (trim($app['POST']['rnameen']) == '') {
                $msg = 'Please enter english name';
            } elseif (trim($app['POST']['rnamedr']) == '') {
                $msg = 'Please enter german name';
            } elseif (trim($app['POST']['level']) == '') {
                $msg = 'Please choose ribbon level';
            } elseif (trim($app['POST']['grade']) == '') {
                $msg = 'Please enter ribbon grade';
            } elseif (trim($app['POST']['rb_value']) == '') {
                $msg = 'Please enter ribbon value';
            } elseif (trim($app['POST']['btposition']) == '') {
                $msg = 'Please enter position';
            } elseif (($_FILES['upload_image']['name']) == '') {
                $msg = 'Please choose batch image';
            } else {
                $queryObj = new query('batches');
                $queryObj->Field = " id";
                $queryObj->Where = " where ribbon_name_en = '" . $app['POST']['rnameen'] . "'";
                $object = $queryObj->DisplayOne();
                if (!is_object($object)) {
                    if (isset($_FILES['upload_image']['name']) && $_FILES['upload_image']['name'] != '') {
                        $file_name = $_FILES['upload_image']['name'];
                        if (file_exists(DIR_FS_UPLOADS . "batch/" . $file_name)) {
                            $i = 1;
                            while (file_exists(DIR_FS_UPLOADS . "batch/" . $i . "_" . $file_name)) {
                                $i++;
                            }
                            $file_name = $i . "_" . str_replace(" ", "_", $file_name);
                        }
                        $file_tmp = $_FILES['upload_image']['tmp_name'];
                        $move = move_uploaded_file($file_tmp, DIR_FS_UPLOADS . "batch/" . $file_name);
                        if ($move) {
                            $query = new query('batches');
                            $query->Data['ribbon_name_en'] = $app['POST']['rnameen'];
                            $query->Data['ribbon_name_dr'] = $app['POST']['rnamedr'];
                            $query->Data['batch_image'] = $file_name;
                            $query->Data['webshop_title_en'] = $app['POST']['webtten'];
                            $query->Data['webshop_title_dr'] = $app['POST']['webttdr'];
                            $query->Data['type'] = $app['POST']['ribloc'];
                            $query->Data['desc_en'] = $app['POST']['desen'];
                            $query->Data['desc_dr'] = $app['POST']['desdr'];
                            $query->Data['level'] = $app['POST']['level'];
                            $query->Data['grade'] = $app['POST']['grade'];
                            $query->Data['value'] = $app['POST']['rb_value'];
                            $query->Data['unit_price'] = $app['POST']['uprice'];
                            $query->Data['batch_position'] = $app['POST']['btposition'];
                            $query->Data['is_batch'] = '1';
                            $query->Data['is_active'] = '1';
                            //$query->Data['is_active'] = isset($app['POST']['active']) ? '1' : '0';
                            $query->Data['is_deleted'] = '0';
                            if ($query->Insert()) {
                                $query = new query('batches');
                                $batch_id = $query->GetMaxId();
                                $categories = $app['POST']['categories_name'];
                                if (!empty($categories)) {
                                    foreach ($categories as $k => $v) {
                                        $query1 = new query('batch_filter_relation');
                                        $query1->Data['batch_id'] = $batch_id;
                                        $query1->Data['rel_type'] = "categories";
                                        $query1->Data['filter_id'] = $v;
                                        $query1->Insert();
                                    }
                                }
                                $districts = $app['POST']['districts_name'];
                                if (!empty($districts)) {
                                    foreach ($districts as $k => $v) {
                                        $query1 = new query('batch_filter_relation');
                                        $query1->Data['batch_id'] = $batch_id;
                                        $query1->Data['rel_type'] = "districts";
                                        $query1->Data['filter_id'] = $v;
                                        $query1->Insert();
                                    }
                                }
                                 $subdistricts = $app['POST']['subdistricts_name'];
                                if (!empty($subdistricts)) {
                                    foreach ($subdistricts as $k => $v) {
                                        $query1 = new query('batch_filter_relation');
                                        $query1->Data['batch_id'] = $batch_id;
                                        $query1->Data['rel_type'] = "subdistricts";
                                        $query1->Data['filter_id'] = $v;
                                        $query1->Insert();
                                    }
                                }
                                $departments = $app['POST']['departments_name'];
                                if (!empty($departments)) {
                                    foreach ($departments as $k => $v) {
                                        $query1 = new query('batch_filter_relation');
                                        $query1->Data['batch_id'] = $batch_id;
                                        $query1->Data['rel_type'] = "departments";
                                        $query1->Data['filter_id'] = $v;
                                        $query1->Insert();
                                    }
                                }
                                $departments_new = $app['POST']['departments_new_name'];
                                if (!empty($departments_new)) {
                                    foreach ($departments_new as $k => $v) {
                                        $query1 = new query('batch_filter_relation');
                                        $query1->Data['batch_id'] = $batch_id;
                                        $query1->Data['rel_type'] = "departments_new";
                                        $query1->Data['filter_id'] = $v;
                                        $query1->Insert();
                                    }
                                }
                                $organizations = $app['POST']['organization_name'];
                                if (!empty($organizations)) {
                                    foreach ($organizations as $k => $v) {
                                        $query1 = new query('batch_filter_relation');
                                        $query1->Data['batch_id'] = $batch_id;
                                        $query1->Data['rel_type'] = "organizations";
                                        $query1->Data['filter_id'] = $v;
                                        $query1->Insert();
                                    }
                                }
                                 
                                set_alert('success', "New batch added successfully");
                                redirect(app_url('batches', 'list', 'list', array(), true));
                            } else {
                                $msg = 'Error occurred while updating account info. Please try again!';
                            }
                        } else {
                            $msg = 'Error occurred while uploading image file. Please try again!';
                        }
                    } else {
                        $msg = 'Please upload batch image.';
                    }
                } else {
                    $msg = 'Batch name already exist!';
                }
            }
        }
        set_alert('error', $msg);
        $query = new query('categories');
        $query->Where = "where is_active = 1 order by position";
        //$query->Where = "where is_active = 1";
        $categories = $query->ListOfAllRecords('object');

        $query = new query('districts as dist');
        $query->Field = "dist.id,dist.name_en,sb.name_en as sub_dist_name";
        $query->Where = " LEFT JOIN sub_districts as sb ON sb.district_id = dist.id";
        $dist_relations = $query->ListOfAllRecords();
        function listSubDistricts($id){
        $subdist_relations = array();
        $query = new query('sub_districts');
        $query->Field = "name_en,id";
        $query->Where = " where district_id = $id";
        $subdist_relations = $query->ListOfAllRecords();
         return $subdist_relations;
   }
       
        
        
//        $query = new query('sub_districts as s_dist');
//        $query->Field = "s_dist.id,s_dist.district_id as dist_id,s_dist.name_en,s_dist.name_dr,s_dist.position,s_dist.is_active,dis.name_en as district_name_en";
//        $query->Where = " LEFT JOIN districts as dis ON dis.id = s_dist.district_id";
//        $query->Where .= " where s_dist.id = ".$id;
//        $s_districts = $query->DisplayOne();
//        $query->Where = "where is_active = 1 order by position";
//        $districts = $query->ListOfAllRecords('object');
        
//        $query = new query('sub_districts');
//        $query->Where = "where is_active = 1 order by position";
//        //$query->Where = "where is_active = 1";
//        $sdistricts = $query->ListOfAllRecords('object');
        

        $query = new query('departments');
        $query->Where = " where is_active = 1 order by position";
        //$query->Where = "where is_active = 1";
        $departments = $query->ListOfAllRecords('object');
        
        $query = new query('departments_new');
        $query->Where = " where is_active = 1 order by position";
        //$query->Where = "where is_active = 1";
        $departments_new = $query->ListOfAllRecords('object');

        $query = new query('organizations');
        $query->Where = "where is_active = 1 order by position";
        //$query->Where = " where is_active = 1";
        $organizations = $query->ListOfAllRecords('object');
        
        $query_ia = new query('international_authorities');
        $query_ia->Field = "id,name_en";
        $query_ia->Where = "where is_active = 1";
        $ia = $query_ia->ListOfAllRecords('object');
        break;

    case 'edit':
        if (isset($app['POST']['update'])) {
            $msg = '';
            if (trim($app['POST']['rnameen']) == '') {
                $msg = 'Please enter Ribbon english name';
            } elseif (trim($app['POST']['rnamedr']) == '') {
                $msg = 'Please enter Ribbon german name';
            } elseif (trim($app['POST']['btposition']) == '') {
                $msg = 'Please enter Batch position';
            } else {
                $query = new query('batches');
                $query->Data['id'] = $id;
                $query->Data['ribbon_name_en'] = $app['POST']['rnameen'];
                $query->Data['ribbon_name_dr'] = $app['POST']['rnamedr'];
                if (isset($_FILES['upload_image']['name']) && $_FILES['upload_image']['name'] != '') {
                    $file_name = $_FILES['upload_image']['name'];
                    if (file_exists(DIR_FS_UPLOADS . "batch/" . $file_name)) {
                        $i = 1;
                        while (file_exists(DIR_FS_UPLOADS . "batch/" . $i . "_" . $file_name)) {
                            $i++;
                        }
                        $file_name = $i . "_" . $file_name;
                    }
                    $file_tmp = $_FILES['upload_image']['tmp_name'];
                    $upload_folder = DIR_FS_UPLOADS . "batch/" . $file_name;
                    $move = move_uploaded_file($file_tmp, $upload_folder);
                    $query->Data['batch_image'] = $file_name;
                }
                $query->Data['webshop_title_en'] = $app['POST']['webtten'];
                $query->Data['webshop_title_dr'] = $app['POST']['webttdr'];
                $query->Data['type'] = $app['POST']['ribloc'];
                $query->Data['desc_en'] = $app['POST']['desen'];
                $query->Data['desc_dr'] = $app['POST']['desdr'];
                $query->Data['level'] = $app['POST']['level'];
                $query->Data['grade'] = $app['POST']['grade'];
                $query->Data['value'] = $app['POST']['rb_value'];
                $query->Data['unit_price'] = $app['POST']['uprice'];
                $query->Data['batch_position'] = $app['POST']['btposition'];
                //$query->Data['is_active'] = isset($app['POST']['active']) ? '1' : '0';
                if ($query->Update()) {
                    // categories
                    
                    $query1 = new query('batch_filter_relation');
                    $query1->Data['batch_id'] = $id;
                    $query1->Field = "filter_id";
                    $query1->Where = "where batch_id = $id and rel_type = 'categories'";
                    $existing_categories_arr = $query1->ListOfAllRecords('object');
                    $existing_categories = array();
                    foreach ($existing_categories_arr as $kk => $vv) {
                        $existing_categories[$vv->filter_id] = $vv->filter_id;
                    }
                    $new_categories = $app['POST']['categories_name'];
                    foreach ($new_categories as $kk => $vv) {
                        if (array_key_exists($vv, $existing_categories)) {
                            unset($existing_categories[$vv]);
                        } else {
                            $query1 = new query('batch_filter_relation');
                            $query1->Data['batch_id'] = $id;
                            $query1->Data['rel_type'] = "categories";
                            $query1->Data['filter_id'] = $vv;
                            $query1->Insert();
                        }
                    }

                    if (!empty($existing_categories)) {
                        foreach ($existing_categories as $kk => $vv) {
                            $query1 = new query('batch_filter_relation');
                            $query1->Where = " where batch_id = $id and rel_type = 'categories' and filter_id = $vv";
                            $query1->Delete_where();
                        }
                    }

                    // distrcits
                    $query1 = new query('batch_filter_relation');
                    $query1->Data['batch_id'] = $id;
                    $query1->Field = "filter_id";
                    $query1->Where = "where batch_id = $id and rel_type = 'districts'";
                    $existing_districts_arr = $query1->ListOfAllRecords('object');
                    $existing_districts = array();
                    foreach ($existing_districts_arr as $kk => $vv) {
                        $existing_districts[$vv->filter_id] = $vv->filter_id;
                    }
                    $new_districts = $app['POST']['districts_name'];
                    foreach ($new_districts as $kk => $vv) {
                        if (array_key_exists($vv, $existing_districts)) {
                            unset($existing_districts[$vv]);
                        } else {
                            $query1 = new query('batch_filter_relation');
                            $query1->Data['batch_id'] = $id;
                            $query1->Data['rel_type'] = "districts";
                            $query1->Data['filter_id'] = $vv;
                            $query1->Insert();
                        }
                    }

                    if (!empty($existing_districts)) {
                        foreach ($existing_districts as $kk => $vv) {
                            $query1 = new query('batch_filter_relation');
                            $query1->Where = " where batch_id = $id and rel_type = 'districts' and filter_id = $vv";
                            $query1->Delete_where();
                        }
                    }
                    
                    
                    // subdistricts
                    $query1 = new query('batch_filter_relation');
                    $query1->Data['batch_id'] = $id;
                    $query1->Field = "filter_id";
                    $query1->Where = "where batch_id = $id and rel_type = 'subdistricts'";
                    $existing_subdistricts_arr = $query1->ListOfAllRecords('object');
                    $existing_subdistricts = array();
                    foreach ($existing_subdistricts_arr as $kk => $vv) {
                        $existing_subdistricts[$vv->filter_id] = $vv->filter_id;
                    }
                    $new_subdistricts = $app['POST']['subdistricts_name'];
                    foreach ($new_subdistricts as $kk => $vv) {
                        if (array_key_exists($vv, $existing_subdistricts)) {
                            unset($existing_subdistricts[$vv]);
                        } else {
                            $query1 = new query('batch_filter_relation');
                            $query1->Data['batch_id'] = $id;
                            $query1->Data['rel_type'] = "subdistricts";
                            $query1->Data['filter_id'] = $vv;
                            $query1->Insert();
                        }
                    }

                    if (!empty($existing_subdistricts)) {
                        foreach ($existing_subdistricts as $kk => $vv) {
                            $query1 = new query('batch_filter_relation');
                            $query1->Where = " where batch_id = $id and rel_type = 'subdistricts' and filter_id = $vv";
                            $query1->Delete_where();
                        }
                    }

                    // departments
                    $query1 = new query('batch_filter_relation');
                    $query1->Data['batch_id'] = $id;
                    $query1->Field = "filter_id";
                    $query1->Where = "where batch_id = $id and rel_type = 'departments'";
                    $existing_departmentss_arr = $query1->ListOfAllRecords('object');
                    $existing_departments = array();
                    foreach ($existing_departmentss_arr as $kk => $vv) {
                        $existing_departments[$vv->filter_id] = $vv->filter_id;
                    }
                    $new_departments = $app['POST']['departments_name'];
                    foreach ($new_departments as $kk => $vv) {
                        if (array_key_exists($vv, $existing_departments)) {
                            unset($existing_departments[$vv]);
                        } else {
                            $query1 = new query('batch_filter_relation');
                            $query1->Data['batch_id'] = $id;
                            $query1->Data['rel_type'] = "departments";
                            $query1->Data['filter_id'] = $vv;
                            $query1->Insert();
                        }
                    }
                    if (!empty($existing_departments)) {
                        foreach ($existing_departments as $kk => $vv) {
                            $query1 = new query('batch_filter_relation');
                            $query1->Where = " where batch_id = $id and rel_type = 'departments' and filter_id = $vv";
                            $query1->Delete_where();
                        }
                    }
                    // departments_new
                    $query1 = new query('batch_filter_relation');
                    $query1->Data['batch_id'] = $id;
                    $query1->Field = "filter_id";
                    $query1->Where = "where batch_id = $id and rel_type = 'departments_new'";
                    $existing_departmentss_new_arr = $query1->ListOfAllRecords('object');
                    $existing_departments_new = array();
                    foreach ($existing_departmentss_new_arr as $kk => $vv) {
                        $existing_departments_new[$vv->filter_id] = $vv->filter_id;
                    }
                    $new_departments_name = $app['POST']['departments_new_name'];
                    foreach ($new_departments_name as $kk => $vv) {
                        if (array_key_exists($vv, $existing_departments_new)) {
                            unset($existing_departments_new[$vv]);
                        } else {
                            $query1 = new query('batch_filter_relation');
                            $query1->Data['batch_id'] = $id;
                            $query1->Data['rel_type'] = "departments_new";
                            $query1->Data['filter_id'] = $vv;
                            $query1->Insert();
                        }
                    }
                    if (!empty($existing_departments_new)) {
                        foreach ($existing_departments_new as $kk => $vv) {
                            $query1 = new query('batch_filter_relation');
                            $query1->Where = " where batch_id = $id and rel_type = 'departments_new' and filter_id = $vv";
                            $query1->Delete_where();
                        }
                    }
                    // organizations
                    $query1 = new query('batch_filter_relation');
                    $query1->Data['batch_id'] = $id;
                    $query1->Field = "filter_id";
                    $query1->Where = "where batch_id = $id and rel_type = 'organizations'";
                    $existing_organizations_arr = $query1->ListOfAllRecords('object');
                    $existing_organizations = array();
                    foreach ($existing_organizations_arr as $kk => $vv) {
                        $existing_organizations[$vv->filter_id] = $vv->filter_id;
                    }
                    $new_organizations = $app['POST']['organization_name'];
    
                    foreach ($new_organizations as $kk => $vv) {
                        if (array_key_exists($vv, $existing_organizations)) {
                            unset($existing_organizations[$vv]);
                        } else {
                            $query1 = new query('batch_filter_relation');
                            $query1->Data['batch_id'] = $id;
                            $query1->Data['rel_type'] = "organizations";
                            $query1->Data['filter_id'] = $vv;
                            $query1->Insert();
                        }
                    }
                    if (!empty($existing_organizations)) {
                        foreach ($existing_organizations as $kk => $vv) {
                            $query1 = new query('batch_filter_relation');
                            $query1->Where = " where batch_id = $id and rel_type = 'organizations' and filter_id = $vv";
                            $query1->Delete_where();
                        }
                    }
                    
                    
                    /********check ia*********/
                    $query1 = new query('batch_filter_relation');
                    $query1->Data['batch_id'] = $id;
                    $query1->Field = "filter_id";
                    $query1->Where = "where batch_id = $id and rel_type = 'ia'";
                    $existing_organizations_arr = $query1->ListOfAllRecords('object');
                    $existing_organizations1 = array();
                    foreach ($existing_organizations_arr as $kk => $vv) {
                        $existing_organizations1[$vv->filter_id] = $vv->filter_id;
                    }
                    
                     $ia_name = $app['POST']['ia_name'];
                     
                
                     foreach ($ia_name as $kk => $vv) {
                             
                        if (array_key_exists($vv, $existing_organizations1)) {
      
                            unset($existing_organizations1[$vv]);
                        } else {
                          
                            $query1 = new query('batch_filter_relation');
                            $query1->Data['batch_id'] = $id;
                            $query1->Data['rel_type'] = "ia";
                            $query1->Data['filter_id'] = $vv;
                            $query1->Insert();
                        }
                    }
                 
                      if (!empty($existing_organizations1)) {
                        foreach ($existing_organizations1 as $kk => $vv) {
                            $query1 = new query('batch_filter_relation');
                            $query1->Where = " where batch_id = $id and rel_type = 'ia' and filter_id = $vv";
                            $query1->Delete_where();
                        }
                    }
                    
                    /*
                      $query1 = new query('batch_filter_relation');
                      $query1->Data['batch_id'] = $id;
                      $query1->Field = "filter_id";
                      $query1->Where = "where batch_id = $id and rel_type = 'categories'";
                      $record = $query1->ListOfAllRecords('object');
                      if (!empty($record)) {
                      foreach ($record as $k => $v) {
                      $new_cat[] = $v->filter_id;
                      }
                      }
                      $categories = $app['POST']['categories_name'];
                      // if(!empty( $categories)){
                      $res = array_diff($categories, $new_cat);
                      $diff = array_diff($new_cat, $categories);
                      // }
                      if (!empty($categories)) {
                      $query1->Data['rel_type'] = "categories";
                      foreach ($categories as $k => $v) {
                      $query1->Data['filter_id'] = $v;
                      $query1->Insert();
                      }
                      } else {
                      $queryd1 = new query('batch_filter_relation');
                      $queryd1->Where = "Where batch_id ='" . $id . "' and rel_type = 'categories'";
                      $queryd1->Delete_where();
                      }
                      // pr($categories);
                      if ($res) {
                      foreach ($res as $key => $val) {
                      $query2 = new query('batch_filter_relation');
                      $query2->Data['filter_id'] = $val;
                      $query2->Data['rel_type'] = "categories";
                      $query2->Data['batch_id'] = $id;
                      $query2->Where = "where batch_id =  $id";
                      $query2->Insert();
                      }
                      }
                      if ($diff) {
                      $queryd1 = new query('batch_filter_relation');
                      $queryd1->Where = "Where filter_id in(" . implode(",", $diff) . ") and rel_type = 'categories'";
                      $queryd1->Delete_where();
                      }
                      $query1 = new query('batch_filter_relation');
                      $query1->Data['batch_id'] = $id;
                      $query1->Field = "filter_id";
                      $query1->Where = "where batch_id = $id and rel_type = 'districts'";
                      $record = $query1->ListOfAllRecords('object');
                      //pr($record);
                      if (!empty($record)) {
                      foreach ($record as $k => $v) {
                      $new_dis[] = $v->filter_id;
                      }
                      }

                      $districts = $app['POST']['districts_name'];
                      // if(!empty($districts)){
                      $res = array_diff($districts, $new_dis);
                      $diff_dis = array_diff($new_dis, $districts);
                      //pr($districts);
                      //}
                      if (!empty($districts)) {
                      $query1->Data['rel_type'] = "districts";
                      foreach ($districts as $k => $v) {
                      $query1->Data['filter_id'] = $v;
                      $query1->Insert();
                      }
                      } else {
                      $queryd1 = new query('batch_filter_relation');
                      $queryd1->Where = "Where batch_id ='" . $id . "' and rel_type = 'districts'";
                      $queryd1->Delete_where();
                      }
                      if ($res) {
                      foreach ($res as $key => $val) {
                      $query2 = new query('batch_filter_relation');
                      $query2->Data['filter_id'] = $val;
                      $query2->Data['rel_type'] = "districts";
                      $query2->Data['batch_id'] = $id;
                      //$query2->Where ="where batch_id =  $id";
                      $query2->Insert();
                      }
                      }if ($diff_dis) {
                      $queryd2 = new query('batch_filter_relation');
                      $queryd2->Where = "Where filter_id in(" . implode(",", $diff_dis) . ") and rel_type = 'districts' ";
                      $queryd2->Delete_where();
                      }
                      $query1 = new query('batch_filter_relation');
                      $query1->Data['batch_id'] = $id;
                      $query1->Field = "filter_id";
                      $query1->Where = "where batch_id = $id and rel_type = 'departments'";
                      $record = $query1->ListOfAllRecords('object');
                      if (!empty($record)) {
                      foreach ($record as $k => $v) {
                      $new_dep[] = $v->filter_id;
                      }
                      }
                      $departments = $app['POST']['departments_name'];
                      $res = array_diff($departments, $new_dep);
                      $diff_dep = array_diff($new_dep, $departments);

                      if (!empty($departments)) {
                      $query1->Data['rel_type'] = "departments";
                      foreach ($departments as $k => $v) {
                      $query1->Data['filter_id'] = $v;
                      $query1->Insert();
                      }
                      } else {
                      $queryd1 = new query('batch_filter_relation');
                      $queryd1->Where = "Where batch_id ='" . $id . "' and rel_type = 'departments'";
                      $queryd1->Delete_where();
                      }

                      if ($res) {
                      foreach ($res as $key => $val) {
                      $query2 = new query('batch_filter_relation');
                      $query2->Data['filter_id'] = $val;
                      $query2->Data['rel_type'] = "departments";
                      $query2->Data['batch_id'] = $id;
                      // $query2->Where ="where batch_id =  $id";
                      $query2->Insert();
                      }
                      }
                      if ($diff_dep) {
                      $queryd2 = new query('batch_filter_relation');
                      $queryd2->Where = "Where filter_id in(" . implode(",", $diff_dep) . ") and rel_type = 'departments' ";
                      $queryd2->Delete_where();
                      }
                     * 
                     */
                    set_alert('success', "Account info updated successfully");
                    redirect(app_url('batches', 'edit', 'edit', array('id' => $id), true));
                } else {
                    $msg = 'Error occurred while updating account info. Please try again!';
                }
//            }else{
//                     $msg = 'Error occurred while uploading image file. Please try again!';
//                }
            }
            //}
            set_alert('error', $msg);
        }
        $query = new query('batches');
        $query->Where = "where id = " . $id;
        $batches = $query->DisplayOne();
        if (!(is_object($batches))) {
            redirect(app_url('batches', 'list', 'list', array(), true));
        }

        $query = new query('categories');
        $query->Where = "where is_active = 1 order by position";
        $categories = $query->ListOfAllRecords('object');
        
      
        $queryCS = new query('batch_filter_relation');
        $queryCS->Field = "filter_id";
        $queryCS->Where = "where batch_id = $id and rel_type = 'categories' ";
        $cust_categories = $queryCS->ListOfAllRecords('object');
        $new_arr = array();
        if (!empty($cust_categories)) {
            foreach ($cust_categories as $k => $v) {
                $new_arr[] = $v->filter_id;
            }
        }

        $query = new query('districts');
        $query->Where = "where is_active = 1 order by position";
        $districts = $query->ListOfAllRecords('object');
            function listSubDistricts($id){
        $subdist_relations = array();
        $query = new query('sub_districts');
        $query->Field = "name_en,id";
        $query->Where = " where district_id = $id";
        $subdist_relations = $query->ListOfAllRecords();
         return $subdist_relations;
   }
        
        $query = new query('sub_districts');
        $query->Where = "where is_active = 1 order by position";
        //$query->Where = "where is_active = 1";
        $sdistricts = $query->ListOfAllRecords('object');
    
        
         $queryCS_ia = new query('batch_filter_relation');
        $queryCS_ia->Field = "filter_id";
        $queryCS_ia->Where = "where batch_id = $id and rel_type = 'ia'";
        $cust_organizations_ia = $queryCS_ia->ListOfAllRecords('object');
        $new_arr = array();
        if (!empty($cust_organizations_ia)) {
            foreach ($cust_organizations_ia as $k => $v) {
                $new_arr[] = $v->filter_id;
            }
        }
        
        $query_ia_1 = new query('international_authorities');
        $query_ia_1->Field = "id,name_en";
        $query_ia_1->Where = "where is_active = 1";
        $ia_1 = $query_ia_1->ListOfAllRecords('object');
       
        
        
        
        $queryCS = new query('batch_filter_relation');
        $queryCS->Field = "filter_id";
        $queryCS->Where = "where batch_id = $id and rel_type = 'districts' ";
        $cust_districts = $queryCS->ListOfAllRecords('object');
        
        $new_arr = array();
        if (!empty($cust_districts)) {
            foreach ($cust_districts as $k => $v) {
                $new_arr[] = $v->filter_id;
            }
        }
        
        
        /*custom subdistrict*/
        $queryCS = new query('batch_filter_relation');
        $queryCS->Field = "filter_id";
        $queryCS->Where = "where batch_id = $id and rel_type = 'subdistricts' ";
        //$queryCS->print=1;
        $cust_subdistricts = $queryCS->ListOfAllRecords('object');
        //print_r($cust_subdistricts);
        $new_arr = array();
        if (!empty($cust_subdistricts)) {
            foreach ($cust_subdistricts as $k => $v) {
                $new_arr[] = $v->filter_id;
            }
        }
        
        $query = new query('departments');
        $query->Where = "where is_active = 1 order by position";
        $departments = $query->ListOfAllRecords('object');
        $queryCS = new query('batch_filter_relation');
        $queryCS->Field = "filter_id";
        $queryCS->Where = "where batch_id = $id and rel_type = 'departments' ";
        $cust_departments = $queryCS->ListOfAllRecords('object');
        $new_arr = array();
        if (!empty($cust_departments)) {
            foreach ($cust_departments as $k => $v) {
                $new_arr[] = $v->filter_id;
            }
        }
        $query = new query('departments_new');
        $query->Where = "where is_active = 1 order by position";
        $departments_new = $query->ListOfAllRecords('object');
        $queryCS = new query('batch_filter_relation');
        $queryCS->Field = "filter_id";
        $queryCS->Where = "where batch_id = $id and rel_type = 'departments_new' ";
        $cust_departments_new = $queryCS->ListOfAllRecords('object');
        $new_arr = array();
        if (!empty($cust_departments_new)) {
            foreach ($cust_departments_new as $k => $v) {
                $new_arr[] = $v->filter_id;
            }
        }
        $query = new query('organizations');
        $query->Field = "id,name_en";
        $query->Where = "where is_active = 1";
        $organizations = $query->ListOfAllRecords('object');
        
       
        
        
        $queryCS = new query('batch_filter_relation');
        $queryCS->Field = "filter_id";
        $queryCS->Where = "where batch_id = $id and rel_type = 'organizations'";
        $cust_organizations = $queryCS->ListOfAllRecords('object');
        $new_arr = array();
        if (!empty($cust_organizations)) {
            foreach ($cust_organizations as $k => $v) {
                $new_arr[] = $v->filter_id;
            }
        }
        break;

    case 'delete_batch':
        if (isset($app['GET']['del']) && $app['GET']['del'] != '') {
            $query = new query('batches');
            $query->id = $app['GET']['del'];
            //pr($app['GET']['del']);
            $batches = $query->Delete();

            $query2 = new query('batch_filter_relation');
            $query2->Where = "Where batch_id =" . $app['GET']['del'];
            $query2->Delete_where();
        } else {
            set_alert('error', 'Incorrect information');
        }
        if (!(is_object($batches))) {
            redirect(app_url('batches', 'list', 'list', array(), true));
        }
        break;


    case 'list':
        //$offset = 0;
        //$limit = 10;
        $query = new query('batches');
        $query->Where = " order by ribbon_name_en asc";
        $batches = $query->ListOfAllRecords('object');
        $data = pagination('batches', $limit, $page_no, $url = '', 'batch_position asc');
        $batches = $data['show_record'];
        $pagination = $data['pagination'];
        //$total_records = count($batches);
        //$total_pages = ceil($total_records / $limit);
        //calculate offset
        //calculate sr number for table
        //if($p > 1)
        //{
        //$offset= ($p - 1)* $limit;
        //}
        //$query1 = new query('batches');
        //$query1->Where = " order by ribbon_name_en asc LIMIT {$offset}, {$limit}";
        //$query1->print=1;
        //$batches = $query1->ListOfAllRecords('object');
        //pr($total_pages);
        break;

    case 'batch_image':
        $query = new query('batches');
        $query->Where = " where type = '1'";
        $get_batches = $query->ListOfAllRecords();


        $query = new query('batches');
        $query->Where = " where type = '2'";
        $get_loc_batch = $query->ListOfAllRecords();

        $query = new query('ribbon_location');
        $query->Where = " order by position";
        $get_location = $query->ListOfAllRecords();

        if (isset($app['POST']['add_image'])) {
            $msg = '';
            $image_data_array = array();
            $batch_id = (isset($app['POST']['num_batches']) && $app['POST']['num_batches'] != '') ? $app['POST']['num_batches'] : 0;
            if ($batch_id != 0) {
                $batch_img_array = $_FILES['image_name'];
                for ($i = 1; $i <= 5; $i++) {
                    if ($batch_img_array['name'][$i] != '') {
                        $image_data_array['name'] = $batch_img_array['name'][$i];
                        $image_data_array['type'] = $batch_img_array['type'][$i];
                        $image_data_array['tmp_name'] = $batch_img_array['tmp_name'][$i];
                        $image_data_array['error'] = $batch_img_array['error'][$i];
                        $image_data_array['size'] = $batch_img_array['size'][$i];
                        if ($image_data_array['size'] > 2097152) {
                            set_alert('error', "File size must be less than 2 mega bytes");
                        } else if (($image_data_array['type'] != "image/jpeg") && ($image_data_array['type'] != "image/jpg") && ($image_data_array['type'] != "image/png")) {
                            set_alert('error', "File should be jpeg,jpg or png type");
                        } else {
                            $final_img = str_replace(" ", "_", $image_data_array['name']);
                            $move = move_uploaded_file($image_data_array['tmp_name'], DIR_FS_UPLOADS . "batch/" . $final_img);
                            if ($move) {
                                $query = new query('batch_images');
                                $query->Data['batch_id'] = $batch_id;
                                $query->Data['batch_image'] = $final_img;
                                $query->Data['number'] = $i;
                                if ($query->Insert()) {
                                }
                            }
                        }
                    }
                }
                set_alert('success', "Images updated for batches.");
                redirect(app_url('batches', 'batch_image', 'batch_image', array('id' => $batch_id), true));
            } else {
                set_alert('error', "Please select batch name for number");
            }
        }

        if (isset($app['POST']['add_location_image'])) {
            $msg = '';
            $image_data_loc = array();
            $batch_id_loc = (isset($app['POST']['loc_batches']) && $app['POST']['loc_batches'] != '') ? $app['POST']['loc_batches'] : 0;
            if ($batch_id_loc != 0) {
                $batch_img_array = $_FILES['image_loc'];
                foreach ($batch_img_array['name'] as $key => $value) {
                    if ($batch_img_array['name'][$key] != '') {
                        $image_data_loc['name'] = $batch_img_array['name'][$key];
                        $image_data_loc['type'] = $batch_img_array['type'][$key];
                        $image_data_loc['tmp_name'] = isset($batch_img_array['tmp_name'][$key]) ? $batch_img_array['tmp_name'][$key] : $batch_img_array['name'][$key];
                        $image_data_loc['error'] = $batch_img_array['error'][$key];
                        $image_data_loc['size'] = $batch_img_array['size'][$key];
                        if ($image_data_loc['size'] > 2097152) {
                            set_alert('error', "File size must be less than 2 mega bytes");
                        } else if (($image_data_loc['type'] != "image/jpeg") && ($image_data_loc['type'] != "image/jpg") && ($image_data_loc['type'] != "image/png")) {
                            set_alert('error', "File should be jpeg,jpg or png type");
                        } else {
                            $final_image = str_replace(" ", "_", $image_data_loc['name']);
                            $move = move_uploaded_file($image_data_loc['tmp_name'], DIR_FS_UPLOADS . "batch/" .$final_image );
                            if ($move) {
                                $query = new query('batch_images');
                                $query->Data['batch_id'] = $batch_id_loc;
                                $query->Data['batch_image'] = $final_image;
                                $query->Data['location_id'] = $key;
                                if ($query->Insert()) {
                                    
                                }
                            }
                        }
                    }
                }
                set_alert('success', "Images updated for batches.");
                redirect(app_url('batches', 'batch_image', 'batch_image', array('id_loc' => $batch_id_loc), true));
            } else {
                set_alert('error', "Please select batch for location");
            }
        }
        break;
endswitch;
