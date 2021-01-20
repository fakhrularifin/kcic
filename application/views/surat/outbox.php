<style>
td.label-red {
	font-weight: bold;
	color: #ff0000;
}
.row-red {
	font-weight: bold;
	background-color: #ff0000;
}
.dataTables_wrapper .bottom{
	margin-top:15px;
}
.table tr:hover {
	/* background-color: #ffe6e6; */
	cursor: pointer;
}
.d-none {
	display: none !important;
}
ul.ui-autocomplete {
    z-index: 1100;
}
</style>
<body>
	<!-- wrapper -->
	<div id="wrapper">
		<!-- nav top -->
		<?php $this->view("inc/nav-top"); ?>
		<?php // require_once(APPPATH.'views/shared/topbar.php'); ?>

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
					<h3 class="page-title">List Surat Keluar</h3>
					<!-- page -->
					<div class="row">
						<!-- start content -->
						<div class="col-md-12">
						
							<!-- content2 -->
							<div class="panel">

								<div class="panel-body">
									<div class="table-responsive">
										<table class="table table-hover" id="dataTable" style="width:100%">
											<thead class="thead-light" style="font-height:bold; font-size:16px">
												<tr class="text-center">
													<th></th>
													<th>Jenis Surat</th>
													<!-- <th>Nomor Surat</th> -->
													<!-- <th>Asal</th> -->
													<th>Tujuan</th>
													<th width="30%">Perihal</th>
													<th>Tanggal Surat</th>
													<th>Sifat</th>
													<th>Aksi</th>
												</tr>
											</thead>
											<tbody></tbody>
											<!-- <tfoot>
											<tr>
												<th></th>
												<th></th>
												<th></th>
												<th></th>
												<th></th>
												<th></th>
												<th></th>
												<th></th>
												<th></th>
											</tr>
											</tfoot> -->
										</table>
									</div>
								</div>
								<!-- <div class="panel-footer">
									Surat Keluar : <span class="label label-success"></span>
								</div> -->
							</div>
						</div>
						<!-- end content -->
				
					</div>
					<!-- end page -->
				</div>
			</div>
			<!-- end main content -->
		</div>
		<!-- end main -->
        
        <!-- start modal -->
		<!--  Modal Buat Surat -->
		<?php $this->view("shared/modal_buat_surat");
		//require_once(APPPATH.'views/shared/modal_buat_surat.php'); ?>
	
        <!--  Modal Detail Surat-->
        <?php $this->view("shared/modal_detail_surat");
		//require_once(APPPATH.'views/shared/modal_detail_surat.php'); ?>
        <!-- end modal -->
        
        <!-- footer -->
		<?php //$this->view("inc/footer"); ?>
        <!-- end footer -->
      </div>
      <!-- end wrapper -->
    <!-- Javascript -->
    <?php $this->view("inc/js"); ?>
    <?php //require_once(APPPATH.'views/shared/libs.php'); ?>

	<script>
	String.prototype.ucwords = function() {
		return this.toLowerCase().replace(/\b[a-z]/g, function(letter) {
			return letter.toUpperCase();
		});
	}
	$(document).ready(function() {
	//fq_20201008: new logic getsurat
		$( ".search_user" ).autocomplete({
        source: function( request, response ) {
          $.ajax({
            url: baseURL+"surat/get_list_user",
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
	let detailSurat = [];
	// mode surat, apakah revisi atau buat surat baru
	let isRevision = false;
			
		$.ajax({
		type: 'POST',
		url: baseURL+'api/getSuratKeluar',
		data: {
			token: TOKEN,
			pengirim: MAIL
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
							pemeriksa: d.pemeriksa,
							sifat: d.sifat,
							tanggalSurat: moment(d.tanggalSurat).format('DD MMMM YYYY HH:mm:ss')
						});
						//console.log('detailSurat :: ', detailSurat);

						let aksi = ``;

						let sifat = 'NORMAL';
						if(d.sifat !== null){
							sifat = d.sifat === 'NORMAL' ? '<span class="label label-info">NORMAL</span>' : '<span class="label label-danger">URGENT</span>'
						}
						
						let statusDisetujui = '';
						if(d.statusDisetujui === 'APPROVED'){
							statusDisetujui = `<span class="badge label label-success">Sudah Disetujui Atasan</span>`;
						}else if(d.statusDisetujui === 'NOT APPROVED'){
							statusDisetujui = `<span class="label label-danger">Belum Disetujui Atasan</span>`;
						}

						if(d.tanggalSurat != null){
							tglSurat = moment(d.tanggalSurat).format('DD-MM-YYYY');
							tglSurat +=  "<br><small>"+moment(d.tanggalSurat).format('HH:mm:ss')+"</small>"
						}else{
							tglSurat = '-';
						}

						data.push({
							id: d.id,
							status: d.statusDibaca === 'READ' ? '<span><i class="fa fa-envelope-open"></i></span>' : '<span><i class="fa fa-envelope"></i></span>',
							jenisSurat: d.jenisSurat.replaceAll('_', ' ').ucwords(),
							tanggalSurat: tglSurat,
							pengirim: d.pengirim,
							penerima: d.penerima,
							nomorSurat: d.nomorSurat,
							perihal: d.perihal === null ? d.jenisSurat.replace(/_|-/g, " ") : d.perihal,
							sifat: sifat,
							aksi: aksi
						});
					});

					$('#dataTable').DataTable().clear().destroy();
					$('#dataTable').DataTable({
						data: data,
						responsive: true,
	
						columns: [
							{ data: 'status' },
							{ data: 'jenisSurat' },
							// { data: 'nomorSurat' },
							// { data: 'pengirim' },
							{ data: 'penerima' },
							{ data: 'perihal' , render:function(data, type, row){
								nomorSurat = row.nomorSurat === null ? '' : '<small class="text-muted">'+row.nomorSurat+'</small><br>';

								return nomorSurat+row.perihal;
							}},
							{ data: 'tanggalSurat' },
							{ data: 'sifat' },
							{ data: 'aksi' },
						],
						"columnDefs": [ 
								{
								"targets": [1],
								"createdCell": function (td, cellData, rowData, row, col) {
								if ( cellData == 'UNREAD') {
									$(td,row).addClass('label-red');
									} }
								},
								{
								"targets": [0],
								"visible": true
								}
							
							],
							createdRow: function( row, data, dataIndex, cell ) {
										if (data.statusDibaca == "UNREAD"){
										  $(row).addClass( 'label-red' );
										}
										$(row).data( 'id', data.id );
									},
							initComplete: function () {
								this.api().columns(1).every( function () {
									var column = this;
									var select = $('<select class="form-control"><option value="" selected="selected">Jenis Surat</option></select>')
										.appendTo( $(column.header()).empty() )
										.on( 'change', function () {
											var val = $.fn.dataTable.util.escapeRegex(
												$(this).val()
											);
					 
											column
												.search( val ? '^'+val+'$' : '', true, false )
												.draw();
										} );
									// select.append( '<option value="" selected="selected">Jenis Surat</option>');
					
									column.data().unique().sort().each( function ( d, j ) {
										text = d.replaceAll('_', ' ');
										select.append( '<option value="'+d+'">'+text.ucwords()+'</option>' )
									} );
								} );
							},
							//"paging":   false,
							"ordering": false,
							"info":     true,
							"processing": false,
							"serverSide": false,
							"lengthChange": false,
							"pagingType": "simple_numbers",
							"dom": '<"top"f>rt<"bottom"<"pull-left"i>l<"pull-right"p>><"clear">',
							"lengthChange": false,
							"scrollY": (screen.height - 680) + 'px',
							"scrollX": true,        
							// "order": [[2, 'asc'], [0, 'desc'] ],
							"language": {
									search: '<i class="fa fa-search"></i>',
									processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>',
									sInfo: "_START_ - _END_ dari _TOTAL_ data"
								},
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
	
	//fq_20201008: end new logic getsurat	
	
			//$(document.body).on('click', '.btnDetailSurat', function(){
			$('table tbody').on('click','tr' ,function(){
			const id = $(this).data('id');
			const surat = detailSurat.find(s => s.id == id);
			
			$('#modalDetailSurat #action').html('');
			$('#modalDetailSurat #attachments').html('');
			
			$('#modalDetailSurat #detailSuratTitle').html(`
				<small class='text-muted'><i class='fa fa-calendar'></i> ${surat.tanggalSurat}</small>
				<h4 class='no-margin'>${surat.nomorSurat === null ? surat.jenisSurat.replace(/_|-/g, " ") : surat.nomorSurat}</h4>
				<span class='label label-primary'>${surat.jenisSurat}</span> ${surat.sifat === 'NORMAL' ? '<span class="label label-success">NORMAL</span>' : '<span class="label label-danger">URGENT</span>'}&nbsp;&nbsp;&nbsp;&nbsp;
			`);

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
						//console.log(response);
						if(response.status !== 200){
							return Swal.fire({
								title: 'Ambil Data Detail Surat Gagal',
								text: response.message,
								icon: 'error',
								confirmButtonText: 'OK'
							})
						}

						if(surat.pemeriksa === MAIL){
							//console.log('surat :: ', surat);
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
							<div id="memoRead" class="html-viewer"></div>
						`);
						$('.html-viewer').summernote({
							  height: 400,                 
							  maxHeight: 400,            
							  toolbar: []
							});
						$('.html-viewer').summernote('code', response.data.memo);

	
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
						//console.log(response);
						if(response.status !== 200){
							return Swal.fire({
								title: 'Ambil Data Detail Surat Gagal',
								text: response.message,
								icon: 'error',
								confirmButtonText: 'OK'
							})
						}

						$('#modalDetailSurat #detailSurat').html(`
						<table class="table-borderless" style="margin-bottom:15px;">
								<tr><td>Dari&nbsp</td> <td>&nbsp:&nbsp</td><td> ${response.data.pengirim} </td></tr>
								<tr><td>Kepada&nbsp</td> <td>&nbsp:&nbsp</td> <td>${response.data.penerima}</td></tr>
								<tr><td>CC&nbsp</td> <td>&nbsp:&nbsp</td> <td>${response.data.penerimaCc === null ? '' : response.data.penerimaCc} </td></td>
								<tr><td>Perihal&nbsp</td> <td>&nbsp:&nbsp</td> <td><b><u>${response.data.perihal}</u></b> </td></td>
							</table>
							<div id="memoRead" class="html-viewer"></div>
						`);
						$('.html-viewer').summernote({
							  height: 400,                 
							  maxHeight: 400,            
							  toolbar: []
							});
						$('.html-viewer').summernote('code', response.data.memo);
						//$('.html-viewer').summernote('disable');

						$('#modalDetailSurat #action').html('');
						
						$('#modalDetailSurat #action').html(`
							<button class="btn btn-info" id="btnBuatBalasanDisposisi" data-id="${surat.id}"><i class="fa fa-edit"></i> Buat Balasan Disposisi</button>&nbsp;<button class="btn btn-info pull-right" id="btnSummaryDisposisi" data-id="${surat.id}"><i class="fa fa-search"></i> Lihat Summary Disposisi</button>
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
						//console.log(response);
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
							<button class="btn btn-info" id="btnBuatBalasanDisposisi" data-id="${surat.idSuratRef}"><i class="fa fa-edit"></i> Buat Balasan Disposisi</button>&nbsp; 
							<button class="btn btn-info pull-right" id="btnSummaryDisposisi" data-id="${surat.idSuratRef}"><i class="fa fa-search"></i> Lihat Summary Disposisi</button>
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

						//initSuratMasukContent();
						
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
		});
	
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
			{ "data": "penerima" },
            { "data": "perihal" },
            { "data": "sifat" },
            { "data": "statusDibaca" }
        ],

		"columnDefs": [ 
		{
			"targets": [5],
			"createdCell": function (td, cellData, rowData, row, col) {
			if ( cellData == 'URGENT' || cellData == 'UNREAD' || cellData == 'REJECTED') {
				$(td).addClass('label label-danger');
			} else {
				$(td).addClass('label label-default')
			}
		} },
			{
			"targets": [6],
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
            this.api().columns(1).every( function () {
                var column = this;
                var select = $('<select><option value=""></option></select>')
                    .appendTo( $(column.header()).empty() )
                    .on( 'change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );
 
                        column
                            .search( val ? '^'+val+'$' : '', true, false )
                            .draw();
                    } );
				select.append( '<option value="" selected="selected">Jenis Surat</option>');

                column.data().unique().sort().each( function ( d, j ) {
                    select.append( '<option value="'+d+'">'+d+'</option>' )
                } );
            } );
        },
		//"paging":   false,
        "ordering": false,
        "info":     true,
        "processing": false,
        "serverSide": false,
		"lengthChange": false,
		"pagingType": "simple_numbers",
		"dom": '<"top"f>rt<"bottom"ilp><"clear">',
		"lengthChange": false,
		"scrollY": (screen.height - 680) + 'px',
		"scrollX": true,        
		"order": [[1, 'asc'], [6, 'desc'] ],
		"language": {
				search: '<i class="fa fa-search"></i>',
                processing: '<i class="fa fa-spinner fa-spin fa-3x fa-fw"></i>',
				sInfo: "_START_ -_END_ dari _TOTAL_ data"
            },
    } );
	
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
						$('#modalDetailSurat').modal('hide');
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

			//addTinymce('#notaRevisiInput', '');
			//$('#notaRevisiInput').summernote('code', '');
			
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

			//addTinymce('#disposisiMemo', '');
			//$('#disposisiMemo').summernote('code', '');
			
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
					
					//addTinymce('#memo', suratDetail.memo)
					$('#memo').summernote('code', suratDetail.memo);
					
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
							<div class="panel">
								<div class="panel-body">
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
						<div class="panel">
							<div class="panel-body">
								<div class="d-flex justify-content-between">
								<p><button class="btn close" id="btnTutupDisposisiSummary">x</button></p>
								<h4>Summary Disposisi</h4>
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
			
			//addTinymce('#memo', '');
			//$('#memo').summernote('code', '');

			
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
		
	$('.html-editor').summernote({
		  height: 400,                 
		  maxHeight: 400,            
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

	//$('table tbody').on('click','tr' ,function(){
		 //var name = $('td', this).eq(0).text();
		// const id = $(this).data('id');
        // console.log(id);
        //if(typeof $(this).data('id') != 'undefined'){
        //        window.location.href='<?php //echo base_url('surat/read/');?>'+$(this).data('id');
      //  }
   // });
} );
	
	</script>
    <!-- end Javascript -->
    </body>
</html>