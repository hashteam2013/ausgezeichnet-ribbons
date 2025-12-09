<div class="row">
    <div class="col-sm-12">
        <!-- BEGIN SAMPLE FORM PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-red-sunglo">
                    <i class="icon-user font-red-sunglo"></i>
                    <span class="caption-subject bold uppercase"> Add Batch Images</span>
                </div>
                <div class="actions"></div>
            </div>
            <div class="portlet-body form">
                <div class="row">
                    <div class="col-sm-6">
                        <form role="form" action="<?php app_url('batches', 'batch_image', 'batch_image'); ?>" method="POST" enctype="multipart/form-data">
                            <?php
                            $image_name = array();
                            ?>
                            <div class="form-body">
                                <div class="form-group">
                                    <label>Number Batches</label><br/>
                                    <select name="num_batches" id="b_number" class='form-control'>
                                        <option value=""><?php _e('Select Number batches'); ?></option>
                                        <?php foreach ($get_batches as $dis) { ?>
                                            <option value="<?php echo $dis['id']; ?>"><?php echo $dis['ribbon_name_en']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div id="show_batch" style="display:<?php echo ($id=="0")?"none":"block";?>">
                                    <div class="number_pos">Number 1</div>
                                    <div class="form-group" id='inner_pos'>
                                        <label id="1">Upload Image</label>
                                        <input type="file" name="image_name[1]" value="<?php echo isset($_FILES['upload_image1']['name']) ? $_FILES['upload_image1']['name'] : ''; ?>" >
                                    </div>
                                    <div class="number_pos">Number 2</div>
                                    <div class="form-group" id='inner_pos'>
                                        <label id="2">Upload Image</label>
                                        <input type="file"  name="image_name[2]" value="<?php echo isset($_FILES['upload_image2']['name']) ? $_FILES['upload_image2']['name'] : ''; ?>">
                                    </div>
                                    <div class="number_pos">Number 3</div>
                                    <div class="form-group" id='inner_pos'>
                                        <label id="3">Upload Image</label>
                                        <input type="file"  name="image_name[3]" value="<?php echo isset($_FILES['upload_image3']['name']) ? $_FILES['upload_image3']['name'] : ''; ?>">
                                    </div>
                                    <div class="number_pos">Number 4</div>
                                    <div class="form-group" id='inner_pos'>
                                        <label id="4">Upload Image</label>
                                        <input type="file"  name ="image_name[4]" value="<?php echo isset($_FILES['upload_image4']['name']) ? $_FILES['upload_image4']['name'] : ''; ?>">
                                    </div>
                                    <div class="number_pos">Number 5</div>
                                    <div class="form-group" id='inner_pos'>
                                        <label id="5">Upload Image</label>
                                        <input type="file"  name="image_name[5]" value="<?php echo isset($_FILES['upload_image5']['name']) ? $_FILES['upload_image5']['name'] : ''; ?>">
                                    </div>
                                    <div class="number_pos">Number 6</div>
                                    <div class="form-group" id='inner_pos'>
                                        <label id="6">Upload Image</label>
                                        <input type="file"  name="image_name[6]" value="<?php echo isset($_FILES['upload_image6']['name']) ? $_FILES['upload_image6']['name'] : ''; ?>">
                                    </div>
                                    <div class="number_pos">Number 7</div>
                                    <div class="form-group" id='inner_pos'>
                                        <label id="7">Upload Image</label>
                                        <input type="file"  name="image_name[7]" value="<?php echo isset($_FILES['upload_image7']['name']) ? $_FILES['upload_image7']['name'] : ''; ?>">
                                    </div>
                                    <div class="number_pos">Number 8</div>
                                    <div class="form-group" id='inner_pos'>
                                        <label id="8">Upload Image</label>
                                        <input type="file"  name="image_name[8]" value="<?php echo isset($_FILES['upload_image8']['name']) ? $_FILES['upload_image8']['name'] : ''; ?>">
                                    </div>
                                    <div class="number_pos">Number 9</div>
                                    <div class="form-group" id='inner_pos'>
                                        <label id="9">Upload Image</label>
                                        <input type="file"  name="image_name[9]" value="<?php echo isset($_FILES['upload_image9']['name']) ? $_FILES['upload_image9']['name'] : ''; ?>">
                                    </div>
                                    <div class="number_pos">Number 10</div>
                                    <div class="form-group" id='inner_pos'>
                                        <label id="10">Upload Image</label>
                                        <input type="file"  name="image_name[10]" value="<?php echo isset($_FILES['upload_image10']['name']) ? $_FILES['upload_image10']['name'] : ''; ?>">
                                    </div>
                                    <div class="number_pos">Number 11</div>
                                    <div class="form-group" id='inner_pos'>
                                        <label id="11">Upload Image</label>
                                        <input type="file"  name="image_name[11]" value="<?php echo isset($_FILES['upload_image11']['name']) ? $_FILES['upload_image11']['name'] : ''; ?>">
                                    </div>
                                    <div class="number_pos">Number 12</div>
                                    <div class="form-group" id='inner_pos'>
                                        <label id="12">Upload Image</label>
                                        <input type="file"  name="image_name[12]" value="<?php echo isset($_FILES['upload_image12']['name']) ? $_FILES['upload_image12']['name'] : ''; ?>">
                                    </div>
                                    <div class="number_pos">Number 13</div>
                                    <div class="form-group" id='inner_pos'>
                                        <label id="13">Upload Image</label>
                                        <input type="file"  name="image_name[13]" value="<?php echo isset($_FILES['upload_image13']['name']) ? $_FILES['upload_image13']['name'] : ''; ?>">
                                    </div>
                                    <div class="number_pos">Number 14</div>
                                    <div class="form-group" id='inner_pos'>
                                        <label id="14">Upload Image</label>
                                        <input type="file"  name="image_name[14]" value="<?php echo isset($_FILES['upload_image14']['name']) ? $_FILES['upload_image14']['name'] : ''; ?>">
                                    </div>
                                    <div class="number_pos">Number 15</div>
                                    <div class="form-group" id='inner_pos'>
                                        <label id="15">Upload Image</label>
                                        <input type="file"  name="image_name[15]" value="<?php echo isset($_FILES['upload_image15']['name']) ? $_FILES['upload_image15']['name'] : ''; ?>">
                                    </div>
                                    <div class="number_pos">Number 16</div>
                                    <div class="form-group" id='inner_pos'>
                                        <label id="16">Upload Image</label>
                                        <input type="file"  name="image_name[16]" value="<?php echo isset($_FILES['upload_image16']['name']) ? $_FILES['upload_image16']['name'] : ''; ?>">
                                    </div>
                                    <div class="number_pos">Number 17</div>
                                    <div class="form-group" id='inner_pos'>
                                        <label id="17">Upload Image</label>
                                        <input type="file"  name="image_name[17]" value="<?php echo isset($_FILES['upload_image17']['name']) ? $_FILES['upload_image17']['name'] : ''; ?>">
                                    </div>
                                    <div class="number_pos">Number 18</div>
                                    <div class="form-group" id='inner_pos'>
                                        <label id="18">Upload Image</label>
                                        <input type="file"  name="image_name[18]" value="<?php echo isset($_FILES['upload_image18']['name']) ? $_FILES['upload_image18']['name'] : ''; ?>">
                                    </div>
                                    <div class="number_pos">Number 19</div>
                                    <div class="form-group" id='inner_pos'>
                                        <label id="19">Upload Image</label>
                                        <input type="file"  name="image_name[19]" value="<?php echo isset($_FILES['upload_image19']['name']) ? $_FILES['upload_image19']['name'] : ''; ?>">
                                    </div>
                                    <div class="number_pos">Number 20</div>
                                    <div class="form-group" id='inner_pos'>
                                        <label id="20">Upload Image</label>
                                        <input type="file"  name="image_name[20]" value="<?php echo isset($_FILES['upload_image20']['name']) ? $_FILES['upload_image20']['name'] : ''; ?>">
                                    </div>

                                    <div class="form-actions">
                                        <button type="submit" name="add_image" id="add_image" class="btn blue">Add Batch Images</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col-sm-6">
                        <form role="form" action="<?php app_url('batches', 'batch_image', 'batch_image'); ?>" method="POST" enctype="multipart/form-data">
                            <div class="form-body">
                                <div class="form-group">
                                    <label>Location Batches</label><br/>
                                    <select name="loc_batches" id="l_number" class='form-control'>
                                        <option value=""><?php _e('Select Location batches'); ?></option>
                                        <?php foreach ($get_loc_batch as $loc) { ?>
                                            <option value="<?php echo $loc['id']; ?>"><?php echo $loc['ribbon_name_en']; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                                <div class='showing_loc' style='display:<?php echo ($id_loc=="0")?"none":"block";?>'>
                                    <?php foreach ($get_location as $location) { ?>
                                        <div class="location_pos"><?php echo $location['name']; ?></div>
                                        <div class="form-group location_class" id='inner_loc'>
                                            <label id='location_<?php echo $location['id']; ?>'>Upload Image</label>
                                            <input type="file" name="image_loc[<?php echo $location['id']; ?>]" value="<?php echo isset($_FILES['upload_image']['name']) ? $_FILES['upload_image']['name'] : ''; ?>" name="upload_image">
                                        </div>
                                    <?php } ?>
                                    <div class="form-actions">
                                        <button type="submit" name="add_location_image" class="btn blue">Add Batch Images</button>
                                    </div>
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

<script>
    /*----------------------------------------ajax for number batch showing---------------------------------------------------------------------------*/
    <?php if($id!="0"){?>
    $(document).ready(function () {
        $('#b_number').val('<?php echo $id;?>').trigger('change');
    });
    <?php } ?>

    $(document.body).on('change', "#b_number", function (e) {
        $('.numBatch').html('');
        $("#show_batch").css('display', 'block');
        var batch_id = $("#b_number option:selected").val();
        $.ajax({
            url: "<?php echo app_url('ajax', 'show_image_number'); ?>",
            type: "post",
            dataType: "json",
            data: {
                'batch_id': batch_id,
            },
            success: function (data) {
                $(data.batch_one).each(function (i, e) {
                    if (e.number == 1) {
                        $('#1').html("<div class='numBatch'><img src=<?php echo DIR_WS_UPLOADS; ?>batch/" + e.batch_image + " class='img-responsive'></div>");
                    } else if (e.number == 2) {
                        $('#2').html("<div class='numBatch'><img src=<?php echo DIR_WS_UPLOADS; ?>batch/" + e.batch_image + " class='img-responsive'></div>");
                    } else if (e.number == 3) {
                        $('#3').html("<div class='numBatch'><img src=<?php echo DIR_WS_UPLOADS; ?>batch/" + e.batch_image + " class='img-responsive'></div>");
                    } else if (e.number == 4) {
                        $('#4').html("<div class='numBatch'><img src=<?php echo DIR_WS_UPLOADS; ?>batch/" + e.batch_image + " class='img-responsive'></div>");
                    } else if (e.number == 5) {
                        $('#5').html("<div class='numBatch'><img src=<?php echo DIR_WS_UPLOADS; ?>batch/" + e.batch_image + " class='img-responsive'></div>");
                    } else if (e.number == 6) {
                        $('#6').html("<div class='numBatch'><img src=<?php echo DIR_WS_UPLOADS; ?>batch/" + e.batch_image + " class='img-responsive'></div>");
                    } else if (e.number == 7) {
                        $('#7').html("<div class='numBatch'><img src=<?php echo DIR_WS_UPLOADS; ?>batch/" + e.batch_image + " class='img-responsive'></div>");
                    } else if (e.number == 8) {
                        $('#8').html("<div class='numBatch'><img src=<?php echo DIR_WS_UPLOADS; ?>batch/" + e.batch_image + " class='img-responsive'></div>");
                    } else if (e.number == 9) {
                        $('#9').html("<div class='numBatch'><img src=<?php echo DIR_WS_UPLOADS; ?>batch/" + e.batch_image + " class='img-responsive'></div>");
                    } else if (e.number == 10) {
                        $('#10').html("<div class='numBatch'><img src=<?php echo DIR_WS_UPLOADS; ?>batch/" + e.batch_image + " class='img-responsive'></div>");
                    } else if (e.number == 11) {
                        $('#11').html("<div class='numBatch'><img src=<?php echo DIR_WS_UPLOADS; ?>batch/" + e.batch_image + " class='img-responsive'></div>");
                    } else if (e.number == 12) {
                        $('#12').html("<div class='numBatch'><img src=<?php echo DIR_WS_UPLOADS; ?>batch/" + e.batch_image + " class='img-responsive'></div>");
                    } else if (e.number == 13) {
                        $('#13').html("<div class='numBatch'><img src=<?php echo DIR_WS_UPLOADS; ?>batch/" + e.batch_image + " class='img-responsive'></div>");
                    } else if (e.number == 14) {
                        $('#14').html("<div class='numBatch'><img src=<?php echo DIR_WS_UPLOADS; ?>batch/" + e.batch_image + " class='img-responsive'></div>");
                    } else if (e.number == 15) {
                        $('#15').html("<div class='numBatch'><img src=<?php echo DIR_WS_UPLOADS; ?>batch/" + e.batch_image + " class='img-responsive'></div>");
                    } else if (e.number == 16) {
                        $('#16').html("<div class='numBatch'><img src=<?php echo DIR_WS_UPLOADS; ?>batch/" + e.batch_image + " class='img-responsive'></div>");
                    } else if (e.number == 17) {
                        $('#17').html("<div class='numBatch'><img src=<?php echo DIR_WS_UPLOADS; ?>batch/" + e.batch_image + " class='img-responsive'></div>");
                    } else if (e.number == 18) {
                        $('#18').html("<div class='numBatch'><img src=<?php echo DIR_WS_UPLOADS; ?>batch/" + e.batch_image + " class='img-responsive'></div>");
                    } else if (e.number == 19) {
                        $('#19').html("<div class='numBatch'><img src=<?php echo DIR_WS_UPLOADS; ?>batch/" + e.batch_image + " class='img-responsive'></div>");
                    } else if (e.number == 20) {
                        $('#20').html("<div class='numBatch'><img src=<?php echo DIR_WS_UPLOADS; ?>batch/" + e.batch_image + " class='img-responsive'></div>");
                    }
                });
            }
        });
    });

    <?php if($id_loc!="0"){?>
    $(document).ready(function () {
        $('#l_number').val('<?php echo $id_loc;?>').trigger('change');
    });
    <?php } ?>

    $(document.body).on('change', "#l_number", function (e) {
        $(".showing_loc").css('display', 'block');
        var batch_id = $("#l_number option:selected").val();
        $.ajax({
            url: "<?php echo app_url('ajax', 'show_image_location'); ?>",
            type: "post",
            dataType: "json",
            data: {
                'batch_id': batch_id,
            },
            success: function (data) {
                $('.locBatch').html("");
                $(data).each(function (k, v) {
                    $('#location_' + v.location_id).html("<div class='locBatch'><img src=<?php echo DIR_WS_UPLOADS; ?>batch/" + v.batch_image + " class='img-responsive'></div>");
                });
            }
        });
    });
</script>