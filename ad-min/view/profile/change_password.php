<div class="row">
    <div class="col-sm-12">
        <!-- BEGIN SAMPLE FORM PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-red-sunglo">
                    <i class="icon-settings font-red-sunglo"></i>
                    <span class="caption-subject bold uppercase"> Change Password</span>
                </div>
                <div class="actions">

                </div>
            </div>
            <div class="portlet-body form">
                <div class="row">
                    <div class="col-sm-8">
                        <form role="form" action="" method="POST">
                            <div class="form-body">
                                <div class="form-group">
                                    <label>Old Password</label>
                                    <input type="password" name="old_password" value="<?php echo isset($app['POST']['old_password'])?$app['POST']['old_password']:"";?>" class="form-control" placeholder="Old Password"> 
                                </div>
                                <div class="form-group">
                                    <label>New Password</label>
                                    <input type="password" name="new_password" class="form-control" placeholder="New Password"> 
                                </div>
                                <div class="form-group">
                                    <label>Confirm Password</label>
                                    <input type="password" name="confirm_new_password" class="form-control" placeholder="Confirm New Password"> 
                                </div>                                
                                <div class="form-actions">
                                    <button type="submit" name="update" class="btn blue">Update Password</button>
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