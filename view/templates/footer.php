<div class="login-phase mx-auto left-0 right-0  fixed top-0 opacity-0 hidden z-[9] pt-10 pb-5 px-5 overflow-y-auto  w-full h-full" id="loginmodal">
    <div class="mx-auto max-w-[630px]">
                <div class="panel panel-login">
                    <div class="panel-heading bg-black flex items-stretch relative"> 
                        <a href="javascript:void(0)" class="active text-white inline-flex items-center justify-center text-center py-5 px-4 w-1/2 md:text-base text-sm font-medium" id="login-form-link"><?php _e("Login"); ?></a>
                        <a href="javascript:void(0)" class="text-white text-center inline-flex items-center justify-center px-4 py-5  w-1/2 md:text-base text-sm font-medium" id="register-form-link"><?php _e("Register"); ?></a>
                        <button type="button" id="closelogin" class="close rounded-full bg-black border border-white md:text-[33px] md:leading-[33px] font-light text-white absolute md:w-10 md:h-10 w-6 h-6 text-2xl leading-[21px]  lead bg-gray-900 -top-3 -right-3 pull-right">×</button>
                    </div>
                    <div class="panel-body bg-white flex flex-col p-5">
                                <form id="login-form" action="" method="post" role="form" style="display: block;">
                                    <input type="hidden" class="batch_id" value=""/>
                                    <input type="hidden" class="user_id" value= <?php echo (LOGGED_IN_USER) ? $app['user_info']->id : "" ?>>
                                    <input type="hidden" class="customer_url" value=""/>
                                    <input type="hidden" class="current_url" value=""/>
                                    <div id="msg_login"></div>
                                    <div class="box-sow flex flex-col gap-4">
                                        <div class="form-group flex flex-col gap-1.5">
                                            <label class="md:text-base text-sm text-dark font-normal w-full"><?php _e("Email Address"); ?><font color="red">*</font></label>
                                            <input type="email" name="email" value="<?php echo isset($app['POST']['email']) ? $app['POST']['email'] : ''; ?>" class="w-full border-[#b1b1b1] px-4 md:min-h-12 min-h-10 md:text-base text-sm border rounded-lg focus:outline-none" placeholder="<?php _e("Enter your email"); ?>"> 
                                        </div>
                                        <div class="form-group flex flex-col gap-1.5">
                                            <label class="md:text-base text-sm text-dark font-normal w-full"><?php _e("Password"); ?><font color="red">*</font></label>
                                            <input type="password" name="password" value="<?php echo isset($app['POST']['password']) ? $app['POST']['password'] : ''; ?>" class="w-full border-[#b1b1b1] px-4 md:min-h-12 min-h-10 md:text-base text-sm border rounded-lg focus:outline-none"  placeholder="<?php _e("Enter your password"); ?>"/>
                                        </div>
                                        <div class="form-group flex items-center">
                                            <input type="checkbox" tabindex="3" class="" name="remember" id="remember">
                                            <label class="text-sm font-normal text-dark" for="remember"><?php _e("Remember Me"); ?></label>
                                        </div>
                                        <div class="form-group">
                                            <div class="flex gap-5 justify-between items-center">
                                                <button type="submit" name="login-submit"  class="bg-primary px-5 inline-flex items-center justify-center text-white rounded-xl font-semibold md:text-base text-sm md:min-h-12 min-h-10 text-white hover:bg-secondary" tabindex="4" id="login-submit" ><?php _e("Log In"); ?></button>
                                                <a href="javascript:void(0)" tabindex="5" class="forgot-password md:text-base text-[13px] text-dark" id="tog-blok"><?php _e("Forgot Password?"); ?></a>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <form id="forgot_form" class="box-confrm" action="" method="post" style="display:none">
                                    <div id="msg_forgot"></div>
                                    <div class="box-confrm flex flex-col gap-4">
                                        <div class="form-group flex flex-col gap-1.5">
                                            <label class="md:text-base text-sm text-dark font-normal w-full"><?php _e("Email Address"); ?><font color="red">*</font></label>
                                            <input type="email" name="email" id="username" tabindex="1" class="w-full border-[#b1b1b1] px-4 md:min-h-12 min-h-10 md:text-base text-sm border rounded-lg focus:outline-none" placeholder="<?php _e("Enter your email"); ?>">
                                        </div>
                                        <div class="form-group flex md:flex-nowrap flex-wrap items-center justify-between md:gap-5 gap-3">
                                            <input type="button" name="forgot_submit" id="forgot-submit" tabindex="4" class="bg-primary px-5 inline-flex items-center justify-center text-white rounded-xl font-semibold md:text-base text-sm md:min-h-12 min-h-10 text-white hover:bg-secondary btn btn-login cursor-pointer" value="<?php _e("Get Access Info"); ?>">
                                            <a href="#" id="back" class="becker bg-secondary px-5 inline-flex items-center justify-center text-white rounded-xl font-semibold md:text-base text-sm md:min-h-12 min-h-10 text-white"><?php _e("Back to Login Page"); ?></a>
                                        </div>
                                    </div>
                                </form>
                                <form id="register-form" action="" method="post" role="form" style="display: none;">
                                    <div id="msg_register"></div>
                                    <div class="form-body flex flex-wrap justify-between gap-4">
                                        <div class="form-group flex flex-col gap-1.5 md:w-[calc(50%-8px)] w-full">
                                            <label class="md:text-base text-sm text-dark font-normal w-full"><?php _e("Firstname"); ?><font color="red">*</font></label>
                                            <input type="text" name="firstname" value="<?php echo isset($app['POST']['firstname']) ? $app['POST']['firstname'] : ''; ?>" class="w-full border-[#b1b1b1] px-4 md:min-h-12 min-h-10 md:text-base text-sm border rounded-lg focus:outline-none" placeholder="<?php _e("Firstname"); ?>"> 
                                        </div>
                                        <div class="form-group flex flex-col gap-1.5 md:w-[calc(50%-8px)] w-full">
                                            <label class="md:text-base text-sm text-dark font-normal w-full"><?php _e("Lastname"); ?><font color="red">*</font></label>
                                            <input type="text" name="lastname" value="<?php echo isset($app['POST']['lastname']) ? $app['POST']['lastname'] : ''; ?>" class="w-full border-[#b1b1b1] px-4 md:min-h-12 min-h-10 md:text-base text-sm border rounded-lg focus:outline-none" placeholder="<?php _e("Lastname"); ?>"> 
                                        </div>
                                        <div class="form-group flex flex-col gap-1.5 md:w-[calc(50%-8px)] w-full">
                                            <label class="md:text-base text-sm text-dark font-normal w-full"><?php _e("Email"); ?><font color="red">*</font></label>
                                            <input type="email" name="email" value="<?php echo isset($app['POST']['email']) ? $app['POST']['email'] : ''; ?>" class="w-full border-[#b1b1b1] px-4 md:min-h-12 min-h-10 md:text-base text-sm border rounded-lg focus:outline-none" placeholder="<?php _e("Email"); ?>"> 
                                        </div>
                                        <div class="form-group flex flex-col gap-1.5 md:w-[calc(50%-8px)] w-full">
                                            <label class="md:text-base text-sm text-dark font-normal w-full"><?php _e("Password"); ?><font color="red">*</font></label>
                                            <input type="password" name='password' class="w-full border-[#b1b1b1] px-4 md:min-h-12 min-h-10 md:text-base text-sm border rounded-lg focus:outline-none" placeholder="<?php _e("password"); ?>"> 
                                        </div>
                                        <div class="form-group flex flex-col gap-1.5 md:w-[calc(50%-8px)] w-full">
                                            <label class="md:text-base text-sm text-dark font-normal w-full"><?php _e("Confirm Password"); ?><font color="red">*</font></label>
                                            <input type="password" name='cpassword' class="w-full border-[#b1b1b1] px-4 md:min-h-12 min-h-10 md:text-base text-sm border rounded-lg focus:outline-none" placeholder="<?php _e("confirm password"); ?>"> 
                                        </div>
                                        <?php $get_districts = getDistrict(); ?>
                                        <div class="form-group flex flex-col gap-1.5 md:w-[calc(50%-8px)] w-full">
                                            <label class="md:text-base text-sm text-dark font-normal w-full">Staat / Bundesland auswählen<font color="red">*</font></label>
                                            <select name="name_dist" id="name_dist" class='w-full border-[#b1b1b1] px-4 md:min-h-12 min-h-10 md:text-base text-sm border rounded-lg focus:outline-none'>
                                                <option value=""><?php _e('Select district'); ?></option>
                                                <?php foreach ($get_districts as $dis) { ?>
                                                    <option value="<?php echo $dis['id']; ?>"><?php echo $dis['full_name']; ?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="form-group flex flex-col gap-1.5 md:w-[calc(50%-8px)] w-full">
                                            <div class="flex gap-1">
                                                <label class="md:text-base text-sm text-dark font-normal">Bezirk auswählen</label>
                                                <label class="info-disc"><span><i class="fa fa-info-circle" aria-hidden="true"></i></span><font><?php _e("DistrictNotNeeded"); ?></font></label>
                                            </div>
                                            <select name="name_subdist" id="name_subdist" class='w-full border-[#b1b1b1] px-4 md:min-h-12 min-h-10 md:text-base text-sm border rounded-lg focus:outline-none'>
                                                <option value=""><?php _e('Select sub district'); ?></option>
                                            </select>
                                        </div>
                                        <div class="form-group flex flex-col gap-1.5 md:w-[calc(50%-8px)] w-full">
                                            <div class="flex gap-1">
                                                <label class="md:text-base text-sm text-dark font-normal">Gemeinde auswählen</label>
                                                <label class="info-disc"><span><i class="fa fa-info-circle" aria-hidden="true"></i></span><font><?php _e("CommunityNotNeeded"); ?></font></label>
                                            </div>
                                            <select name="name_comm" id="name_comm" class='w-full border-[#b1b1b1] px-4 md:min-h-12 min-h-10 md:text-base text-sm border rounded-lg focus:outline-none'>
                                                <option value=""><?php _e('Select community'); ?></option>
                                            </select>
                                        </div>
                                        <div class="form-group flex flex-col gap-1.5 md:w-[calc(50%-8px)] w-full">
                                            <div class="flex gap-1">
                                            <label class="md:text-base text-sm text-dark font-normal">Ortsteil auswählen</label>
			                                <label class="info-disc"><span><i class="fa fa-info-circle" aria-hidden="true"></i></span><font><?php _e("BoroughNotNeeded"); ?></font></label>
                                            </div>
                                            <select name="name_boro" id="name_boro" class='w-full border-[#b1b1b1] px-4 md:min-h-12 min-h-10 md:text-base text-sm border rounded-lg focus:outline-none'>
                                                <option value=""><?php _e('Select Borough'); ?></option>
                                            </select>
                                        </div>
                                        <div class="form-group flex gap-1.5 md:w-[calc(50%-8px)] w-full items-center">
                                               <label class="text-dark w-full text-sm font-normal text-dark" for="agreeAGB">
                                                <input type="checkbox" tabindex="1"  name="agreeAGB" id="agreeAGB" style="margin-right: 10px;" value="1"><?php _e("I agree all terms and conditions"); ?></label>    
                                        </div>
                                        <div class="form-group w-full">
                                            <label class="text-sm text-dark font-normal w-full gap-1.5" for="agreeDSGVO"><input type="checkbox" tabindex="2" name="agreeDSGVO" id="agreeDSGVO"  style="margin-right: 10px;" value="1"><?php _e("I agree DSGVO"); ?></label>    
                                        </div>

                                       <div class="form-group w-full">
                                            <label for="agreePhone" class="text-sm text-dark font-normal w-full gap-1.5" ><input type="checkbox" tabindex="4" class="" name="agreePhone" id="agreePhone"  style="margin-right: 10px;" value="1"><?php _e("I agree phone2"); ?></label>    
                                        </div>
                                        <div class="form-group flex justify-start">
                                            <input type="submit" name="register-submit" id="register-submit" tabindex="4" class="bg-primary px-5 inline-flex items-center justify-center text-white rounded-xl font-semibold md:text-base text-sm md:min-h-12 min-h-10 text-white hover:bg-secondary cursor-pointer" value="<?php _e("Register Now"); ?>">
                                        </div>
                                    </div>
                                </form>
                          
                    </div>
                </div>

    </div>
</div>
<div class="login-phase fixed top-0 left-0 right-0 opacity-0 z-[1] hidden pt-10 pb-5 px-5 overflow-y-auto  w-full h-full" id="custmodal" >
    <div class="mx-auto max-w-[400px] w-full">
        <div class="bg-black relative px-5 py-3 flex justify-between items-center">
            <h4 class="text-white text-xl font-medium">
                <a href="javascript:void(0)" class="active capitalize blinker text-white" id="login-form-link">
                    <?php _e("Add customer"); ?>
                </a>
            </h4>
            <button type="button" class="close pull-right rounded-full bg-black text-[33px] leading-[33px] font-light text-white  w-10 h-10 relative -right-2 top-0 x" id="custmodalclose">×</button>
        </div>
        <div class="bg-white p-5">
            <form role="form" action="<?php app_url('customers', 'add', 'add'); ?>" id="customer_add_form" method="POST">
                <div id="msg"></div>
                <div class="form-body flex flex-col gap-4 w-full">
                    <div class="form-group flex flex-col gap-1.5">
                        <input type="hidden" name="id" id="id" value="<?php echo $logged_in_user_info->id; ?>" />
                        <label class="md:text-base text-sm text-dark font-normal"><?php _e("Firstname"); ?><font color="red">*</font></label>
                        <input type="text"  name="firstname" value="" class="form-control md:text-base text-sm fname w-full border-[#b1b1b1] px-4 md:min-h-12 min-h-10 border rounded-lg focus:outline-none" placeholder="<?php _e("Firstname"); ?>"> 
                    </div>
                    <div class="form-group flex flex-col gap-1.5">
                        <label class="md:text-base text-sm text-dark font-normal"><?php _e("Lastname"); ?><font color="red">*</font></label>
                        <input type="text"  name="lastname" value="" class="form-control fname md:text-base text-sm w-full border-[#b1b1b1] px-4 md:min-h-12 min-h-10 border rounded-lg focus:outline-none" placeholder="<?php _e("Lastname"); ?>"> 
                    </div>
                    <div class="form-group">
                        <button type="submit" name="cust-submit"  class="form-control bg-primary px-5 inline-flex items-center justify-center text-white rounded-xl font-semibold text-base md:min-h-12 min-h-10 md:text-base text-sm text-white hover:bg-secondary" tabindex="4" id="cust-submit" ><?php _e("Add Customer"); ?></button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<div id="condition" class="modal fade hidden " role="dialog">
    <div class="modal-dialog ">
        <!-- Modal content-->
        <div class="modal-content">
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
<div id="imprint" class="fixed top-0 opacity-0 hidden z-[9] left-0 right-0 pt-10 pb-5 px-5 overflow-y-auto  w-full h-full">
    <div class="mx-auto max-w-[500px]">
        <div class="bg-black px-5 py-4 relative">
            <button type="button" id="imprint-close" class="close rounded-full bg-black text-[33px] leading-[33px] font-light text-white  w-10 h-10 relative -right-2 -top-1.5 pull-right">×</button>
            <h4 class="text-white text-xl font-medium"><?php _e("Imprint"); ?></h4>
        </div>
        <div class="bg-white p-5 text-dark text-base flex flex-col gap-3">
            <?php _e("Imprint content"); ?>
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
<footer class="border-t border-secondary flex flex-wrap w-full">
        <div class="container-custom">
            <div class="flex md:flex-nowrap flex-wrap md:py-14 py-6 md:flex-row flex-col md:gap-0 gap-4  items-center justify-between">
                <div>
                    <a href="<?php echo WS_PATH; ?>index.php" class="lg:w-[420px] md:w-[350px] w-[285px] inline-block"> 
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
     
   

    <div class="footer-bootom md:py-5 py-4 bg-black w-full">
        <div class="container-custom">
            <div class="flex md:justify-between md:items-start items-center md:gap-10 gap-3 md:flex-nowrap flex-wrap md:flex-row flex-col">
                <div class="text-white md:text-lg  text-[12px] font-regular">
                    <a href="http://www.hashsoftware.com/" target="_blank"><span><?php _e(""); ?></span></a>
                    &copy; <?php echo date("Y"); ?> <?php _e("Excellent.cc  |  All right reserved."); ?>
                </div>
                <div class="tc_page flex md:gap-7 gap-0">
                    <li class="text-white list-none font-medium"><?php _e("agblink "); ?></li>
                    <li class="list-none"><a href="javascript:void(0);" id="imprint-toggle" class="text-center text-white md:text-lg text-sm font-medium"><?php _e("Imprint"); ?></a></li>
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
    
    $('#menutoggle').on('click',function(){
       $('#navmenus').toggleClass('active');
    });

    $('#login-link,#register-link').on('click',function(){
        $('#loginmodal').css({"opacity": "1","display":"block"});
        $('body').addClass('active');
    });
    $('#imprint-toggle').on('click',function(){
        $('#imprint').css({"opacity": "1","display":"block"});
        $('body').addClass('active');
        
    });
    $('#closelogin').on('click',function(){
        $('body').removeClass('active');
        $('#loginmodal').css({"opacity": "0","display":"none"});
    });
    $("#imprint-close").on('click',function(){
        $('body').removeClass('active');
        $('#imprint').css({"opacity": "0","display":"none"});
        
    });
    $("#custmodalclose").on('click',function(){
        $('body').removeClass('active');
        $('#custmodal').css({"opacity": "0","display":"none"});
    });

    function _shouldToggleSidebarFilter() {
        return window.innerWidth < 1024;
    }

    // Toggle only on smaller viewports (below 1024px)
    $('#filterBtn').on('click', function () {
        if (_shouldToggleSidebarFilter()) {
            $('#sibebarfilter').slideToggle();
        }
    });

    // Ensure sidebar filter is visible on desktop (>=1024px)
    $(document).ready(function () {
        if (!_shouldToggleSidebarFilter()) {
            $('#sibebarfilter').show();
        }
    });

    $(window).on('resize', function () {
        if (!_shouldToggleSidebarFilter()) {
            $('#sibebarfilter').show();
        }
    });
</script>
</body>
</html>





