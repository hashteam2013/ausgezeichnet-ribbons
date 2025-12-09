<div class="filter-bar sampewr">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1><?php _e("My Account"); ?></h1>
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
                <form id="update_terms_conditions" role="form" action="<?php //echo make_url('dsgvo'); ?>" method="POST">
                    <div class="spot-a">
                        <div class="form-group">
                           <label for="accepted_dsgvo">
                               <input type="checkbox" tabindex="1" class="accepted_info" name="accepted_dsgvo" id="accepted_dsgvo"  style="margin-right:10px;" <?php echo($dsgvo->accepted_dsgvo1== '1') ? 'checked' : '' ?> value="1"><?php _e("I agree DSGVO2"); ?>
                           </label>    
                        </div>
                        <div class="form-group accepted_dsgvo" style="color:red;<?php echo($dsgvo->accepted_dsgvo1== '1') ? 'display: none;' : '' ?>">
                            <?php
                                    if($dsgvo->accepted_dsgvo1!= '1')
                                    {
                                            _e("NoDSGVOWarning");
                                    } 
                                    else                                           
                                    {
                                         _e("NoDSGVOWarning");
                                    }

                            ?>
			</div>
                        <div class="form-group">
                            <label for="accepted_eMail"><input type="checkbox" tabindex="2" class="accepted_info" name="accepted_eMail" id="accepted_eMail" style="margin-right:10px;"   <?php echo($dsgvo->accepted_eMail== '1') ? 'checked' : '' ?> value="1"><?php _e("I agree eMail2"); ?></label>    
                        </div>
                        <div class="form-group accepted_eMail" style="color:red; <?php echo($dsgvo->accepted_eMail== '1') ? 'display: none;' : '' ?>" >
                            <?php
                                    if($dsgvo->accepted_eMail!= '1')
                                    {
                                            _e("NoeMailWarning");
                                    } 
                                    else
                                    {
                                            _e("NoeMailWarning");
                                    }

                            ?>
			</div>
                        <div class="form-group">
                            <label for="accepted_phone"><input type="checkbox" tabindex="3" class="accepted_info" name="accepted_phone" id="accepted_phone" style="margin-right:10px;" <?php echo($dsgvo->accepted_phone== '1') ? 'checked' : '' ?> value="1"><?php _e("I agree phone2"); ?></label>    
                        </div>
                        <div class="form-group accepted_phone" style="color:red;<?php echo($dsgvo->accepted_phone== '1') ? 'display: none;' : '' ?>">
                        <?php
                            if($dsgvo->accepted_phone!= '1')
                            {
				_e("NoPhoneWarning");
                            } 
                            else
                            {
                                _e("NoPhoneWarning");
                            }   

                        ?>
			</div>
                        <div class="form-group">
                            <button type="submit" name="update" class="all-cat add-btn hvr-float-shadow"><?php _e("Update settings"); ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

