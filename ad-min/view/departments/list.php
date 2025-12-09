<div class="row">
    <div class="col-sm-12">
        <!-- BEGIN SAMPLE FORM PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-red-sunglo">
                    <i class="icon-users font-red-sunglo"></i>
                    <span class="caption-subject bold uppercase"> Manage Collections</span>
                </div>
                <div class="actions"></div>
            </div>
            <?php //pr($departments); ?>
            <div class="portlet-body">
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table">
                            <tr>
                                <th>Sr no.</th> 
                                <th>Name (English)</th> 
                                <th>Name (German)</th> 
                                <th>Position</th> 
                                <th>Active</th> 
                                <th>Actions</th> 
                            </tr>
                            <?php $count = ($page_no != 1)?(($page_no-1)*PAGE_CONTENT_LIMIT+1) :$page_no ;
                            foreach($departments as $department){
                            ?>
                            <tr>
                                <td><?php echo $count++ ;?></td>
                                <td><?php echo $department->name_en ;?></td>
                                <td><?php echo $department->name_dr;?></td>
                                <td><?php echo $department->position;?></td>
                                <td><?php if ($department->is_active =='1'){ echo 'Active'; } 
                                else { echo 'Not Active' ;}
                                ?></td>
                                <td>
                                    <a class="btn btn-info btn-sm" href="<?php echo app_url('departments','edit','edit',array('id'=>$department->id));?>" title="Edit Department"><i class="fa fa-pencil"></i> Edit</a>&nbsp;&nbsp;
                                    <a class="btn btn-danger btn-sm" href="<?php echo app_url('departments','delete_department','list',array('del'=>$department->id));?>" onclick="return confirm('Are you sure you want to delete this category?');" title="Delete Department"><i class="fa fa-trash"></i> Delete</a>&nbsp;&nbsp;
                                    <?php //if ($category->is_active=='1'){ ?>
<!--                                    <a class="btn btn-warning btn-sm" href="//<?php //echo app_url('users','suspend_user','list',array('suspend'=>$category->id));?>" title="Suspend User"><i class="fa fa-thumbs-down"></i> Suspend</a>-->
                                    <?php //} else { ?>
<!--                                    <a class="btn btn-success btn-sm" href="//<?php //echo app_url('users','unsuspend_user','list',array('unsuspend'=>$category->id));?>" title="Unsuspend User"><i class="fa fa-thumbs-up"></i> Unsuspend</a>-->
                                    <?php //} ?>
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
echo $pagination;
?>

</ul>
</div>
