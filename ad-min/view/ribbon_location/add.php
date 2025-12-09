<div class="row">
    <div class="col-sm-12">
        <!-- BEGIN SAMPLE FORM PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-red-sunglo">
                    <i class="icon-user font-red-sunglo"></i>
                    <span class="caption-subject bold uppercase"> Add Ribbon Location</span>
                </div>
                <div class="actions">

                </div>
            </div>
            <div class="portlet-body form">
                <div class="row">
                    <div class="col-sm-8">
                        <form role="form" action="<?php app_url('ribbon_location','add','add');?>" method="POST">
                            <div class="form-body">
                                <div class="form-group">
                                    <label>Name<font color="red">*</font></label>
                                    <input type="text" name="name" value="<?php echo isset($app['POST']['name'])?$app['POST']['name']:'';?>" class="form-control" placeholder="Ribbon Location"> 
                                </div>
                                <div class="form-group">
                                    <label>Set ID</label><br/>
                                    <input type="number" name='SetID' value="<?php echo isset($app['POST']['SetID'])?$app['POST']['SetID']:$ribbon_location->SetID;?>" min="0" id="number" > 
                                </div>
                                <div class="form-group">
                                    <label>Position<font color="red">*</font></label><br/>
                                    <input type="number" name='position' value="<?php echo isset($app['POST']['position'])?$app['POST']['position']:'';?>" min="0" id="number" > 
                                </div> 
                                <div class="form-actions">
                                    <button type="submit" name="add" class="btn blue">Add Location</button>
                                    <a class="btn default" href="<?php app_url('ribbon_location','list','list');?>">Cancel</a>
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

