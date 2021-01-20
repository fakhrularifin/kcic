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
				<!-- breadcumb -->
				<?php $this->view("inc/breadcumb"); ?>
					<!-- end breadcumb -->
				<div class="container-fluid">
					<h3 class="page-title">Buat Pengajuan Cuti</h3>
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
								<form id="form-data"  action="" method="post">
									<div class="form-group">
									<label class="form-label" for="">Dari</label>
										<input type="text" class="form-control date_form" name="tanggal_mulai" placeholder="tanggal mulai cuti">
									</div>
									<div class="form-group">
										<label class="form-label" for="">Sampai</label>
										<input type="text" class="form-control date_form" name="tanggal_akhir" placeholder="tanggal selesai">
									</div>
									<div class="form-group">
									<label class="form-label" for="">Tipe Cuti</label>
									<label class="fancy-radio" >
										<input name="tipe" value="CUTI TAHUNAN" type="radio" checked>
										<span><i></i>Cuti Tahunan</span>
									</label>
									<label class="fancy-radio">
										<input name="tipe" value="CUTI ISTIMEWA" type="radio">
										<span><i></i>Cuti Istimewa</span>
									</label>
									</div>
									<div class="form-group">
									<label>Jenis Cuti</label><select name="jenis" class="form-control" id="jenis">
										<option value="CUTI TAHUNAN">Cuti Tahunan</option>
										<option value="CUTI MELAHIRKAN">Cuti Melahirkan</option>
										<option value="CUTI BESAR">Cuti Besar</option>
										<option value="CUTI PERNIKAHAN KARYAWAN">Cuti Pernikahan Karyawan</option>
										<option value="CUTI ISTRI MELAHIRKAN">Cuti Istri Melahirkan</option>
									</select>
									</div>
									<div class="form-group">
									<label>Alasan Cuti</label><textarea name="alasan" rows="4" class="form-control" id="alasan" placeholder="Alasan cuti"></textarea>
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
				url: baseURL+"cuti/post_pengajuan_cuti",
				data: data,
				success: function() {
					//$('.tampildata').load("tampil.php");
					alert('data disimpan');
					window.location = "<?php echo base_url('cuti/cuti_list');?>";
				}
			});
		});
	$(document).ready(function(){
		
	//dataProcess();
	function dataProcess(){
		var table = "";
		$.ajax({ 
		type: 'POST', 
		url: baseURL+"cuti/post_pengajuan_cuti", 
		dataType: "json",
		success: function (jsondata) {
			console.log(jsondata);
					if(jsondata['data'].length != 0){
						for(var i = 0 ; i < jsondata['data'].length ; i++){
						if(jsondata['data'][i]['sifat']=='urgent') {
							var sifat_class = "label label-danger";
						} else {
							var sifat_class = "label label-success";
						}
						if(jsondata['data'][i]['status']=='NOT APPROVED') {
							var status_class = "label label-danger";
						} else {
							var status_class = "label label-success";
						}
						  table += "<tr>"+
								  "<td>"+(i+1)+"</td>"+
								  "<td>"+jsondata['data'][i]['pengaju']+"</td>"+
								  "<td>"+jsondata['data'][i]['tanggalMulai']+"</td>"+
								  "<td>"+jsondata['data'][i]['tanggalAkhir']+"</td>"+
								  "<td>"+jsondata['data'][i]['tipe']+": "+jsondata['data'][i]['jenis']+"</td>"+
								  "<td>"+jsondata['data'][i]['alasan']+"</td>"+
								  "<td><span class=\""+status_class+"\">"+jsondata['data'][i]['status']+"</span></td>"+
								  "<td><button type=\"button\" class=\"btn btn-success\">Approve</button> <button type=\"button\" class=\"btn btn-danger\">Reject</button></td>"+
								"</tr>";
						}

						$('#table-content').html(table);
					  
					}else{
					  $('#table-content').html("Belum ada Data");
					}
				  },
				  error:function(error){
					//alert("gagal memuat data");
					$("#reg-info").html(error);
				  }
		});
		}
	});
	</script>
    <!-- end Javascript -->
    </body>
</html>