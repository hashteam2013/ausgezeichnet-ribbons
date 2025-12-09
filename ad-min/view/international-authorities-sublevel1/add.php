<div class="row">
    <div class="col-sm-12">
        <!-- BEGIN SAMPLE FORM PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-red-sunglo">
                    <i class="icon-user font-red-sunglo"></i>
                    <span class="caption-subject bold uppercase"> Add International Authorities Sublevel1</span>
                </div>
                <div class="actions"></div>
            </div>
            <div class="portlet-body form">
                <div class="row">
                    <div class="col-sm-8">
                        <form role="form" action="<?php app_url('international-authorities-sublevel1','add','add');?>" method="POST">
                            <div class="form-body">
                                <div class="form-group">
                                    <label>Choose International Authority</label><br/>
                                    <select name="name_ia" id="name_dist" class='form-control'>
                                        <option value=""><?php _e('Select International Authority'); ?></option>
                                        <?php foreach ($get_ia as $dis) { ?>
                                            <option value="<?php echo $dis['id']; ?>"><?php echo $dis['name_en']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Name (English)<font color="red">*</font></label>
                                    <input type="text" name="nameen" value="<?php echo isset($app['POST']['nameen'])?$app['POST']['nameen']:'';?>" class="form-control" placeholder="Name English"> 
                                </div>
                                <div class="form-group">
                                    <label>Name (German)<font color="red">*</font></label>
                                    <input type="text" name="namedr" value="<?php echo isset($app['POST']['namedr'])?$app['POST']['namedr']:'';?>" class="form-control" placeholder="Name German"> 
                                </div>
                                <div class="form-group">
                                    <label>Position<font color="red">*</font></label><br/>
                                    <input type="number" name='position' value=" <?php echo isset($app['POST']['position'])?$app['POST']['position']:'';?>"  min="0" id="number" > 
                                </div> 
                                <div class="row">
                                <div class="col-sm-4">
                                   <div class="form-group">
                                    <label>Active</label>
                                    <input type="checkbox" name='active'  value="1"> 
                                </div>
                                </div>
<!--                                <div class="col-sm-4">
                                 <div class="form-group">
                                    <label>Delete</label>
                                    <input type="checkbox" name='delete' value="1"> 
                                </div>
                                </div>-->
                                </div>
                                <div class="form-actions">
                                    <button type="submit" name="add" class="btn blue">Add International Authorities Sublevel1</button>
                                    <a class="btn default" href="<?php app_url('international-authorities-sublevel1','list','list');?>">Cancel</a>
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
