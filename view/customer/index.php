<div class="filter-bar sampewr">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1><?php _e("My Account") ?></h1>
            </div>
        </div>
    </div>
</div>
<div class="container ac-onword">
    <div class="row">
        <div class="col-sm-12">
            <input type="button" class="add-btn hvr-float-shadow add_cust mar0" value="<?php _e("Add Customer"); ?>">
        </div>
    </div>
</div>

<div class="container ac-onword">
    <div class="row">
        <div class="col-sm-4">
            <?php include_once (DIR_FS_VIEW_TEMPLATES . 'sidebar_navigation.php'); ?>
        </div>
        <div class="col-sm-8">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title"><?php _e("Customers"); ?></h3>
                    <div class="pull-right"></div>
                </div>
                <div class="panel-body" style="display: none;">
                    <input type="text" class="form-control" id="dev-table-filter" data-action="filter" data-filters="#dev-table" placeholder="<?php _e("Filter Customer"); ?>" />
                </div>
                <table class="table table-hover" id="dev-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th><?php _e("First Name"); ?></th>
                            <th><?php _e("Last Name"); ?></th>
                            <th><?php _e("Badges"); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $count = 0;
                        if (!empty($customers)) {
                            foreach ($customers as $cust) {
                                ?>
                                <tr>
                                    <td><?php echo ++$count; ?></td>
                                    <td><?php echo $cust['first_name']; ?></td>
                                    <td><?php echo $cust['last_name']; ?></td>
                                    <td>
                                        <input type="button" name="show-badge"  data-toggle="modal" data-target="#enquirypopup" data-cid ="<?php echo $cust['id']; ?>" class="badge-btn hvr-float-shadow show_show" value="<?php _e("Ribbons"); ?>"></td>
                                    <td><input type="button" name="rename_cust"  data-toggle="modal" data-target="#renamepopup_Red" onclick="RenameFunction_Red(<?php echo $cust['id']; ?>)" data-cid ="<?php echo $cust['id']; ?>" class="btn btn-info btn-sm" value="<?php _e("Rename Customer"); ?>"></td>
                                    <td><a class="btn btn-info btn-sm" href="<?php echo make_url('customer', array('id' => $cust['id'])); ?>" onclick="return confirm('Are you sure you want to delete this customer?');" title="<?php _e('delete'); ?>"><?php _e('Delete Customer'); ?> <i class="fa fa-trash-o"></i> </a>&nbsp;&nbsp;</td>
                                </tr>
                            <?php
                            }
                        } else {
                            ?>
                            <tr><td colspan="4"><?php _e("No customer added yet"); ?></td></tr>
<?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



<div id="enquirypopup" class="modal fade in" role="dialog" style="display: none; padding-right: 15px;">
    <div class="modal-dialog">
        <input type="hidden" name="data-cid" id="data-cid" value="<?php echo $cust['id']; ?>"/>	
        <!-- Modal content-->
        <div class="srch-reslt slect mar-top-10">
            <div class="srch-heading">
<?php _e("Badges Placed"); ?><button type="button" class="close" data-dismiss="modal">×</button>
            </div>
            <div class="bdr" >
                <div class="flag-sec">
                    <ul class="popup-react" id="popup-react2"></ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="renamepopup_Red" class="modal fade in" role="dialog" style="display: none; padding-right: 15px;">
    <div class="modal-dialog">
        <input type="hidden" name="data-cid" id="data_cid" value=""/>	
        <!-- Modal content-->
        <div class="srch-reslt slect mar-top-10">
            <div class="srch-heading">
<?php _e("Rename Customer"); ?><button type="button" class="close" data-dismiss="modal">×</button>
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
                                            <label><?php _e("Firstname"); ?><font color="red">*</font></label>
                                            <input type="text"  name="firstname" id="fname" value="" class="form-control fname" placeholder="<?php _e("Firstname"); ?>"> 
                                        </div>
                                    </div>
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label><?php _e("Lastname"); ?><font color="red">*</font></label>
                                            <input type="text"  name="lastname" id="lname" value="" class="form-control fname" placeholder="<?php _e("Lastname"); ?>"> 
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-sm-offset-3">
                                    <button type="submit" name="cust-submit"  class="form-control hvr-float-shadow " tabindex="4" id="cust-rename_Red"  tabindex="4" ><?php _e("Rename Customer"); ?></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    jQuery(document.body).on('click', ".show_show", function (e) {
        var id = $(this).data('cid');
        $.ajax({
            type: 'POST',
            url: '<?php echo make_url('ajax', array("action" => "cust_batch")); ?>',
            data: {
                'id': id
            },
            dataType: 'JSON',
            success: function (response) {
                var htmlData = '';
                $(response).each(function (index, value) {
                    var ribbon = value.batchname;
                    var image = value.batch_image
                    htmlData += '<li><div><img src="<?php echo DIR_WS_UPLOADS; ?>batch/' + image + '" class="img-responsive"></div><p>' + ribbon + '</p></li>';
                });
                $("#popup-react2").html(htmlData);
            }
        });
    });

    function RenameFunction_Red(id) {
        var cid = $('#renamepopup_Red #data_cid').val(id);
        $.ajax({
            type: 'POST',
            url: '<?php echo make_url('ajax', array("action" => "cust_detail_reduced")); ?>',
            data: {
                'id': id
            },
            dataType: 'JSON',
            success: function (response) {
                $("#fname").val(response.first_name);
                $("#lname").val(response.last_name);
            }
        });
    }

    jQuery(document.body).on('click', "#cust-rename_Red", function (e) {
        e.preventDefault();
        var id = $('#renamepopup_Red #data_cid').val();
        var fname = $("#fname").val();
        var lname = $("#lname").val();
        $.ajax({
            type: 'POST',
            url: '<?php echo make_url('ajax', array("action" => "rename_cust")); ?>',
            data: {
                'id': id,
                'fname': fname,
                'lname': lname
            },
            dataType: 'JSON',
            success: function (response) {
                if (response.status == "Sucessfully") {
                    toastr.success(response.msg);
                    $("#renamepopup_Red").hide();
                    window.setTimeout(function () {
                        location.reload()
                    }, 500)
                } else {
                    toastr['error'](response.msg);

                }
            }
        });
    });

</script>
