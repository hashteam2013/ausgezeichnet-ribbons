<div class="row">
    <div class="col-sm-12">
        <!-- BEGIN SAMPLE FORM PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-red-sunglo">
                    <i class="icon-users font-red-sunglo"></i>
                    <span class="caption-subject bold uppercase"> Manage Batches</span>
                </div>
                <div class="actions"></div>
            </div>
            <div class="col-sm-12">
            <div class="srch-bar">
                
                <form method="GET"  action=" <?php  echo app_url('batches','list','list')?>">
                <input type="hidden" value ="<?php echo $page;?>" name="page"> 
                <input type="hidden" value ="<?php echo $view;?>"name="view">
                <input type="hidden" value ="<?php echo $action;?>"name="action">
                <input type="hidden" value ="<?php echo $text?>">
                <input type="text" id="search-box" class="my-srch" placeholder="Search" name="content">
                <!--<input type="hidden" value ="<?php //echo app_url('batches','list','list',array('content'=>$text))?>">-->
                <!--<input type="submit" class="btn srch-btn search1" name="search"><i class="fa fa-search" aria-hidden="true"></i></input>-->
                <input type="submit" class="btn srch-btn search1" name="search">
                </form>
            </div>
        </div>
            <div class="portlet-body">
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table">
                            <tr>
                                <th>Sr no.</th> 
		<th>Image</th>
                                <th>Ribbon Name</th> 
                                <th>Miniature Name</th> 
                                <th>Position</th> 
                                <th>Unit Price</th>
                                <th>Active</th> 
                                <th>&nbsp;</th>
                                <th>&nbsp;</th>
                            </tr>
                            <?php $count = ($page_no != 1)?(($page_no-1)*PAGE_CONTENT_LIMIT+1) :$page_no ;
                            foreach($batches as $batch){
                            ?>
                            <tr>
                                <td><?php echo $count++ ;?></td>
		<td>  <div class="img-uper">
                                    <img src="<?php echo  DIR_WS_UPLOADS."batch/" .$batch->batch_image;?>"></img>
                                </div></td>
                                <td><?php echo $batch->ribbon_name_dr;?></td>
                                <td><?php echo $batch->miniature_name;?></td>
                                 <td><?php echo $batch->batch_position;?></td>
                                <td><?php echo show_price($batch->unit_price);?></td>
                                <td><?php if ($batch->is_active =='1'){ echo 'Active'; } 
                                else { echo 'Not Active' ;}?>
                                <td>
                                    <a class="btn btn-info btn-sm" href="<?php echo app_url('batches','edit','edit',array('id'=>$batch->id));?>" title="Edit batch"><i class="fa fa-pencil"></i> Edit</a>&nbsp;&nbsp;
                                    <a class="btn btn-danger btn-sm" href="<?php echo app_url('batches','delete_batch','list',array('del'=>$batch->id));?>"onclick="return confirm('Are you sure you want to delete this category?');" title="Delete Category"><i class="fa fa-trash"></i> Delete</a>&nbsp;&nbsp;
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
<?php 
echo $pagination;
?>
</div>

<!--<script>
jQuery(document).ready(function() {
jQuery("#target-content").load("pagination.php?page=1");
    jQuery("#pagination li").live('click',function(e){
    e.preventDefault();
        jQuery("#target-content").html('loading...');
        jQuery("#pagination li").removeClass('active');
        jQuery(this).addClass('active');
        var pageNum = this.id;
        jQuery("#target-content").load("pagination.php?page=" + pageNum);
    });
    });
</script>-->
