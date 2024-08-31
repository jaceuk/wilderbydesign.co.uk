<?php
// Feature flags
function flags() {
	global $LAUNCH_EVENT;
	$LAUNCH_EVENT = true;
}
add_action( 'after_setup_theme', 'flags' );