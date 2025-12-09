<div class="row">
    <div class="col-sm-12">
        <!-- BEGIN SAMPLE FORM PORTLET-->
        <div class="portlet light bordered partation">
            <div class="portlet-title">
                <div class="caption font-red-sunglo">
                    <i class="icon-user font-red-sunglo"></i>
                    <span class="caption-subject bold uppercase"> Add Misc Item</span>
                </div>
                <div class="actions"></div>
            </div>
            <div class="portlet-body form">
                <div class="row">
                    <form role="form" action="<?php app_url('miscitems','add','add');?>" method="POST" enctype="multipart/form-data">
                    <div class="col-sm-8">
                            <div class="form-body">
                                <div class="form-group">
                                    <label>Ribbon Name (English)</label>
                                    <input type="text" name="rnameen" value="<?php echo isset($app['POST']['rnameen'])?$app['POST']['rnameen']:'';?>" class="form-control" placeholder="Ribbon Name English"> 
                                </div>
                                <div class="form-group">
                                    <label>Ribbon Name (German)</label>
                                    <input type="text" name="rnamedr" value="<?php echo isset($app['POST']['rnamedr'])?$app['POST']['rnamedr']:'';?>" class="form-control" placeholder="Ribbon Name German"> 
                                </div>
                                <div class="form-group">
                                    <label>Webshop Title (English)</label>
                                    <input type="text" name="webtten" value="<?php echo isset($app['POST']['webtten'])?$app['POST']['webtten']:'';?>" class="form-control" placeholder="Webshop Title English"> 
                                </div>
                                <div class="form-group">
                                    <label>Webshop Title (German)</label>
                                    <input type="text" name="webttdr" value="<?php echo isset($app['POST']['webttdr'])?$app['POST']['webttdr']:'';?>" class="form-control" placeholder="Webshop Title German"> 
                                </div>
                                 <div class="form-group">
                                    <label>Description (English)</label>
                                    <input type="textarea" name="desen" value="<?php echo isset($app['POST']['desen'])?$app['POST']['desen']:'';?>" class="form-control" placeholder="Description English"> 
                                </div>
                                <div class="form-group">
                                    <label>Description (German)</label>
                                    <input type="text" name="desdr" value="<?php echo isset($app['POST']['desdr'])?$app['POST']['desdr']:'';?>" class="form-control" placeholder="Description German"> 
                                </div>

                                     <div class="form-group">
                                    <label>Batch-Position</label><br/>
                                    <input type="number" name='btposition' value="<?php echo isset($app['POST']['btposition'])?$app['POST']['btposition']:'';?>" min="0" id="number" > 
                                </div> 

                                <div class="form-group">
                                    <label>Ribbon Level</label><br/>
                                    <select name="level">
                                        <option value="">Select Ribbon Level</option>
                                        <option value="1" <?php echo ($batches->level == 1?'selected':'');?>>1</option>
                                        <option value="2" <?php echo ($batches->level == 2?'selected':'');?>>2</option>
                                        <option value="3" <?php echo ($batches->level == 3?'selected':'');?>>3</option>
                                        <option value="4" <?php echo ($batches->level == 4?'selected':'');?>>4</option>
                                        <option value="5" <?php echo ($batches->level == 5?'selected':'');?>>5</option>
                                        <option value="6" <?php echo ($batches->level == 6?'selected':'');?>>Verbinder</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Unit Price</label>
                                    <input type="number" name="uprice" value="<?php echo isset($app['POST']['uprice'])?$app['POST']['uprice']:'';?>" min="0" class="form-control" placeholder="Unit Price"> 
                                </div>

                                <div class="form-group">
                                    <textarea name="text" rows="20" cols="100">Insert Description</textarea>
                                </div>

                                <div class="form-group">
                                    <label>Upload Image</label>
                                    <input type="file" value="<?php echo isset($_FILES['upload_image']['name'])?$_FILES['upload_image']['name']:'';?>" name="upload_image">
                                </div>
                                <div class="row">
                                <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Active</label>
                                    <input type="checkbox" name='active' value="1"> 
                                </div> 
                                </div>
                                </div>
                                <div class="form-actions">
                                    <button type="submit" name="add" class="btn blue">Add Item</button>
                                    <a class="btn default" href="<?php app_url('miscitems','list','list');?>">Cancel</a>
                                 </div>
                            </div>
                    </div>



                     <div class="col-sm-4">
                         <div class="form-group">
                             <h2>Categories</h2>
                             <ul class="my-check-sec">
                                 <?php 
                                foreach($categories as $cat){?>
                                   <li><label><input type="checkbox" name=" categories_name[]" value="<?php echo $cat->id?>" class="my-check"> <span><?php echo $cat->name_en;?></span></label></li>
                             <?php
                             }
                             ?>
                             </ul>
            
                
                            </div> 
                        </div>
                 <div class="col-sm-4">
                         <div class="form-group">
                             <h2>Additional Categories</h2>
                             <ul class="my-check-sec">
                                 <?php 
                                foreach($additional_categories as $add_cat){?>
                                   <li><label><input type="checkbox" name=" additional_categories_name[]" value="<?php echo $add_cat->id?>" class="my-check"> <span><?php echo $add_cat->name_en;?></span></label></li>
                             <?php
                             }
                             ?>
                             </ul>
            
                
                            </div> 
                        </div>



                    </form>
                </div>
            </div>
        </div>
        <!-- END SAMPLE FORM PORTLET-->
    </div>
</div>

<script>
$(document).ready(function() {   
    $('input[type=checkbox]').click(function () {
    $(this).parent().parent().parent().prev().find("input").prop('checked', true);
    var sibs = false;
    $(this).closest('ul').children('li').each(function () {
        if($('input[type=checkbox]', this).is(':checked'))
            sibs=true;
    })
    if(sibs == false){
     $(this).parent().parent().parent().prev().find("input").prop('checked', false);
    }
    var checked = false;
    if($(this).is(':checked')){ checked=true};
    $(this).parent().parent().children('ul').children('li').each(function () {
         $(this).find("input").prop('checked', checked)
    })
    $(this).parents('ul').prev().prop('checked', sibs);
   });
});

$('.my-check-col').change(function () {
    var depart_id = $(this).val();
      $.ajax({
                url: "<?php echo app_url('ajax', 'add_organization_list'); ?>",
                type: "POST",
                dataType:'json',
                data: {
                     'depart_id': depart_id,
                },
                success: function (data) {
					$(data).each(function(i,e){
                     $('.org').append('<li><label><input type="radio" name="organization_name[]" value='+e.id+' class="my-check"> <span>'+e.name_en+'</span></label></li>');
					});
                }
    });
    $('.org').html('');
    });
</script>
