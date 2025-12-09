<div class="row">
    <div class="col-sm-12">
        <!-- BEGIN SAMPLE FORM PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-red-sunglo">
                    <i class="icon-user font-red-sunglo"></i>
                    <span class="caption-subject bold uppercase"> Edit Admin Account</span>
                </div>
                <div class="actions">

                </div>
            </div>
            <div class="portlet-body form">
                <div class="row">
                    <div class="col-sm-8">
                        <form role="form" action="<?php app_url('users','edit','edit',array('id'=>$app['GET']['id']));?>" method="POST">
                            <div class="form-body">
                                <div class="form-group">
                                    <label>Firstname</label>
                                    <input type="text" name="firstname" value="<?php echo isset($app['POST']['firstname'])?$app['POST']['firstname']:$user->firstname;?>" class="form-control" placeholder="Firstname"> 
                                </div>
                                <div class="form-group">
                                    <label>Lastname</label>
                                    <input type="text" name="lastname" value="<?php echo isset($app['POST']['lastname'])?$app['POST']['lastname']:$user->lastname;?>" class="form-control" placeholder="Lastname"> 
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" name="email" value="<?php echo isset($app['POST']['email'])?$app['POST']['email']:$user->email;?>" class="form-control" placeholder="Email"> 
                                </div>  
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" name='username' value="<?php echo isset($app['POST']['username'])?$app['POST']['username']:$user->username;?>" class="form-control" placeholder="Username"> 
                                </div>  
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" name='password' class="form-control" placeholder="password"> 
                                    <span class="help-inline">Leave empty if you don't want to update password</span>
                                </div>  
                                <div class="form-actions">
                                    <button type="submit" name="update" class="btn blue">Update User Info</button>
                                    <a class="btn default" href="<?php app_url('users','list','list');?>">Cancel</a>
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
