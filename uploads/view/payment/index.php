<?php if (isset($order_detail->payment_method_name) && $order_detail->payment_method_name == 'Sofort') { ?>
    <div style="position:relative;top: 80px" id="loading " align="center">
        <h3><?php _e('We are redirecting you to Sofort.....'); ?></h3>
        <img src="<?php echo DIR_WS_ASSETS_IMAGES; ?>loader.gif"/>
    </div>
    <form method="post" novalidate action="https://www.sofort.com/payment/start">
        <input name="amount" type="hidden" value="<?php echo isset($order_detail->grand_total) ? $order_detail->grand_total *(1-$order_detail->discount)+$order_detail->total_shipping_amount : ""; ?>"/>
        <input name="currency_id" type="hidden" value="EUR"/>
        <input name="reason_1" type="hidden" value="Ausgezeichnet.cc"/>
        <input name="reason_2" type="hidden" value="Ordensspangen"/>
        <input name="user_id" type="hidden" value="158105"/>
        <input name="user_variable_0" type="hidden" value="<?php echo isset($order_detail->id) ? $order_detail->id : ''; ?>"/>
        <input name="project_id" type="hidden" value="403745"/>
        <div class="text-center mt20">
            <span style="display: none"><button  type="submit" name="submit" class="btn btn-default send-btn" id="form_submit"><?php _e('BUY NOW'); ?></button></span>  
        </div>  
    </form>
<?php } else if (isset($order_detail->payment_method_name) && $order_detail->payment_method_name == 'banktransfer') { ?>
    <div style="position:relative;top: 80px" id="loading " align="center">
        <h3>Vielen Dank fuer Ihre Bestellung</h3>
	<div><p>Bitte &uumlberweisen Sie den Betrag von EUR <?php echo isset($order_detail->grand_total) ? $order_detail->grand_total * (1-$order_detail->discount)+$order_detail->total_shipping_amount : "";?> an untenstehendes Konto: </p></div>
	<p> IBAN: AT69 1420 0200 1097 0173</p>
	<p> BIC: EASYATW1</p>
	<p> Verwendungszweck: 10<?php echo $order_detail->id?></p>
        <a href='<?php echo make_url("payment", array('banktransfer'=>'1'));?>' class="plc-ordr all-cat add-btn hvr-float-shadow"><?php echo _e("Confirm"); ?></a>
	<br></br>
	
    </div>

<?php } else if (isset($order_detail->payment_method_name) && $order_detail->payment_method_name == 'onaccount') { ?>
    <div style="position:relative;top: 80px" id="loading " align="center">
        <h3>Vielen Dank fuer Ihre Bestellung 10<?php echo $order_detail->id?></h3>
	<div><p>Wir werden Ihre Bestellung bearbeiten und auf Rechnung zukommen lassen.</p></div>
        <a href='<?php echo make_url("payment", array('onaccount'=>'1'));?>' class="plc-ordr all-cat add-btn hvr-float-shadow"><?php echo _e("Confirm"); ?></a>
	<br></br>
	
    </div>

<?php 
} 
else 
{ ?>
    <div style="position:relative;top: 80px" id="loading " align="center">
        <h3><?php _e('We are redirecting you to Paypal.....'); ?></h3>
        <img src="<?php echo DIR_WS_ASSETS_IMAGES; ?>loader.gif"/>
    </div>
    <form action="<?php echo $paypal_url; ?>" id="frm1" name="paypal_form" method="POST">
        <input type="hidden" name="business" value="<?php echo isset($paypal_id) ? $paypal_id : ''; ?>">
        <input type="hidden" name="item_name" value="Ordensspangen">
        <input type="hidden" name="custom" value="<?php echo isset($order_detail->id) ? $order_detail->id : ''; ?>">
        <input type="hidden" name="currency_code" value="EUR">
        <input type="hidden" name="address_override" value="<?php echo isset($order_detail->shipping_address1) ? $order_detail->shipping_address1 : ''; ?>">
        <input type="hidden" name="amount" value="<?php echo isset($order_detail->grand_total) ? $order_detail->grand_total * (1-$order_detail->discount)+$order_detail->total_shipping_amount : ""; ?>">
        <input type="hidden" name="cmd" value="_xclick">
        <input type="hidden" name="tx" value="TransactionID">
        <input type="hidden" name="at" value="YourIdentityToken">
        <input type='hidden' name='return' value='<?php echo make_url("order_success", array('status' => '1', 'id' => $order_detail->id)); ?>'>
        <input type='hidden' name="notify_url" value='<?php echo make_url("listener") ?>'>
        <input type='hidden' name='cancel_return' value='<?php echo make_url("order_success", array('status' => '0', 'id' => $order_detail->id)); ?>'>
        <div class="text-center mt20">
            <span style="display: none"><button  type="submit" name="submit" class="btn btn-default send-btn" id="form_submit"><?php _e('BUY NOW'); ?></button></span>  
        </div>                               
    </form>
<?php }

?>
<script>
    $(document).ready(function () {
        $("#form_submit").trigger("click");
    });
</script>