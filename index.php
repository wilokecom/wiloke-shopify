<?php

use WilokeShopify\Models\UserMeta;
use WilokeShopify\ShopifyConnection\Shopify;

get_header();

if (is_user_logged_in()) :
    echo sprintf("Hello %s, Welcome to the Wiloke", get_userdata(get_current_user_id())->display_name);
else:
    ?>
    <h1 class="center mt-20">Wiloke Shopify</h1>
    <form class="center" action="<?php echo home_url('/'); ?>" method="post">
        <p>
            <label for="shop-name">Your Shopify</label>
            <input type="text" name="shopname" id="shop-name"> .myshopify.com
        </p>

        <input type="hidden" name="route" value="shop-installation">
        <button type="submit">Register</button>
    </form>
<?php
endif;
get_footer();
