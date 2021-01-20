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
				<div class="container-fluid">
					<!-- page -->
					<div class="panel panel-headline">
                    <!-- breadcumb -->
						<?php $this->view("inc/breadcumb"); ?>
					<!-- end breadcumb -->
						<div class="panel-heading">
							<div class="panel-title">Persetujuan Mobil Dinas</div>
							<p class="panel-subtitle"></p>
						</div>
						<div class="panel-body">
							<div class="row">
                            	<!-- start content -->
						<div class="col-md-12">
							<!-- content2 -->
						  <div class="panel">
								<div class="panel-heading">
									<div class="right">
										<button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
										<button type="button" class="btn-remove"><i class="lnr lnr-cross"></i></button>
									</div>
								</div>
								<div class="panel-body no-padding">
								
								<table class="table table-condensed table-hover table-striped">
								<thead>
								<tr>
										<th>No</th>
										<th>Pengaju</th>
										<th>Dari</th>
										<th>Sampai</th>
										<th>Tujuan</th>
										<th>Tipe Mobil</th>
										<th>Jenis Mobil</th>
										<th>Catatan user</th>
										<th>Status</th>
										<th>Hotel</th>
										<th>Aksi</th>
								</tr>
								</thead>
								<tbody id="table-content"></tbody>
							  </table>
							  
								</div>
								<div class="panel-footer">
									<div class="row">
                                    total data: <span class="label label-success"></span>
									</div>
								</div>
							</div>
							<!-- start modal -->
                            <div id="modal-content" >
								<form id="form-data"  action="" method="post">
									<div id="edit-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
										<div class="modal-header">
											<h5 class="modal-title" id="exampleModalLabel">Approval peminjaman Mobil Dinas</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<div class="form-group">
											  <input type="hidden"  class="form-control" name="idPerdin" id="idPerdin">
										  </div>
											<div class="form-group">
											  <label>Pengaju</label>
												<input type="text" disabled class="form-control" name="pengaju" id="pengaju">
											</div>
											 
											<div class="form-group">Dari
											  <input type="text" disabled  name="tanggalMulai" id="tanggalMulai">
											  Sampai
											  <input type="text" disabled name="tanggalAkhir" id="tanggalAkhir">
										  </div>
										  <div class="form-group">Tujuan
											  <input type="text" disabled class="form-control" name="tujuan" id="tujuan">
										  </div>
										  <div class="form-group">Tipe Mobil
											  <input type="text" disabled class="form-control" name="tipeMobil" id="tipeMobil">
										  </div>
										  <div class="form-group">Butuh Penginapan
											  <input type="text" disabled class="form-control" name="hotel" id="hotel">
										  </div>
										  <div class="form-group">Catatan pengguna
											  <textarea disabled class="form-control mdl-catatan" name="catatanUser" id="catatanUser">
											  </textarea>
										  </div>
										 <div class="form-group">Approve?
												<label class="fancy-radio">
													<input name="status" value="APPROVED" type="radio">
													<span><i></i>APPROVE</span>
												</label>
												<label class="fancy-radio" >
													<input name="status" value="REJECTED" type="radio">
													<span><i></i>REJECT</span>
												</label>
												<br>
										</div>
										  <div class="form-group">Jenis Mobil
											  <select class="form-control" name="idMobil" id="idMobil">
											  </select>
										  </div>
										  <div class="form-group">Catatan untuk pengguna
											  <textarea class="form-control" name="catatanUntukUser" id="catatanUntukUser" rows="2"></textarea>
										  </div>
									</div>
									<div class="modal-footer">
										
                                    <button id="form-btn" type="button" class="btn btn-primary" ><i class="fa fa-paper-plane-o"></i> Kirim</button>                                        
                                        
									</div>

									</div>
								</div>
								</div>
							</form>
                            </div>
							<!-- end modal -->
							<!-- end content -->
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
	<script defer>
	

	$("#table-contents").on("click", ".btn", function(){
	//alert($(this).data("fpid")+" "+$(this).val());
		var dataId = $(this).data("fpid");
		//var params = $(this).val();
        //actionButton(params['idCuti'], params['status']);
		var reqMethod = "POST";
		  var reqURL = baseURL+"cuti/post_followup_perdin";
		  var formData = "idCuti="+dataId+"";
		  var dataType = "json";

		  //$("#splash-message").hide();
		  //$("#message-panel").show();
		  //$("#message-body").html("<span class='text-info'>text</span>");

		  $.ajax({
			type: reqMethod,
			url: reqURL,
			data: formData,
			dataType : dataType,
			  success: function (data) {
				var ddata = JSON.parse(data);

				if(ddata['status'] == 200){
					alert('horee');
				}else{
				  var message = "<h5 class='text-danger'>"+ddata['message']+"</h5>";

				  $("#message-panel").show();
				  $("#message-body").html("<span class='text-danger'>"+message+"</span>");
				}
			  },
			  error:function(error){
				alert(ddata['status']);
			  }
		  });
		
		});
	$("#table-content").on("click", ".btn-edit", function(){
            // get data from button edit
            //const id = $(this).data('id');
            //const name = $(this).data('name');
            //const price = $(this).data('price');
            //const category = $(this).data('category_id');
            // Set data to Form Edit
            //$('.product_id').val(id);
            //$('.product_name').val(name);
            //$('.product_price').val(price);
            //$('.product_category').val(category).trigger('change');
            // Call Modal Edit
			//alert('hahaha');
             $("#edit-modal").modal("show");
			$("#idPerdin").val($(this).closest('tr').children()[0].textContent);
			$("#pengaju").val($(this).closest('tr').children()[1].textContent);
			$("#tanggalMulai").val($(this).closest('tr').children()[2].textContent);
			$("#tanggalAkhir").val($(this).closest('tr').children()[3].textContent);
			$("#tujuan").val($(this).closest('tr').children()[4].textContent);
			$("#tipeMobil").val($(this).closest('tr').children()[5].textContent);
			$("#hotel").val($(this).closest('tr').children()[9].textContent);
			$("#catatanUser").val($(this).closest('tr').children()[7].textContent);
        });
		
	$('table tbody tr  td').on('click',function(){
		$("#edit-modal").modal("show");
		$("#pengaju").val($(this).closest('tr').children()[0].textContent);
		$("#tanggalMulai").val($(this).closest('tr').children()[1].textContent);
	});
	$(document).ready(function(){
	 // get Edit Form
    $('#edit-modal').on('show.bs.modal', function (e) {

    var _button = $(e.relatedTarget);

     console.log(_button, _button.parents("tr"));
    var _row = _button.parents("tr");
    var _catatan = _row.find(".mdl-catatan").text();
     console.log(_catatan);
    $(this).find(".mdl-catatan").val(_catatan);
});
	
 getDynamicmenu();
 function getDynamicmenu()
 {
  var html_menu = '<option value="">Pilih mobil tersedia</option>';
  $.ajax({ 
		type: 'GET', 
		url: baseURL+"perdin/get_mobil", 
		dataType: "json",
		success: function (jsondata) {
			var len = jsondata.length;
			console.log(jsondata);
					if(jsondata['data'].length != 0){
						for(var i = 0 ; i < jsondata['data'].length ; i++){
						  html_menu += '<option value="'+jsondata['data'][i]['id']+'">'+jsondata['data'][i]['tipe']+" "+jsondata['data'][i]['merk']+" "+jsondata['data'][i]['platNo']+'</option>';
						}
						$('#idMobil').html(html_menu);
					} 
					else{
						
					  $('#idMobil').html("Belum ada Data");
					}
				  },
				  error:function(error){
					//alert("gagal memuat data");
				  }
  });
 }

	
getDynamictable();
function getDynamictable(){
		var html_table = "";
		$.ajax({ 
		type: 'GET', 
		url: baseURL+"perdin/get_perdin", 
		dataType: "json",
		success: function (jsondata) {
			var len = jsondata.length;
			console.log(jsondata);
					if(jsondata['data'].length != 0){
						for(var i = 0 ; i < jsondata['data'].length ; i++){
						if(jsondata['data'][i]['sifat']=='urgent') {
							var sifat_class = "label label-danger";
						} else {
							var sifat_class = "label label-success";
						}
						if(jsondata['data'][i]['hotel']=='0') {
							var butuh_hotel = "Tidak";
						} else {
							var butuh_hotel = "Ys";
						}
						if(jsondata['data'][i]['status']=='NOT APPROVED' || jsondata['data'][i]['status']=='REJECTED') {
							var status_class = "label label-danger";
						} else {
							var status_class = "label label-success";
						}
						  html_table += "<tr>"+
								  "<td>"+(i+1)+"</td>"+
								  "<td>"+jsondata['data'][i]['pengaju']+"</td>"+
								  "<td>"+jsondata['data'][i]['tanggalMulai']+"</td>"+
								  "<td>"+jsondata['data'][i]['tanggalAkhir']+"</td>"+
								  "<td>"+jsondata['data'][i]['tujuan']+"</td>"+
								  "<td>"+jsondata['data'][i]['tipeMobil']+"</td>"+
								  "<td>"+jsondata['data'][i]['merk']+" "+jsondata['data'][i]['platNo']+"</td>"+
								  "<td class=\"mdl-catatan\">"+jsondata['data'][i]['catatanDariUser']+"</td>"+
								  "<td><span class=\""+status_class+"\">"+jsondata['data'][i]['status']+"</span></td>"+
								  "<td>"+butuh_hotel+"</td>"+
								  "<td><button type=\"button\" data-fpid=\""+jsondata['data'][i]['id']+"\" value=\"detail\" data-toggle=\"modal\" data-target=\"#con-close-modal\" class=\"btn btn-edit\"  ><span class=\"lnr lnr-pencil\"></span>  Detail</button><td>"+
								
								"</tr>";
						}

						$('#table-content').html(html_table);
					  
					} 
					else{
						
					  $('#table-content').html("Belum ada Data");
					}
				  },
				  error:function(error){
					//alert("gagal memuat data");
				  }
		});
		}
		
		$("#form-btn").click(function(){
			var data = $('#form-data').serialize();
			$.ajax({
				type: 'POST',
				url: baseURL+"perdin/post_followup_perdin",
				data: data,
				success: function() {
					//$('.tampildata').load("tampil.php");
					alert('data disimpan');
					location.reload(); 

				}
			});
		});
		
		function actionButton(dataId,params){
		  var reqMethod = "POST";
		  var reqURL = baseURL+"perdin/post_followup_perdin";
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