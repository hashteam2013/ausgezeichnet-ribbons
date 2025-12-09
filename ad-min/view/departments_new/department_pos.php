<div class="row">
    <div class="col-sm-12">
        <!-- BEGIN SAMPLE FORM PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-red-sunglo">
                    <i class="icon-user font-red-sunglo"></i>
                    <span class="caption-subject bold uppercase"> Manage Department Positions</span>
                </div>
                <div class="actions"></div>
            </div>
            <div class="portlet-body form">
                <div class="row">
                    <div class="col-sm-6">
                        <form role="form" action="<?php app_url('departments_new', 'department_pos', 'department_pos'); ?>" method="POST" enctype="multipart/form-data">
                            <?php
                            $image_name = array();
                            ?>
                            <div class="form-body">
                                <div class="form-group">
                                    <label>Choose Main Department</label>
                                    <select name="main_depart" id="main_depart" class='form-control'>
                                        <option value=""><?php _e('Select Department'); ?></option>
                                        <?php
                                        foreach ($departmentslist as $dis) {
                                            if (in_array($id, $dis)) {
                                                ?>
                                                <option value="<?php echo $dis['id']; ?>" <?php echo ($dis['id'] == $id) ? 'selected' : '' ?>><?php echo $dis['name_en']; ?></option>
                                            <?php } else { ?>
                                                <option value="<?php echo $dis['id']; ?>"><?php echo $dis['name_en']; ?></option>
                                            <?php }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="depart_poss"></div>
                                <div id="show_batch" style="display:<?php echo ($id == "0") ? "none" : "block"; ?>">
                                    <?php
                                    //pr($positions);
                                    foreach ($departmentsexcID as $deprt) {
                                        ?>
                                        <div class="pos_depart"><?php echo $deprt['name_en']; ?></div>
                                        <div class="form-group" id='inner_pos'>
                                            <?php if (!empty($positions)) { ?>
                                                <input type="number" name="pos_no[<?php echo $deprt['id']; ?>]" value="<?php echo ($positions[$deprt['id']]) ? $positions[$deprt['id']] : ''; ?>">
                                        <?php } else { ?>
                                                <input type="number" name="pos_no[<?php echo $deprt['id']; ?>]" value="">
                                        <?php } ?>
                                        </div>
                                        <?php } ?>
                                    <div class="form-actions">
                                        <button type="submit" name="add_pos" id="add_image" class="btn blue">Manage Department Positions</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- END SAMPLE FORM PORTLET-->
    </div>
</div>
<script>
    $(document.body).on('change', "#main_depart", function (e) {
        var depart_id = $("#main_depart option:selected").val();
        var pageURL = $(location).attr("href");
        if (window.location.href.indexOf("&id") > -1) {
            window.location.href = pageURL.split("&id")[0] + '&id=' + depart_id;
        } else {
            window.location.href = pageURL + '&id=' + depart_id;
        }
    });
</script>

