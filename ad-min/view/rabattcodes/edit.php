<div class="row">
    <div class="col-sm-12">
        <!-- BEGIN SAMPLE FORM PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-red-sunglo">
                    <i class="icon-user font-red-sunglo"></i>
                    <span class="caption-subject bold uppercase"> Edit Code</span>
                </div>
                <div class="actions">

                </div>
            </div>
            <div class="portlet-body form">
                <div class="row">
                    <div class="col-sm-8">
                        <form role="form" action="<?php app_url('rabattcodes','edit','edit',array('id'=>$app['GET']['id']));?>" method="POST">
                            <div class="form-body">
                                <div class="form-group">
                                    <label>Code</label>
                                    <input type="text" name="code" value="<?php echo isset($app['POST']['code'])?$app['POST']['code']:$rabattcode->code;?>" class="form-control" placeholder="Code"> 
                                </div>
                                <div class="form-group">
                                    <label>Rabatt</label>
                                    <input type="text" name="rabatt" value="<?php echo isset($app['POST']['rabatt'])?$app['POST']['rabatt']:$rabattcode->rabatt;?>" class="form-control" placeholder="Rabatt"> 
                                </div>
  
                                <div class="form-actions">
                                    <button type="submit" name="update" class="btn blue">Update Code Info</button>
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
