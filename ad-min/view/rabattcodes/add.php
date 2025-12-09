<div class="row">
    <div class="col-sm-12">
        <!-- BEGIN SAMPLE FORM PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-red-sunglo">
                    <i class="icon-user font-red-sunglo"></i>
                    <span class="caption-subject bold uppercase"> Add Rabattcode</span>
                </div>
                <div class="actions">

                </div>
            </div>
            <div class="portlet-body form">
                <div class="row">
                    <div class="col-sm-8">
                        <form role="form" action="<?php app_url('rabattcodes','add','add');?>" method="POST">
                            <div class="form-body">
                                <div class="form-group">
                                    <label>Code<font color="red">*</font></label>
                                    <input type="text" name="code" value="<?php echo isset($app['POST']['code'])?$app['POST']['code']:'';?>" class="form-control" placeholder="Code"> 
                                </div>
                                <div class="form-group">
                                    <label>Rabattsatz<font color="red">*</font></label>
                                    <input type="text" name="rabatt" value="<?php echo isset($app['POST']['rabatt'])?$app['POST']['rabatt']:'';?>" class="form-control" placeholder="Rabatt"> 
                                </div>

                                <div class="form-actions">
                                    <button type="submit" name="add" class="btn blue">Add Code</button>
                                    <a class="btn default" href="<?php app_url('rabattcodes','list','list');?>">Cancel</a>
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
