<div class="row">
    <div class="col-sm-12">
        <!-- BEGIN SAMPLE FORM PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-red-sunglo">
                    <i class="icon-user font-red-sunglo"></i>
                    <span class="caption-subject bold uppercase"> Edit Sub District</span>
                </div>
                <div class="actions"></div>
            </div>
            <div class="portlet-body form">
                <div class="row">
                    <div class="col-sm-8">
                        <?php //pr($s_districts);?>
                        <form role="form" action="<?php app_url('sub_districts','edit','edit',array('id'=>$app['GET']['id']));?>" method="POST">
                            <div class="form-body">
                                <div class="form-group">
                                    <label>Choose District</label><br/>


                                    <select name="name_dist" id="name_dist" class='form-control'>
                                        <option value=""><?php _e('Select district'); ?></option>
                                        <?php foreach ($get_districts as $dis) { ?>

                                            <option <?php if( $dis['id'] == $s_districts->dist_id){?> selected="selected"<?php } ?> value="<?php echo $dis['id']; ?>"><?php echo $dis['name_en']; ?></option>
                                        <?php } ?>
                                    </select>

                                </div>
                                <div class="form-group">
                                    <label>Name (English)</label>
                                    <input type="text" name="nameen" value="<?php echo isset($app['POST']['nameen'])?$app['POST']['nameen']:$s_districts->name_en;?>" class="form-control" placeholder="Name English"> 
                                </div>
                                <div class="form-group">
                                    <label>Name (German)</label>
                                    <input type="text" name="namedr" value="<?php echo isset($app['POST']['namedr'])?$app['POST']['namedr']:$s_districts->name_dr;?>" class="form-control" placeholder="Name German"> 
                                </div>
                                <div class="form-group">
                                    <label>Position</label><br/>
                                    <input type="number" name='position' value="<?php echo isset($app['POST']['position'])?$app['POST']['position']:$s_districts->position;?>" min="0" id="number"> 
                                </div>  
                               <div class="row">
                                <div class="col-sm-4">
                                  <div class="form-group">
                                    <label>Active</label>
                                    <input type="checkbox" name="active" <?php echo ($s_districts->is_active == 1 ? 'checked' : '') ?> value="1" > 
                                  </div> 
                                </div>
                                </div>  
                                <div class="form-actions">
                                    <button type="submit" name="update" class="btn blue">Update Sub District</button>
                                    <a class="btn default" href="<?php app_url('sub_districts','list','list');?>">Cancel</a>
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
