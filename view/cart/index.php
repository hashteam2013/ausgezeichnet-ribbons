
<div class="flex flex-col gap-20">
    <div class="bg-body py-7 flex w-full">
        <div class="container-custom">
            <h1 class="cart-hdng text-3xl font-gothic text-black text-center"><?php _e("Cart"); ?></h1>
        </div>
    </div>

    <div class="flex w-full pb-24">
        <div class="container-custom">
        
            <div id="no-more-tables">
                <form id="cart-form"  action="<?php echo make_url("cart") ?>" method="post" role="form" class="flex gap-14 items-start">
                    <input type = "hidden" value="" name="conn_val" id="redirect_id">
                    <div class="bg-body rounded-[20px] border border-[#d9d9d9] p-5 w-2/3">
                        <table class="cf">
                            <thead class="cf">
                                <tr>
                                    <th  class="text-left text-black pe-4 capitalize pb-3 text-lg font-semibold"><?php _e("Product"); ?></th>
                                    <th class="numeric text-left text-black pe-4 capitalize pb-3 text-lg font-semibold"><?php _e("Quantity"); ?></th>
                                    <th class="numeric text-left text-black pe-4 capitalize pb-3 text-lg font-semibold"><?php _e("Price"); ?></th>
                                    <th class="numeric text-left text-black pe-4 capitalize pb-3 text-lg font-semibold"><?php _e("Total"); ?></th>
                                    <th class="numeric text-left text-black pe-4 capitalize pb-3 text-lg font-semibold"><?php _e("action"); ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $customer_name = "";
                                foreach ($cart_items as $record) {
                                    if ($customer_name != $record['customer_name']) {

                                        $customer_items = listBatch($record['customer_id']);
                                        if (is_array($customer_items))
                                        {
                                            $total = sizeof($customer_items)-2;
                                        }
                                        else
                                        {
                                            $total = 0;
                                        }

                                        echo '<tr><td colspan="5" class="c-name text-xl font-gothic text-black pb-2">';
                                        echo $record['customer_name'] . '</td>' . '</tr>';
                                                //     foreach ($customer_items as $customer) {
                                                //          if ($customer->customer_id == $record['customer_id']) {
                                                //          $total = $customer->NumberOfItems;
                                                $tempvar1 = $total % 3;
                                                $tempvar2 = $total - $tempvar1;
                                                $tempvar3 = $tempvar2 * 2 / 3;
                                                //$tempvar4=$sign($tempvar1);
                                                if ($tempvar1 == 0) {
                                                    $tempvar4 = 0;
                                                } else if ($tempvar1 < 0) {
                                                    $tempvar4 = -1;
                                                } else if ($tempvar1 > 0) {
                                                    $tempvar4 = 1;
                                                }
                                                //$sign($tempvar3)
                                                if ($tempvar3 == 0) {
                                                    $tempvar8 = 0;
                                                } else if ($tempvar3 < 0) {
                                                    $tempvar8 = -1;
                                                } else if ($tempvar3 > 0) {
                                                    $tempvar8 = 1;
                                                }
                                                //$sign($total-3)
                                                if ($total - 3 == 0) {
                                                    $tempvar9 = 0;
                                                } else if ($total - 3 < 0) {
                                                    $tempvar9 = -1;
                                                } else if ($total - 3 > 0) {
                                                    $tempvar9 = 1;
                                                }
                                                //sign(3*$tempvar8+$tempvar1-1)
                                                if (3 * $tempvar8 + $tempvar1 - 1 == 0) {
                                                    $tempvar10 = 0;
                                                } else if (3 * $tempvar8 + $tempvar1 - 1 < 0) {
                                                    $tempvar10 = -1;
                                                } else if (3 * $tempvar8 + $tempvar1 - 1 > 0) {
                                                    $tempvar10 = 1;
                                                }
                                                $tempvar5 = $tempvar10;
                                                $tempvar6 = $tempvar3 + $tempvar4;

                                                $LConnectors = $tempvar5 + $tempvar6 - 1;

                                                $QConnectors = (($total - 3) + ($total - 3) * $tempvar9) / 2;
                                                if ($total == 4 || $total == 7 || $total == 10 || $total == 13 || $total == 16) {
                                                    $QConnectors = $QConnectors + 1;
                                                }

                                            if($LConnectors<0)
                                            {
                                                $LConnectors=0;
                                            }

                                                                if ($total < 8) {
                                                                    $nails = 2;
                                                                } else {
                                                                    $nails = 4;
                                                                }
                                            if($total==0)
                                            {
                                                $nails=0;
                                            }


                                                echo "<tr><td colspan='5' class='text-secondary font-medium text-sm pb-4'> Dieser Kunde wird " . $total . " Auszeichnungen tragen.";
                                                echo 'Sie ben&oumltigen ' . $LConnectors . ' L&aumlngsverbinder und ' . $QConnectors . ' Querverbinder. Wir empfehlen ' . $nails . ' N&aumlgel. Bitte passen Sie die St&uumlckzahlen im Warenkorb an. F&uumlr Namensschilder ben&oumltigen Sie keine N&aumlgel.</td></tr>';
                                                //               }
                                                //          }
                                        $customer_name = $record['customer_name'];
                                    }
                                    echo '<tr>';
                                    echo '<td data-title="Product" class="text-sm font-medium text-black py-4 pe-4">';
                                    echo show_ribbon_images($record['type'], $record['batch_image'], $record['number'], $record['country'], $record['product_id']);
                                    
                                    if($record['type']=='10')
                                    {
                                        echo $record['ribbon_name_en']."<b> ".$record['ShownName'] . "</b>";
                                    }
                                    else
                                    {
                                        echo "<span class='mt-2.5 inline-flex'>" .$record['ribbon_name_en'] ."</span>";
                                    }

                                    echo '</td>';
                                    echo '<td data-title="Quantity" class="numeric quant text-base font-medium py-4 pe-4" >';
                                    ?>
                                    <?php
                                    if ($record['level'] == '6') {
                                        ?>
                                    <select name="quant[<?php echo $record['id']; ?>]" id="p_<?php echo $record['id']; ?>" class="cart_sel" >
                                        <?php
                                        for ($i = 0; $i <= 15; $i++) {
                                            ?>
                                            <option value=<?php echo $i; ?>
                                                    <?php if ($record['quantity'] == $i) { ?> selected="selected"<?php } ?>>
                                                <?php echo $i; ?></option>';
                                        <?php } ?>
                                        <?php
                                        echo '</select>';
                                    } else {
                                        echo $record['quantity'];
                                    }
                                    ?>
                                    <?php
                                    echo '<input type="hidden"  name="price[' . $record['id'] . ']" value=' . $record['unit_price'] . '>';
                                    echo '<td data-title="Price" class="numeric text-base font-medium text-secondary py-4 pe-4">';
                                    echo show_price($record['unit_price']);
                                    echo '</td>';
                                    echo '<td data-title="Total" class="numeric text-base font-medium text-secondary py-4 pe-4">';
                                    echo show_price($record['total_price_tax_excl']);
                                    echo '</td>';
                                    echo '<td data-title="" class="numeric text-base font-medium text-secondary py-4 pe-4">';
                                    echo '<a href="javascript:void(0);" class="btn btn-danger btn-sm del_cart min-w-12 h-10 bg-white rounded-lg border border-[#d9d9d9] inline-flex justify-center items-center" data-value=' . $record['id'] . '><svg width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M13.3333 4.99999V4.33332C13.3333 3.3999 13.3333 2.93319 13.1517 2.57667C12.9919 2.26307 12.7369 2.0081 12.4233 1.84831C12.0668 1.66666 11.6001 1.66666 10.6667 1.66666H9.33333C8.39991 1.66666 7.9332 1.66666 7.57668 1.84831C7.26308 2.0081 7.00811 2.26307 6.84832 2.57667C6.66667 2.93319 6.66667 3.3999 6.66667 4.33332V4.99999M8.33333 9.58332V13.75M11.6667 9.58332V13.75M2.5 4.99999H17.5M15.8333 4.99999V14.3333C15.8333 15.7335 15.8333 16.4335 15.5608 16.9683C15.3212 17.4387 14.9387 17.8212 14.4683 18.0608C13.9335 18.3333 13.2335 18.3333 11.8333 18.3333H8.16667C6.76654 18.3333 6.06647 18.3333 5.53169 18.0608C5.06129 17.8212 4.67883 17.4387 4.43915 16.9683C4.16667 16.4335 4.16667 15.7335 4.16667 14.3333V4.99999" stroke="#393C40" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path></svg></a>';
                                    echo '</td>';
                                    echo '</tr>';
                                }
                                ?>
                                </tbody>
                        </table>
                    </div>
                    <div class="bg-body rounded-[20px] border border-[#d9d9d9] p-5 w-1/3">
                        <div class="flex flex-col">
                            <div class="flex justify-end mb-3">
                                <button type='submit' name='clear' class="btn btn-info btn-sm update_quantity text-sm text-primary"><?php _e('Clear'); ?></button>
                            </div>
                            <?php
                                $discount = $cart_detail->discount;
                                echo '<div class="flex gap-2.5 justify-between text-sm text-secondary mb-6 font-normal"><p>';
                                echo _e('Total');
                                echo '</p><p>';
                                echo show_price(get_total());
                                echo '</p></div>';
                                if ($discount <> 0) {
                                    echo '<div class="flex gap-2.5 justify-between"><p>';
                                    echo 'Atkionspreis -' . ($discount * 100) . '% durch Code ' . $cart_detail->rabattcode . '';
                                    echo '</p>';
                                    echo '<p>';
                                    echo show_price(get_total() * (1 - $discount));
                                    echo '</p></div>';
                                }
                            ?>
                            <div class="flex gap-2.5 justify-between text-sm text-secondary mb-5 font-normal">
                                <p><?php _e('ShippingCost'); ?></p>
                                <p><?php echo show_price(shipingCostWithArea(get_total() * (1 - $discount),$area)); ?></p>
                            </div>
                            <div class="text-black/55 text-sm font-medium mb-5">
                                <p><?php echo SHIPPING_TIME_TITLE?> -  <?php
                                        if (get_discount_string() == '') {
                                            echo SHIPPING_TIME_VALUE;
                                        } else {
                                            echo SHIPPING_TIME_VALUE;
                                        }
                                        ?> </p>
                            </div>
                            <div class="flex gap-2.5 justify-between text-lg text-black font-medium pt-5 border-t border-[#d9d9d9] mb-6">
                                <p><?php _e('TotalShipping'); ?></p>
                                <p><?php echo show_price(get_total() * (1 - $discount) + shipingCostWithArea(get_total() * (1 - $discount),$area)); ?></p>
                            </div>
                            <div class="flex gap-2.5 mb-5">
                                 <input type="text" class="feild-a flex-auto px-4 min-h-10 text-sm text-black font-normal focus:outline-none border border-[#d9d9d9] rounded-md" name='rabattcode' value="<?php echo $cart_detail->rabattcode; ?>" placeholder="Rabattcode eingeben">
                                <button type='submit' name='sendrabatt' class="btn text-white rounded-md btn-info btn-sm update_quantity bg-primary min-h-10 text-sm px-4 font-medium hover:bg-secondary"><?php _e('usecode'); ?> </button>
                            </div>
                            <div class="flex  gap-3">
                                 <a href='<?php echo make_url("checkout"); ?>' class="btn cart-slct w-full inline-flex justify-center items-center text-sm bg-secondary hover:bg-primary text-white rounded-md font-medium min-h-10"><?php _e('Checkout'); ?> </a>
                                <a class="btn cart-slct w-full inline-flex justify-center items-center text-sm bg-primary hover:bg-secondary text-white rounded-md font-medium min-h-10" href='<?php echo make_url("shop"); ?>'> <?php _e('Shop') ?></a>
                            </div>
                        </div>
                    </div>
                </form>  
            </div>
        </div>
    </div>
</div>
<script>
    $(document.body).on('change', ".cart_sel", function (e) {
        var val = $(this).val();
        var id = $(this).attr('id');
        $("#redirect_id").val(id);
        $("#cart-form").submit();
    });
</script>
