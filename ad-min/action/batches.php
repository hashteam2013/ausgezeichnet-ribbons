<?php
// ini_set('display_errors', '1');
// ini_set('display_startup_errors', '1');
// error_reporting(E_ALL);
global $app;
$id = isset($app['GET']['id']) ? $app['GET']['id'] : "0";
$id_loc = isset($app['GET']['id_loc']) ? $app['GET']['id_loc'] : "0";
$page_no = (isset($app['GET']['page_no']) && $app['GET']['page_no'] != "") ? $app['GET']['page_no'] : 1;
$limit = PAGE_CONTENT_LIMIT;
$msg = '';
if (!function_exists('get_upload_error_msg')) {
    function get_upload_error_msg($code)
    {
        switch ($code) {
            case UPLOAD_ERR_INI_SIZE:
            case UPLOAD_ERR_FORM_SIZE:
                return 'Image is larger than the allowed limit.';
            case UPLOAD_ERR_PARTIAL:
                return 'Image was only partially uploaded.';
            case UPLOAD_ERR_NO_FILE:
                return 'No image was uploaded.';
            case UPLOAD_ERR_NO_TMP_DIR:
                return 'Missing temporary folder on server.';
            case UPLOAD_ERR_CANT_WRITE:
                return 'Server cannot write the uploaded file.';
            case UPLOAD_ERR_EXTENSION:
                return 'A PHP extension stopped the upload.';
            default:
                return 'Unexpected upload error (code ' . $code . ').';
        }
    }
}
switch ($action):
    case 'add':
        if (isset($app['POST']['add'])) {
           // pr($app['POST']);
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
            } elseif (trim($app['POST']['name_dist']) == '') {
                $msg = 'Please choose district name';
            } elseif (($_FILES['upload_image']['name']) == '') {
                $msg = 'Please choose batch image';
            } else {
                $queryObj = new query('batches');
                $queryObj->Field = " id";
                $queryObj->Where = " where ribbon_name_en = '" . $app['POST']['rnameen'] . "'";
                $object = $queryObj->DisplayOne();
                if (!is_object($object)) {
                    if (isset($_FILES['upload_image']['name']) && $_FILES['upload_image']['name'] != '') {
                        $upload = $_FILES['upload_image'];
                        $max_size = defined('MAX_UPLOAD_FILE_SIZE') ? MAX_UPLOAD_FILE_SIZE : 2097152;
                        $target_dir = DIR_FS_UPLOADS . "batch/";
                        if (!is_dir($target_dir)) {
                            mkdir($target_dir, 0775, true);
                        }
                        if ($upload['error'] !== UPLOAD_ERR_OK) {
                            $msg = 'Image upload failed: ' . get_upload_error_msg($upload['error']);
                        } elseif ($upload['size'] > $max_size) {
                            $msg = 'Image upload failed: file exceeds ' . round($max_size / 1048576, 2) . ' MB.';
                        } elseif (!is_uploaded_file($upload['tmp_name'])) {
                            $msg = 'Image upload failed: temporary upload missing.';
                        } elseif (!is_writable($target_dir)) {
                            $msg = 'Image upload failed: uploads/batch is not writable.';
                        } else {
                            $file_name = str_replace(" ", "_", basename($upload['name']));
                            if (file_exists($target_dir . $file_name)) {
                                $i = 1;
                                while (file_exists($target_dir . $i . "_" . $file_name)) {
                                    $i++;
                                }
                                $file_name = $i . "_" . $file_name;
                            }
                            $move = move_uploaded_file($upload['tmp_name'], $target_dir . $file_name);
                            if ($move) {
                            $query = new query('batches');
                            $query->Data['ribbon_name_en'] = $app['POST']['rnameen'];
                            $query->Data['ribbon_name_dr'] = $app['POST']['rnamedr'];
                            $query->Data['batch_image'] = $file_name;
                            $query->Data['webshop_title_en'] = $app['POST']['webtten'];
                            $query->Data['webshop_title_dr'] = $app['POST']['webttdr'];
                            $query->Data['type'] = $app['POST']['ribloc'];
                	$query->Data['type_number'] = $app['POST']['type_number'];
                            // ItemType is required in DB; default to 0 when not provided
                            $query->Data['ItemType'] = isset($app['POST']['ItemType']) && $app['POST']['ItemType'] !== '' ? intval($app['POST']['ItemType']) : 0;
                            $query->Data['desc_en'] = $app['POST']['desen'];
                            $query->Data['desc_dr'] = $app['POST']['desdr'];
                            // store optional remarks; fall back to a neutral placeholder to satisfy NOT NULL
                            $query->Data['comment'] = isset($app['POST']['comment']) && $app['POST']['comment'] !== '' ? $app['POST']['comment'] : 'N/A';
                            $query->Data['confirm_comment'] = isset($app['POST']['confirm_comment']) && $app['POST']['confirm_comment'] !== '' ? $app['POST']['confirm_comment'] : 'N/A';
                            $query->Data['level'] = $app['POST']['level'];
                            $query->Data['grade'] = $app['POST']['grade'];
                            $query->Data['value'] = $app['POST']['rb_value'];
                            $query->Data['serious_level'] = $app['POST']['serious_level'];
                             $query->Data['SetID'] = $app['POST']['SetID'];
                            $query->Data['unit_price'] = $app['POST']['uprice'];
                            $query->Data['batch_position'] = $app['POST']['btposition'];
                            $query->Data['miniature_id'] = $app['POST']['miniature_id'];
                            // generate url slug from English name (fallback to uniqid to keep non-null)
                            $slugSource = isset($app['POST']['rnameen']) ? $app['POST']['rnameen'] : uniqid();
                            $slug = strtolower(preg_replace('/[^a-z0-9]+/', '-', trim($slugSource)));
                            $slug = trim($slug, '-');
                            if ($slug === '') {
                                $slug = uniqid();
                            }
                            $query->Data['url_slug'] = $slug;
                            // defaults for required numeric fields
                            // fallback to 0 to satisfy NOT NULL integer columns
                            $query->Data['quantity'] = isset($app['POST']['quantity']) && $app['POST']['quantity'] !== '' ? intval($app['POST']['quantity']) : 0;
                            $query->Data['is_available'] = 1;
                            $query->Data['sale_price'] = isset($app['POST']['sale_price']) && $app['POST']['sale_price'] !== '' ? $app['POST']['sale_price'] : 0;
                            // ensure required discount fields are always populated
                            $query->Data['discount_type'] = isset($app['POST']['discount_type']) && $app['POST']['discount_type'] !== '' ? $app['POST']['discount_type'] : 'none';
                            $query->Data['discount'] = isset($app['POST']['discount']) && $app['POST']['discount'] !== '' ? $app['POST']['discount'] : 0;
                            $query->Data['weight'] = isset($app['POST']['weight']) && $app['POST']['weight'] !== '' ? $app['POST']['weight'] : 0;
                            $query->Data['width'] = isset($app['POST']['width']) && $app['POST']['width'] !== '' ? $app['POST']['width'] : 0;
                            // ensure non-null date_add to satisfy NOT NULL column
                            $query->Data['date_add'] = 'now';
                            // ensure numeric code to prevent MySQL truncation errors on int column
                            $nextCode = isset($app['POST']['code']) && $app['POST']['code'] !== ''
                                ? intval($app['POST']['code'])
                                : (intval($query->GetMaxId()) + 1);
                            $query->Data['code'] = $nextCode;
                            $query->Data['is_batch'] = '1';
                            $query->Data['is_active'] = isset($app['POST']['active']) ? '1' : '0';
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
                                if (!empty($app['POST']['name_dist'])) {
                                    $query1 = new query('batch_filter_relation');
                                    $query1->Data['batch_id'] = $batch_id;
                                    $query1->Data['rel_type'] = "districts";
                                    $query1->Data['filter_id'] = $app['POST']['name_dist'];
                                    $query1->Insert();
                                }
                                $subdist = isset($app['POST']['name_subdist']) ? $app['POST']['name_subdist'] : '0';
                                $query1 = new query('batch_filter_relation');
                                $query1->Data['batch_id'] = $batch_id;
                                $query1->Data['rel_type'] = "subdistricts";
                                $query1->Data['filter_id'] = $subdist;
                                $query1->Insert();

                                $comm = isset($app['POST']['name_comm']) ? $app['POST']['name_comm'] : '0';
                                $query1 = new query('batch_filter_relation');
                                $query1->Data['batch_id'] = $batch_id;
                                $query1->Data['rel_type'] = "communities";
                                $query1->Data['filter_id'] = $comm;
                                $query1->Insert();
                                
                                $boro = isset($app['POST']['name_boro'])?$app['POST']['name_boro']:'0';
                                $query1 = new query('batch_filter_relation');
                                $query1->Data['batch_id'] = $batch_id;
                                $query1->Data['rel_type'] = "boroughs";
                                $query1->Data['filter_id'] = $boro;
                                $query1->Insert();

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
                                $inter_auth = isset($app['POST']['name_ia']) ? $app['POST']['name_ia'] : '';
                                $query1 = new query('batch_filter_relation');
                                $query1->Data['batch_id'] = $batch_id;
                                $query1->Data['rel_type'] = "ia";
                                $query1->Data['filter_id'] = $inter_auth;
                                $query1->Insert();

                                $inter_auth_lev1 = isset($app['POST']['name_ia1']) ? $app['POST']['name_ia1'] : '';
                                $query1 = new query('batch_filter_relation');
                                $query1->Data['batch_id'] = $batch_id;
                                $query1->Data['rel_type'] = "ia_lev1";
                                $query1->Data['filter_id'] = $inter_auth_lev1;
                                $query1->Insert();

                                $inter_auth_lev2 = isset($app['POST']['name_ia2']) ? $app['POST']['name_ia2'] : '';
                                $query1 = new query('batch_filter_relation');
                                $query1->Data['batch_id'] = $batch_id;
                                $query1->Data['rel_type'] = "ia_lev2";
                                $query1->Data['filter_id'] = $inter_auth_lev2;
                                $query1->Insert();
                                set_alert('success', "New batch added successfully");
                                redirect(app_url('batches', 'list', 'list', array(), true));
                            } else {
                                $msg = 'Error occurred while updating account info. Please try again!';
                            }
                            } else {
                                $msg = 'Error occurred while uploading image file. Please try again!';
                            }
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
        $query->Where = " order by position"; //where is_active = 1
        $categories = $query->ListOfAllRecords('object');

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
        // Miniatures list used by add view
        $query1 = new query('miniatures');
        $miniatures = $query1->ListOfAllRecords('object');
        break;

    case 'edit':
        if (isset($app['POST']['update'])) {
            // pr($app['POST']);
            if (trim($app['POST']['rnameen']) == '') {
                $msg = 'Please enter Ribbon english name';
            } elseif (trim($app['POST']['rnamedr']) == '') {
                $msg = 'Please enter Ribbon german name';
            } elseif (trim($app['POST']['btposition']) == '') {
                $msg = 'Please enter Batch position';
            } 
        //elseif (trim($app['POST']['name_dist']) == '') {
       //         $msg = 'Please choose district for batch';
//            }
 else {
                $query = new query('batches');
                $query->Data['id'] = $id;
                $query->Data['ribbon_name_en'] = $app['POST']['rnameen'];
                $query->Data['ribbon_name_dr'] = $app['POST']['rnamedr'];
                if (isset($_FILES['upload_image']['name']) && $_FILES['upload_image']['name'] != '') {
                    $upload = $_FILES['upload_image'];
                    $max_size = defined('MAX_UPLOAD_FILE_SIZE') ? MAX_UPLOAD_FILE_SIZE : 2097152;
                    $target_dir = DIR_FS_UPLOADS . "batch/";
                    if (!is_dir($target_dir)) {
                        mkdir($target_dir, 0775, true);
                    }
                    if ($upload['error'] !== UPLOAD_ERR_OK) {
                        $msg = 'Image upload failed: ' . get_upload_error_msg($upload['error']);
                    } elseif ($upload['size'] > $max_size) {
                        $msg = 'Image upload failed: file exceeds ' . round($max_size / 1048576, 2) . ' MB.';
                    } elseif (!is_uploaded_file($upload['tmp_name'])) {
                        $msg = 'Image upload failed: temporary upload missing.';
                    } elseif (!is_writable($target_dir)) {
                        $msg = 'Image upload failed: uploads/batch is not writable.';
                    } else {
                        $file_name = str_replace(" ", "_", basename($upload['name']));
                        if (file_exists($target_dir . $file_name)) {
                            $i = 1;
                            while (file_exists($target_dir . $i . "_" . $file_name)) {
                                $i++;
                            }
                            $file_name = $i . "_" . $file_name;
                        }
                        $upload_folder = $target_dir . $file_name;
                        $move = move_uploaded_file($upload['tmp_name'], $upload_folder);
                        if ($move) {
                            $query->Data['batch_image'] = $file_name;
                        } else {
                            $msg = 'Error occurred while uploading image file. Please try again!';
                        }
                    }
                }
                $query->Data['webshop_title_en'] = $app['POST']['webtten'];
                $query->Data['webshop_title_dr'] = $app['POST']['webttdr'];
                $query->Data['type'] = $app['POST']['ribloc'];
                $query->Data['type_number'] = $app['POST']['type_number'];
                $query->Data['desc_en'] = $app['POST']['desen'];
                $query->Data['desc_dr'] = $app['POST']['desdr'];

                // keep comment non-null to satisfy schema constraints
                $query->Data['comment'] = isset($app['POST']['comment']) && $app['POST']['comment'] !== '' ? $app['POST']['comment'] : 'N/A';
                $query->Data['confirm_comment'] = isset($app['POST']['confirm_comment']) && $app['POST']['confirm_comment'] !== '' ? $app['POST']['confirm_comment'] : 'N/A';

                $query->Data['level'] = $app['POST']['level'];
                $query->Data['grade'] = $app['POST']['grade'];
                $query->Data['value'] = $app['POST']['rb_value'];
                $query->Data['serious_level'] = $app['POST']['serious_level'];
                $query->Data['SetID'] = $app['POST']['SetID'];
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
                    /* district update */
                    $new_departments = isset($app['POST']['name_dist']) ? $app['POST']['name_dist'] : '';
                    $query1 = new query('batch_filter_relation');
                    $query1->Where = "where batch_id = $id and rel_type = 'districts'";
                    $is_dist = $query1->displayOne('object');
                    if (!empty($is_dist) || $is_dist != '0') {
                        $query1 = new query('batch_filter_relation');
                        $query1->Data['filter_id'] = $new_departments;
                        $query1->Data['rel_type'] = 'districts';
                        $query1->Where = "where batch_id = $id and rel_type = 'districts'";
                        $query1->UpdateCustom();
                    } else {
                        $query1 = new query('batch_filter_relation');
                        $query1->Data['filter_id'] = $new_departments;
                        $query1->Data['rel_type'] = 'districts';
                        $query1->Data['batch_id'] = $id;
                        $query1->Insert();
                    }
                 
                    /* subdistrict update */
                    // check if already exists
                    $new_sub = isset($app['POST']['name_subdist']) ? $app['POST']['name_subdist'] : '';
                    $query1 = new query('batch_filter_relation');
                    $query1->Where = "where batch_id = $id and rel_type = 'subdistricts'";
                    $is_sub = $query1->displayOne('object');
                    if (!empty($is_sub) || $is_sub != '0') {
                        $query1 = new query('batch_filter_relation');
                        $query1->Data['filter_id'] = $new_sub;
                        $query1->Data['rel_type'] = 'subdistricts';
                        $query1->Where = "where batch_id = $id and rel_type = 'subdistricts'";
                        $query1->UpdateCustom();
                    } else {
                        $query1 = new query('batch_filter_relation');
                        $query1->Data['filter_id'] = $new_sub;
                        $query1->Data['rel_type'] = 'subdistricts';
                        $query1->Data['batch_id'] = $id;
                        $query1->Insert();
                    }

                    /* communities update */
                    $new_comm = isset($app['POST']['name_comm']) ? $app['POST']['name_comm'] : '0';
                    // check if already exists
                    $query1 = new query('batch_filter_relation');
                    $query1->Where = "where batch_id = $id and rel_type = 'communities'";
                    $is_com = $query1->displayOne('object');
                    if (!empty($is_com) || $is_com != '0') {
                        $query1 = new query('batch_filter_relation');
                        $query1->Data['filter_id'] = $new_comm;
                        $query1->Where = " where batch_id = $id and rel_type = 'communities'";
                        // $query1->print=1;
                        $query1->UpdateCustom();
                    } else {
                        $query1 = new query('batch_filter_relation');
                        $query1->Data['filter_id'] = $new_comm;
                        $query1->Data['rel_type'] = 'communities';
                        $query1->Data['batch_id'] = $id;
                        $query1->Insert();
                    }
                    
                    /* brough update */
                    $new_boro = isset($app['POST']['name_boro']) ? $app['POST']['name_boro'] : '0';
                    // check if already exists
                    $query1 = new query('batch_filter_relation');
                    $query1->Where = "where batch_id = $id and rel_type = 'boroughs'";
                    $is_bor = $query1->displayOne('object');
                    if (!empty($is_bor) || $is_bor != '0') {
                        $query1 = new query('batch_filter_relation');
                        $query1->Data['filter_id'] = $new_boro;
                        $query1->Where = " where batch_id = $id and rel_type = 'boroughs'";
                        // $query1->print=1;
                        $query1->UpdateCustom();
                    } else {
                        $query1 = new query('batch_filter_relation');
                        $query1->Data['filter_id'] = $new_boro;
                        $query1->Data['rel_type'] = 'boroughs';
                        $query1->Data['batch_id'] = $id;
                        $query1->Insert();
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

                    /* ia update */
                    $new_ia = isset($app['POST']['name_ia']) ? $app['POST']['name_ia'] : '';
                    $query1 = new query('batch_filter_relation');
                    $query1->Where = "where batch_id = $id and rel_type = 'ia'";
                    $is_ia = $query1->displayOne('object');
                    if (!empty($is_ia) || $is_ia != '0') {
                        $query1 = new query('batch_filter_relation');
                        $query1->Data['filter_id'] = $new_ia;
                        $query1->Data['rel_type'] = 'ia';
                        $query1->Where = "where batch_id = $id and rel_type = 'ia'";
                        $query1->UpdateCustom();
                    } else {
                        $query1 = new query('batch_filter_relation');
                        $query1->Data['filter_id'] = $new_ia;
                        $query1->Data['rel_type'] = 'ia';
                        $query1->Data['batch_id'] = $id;
                        $query1->Insert();
                    }

                    /* ia1 update */
                    $new_ia1 = isset($app['POST']['name_ia1']) ? $app['POST']['name_ia1'] : '0';
                    $query1 = new query('batch_filter_relation');
                    $query1->Where = "where batch_id = $id and rel_type = 'ia_lev1'";
                    $is_ia1 = $query1->displayOne('object');
                    if (!empty($is_ia1) || $is_ia1 != '0') {
                        $query1 = new query('batch_filter_relation');
                        $query1->Data['filter_id'] = $new_ia1;
                        $query1->Data['rel_type'] = 'ia_lev1';
                        $query1->Where = "where batch_id = $id and rel_type = 'ia_lev1'";
                        $query1->UpdateCustom();
                    } else {
                        $query1 = new query('batch_filter_relation');
                        $query1->Data['filter_id'] = $new_ia1;
                        $query1->Data['rel_type'] = 'ia_lev1';
                        $query1->Data['batch_id'] = $id;
                        $query1->Insert();
                    }

                    /* ia2 update */
                    $new_ia2 = isset($app['POST']['name_ia2']) ? $app['POST']['name_ia2'] : '0';
                    $query1 = new query('batch_filter_relation');
                    $query1->Where = "where batch_id = $id and rel_type = 'ia_lev2'";
                    $is_ia2 = $query1->displayOne('object');
                    if (!empty($is_ia2) || $is_ia2 != '0') {
                        $query1 = new query('batch_filter_relation');
                        $query1->Data['filter_id'] = $new_ia2;
                        $query1->Data['rel_type'] = 'ia_lev2';
                        $query1->Where = "where batch_id = $id and rel_type = 'ia_lev2'";
                        $query1->UpdateCustom();
                    } else {
                        $query1 = new query('batch_filter_relation');
                        $query1->Data['filter_id'] = $new_ia2;
                        $query1->Data['rel_type'] = 'ia_lev2';
                        $query1->Data['batch_id'] = $id;
                        $query1->Insert();
                    }
                    set_alert('success', "Account info updated successfully");
                    redirect(app_url('batches', 'edit', 'edit', array('id' => $id), true));
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
            redirect(app_url('batches', 'list', 'list', array(), true));
        }

        $query = new query('categories');
        $query->Where = "where is_active < 2 order by position";
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
                    $query1->Where = " ORDER BY name ";
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
            redirect(app_url('batches', 'list', 'list', array(), true));
        }
        break;


    case 'list':
        $query = new query('batches');
        $query->Field = "batches.id as id, batches.ribbon_name_dr as ribbon_name_dr, batches.is_active as is_active, batches.batch_position as batch_position, batches.batch_image as batch_image, batches.unit_price as unit_price, miniatures.name as miniature_name, type_number as type_numer";
        $query->Where = " LEFT JOIN miniatures on batches.miniature_id=miniatures.id WHERE batches.is_batch=1 ";
        $query->Where .= " order by ribbon_name_dr asc";
        $batches = $query->ListOfAllRecords('object');
        break;

    case 'batch_image':

      $id = (isset($app['POST']['num_batches']) && $app['POST']['num_batches'] != '') ? $app['POST']['num_batches'] : 0;


        $query = new query('batch_images');
        $query->Where = " where id = $id";
        $get_batches = $query->ListOfAllRecords();

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
                for ($i = 1; $i <= 20; $i++) {
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

                            $imgpath = DIR_FS_UPLOADS . "batch/" . $final_img;
                            $query = new query('batch_images');
                            $query->Field = "id,batch_image,batch_id,number";
                            $query->Where = " where batch_id = $batch_id and number = $i";
                            $dataExist = $query->ListOfAllRecords();
                            if ($dataExist) {
                                //unlink($imgpath);
                                $move = move_uploaded_file($image_data_array['tmp_name'], DIR_FS_UPLOADS . "batch/" . $final_img);
                                $query = new query('batch_images');
                                $query->Data['batch_id'] = $batch_id;
                                $query->Data['batch_image'] = $final_img;
                                $query->Data['number'] = $i;
                                $query->Where = " where batch_id = $batch_id and number = $i";
                                $query->UpdateCustom();
                            } else {
                                $move = move_uploaded_file($image_data_array['tmp_name'], DIR_FS_UPLOADS . "batch/" . $final_img);
                                $query = new query('batch_images');
                                $query->Data['batch_id'] = $batch_id;
                                $query->Data['batch_image'] = $final_img;
                                $query->Data['number'] = $i;
                                $query->Insert();
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
                            $imgpath = DIR_FS_UPLOADS . "batch/" . $final_image;
                            $query = new query('batch_images');
                            $query->Data['batch_id'] = $batch_id_loc;
                            $query->Data['batch_image'] = $final_image;
                            $query->Data['location_id'] = $key;
                            $query->Where = " where batch_id = $batch_id_loc and location_id = $key";
                            $dataExist = $query->ListOfAllRecords();
                            if ($dataExist) {
                                $move = move_uploaded_file($image_data_loc['tmp_name'], DIR_FS_UPLOADS . "batch/" . $final_image);
                                $query = new query('batch_images');
                                $query->Data['batch_id'] = $batch_id_loc;
                                $query->Data['batch_image'] = $final_image;
                                $query->Data['location_id'] = $key;
                                $query->Where = " where batch_id = $batch_id_loc and location_id = $key";
                                $query->UpdateCustom();
                            } else {
                                $move = move_uploaded_file($image_data_loc['tmp_name'], DIR_FS_UPLOADS . "batch/" . $final_image);
                                $query = new query('batch_images');
                                $query->Data['batch_id'] = $batch_id_loc;
                                $query->Data['batch_image'] = $final_image;
                                $query->Data['location_id'] = $key;
                                $query->Insert();
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