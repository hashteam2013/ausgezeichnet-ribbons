<div class="row">
    <div class="col-sm-12">
        <!-- BEGIN SAMPLE FORM PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-red-sunglo">
                    <i class="icon-user font-red-sunglo"></i>
                    <span class="caption-subject bold uppercase"> Edit Miniature</span>
                </div>
                <div class="actions"></div>
            </div>
            <div class="portlet-body form">
                <div class="row">
                    <div class="col-sm-8">
                        <form role="form" action="<?php app_url('miniatures','edit','edit',array('id'=>$app['GET']['id']));?>" method="POST">
                            <div class="form-body">
                                 <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" value="<?php echo isset($app['POST']['name'])?$app['POST']['name']:$miniatures->name;?>" class="form-control" placeholder="Name"> 
                                 </div>
                                 <div class="form-group">
                                    <label>Pieces ordered</label>
                                    <input type="number" name="pieces_ordered" value="<?php echo isset($app['POST']['pieces_ordered'])?$app['POST']['pieces_in_stock']:$miniatures->pieces_ordered;?>" class="form-control" placeholder="0"> 
                                 </div>
                                 <div class="form-group">
                                    <label>Pieces lost</label>
                                    <input type="number" name="pieces_lost" value="<?php echo isset($app['POST']['pieces_lost'])?$app['POST']['pieces_lost']:$miniatures->pieces_lost;?>" class="form-control" placeholder="0"> 
                                 </div>
                                <div class="form-actions">
                                    <button type="submit" name="update" class="btn blue">Update Miniature</button>
                                    <a class="btn default" href="<?php app_url('miniatures','list','list');?>">Cancel</a>
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
