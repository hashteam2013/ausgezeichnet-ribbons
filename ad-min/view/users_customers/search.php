<div class="row">
    <div class="col-sm-12">
        <!-- BEGIN SAMPLE FORM PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-red-sunglo">
                    <i class="icon-user font-red-sunglo"></i>
                    <span class="caption-subject bold uppercase"> Search for Customers</span>
                </div>
                <div class="actions"></div>
            </div>
            <?php //print_r($users_customers); ?>
            <div class="portlet-body form">
                <div class="row">
                    <div class="col-sm-8">
                        <form role="form" action="<?php app_url('users_customers','search','search');?>" method="POST">
                            <div class="form-body">
                                <div class="form-group">
                                    <label>Firstname<font color="red">*</font></label>
                                    <input type="text" name="firstname" value="<?php echo isset($app['POST']['firstname'])?$app['POST']['firstname']:'';?>" class="form-control" placeholder="Firstname"> 
                                </div>
                                <div class="form-group">
                                    <label>Lastname<font color="red">*</font></label>
                                    <input type="text" name="lastname" value="<?php echo isset($app['POST']['lastname'])?$app['POST']['lastname']:'';?>" class="form-control" placeholder="Lastname"> 
                                </div>


             
                                <div class="form-actions">
                                    <button type="submit" name="search" class="btn blue">Search</button>

                                </div>

				
			  	
				<table class="table">
                            		<tr>
                                		<th>First Name</th> 
						<th>Last Name</th> 
						<th>User</th>
						<th>User ID</th> 
						<th>Order ID</th> 
 
					</tr>

				
				<?php

				$lastuser=0;
				$color="lightgray";
				foreach($customers as $customer)
				{
					if ($lastuser!=$customer->userid)
					{
						if ($color=="lightgray")
						{
							$color="white";
						}
						else
						{
							$color="lightgray";
						}
					}

					echo '<tr style="background-color:' . $color . ';">';
					echo  "<td>" . $customer->first_name . "</td>";
					echo  "<td>" . $customer->last_name . "</td>";
					echo  "<td><a href='https://www.ausgezeichnet.cc/ad-min/app.php?page=users_customers&view=edit&action=edit&id=" . $customer->userid . "'> " . $customer->user_first_name . " " . $customer->user_last_name . "</a></td>";
					echo  "<td>" . $customer->userid . "</td>";
					echo  "<td><a href='https://www.ausgezeichnet.cc/ad-min/app.php?page=orders&view=view&action=view&id=" . $customer->orderid . "'> " . $customer->orderid . "</a></td>";
					echo '</tr>';
					$lastuser=$customer->userid;
				}
				?>
				</table>



                            </div>
                        </form>
                       </div>
                    </div>
            </div>
        </div>
        <!-- END SAMPLE FORM PORTLET-->
    </div>
</div>
