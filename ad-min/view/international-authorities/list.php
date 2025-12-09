<div class="row">
    <div class="col-sm-12">
        <!-- BEGIN SAMPLE FORM PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-red-sunglo">
                    <i class="icon-users font-red-sunglo"></i>
                    <span class="caption-subject bold uppercase"> Manage International Authorities</span>
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
                                <th>Active</th> 
                                <th>Actions</th> 
                            </tr>
                            <?php $count = ($page_no != 1)?(($page_no-1)*10+1) :$page_no ;
                            foreach($districts as $district){
                            ?>
                            <tr>
                                <td><?php echo $count++ ;?></td>
                                <td><?php echo $district->name_en ;?></td>
                                <td><?php echo $district->name_dr;?></td>
                                <td><?php echo $district->position;?></td>
                                <td><?php if ($district->is_active =='1'){ echo 'Active'; } 
                                else { echo 'Not Active' ;}
                                ?></td>
<!--                                <td><?php //if ($district->is_deleted =='1'){ echo 'Deleted'; } 
                                //else { echo 'Not Deleted' ;}
                                ?></td>-->
                                <td>
                                    <a class="btn btn-info btn-sm" href="<?php echo app_url('international-authorities','edit','edit',array('id'=>$district->id));?>" title="Edit international authorities"><i class="fa fa-pencil"></i> Edit</a>&nbsp;&nbsp;
                                    <a class="btn btn-danger btn-sm" href="<?php echo app_url('international-authorities','delete_district','list',array('del'=>$district->id));?>"onclick="return confirm('Are you sure you want to delete this international authorities?');" title="Delete district"><i class="fa fa-trash"></i> Delete</a>&nbsp;&nbsp;
                                    <?php //if ($category->is_active=='1'){ ?>
<!--                                    <a class="btn btn-warning btn-sm" href="//<?php //echo app_url('users','suspend_user','list',array('suspend'=>$category->id));?>" title="Suspend User"><i class="fa fa-thumbs-down"></i> Suspend</a>-->
                                    <?php //} else { ?>
<!--                                    <a class="btn btn-success btn-sm" href="//<?php //echo app_url('users','unsuspend_user','list',array('unsuspend'=>$category->id));?>" title="Unsuspend User"><i class="fa fa-thumbs-up"></i> Unsuspend</a>-->
                                    <?php //} ?>
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