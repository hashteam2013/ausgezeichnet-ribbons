<div class="row">
    <div class="col-sm-12">
        <!-- BEGIN SAMPLE FORM PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-red-sunglo">
                    <i class="icon-user font-red-sunglo"></i>
                    <span class="caption-subject bold uppercase"> Edit add_cat_sub</span>
                </div>
                <div class="actions"></div>
            </div>
            <div class="portlet-body form">
                <div class="row">
                    <div class="col-sm-8">
                        <form role="form" action="<?php app_url('add_cat_sub','edit','edit',array('id'=>$app['GET']['id']));?>" method="POST">
                            <div class="form-body">
                                <div class="form-group">
		      <?php echo $add_cat_sub->add_cat_id; ?>
                                    <label>Choose add_cat</label><br/>
                                    <select name="add_cat">
                                        <option value="">Select add_cat Name</option>
                                        <?php foreach($add_cat_name as $add_cat){ ?>
                                         <option <?php if($add_cat['id'] == $add_cat_sub->add_cat_id){?> selected="selected" <?php } ?> value="<?php echo $add_cat['id']; ?>"><?php echo $add_cat['name_en']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                 <div class="form-group">
                                    <label>Name (English)</label>
                                    <input type="text" name="nameen" value="<?php echo isset($app['POST']['nameen'])?$app['POST']['nameen']:$add_cat_sub->name_en;?>" class="form-control" placeholder="Name English"> 
                                </div>
                                <div class="form-group">
                                    <label>Name (German)</label>
                                    <input type="text" name="namedr" value="<?php echo isset($app['POST']['namedr'])?$app['POST']['namedr']:$add_cat_sub->name_dr;?>" class="form-control" placeholder="Name German"> 
                                </div>
                                <div class="form-group">
                                    <label>Position</label><br/>
                                    <input type="number" name='position' value="<?php echo isset($app['POST']['position'])?$app['POST']['position']:$add_cat_sub->position;?>" min="0" id="number"> 
                                </div>  
                               <div class="row">
                                <div class="col-sm-4">
                                <div class="form-group">
                                    <label>Active</label>
                                    <input type="checkbox" name='active' <?php echo ($add_cat_sub->is_active == 1 ? 'checked': '')?> value="1"> 
                                </div> 
                                </div>
                                </div>  
                                <div class="form-actions">
                                    <button type="submit" name="update" class="btn blue">Update add_cat_sub</button>
                                    <a class="btn default" href="<?php app_url('add_cat_sub','list','list');?>">Cancel</a>
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
