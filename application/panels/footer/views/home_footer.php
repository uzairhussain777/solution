<footer>
		<div class="content">
			<div class="footer-content">
			<img src="<?php echo $this->config->base_url(); ?>r/images/footer-content-logo.png">
			<p>In at convallis sapien. Etiam ut ipsum magna. Vivamus vitae dolor eu dui porta faucibus. Quisque eget felis tempus metus luctus porta. Maecenas sit amet felis est. Aliquam a vulputate ligula, non rhoncus mi. Vivamus vitae odio risus. Mauris sed sapien lacus. Sed sit amet purus in eros consectetur fringilla non nec justo.</p>
			</div>  <!-- /end footer content -->
			<div class="footer-links">
				<div class="footer-links-left">
						<div class="footer-col-left">
							<h4>Related Links</h4>
							<ul class="related-links">
								<!-- <li><a href="#">How it works</a></li> -->
								<li><a href="<?php echo $this->config->base_url(); ?>pages?content=about-us">About us</a></li>
								<li><a href="<?php echo $this->config->base_url(); ?>contactus">Contact us</a></li>
								 <li>
								 			<a href="<?php echo $this->config->base_url(); ?>pages?content=privacy-policy"> Privacy Policy</a>
		
								 </li>
							</ul>
						</div>   <!-- /end footer col left-->
						<div class="footer-col-left">
							<h4>Categories</h4>
							<?php if(!empty($result)){?>
								<?php foreach ($result as $key) {?>
									<ul class="categories">
										<li><a href="<?php echo $this->config->base_url(); ?>categories/<?php echo $key->slug?>"><?php echo $key->category_name; ?></a></li>
									</ul>
								<?php } ?>
							<?php } else {?>
								<ul class="categories">
										<li style="color: #ffff;"><?php echo "No categories found"; ?></li>
									</ul>
							<?php }?>
						</div>   <!-- /end footer col left -->
					</div>   <!-- /end footer links left -->

					<div class="footer-links-right">

						<div class="footer-col-right">
							<h4>Connect with us</h4>
							<ul class="social-links">
								<li><a href="#"><span><img src="<?php echo $this->config->base_url(); ?>r/images/facebook-icon.png"></span>Facebook</a></li>
								<li><a href="#"><span><img src="<?php echo $this->config->base_url(); ?>r/images/twitter-icon.png"></span>Twitter</a></li>
								<li><a href="#"><span><img src="<?php echo $this->config->base_url(); ?>r/images/instagram-icon.png"></span>Instagram</a></li>
							</ul>
						</div>   <!-- /end footer col right -->

						<div class="footer-col-right">
							<h4>Location</h4>
							<ul class="location">
								<li><a href="#">2132 Folsom St., Ste 2<br> San Francisco, CA 94110<br>
									+1 (256) 792-8747<br> Locate@solution_new.org</a></li>
							</ul>
						</div>   <!-- /end footer col right -->
					</div>   <!-- /end footer links right -->
		</div>  <!-- /end footer links -->
	</footer>

		<section class="copyrights">
			<div class="content">
				<div class="copyrights-info">
					<span>&copy; Copyrights 2019  All rights Reserved by Solution_New</span>
				</div>  <!-- /end copyrights info -->
				<div class="quick-links-bottom">
					<ul>
						<li><a href="<?php echo $this->config->base_url(); ?>pages?content=privacy-policy">Privacy Policy</a></li>
						<li><a href="<?php echo $this->config->base_url(); ?>pages?content=about-us">About Us</a></li>
						<li><a href="<?php echo $this->config->base_url(); ?>contactus" >Contact Us</a></li>
					</ul>
				</div>   <!-- /end quick links bottom -->
			</div>	<!-- /end content -->
		</section>	<!-- /end copyrights -->

		

