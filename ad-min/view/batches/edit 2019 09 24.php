<div class="row">
    <div class="col-sm-12">
        <?php //pr($batches);?>
        <!-- BEGIN SAMPLE FORM PORTLET-->
        <div class="portlet light bordered partation">
            <div class="portlet-title">
                <div class="caption font-red-sunglo">
                    <i class="icon-user font-red-sunglo"></i>
                    <span class="caption-subject bold uppercase"> Edit Batch</span>
                </div>
                <div class="actions"></div>
            </div>
            <div class="portlet-body form">
                <div class="row">
                   <form role="form" action="<?php app_url('batches','edit','edit',array('id'=>$app['GET']['id']));?>" method="POST" enctype="multipart/form-data">
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
                                    <label>Ribbon Miniature</label><br/>

                                    <select name="miniature_id">
                                        <option value="">Select miniature</option>
			<?php


			foreach ($miniatures as $miniature)
			{
                                        	echo '<option value="' . $miniature->id . '" ' . ($batches->miniature_id == $miniature->id?'selected':'') . ' >'.$miniature->name.'</option>';
   			}

			?>

                                    </select>
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
                                    <label>Grade</label>
                                    <input type="number" name="grade" value="<?php echo isset($app['POST']['grade'])?$app['POST']['grade']:$batches->grade;?>" class="form-control" placeholder="Enter Grade"> 
                                </div>
                                <div class="form-group">
                                    <label>Value</label>
                                    <input type="number" name="rb_value" value="<?php echo isset($app['POST']['rb_value'])?$app['POST']['rb_value']:$batches->value;?>" class="form-control" placeholder="Enter Ribbon Value"> 
                                </div>
                                <div class="form-group">
                                    <label>Integrity level</label>
                                    <input type="number" name="serious_level" value="<?php echo isset($app['POST']['serious_level'])?$app['POST']['grade']:$batches->serious_level;?>" class="form-control" placeholder="Enter Grade"> 
                                </div>
                                <div class="form-group">
                                    <label>Unit Price</label>
                                    <input type="text" name="uprice" value="<?php echo isset($app['POST']['uprice'])?$app['POST']['uprice']:$batches->unit_price;?>" class="form-control" placeholder="Unit-Price"> 
                                </div>
                                 <div class="form-group">
                                    <?php $batches->type;?>
                                    <label>Ribbon type</label><br/>
                                    <select name="ribloc" >
                                        <option value="">select ribbon type</option>
                                        <option value="0" <?php echo ($batches->type==0)?'selected':''?>><?php echo "Normal";?></option>
                                        <option value="1" <?php echo ($batches->type==1)?'selected':''?>><?php echo "Numbers";?></option>
                                        <option value="2" <?php echo ($batches->type==2)?'selected':''?>><?php echo "Year & Country";?></option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Number of Images</label><br/>
                                    <input type="number" name='type_number' value="<?php echo isset($app['POST']['type_number'])?$app['POST']['type_number']:$batches->type_number;?>" min="0" id="number" > 
                                </div> 
                                <div class="form-group">
                                    <label>Batch Position</label><br/>
                                    <input type="number" name='btposition' value="<?php echo isset($app['POST']['btposition'])?$app['POST']['btposition']:$batches->batch_position;?>" min="0" id="number" > 
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
                             <h2>District/Subdistrict/Community</h2>
                                <ul class="my-check-sec fordist">
                                    <div class="form-group">
                                    <label>Select District</label><br/>
                                    <select name="name_dist" id="name_dist">
                                        <option value="">Select Ribbon District</option>
                                        <?php foreach ($districts as $dist) {  ?>
                                            <option value="<?php echo $dist->id; ?>" <?php echo ($dist->id == $seldistrict->filter_id) ? 'selected' : '' ?>><?php echo $dist->name_en; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Choose Subdistrict</label><br/>
                                    <select name="name_subdist" id="name_subdist">
                                        <option value="">Select Ribbon Subdistrict</option>
                                        <?php foreach ($all_subdistrict as $allSub) {
                                             if(!empty($existing_subdistrict) || $existing_subdistrict != '0'){ ?>
                                            <option value="<?php echo $allSub['id']; ?>" <?php echo ($allSub['id'] == $existing_subdistrict->filter_id) ? 'selected' : '' ?>><?php echo $allSub['name_en']; ?></option>
                                        <?php } else{ ?>
                                       <option value="<?php echo $allSub['id']; ?>"><?php echo $allSub['name_en']; ?></option>
                                        <?php }} ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Choose Community</label><br/>
                                    <select name="name_comm" id="name_comm">
                                         <option value="">Select Ribbon Community</option>
                                        <?php foreach ($all_com as $allCom) {
                                            if(!empty($existing_commi) || $existing_commi != '0'){
                                            ?>
                                            <option value="<?php echo $allCom['id']; ?>" <?php echo ($allCom['id'] == $existing_commi->filter_id) ? 'selected' : '' ?>><?php echo $allCom['name_en']; ?></option>
                                        <?php }else { ?>
                                            <option value="<?php echo $allCom['id']; ?>"><?php echo $allCom['name_en']; ?></option>
                                        <?php }} ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Choose Borough</label><br/>
                                    <select name="name_boro" id="name_boro">
                                        <option value=""><?php _e('Select borough'); ?></option>
                                        <?php foreach($all_boro as $al_bor){ 
                                        if(!empty($selboro) || $sselboro != '0'){ ?>
                                            <option value="<?php echo $al_bor['id']; ?>" <?php echo ($al_bor['id'] == $selboro->filter_id) ? 'selected' : '' ?>><?php echo $al_bor['name_en']; ?></option>
                                        <?php } else { ?>
                                            <option value="<?php echo $al_bor['id']; ?>"><?php echo $al_bor['name_en']; ?></option>
                                        <?php }} ?>
                                    </select>
                                </div>
                                </ul>
                             <h2>Collections</h2>
                             <ul class="my-check-sec">
                                 <?php
                                 $new = array();
                                 foreach($departments as $depart){
                                     foreach($cust_departments as $new_dep){
                                       $new[]=  $new_dep->filter_id;
                                     }
                                     ?>
                                   <li><label><input type="radio" name="departments_name[]" <?php echo (in_array($depart->id, $new))?"checked":"";?> value="<?php echo $depart->id?>" > <span><?php echo $depart->name_en;?></span></label></li>
                             <?php
                             }
                             ?>
                             </ul>
                              <h2>Departments</h2>
                             <ul class="my-check-sec">
                                 <?php
                                 $new = array();
                                 foreach($departments_new as $depart){
                                     foreach($cust_departments_new as $new_dep){
                                       $new[]=  $new_dep->filter_id;
                                     }
                                     ?>
                                   <li><label><input type="radio" name="departments_new_name[]" <?php echo (in_array($depart->id, $new))?"checked":"";?> value="<?php echo $depart->id?>" class="my-check-col"> <span><?php echo $depart->name_en;?></span></label></li>
                             <?php
                             }
                             ?>
                             </ul>
                             <h2>Organizations</h2>
                             <ul class="my-check-sec org">
                                 <?php $new = array();
                                 foreach($organizations as $org){
                                     foreach($cust_organizations as $new_org){
                                       $new[]=  $new_org->filter_id;
                                     }}
                             ?>
                             </ul>
                             <h2>International Authorities</h2>
                                <ul class="my-check-sec fordist">
                                    <div class="form-group">
                                        <label>International Authority</label><br/>
                                        <select name="name_ia" id="name_ia">
                                            <option value="">Select International Authority</option>
                                            <?php foreach ($ia_1 as $ialoop) {
                                                if(!empty($selia  || $selia != '0')){?>
                                                <option value="<?php echo $ialoop->id; ?>" <?php echo ($ialoop->id == $selia->filter_id) ? 'selected' : '' ?>><?php echo $ialoop->name_en; ?></option>
                                            <?php }else{ ?>
                                            <option value="<?php echo $ialoop->id; ?>"><?php echo $ialoop->name_en; ?></option>
                                             <?php } }?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>International Authority Sublevel1</label><br/>
                                        <select name="name_ia1" id="name_ia1">
                                            <option value="">Select ia1</option>
                                            <?php
                                            foreach ($all_ia as $ialoop1) {
                                                if(!empty($selia1)  || $selia1 != '0'){?>
                                                <option value="<?php echo $ialoop1->id; ?>" <?php echo ($ialoop1->id == $selia1->filter_id) ? 'selected' : '' ?>><?php echo $ialoop1->name_en; ?></option>
                                        <?php }else{?>
                                            <option value="<?php echo $ialoop1->id; ?>"><?php echo $ialoop1->name_en; ?></option>

                                            <?php } }?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>International Authority Sublevel2</label><br/>
                                        <select name="name_ia2" id="name_ia2">
                                             <option value="">Select ia2</option>
                                            <?php foreach ($all_ia2 as $ialoop2) { ?>
                                                <option value="<?php echo $ialoop2['id']; ?>" <?php echo ($ialoop2['id'] == $selia2->filter_id) ? 'selected' : '' ?>><?php echo $ialoop2['name_en']; ?></option>
                                    <?php } ?>
                                        </select>
                                    </div>
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

function ajax_call(){
	    var batch_id = $("#batch").val();
	    var depart_id = $("input[type=radio][class=my-check-col]:checked").val();
	       //console.log(depart_id);
      $.ajax({
                url: "<?php echo app_url('ajax', 'edit_organization_list'); ?>",
                type: "POST",
                dataType:'json',
                data: {
					 'batch_id':batch_id,
                     'depart_id': depart_id,
                },
                success: function (data) {
					$(data.org_name).each(function(i,e){
						$('.org').append('<li><label><input type="radio" name="organization_name[]" value='+e.id+' class="my-check" id=rec'+e.id+'> <span>'+e.name_en+'</span></label></li>');
						$(data.sel_org).each(function(k,v){
						if(e.id == v.filter_id){
							$('#rec'+e.id+'').prop('checked', true);
						}
					});
					});
                }
    });
	
}

$(document).ready(function() {
	ajax_call();
    });
    
    $('.my-check-col').change(function () {
		$('.org').html('');
		ajax_call();
    });
</script>

