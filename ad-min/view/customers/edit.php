<div class="row">
    <div class="col-sm-12">
        <!-- BEGIN SAMPLE FORM PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-red-sunglo">
                    <i class="icon-user font-red-sunglo"></i>
                    <span class="caption-subject bold uppercase"> Edit Customer Account</span>
                </div>
                <div class="actions">
                 <?php //pr($customers); ?>
                </div>
            </div>
            <div class="portlet-body form">
                <div class="row">
                    <div class="col-sm-8">
                        <form role="form" action="<?php app_url('customers','edit','edit',array('id'=>$app['GET']['id']));?>" method="POST">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Firstname</label>
                                            <input type="text" name="firstname" value="<?php echo isset($app['POST']['firstname'])?$app['POST']['firstname']:$customers->first_name;?>" class="form-control" placeholder="Firstname"> 
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Lastname</label>
                                            <input type="text" name="lastname" value="<?php echo isset($app['POST']['lastname'])?$app['POST']['lastname']:$customers->last_name;?>" class="form-control" placeholder="Lastname"> 
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Active</label>
                                            <input type="checkbox" name="active" <?php echo ($customers->is_active == 1) ? 'checked' : ''?> value="1" > 
                                        </div> 
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <button type="submit" name="update" class="btn blue">Update Customer Info</button>
                                    <a class="btn default" href="<?php app_url('users_customers','list','list');?>">Cancel</a>
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
