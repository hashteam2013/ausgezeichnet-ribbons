<div class="row">
    <div class="col-sm-12">
        <!-- BEGIN SAMPLE FORM PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-red-sunglo">
                    <i class="icon-user font-red-sunglo"></i>
                    <span class="caption-subject bold uppercase"> Manage Account</span>
                </div>
                <div class="actions">

                </div>
            </div>
            <div class="portlet-body form">
                <div class="row">
                    <div class="col-sm-6 col-md-5" style="display: <?php echo (isset($app['GET']['update']) && $app['GET']['update']=='1')?"none":"block";?>"  id="account-summary" >
                        <div class="form-body sale-summary">
                            <ul class="list-unstyled">
                                <li>
                                    <span class="sale-info"> Name</span>
                                    <span class="sale-num"> <?php echo ucfirst($app['admin_info']->firstname).' '.ucfirst($app['admin_info']->lastname);?> </span>
                                </li>
                                <li>
                                    <span class="sale-info"> Email</span>
                                    <span class="sale-num"><?php echo $app['admin_info']->email;?> </span>
                                </li>
                                <li>
                                    <span class="sale-info"> Username </span>
                                    <span class="sale-num"> <?php echo $app['admin_info']->username;?>  </span>
                                </li>
                                <li>
                                    <span class="sale-info"> Password </span>
                                    <span class="sale-num"> ***** </span>
                                </li>
                            </ul>
                        </div>
                        <div class="form-actions">
                            <button class="btn blue" onclick="show_update_account()">EDIT YOUR ACCOUNT</button>
                        </div>
                    </div>
                    <div class="col-sm-8" style="display: <?php echo (isset($app['GET']['update']) && $app['GET']['update']=='1')?"block":"none";?>" id="udpate-account-form">
                        <form role="form" action="<?php app_url('profile','manage','manage',array('update'=>1));?>" method="POST">
                            <div class="form-body">
                                <div class="form-group">
                                    <label>Firstname</label>
                                    <input type="text" name="firstname" value="<?php echo isset($app['POST']['firstname'])?$app['POST']['firstname']:$app['admin_info']->firstname;?>" class="form-control" placeholder="Firstname"> 
                                </div>
                                <div class="form-group">
                                    <label>Lastname</label>
                                    <input type="text" name="lastname" value="<?php echo isset($app['POST']['lastname'])?$app['POST']['lastname']:$app['admin_info']->lastname;?>" class="form-control" placeholder="Lastname"> 
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" name="email" value="<?php echo isset($app['POST']['email'])?$app['POST']['email']:$app['admin_info']->email;?>" class="form-control" placeholder="Email"> 
                                </div>  
                                <div class="form-group">
                                    <label>Username</label>
                                    <input type="text" disabled="" readonly="" value="<?php echo $app['admin_info']->username;?>" class="form-control" placeholder="Username"> 
                                </div>  
                                <div class="form-actions">
                                    <button type="submit" name="update" class="btn blue">UPDATE ACCOUNT INFORMATION</button>
                                    <a href="javascript:void(0)" onclick="hide_update_account()" class="btn default">Cancel</a>
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
