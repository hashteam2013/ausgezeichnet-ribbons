<div class="row">
    <div class="col-sm-12">
        <!-- BEGIN SAMPLE FORM PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-red-sunglo">
                    <i class="icon-upload font-red-sunglo"></i>
                    <span class="caption-subject bold uppercase"> Preferences > <?php echo ucwords(str_replace('_', ' ', $sname)); ?> Settings</span>
                </div>
                <div class="actions"></div>
            </div>
            <div class="portlet-body form">
                <div class="sidebar-content tabbable tabs-left">
                    <ul class="nav nav-tabs" id="product_tabs">
                        <li class="<?php echo ($sname == 'general') ? "active" : ""; ?>">
                            <a href="<?php echo app_url('setting', '', '', array('sname' => 'general')); ?>">
                                <i class="icon-briefcase"></i> General
                            </a>
                            <?php echo ($sname == 'general') ? '<span class="after"></span>' : ""; ?>
                        </li>
                        <li class="<?php echo ($sname == 'email') ? "active" : ""; ?>">
                            <a href="<?php echo app_url('setting', '', '', array('sname' => 'email')); ?>">
                                <i class="icon-envelope"></i> Email
                            </a>
                            <?php echo ($sname == 'email') ? '<span class="after"></span>' : ""; ?>
                        </li>
<!--                        <li class="<?php echo ($sname == 'SMTP') ? "active" : ""; ?>">
                            <a href="<?php echo app_url('setting', '', '', array('sname' => 'SMTP')); ?>">
                                <i class="icon-target"></i> SMTP
                            </a>
                            <?php echo ($sname == 'SMTP') ? '<span class="after"></span>' : ""; ?>
                        </li>
                        <li class="<?php echo ($sname == 'seo') ? "active" : ""; ?>">
                            <a href="<?php echo app_url('setting', '', '', array('sname' => 'seo')); ?>">
                                <i class="icon-feed"></i> SEO
                            </a>
                            <?php echo ($sname == 'seo') ? '<span class="after"></span>' : ""; ?>
                        </li>-->
                        <li class="<?php echo ($sname == 'meta') ? "active" : ""; ?>">
                            <a href="<?php echo app_url('setting', '', '', array('sname' => 'meta')); ?>">
                                <i class="icon-layers"></i> Meta Information
                            </a>
                            <?php echo ($sname == 'meta') ? '<span class="after"></span>' : ""; ?>
                        </li>
                        <li class="<?php echo ($sname == 'security') ? "active" : ""; ?>">
                            <a href="<?php echo app_url('setting', '', '', array('sname' => 'security')); ?>">
                                <i class="icon-lock"></i> Security
                            </a>
                            <?php echo ($sname == 'security') ? '<span class="after"></span>' : ""; ?>
                        </li>
                        <li class="<?php echo ($sname == 'address') ? "active" : ""; ?>">
                            <a href="<?php echo app_url('setting', '', '', array('sname' => 'address')); ?>">
                                <i class="icon-pin"></i> Store Address
                            </a>
                            <?php echo ($sname == 'address') ? '<span class="after"></span>' : ""; ?>
                        </li>
                        <li class="<?php echo ($sname == 'social') ? "active" : ""; ?>">
                           <a href="<?php echo app_url('setting', '', '', array('sname' => 'social')); ?>">
                               <i  class="fa fa-share-square" ></i> Social Links
                           </a>
                           <?php echo ($sname == 'social') ? '<span class="after"></span>' : ""; ?>
                       </li>

                    </ul>	
                </div>
                <form class="form-horizontal" action="<?php echo app_url('setting', 'update', 'list'); ?>" method="POST" enctype="multipart/form-data" id="validation">
                    <?php foreach ($ob as $kk => $vv): ?>
                        <div class="form-group <?php echo $vv['key']; ?>">
                            <label class="control-label col-md-3"><?php echo get_setting_name($vv['title']); ?>:</label>
                            <div class="controls col-md-7">
                                <?php echo get_setting_control($vv['id'], $vv['type'], $vv['value'], $vv['options']); ?>
                                <span class="clearfix"></span>
                                <span class="help-block settings_help">
                                    <?php echo $vv['hint']; ?>
                                </span>
                            </div>
                        </div>
                    <?php endforeach; ?>   
                    <div class="form-actions fluid">
                        <div class="offset2">
                            <input  type="hidden" name="sname1" value="<?php echo $sname ?>"/>
                            <input  type="hidden" name="setting_type" value="<?php echo $setting_type ?>"/>
                            <button class="btn green" type="submit" name="Submit" value="Submit"><i class="icon-edit"></i> Save</button> 
                            <a href="<?php echo app_url('setting', 'list', 'list'); ?>" class="btn" name="cancel"> Cancel</a>
                        </div>
                    </div>
                </form>                        
            </div>
        </div>
        <!-- END SAMPLE FORM PORTLET-->
    </div>
</div>