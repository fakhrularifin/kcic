<style>
td.label-red {
	font-weight: bold;
	color: #ff0000;
}
.row-red {
	font-weight: bold;
	background-color: #ff0000;
}

.table tr:hover {
	background-color: #ffe6e6;
	cursor: pointer;
}
</style>
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
							      <div class="box-header with-border">
        <h2 class="box-title">List Surat Masuk</h2>
        <a href="<?php echo base_url('surat/arsip_new') ?>" class="btn btn-primary pull-left"><i class="fa fa-envelope"> </i> Buat Surat baru</a>
      </div>
							
						</div>

						<div class="panel-body">
							<div class="row">
                            	<!-- start content -->

						<div class="col-md-12">
							<!-- content2 -->
							<div class="panel">

								<div class="panel-body">
								<table id="table-dynamic" class="display table" style="width:100%">
								<thead style="text-height:bold;background-color:#CCC">
								<tr>
									<th>Tanggal Terima</th>
									<th>Jenis Surat</th>
									<th>Asal Surat</th>
									<th>Perihal</th>
									<th>Sifat</th>
									<th>Status</th>
									<th>Aksi</th>
								</tr>
								</thead>
								<tbody></tbody>
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
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
											</button>
											<h4 class="modal-title" id="exampleModalLabel">Surat Masuk</h4>

										</div>
										<div class="modal-body">
											<div class="form-group">
											  <input type="hidden"  class="form-control" name="idSurat" id="idSurat">
										  </div>
											<div class="form-group">
											  <label>Nomor Surat</label>
												<input type="text" class="form-control" name="nomorSurat" id="nomorSurat">
												
											  <label>Sifat </label>
												<span id="sifat" class="label label-default"></span>
												
											 <label>Tanggal Surat</label>
												<input type="text" class="form-control" id="tanggalSurat">
											</div>
											 
											<div class="form-group">jenis surat
											  <input type="text" class="form-control" name="jenisSurat" id="jenisSurat">
										  </div>
										  <div class="form-group">Perihal :
											  <input type="text" class="form-control" name="perihal" id="perihal">
										  </div>
										  <div class="form-group">pengirim
											  <input type="text" class="form-control" name="pengirim" id="pengirim">
										  </div>

										  <div class="form-group">Cc
											  <input type="text"  class="form-control" name="penerimaCc" id="penerimaCc">
										  </div>
										  <div class="form-group">rujukan
											  <input type="text"  class="form-control" name="rujukan" id="rujukan">
										  </div>

										  <div class="form-group">Memo
											  <textarea  class="form-control html-editor" name="memo" id="memo">
											  </textarea>
										  </div>
                                          <div>
                                          	<a href="" id="attachments" target="_parent"></a>
                                          </div>
																				
										  <!--<div class="form-group">Nota Perbaikan
											  <textarea disabled class="form-control mdl-catatan" name="notaPerbaikan" id="notaPerbaikan">
											  </textarea>
										  </div>
										  -->
									</div>
									<div class="modal-footer">
                                    <!--<button id="form-btn" type="button" class="btn btn-primary" ><i class="fa fa-paper-plane-o"></i> Simpan</button>-->
									<button id="reply-btn" type="button" class="btn btn-primary" ><i class="fa fa-paper-plane-o"></i> Balas Disposisi</button>
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

	$(document).ready(function() {
    var table = $('#table-dynamic').DataTable( {
		
		"ajax":{
					"url": baseURL+"surat/get_surat_masuk/",
					"dataType": "json",
					"type": "POST"
				},
        "columns": [
            { "data": "tanggalSurat" },
			{ "data": "jenisSurat" },
            { "data": "pengirim" },
            { "data": "perihal" },
            { "data": "sifat" },
            { "data": "statusDibaca" },
			{ "defaultContent": "<button class=\"btn btn-success btn-edit\">Detail</button>"}
        ],

		"columnDefs": [ 
		{
			"targets": [4],
			"createdCell": function (td, cellData, rowData, row, col) {
			if ( cellData == 'URGENT' || cellData == 'UNREAD' || cellData == 'REJECTED') {
				$(td).addClass('label label-danger');
			} else {
				$(td).addClass('label label-default')
			}
		} },
			{
			"targets": [5],
			"createdCell": function (td, cellData, rowData, row, col) {
			if ( cellData == 'UNREAD') {
				$(td,row).addClass('label-red');
			} 
		}}
		
		],
		createdRow: function( row, data, dataIndex, cell ) {
                    if (data.statusDiaca == "UNREAD"){
                      $(row).addClass( 'label-red' );
                    }
					$(row).data( 'id', data.id );
                },
        initComplete: function () {
            this.api().columns().every( function () {
                var column = this;
                var select = $('<select><option value=""></option></select>')
                    .appendTo( $(column.footer()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
 
                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        },
		//"paging":   false,
        //"ordering": false,
        "info":     true,
        "processing": false,
        "serverSide": false,
		"lengthChange": false,
		"pagingType": "simple_numbers",
		"dom": '<"top"f>rt<"bottom"ilp><"clear">',
		"lengthChange": false,
		"scrollY": (screen.height - 680) + 'px',
		"scrollX": true,        
		"order": [[1, 'desc'], [5, 'desc'],[2, 'asc'] ],
		"language": {
				search: '<i class="fa fa-search"></i>',
                processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>',
				sInfo: "_START_ -_END_ dari _TOTAL_ data"
            },
    } );
	
	$("#reply-btn").click(function(){
			window.location = "<?php echo base_url('surat/disposisi');?>";			
		});
	
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
						$("#penerimaCc").val(jsondata['data'][i]['penerimaCc']);
						$("#rujukan").val(jsondata['data'][i]['rujukan']);
						$("#memo").val(jsondata['data'][i]['memo']);
						var memo = jsondata['data'][i]['memo'];
						$("#attachments").val(jsondata['data'][i]['pdf']);

						//$("#notaPerbaikan").val(notaPerbaikan);

						}						
						$("#edit-modal").modal("show");
						$('#memo').summernote('code', memo);

					}else{
					  $('#modal-content').html("Belum ada Data");
					}
				  },
		error:function(error){
					alert("gagal memuat data");
			}
		});
		//update read status
		var email_logged = "abdullah.faqih@kcic.co.id";
		var read_status = "READ";
			$.ajax({
				type: 'POST',
				url: baseURL+"surat/post_update_dibaca",
				data: {idSurat:id_surat, penerima:email_logged, status:read_status },
				success: function() {
					//$('.tampildata').load("tampil.php");
					 //location.reload();
				}
			});
	});
	
	$('table tbody').on('click','tr' ,function(){
        //alert($(this).data('id'));
        if(typeof $(this).data('id') != 'undefined'){
                window.location.href='<?php echo base_url('surat/read/');?>'+$(this).data('id');
        }
    });
	$('#memo').summernote({
		  contenteditable: false,
		  height: 200,                 
		  minHeight: 200,            
		  maxHeight: 300,            
		  focus: true,     
		  toolbar: [ ]
		});
} );
	
	/*
	$(document).ready(function(){

	getSuratMasuk();
	function getSuratMasuk(){
		var table = "";
		$.ajax({ 
		type: 'POST', 
		url: baseURL+"surat/get_surat_masuk/", 
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