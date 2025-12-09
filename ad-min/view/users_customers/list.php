<div class="row">
    <div class="col-sm-12">
        <!-- BEGIN SAMPLE FORM PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-red-sunglo">
                    <i class="icon-users font-red-sunglo"></i>
                    <span class="caption-subject bold uppercase">Manage Users</span>
                </div>
                <div class="actions">
              <?php //echo "<pre>"; print_r($users_customers); echo "</pre>";?>
                </div>
            </div>
            <div class="portlet-body">
	<p>Users verified: <?php echo $users_verified; ?> </p>
	<p>Users accepted DSGVO: <?php echo $users_dsgvo; ?> </p>
                <div class="row">
                    <div class="col-sm-12">
                        <table class="table">
                            <tr>
                                <th>Sr no.</th> 
                                <th>Name</th> 
                                <th>Email</th> 
                  	   <th>Comment</th> 
                               <th>Date</th>
                         	   <th>Volumen</th>
                         	   <th>Spangen</th>  
                                <th>Verified</th> 
                                <th>DSGVO</th>
                                <th>Mail</th>
                                <th>Phone</th>
                                 <th>Actions</th> 
                            </tr>
                            <?php $count = ($page_no != 1)?(($page_no-1)*PAGE_CONTENT_LIMIT+1) :$page_no ;
                            foreach($users_customers as $user){ ?>
                            
		<?php
		if($user->accepted_dsgvo1=='1' && $user->is_verified=='1')
		{
			if( $user->batches_total > 40)
			{
				echo '<tr style="background-color: #CCFFFF;">';
			}
			else
			{
				echo '<tr style="background-color: #CCFFCC;">';
			}
		}
		elseif($user->is_verified!='1')
		{
			echo '<tr style="background-color: #FFCCCC;">';
		}
		elseif($user->accepted_dsgvo1!='1')
		{
			echo '<tr style="background-color: #FFAAAA;">';
		}
		else
		{
			echo '<tr>';
		}

		?>
		
                                <td><?php echo $count++;?></td>
                                <td><?php echo $user->first_name.' '.$user->last_name;?></td>
                                <td><?php echo $user->email;?></td>      
                             <td><?php echo $user->comment;?></td>                             
                                <td><?php echo show_date($user->date_upd);?></td>  
                                <td><?php echo $user->total;?></td>  
                                <td><?php echo $user->batches_total;?></td>  
                                <td><?php echo $user->is_verified;?></td>  
                                <td><?php echo $user->accepted_dsgvo1;?></td>  
                                <td><?php echo $user->accepted_eMail;?></td>  
                                <td><?php echo $user->accepted_phone;?></td>  
                                <td>
                                    <a class="btn btn-info btn-sm" href="<?php echo app_url('users_customers','edit','edit',array('id'=>$user->id));?>" title="Edit User"><i class="fa fa-pencil"></i> Edit</a>&nbsp;&nbsp;
                                    <a class="btn btn-danger btn-sm" href="<?php echo app_url('users_customers','delete_user','list',array('del'=>$user->id));?>" onclick="return confirm('Are you sure you want to delete this user?');" title="Delete User"><i class="fa fa-trash"></i> Delete</a>&nbsp;&nbsp;
                                    <a class="btn btn-success btn-sm" href="<?php echo app_url('customers','customer_list','list',array('id'=>$user->id));?>" title="Customers"><i class="fa fa-thumbs-up"></i>Customers</a>
                                    <a class="btn btn-info btn-sm" href="mailto: <?php echo  $user->email;?> ?subject=Ausgezeichnet.cc | Account Verifizierung" title="Mail"><i class="class="fa fa-pencil"></i>Mail</a>
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

