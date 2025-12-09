<div class="row">
    <div class="col-sm-12">
        <!-- BEGIN SAMPLE FORM PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-red-sunglo">
                    <i class="icon-users font-red-sunglo"></i>
                    <span class="caption-subject bold uppercase"> Manage Miniatures</span>
                </div>
                <div class="actions"></div>
            </div>
            <div class="col-sm-12">
            <div class="srch-bar">
                
                <form method="GET"  action=" <?php  echo app_url('miniatures','list','list')?>">
                <input type="hidden" value ="<?php echo $page;?>" name="page"> 
                <input type="hidden" value ="<?php echo $view;?>"name="view">
                <input type="hidden" value ="<?php echo $action;?>"name="action">
                <input type="hidden" value ="<?php echo $text?>">
                <input type="text" id="search-box" class="my-srch" placeholder="Search" name="content">

                <input type="submit" class="btn srch-btn search1" name="search">
                </form>
            </div>
        </div>
            <div class="portlet-body">
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table">
                            <tr>
                                <th>ID</th> 
                                <th>Name </th> 
                                <th>Pieces ordered</th> 
                                <th>Pieces sold</th> 
                                <th>Pieces lost</th> 	
                                <th>Stock nominal</th> 	
                            </tr>
                            <?php $count = ($page_no != 1)?(($page_no-1)*PAGE_CONTENT_LIMIT+1) :$page_no ;
                            foreach($miniatures as $miniature){
                            ?>
                            <tr>
                                <td><?php echo $count++ ;?></td>
                                <td><?php echo $miniature->name ;?></td>
                                <td><?php echo $miniature->pieces_ordered ;?></td>
                                <td><?php echo $miniature->pieces_sold ;?></td>
                                <td><?php echo $miniature->pieces_lost ;?></td>
                                <td><?php echo $miniature->pieces_ordered-$miniature->pieces_sold-$miniature->pieces_lost ;?></td>
                                <td>
                                    <a class="btn btn-info btn-sm" href="<?php echo app_url('miniatures','edit','edit',array('id'=>$miniature->id));?>" title="Edit miniature"><i class="fa fa-pencil"></i> Edit</a>&nbsp;&nbsp;
                                    <a class="btn btn-danger btn-sm" href="<?php echo app_url('miniatures','delete_miniature','list',array('del'=>$miniature->id));?>"onclick="return confirm('Are you sure you want to delete this miniature?');" title="Delete Miniature"><i class="fa fa-trash"></i> Delete</a>&nbsp;&nbsp;

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
//echo $pagination;
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
