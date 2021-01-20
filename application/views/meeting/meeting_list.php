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
					<h3 class="page-title">List Meeting Schedule</h3>
					<!-- page -->
					
					<div class="row">
						<!-- start content -->
						<div class="col-md-12">
							<!-- content2 -->
							<div class="panel">
								
								<div class="panel-body">
									<table class="table table-striped">
										<thead>
											<tr>
												<th>No</th>
												<th>Nama Ruangan</th>
												<!-- <th>Id ruangan</th> -->
												<th>Pengaju</th>
												<th>Tanggal</th>
												<th>Waktu</th>
												<th>Makan Siang</th>
												<th>Akun Zoom</th>
												<th>Video Conf</th>
												<th></th>
											</tr>
										</thead>
										<tbody id="table-content"></tbody>
									</table>
								</div>
								<div class="panel-footer">
									Room Available: <span class="label label-success">3</span>	
								</div>
							</div>
							
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
	<script>
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
					"<td colspan='9' class='text-center' style='vertical-align:middle;height:150px'>"+
					"<i class='fa fa-circle-o-notch fa-spin fa-4x text-muted'></i>"+
					"</td>"+
					"<tr>";
			$('#table-content').html(load);
		},
		success: function (jsondata) {
			console.log(jsondata);
					if(jsondata['data'].length != 0){
						for(var i = 0 ; i < jsondata['data'].length ; i++){
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
						  table += "<tr class='"+jsondata['data'][i]['statusDisetujui']+"'>"+
								  "<td>"+(i+1)+"</td>"+
								  "<td>"+jsondata['data'][i]['nama']+"</td>"+
								//   "<td>"+jsondata['data'][i]['idRuangRapat']+"</td>"+
								  "<td>"+jsondata['data'][i]['user']+"</td>"+
								  "<td>"+jsondata['data'][i]['tanggal']+"</td>"+
								  "<td>"+jsondata['data'][i]['jamMulai']+" - "+jsondata['data'][i]['jamAkhir']+"</td>"+
								  "<td>"+jsondata['data'][i]['makanSiang']+"</td>"+
								  "<td>"+jsondata['data'][i]['akunZoom']+"</td>"+
								  "<td>"+jsondata['data'][i]['videoConf']+"</td>"+
								  "<td><span class=\""+status_class+"\">"+jsondata['data'][i]['statusDisetujui']+"</span></td>"+								 
								
								"</tr>";
						}

						$('#table-content').hide().html(table).fadeIn();
					  
					}else{
						empty = "<tr>"+
								"<td colspan='9' class='text-center' style='vertical-align:middle;height:150px'>"+
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
    <!-- end Javascript -->
    </body>
</html>