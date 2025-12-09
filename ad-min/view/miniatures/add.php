<div class="row">
    <div class="col-sm-12">
        <!-- BEGIN SAMPLE FORM PORTLET-->
        <div class="portlet light bordered partation">
            <div class="portlet-title">
                <div class="caption font-red-sunglo">
                    <i class="icon-user font-red-sunglo"></i>
                    <span class="caption-subject bold uppercase"> Add Miniature</span>
                </div>
                <div class="actions"></div>
            </div>
            <div class="portlet-body form">
                <div class="row">
                    <form role="form" action="<?php app_url('miniatures','add','add');?>" method="POST" enctype="multipart/form-data">
                    <div class="col-sm-8">
                            <div class="form-body">
                                <div class="form-group">
                                    <label>Miniature Name</label>
                                    <input type="text" name="name" value="<?php echo isset($app['POST']['name'])?$app['POST']['name']:'';?>" class="form-control" placeholder="Miniature Name"> 
                                </div>

                                <div class="form-actions">
                                    <button type="submit" name="add" class="btn blue">Add Miniature</button>
                                    <a class="btn default" href="<?php app_url('miniatures','list','list');?>">Cancel</a>
                                 </div>
                            </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- END SAMPLE FORM PORTLET-->
    </div>
</div>

<script>
$(document).ready(function() {   
    $('input[type=checkbox]').click(function () {
    $(this).parent().parent().parent().prev().find("input").prop('checked', true);
    var sibs = false;
    $(this).closest('ul').children('li').each(function () {
        if($('input[type=checkbox]', this).is(':checked'))
            sibs=true;
    })
    if(sibs == false){
     $(this).parent().parent().parent().prev().find("input").prop('checked', false);
    }
    var checked = false;
    if($(this).is(':checked')){ checked=true};
    $(this).parent().parent().children('ul').children('li').each(function () {
         $(this).find("input").prop('checked', checked)
    })
    $(this).parents('ul').prev().prop('checked', sibs);
   });
});


</script>
