


<div class="row">
    <div class="col-sm-12">
        <!-- BEGIN SAMPLE FORM PORTLET-->
        <div class="portlet light bordered">
            <div class="portlet-title">
                <div class="caption font-red-sunglo">
                    <i class="icon-users font-red-sunglo"></i>
                    <span class="caption-subject bold uppercase"> Statistik fuer  <?php echo $validorderitems[0]->ribbon_name_dr ?></span>
                </div>
                <div class="actions"></div>
            </div>
            
            <div class="portlet-body">
                <div class="row">
                    <div class="col-sm-12">

                        <table class="table">
                            <tr>
                                <th>Number</th> 
                                <th>Order ID</th>
                                <th>Besteller</th>
		  <th>Customer ID</th> 
                                <th>Quantity ordered</th> 
                                <th>Quantity delivered</th> 
                            </tr>
                            
                            <?php

                            $count = ($page_no != 1)?(($page_no-1)*PAGE_CONTENT_LIMIT+1) :$page_no ;

                         foreach($validorderitems as $orderitem)
                      {

	        $shipped_counter=0;



                         foreach($shippedorderitems as $shippeditem)
		{

			if($shippeditem->customer_id==$orderitem->customer_id && $shippeditem->order_id==$orderitem->order_id )
			{	
				$shipped_counter=$shippeditem->quantity;
				break;
			}
		}

		if($shipped_counter==$orderitem->quantity) 
		{
			continue;
		}
		

                          {	

		if($shipped_counter!=$orderitem->quantity) 
		{
			echo '<tr bgcolor=#FFCCCC>';
		}
		else
		{
			echo '<tr>';
		}


                              echo '<td>'.$count++.'</td>';
                              echo '<td><a href=http://www.ausgezeichnet.cc/ad-min/app.php?page=orders&view=view&action=view&id='.$orderitem->order_id.'>'.$orderitem->order_id.'</td>';
                              echo '<td>'.$orderitem->billing_firstname. ' ' . $orderitem->billing_lastname.'</td>';
                              echo '<td>'.$orderitem->customer_id.'</td>';
                              echo '<td>'.$orderitem->quantity.'</td>';
                              echo '<td>'.$shipped_counter.'</td>';
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
