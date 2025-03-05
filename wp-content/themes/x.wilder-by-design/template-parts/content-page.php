<?php

/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Rude_by_Design
 */

?>

<header>
	<?php the_title('<h1>', '</h1>'); ?>
</header>

<?php the_post_thumbnail(); ?>

<div>
	<?php
	the_content();

	wp_link_pages(
		array(
			'before' => '<div class="page-links">' . esc_html__('Pages:', 'rude-by-design'),
			'after'  => '</div>',
		)
	);
	?>
</div>