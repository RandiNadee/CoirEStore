<link rel="stylesheet" href="css/bootstrap.min.css"/>
<footer class="Footer" role="contentinfo" data-controller="FooterBreakpoints" id="yui_3_17_2_1_1689421921463_158" data-controllers-bound="FooterBreakpoints">
			<div class="Footer-inner clear" id="yui_3_17_2_1_1689421921463_157">
				<div class="sqs-layout sqs-grid-12 columns-12 Footer-blocks Footer-blocks--top sqs-alternate-block-style-container" data-layout-label="Footer Top Blocks" data-type="block-field" data-updated-on="1472726638185" id="footerBlocksTop">
					<div class="row sqs-row" id="yui_3_17_2_1_1689421921463_156">
						<div class="col sqs-col-12 span-12" id="yui_3_17_2_1_1689421921463_155">
							<div class="row sqs-row" id="yui_3_17_2_1_1689421921463_154">
								<div class="col sqs-col-3 span-3 mx-3 my-3">
									<div class="row sqs-row">
										<h3 class="footer-heading">Pages</h3>
										<div class="sqs-block-content">
											<ul class="list-unstyled" style="margin-left: 2%;">
												<li>
													<p class="" style="white-space:pre-wrap;"><a style="color:white;" href="index.php">Home</a>
												</li>
												<li>
													<p class="" style="white-space:pre-wrap;"><a style="color:white;" href="products.php">Products</a>
												</li>
												<li>
													<p class="" style="white-space:pre-wrap;"><a style="color:white;" href="cart.php">Cart</a>
												</li>
											</ul>
										</div>
									</div>
									<div class="row sqs-row">
										<h3 class="footer-heading">User Section</h3>
										<div class="sqs-block-content">
											<ul class="list-unstyled" style="margin-left: 2%;">
												<li>
													<p class="" style="white-space:pre-wrap;"><a style="color:white;" href="login_form.php">SignIn</a>
												</li>
												<li>
													<p class="" style="white-space:pre-wrap;"><a style="color:white;" href="customer_registration.php?register=1">Register</a>
												</li>
											</ul>
										</div>
									</div>
								</div>
								<div class="col sqs-col-3 span-3 mx-3 my-3">
									<h3 class="footer-heading">Find Us</h3>
									<div class="row sqs-row" style="margin-left: 2%; margin-bottom: 4%;">
										<div class="sqs-block-content">
											<b>InterCoir (PVT) Ltd </b><br>
											Industrial Estate, <br>
											Ekala. <br>
											+9471-6524555 <br>
										</div>
									</div>
									<div class="row sqs-row" style=" margin-top: 50px;">
										<h3 class="footer-heading">Top Product Categories</h3>
										<div class="sqs-block-content" style="margin-left: 10px;">
											<ul class="list-unstyled" id="hot_cat">
												<script>
													var cat = [];
													$.ajax({
														url: "action.php",
														method: "POST",
														data: {
															get_hot_categories: 1
														},
														success: function(data) {
															console.log(data);
															var resp = $.parseJSON(data);
															var catHTML = '';
															$.each(resp.message, function(index, value) {
																catHTML += '<li style="margin-bottom: 10px;">' +
																	'<p class="" style="white-space:pre-wrap;"><a style="color:white;" href="products.php">' + value.cat_title + '</a>' +
																	'</li>';
															});

															$("#hot_cat").html(catHTML);
														}
													})
													cat;
												</script>
												<li>
													<p class="" style="white-space:pre-wrap;"><a style="color:white;" href="login.php">Login</a>
												</li>
												<li>
													<p class="" style="white-space:pre-wrap;"><a style="color:white;" href="customer_register.php">Register</a>
												</li>
											</ul>
										</div>
									</div>
								</div>
								<div class="col sqs-col-6 span-6" id="yui_3_17_2_1_1689421921463_153">
									<div class="row sqs-row" id="yui_3_17_2_1_1689421921463_152">
										<div class="col sqs-col-2 span-2">
											<div class="sqs-block spacer-block sqs-block-spacer sized vsize-1" data-block-type="21" id="block-yui_3_17_2_2_1472113244815_9531">
												<div class="sqs-block-content">&nbsp;</div>
											</div>
										</div>
										<div class="col sqs-col-3 span-3" id="yui_3_17_2_1_1689421921463_151" style="text-align: center; font-style:italic">
											<h2 class="footer-heading footer-heading-white" style="text-align: center; font-style:italic">Send us feedback</h2>
											<form class="contact-form" id="feedback-form">
												<div class="form-group">
													<input type="text" name="name" class="form-control" placeholder="Your Name">
												</div>
												<div class="form-group">
													<input type="text" name="email" class="form-control" placeholder="Your Email">
												</div>
												<div class="form-group">
													<input type="text" name="subject" class="form-control" placeholder="Subject">
												</div>
												<div class="form-group">
													<textarea name="message" cols="30" rows="3" class="form-control" placeholder="Message"></textarea>
												</div>
												<div class="form-group">
													<button type="button" class="form-control submit-feedback px-3">Send Feedback</button>
												</div>
											</form>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="Footer-middle">
					<div class="Footer-business">
					</div>
					<div class="sqs-layout sqs-grid-12 columns-12 Footer-blocks Footer-blocks--middle sqs-alternate-block-style-container" data-layout-label="Footer Middle Blocks" data-type="block-field" data-updated-on="1565442842311" id="footerBlocksMiddle">
						<div class="row sqs-row">
							<div class="col sqs-col-1 span-1">
								<div class="sqs-block spacer-block sqs-block-spacer sized vsize-1" data-block-type="21" id="block-yui_3_17_2_4_1456325535463_5766">
									<div class="sqs-block-content">&nbsp;</div>
								</div>
							</div>
							<div class="col sqs-col-10 span-10">
								<div class="sqs-block html-block sqs-block-html" data-block-type="2" id="block-yui_3_17_2_2_1456325002802_36163">
									<div class="sqs-block-content">
										<p style="text-align:center;white-space:pre-wrap;" class="">© <script>
												document.write(new Date().getFullYear());
											</script> Coir E-Store. All Rights Reserved || Created by Randi</p>
									</div>
								</div>
							</div>
							<div class="col sqs-col-1 span-1">
								<div class="sqs-block spacer-block sqs-block-spacer sized vsize-1" data-block-type="21" id="block-yui_3_17_2_8_1470681800799_35356">
									<div class="sqs-block-content">&nbsp;</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</footer>