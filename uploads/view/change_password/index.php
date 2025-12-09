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
                <form role="form" action="<?php echo make_url('change_password'); ?>" method="POST">
                    <div class="spot-a">
                        <div class="form-group">
                            <lebel><?php _e("Old Password"); ?><font color="red">*</font></lebel>
                            <input type="password" name="old_password" value="<?php echo isset($app['POST']['old_password']) ? $app['POST']['old_password'] : ""; ?>" class="feild-a" placeholder="<?php _e("Old Password"); ?>"> 
                        </div>
                        <div class="form-group">
                            <lebel><?php _e("New Password"); ?><font color="red">*</font></lebel>
                            <input type="password" class="feild-a" name="new_password" placeholder="<?php _e("New Password"); ?>">
                        </div>
                        <div class="form-group">
                            <lebel><?php _e("Confirm New Password"); ?><font color="red">*</font></lebel>
                            <input type="password" class="feild-a" name="confirm_new_password" placeholder="<?php _e("Confirm New Password"); ?>">
                        </div>
                        <div class="form-group">
                            <button type="submit" name="update" class="all-cat add-btn hvr-float-shadow"><?php _e("Update Password"); ?></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

