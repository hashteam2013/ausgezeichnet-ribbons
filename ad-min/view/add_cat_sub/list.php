<div class="row">
    <div class="col-sm-12">
        <!-- BEGIN SAMPLE FORM PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-red-sunglo">
                    <i class="icon-users font-red-sunglo"></i>
                    <span class="caption-subject bold uppercase"> Manage add_cat_sub</span>
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
                            foreach($add_cat_subs as $add_cat_sub){
                            ?>
                            <tr>
                                <td><?php echo $count++ ;?></td>
                                <td><?php echo $add_cat_sub->name_en ;?></td>
                                <td><?php echo $add_cat_sub->name_dr;?></td>
                                <td><?php echo $add_cat_sub->position;?></td>
                                <td><?php if ($add_cat_sub->is_active =='1'){ echo 'Active'; } 
                                else { echo 'Not Active' ;}
                                ?></td>
                                <td>
                                    <a class="btn btn-info btn-sm" href="<?php echo app_url('add_cat_sub','edit','edit',array('id'=>$add_cat_sub->id));?>" title="Edit add_cat_sub"><i class="fa fa-pencil"></i> Edit</a>&nbsp;&nbsp;
                                    <a class="btn btn-danger btn-sm" href="<?php echo app_url('add_cat_sub','delete_add_cat_sub','list',array('del'=>$add_cat_sub->id));?>" onclick="return confirm('Are you sure you want to delete this category?');" title="Delete add_cat_sub"><i class="fa fa-trash"></i> Delete</a>&nbsp;&nbsp;
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
