<div class="row">
    <div class="col-sm-12">
        <!-- BEGIN SAMPLE FORM PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-red-sunglo">
                    <i class="icon-upload font-red-sunglo"></i>
                    <span class="caption-subject bold uppercase"> Upload New Email Addresses</span>
                </div>
                <div class="actions"></div>
            </div>
            <div class="portlet-body form">
                <div class="row">
                    <div class="col-sm-8">
                        <form role="form" action="" method="POST" enctype="multipart/form-data">
                            <div class="form-body">
                                <div class="form-group">
                                    <label>Upload file</label>
                                    <div class="clearfix"></div>
                                    <div class="fileinput fileinput-new" data-provides="fileinput">
                                        <div class="input-group input-large">
                                            <div class="form-control uneditable-input input-fixed input-medium" data-trigger="fileinput">
                                                <i class="fa fa-file fileinput-exists"></i>&nbsp;
                                                <span class="fileinput-filename"> </span>
                                            </div>
                                            <span class="input-group-addon btn default btn-file">
                                                <span class="fileinput-new"> Select file </span>
                                                <span class="fileinput-exists"> Change </span>
                                                <input type="file" name="file"  accept=".csv">
                                            </span>
                                            <a href="javascript:;" class="input-group-addon btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <span class="help-block">only <strong>csv</strong> files<br/>max upload size <?php echo getfilesize(MAX_UPLOAD_FILE_SIZE);?></span>
                                </div>                                
                                <div class="form-actions">
                                    <button type="submit" name="upload" class="btn blue">Upload</button>
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