<div class="filter-bar sampewr bg-body md:py-7 py-4 flex w-full">
    <div class="container-custom">
        <h1 class="md:text-3xl text-lg font-gothic text-black text-center"><?php _e("My Orders") ?></h1>
    </div>
</div>
<div class="ac-onword md:py-20 py-5">
    <div class="container-custom">
         
        <?php include_once (DIR_FS_VIEW_TEMPLATES . 'sidebar_navigation.php'); ?>
        
        <?php if ($id == '') { ?>
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title md:text-3xl text-xl text-black font-gothic my-5"><?php _e("Your Orders"); ?></h3>
                    </div>
                    <div class="bg-body rounded-[20px] border border-[#d9d9d9] p-5 xl:overflow-visible overflow-x-auto">
                        <table class="table table-hover xl:w-full w-[1600px] md:table-fixed table-auto" id="dev-table">
                            <thead>
                                <tr>
                                    <th class="text-left text-black pe-4 capitalize pb-3 md:text-lg text-base  font-semibold"><?php _e("Sr no."); ?></th> 
                                    <th class="text-left text-black pe-4 capitalize pb-3 md:text-lg text-base  font-semibold"><?php _e("First Name"); ?></th> 
                                    <th class="text-left text-black pe-4 capitalize pb-3 md:text-lg text-base  font-semibold"><?php _e("Last Name"); ?></th> 
                                    <th class="text-left text-black pe-4 capitalize pb-3 md:text-lg text-base  font-semibold"><?php _e("Email"); ?></th> 
                                    <th class="text-left text-black pe-4 capitalize pb-3 md:text-lg text-base  font-semibold"><?php _e("Amount"); ?></th> 
                                    <th class="text-left text-black pe-4 capitalize pb-3 md:text-lg text-base  font-semibold"><?php _e("Date"); ?></th> 
                                    <th class="text-left text-black pe-4 capitalize pb-3 md:text-lg text-base  font-semibold"><?php _e("action"); ?></th>
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
                                            <td class="border-b border-[#d9d9d9] md:py-4 py-2.5 text-secondary font-medium md:text-base text-sm pe-4"><?php echo ++$count; ?></td>

                                            <td class="border-b border-[#d9d9d9] md:py-4 py-2.5 text-secondary font-medium md:text-base text-sm pe-4"><?php echo $order['billing_firstname']; ?></td>
                                            <td class="border-b border-[#d9d9d9] md:py-4 py-2.5 text-secondary font-medium md:text-base text-sm pe-4"><?php echo $order['billing_lastname']; ?></td>
                                            <td class="border-b border-[#d9d9d9] md:py-4 py-2.5 text-secondary font-medium break-all md:text-base text-sm pe-4"><?php echo $order['billing_email']; ?></td>
                                            <td class="border-b border-[#d9d9d9] md:py-4 py-2.5 text-secondary font-medium md:text-base text-sm pe-4"><?php echo show_price($order['grand_total']*(1-$order['discount'])+$order['total_shipping_amount']); ?></td>
                                            <td class="border-b border-[#d9d9d9] md:py-4 py-2.5 text-secondary font-medium md:text-base text-sm pe-4"><?php echo show_date($order['date_add']); ?></td>
                                            <td class="border-b border-[#d9d9d9] md:py-4 py-2.5 text-secondary font-medium md:text-base text-sm pe-4">
                                                <a class="btn btn-info btn-sm min-w-12 h-10 bg-white rounded-lg border border-[#d9d9d9] inline-flex justify-center items-center" href="<?php echo make_url('orders', array('id' => $order['id'])); ?>" title="<?php _e('details'); ?>"><svg width="20" height="20" class="pointer-events-none" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><g clip-path="url(#clip0_714_1751)">
                                                <path d="M9.16602 3.33332H3.33268C2.89065 3.33332 2.46673 3.50891 2.15417 3.82147C1.84161 4.13403 1.66602 4.55796 1.66602 4.99999V16.6667C1.66602 17.1087 1.84161 17.5326 2.15417 17.8452C2.46673 18.1577 2.89065 18.3333 3.33268 18.3333H14.9993C15.4414 18.3333 15.8653 18.1577 16.1779 17.8452C16.4904 17.5326 16.666 17.1087 16.666 16.6667V10.8333M15.416 2.08332C15.7475 1.7518 16.1972 1.56555 16.666 1.56555C17.1349 1.56555 17.5845 1.7518 17.916 2.08332C18.2475 2.41484 18.4338 2.86448 18.4338 3.33332C18.4338 3.80216 18.2475 4.2518 17.916 4.58332L9.99935 12.5L6.66602 13.3333L7.49935 9.99999L15.416 2.08332Z" stroke="#393C40" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></g><defs><clipPath id="clip0_714_1751"><rect width="20" height="20" fill="white"></rect></clipPath></defs></svg></a>
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
            
            <?php include_once (DIR_FS_VIEW_TEMPLATES . 'sidebar_navigation.php'); ?>
            
            <div class="w-full mt-5">
                <div class="flex justify-end mb-5">
                    <a href="<?php echo make_url('orders'); ?>"><button type="submit" name="update" class="all-cat add-btn righter min-h-[38px] text-sm px-4 hover:bg-primary text-white cursor-pointer rounded-md font-medium bg-secondary"><?php _e('Back To Orders');?></button></a>
                </div>
                <div class="tab-content">
                    <div class="tab-pane flex flex-col lg:gap-14 md:gap-10 gap-5 active" id="tab_1">
                        <div class="flex lg:flex-nowrap flex-wrap md:gap-10 gap-5">
                          <div class="lg:w-[70%] w-full flex flex-col md:gap-10 gap-5">
                            <div class="flex sm:flex-nowrap flex-wrap md:gap-10 gap-5">
                                <div class="sm:w-1/2 w-full">
                                    <div class="portlet yellow-crusta box flex flex-col gap-5 h-full">
                                        <div class="portlet-title panel-title md:text-3xl text-xl text-black font-gothic">
                                            <div class="caption">
                                                <?php _e("Order Details"); ?> 
                                            </div>
                                            <div class="actions"></div>
                                        </div>
                                        <div class="portlet-body bg-body rounded-[20px] border border-[#d9d9d9] p-5 flex-1 flex flex-wrap gap-5">
                                            <div class="static-info flex flex-col gap-2.5 w-full xl:w-[calc(50%-10px)] ">
                                                <div class="name text-sm text-black font-normal"><?php _e(" Order #:"); ?> </div>
                                                <div class="value font-medium text-secondary text-base"><?php echo $orders->id; ?>

                                                </div>
                                            </div>
                                            <div class="static-info flex flex-col gap-2.5 w-full xl:w-[calc(50%-10px)]">
                                                <div class="name text-sm text-black font-normal"><?php _e(" Order Date &amp; Time:"); ?> </div>
                                                <div class="value font-medium text-secondary text-base"><?php echo show_datetime($orders->date_add); ?></div>
                                            </div>

                                            <div class="static-info flex flex-col gap-2.5 w-full xl:w-[calc(50%-10px)]">
                                                <div class="name text-sm text-black font-normal"><?php _e(" Grand Total:"); ?> </div>
                                                <div class="value font-medium text-secondary text-base"><?php echo show_price($orders->grand_total*(1-$orders->discount)+$orders->total_shipping_amount); ?></div>
                                            </div>
                                            <div class="static-info flex flex-col gap-2.5 w-full xl:w-[calc(50%-10px)]">
                                                <div class="name text-sm text-black font-normal"><?php _e(" Payment Information:"); ?> </div>
                                                <div class="value font-medium text-secondary text-base"><?php if ($orders->is_payment_made == 0) {
                                                    _e("Payment Pending");
                                                } else if ($orders->is_payment_made == 1) {
                                                    _e("Payment Done");
                                                } ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="sm:w-1/2 w-full">
                                    <div class="portlet blue-hoki box flex flex-col gap-5 h-full">
                                        <div class="portlet-title">
                                            <div class="caption panel-title md:text-3xl text-xl text-black font-gothic">
                                                <?php _e("Customer Information");?> 
                                            </div>
                                            <div class="actions"></div>
                                        </div>
                                        <div class="portlet-body bg-body rounded-[20px] border border-[#d9d9d9] p-5 flex-1 flex flex-wrap gap-5">
                                            <div class="flex flex-col gap-2.5 w-full xl:w-[calc(50%-10px)] static-info">
                                                <div class="name font-normal text-black text-sm"><?php _e("Customer Name:"); ?> </div>
                                                <div class="font-medium text-secondary text-base value"><?php echo $orders->billing_firstname.' '.$orders->billing_lastname; ?></div>
                                            </div>
                                            <div class="flex flex-col gap-2.5 w-full xl:w-[calc(50%-10px)] static-info">
                                                <div class="name font-normal text-black text-sm"><?php _e(" Email:"); ?> </div>
                                                <div class="font-medium text-secondary text-base break-all value"><?php echo $orders->billing_email; ?></div>
                                            </div>
                                            <div class="flex flex-col gap-2.5 w-full xl:w-[calc(50%-10px)] static-info">
                                                <div class="name font-normal text-black text-sm"><?php _e(" Phone Number:"); ?> </div>
                                                <div class="font-medium text-secondary text-base value"><?php echo $orders->billing_mobile; ?></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex sm:flex-nowrap flex-wrap md:gap-10 gap-5">
                                <div class="sm:w-1/2 w-full">
                                    <div class="portlet green-meadow box flex flex-col gap-5 h-full">
                                        <div class="portlet-title">
                                            <div class="caption panel-title md:text-3xl text-xl text-black font-gothic">
                                                <?php _e(" Billing Address"); ?> 
                                            </div>
                                        </div>
                                        <div class="portlet-body bg-body rounded-[20px] border border-[#d9d9d9] p-5 flex-1 flex flex-wrap gap-5">
                                            <div class="static-info">
                                                <div class="value text-base text-secondary">
                                                    <?php echo $orders->billing_company; ?>
                                                    <br><?php echo $orders->billing_firstname; ?>  <?php echo $orders->billing_lastname; ?>
                                                    <br><?php echo $orders->billing_address1 . ' ' . $orders->billing_address2; ?>
                                                    <br><?php echo  $orders->billing_zip . ' ' . $orders->billing_city; ?>
                                                    <br><?php echo $orders->billing_mobile; ?>
                                                    <br><?php echo $orders->billing_email; ?>
                                                    <br> </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="sm:w-1/2 w-full">
                                    <div class="portlet red-sunglo box flex flex-col gap-5 h-full">
                                        <div class="portlet-title">
                                            <div class="caption panel-title lg:text-3xl text-xl text-black font-gothic">
                                                <?php _e('Shipping Address');?> </div>
                                            <div class="actions"></div>
                                        </div>
                                        <div class="portlet-body bg-body rounded-[20px] border border-[#d9d9d9] p-5 flex-1 flex flex-wrap gap-5">
                                            <div class="static-info">
                                                <div class="value text-base text-secondary">
                                                <?php echo $orders->shipping_company; ?>
                                                    <br><?php echo $orders->shipping_firstname; ?> <?php echo $orders->shipping_lastname; ?>
                                                    <br><?php echo $orders->shipping_address1 . ' ' . $orders->shipping_address2; ?>
                                                    <br><?php echo  $orders->shipping_zip . ' ' . $orders->shipping_city; ?>
                                                    <br><?php echo $orders->shipping_mobile; ?>
                                                    <br><?php echo $orders->shipping_email; ?>
                                                    <br> </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                          </div>
                          <div class="well lg:w-[30%] w-full lg:mt-14">
                            <div class="bg-body rounded-[20px] border border-[#d9d9d9] p-5 flex-1 flex flex-col gap-5 h-full">
                                <div class="static-info align-reverse">
                                    <div class="flex gap-2.5 justify-between mb-5 text-sm text-secondary font-normal">
                                        <div class="name"><?php _e(" Grand Total:"); ?> </div>
                                        <div class="value"><?php echo show_price($orders->grand_total); ?></div>
                                    </div>

                                        <?php
                                            if ($orders->discount<>0){
                                            echo '<div class="flex gap-2.5 justify-between mb-5 text-sm text-secondary font-normal"> <div class="name">';
                                            echo _e("TotalDisc") . " ( Minus " . $orders->discount *100 . "% " . " ) </div>";
                                            echo '<div class="value">';
                                            echo show_price($orders->grand_total*(1-$orders->discount)) . ' </div> </div>';
                                            }
                                        ?>
                                        <div class="flex gap-2.5 justify-between mb-5 text-sm text-secondary font-normal">
                                           <div class="name"><?php _e("ShippingCost"); ?> </div>
                                            <div class="value"><?php echo show_price($orders->total_shipping_amount); ?></div>
                                        </div>
                                        <div class="flex gap-2.5 justify-between text-sm text-secondary font-normal">
                                           <div class="name"><strong><?php _e("TotalShipping"); ?> </strong></div>
                                            <div class="value"><?php echo show_price($orders->grand_total*(1-$orders->discount)+$orders->total_shipping_amount); ?></div>
                                        </div>
                                </div>
                                <?php //pr($orders->is_payment_made); ?>
                                <div class="row static-info align-reverse">
                                    <div class="flex gap-2.5 justify-between text-sm text-secondary font-normal">
                                        <div class="name"><?php _e(" Total Paid:"); ?> </div>
                                        <?php if ($orders->is_payment_made == 1) { ?>
                                            <div class="value"><?php echo show_price($orders->grand_total*(1-$orders->discount)+$orders->total_shipping_amount); ?></div>
                                        <?php } else { ?>
                                            <div class="value"><?php echo show_price('0'); ?></div>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="row static-info align-reverse">
                                    <div class="flex gap-2.5 justify-between text-sm text-secondary font-normal">
                                        <div class="name"><?php _e(" Total Due: "); ?></div>
                                        <?php if ($orders->is_payment_made == 1) { ?>
                                            <div class="value"><?php echo show_price('0'); ?></div>
                                        <?php } else { ?>
                                            <div class="value"><?php echo show_price($orders->grand_total*(1-$orders->discount)+$orders->total_shipping_amount); ?></div>
                                        <?php } ?>
                                    </div>
                                </div>
                               </div>
                            </div>
                        </div>
                            
                        <div class="portlet grey-cascade box flex flex-col gap-5">
                            <div class="portlet-title">
                                <div class="caption md:text-3xl text-xl text-black font-gothic">
                                    <?php _e("Shopping Cart"); ?></div>
                                <div class="actions"></div>
                            </div>
                            <div class="portlet-body bg-body rounded-[20px] border border-[#d9d9d9] p-5 flex-1 flex flex-wrap gap-5">
                                <div class="table-responsive w-full md:overflow-visible overflow-x-auto">
                                    <table class="table md:w-full w-[767px]">
                                        <thead>
                                            <tr>
                                                <th class="text-left text-black pe-4 capitalize pb-3 md:text-lg text-base font-semibold"><?php _e(" Product Image"); ?></th>
                                                <th class="text-left text-black pe-4 capitalize pb-3 md:text-lg text-base font-semibold"><?php _e(" Name"); ?></th>
                                                <th class="text-left text-black pe-4 capitalize pb-3 md:text-lg text-base font-semibold"><?php _e(" Original Price"); ?> </th>
                                                <th class="text-left text-black pe-4 capitalize pb-3 md:text-lg text-base font-semibold"><?php _e(" Quantity"); ?> </th>
                                                <th class="text-left text-black pe-4 capitalize pb-3 md:text-lg text-base font-semibold"><?php _e(" Total"); ?> </th>
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
                                                    <td class="md:text-base text-sm font-medium text-secondary md:py-4 py-2.5 pe-4">
                                                        <?php echo show_ribbon_images($order_item->type, $order_item->batch_image, $order_item->number, $order_item->country, $order_item->product_id); ?>
                                                    </td>
                                                    <td class="md:text-base text-sm font-medium text-secondary md:py-4 py-2.5 pe-4"><?php echo $order_item->batch_name; ?></td>
                                                    <td class="md:text-base text-sm font-medium text-secondary md:py-4 py-2.5 pe-4"><?php echo show_price($order_item->unit_price); ?></td>
                                                    <td class="md:text-base text-sm font-medium text-secondary md:py-4 py-2.5 pe-4"><?php echo $order_item->quantity; ?></td>
                                                    <td class="md:text-base text-sm font-medium text-secondary md:py-4 py-2.5 pe-4"><?php echo show_price($order_item->unit_price * $order_item->quantity); ?></td>
                                                </tr>
                                                <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        
                        <?php if(!empty($orders->order_comment)){ ?>
                        
                        <div class="portlet yellow-crusta box flex flex-col gap-5">
                            <div class="portlet-title">
                                <div class="caption text-xl md:text-3xl text-black font-gothic">
                                    <?php _e("Order Comment"); ?> </div>
                                <div class="actions"></div>
                            </div>
                            <div class="portlet-body bg-body rounded-[20px] border border-[#d9d9d9] p-5 flex-1 flex flex-wrap gap-5">
                            <?php echo $orders->order_comment; ?>  
                            </div>
                        </div>
                            
                        <?php } ?>
                    </div>
                </div>
            </div>
<?php } ?>
</div>
</div>
</div>     
