


<div class="container">


    <div class="row">
        <div class="col-md-12">
            <h1 class="cart-hdng"><?php _e("Cart"); ?></h1>


        </div>
        <div id="no-more-tables">
            <form id="login-form" action="<?php echo make_url("cart4admin")?>" method="post" role="form" style="display: block;">



            <table class="col-md-12 table-bordered table-striped table-condensed cf">


                <thead class="cf">
                    <tr>
                        <th><?php _e("Product"); ?></th>
                        <th class="numeric"><?php _e("Quantity"); ?></th>
                        <th class="numeric"><?php _e("Price"); ?></th>
                        <th class="numeric"><?php _e("Total"); ?></th>
                        <th class="numeric">&nbsp; </th>
                    </tr>
                </thead>
                <tbody>
                    
                <?php
                    $customer_name = "";
                    foreach ($cart_items as $record)
                    {
                        if($customer_name!=  $record['customer_name'])
                        {
                            echo '<tr><td colspan="5" class="c-name">';
                            echo $record['customer_name'].'</td>'.'</tr>';
                            
                            foreach  ($customer_items as $customer)
			                 {
                                if($customer->customer_id==$record['customer_id'])
                                {
	
					$total = $customer->NumberOfItems;
					$tempvar1=$total%3;
					$tempvar2=$total-$tempvar1;
					$tempvar3=$tempvar2*2/3;


	
					//$tempvar4=$sign($tempvar1);
					if($tempvar1==0)
					{
						$tempvar4=0;
					}
						else if($tempvar1<0)
					{
						$tempvar4=-1;
					}
						else if($tempvar1>0)
			{
				$tempvar4=1;
			}

			//$sign($tempvar3)
			if($tempvar3==0)
			{
				$tempvar8=0;
			}
			else if($tempvar3<0)
			{
				$tempvar8=-1;
			}
			else if($tempvar3>0)
			{
				$tempvar8=1;
			}
			//$sign($total-3)
			if($total-3==0)
			{
				$tempvar9=0;
			}
			else if($total-3<0)
			{
				$tempvar9=-1;
			}
			else if($total-3>0)
			{
				$tempvar9=1;
			}



			//sign(3*$tempvar8+$tempvar1-1)
			if(3*$tempvar8+$tempvar1-1==0)
			{
				$tempvar10=0;
			}
			else if(3*$tempvar8+$tempvar1-1<0)
			{
				$tempvar10=-1;
			}
			else if(3*$tempvar8+$tempvar1-1>0)
			{
				$tempvar10=1;
			}


			$tempvar5=$tempvar10;
			$tempvar6=$tempvar3+$tempvar4;

			$LConnectors = $tempvar5+$tempvar6-1;

			$QConnectors = (($total-3)+($total-3)*$tempvar9)/2;
			if($total==4 || $total==7 || $total==10 || $total==13 || $total==16)
			{
				$QConnectors =$QConnectors +1;	
			}

			if($total<8)
			{
				$nails=2;
			}
			else
			{
				$nails=4;
			}
			echo "<tr><td> Dieser Kunde hat ".$customer->NumberOfItems. " Auszeichnungen."; 
			echo 'F&uumlr diese Spange ben&oumltigen Sie ' .$LConnectors .  ' L&aumlngsverbinder und '.$QConnectors . ' Querverbinder. Wir empfehlen ' . $nails . ' N&aumlgel. Bitte passen Sie die St&uumlckzahlen im Warenkorb an. </td></tr>';

			}
			                 }
                            
                            $customer_name = $record['customer_name'];
                        }
                            
                            
                        echo '<tr>';
                        echo '<td data-title="Product">';
                        echo show_ribbon_images($record['type'],$record['batch_image'],$record['number'],$record['country'],$record['product_id']);
                        echo $record['ribbon_name_en'];
                        echo '</td>';
                        echo '<td data-title="Quantity" class="numeric quant" >';

     //                   if ($record['level']=='6')
   //                     {
                            echo '<select name="quant['.$record['id'].']" onchange="this.form.submit()">';
                            for ($i=0; $i<=100;$i++)
                            {
                            	echo '<option value='. $i;
                            	if( $record['quantity'] == $i)
                           	 { 
                           	     echo ' selected="selected" ';
                         	   }

                           	     echo ' >';

                        	    echo $i;
                         	   echo '</option>';
                            }
                                echo '</select>';
       //                 }
   //                    else
   //                     {
  //                          echo $record['quantity'];
   //                     }
                    



                        echo '<input type="hidden"  name="price[' . $record['id'].']" value=' . $record['unit_price'].'>';
                        echo '<td data-title="Price" class="numeric">';
                        echo show_price($record['unit_price']);
                        echo '</td>';
                        echo '<td data-title="Total" class="numeric">';
                        echo show_price($record['total_price_tax_excl']);
                        echo '</td>';
                        echo '<td data-title="" class="numeric">';
                        echo '<a href="javascript:void(0);" class="btn btn-danger btn-sm del_cart" data-value=' . $record['id'] . '><i class="fa fa-trash-o"></i></a>';	
                        echo '</td>';
                        echo '</tr>';
                        
                    }
                    ?>
                            
    <?php               

	$discount=$cart_detail->discount;             
	echo '<tr>';
                   echo '<td  colspan="4" class="text-right"><h3>';
                    echo _e('Total');
                    echo '</h3></td>';
                    echo '<td class="text-right"><h3>';
                    echo show_price(get_total());
                    echo '</h3></td>';
	echo '</tr>';

	if($discount<>0)
	{
                echo  "<tr>";
                echo  '<td  colspan="4" class="text-right"><h3>';
                echo get_discount_string();
                echo '</h3></td>';
                echo  '<td class="text-right"><h3><strong>';
                echo show_price(get_total()*(1-$discount));
                echo '</strong></h3></td>';
                echo  '</tr>';
	}

                    
                    
?>
                    <tr>
                        <td  colspan="4" class="text-right"><h3><?php _e('ShippingCost');?></h3></td>
                        <td class="text-right"><h3><?php echo show_price(shipingCost());?></h3></td>
                    </tr>
                    <tr>
                        <td  colspan="4" class="text-right"><h3><?php _e('TotalShipping');?></h3></td>
                        <td class="text-right"><h3><strong><?php echo show_price(get_total()*(1-$discount)+shipingCost()); ?></strong></h3></td>
                    </tr>
                    <tr>
                        <td  colspan="4" class="text-right"><h3>Voraussichtliche Lieferzeit:</h3></td>

                        <td class="text-right"><h3><strong>
<?php if(get_discount_string()=='') {echo '2 Tage nach Zahlungseingang';}else{echo 'ab 01.02.2018';}?></strong></h3></td>
                    </tr>

                    <tr>
                        <td  colspan="6" class="text-right">
                            <a class="btn cart-slct pull-left" href='<?php echo make_url("shop"); ?>'><i class="fa fa-angle-left"></i> <?php _e('Shop')?></a>
		
                            <button type='submit' name='clear' class="btn btn-info btn-sm update_quantity"><?php _e('Clear');?> <i class="fa fa-trash-o" aria-hidden="true"></i></button>
                                <a href='<?php echo make_url("checkout"); ?>' class="btn cart-slct"><?php _e('Checkout');?> <i class="fa fa-angle-right"></i></a>
                        </td>
                    </tr>
                </tbody>
            </table>
              </form>  
        </div>
    </div>
</div>
