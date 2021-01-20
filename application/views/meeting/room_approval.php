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
					<!-- page -->
					<h3 class="page-title">List Approval Meeting room</h3>
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
													<th>Pengaju</th>
													<th>Tanggal</th>
													<th>Waktu</th>
													<th>Makan siang</th>
													<th>Akun Zoom</th>
													<th>Video Conf</th>
													<th>Status</th>
													<th>Aksi</th>
												</tr>
											</thead>
											<tbody id="table-content"></tbody>
										</table>
									</div>
									<div class="panel-footer">
										Total Approval: <span class="label label-success" id="total_approval"></span>
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
	$("#table-content").on("click", ".btn", function(){
	//alert($(this).data("fpid")+" "+$(this).val());
		//var params = new Array();
        //params['id'] = $(this).data("fpid");
        //params['status'] = $(this).val();
		var dataId = $(this).data("fpid");
		var params = $(this).val();
        //actionButton(params['id'], params['status']);
		var reqMethod = "POST";
		  var reqURL = baseURL+"meeting/post_update_status_jadwal";
		  var formData = "id="+dataId+"&status="+params+"";
		  var dataType = "json";

		  //$("#splash-message").hide();
		  //$("#message-panel").show();
		  //$("#message-body").html("<span class='text-info'>Letakkan sidik jari <strong>"+activeUserID+" - ["+activeLevelID+"] - "+activeUserName+"</strong> pada FP Scanner untuk mutasi user</span>");

		  $.ajax({
			type: reqMethod,
			url: reqURL,
			data: formData,
			dataType : dataType,
			  success: function (data) {
					location.reload(); 
			  },
			  error:function(error){
				alert(ddata['status']);
			  }
		  });
		
		});
	
	$(document).ready(function(){
	getDynamictable();
	function getDynamictable(){
		var table = "";
		$.ajax({ 
		type: 'GET', 
		url: baseURL+"meeting/get_pengajuan_jadwal", 
		dataType: "json",
		success: function (jsondata) {
			console.log(jsondata);
			$('#total_approval').html(jsondata['data'].length);
					if(jsondata['data'].length != 0){
						for(var i = 0 ; i < jsondata['data'].length ; i++){
						if(jsondata['data'][i]['sifat']=='urgent') {
							var sifat_class = "label label-danger";
						} else {
							var sifat_class = "label label-success";
						}
						if(jsondata['data'][i]['statusDisetujui']=='APPROVED') {
							var status_class = "label label-success";
						} 
						else if(jsondata['data'][i]['statusDisetujui']=='NOT APPROVED') {
							var status_class = "label label-warning";
						} 
						else {
							var status_class = "label label-danger";
						}
						  table += "<tr>"+
								  "<td>"+(i+1)+"</td>"+
								  "<td>"+jsondata['data'][i]['nama']+"</td>"+
								//   "<td>"+jsondata['data'][i]['idRuangRapat']+"</td>"+
								  "<td>"+jsondata['data'][i]['user']+"</td>"+
								  "<td>"+jsondata['data'][i]['tanggal']+"</td>"+
								  "<td>"+jsondata['data'][i]['jamMulai']+" - "+jsondata['data'][i]['jamAkhir']+"</td>"+
								  "<td class=''>"+jsondata['data'][i]['makanSiang']+"</td>"+
								  "<td>"+jsondata['data'][i]['akunZoom']+"</td>"+
								  "<td>"+jsondata['data'][i]['videoConf']+"</td>"+
								  "<td><span class=\""+status_class+"\">"+jsondata['data'][i]['statusDisetujui']+"</span></td>"+
								  "<td><button type=\"button\" data-fpid=\""+jsondata['data'][i]['id']+"\" value=\"approved\" class=\"btn btn-xs btn-block btn-success\">Approve</button> <button type=\"button\" data-fpid=\""+jsondata['data'][i]['id']+"\" value=\"rejected\" class=\"btn btn-xs btn-block btn-danger\">Reject</button></td>"+
								 
								
								"</tr>";
						}

						$('#table-content').hide().html(table).fadeIn();
					  
					}else{
						empty = "<tr>"+
								"<td colspan='9' class='text-center' style='vertical-align:middle;height:150px'>"+
								"<p class='text-muted'>Belum ada data</p>"+
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