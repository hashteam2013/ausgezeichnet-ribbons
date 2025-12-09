<div class="side-bar">
    <ul>
        <li class="<?php echo($page == 'profile') ? 'selected' : '' ?>"><a href="<?php echo make_url('profile'); ?>"><?php _e('Basic Info');?></a></li>
        <li class="<?php echo($page == 'change_password') ? 'selected' : '' ?>"><a href="<?php echo make_url('change_password'); ?>"><?php _e('Change Password');?></a></li>
        <li class="<?php echo($page == 'customer') ? 'selected' : '' ?>"><a href="<?php echo make_url('customer'); ?>"><?php _e('Customers');?></a></li>
        <li class="<?php echo($page == 'orders') ? 'selected' : '' ?>"><a href="<?php echo make_url('orders'); ?>"><?php _e('Orders');?></a></li>
        <li class="<?php echo($page == 'cart') ? 'selected' : '' ?>"><a href="<?php echo make_url('cart'); ?>"><?php _e('Cart');?></a></li>
        <li class="<?php echo($page == 'dsgvo') ? 'selected' : '' ?>"><a href="<?php echo make_url('dsgvo'); ?>"><?php _e('dsgvo1');?></a></li>
    </ul>
</div>
