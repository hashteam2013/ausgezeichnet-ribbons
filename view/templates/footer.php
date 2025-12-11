
<div class="modal fade login-phase" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-login">
                    <div class="panel-heading"> 
                        <div class="row">
                            <div class="col-xs-12">
                                <a href="javascript:void(0)" class="active" id="login-form-link"><?php _e("Login"); ?></a>
                                <a href="javascript:void(0)" id="register-form-link"><?php _e("Register"); ?></a>
                                <button type="button" class="close pull-right" data-dismiss="modal" aria-hidden="true">×</button>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <form id="login-form" action="" method="post" role="form" style="display: block;">
                                    <input type="hidden" class="batch_id" value=""/>
                                    <input type="hidden" class="user_id" value= <?php echo (LOGGED_IN_USER) ? $app['user_info']->id : "" ?>>
                                    <input type="hidden" class="customer_url" value=""/>
                                    <input type="hidden" class="current_url" value=""/>
                                    <div id="msg_login"></div>
                                    <div class="box-sow">
                                        <div class="form-group">
                                            <label><?php _e("Email Address"); ?><font color="red">*</font></label>
                                            <input type="email" name="email" value="<?php echo isset($app['POST']['email']) ? $app['POST']['email'] : ''; ?>" class="form-control" placeholder="<?php _e("Enter your email"); ?>"> 
                                        </div>
                                        <div class="form-group">
                                            <label><?php _e("Password"); ?><font color="red">*</font></label>
                                            <input type="password" name="password" value="<?php echo isset($app['POST']['password']) ? $app['POST']['password'] : ''; ?>" class="form-control" placeholder="<?php _e("Enter your password"); ?>"/>
                                        </div>
                                        <div class="form-group">
                                            <input type="checkbox" tabindex="3" class="" name="remember" id="remember">
                                            <label for="remember"><?php _e("Remember Me"); ?></label>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-6 col-sm-offset-3">
                                                    <button type="submit" name="login-submit"  class="form-control hvr-float-shadow all-cat add-btn hvr-float-shadow " tabindex="4" id="login-submit" ><?php _e("Log In"); ?></button>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="text-center">
                                                        <a href="javascript:void(0)" tabindex="5" class="forgot-password hvr-float-shadow" id="tog-blok"><?php _e("Forgot Password?"); ?></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <form id="forgot_form" class="box-confrm" action="" method="post" style="display:none">
                                    <div id="msg_forgot"></div>
                                    <div class="box-confrm">
                                        <div class="form-group">
                                            <label><?php _e("Email Address"); ?><font color="red">*</font></label>
                                            <input type="email" name="email" id="username" tabindex="1" class="form-control" placeholder="<?php _e("Enter your email"); ?>">
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-6 col-sm-offset-3">
                                                    <input type="button" name="forgot_submit" id="forgot-submit" tabindex="4" class="form-control btn btn-login" value="<?php _e("Get Access Info"); ?>">
                                                </div>
                                            </div>
                                            <a href="#" id="back" class="becker hvr-float-shadow"><?php _e("Back to Login Page"); ?></a>
                                        </div>
                                    </div>
                                </form>
                                <form id="register-form" action="" method="post" role="form" style="display: none;">
                                    <div id="msg_register"></div>
                                    <div class="form-body">
                                        <div class="form-group">
                                            <label><?php _e("Firstname"); ?><font color="red">*</font></label>
                                            <input type="text" name="firstname" value="<?php echo isset($app['POST']['firstname']) ? $app['POST']['firstname'] : ''; ?>" class="form-control" placeholder="<?php _e("Firstname"); ?>"> 
                                        </div>
                                        <div class="form-group">
                                            <label><?php _e("Lastname"); ?><font color="red">*</font></label>
                                            <input type="text" name="lastname" value="<?php echo isset($app['POST']['lastname']) ? $app['POST']['lastname'] : ''; ?>" class="form-control" placeholder="<?php _e("Lastname"); ?>"> 
                                        </div>
                                        <div class="form-group">
                                            <label><?php _e("Email"); ?><font color="red">*</font></label>
                                            <input type="email" name="email" value="<?php echo isset($app['POST']['email']) ? $app['POST']['email'] : ''; ?>" class="form-control" placeholder="<?php _e("Email"); ?>"> 
                                        </div>
                                        <div class="form-group">
                                            <label><?php _e("Password"); ?><font color="red">*</font></label>
                                            <input type="password" name='password' class="form-control" placeholder="<?php _e("password"); ?>"> 
                                        </div>
                                        <div class="form-group">
                                            <label><?php _e("Confirm Password"); ?><font color="red">*</font></label>
                                            <input type="password" name='cpassword' class="form-control" placeholder="<?php _e("confirm password"); ?>"> 
                                        </div>
                                        <?php $get_districts = getDistrict(); ?>
                                        <div class="form-group">
                                            <label>Staat / Bundesland auswählen</label><font color="red">*</font><br/>
                                            <select name="name_dist" id="name_dist" class='form-control'>
                                                <option value=""><?php _e('Select district'); ?></option>
                                                <?php foreach ($get_districts as $dis) { ?>
                                                    <option value="<?php echo $dis['id']; ?>"><?php echo $dis['full_name']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Bezirk auswählen</label>
                                            <label class="info-disc"><span><i class="fa fa-info-circle" aria-hidden="true"></i></span><font><?php _e("DistrictNotNeeded"); ?></font></label>
                                            <select name="name_subdist" id="name_subdist" class='form-control'>
                                                <option value=""><?php _e('Select sub district'); ?></option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Gemeinde auswählen</label>
                                            <label class="info-disc"><span><i class="fa fa-info-circle" aria-hidden="true"></i></span><font><?php _e("CommunityNotNeeded"); ?></font></label>
                                            <select name="name_comm" id="name_comm" class='form-control'>
                                                <option value=""><?php _e('Select community'); ?></option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label>Ortsteil auswählen</label>
			<label class="info-disc"><span><i class="fa fa-info-circle" aria-hidden="true"></i></span><font><?php _e("BoroughNotNeeded"); ?></font></label>
                                            <select name="name_boro" id="name_boro" class='form-control'>
                                                <option value=""><?php _e('Select Borough'); ?></option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                               <label for="agreeAGB"><input type="checkbox" tabindex="1" class="" name="agreeAGB" id="agreeAGB" style="margin-right: 10px;" value="1"><?php _e("I agree all terms and conditions"); ?></label>    
                                        </div>
                                        <div class="form-group">
                                            <label for="agreeDSGVO"><input type="checkbox" tabindex="2" class="" name="agreeDSGVO" id="agreeDSGVO"  style="margin-right: 10px;" value="1"><?php _e("I agree DSGVO"); ?></label>    
                                        </div>

                                 <div class="form-group">
                                            <label for="agreePhone"><input type="checkbox" tabindex="4" class="" name="agreePhone" id="agreePhone"  style="margin-right: 10px;" value="1"><?php _e("I agree phone2"); ?></label>    
                                        </div>
                                        <div class="form-group">
                                            <div class="row">
                                                <div class="col-sm-6 col-sm-offset-3">
                                                    <input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control hvr-float-shadow" value="<?php _e("Register Now"); ?>">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade login-phase" id="custmodal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="row">
            <div class="col-md-6 col-md-offset-3">
                <div class="panel panel-login">
                    <div class="panel-heading">
                        <div class="row">
                            <a href="javascript:void(0)" class="active blinker" id="login-form-link" style="text-align:center"><?php _e("Add customer"); ?></a>
                            <button type="button" class="close pull-right x" data-dismiss="modal" aria-hidden="true">×</button>
                        </div>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <form role="form" action="<?php app_url('customers', 'add', 'add'); ?>" id="customer_add_form" method="POST">
                                    <div id="msg"></div>
                                    <div class="form-body">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <input type="hidden" name="id" id="id" value="<?php echo $logged_in_user_info->id; ?>" />
                                                    <label><?php _e("Firstname"); ?><font color="red">*</font></label>
                                                    <input type="text"  name="firstname" value="" class="form-control fname" placeholder="<?php _e("Firstname"); ?>"> 
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label><?php _e("Lastname"); ?><font color="red">*</font></label>
                                                    <input type="text"  name="lastname" value="" class="form-control fname" placeholder="<?php _e("Lastname"); ?>"> 
                                                </div>
                                            </div>

                                        </div>
   
                                        <div class="col-sm-6 col-sm-offset-3">
                                            <button type="submit" name="cust-submit"  class="form-control hvr-float-shadow " tabindex="4" id="cust-submit" ><?php _e("Add Customer"); ?></button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="condition" class="modal fade" role="dialog">
    <div class="modal-dialog ">
        <!-- Modal content-->
        <div class="modal-content bleasver">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php _e("Terms and Conditions"); ?></h4>
            </div>
            <div class="modal-body">
                <?php _e("Terms and Conditions content"); ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php _e("Close"); ?></button>
            </div>
        </div>
    </div>
</div>
<div id="imprint" class="modal fade" role="dialog">
    <div class="modal-dialog ">
        <!-- Modal content-->
        <div class="modal-content bleasver">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php _e("Imprint"); ?></h4>
            </div>
            <div class="modal-body">
                <?php _e("Imprint content"); ?>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"><?php _e("Close"); ?></button>
            </div>
        </div>
    </div>
</div>






<div id="Type10" class="modal fade in" role="dialog" style="display: none; padding-right: 15px;">
    <div class="modal-dialog">
        <input type="hidden" name="data-cid" id="data_cid" value=""/>	
        <!-- Modal content-->
        <div class="srch-reslt slect mar-top-10">
            <div class="srch-heading">
<?php _e("ShownName"); ?><button type="button" class="close" data-dismiss="modal">×</button>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-12">
                        <form role="form" action="" id="customer_add" method="POST">
                            <div id="msg"></div>
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
					<p>Namensschild f&uuml;r </p>
					<label id="fname"></label> <label id="lname"></label>
                                         </div>

                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label><?php _e("ShownName"); ?><font color="red">*</font></label>
                                            <input type="text"  name="ShownName" id="ShownName" value="" class="form-control <" placeholder="<?php _e("ShownName"); ?>"> 
                                        </div>
                                    </div>

                                </div>
                                      <input type="hidden"  name="batch_id" id="batch_id" value="" class="batch_id"> 

		      <input type='button' id='type10submit' name='cust-submit' class='add-list' value='<?php _e('Add to list'); ?>' data-batch-id='999999' data-batch-type='10' tabindex='4'  >
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>






<!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -END- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -->
<footer class="border-t border-secondary">
        <div class="container-custom">
            <div class="flex py-14 items-center justify-between">
                <div>
                    <a href="<?php echo WS_PATH; ?>index.php" class="w-[420px] inline-block"> 
                        <img src="<?php echo DIR_WS_ASSETS_IMAGES; ?>logo.jpg" class="w-full">
                    </a> 
                </div>
                <ul class="social-icone flex gap-2.5">
                    <li><a href="#"><img src="<?php echo DIR_WS_ASSETS_IMAGES; ?>visa.png" class="img-responsive"></a></li>
                    <li><a href="#"><img src="<?php echo DIR_WS_ASSETS_IMAGES; ?>master.png" class="img-responsive"></a></li>
                    <li><a href="#"><img src="<?php echo DIR_WS_ASSETS_IMAGES; ?>meso.png" class="img-responsive"></a></li>
                    <li><a href="#"><img src="<?php echo DIR_WS_ASSETS_IMAGES; ?>american.png" class="img-responsive"></a></li>
                </ul>
            </div>
        </div>
   
   
    
    <!-- <ul>
        <?php if (SOCIAL_FACEBOOK != "") {
            ?>
            <li><a href="<?php echo SOCIAL_FACEBOOK; ?>" target="_blank" ><i class="fa fa-facebook-square" aria-hidden="true"></i></a></li>
        <?php }
        ?>
        <?php if (GOOGLE_PLUS_PAGE != "") {
            ?>
            <li><a href="<?php echo GOOGLE_PLUS_PAGE; ?>"target="_blank"><i class="fa fa-google-plus-square" aria-hidden="true"></i></a></li>
        <?php }
        ?>
        <?php if (SOCIAL_LINKED_IN != "") {
            ?>
            <li><a href="<?php echo SOCIAL_LINKED_IN; ?>"target="_blank"><i class="fa fa-linkedin-square" aria-hidden="true"></i></a></li>
        <?php }
        ?>
        <?php if (SOCIAL_PINTEREST != "") {
            ?>
            <li><a href="<?php echo SOCIAL_PINTEREST; ?>"target="_blank"><i class="fa fa-pinterest-p square" aria-hidden="true"></i></a></li>
        <?php }
        ?>
        <?php if (SOCIAL_TWITTER != "") {
            ?>
            <li><a href="<?php echo SOCIAL_TWITTER; ?>"target="_blank"><i class="fa fa-twitter-square" aria-hidden="true"></i></a></li>
        <?php }
        ?>
    </ul> -->
     
   

    <div class="footer-bootom py-5 bg-black">
        <div class="container-custom">
            <div class="flex justify-between gap-10">
                <div class="text-white text-lg font-regular">
                    <a href="http://www.hashsoftware.com/" target="_blank"><span><?php _e(""); ?></span></a>
                    &copy; <?php echo date("Y"); ?> <?php _e("Excellent.cc  |  All right reserved."); ?>
                </div>
                <div class="tc_page flex gap-7">
                    <li class="text-white list-none font-medium"><?php _e("agblink "); ?></li>
                    <li class="list-none"><a href="javascript:void(0);" data-toggle="modal" data-target="#imprint" class="text-center text-white text-lg font-medium"><?php _e("Imprint"); ?></a></li>
                    <li class="text-white list-none font-medium"><?php _e("dataprotlink "); ?></li>
                </div>
            </div>
        </div>
    </div>
</footer>
<script type="text/javascript" src="<?= DIR_WS_ASSETS_JS; ?>jquery-ui.js"></script>
<!--<script type="text/javascript" src="<?= DIR_WS_ASSETS_JS; ?>jquery.auto-complete.js"></script>-->
<script type="text/javascript" src="<?= DIR_WS_ASSETS_PLUGINS; ?>toastr/build/toastr.min.js"></script>
<?php
if (isset($app['page_specific_js'])):
    foreach ($app['page_specific_js'] as $path):
        echo '<script type="text/javascript" src="' . $path . '"></script>';
    endforeach;
endif;
if ($page == 'shop') {
    include("shop_ajax.php");
}
include("common_js.php");
?>
<?php if (isset($_SESSION['alert']) && count($_SESSION['alert'])) { ?>
    <script type="text/javascript">
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "positionClass": "toast-top-center",
            "onclick": null,
            "showDuration": "1000",
            "hideDuration": "1000",
            "timeOut": "9000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
    <?php
    foreach ($_SESSION['alert'] as $kk => $vv) {
        if (trim($vv['msg']) != '') {
            $vv['msg'] = str_replace('"', "&#34;", str_replace("'", "&#39;", $vv['msg']));
            $vv['msg'] = preg_replace("/\r|\n/", " ", $vv['msg']);
            ?>
                toastr['<?php echo $vv['status']; ?>']('<?php echo $vv['msg']; ?>');
            <?php
            unset($_SESSION['alert'][$kk]);
        }
    }
    ?>
    </script>
<?php } ?>
<script type="text/javascript" id="cookieinfo"
	src="//cookieinfoscript.com/js/cookieinfo.min.js"
	data-message="Wir verwenden Cookies, um unsere Webseite für Sie möglichst benutzerfreundlich zu gestalten. Wenn Sie fortfahren, nehmen wir an, dass Sie mit der Verwendung von Cookies auf der Webseite einverstanden sind. "
	data-linkmsg="Datenschutzerkl&auml;rung"
	data-moreinfo="guarav.ausgezeichnet.cc/datenschutzerklaerung.pdf"
	data-bg="#645862"
	data-fg="#FFFFFF"
	data-link="#F1D600"
	data-cookie="CookieInfoScript"
	data-text-align="left"
       data-close-text="Annehmen">
</script>

<script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
<script type="text/javascript">
    function RenameFunction(id, bid) {
	var id = $("#custm").val();
        var cid = $('#Type10 #data_cid').val(id);
        $.ajax({
            type: 'POST',
            url: '<?php echo make_url('ajax', array("action" => "cust_detail")); ?>',
            data: {
                'id': id
            },
            dataType: 'JSON',
            success: function (response) {
                $("#fname").text(response.first_name);
                $("#lname").text(response.last_name);
                $("#ShownName").val(response.ShownName);
                $("#batch_id").val(bid);
            }
        });
    }

    jQuery(document.body).on('click', "#cust-rename", function (e) {
        e.preventDefault();
        var id = $('#Type10 #data_cid').val();
        var ShownName = $("#ShownName").val();
        $.ajax({
            type: 'POST',
            url: '<?php echo make_url('ajax', array("action" => "rename_cust_ShownName")); ?>',
            data: {
                'id': id,
                'ShownName': ShownName
            },
            dataType: 'JSON',
            success: function (response) {
                if (response.status == "Sucessfully") {
                    toastr.success(response.msg);
                    $("#Type10").hide();
                    window.setTimeout(function () {
                        location.reload()
                    }, 500)
                } else {
                    toastr['error'](response.msg);

                }
            }
        });
    });
    $('.slider').slick({
            dots: false,
            arrows: true,
            infinite: true,
            speed: 500,
            autoplay: true,
            autoplaySpeed: 2000,
            prevArrow: $('.custom-prev'),
            nextArrow: $('.custom-next')
    });
</script>





</body>
</html>





