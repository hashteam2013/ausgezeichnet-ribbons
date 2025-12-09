<div class="row">
    <div class="col-sm-12">
        <?php //pr($batches);?>
        <!-- BEGIN SAMPLE FORM PORTLET-->
        <div class="portlet light bordered partation">
            <div class="portlet-title">
                <div class="caption font-red-sunglo">
                    <i class="icon-user font-red-sunglo"></i>
                    <span class="caption-subject bold uppercase"> Edit Misc item</span>
                </div>
                <div class="actions"></div>
            </div>
            <div class="portlet-body form">
                <div class="row">
                   <form role="form" action="<?php app_url('miscitems','edit','edit',array('id'=>$app['GET']['id']));?>" method="POST" enctype="multipart/form-data">
                   <input type="hidden" name="batch" id="batch" class="batch" value="<?php echo $app['GET']['id']; ?>" />
                    <div class="col-sm-8">
                            <div class="form-body">
                                 <div class="form-group">
                                    <label>Ribbon Name (English)</label>
                                    <input type="text" name="rnameen" value="<?php echo isset($app['POST']['rnameen'])?$app['POST']['rnameen']:$batches->ribbon_name_en;?>" class="form-control" placeholder="Ribbon Name English"> 
                                </div>
                                <div class="form-group">
                                    <label>Ribbon Name (German)</label>
                                    <input type="text" name="rnamedr" value="<?php echo isset($app['POST']['rnamedr'])?$app['POST']['rnamedr']:$batches->ribbon_name_dr;?>" class="form-control" placeholder="Ribbon Name German"> 
                                </div>
                                <div class="form-group">
                                    <div class="img-uper">
                                    <img src="<?php echo  DIR_WS_UPLOADS."batch/" .$batches->batch_image;?>"></img>
                                </div>
                                    <label>Upload Image</label>
                                    <input type="file" value="<?php echo isset($_FILES['upload_image']['name'])?$_FILES['upload_image']['name']:$batches->batch_image;?>" name="upload_image">
                                </div>
                                <div class="form-group">
                                    <label>Webshop Title (English)</label>
                                    <input type="text" name="webtten" value="<?php echo isset($app['POST']['webtten'])?$app['POST']['webtten']:$batches->webshop_title_en;?>" class="form-control" placeholder="Webshop Title English"> 
                                </div>
                                 <div class="form-group">
                                    <label>Webshop Title (German)</label>
                                    <input type="text" name="webttdr" value="<?php echo isset($app['POST']['webttdr'])?$app['POST']['webttdr']:$batches->webshop_title_dr;?>" class="form-control" placeholder="Webshop Title German"> 
                                </div>
                                <div class="form-group">
                                    <label>Description (English)</label>
                                    <input type="textarea" name="desen" value="<?php echo isset($app['POST']['desen'])?$app['POST']['desen']:$batches->desc_en;?>" class="form-control" placeholder="Description English"> 
                                </div>
                                <div class="form-group">
                                    <label>Description (German)</label>
                                    <input type="text" name="desdr" value="<?php echo isset($app['POST']['desdr'])?$app['POST']['desdr']:$batches->desc_dr;?>" class="form-control" placeholder="Description German"> 
                                </div>


                                     <div class="form-group">
                                    <label>Batch Position</label><br/>
                                    <input type="number" name='btposition' value="<?php echo isset($app['POST']['btposition'])?$app['POST']['btposition']:$batches->batch_position;?>" min="0" id="number" > 
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
                                    <input type="text" name="uprice" value="<?php echo isset($app['POST']['uprice'])?$app['POST']['uprice']:$batches->unit_price;?>" class="form-control" placeholder="Unit-Price"> 
                                </div>

      
                                <div class="form-group">
                                    <textarea name="text" rows="20" cols="100"><?php echo isset($app['POST']['text'])?$app['POST']['text']:$text->Text;?></textarea>
                                </div>
                                <div class="row">
                                <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Active</label>
                                    <input type="checkbox" name='active'<?php echo ($batches->is_active == 1) ? 'checked' : ''?>  value="1"> 
                                </div> 
                                </div>
                                </div>
                                <div class="form-actions">
                                    <button type="submit" name="update" class="btn blue">Update Batch</button>
                                    <a class="btn default" href="<?php app_url('batches','list','list');?>">Cancel</a>
                                </div>
                            </div>
                    </div>
                    <div class="col-sm-4">
                         <div class="form-group">
                             <h2>Categories</h2>
                             <ul class="my-check-sec">
                                 <?php 
                                 $new = array();
                                 foreach($categories as $cat){
                                     foreach($cust_categories as $new_cat){
                                          //pr($cust_categories);
                                       $new[]=  $new_cat->filter_id;
                                     } 
                                     ?>
                                   <li>
                                       <label>
                                           <input type="checkbox" name="categories_name[]" <?php echo (in_array($cat->id,$new))?"checked":"";?>  value="<?php echo $cat->id?>" class="my-check"> 
                                           <span><?php echo $cat->name_en;?></span>
                                       </label>
                                   </li>
                             <?php
                             } 
                             ?>
                             </ul>
                                </ul>
                        </div> 
                    </div>

                 <div class="col-sm-4">
                         <div class="form-group">
                             <h2>Additional Categories</h2>
                             <ul class="my-check-sec">
                                 <?php 
                                 $add_new = array();
                                foreach($additional_categories as $add_cat){
                                     foreach($add_cust_categories as $add_new_cat){
                                       $add_new[]=  $add_new_cat->filter_id;
                                     } 
					?>
                                   <li><label><input type="checkbox" name="additional_categories_name[]"  <?php echo (in_array($add_cat->id,$add_new))?"checked":"";?> value="<?php echo $add_cat->id?>" class="my-check"> <span><?php echo $add_cat->name_en;?></span></label></li>
                             <?php
                             }
                             ?>
                             </ul>
                          
                            </div> 
                        </div>
                 <div class="col-sm-4">
                         <div class="form-group">
                             <h2>Additional Sub Categories</h2>
                             <ul class="my-check-sec">
                                 <?php 
                                 $add_new = array();
                                foreach($add_cat_subs as $add_cat_sub){
                                     foreach($add_cust_categories_sub as $add_new_cat_sub){
                                       $add_new_sub[]=  $add_new_cat_sub->filter_id;
                                     } 
					?>
                                   <li><label><input type="checkbox" name="additional_categories_name_sub[]"  <?php echo (in_array($add_cat_sub->id,$add_new_sub))?"checked":"";?> value="<?php echo $add_cat_sub->id?>" class="my-check"> <span><?php echo $add_cat_sub->name_en;?></span></label></li>
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

