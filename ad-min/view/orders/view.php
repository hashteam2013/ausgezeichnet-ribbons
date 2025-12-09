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

<table  style="width:100%">
	<tr>
		<th>Rechnungen</th>
		<th>Angebote</th>
		<th>Versand</th>
		<th>Sonstiges</th>
		<th>Auslieferung</th>
	</tr>
	<tr>
		<td><a class="btn btn-info btn-sm" href="<?php echo app_url('invoice','view','view',array('id'=>$orders->id))?>" title="invoice"><i class="fa fa-pencil"></i>Rechnung erstellen</a></td>
		<td><a class="btn btn-info btn-sm" href="<?php echo app_url('offer','view','view',array('id'=>$orders->id))?>" title="invoice"><i class="fa fa-pencil"></i>Angebot erstellen</a><br></td>
		<td><a class="btn btn-info btn-sm" href="<?php echo app_url('packinglist','view','view',array('id'=>$orders->id))?>" title="invoice"><i class="fa fa-pencil"></i>Lieferschein erstellen</a></td>
	<td><a class="btn btn-info btn-sm" href="<?php echo app_url('orders','close','view',array('id'=>$orders->id))?>" title="close"><i class="fa fa-pencil"></i>Bestellung abschließen</a></td>
	<td><a class="btn btn-info btn-sm" href="<?php echo app_url('shippingPost','view','view',array('id'=>$orders->id))?>" title="invoice"><i class="fa fa-pencil"></i>Per Post versenden</a></td>
	</tr>
	<tr>
		<td><a class="btn btn-info btn-sm" href="<?php echo app_url('invoicepercustomer','view','view',array('id'=>$orders->id))?>" title="invoicepercustomer"><i class="fa fa-pencil"></i>Rechnung pro Kunde</a></td>
		<td><a class="btn btn-info btn-sm" href="<?php echo app_url('offerBusiness','view','view',array('id'=>$orders->id))?>" title="invoice"><i class="fa fa-pencil"></i>Angebot (Firmenkunden) erstellen</a><br></td>
	<td><a class="btn btn-info btn-sm" href="<?php echo app_url('shippinglabel','view','view',array('id'=>$orders->id))?>" title="shippinglabel"><i class="fa fa-pencil"></i>Versandetikett drucken</a></td>
	<td><a class="btn btn-info btn-sm" href="<?php echo app_url('badgesplaced','view','view',array('id'=>$orders->user_id,'orderid'=>$app['GET']['id']))?>" title="badgesplaced"><i class="fa fa-pencil"></i>Spangen anzeigen</a></td>
	</tr>
	<td></td>
	<tr>
		<td><a class="btn btn-info btn-sm" href="<?php echo app_url('storno','view','view',array('id'=>$orders->id))?>" title="storno"><i class="fa fa-pencil"></i>Stornorechnung erstellen</a></td>
		<td><a class="btn btn-info btn-sm" href="<?php echo app_url('offer_withoutsum','view','view',array('id'=>$orders->id))?>" title="invoice"><i class="fa fa-pencil"></i>Angebot (ohne Summe) erstellen</a></td>
		<td><a class="btn btn-info btn-sm" href="<?php echo app_url('packinglabels','view','view',array('id'=>$orders->id))?>" title="packinglabels"><i class="fa fa-pencil"></i>Packetiketten drucken</a></td>
	<td><a class="btn btn-info btn-sm" href="<?php echo app_url('orderconfirmation','view','view',array('id'=>$orders->id))?>" title="orderconfirmation"><i class="fa fa-pencil"></i>AB</a></td>
		<td></td>
	</tr>
	<tr>
		<td><a class="btn btn-info btn-sm" href="<?php echo app_url('invoiceIGErwerb','view','view',array('id'=>$orders->id))?>" title="invoiceIGErwerb"><i class="fa fa-pencil"></i>Rechnung IG Erwerb</a></td>
		<td><a class="btn btn-info btn-sm" href="<?php echo app_url('offerpercustomer','view','view',array('id'=>$orders->id))?>" title="offerpercustomer"><i class="fa fa-pencil"></i>Angebot pro Kunde erstellen</a></td>
		<td></td>
		<td><a class="btn btn-info btn-sm" href="<?php echo app_url('paymentreminder','view','view',array('id'=>$orders->id))?>" title="paymentreminder"><i class="fa fa-pencil"></i>Mahnung</a></td>
		<td></td>
	</tr>
	<tr>
		<td><a class="btn btn-info btn-sm" href="<?php echo app_url('invoiceAusland','view','view',array('id'=>$orders->id))?>" title="invoiceAusland"><i class="fa fa-pencil"></i>Rechnung Nicht EU</a></td>
		<td></td>
		<td></td>
		<td><a class="btn btn-info btn-sm" href="<?php echo app_url('paymentreminder_last','view','view',array('id'=>$orders->id))?>" title="paymentreminder"><i class="fa fa-pencil"></i>Letzte Mahnung</a></td>
		<td></td>
	</tr>
