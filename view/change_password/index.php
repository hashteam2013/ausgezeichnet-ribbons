<div class="filter-bar sampewr bg-body md:py-7 py-4 flex w-full">
    <div class="container-custom">
        <h1 class="md:text-3xl text-lg font-gothic text-black text-center"><?php _e("My Account"); ?></h1>
    </div>
</div>
<div class="ac-onword flex w-full md:py-20 py-5">
    <div class="container-custom">
        
        <div class="flex flex-col gap-5">
            <?php include_once (DIR_FS_VIEW_TEMPLATES . 'sidebar_navigation.php'); ?>
            <div class="right-part">
                <form role="form" action="<?php echo make_url('change_password'); ?>" method="POST">
                    <div class="spot-a p-5 rounded-[20px] border border-[#d9d9d9] border-solid  flex flex-col">
                        <div class="form-group mb-7 flex flex-col gap-2.5">
                            <label class="text-base font-medium text-dark"><?php _e("Old Password"); ?><font color="red">*</font></label>
                            <input type="password" name="old_password" value="<?php echo isset($app['POST']['old_password']) ? $app['POST']['old_password'] : ""; ?>" class="feild-a min-h-[46px] bg-white px-4 text-base text-black border border-solid border-[#d9d9d9] focus:outline-none rounded-[10px]" placeholder="<?php _e("Old Password"); ?>"> 
                        </div>
                        <div class="form-group mb-7 flex flex-col gap-2.5">
                            <label class="text-base font-medium text-dark"><?php _e("New Password"); ?><font color="red">*</font></label>
                            <input type="password" class="feild-a min-h-[46px] bg-white px-4 text-base text-black border border-solid border-[#d9d9d9] focus:outline-none rounded-[10px]" name="new_password" placeholder="<?php _e("New Password"); ?>">
                        </div>
                        <div class="form-group mb-7 flex flex-col gap-2.5">
                            <label class="text-base font-medium text-dark"><?php _e("Confirm New Password"); ?><font color="red">*</font></label>
                            <input type="password" class="feild-a min-h-[46px] bg-white px-4 text-base text-black border border-solid border-[#d9d9d9] focus:outline-none rounded-[10px]" name="confirm_new_password" placeholder="<?php _e("Confirm New Password"); ?>">
                        </div>
                        <div class="form-group">
                            <button type="submit" name="update" class="all-cat add-btn bg-secondary hover:bg-primary rounded-md px-5 min-h-10 text-sm text-white cursor-pointer font-medium"><?php _e("Update Password"); ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

