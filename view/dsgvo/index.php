<div class="filter-bar sampewr bg-body md:py-7 py-4 flex w-full">
    <div class="container-custom">
            <h1 class="md:text-3xl text-lg font-gothic text-black text-center"><?php _e("My Account"); ?></h1>
    </div>
</div>
<div class="ac-onword md:min-h-[50vh] md:py-20 py-5">
    <div class="container-custom">
        <div class="flex flex-col gap-5">
            <?php include_once (DIR_FS_VIEW_TEMPLATES . 'sidebar_navigation.php'); ?>
            <div class="right-part bg-body rounded-[20px] border border-[#d9d9d9] p-5">
                <form id="update_terms_conditions" role="form" action="<?php //echo make_url('dsgvo'); ?>" method="POST">
                    <div class="spot-a">
                        <div class="form-group mb-7">
                            <label for="accepted_dsgvo" class="relative flex md:items-center items-start  gap-2.5 green_label text-sm text-black/55 font-medium">
                                <input type="checkbox" tabindex="1" class="accepted_info opacity-0 absolute z-[1] left-0 w-4 h-4" name="accepted_dsgvo" id="accepted_dsgvo"  style="margin-right:10px;" <?php echo($dsgvo->accepted_dsgvo1== '1') ? 'checked' : '' ?> value="1">
                                <span class="sm_checkmark relative md:mt-0 mt-1 min-w-4 h-4 inline-flex border border-solid border-[#b1b1b1] rounded-[3px]"></span>
                                <span><?php _e("I agree DSGVO2"); ?></span>
                            </label>    
                        </div>
                        <div class="form-group accepted_dsgvo mb-5 text-xs" style="color:red;<?php echo($dsgvo->accepted_dsgvo1== '1') ? 'display: none;' : '' ?>">
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

                        <div class="form-group mb-7">
                            <label for="accepted_phone" class="relative flex md:items-center items-start  gap-2.5 green_label text-sm text-black/55 font-medium">
                                <input type="checkbox" tabindex="3" class="accepted_info opacity-0 absolute z-[1] left-0 w-4 h-4" name="accepted_phone" id="accepted_phone" style="margin-right:10px;" <?php echo($dsgvo->accepted_phone== '1') ? 'checked' : '' ?> value="1">
                                <span class="sm_checkmark relative md:mt-0 mt-1 min-w-4 h-4 inline-flex border border-solid border-[#b1b1b1] rounded-[3px]"></span>
                                <span><?php _e("I agree phone2"); ?></span>
                            </label>    
                        </div>
                        <div class="form-group accepted_phone mb-5 text-xs" style="color:red;<?php echo($dsgvo->accepted_phone== '1') ? 'display: none;' : '' ?>">
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
                            <button type="submit" name="update" class="all-cat add-btn bg-secondary rounded-md px-5 min-h-10 text-sm text-white cursor-pointer font-medium hover:bg-primary"><?php _e("update_settings"); ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

