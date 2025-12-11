<?php
// ini_set('display_errors', '1');
// ini_set('display_startup_errors', '1');
// error_reporting(E_ALL);
global $app;
$id = isset($app['GET']['id']) ? $app['GET']['id'] : "0";

$page_no = (isset($app['GET']['page_no']) && $app['GET']['page_no'] != "") ? $app['GET']['page_no'] : 1;
$limit = PAGE_CONTENT_LIMIT;
switch ($action):
    case 'add':
        if (isset($app['POST']['add'])) {
            $msg = '';
            if (trim($app['POST']['name']) == '') {
                $msg = 'Please enter name';
            } else {
                $queryObj = new query('miniatures');
                $queryObj->Field = " id";
                // Ensure proper WHERE clause and escape the name to avoid SQL syntax errors
                $queryObj->Where = " WHERE name = '" . mysqli_real_escape_string($app['mysqllink'], $app['POST']['name']) . "'";
                $object = $queryObj->DisplayOne();

                if (!is_object($object)) {
                            // Normalize numeric inputs to avoid empty-string errors on integer columns
                            $piecesOrdered = isset($app['POST']['pieces_ordered']) && $app['POST']['pieces_ordered'] !== '' ? (int)$app['POST']['pieces_ordered'] : 0;
                            $piecesLost = isset($app['POST']['pieces_lost']) && $app['POST']['pieces_lost'] !== '' ? (int)$app['POST']['pieces_lost'] : 0;

                            $query = new query('miniatures');
                            $query->Data['name'] = $app['POST']['name'];
                            $query->Data['pieces_ordered'] = $piecesOrdered;
                            $query->Data['pieces_lost'] = $piecesLost;
                            $query->Data['date_add'] = 1;
                            if ($query->Insert()) {
                                      set_alert('success', "New miniature added successfully");
                                       redirect(app_url('miniatures', 'list', 'list', array(), true));
                            } 
		else 
		{
                                   $msg = 'Error occurred while updating account info. Please try again!';
                            }
                } else {
                    $msg = 'Miniature name already exist!';
                }
            }
            set_alert('error', $msg);
            break;
        }



$query3 = new query('miniatures');
$query3->Where = "  ";

$miniatures = $query3->ListOfAllRecords('object');
            break;


    case 'edit':


        if (isset($app['POST']['update'])) {
            $msg = '';
            if (trim($app['POST']['name']) == '') {
                $msg = 'Please enter name';
            }else{
                            $query = new query('miniatures');
                            $query->Data['id'] = $id;
                            $query->Data['name'] = $app['POST']['name'];
                            $query->Data['pieces_ordered'] = $app['POST']['pieces_ordered'];
                            $query->Data['pieces_lost'] = $app['POST']['pieces_lost'];

                            if ($query->Update()) {
                                set_alert('success', "Account info updated successfully");
                                redirect(app_url('miniatures','edit','edit',array('id'=>$id),true));
                            } else {
                                $msg = 'Error occurred while updating account info. Please try again!';
                            }
            }
            set_alert('error', $msg);
        }
        $query = new query('miniatures');
        $query->Where = " WHERE id=$id ";
        $miniatures = $query->DisplayOne();
        if(!(is_object($miniatures))){
            redirect(app_url('miniatures','list','list',array(),true));
        }
        



        break;

    case 'delete_miniature':
        if (isset($app['GET']['del']) && $app['GET']['del'] != '') {
            $query = new query('miniatures');
            $query->id = $app['GET']['del'];
            $miniature = $query->Delete();

            $query2 = new query('miniatures');
            $query2->Where = "Where miniature_id =" . $app['GET']['del'];
            $query2->Delete_where();
        } else {
            set_alert('error', 'Incorrect information');
        }
        if (!(is_object($miniatures))) {
            redirect(app_url('miniatures', 'list', 'list', array(), true));
        }
        break;


    case 'list':

$query3 = new query('miniatures');
 $query3->Field = "miniatures.id as id, miniatures.name as name,  miniatures.pieces_ordered as pieces_ordered, miniatures.pieces_lost as pieces_lost, count(batches.id) as NumberOfBatches ";
//$query3->Where = " Left Join batches on miniatures.id = batches.miniature_id Group by miniatures.id  ";
        
$query3->Where = " Left Join batches on miniatures.id = batches.miniature_id Group by miniatures.id  order by miniatures.name";
$miniatures = $query3->ListOfAllRecords('object');



//    $data = pagination('miniatures', $limit, $page_no, $url = '', 'id asc');
//     $miniatures = $data['show_record'];
//   $pagination = $data['pagination'];
        break;

    case 'stats':




$query3 = new query('miniatures');
 $query3->Field = "miniatures.id as id, miniatures.name as name,  miniatures.pieces_ordered as pieces_ordered, miniatures.pieces_lost as pieces_lost, sum(order_items.quantity) as pieces_sold";
$query3->Where = " Left Join batches on miniatures.id = batches.miniature_id Left Join order_items on product_id=batches.id WHERE order_items.order_id IN(SELECT orders.id FROM orders WHERE orders.is_order_valid='1') Group by miniatures.id  order by pieces_sold desc";
        
$miniatures = $query3->ListOfAllRecords('object');

        break;

endswitch;
