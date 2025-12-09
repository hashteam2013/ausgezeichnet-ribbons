<div class="row">
    <?php //print_r($ia_sub1); ?>
    <div class="col-sm-12">
        <!-- BEGIN SAMPLE FORM PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-red-sunglo">
                    <i class="icon-user font-red-sunglo"></i>
                    <span class="caption-subject bold uppercase"> Edit international authorities sublevel2</span>
                </div>
                <div class="actions"></div>
            </div>
            <div class="portlet-body form">
                <div class="row">
                    <?php //echo "<pre>"; print_r($districts); echo "</pre>";?>
                    <div class="col-sm-8">
                        <form role="form" action="<?php app_url('international-authorities-sublevel2','edit','edit',array('id'=>$app['GET']['id']));?>" method="POST">
                            <div class="form-body">
                                <div class="form-group">
                                    <label>Choose International Authority Sublevel</label><br/>
                                    <select name="name_ia" id="name_ia" class='form-control'>
                                        <option value=""><?php _e('Select International Authority Sublevel1'); ?></option>
                                        <option <?php echo ($ia_sub1->ia_id)?'selected':"";?> value="<?php echo $ia_sub1->ia_id;?>"><?php echo $ia_sub1->ia_name_en;?></option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Choose International Authority Sublevel1</label><br/>
                                    <select name="name_ia1" id="name_ia1" class='form-control'>
                                        <option value=""><?php _e('Select International Authority Sublevel1'); ?></option>
                                        <option <?php echo ($ia_sub1->ia_lev1_id)?'selected':"";?> value="<?php echo $ia_sub1->ia_lev1_id;?>"><?php echo $ia_sub1->sublev2_name;?></option>
                                    </select>
                                </div>
                                 <div class="form-group">
                                    <label>Name (English)</label>
                                    <input type="text" name="nameen" value="<?php echo isset($app['POST']['nameen'])?$app['POST']['nameen']:$ia_sub1->name_en;?>" class="form-control" placeholder="Name English"> 
                                </div>
                                <div class="form-group">
                                    <label>Name (German)</label>
                                    <input type="text" name="namedr" value="<?php echo isset($app['POST']['namedr'])?$app['POST']['namedr']:$ia_sub1->name_dr;?>" class="form-control" placeholder="Name German"> 
                                </div>
                                <div class="form-group">
                                    <label>Position</label><br/>
                                    <input type="number" name='position' value="<?php echo isset($app['POST']['position'])?$app['POST']['position']:$ia_sub1->position;?>" min="0" id="number"> 
                                </div>  
                               <div class="row">
                                <div class="col-sm-4">
                                  <div class="form-group">
                                    <label>Active</label>
                                    <input type="checkbox" name="active" <?php echo ($ia_sub1->is_active == 1 ? 'checked' : '') ?> value="1" > 
                                  </div> 
                                </div>
                                </div>  
                                <div class="form-actions">
                                    <button type="submit" name="update" class="btn blue">Update User Info</button>
                                    <a class="btn default" href="<?php app_url('international-authorities','list','list');?>">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
