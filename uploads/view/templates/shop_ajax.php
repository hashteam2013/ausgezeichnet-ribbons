<script>
    /*-------------------------------------shop checkbox (show ribbons using category)-------------------------------------------------------------------------*/
    // Read login state directly from PHP session to avoid stale/missing DOM values
    var log_in = "<?php echo LOGGED_IN_USER ? '1' : '0'; ?>";
    var customer_id = $("#custm option:selected").val();
    var recent_activity = {};
    recent_activity['category'] = {};
    recent_activity['district'] = {};
    recent_activity['department'] = {};
    recent_activity['cust_id'] = customer_id;
    var filter_id = '';
    var batch_id = '';
    
    $('.cat_class').change(function () {
        var ids = [];
        var id = this.checked ? this.value : '';
        var cat_id = $('#cat_id_' + id).attr('id');
        var position_id = $(this).attr('id');
        var remove_id = $(this).val();
        ids.push(id);
        if (log_in == "1") {
            var cids = [];
            $("input[name='categories_name[]']:checked").each(function () {
                cids.push($(this).val());
            });
            recent_activity.category = cids;
            getLastactivity(recent_activity);
        }
        if (id != '') {
            var district_related = $(this).attr("dist-attr");
	var show_closed = $(this).attr("showclosed");
            var district_ids = [];
            if (district_related == '1') {
                $("input[name='districts_name[]']:checked").each(function () {
                    district_ids.push($(this).val());
                });
            }
            $("#" + position_id).prop("disabled", true);
            $('.ajax-load-image').css('display', 'block');
            $.ajax({
                url: "<?php echo make_url('ajax', array("action" => "cat_list")); ?>",
                type: "post",
                dataType: "json",
                data: {
                    'ids': ids,
                    'district_related': district_related,
                    'district_ids': district_ids
                },
                success: function (data) {
                    $('.ajax-load-image').css('display', 'none');
                    $("#" + position_id).prop("disabled", false);
                    var status = 0;
                    var orgname = 0;
                    var cat_list = "";
                    var cat_name = '';
                    $(data).each(function (index, value) {
                        var countt = 0;
                        $(value).each(function (i, v) {
                            //console.log(v);
                            if (v.batch_image !== null) {
                                var desc_len = v.desc_en;
                                batch_id = v.batch_id;
                                org_id = v.org_id;
                                if (district_related == 1) {
                                    cat_name = v.name_en;
                                }
                                if (district_related == 0) {
                                    cat_name = v.cat;
                                }
                                if (status != v.org_id && v.org_name !== null && v.org_name != '' && typeof v.org_name != "undefined") {
                                    if (countt != 0) {
                                        cat_list += "</div>";
                                    }
                                    cat_list += "<div class='conurty-nm cat_" + remove_id + " contract'>" + v.org_name + "<div class='plusminus'>+</div></div><div class='inner'style='display: none;'>";
                                    countt++;
                                } else if (v.org_name == null && orgname == 0) {
                                    orgname = 1;
                                    if (countt != 0) {
                                        cat_list += "</div>";
                                    }
                                    cat_list += "<div class='conurty-nm cat_" + remove_id + " contract '>" + cat_name + " <div class='plusminus'>+</div> </div><div class='inner' style='display: none;'>";
                                    countt++;
                                }
                                status = v.org_id;
                                var gray = v.is_active == '0' ? "style='filter: grayscale(100%) opacity(.5);'" : "";
                                var disabledvalue = v.is_active == '0' ? 'disabled' : '';
                                var valuebecome = v.is_active == '0' ? "<?php _e('Not Available'); ?>" : "<?php _e('Add to list'); ?>";
                                //console.log(valuebecome);
                                cat_list += "<ul class='cat_" + remove_id + "'><li " + gray + "><div><img src=<?php echo DIR_WS_UPLOADS; ?>batch/" + v.batch_image + " class='img-responsive'></div><div class='add-to-list'><input type='button' class='add-list' " + disabledvalue + " value='" + valuebecome + "' data-batch-id='" + v.batch_id + "' data-batch-type=" + v.type + "></div><p>" + v.webshop_title_en + "</p><br><p style='color:blue' >" + v.comment + "</p> </li></ul>";
                            } else {
                            }
                        });
                        $('.list').append("<span class='outer_" + position_id + "'>" + cat_list + "</span>");

                        var emp = $('.list').find('span').sort(sortMe);

                        function sortMe(a, b)
                        {
                            return a.className > b.className;
                        }
                        $('.list').append(emp);
                        var height_div = $('.high').height();
                        var numItems = $(".list").find(".outer").length;
                        var sr = 0;
                        $('.outer').each(function () {
                            if ($(this).text() !== '') {
                                sr++;
                            }
                        });
                        if (sr == 1) {
                            $(".list.outer").find(".inner").css("max-height", height_div);
                        } else {
                            $(".list.outer").find(".inner").css("max-height", '600px');
                        }
                        orgname = "";
                    });
                    /*district specified is closed **/
                   if (show_closed == 0) { 
                        $(".contract").next(".inner").slideDown(300);
                        $(".contract").children(".plusminus").text('-');
                       } 
                }
            });
        } else {
            var district_related = $(this).attr("dist-attr");
            if (district_related== '1') {
                $(".dist_class").prop("checked", false);
            }
            $('.outer_' + position_id).remove();
            $('.cat_' + remove_id).remove();
            if ($("#cat_id_3").is(':checked')) {
            } else {
                $('.dist-related').remove();
            }
        }
    });
    /*-----------------------------------------------Related categories and districts---------------------------------------------------------------------------------*/
    $('.dist_class').change(function () {
        var district_related = $(this).attr("dist-attr");
        var dist_id = $(this).attr('id');
        var dist_remove_id = $(this).val();
        var items = [];
        var id = '';
        $("input[name='districts_name[]']:checked").each(function () {
            items.push($(this).val());
        });
        if (log_in == "1") {
            ddid = [];
            $("input[name='districts_name[]']:checked").each(function () {
                ddid.push($(this).val());
            });
            recent_activity.district = ddid;
            getLastactivity(recent_activity);
        }
        var cat_id = "";
        var at_id = '';
        $('input[class="cat_class"]').each(function () {
            if ($(this).attr("dist-attr") == '1') {
                cat_id = $(this).val();
                at_id = $(this).attr('id');
                $(this).prop("checked", true);
            }
        });
        $("#" + dist_id).prop("disabled", true);
        $('.ajax-load-image').css('display', 'block');
        $.ajax({
            url: "<?php echo make_url('ajax', array("action" => "dist_list")); ?>",
            type: "post",
            dataType: "json",
            data: {
                'cat_id': cat_id,
                'district_ids': items
            },
            success: function (data) {
                $("#" + dist_id).prop("disabled", false);
                $('.ajax-load-image').css('display', 'none');
                $('.cat_' + cat_id).remove();
                $('.dist-related').remove();
                var status = 0;
                var filter_id = 0;
                var orgname = 0;
                var cat_list = "";
                var cat_name = '';
                var countt = '';
                $(data).each(function (index, value) {
                    $(value).each(function (i, v) {
                        if (v.batch_image !== null) {
                            var desc_len = v.desc_en;
                            //var description = desc_len.substr(0, 50);
                            batch_id = v.batch_id;
                            org_id = v.org_id;
                            if (district_related == 0) {
                                if (filter_id != v.filter_id) {
                                    if (countt != 0) {
                                        cat_list += "</div>";
                                    }
                                    cat_list += "<div class='conurty-nm dist-related dist_" + dist_remove_id + " contract'>" + v.cat + "<div class='plusminus'>+</div></div><div class='inner'style='display: none;'>";
                                    countt++;
                                }
                            } else {
                                if (status != v.org_id && v.org_name !== null && v.org_name != '' && typeof v.org_name != "undefined") {
                                    orgname = 0;
                                    if (countt != 0) {
                                        cat_list += "</div>";
                                    }
                                    cat_list += "<div class='conurty-nm dist-related dist_" + dist_remove_id + " contract'>" + v.org_name + "<div class='plusminus'>+</div></div><div class='inner'style='display: none;'>";
                                    countt++;
                                } else if (v.org_name == null && orgname == 0) {
                                    orgname = 1;
                                    if (countt != 0) {
                                        cat_list += "</div>";
                                    }
                                    cat_list += "<div class='conurty-nm dist-related dist_" + dist_remove_id + " contract'>" + v.name_en + "<div class='plusminus'>+</div></div><div class='inner'style='display: none;'>";
                                    countt++;
                                }
                                status = v.org_id;
                            }
                            filter_id = v.filter_id;
                            orgname = v.org_name;
                            var gray = v.is_active == '0' ? "style='filter: grayscale(100%) opacity(.5);'" : "";
                            var disabledvalue = v.is_active == '0' ? 'disabled' : '';
                            var valuebecome = v.is_active == '0' ? '<?php _e('Not Available'); ?>' : '<?php _e('Add to list'); ?>';
                            cat_list += "<ul class='dist-related dist_" + dist_remove_id + "' ><li " + gray + "><div><img src=<?php echo DIR_WS_UPLOADS; ?>batch/" + v.batch_image + " class='img-responsive'></div><div class='add-to-list'><input type='button' class='add-list' " + disabledvalue + " value='" + valuebecome + "' data-batch-id='" + v.batch_id + "' data-batch-type=" + v.type + "></div><p>" + v.webshop_title_en + "</p></li></ul>";
                            countt++;
                        } else {
                        }
                    });
                    $('.list').append("<span class='outer_" + at_id + "'>" + cat_list + "</span>");

                    var emp = $('.list').find('span').sort(sortMe);

                    function sortMe(a, b)
                    {
                        return a.className > b.className;
                    }
                    $('.list').append(emp);
                    var height_div = $('.high').height();
                    var numItems = $(".list").find(".outer").length;
                    var sr = 0;
                    $('.outer').each(function () {
                        if ($(this).text() !== '') {
                            sr++;
                        }
                    });
                    if (sr == 1) {
                        $(".list.outer").find(".inner").css("max-height", height_div);
                    } else {
                        $(".list.outer").find(".inner").css("max-height", '500px');
                    }
                });
            }
        });
    });
    /*--------------------------------------show ribbons using collections---------------------------------------------------------------*/
    $('.depart_class').change(function () {
        var ids = [];
        var id = this.checked ? this.value : '';
        var depart_id = $('#depart_id_' + id).attr('id');
        var depart_remove_id = $(this).val();
        if (log_in == "1") {
            did = [];
            $("input[name='departments_name[]']:checked").each(function () {
                did.push($(this).val());
            });
            recent_activity.department = did;
            getLastactivity(recent_activity);
        }
        if (id != '') {
            $("#" + depart_id).prop("disabled", true);
            $('.ajax-load-image').css('display', 'block');
            $.ajax({
                url: "<?php echo make_url('ajax', array("action" => "depart_list")); ?>",
                type: "post",
                dataType: "json",
                data: {
                    'ids': did
                },
                success: function (data) {
                    $('.ajax-load-image').css('display', 'none');
                    $("#" + depart_id).prop("disabled", false);
                    var status = 0;
                    var cat_list = "";
                    var cat_name = '';
                    var countt = '';
                    $(data).each(function (index, value) {
                        $(value).each(function (i, v) {
                            if (v.batch_image !== null) {
                                var desc_len = v.desc_en;
                                batch_id = v.batch_id;
                                filter_id = v.filter_id;
                                if (status != v.filter_id) {
                                    if (countt != 0) {
                                        cat_list += "</div>";
                                    }
                                    cat_list += "<div class='conurty-nm depart_" + depart_remove_id + " contract'>" + v.name_en + "<div class='plusminus'>+</div></div><div class='inner'style='display: none;'>";
                                    countt++;
                                }
                                status = v.filter_id;
                                var gray = v.is_active == '0' ? "style='filter: grayscale(100%) opacity(.5);" : "";
                                var disabledvalue = v.is_active == '0' ? 'disabled' : '';
                                var valuebecome = v.is_active == '0' ? '<?php _e('Not Available'); ?>' : '<?php _e('Add to list'); ?>';
                                cat_list += "<ul class='depart_" + depart_remove_id + "'><li " + gray + "><div><img src=<?php echo DIR_WS_UPLOADS; ?>batch/" + v.batch_image + " class='img-responsive'></div><div class='add-to-list'><input type='button' class='add-list' " + disabledvalue + " value='" + valuebecome + "' data-batch-id='" + v.batch_id + "' data-batch-type=" + v.type + "></div><p>" + v.webshop_title_en + "</p></li></ul>";
                                countt++;
                            }
                            else {
                            }
                        });
                        $('.list').append("<div class='outer'>" + cat_list + "</div>");
                        var height_div = $('.high').height();
                        var numItems = $(".list").find(".outer").length;
                        var sr = 0;
                        $('.outer').each(function () {
                            if ($(this).text() !== '') {
                                sr++;
                            }
                        });
                        if (sr == 1) {
                            $(".list.outer").find(".inner").css("max-height", height_div);
                        } else {
                            $(".list.outer").find(".inner").css("max-height", '400px');
                        }
                    });
                }
            });
        } else {
            $('.depart_' + depart_remove_id).remove();
        }
    });

    /*-----------------------------------------Add to list----------------------------------------------------------------------------*/
    $(document).on('click', '.add-list', function () {
        var user_id = $('.user_id').val();
        var cust_id = $("#custm").val();
        if (cust_id !== null && cust_id != '' && typeof cust_id != "undefined") {
            var batch_id = $(this).attr("data-batch-id");
            var batchType = $(this).attr("data-batch-type");
            var thiss = $(this);
            if (log_in && batchType == '0') {
                $('.ajax-load-image').css('display', 'block');
                $.ajax({
                    url: "<?php echo make_url('ajax', array("action" => "add_list")); ?>",
                    type: "post",
                    dataType: "json",
                    data: {
                        'user_id': user_id,
                        'cust_id': cust_id,
                        'batch_id': batch_id
                    },
                    success: function (data) {
                        $('.ajax-load-image').css('display', 'none');
                        var custData = '';
                        if (data.status == 'Sucessfully') {
                        }
                        else if (data.status == 'error') {
                            toastr['error'](data.msg);
                        }
                        $(data.result).each(function (index, value) {
                            custData += '<li id=ribbon_' + value.custId + '><div>' + value.ribbon_type + '</div><span><label><input type=checkbox checked=checked class=chkid  value=' + value.custId + '>' + value.ribbon_name_en + '</label></span></li>';
                            $('.batch').html(custData);
                        });
                        if (data.result != '') {
                            $('#show_buttons').html('<select id="action-dropdown" class="delet-slct hvr-float-shadow"><option value=""><?php _e("Select Action");?></option><option value="delete"><?php _e("Delete Selected"); ?></option><option value="select"><?php _e("Select All"); ?></option></select><a href="javascript:void(0)"><input type="button" class="cart-slct divider hvr-float-shadow add_to_cart_ribbon" value="<?php _e("Add to Cart"); ?>"></a><a href="<?php echo make_url('cart'); ?>"><input type="button" class="cart-slct divider buy hvr-float-shadow view_cart" value="<?php _e("View Cart"); ?>"></a>');
                            badgeFilterByLevel(cust_id);
                        }
                    }
                });
            } else if (log_in && batchType == '1') {
                $(".add-list").addClass("num_type");
                if (jQuery('.drop').parent().length !== '')
                {
                    thiss.parent().append("<select id=" + batch_id + " class=drop><option><?php _e("Select number"); ?></option><option value=1>1</option><option  value=2>2</option><option  value=3>3</option><option  value=4>4</option><option  value=5>5</option><option  value=6>6</option><option  value=7>7</option><option  value=8>8</option><option  value=9>9</option></select>");
                    thiss.parent().append("<input type='button' class='go_1_" + batch_id + "' id='add-list-go' value='Go'>");
                }
                $(document).on('click', '.go_1_' + batch_id, function () {
                    var cust_id = $("#custm").val();
                    var number = $(this).prev('select').val();
                    var batchID = $(this).parent().find(".num_type").attr("data-batch-id");
                    $('.ajax-load-image').css('display', 'block');
                    $.ajax({
                        url: "<?php echo make_url('ajax', array("action" => "add_list_type")); ?>",
                        type: "post",
                        dataType: "json",
                        data: {
                            'user_id': user_id,
                            'cust_id': cust_id,
                            'batch_id': batch_id,
                            'number': number,
                            'batchID': batchID,
                            'batchType': batchType
                        },
                        success: function (data) {
                            $('.ajax-load-image').css('display', 'none');
                            if (data.status == 'Sucessfully') {
                                $('.batch').append('<li id= ribbon_' + data.custId + '><div>' + data.ribbon_type + '</div><span><label><input type=checkbox checked=checked class=chkid value=' + data.custId + '>' + data.ribbon_name_en + '</label></span></li>');
                            } else {
                                toastr['error'](data.msg);
                                return false;
                            }
                            if (data != '') {
                                $('#show_buttons').html('<select id="action-dropdown" class="delet-slct hvr-float-shadow"><option value=""><?php _e("Select Action");?></option><option value="delete"><?php _e("Delete Selected"); ?></option><option value="select"><?php _e('Select All'); ?></option></select><a href="javascript:void(0)"><input type="button" class="cart-slct divider hvr-float-shadow add_to_cart_ribbon" value="<?php _e("Add to Cart"); ?>"></a><a href="<?php echo make_url('cart'); ?>"><input type="button" class="cart-slct divider buy hvr-float-shadow view_cart" value="<?php _e("View Cart"); ?>"></a>');
                                badgeFilterByLevel(cust_id);
                            }
                        }
                    });
                });
            } else if (log_in && batchType == '2') {
                $('.ajax-load-image').css('display', 'block');
                $.ajax({
                    url: "<?php echo make_url('ajax', array("action" => "ribbon_location")); ?>",
                    type: "post",
                    dataType: "json",
                    data: {
                        'batch_id': batch_id,
                        'batchType': batchType
                    },
                    success: function (data) {
                        $('.ajax-load-image').css('display', 'none');
                        var loc_val = '';
                        var dropoptions = '';
                        $(data).each(function (i, v) {
                            dropoptions += "<option value='" + v.id + "'>" + v.name + "</option> ";
                        });
                        thiss.parent().find("#location").remove();
                        thiss.parent().append("<select id='location' class='loc'><option><?php _e('Select Location'); ?></option>" + dropoptions + "</select>");
                        $(document.body).on('change', ".loc", function (e) {
                            loc_val = $(this).val();
                            var batchID = $('.add-list').attr("data-batch-id");
                        });
                        thiss.parent().find("#add-list-go").remove();
                        thiss.parent().append("<input type='button' class='go' id='add-list-go' value='Go'>");
                    }
                });
            } else {
                $('.add-list').click(function (e) {
                    $('#myModal').modal('show');
                    $("#login-form").delay(100).fadeIn(100);
                    $("#register-form").fadeOut(100);
                    $('#register-form-link').removeClass('active');
                    $("#forgot_form").fadeOut(100);
                    $(".box-sow").show();
                    $('#login-form-link').addClass('active');
                    e.preventDefault();
                });
                $('.batch_id').val(batch_id);
                $('.current_url').val("add_to_list");
            }
        } else {
            toastr.error("<?php _e("Please select customer first."); ?>");
        }
    });
    $(document).on('click', '.go', function () {
        var user_id = $('.user_id').val();
        var cust_id = $("#custm").val();
        var batch_id = $(this).parent().find(".add-list").attr('data-batch-id');
        var loc_val = $(this).parent().find("#location").val();
        $('.ajax-load-image').css('display', 'block');
        $.ajax({
            url: "<?php echo make_url('ajax', array("action" => "add_list_country")); ?>",
            type: "post",
            dataType: "json",
            data: {
                'user_id': user_id,
                'cust_id': cust_id,
                'batch_id': batch_id,
                'loc_val': loc_val
            },
            success: function (data) {
                //console.log(data);
                $('.ajax-load-image').css('display', 'none');
                if (data.status == 'Sucessfully') {

                    $('.batch').append('<li id=ribbon_' + data.custId + '><div>' + data.ribbon_type + '</div><span><label><input type=checkbox checked=checked class=chkid value=' + data.custId + '>' + data.ribbon_name_en + '</label></span></li>');
                } else {
                    toastr['error'](data.msg);
                    return false;
                }
                if (data != '') {
                    badgeFilterByLevel(cust_id);
                } else {
                    toastr['error'](data.msg);
                }
            }
        });
    });
    /*-------------------------------------on select customer show list-----------------------------------------------------------------------------------*/
    $(document.body).on('change', "#custm", function (e) {
        var customer_id = $("#custm option:selected").val();
        if (customer_id) {
            if (log_in == '1') {
                var cust = [];
                cust.push($("#custm").val());
                recent_activity.cust_id = cust;
                getLastactivity(recent_activity);
            }
            $.ajax({
                url: "<?php echo make_url('ajax', array("action" => "show_list")); ?>",
                type: "post",
                dataType: "json",
                data: {
                    'customer_id': customer_id,
                },
                success: function (data) {
                    $('.ajax-load-image').css('display', 'none');
                    var htmlData = '';
                    $(data).each(function (index, value) {
                        htmlData += '<li id="ribbon_' + value.custId + '"><div>' + value.ribbon_type + '</div><span><label><input type=checkbox  class=chkid value=' + value.custId + '>' + value.ribbon_name_en + '</label></span></li>'
                    });
                    $('.batch').html(htmlData);
                    if (htmlData != '') {
                        $('#show_buttons').html('<select id="action-dropdown" class="delet-slct hvr-float-shadow"><option value=""><?php _e("Select Action");?></option><option value="delete"><?php _e('Delete Selected'); ?></option><option value="select"><?php _e('Select All'); ?></option></select><a href="javascript:void(0)"><input type="button" class="cart-slct divider hvr-float-shadow add_to_cart_ribbon" value="<?php _e("Add to Cart"); ?>"></a><a href="<?php echo make_url('cart'); ?>"><input type="button" class="cart-slct divider buy hvr-float-shadow view_cart" value="<?php _e("View Cart"); ?>"></a>');
                        var badgeData = '';
                        $(data).each(function (index, value) {
                            badgeData += value.ribbon_type;
                        });
                        var number_of_rec = data.length;
                        var badgeData1 = '';
                        badgeFilterByLevel(customer_id);
                    } else if (htmlData == '') {
                        $('#show_buttons').html('');
                        $('.badges').html('');
                    }
                }
            });
        }
    });
    /*-------------------------------------on select-----------------------------------------------------------------------------------*/
    $(document.body).on('click', ".select", function (e) {
        if ($(".chkid").length == $(".chkid:checked").length) {
            $('.chkid').prop("checked", false);
            $(this).val("<?php _e('Select All'); ?>");
        } else {
            $('.chkid').prop("checked", true);
            $(this).val("<?php _e('Deselect All'); ?>");
        }
    });

    /*-----------------Delete----------------------------------*/
    $(document.body).on('click', ".delete", function (e) {
        var cust_id = $("#custm").val();
        var values = [];
        $.each($("input[class='chkid']:checked"), function () {
            values.push($(this).val());
        });
        if (values == '') {
            toastr['error']("<?php _e('Please check at least one batch!'); ?>");
        } else {
            var r = confirm("<?php _e('Are you sure? You want to delete this badge!') ?>");
            if (r == true) {
                if (values) {
                    $.ajax({
                        url: "<?php echo make_url('ajax', array("action" => "delete_customer")); ?>",
                        type: "post",
                        dataType: "json",
                        data: {
                            'values': values,
                            'cust_id': cust_id
                        },
                        success: function (data) {
                            $.each(values, function (key, value) {
                                $('#ribbon_' + value).remove();
                            });
                            var htmlBatch = $('ul.batch').html();
                            if ($.trim(htmlBatch) == '') {
                                $('#show_buttons').html('');
                                $('.badges').html('');
                            }
                            /*********get all updated badge after delete one or more together************/
                            $.ajax({
                                url: "<?php echo make_url('ajax', array("action" => "show_list_1")); ?>",
                                type: "post",
                                dataType: "json",
                                data: {
                                    'customer_id': cust_id,
                                },
                                success: function (data) {
                                    //console.log(data);
                                    var total, placementOne = '', badgeData = '';
                                    $(data).each(function (index, value) {
                                        badgeData += value.ribbon_type;
                                        total = data.length;
                                        if (total % 3 == 1 && index == 0) {
                                            var oneR1 = '<div class="ribbon_outer1"></div>';
                                            badgeData = oneR1 + badgeData + oneR1;
                                        }
                                        else if (total % 3 == 2) {
                                            if (index === 0) {
                                                var twoR1 = '<div class="ribbon_outer2"></div>';
                                                badgeData = twoR1 + badgeData;
                                            }
                                            if (index === 1) {
                                                var twoR2 = '<div class="ribbon_outer2"></div>';
                                                badgeData = badgeData + twoR2;
                                            }
                                        }
                                        tempvar1 = total % 3;
                                        tempvar2 = total - tempvar1;
                                        tempvar3 = tempvar2 * 2 / 3;
                                        tempvar4 = sign(tempvar1);
                                        tempvar5 = sign(3 * sign(tempvar3) + tempvar1 - 1);
                                        tempvar6 = tempvar3 + tempvar4;
                                        LConnectors = tempvar5 + tempvar6 - 1;
                                        QConnectors = ((total - 3) + (total - 3) * sign(total - 3)) / 2;
                                        if (total == 4 || total == 7 || total == 10 || total == 13 || total == 16)
                                        {
                                            QConnectors = QConnectors + 1;
                                        }

                                        if (total < 8)
                                        {
                                            nails = 2;
                                        }
                                        else
                                        {
                                            nails = 4;
                                        }
                                    });
                                    $('.badges').html('<div class=srch-reslt slect mar-top-10><div class=srch-heading><?php _e("Badges Placed"); ?></div>'+'<div class="druken-btn"><a class="add-btn hvr-float-shadow  pull-left" href="<?php echo WS_PATH; ?>?page=printBadgesPlaced&id=' + cust_id + '" title="invoice">Ansicht Drucken</a> <a class="add-btn hvr-float-shadow pull-right" href="<?php echo WS_PATH; ?>?page=printFullBadgesPlaced&id=' + cust_id + '" title="invoice">Alle Drucken</a></div>'+'<div class=flag-contaner>' + '<p> F&uumlr diese Spange ben&oumltigen Sie ' + LConnectors + " L&aumlngsverbinder und " + QConnectors + " Querverbinder. Wir empfehlen " + nails + " N&aumlgel. Bitte passen Sie die St&uumlckzahlen im Warenkorb an. </p>" + badgeData + '</div></div></div>');
                                }
                            });

                            toastr['success']("<?php _e('Batch has been deleted successfully!'); ?>");
                        }
                    });
                }
            }
        }
    });
    /*------------------------------------Add to cart-------------------------------------------------------------------*/
    $(document.body).on('click', ".add_to_cart_ribbon", function (e) {
        var customer_id = $("#custm option:selected").val();
        values = [];
        $.each($("input[class='chkid']:checked"), function () {
            values.push($(this).val());
        });

        if (values) {
            $.ajax({
                url: "<?php echo make_url('ajax', array("action" => "add_to_cart")); ?>",
                type: "post",
                dataType: "json",
                data: {
                    'values': values,
                    'customer_id': customer_id,
                },
                success: function (data) {
                    $.each(data.msgs, function (index, value) {
                        toastr[value.status](value.msg);
                    });
                }
            });
        }
    });
    /*--------------------------------------Searching on shop page-----------------------------------------------------------------------------------------*/
    var count = 0;
    $('#search-box').keydown(function (e) {
        if (e.keyCode == 13) {
            $(".search_ribbon").click();//trigger search function
        }
    });
    $(".search_ribbon").click(function () {
        var textData = $('#search-box').val();
        $.ajax({
            url: "<?php echo make_url('ajax', array("action" => "search")); ?>",
            type: "post",
            dataType: "json",
            data: {
                q: textData
            },
            success: function (data) {
                $('#search-box').val('');
                var html = "";
                if (data != '') {
                    var tag_line = '';
                    tag_line = "<div class='tag_line_" + count + "' id='tagg'>Search results <input type='button' class='teriff' id='testff_" + count + "' data-count ='" + count + "' name='X' value='X'></div>";
                    html = tag_line;
                    $(data).each(function (i, v) {
                        var gray = v.is_active == '0' ? "style='filter: grayscale(100%) opacity(.5);'" : "";
                        var disabledvalue = v.is_active == '0' ? 'disabled' : '';
                        var valuebecome = v.is_active == '0' ? '<?php _e('Not Available'); ?>' : '<?php _e('Add to list'); ?>';
                        html += "<ul class='search-out_" + count + "'><li "+gray+"><div><img src=<?php echo DIR_WS_UPLOADS; ?>batch/" + v.batch_image + " class='img-responsive'></div><div class='add-to-list'><input type='button' class='add-list' " + disabledvalue + " value='" + valuebecome + "' data-batch-id='" + v.id + "' data-batch-type=" + v.type + "></div><p>" + v.desc_en + "</p></li></ul>";
                    });
                    $(".list").prepend(html);
                } else {
                    toastr.error('<?php _e("No result found"); ?>');
                }
                count++;
            }
        });
    });
    /**********remove search result***********/
    var tot;
    $(document.body).on('click', ".teriff", function () {
        tot = $(this).data('count');
        $('.search-out_' + tot).html('');
        $('.tag_line_' + tot).hide('');
    });

    function badgeFilterByLevel(customer_id)
    {
        $.ajax({
            url: "<?php echo make_url('ajax', array("action" => "show_list_1")); ?>",
            type: "post",
            dataType: "json",
            data: {
                'customer_id': customer_id,
            },
            success: function (data) {
                var total, placementOne = '', badgeData = '';
                $(data).each(function (index, value) {
                    badgeData += value.ribbon_type;
                    total = data.length;
                    if (total % 3 == 1 && index == 0) {
                        var oneR1 = '<div class="ribbon_outer1"></div>';
                        badgeData = oneR1 + badgeData + oneR1;
                    }
                    else if (total % 3 == 2) {
                        if (index === 0) {
                            var twoR1 = '<div class="ribbon_outer2"></div>';
                            badgeData = twoR1 + badgeData;
                        }
                        if (index === 1) {
                            var twoR2 = '<div class="ribbon_outer2"></div>';
                            badgeData = badgeData + twoR2;
                        }
                    }
                    tempvar1 = total % 3;
                    tempvar2 = total - tempvar1;
                    tempvar3 = tempvar2 * 2 / 3;
                    tempvar4 = sign(tempvar1);
                    tempvar5 = sign(3 * sign(tempvar3) + tempvar1 - 1)
                    tempvar6 = tempvar3 + tempvar4;
                    LConnectors = tempvar5 + tempvar6 - 1;
                    QConnectors = ((total - 3) + (total - 3) * sign(total - 3)) / 2;
                    if (total == 4 || total == 7 || total == 10 || total == 13 || total == 16)
                    {
                        QConnectors = QConnectors + 1;
                    }
                    if (total < 8)
                    {
                        nails = 2;
                    }
                    else
                    {
                        nails = 4;
                    }
                });
                $('.badges').html('<div class = srch-reslt slect mar-top-10><div class=srch-heading><?php _e("Badges Placed"); ?></div>'+'<div class="druken-btn"><a class="add-btn hvr-float-shadow  pull-left" href="<?php echo WS_PATH; ?>?page=printBadgesPlaced&id=' + customer_id + '" title="invoice">Ansicht Drucken</a> <a class="add-btn hvr-float-shadow pull-right" href="<?php echo WS_PATH; ?>?page=printFullBadgesPlaced&id=' + customer_id + '" title="invoice">Alle Drucken</a></div>'+'<div class=flag-contaner>' + '<p> F&uumlr diese Spange ben&oumltigen Sie ' + LConnectors + " L&aumlngsverbinder und " + QConnectors + " Querverbinder. Wir empfehlen " + nails + " N&aumlgel. Bitte passen Sie die St&uumlckzahlen im Warenkorb an.  </p>" + badgeData + '</div></div></div>');
                if (total == '1') {
                    $(".flag-contaner img").css("max-width", "140px");
                    $(".flag-contaner").find(".ribbon_outer").addClass('opacity');
                }
            }
        });
    }
    function addBadgeToList(customer_id)
    {
        $.ajax({
            url: "<?php echo make_url('ajax', array("action" => "show_list_1")); ?>",
            type: "post",
            dataType: "json",
            data: {
                'customer_id': customer_id,
            },
            success: function (data) {
                $('.batch').html('');
                var badgeData = '';
                var level = '';
                $(data).each(function (index, value) {
                    badgeData += "<li id=ribbon_" + value.custId + "><div>" + value.ribbon_type + "</div><span><label><input type=checkbox checked=checked class=chkid  value=" + value.custId + ">" + value.ribbon_name_en + "</label></span></li>";
                });
                $('.batch').append(badgeData);
            }
        });
    }
    /* Accordion js */
    $(".list").on("click", ".contract", function () {
        if ($(this).next(".inner").is(':visible')) {
            $(this).next(".inner").slideUp(300);
            $(this).children(".plusminus").text('+');
        } else {
            $(this).next(".inner").slideDown(300);
            $(this).children(".plusminus").text('-');
        }
    });
    /***********ajax load functoin*******/
    function loadAjax()
    {
        $('body').addClass('load-ajax-body');
        $('.load-ajax-body').css('background-image', 'url(<?php echo WS_PATH ?>"assets/images/ajax.svg")');
    }
    function removeAjax()
    {
        $('body').css('background-image', 'url("")');
    }

    function getLastactivity(selectedStuff) {
        $.ajax({
            url: "<?php echo make_url('ajax', array("action" => "updateLastactivity")); ?>",
            type: "POST",
            dataType: "json",
            data: recent_activity,
            success: function (data) {
                getShopDetail();
            }
        });
    }

    function getShopDetail() {
        var session = "<?php echo isset($_SESSION['user_id']) ? $_SESSION['user_id'] : ''; ?>";
        $.ajax({
            url: "<?php echo make_url('ajax', array('action' => 'getShopInfo')); ?>",
            type: "POST",
            dataType: "JSON",
            data: {
                'sess_id': session
            },
            success: function (data) {
                if (data == false) {
                    $('.categories input:checkbox:first').prop("checked", true);
                    $('.categories input:checkbox:first').trigger("change");
                }
                else
                if (data.category != '') {
                    $(data.category).each(function (i, v) {
                        $("input[name = 'categories_name[]'][value='" + v + "']").attr('checked', true);
                        $("input[name = 'categories_name[]'][value='" + v + "']").trigger("change");
                    });
                }
                if (data.district != '') {
                    $(data.district).each(function (i, v) {
                        $("input[name = 'districts_name[]'][value='" + v + "']").prop('checked', true);
                        $("input[name = 'districts_name[]'][value='" + v + "']").trigger("change");
                    });
                }
                if (data.department != '') {
                    $(data.department).each(function (i, v) {
                        $("input[name = 'departments_name[]'][value='" + v + "']").prop('checked', true);
                        $("input[name = 'departments_name[]'][value='" + v + "']").trigger("change");
                    });
                }
                if (data.cust_id != '') {
                    var values = [];
                    $('#custm option').each(function () {
                        values.push($(this).attr('value'));
                    });
                    if (jQuery.inArray(data.cust_id, values)) {
                        $('#custm option[value=' + data.cust_id + ']').attr("selected", "selected");
                        $('#custm').val(data.cust_id).trigger('change');
                    }
                }
            }
        });
    }
    
    /* * *****default check first chekbox value of categories**************** */
    if (log_in !== '1') {
        $(document).ready(function () {
            $('.categories input:checkbox:first').prop("checked", true);
            $('.categories input:checkbox:first').trigger("change");
        });
    }
    if (log_in == '1') {
        var session = "<?php echo isset($_SESSION['user_id']) ? $_SESSION['user_id'] : ''; ?>";
        getShopDetail();
    }
    /***************************************************************************/
</script>