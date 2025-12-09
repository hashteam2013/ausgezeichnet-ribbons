<div class="row">
    <div class="col-sm-12">
        <!-- BEGIN SAMPLE FORM PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-red-sunglo">
                    <i class="icon-users font-red-sunglo"></i>
                    <span class="caption-subject bold uppercase"> Manage Sub Districts</span>
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
                            <?php $count = 1;
                            foreach($subdistricts as $sdistrict){ ?>
                            <tr>
                                <td><?php echo $count++ ;?></td>
                                <td><?php echo $sdistrict->name_en ;?></td>
                                <td><?php echo $sdistrict->name_dr;?></td>
                                <td><?php echo $sdistrict->position;?></td>
                                <td><?php if ($sdistrict->is_active =='1'){ echo 'Active'; } 
                                else { echo 'Not Active' ;}
                                ?></td>
                                <td>
                                    <a class="btn btn-info btn-sm" href="<?php echo app_url('sub_districts','edit','edit',array('id'=>$sdistrict->id));?>" title="Edit Subdistrict"><i class="fa fa-pencil"></i> Edit</a>&nbsp;&nbsp;
                                    <a class="btn btn-danger btn-sm" href="<?php echo app_url('sub_districts','delete_sub_district','list',array('del'=>$sdistrict->id));?>"onclick="return confirm('Are you sure you want to delete this subdistrict?');" title="Delete district"><i class="fa fa-trash"></i> Delete</a>&nbsp;&nbsp;
                                </td>
                            </tr>
                            <?php }  ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div align="center">
<ul class='pagination text-center' id="pagination">
<?php 
//echo $pagination;
?>

</ul>
</div>
