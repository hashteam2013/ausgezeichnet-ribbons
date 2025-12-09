<div class="row">
    <div class="col-sm-12">
        <!-- BEGIN SAMPLE FORM PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-red-sunglo">
                    <i class="icon-users font-red-sunglo"></i>
                    <span class="caption-subject bold uppercase">Manage Customers</span>
                </div>
                <div class="actions">
                   <a class="btn blue" href="<?php echo app_url('customers','add','add',array('id'=>$app['GET']['id']));?>" title="Add Customers"><i class="fa fa-thumbs-up"></i> Add More Customer</a>
              <?php //echo "<pre>"; print_r($customers); echo "</pre>";?>
                </div>
            </div>
            <div class="portlet-body">
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table">
                            <tr>
                                <th>Sr no.</th> 
                                <th>Name</th> 
                                <th>Active</th>
                                <th>Actions</th> 
                            </tr>
                            <?php $count = ($page_no != 1)?(($page_no-1)*10+1) :$page_no ;
                            foreach($customers as $customer){ ?>
                            <tr>
                                <td><?php echo $count++;?></td>
                                <td><?php echo $customer->first_name . ' ' .$customer->last_name;?></td>
                                <td><?php if ($customer->is_active =='1'){ echo 'Active'; } 
                                else { echo 'Not Active' ;}
                                ?></td>
                                <td>
                                    <a class="btn btn-info btn-sm" href="<?php echo app_url('customers','edit','edit',array('id'=>$customer->id));?>" title="Edit Customer"><i class="fa fa-pencil"></i> Edit</a>&nbsp;&nbsp;
                                    <a class="btn btn-danger btn-sm"  href="<?php echo app_url('customers','delete','list',array('id'=>$app['GET']['id'],'del'=>$customer->id));?>" onclick="return confirm('Are you sure you want to delete this user?');" title="Delete"><i class="fa fa-trash"></i> Delete</a>&nbsp;&nbsp;
                                </td>
                            </tr>
                            <?php } ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- END SAMPLE FORM PORTLET-->
    </div>
</div>
<div align="center">
<ul class='pagination text-center' id="pagination">
<?php 
//echo $pagination;
?>

</ul>
</div>
