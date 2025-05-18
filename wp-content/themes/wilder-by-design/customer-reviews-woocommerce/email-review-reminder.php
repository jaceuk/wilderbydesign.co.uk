<?php

if (! defined('ABSPATH')) {
	exit; // Exit if accessed directly
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title><?php echo get_bloginfo('name', 'display'); ?></title>
	<style media="all" type="text/css">
		@media all {
			.btn-primary table td:hover {
				background-color: #151922 !important;
			}

			.btn-primary a:hover {
				background-color: #151922 !important;
				border-color: #151922 !important;
			}
		}

		@media only screen and (max-width: 640px) {

			.main p,
			.main td,
			.main span {
				font-size: 16px !important;
			}

			.wrapper {
				padding: 16px !important;
			}

			.content {
				padding: 0 !important;
			}

			.container {
				padding: 0 !important;
				padding-top: 8px !important;
				width: 100% !important;
			}

			.main {
				border-left-width: 0 !important;
				border-radius: 4px !important;
				border-right-width: 0 !important;
			}

			.btn table {
				max-width: 100% !important;
				width: 100% !important;
			}

			.btn a {
				font-size: 16px !important;
				max-width: 100% !important;
				width: 100% !important;
			}
		}

		@media all {
			.ExternalClass {
				width: 100%;
			}

			.ExternalClass,
			.ExternalClass p,
			.ExternalClass span,
			.ExternalClass font,
			.ExternalClass td,
			.ExternalClass div {
				line-height: 100%;
			}

			.apple-link a {
				color: inherit !important;
				font-family: inherit !important;
				font-size: inherit !important;
				font-weight: inherit !important;
				line-height: inherit !important;
				text-decoration: none !important;
			}

			#MessageViewBody a {
				color: inherit;
				text-decoration: none;
				font-size: inherit;
				font-family: inherit;
				font-weight: inherit;
				line-height: inherit;
			}
		}
	</style>
</head>

