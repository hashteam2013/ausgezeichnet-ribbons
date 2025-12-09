</div>
<!-- END CONTENT BODY -->
</div>
<!-- END CONTENT -->       
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="page-footer">
    <div class="page-footer-inner"> 1998 - <?php echo date("Y"); ?> &copy; - All Right Reserved</div>
    <div class="scroll-to-top">
        <i class="icon-arrow-up"></i>
    </div>
</div>
<!-- END FOOTER -->

<script src="assets/global/plugins/bootstrap-toastr/toastr.min.js" type="text/javascript" ></script>
<script src="assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>

<!-- BEGIN THEME GLOBAL SCRIPTS -->
<script src="assets/global/scripts/app.min.js" type="text/javascript"></script>
<!-- END THEME GLOBAL SCRIPTS -->
<!-- BEGIN THEME LAYOUT SCRIPTS -->
<script src="assets/layouts/layout4/scripts/layout.min.js" type="text/javascript"></script>
<script src="assets/layouts/layout4/scripts/demo.min.js" type="text/javascript"></script>
<!-- END THEME LAYOUT SCRIPTS -->

<script src="assets/js/custom.js" type="text/javascript"></script>
<script>
/*Batch district/Subdistrict/Community ajax*/
    /*get subdistricts using district id */
    $('#name_dist').change(function () {
        var distId = $(this).val();
        getSubDistrictId(distId);
    });
   
    /*get community using district id & subdist_id */
    $('#name_subdist').change(function () {
        var distId = $('#name_dist').val();
        var subdist = $(this).val();
        getCommId(distId,subdist);
    });
    
    /*get borough using district id & subdist_id & comm_id */
    $('#name_comm').change(function () {
        var distId = $('#name_dist').val();
        var subdist = $('#name_subdist').val();
        var commid = $('#name_comm').val();
        getBoroId(distId,subdist,commid);
    });
    
    
    /*international authorities*/
    $('#name_ia').change(function () {
        var distId = $(this).val();
        $.ajax({
            url: "<?php echo app_url('ajax', "getinterone"); ?>",
            type: "post",
            dataType: "json",
            data: {
                q: distId
            },
            success: function (data) {
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
                        jQuery('#name_ia1').html(option);
                        i++;
                    });
                } else {
                    jQuery('#name_ia1').html('');
                    jQuery('#name_ia2').html('');
                }
            }
        });
    });
    
    
    $('#name_ia1').change(function () {
        var distId = $('#name_ia').val();
        var subdist = $(this).val();
        $.ajax({
            url: "<?php echo app_url('ajax', 'getia2'); ?>",
            type: "post",
            dataType: "json",
            data: {
                d_id: distId,
                s_id: subdist
            },
            success: function (data) {
                console.log(data);
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
                        jQuery('#name_ia2').html(option);
                        i++;
                    });
                } else {
                    jQuery('#name_ia2').html('');
                }
            }
        });
    });
    
    /*get subdistrict function*/
    function getSubDistrictId(distid){
    $.ajax({
            url: "<?php echo app_url('ajax', "getSubistrict"); ?>",
            type: "post",
            dataType: "json",
            data: {
                q: distid
            },
            success: function (data) {
                var option = '', selected = '', i = '';
                option += '<option value="">Please Select</option>';
                if (data.status == 'true') {
                    jQuery.each(data.record, function (key, value) {
                        if (i == 1) {
                            selected = ''
                        } else {
                            selected = '';
                        }
                        //var hashes = window.location.href.slice(window.location.href.indexOf('?') + 1).split('&');
                        //var v = hashes['3'].split("=");
                        //getSpecificsub(distid,v['1']);
                        option += '<option value=' + value.id + ' ' + selected + '>' + value.name_en + '</option>';
                        jQuery('#name_subdist').html(option);
                        jQuery('#name_comm').html('');
                        jQuery('#name_boro').html('');
                        i++;
                    });
                } else {
                    jQuery('#name_subdist').html('');
                    jQuery('#name_comm').html('');
                    jQuery('#name_boro').html('');
                }
            }
        });
        }
    
    /*get communities function*/
    function getCommId(dist_id,subdist){
       $.ajax({
            url: "<?php echo make_url('ajax', array("action" => "getCommunity")); ?>",
            type: "post",
            dataType: "json",
            data: {
                d_id: dist_id,
                s_id: subdist
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
                        jQuery('#name_comm').html(option);
                        jQuery('#name_boro').html('');
                        i++;
                    });
                } else {
                    jQuery('#name_comm').html('');
                    jQuery('#name_boro').html('');
                }
            }
        });
    }
    
    /*get borough function*/
    function getBoroId(dist_id,subdist,commid){
       $.ajax({
            url: "<?php echo app_url('ajax', "getBorough"); ?>",
            type: "post",
            dataType: "json",
            data: {
                d_id: dist_id,
                s_id: subdist,
                c_id: commid
            },
            success: function (data) {
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
    }
    

</script>
<?php if (isset($_SESSION['alert']) && count($_SESSION['alert'])) { ?>
    <script type="text/javascript">
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "positionClass": "toast-top-right",
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
        var number = document.getElementById('number');
        number.onkeydown = function (e) {
            if (!((e.keyCode > 95 && e.keyCode < 106)|| (e.keyCode > 47 && e.keyCode < 58)|| e.keyCode == 8)) {
                return false;
            }
        }
    </script>
<?php } ?>
</body>
</html>