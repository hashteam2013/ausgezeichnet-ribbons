<script type="text/javascript">
    var log_in = $("#LOGGED_IN_USER").val();
    /*- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -login ajax- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -*/
    $("#login-submit").click(function (e) {
        var current_url = $('.current_url').val();
        var customer_url = $('.customer_url').val();
        var data = {"action": "login"};
        data = $("#login-form").serialize() + "&" + $.param(data);
        //var myForm = $("#login-form").serialize();
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: '<?php echo make_url('ajax', array("action" => "login")); ?>',
            data: data,
            dataType: 'JSON',
            success: function (response) {
                if (response.status == "Sucessfully" || response.status == "Sucessfully_InfoMissing") {
                    if (response.status == "Sucessfully_InfoMissing")
                    {
                        window.location.href = "<?php echo make_url("profile"); ?>";
                    }
                    else
                    {
                        window.location.href = "<?php echo make_url("shop"); ?>";
                    }

                    if (current_url == "add_to_list" || customer_url == 'add_to_cust') {
                        log_in = true;
                        $('#myModal').modal('hide');
                        $("#logged").remove();
                        $("#reg").remove();
                        $(".login-top").html(' <li><a href="<?php echo make_url("info"); ?>"> <?php _e("HELLO"); ?> ' + response.first_name + '</a></li><li><a href="<?php echo make_url("logout"); ?>"><?php _e("Logout"); ?></a> </li>');
                        $("#ajax_reg").append('<li><a href="<?php echo make_url("logout"); ?>">Logout</a></li>');
                        var options = '';
                        $(response.customers).each(function (i, v) {
                            options += "<option value='" + v.id + "'>" + v.first_name + ' ' + v.last_name + "</option>";
                        });
                        $('.pull-left').html("<select id = 'custm'>" + options + "</select>");
                        var cust_record = '';
                        var ribbon_val = '';
                        $(response.customer_batches).each(function (k, val) {
                            cust_record += '<li id="ribbon_' + val.id + '"><div>' + val.ribbon_type + '</div><span><label><input type=checkbox  class=chkid value=' + val.id + '>' + val.ribbon_name_en + '</label></span></li>';
                        });
                        $('.batch').html(cust_record);
                        if (cust_record != '') {
                            $('#show_buttons').html('<input type="button" class="delet-slct hvr-float-shadow delete" value="<?php _e("Delete Selected"); ?>"><input type="button" class="delet-slct hvr-float-shadow select" value="Select All"><a href="javascript:void(0)"><input type="button" class="cart-slct divider hvr-float-shadow add_to_cart_ribbon" value="<?php _e("Add to Cart"); ?>"></a><a href="<?php echo make_url('cart'); ?>"><input type="button" class="cart-slct divider buy hvr-float-shadow view_cart" value="<?php _e("View Cart"); ?>"></a>');
                        } else if (cust_record == '') {
                            $('#show_buttons').html('');
                        }
                    } else {
                        //window.location.reload();
                    }
                } else if (response.status == "error") {
                    toastr['error'](response.msg);
                }
            }
        });
    });
    /*- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -Registeration ajax- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -*/
    /*get subdistrict using district id */
    $('#name_dist').change(function () {
        jQuery('#name_subdist').html('');
        jQuery('#name_comm').html('');
        jQuery('#name_boro').html('');
        var distId = $(this).val();
        $.ajax({
            url: "<?php echo make_url('ajax', array("action" => "getSubistrict")); ?>",
            type: "post",
            dataType: "json",
            data: {
                q: distId
            },
            success: function (data) {
                var option = '', selected = '', i = '';
                option += '<option value="">Bitte auswaehlen</option>';
                if (data.status == 'true') {
                    jQuery.each(data.record, function (key, value) {
                        if (i == 1) {
                            selected = ''
                        } else {
                            selected = '';
                        }
                        option += '<option value=' + value.id + ' ' + selected + '>' + value.name_en + '</option>';
                        jQuery('#name_subdist').html(option);
                        i++;
                    });
                } else {
                    jQuery('#name_subdist').html('');
                    jQuery('#name_comm').html('');
                    jQuery('#name_boro').html('');
                }
            }
        });
    });
    /*get community using district id & subdist_id */
    $('#name_subdist').change(function () {
        var distId = $('#name_dist').val();
        var subdist = $(this).val();
        $.ajax({
            url: "<?php echo make_url('ajax', array("action" => "getCommunity")); ?>",
            type: "post",
            dataType: "json",
            data: {
                d_id: distId,
                s_id: subdist
            },
            success: function (data) {
                //console.log(data);
                var option = '', selected = '', i = '';
                option += '<option value="">Bitte auswaehlen</option>';
                if (data.status == 'true') {
                    jQuery.each(data.record, function (key, value) {
                        if (i == 1) {
                            selected = ''
                        } else {
                            selected = '';
                        }
                        option += '<option value=' + value.id + ' ' + selected + '>' + value.name_en + '</option>';
                        jQuery('#name_comm').html(option);
                        i++;
                    });
                } else {
                    jQuery('#name_comm').html('');
                }
            }
        });
    });
    /*get borough using district id & subdist_id & comm_id */
    $('#name_comm').change(function () {
        var distId = $('#name_dist').val();
        var subdistId = $('#name_subdist').val();
        var commId = $(this).val();
        $.ajax({
            url: "<?php echo make_url('ajax', array("action" => "getborough")); ?>",
            type: "post",
            dataType: "json",
            data: {
                d_id: distId,
                s_id: subdistId,
                c_id: commId
            },
            success: function (data) {
                //console.log(data);
                var option = '', selected = '', i = '';
                option += '<option value="">Please Select</option>';
                if (data.status == 'true') {
                    jQuery.each(data.record, function (key, value) {
                        if (i == 1) {
                            selected = ''
                        } else {
                            selected = '';
                        }
                        option += '<option value=' + value.id + ' ' + selected + '>' + value.name_en + '</option>';
                        jQuery('#name_boro').html(option);
                        i++;
                    });
                } else {
                    jQuery('#name_boro').html('');
                }
            }
        });
    });
    $(document).on('submit', '#register-form', function (e) {
        var data = {"action": "register"};
        data = $("#register-form").serialize() + "&" + $.param(data);
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: '<?php echo make_url('ajax', array("action" => "register")); ?>',
            data: data,
            dataType: 'JSON',
            success: function (response) {
                if (response.status == "Sucessfully") {
                    toastr.success(response.msg);
                    $('#myModal').modal('hide');
                    $('#register-form')[0].reset();
                } else if (response.status == "error") {
                    toastr.error(response.msg);
                }
            }
        });
    });
    /*- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -forgot ajax- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -*/
    $("#forgot-submit").click(function (e) {
        var data = {"action": "forgot"};
        data = $("#forgot_form").serialize() + "&" + $.param(data);
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: '<?php echo make_url('ajax', array("action" => "forgot")); ?>',
            data: data,
            dataType: 'JSON',
            success: function (response) {
                if (response.status == "Sucessfully") {
                    toastr.success(response.msg);
                    $('#myModal').modal('hide');
                    $('#forgot_form')[0].reset();

                } else if (response.status == "error") {
                    toastr.error(response.msg);
                }
            }
        });
    });
    /*- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - popup hide show- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -*/
    $(function () {
        $('#login-link').click(function (e) {
            $("#login-form").delay(100).fadeIn(100);
            $("#register-form").fadeOut(100);
            $('#register-form-link').removeClass('active');
            $("#forgot_form").fadeOut(100);
            $(".box-sow").show();
            $('#login-form-link').addClass('active');
            e.preventDefault();
        });
        $('#register-link').click(function (e) {
            $("#register-form").delay(100).fadeIn(100);
            $("#login-form").fadeOut(100);
            $('#login-form-link').removeClass('active');
            $("#forgot_form").fadeOut(100);
            $('#register-form-link').addClass('active');
            e.preventDefault();
        });
        $('#login-form-link').click(function (e) {
            $("#login-form").delay(100).fadeIn(100);
            $("#register-form").fadeOut(100);
            $('#register-form-link').removeClass('active');
            $("#forgot_form").fadeOut(100);
            $(".box-sow").show();
            $(this).addClass('active');
            e.preventDefault();
        });
        $('#register-form-link').click(function (e) {
            $("#register-form").delay(100).fadeIn(100);
            $("#login-form").fadeOut(100);
            $('#login-form-link').removeClass('active');
            $("#forgot_form").fadeOut(100);
            $(this).addClass('active');
            e.preventDefault();
        });
        $("#tog-blok").click(function () {
            $(".box-sow").hide();
            $(".box-confrm").show();
        });
        $("a#back").click(function () {
            $(".box-confrm").hide();
            $(".box-sow").show();
        });

    });
        /*-----------------------------------Add customer----------------------------------------------------*/
    $(".add_cust").click(function () {
        if (log_in) {
            $('#custmodal').modal('show');
            $("#cust-submit").click(function (e) {
                var data = {"action": "add_customer"};
                data = $("#customer_add_form").serialize() + "&" + $.param(data);
                e.preventDefault();
                e.stopImmediatePropagation();
                $('.ajax-load-image').css('display', 'block');
                $.ajax({
                    type: 'POST',
                    url: '<?php echo make_url('ajax', array("action" => "add_customer")); ?>',
                    data: data,
                    dataType: 'JSON',
                    success: function (response) {
                        $('.ajax-load-image').css('display', 'none');
                        if (response.status == "Sucessfully") {
                            $('#custm').append('<option value =' + response.id + '>' + response.first_name + ' ' + response.last_name + '</option>');
                            $('#custm').show();
                            toastr.success(response.msg);
                            $('#custmodal').modal('hide');
                            $('.fname').val('');
                            $('#msg').html('');
                            // window.location.reload();
                            var name = GetParameterValues('page');
                            if (name == 'customer') {
                                setTimeout(function () {
                                    window.location.reload(1);
                                }, 1000);
                            }
                            function GetParameterValues(param) {
                                var url = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
                                for (var i = 0; i < url.length; i++) {
                                    var urlparam = url[i].split('=');
                                    if (urlparam[0] == param) {
                                        return urlparam[1];
                                    }
                                }
                            }
                        } else if (response.status == "error") {
                            toastr.error(response.msg);
                        }
                    }
                });
            });
        } else {
            $('#myModal').modal('show');
            $('.customer_url').val("add_to_cust");
        }
    });
    /*- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -Delete Cart- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -*/
    $('.del_cart').click(function (e) {
        var id = $(this).attr('data-value');
        var r = confirm('Are you sure? you want to delete this item!');
        if (r == true)
        {
            $.ajax({
                url: "<?php echo make_url('ajax', array("action" => "del_from_cart")); ?>",
                type: "post",
                dataType: "json",
                data: {
                    'id': id,
                },
                success: function (data) {
                    toastr['success']('Item has been successfully deleted!');
                    setTimeout(function () {
                        window.location.reload(1);
                    }, 1000);
                }
            });
        }
    });
    /*- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -checkout shipping- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -*/
    $("#ship").change(function () {
        var ischecked = $(this).is(':checked');
        if (ischecked == false) {
            $("#shipping_container").css('display', 'block');
        } else {
            $("#shipping_container").css('display', 'none');
        }
    });
    $(document).ready(function () {
        $("a.myrefclass").on('click', function (event) {
            if (this.hash !== "") {
                event.preventDefault();
                var hash = this.hash;
                $('html, body').animate({
                    scrollTop: $(hash).offset().top
                }, 800, function () {
                    window.location.hash = hash;
                });
            }
        });
        $("#check_password").submit(function(event){
            event.preventDefault();
            var data = $( this ).serializeArray();
            $.ajax({
                url: '<?php echo make_url('dsgvo', array("action" => "check_password")); ?>',
                type: 'post',
                data: data,
                dataType: 'json',
                success: function (response) {
                    if (response.status == "success") {
                        $("#check_password").css("display", "none");
                        $("#update_terms_conditions").css("display", "block");
                        if(response.data.accepted_dsgvo1 == "1"){
                            $("#accepted_dsgvo").prop("checked",true);
                        }else{
                            $("#accepted_dsgvo").prop("checked",false);
                        }
                    }else{
                        toastr['error'](response.msg);
                    }
                },
                error: function () {
                    toastr['error']('error occurred. please try again!');
                }
            });
        });
        $("#update_terms_conditions").submit(function(event){
            event.preventDefault();
            var data = $( this ).serializeArray();
            $.ajax({
                url: '<?php echo make_url('dsgvo', array("action" => "update_terms_conditions")); ?>',
                type: 'post',
                data: data,
                dataType: 'json',
                success: function (response) {
                    if (response.status == "success") {
                        toastr['success'](response.msg);
                    }else{
                        toastr['error'](response.msg);
                    }
                },
                error: function () {
                    toastr['error']('error occurred. please try again!');
                }
            });
        });
        $(".accepted_info").on("click",function(){
            var id = $(this).attr("id");
            if($(this).prop('checked')){
                $("."+id).css("display","none");
            }else{
                $("."+id).css("display","block");
            }
        });
        $("#checkoutForm").submit(function(){
            if($(this).find("#agreeAGB1").prop('checked')){
                $(this).submit();               
            }else{
                toastr['error']("Bitte akzeptieren Sie die AGBs.");
                return false;
            }
        });
    });
</script>