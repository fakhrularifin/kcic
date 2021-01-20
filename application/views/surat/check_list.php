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
							<div class="panel-title">List Surat Harus Diperiksa</div>
							<p class="panel-subtitle"></p>
						</div>
						<div class="panel-body">
							<div class="row">
                            	<!-- start content -->
						<div class="col-md-12">
							<!-- content2 -->
							<div class="panel">
								<div class="panel-body">
								<table id="table-dynamic" class="table table-striped" style="width:100%">
								<thead>
										<th>Tanggal Surat</th>
										<th>Nomor Surat</th>
										<th>Jenis Surat</th>
										<th>Asal Surat</th>
										<th>Tujuan Surat</th>
										<th>Perihal</th>
										<th>Sifat</th>
										<th>Rujukan</th>
										<th>Aksi</th>
								</thead>
								<tbody id="table-dynamic"></tbody>
							  </table>
							  
								</div>
								<div class="panel-footer">
									<div class="row">
                                    total Surat Masuk: <span class="label label-success"></span>
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
											<h5 class="modal-title" id="exampleModalLabel">Surat Harus Diperiksa</h5>
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
											</button>
										</div>
										<div class="modal-body">
											<div class="form-group">
											  <input type="hidden"  class="form-control" name="idSurat" id="idSurat">
										  </div>
											<div class="form-group">
											  <label>Nomor Surat</label>
												<input type="text" disabled class="form-control" name="nomorSurat" id="nomorSurat">
												
											  <label>Sifat </label>
												<span id="sifat" class="label label-default"></span>
												
											 <label>Tanggal Surat</label>
												<input type="text" disabled class="form-control" id="tanggalSurat">
											</div>
											 
											<div class="form-group">jenis surat
											  <input type="text" disabled class="form-control" name="jenisSurat" id="jenisSurat">
										  </div>
										  <div class="form-group">Perihal :
											  <input type="text" disabled class="form-control" name="perihal" id="perihal">
										  </div>
										  <div class="form-group">pengirim
											  <input type="text" disabled class="form-control" name="pengirim" id="pengirim">
										  </div>
										  <div class="form-group">penerima
											  <input type="text" disabled class="form-control" name="penerima" id="penerima">
										  </div>
										  <div class="form-group">Cc
											  <input type="text" disabled class="form-control" name="penerimaCc" id="penerimaCc">
										  </div>
										  <div class="form-group">rujukan
											  <input type="text" disabled class="form-control" name="rujukan" id="rujukan">
										  </div>

										  <div class="form-group">Memo
											  <textarea disabled class="form-control mdl-catatan" name="memo" id="memo">
											  </textarea>
										  </div>
																			
										 <div class="form-group">Approve? <br>
										 <input type="radio" id="status" name="status" checked="checked" value="APPROVED" class="radio_status" /> <span><i></i>APPROVE</span> <br> 
										 <input type="radio" id="status" name="status" value="REJECT" class="radio_status"/> <span><i></i>REJECT</span> <br>
										 <input type="radio" id="status" name="status" value="REVISED" class="radio_status"/> <span><i></i>REVISE</span><br>
										<br>
										</div>
										<div class="form-group" id="hide_element" style="display:none;">Nota Perbaikan
											  <textarea class="form-control mdl-catatan" name="notaPerbaikan" id="notaPerbaikan"></textarea>
										  </div>
									</div>
									<div class="modal-footer">
										
                                    <button id="form-btn" type="button" class="btn btn-primary" ><i class="fa fa-paper-plane-o"></i> Simpan</button>                                        
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
	/*
	$("#table-dynamic").on("click", ".btn-edit", function(){
		$("#edit-modal").modal("show");
		$("#idPerdin").val($(this).closest('tr').children()[0].textContent);
		$("#pengaju").val($(this).closest('tr').children()[1].textContent);
		$("#tanggalMulai").val($(this).closest('tr').children()[2].textContent);
		$("#tanggalAkhir").val($(this).closest('tr').children()[3].textContent);
		$("#tujuan").val($(this).closest('tr').children()[4].textContent);
		$("#tipeMobil").val($(this).closest('tr').children()[5].textContent);
		$("#catatanUser").val($(this).closest('tr').children()[7].textContent);
     });*/
	
	$(document).ready(function() {
    var table = $('#table-dynamic').DataTable( {
		//"paging":   false,
        //"ordering": false,
        "info":     true,
        "processing": true,
        "serverSide": false,
		"lengthChange": false,
		"pagingType": "simple_numbers",
		"dom": '<"top"if>rt<"bottom"lp><"clear">',
		"lengthChange": false,
		"scrollY": (screen.height - 480) + 'px',
		"scrollX": true,        
		"order": [[0, 'desc'], [1, 'asc']],
		"language": {
				search: '<i class="fa fa-search"></i>',
                processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>',
				sInfo: "_START_ -_END_ dari _TOTAL_ data"
            },
		"ajax":{
					"url": baseURL+"surat/get_surat_diperiksa/",
					"dataType": "json",
					"type": "POST"
				},
        "columns": [
			{ "data": "tanggalSurat" },
			{ "data": "nomorSurat" },
			{ "data": "jenisSurat" },
            { "data": "pengirim" },
            { "data": "penerima" },
            { "data": "perihal" },
			{ "data": "sifat" },
            { "data": "rujukan" },
			{ "defaultContent": "<button class=\"btn btn-success btn-edit\">Detail</button>"}
        ],
		"columnDefs": [ {
			"targets": 6,
			"createdCell": function (td, cellData, rowData, row, col) {
			if ( cellData == 'URGENT' || cellData == 'UNREAD' || cellData == 'REJECTED') {
				$(td).addClass('label label-danger')
			} else {
				$(td).addClass('label label-default')
			}
		} }]

    } );
	
		$("#table-dynamic").on("click", ".btn-edit", function(){
		var data = table.row( $(this).parents('tr') ).data();
		var id_surat = data['id'];
		//console.log(data);
        //alert(data['id']);
		var html_code = "";
		$.ajax({ 
		type: 'POST', 
		url: baseURL+"surat/get_surat_detail/", 
		data: {idSurat:id_surat },
		dataType: "json",
		success: function (jsondata) {
			//console.log(jsondata);
					if(jsondata['data'].length != 0){
						for(var i = 0 ; i < jsondata['data'].length ; i++){
						if(jsondata['data'][i]['sifat']=='urgent') {
							var sifat_class = "label label-danger";
						} else {
							var sifat_class = "label label-success";
						}
						if(jsondata['data'][i]['statusDibaca']=='UNREAD') {
							var status_class = "label label-danger";
						} else {
							var status_class = "label label-success";
						}
						$("#idSurat").val(id_surat);
						$("#nomorSurat").val(jsondata['data'][i]['nomorSurat']);
						$("#sifat").val(jsondata['data'][i]['sifat']);
						$("#tanggalSurat").val(jsondata['data'][i]['tanggalSurat']);
						$("#jenisSurat").val(jsondata['data'][i]['jenisSurat']);
						$("#perihal").val(jsondata['data'][i]['perihal']);
						$("#pengirim").val(jsondata['data'][i]['pengirim']);
						$("#penerima").val(jsondata['data'][i]['penerima']);
						$("#penerimaCc").val(jsondata['data'][i]['penerimaCc']);
						$("#rujukan").val(jsondata['data'][i]['rujukan']);
						$("#memo").val(jsondata['data'][i]['memo']);
						$("#attachments").val(jsondata['data'][i]['pdf']);

						//$("#notaPerbaikan").val(notaPerbaikan);

						}						
						$("#edit-modal").modal("show");
					}else{
					  $('#modal-content').html("Belum ada Data");
					}
				  },
				  error:function(error){
					alert("gagal memuat data");
				  }
		});
	});
	
	$("#form-btn").click(function(){
			var data = $('#form-data').serialize();
			$.ajax({
				type: 'POST',
				url: baseURL+"surat/post_update_approval",
				data: data,
				success: function() {
					//alert('data disimpan');
					//location.reload(); 

				}
			});
			$.ajax({
				type: 'POST',
				url: baseURL+"surat/post_nota_revisi",
				data: data,
				success: function() {
					alert('data disimpan');
					location.reload(); 
				}
			});
		});
		
	$(".radio_status").change(function(){
		if($(this).val()=="REVISED") {
			$("#hide_element").show();
		}
		else {
			$("#hide_element").hide(); 
		}   
		});

} );
/*
	$(document).ready(function(){
	getSuratMasuk();
	function getSuratMasuk(){
		var table = "";
		$.ajax({ 
		type: 'POST', 
		url: baseURL+"surat/get_surat_diperiksa/", 
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
						if(jsondata['data'][i]['statusDibaca']=='UNREAD') {
							var status_class = "label label-danger";
						} else {
							var status_class = "label label-success";
						}
						  table += "<tr>"+
								  "<td>"+(i+1)+"</td>"+
								  "<td>"+jsondata['data'][i]['pengirim']+"</td>"+
								  "<td>"+jsondata['data'][i]['penerima']+"</td>"+
								  "<td>"+jsondata['data'][i]['tanggalSurat']+"</td>"+
								  "<td>"+jsondata['data'][i]['perihal']+"</td>"+
								  "<td><span class=\""+sifat_class+"\">"+jsondata['data'][i]['sifat']+"</span> <span class=\""+status_class+"\">"+jsondata['data'][i]['statusDibaca']+"</span></td>"+
								  "<td><button type=\"button\" class=\"btn btn-default\"><i class=\"fa fa-search\"></i> Lihat </button></td>"+
								"</tr>";
						}

						$('#table-content').html(table);
					  
					}else{
					  $('#table-content').html("Belum ada Data");
					}
				  },
				  error:function(error){
					//alert("gagal memuat data");
				  }
		});
		}
	});*/
	</script>
    <!-- end Javascript -->
    </body>
</html>