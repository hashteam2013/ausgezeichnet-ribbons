<div class="row">
    <div class="col-sm-12">
        <!-- BEGIN SAMPLE FORM PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-red-sunglo">
                    <i class="icon-user font-red-sunglo"></i>
                    <span class="caption-subject bold uppercase"> Edit Community</span>
                </div>
                <div class="actions"></div>
            </div>
            <div class="portlet-body form">
                <div class="row">
                    <?php //echo "<pre>"; print_r($districts); echo "</pre>";?>
                    <div class="col-sm-8">
                        <form role="form" action="<?php app_url('communities','edit','edit',array('id'=>$app['GET']['id']));?>" method="POST">
                            <div class="form-body">
                                <div class="form-group">
                                    <label>Choose District</label><br/>
                                    <select name="name_dist" id="name_dist" class='form-control'>
                                        <option value=""><?php _e('Select district'); ?></option>
                                        <?php foreach ($get_districts as $dis) { ?>
                                            <option <?php if($dis['id'] == $communities->dist_id){?> selected="selected"<?php }?> value="<?php echo $dis['id']; ?>"><?php echo $dis['name_en']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Choose Sub District</label><br/>
                                    <select name="name_subdist" id="name_subdist" class='form-control'>
                                        <option value=""><?php _e('Select sub district'); ?></option>
                                        <?php foreach ($get_subdistricts as $subdis) { ?>
                                            <option <?php if($subdis['id'] == $communities->subdist_id){?> selected="selected"<?php }?> value="<?php echo $subdis['id']; ?>"><?php echo $subdis['name_en']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                 <div class="form-group">
                                    <label>Name (English)</label>
                                    <input type="text" name="nameen" value="<?php echo isset($app['POST']['nameen'])?$app['POST']['nameen']:$communities->name_en;?>" class="form-control" placeholder="Name English"> 
                                </div>
                                <div class="form-group">
                                    <label>Name (German)</label>
                                    <input type="text" name="namedr" value="<?php echo isset($app['POST']['namedr'])?$app['POST']['namedr']:$communities->name_dr;?>" class="form-control" placeholder="Name German"> 
                                </div>
                                <div class="form-group">
                                    <label>Position</label><br/>
                                    <input type="number" name='position' value="<?php echo isset($app['POST']['position'])?$app['POST']['position']:$communities->position;?>" min="0" id="number"> 
                                </div>  
                               <div class="row">
                                <div class="col-sm-4">
                                  <div class="form-group">
                                    <label>Active</label>
                                    <input type="checkbox" name="active" <?php echo ($communities->is_active == 1 ? 'checked' : '') ?> value="1" > 
                                  </div> 
                                </div>
                                </div>  
                                <div class="form-actions">
                                    <button type="submit" name="update" class="btn blue">Update community</button>
                                    <a class="btn default" href="<?php app_url('communities','list','list');?>">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- END SAMPLE FORM PORTLET-->
    </div>
</div>
