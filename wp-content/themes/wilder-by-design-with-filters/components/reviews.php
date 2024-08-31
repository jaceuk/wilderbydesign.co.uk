<?php
$args = array('post_type' => 'product');
$comments = get_comments($args);
wp_list_comments(array('callback' => 'woocommerce_comments'), $comments);

print "<pre>";
print_r($comments);
print "</pre>";
