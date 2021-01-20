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
							<div id="detail">
							</div>
							
							<div class="modal fade" id="modalDetailSurat" tabindex="-1" role="dialog" aria-labelledby="modalDetailSurat" aria-hidden="true">
							<div class="modal-dialog modal-dialog-centered modal-lg" role="document">
								<div class="modal-content">
									<div class="modal-header">
										<span>
											<strong class="modal-title" id="detailSuratTitle"></strong>
											<span class="loadingState"></span>
										</span>
										<button type="button" class="close" data-dismiss="modal" aria-label="Close">
											<span aria-hidden="true">&times;</span>
										</button>
									</div>
									<div class="modal-body">
										<div id="action" class="px-4 py-2"></div>
										<div id="notaRevisi" class="px-4 py-2 d-none">
											<form>
												<input type="hidden" id="notaRevisiIdSurat">
												<input type="hidden" id="notaRevisiPenerima">
												<div class="form-group">
													<label for="notaRevisiInput">Nota Revisi</label>
													<textarea class="form-control" name="notaRevisiInput" id="notaRevisiInput"></textarea>
												</div>
												<button type="button" class="btn btn-primary" id="btnKirimNotaRevisi">Kirim</button>
												<button type="button" class="btn btn-secondary" id="btnBatalNotaRevisi">Batal</button>
											</form>
											<hr>
										</div>
										<div id="balasanDisposisi" class="px-4 py-2 d-none">
											<form>
												<input type="hidden" id="disposisiIdSurat">
												<div class="form-group">
													<label for="disposisiPenerima">Diteruskan Kepada</label>
													<input type="text" class="form-control" id="disposisiPenerima"/>
												</div>
												<div class="form-group">
													<label for="disposisiPenerimaCc">CC</label>
													<input type="text" class="form-control" id="disposisiPenerimaCc" data-role="tagsinput"/>
												</div>
												<div class="form-group">
													<label for="balasanDisposisiInput">Balasan Disposisi</label>
													<textarea class="form-control" name="disposisiMemo" id="disposisiMemo"></textarea>
												</div>
												<button type="button" class="btn btn-primary" id="btnKirimBalasanDisposisi">Kirim</button>
												<button type="button" class="btn btn-secondary" id="btnBatalBalasanDisposisi">Batal</button>
											</form>
											<hr>
										</div>
										<div id="disposisiSummary" class="px-4 mb-4 d-none"></div>
										<!-- <div id="loop" class="px-4"></div> -->
										<div id="detailSurat" class="p-4"></div>
										<div id="attachments" class="p-4"></div>
									</div>
								</div>
							</div>
							</div>
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
			<!--  Modal Buat Surat -->
			<?php require_once(APPPATH.'views/shared/modal_buat_surat.php'); ?>
	
			<!--  Modal Detail Surat-->
			<?php require_once(APPPATH.'views/shared/modal_detail_surat.php'); ?>
		
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
		let detailSurat = [];
		let isRevision = false;
		
		var data="";
		var header = "";
		var footer = "";
		var action = "";
		var email_logged = '<?php echo $this->session->userdata('email')?>';

		//var pemeriksa = <?php echo $this->session->userdata('email')?>;
		//var data = table.row( $(this).parents('tr') ).data();
		var id_surat = <?php echo $this->uri->segment(3);?>;
        //alert(id_surat);
		
	//fq_20201007: new logic get suratmasuk
	/*	$.ajax({
				type: 'POST',
				url: baseURL+'api/getSuratMasuk',
				data: {		
					//idSurat:id_surat	
					token: TOKEN,
					penerima: MAIL,
					offset: 0
				},
				dataType: 'json',
				success: function(response){		
					if(response.status !== 200){
						return Swal.fire({
							title: 'Gagal mengambil data surat masuk',
							text: response.message,
							icon: 'error',
							confirmButtonText: 'OK'
						});
					}

					const data = [];
					$.each(response.data, function(id, d){
						detailSurat.push({
							id: d.id,
							idSuratRef: d.idSuratRef,
							nomorSurat: d.nomorSurat,
							jenisSurat: d.jenisSurat,
							pengirim: d.pengirim,
							penerima: d.penerima,
							penerimaCc: d.penerimaCc,
							attachments: d.attachments,
							pdf: d.pdf,
							memo: d.memo,
							statusDisetujui: d.statusDisetujui,
							pemeriksa: d.pemeriksa
						});
						console.log('detailSurat :: ', detailSurat);

						let aksi = '<button title="Lihat detail surat" class="btn btn-primary btnDetailSurat" data-id="${d.id}"><i class="fa fa-envelope-open"></i></button>';

						if(d.pemeriksa === MAIL){
							if(d.statusDisetujui === 'NOT APPROVED'){
								aksi = '<button title="Lihat detail surat" class="btn btn-primary btnDetailSurat" data-id="${d.id}"><i class="fa fa-envelope-open"></i></button>'+
									'<button title="Setujui surat" class="btn btn-success btnSetujuiSurat" data-id="${d.id}"><i class="fa fa-check"></i></button>';
							}else{
								aksi = '<button title="Lihat detail surat" class="btn btn-primary btnDetailSurat" data-id="${d.id}"><i class="fa fa-envelope-open"></i></button>'+
									'<button title="Surat Sudah Disetujui" class="btn btn-link" disabled><i class="fa fa-check"></i></button>';
							}
						}
						
						let sifat = 'NORMAL';
						if(d.sifat !== null){
							sifat = d.sifat === 'NORMAL' ? '<span class="badge badge-info">NORMAL</span>' : '<span class="badge badge-danger">URGENT</span>'
						}

						data.push({
							status: d.statusDibaca === 'READ' ? '<span class="badge badge-secondary"><i class="fa fa-envelope-open"></i></span>' : '<span class="badge badge-warning"><i class="fa fa-envelope"></i></span>',
							tanggalSurat: moment(d.tanggalSurat).format('DD-MM-YYYY HH:mm:ss'),
							pengirim: d.pengirim,
							nomorSurat: d.nomorSurat,
							perihal: d.perihal === null ? d.jenisSurat.replace(/_|-/g, " ") : d.perihal,
							sifat: sifat,
							aksi: aksi
						});
					});
				},
				error: function(error){
					Swal.fire({
						title: 'Gagal mengambil data surat masuk',
						text: error.responseText,
						icon: 'error',
						confirmButtonText: 'OK'
					});
				}
			});
		*/
		
		
		//fq_20201007: old logic
		/*$.ajax({ 
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
		*/
		
	//fq_20201007: new logic detailsurat	
		
			//const id = $(this).data('id');
			const id = id_surat;
			//const surat = detailSurat.find(s => s.id == id);
			
			$('#modalDetailSurat #action').html('');
			$('#modalDetailSurat #attachments').html('');
			//alert(surat);
			/*$('#modalDetailSurat #detailSuratTitle').html(`
				${surat.nomorSurat === null ? surat.jenisSurat.replace(/_|-/g, " ") : surat.nomorSurat}
			`);*/
			
			if(
				surat.jenisSurat === 'SURAT_KELUAR' || surat.jenisSurat === 'NOTA_DINAS' || 
				surat.jenisSurat === 'REVISI_SURAT_KELUAR' || surat.jenisSurat === 'REVISI_NOTA_DINAS' ){
				$.ajax({
					type: 'POST',
					url: baseURL+'api/getSuratDetail',
					data: {
						token: TOKEN,
						idSurat:surat.id,
					},
					dataType: 'json',
					success: function (response){ 
						console.log(response);
						if(response.status !== 200){
							return Swal.fire({
								title: 'Ambil Data Detail Surat Gagal',
								text: response.message,
								icon: 'error',
								confirmButtonText: 'OK'
							})
						}

						if(surat.pemeriksa === MAIL){
							console.log('surat :: ', surat);
							if(surat.statusDisetujui === 'NOT APPROVED'){
								$('#modalDetailSurat #action').html(`
									<button class="btn btn-success btnSetujuiSurat" data-id="${surat.id}"><i class="fa fa-check"></i> Setujui</button>
									<button class="btn btn-warning" id="btnBuatNotaRevisi" data-penerima="${surat.pengirim}" data-id="${surat.id}"><i class="fa fa-edit"></i> Buat Nota Revisi</button>
								`);
							}
						}

						$('#modalDetailSurat #detailSurat').html(`
							dari : ${response.data.pengirim} <br/>
							kepada : ${response.data.penerima} <br/>
							cc : ${response.data.penerimaCc === null ? '' : response.data.penerimaCc} <br/><br/>

							${response.data.memo}
						`);	
					},
					error: function (error) {
						Swal.fire({
							title: 'Ambil Data Detail Surat Gagal',
							text: error.responseText,
							icon: 'error',
							confirmButtonText: 'OK'
						})
					}
				})
			}

			if(surat.jenisSurat === 'DISPOSISI'){
				$.ajax({
					type: 'POST',
					url: baseURL+'api/getSuratDetail',
					data: {
						token: TOKEN,
						idSurat:surat.id,
					},
					dataType: 'json',
					success: function (response){ 
						console.log(response);
						if(response.status !== 200){
							return Swal.fire({
								title: 'Ambil Data Detail Surat Gagal',
								text: response.message,
								icon: 'error',
								confirmButtonText: 'OK'
							})
						}

						$('#modalDetailSurat #detailSurat').html(`
							dari : ${response.data.pengirim} <br/>
							kepada : ${response.data.penerima} <br/>
							cc : ${response.data.penerimaCc === null ? '' : response.data.penerimaCc} <br/><br/>

							${response.data.memo}
						`);

						$('#modalDetailSurat #action').html('');
						
						$('#modalDetailSurat #action').html(`
							<button class="btn btn-info" id="btnBuatBalasanDisposisi" data-id="${surat.id}"><i class="fa fa-edit"></i> Buat Balasan Disposisi</button>
							<button class="btn btn-info" id="btnSummaryDisposisi" data-id="${surat.id}"><i class="fa fa-search"></i> Lihat Summary Disposisi</button>
						`);		
					},
					error: function (error) {
						Swal.fire({
							title: 'Ambil Data Detail Surat Gagal',
							text: error.responseText,
							icon: 'error',
							confirmButtonText: 'OK'
						})
					}
				})
			}

			if(surat.jenisSurat === 'BALASAN_DISPOSISI'){
				$.ajax({
					type: 'POST',
					url: baseURL+'api/getSuratDetail',
					data: {
						token: TOKEN,
						idSurat:surat.idSuratRef,
					},
					dataType: 'json',
					success: function (response){ 
						console.log(response);
						if(response.status !== 200){
							return Swal.fire({
								title: 'Ambil Data Detail Surat Gagal',
								text: response.message,
								icon: 'error',
								confirmButtonText: 'OK'
							})
						}

						$('#modalDetailSurat #detailSurat').html(`
							dari : ${surat.pengirim} <br/>
							kepada : ${surat.penerima} <br/>
							cc : ${surat.penerimaCc === null ? '' : surat.penerimaCc} <br/><br/>

							${surat.memo}
							<hr/>
							dari : ${response.data.pengirim} <br/>
							kepada : ${response.data.penerima} <br/>
							cc : ${response.data.penerimaCc === null ? '' : response.data.penerimaCc } <br/><br/>

							${response.data.memo}
						`);

						$('#modalDetailSurat #action').html('');
						
						$('#modalDetailSurat #action').html(`
							<button class="btn btn-info" id="btnBuatBalasanDisposisi" data-id="${surat.idSuratRef}"><i class="fa fa-edit"></i> Buat Balasan Disposisi</button>
							<button class="btn btn-info" id="btnSummaryDisposisi" data-id="${surat.idSuratRef}"><i class="fa fa-search"></i> Lihat Summary Disposisi</button>
						`);		
					},
					error: function (error) {
						Swal.fire({
							title: 'Ambil Data Detail Surat Gagal',
							text: error.responseText,
							icon: 'error',
							confirmButtonText: 'OK'
						})
					}
				})
			}

			if(surat.jenisSurat === 'NOTA_REVISI_SURAT'){
				$.ajax({
					type: 'POST',
					url: baseURL+'api/getSuratDetail',
					data: {
						token: TOKEN,
						idSurat: surat.idSuratRef,
					},
					dataType: 'json',
					success: function (response){ 
						if(response.status !== 200){
							return Swal.fire({
								title: 'Ambil Data Detail Surat Gagal',
								text: response.message,
								icon: 'error',
								confirmButtonText: 'OK'
							})
						}

						$('#modalDetailSurat #detailSuratTitle').html(`Nota Revisi Surat`);
						$('#modalDetailSurat #detailSurat').html(`
							dari : ${surat.pengirim} <br>
							kepada : ${surat.penerima} <br>
							cc : ${ surat.penerimaCc === null ? '' : surat.penerimaCc} <br><br>
							${surat.memo}
							<hr/>
							Nomor Surat : ${response.data.nomorSurat} <br>
							dari : ${response.data.pengirim} <br>
							kepada : ${response.data.penerima} <br>
							cc : ${response.data.penerimaCc === null ? '' : response.data.penerimaCc} <br><br>
							${response.data.memo}
						`);		
						
						$('#modalDetailSurat #action').html('');

						if(response.data.tanggalRevisi === null ){
							$('#modalDetailSurat #action').html(`
								<button class="btn btn-info" id="btnBuatRevisiSurat" data-revision="true" data-id="${surat.idSuratRef}"><i class="fa fa-edit"></i> Revisi Surat</button>
							`);
						}else{
							$('#modalDetailSurat #action').html(`
								<span class="badge badge-info">
									Sudah direvisi pada tanggal ${moment(response.data.tanggalRevisi).format('DD-MM-YYYY HH:mm:ss')}
								</span>
							`);
							$('#modalDetailSurat #detailSurat').append(`
								[direvisi tanggal : ${ moment(response.data.tanggalRevisi).format('DD-MM-YYYY HH:mm:ss') }]
							`);	
						}
					},
					error: function (error) {
						Swal.fire({
							title: 'Ambil Data Detail Surat Gagal',
							text: error.responseText,
							icon: 'error',
							confirmButtonText: 'OK'
						})
					}
				})
			}

			if(surat.attachments !== '' && surat.attachments !== null){
				$('#modalDetailSurat #attachments').html(`
					<hr/>
					<a href="${ 'http://'+surat.attachments }">Download attachments</a> <br>
					<a href="${ 'http://'+surat.pdf }">Download pdf</a> <br>
				`);
			}

			if(surat.pdf !== '' && surat.pdf !== null){
				$('#modalDetailSurat #attachments').append(`
					<a href="${ 'http://'+surat.pdf }">Download pdf</a> <br>
				`);
			}

			$('#modalDetailSurat').modal('show');

			$('#modalDetailSurat').on('hidden.bs.modal', function(){
				$('#disposisiSummary').addClass('d-none');
				$('#balasanDisposisi').addClass('d-none');
				$('#balasanNotaRevisi').addClass('d-none');

				$.ajax({
					type: 'POST',
					url: baseURL+'api/postUpdateStatusDibacaSurat',
					data: {
						token: TOKEN,
						idSurat: id,
						penerima: MAIL,
						status: 'READ'
					},
					dataType: 'json',
					success: function (response){ 
						if(response.status !== 200){
							return Swal.fire({
								title: 'Update Status Dibaca Surat Gagal',
								text: response.message,
								icon: 'error',
								confirmButtonText: 'OK'
							})
						}

						initSuratMasukContent();
						
					},
					error: function (error) {
						Swal.fire({
							title: 'Update Status Dibaca Surat Gagal',
							text: error.responseText,
							icon: 'error',
							confirmButtonText: 'OK'
						})
					}
				})
			})
		
		// fq_20201007: end DetailSurat content
		
		$(document.body).on('click','.btnSetujuiSurat', function(){
			const id = $(this).data('id');
			
			$.ajax({
				type: 'POST',
				url: baseURL+'api/postUpdateApprovalSurat',
				data: {
					token: TOKEN,
					idSurat: id,
					status: 'APPROVED'
				},
				dataType: 'json',
				success: function (response){ 
					if(response.status !== 200){
						return Swal.fire({
							title: 'Persetujuan Surat Gagal',
							text: response.message,
							icon: 'error',
							confirmButtonText: 'OK'
						})
					}

					Swal.fire({
						title: 'Persetujuan Surat Berhasil',
						text: response.message,
						icon: 'success',
						confirmButtonText: 'OK'
					}).then(result => {
						initSuratMasukContent();
						//fq_20201008: show modal
						$('#modalDetailSurat').modal('show');
					});
				},
				error: function (error) {
					Swal.fire({
						title: 'Persetujuan Surat Gagal',
						text: error.responseText,
						icon: 'error',
						confirmButtonText: 'OK'
					})
				}
			})
		});

		$(document.body).on('click', '#btnKirimNotaRevisi', function(){
			
			const data = {
				idSuratRef: $('#notaRevisi #notaRevisiIdSurat').val(),
				pengirim: MAIL,
				penerima: $('#notaRevisi #notaRevisiPenerima').val(),
				memo: $('#notaRevisi #notaRevisiInput').val()
			}

			data.token = TOKEN;

			$.ajax({
				type: 'POST',
				url: baseURL+'api/postNotaRevisiSurat/',
				data: data,
				dataType: 'json',
				success: function (response){ 
					if(response.status !== 200){
						$('#loadingStatus').addClass('d-none');

						return Swal.fire({
							title: 'Kirim Nota Revisi Surat Gagal',
							text: response.message,
							icon: 'error',
							confirmButtonText: 'OK'
						});
					}

					Swal.fire({
						title: 'Sukses',
						text: response.message,
						icon: 'success',
						confirmButtonText: 'OK'
					}).then(result => {
						//fq_20201008: show modal
						$('#modalDetailSurat').modal('hide');
					});
				},
				error: function (error) {
					Swal.fire({
						title: 'Kirim Nota Revisi Surat Gagal',
						text: error.responseText,
						icon: 'error',
						confirmButtonText: 'OK'
					});
				}
			})

		})

		$(document.body).on('click', '#btnBuatNotaRevisi', function(){
			const id = $(this).data('id');
			const penerima = $(this).data('penerima');

			addTinymce('#notaRevisiInput', '');
			
			$('#modalDetailSurat #action').addClass('d-none');
			$('#modalDetailSurat #notaRevisi').removeClass('d-none');
			$('#modalDetailSurat #notaRevisi #notaRevisiIdSurat').val(id);
			$('#modalDetailSurat #notaRevisi #notaRevisiPenerima').val(penerima);
		})

		$(document.body).on('click', '#btnKirimBalasanDisposisi', function(){
			
			const data = {
				idSurat: $('#disposisiIdSurat').val(),
				pengirim: MAIL,
				penerima: $('#disposisiPenerima').val(),
				penerimaCc: $('#disposisiPenerimaCc').val(),
				memo: $('#disposisiMemo').val()
			}

			data.token = TOKEN;

			$.ajax({
				type: 'POST',
				url: baseURL+'api/postBalasanDisposisi/',
				data: data,
				dataType: 'json',
				success: function (response){ 
					if(response.status !== 200){
						$('#loadingStatus').addClass('d-none');

						return Swal.fire({
							title: 'Kirim Balasan Disposisi Gagal',
							text: response.message,
							icon: 'error',
							confirmButtonText: 'OK'
						});
					}

					Swal.fire({
						title: 'Sukses',
						text: response.message,
						icon: 'success',
						confirmButtonText: 'OK'
					}).then(result => {
						$('#modalDetailSurat').modal('hide');
					});
				},
				error: function (error) {
					Swal.fire({
						title: 'Kirim Balasan Disposisi Gagal',
						text: error.responseText,
						icon: 'error',
						confirmButtonText: 'OK'
					});
				}
			})
		})

		$(document.body).on('click', '#btnBuatBalasanDisposisi', function(){
			const id = $(this).data('id');

			addTinymce('#disposisiMemo', '');
			
			$('#modalDetailSurat #action').addClass('d-none');
			$('#modalDetailSurat #balasanDisposisi').removeClass('d-none');
			$('#modalDetailSurat #balasanDisposisi #disposisiIdSurat').val(id);
		})

		$(document.body).on('click', '#btnBatalNotaRevisi', function(){
			$('#modalDetailSurat #action').removeClass('d-none');
			$('#modalDetailSurat #notaRevisi').addClass('d-none');
		})

		$(document.body).on('click', '#btnBatalBalasanDisposisi', function(){
			$('#modalDetailSurat #action').removeClass('d-none');
			$('#modalDetailSurat #balasanDisposisi').addClass('d-none');
		})

		$(document.body).on('click', '#btnBuatRevisiSurat', function(){
			const id = $(this).data('id');
			const penerima = $(this).data('penerima');
			isRevision = true;

			$.ajax({
				type: 'POST',
				url: baseURL+'api/getSuratDetail',
				data: {
					token: TOKEN,
					idSurat: id,
				},
				dataType: 'json',
				success: function (response){ 
					console.log('response ==> ', response);
					if(response.status !== 200){
						return Swal.fire({
							title: 'Ambil Data Detail Surat Gagal',
							text: response.message,
							icon: 'error',
							confirmButtonText: 'OK'
						})
					}

					$('.modal').css('overflow-y', 'auto');
					$('#modalDetailSurat').modal('hide');
					
					const suratDetail = response.data;

					$('#modalBuatSurat #idSurat').val(suratDetail.id);
					$('#modalBuatSurat #nomorSurat').val(suratDetail.nomorSurat);
					$('#modalBuatSurat #jenisSurat').val(suratDetail.jenisSurat);
					$('#modalBuatSurat #penerima').val(suratDetail.penerima);
					$('#modalBuatSurat #penerimaCc').tagsinput('add', suratDetail.penerimaCc);
					$('#modalBuatSurat #lampiran').val(suratDetail.lampiran);
					$('#modalBuatSurat #tanggalTerimaSurat').val(suratDetail.tanggalTerimaSurat);
					$('#modalBuatSurat #perihal').val(suratDetail.perihal);
					$('#modalBuatSurat #sifat').val(suratDetail.sifat);
					$('#modalBuatSurat #rujukan').val(suratDetail.rujukan);
					
					addTinymce('#memo', suratDetail.memo)

					$('#modalBuatSurat').modal('show');
				},
				error: function (error) {
					Swal.fire({
						title: 'Ambil Data Detail Surat Gagal',
						text: error.responseText,
						icon: 'error',
						confirmButtonText: 'OK'
					})
				}
			})
		})

		$(document.body).on('click', '#btnTutupDisposisiSummary', function(){
			$('#disposisiSummary').html('');
		});

		// untuk surat baru atau revisi surat
		$('#modalBuatSurat').on('hidden.bs.modal', function(){
			if(isRevision){
				$('#modalDetailSurat').modal('show');
			}
		});

		// untuk surat baru atau revisi surat
		$('#modalDetailSurat').on('hidden.bs.modal', function(){
			$('#modalDetailSurat #action').removeClass('d-none');
			$('#modalDetailSurat #balasanDisposisi').addClass('d-none');
			$('#modalDetailSurat #notaRevisi').addClass('d-none');
		});

		$(document.body).on('click', '#btnSummaryDisposisi', function(){
			const id = $(this).data('id');
			const data = {
				idSuratRef: id
			};

			data.token = TOKEN;

			$.ajax({
				type: 'POST',
				url: baseURL+'api/getDisposisiSummary',
				data: data,
				dataType: 'json',
				success: function (response){ 
					console.log(response);
					if(response.status !== 200){
						$('#loadingStatus').addClass('d-none');

						return Swal.fire({
							title: 'Ambil Data Summary Disposisi Gagal',
							text: response.message,
							icon: 'error',
							confirmButtonText: 'OK'
						});
					}

					if(response.data.diteruskanKepada.length === 0){
						$('#disposisiSummary').removeClass('d-none');
						$('#disposisiSummary').html(`
							<div class="card">
								<div class="card-body">
									<div class="d-flex justify-content-between">
										<h3>Summary Disposisi</h3>
										<p><button class="btn btn-light" id="btnTutupDisposisiSummary">x</button></p>
									</div>
									<div class="row">
										Belum ada data summary disposisi
									</div>
								</div>
							</div>
						`);
						return ;
					}

					let memo = '';
					$.each(response.data.memo, function(id, d){
						memo += d.memo+'<br>'
					})

					let diteruskanKepada = '';
					$.each(response.data.diteruskanKepada, function(id, d){
						if(d !== null || d !== '') diteruskanKepada += d+'<br>'
					})

					$('#disposisiSummary').removeClass('d-none');
					$('#disposisiSummary').html(`
						<div class="card">
							<div class="card-body">
								<div class="d-flex justify-content-between">
									<h3>Summary Disposisi</h3>
									<p><button class="btn btn-light" id="btnTutupDisposisiSummary">x</button></p>
								</div>
								<div class="row">
									<div class="col"><strong>Catatan : </strong><br> ${memo}</div>
									<div class="col"><strong>Diteruskan Kepada : </strong><br> ${diteruskanKepada}</div>
								</div>
							</div>
						</div>
						<hr/>
					`);
				},
				error: function(error){
					Swal.fire({
						title: 'Ambil Data Summary Disposisi Gagal',
						text: error.responseText,
						icon: 'error',
						confirmButtonText: 'OK'
					});
				}
			})
		});

		$('#jenisSurat').on('change', function(){
			const jenisSurat = $(this).val();

			if(jenisSurat !== 'DISPOSISI'){
				$('#tanggalTerimaSuratInput').addClass('d-none');
				$('#rujukanInput').addClass('d-none');
			}else{
				$('#tanggalTerimaSuratInput').removeClass('d-none');
				$('#rujukanInput').removeClass('d-none');
			}
		});

		$('#btnBuatSurat').on('click', function(){
			isRevision = false;

			$('#formBuatSurat').trigger('reset');
			$('#formBuatSurat #penerimaCc').tagsinput('removeAll');
			
			addTinymce('#memo', '');
			$('#modalBuatSurat').modal('show');
		});

		$('#formBuatSurat').on('submit', function(e){
			e.preventDefault();
			const formData = new FormData(this);
			formData.append('pengirim', MAIL);
			formData.append('token', TOKEN);
			formData.append('isManager', ISMANAGER);
			formData.append('manager', MANAGER);
			
			if(isRevision){
				revisiSurat(formData);
			}else{
				buatSurat(formData);
			}
		});

		function buatSurat(formData){
			$.ajax({
				type: 'POST',
				url: baseURL+'api/postSurat/',
				data: formData,
				processData: false,
				contentType: false,
				dataType: 'json',
				success: function (response){ 
					console.log('postSurat response :: ', response);
					if(response.status !== 200){
						$('#loadingStatus').addClass('d-none');

						return Swal.fire({
							title: 'Kirim Surat Gagal',
							text: response.message,
							icon: 'error',
							confirmButtonText: 'OK'
						});
					}

					Swal.fire({
						title: 'Sukses',
						text: response.message,
						icon: 'success',
						confirmButtonText: 'OK'
					}).then(result => {
						$('#modalBuatSurat').modal('hide');
						if(mode === 'INBOX'){
							initSuratMasukContent();
						}else{
							initSuratKeluarContent();
						}
					});
				},
				error: function (error) {
					Swal.fire({
						title: 'Kirim Surat Gagal',
						text: error.responseText,
						icon: 'error',
						confirmButtonText: 'OK'
					});
				}
			})
		}

		function revisiSurat(formData){
			$.ajax({
				type: 'POST',
				url: baseURL+'api/postRevisiSurat/',
				data: formData,
				processData: false,
				contentType: false,
				dataType: 'json',
				success: function (response){ 
					console.log('postRevisiSurat response :: ', response);
					if(response.status !== 200){
						$('#loadingStatus').addClass('d-none');

						return Swal.fire({
							title: 'Kirim Revisi Surat Gagal',
							text: response.message,
							icon: 'error',
							confirmButtonText: 'OK'
						});
					}

					Swal.fire({
						title: 'Sukses',
						text: response.message,
						icon: 'success',
						confirmButtonText: 'OK'
					}).then(result => {
						isRevision = false;
						$('#modalBuatSurat').modal('hide');
						if(mode === 'INBOX'){
							initSuratMasukContent();
						}else{
							initSuratKeluarContent();
						}
					});
				},
				error: function (error) {
					Swal.fire({
						title: 'Kirim Revisi Surat Gagal',
						text: error.responseText,
						icon: 'error',
						confirmButtonText: 'OK'
					});
				}
			})
		}

		function addTinymce(selector, content){
			tinymce.remove(selector);
			tinymce.init({
				selector: selector,
				height: 500,
				setup: function (editor) {
					editor.on('init', function () {
						editor.setContent(content);
					});
					editor.on('change', function () {
						editor.save();
					});
				}
			});
		}

		$('#surat-masuk-tab').on('click', function(){
			mode = 'INBOX';
			$('#suratKeluar').html('');
			initSuratMasukContent();
		});

		$('#surat-keluar-tab').on('click', function(){
			mode = 'OUTBOX';
			$('#suratMasuk').html('');
			initSuratKeluarContent();
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