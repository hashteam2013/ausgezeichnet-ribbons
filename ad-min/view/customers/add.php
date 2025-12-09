<div class="row">
    <div class="col-sm-12">
        <!-- BEGIN SAMPLE FORM PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-red-sunglo">
                    <i class="icon-user font-red-sunglo"></i>
                    <span class="caption-subject bold uppercase"> Add Customer</span>
                </div>
                <div class="actions"></div>
            </div>
            <?php //print_r($users_customers); ?>
            <div class="portlet-body form">
                <div class="row">
                    <div class="col-sm-8">
                        <form role="form" action="<?php app_url('customers','add','add');?>" method="POST">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Firstname<font color="red">*</font></label>
                                            <input type="hidden" name="id" id="id" value="<?php echo $app['GET']['id'];?>" />
                                            <input type="text" name="firstname" value="<?php echo isset($app['POST']['firstname'])?$app['POST']['firstname']:'';?>" class="form-control" placeholder="Firstname"> 
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label>Lastname<font color="red">*</font></label>
                                            <input type="text" name="lastname" value="<?php echo isset($app['POST']['lastname'])?$app['POST']['lastname']:'';?>" class="form-control" placeholder="Lastname"> 
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label>Active</label>
                                            <input type="checkbox" name="active" value="1" > 
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <button type="submit" name="add" class="btn blue">Add Customer</button>
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
