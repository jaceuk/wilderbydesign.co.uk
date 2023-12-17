<?php

/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Rude_by_Design
 */

get_header();
?>

<main id="primary" class="inner-wrapper">

	<?php if (have_posts()) : ?>

		<header class="page-header">
			<h1 class="page-title">
				<?php
				/* translators: %s: search query. */
				printf(esc_html__('Search Results for: %s', 'rude-by-design'), '<span>' . get_search_query() . '</span>');
				?>
			</h1>
		</header><!-- .page-header -->


	<?php
		/* Start the Loop */
		$ids = [];
		while (have_posts()) :
			the_post();

			$ids[] += get_the_ID();
		endwhile;

		$ids_csv = implode(',', $ids);
		echo do_shortcode('[products ids="' . $ids_csv . '"]');

		the_posts_navigation();

	else :

		get_template_part('template-parts/content', 'none');

	endif;
	?>


</main><!-- #main -->

<?php
get_footer();
