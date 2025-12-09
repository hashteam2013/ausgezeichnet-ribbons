<div class="row">
    <div class="col-sm-12">
        <!-- BEGIN SAMPLE FORM PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-red-sunglo">
                    <i class="icon-user font-red-sunglo"></i>
                    <span class="caption-subject bold uppercase"> Edit District</span>
                </div>
                <div class="actions"></div>
            </div>
            <div class="portlet-body form">
                <div class="row">
                    <?php //echo "<pre>"; print_r($districts); echo "</pre>";?>
                    <div class="col-sm-8">
                        <form role="form" action="<?php app_url('districts','edit','edit',array('id'=>$app['GET']['id']));?>" method="POST">
                           
                            <div class="form-body">
                                 <div class="form-group">
                                    <label>Name (English)</label>
                                    <input type="text" name="nameen" value="<?php echo isset($app['POST']['nameen'])?$app['POST']['nameen']:$districts->name_en;?>" class="form-control" placeholder="Name English"> 
                                </div>
                                <div class="form-group">
                                    <label>Name (German)</label>
                                    <input type="text" name="namedr" value="<?php echo isset($app['POST']['namedr'])?$app['POST']['namedr']:$districts->name_dr;?>" class="form-control" placeholder="Name German"> 
                                </div>
                                <div class="form-group">
                                    <label>Position</label><br/>
                                    <input type="number" name='position' value="<?php echo isset($app['POST']['position'])?$app['POST']['position']:$districts->position;?>" min="0" id="number"> 
                                </div> 
                                <div class="form-group">
                                    <label>Max Ribbons allowed<font color="red">*</font></label><br/>
                                    <input type="number" name='max_ribbon' value="<?php echo isset($app['POST']['max_ribbon'])?$app['POST']['max_ribbon']:$districts->max_ribbon;?>" min="0" id="number"> 
                                </div> 
                               <div class="row">
                                <div class="col-sm-4">
                                  <div class="form-group">
                                    <label>Active</label>
                                    <input type="checkbox" name="active" <?php echo ($districts->is_active == 1 ? 'checked' : '') ?> value="1" > 
                                  </div> 
                                </div>
                                <div class="col-sm-4">
                                 <div class="form-group">
                                    <label>Wear highest class</label>
                                    <input type="checkbox" name='allow' <?php echo ($districts->is_allowed == 1 ? 'checked': '')?> value="1"> 
                                </div>
                                </div>
                                </div>  
                                <div class="form-actions">
                                    <button type="submit" name="update" class="btn blue">Update district</button>
                                    <a class="btn default" href="<?php app_url('districts','list','list');?>">Cancel</a>
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
