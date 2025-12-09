


<div class="row">
    <div class="col-sm-12">
        <!-- BEGIN SAMPLE FORM PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-red-sunglo">
                    <i class="icon-users font-red-sunglo"></i>
                    <span class="caption-subject bold uppercase"> View Orders</span>
                </div>
                <div class="actions"></div>
            </div>


            <div class="portlet-body">
                <div class="row">
                    <div class="col-sm-12">

                        <table class="table">
                            <tr>
                                <th>Number</th> 
                                <th>Ribbon ID</th>
				<th>Number of orders</th> 
				<th>Ribbon Name</th>
                                <th>Total ordered - last month</th> 
                                <th>Total ordered - 2 months ago</th> 
                            </tr>

                            <?php

                            $count = ($page_no != 1)?(($page_no-1)*PAGE_CONTENT_LIMIT+1) :$page_no ;

	
                         foreach($validorderitemsThisMonth as $orderitem)
                      {
			$orderedlastmonth = 0;
	
                         foreach($validorderitemsLastMonth as $orderitemLastMonth)
                         {
				if($orderitem->product_id == $orderitemLastMonth->product_id)
				{
				$orderedlastmonth = $orderitemLastMonth->numberofitems; 
				break;
				}
			}




                          {	
                              echo '<tr>';
                              echo '<td>'.$count++.'</td>';
                              echo '<td>'.$orderitem->product_id.'</td>';
                              echo '<td>'.$orderitem->NumberOfProcessedOrders.'</td>';
		      	      echo '<td>'.$orderitem->ribbon_name_dr.'</td>';
                              echo '<td>'.$orderitem->numberofitems.'</td>';
                              echo '<td>'.$orderedlastmonth.'</td>';
                     	      echo '</tr>';
                }
           }
                            ?>
                    </table>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>



