<nav class="navbar navbar-default navbar-fixed-top">
			<div class="brand">
				<a href="<?php echo base_url('dashboard') ?>"><img src="<?php echo base_url('assets/img/logo-header.png')?>"  alt=" Logo" class="img-responsive logo"></a>
				<?php //echo $this->session->userdata('email')."<br>";?>
				<?php //echo $this->session->userdata('guid')."<br>";?>
				<?php //echo $this->session->userdata('token')."<br>";?>

			</div>
			<div class="container-fluid">
				<div class="navbar-btn">
				</div>
                <!-- fq:disable search form
				<form class="navbar-form navbar-left">
					<div class="input-group">
						<input type="text" value="" class="form-control" placeholder="Cari...">
						<span class="input-group-btn"><button type="button" class="btn btn-primary"><i class="lnr lnr-magnifier"></i></button></span>
					</div>
				</form>
                //-->
				<div id="navbar-menu">
					<ul class="nav navbar-nav navbar-right">
						<li class="dropdown">
							<a href="#" class="dropdown-toggle icon-menu" data-toggle="dropdown">
								<i class="lnr lnr-alarm"></i>
							<!--	<span class="badge bg-danger">3</span>-->
							</a>
							<ul class="dropdown-menu notifications">
								<li><a href="#" class="notification-item"><span class="dot bg-warning"></span>Anda Memiliki 2  surat masuk</a></li>
								<li><a href="#" class="notification-item"><span class="dot bg-danger"></span>Sewa ruangan anda telah berhasil</a></li>
								<li><a href="#" class="notification-item"><span class="dot bg-success"></span>Cuti anda disetujui</a></li>
								<!--<li><a href="#" class="more">Lihat semua Pemberitahuan</a></li>-->
							</ul>
						</li>
						<li class="dropdown">
							<a href="#" class="dropdown-toggle" data-toggle="dropdown"><img src="<?php echo base_url('assets/img/user.png')?>" class="img-circle" alt="Avatar"> <span><?php echo $this->session->userdata('name');?></span> <i class="icon-submenu lnr lnr-chevron-down"></i></a>
							<ul class="dropdown-menu">
								<li><a href="#"><i class="lnr lnr-envelope"></i> <span>Message</span></a></li>
								<li><a href="<?php echo base_url('main/logout') ?>"><i class="lnr lnr-exit"></i> <span>Logout</span></a></li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</nav>