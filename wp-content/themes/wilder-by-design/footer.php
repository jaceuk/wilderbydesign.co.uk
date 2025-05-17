<?php
get_template_part('components/benefits');
?>

<footer class="footer">

	<?php if (!is_checkout() || is_wc_endpoint_url('order-received')) { ?>

		<div class="inner-wrapper">
			<div class="footer-menu">
				<div class="h4">Wilder by Design</div>
				<ul>
					<li><a href="/">Homepage</a></li>
					<li><a href="/privacy-policy">Privacy policy</a></li>
					<li><a href="/terms">Terms of service</a></li>
					<li><a href="/wp-sitemap.xml">Sitemap</a></li>
				</ul>
			</div>

			<div class="footer-menu">
				<div class="h4">Support</div>
				<ul>
					<li><a href="/contact">Contact us</a></li>
					<li><a href="/faq">FAQ</a></li>
					<li><a href="/returns-policy">Returns policy</a></li>
				</ul>
			</div>

			<div class="newsletter">
				<?php
				echo do_shortcode('[mailpoet_form id="1"]');
				?>
			</div>
		</div>

	<?php } ?>

	<div class="inner-wrapper">
		<div class="legals">
			<ul>
				<li>&copy; Wilder By Design <?php echo date("Y"); ?>, all rights reserved.</li>
				<li>
					<a class="facebook" href="https://www.facebook.com/wilderbydesignuk" target="_blank">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 50 50" width="16" height="16" focusable="false" aria-hidden="true">
							<path fill-rule="evenodd" d="M28.848 50V24.997h6.902l.915-8.616h-7.817l.012-4.313c0-2.247.214-3.45 3.441-3.45h4.315V0h-6.903c-8.291 0-11.21 4.18-11.21 11.209v5.173h-5.168v8.616h5.168V50h10.345Z" clip-rule="evenodd"></path>
						</svg>
					</a>
				</li>
			</ul>
		</div>
	</div>
</footer>

<div id="cookie-notice" class="cookie-notice">
	<div class="inner-wrapper">
		This site uses cookies to provide an optimized shopping experience. By using this site, you agree to the use of cookies.
		<button id="cookie-button">Dismiss</button>
	</div>
</div>

<dialog id="newsletter-dialog" class="dialog newsletter">
	<button id="newsletter-dialog-close-button" class="dialog-close-button" type="button">
		<svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24">
			<path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z" />
		</svg>
	</button>

	<div class="dialog-body">
		<?php
		echo do_shortcode('[mailpoet_form id="2"]');
		?>
	</div>
</dialog>

<?php wp_footer(); ?>

<?php
get_template_part('components/dev-banner');
?>

</body>

</html>