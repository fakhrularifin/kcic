<?php 
	$user_logged = $this->session->userdata('email');
	if(	$user_logged == 'anggie.gunawan@kcic.co.id' ||
			$user_logged == 'andi.nugroho@kcic.co.id' ||
			$user_logged == 'dadang.hermawan@kcic.co.id' ||
			$user_logged == 'moh.irvan@kcic.co.id' 
			) {
				$is_manager = true;
			} else {
				$is_manager = false;
			}
	$guid_logged = $this->session->userdata('guid');
	if(	$guid_logged == '1004') {
				$is_admin = true;
			} else {
				$is_admin = false;
			}
 ?>
<div id="sidebar-nav" class="sidebar">
			<div class="sidebar-scroll">
				<nav>
					<ul class="nav">
						<li><a href="<?php echo base_url('dashboard') ?>" class="<?php echo $this->uri->segment(1) == 'dashboard' ? 'active' : ''?>"><i class="lnr lnr-home"></i> <span>Dashboard</span></a></li>
						<!--<li><a href="<?php //echo base_url('task') ?>" class=""><i class="lnr lnr-pencil"></i> <span>Tugas Saya</span></a></li>-->
						<li><a href="#subPages1" data-toggle="collapse" class="<?php echo $this->uri->segment(1) == 'meeting' ? 'active collapsed': 'collapse' ?>"><i class="lnr lnr-enter"></i> <span>Ruang Rapat</span><i class="icon-submenu lnr lnr-chevron-left"></i></a>
                        	<div id="subPages1" class="<?php echo $this->uri->segment(1) == 'meeting' ? 'collapsed': 'collapse' ?>">
								<ul class="nav">
									<li><a href="<?php echo base_url('meeting/meeting_list') ?>" class="<?php echo $this->uri->uri_string() == 'meeting/meeting_list' ? 'active': '' ?>">Jadwal Rapat</a></li>
									<li><a href="<?php echo base_url('meeting/room_list') ?>" class="<?php echo $this->uri->uri_string() == 'meeting/room_list' ? 'active': '' ?>">List Room</a></li>
									<li><a href="<?php echo base_url('meeting/room_book') ?>" class="<?php echo $this->uri->uri_string() == 'meeting/room_book' ? 'active': '' ?>">Book Room</a></li>
								<?php if ($is_admin==true) { ?>
									<li><a href="<?php echo base_url('meeting/room_approval') ?>" class="<?php echo $this->uri->uri_string() == 'meeting/room_approval' ? 'active': '' ?>">Approval</a></li>
								<?php } ?>
								</ul>
							</div>
                        </li>
                        <li><a href="#subPages2" data-toggle="collapse" class="<?php echo $this->uri->segment(1) == 'surat' ? 'active collapsed': 'collapse' ?>"><i class="lnr lnr-envelope"></i> <span>Surat</span><i class="icon-submenu lnr lnr-chevron-left"></i></a>
                        	<div id="subPages2" class="<?php echo $this->uri->segment(1) == 'surat' ? 'collapsed': 'collapse' ?>">
								<ul class="nav">
									<li><a href="<?php echo base_url('surat/inbox') ?>" class="<?php echo $this->uri->uri_string() == 'surat/inbox' ? 'active': '' ?>">Surat Masuk</a></li>
									<li><a href="<?php echo base_url('surat/outbox') ?>" class="<?php echo $this->uri->uri_string() == 'surat/outbox' ? 'active': '' ?>">Surat Keluar</a></li>
									<li><a href="<?php echo base_url('surat/arsip_new') ?>" class="<?php echo $this->uri->uri_string() == 'surat/arsip_new' ? 'active': '' ?>">Buat Surat Keluar</a></li>

								</ul>
							</div>
                        </li>
                         <li><a href="#subPages3" data-toggle="collapse" class="<?php echo $this->uri->segment(1) == 'cuti' ? 'active collapsed': 'collapse' ?>"><i class="lnr lnr-rocket"></i> <span>Cuti</span><i class="icon-submenu lnr lnr-chevron-left"></i></a>
                        	<div id="subPages3" class="<?php echo $this->uri->segment(1) == 'cuti' ? 'collapsed': 'collapse' ?>">
								<ul class="nav">
									<li><a href="<?php echo base_url('cuti/cuti_new') ?>" class="<?php echo $this->uri->uri_string() == 'cuti/cuti_new' ? 'active': '' ?>">Buat Pengajuan Cuti</a></li>
									<?php if ($is_admin==true) { ?>
									<li><a href="<?php echo base_url('cuti/cuti_approval') ?>" class="<?php echo $this->uri->uri_string() == 'cuti/cuti_approval' ? 'active': '' ?>">Approval</a></li>
									<?php } else {?>
									<li><a href="<?php echo base_url('cuti/cuti_list') ?>" class="<?php echo $this->uri->uri_string() == 'cuti/cuti_list' ? 'active': '' ?>">Daftar Pengajuan Cuti</a></li>
									<?php } ?>
								</ul>
							</div>
                        </li>
                        <li><a href="#subPages4" data-toggle="collapse" class="<?php echo $this->uri->segment(1) == 'perdin' ? 'active collapsed': 'collapse' ?>"><i class="lnr lnr-car"></i> <span>Peminjaman Mobil</span><i class="icon-submenu lnr lnr-chevron-left"></i></a>
                        	<div id="subPages4" class="<?php echo $this->uri->segment(1) == 'perdin' ? 'collapsed': 'collapse' ?>">
								<ul class="nav">
									<li><a href="<?php echo base_url('perdin/car_book') ?>" class="<?php echo $this->uri->uri_string() == 'perdin/car_book' ? 'active': '' ?>">Pengajuan Mobil Dinas</a></li>
									<?php if ($is_admin==true) { ?>
									<li><a href="<?php echo base_url('perdin/car_approval') ?>" class="<?php echo $this->uri->uri_string() == 'perdin/car_approval' ? 'active': '' ?>">Approval</a></li>
									<?php  } ?>
									<li><a href="<?php echo base_url('perdin/car_list') ?>" class="<?php echo $this->uri->uri_string() == 'perdin/car_list' ? 'active': '' ?>">Daftar Mobil</a></li>

								</ul>
							</div>
                        </li>
                        <li><a href="#subPages5" data-toggle="collapse" class="<?php echo $this->uri->segment(1) == 'alat_tulis_kantor' ? 'active collapsed': 'collapse' ?>"><i class="lnr lnr-cart"></i> <span>Pemesanan ATK</span><i class="icon-submenu lnr lnr-chevron-left"></i></a>
                        	<div id="subPages5" class="<?php echo $this->uri->segment(1) == 'alat_tulis_kantor' ? 'collapsed': 'collapse' ?>">
								<ul class="nav">
									<li><a href="<?php echo base_url('alat_tulis_kantor/order_list') ?>" class="<?php echo $this->uri->uri_string() == 'alat_tulis_kantor/order_list' ? 'active': '' ?>">List Pemesanan ATK</a></li>
									<?php if ($is_admin==true) { ?>
									<li><a href="<?php echo base_url('alat_tulis_kantor/atk_approval') ?>" class="<?php echo $this->uri->uri_string() == 'alat_tulis_kantor/atk_approval' ? 'active': '' ?>">Approval</a></li>
									<?php  } ?>

								</ul>
							</div>
                        </li>
					</ul>
				</nav>
			</div>
		</div>