<body
	style="
      font-family: Helvetica, sans-serif;
      -webkit-font-smoothing: antialiased;
      font-size: 16px;
      line-height: 1.3;
      -ms-text-size-adjust: 100%;
      -webkit-text-size-adjust: 100%;
      background-color: #efe9d8;
      margin: 0;
      padding: 0;
    ">
	<table
		role="presentation"
		border="0"
		cellpadding="0"
		cellspacing="0"
		class="body"
		style="
        border-collapse: separate;
        mso-table-lspace: 0pt;
        mso-table-rspace: 0pt;
        background-color: #efe9d8;
        width: 100%;
      "
		width="100%"
		bgcolor="#efe9d8">
		<tr>
			<td
				style="
            font-family: Helvetica, sans-serif;
            font-size: 16px;
            vertical-align: top;
          "
				valign="top">
				&nbsp;
			</td>
			<td
				class="container"
				style="
            font-family: Helvetica, sans-serif;
            font-size: 16px;
            vertical-align: top;
            max-width: 600px;
            padding: 0;
            padding-top: 24px;
            width: 600px;
            margin: 0 auto;
          "
				width="600"
				valign="top">
				<div
					style="
              font-size: 24px;
              text-align: center;
              padding-bottom: 32px;
              font-weight: bold;
            ">
					Wilder By Design
				</div>
				<div
					class="content"
					style="
              box-sizing: border-box;
              display: block;
              margin: 0 auto;
              max-width: 600px;
              padding: 0;
            ">
					<!-- START CENTERED WHITE CONTAINER -->
					<table
						role="presentation"
						border="0"
						cellpadding="0"
						cellspacing="0"
						class="main"
						style="
                border-collapse: separate;
                mso-table-lspace: 0pt;
                mso-table-rspace: 0pt;
                background: #ffffff;
                border: 1px solid #eaebed;
                border-radius: 4px;
                width: 100%;
              "
						width="100%">
						<!-- START MAIN CONTENT AREA -->
						<tr>
							<td
								class="wrapper"
								style="
                    font-family: Helvetica, sans-serif;
                    font-size: 16px;
                    vertical-align: top;
                    box-sizing: border-box;
                    padding: 32px;
                  "
								valign="top">
								<h1
									style="
                      font-family: Helvetica, sans-serif;
                      font-size: 32px;
                      font-weight: bold;
                      margin: 0;
                      margin-bottom: 32px;
                    ">
									<?php echo $cr_email_heading; ?>
								</h1>
								<p
									style="
                      font-family: Helvetica, sans-serif;
                      font-size: 16px;
                      font-weight: normal;
                      margin: 0;
                      margin-bottom: 32px;
                    ">
									<?php echo wpautop(wp_kses_post($cr_email_body)); ?>
								</p>
								<table
									role="presentation"
									border="0"
									cellpadding="0"
									cellspacing="0"
									class="btn btn-primary"
									style="
                      border-collapse: separate;
                      mso-table-lspace: 0pt;
                      mso-table-rspace: 0pt;
                      box-sizing: border-box;
                      width: 100%;
                      min-width: 100%;
											margin-top: 32px;
                    "
									width="100%">
									<tbody>
										<tr>
											<td
												align="left"
												style="
                            font-family: Helvetica, sans-serif;
                            font-size: 16px;
                            vertical-align: top;
                          "
												valign="top">
												<table
													role="presentation"
													border="0"
													cellpadding="0"
													cellspacing="0"
													style="
                              border-collapse: separate;
                              mso-table-lspace: 0pt;
                              mso-table-rspace: 0pt;
                              width: auto;
                            ">
													<tbody>
														<tr>
															<td
																style="
                                    font-family: Helvetica, sans-serif;
                                    font-size: 16px;
                                    vertical-align: top;
                                    border-radius: 4px;
                                    text-align: center;
                                    background-color: #151922;
                                  "
																valign="top"
																align="center"
																bgcolor="#151922">
																<a
																	href="<?php echo esc_url($cr_email_form_link); ?>"
																	target="_blank"
																	style="
                                      border: solid 2px #151922;
                                      border-radius: 4px;
                                      box-sizing: border-box;
                                      cursor: pointer;
                                      display: inline-block;
                                      font-size: 16px;
                                      font-weight: bold;
                                      margin: 0;
                                      padding: 12px 24px;
                                      text-decoration: none;
                                      text-transform: capitalize;
                                      background-color: #151922;
                                      border-color: #151922;
                                      color: #ffffff;
                                    "><?php esc_html_e($cr_email_review_btn); ?></a>
															</td>
														</tr>
													</tbody>
												</table>
											</td>
										</tr>
									</tbody>
								</table>
							</td>
						</tr>

						<!-- END MAIN CONTENT AREA -->
					</table>

					<!-- START FOOTER -->
					<div
						class="footer"
						style="
                clear: both;
                padding-top: 24px;
                text-align: center;
                width: 100%;
              ">
						<table
							role="presentation"
							border="0"
							cellpadding="0"
							cellspacing="0"
							style="
                  border-collapse: separate;
                  mso-table-lspace: 0pt;
                  mso-table-rspace: 0pt;
                  width: 100%;
                "
							width="100%">
							<tr>
								<td
									class="content-block"
									style="
                      font-family: Helvetica, sans-serif;
                      vertical-align: top;
                      color: #151922;
                      font-size: 16px;
                      text-align: center;
                    "
									valign="top"
									align="center">
									<p
										class="apple-link"
										style="
                        color: #151922;
                        font-size: 16px;
                        text-align: center;
                      ">
										<?php echo wp_kses_post(wpautop(wptexturize($cr_email_footer))); ?>
									</p>
								</td>
							</tr>
						</table>
					</div>

					<!-- END FOOTER -->

					<!-- END CENTERED WHITE CONTAINER -->
				</div>
			</td>
			<td
				style="
            font-family: Helvetica, sans-serif;
            font-size: 16px;
            vertical-align: top;
          "
				valign="top">
				&nbsp;
			</td>
		</tr>
	</table>
	<?php echo $cr_email_pixel; ?>
</body>

</html>