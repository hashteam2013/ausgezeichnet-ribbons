<div class="row">
    <div class="col-sm-12">
        <!-- BEGIN SAMPLE FORM PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-red-sunglo">
                    <i class="icon-users font-red-sunglo"></i>
                    <span class="caption-subject bold uppercase"> Manage Admin Users</span>
                </div>
                <div class="actions">

                </div>
            </div>
            <div class="portlet-body">
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table">
                            <tr>
                                <th>Name</th> 
                                <th>Email</th> 
                                <th>Username</th> 
                                <th>Role</th> 
                                <th>Actions</th> 
                            </tr>
                            <?php foreach($users as $user){ ?>
                            <tr>
                                <td><?php echo $user->firstname.' '.$user->lastname;?></td>
                                <td><?php echo $user->email;?></td>
                                <td><?php echo $user->email;?></td>
                                <td><?php echo user_role_lable($user->role);?></td>
                                <td>
                                    <a class="btn btn-info btn-sm" href="<?php echo app_url('users','edit','edit',array('id'=>$user->id));?>" title="Edit User"><i class="fa fa-pencil"></i> Edit</a>&nbsp;&nbsp;
                                    <a class="btn btn-danger btn-sm" href="<?php echo app_url('users','delete_user','list',array('del'=>$user->id));?>" onclick="return confirm('Are you sure you want to delete this user?');" title="Delete User"><i class="fa fa-trash"></i> Delete</a>&nbsp;&nbsp;
                                    <?php if ($user->is_active=='1'){ ?>
                                    <a class="btn btn-warning btn-sm" href="<?php echo app_url('users','suspend_user','list',array('suspend'=>$user->id));?>" title="Suspend User"><i class="fa fa-thumbs-down"></i> Suspend</a>
                                    <?php } else { ?>
                                    <a class="btn btn-success btn-sm" href="<?php echo app_url('users','unsuspend_user','list',array('unsuspend'=>$user->id));?>" title="Unsuspend User"><i class="fa fa-thumbs-up"></i> Unsuspend</a>
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