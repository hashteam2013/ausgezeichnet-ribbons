<div class="row">
    <div class="col-sm-12">
        <!-- BEGIN SAMPLE FORM PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-red-sunglo">
                    <i class="icon-users font-red-sunglo"></i>
                    <span class="caption-subject bold uppercase">Manage payment Conditions</span>
                </div>
                <div class="actions"></div>
            </div>
            <div class="portlet-body">
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table">
                            <tr>
                                <th>Sr no.</th> 
                                <th>Name(English)</th> 
                                <th>Name (German)</th> 
                                <th>Position</th>
                                <th>Actions</th> 
                            </tr>
                            <?php $count = ($page_no != 1)?(($page_no-1)*PAGE_CONTENT_LIMIT+1) :$page_no ;
                            foreach($paymentconditions as $paymentcondition){
                            ?>
                            <tr>
                                <td><?php echo $count++ ;?></td>
                                <td><?php echo $paymentcondition->name_en ;?></td>
                                <td><?php echo $paymentcondition->name_dr;?></td>
                                <td><?php echo $paymentcondition->position;?></td>
                                <td>
                                    <a class="btn btn-info btn-sm" href="<?php echo app_url('paymentconditions','edit','edit',array('id'=>$paymentcondition->id));?>" title="Edit paymentcondition"><i class="fa fa-pencil"></i> Edit</a>&nbsp;&nbsp;
                                    <a class="btn btn-danger btn-sm" href="<?php echo app_url('paymentconditions','delete_paymentcondition','list',array('del'=>$paymentconditions->id));?>"onclick="return confirm('Are you sure you want to delete this paymentcondition?');" title="Delete paymentconditions"><i class="fa fa-trash"></i> Delete</a>&nbsp;&nbsp;
                                </td>
                            </tr>
                            <?php }  //$count++;  ?>
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
echo $pagination;
?>

</ul>
</div>
