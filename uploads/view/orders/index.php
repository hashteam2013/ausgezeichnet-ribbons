<div class="filter-bar sampewr">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <h1><?php _e("My Orders") ?></h1>
            </div>
        </div>
    </div>
</div>
<div class="container ac-onword">
    <div class="row">
        <div class="col-sm-4">
            <?php include_once (DIR_FS_VIEW_TEMPLATES . 'sidebar_navigation.php'); ?>
        </div>
        <?php if ($id == '') { ?>
            <div class="col-sm-8" >
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title"><?php _e("Your Orders"); ?></h3>
                    </div>
                    <table class="table table-hover" id="dev-table">
                        <thead>
                            <tr>
                                <th><?php _e("Sr no."); ?></th> 
                                <th><?php _e("First Name"); ?></th> 
                                <th><?php _e("Last Name"); ?></th> 
                                <th><?php _e("Email"); ?></th> 
                                <th><?php _e("Amount"); ?></th> 
                                <th><?php _e("Date"); ?></th> 
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $count = 0;
                            if (!empty($orders)) {
                                foreach ($orders as $order) {
			if($order['is_order_valid']=='1'){
                                    ?>
                                    <tr>
                                        <td><?php echo ++$count; ?></td>

                                        <td><?php echo $order['billing_firstname']; ?></td>
                                        <td><?php echo $order['billing_lastname']; ?></td>
                                        <td><?php echo $order['billing_email']; ?></td>
                                        <td><?php echo show_price($order['grand_total']*(1-$order['discount'])+$order['total_shipping_amount']); ?></td>
                                        <td><?php echo show_date($order['date_add']); ?></td>
                                        <td>
                                            <a class="btn btn-info btn-sm" href="<?php echo make_url('orders', array('id' => $order['id'])); ?>" title="<?php _e('details'); ?>"><i class="fa fa-pencil"></i><?php _e('More Detail'); ?></a>&nbsp;&nbsp;
                                        </td>
                                    </tr>
                                <?php
                                }
		}
                            } else {
                                ?>
                                <tr><td colspan="4"><?php _e("No orders yet"); ?></td></tr>
    <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <?php } else { ?>
            <div class="col-sm-4">
    <?php include_once (DIR_FS_VIEW_TEMPLATES . 'sidebar_navigation.php'); ?>
            </div>
            <div class="col-md-8 col-sm-8">
                <a href="<?php echo make_url('orders'); ?>"><button type="submit" name="update" class="all-cat add-btn righter hvr-float-shadow"><?php _e('Back To Orders');?></button></a>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab_1">
                        <div class="row">
                            <div class="col-md-6 col-sm-12">
                                <div class="portlet yellow-crusta box">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-cogs"></i><?php _e("Order Details"); ?> </div>
                                        <div class="actions"></div>
                                    </div>
                                    <div class="portlet-body">
                                        <div class="row static-info">
                                            <div class="col-md-5 name"><?php _e(" Order #:"); ?> </div>
                                            <div class="col-md-7 value"><?php echo $orders->id; ?>

                                            </div>
                                        </div>
                                        <div class="row static-info">
                                            <div class="col-md-5 name"><?php _e(" Order Date &amp; Time:"); ?> </div>
                                            <div class="col-md-7 value"><?php echo show_datetime($orders->date_add); ?></div>
                                        </div>

                                        <div class="row static-info">
                                            <div class="col-md-5 name"><?php _e(" Grand Total:"); ?> </div>
                                            <div class="col-md-7 value"><?php echo show_price($orders->grand_total*(1-$orders->discount)+$orders->total_shipping_amount); ?></div>
                                        </div>
                                        <div class="row static-info">
                                            <div class="col-md-5 name"><?php _e(" Payment Information:"); ?> </div>
                                            <div class="col-md-7 value"><?php if ($orders->is_payment_made == 0) {
                                                _e("Payment Pending");
                                            } else if ($orders->is_payment_made == 1) {
                                                _e("Payment Done");
                                            } ?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="portlet blue-hoki box">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-cogs"></i><?php _e("Customer Information");?> </div>
                                        <div class="actions">

                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <div class="row static-info">
                                            <div class="col-md-5 name"><?php _e("Customer Name:"); ?> </div>
                                            <div class="col-md-7 value"><?php echo $orders->billing_firstname.' '.$orders->billing_lastname; ?></div>
                                        </div>
                                        <div class="row static-info">
                                            <div class="col-md-5 name"><?php _e(" Email:"); ?> </div>
                                            <div class="col-md-7 value"><?php echo $orders->billing_email; ?></div>
                                        </div>
                                        <div class="row static-info">
                                            <div class="col-md-5 name"><?php _e(" Phone Number:"); ?> </div>
                                            <div class="col-md-7 value"><?php echo $orders->billing_mobile; ?></div>
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
                                            <i class="fa fa-cogs"></i><?php _e(" Billing Address"); ?> </div>
                                    </div>
                                    <div class="portlet-body">
                                        <div class="row static-info">
                                            <div class="col-md-12 value">
                                                <?php echo $orders->billing_company; ?>
			     <br><?php echo $orders->billing_firstname; ?>  <?php echo $orders->billing_lastname; ?>
                                                <br><?php echo $orders->billing_address1; ?>
                                                <br><?php echo  $orders->billing_zip . ' ' . $orders->billing_city; ?>
                                                <br><?php echo $orders->billing_mobile; ?>
                                                <br><?php echo $orders->billing_email; ?>
                                                <br> </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12">
                                <div class="portlet red-sunglo box">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-cogs"></i><?php _e('Shipping Address');?> </div>
                                        <div class="actions">

                                        </div>
                                    </div>
                                    <div class="portlet-body">
                                        <div class="row static-info">
                                            <div class="col-md-12 value">
                                             <?php echo $orders->shipping_company; ?>
			   <br><?php echo $orders->shipping_firstname; ?> <?php echo $orders->shipping_lastname; ?>
                                                <br><?php echo $orders->shipping_address1; ?>
                                                <br><?php echo  $orders->shipping_zip . ' ' . $orders->shipping_city; ?>
                                                <br><?php echo $orders->shipping_mobile; ?>
                                                <br><?php echo $orders->shipping_email; ?>
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
                                            <i class="fa fa-cogs"></i><?php _e("Shopping Cart"); ?></div>
                                        <div class="actions"></div>
                                    </div>
                                    <div class="portlet-body">
                                        <div class="table-responsive">
                                            <table class="table table-hover table-bordered table-striped">
                                                <thead>
                                                    <tr>
                                                        <th><?php _e(" Product Image"); ?></th>
                                                        <th><?php _e(" Name"); ?></th>
                                                        <th><?php _e(" Original Price"); ?> </th>
                                                        <th><?php _e(" Quantity"); ?> </th>
                                                        <th><?php _e(" Total"); ?> </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                  <?php
                                                    $count = 0;
                                                    $customer_name = "";
                                                    foreach ($orders_item as $order_item) {
                                                        $cust_name = $order_item->firstname . ' ' . $order_item->lastname;
                                                        if ($customer_name != $cust_name) {
                                                            ?>
                                                        <tr><td colspan="5" class="cust-name"><?php echo $cust_name; ?></td></tr>
                                                                    <?php $customer_name = $cust_name; ?>
                                                        <?php } ?>
                                                        <tr>
                                                            <td>
                                                                <?php echo show_ribbon_images($order_item->type, $order_item->batch_image, $order_item->number, $order_item->country, $order_item->product_id); ?>
                                                            </td>
                                                            <td><?php echo $order_item->batch_name; ?></td>
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
                        <?php if(!empty($orders->order_comment)){ ?>
                        <div class="row">
                        <div class="col-md-12 col-sm-12">
                                <div class="portlet yellow-crusta box">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-cogs"></i><?php _e("Order Comment"); ?> </div>
                                        <div class="actions"></div>
                                    </div>
                                    <div class="portlet-body">
                                      <?php echo $orders->order_comment; ?>  
                                    </div>
                                </div>
                        </div>
                        </div>
                        <?php } ?>
                        <div class="row">
                            <div class="col-md-6"> </div>
                            <div class="col-md-6">
                                <div class="well">
                                    <div class="row static-info align-reverse">
                                        <div class="col-md-8 name"><?php _e(" Grand Total:"); ?> </div>
                                        <div class="col-md-3 value"><?php echo show_price($orders->grand_total); ?></div>

<?php
			if ($orders->discount<>0){
			echo ' <div class="col-md-8 name">';
			echo _e("TotalDisc") . " ( Minus " . $orders->discount *100 . "% " . " ) </div>";
			echo '<div class="col-md-3 value">';
			echo show_price($orders->grand_total*(1-$orders->discount)) . ' </div>';
			}
?>

			<div class="col-md-8 name"><?php _e("ShippingCost"); ?> </div>
			<div class="col-md-3 value"><?php echo show_price($orders->total_shipping_amount); ?></div>
			<div class="col-md-8 name"><strong><?php _e("TotalShipping"); ?> </strong></div>
			<div class="col-md-3 value"><?php echo show_price($orders->grand_total*(1-$orders->discount)+$orders->total_shipping_amount); ?></div>
                                    </div>
                                        <?php //pr($orders->is_payment_made); ?>
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
                </div>
            </div>
<?php } ?>
</div>
</div>
</div>     
