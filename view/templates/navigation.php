
<nav class="navbar navbar-default navbar-outer">
            <div class="container-fluid"> 
                <!-- Brand and toggle get grouped for better mobile display -->
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false"> <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                </div>

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                    <ul class="nav navbar-nav main-nav-bar">
                        <?php
                        if ($page!='home') {
                            ?>
                            <li><a href="<?php echo make_url("home"); ?>index.php"><?php _e('Home');?></a></li>
                            <li><a href="<?php echo make_url("home"); ?>#welcome"><?php _e('Welcome');?></a></li>
                            <li><a href="<?php echo make_url("shop"); ?>"><?php _e('Shop');?></a></li>
                            <li><a href="<?php echo make_url("home"); ?>#about-us"><?php _e('About Us');?></a></li>
                            <li><a href="<?php echo make_url("home"); ?>#contact"><?php _e('Contact');?></a></li>
                        <?php } else { ?>
                            <li class="active"><a href="<?php echo make_url("home"); ?>index.php"><?php _e('Home');?><span class="sr-only">(current)</span></a></li>
                            <li><a class="myrefclass" href="#welcome"><?php _e('Welcome');?></a></li>
                            <li><a class="myrefclass" href="<?php echo make_url("shop"); ?>"><?php _e('Shop');?></a></li>
                            <li><a class="myrefclass" href="#about-us" ><?php _e('About Us');?></a></li>
                            <li><a class="myrefclass" href="#contact"><?php _e('Contact');?></a></li>
                        <?php } ?>
                    </ul>
                </div>
                <!-- /.navbar-collapse --> 
            </div>
            <!-- /.container-fluid --> 
        </nav>
        <!-- Navbar end --> 
