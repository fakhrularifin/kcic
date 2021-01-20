<body>
	<!-- wrapper -->
	<div id="wrapper">
		<!-- nav top -->
		<?php $this->view("inc/nav-top"); ?>
		<!-- end navtop -->
		<!-- nav sidebar -->
		<?php $this->view("inc/nav-sidebar"); ?>
		<!-- end nav sidebar -->
		<!-- main -->
		<div class="main">
			<!-- main content -->
            <?php //debug area
				
			?>
			<div class="main-content">
				<div class="container-fluid">
					<!-- page -->
					<h3 class="page-title"><?php echo ucfirst($this->uri->segment(1)) ?></h3>
					<div class="row">
						<div class="col-md-9">
					<!-- <div class="panel panel-headline">
						<div class="panel-heading">
							
							<p class="panel-subtitle"></p>
						</div>
						<div class="panel-body"> -->
							<div class="row">
								<div class="col-md-4">
									<div class="metric">
										<div class="metric-body">
										<span class="icon"><i class="fa fa-calendar"></i></span>
										<p>
											<span class="number" id="ruang-rapat-tersedia"><i class="fa fa-circle-o-notch fa-spin"></i></span>
											<span class="title">R. Rapat Tersedia</span>
										</p>
										</div>
										<div class="metric-footer">
											<div class="more">
												<a href="<?php echo base_url('meeting/room_list') ?>" class="metric-link">Selengkapnya <i class="fa fa-angle-right"></i></a>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-4">
									<div class="metric">
										<div class="metric-body">
											<span class="icon"><i class="fa fa-download"></i></span>
											<p>
												<span class="number" id="surat-masuk"><i class="fa fa-circle-o-notch fa-spin"></i></span>
												<span class="title">Surat Masuk</span>
											</p>
										</div>
										<div class="metric-footer">
											<div class="more">
												<a href="<?php echo base_url('surat/inbox') ?>" class="metric-link">Selengkapnya <i class="fa fa-angle-right"></i></a>
											</div>
										</div>
									</div>
								</div>
								<!-- <div class="col-md-3">
									<div class="metric">
										<div class="metric-body">
											<span class="icon"><i class="fa fa-upload"></i></span>
											<p>
											
												<span class="number" id="surat-keluar"><i class="fa fa-circle-o-notch fa-spin"></i></span>
												<span class="title">Surat Keluar</span>
											
											</p>
										</div>
										<div class="metric-footer">
											<div class="more">
												<a href="<?php echo base_url('surat/outbox') ?>" class="metric-link">Selengkapnya <i class="fa fa-angle-right"></i></a>
											</div>
										</div>
									</div>
								</div> -->
								<div class="col-md-4">
									<div class="metric">
										<div class="metric-body">
											<span class="icon"><i class="fa fa-car"></i></span>
											<p>
											
												<span class="number" id="mobil-tersedia"><i class="fa fa-circle-o-notch fa-spin"></i></span>
												<span class="title">Mobil Tersedia</span>
											
											</p>
										</div>
										<div class="metric-footer">
											<div class="more">
												<a href="<?php echo base_url('perdin/car_book') ?>" class="metric-link">Selengkapnya <i class="fa fa-angle-right"></i></a>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="row">
							</div>
						<!-- </div>
					</div> -->
					<!-- end page -->
					<!-- <div class="row">
						<div class="col-md-9"> -->
							<!-- content2 -->
							<div class="panel" >
								<div class="panel-heading">
									<div class="panel-title">Jadwal Rapat</div>
								</div>
								<div class="panel-body no-padding" style="min-height:270px">
									<div class="table-responsive">
										<table class="table">
											<thead>
												<tr>
													<th>No</th>
													<th>Nama Ruangan</th>
													<!-- <th>Id ruangan</th> -->
													<th>Pengaju</th>
													<th>Tanggal</th>
													<th>Waktu</th>
													<th>Video Conf</th>
													<th></th>
												</tr>
											</thead>
											<tbody id="table-content"></tbody>
										</table>
									</div>
								</div>
								<div class="panel-footer">
									<div class="row">
										<!-- <div class="col-md-6"><span class="panel-note"><i class="fa fa-clock-o"></i> Last 24 hours</span></div> -->
										<div class="col-md-6"></div>
										<div class="col-md-6 text-right"><a href="<?php echo base_url('meeting/meeting_list') ?>" class="btn btn-primary">Lihat Semua Jadwal</a></div>
									</div>
								</div>
							</div>
							<!-- end content2 -->
						</div>
						<div class="col-md-3">
							<!-- content3 -->
							<div class="panel panel-presensi">
								<div class="panel-heading">
									<div class="panel-title">Presensi</div>
									<!-- <div class="right">
										<button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
										<button type="button" class="btn-remove"><i class="lnr lnr-cross"></i></button>
									</div> -->
                                 </div>
								<div class="panel-body">
									<div class="text-center">
									<div>
										<span><i class="fa fa-calendar"></i> <?php echo strftime("%A, %d %B %Y", strtotime(date('Y/m/d')))?></span>
										<div style="font-size:x-large" id="jam" class="text-bold"></div>
									</div>
									<br>
									
									<div class="row">
										<div class="col-xs-12">
											<button class="btn btn-block btn-success" id="btn_clockin" name="btn_clockin" type="button" disabled="disabled" style="white-space:normal">
												CLOCK IN
											</button>
											<button class="btn btn-block btn-primary" id="btn_clockout" name="btn_clockout" type="button" disabled="disabled" style="white-space:normal;display:none">
												CLOCK OUT
											</button>
											<button class="btn btn-block btn-primary" id="btn_load" type="button" disabled="disabled" style="white-space:normal;display:none">
												<i class="fa fa-circle-o-notch fa-spin"></i> Loading...
											</button>
										</div>
										
										<!-- <div class="col-xs-6">
											
										</div> -->
									</div>
									</div>
									<!-- <br> -->
								</div>
								<div class="panel-footer text-small">
									<div class="row">
										<div class="col-xs-6 text-center">
											<span class="lnr lnr-enter text-bold text-success"></span>
											<span id="clockin_time">.. : .. : ..</span>
										</div>
										<div class="col-xs-6 text-center">
											<span class="lnr lnr-exit text-bold text-danger"></span>
											<span id="clockout_time">.. : .. : ..</span>
										</div>
									</div>
								</div>
								</div>
								
								<div class="panel">
								<div class="panel-heading">
									<div class="panel-title">Quick Launch</div>
									<!-- <div class="right">
										<button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
										<button type="button" class="btn-remove"><i class="lnr lnr-cross"></i></button>
									</div> -->
                                 </div>
								<div class="panel-body no-padding">
									<div class="quicklaunch">
										<ul class="nav">
											<li>
												<a href="<?php echo base_url('surat/arsip_new') ?>"> 
													<span class="icon"><i class="fa fa-envelope"> </i></span> 
													<span class="text">Buat Surat Baru</span>
												</a>
											</li>
											<li>
												<a href="<?php echo base_url('cuti/cuti_new') ?>"> 
													<span class="icon"><i class="fa fa-calendar"> </i></span>
													<span class="text">Ajukan Cuti</span>
												</a>
											</li>
											<li>
												<a href="<?php echo base_url('perdin/car_book') ?>"> 
													<span class="icon"><i class="fa fa-car"> </i></span>
													<span class="text">Ajukan Perdin</span>
												</a>
											</li>
										</ul>
									</div>

									<!-- <p><a href="<?php echo base_url('surat/arsip_new') ?>">
									  <button type="button" class="btn btn-block btn-default btn-quicklaunch">
									  <span class="icon"><i class="fa fa-envelope"> </i></span> <span class="text">Buat Surat Baru</span>
									  </button>
									</a></p>
									<p><a href="<?php echo base_url('cuti/cuti_new') ?>">
									  <button type="button" class="btn btn-block btn-default btn-quicklaunch"> 
									  <span class="icon"><i class="fa fa-calendar"> </i></span>
									  <span class="text">Ajukan Cuti</span>
									  </button>
									</a></p>
									<p><a href="<?php echo base_url('perdin/car_book') ?>" class="">
									  <button type="button" class="btn btn-block btn-default btn-quicklaunch"> 
									  <span class="icon"><i class="fa fa-paper-plane-o"> </i></span>
									  <span class="text">Ajukan Perdin</span>
									  </button>
									</a></p> -->
									</div>
								</div>
							</div>
							<!-- end content3 -->
						</div>
						
					</div>

				</div>
			</div>
			<!-- end maincontent -->
		</div>
		<!-- end main -->
	<?php //$this->view("inc/footer"); ?>
	</div>
	<!-- end wrapper -->
	<!-- Javascript -->
    <?php $this->view("inc/js"); ?>
    <script>
		$(function(){
			function startTime() {
			var today = new Date();
			var h = today.getHours();
			var m = today.getMinutes();
			var s = today.getSeconds();
			m = checkTime(m);
			s = checkTime(s);
			$('#jam').html(h + ":" + m + ":" + s)
			var t = setTimeout(startTime, 500);
			}
			function checkTime(i) {
			if (i < 10) {i = "0" + i};  // add zero in front of numbers < 10
			return i;
			}

			startTime();
		});

	getDashboarddata();
	function getDashboarddata(){
		var table = "";
		$.ajax({ 
		type: 'POST', 
		//url: baseURL+"main/get_all_count", 
		url: baseURL+"main/get_overview",
		dataType: "json",
		success: function (jsondata) {
			//console.log(jsondata);
					//if(jsondata.length != 0){
					if(jsondata['data'].length != 0){
						//$('#ruang-rapat-tersedia').html(jsondata['count_ruang_rapat_tersedia']);
						//$('#surat-masuk').html(jsondata['count_surat_masuk']);
						//$('#surat-keluar').html(jsondata['count_surat_keluar']);
						//$('#mobil-tersedia').html(jsondata['count_mobil_tersedia']);
						
						$('#ruang-rapat-tersedia').html(jsondata['data']['ruangRapatTersedia']);
						$('#surat-masuk').html(jsondata['data']['suratMasuk']);
						$('#surat-keluar').html(jsondata['data']['suratKeluar']);
						$('#mobil-tersedia').html(jsondata['data']['mobilTersedia']);
					}else{
					  alert("Belum ada data");
					}
				  },
				  error:function(error){
					alert("Gagal memuat data");
				  }
		});
		}
	var presensi = false;
	function checkPresensi(){
			$.ajax({ 
				type: 'POST', 
				url: baseURL+"main/get_presensi",
				dataType: "json",
				beforeSend: function(){
					$("#btn_clockin").hide();
					$("#btn_clockout").hide();
					$("#btn_load").show();
				},
				success: function (data) {
						var jsondata = data;
						// console.log(jsondata);
						$("#btn_load").hide();
						if(jsondata.data !== null){
							if(jsondata['data']['in'] !== null){
								var clockin=(jsondata['data']['in']);
								$("#btn_clockin").attr("disabled", true);		
								$("#btn_clockout").attr("disabled", false);	
								$("#btn_clockin").hide();
								$("#btn_clockout").show();
								$('#clockin_time').html(clockin);
							}

							if(jsondata['data']['out'] != null){
								var clockout=(jsondata['data']['out']);	
								$('#clockout_time').html(clockout);
								// presensi = true;
							}
						} else {
						$("#btn_clockin").attr("disabled", false);
						$("#btn_clockout").hide();
						$("#btn_clockin").show();
						
							presensi = false;
						}
				},
				error:function(error){
					presensi = false;
				// alert('error');
				}
			});
	}
	checkPresensi();
	console.log(presensi);
	//console.log(checkPresensi());
		$('#btn_clockin').on('click', function(){
			if (presensi!== true) {
				$.ajax({ 
					type: 'POST', 
					url: baseURL+"main/post_presensi",
					dataType: "json",
					success: function (response) {
						checkPresensi();
						/* //console.log(jsondata);
						//$('#mobil-tersedia').html(jsondata['data']['mobilTersedia']);
						$('#btn_clockin').removeClass('btn btn-primary').addClass('btn btn-Success');
						$("#btn_clockin").attr("disabled", true);
						//alert('blmabsen'); */
					},
						error:function(error){
							//alert("Gagal kirim data");
					}
				});
			} else {
				//alert('sdhabsen');
			}
		});

		$('#btn_clockout').on('click', function(){
			if (presensi!== true) {
				$.ajax({ 
					type: 'POST', 
					url: baseURL+"main/post_presensi",
					dataType: "json",
					success: function (response) {
						checkPresensi();
					},
					error:function(error){
						alert("Gagal kirim data");
					}
				});
			} else {
				//alert('sdhabsen');
			}
		});
			
		$(document).ready(function(){
	getDynamictable();
	function getDynamictable(){
		var table = "";
		$.ajax({ 
		type: 'GET', 
		url: baseURL+"meeting/get_pengajuan_jadwal", 
		dataType: "json",
		beforeSend: function(){
			load = "<tr>"+
					"<td colspan='9' class='text-center' style='vertical-align:middle;height:250px'>"+
					"<i class='fa fa-circle-o-notch fa-spin fa-4x text-muted'></i>"+
					"</td>"+
					"<tr>";
			$('#table-content').html(load);
		},
		success: function (jsondata) {
			//console.log(jsondata);
					if(jsondata['data'].length != 0){
						for(var i = 0 ; i < jsondata['data'].length ; i++){
						if(jsondata['data'][i]['statusDisetujui']=='APPROVED'){
							if(jsondata['data'][i]['sifat']=='urgent') {
								var sifat_class = "label label-danger";
							} else {
								var sifat_class = "label label-success";
							}
							if(jsondata['data'][i]['statusDisetujui']=='APPROVED') {
								var status_class = "label label-success";
							} else if(jsondata['data'][i]['statusDisetujui']=='NOT APPROVED') {
								var status_class = "label label-warning";
							} else {
								var status_class = "label label-danger";
							}
							table += "<tr>"+
									"<td>"+(i+1)+"</td>"+
									"<td>"+jsondata['data'][i]['nama']+"</td>"+
									//   "<td>"+jsondata['data'][i]['idRuangRapat']+"</td>"+
									"<td>"+jsondata['data'][i]['user']+"</td>"+
									"<td>"+jsondata['data'][i]['tanggal']+"</td>"+
									"<td>"+jsondata['data'][i]['jamMulai']+" - "+jsondata['data'][i]['jamAkhir']+"</td>"+
									"<td class='text-center'>"+jsondata['data'][i]['videoConf']+"</td>"+
									"<td><span class=\""+status_class+"\">"+jsondata['data'][i]['statusDisetujui']+"</span></td>"+								 
									
									"</tr>";
							}
						}

						if(table == ''){
							table = "<tr>"+
								"<td colspan='7' class='text-center' style='vertical-align:middle;height:250px'>"+
								"<p class='text-muted'>Belum ada jadwal</p>"+
								"<a href='"+baseURL+"meeting/room_book' class='btn btn-sm btn-secondary'><i class='fa fa-plus'></i> Tambah Jadwal Rapat</a>"+
								"</td>"+
								"<tr>";
						}

						$('#table-content').hide().html(table).fadeIn();
					  
					}else{
						empty = "<tr>"+
								"<td colspan='7' class='text-center' style='vertical-align:middle;height:250px'>"+
								"<p class='text-muted'>Belum ada jadwal</p>"+
								"<a href='"+baseURL+"meeting/room_book' class='btn btn-sm btn-secondary'><i class='fa fa-plus'></i> Tambah Jadwal Rapat</a>"+
								"</td>"+
								"<tr>";
					  $('#table-content').hide().html(empty).fadeIn();
					}
				  },
				  error:function(error){
					//alert("gagal memuat data");
				  }
		});
		}
		
	});
	</script>
</body>

</html>
