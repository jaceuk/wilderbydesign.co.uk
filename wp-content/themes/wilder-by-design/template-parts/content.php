<?php

/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Rude_by_Design
 */
?>


<header>
	<?php
	if (is_singular()) :
		the_title('<h1>', '</h1>');
	else :
		the_title('<h2><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
	endif;
	?>
</header>

<?php the_post_thumbnail(); ?>

<div>
	<?php
	the_content(
		sprintf(
			wp_kses(
				/* translators: %s: Name of current post. Only visible to screen readers */
				__('Continue reading<span class="screen-reader-text"> "%s"</span>', 'rude-by-design'),
				array(
					'span' => array(
						'class' => array(),
					),
				)
			),
			wp_kses_post(get_the_title())
		)
	);

	wp_link_pages(
		array(
			'before' => '<div class="page-links">' . esc_html__('Pages:', 'rude-by-design'),
			'after'  => '</div>',
		)
	);
	?>
</div>