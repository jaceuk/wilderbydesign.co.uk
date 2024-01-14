<!doctype html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php
	if (is_home() || is_front_page()) {
	?>
		<meta name="description" content="Treat someone you love to a rude, funny or sarcastic mug.">
	<?php
	}
	?>

	<?php
	if (is_product()) {
	?>
		<meta name="description" content="<?php echo strip_tags(wc_get_product($post->ID)->get_description()); ?>">
	<?php
	}
	?>

	<?php wp_head(); ?>

	<?php if (!file_exists('c:\windows')) { ?>
		<!-- Google tag (gtag.js) -->
		<script async src="https://www.googletagmanager.com/gtag/js?id=G-DR0DTLB52E"></script>
		<script>
			window.dataLayer = window.dataLayer || [];

			function gtag() {
				dataLayer.push(arguments);
			}
			gtag('js', new Date());

			gtag('config', 'G-DR0DTLB52E');
		</script>
	<?php } ?>

	<!-- Meta Pixel Code -->
	<script>
		! function(f, b, e, v, n, t, s) {
			if (f.fbq) return;
			n = f.fbq = function() {
				n.callMethod ?
					n.callMethod.apply(n, arguments) : n.queue.push(arguments)
			};
			if (!f._fbq) f._fbq = n;
			n.push = n;
			n.loaded = !0;
			n.version = '2.0';
			n.queue = [];
			t = b.createElement(e);
			t.async = !0;
			t.src = v;
			s = b.getElementsByTagName(e)[0];
			s.parentNode.insertBefore(t, s)
		}(window, document, 'script',
			'https://connect.facebook.net/en_US/fbevents.js');
		fbq('init', '358964673257456');
		fbq('track', 'PageView');
	</script>
	<noscript><img height="1" width="1" style="display:none" src="https://www.facebook.com/tr?id=358964673257456&ev=PageView&noscript=1" /></noscript>
	<!-- End Meta Pixel Code -->
</head>

