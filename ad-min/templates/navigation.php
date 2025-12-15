<!-- BEGIN CONTAINER -->
<div class="page-container">
    <!-- BEGIN SIDEBAR -->
    <div class="page-sidebar-wrapper">
        <!-- BEGIN SIDEBAR -->
        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
        <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
        <div class="page-sidebar navbar-collapse collapse">
            <!-- BEGIN SIDEBAR MENU -->
            <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
            <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
            <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
            <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
            <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
            <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
            <ul class="page-sidebar-menu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
                <li class="nav-item start <?php echo is_active_nav('dashboard',$page);?>">
                    <a href="<?php app_url('dashboard');?>" class="nav-link">
                        <i class="icon-home"></i>
                        <span class="title">Dashboard</span>
                    </a>
                </li>
            <?php if($app['admin_info']->role=='super_admin'){?>
                <li class="nav-item <?php echo is_active_nav('users',$page);?>">
                    <a href="<?php app_url('users','list','list');?>" class="nav-link nav-toggle">
                        <i class="icon-users"></i>
                        <span class="title">Admin Users</span>
                        <span class="<?php echo (is_active_nav('users',$page)!='')?"selected":"";?>"></span>
                        <span class="arrow <?php echo is_active_nav('users',$page);?>"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item <?php echo is_active_nav('users',$page,'add',$view);?>">
                            <a href="<?php app_url('users','add','add');?>" class="nav-link ">
                                <span class="title">Add Admin User</span>
                                <span class="<?php echo (is_active_nav('users',$page,'add',$view)!='')?"selected":"";?>"></span>
                            </a>
                        </li>
                        <li class="nav-item <?php echo is_active_nav('users',$page,'list',$view);?> <?php echo is_active_nav('users',$page,'edit',$view);?>">
                            <a href="<?php app_url('users','list','list');?>" class="nav-link ">
                                <span class="title">Manage Admin Users</span>
                                <span class="<?php echo (is_active_nav('users',$page,'list',$view)!='')?"selected":"";?>"></span>
                            </a>
                        </li>
                    </ul>
                </li>
                <?php } ?>
                 <li class="nav-item <?php echo is_active_nav('users_customers',$page);?>">
                    <a href="<?php app_url('users_customers','list','list');?>" class="nav-link nav-toggle">
                        <i class="fa fa-users" aria-hidden="true"></i>
                        <span class="title">Users</span>
                        <span class="<?php echo (is_active_nav('users_customers',$page)!='')?"selected":"";?>"></span>
                        <span class="arrow <?php echo is_active_nav('users_customers',$page);?>"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item <?php echo is_active_nav('users_customers',$page,'add',$view);?>">
                            <a href="<?php app_url('users_customers','add','add');?>" class="nav-link ">
                                <span class="title">Add User</span>
                                <span class="<?php echo (is_active_nav('users_customers',$page,'add',$view)!='')?"selected":"";?>"></span>
                            </a>
                        </li>
                        <li class="nav-item <?php echo is_active_nav('users_customers',$page,'list',$view);?>">
                            <a href="<?php app_url('users_customers','list','list');?>" class="nav-link ">
                                <span class="title">Manage Users</span>
                                <span class="<?php echo (is_active_nav('users_customers',$page,'list',$view)!='')?"selected":"";?>"></span>
                            </a>
                        </li>
                        <li class="nav-item <?php echo is_active_nav('users_customers',$page,'search',$view);?>">
                            <a href="<?php app_url('users_customers','search','search');?>" class="nav-link ">
                                <span class="title">Search for customer</span>
                                <span class="<?php echo (is_active_nav('users_customers',$page,'search',$view)!='')?"selected":"";?>"></span>
                            </a>
                        </li>
                    </ul>
                </li>
                 <li class="nav-item <?php echo is_active_nav('messages',$page);?>">
                    <a href="<?php app_url('messages','list','list');?>" class="nav-link nav-toggle">
                        <i class="fa fa-users" aria-hidden="true"></i>
                        <span class="title">Messages</span>
                        <span class="<?php echo (is_active_nav('messages',$page)!='')?"selected":"";?>"></span>
                        <span class="arrow <?php echo is_active_nav('messages',$page);?>"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item <?php echo is_active_nav('messages',$page,'add',$view);?>">
                            <a href="<?php app_url('messages','add','add');?>" class="nav-link ">
                                <span class="title">Add Message</span>
                                <span class="<?php echo (is_active_nav('messages',$page,'add',$view)!='')?"selected":"";?>"></span>
                            </a>
                        </li>
                        <li class="nav-item <?php echo is_active_nav('messages',$page,'list',$view);?>">
                            <a href="<?php app_url('messages','list','list');?>" class="nav-link ">
                                <span class="title">Manage Messages</span>
                                <span class="<?php echo (is_active_nav('messages',$page,'list',$view)!='')?"selected":"";?>"></span>
                            </a>
                        </li>
                    </ul>
                </li>

                    <li class="nav-item <?php echo is_active_nav('categories',$page);?>">
                    <a href="<?php app_url('categories','list','list');?>" class="nav-link nav-toggle">
                        <i class="fa fa-list" aria-hidden="true"></i>
                        <span class="title">Categories</span>
                        <span class="<?php echo (is_active_nav('categories',$page)!='')?"selected":"";?>"></span>
                        <span class="arrow <?php echo is_active_nav('categories',$page);?>"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item <?php echo is_active_nav('categories',$page,'add',$view);?>">
                            <a href="<?php app_url('categories','add','add');?>" class="nav-link ">
                                <span class="title">Add Category</span>
                                <span class="<?php echo (is_active_nav('categories',$page,'add',$view)!='')?"selected":"";?>"></span>
                            </a>
                        </li>
                        <li class="nav-item <?php echo is_active_nav('categories',$page,'list',$view);?>">
                            <a href="<?php app_url('categories','list','list');?>" class="nav-link ">
                                <span class="title">Manage Categories</span>
                                <span class="<?php echo (is_active_nav('categories',$page,'list',$view)!='')?"selected":"";?>"></span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item <?php echo is_active_nav('communities',$page);?>">
                    <a href="<?php app_url('communities','list','list');?>" class="nav-link nav-toggle">
                        <i class="fa fa-asterisk" aria-hidden="true"></i>
                        <span class="title">Communities</span>
                        <span class="<?php echo (is_active_nav('communities',$page)!='')?"selected":"";?>"></span>
                        <span class="arrow <?php echo is_active_nav('communities',$page);?>"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item <?php echo is_active_nav('communities',$page,'add',$view);?>">
                            <a href="<?php app_url('communities','add','add');?>" class="nav-link ">
                                <span class="title">Add Community</span>
                                <span class="<?php echo (is_active_nav('communities',$page,'add',$view)!='')?"selected":"";?>"></span>
                            </a>
                        </li>
                        <li class="nav-item <?php echo is_active_nav('communities',$page,'list',$view);?>">
                            <a href="<?php app_url('communities','list','list');?>" class="nav-link ">
                                <span class="title">Manage Communities</span>
                                <span class="<?php echo (is_active_nav('communities',$page,'list',$view)!='')?"selected":"";?>"></span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item <?php echo is_active_nav('boroughs',$page);?>">
                    <a href="<?php app_url('boroughs','list','list');?>" class="nav-link nav-toggle">
                        <i class="fa fa-asterisk" aria-hidden="true"></i>
                        <span class="title">Boroughs</span>
                        <span class="<?php echo (is_active_nav('boroughs',$page)!='')?"selected":"";?>"></span>
                        <span class="arrow <?php echo is_active_nav('boroughs',$page);?>"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item <?php echo is_active_nav('boroughs',$page,'add',$view);?>">
                            <a href="<?php app_url('boroughs','add','add');?>" class="nav-link ">
                                <span class="title">Add Borough</span>
                                <span class="<?php echo (is_active_nav('boroughs',$page,'add',$view)!='')?"selected":"";?>"></span>
                            </a>
                        </li>
                        <li class="nav-item <?php echo is_active_nav('boroughs',$page,'list',$view);?>">
                            <a href="<?php app_url('boroughs','list','list');?>" class="nav-link ">
                                <span class="title">Manage Boroughs</span>
                                <span class="<?php echo (is_active_nav('boroughs',$page,'list',$view)!='')?"selected":"";?>"></span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item <?php echo is_active_nav('departments',$page);?>">
                    <a href="<?php app_url('departments','list','list');?>" class="nav-link nav-toggle">
                        <i class="fa fa-asterisk" aria-hidden="true"></i>
                        <span class="title">Collections</span>
                        <span class="<?php echo (is_active_nav('departments',$page)!='')?"selected":"";?>"></span>
                        <span class="arrow <?php echo is_active_nav('departments',$page);?>"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item <?php echo is_active_nav('departments',$page,'add',$view);?>">
                            <a href="<?php app_url('departments','add','add');?>" class="nav-link ">
                                <span class="title">Add Collection</span>
                                <span class="<?php echo (is_active_nav('departments',$page,'add',$view)!='')?"selected":"";?>"></span>
                            </a>
                        </li>
                        <li class="nav-item <?php echo is_active_nav('departments',$page,'list',$view);?>">
                            <a href="<?php app_url('departments','list','list');?>" class="nav-link ">
                                <span class="title">Manage Collections</span>
                                <span class="<?php echo (is_active_nav('departments',$page,'list',$view)!='')?"selected":"";?>"></span>
                            </a>
                        </li>
                    </ul>
                </li>
                  <li class="nav-item <?php echo is_active_nav('departments_new',$page);?>">
                    <a href="<?php app_url('departments_new','list','list');?>" class="nav-link nav-toggle">
                     <i class="fa fa-industry" aria-hidden="true"></i>
                        <span class="title">Departments</span>
                        <span class="<?php echo (is_active_nav('departments_new',$page)!='')?"selected":"";?>"></span>
                        <span class="arrow <?php echo is_active_nav('departments_new',$page);?>"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item <?php echo is_active_nav('departments_new',$page,'add',$view);?>">
                            <a href="<?php app_url('departments_new','add','add');?>" class="nav-link ">
                                <span class="title">Add Department</span>
                                <span class="<?php echo (is_active_nav('departments_new',$page,'add',$view)!='')?"selected":"";?>"></span>
                            </a>
                        </li>
                        <li class="nav-item <?php echo is_active_nav('departments_new',$page,'list',$view);?>">
                            <a href="<?php app_url('departments_new','list','list');?>" class="nav-link ">
                                <span class="title">Manage Departments</span>
                                <span class="<?php echo (is_active_nav('departments_new',$page,'list',$view)!='')?"selected":"";?>"></span>
                            </a>
                        </li>
                        <li class="nav-item <?php echo is_active_nav('departments_new', $page, 'department_pos', $view); ?>">
                            <a href="<?php app_url('departments_new', 'department_pos', 'department_pos'); ?>" class="nav-link ">
                                <span class="title">Department Positions</span>
                                <span class="<?php echo (is_active_nav('departments_new', $page, 'department_pos', $view) != '') ? "selected" : ""; ?>"></span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item <?php echo is_active_nav('districts',$page);?>">
                    <a href="<?php app_url('districts','list','list');?>" class="nav-link nav-toggle">
                        <i class="fa fa-bars" aria-hidden="true"></i>
                        <span class="title">Districts</span>
                        <span class="<?php echo (is_active_nav('districts',$page)!='')?"selected":"";?>"></span>
                        <span class="arrow <?php echo is_active_nav('districts',$page);?>"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item <?php echo is_active_nav('districts',$page,'add',$view);?>">
                            <a href="<?php app_url('districts','add','add');?>" class="nav-link ">
                                <span class="title">Add District</span>
                                <span class="<?php echo (is_active_nav('districts',$page,'add',$view)!='')?"selected":"";?>"></span>
                            </a>
                        </li>
                        <li class="nav-item <?php echo is_active_nav('districts',$page,'list',$view);?>">
                            <a href="<?php app_url('districts','list','list');?>" class="nav-link ">
                                <span class="title">Manage Districts</span>
                                <span class="<?php echo (is_active_nav('districts',$page,'list',$view)!='')?"selected":"";?>"></span>
                            </a>
                        </li>
                    </ul>
                </li>
                 <li class="nav-item <?php echo is_active_nav('sub_districts',$page);?>">
                    <a href="<?php app_url('sub_districts','list','list');?>" class="nav-link nav-toggle">
                        <i class="fa fa-bars" aria-hidden="true"></i>
                        <span class="title">Sub Districts</span>
                        <span class="<?php echo (is_active_nav('sub_districts',$page)!='')?"selected":"";?>"></span>
                        <span class="arrow <?php echo is_active_nav('sub_districts',$page);?>"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item <?php echo is_active_nav('sub_districts',$page,'add',$view);?>">
                            <a href="<?php app_url('sub_districts','add','add');?>" class="nav-link ">
                                <span class="title">Add Sub Districts</span>
                                <span class="<?php echo (is_active_nav('sub_districts',$page,'add',$view)!='')?"selected":"";?>"></span>
                            </a>
                        </li>
                        <li class="nav-item <?php echo is_active_nav('sub_districts',$page,'list',$view);?>">
                            <a href="<?php app_url('sub_districts','list','list');?>" class="nav-link ">
                                <span class="title">Manage Sub Districts</span>
                                <span class="<?php echo (is_active_nav('sub_districts',$page,'list',$view)!='')?"selected":"";?>"></span>
                            </a>
                        </li>
                    </ul>
                </li>
                
                <li class="nav-item <?php echo is_active_nav('international-authorities',$page);?>">
                    <a href="<?php app_url('international-authorities','list','list');?>" class="nav-link nav-toggle">
                        <i class="fa fa-bars" aria-hidden="true"></i>
                        <span class="title" style="font-size: 13px;">International Authorities</span>
                        <span class="<?php echo (is_active_nav('international-authorities',$page)!='')?"selected":"";?>"></span>
                        <span class="arrow <?php echo is_active_nav('international-authorities',$page);?>"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item <?php echo is_active_nav('international-authorities',$page,'add',$view);?>">
                            <a href="<?php app_url('international-authorities','add','add');?>" class="nav-link ">
                                <span class="title">Add International Authorities</span>
                                <span class="<?php echo (is_active_nav('international-authorities',$page,'add',$view)!='')?"selected":"";?>"></span>
                            </a>
                        </li>
                        <li class="nav-item <?php echo is_active_nav('international-authorities',$page,'list',$view);?>">
                            <a href="<?php app_url('international-authorities','list','list');?>" class="nav-link ">
                                <span class="title">Manage International Authorities</span>
                                <span class="<?php echo (is_active_nav('international-authorities',$page,'list',$view)!='')?"selected":"";?>"></span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item <?php echo is_active_nav('international-authorities-sublevel1',$page);?>">
                    <a href="<?php app_url('international-authorities-sublevel1','list','list');?>" class="nav-link nav-toggle">
                        <i class="fa fa-bars" aria-hidden="true"></i>
                        <span class="title" style="font-size: 13px;">International Authorities Sublevel1</span>
                        <span class="<?php echo (is_active_nav('international-authorities-sublevel1',$page)!='')?"selected":"";?>"></span>
                        <span class="arrow <?php echo is_active_nav('international-authorities-sublevel1',$page);?>"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item <?php echo is_active_nav('international-authorities-sublevel1',$page,'add',$view);?>">
                            <a href="<?php app_url('international-authorities-sublevel1','add','add');?>" class="nav-link ">
                                <span class="title">Add International Authorities Sublevel1</span>
                                <span class="<?php echo (is_active_nav('international-authorities-sublevel1',$page,'add',$view)!='')?"selected":"";?>"></span>
                            </a>
                        </li>
                        <li class="nav-item <?php echo is_active_nav('international-authorities-sublevel1',$page,'list',$view);?>">
                            <a href="<?php app_url('international-authorities-sublevel1','list','list');?>" class="nav-link ">
                                <span class="title">Manage International Authorities Sublevel1</span>
                                <span class="<?php echo (is_active_nav('international-authorities-sublevel1',$page,'list',$view)!='')?"selected":"";?>"></span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item <?php echo is_active_nav('international-authorities-sublevel2',$page);?>">
                    <a href="<?php app_url('international-authorities-sublevel2','list','list');?>" class="nav-link nav-toggle">
                        <i class="fa fa-bars" aria-hidden="true"></i>
                        <span class="title" style="font-size: 13px;">International Authorities Sublevel2</span>
                        <span class="<?php echo (is_active_nav('international-authorities-sublevel2',$page)!='')?"selected":"";?>"></span>
                        <span class="arrow <?php echo is_active_nav('international-authorities-sublevel2',$page);?>"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item <?php echo is_active_nav('international-authorities-sublevel2',$page,'add',$view);?>">
                            <a href="<?php app_url('international-authorities-sublevel2','add','add');?>" class="nav-link ">
                                <span class="title">Add International Authorities Sublevel2</span>
                                <span class="<?php echo (is_active_nav('international-authorities-sublevel2',$page,'add',$view)!='')?"selected":"";?>"></span>
                            </a>
                        </li>
                        <li class="nav-item <?php echo is_active_nav('international-authorities-sublevel2',$page,'list',$view);?>">
                            <a href="<?php app_url('international-authorities-sublevel2','list','list');?>" class="nav-link ">
                                <span class="title">Manage International Authorities Sublevel2</span>
                                <span class="<?php echo (is_active_nav('international-authorities-sublevel2',$page,'list',$view)!='')?"selected":"";?>"></span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item <?php echo is_active_nav('organizations',$page);?>">
                    <a href="<?php app_url('organizations','list','list');?>" class="nav-link nav-toggle">
                        <i class="fa fa-sitemap" aria-hidden="true"></i>
                        <span class="title">Organizations</span>
                        <span class="<?php echo (is_active_nav('organizations',$page)!='')?"selected":"";?>"></span>
                        <span class="arrow <?php echo is_active_nav('organizations',$page);?>"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item <?php echo is_active_nav('organizations',$page,'add',$view);?>">
                            <a href="<?php app_url('organizations','add','add');?>" class="nav-link ">
                                <span class="title">Add Organization</span>
                                <span class="<?php echo (is_active_nav('organizations',$page,'add',$view)!='')?"selected":"";?>"></span>
                            </a>
                        </li>
                        <li class="nav-item <?php echo is_active_nav('organizations',$page,'list',$view);?>">
                            <a href="<?php app_url('organizations','list','list');?>" class="nav-link ">
                                <span class="title">Manage Organizations</span>
                                <span class="<?php echo (is_active_nav('organizations',$page,'list',$view)!='')?"selected":"";?>"></span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item <?php echo is_active_nav('additional_categories',$page);?>">
                    <a href="<?php app_url('additional_categories','list','list');?>" class="nav-link nav-toggle">
                        <i class="fa fa-list" aria-hidden="true"></i>
                        <span class="title">Additional Categories</span>
                        <span class="<?php echo (is_active_nav('additional_categories',$page)!='')?"selected":"";?>"></span>
                        <span class="arrow <?php echo is_active_nav('additional_categories',$page);?>"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item <?php echo is_active_nav('additional_categories',$page,'add',$view);?>">
                            <a href="<?php app_url('additional_categories','add','add');?>" class="nav-link ">
                                <span class="title">Add Additional Category</span>
                                <span class="<?php echo (is_active_nav('additional_categories',$page,'add',$view)!='')?"selected":"";?>"></span>
                            </a>
                        </li>
                        <li class="nav-item <?php echo is_active_nav('additional_categories',$page,'list',$view);?>">
                            <a href="<?php app_url('additional_categories','list','list');?>" class="nav-link ">
                                <span class="title">Manage Additional Categories</span>
                                <span class="<?php echo (is_active_nav('additional_categories',$page,'list',$view)!='')?"selected":"";?>"></span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item <?php echo is_active_nav('add_cat_sub',$page);?>">
                    <a href="<?php app_url('add_cat_sub','list','list');?>" class="nav-link nav-toggle">
                        <i class="fa fa-sitemap" aria-hidden="true"></i>
                        <span class="title">Additional Category Sub</span>
                        <span class="<?php echo (is_active_nav('add_cat_sub',$page)!='')?"selected":"";?>"></span>
                        <span class="arrow <?php echo is_active_nav('add_cat_sub',$page);?>"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item <?php echo is_active_nav('add_cat_sub',$page,'add',$view);?>">
                            <a href="<?php app_url('add_cat_sub','add','add');?>" class="nav-link ">
                                <span class="title">Add Additional Category Sub</span>
                                <span class="<?php echo (is_active_nav('add_cat_sub',$page,'add',$view)!='')?"selected":"";?>"></span>
                            </a>
                        </li>
                        <li class="nav-item <?php echo is_active_nav('add_cat_sub',$page,'list',$view);?>">
                            <a href="<?php app_url('add_cat_sub','list','list');?>" class="nav-link ">
                                <span class="title">Manage Additional Category Sub</span>
                                <span class="<?php echo (is_active_nav('add_cat_sub',$page,'list',$view)!='')?"selected":"";?>"></span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item <?php echo is_active_nav('batches',$page);?>">
                    <a href="<?php app_url('batches','list','list');?>" class="nav-link nav-toggle">
                        <i class="fa fa-certificate" aria-hidden="true"></i>
                        <span class="title">Batches</span>
                        <span class="<?php echo (is_active_nav('batches',$page)!='')?"selected":"";?>"></span>
                        <span class="arrow <?php echo is_active_nav('batches',$page);?>"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item <?php echo is_active_nav('batches',$page,'add',$view);?>">
                            <a href="<?php app_url('batches','add','add');?>" class="nav-link ">
                                <span class="title">Add Batch</span>
                                <span class="<?php echo (is_active_nav('batches',$page,'add',$view)!='')?"selected":"";?>"></span>
                            </a>
                        </li>
                        <li class="nav-item <?php echo is_active_nav('batches',$page,'list',$view);?>">
                            <a href="<?php app_url('batches','list','list');?>" class="nav-link ">
                                <span class="title">Manage Batches</span>
                                <span class="<?php echo (is_active_nav('batches',$page,'list',$view)!='')?"selected":"";?>"></span>
                            </a>
                        </li>
                        <li class="nav-item <?php echo is_active_nav('batches',$page,'batch_image',$view);?>">
                            <a href="<?php app_url('batches','batch_image','batch_image');?>" class="nav-link ">
                                <span class="title">Batch Image</span>
                                <span class="<?php echo (is_active_nav('batches',$page,'batch_image',$view)!='')?"selected":"";?>"></span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item <?php echo is_active_nav('miscitems',$page);?>">
                    <a href="<?php app_url('miscitems','list','list');?>" class="nav-link nav-toggle">
                        <i class="fa fa-certificate" aria-hidden="true"></i>
                        <span class="title">Misc items</span>
                        <span class="<?php echo (is_active_nav('miscitems',$page)!='')?"selected":"";?>"></span>
                        <span class="arrow <?php echo is_active_nav('miscitems',$page);?>"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item <?php echo is_active_nav('miscitems',$page,'add',$view);?>">
                            <a href="<?php app_url('miscitems','add','add');?>" class="nav-link ">
                                <span class="title">Add Misc item</span>
                                <span class="<?php echo (is_active_nav('miscitems',$page,'add',$view)!='')?"selected":"";?>"></span>
                            </a>
                        </li>
                        <li class="nav-item <?php echo is_active_nav('miscitems',$page,'list',$view);?>">
                            <a href="<?php app_url('miscitems','list','list');?>" class="nav-link ">
                                <span class="title">Manage Misc items</span>
                                <span class="<?php echo (is_active_nav('miscitems',$page,'list',$view)!='')?"selected":"";?>"></span>
                            </a>
                        </li>
                            </ul>
                </li>

              <li class="nav-item <?php echo is_active_nav('miniatures',$page);?>">
                    <a href="<?php app_url('miniatures','list','list');?>" class="nav-link nav-toggle">
                        <i class="fa fa-certificate" aria-hidden="true"></i>
                        <span class="title">Miniatures</span>
                        <span class="<?php echo (is_active_nav('miniatures',$page)!='')?"selected":"";?>"></span>
                        <span class="arrow <?php echo is_active_nav('miniatures',$page);?>"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item <?php echo is_active_nav('miniatures',$page,'add',$view);?>">
                            <a href="<?php app_url('miniatures','add','add');?>" class="nav-link ">
                                <span class="title">Add Miniature</span>
                                <span class="<?php echo (is_active_nav('miniatures',$page,'add',$view)!='')?"selected":"";?>"></span>
                            </a>
                        </li>
                        <li class="nav-item <?php echo is_active_nav('miniatures',$page,'list',$view);?>">
                            <a href="<?php app_url('miniatures','list','list');?>" class="nav-link ">
                                <span class="title">Manage Miniatures</span>
                                <span class="<?php echo (is_active_nav('miniatures',$page,'list',$view)!='')?"selected":"";?>"></span>
                            </a>
                        </li>
                        <li class="nav-item <?php echo is_active_nav('miniatures',$page,'stats',$stats);?>">
                            <a href="<?php app_url('miniatures','stats','stats');?>" class="nav-link ">
                                <span class="title">Stats</span>
                                <span class="<?php echo (is_active_nav('miniatures',$page,'stats',$stats)!='')?"selected":"";?>"></span>
                            </a>
                        </li>
                    </ul>
                </li>


                  <li class="nav-item <?php echo is_active_nav('ribbon_location',$page);?>">
                    <a href="<?php app_url('ribbon_location','list','list');?>" class="nav-link nav-toggle">
                        <i class="fa fa-bars" aria-hidden="true"></i>
                        <span class="title">Ribbon Location</span>
                        <span class="<?php echo (is_active_nav('ribbon_location',$page)!='')?"selected":"";?>"></span>
                        <span class="arrow <?php echo is_active_nav('ribbon_location',$page);?>"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item <?php echo is_active_nav('ribbon_location',$page,'add',$view);?>">
                            <a href="<?php app_url('ribbon_location','add','add');?>" class="nav-link ">
                                <span class="title">Add Ribbon Location</span>
                                <span class="<?php echo (is_active_nav('ribbon_location',$page,'add',$view)!='')?"selected":"";?>"></span>
                            </a>
                        </li>
                        <li class="nav-item <?php echo is_active_nav('ribbon_location',$page,'list',$view);?>">
                            <a href="<?php app_url('ribbon_location','list','list');?>" class="nav-link ">
                                <span class="title">Manage Ribbon Location</span>
                                <span class="<?php echo (is_active_nav('ribbon_location',$page,'list',$view)!='')?"selected":"";?>"></span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item <?php echo is_active_nav('orders',$page);?>">
                    <a href="<?php app_url('orders','list','list');?>" class="nav-link nav-toggle">
                        <i class="fa fa-cart-arrow-down" aria-hidden="true"></i>
                        <span class="title">Orders</span>
                        <span class="<?php echo (is_active_nav('orders',$page)!='')?"selected":"";?>"></span>
                        <span class="arrow <?php echo is_active_nav('orders',$page);?>"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item <?php echo is_active_nav('orders',$page,'list',$view,'list',$action);?>">
                            <a href="<?php app_url('orders','list','list');?>" class="nav-link ">
                                <span class="title">View orders</span>
                                <span class="<?php echo (is_active_nav('orders',$page,'list',$view,'list',$action)!='')?"selected":"";?>"></span>
                            </a>
                        </li>
                        <li class="nav-item <?php echo is_active_nav('orders',$page,'list',$view,'listdebug',$action);?>">
                            <a href="<?php app_url('orders','listdebug','list');?>" class="nav-link ">
                                <span class="title">View orders (debug)</span>
                                <span class="<?php echo (is_active_nav('orders',$page,'list',$view,'listdebug',$action)!='')?"selected":"";?>"></span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item <?php echo is_active_nav('paymentconditions',$page) || is_active_nav('deliveryconditions',$page);?>">
                    <a href="<?php app_url('conditions','list','list');?>" class="nav-link nav-toggle">
                        <i class="fa fa-cart-arrow-down" aria-hidden="true"></i>
                        <span class="title">Conditions</span>
                        <span class="<?php echo ( is_active_nav('paymentconditions',$page) || is_active_nav('deliveryconditions',$page)!='')?"selected":"";?>"></span>
                        <span class="arrow <?php echo  is_active_nav('paymentconditions',$page) || is_active_nav('deliveryconditions',$page);?>"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item <?php echo is_active_nav('deliveryconditions',$page,'add',$view);?>">
                            <a href="<?php app_url('deliveryconditions','add','add');?>" class="nav-link ">
                                <span class="title">Add Delivery condition</span>
                                <span class="<?php echo (is_active_nav('deliveryconditions',$page,'add',$view)!='')?"selected":"";?>"></span>
                            </a>
                        </li>
                        <li class="nav-item <?php echo is_active_nav('deliveryconditions',$page,'list',$view,'list',$action);?>">
                            <a href="<?php app_url('deliveryconditions','list','list');?>" class="nav-link ">
                                <span class="title">View delivery conditions</span>
                                <span class="<?php echo (is_active_nav('deliveryconditions',$page,'list',$view,'list',$action)!='')?"selected":"";?>"></span>
                            </a>
                        </li>
                        <li class="nav-item <?php echo is_active_nav('paymentconditions',$page,'add',$view);?>">
                            <a href="<?php app_url('paymentconditions','add','add');?>" class="nav-link ">
                                <span class="title">Add payment condition</span>
                                <span class="<?php echo (is_active_nav('paymentconditions',$page,'add',$view)!='')?"selected":"";?>"></span>
                            </a>
                        </li>
                        <li class="nav-item <?php echo is_active_nav('paymentconditions',$page,'list',$view,'listdebug',$action);?>">
                            <a href="<?php app_url('paymentconditions','list','list');?>" class="nav-link ">
                                <span class="title">View payment conditions</span>
                                <span class="<?php echo (is_active_nav('list',$page,'list',$view,'listdebug',$action)!='')?"selected":"";?>"></span>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item <?php echo is_active_nav('statistics',$page,'list',$view,'list',$action);?>">
                   <a href="<?php app_url('statistics', 'list', 'list');?>" class="nav-link nav-toggle">
                        <i class="fa fa-cart-arrow-down" aria-hidden="true"></i>
                        <span class="title">Statistics</span>
                        <span class="<?php echo (is_active_nav('statistics',$page)!='')?"selected":"";?>"></span>
                        <span class="arrow <?php echo is_active_nav('orders',$page);?>"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item <?php echo is_active_nav('statistics',$page,'list',$view,'list',$action);?>">
                    		<a href="<?php app_url('statistics', 'list', 'list');?>" class="nav-link nav-toggle">
                                	<span class="title">View statistics - total</span>
                                	<span class="<?php echo (is_active_nav('statistics',$page,'list',$view,'list',$action)!='')?"selected":"";?>"></span>
                            	</a>
                        </li>
                        <li class="nav-item <?php echo is_active_nav('statistics',$page,'list',$view,'list_standard',$action);?>">
                    		<a href="<?php app_url('statistics', 'list_standard', 'list');?>" class="nav-link nav-toggle">
                                	<span class="title">View statistics - Standardgeschaeft</span>
                                	<span class="<?php echo (is_active_nav('statistics',$page,'list',$view,'list_standard',$action)!='')?"selected":"";?>"></span>
                            	</a>
                        </li>
                        <li class="nav-item <?php echo is_active_nav('statistics',$page,'list',$view,'list_sonder',$action);?>">
                    		<a href="<?php app_url('statistics', 'list_sonder', 'list');?>" class="nav-link nav-toggle">
                                	<span class="title">View statistics - Sonderproduktion</span>
                                	<span class="<?php echo (is_active_nav('statistics',$page,'list',$view,'list_sonder',$action)!='')?"selected":"";?>"></span>
                            	</a>
                        </li>
      			<li class="nav-item <?php echo is_active_nav('statistics_monthly',$page,'list',$view,'list',$action);?>">
                    		<a href="<?php app_url('statistics_monthly', 'list', 'list');?>" class="nav-link nav-toggle">
                                <span class="title">View statistics (Monthly)</span>
                                <span class="<?php echo (is_active_nav('statistics_monthly',$page,'list',$view,'list',$action)!='')?"selected":"";?>"></span>
                            	</a>
                        </li>
                        <li class="nav-item <?php echo is_active_nav('statisticstoproduce',$page,'list',$view,'list',$action);?>">
                    		<a href="<?php app_url('statisticstoproduce', 'list', 'list');?>" class="nav-link nav-toggle">
                                <span class="title">View items to produce </span>
                                <span class="<?php echo (is_active_nav('statisticstoproduce',$page,'list',$view,'list',$action)!='')?"selected":"";?>"></span>
                            </a>
                        </li>



                    </ul>
                </li>


            
                <li class="nav-item <?php echo is_active_nav('rabattcodes',$page);?>">
                    <a href="<?php app_url('rabattcodes','list','list');?>" class="nav-link nav-toggle">
                        <i class="icon-users"></i>
                        <span class="title">Rabattcodes</span>
                        <span class="<?php echo (is_active_nav('rabattcodes',$page)!='')?"selected":"";?>"></span>
                        <span class="arrow <?php echo is_active_nav('rabattcodes',$page);?>"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item <?php echo is_active_nav('rabattcodes',$page,'add',$view);?>">
                            <a href="<?php app_url('rabattcodes','add','add');?>" class="nav-link ">
                                <span class="title">Add Rabattcode</span>
                                <span class="<?php echo (is_active_nav('rabattcodes',$page,'add',$view)!='')?"selected":"";?>"></span>
                            </a>
                        </li>
                        <li class="nav-item <?php echo is_active_nav('rabattcodes',$page,'list',$view);?> <?php echo is_active_nav('rabattcodes',$page,'edit',$view);?>">
                            <a href="<?php app_url('rabattcodes','list','list');?>" class="nav-link ">
                                <span class="title">Manage Rabattcodes</span>
                                <span class="<?php echo (is_active_nav('rabattcodes',$page,'list',$view)!='')?"selected":"";?>"></span>
                            </a>
                        </li>
                    </ul>
                </li>
               


                <li class="nav-item start <?php echo is_active_nav('setting',$page);?>">
                    <a href="<?php echo app_url('setting', '', '', array('sname'=>'general')); ?>" class="nav-link">
                        <i class="icon-settings"></i>
                        <span class="title">Settings</span>
                    </a>
                </li>
                <li class="nav-item  end <?php echo is_active_nav('profile',$page);?>">
                    <a href="<?php app_url('profile','manage','manage');?>" class="nav-link nav-toggle">
                        <i class="icon-user"></i>
                        <span class="title">Account Management</span>
                        <span class="<?php echo (is_active_nav('profile',$page)!='')?"selected":"";?>"></span>
                        <span class="arrow <?php echo is_active_nav('profile',$page);?>"></span>
                    </a>
                    <ul class="sub-menu">
                        <li class="nav-item  <?php echo is_active_nav('profile',$page,'manage',$view);?>">
                            <a href="<?php app_url('profile','manage','manage');?>" class="nav-link">
                                <span class="title">Manage Account</span>
                                <span class="<?php echo (is_active_nav('profile',$page,'manage',$view)!='')?"selected":"";?>"></span>
                            </a>
                        </li>
                        <li class="nav-item  <?php echo is_active_nav('profile',$page,'change_password',$view);?>">
                            <a href="<?php app_url('profile','change_password','change_password');?>" class="nav-link ">
                                <span class="title">Change Password</span>
                                <span class="<?php echo (is_active_nav('profile',$page,'change_password',$view)!='')?"selected":"";?>"></span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- END SIDEBAR MENU -->
        </div>
        <!-- END SIDEBAR -->
    </div>
    <!-- END SIDEBAR -->
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <!-- BEGIN CONTENT BODY -->
        <div class="page-content">
