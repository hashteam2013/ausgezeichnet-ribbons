<div class="row">
    <div class="col-sm-12">
        <!-- BEGIN SAMPLE FORM PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="row">
                    <div class="col-md-6">
                        <div class="caption font-red-sunglo">
                            <i class="icon-users font-red-sunglo"></i>
                            <span class="caption-subject bold uppercase"> Manage Departments</span>
                        </div>
                    </div>
                    <div class="col-md-6">
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
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <?php //pr($positions);  ?>
            <div class="portlet-body">
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table">
                            <tr>
                                <th>Sr no.</th> 
                                <th>Name (English)</th> 
                                <th>Name (German)</th> 
                                <th>Position</th> 
                                <th>Allowed Ribbons</th>
		  <th>integrity level</th>
                                <th>Active</th> 
                                <th>Selectable</th>
                                <th>Class</th>
                                <th>Actions</th> 
                            </tr>
                            <?php
                            $count = ($page_no != 1) ? (($page_no - 1) * 10 + 1) : $page_no;
                            foreach ($departments as $department) {
                                ?>
                                <tr>
                                    <td><?php echo $count++; ?></td>
                                    <td><?php echo $department->name_en; ?></td>
                                    <td><?php echo $department->name_dr; ?></td>
                                    <?php if (!empty($positions)) { ?>
                                        <td><?php echo ($positions[$department->id]) ? $positions[$department->id] : '0' ?></td>
                                    <?php } else { ?>
                                        <td><?php echo $department->position; ?></td>
                                    <?php } ?>
                                    <td><?php echo $department->max_ribbon; ?></td>
                                    <td><?php echo $department->serious_level; ?></td>
                                    <td><?php
                                        if ($department->is_active == '1') {
                                            echo 'Active';
                                        } else {
                                            echo 'Not Active';
                                        }
                                        ?></td>
                                    <td><?php
                                        if ($department->is_selected == '1') {
                                            echo 'Selectable';
                                        } else {
                                            echo 'Not Selectable';
                                        }
                                        ?></td>
                                    <td><?php
                                        if ($department->is_allowed == '1') {
                                            echo 'High';
                                        } else {
                                            echo 'Low';
                                        }
                                        ?></td>
                                    <td>
                                        <a class="btn btn-info btn-sm" href="<?php echo app_url('departments_new', 'edit', 'edit', array('id' => $department->id)); ?>" title="Edit Department"><i class="fa fa-pencil"></i> Edit</a>&nbsp;&nbsp;
                                        <a class="btn btn-danger btn-sm" href="<?php echo app_url('departments_new', 'delete_department', 'list', array('del' => $department->id)); ?>" onclick="return confirm('Are you sure you want to delete this category?');" title="Delete Department"><i class="fa fa-trash"></i> Delete</a>&nbsp;&nbsp;
                                        <?php //if ($category->is_active=='1'){  ?>
    <!--                                    <a class="btn btn-warning btn-sm" href="//<?php //echo app_url('users','suspend_user','list',array('suspend'=>$category->id));       ?>" title="Suspend User"><i class="fa fa-thumbs-down"></i> Suspend</a>-->
                                        <?php //} else {  ?>
    <!--                                    <a class="btn btn-success btn-sm" href="//<?php //echo app_url('users','unsuspend_user','list',array('unsuspend'=>$category->id));       ?>" title="Unsuspend User"><i class="fa fa-thumbs-up"></i> Unsuspend</a>-->
                                        <?php //} ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- END SAMPLE FORM PORTLET-->
    </div>
</div>
<div align="center">
    <ul class='pagination text-center' id="pagination">
        <?php
        echo $pagination;
        ?>
    </ul>
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