<?php
// Feature flags
function flags()
{
	global $LAUNCH_EVENT_DISCOUNT;
	$LAUNCH_EVENT_DISCOUNT = 25;
}
add_action('after_setup_theme', 'flags');