</table>


                              
                            
                        	<?php
				if(empty($otherunfinishedorders)==false)
				{
					echo '<div style="color:red; font-size: larger;">';
					echo '<br>';
					foreach($otherunfinishedorders as $otherunfinishedorder)
					{
					echo 'ACHTUNG: Andere offene Lieferung in <a href=';
					echo app_url('orders','view','view',array('id'=>$otherunfinishedorder->id));                                    			echo '>'.$otherunfinishedorder->id.'</a><br>';
					}
					echo '</div>';
				}
				?>    
                            

                            
                        	<?php
				if($orders->is_order_valid==0)
				{
					echo '<div style="color:red; font-size: larger;">';
					echo '<br>';
					echo 'ACHTUNG: BESTELLUNG IST UNGUELITG GESETZT';
					echo '</div>';
				}
				?>                               
                            
                            


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
                                                        <div class="col-md-5 name"> Payment Method: </div>
                                                        <div class="col-md-7 value">
                                                            <select name="payment_method_name">
                                                                <option value="Sofort" <?php echo ($orders->payment_method_name == "Sofort"?'selected':'');?>>Sofort</option>
                                                                <option value="onaccount" <?php echo ($orders->payment_method_name == "onaccount"?'selected':'');?>>onaccount</option>
                                                                <option value="Paypal" <?php echo ($orders->payment_method_name == "Paypal"?'selected':'');?>>Paypal</option>
                                                                <option value="banktransfer" <?php echo ($orders->payment_method_name == "banktransfer"?'selected':'');?>>banktransfer</option>
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
                                                        <div class="col-md-5 name"> Shipment plan: </div>
                                                        <div class="col-md-7 value">
                                                            <select name="shipmenttarif">
                                                                <option value="28" <?php echo ($orders->shipmenttarif == 28?'selected':'');?>>Retourpaket</option>
                                                                <option value="63" <?php echo ($orders->shipmenttarif == 63?'selected':'');?>>Retourpaket International</option>
                                                                <option value="14" <?php echo ($orders->shipmenttarif == 14?'selected':'');?>>Premium light</option>
                                                                <option value="30" <?php echo ($orders->shipmenttarif == 30?'selected':'');?>>Premium Select</option>
                                                                <option value="12" <?php echo ($orders->shipmenttarif == 12?'selected':'');?>>Kleinpaket</option>
                                                                <option value="65" <?php echo ($orders->shipmenttarif == 65?'selected':'');?>>Next Day</option>
                                                                <option value="10" <?php echo ($orders->shipmenttarif == 10?'selected':'');?>>Paket Österreich</option>
                                                                <option value="45" <?php echo ($orders->shipmenttarif == 45?'selected':'');?>>Paket Premium International</option>
                                                                <option value="47" <?php echo ($orders->shipmenttarif == 47?'selected':'');?>>Combi-freight Österreich</option>
                                                                <option value="49" <?php echo ($orders->shipmenttarif == 49?'selected':'');?>>Combi-freight International</option>
                                                                <option value="31" <?php echo ($orders->shipmenttarif == 31?'selected':'');?>>Paket Premium Österreich B2B</option>
                                                                <option value="1" <?php echo ($orders->shipmenttarif == 1?'selected':'');?>>Post Express Österreich</option>
                                                                <option value="46" <?php echo ($orders->shipmenttarif == 46?'selected':'');?>>Post Express International</option>
                                                                <option value="78" <?php echo ($orders->shipmenttarif == 78?'selected':'');?>>Päckchen M mit Sendungsverfolgung</option>
                                                                <option value="70" <?php echo ($orders->shipmenttarif == 70?'selected':'');?>>Paket Plus Int. Outbound</option>
                                                                <option value="69" <?php echo ($orders->shipmenttarif == 69?'selected':'');?>>Paket Light Int. non boxable Outbound</option>
                                                                <option value="96" <?php echo ($orders->shipmenttarif == 96?'selected':'');?>>Kleinpaket 2000</option>
                                                                <option value="16" <?php echo ($orders->shipmenttarif == 16?'selected':'');?>>Kleinpaket 2000 Plus</option>
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
                                                        <div class="col-md-5 name"> Downpayment: </div>
                                                        <div class="col-md-7 value">
                                                            <select name="downpayment">
                                                                <option value="0" <?php echo ($orders->downpayment == 0?'selected':'');?>>0 %</option>
                                                                <option value="30" <?php echo ($orders->downpayment == 30?'selected':'');?>>30 %</option>
                                                                <option value="40" <?php echo ($orders->downpayment == 40?'selected':'');?>>40 %</option>
                                                                <option value="50" <?php echo ($orders->downpayment == 50?'selected':'');?>>50 %</option>
                                                            </select>
                           					<a class="btn btn-info btn-sm" href="<?php echo app_url('invoicedownpayment','view','view',array('id'=>$orders->id))?>" title="invoicedownpayment"><i class="fa fa-pencil"></i>Anzahlungsrechnung erstellen</a>

                                                        </div>

                                                    </div>


                                                    <div class="row static-info">
                                                        <div class="col-md-5 name"> Comment: </div>
                                                        <div class="col-md-7 value">
                                                            <input type="text" name="comment" style="color: red; font-size: larger;" value="<?php echo $orders->comment ?>">
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




                                                    <div class="row static-info">
                                                        <div class="col-md-5 name"> Order category </div>
                                                        <div class="col-md-7 value">
                                                            <select name="is_special">
                                                                <option value="0" <?php echo ($orders->is_special == "0"?'selected':'');?>>Standard</option>
     								<option value="1" <?php echo ($orders->is_special == "1"?'selected':'');?>>Sonderproduktion</option>
                                                            </select>
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
                                                    <div class="row static-info">
                                                        <div class="col-md-5 name"> Comment: </div>
                                                        <div class="col-md-7 value" style="color:red;font-size:16px;"><?php echo $trust->comment;?></div>
                                                    </div>


                                                </div>
                                            </div>



                                        </div>

                        <div class="col-md-6 col-sm-12">
                 
                                <div class="portlet yellow-crusta box">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-cogs"></i><?php _e("Order Comment"); ?> </div>
                                        <div class="actions"></div>
                                    </div>
                                    <div class="portlet-body" >
					
                                             <textarea style="width: 100%" rows="6"  name="order_comment"><?php echo $orders->order_comment ?></textarea>
					
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
				<label>Strasse</label> <br>
				<input type="text" name="billing_address1" value="<?php echo $orders->billing_address1; ?>">
				<br>
				<label>Hausnummer</label> <br>
				<input type="text" name="billing_address2" value="<?php echo $orders->billing_address2; ?>">
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
				<label>Strasse</label> <br>
				<input type="text" name="shipping_address1" value="<?php echo $orders->shipping_address1; ?>">
				<br>
				<label>Hausnummer</label> <br>
				<input type="text" name="shipping_address2" value="<?php echo $orders->shipping_address2; ?>">
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
                            <a class="btn btn-info btn-sm" href="<?php echo app_url('setallitemsinactive','view','view',array('id'=>$orders->id))?>" title="invoice"><i class="fa fa-pencil"></i>Set all items inactive</a>
                                                    <div class="table-responsive">
                                                        <table class="table table-hover table-bordered table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th>Pos</th>
                                                                    <th>Inactive</th>
                                                                    <th>Product</th>
                                                                    <th>Name</th>
                                                                    <th>Original Price</th>
                                                                    <th>Quantity </th>^
                                                                    <th>Quantity initial</th>
                                                                    <th>Total </th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                   foreach ($orders_item as $order_item) 
									{
                                                                   	$color="#DDDDFF";


										foreach($customer_order_items as $customer_order_item)
										{
											if($order_item->customer_id==$customer_order_item->customer_id && $orders->id>$customer_order_item->order_id)
											{

												$color="#FFFFFF";
												break;
											}
										}

									if($order_item->inactive=="1")
									{
										$color="#CCCCCC";
									}

 ?>
                                                                    <tr  style="background-color: <?php echo $color;?>">
				
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
                                                                            <td><?php echo "[".$order_item->product_id."]".$order_item->batch_name."\n".UTFencoder("Empfänger: "). UTFencoder($order_item->firstname)." ".UTFencoder($order_item->lastname)."[".$order_item->customer_id."]"."[".$order_item->id."]"; ?></td>


 <td><input type="text" name="unit_price_<?php echo $order_item->id; ?>" value="<?php echo $order_item->unit_price; ?>"></td>
 <td><input type="text" name="quantity_<?php echo $order_item->id; ?>" value="<?php echo $order_item->quantity; ?>"></td>
 <td><?php echo $order_item->quantity_initial; ?></td>
                                                                            <td><?php echo show_price($order_item->unit_price * $order_item->quantity); ?></td>
                                                                        </tr>
                                                                <?php } ?>
                                                            </tbody>
                                                        </table>
							 <table class="table table-hover table-bordered table-striped">
                                                            <thead>
                                                                <tr>
                                                                    <th>Item ID</th>
                                                                    <th>Customer ID</th>
                                                                    <th>Price</th>
                                                                    <th>Qty</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>

								<tr>Experimentell: Neues Item hinzufügen</tr>
								<tr>
									<td><input type="text" name="ItemToAdd_ID" value="0"> </td>
									<td><input type="text" name="ItemToAdd_customerID" value="0"></td>
									<td><input type="text" name="ItemToAdd_Price" value="0"> </td>
									<td><input type="text" name="ItemToAdd_Qty" value="0"></td>
								</tr>

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
                  <option value="0.5" <?php echo ($orders->discount == 0.5?'selected':'');?>>50 %</option>
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
                  	<option value="5.20" <?php echo ($orders->total_shipping_amount == 5.20?'selected':'');?>><?php echo show_price(5.20); ?></option>
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

            <div class="col-md-8 name">Gutschrift</div>
		<div class="col-md-3 value">
		<input type="text" name="creditnote" value="<?php echo $orders->creditnote; ?>">
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


