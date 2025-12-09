<div class="row">
    <div class="col-sm-12">
        <!-- BEGIN SAMPLE FORM PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-red-sunglo">
                    <i class="icon-user font-red-sunglo"></i>
                    <span class="caption-subject bold uppercase"> Edit Department</span>
                </div>
                <a class="btn btn-info btn-sm" style="float:right" href="<?php echo app_url('departments_new', 'department_pos', 'department_pos', array('id' => $id)); ?>" title="Edit User">Manage Position</a>&nbsp;&nbsp;
            </div>
            <div class="portlet-body form">
                <div class="row">
                    <?php //echo "<pre>"; print_r($departments); echo "</pre>";?>
                    <div class="col-sm-8">
                        <form role="form" action="<?php app_url('departments_new', 'edit', 'edit', array('id' => $app['GET']['id'])); ?>" method="POST">
                            <div class="form-body">
                                <div class="form-group">
                                    <label>Name (English)</label>
                                    <input type="text" name="nameen" value="<?php echo isset($app['POST']['nameen']) ? $app['POST']['nameen'] : $departments->name_en; ?>" class="form-control" placeholder="Name English"> 
                                </div>
                                <div class="form-group">
                                    <label>Name (German)</label>
                                    <input type="text" name="namedr" value="<?php echo isset($app['POST']['namedr']) ? $app['POST']['namedr'] : $departments->name_dr; ?>" class="form-control" placeholder="Name German"> 
                                </div>
                                <div class="form-group">
                                    <label>Position</label><br/>
                                    <input type="number" name='position' value="<?php echo isset($app['POST']['position']) ? $app['POST']['position'] : $departments->position; ?>" min="0" id="number"> 
                                </div> 
                                <div class="form-group">
                                    <label>Max Ribbons allowed<font color="red">*</font></label><br/>
                                    <input type="number" name='max_ribbon' value="<?php echo isset($app['POST']['max_ribbon']) ? $app['POST']['max_ribbon'] : $departments->max_ribbon; ?>" min="0" id="number"> 
                                </div>
                                <div class="form-group">
                                    <label>Integrity level<font color="red">*</font></label><br/>
                                    <input type="number" name='serious_level' value="<?php echo isset($app['POST']['serious_level']) ? $app['POST']['serious_level'] : $departments->serious_level; ?>" min="0" id="number"> 
                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Active</label>
                                            <input type="checkbox" name='active' <?php echo ($departments->is_active == 1 ? 'checked' : '') ?> value="1"> 
                                        </div> 
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Selectable</label>
                                            <input type="checkbox" name='selectable' <?php echo ($departments->is_selected == 1 ? 'checked' : '') ?> value="1"> 
                                        </div> 
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="form-group">
                                            <label>Wear highest class</label>
                                            <input type="checkbox" name='allow' <?php echo ($departments->is_allowed == 1 ? 'checked' : '') ?> value="1"> 
                                        </div>
                                    </div>
                                </div>  
                                <div class="form-actions">
                                    <button type="submit" name="update" class="btn blue">Update Department</button>
                                    <a class="btn default" href="<?php app_url('departments_new', 'list', 'list'); ?>">Cancel</a>
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
