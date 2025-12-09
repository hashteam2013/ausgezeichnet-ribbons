<div class="row">
    <div class="col-sm-12">
        <!-- BEGIN SAMPLE FORM PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-red-sunglo">
                    <i class="icon-users font-red-sunglo"></i>
                    <span class="caption-subject bold uppercase"> Manage Rabattcodes</span>
                </div>
                <div class="actions">

                </div>
            </div>
            <div class="portlet-body">
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table">
                            <tr>
                                <th>Code</th> 
                                <th>Rabatt</th> 
                            </tr>
                            <?php foreach($rabattcodes as $rabattcode){ ?>
                            <tr>
                                <td><?php echo $rabattcode->code;?></td>
                                <td><?php echo $rabattcode->rabatt;?></td>
                                <td>
                                    <a class="btn btn-info btn-sm" href="<?php echo app_url('rabattcodes','edit','edit',array('id'=>$rabattcode->id));?>" title="Edit Code"><i class="fa fa-pencil"></i> Edit</a>&nbsp;&nbsp;
                                    <a class="btn btn-danger btn-sm" href="<?php echo app_url('rabattcodes','delete_code','list',array('del'=>$rabattcode->id));?>" onclick="return confirm('Are you sure you want to delete this code?');" title="Delete rabattcode"><i class="fa fa-trash"></i> Delete</a>&nbsp;&nbsp;
                                    <?php if ($rabattcode->is_active=='1'){ ?>
                                    <a class="btn btn-warning btn-sm" href="<?php echo app_url('rabattcodes','suspend_code','list',array('suspend'=>$rabattcode->id));?>" title="Suspend rabattcode"><i class="fa fa-thumbs-down"></i> Suspend</a>
                                    <?php } else { ?>
                                    <a class="btn btn-success btn-sm" href="<?php echo app_url('rabattcodes','unsuspend_code','list',array('unsuspend'=>$rabattcode->id));?>" title="Unsuspend rabattcode"><i class="fa fa-thumbs-up"></i> Unsuspend</a>
                                    <?php } ?>
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