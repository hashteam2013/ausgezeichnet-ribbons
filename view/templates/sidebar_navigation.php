<div class="side-bar flex w-full">
    <ul class="flex items-center gap-5">
        <li class="<?php echo($page == 'profile') ? 'selected' : '' ?>">
            <a class="bg-[#d9d9d9] font-normal text-base text-black hover:bg-primary hover:text-white rounded-md px-5 inline-flex py-3" href="<?php echo make_url('profile'); ?>"><?php _e('Basic Info');?></a></li>
        <li class="<?php echo($page == 'change_password') ? 'selected' : '' ?>">
            <a class="bg-[#d9d9d9] font-normal text-base text-black hover:bg-primary hover:text-white rounded-md px-5 inline-flex py-3" href="<?php echo make_url('change_password'); ?>"><?php _e('Change Password');?></a></li>
        <li class="<?php echo($page == 'customer') ? 'selected' : '' ?>">
            <a class="bg-[#d9d9d9] font-normal text-base text-black hover:bg-primary hover:text-white rounded-md px-5 inline-flex py-3" href="<?php echo make_url('customer'); ?>"><?php _e('Customers');?></a></li>
        <li class="<?php echo($page == 'orders') ? 'selected' : '' ?>">
            <a class="bg-[#d9d9d9] font-normal text-base text-black hover:bg-primary hover:text-white rounded-md px-5 inline-flex py-3" href="<?php echo make_url('orders'); ?>"><?php _e('Orders');?></a></li>
        <li class="<?php echo($page == 'cart') ? 'selected' : '' ?>">
            <a class="bg-[#d9d9d9] font-normal text-base text-black hover:bg-primary hover:text-white rounded-md px-5 inline-flex py-3" href="<?php echo make_url('cart'); ?>"><?php _e('Cart');?></a></li>
        <li class="<?php echo($page == 'dsgvo') ? 'selected' : '' ?>">
            <a class="bg-[#d9d9d9] font-normal text-base text-black hover:bg-primary hover:text-white rounded-md px-5 inline-flex py-3" href="<?php echo make_url('dsgvo'); ?>"><?php _e('dsgvo1');?></a></li>
    </ul>
</div>
