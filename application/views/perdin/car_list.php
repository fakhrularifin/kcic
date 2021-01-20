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
					<h3 class="page-title">List Mobil Dinas</h3>
					<!-- page -->
					
					<div class="row">
				
				
						<div class="col-md-8">
							<div class="panel">
								
								<div class="panel-body">
									<table class="table">
										<thead>
											<th>No</th>
											<th>Merk</th>
											<th>Tipe</th>
											<th>Plat Nomor</th>
											<th>Status</th>
											<th></th>
										</thead>
										<tbody id="table-content"></tbody>
									</table>
								</div>
						
							</div>
							<!-- end content -->  
						</div>
						<div class="col-md-4" id="admin_panel" style="display:none">
							<div class="panel">
								<div class="panel-body">
									
									<form id="form-data" action="" method="post">
										<div class="form-group">
										<!--<label>Merk</label>
										<select class="form-control" id="merk" name="merk" placeholder="merk Mobil">
										<option value="TOYOTA">TOYOTA</option>
										<option value="HONDA">HONDA</option>
										<option value="DAIHATSU">DAIHATSU</option>
										<option value="MITSUBISHI">MITSUBISHI</option>
										<option value="KIA">KIA</option>
										</select>
										
										</div>-->
										<div class="form-group">
										<label>Merk Tipe Mobil</label><input type="text" class="form-control" id="merk" name="merk" placeholder="Merk tipe mobil, misal Toyota Rush">
										</div>
										<div class="form-group">
										<label>Tipe</label>
										<select class="form-control" id="tipe" name="tipe" placeholder="tipe Nomor">
										<option value="GANJIL">GANJIL</option>
										<option value="GENAP">GENAP</option>
										</select>
										</div>
										<div class="form-group">
										<label>Plat Nomor</label><input type="text" class="form-control" id="platNo" name="platNo" placeholder="Nomor Polisi">
										</div>
										<div class="form-group">
										<button id="form-btn" type="button" class="btn btn-primary" ><i class="fa fa-paper-plane-o"></i> Tambah Mobil</button>
										</div>
									</form>
									
								</div>
							</div>
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
				url: baseURL+"perdin/post_mobil",
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
				url: baseURL+"perdin/get_mobil", 
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
								if(jsondata['data'][i]['status']=='OCCUPIED') {
									var status_class = "label label-danger";
								} else {
									var status_class = "label label-success";
								}
								  table += "<tr>"+
										  "<td>"+(i+1)+"</td>"+
										  "<td>"+jsondata['data'][i]['merk']+"</td>"+
										  "<td>"+jsondata['data'][i]['tipe']+"</td>"+
										  "<td>"+jsondata['data'][i]['platNo']+"</td>"+
										  "<td><span class=\""+status_class+"\">"+jsondata['data'][i]['status']+"</span></td>"+
										  /*"<td><a href=\"<?php echo base_url('perdin/car_book?id=') ?>"+jsondata['data'][i]['id']+"\" class=\"btn btn-success\"> Booking </a></td>"+*/

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