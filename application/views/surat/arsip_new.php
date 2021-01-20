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
					<h3 class="page-title">Buat Surat Keluar</h3>
					<!-- page -->
					
					<div class="row">
						<!-- start content -->
						<div class="col-md-12">
							<!-- content2 -->
							<div class="panel">
								<!-- <div class="panel-heading">
									<div class="right">
										<button type="button" class="btn-toggle-collapse"><i class="lnr lnr-chevron-up"></i></button>
										<button type="button" class="btn-remove"><i class="lnr lnr-cross"></i></button>
									</div>
								</div> -->
								<div class="panel-body">
									<form id="formBuatSurat" enctype="multipart/form-data">
									<div>
									<!-- start panel body -->
										<div class="panel-body">	
											<div id="modalFormArea" class="m-4">
											
												<input type="hidden" name="idSurat" id="idSurat">
												<div class="form-group">
													<label for="nomorSurat">Nomor Surat</label>
													<input type="text" class="form-control" name="nomorSurat" id="nomorSurat" />
												</div>
												<div class="form-group">
													<label for="jenisSurat">Jenis Surat</label>
													<select name="jenisSurat" id="jenisSurat" class="form-control">
														<option value="">-- Pilih Jenis Surat --</option>
														<option value="SURAT_KELUAR">Surat Keluar</option>
														<option value="NOTA_DINAS">Nota Dinas</option>
														<option value="DISPOSISI">Disposisi</option>
													</select>
												</div>
												<div class="form-group">
													<label for="penerima">Tujuan</label>
													<input id="penerima" name="penerima" type="text" class="form-control search_user" placeholder="email tujuan">
												</div>
												<div class="form-group">
													<label for="penerimaCc">Tembusan</label>
													<input type="text" class="form-control search_multiuser" name="penerimaCc" id="penerimaCc" placeholder="email tembusan" />
												</div>
												<div class="form-group d-none" id="tanggalTerimaSuratInput">
													<label for="tanggalTerimaSurat">Tanggal Terima Surat</label>
													<input type="text" class="form-control date_form" name="tanggalTerimaSurat" id="tanggalTerimaSurat" />
												</div>
												<div class="form-group">
													<label for="perihal">Perihal</label>
													<input type="text" class="form-control" name="perihal" id="perihal" />
												</div>
												<div class="form-group">
													<label for="sifat">Sifat Surat</label>
													<select class="form-control" name="sifat" id="sifat">
														<option value="">-- Sifat Surat --</option>
														<option value="NORMAL">Normal</option>
														<option value="URGENT">Urgent</option>
													</select>
												</div>
												<div class="form-group d-none" id="rujukanInput">
													<label for="rujukan">Surat Rujukan</label>
													<input type="text" class="form-control" name="rujukan" id="rujukan" />
												</div>
												<div class="form-group">
													<label for="memo">Memo</label>
													<textarea id="memo" name="memo" class="html-editor"></textarea>
												</div>
												<div class="form-group" id="attachments">
													<label for="attachments">Attachments</label>
													<input type="file" class="form-control" name="attachments" id="attachments"/>
												</div>
												<div class="form-group">
													<label for="lampiran">Keterangan Lampiran</label>
													<input type="text" class="form-control" name="lampiran" id="lampiran" />
												</div>
												
										</div>
									</div>
									<!-- end panel body -->
									<div class="panel-footer">
										<div id="action" class="text-right"> 
										<button type="submit" class="btn btn-primary"><i class="fa fa-paper-plane-o"></i> Kirim</button>
										</div>
									</div>
									</div>
									</form>
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
	$( function() {
		$( ".date_form" ).datepicker();
		$( ".date_form" ).datepicker( "option", "dateFormat", "yy-mm-dd" );
	} );
		$( ".search_user" ).autocomplete({
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
	  	$('.html-editor').summernote({
		  height: 300,                 
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
	
	$(function() {
  	var tagsList = [ "abdullah.faqih@kcic.co.id","anggie.gunawan@kcic.co.id","bayu.aditya@kcic.co.id","moh.irvan@kcic.co.id" ];

	var split = function( val ) {
		return val.split( "," );
	};
	
	var extractLast = function( term ) {
		return split( term ).pop();
	};
	
	$( ".search_multiuser" ).on( "keydown", function( event ) {
		if ( event.keyCode === $.ui.keyCode.TAB && $( this ).autocomplete( "instance" ).menu.active ) {
			event.preventDefault();
		}
	}).autocomplete({
		source: function( request, response ) {
			response( $.ui.autocomplete.filter(
				tagsList, extractLast( request.term ) ) );
		},
		focus: function() {
			return false;
		},
		select: function( event, ui ) {
			var terms = split( this.value );
			terms.pop();
			terms.push( ui.item.value );
			terms.push( "" );
			this.value = terms.join( "," );
			return false;
		}
	})
	});
	 /* $('.cc').tokenInput("<?php echo base_url('surat/get_list_user');?>", {
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
		  });*/
		  /*
	$("#form-btn").click(function(){
			var data = $('#form-data').serialize();
			$.ajax({
				type: 'POST',
				url: baseURL+"surat/post_surat",
				data: data,
				success: function() {
					//$('.tampildata').load("tampil.php");
					alert('data disimpan');
					window.location = "<?php //echo base_url('surat/outbox');?>";

				}
			});
		});*/
	
	
	$(document).ready(function() {
	let isRevision = false;
	
	  $('#editor').summernote({
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
	</script>
    <!-- end Javascript -->
    </body>
</html>