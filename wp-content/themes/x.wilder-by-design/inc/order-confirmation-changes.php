<?php
// add personalisation section to the order confirmation page
add_action('woocommerce_thankyou', 'personalisation', 10, 2);

function personalisation($order_id)
{
  echo '<section class="woocommerce-personalisation">
	<h2>Personalisation</h2>
	<p>If your order contains a personalised item that requires a photo you\'ll need to email your photo along with your order number to info@wilderbydesign.co.uk.</p>
	<p>Please check our FAQ for more details on <a href="/faq#send-photo">how to get your photo to us</a>.</p>
</section>';
}
