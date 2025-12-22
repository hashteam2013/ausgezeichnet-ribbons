<div class="filter-bar sampewr bg-body py-7 flex w-full">
    <div class="container-custom">
        <h1 class="text-3xl font-gothic text-black text-center"><?php _e(" My Account"); ?></h1>
    </div>
</div>
<div class="ac-onword flex w-full py-20">
    <div class="container-custom">
        <div class="flex flex-col gap-5">
            <?php include_once (DIR_FS_VIEW_TEMPLATES . 'sidebar_navigation.php'); ?>
            <div class="">
            <div class="right-part">
                <?php
                if ($app['user_info']->zipcode == '') {
                    echo '<p style="color:red">' . ('Bitte geben Sie Ihre vollständige Adresse an') . '</p>';
                }

                if ($msg == "Ungueltige Postleitzahl!") {
                    echo '<p style="color:red">' . ('Unser System ist derzeit in Kärnten noch nicht zugelassen. Wir arbeiten daran, das System auch in Ihrem Bundesland hier verfügbar zu machen. Bitte um Verständnis. Ihr Ausgezeichnet.cc-Team ') . '</p>';
                }


                $discount_string = get_discount_string();

                if ($discount_string <> "") {

                    echo ('<p style="color:green">Für Sie gilt laut Ihren Eingaben unsere ') . $discount_string . '</p>';
                }
                ?>

                <form role="form" action="<?php make_url('orders'); ?>" method="POST">
                    <div class="spot-a p-5 rounded-[20px] border border-[#d9d9d9] border-solid  flex flex-col">
                        <h3 class="text-3xl text-black font-gothic mb-5">Rechnungsanschrift</h3>
                        <div class="form-group mb-7 flex flex-col gap-2.5">
                                <label class="text-base font-medium text-dark"><?php _e(" Company"); ?></label>
                                <input type="text" class="feild-a min-h-[46px] bg-white px-4 text-base text-black border border-solid border-[#d9d9d9] focus:outline-none rounded-[10px]" name="company" value="<?php echo isset($app['POST']['company']) ? $app['POST']['company'] : $app['user_info']->company; ?>" placeholder="<?php _e('Company'); ?>">  
                        </div>
                        <div class="form-group mb-7 flex flex-col gap-2.5">
                                <label class="text-base font-medium text-dark"><?php _e(" First Name"); ?><font color="red">*</font></label>
                                <input type="text" class="feild-a min-h-[46px] bg-white px-4 text-base text-black border border-solid border-[#d9d9d9] focus:outline-none rounded-[10px]" name="firstname" value="<?php echo isset($app['POST']['firstname']) ? $app['POST']['firstname'] : $app['user_info']->first_name; ?>" placeholder="First Name*">
                        </div>
                        <div class="form-group mb-7 flex flex-col gap-2.5">
                                <label class="text-base font-medium text-dark"><?php _e(" Last Name"); ?><font color="red">*</font></label>
                                <input type="text" class="feild-a min-h-[46px] bg-white px-4 text-base text-black border border-solid border-[#d9d9d9] focus:outline-none rounded-[10px]" name="lastname" value="<?php echo isset($app['POST']['lastname']) ? $app['POST']['lastname'] : $app['user_info']->last_name; ?>" placeholder="Last Name*">
                            
                        </div>
                        <div class="form-group mb-7 flex flex-col gap-2.5">
                                <label class="text-base font-medium text-dark"><?php _e("Address"); ?></label>
                                <input type="text" class="feild-a min-h-[46px] bg-white px-4 text-base text-black border border-solid border-[#d9d9d9] focus:outline-none rounded-[10px]" name="address1" value="<?php echo isset($app['POST']['address1']) ? $app['POST']['address1'] : $app['user_info']->address1; ?>" placeholder="Strasse">
                        </div>
                        <div class="form-group mb-7 flex flex-col gap-2.5">
                                <label class="text-base font-medium text-dark"><?php _e("Address2"); ?></label>
                                <input type="text" class="feild-a min-h-[46px] bg-white px-4 text-base text-black border border-solid border-[#d9d9d9] focus:outline-none rounded-[10px]" name="address2" value="<?php echo isset($app['POST']['address2']) ? $app['POST']['address2'] : $app['user_info']->address2; ?>" placeholder="Hausnummer">
                        </div>
                        <div class="form-group mb-7 flex flex-col gap-2.5">
                                <label class="text-base font-medium text-dark"><?php _e(" Zipcode"); ?><font color="red">*</font></label>
                                <input type="text" class="feild-a min-h-[46px] bg-white px-4 text-base text-black border border-solid border-[#d9d9d9] focus:outline-none rounded-[10px]" name="zip" value="<?php echo isset($app['POST']['zip']) ? $app['POST']['zip'] : $app['user_info']->zipcode; ?>" placeholder="Postleitzahl*">
                        </div>
                        <div class="form-group mb-7 flex flex-col gap-2.5">
                                <label class="text-base font-medium text-dark"><?php _e(" City"); ?></label>
                                <input type="text" class="feild-a min-h-[46px] bg-white px-4 text-base text-black border border-solid border-[#d9d9d9] focus:outline-none rounded-[10px]" name="city" value="<?php echo isset($app['POST']['city']) ? $app['POST']['city'] : $app['user_info']->city; ?>" placeholder="Ort*">
                        </div>
                        <div class="form-group mb-7 flex flex-col gap-2.5">
                                <label class="text-base font-medium text-dark"><?php _e(" Email"); ?></label>
                                <input type="text" class="feild-a min-h-[46px] bg-white px-4 text-base text-black border border-solid border-[#d9d9d9] focus:outline-none rounded-[10px]" name="mail" value="<?php echo isset($app['POST']['mail']) ? $app['POST']['mail'] : $app['user_info']->email; ?>" readonly="" placeholder="Email*">
                        </div>
                        <div class="form-group mb-7 flex flex-col gap-2.5">
                                <label class="text-base font-medium text-dark"><?php _e(" Contact Number"); ?></label>
                                <input type="text"  class="feild-a min-h-[46px] bg-white px-4 text-base text-black border border-solid border-[#d9d9d9] focus:outline-none rounded-[10px]" name="fone" value="<?php echo isset($app['POST']['fone']) ? $app['POST']['fone'] : $app['user_info']->phone; ?>" placeholder="Telefonnummer">
                        </div>

                       <h3>Informationen f&uumlr die korrekte Rangordnung</h3>
		

	                   <div class="form-group mb-7  flex flex-col gap-2.5">
                            <?php
                                    echo $msgWearAll;
                                    
                                    if($msgWearAll!="")
                                    {
                                    echo '<select name="forcewearall" id="forcewearall" class="min-h-[46px] bg-white px-4 text-base text-black border border-solid border-[#d9d9d9] rounded-[10px]" >';

                                        $strselected=($app['user_info']->forcewearall=='0') ? "selected" : "";
                                                            echo '<option ' . $strselected . ' value="0">Empfohlene Einstellungen verwenden</option>';

                                        $strselected=($app['user_info']->forcewearall=='1') ? "selected" : "";
                                                            echo '<option ' . $strselected . ' value="1">Ich will trotzdem alle Auszeichnungen tragen</option>';
                                                        echo '</select>';
                                    }
                            ?>
 	                    </div>



                        <div class="form-group mb-7 flex flex-col gap-2.5">
                                <label class="text-base font-medium text-dark"><?php _e(" Departments"); ?><font color="red">*</font></label>
                                <select name="org" class="min-h-[46px] bg-white px-4 text-base text-black border border-solid border-[#d9d9d9] rounded-[10px]">
                                    <option value=""><?php _e('Select Department'); ?></option>
                                    <?php foreach ($get_department as $dep) { ?>
                                        <option  class="feild-a" name="org_opt" <?php echo ($dep['id'] == $app['user_info']->department_new) ? 'selected' : ""; ?> value="<?php echo $dep['id']; ?>"><?php echo $dep['name_en']; ?></option>
                                    <?php } ?>
                                </select>
                        </div>
                        <div class="form-group mb-7 flex flex-col gap-2.5">
                            
                                <div class="flex gap-1"><label class="text-base font-medium text-dark"><?php _e("Department2"); ?></label>
		                        <label class="info-disc"><span><i class="fa fa-info-circle" aria-hidden="true"></i></span><font><?php _e("Department2Info"); ?></font></label></div>
                                <select name="org2" class="min-h-[46px] bg-white px-4 text-base text-black border border-solid border-[#d9d9d9] rounded-[10px]">
                                    <option value=""><?php _e('No Department2'); ?></option>
                                    <?php foreach ($get_department as $dep) { 
                                    if ($dep['id'] != $app['user_info']->department_new) 
                                    {?>
                                        <option  class="feild-a" name="org_opt" <?php echo ($dep['id'] == $app['user_info']->department_new2) ? 'selected' : ""; ?> value="<?php echo $dep['id']; ?>"><?php echo $dep['name_en']; ?></option>
                                        <?php }
                                    }  ?>
                                </select>
                        </div>


                        <div class="form-group mb-7 flex flex-col gap-2.5">
                                <label class="text-base font-medium text-dark"><?php _e("State"); ?><font color="red">*</font></label>
                                <select name="district" id="name_dist" class="min-h-[46px] bg-white px-4 text-base text-black border border-solid border-[#d9d9d9] rounded-[10px]">
                                    <option value=""><?php _e('Select District'); ?></option>
                                    <?php foreach ($get_district as $dis) {
                                        ?>
                                        <option class="feild-a" name="org_opt" <?php echo ($dis['id'] == $app['user_info']->district) ? 'selected' : ""; ?> value="<?php echo $dis['id']; ?>"><?php echo $dis['full_name']; ?></option>
                                    <?php } ?>
                                </select>
                        </div>
                        <div class="form-group mb-7 flex flex-col gap-2.5">
                                <div class="flex gap-1"><label class="text-base font-medium text-dark"><?php _e("Subdistrict"); ?></label>
                                <label class="info-disc"><span><i class="fa fa-info-circle" aria-hidden="true"></i></span><font><?php _e("DistrictNotNeeded"); ?></font></label></div>
                                <select name="subdist" id ="name_subdist" class="min-h-[46px] bg-white px-4 text-base text-black border border-solid border-[#d9d9d9] rounded-[10px]">
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

                        <div class="form-group mb-7 flex flex-col gap-2.5">
                                <div class="flex gap-1"><label class="text-base font-medium text-dark"><?php _e("Community"); ?></label> <label class="info-disc"><span><i class="fa fa-info-circle" aria-hidden="true"></i></span><font><?php _e("CommunityNotNeeded"); ?></font></label></div>
                                <select name="community" id ="name_comm" class="min-h-[46px] bg-white px-4 text-base text-black border border-solid border-[#d9d9d9] rounded-[10px]">
                                    <option value=""><?php _e('Select Community'); ?></option>
                                <?php //if(isset($user_comm->id)){  ?>
                                        <!--<option class="feild-a" name="comm_opt" <?php //echo ($user_comm->id)?'selected':""; ?> value="<?php //echo $user_comm->id; ?>"><?php //echo $user_comm->name_en;  ?></option>-->
                                <?php //}  ?>  
                                <?php foreach ($get_community as $comm) {  ?>
                                        <option  class="feild-a" name="comm_opt" <?php echo ($comm['id'] == $app['user_info']->community) ? 'selected' : ""; ?> value="<?php echo $comm['id']; ?>"><?php echo $comm['name_en']; ?></option>
                                <?php } ?>
                                </select>                       
                        </div>
                        <div class="form-group mb-7 flex flex-col gap-2.5 ">
                            <div class="flex gap-1"><label class="text-base font-medium text-dark"><?php _e("Choose Borough");?></label><label class="info-disc"><span><i class="fa fa-info-circle" aria-hidden="true"></i></span><font><?php _e("BoroughNotNeeded"); ?></font></label></div>
                            <select name="name_boro" id="name_boro" class='form-control min-h-[46px] bg-white px-4 text-base text-black border border-solid border-[#d9d9d9] rounded-[10px]'>
                                <option value=""><?php _e('Select Borough'); ?></option>
                                <?php foreach($get_boro as $boro){ ?> 
                                    <option  class="feild-a" name="comm_opt" <?php echo ($boro['id'] == $app['user_info']->borough) ? 'selected' : ""; ?> value="<?php echo $boro['id']; ?>"><?php echo $boro['name_en']; ?></option>
                                <?php }?>
                            </select>
                            
                        </div>

                        <div class="form-group">
                            <input type="submit" class="all-cat add-btn bg-secondary rounded-md px-5 min-h-10 text-sm text-white cursor-pointer font-medium" name="update">
                        </div>
                        </div>
                </form>
            </div>
           </div>
        </div>
    </div>
</div>


