<div class="row">
    <div class="col-sm-12">
        <!-- BEGIN SAMPLE FORM PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-red-sunglo">
                    <i class="icon-users font-red-sunglo"></i>
                    <span class="caption-subject bold uppercase"> Manage International Authorities Sublevel2</span>
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
                            <?php 
                            $count = 1;
                            foreach($sublev2ia as $sublev2_ia){
                            ?>
                            
                            <tr>
                                <td><?php echo $count++ ;?></td>
                                <td><?php echo $sublev2_ia->name_en ;?></td>
                                <td><?php echo $sublev2_ia->name_dr;?></td>
                                <td><?php echo $sublev2_ia->position;?></td>
                                <td><?php if ($sublev2_ia->is_active =='1'){ echo 'Active'; } 
                                else { echo 'Not Active' ;}
                                ?></td>
                                <td>
                                    <a class="btn btn-info btn-sm" href="<?php echo app_url('international-authorities-sublevel2','edit','edit',array('id'=>$sublev2_ia->id));?>" title="Edit international authorities sublevel1"><i class="fa fa-pencil"></i> Edit</a>&nbsp;&nbsp;
                                    <a class="btn btn-danger btn-sm" href="<?php echo app_url('international-authorities-sublevel2','delete_ia','list',array('del'=>$sublev2_ia->id));?>"onclick="return confirm('Are you sure you want to delete this international authorities sublevel2?');" title="Delete district"><i class="fa fa-trash"></i> Delete</a>&nbsp;&nbsp;
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
//echo $pagination;
?>

</ul>
</div>