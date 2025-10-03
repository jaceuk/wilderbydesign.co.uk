<?php
get_template_part('components/benefits');
?>

<footer class="footer">

	<?php if (!is_checkout() || is_wc_endpoint_url('order-received')) { ?>

		<div class="inner-wrapper">
			<div class="footer-menu">
				<div class="h4">Wilder By Design</div>
				<ul>
					<li><a href="/">Homepage</a></li>
					<li><a href="/privacy-policy">Privacy policy</a></li>
					<li><a href="/terms">Terms of service</a></li>
					<li><a href="/wp-sitemap.xml">Sitemap</a></li>
					<li><a href="https://www.facebook.com/humoroushistory">Facebook</a></li>
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
			<small>&copy; Wilder By Design <?php echo date("Y"); ?>, all rights reserved.</small>
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
	<button id="newsletter-dialog-close-button" class="dialog-close-button" type="button" onclick="closeDialog('newsletter-dialog')">
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

<dialog id="back-print-dialog" class="dialog newsletter">
	<button id="back-print-dialog-close-button" class="dialog-close-button" type="button" onclick="closeDialog('back-print-dialog')">
		<svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24">
			<path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z" />
		</svg>
	</button>

	<div class="dialog-body align-center">
		<h2>You are ordering a back print item</h2>
		<p>This means that the design will be printed on the <strong>back</strong> of the garment and there will be no print on the front.</p>
		<p>If this was a mistake please make sure to remove it from your basket.</p>
		<button id="back-print-dialog-accept-button" class="confirm-button" type="button" onclick="closeDialog('back-print-dialog')">I understand</button>
	</div>
</dialog>

<?php wp_footer(); ?>

<?php
get_template_part('components/dev-banner');
?>

</body>

</html>