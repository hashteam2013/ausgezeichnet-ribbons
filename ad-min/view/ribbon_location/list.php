<div class="row">
    <div class="col-sm-12">
        <!-- BEGIN SAMPLE FORM PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-red-sunglo">
                    <i class="icon-users font-red-sunglo"></i>
                    <span class="caption-subject bold uppercase"> Manage Ribbon Location</span>
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
                                <th>Name</th>
                                <th>Set ID</th>
                                <th>Position </th>
                            </tr>
                            <?php $count = ($page_no != 1)?(($page_no-1)*PAGE_CONTENT_LIMIT+1) :$page_no ;
                            foreach($ribbon_location as $location){
                            ?>
                            <tr>
                                <td><?php echo $count++ ;?></td>
                                <td><?php echo $location->name ;?></td>
                                <td><?php echo $location->SetID ;?></td>
                                <td><?php echo $location->position ;?></td>
                                <td>
                                    <a class="btn btn-info btn-sm" href="<?php echo app_url('ribbon_location','edit','edit',array('id'=>$location->id));?>" title="Edit Location"><i class="fa fa-pencil"></i> Edit</a>&nbsp;&nbsp;
                                    <a class="btn btn-danger btn-sm" href="<?php echo app_url('ribbon_location','delete_ribbon_location','list',array('del'=>$location->id));?>" onclick="return confirm('Are you sure you want to delete this Location?');" title="Delete location"><i class="fa fa-trash"></i> Delete</a>&nbsp;&nbsp;
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

