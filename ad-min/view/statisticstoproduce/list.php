


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
      		<th>Total to deliver</th> 
                            </tr>





                            <?php

                            $count = ($page_no != 1)?(($page_no-1)*PAGE_CONTENT_LIMIT+1) :$page_no ;

	
                         foreach($validorderitems as $orderitem)
                      {
		$shipped_counter=0;
		$cancelled_counter=0;


                         foreach($shippedorderitems as $shippeditem)
		{

			if($shippeditem->product_id==$orderitem->product_id)
			{	
				$shipped_counter=$shippeditem->numberofitems ;
				break;
			}
		}


		if($orderitem->numberofitems - $shipped_counter==0)
		{

			continue;
		}

                          {	
                          	echo '<tr>';
                              echo '<td>'.$count++.'</td>';
                              echo '<td>'.$orderitem->product_id.'</td>';
                              echo '<td>'.$orderitem->NumberOfProcessedOrders.'</td>';
		echo '<td>'.$orderitem->ribbon_name_dr.'</td>';
                             echo '<td>'.($orderitem->numberofitems - $shipped_counter ).'</td>';
                              echo '<td><a class="btn btn-info btn-sm" href="';
                              echo app_url('statisticstoproduce','view','view',array('id'=>$orderitem->product_id));
                              echo '" title="details"><i class="fa fa-pencil"></i>More detail</a>&nbsp;&nbsp;</td>';
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



