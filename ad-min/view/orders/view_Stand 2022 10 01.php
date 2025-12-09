<?php //pr($trust);  ?>
<div class="row">
    <div class="col-sm-12">
        <!-- BEGIN SAMPLE FORM PORTLET-->
        <div class="portlet light bordered partation">
            <div class="portlet-title">
                <div class="caption font-red-sunglo">
                    <i class="icon-user font-red-sunglo"></i>
                    <span class="caption-subject bold uppercase">Order Detail</span>
                </div>
                <div class="actions"></div>
            </div>
            <div class="portlet-body form">

<?php
$dir = 'pdfAblage/'.$orders->id;

// Open a directory, and read its contents

if (is_dir($dir))
{
  if ($dh = opendir($dir))
  {
    while (($file = readdir($dh)) !== false)
          {
          echo '<a href="'.'pdfAblage/'.$orders->id  .'/'. $file.'">'.$file.'</a>';   
          }
   closedir($dh);
 }
}
?>

                <div class="row">
                    
                <form role="form" action="<?php app_url('orders','edit','view',array('id'=>$app['GET']['id']));?>" method="POST" enctype="multipart/form-data" accept-charset="utf-8">

                 <select name="ordervalid">
                        <option value="1" <?php echo ($orders->is_order_valid == 1?'selected':'');?>>Order is valid</option>
                        <option value="0" <?php echo ($orders->is_order_valid == 0?'selected':'');?>>Order is not valid</option>
                </select>
                 <select name="ordercancelled">
                        <option value="1" <?php echo ($orders->is_order_cancelled == 1?'selected':'');?>>Order is cancelled</option>
                        <option value="0" <?php echo ($orders->is_order_cancelled  == 0?'selected':'');?>>Order is not cancelled</option>
                </select>
                                                                <div class="form-actions">
                                    <button type="submit" name="update" class="btn blue">Update Order</button>
                                    <a class="btn default" href="<?php app_url('orders','list','list');?>">Cancel</a>
                        </div>
                            <a class="btn btn-info btn-sm" href="<?php echo app_url('invoice','view','view',array('id'=>$orders->id))?>" title="invoice"><i class="fa fa-pencil"></i>Rechnung erstellen</a>
                            <a class="btn btn-info btn-sm" href="<?php echo app_url('invoicepercustomer','view','view',array('id'=>$orders->id))?>" title="invoicepercustomer"><i class="fa fa-pencil"></i>Rechnung pro Kunde</a>
                            <a class="btn btn-info btn-sm" href="<?php echo app_url('offer','view','view',array('id'=>$orders->id))?>" title="invoice"><i class="fa fa-pencil"></i>Angebot erstellen</a>
                            <a class="btn btn-info btn-sm" href="<?php echo app_url('offerBusiness','view','view',array('id'=>$orders->id))?>" title="invoice"><i class="fa fa-pencil"></i>Angebot (Firmenkunden) erstellen</a>

                            <a class="btn btn-info btn-sm" href="<?php echo app_url('packinglist','view','view',array('id'=>$orders->id))?>" title="invoice"><i class="fa fa-pencil"></i>Lieferschein erstellen</a>
                            <a class="btn btn-info btn-sm" href="<?php echo app_url('shippinglabel','view','view',array('id'=>$orders->id))?>" title="shippinglabel"><i class="fa fa-pencil"></i>Versandetikett drucken</a>
                            <a class="btn btn-info btn-sm" href="<?php echo app_url('packinglabels','view','view',array('id'=>$orders->id))?>" title="packinglabels"><i class="fa fa-pencil"></i>Packetiketten drucken</a>
                            <a class="btn btn-info btn-sm" href="<?php echo app_url('storno','view','view',array('id'=>$orders->id))?>" title="storno"><i class="fa fa-pencil"></i>Stornorechnung erstellen</a>
                            <a class="btn btn-info btn-sm" href="<?php echo app_url('orders','close','view',array('id'=>$orders->id))?>" title="close"><i class="fa fa-pencil"></i>Bestellung abschließen</a>
                            <a class="btn btn-info btn-sm" href="<?php echo app_url('badgesplaced','view','view',array('id'=>$orders->user_id,'orderid'=>$app['GET']['id']))?>" title="badgesplaced"><i class="fa fa-pencil"></i>Spangen anzeigen</a>
                            <a class="btn btn-info btn-sm" href="<?php echo app_url('orderconfirmation','view','view',array('id'=>$orders->id))?>" title="orderconfirmation"><i class="fa fa-pencil"></i>AB</a>
                            <a class="btn btn-info btn-sm" href="<?php echo app_url('invoiceIGErwerb','view','view',array('id'=>$orders->id))?>" title="invoiceIGErwerb"><i class="fa fa-pencil"></i>Rechnung IG Erwerb</a>
                            <a class="btn btn-info btn-sm" href="<?php echo app_url('paymentreminder','view','view',array('id'=>$orders->id))?>" title="paymentreminder"><i class="fa fa-pencil"></i>Mahnung</a>
                            <a class="btn btn-info btn-sm" href="<?php echo app_url('offer_withoutsum','view','view',array('id'=>$orders->id))?>" title="invoice"><i class="fa fa-pencil"></i>Angebot (ohne Summe) erstellen</a>

                    <div class="col-sm-12">
                        <div class="form-body">
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_1">
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12">
                                            <div class="portlet yellow-crusta box">
                                                <div class="portlet-title">
                                                    <div class="caption">
                                                        <i class="fa fa-cogs"></i>Order Details </div>
                                                    <div class="actions">
                                                        
                                                    </div>
                                                </div>

                                                <div class="portlet-body">
                                                    <div class="row static-info">
                                                        <div class="col-md-5 name"> Order #: </div>
                                                        <div class="col-md-7 value"><?php echo $orders->id; ?>

                                                        </div>
                                                    </div>
                                                    <div class="row static-info">
                                                        <div class="col-md-5 name"> Order Date &amp; Time: </div>
                                                        <div class="col-md-7 value"><?php echo show_date($orders->date_add); ?> </div>
                                                    </div>

                                                    <div class="row static-info">
                                                        <div class="col-md-5 name"> Grand Total: </div>
                                                        <div class="col-md-7 value"><?php echo show_price($orders->grand_total*(1-$orders->discount)+$orders->total_shipping_amount); ?></div>
                                                    </div>
                                                    <div class="row static-info">
                                                        <div class="col-md-5 name"> Payment Information: </div>
                                                        <div class="col-md-7 value">
                                                            <select name="paymentdone">
                                                                <option value="1" <?php echo ($orders->is_payment_made == 1?'selected':'');?>>Payment done</option>
                                                                <option value="0" <?php echo ($orders->is_payment_made == 0?'selected':'');?>>Payment not done</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row static-info">
                                                        <div class="col-md-5 name"> Payment date: </div>
                                                        <div class="col-md-7 value">
				<input type="date" name="payment_time" value="<?php echo date('Y-m-d', strtotime(str_replace('-', '/', $orders->payment_time))); ?>">
                                                        </div>
                                                    </div>
                                                    <div class="row static-info">
                                                        <div class="col-md-5 name"> Estimated delivery date: </div>
                                                        <div class="col-md-7 value">
				<input type="date" name="estimate_delivery_date" value="<?php echo date('Y-m-d', strtotime(str_replace('-', '/', $orders->estimate_delivery_date))); ?>">
                                                        </div>
                                                    </div>
                                                    <div class="row static-info">
                                                        <div class="col-md-5 name"> Override delivery date: </div>
                                                        <div class="col-md-7 value">
				<input type="text" name="override_delivery_date" value="<?php echo $orders->override_delivery_date; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="row static-info">
                                                        <div class="col-md-5 name"> Override invoice date: </div>
                                                        <div class="col-md-7 value">
				<input type="text" name="override_invoice_date" value="<?php echo $orders->override_invoice_date; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="row static-info">
                                                        <div class="col-md-5 name"> Override order date: </div>
                                                        <div class="col-md-7 value">
				<input type="text" name="override_order_date" value="<?php echo $orders->override_order_date; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="row static-info">
                                                        <div class="col-md-5 name"> Packing Information: </div>
                                                        <div class="col-md-7 value">
                                                            <select name="packingdone">
                                                                <option value="1" <?php echo ($orders->is_packing_made == 1?'selected':'');?>>Packing done</option>
                                                                <option value="0" <?php echo ($orders->is_packing_made == 0?'selected':'');?>>Packing not done</option>
                                                            </select>
                                                        </div>
                                                    </div>


                                                    <div class="row static-info">
                                                        <div class="col-md-5 name"> Shipment Information: </div>
                                                        <div class="col-md-7 value">
                                                            <select name="shipmentdone">
                                                                <option value="1" <?php echo ($orders->is_shipment_made == 1?'selected':'');?>>Shipment done</option>
                                                                <option value="0" <?php echo ($orders->is_shipment_made == 0?'selected':'');?>>Shipment not done</option>
                                                            </select>
                                                        </div>
                                                    </div>

                                                            <div class="row static-info">
                                                        <div class="col-md-5 name"> Delivery Condition: </div>
                                                        <div class="col-md-7 value">
				 <select name="deliverycondition_id" id="deliverycondition_id" class='form-control'>
                                       		 <option value=""><?php _e('Select delivery condition'); ?></option>
                                        		<?php foreach ($deliveryconditions as $deliverycondition) { ?>
                                            		<option <?php if( $deliverycondition->id == $orders->deliverycondition_id){?> selected="selected"<?php } ?> value="<?php echo $deliverycondition->id; ?>"><?php echo $deliverycondition->name_en; ?></option>
                                        		<?php } ?>
                                    		</select>

                                                        </div>
                                                    </div>

                                                            <div class="row static-info">
                                                        <div class="col-md-5 name"> Payment Condition: </div>
                                                        <div class="col-md-7 value">
				 <select name="paymentcondition_id" id="paymentcondition_id" class='form-control'>
                                       		 <option value=""><?php _e('Select payment condition'); ?></option>
                                        		<?php foreach ($paymentconditions as $paymentcondition) { ?>
                                            		<option <?php if( $paymentcondition->id == $orders->paymentcondition_id){?> selected="selected"<?php } ?> value="<?php echo $paymentcondition->id; ?>"><?php echo $paymentcondition->name_en; ?></option>
                                        		<?php } ?>
                                    		</select>

                                                        </div>
                                                    </div>

                                                    <div class="row static-info">
                                                        <div class="col-md-5 name"> Comment: </div>
                                                        <div class="col-md-7 value">
                                                            <input type="text" name="comment" value="<?php echo $orders->comment ?>">
                                                        </div>
                                                    </div>

                                                    <div class="row static-info">
                                                        <div class="col-md-5 name"> Printed comment: </div>
                                                        <div class="col-md-7 value">
                                                            <input type="text" name="comment_top" value="<?php echo $orders->comment_top ?>">
                                                        </div>
                                                    </div>

                                                    <div class="row static-info">
                                                        <div class="col-md-5 name"> Override invoice Text: </div>
                                                        <div class="col-md-7 value">
                                                            <input type="text" name="Override_TotalInvoice" value="<?php echo $orders->Override_TotalInvoice?>">
                                                        </div>
                                                    </div>


                                      	</div>
                                                </div>
                                            </div>

                                        <div class="col-md-6 col-sm-12">
                                            <div class="portlet blue-hoki box">
                                                <div class="portlet-title">
                                                    <div class="caption">
                                                        <i class="fa fa-cogs"></i>Customer Information </div>
                                                    <div class="actions">

                                                    </div>
                                                </div>
                                                <div class="portlet-body">
                                                    <div class="row static-info">
                                                        <div class="col-md-5 name"> id: </div>
                                                        <div class="col-md-7 value"><?php echo $trust->id; ?></div>
			        </div>
                                                    <div class="row static-info">
                                                        <div class="col-md-5 name"> Customer Name: </div>
                                                        <?php if($trust->is_trustworthy == '1' ){ ?>
                                                        <div class="col-md-5 value"><?php echo UTFencoder($trust->first_name . ' ' .  $trust->last_name) .   ' (Trustworthy)' ;?></div>
                                                        <?php }else { ?>
                                                        <div class="col-md-7 value"><?php echo UTFencoder($trust->first_name .  ' '  . $trust->last_name); ?></div>
                                                        <?php } ?>
                                                    </div>
                                                    <div class="row static-info">
                                                        <div class="col-md-5 name"> Email: </div>
                                                        <div class="col-md-7 value"><?php echo $trust->email; ?></div>
                                                    </div>
                                                    <div class="row static-info">
                                                        <div class="col-md-5 name"> Phone Number: </div>
				<?php if($trust->accepted_phone==0)
				{ ?>
                                                        		<div class="col-md-7 value"> No calls accepted </div>
				<?php }
				else
                                                        	{ ?>
					<div class="col-md-7 value"><?php echo $trust->phone; ?> </div>
                                                    	<?php } ?>
				</div>
                                                    <div class="row static-info">
                                                        <div class="col-md-5 name"> District: </div>
                                                        <div class="col-md-7 value"><?php echo $district->name_dr;?> </div>
                                                    </div>
                                                    <div class="row static-info">
                                                        <div class="col-md-5 name"> Subdistrict: </div>

				<?php if($trust->subdistrict==0)
				{ ?>
                                                        		<div class="col-md-7 value"> Not specified </div>
				<?php }
				else
                                                        	{ ?>
                                                        		<div class="col-md-7 value"><?php echo $subdistrict->name_dr;?> </div>
                                                    	<?php } ?>
                                                    </div>

                                                    <div class="row static-info">
                                                        <div class="col-md-5 name"> Organisation: </div>

				<?php if($trust->department_new==0)
				{ ?>
                                                        		<div class="col-md-7 value"> Not specified </div>
				<?php }
				else
                                                        	{ ?>
                                                        		<div class="col-md-7 value"><?php echo $department->name_dr;?> </div>
                                                    	<?php } ?>
                                                    </div>
                                                    <div class="row static-info">
                                                        <div class="col-md-5 name"> Organisation 2: </div>

				<?php if($trust->department_new2==0)
				{ ?>
                                                        		<div class="col-md-7 value"> Not specified </div>
				<?php }
				else
                                                        	{ ?>
                                                        		<div class="col-md-7 value"><?php echo $department2->name_dr;?> </div>
                                                    	<?php } ?>
                                                    </div>



                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6 col-sm-12">
                                            <div class="portlet green-meadow box">
                                                <div class="portlet-title">
                                                    <div class="caption">
                                                        <i class="fa fa-cogs"></i>Billing Address </div>
                                                    <div class="actions">

                                                    </div>
                                                </div>
                                                <div class="portlet-body">
                                                    <div class="row static-info">
                                                        <div class="col-md-12 value">
				<label>Company</label><br>
				<input type="text" name="billing_company" value="<?php echo $orders->billing_company; ?>">
				<br>
				<label>Firstname - Lastname</label> <br>
				<input type="text" name="billing_firstname" value="<?php echo $orders->billing_firstname; ?>">
				<input type="text" name="billing_lastname" value="<?php echo $orders->billing_lastname; ?>">
				<br>
				<label>Address</label> <br>
				<input type="text" name="billing_address1" value="<?php echo $orders->billing_address1; ?>">
				<br>
				<label>ZIP code</label> <br>
				<input type="text" name="billing_zip" value="<?php echo $orders->billing_zip; ?>">
				<br>
				<label>City</label> <br>
				<input type="text" name="billing_city" value="<?php echo $orders->billing_city; ?>">
				<br>
				<label>Phone</label> <br>
				<input type="text" name="billing_mobile" value="<?php echo $orders->billing_mobile; ?>">
				<br>
				<label>Mail</label> <br>
				<input type="text" name="billing_email" value="<?php echo $orders->billing_email; ?>">
                                                            <br> </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-sm-12">
                                            <div class="portlet red-sunglo box">
                                                <div class="portlet-title">
                                                    <div class="caption">
                                                        <i class="fa fa-cogs"></i>Shipping Address </div>
                                                    <div class="actions">

                                                    </div>
                                                </div>
                                                <div class="portlet-body">
                                                    <div class="row static-info">
                                                        <div class="col-md-12 value">
				<label>Company</label><br>
				  <input type="text" name="shipping_company" value="<?php echo $orders->shipping_company; ?>">
				<br>
				<label>Firstname - Lastname</label> <br>
				<input type="text" name="shipping_firstname" value="<?php echo $orders->shipping_firstname; ?>">
				<input type="text" name="shipping_lastname" value="<?php echo $orders->shipping_lastname; ?>">
				<br>
				<label>Address</label> <br>
				<input type="text" name="shipping_address1" value="<?php echo $orders->shipping_address1; ?>">
				<br>
				<label>ZIP code</label> <br>
				<input type="text" name="shipping_zip" value="<?php echo $orders->shipping_zip; ?>">
				<br>
				<label>City</label> <br>
				<input type="text" name="shipping_city" value="<?php echo $orders->shipping_city; ?>">
				<br>
				<label>Phone</label> <br>
				<input type="text" name="shipping_mobile" value="<?php echo $orders->shipping_mobile; ?>">
				<br>
				<label>Mail</label> <br>
				<input type="text" name="shipping_email" value="<?php echo $orders->shipping_email; ?>">
                                                            <select name="shipping_country">
                                                                <option value="1" <?php echo ($orders->shipping_country == 1?'selected':'');?>>AUT</option>
                                                                <option value="2" <?php echo ($orders->shipping_country == 2?'selected':'');?>>DE</option>
                                                            </select>


                                                            <br> </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row">
                                        <div class="col-md-6 col-sm-12">
                                            <div class="portlet green-meadow box">
                                                <div class="portlet-title">
                                                    <div class="caption">
                                                        <i class="fa fa-cogs"></i>Other orders with that customers </div>
                                                    <div class="actions">

                                                    </div>
                                                </div>
                                                <div class="portlet-body">
                                                    <div class="row static-info">
                                                        <div class="col-md-12 value">
				<?php
				foreach($customer_order_items as $customer_order_item)
				{
					echo   UTFencoder($customer_order_item->first_name .' '. $customer_order_item->last_name) .' ('. $customer_order_item->customer_id. ') in <a href=';
					echo  app_url('orders','view','view',array('id'=>$customer_order_item->order_id));                                    					
					echo '>'.$customer_order_item->order_id.'</a><br>';
				}
				?>
                                                            <br> </div>
                                                    </div>
                                                </div>
                                            </div>
                                            </div>
                                      <div class="col-md-6 col-sm-12">
                                            <div class="portlet green-meadow box">
                                                <div class="portlet-title">
                                                    <div class="caption">
                                                        <i class="fa fa-cogs"></i>New customers </div>
                                                    <div class="actions">

                                                    </div>
                                                </div>
                                                <div class="portlet-body">
                                                    <div class="row static-info">
                                                        <div class="col-md-12 value">
				<?php
	

	

				foreach ($customers_for_this_order as $customer)
				{
				$show=1;
					foreach($customer_order_items as $customer_order_item)
					{
						if($customer->customer_id==$customer_order_item->customer_id && $orders->id>$customer_order_item->order_id)
						{

							$show=0;
							break;
						}
					}
					if($show==1)
					{
						echo   UTFencoder($customer->first_name.' '.$customer->last_name . ' (' . $customer->ShownName .')');					
						echo '<br>';
					}
				}


				?>
                                                            <br> </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                     </div>
         

                                    <div class="row">
                                        <div class="col-md-12 col-sm-12">
                                            <div class="portlet grey-cascade box">
                                                <div class="portlet-title">
                                                    <div class="caption">
                                                        <i class="fa fa-cogs"></i>Shopping Cart </div>
                                                </div>
                                                <div class="portlet-body">
                                                    <div class="table-responsive">
                                                        <table class="table table-hover table-bordered table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th>Pos</th>
                                                                    <th>Inactive</th>
                                                                    <th>Product</th>
                                                                    <th>Name</th>
                                                                    <th>Original Price</th>
                                                                    <th>Quantity </th>
                                                                    <th>Total </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                   foreach ($orders_item as $order_item) { ?>
                                                                   
                                                                    <tr>
				
                                                                            <td><input type="text" name="pos_<?php echo $order_item->id; ?>" value="<?php echo $order_item->pos; ?>"></td>
                                                                            <td><input type="text" name="inactive_<?php echo $order_item->id; ?>" value="<?php echo $order_item->inactive; ?>"></td>
                                                                           <td><img src="<?php echo DIR_WS_UPLOADS; ?>batch/<?php echo $order_item->batch_image; ?>" class="border alpha" > <br/>
                                                                             <?php
                                                                                if ($order_item->type == 0)
                                                                                    echo"";
                                                                                elseif ($order_item->type == 1)
                                                                                    echo '<b>Number : </b>' . $order_item->number;
                                                                                elseif ($order_item->type == 2)
                                                                                    echo '<b>Year :</b>' . $order_item->year . '<br>' . '<b>Country:</b>' . $order_item->country;
                                                                                elseif ($order_item->type == 10)
                                                                                    echo '<b>' . $order_item->ShownName . '</b>';
                                                                                ?>
                                                                            </td>
                                                                            <td><?php echo "[".$order_item->id."][".$order_item->product_id."]".$order_item->batch_name."\n".UTFencoder("Empfänger: "). UTFencoder($order_item->firstname)." ".UTFencoder($order_item->lastname); ?></td>
                                                                            <td><?php echo show_price($order_item->unit_price); ?></td>
                                                                            <td><?php echo $order_item->quantity; ?></td>
                                                                            <td><?php echo show_price($order_item->unit_price * $order_item->quantity); ?></td>
                                                                        </tr>
                                                                <?php } ?>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row" >
                            <div class="col-md-12 col-sm-12">
                                <div class="portlet yellow-crusta box">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-cogs"></i><?php _e("Order Comment"); ?> </div>
                                        <div class="actions"></div>
                                    </div>
                                    <div class="portlet-body">
                                                            <textarea rows="6" cols="200" name="order_comment"><?php echo $orders->order_comment ?></textarea>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6"> </div>
                            <div class="col-md-6">
                                <div class="well">
                                <?php //pr($orders); ?> 
                                    <div class="row static-info align-reverse">
                                        <div class="col-md-8 name"><?php _e(" Grand Total:"); ?> </div>
                                        <div class="col-md-3 value"><?php echo show_price($orders->grand_total); ?></div>
 
            <div class="col-md-8 name">Discount</div>
			<div class="col-md-3 value">
                <select name="discount">
                  <option value="0" <?php echo ($orders->discount == 0?'selected':'');?>> 0 %</option>
                  <option value="0.07" <?php echo ($orders->discount == 0.07?'selected':'');?>>7 %</option>
                  <option value="0.1" <?php echo ($orders->discount == 0.1?'selected':'');?>>10 %</option>
                  <option value="0.2" <?php echo ($orders->discount == 0.2?'selected':'');?>>20 %</option>
                  <option value="1" <?php echo ($orders->discount == 1?'selected':'');?>>100 %</option>
                </select>
            </div>
                                        
			<div class="col-md-8 name"><?php _e("TotalDisc"); ?> </div>
			<div class="col-md-3 value"><?php echo show_price($orders->grand_total*(1-$orders->discount)); ?></div>
			<div class="col-md-8 name"><?php _e("ShippingCost"); ?> </div>

		<div class="col-md-3 value">
                	<select name="shippingcosts">
                  	<option value="0" <?php echo ($orders->total_shipping_amount == 0?'selected':'');?>><?php echo show_price(0); ?></option>
                  	<option value="2.10" <?php echo ($orders->total_shipping_amount == 2.10?'selected':'');?>><?php echo show_price(2.10); ?></option>
                  	<option value="4.20" <?php echo ($orders->total_shipping_amount == 4.20?'selected':'');?>><?php echo show_price(4.20); ?></option>
                  	<option value="6.90" <?php echo ($orders->total_shipping_amount == 6.90?'selected':'');?>><?php echo show_price(6.90); ?></option> 
                  	<option value="8.90" <?php echo ($orders->total_shipping_amount == 8.90?'selected':'');?>><?php echo show_price(8.90); ?></option>
                  	<option value="12" <?php echo ($orders->total_shipping_amount == 12?'selected':'');?>><?php echo show_price(12); ?></option> 

	               	</select>

	            </div>

			<div class="col-md-8 name">Mahngebuehr </div>
		<div class="col-md-3 value">
                <select name="reminder_fee">
                  <option value="0" <?php echo ($orders->reminder_fee == 0?'selected':'');?>><?php echo show_price(0); ?></option>
                  <option value="10.00" <?php echo ($orders->reminder_fee == 10.00?'selected':'');?>><?php echo show_price(10.00); ?></option>
                  <option value="15.00" <?php echo ($orders->reminder_fee == 15.00?'selected':'');?>><?php echo show_price(15.00); ?></option>
                  <option value="20.00" <?php echo ($orders->reminder_fee == 20.00?'selected':'');?>><?php echo show_price(20.00); ?></option>

               </select>

            </div>
			<div class="col-md-8 name"><?php _e("TotalDiscShip"); ?> </div>
			<div class="col-md-3 value"><?php echo show_price($orders->grand_total*(1-$orders->discount)+$orders->total_shipping_amount); ?></div>
                                    </div>
                                    <div class="row static-info align-reverse">
                                        <div class="col-md-8 name"><?php _e(" Total Paid:"); ?> </div>
                                        <?php if ($orders->is_payment_made == 1) { ?>
                                       <div class="col-md-3 value"><?php echo show_price($orders->grand_total*(1-$orders->discount)+$orders->total_shipping_amount); ?></div>
                                <?php } else { ?>
                                            <div class="col-md-3 value"><?php echo show_price('0'); ?></div>
                                        <?php } ?>
                                    </div>
                                    <div class="row static-info align-reverse">
                                        <div class="col-md-8 name"><?php _e(" Total Due: "); ?></div>
                                        <?php if ($orders->is_payment_made == 1) { ?>
                                            <div class="col-md-3 value"><?php echo show_price('0'); ?></div>
                                <?php } else { ?>
                                            <div class="col-md-3 value"><?php echo show_price($orders->grand_total*(1-$orders->discount)+$orders->total_shipping_amount); ?></div>
                                <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>


                        
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> 
<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script src="js/bootstrap.min.js"></script>	