<body <?php body_class(); ?>>
	<header class="header">
		<div class="inner-wrapper grid">
			<button type="button" id="mobile-menu-open-button" class="menu-button">
				<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 -960 960 960" width="24" fill="#ffffff">
					<path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z" />
				</svg>
			</button>
			<a href="<?php echo esc_url(home_url('/')); ?>" rel="home" aria-label="Home">
				<svg class="logo" viewBox="0 0 1006 413" xmlns="http://www.w3.org/2000/svg">
					<path d="M472.719 315.31C473.718 312.608 476.05 311.202 479.714 311.091C483.378 310.98 485.839 312.22 487.097 314.81L487.208 335.849C492.389 332.666 498.921 331.889 506.804 333.518C514.686 335.146 520.293 340.272 523.624 348.894C526.954 357.517 526.418 366.27 522.014 375.151C517.647 383.996 511.3 388.826 502.973 389.64C494.683 390.454 489.354 389.27 486.986 386.087C485.654 388.826 483.081 390.066 479.27 389.807C475.495 389.585 473.274 388.215 472.608 385.699L472.719 315.31ZM503.528 347.673C498.791 345.971 493.555 346.729 487.818 349.949V371.821C492.074 375.707 496.589 377.002 501.363 375.707C506.174 374.411 509.246 372.006 510.578 368.49C511.948 364.937 512.299 360.996 511.633 356.666C510.967 352.336 508.265 349.339 503.528 347.673ZM575.305 407.57C571.826 410.975 565.924 412.696 557.597 412.733C549.27 412.77 543.127 411.234 539.167 408.125C534.023 405.683 532.339 402.278 534.115 397.911C535.892 393.581 539.259 392.545 544.218 394.803C547.623 397.8 552.194 399.188 557.93 398.966C563.666 398.781 566.22 396.153 565.59 391.083V386.143C560.039 389.029 554.488 390.195 548.937 389.64C543.423 389.085 539.037 386.883 535.781 383.034C532.561 379.185 530.581 374.152 529.841 367.935C529.101 361.718 529.933 356.24 532.339 351.503C534.744 346.729 535.892 342.603 535.781 339.124C535.707 335.646 537.779 333.869 541.998 333.795C546.217 333.721 548.604 335.183 549.159 338.181C549.751 341.141 548.752 345.897 546.161 352.447C543.608 358.961 543.256 364.345 545.107 368.601C546.957 372.857 550.695 375.003 556.32 375.04C561.982 375.077 565.054 373.135 565.535 369.212L565.59 338.736C565.59 335.331 568.07 333.555 573.029 333.407C577.988 333.259 580.542 335.331 580.69 339.624L580.856 395.469C580.634 400.132 578.784 404.166 575.305 407.57ZM667.788 311.035C671.932 311.109 674.208 312.719 674.616 315.865L674.727 385.699C674.06 388.215 671.821 389.585 668.01 389.807C664.235 390.066 661.681 388.826 660.349 386.087C657.981 389.27 652.318 390.454 643.362 389.64C634.444 388.826 628.189 384.403 624.599 376.373C621.01 368.305 620.788 359.553 623.933 350.116C627.116 340.679 632.649 335.146 640.531 333.518C648.414 331.889 654.946 332.666 660.127 335.849L660.238 315.92C661.126 312.59 663.643 310.961 667.788 311.035ZM659.849 349.394C654.113 346.174 648.877 345.416 644.14 347.118C639.403 348.783 636.701 351.781 636.035 356.111C635.369 360.441 635.702 364.382 637.034 367.935C638.403 371.451 641.475 373.856 646.249 375.151C651.06 376.447 655.594 375.151 659.849 371.266V349.394ZM722.078 387.198C716.12 390.343 708.811 391.083 700.151 389.418C691.491 387.753 685.385 383.145 681.832 375.596C678.316 368.009 678.057 359.793 681.055 350.948C684.053 342.066 689.974 336.441 698.819 334.073C707.664 331.667 715.121 331.815 721.19 334.517C727.259 337.181 729.517 340.697 727.962 345.064C726.408 349.394 723.503 350.615 719.247 348.728C714.066 345.656 708.774 344.713 703.371 345.897C698.005 347.081 694.988 349.838 694.322 354.168L713.807 354.113C717.212 354.964 718.895 357.073 718.858 360.441C718.821 363.772 717.082 366.085 713.64 367.38H694.156C695.303 371.525 698.412 374.411 703.482 376.04C708.589 377.631 713.825 376.484 719.192 372.598C724.928 370.414 728.332 371.525 729.406 375.929C730.479 380.296 728.036 384.052 722.078 387.198ZM743.561 335.016C749.815 331.834 756.902 331.26 764.822 333.296C772.779 335.294 776.443 338.107 775.813 341.733C775.184 345.323 773.463 347.229 770.651 347.451C767.838 347.673 764.619 347.063 760.992 345.619C757.365 344.176 754.33 343.935 751.888 344.898C749.482 345.86 748.816 347.414 749.89 349.561C750.963 351.67 753.405 352.947 757.217 353.391C761.029 353.798 764.693 354.538 768.208 355.611C771.724 356.648 774.925 358.776 777.812 361.995C780.736 365.178 781.309 369.785 779.533 375.818C777.793 381.85 773.889 386.05 767.82 388.419C761.751 390.787 754.349 390.658 745.615 388.03C736.918 385.403 732.329 382.238 731.848 378.538C731.367 374.837 732.681 372.431 735.79 371.321C738.898 370.174 742.525 370.896 746.67 373.486C750.852 376.04 754.96 377.131 758.993 376.761C763.064 376.391 765.211 374.855 765.433 372.154C765.655 369.452 762.953 367.75 757.328 367.047C751.74 366.307 746.411 364.604 741.341 361.94C736.271 359.275 733.81 354.927 733.958 348.894C734.143 342.825 737.344 338.199 743.561 335.016ZM785.028 339.069C785.473 334.776 787.989 332.611 792.578 332.574C797.167 332.5 799.758 334.646 800.35 339.013V383.589C799.536 387.919 796.963 390.084 792.634 390.084C788.304 390.084 785.769 387.808 785.028 383.256V339.069ZM784.806 320.084C784.806 313.978 787.545 311.017 793.022 311.202C798.536 311.387 801.256 314.422 801.182 320.306C801.145 326.19 798.407 329.151 792.967 329.188C787.564 329.188 784.843 326.153 784.806 320.084ZM834.989 412.566C827.254 412.529 820.612 410.975 815.06 407.903C812.063 404.795 811.378 401.631 813.006 398.411C814.635 395.228 817.762 394.396 822.388 395.913C829.271 398.577 834.489 399.54 838.042 398.799C841.632 398.059 843.704 396.357 844.26 393.692L844.315 387.919C839.134 391.102 832.602 391.879 824.719 390.251C816.837 388.622 811.23 383.497 807.899 374.874C804.569 366.251 805.087 357.517 809.454 348.672C813.858 339.79 820.204 334.942 828.494 334.128C836.821 333.314 842.169 334.498 844.537 337.681C845.869 334.942 848.423 333.703 852.198 333.962C856.01 334.184 858.248 335.553 858.915 338.07L859.137 391.583C858.989 398.762 856.861 404.055 852.753 407.459C848.645 410.901 842.724 412.603 834.989 412.566ZM828.328 376.706C833.065 378.371 838.301 377.594 844.037 374.374V352.503C839.782 348.617 835.248 347.322 830.437 348.617C825.663 349.912 822.591 352.336 821.222 355.889C819.89 359.405 819.557 363.327 820.223 367.657C820.889 371.987 823.591 375.003 828.328 376.706ZM864.743 339.846C865.521 336.478 868.13 334.776 872.571 334.739C877.048 334.665 879.528 336.182 880.009 339.291C885.56 336.034 891.278 334.498 897.162 334.683C903.083 334.868 907.654 336.7 910.874 340.179C914.13 343.658 916.129 348.506 916.869 354.723C917.609 360.94 916.24 368.305 912.761 376.817C909.282 385.329 907.802 392.305 908.32 397.745C908.838 403.222 906.877 406.127 902.436 406.46C898.032 406.793 895.293 404.055 894.22 398.244C893.184 392.471 894.683 384.866 898.717 375.429C902.787 365.955 903.824 358.961 901.825 354.446C899.827 349.931 895.811 347.655 889.779 347.618C883.784 347.581 880.546 349.524 880.065 353.446L880.009 384.477C880.009 387.882 877.53 389.659 872.571 389.807C867.611 389.955 865.058 387.882 864.91 383.589L864.743 339.846Z" fill="white" />
					<path d="M10.7485 66.1882C3.7388 48.4378 7.30019 36.7361 21.4327 31.0831C35.5652 25.317 46.645 30.8004 54.6723 47.5333L128.274 235.778C132.91 253.528 127.709 264.495 112.672 268.678C97.7481 272.862 87.6857 267.039 82.485 251.211L10.7485 66.1882ZM167.449 40.5801C166.997 29.8394 177.003 20.3989 197.467 12.2586C218.044 4.11831 237.942 4.17484 257.162 12.4282C276.496 20.6816 288.65 35.4359 293.624 56.6911C298.712 77.8333 294.246 98.8625 280.227 119.779L213.408 212.205C207.303 227.694 205.833 239.113 208.999 246.462C210.808 256.977 205.438 264.439 192.888 268.848C180.451 273.37 170.785 269.47 163.888 257.146L83.3329 67.5449C75.6449 50.3598 79.0932 38.7712 93.6779 32.779C108.263 26.7868 120.699 32.0441 130.988 48.5508L185.765 182.188L228.332 127.919C252.753 98.2972 259.706 76.4766 249.192 62.4572C238.677 48.3247 227.823 44.8199 216.63 51.9426C205.551 58.9523 194.697 61.4962 184.069 59.5742C173.442 57.6522 167.902 51.3208 167.449 40.5801ZM312.449 114.691C313.805 101.576 321.494 94.9619 335.513 94.8488C349.532 94.6227 357.447 101.18 359.255 114.521V250.702C356.768 263.93 348.911 270.544 335.683 270.544C322.455 270.544 314.71 263.591 312.449 249.684V114.691ZM311.77 56.6911C311.77 38.0363 320.137 28.9915 336.87 29.5568C353.716 30.1221 362.025 39.393 361.799 57.3695C361.686 75.346 353.32 84.3908 336.7 84.5039C320.193 84.5039 311.883 75.233 311.77 56.6911ZM386.22 49.0596C387.69 35.9447 395.435 29.3307 409.454 29.2176C423.473 28.9915 431.388 35.549 433.197 48.89V250.702C430.709 263.93 422.852 270.544 409.624 270.544C396.396 270.544 388.651 263.591 386.39 249.684L386.22 49.0596ZM596.342 29.048C609.005 29.2741 615.958 34.1922 617.202 43.8023L617.541 257.146C615.506 264.834 608.666 269.018 597.02 269.696C585.488 270.487 577.687 266.7 573.617 258.333C566.381 268.057 549.083 271.674 521.722 269.187C494.475 266.7 475.368 253.189 464.401 228.655C453.434 204.008 452.756 177.269 462.366 148.439C472.089 119.609 488.992 102.707 513.073 97.7319C537.155 92.7572 557.11 95.1315 572.939 104.855L573.278 43.9719C575.991 33.7965 583.679 28.8219 596.342 29.048ZM572.091 146.235C554.566 136.398 538.568 134.081 524.097 139.281C509.625 144.369 501.372 153.527 499.337 166.755C497.302 179.983 498.319 192.024 502.389 202.878C506.572 213.618 515.956 220.967 530.541 224.924C545.239 228.881 559.089 224.924 572.091 213.053V146.235ZM762.201 261.725C743.998 271.335 721.669 273.596 695.213 268.509C668.757 263.421 650.102 249.345 639.248 226.281C628.507 203.104 627.716 178.004 636.874 150.983C646.032 123.849 664.121 106.664 691.143 99.4278C718.164 92.0789 740.946 92.5311 759.487 100.784C778.029 108.925 784.926 119.665 780.177 133.007C775.429 146.235 766.554 149.966 753.552 144.199C737.723 134.815 721.556 131.932 705.049 135.55C688.655 139.168 679.441 147.591 677.406 160.819L736.932 160.65C747.333 163.25 752.478 169.694 752.365 179.983C752.251 190.158 746.938 197.225 736.423 201.182H676.897C680.402 213.844 689.899 222.663 705.388 227.638C720.99 232.499 736.988 228.994 753.382 217.123C770.906 210.453 781.308 213.844 784.587 227.298C787.865 240.64 780.403 252.115 762.201 261.725ZM800.358 109.942C798.776 100.219 805.164 95.1315 819.522 94.6793C833.881 94.227 841.851 97.5057 843.434 104.515C888.997 90.7222 919.58 94.0574 935.182 114.521C950.785 134.872 951.746 158.841 938.065 186.427C932.412 196.037 923.594 202.143 911.609 204.743C921.898 209.039 932.299 219.328 942.814 235.608L968.252 264.947C982.611 279.758 992.334 289.199 997.422 293.269C1002.62 297.452 1005.05 303.388 1004.71 311.076C1004.49 318.877 1001.66 324.53 996.235 328.035C990.921 331.54 984.363 332.67 976.562 331.427C968.874 330.183 958.925 322.495 946.714 308.362L931.791 287.333C916.754 268.113 903.639 252.002 892.446 239C881.253 225.885 865.82 220.854 846.148 223.907V255.959C844 264.552 835.916 268.791 821.896 268.678C807.99 268.678 800.811 262.969 800.358 251.55V109.942ZM903.13 157.597C902.565 135.324 883.005 128.993 844.452 138.603L844.621 181.509C884.192 187.841 903.695 179.87 903.13 157.597Z" fill="white" />
				</svg>
			</a>

			<?php if (!is_checkout() || is_wc_endpoint_url('order-received')) { ?>

				<nav class="account-and-basket">
					<ul>
						<li><a href="/my-account">
								<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000">
									<path d="M0 0h24v24H0V0z" fill="none" />
									<path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v1c0 .55.45 1 1 1h14c.55 0 1-.45 1-1v-1c0-2.66-5.33-4-8-4z" />
								</svg>
								Account</a></li>
						<li><a href="/basket">
								<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="#000000">
									<path d="M0 0h24v24H0V0z" fill="none" />
									<path d="M22 9h-4.79l-4.39-6.57c-.4-.59-1.27-.59-1.66 0L6.77 9H2c-.55 0-1 .45-1 1 0 .09.01.18.04.27l2.54 9.27c.23.84 1 1.46 1.92 1.46h13c.92 0 1.69-.62 1.93-1.46l2.54-9.27L23 10c0-.55-.45-1-1-1zM11.99 4.79L14.8 9H9.18l2.81-4.21zM12 17c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2z" />
								</svg>
								Basket
								<?php if (sizeof(WC()->cart->get_cart()) > 0) {
									echo '<div class="badge">' . WC()->cart->get_cart_contents_count() . '</div>';
								} ?>
							</a></li>
					</ul>
				</nav>

				<div class="search">
					<?php
					get_search_form();
					?>
				</div>
		</div>

		<nav class="nav">
			<div class="inner-wrapper">
				<div class="menu">
					<?php
					get_template_part('components/desktop-menu');
					?>

					<div class="currency-switcher"><?php dynamic_sidebar('currency-switcher'); ?></div>
				</div>
			</div>
		</nav>
	<?php } ?>
	</header>

	<dialog id="mobile-menu" class="mobile-menu">
		<div class="dialog-inner-wrapper">
			<button id="mobile-menu-close-button" class="dialog-close-button">
				<svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 -960 960 960" width="24">
					<path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z" />
				</svg>
			</button>

			<a href="<?php echo esc_url(home_url('/')); ?>" rel="home" aria-label="Home">
				<svg class="logo" viewBox="0 0 1006 413" xmlns="http://www.w3.org/2000/svg">
					<path d="M472.719 315.31C473.718 312.608 476.05 311.202 479.714 311.091C483.378 310.98 485.839 312.22 487.097 314.81L487.208 335.849C492.389 332.666 498.921 331.889 506.804 333.518C514.686 335.146 520.293 340.272 523.624 348.894C526.954 357.517 526.418 366.27 522.014 375.151C517.647 383.996 511.3 388.826 502.973 389.64C494.683 390.454 489.354 389.27 486.986 386.087C485.654 388.826 483.081 390.066 479.27 389.807C475.495 389.585 473.274 388.215 472.608 385.699L472.719 315.31ZM503.528 347.673C498.791 345.971 493.555 346.729 487.818 349.949V371.821C492.074 375.707 496.589 377.002 501.363 375.707C506.174 374.411 509.246 372.006 510.578 368.49C511.948 364.937 512.299 360.996 511.633 356.666C510.967 352.336 508.265 349.339 503.528 347.673ZM575.305 407.57C571.826 410.975 565.924 412.696 557.597 412.733C549.27 412.77 543.127 411.234 539.167 408.125C534.023 405.683 532.339 402.278 534.115 397.911C535.892 393.581 539.259 392.545 544.218 394.803C547.623 397.8 552.194 399.188 557.93 398.966C563.666 398.781 566.22 396.153 565.59 391.083V386.143C560.039 389.029 554.488 390.195 548.937 389.64C543.423 389.085 539.037 386.883 535.781 383.034C532.561 379.185 530.581 374.152 529.841 367.935C529.101 361.718 529.933 356.24 532.339 351.503C534.744 346.729 535.892 342.603 535.781 339.124C535.707 335.646 537.779 333.869 541.998 333.795C546.217 333.721 548.604 335.183 549.159 338.181C549.751 341.141 548.752 345.897 546.161 352.447C543.608 358.961 543.256 364.345 545.107 368.601C546.957 372.857 550.695 375.003 556.32 375.04C561.982 375.077 565.054 373.135 565.535 369.212L565.59 338.736C565.59 335.331 568.07 333.555 573.029 333.407C577.988 333.259 580.542 335.331 580.69 339.624L580.856 395.469C580.634 400.132 578.784 404.166 575.305 407.57ZM667.788 311.035C671.932 311.109 674.208 312.719 674.616 315.865L674.727 385.699C674.06 388.215 671.821 389.585 668.01 389.807C664.235 390.066 661.681 388.826 660.349 386.087C657.981 389.27 652.318 390.454 643.362 389.64C634.444 388.826 628.189 384.403 624.599 376.373C621.01 368.305 620.788 359.553 623.933 350.116C627.116 340.679 632.649 335.146 640.531 333.518C648.414 331.889 654.946 332.666 660.127 335.849L660.238 315.92C661.126 312.59 663.643 310.961 667.788 311.035ZM659.849 349.394C654.113 346.174 648.877 345.416 644.14 347.118C639.403 348.783 636.701 351.781 636.035 356.111C635.369 360.441 635.702 364.382 637.034 367.935C638.403 371.451 641.475 373.856 646.249 375.151C651.06 376.447 655.594 375.151 659.849 371.266V349.394ZM722.078 387.198C716.12 390.343 708.811 391.083 700.151 389.418C691.491 387.753 685.385 383.145 681.832 375.596C678.316 368.009 678.057 359.793 681.055 350.948C684.053 342.066 689.974 336.441 698.819 334.073C707.664 331.667 715.121 331.815 721.19 334.517C727.259 337.181 729.517 340.697 727.962 345.064C726.408 349.394 723.503 350.615 719.247 348.728C714.066 345.656 708.774 344.713 703.371 345.897C698.005 347.081 694.988 349.838 694.322 354.168L713.807 354.113C717.212 354.964 718.895 357.073 718.858 360.441C718.821 363.772 717.082 366.085 713.64 367.38H694.156C695.303 371.525 698.412 374.411 703.482 376.04C708.589 377.631 713.825 376.484 719.192 372.598C724.928 370.414 728.332 371.525 729.406 375.929C730.479 380.296 728.036 384.052 722.078 387.198ZM743.561 335.016C749.815 331.834 756.902 331.26 764.822 333.296C772.779 335.294 776.443 338.107 775.813 341.733C775.184 345.323 773.463 347.229 770.651 347.451C767.838 347.673 764.619 347.063 760.992 345.619C757.365 344.176 754.33 343.935 751.888 344.898C749.482 345.86 748.816 347.414 749.89 349.561C750.963 351.67 753.405 352.947 757.217 353.391C761.029 353.798 764.693 354.538 768.208 355.611C771.724 356.648 774.925 358.776 777.812 361.995C780.736 365.178 781.309 369.785 779.533 375.818C777.793 381.85 773.889 386.05 767.82 388.419C761.751 390.787 754.349 390.658 745.615 388.03C736.918 385.403 732.329 382.238 731.848 378.538C731.367 374.837 732.681 372.431 735.79 371.321C738.898 370.174 742.525 370.896 746.67 373.486C750.852 376.04 754.96 377.131 758.993 376.761C763.064 376.391 765.211 374.855 765.433 372.154C765.655 369.452 762.953 367.75 757.328 367.047C751.74 366.307 746.411 364.604 741.341 361.94C736.271 359.275 733.81 354.927 733.958 348.894C734.143 342.825 737.344 338.199 743.561 335.016ZM785.028 339.069C785.473 334.776 787.989 332.611 792.578 332.574C797.167 332.5 799.758 334.646 800.35 339.013V383.589C799.536 387.919 796.963 390.084 792.634 390.084C788.304 390.084 785.769 387.808 785.028 383.256V339.069ZM784.806 320.084C784.806 313.978 787.545 311.017 793.022 311.202C798.536 311.387 801.256 314.422 801.182 320.306C801.145 326.19 798.407 329.151 792.967 329.188C787.564 329.188 784.843 326.153 784.806 320.084ZM834.989 412.566C827.254 412.529 820.612 410.975 815.06 407.903C812.063 404.795 811.378 401.631 813.006 398.411C814.635 395.228 817.762 394.396 822.388 395.913C829.271 398.577 834.489 399.54 838.042 398.799C841.632 398.059 843.704 396.357 844.26 393.692L844.315 387.919C839.134 391.102 832.602 391.879 824.719 390.251C816.837 388.622 811.23 383.497 807.899 374.874C804.569 366.251 805.087 357.517 809.454 348.672C813.858 339.79 820.204 334.942 828.494 334.128C836.821 333.314 842.169 334.498 844.537 337.681C845.869 334.942 848.423 333.703 852.198 333.962C856.01 334.184 858.248 335.553 858.915 338.07L859.137 391.583C858.989 398.762 856.861 404.055 852.753 407.459C848.645 410.901 842.724 412.603 834.989 412.566ZM828.328 376.706C833.065 378.371 838.301 377.594 844.037 374.374V352.503C839.782 348.617 835.248 347.322 830.437 348.617C825.663 349.912 822.591 352.336 821.222 355.889C819.89 359.405 819.557 363.327 820.223 367.657C820.889 371.987 823.591 375.003 828.328 376.706ZM864.743 339.846C865.521 336.478 868.13 334.776 872.571 334.739C877.048 334.665 879.528 336.182 880.009 339.291C885.56 336.034 891.278 334.498 897.162 334.683C903.083 334.868 907.654 336.7 910.874 340.179C914.13 343.658 916.129 348.506 916.869 354.723C917.609 360.94 916.24 368.305 912.761 376.817C909.282 385.329 907.802 392.305 908.32 397.745C908.838 403.222 906.877 406.127 902.436 406.46C898.032 406.793 895.293 404.055 894.22 398.244C893.184 392.471 894.683 384.866 898.717 375.429C902.787 365.955 903.824 358.961 901.825 354.446C899.827 349.931 895.811 347.655 889.779 347.618C883.784 347.581 880.546 349.524 880.065 353.446L880.009 384.477C880.009 387.882 877.53 389.659 872.571 389.807C867.611 389.955 865.058 387.882 864.91 383.589L864.743 339.846Z" fill="black" />
					<path d="M10.7485 66.1882C3.7388 48.4378 7.30019 36.7361 21.4327 31.0831C35.5652 25.317 46.645 30.8004 54.6723 47.5333L128.274 235.778C132.91 253.528 127.709 264.495 112.672 268.678C97.7481 272.862 87.6857 267.039 82.485 251.211L10.7485 66.1882ZM167.449 40.5801C166.997 29.8394 177.003 20.3989 197.467 12.2586C218.044 4.11831 237.942 4.17484 257.162 12.4282C276.496 20.6816 288.65 35.4359 293.624 56.6911C298.712 77.8333 294.246 98.8625 280.227 119.779L213.408 212.205C207.303 227.694 205.833 239.113 208.999 246.462C210.808 256.977 205.438 264.439 192.888 268.848C180.451 273.37 170.785 269.47 163.888 257.146L83.3329 67.5449C75.6449 50.3598 79.0932 38.7712 93.6779 32.779C108.263 26.7868 120.699 32.0441 130.988 48.5508L185.765 182.188L228.332 127.919C252.753 98.2972 259.706 76.4766 249.192 62.4572C238.677 48.3247 227.823 44.8199 216.63 51.9426C205.551 58.9523 194.697 61.4962 184.069 59.5742C173.442 57.6522 167.902 51.3208 167.449 40.5801ZM312.449 114.691C313.805 101.576 321.494 94.9619 335.513 94.8488C349.532 94.6227 357.447 101.18 359.255 114.521V250.702C356.768 263.93 348.911 270.544 335.683 270.544C322.455 270.544 314.71 263.591 312.449 249.684V114.691ZM311.77 56.6911C311.77 38.0363 320.137 28.9915 336.87 29.5568C353.716 30.1221 362.025 39.393 361.799 57.3695C361.686 75.346 353.32 84.3908 336.7 84.5039C320.193 84.5039 311.883 75.233 311.77 56.6911ZM386.22 49.0596C387.69 35.9447 395.435 29.3307 409.454 29.2176C423.473 28.9915 431.388 35.549 433.197 48.89V250.702C430.709 263.93 422.852 270.544 409.624 270.544C396.396 270.544 388.651 263.591 386.39 249.684L386.22 49.0596ZM596.342 29.048C609.005 29.2741 615.958 34.1922 617.202 43.8023L617.541 257.146C615.506 264.834 608.666 269.018 597.02 269.696C585.488 270.487 577.687 266.7 573.617 258.333C566.381 268.057 549.083 271.674 521.722 269.187C494.475 266.7 475.368 253.189 464.401 228.655C453.434 204.008 452.756 177.269 462.366 148.439C472.089 119.609 488.992 102.707 513.073 97.7319C537.155 92.7572 557.11 95.1315 572.939 104.855L573.278 43.9719C575.991 33.7965 583.679 28.8219 596.342 29.048ZM572.091 146.235C554.566 136.398 538.568 134.081 524.097 139.281C509.625 144.369 501.372 153.527 499.337 166.755C497.302 179.983 498.319 192.024 502.389 202.878C506.572 213.618 515.956 220.967 530.541 224.924C545.239 228.881 559.089 224.924 572.091 213.053V146.235ZM762.201 261.725C743.998 271.335 721.669 273.596 695.213 268.509C668.757 263.421 650.102 249.345 639.248 226.281C628.507 203.104 627.716 178.004 636.874 150.983C646.032 123.849 664.121 106.664 691.143 99.4278C718.164 92.0789 740.946 92.5311 759.487 100.784C778.029 108.925 784.926 119.665 780.177 133.007C775.429 146.235 766.554 149.966 753.552 144.199C737.723 134.815 721.556 131.932 705.049 135.55C688.655 139.168 679.441 147.591 677.406 160.819L736.932 160.65C747.333 163.25 752.478 169.694 752.365 179.983C752.251 190.158 746.938 197.225 736.423 201.182H676.897C680.402 213.844 689.899 222.663 705.388 227.638C720.99 232.499 736.988 228.994 753.382 217.123C770.906 210.453 781.308 213.844 784.587 227.298C787.865 240.64 780.403 252.115 762.201 261.725ZM800.358 109.942C798.776 100.219 805.164 95.1315 819.522 94.6793C833.881 94.227 841.851 97.5057 843.434 104.515C888.997 90.7222 919.58 94.0574 935.182 114.521C950.785 134.872 951.746 158.841 938.065 186.427C932.412 196.037 923.594 202.143 911.609 204.743C921.898 209.039 932.299 219.328 942.814 235.608L968.252 264.947C982.611 279.758 992.334 289.199 997.422 293.269C1002.62 297.452 1005.05 303.388 1004.71 311.076C1004.49 318.877 1001.66 324.53 996.235 328.035C990.921 331.54 984.363 332.67 976.562 331.427C968.874 330.183 958.925 322.495 946.714 308.362L931.791 287.333C916.754 268.113 903.639 252.002 892.446 239C881.253 225.885 865.82 220.854 846.148 223.907V255.959C844 264.552 835.916 268.791 821.896 268.678C807.99 268.678 800.811 262.969 800.358 251.55V109.942ZM903.13 157.597C902.565 135.324 883.005 128.993 844.452 138.603L844.621 181.509C884.192 187.841 903.695 179.87 903.13 157.597Z" fill="black" />
				</svg>
			</a>

			<nav>
				<?php
				get_template_part('components/mobile-menu');
				?>
			</nav>
		</div>
	</dialog>