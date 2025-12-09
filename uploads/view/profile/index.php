<div class="filter-bar sampewr">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1><?php _e(" My Account"); ?></h1>
            </div>
        </div>
    </div>
</div>
<div class="container ac-onword">
    <div class="row">
        <div class="col-sm-4">
            <?php include_once (DIR_FS_VIEW_TEMPLATES . 'sidebar_navigation.php'); ?>
        </div>
        <div class="col-sm-8">
            <div class="right-part">
                <?php
   //             if ($app['user_info']->zipcode == '') {
   //                 echo '<p style="color:red">' . ('Um Ihnen Aktionspreise ermöglichen zu können, bitte geben Sie Ihre vollständige Adresse an') . '</p>';
   //             }

                if ($msg == "Ungueltige Postleitzahl!") {
                    echo '<p style="color:red">' . ('Unser System ist derzeit nur im Burgenland, in Oberösterreich, Niederösterreich und der Steiermark zugelassen. Ihrer Postleitzahl nach wollen Sie aus einem anderen Bundesland bestellen. Dies ist derzeit leider nicht möglich. Wir arbeiten daran, das System auch in Ihrem Bundesland verfügbar zu machen. Bitte um Verständnis. Ihr Ausgezeichnet.cc-Team ') . '</p>';
                }


                $discount_string = get_discount_string();

                if ($discount_string <> "") {

                    echo ('<p style="color:green">Für Sie gilt laut Ihren Eingaben unser ') . $discount_string . '</p>';
                }
                ?>

                <form role="form" action="<?php make_url('orders'); ?>" method="POST">
                    <div class="spot-a">
                        <div class="col-md-12">
                        <h3>Rechnungsanschrift</h3>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <label><?php _e(" Company"); ?></label>
                                <input type="text" class="feild-a" name="company" value="<?php echo isset($app['POST']['company']) ? $app['POST']['company'] : $app['user_info']->company; ?>" placeholder="<?php _e('Company'); ?>">  
                            </div>  
                        </div>
                        <div class="form-group">
                            <div class="col-sm-6">
                                <label><?php _e(" First Name"); ?><font color="red">*</font></label>
                                <input type="text" class="feild-a" name="firstname" value="<?php echo isset($app['POST']['firstname']) ? $app['POST']['firstname'] : $app['user_info']->first_name; ?>" placeholder="First Name*">
                            </div>
                            <div class="col-sm-6">
                                <label><?php _e(" Last Name"); ?><font color="red">*</font></label>
                                <input type="text" class="feild-a" name="lastname" value="<?php echo isset($app['POST']['lastname']) ? $app['POST']['lastname'] : $app['user_info']->last_name; ?>" placeholder="Last Name*">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-6">
                                <label><?php _e(" Street Address"); ?></label>
                                <input type="text" class="feild-a" name="address1" value="<?php echo isset($app['POST']['address1']) ? $app['POST']['address1'] : $app['user_info']->address1; ?>" placeholder="Strasse">
                            </div>
                            <div class="col-sm-6">
                                <label><?php _e(" Zipcode"); ?><font color="red">*</font></label>
                                <input type="text" class="feild-a" name="zip" value="<?php echo isset($app['POST']['zip']) ? $app['POST']['zip'] : $app['user_info']->zipcode; ?>" placeholder="Postleitzahl*">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-12">
                                <label><?php _e(" City"); ?></label>
                                <input type="text" class="feild-a" name="city" value="<?php echo isset($app['POST']['city']) ? $app['POST']['city'] : $app['user_info']->city; ?>" placeholder="Ort*">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-6">
                                <label><?php _e(" Email"); ?></label>
                                <input type="text" class="feild-a" name="mail" value="<?php echo isset($app['POST']['mail']) ? $app['POST']['mail'] : $app['user_info']->email; ?>" readonly="" placeholder="Email*">
                            </div>
                            <div class="col-sm-6">
                                <label><?php _e(" Contact Number"); ?></label>
                                <input type="text"  class="feild-a" name="fone" value="<?php echo isset($app['POST']['fone']) ? $app['POST']['fone'] : $app['user_info']->phone; ?>" placeholder="Telefonnummer">
                            </div>
                        </div>

                        <div class="col-md-12"> <h3>Informationen f&uumlr die korrekte Rangordnung</h3></div>
                        <div class="form-group">
                            <div class="col-sm-6">
                                <label><?php _e(" Departments"); ?><font color="red">*</font></label>
                                <select name="org">
                                    <option value=""><?php _e('Select Department'); ?></option>
                                    <?php foreach ($get_department as $dep) { ?>
                                        <option  class="feild-a" name="org_opt" <?php echo ($dep['id'] == $app['user_info']->department_new) ? 'selected' : ""; ?> value="<?php echo $dep['id']; ?>"><?php echo $dep['name_en']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="col-sm-6">
                                <label><?php _e(" District"); ?><font color="red">*</font></label>
                                <select name="district" id="name_dist">
                                    <option value=""><?php _e('Select District'); ?></option>
                                    <?php foreach ($get_district as $dis) {
                                        ?>
                                        <option class="feild-a" name="org_opt" <?php echo ($dis['id'] == $app['user_info']->district) ? 'selected' : ""; ?> value="<?php echo $dis['id']; ?>"><?php echo $dis['name_en']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-6">
                                <label><?php _e("Subdistrict"); ?></label>
                                <label class="info-disc"><span><i class="fa fa-info-circle" aria-hidden="true"></i></span><font><?php _e("DistrictNotNeeded"); ?></font></label>
                                <select name="subdist" id ="name_subdist">
                                    <option value=""><?php _e('Select Subdistrict'); ?></option>
                                        <?php //if(isset($user_subdist->id)){  ?>
                                           <!--<option class="feild-a" name="sub_opt" <?php //echo ($user_subdist->id)?'selected':""; ?> value="<?php //echo $user_subdist->id; ?>"><?php //echo $user_subdist->name_en;  ?></option>-->-->
                                        <?php //}  ?> 
                                        <?php foreach ($get_subdist as $sub) {
                                            ?>
                                        <option class="feild-a" name="sub_opt" <?php echo ($sub['id'] == $app['user_info']->subdistrict) ? 'selected' : ""; ?> value="<?php echo $sub['id']; ?>"><?php echo $sub['name_en']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        
                            <div class="col-sm-6">
                                <label><?php _e("Community"); ?></label> <label class="info-disc"><span><i class="fa fa-info-circle" aria-hidden="true"></i></span><font><?php _e("CommunityNotNeeded"); ?></font></label>
                                <select name="community" id ="name_comm">
                                    <option value=""><?php _e('Select Community'); ?></option>
                                <?php //if(isset($user_comm->id)){  ?>
                                        <!--<option class="feild-a" name="comm_opt" <?php //echo ($user_comm->id)?'selected':""; ?> value="<?php //echo $user_comm->id; ?>"><?php //echo $user_comm->name_en;  ?></option>-->
                                <?php //}  ?>  
                                <?php foreach ($get_community as $comm) {  ?>
                                        <option  class="feild-a" name="comm_opt" <?php echo ($comm['id'] == $app['user_info']->community) ? 'selected' : ""; ?> value="<?php echo $comm['id']; ?>"><?php echo $comm['name_en']; ?></option>
                                <?php } ?>
                                </select>
                                
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-6">
                            <label><?php _e("Choose Borough");?></label><label class="info-disc"><span><i class="fa fa-info-circle" aria-hidden="true"></i></span><font><?php _e("BoroughNotNeeded"); ?></font></label>
                            <select name="name_boro" id="name_boro" class='form-control'>
                                <option value=""><?php _e('Select Borough'); ?></option>
                                <?php foreach($get_boro as $boro){ ?> 
                                    <option  class="feild-a" name="comm_opt" <?php echo ($boro['id'] == $app['user_info']->borough) ? 'selected' : ""; ?> value="<?php echo $boro['id']; ?>"><?php echo $boro['name_en']; ?></option>
                                <?php }?>
                            </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-sm-12 text-center" >
                                <input type="submit" class="all-cat add-btn hvr-float-shadow" name="update">
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

