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
					<h3 class="page-title">List Pemesanan Alat Tulis Kantor</h3>

					<div class="row">
						<!-- start content -->
						<div class="col-md-12">
							<!-- content2 -->
							<div class="panel">
								<div class="panel-heading">
									
								</div>
								<div class="panel-body">
								
									<table class="table table-striped">
										<thead>
											<th>No</th>
											<th>Tgl Pemesanan</th>
											<th>Jenis</th>
											<th>Jumlah</th>
											<th>Pengaju</th>
											<th>Status</th>
										</thead>
										<tbody id="table-content"></tbody>
									</table>
							
								</div>
								<!-- <div class="panel-footer">
									Total Pengajuan Cuti: <span class="label label-success"></span>
								</div> -->
							</div>
							<!-- end content -->
						</div>
					</div>
				</div>
				<div id="modal-content" >
					<form id="form-data"  action="" method="post">
						<div id="order-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<div class="modal-content">
							<div class="modal-header">
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
								</button>
								<h5 class="modal-title" id="exampleModalLabel">Pesan Alat Tulis Kantor</h5>
								
							</div>
							<div class="modal-body">
								<div class="form-group row">
									<label class="control-label col-md-12">Jenis ATK</label>
									<div class="col-md-9">
										<select class="form-control" name="jenis" id="jenis">
											<option value="">-- Pilih Jenis ATK --</option>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label class="control-label col-md-12">Jumlah</label>
									<div class="col-md-3">
										<input type="number" class="form-control" name="jumlah" id="jumlah" min="0" value="0" autocomplete="off">
									</div>
									<div class="col-md-3">
									<input type="text" class="form-control" name="unit" id="unit" readonly>
									</div>
								</div>
								
							</div>
							<div class="modal-footer">
								<button id="order-btn" type="button" class="btn btn-primary" ><i class="fa fa-paper-plane-o"></i> Kirim</button>
							</div>
						</div>
					</div>
					</div>
				</form>
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
	<script defer="defer">		
	$(document).ready(function(){
	getDynamictable();
	function isManager() {
		var user_logged = "<?php echo $this->session->userdata('email'); ?>";
		if(	user_logged == 'anggie.gunawan@kcic.co.id' ||
			user_logged == 'andi.nugroho@kcic.co.id' ||
			user_logged == 'dadang.hermawan@kcic.co.id' ||
			user_logged == 'moh.irvan@kcic.co.id' 
		) { 
			return true;
			} else { 
			return false; 
		}
	}
	function getDynamictable(){
		var table = "";
		var table_button = "";
		var user_logged = "<?php echo $this->session->userdata('email'); ?>";

		$.ajax({ 
		type: 'GET', 
		url: baseURL+"cuti/get_cuti_user", 
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
			// console.log(jsondata);

					if(jsondata['data'].length != 0){
						for(var i = 0 ; i < jsondata['data'].length ; i++){
							
						/* if((isManager() == true) && (jsondata['data'][i]['status']=='')) {
							table_button = "<td><button type=\"button\" data-fpid=\""+jsondata['data'][i]['id']+"\" value=\"approved\" class=\"btn btn-success\">Approve</button> <button type=\"button\" data-fpid=\""+jsondata['data'][i]['id']+"\" value=\"rejected\" class=\"btn btn-danger\">Reject</button></td>";
						} else { */
							table_button = "<td></td>";
						// }
						if(jsondata['data'][i]['sifat']=='urgent') {
							var sifat_class = "label label-danger";
						} else {
							var sifat_class = "label label-success";
						}
						
						if(jsondata['data'][i]['status']=='APPROVED') {
							var status_class = "label label-success";
						} else {
							var status_class = "label label-danger";
						}
						  /* table += "<tr>"+
								  "<td>"+(i+1)+"</td>"+
								  "<td>"+jsondata['data'][i]['pengaju']+"</td>"+
								  "<td>"+jsondata['data'][i]['tanggalMulai']+"</td>"+
								  "<td>"+jsondata['data'][i]['tanggalAkhir']+"</td>"+
								  "<td>"+jsondata['data'][i]['tipe']+" - "+jsondata['data'][i]['jenis']+"</td>"+
								  "<td>"+jsondata['data'][i]['alasan']+"</td>"+
								  "<td><span class=\""+status_class+"\">"+jsondata['data'][i]['status']+"</span></td>"+
								  table_button+
								"</tr>"; */

								empty = "<tr>"+
								"<td colspan='7' class='text-center' style='vertical-align:middle;height:250px'>"+
								"<p class='text-muted'>Belum ada pemesanan ATK</p>"+
								"<a type='button' class='btn btn-sm btn-secondary' href='"+baseURL+"alat_tulis_kantor/new_order'><i class='fa fa-plus'></i> Tambah Pesanan</a>"+
								"</td>"+
								"<tr>";
						}

						$('#table-content').hide().html(empty).fadeIn();
						// $('#table-content').hide().html(table).fadeIn();
					  
					}else{
						empty = "<tr>"+
								"<td colspan='7' class='text-center' style='vertical-align:middle;height:250px'>"+
								"<p class='text-muted'>Belum ada pengajuan cuti</p>"+
								"<button type='button' class='btn btn-sm btn-secondary' data-toggle='modal' data-target='#order-modal'><i class='fa fa-plus'></i> Tambah Pesanan</button>"+
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
    <!-- end Javascript -->
    </body>
</html>