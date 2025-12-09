<div class="tiles pull-right">

        <div class="tile bg-yellow <?php echo (isset($setting_type) && $setting_type=='general')?'selected':''?>">
            <a href="<?php echo make_admin_url('setting', 'list', 'list','sname=general'.'&setting_type=general');?>">
                <div class="corner"></div>

                <div class="tile-body">
                        <i class="icon-cogs"></i>
                </div>
                <div class="tile-object">
                        <div class="name">
                                General Settings
                        </div>
                </div>
            </a>   
        </div>
        <div class="tile bg-blue <?php echo (isset($setting_type) && $setting_type=='email')?'selected':''?>">
            <a href="<?php echo make_admin_url('setting', 'list', 'list','sname=email'.'&setting_type=email');?>">
                <div class="corner"></div>

                <div class="tile-body">
                        <i class="icon-envelope-alt"></i>
                </div>
                <div class="tile-object">
                        <div class="name">
                                Email Settings
                        </div>
                </div>
            </a> 
        </div>
        <div class="tile bg-red <?php echo ($Page=='change_password')?'selected':''?>">
            <a href="<?php echo make_admin_url('change_password', 'list', 'list');?>">
                <div class="corner"></div>
                <div class="tile-body">
                        <i class="icon-lock"></i>
                </div>
                <div class="tile-object">
                        <div class="name">
                                Security Settings
                        </div>
                </div>
            </a> 
        </div>
</div>