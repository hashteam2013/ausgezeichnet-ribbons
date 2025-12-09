<div class="row"><h3 align="center"><?php _e("Reset Password");?></h3></div>
<div class="col-lg-6">
    
<?php if ($msg != '' && $status == 'success') { ?>
<div class="alert alert-success"><a title="close" aria-label="close" data-dismiss="alert" class="close" href="#">×</a><?php echo $msg; ?></div>
<?php } elseif ($msg != '' && $status == 'error') { ?>
<div class="alert alert-danger"><a title="close" aria-label="close" data-dismiss="alert" class="close" href="#">×</a><?php echo $msg; ?></div>
<?php } ?>

<form id="reset-form" action="" method="post" role="form" style="display: block;">
    <div id="msg_login"></div>
    <div class="box-sow">
        <div class="form-group">
            <label><?php _e('New Password');?><font color="red">*</font></label>
            <input type=password name="new_pass" value="<?php echo isset($app['POST']['new_pass'])?$app['POST']['new_pass']:'';?>" class="form-control" placeholder="<?php _e('Enter password here');?>"> 
        </div>
        <div class="form-group">
            <label><?php _e('Confirm Password');?><font color="red">*</font></label>
            <input type=password name="con_pass" value="<?php echo isset($app['POST']['con_pass'])?$app['POST']['con_pass']:'';?>" class="form-control" placeholder="<?php _e('Confirm your password');?>"> 
        </div>
        <div class="form-group">
            <div class="row">
                <div class="col-sm-6 col-sm-offset-3">
                <button type="submit" name="reset"  class="form-control hvr-float-shadow " tabindex="4" id="reset" tabindex="4" ><?php _e('Reset Password');?></button>
                </div>
            </div>
        </div>
    </div>
    </form>
    </div>



