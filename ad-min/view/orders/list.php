


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
                           <a class="btn btn-info btn-sm" href="<?php echo app_url('dpd_update','view','view')?>" title="dpd_update"><i class="fa fa-pencil"></i>DPD Update</a>
                           <a class="btn btn-info btn-sm" href="<?php echo app_url('dpd_daylist','view','view')?>" title="dpd_daylist"><i class="fa fa-pencil"></i>DPD Daylist importer</a>

                            <a class="btn btn-info btn-sm" href="<?php echo app_url('nameplates_all','view','view')?>" title="nameplates_all"><i class="fa fa-pencil"></i>Alle offenen Namensschilder generieren</a>
                          <a class="btn btn-info btn-sm" href="<?php echo app_url('nameplates_BH_Nagel','view','view')?>" title="nameplates_BH"><i class="fa fa-pencil"></i>Alle offenen Bundesheerschilder mit Nagel generieren</a>
                          <a class="btn btn-info btn-sm" href="<?php echo app_url('nameplates_BH_Nadel','view','view')?>" title="nameplates_BH"><i class="fa fa-pencil"></i>Alle offenen Bundesheerschilder mit Nadel generieren</a>
                      <a class="btn btn-info btn-sm" href="<?php echo app_url('nameplates_ORK','view','view')?>" title="nameplates_ORK"><i class="fa fa-pencil"></i>Alle offenen ORK Schilder generieren</a>
 
                      <a class="btn btn-info btn-sm" href="<?php echo app_url('nameplates_FW_list','view','view')?>" title="nameplates_FW"><i class="fa fa-pencil"></i>Liste als FW Schilder generieren</a>
                      <a class="btn btn-info btn-sm" href="<?php echo app_url('nameplates_ORK_list','view','view')?>" title="nameplates_ORK"><i class="fa fa-pencil"></i>Liste als ORK Schilder generieren</a>

                 <div class="col-sm-12">
                        <table class="table">
                            <tr>
                                <th>ID </th> 
                                <th>Billing Name</th> 
                                <th>Shipping Name</th> 
                                <th>Email</th> 
                                <th>Comment</th> 
				<th>Delivery State</th>	
                                <th>Amount</th>
                                <th>Discount</th>  
                                <th>Shipping</th>  
                                <th>Payment method</th> 
                                <th>Payment done</th> 
                                <th>Date</th> 
                            </tr>
                            
                            <?php
                        $showDebug=false;
                            $count = ($page_no != 1)?(($page_no-1)*PAGE_CONTENT_LIMIT+1) :$page_no ;

$totalamount=0;
$totalamountsold=0;
$counter=0;

                            foreach($orders as $order)
                            {


		if ($order->cart_secure_key<>" ")
		{
		          echo '<tr bgcolor="#FF5050">';
		}

		else
		{

		if($order->is_order_valid==0){   
                                echo '<tr bgcolor="#FFCCCC">';
		}
		else if($order->is_shipment_made==1){   
                                echo '<tr bgcolor="#90FF90">';
		}
		else if($order->is_packing_made==1){   
                                echo '<tr bgcolor="#CCCCFF">';
		}
		else {
                                echo '<tr bgcolor="#EEEE90">';
		}
		}
                             


                                    echo '<td>'.$order->id.'</td>';
                                    echo '<td>'.UTFencoder($order->billing_firstname.' '.$order->billing_lastname). '</td>';
                                    echo '<td>'.UTFencoder($order->shipping_firstname.' '.$order->shipping_lastname). '</td>';            
                                    echo '<td>'.$order->billing_email.'</td>';
                                    echo '<td>'.UTFencoder($order->comment).'</td>';
                                    echo '<td>'.$order->dpd_deliverystate.'</td>';
                                    echo '<td>';
                                    echo show_price($order->grand_total*(1-$order->discount)+$order->total_shipping_amount);
                                    echo '</td>';
                                    echo '<td>';
                                    echo $order->discount*100 . ' %';
                                    echo '</td>';
                                    echo '<td>';
                                    echo show_price($order->total_shipping_amount);
                                    echo '</td>';       
                                    echo '<td>';
                                            if($order->payment_method_name=='onaccount')
                                            {
                                                   echo '<span style="color:blue; font-weight: bold ;text-align:center;">' . $order->payment_method_name . '</span>';
                                            }
                                            else
                                            {
                                                    echo '<span style="color:black;text-align:center;">' . $order->payment_method_name . '</span>';

                                            }

                                    echo '</td>';                 
                                    echo '<td>';

if($order->is_order_cancelled==0)
{
                                    if($order->is_payment_made==1)
                                    {
	                             $counter++;
			$totalamount=$totalamount+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
                                        echo '<span style="color:green;text-align:center;">Bezahlt</span>';
                                    }
                                    else
                                    {
                                        if($order->payment_method_name=="Paypal" || $order->payment_method_name=="Sofort")
                                        {
                                            echo '<span style="color:red;text-align:center;">Abgebrochen</span>';
                                        }
                                        else
                                        {
                                            echo '<span style="color:red; font-weight: bold; text-align:center;">Offen</span>';
                                        }
                                    }
}
else
{
                                        echo '<span style="color:red;text-align:center;">STORNIERT</span>';

}


                                    if($order->is_order_valid==1)
                                    {
			$totalamountsold=$totalamountsold+$order->grand_total*(1-$order->discount)+$order->total_shipping_amount;
		     }

                                    echo '</td>';
                                    echo '<td>';
                                    echo show_date($order->date_add);
                                    echo '</td>';
                                    echo '<td><a class="btn btn-info btn-sm" href="';
                                    echo app_url('orders','view','view',array('id'=>$order->id));
                                    echo '" title="details"><i class="fa fa-pencil"></i>More detail</a>&nbsp;&nbsp;</td>';
                                    echo '</tr>';
                                }
                            
		echo '<br>';

                        echo 'Umsatz bezahlt: '. $totalamount;
		echo '<br>';
                        echo 'Umsatz inkl. offener Bestellungen: '. $totalamountsold;
		echo '<br>';
                        echo 'Anzahl bezahlter Bestellungen: '.$counter;

                            ?>
                    </table>
                </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div align="center">
   <ul class='pagination text-center' id="pagination">
    <?php 
//    echo $pagination;
    ?>

    </ul> 
</div>
