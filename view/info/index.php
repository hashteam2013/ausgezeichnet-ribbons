<div class="filter-bar sampewr bg-body">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1>My Account</h1>
            </div>
        </div>
    </div>
</div>
<div class="container ac-onword">
    <div class="row">
        <div class="col-sm-4">
            <?php include_once (DIR_FS_VIEW_TEMPLATES . 'sidebar_navigation.php');?>
        </div>
        <div class="col-sm-8">
            <div class="right-part">
                <form role="form" action="<?php make_url('orders');?>" method="POST">
                <div class="spot-a">
                    <div class="form-group">
                        <div class="col-sm-13">
                          <lebel>Company</lebel>
                            <input type="text" class="feild-a" name="company" value="<?php echo isset($app['POST']['company']) ? $app['POST']['company'] : $app['user_info']->company; ?>"placeholder="company">  
                        </div>  
                    </div>
                    <div class="form-group">
                        <div class="col-sm-6">
                            <lebel>First Name<font color="red">*</font></lebel>
                            <input type="text" class="feild-a" name="firstname" value="<?php echo isset($app['POST']['firstname']) ? $app['POST']['firstname'] : $app['user_info']->first_name; ?>"placeholder="Firstname">
                        </div>
                        <div class="col-sm-6">
                            <lebel>Last Name<font color="red">*</font></lebel>
                            <input type="text" class="feild-a" name="lastname" value="<?php echo isset($app['POST']['lastname']) ? $app['POST']['lastname'] : $app['user_info']->last_name; ?>" placeholder="Last Name">
                        </div>
                    </div>
                    <div class="form-group">
                     <div class="col-sm-6">
                            <lebel>Contact<font color="red">*</font></lebel>
                            <input type="text" class="feild-a" name="fone" value="<?php echo isset($app['POST']['fone']) ? $app['POST']['fone'] :$app['user_info']->phone; ?>" placeholder="Contact">
                        </div>
                     <div class="col-sm-6">
                            <lebel>Email</lebel>
                            <input type="text" class="feild-a" name="mail" value="<?php echo isset($app['POST']['mail']) ? $app['POST']['mail'] : $app['user_info']->email; ?>" readonly="" placeholder="Email">
                        </div>
                    </div>
                    <div class="form-group">
                     <div class="col-sm-6">
                            <lebel>Address1<font color="red">*</font></lebel>
                            <input type="text" class="feild-a" name="address1" value="<?php echo isset($app['POST']['address1']) ? $app['POST']['address1'] : $app['user_info']->address1; ?>" placeholder="Address1">
                        </div>
                     <div class="col-sm-6">
                            <lebel>Address2<font color="red">*</font></lebel>
                            <input type="text" class="feild-a" name="address2" value="<?php echo isset($app['POST']['address2']) ? $app['POST']['address2'] : $app['user_info']->address2; ?>" placeholder="Address2">
                        </div>
                    </div>
                    <div class="form-group">
                     <div class="col-sm-6">
                            <lebel>City<font color="red">*</font></lebel>
                            <input type="text" class="feild-a" name="city" value="<?php echo isset($app['POST']['city']) ? $app['POST']['city'] : $app['user_info']->city; ?>" placeholder="City">
                        </div>
                     <div class="col-sm-6">
                            <lebel>State<font color="red">*</font></lebel>
                            <input type="text" class="feild-a" name="state" value="<?php echo isset($app['POST']['state']) ? $app['POST']['state'] : $app['user_info']->state; ?>" placeholder="State">
                        </div>
                    </div>
                    <div class="form-group">
                     <div class="col-sm-6">
                            <lebel>Country<font color="red">*</font></lebel>
                            <input type="text" class="feild-a" name="country" value="<?php echo isset($app['POST']['country']) ? $app['POST']['country'] : $app['user_info']->country; ?>" placeholder="Country">
                        </div>
                     <div class="col-sm-6">
                            <lebel>Zipcode<font color="red">*</font></lebel>
                            <input type="text" class="feild-a" name="zip" value="<?php echo isset($app['POST']['zip']) ? $app['POST']['zip'] : $app['user_info']->zipcode; ?>" placeholder="Zipcode">
                        </div>
                    </div>
                    <div class="form-group">
                     <div class="col-sm-6">
                            <lebel>Departments<font color="red">*</font></lebel>
                            <input type="text" class="feild-a" name="org" value="<?php echo isset($app['POST']['org']) ? $app['POST']['org'] : $app['user_info']->organization; ?>" >
                        </div>
                     <div class="col-sm-6">
                            <lebel>District<font color="red">*</font></lebel>
                            <input type="text" class="feild-a" name="district" value="<?php echo isset($app['POST']['district']) ? $app['POST']['district'] : $app['user_info']->district; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <input type="submit" class="all-cat add-btn hvr-float-shadow"  name="update">
                    </div>
                </div>
               

            </div>
                </form>
        </div>
    </div>
</div>


