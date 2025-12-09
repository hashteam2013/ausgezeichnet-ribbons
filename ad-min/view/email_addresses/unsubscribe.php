<div class="row">
    <div class="col-sm-12">
        <!-- BEGIN SAMPLE FORM PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-red-sunglo">
                    <i class="icon-logout font-red-sunglo"></i>
                    <span class="caption-subject bold uppercase"> Unsubscribe an Email Address</span>
                </div>
                <div class="actions">

                </div>
            </div>
            <div class="portlet-body form">
                <div class="row">
                    <div class="col-sm-8">
                        <form role="form" action="" method="POST">
                            <div class="form-body">
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="text" name="email" value="<?php echo isset($app['POST']['email'])?$app['POST']['email']:"";?>" class="form-control" placeholder="Email Address"> 
                                </div>  
                                <div class="form-group">
                                    <label>Reason for unsubscribe</label>
                                    <select name="reason" id="reason" class="form-control">
                                        <option value="">Select reason for unsubscribe</option>
                                        <option value="1" <?php echo (isset($app['POST']['reason']) && $app['POST']['reason']=='1')?"selected":"";?>>Reason 1</option>
                                        <option value="2" <?php echo (isset($app['POST']['reason']) && $app['POST']['reason']=='2')?"selected":"";?>>Reason 2</option>
                                        <option value="3" <?php echo (isset($app['POST']['reason']) && $app['POST']['reason']=='3')?"selected":"";?>>Reason 3</option>
                                        <option value="other" <?php echo (isset($app['POST']['reason']) && $app['POST']['reason']=='other')?"selected":"";?>>Other</option>
                                    </select>
                                </div>  
                                <div class="form-group" id="reason_other" style="display: none;">
                                    <label>Reason Other</label>
                                    <textarea name="reason_other" class="form-control" placeholder="Enter reason for unsubscribe"><?php echo isset($app['POST']['reason_other'])?$app['POST']['reason_other']:"";?></textarea>
                                </div>  
                                <div class="form-actions">
                                    <button type="submit" name="update" class="btn blue">Unsubscribe</button>
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
<script type="text/javascript">
    $(document).ready(function(){
        $("#reason").on('change',function(){
            if($(this).val()=='other'){
                $('#reason_other').show();
            } else{
                $('#reason_other').hide();
            }
        });
        if($("#reason").val()=='other'){
            $('#reason_other').show();
        } else{
            $('#reason_other').hide();
        }
    });
</script>