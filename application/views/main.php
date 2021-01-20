<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
<body>
	<!-- wrapper -->
    <?php 
	//debug area
	echo "</br>";
	 ?>
	<div id="wrapper">
		<div class="vertical-align-wrap">
			<div class="vertical-align-middle">
				<div class="auth-box ">
					<div class="left">
						<div class="content">
						  <div class="header">
								<div class="logo text-center"><img src="<?php echo base_url('assets/img/logo-small.png" alt="KCIC Logo')?>"></div>
								<p class="lead">Masuk ke Smart Office KCIC</p>
							</div>
                            
							<form action="<?php echo base_url('auth/login') ?>" method="post" class="form-auth-small">
								<div class="form-group">
									<label for="sso-email" class="control-label sr-only">Email</label>
									<input type="email" class="form-control" id="sso-email" name="sso-email" placeholder="Email">
								</div>
								<div class="form-group">
									<label for="sso-password" class="control-label sr-only">Kata Sandi</label>
									<input type="password" class="form-control" id="sso-password" name="sso-password" placeholder="Password">
								</div>
								<div class="form-group clearfix">
									<label class="fancy-checkbox element-left">
										<input type="checkbox">
										<span>Ingat Saya</span>
									</label>
								</div>
								<button type="submit" class="btn btn-primary btn-lg btn-block">LOGIN</button>
								<div class="bottom">
									<span class="helper-text"><i class="fa fa-lock"></i> <a href="#">Lupa Kata Sandi?</a></span>
								</div>
							</form>
						</div>
					</div>
					<div class="right">
						<div class="overlay"></div>
						<div class="content text">
							<h1 class="heading">Kereta Cepat Indonesia</h1>
							<p>Smart Office Employee Self Service</p>
						</div>
					</div>
					<div class="clearfix"></div>
				</div>
			</div>
		</div>
	</div>
	<!-- end wrapper -->
	<!-- Javascript -->
    <?php $this->view("inc/js"); ?>
    <!-- end Javascript -->
</body>

</html>
