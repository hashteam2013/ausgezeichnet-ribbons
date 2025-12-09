<div class="row">
    <div class="col-sm-12">
        <!-- BEGIN SAMPLE FORM PORTLET-->
        <div class="portlet light bordered partation">
            <div class="portlet-title">
                <div class="caption font-red-sunglo">
                    <i class="icon-user font-red-sunglo"></i>
                    <span class="caption-subject bold uppercase"> Add Batches</span>
                </div>
                <div class="actions"></div>
            </div>
            <div class="portlet-body form">
                <div class="row">
                    <form role="form" action="<?php app_url('batches','add','add');?>" method="POST" enctype="multipart/form-data">
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
                                        <option value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="4">4</option>
                                        <option value="5">5</option>
                                        <option value="6">Verbinder</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Grade</label>
                                    <input type="number" name="grade" value="<?php echo isset($app['POST']['grade'])?$app['POST']['grade']:'';?>" min="0" class="form-control" placeholder="Enter Grade"> 
                                </div>
                                <div class="form-group">
                                    <label>Value</label>
                                    <input type="number" name="rb_value" value="<?php echo isset($app['POST']['rb_value'])?$app['POST']['rb_value']:'';?>" min="0"  class="form-control" placeholder="Enter Ribbon Value"> 
                                </div>
                                <div class="form-group">
                                    <label>Unit Price</label>
                                    <input type="number" name="uprice" value="<?php echo isset($app['POST']['uprice'])?$app['POST']['uprice']:'';?>" min="0" class="form-control" placeholder="Unit Price"> 
                                </div>
                                <div class="form-group">
                                    <label>Ribbon Location</label><br/>
                                    <select name="ribloc">
                                        <option value="">Select Ribbon location</option>
                                        <option value="0">Normal</option>
                                        <option value="1">Numbers</option>
                                        <option value="2">Year & Country</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Number of Images</label><br/>
                                    <input type="number" name='type_number' value="<?php echo isset($app['POST']['type_number'])?$app['POST']['type_number']:$batches->type_number;?>" min="0" id="number" > 
                                </div> 
                                <div class="form-group">
                                    <label>Batch-Position</label><br/>
                                    <input type="number" name='btposition' value="<?php echo isset($app['POST']['btposition'])?$app['POST']['btposition']:'';?>" min="0" id="number" > 
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
                                    <button type="submit" name="add" class="btn blue">Add Batches</button>
                                    <a class="btn default" href="<?php app_url('batches','list','list');?>">Cancel</a>
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
                             <h2>District/Subdistrict/Community</h2>
                                <ul class="my-check-sec fordist">
                                    <div class="form-group">
                                        <label>Select District</label><br/>
                                        <select name="name_dist" id="name_dist">
                                            <option value="">Select Ribbon District</option>
                                            <?php foreach ($dist_ph2 as $dist_phh) { ?>
                                                <option value="<?php echo $dist_phh->id; ?>"><?php echo $dist_phh->name_en; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                <div class="form-group">
                                    <label>Choose Subdistrict</label><br/>
                                    <select name="name_subdist" id="name_subdist">
                                        <option value=""><?php _e('Select sub district'); ?></option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Choose Community</label><br/>
                                    <select name="name_comm" id="name_comm">
                                        <option value=""><?php _e('Select community'); ?></option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Choose Borough</label><br/>
                                    <select name="name_boro" id="name_boro">
                                        <option value=""><?php _e('Select borough'); ?></option>
                                    </select>
                                </div>
                                </ul>
                             <h2>Collections</h2>
                             <ul class="my-check-sec">
                                 <?php 
                                 foreach($departments as $depart){
                                     ?>
                                   <li><label><input type="radio" name="departments_name[]" value="<?php echo $depart->id?>" > <span><?php echo $depart->name_en;?></span></label></li>
                             <?php
                             }
                             ?>
                             </ul>
                               <h2>Departments</h2>
                             <ul class="my-check-sec">
                                 <?php 
                                 foreach($departments_new as $depart){
                                     ?>
                                   <li><label><input type="radio" name="departments_new_name[]" value="<?php echo $depart->id?>" class="my-check-col"> <span><?php echo $depart->name_en;?></span></label></li>
                             <?php
                             }
                             ?>
                             </ul>
                             <h2>Organizations</h2>
                             <ul class="my-check-sec org"></ul>
                             <h2>International Authorities</h2>
                                <ul class="my-check-sec fordist">
                                    <div class="form-group">
                                        <label>International Authority</label><br/>
                                        <select name="name_ia" id="name_ia">
                                            <option value="">Select International Authority</option>
                                        <?php foreach ($ia as $ialoop) { ?>
                                                <option value="<?php echo $ialoop->id; ?>"><?php echo $ialoop->name_en; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>International Authority Sublevel1</label><br/>
                                        <select name="name_ia1" id="name_ia1">
                                            <option value=""><?php _e('Select sub district'); ?></option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label>International Authority Sublevel2</label><br/>
                                        <select name="name_ia2" id="name_ia2">
                                            <option value=""><?php _e('Select community'); ?></option>
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
