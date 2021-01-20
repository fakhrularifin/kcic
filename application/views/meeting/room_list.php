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
					<!-- page -->
					<h3 class="page-title">List Room</h3>
					
							<div class="row">
								<div class="col-md-8">
								<!-- content2 -->
									<div class="panel">
										<div class="panel-body">
											<table class="table table-striped">
												<thead>
													<th>No</th>
													<th>Nama</th>
													<th>Lokasi</th>
													<th>Status</th>
													<th></th>
												</thead>
												<tbody id="table-content"></tbody>
											</table>
										</div>
									</div>
								</div>
								<div class="col-md-4" id="admin_panel" style="display:none" >
									<div class="panel">
										<div class="panel-body">
											<div class="panel-body" >
											<div class="row">
												<form id="form-data" class="form-horizontal" action="" method="post">
													<span>Nama Ruangan</span><input type="text" class="form-control date_form" name="nama" placeholder="Nama Ruangan">
													<br>
													<span>Lokasi</span><input type="text" class="form-control date_form" name="lokasi" placeholder="Lokasi Ruangan">
													<br>
													<button id="form-btn" type="button" class="btn btn-primary" ><i class="fa fa-paper-plane-o"></i> Tambah Ruangan</button>

												</form>
											</div>
										</div>
									</div>
								</div>
							</div>
							<!-- end content -->  
						
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
	$("#table-content").on("click", ".btns", function(){
	//alert($(this).data("fpid")+" "+$(this).val());
		//var params = new Array();
        //params['idCuti'] = $(this).data("fpid");
        //params['status'] = $(this).val();
		var dataId = $(this).data("fpid");
		var params = $(this).val();
        //actionButton(params['idCuti'], params['status']);
		var reqMethod = "POST";
		  var reqURL = baseURL+"cuti/post_followup_cuti";
		  var formData = "idCuti="+dataId+"&status="+params+"";
		  var dataType = "json";

		  $.ajax({
			type: reqMethod,
			url: reqURL,
			data: formData,
			dataType : dataType,
			  success: function (data) {
					//location.reload(); 
			  },
			  error:function(error){
				alert(ddata['status']);
			  }
		  });
		
		});
		
		$("#form-btn").click(function(){
			var data = $('#form-data').serialize();
			$.ajax({
				type: 'POST',
				url: baseURL+"meeting/post_ruang_rapat",
				data: data,
				success: function() {
					//$('.tampildata').load("tampil.php");
					 location.reload();
				}
			});
		});
		$(document).ready(function(){
			getDynamictable();
			function isAdmin() {
				var guid_logged = "<?php echo $this->session->userdata('guid'); ?>";
				//alert(group_logged);
				if(	guid_logged == '1004') { 
					return true;
					} else { 
					return false; 
				}
			}
			if(isAdmin() == true) {
				$("#admin_panel").show();
				}
				else {
				$("#admin_panel").hide(); 
			}
			function getDynamictable(){
				var table = "";
				$.ajax({ 
				type: 'GET', 
				url: baseURL+"meeting/get_current_jadwal", 
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
								if(jsondata['data'][i]['status']=='OCCUPIED') {
									var status_class = "label label-danger";
								} else {
									var status_class = "label label-success";
								}
								  table += "<tr>"+
										  "<td>"+(i+1)+"</td>"+
										  "<td>"+jsondata['data'][i]['nama']+"</td>"+
										  "<td>"+(typeof jsondata['data'][i]['lokasi'] != 'undefined' ? jsondata['data'][i]['lokasi'] : '-')+ "</td>"+
										//   "<td><span class=\""+status_class+"\"> Tersedia </span></td>"+
										  "<td><span class=\""+status_class+"\">"+jsondata['data'][i]['status']+"  </span></td>"+
										  "<td class='text-center'><a href=\"<?php echo base_url('meeting/room_book?id=') ?>"+jsondata['data'][i]['idRuangRapat']+"\" class=\"btn btn-xs btn-success\"> Booking </a></td>"+

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

		function actionButton(dataId,params){
  
		  var reqMethod = "POST";
		  var reqURL = baseURL+"cuti/post_followup_cuti";
		  var formData = "idCuti="+dataId+"&status="+params+"";
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
				var ddata = JSON.parse(data);

				if(ddata['status'] == 200){
					alert('horee');
				  //removeUser(params);
				}else{
				  var message = "<h5 class='text-danger'>"+ddata['message']+"</h5>";

				  $("#message-panel").show();
				  $("#message-body").html("<span class='text-danger'>"+message+"</span>");
				}
			  },
			  error:function(error){
				alert('Gagal');
			  }
		  });
		}
		
	});
	</script>
    <!-- end Javascript -->
    </body>
</html>