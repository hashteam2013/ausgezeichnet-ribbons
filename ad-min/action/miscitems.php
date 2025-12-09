<?php
global $app;
$id = isset($app['GET']['id']) ? $app['GET']['id'] : "0";
$id_loc = isset($app['GET']['id_loc']) ? $app['GET']['id_loc'] : "0";
$page_no = (isset($app['GET']['page_no']) && $app['GET']['page_no'] != "") ? $app['GET']['page_no'] : 1;
$limit = PAGE_CONTENT_LIMIT;
$msg = '';
switch ($action):
    case 'add':
        if (isset($app['POST']['add'])) {
            //pr($app['POST']);
            if (trim($app['POST']['rnameen']) == '') {
                $msg = 'Please enter english name';
            } elseif (trim($app['POST']['rnamedr']) == '') {
                $msg = 'Please enter german name';
            } else {
                $queryObj = new query('batches');
                $queryObj->Field = " id";
                $queryObj->Where = " where ribbon_name_en = '" . $app['POST']['rnameen'] . "'";
                $object = $queryObj->DisplayOne();
                if (!is_object($object)) {

           if (!isset($_FILES['upload_image']['name']) || $_FILES['upload_image']['name'] == '')
	{
		$name="leer.png";
	}
	else
	{
		$name=$_FILES['upload_image']['name'];
	}

                    if ($name != '') {
                        $file_name = $name;

	         if($file_name!="leer.png")
		{
	                        if (file_exists(DIR_FS_UPLOADS . "batch/" . $file_name)) {
	                            $i = 1;
	                            while (file_exists(DIR_FS_UPLOADS . "batch/" . $i . "_" . $file_name)) {
	                                $i++;
	                            }
	                            $file_name = $i . "_" . str_replace(" ", "_", $file_name);
	                        }

                        $file_tmp = $_FILES['upload_image']['tmp_name'];
                        $move = move_uploaded_file($file_tmp, DIR_FS_UPLOADS . "batch/" . $file_name);
	       }
		else
	{
		 $move='1';
	}

                        if ($move) {
                            $query = new query('batches');
                            $query->Data['ribbon_name_en'] = $app['POST']['rnameen'];
                            $query->Data['ribbon_name_dr'] = $app['POST']['rnamedr'];
                            $query->Data['batch_image'] = $file_name;
                            $query->Data['webshop_title_en'] = $app['POST']['webtten'];
                            $query->Data['webshop_title_dr'] = $app['POST']['webttdr'];

                            $query->Data['desc_en'] = $app['POST']['desen'];
                            $query->Data['desc_dr'] = $app['POST']['desdr'];
                            $query->Data['unit_price'] = $app['POST']['uprice'];
                            $query->Data['level'] = $app['POST']['level'];

                           $query->Data['batch_position'] = $app['POST']['btposition'];

                            $query->Data['is_batch'] = '0';
                            $query->Data['is_active'] = isset($app['POST']['active']) ? '1' : '0';
                            $query->Data['is_deleted'] = '0';
                            if ($query->Insert()) {
                                $query = new query('batches');
                                $batch_id = $query->GetMaxId();
                                $categories = $app['POST']['categories_name'];
                                $additional_categories = $app['POST']['additional_categories_name'];

                                if (!empty($categories)) {
                                    foreach ($categories as $k => $v) {
                                        $query1 = new query('batch_filter_relation');
                                        $query1->Data['batch_id'] = $batch_id;
                                        $query1->Data['rel_type'] = "categories";
                                        $query1->Data['filter_id'] = $v;
                                        $query1->Insert();
                                    }
				}
                                if (!empty($additional_categories)) {
                                    foreach ($additional_categories as $k => $v) {
                                        $query1 = new query('batch_filter_relation');
                                        $query1->Data['batch_id'] = $batch_id;
                                        $query1->Data['rel_type'] = "additional_categories";
                                        $query1->Data['filter_id'] = $v;
                                        $query1->Insert();
                                    }
                                }

                            $query = new query('Descriptions');
                            $query->Data['Text'] = $app['POST']['text'];
                             $query->Data['product_id'] = $batch_id;
		$query->Insert();

                                set_alert('success', "New batch added successfully");
                                redirect(app_url('miscitems', 'list', 'list', array(), true));
                            } else {
                                $msg = 'Error occurred while updating account info. Please try again!';
                            }
                        } else {
                            $msg = 'Error occurred while uploading image file. Please try again!';
                        }
                    } 
                } else {
                    $msg = 'Batch name already exist!';
                }
            }
        }
        set_alert('error', $msg);
        $query = new query('categories');
        $query->Where = " order by position"; //where is_active = 1
        $categories = $query->ListOfAllRecords('object');

        $query = new query('additional_categories');
        $query->Where = " order by position"; //where is_active = 1
        $additional_categories = $query->ListOfAllRecords('object');

        /* start new updates phase 2 */
        $query = new query('districts');
        $query->Where = "where is_active = 1 order by position";
        $dist_ph2 = $query->ListOfAllRecords('object');
        /* end new updates phase 2 */

        $query = new query('departments');
        $query->Where = " where is_active = 1 order by position";
        $departments = $query->ListOfAllRecords('object');

        $query = new query('departments_new');
        $query->Where = " where is_active = 1 order by position";
        $departments_new = $query->ListOfAllRecords('object');

        $query = new query('add_cat');
        $query->Where = " where is_active = 1 order by position";
        $add_cats = $query->ListOfAllRecords('object');

        $query = new query('add_cat_sub');
        $query->Where = "where is_active = 1 order by position";
        $add_cat_subs = $query->ListOfAllRecords('object');

        $query = new query('organizations');
        $query->Where = "where is_active = 1 order by position";
        $organizations = $query->ListOfAllRecords('object');

        $query = new query('communities');
        $query->Where = "where is_active = 1 order by position";
        $communities = $query->ListOfAllRecords('object');

        $query_ia = new query('international_authorities');
        $query_ia->Field = "id,name_en";
        $query_ia->Where = "where is_active = 1";
        $ia = $query_ia->ListOfAllRecords('object');

        $query_ia = new query('international_authorities_sublevel1');
        $query_ia->Field = "id,name_en";
        $query_ia->Where = "where is_active = 1";
        $ia_lev1 = $query_ia->ListOfAllRecords('object');

        $query_ia = new query('international_authorities_sublevel2');
        $query_ia->Field = "id,name_en";
        $query_ia->Where = "where is_active = 1";
        $ia_lev2 = $query_ia->ListOfAllRecords('object');
        break;

    case 'edit':
        if (isset($app['POST']['update'])) {
            // pr($app['POST']);
            if (trim($app['POST']['rnameen']) == '') {
                $msg = 'Please enter Ribbon english name';
            } elseif (trim($app['POST']['rnamedr']) == '') {
                $msg = 'Please enter Ribbon german name';
            } 

 	else {
                $query = new query('batches');
                $query->Data['id'] = $id;
                $query->Data['ribbon_name_en'] = $app['POST']['rnameen'];
                $query->Data['ribbon_name_dr'] = $app['POST']['rnamedr'];



           if (!isset($_FILES['upload_image']['name']) && $_FILES['upload_image']['name'] == '')
	{
		$name="leer.png";
	}
	else
	{
		$name=$_FILES['upload_image']['name'];
	}

                    if ($name != '') {
                        $file_name = $name;

	         if($file_name!="leer.png")
		{

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

	}

                    $query->Data['batch_image'] = $file_name;
                }
                $query->Data['webshop_title_en'] = $app['POST']['webtten'];
                $query->Data['webshop_title_dr'] = $app['POST']['webttdr'];
                $query->Data['type'] = $app['POST']['ribloc'];
                $query->Data['desc_en'] = $app['POST']['desen'];
                $query->Data['desc_dr'] = $app['POST']['desdr'];
                $query->Data['level'] = $app['POST']['level'];

                $query->Data['unit_price'] = $app['POST']['uprice'];
                $query->Data['batch_position'] = $app['POST']['btposition'];
                $query->Data['is_active'] = isset($app['POST']['active']) ? '1' : '0';
                $query->Data['miniature_id'] = $app['POST']['miniature_id'];


                $query->Where = " where id = $id";
                if ($query->UpdateCustom()) {
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
                    $additional_categories = $app['POST']['additional_categories_name'];



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

                    $query1 = new query('batch_filter_relation');
                    $query1->Data['batch_id'] = $id;
                    $query1->Field = "filter_id";
                    $query1->Where = "where batch_id = $id and rel_type = 'additional_categories'";
                    $add_existing_categories_arr = $query1->ListOfAllRecords('object');
                    $add_existing_categories = array();
                    foreach ($add_existing_categories_arr as $kk => $vv) {
                        $add_existing_categories[$vv->filter_id] = $vv->filter_id;
                    }
                    $add_new_categories = $app['POST']['additional_categories_name'];
                    foreach ($add_new_categories as $kk => $vv) {
                        if (array_key_exists($vv, $add_existing_categories)) {
                            unset($add_existing_categories[$vv]);
                        } else {
                            $query1 = new query('batch_filter_relation');
                            $query1->Data['batch_id'] = $id;
                            $query1->Data['rel_type'] = "additional_categories";
                            $query1->Data['filter_id'] = $vv;
                            $query1->Insert();
                        }
                    }
                    if (!empty($add_existing_categories)) {
                        foreach ($add_existing_categories as $kk => $vv) {
                            $query1 = new query('batch_filter_relation');
                            $query1->Where = " where batch_id = $id and rel_type = 'additional_categories' and filter_id = $vv";
                            $query1->Delete_where();
                        }
                    }

                    $query1 = new query('batch_filter_relation');
                    $query1->Data['batch_id'] = $id;
                    $query1->Field = "filter_id";
                    $query1->Where = "where batch_id = $id and rel_type = 'add_cat_sub'";
                    $add_existing_categories_arr_sub = $query1->ListOfAllRecords('object');
                    $add_existing_categories_sub = array();
                    foreach ($add_existing_categories_arr_sub as $kk => $vv) {
                        $add_existing_categories_sub[$vv->filter_id] = $vv->filter_id;
                    }
                    $add_new_categories_sub = $app['POST']['additional_categories_name_sub'];
                    foreach ($add_new_categories_sub as $kk => $vv) {
                        if (array_key_exists($vv, $add_existing_categories_sub)) {
                            unset($add_existing_categories_sub[$vv]);
                        } else {
                            $query1 = new query('batch_filter_relation');
                            $query1->Data['batch_id'] = $id;
                            $query1->Data['rel_type'] = "add_cat_sub";
                            $query1->Data['filter_id'] = $vv;
                            $query1->Insert();
                        }
                    }
                    if (!empty($add_existing_categories_sub)) {
                        foreach ($add_existing_categories_sub as $kk => $vv) {
                            $query1 = new query('batch_filter_relation');
                            $query1->Where = " where batch_id = $id and rel_type = 'add_cat_sub' and filter_id = $vv";
                            $query1->Delete_where();
                        }
                    }


        
                  $query = new query('Descriptions');
                  $query->Where = " where product_id = $id ";
	    $text= $query->DisplayOne();

        if (!(is_object($text)))
	{
                  $query = new query('Descriptions');
                  $query->Data['Text'] = $app['POST']['text'];
                  $query->Data['product_id'] = $id;
	   $query->Insert();   
	}
	else
	{
                  $query->Data['Text'] = $app['POST']['text'];
	   $query->UpdateCustom();
	}

                    set_alert('success', "Account info updated successfully");
                    redirect(app_url('miscitems', 'edit', 'edit', array('id' => $id), true));
                } else {
                    $msg = 'Error occurred while updating account info. Please try again!';
                }
            }
            set_alert('error', $msg);
        }

        $query = new query('batches');
        $query->Where = "where id = " . $id;
        $batches = $query->DisplayOne();
        if (!(is_object($batches))) {
            redirect(app_url('miscitems', 'list', 'list', array(), true));
        }

                  $query = new query('Descriptions');
                  $query->Where = " where product_id = $id ";
	    $text= $query->DisplayOne();


        $query = new query('categories');
        $query->Where = "where is_active < 2 order by position";
        $categories = $query->ListOfAllRecords('object');

        $query = new query('additional_categories');
        $query->Where = " order by position"; //where is_active = 1
        $additional_categories = $query->ListOfAllRecords('object');

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


        $queryCS = new query('batch_filter_relation');
        $queryCS->Field = "filter_id";
        $queryCS->Where = "where batch_id = $id and rel_type = 'additional_categories' ";
        $add_cust_categories = $queryCS->ListOfAllRecords('object');
        $add_new_arr = array();
        if (!empty($add_cust_categories)) {
            foreach ($add_cust_categories as $k => $v) {
                $add_new_arr[] = $v->filter_id;
            }
        }

        $queryCS = new query('batch_filter_relation');
        $queryCS->Field = "filter_id";
        $queryCS->Where = "where batch_id = $id and rel_type = 'add_cat_sub' ";
        $add_cust_categories_sub = $queryCS->ListOfAllRecords('object');
        $add_new_arr_sub = array();
        if (!empty($add_cust_categories_sub)) {
            foreach ($add_cust_categories_sub as $k => $v) {
                $add_new_arr_sub[] = $v->filter_id;
            }
        }


        $query = new query('districts');
        $query->Where = "where is_active = 1 order by position";
        $districts = $query->ListOfAllRecords('object');

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

        /*         * ********international authority sublevel1************** */
        $queryCS_ia1 = new query('batch_filter_relation');
        $queryCS_ia1->Field = "filter_id";
        $queryCS_ia1->Where = "where batch_id = $id and rel_type = 'ia_lev1'";
        $cust_organizations_ia1 = $queryCS_ia1->ListOfAllRecords('object');
        $new_arr = array();
        if (!empty($cust_organizations_ia1)) {
            foreach ($cust_organizations_ia1 as $k => $v) {
                $new_arr[] = $v->filter_id;
            }
        }
        $query_ia_1 = new query('international_authorities_sublevel1');
        $query_ia_1->Field = "id,name_en";
        $query_ia_1->Where = "where is_active = 1";
        $ia_lev1 = $query_ia_1->ListOfAllRecords('object');

        /*         * *********international authority sublevel2************** */
        $queryCS_ia2 = new query('batch_filter_relation');
        $queryCS_ia2->Field = "filter_id";
        $queryCS_ia2->Where = "where batch_id = $id and rel_type = 'ia_lev2'";
        $cust_organizations_ia2 = $queryCS_ia2->ListOfAllRecords('object');
        $new_arr = array();
        if (!empty($cust_organizations_ia2)) {
            foreach ($cust_organizations_ia2 as $k => $v) {
                $new_arr[] = $v->filter_id;
            }
        }

        $queryCS_ia2 = new query('international_authorities_sublevel2');
        $queryCS_ia2->Field = "id,name_en";
        $queryCS_ia2->Where = "where is_active = 1";
        $ia_lev2 = $queryCS_ia2->ListOfAllRecords('object');

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


        /* custom subdistrict */
        $queryCS = new query('batch_filter_relation');
        $queryCS->Field = "filter_id";
        $queryCS->Where = "where batch_id = $id and rel_type = 'subdistricts' ";
        $cust_subdistricts = $queryCS->ListOfAllRecords('object');
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

        $query = new query('add_cat');
        $query->Where = "where is_active = 1 order by position";
        $add_cats = $query->ListOfAllRecords('object');
        $queryCS = new query('batch_filter_relation');
        $queryCS->Field = "filter_id";
        $queryCS->Where = "where batch_id = $id and rel_type = 'additional_categories' ";
        $cust_add_cats = $queryCS->ListOfAllRecords('object');
        $new_arr = array();
        if (!empty($cust_add_cats)) {
            foreach ($cust_add_cats as $k => $v) {
                $new_arr[] = $v->filter_id;
            }
        }

        $query = new query('add_cat_sub');
        $query->Where = "where is_active = 1 order by position";
        $add_cat_subs = $query->ListOfAllRecords('object');
        $queryCS = new query('batch_filter_relation');
        $queryCS->Field = "filter_id";
        $queryCS->Where = "where batch_id = $id and rel_type = 'add_cat_sub' ";
        $cust_add_cat_subs = $queryCS->ListOfAllRecords('object');
        $new_arr_sub = array();
        if (!empty($cust_add_cats)) {
            foreach ($cust_add_cat_subs as $k => $v) {
                $new_arr_sub[] = $v->filter_id;
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


        $query = new query('communities');
        $query->Field = "id,name_en";
        $query->Where = "where is_active = 1";
        $communities = $query->ListOfAllRecords('object');

        $queryCS = new query('batch_filter_relation');
        $queryCS->Field = "filter_id";
        $queryCS->Where = "where batch_id = $id and rel_type = 'communities'";
        $cust_communities = $queryCS->ListOfAllRecords('object');
        $new_arr = array();
        if (!empty($cust_communities)) {
            foreach ($cust_communities as $k => $v) {
                $new_arr[] = $v->filter_id;
            }
        }




	     //Miniatures
                    $query1 = new query('miniatures');
  //                  $query1->Data['miniature_id'] = $id;
//                    $query1->Field = "filter_id";
  //                  $query1->Where = " * ";
                    $miniatures= $query1->ListOfAllRecords('object');


        /* district dropdown */
        $query1 = new query('batch_filter_relation');
        $query1->Data['batch_id'] = $id;
        $query1->Field = "filter_id";
        $query1->Where = "where batch_id = $id and rel_type = 'districts'";
        $seldistrict = $query1->DisplayOne();

        if (!empty($seldistrict) || $seldistrict != '0') {
            $query1 = new query('sub_districts');
            $query1->Where = "where district_id = $seldistrict->filter_id and is_active = '1'";
            $all_subdistrict = $query1->ListOfAllRecords();
        }

        /* subdistrict dropdown */
        $query1 = new query('batch_filter_relation');
        $query1->Data['batch_id'] = $id;
        $query1->Field = "filter_id";
        $query1->Where = "where batch_id = $id and rel_type = 'subdistricts'";
        $existing_subdistrict = $query1->DisplayOne();

        /* community dropdown */
        if (!empty($existing_subdistrict) || $existing_subdistrict != '0') {
            $query1 = new query('communities');
            $query1->Where = "where dist_id = $seldistrict->filter_id and subdist_id = $existing_subdistrict->filter_id and is_active = '1'";
            $all_com = $query1->ListOfAllRecords();
            //pr($all_com);
        }
        $query1 = new query('batch_filter_relation');
        $query1->Data['batch_id'] = $id;
        $query1->Field = "filter_id";
        $query1->Where = "where batch_id = $id and rel_type = 'communities'";
        $existing_commi = $query1->DisplayOne('object');

        if (!empty($existing_commi) || $existing_commi != '0') {
            $query1 = new query('communities');
            $query1->Where = "where subdist_id = $existing_subdistrict->filter_id and is_active = '1'";
            $all_commi = $query1->ListOfAllRecords('object');
        }
        
        /* borough dropdown */
        $query1 = new query('batch_filter_relation');
        $query1->Data['batch_id'] = $id;
        $query1->Field = "filter_id";
        $query1->Where = "where batch_id = $id and rel_type = 'boroughs'";
        $selboro = $query1->DisplayOne('object');
        if (!empty($selboro) || $selboro != '0') {
            $query1 = new query('boroughs');
            $query1->Where = "where dist_id = $seldistrict->filter_id and subdist_id =  $existing_subdistrict->filter_id and comm_id = $existing_commi->filter_id and is_active = '1'";
            $all_boro = $query1->ListOfAllRecords();
        }
        /* ia dropdown */
        $query1 = new query('batch_filter_relation');
        $query1->Data['batch_id'] = $id;
        $query1->Field = "filter_id";
        $query1->Where = "where batch_id = $id and rel_type = 'ia'";
        $selia = $query1->DisplayOne('object');

        if (!empty($selia) || $selia != '0') {
            $query1 = new query('international_authorities_sublevel1');
            $query1->Where = "where ia_id = $selia->filter_id and is_active = '1'";
            $all_ia = $query1->ListOfAllRecords('object');
        }

        $query1 = new query('batch_filter_relation');
        $query1->Data['batch_id'] = $id;
        $query1->Field = "filter_id";
        $query1->Where = "where batch_id = $id and rel_type = 'ia_lev1'";
        $selia1 = $query1->DisplayOne('object');

        /* ia2 dropdown */
        $query1 = new query('batch_filter_relation');
        $query1->Data['batch_id'] = $id;
        $query1->Field = "filter_id";
        $query1->Where = "where batch_id = $id and rel_type = 'ia_lev2'";
        $selia2 = $query1->DisplayOne('object');
        if (!empty($selia2) || $selia2 != '0') {
            $query1 = new query('international_authorities_sublevel2');
            $query1->Where = "where ia_id = $selia->filter_id and ia_lev1_id = $selia1->filter_id and is_active = '1'";
            //$query1->print=1;
            $all_ia2 = $query1->ListOfAllRecords();
            // pr($all_ia2);
        }
        break;

    case 'delete_batch':
        if (isset($app['GET']['del']) && $app['GET']['del'] != '') {
            $query = new query('batches');
            $query->id = $app['GET']['del'];
            $batches = $query->Delete();

            $query2 = new query('batch_filter_relation');
            $query2->Where = "Where batch_id =" . $app['GET']['del'];
            $query2->Delete_where();
        } else {
            set_alert('error', 'Incorrect information');
        }
        if (!(is_object($batches))) {
            redirect(app_url('miscitems', 'list', 'list', array(), true));
        }
        break;


    case 'list':
        $query = new query('batches');
        $query->Field = "batches.id as id, batches.ribbon_name_dr as ribbon_name_dr, batches.is_active as is_active, batches.is_batch as is_batch, batches.batch_position as batch_position, batches.batch_image as batch_image, batches.unit_price as unit_price";
        $query->Where = " WHERE is_batch=0 ";
        $query->Where .= " order by ribbon_name_dr asc";
        $batches = $query->ListOfAllRecords('object');
        break;


endswitch;
