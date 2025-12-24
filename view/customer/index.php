<div class="filter-bar sampewr bg-body py-7 flex w-full">
    <div class="container-custom">
        <h1 class="text-3xl font-gothic text-black text-center"><?php _e("My Account") ?></h1>
    </div>
</div>
<div class="flex flex-col py-20">
    <div class="ac-onword">
        <div class="container-custom">
            <div class="flex flex-col gap-5">
                <?php include_once (DIR_FS_VIEW_TEMPLATES . 'sidebar_navigation.php'); ?>
                <div class="panel panel-primary">
                    <div class="panel-heading flex items-center justify-between gap-2.5 mb-5">
                        <h3 class="panel-title text-3xl text-black font-gothic"><?php _e("Customers"); ?></h3>
                        <div class="relative inline-flex items-center">
                            <svg width="14" height="14" class="absolute pointer-events-none  left-4" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M6.99935 9.04167H4.37435C3.56027 9.04167 3.15323 9.04167 2.82202 9.14214C2.07628 9.36836 1.49271 9.95193 1.26649 10.6977C1.16602 11.0289 1.16602 11.4359 1.16602 12.25M11.0827 12.25V8.75M9.33268 10.5H12.8327M8.45768 4.375C8.45768 5.82475 7.28243 7 5.83268 7C4.38293 7 3.20768 5.82475 3.20768 4.375C3.20768 2.92525 4.38293 1.75 5.83268 1.75C7.28243 1.75 8.45768 2.92525 8.45768 4.375Z" stroke="white" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                            <input type="button" class="add-btn min-h-[38px] text-sm pe-4 ps-[36px] hover:bg-secondary text-white cursor-pointer rounded-md font-medium bg-primary  add_cust mar0" value="<?php _e("Add Customer"); ?>">
                        </div>
                    </div>
                    <div class="panel-body" style="display: none;">
                        <input type="text" class="form-control" id="dev-table-filter" data-action="filter" data-filters="#dev-table" placeholder="<?php _e("Filter Customer"); ?>" />
                    </div>
                    <div class="bg-body rounded-[20px] border border-[#d9d9d9] p-5">
                        <table class="table table-hover w-full table-fixed" id="dev-table">
                            <thead>
                                <tr>
                                    <th class="text-left text-black pe-4 capitalize pb-3 text-lg font-semibold">#</th>
                                    <th class="text-left text-black pe-4 capitalize pb-3 text-lg font-semibold"><?php _e("First Name"); ?></th>
                                    <th class="text-left text-black pe-4 capitalize pb-3 text-lg font-semibold"><?php _e("Last Name"); ?></th>
                                    <th class="text-left text-black pe-4 capitalize pb-3 text-lg font-semibold"><?php _e("action"); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $count = 0;
                                if (!empty($customers)) {
                                    foreach ($customers as $cust) {
                                        ?>
                                        <tr>
                                            <td class="border-b border-[#d9d9d9] py-4 text-secondary font-medium text-base pe-4"><?php echo ++$count; ?></td>
                                            <td class="border-b border-[#d9d9d9] py-4 text-secondary font-medium text-base pe-4"><?php echo $cust['first_name']; ?></td>
                                            <td class="border-b border-[#d9d9d9] py-4 text-secondary font-medium text-base pe-4"><?php echo $cust['last_name']; ?></td>
                                            <td class="border-b border-[#d9d9d9] py-4 text-secondary font-medium text-base pe-4">
                                                <span class="flex gap-2">
                                                    <span class="relative min-w-12 h-10 bg-white rounded-lg border border-[#d9d9d9] inline-flex justify-center items-center">
                                                        <svg width="20" height="20" class="pointer-events-none" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <g clip-path="url(#clip0_714_1658)">
                                                            <path d="M0.833984 10C0.833984 10 4.16732 3.33334 10.0007 3.33334C15.834 3.33334 19.1673 10 19.1673 10C19.1673 10 15.834 16.6667 10.0007 16.6667C4.16732 16.6667 0.833984 10 0.833984 10Z" stroke="#393C40" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                            <path d="M10.0007 12.5C11.3814 12.5 12.5007 11.3807 12.5007 10C12.5007 8.6193 11.3814 7.50001 10.0007 7.50001C8.61994 7.50001 7.50065 8.6193 7.50065 10C7.50065 11.3807 8.61994 12.5 10.0007 12.5Z" stroke="#393C40" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                            </g>
                                                            <defs>
                                                            <clipPath id="clip0_714_1658">
                                                            <rect width="20" height="20" fill="white"/>
                                                            </clipPath>
                                                            </defs>
                                                        </svg>
                                                        <input type="button" name="show-badge"  data-toggle="modal" data-target="#enquirypopup" id="enquiryinputbtn" data-cid ="<?php echo $cust['id']; ?>" class="badge-btn  opacity-0 cursor-pointer absolute top-0 btn-sm w-12 h-10 show_show" value="<?php _e("Ribbons"); ?>">
                                                    </span>
                                            
                                                    <span class="relative min-w-12 h-10 bg-white rounded-lg border border-[#d9d9d9] inline-flex justify-center items-center">
                                                        <svg width="20" height="20" class="pointer-events-none" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                            <g clip-path="url(#clip0_714_1751)">
                                                            <path d="M9.16602 3.33332H3.33268C2.89065 3.33332 2.46673 3.50891 2.15417 3.82147C1.84161 4.13403 1.66602 4.55796 1.66602 4.99999V16.6667C1.66602 17.1087 1.84161 17.5326 2.15417 17.8452C2.46673 18.1577 2.89065 18.3333 3.33268 18.3333H14.9993C15.4414 18.3333 15.8653 18.1577 16.1779 17.8452C16.4904 17.5326 16.666 17.1087 16.666 16.6667V10.8333M15.416 2.08332C15.7475 1.7518 16.1972 1.56555 16.666 1.56555C17.1349 1.56555 17.5845 1.7518 17.916 2.08332C18.2475 2.41484 18.4338 2.86448 18.4338 3.33332C18.4338 3.80216 18.2475 4.2518 17.916 4.58332L9.99935 12.5L6.66602 13.3333L7.49935 9.99999L15.416 2.08332Z" stroke="#393C40" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                                            </g>
                                                            <defs>
                                                            <clipPath id="clip0_714_1751">
                                                            <rect width="20" height="20" fill="white"/>
                                                            </clipPath>
                                                            </defs>
                                                        </svg>
                                                        <input type="button" name="rename_cust"  data-toggle="modal" data-target="#renamepopup_Red" onclick="RenameFunction_Red(<?php echo $cust['id']; ?>)" data-cid ="<?php echo $cust['id']; ?>" class="btn btn-info opacity-0 cursor-pointer absolute top-0 btn-sm w-12 h-10" value="<?php _e("Rename Customer"); ?>">
                                                    </span>
                                                
                                                    <a class="btn btn-info btn-sm min-w-12 h-10 bg-white rounded-lg border border-[#d9d9d9] inline-flex justify-center items-center" href="<?php echo make_url('customer', array('id' => $cust['id'])); ?>" onclick="return confirm('Are you sure you want to delete this customer?');" title="<?php _e('delete'); ?>"> <svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M13.3333 4.99999V4.33332C13.3333 3.3999 13.3333 2.93319 13.1517 2.57667C12.9919 2.26307 12.7369 2.0081 12.4233 1.84831C12.0668 1.66666 11.6001 1.66666 10.6667 1.66666H9.33333C8.39991 1.66666 7.9332 1.66666 7.57668 1.84831C7.26308 2.0081 7.00811 2.26307 6.84832 2.57667C6.66667 2.93319 6.66667 3.3999 6.66667 4.33332V4.99999M8.33333 9.58332V13.75M11.6667 9.58332V13.75M2.5 4.99999H17.5M15.8333 4.99999V14.3333C15.8333 15.7335 15.8333 16.4335 15.5608 16.9683C15.3212 17.4387 14.9387 17.8212 14.4683 18.0608C13.9335 18.3333 13.2335 18.3333 11.8333 18.3333H8.16667C6.76654 18.3333 6.06647 18.3333 5.53169 18.0608C5.06129 17.8212 4.67883 17.4387 4.43915 16.9683C4.16667 16.4335 4.16667 15.7335 4.16667 14.3333V4.99999" stroke="#393C40" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/></svg></a>
                                                </span>
                                            </td>
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
    </div>
</div>



<div id="enquirypopup" class="fixed top-0 left-0 right-0 z-[1]  pt-10 pb-5 px-5 overflow-y-auto  w-full h-full" role="dialog" style="display: none; padding-right: 15px;">
    <div class="mx-auto max-w-[600px] w-full">
        <input type="hidden" name="data-cid" id="data-cid" value="<?php echo $cust['id']; ?>"/>	
        <!-- Modal content-->
        <div class="srch-reslt slect mar-top-10">
            <div class="srch-heading bg-black relative px-5 py-3 flex justify-between items-center">
             <h4 class="text-white text-xl font-medium"><?php _e("Badges Placed"); ?></h4>
             <button type="button" class="close rounded-full bg-black text-[33px] leading-[33px] font-light text-white  w-10 h-10 relative -right-2 top-0" data-dismiss="modal">×</button>
            </div>
            <div class="bdr bg-white py-5 " >
                <div class="flag-sec">
                    <ul class="popup-react flex flex-wrap gap-y-4" id="popup-react2"></ul>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="renamepopup_Red" class="fixed top-0 left-0 right-0 z-[1]  pt-10 pb-5 px-5 overflow-y-auto  w-full h-full" role="dialog" style="display: none; padding-right: 15px;">
    <div class="mx-auto max-w-[400px] w-full">
        <input type="hidden" name="data-cid" id="data_cid" value=""/>	
        <!-- Modal content-->
        <div class="srch-reslt slect mar-top-10">
            <div class="srch-heading bg-black relative px-5 py-3 flex justify-between items-center">
               <h4 class="text-white text-xl font-medium">
                   <?php _e("Rename Customer"); ?>
               </h4>
               <button type="button" class="close rounded-full bg-black text-[33px] leading-[33px] font-light text-white  w-10 h-10 relative -right-2 top-0" data-dismiss="modal">×</button>
            </div>
            <div class="panel-body bg-white p-5">
                <form role="form" action="" id="customer_add" method="POST">
                    <div id="msg"></div>
                    <div class="form-body flex flex-col gap-4 w-full">
                        <div class="form-group flex flex-col gap-1.5">
                            <label><?php _e("Firstname"); ?><font color="red">*</font></label>
                            <input type="text"  name="firstname" id="fname" value="" class="form-control fname md:text-base text-sm fname w-full border-[#b1b1b1] px-4 md:min-h-12 min-h-10 border rounded-lg focus:outline-none" placeholder="<?php _e("Firstname"); ?>"> 
                        </div>
                        <div class="form-group flex flex-col gap-1.5">
                            <label><?php _e("Lastname"); ?><font color="red">*</font></label>
                            <input type="text"  name="lastname" id="lname" value="" class="form-control fname md:text-base text-sm fname w-full border-[#b1b1b1] px-4 md:min-h-12 min-h-10 border rounded-lg focus:outline-none" placeholder="<?php _e("Lastname"); ?>"> 
                        </div>
                        <div class="form-group">
                            <button type="submit" name="cust-submit"  class="form-control bg-primary px-5 inline-flex items-center justify-center text-white rounded-xl font-semibold text-base md:min-h-12 min-h-10 md:text-base text-sm text-white hover:bg-secondary" tabindex="4" id="cust-rename_Red"  tabindex="4" ><?php _e("Rename Customer"); ?></button>
                        </div>
                    </div>
                </form>
              
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
                    htmlData += '<li class="flex flex-col w-1/2 gap-2 px-3 pb-4 border-b border-[#d9d9d9]"><div><img src="<?php echo DIR_WS_UPLOADS; ?>batch/' + image + '" class="img-responsive max-h-24 min-h-24 object-cover object-left w-full"></div><p class="font-medium text-dark text-base ">' + ribbon + '</p></li>';
                });
                $("#popup-react2").html(htmlData);
            }
        });
    });

    function RenameFunction_Red(id) {
        $('body').addClass('active');
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

    jQuery('#enquiryinputbtn').on('click', function () {
        jQuery('body').addClass('active');
    });

    jQuery('.close').on('click', function () {
        jQuery('body').removeClass('active');
    });

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
