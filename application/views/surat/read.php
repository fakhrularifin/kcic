<style>
td.label-red {
	font-weight: bold;
	color: #ff0000;
}
.row-red {
	font-weight: bold;
	background-color: #ff0000;
}
td.label-blue {
	font-weight: bold;
	color: #09F;
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
							<div class="box-header with-border" id="action">
								
								<br>
							</div>
							
						</div>

						<div class="panel-body">
							<div class="row">
                            	<!-- start content -->

						<div class="col-md-12">
							<!-- content2 -->
							<div class="panel">
								<div class="panel-body">
										<form id="surat-form"  action="" method="post">
										<div class="modal-header" id="header">
										</div>
										<div class="modal-body">
											<div class="form-group">
											  <input type="hidden" class="form-control" id="idSurat">
										  </div>
										  <div class="form-group">pengirim
											  <input type="text" class="form-control"  id="pengirim">
										  </div>
										  <div class="form-group">penerima
											  <input type="text" class="form-control"  id="penerima">
										  </div>
										  <div class="form-group">Perihal :
											  <input type="text" class="form-control"  id="perihal">
										  </div>
										  
										  <div class="form-group">Cc / Tembusan
											  <input type="text"  class="form-control"  id="penerimaCc">
										  </div>
										  <div class="form-group">rujukan
											  <input type="text"  class="form-control"  id="rujukan">
										  </div>

										  <div class="form-group">Memo
											  <textarea  class="form-control html-editor"  id="memo">
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
									</div>
								</form>
								</div>
								<div class="panel-footer">
									<div class="row" id="footer">
										
									</div>
								</div>
							</div>
							
							<!-- start modal -->
                            <div id="modal-content" >
								<form id="form-data"  action="" method="post">
									<div id="revisi-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
											</button>
											<h4 class="modal-title" id="exampleModalLabel">Revisi Surat</h4>

										</div>
										<div class="modal-body">
											<div class="form-group">
											  <input type="hidden"  class="form-control" name="id_ref_revisi" id="id_ref_revisi">
										  </div>
											
										  <div class="form-group">pengirim
											  <input type="text" class="form-control" name="pengirim_revisi" id="pengirim_revisi">
										  </div>

										  <div class="form-group">penerima
											  <input type="text"  class="form-control" name="penerima_revisi" id="penerima_revisi">
										  </div>
										  <div class="form-group">Memo
											  <textarea  class="form-control html-editor" name="memo_revisi" id="memo_revisi"></textarea>
										  </div>
                                          <div>
                                          	<a href="" id="attachments" target="_parent"></a>
                                          </div>

									</div>
									<div class="modal-footer">
                                    <!--<button id="form-btn" type="button" class="btn btn-primary" ><i class="fa fa-paper-plane-o"></i> Simpan</button>-->
									<button id="postrevisi-btn" type="button" class="btn btn-primary" ><i class="fa fa-paper-plane-o"></i> Kirim Revisi</button>
									<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>                                        
									</div>

									</div>
								</div>
								</div>
							</form>
							
							<form id="form-data2"  action="" method="post">
									<div id="disposisi-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
											</button>
											<h4 class="modal-title" id="exampleModalLabel">Disposisi Surat</h4>

										</div>
										<div class="modal-body">
											<div class="form-group">
											  <input type="hidden"  class="form-control" name="id_ref_disposisi" id="id_ref_disposisi">
										  </div>
										  <div class="form-group">
										  <span>Nomor Surat</span>
										  <input id="nomor_surat" name="nomor_surat" type="text" class="form-control"><br>
										  <span>Kepada</span>
										  <input id="penerima_disposisi" name="penerima_disposisi" type="text" class="form-control search_form" placeholder="email tujuan">
											<br>
										 <span>CC</span><input type="text" name="penerima_cc" id="penerima_cc" class="form-control cc" placeholder="cc email">
									<br>
                                    <span>Tanggal Surat</span><input name="tanggal_surat" type="text" class="form-control date_form" placeholder="tahun-bulan-tanggal"><br>
									<span>Tanggal Terima Surat</span><input type="text" name="tanggal_terima_surat" class="form-control date_form" value="">
									<br>
                                    <span>Perihal</span><input type="text" name="perihal" class="form-control">
									<br>
                                    <span>Sifat Surat</span>
                                    <select class="form-control" name="sifat">
										<option value="Normal">Normal</option>
										<option value="Urgent">Urgent</option>
									</select>
									<br>
                                    <span>Rujukan Surat</span><input type="text" name="rujukan" class="form-control">
                                    <br>
									<span>Memo</span><textarea name="memo" rows="4" class="form-control html-editor" id="editor" placeholder="memo"></textarea>
                                    <br>
									 <span>Lampiran</span><input type="file" name="attachments" class="form-control">
                                     <br>
									<span>Keterangan Lampiran</span><input type="text" name="lampiran" class="form-control">
                                    <br>
									</div>

									</div>
									<div class="modal-footer">
                                    <!--<button id="form-btn" type="button" class="btn btn-primary" ><i class="fa fa-paper-plane-o"></i> Simpan</button>-->
									<button id="postdisposisi-btn" type="button" class="btn btn-primary" ><i class="fa fa-paper-plane-o"></i> Kirim Disposisi</button>
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
	<script>
		$( function() {
		$( ".date_form" ).datepicker();
		$( ".date_form" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
	} );
	$( ".search_form" ).autocomplete({
        source: function( request, response ) {
          $.ajax({
            url: baseURL+"surat/get_list_email",
            type: 'post',
            dataType: "json",
            data: {
              search: request.term
            },
            success: function( data ) {
              response( data );
            }
          });
        },
        select: function (event, ui) {
          $(this).val(ui.item.value); 
          return false;
        }
      });
	  $('.cc').tokenInput("<?php echo base_url('surat/get_list_user');?>", {
			theme: "facebook",
			tokenValue: "email",
			//propertyOfId:  "email",
			propertyToSearch: "name",
			preventDuplicates: true,
			resultLimit: 10,
			hintText: "Cari nama penerima cc",
			noResultsText: "Data tidak ada",
			searchingText: "Mencari data...",
			animateDropdown: false,
			debug: true
		  });
	function get_suratno(id){
		$.ajax({ 
		type: 'GET', 
		url: baseURL+"surat/get_surat_no/", 
		data: {idSurat:id },
		dataType: "json",
		success: function (jsondata) {
			//console.log(jsondata);
					if(jsondata['data'].length != 0){
						//alert(jsondata['data']['nomorSurat']);
						return jsondata['data']['nomorSurat'];
					}else{
						alert("belum ada data");
					 // $('#modal-content').html("Belum ada Data");
					}
				  },
		error:function(error){
					alert("gagal memuat data");
			}
		});
	}
	//console.log(get_suratno(3));
	$(document).ready(function() {
		var data="";
		var header = "";
		var footer = "";
		var action = "";
		var email_logged = '<?php echo $this->session->userdata('email')?>';

		//var pemeriksa = <?php echo $this->session->userdata('email')?>;
		//var data = table.row( $(this).parents('tr') ).data();
		var id_surat = <?php echo $this->uri->segment(3);?>;
        //alert(id_surat);
		$.ajax({ 
		type: 'POST', 
		url: baseURL+"surat/get_surat_detail/", 
		data: {idSurat:id_surat },
		dataType: "json",
		success: function (jsondata) {
			//console.log(jsondata);
					if(jsondata['data'].length != 0){
						var id_surat_ref = jsondata['data']['idSuratRef']; 
						//alert(id_surat_ref);
						//console.log(get_suratno(id_surat_ref));
						if(jsondata['data']['sifat']=='URGENT') {
							var sifat_class = "label label-danger";
						} else {
							var sifat_class = "label label-success";
						}
						if(jsondata['data']['statusDisetujui']=='APPROVED') {
							var status_class = "label label-success";
							
						} else {
							var status_class = "label label-danger";
						}
						if(jsondata['data']['idSuratRef']!=null) {
							var title = "<h3>Revisi Surat</h3>";
							//var title = "<h3>Revisi Surat: "+get_suratno(id_surat_ref)+"</h3>"+"&nbsp";
						} else {
							var title = "<h3>Nomor Surat: "+jsondata['data']['nomorSurat']+"</h3>"+"&nbsp";
						}
						if(jsondata['data']['pemeriksa']==email_logged) {
							if(jsondata['data']['statusDisetujui']=='APPROVED') {
							action += "";
							} else {
							action += 	"<a href='#' class='btn btn-primary revisi-btn pull-left'><i class='fa fa-reply'> </i> Revisi</a>"+
									"<a href='#' class='btn btn-success approve-btn pull-right' id='approve-btn'><i class='fa fa-share'> </i> Approve</a>"+"&nbsp"+
								  "";
							}
						} else {
							action += 	"<a href='<?php echo base_url('surat/arsip_new') ?>' class='btn btn-primary  pull-left'><i class='fa fa-reply'> </i> Balas surat</a>"+
									"<a href='#' class='btn btn-warning disposisi-btn pull-right' ><i class='fa fa-share'> </i> Disposisi</a>"+"&nbsp"+
								  "";
						}
						header += title+
								  "<span class='label label-primary'>"+jsondata['data']['jenisSurat']+"</span>"+"&nbsp"+
								  "<span class=\""+sifat_class+"\">"+jsondata['data']['sifat']+"</span>"+"&nbsp"+
								  "<span class=\""+status_class+"\">"+jsondata['data']['statusDisetujui']+"</span>"+
								  
								  "<label class='pull-right'><i class='fa fa-calendar'></i>&nbsp"+jsondata['data']['tanggalSurat']+"</label>"+
								  "";

						footer += "<i class='fa fa-paperclip'>&nbsp <a href='"+jsondata['data']['pdf']+"' target='new'>Download lampiran</a>"+"&nbsp"+
								"";
						$("#idSurat").val(id_surat);
						$("#jenisSurat").val(jsondata['data']['jenisSurat']);
						$("#perihal").val(jsondata['data']['perihal']);
						$("#pengirim").val(jsondata['data']['pengirim']);
						var penerima_balasan = jsondata['data']['pengirim'];
						$("#penerima").val(jsondata['data']['penerima']);
						var pengirim_balasan = email_logged;
						$("#penerimaCc").val(jsondata['data']['penerimaCc']);
						$("#rujukan").val(jsondata['data']['rujukan']);
						$("#memo").val(jsondata['data']['memo']);
						var memo = jsondata['data']['memo'];
						$("#attachments").val(jsondata['data']['pdf']);

						//$("#notaPerbaikan").val(notaPerbaikan);
											
						$('#header').html(header);
						$('#action').html(action);
						$('#footer').html(footer);
						$("#penerima_revisi").val(penerima_balasan);
						$("#pengirim_revisi").val(pengirim_balasan);
						$("#penerima_disposisi").val(penerima_balasan);
						$("#pengirim_disposisi").val(pengirim_balasan);
						$("#id_ref_revisi").val(id_surat);
						$("#id_ref_disposisi").val(id_surat);
						$('#memo').summernote('code', memo);

					}else{
						alert("belum ada data");
					 // $('#modal-content').html("Belum ada Data");
					}
				  },
		error:function(error){
					alert("gagal memuat data");
			}
		});
		
		//update read status
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
	$(document).on("click", "a.approve-btn" , function() {
           //alert('ssss');
		   $.ajax({
				type: 'POST',
				url: baseURL+"surat/post_update_approval",
				data: {idSurat:id_surat, status: "APPROVED" },
				success: function() {
					//$('.tampildata').load("tampil.php");
					 location.reload();
				}
			});
        });
	$(document).on("click", "a.revisi-btn" , function() {
		//alert(id_surat);
			$("#revisi-modal").modal("show");
        });
	$("#postrevisi-btn").click(function(){
		//alert('sdfsdf');
		$.ajax({
				type: 'POST',
				url: baseURL+"surat/post_nota_revisi",
				data: {idSurat:id_surat, memo: "testing testing", pengirim: "anggie.gunawan@kcic.co.id", penerima: "abdullah.faqih@kcic.co.id" },
				success: function() {
					//$('.tampildata').load("tampil.php");
					 location.reload();
				}
			});
	});
	
	$(document).on("click", "a.disposisi-btn" , function() {
		//alert(id_surat);
			$("#disposisi-modal").modal("show");
        });
	$("#postdisposisi-btn").click(function(){
		//alert('sdfsdf');
		
		var data = $('#form-data2').serialize();
			$.ajax({
				type: 'POST',
				url: baseURL+"surat/post_disposisi",
				data: data,
				success: function() {
					//$('.tampildata').load("tampil.php");
					alert('disposisi dikirim');
					window.location = "<?php echo base_url('surat/outbox');?>";

				}
			});
	});
	/*$("#disposisi-btn").click(function(){
		alert('sdfsdf');
		//document.getElementById('surat-form').submit();
		//	window.location = "<?php echo base_url('surat/disposisi');?>";			
	});*/
	$('.html-editor').summernote({
		  contenteditable: false,
		  height: 200,                 
		  minHeight: 200,            
		  maxHeight: 300,            
		  focus: true,     
		  toolbar: [ 
					['style', ['bold', 'italic', 'underline', 'clear']],
					['font', ['strikethrough']],
					['fontsize', ['fontsize']],
					['color', ['color']],
					['para', ['ul', 'ol', 'paragraph']]
					//['height', ['height']]
		  ]
		});
		
} );
	
	</script>
    <!-- end Javascript -->
    </body>
</html>