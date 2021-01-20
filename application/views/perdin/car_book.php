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

            <?php //fq:debug area
				//echo var_dump($this->session->userdata); 
			?>			
        <!-- main content -->
			<div class="main-content">
				<?php $this->view("inc/breadcumb"); ?>
				<div class="container-fluid">
					<h3 class="page-title">Peminjaman Mobil Dinas</h3>
					<!-- page -->
					
							<div class="row">
                            
                            	<!-- start content -->
								<div class="col-md-12">
									<!-- content2 -->
									<div class="panel">
										<!-- <div class="panel-heading">
											<div class="right">
												<button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
												<button type="button" class="btn-remove"><i class="lnr lnr-cross"></i></button>
											</div>
										</div> -->
										<div class="panel-body">
											<form id="form-data" action="" method="post">
												<div class="form-group">
													<label>Dari</label><input type="text" class="form-control date_form" name="tanggal_mulai" placeholder="tanggal mulai pinjam">
												</div>
												<div class="form-group">
													<label>Sampai</label><input type="text" class="form-control date_form" name="tanggal_akhir" placeholder="tanggal selesai">
												</div>
												<div class="form-group">
													<label>Tujuan</label><input type="text" class="form-control" name="tujuan" placeholder="tujuan tempat dinas">
												</div>
												<div class="form-group">
													<label>Tipe Mobil</label>
												<label class="fancy-radio">
													<input name="tipe_mobil" value="GANJIL" type="radio">
													<span><i></i>Ganjil</span>
												</label>
												<label class="fancy-radio" >
													<input name="tipe_mobil" value="GENAP" type="radio">
													<span><i></i>Genap</span>
												</label>
												</div>
												<div class="form-group">
													<label>Butuh reservasi penginapan</label>
													<label class="fancy-radio">
														<input name="hotel" value="1" type="radio">
														<span><i></i>Ya</span>
													</label>
													<label class="fancy-radio" >
														<input name="hotel" value="0" type="radio">
														<span><i></i>Tidak</span>
													</label>
												</div>
												<div class="form-group">
													<label>Catatan</label><textarea name="catatan_dariuser" rows="4" class="form-control" id="catatan_dariuser" placeholder="Catatan"></textarea>
												</div>
												<div class="form-group">
													<button id="form-btn" type="button" class="btn btn-primary" ><i class="fa fa-paper-plane-o"></i> Kirim</button>
													<button type="reset" class="btn btn-default"><i class="fa fa-refresh"></i> Reset</button>
												</div>
											</form>
										</div>
										
									</div>
									<div class="tampildata"></div>
									<!-- end content -->
								</div>
							</div>
						
					<!-- end page -->
				</div>
			</div>
			<!-- end main content -->
		</div>
		<!-- end main -->
        <!-- footer -->
		<?php //$this->view("inc/footer"); ?>
        <!-- end footer -->
      </div>
      <!-- end wrapper -->
    <!-- Javascript -->
<?php $this->view("inc/js"); ?>
	<script defer>
	$( function() {
		$( ".date_form" ).datepicker();
		$( ".date_form" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
	} );
	$("#form-btn").click(function(){
			var data = $('#form-data').serialize();
			$.ajax({
				type: 'POST',
				url: baseURL+"perdin/post_perdin",
				data: data,
				success: function() {
					//$('.tampildata').load("tampil.php");
					//alert('data disimpan');
					window.location = "<?php echo base_url('perdin/car_approval');?>";
				}
			});
		});
	</script>
    <!-- end Javascript -->
    </body>
</html>