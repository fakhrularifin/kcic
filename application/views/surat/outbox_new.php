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
							<div class="panel-title">Buat Surat Keluar</div>
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
								<div class="panel-body">
                                <form id="form-data" class="form-horizontal" action="" method="post" enctype="multipart/form-data">
								<span>Nomor Surat</span><input name="nomor_surat" type="text" class="form-control"><br>
									<span>Jenis Surat</span><br>
										<input name="jenis_surat" value="SURAT_KELUAR" type="radio">
										<span>Surat Keluar </span>
										<input name="jenis_surat" value="NOTA_DINAS" type="radio">
										<span>Nota Dinas </span>
										<input name="jenis_surat" value="DISPOSISI" type="radio">
										<span>Disposisi </span><br><br>
                                    <span>Kepada</span><input id="penerima" name="penerima" type="text" class="form-control search_form" placeholder="email tujuan">
									<br>
                                    <span>CC</span><input type="text" name="penerima_cc" id="penerima_cc" class="form-control search_form" placeholder="cc email">
									<br>
                                    <span>Tanggal Surat</span><input name="tanggal_surat" type="text" class="form-control date_form" placeholder="tahun-bulan-tanggal">
									<br>
									<span>Tanggal Terima Surat</span><input type="text" name="tanggal_terima_surat" class="form-control date_form" placeholder="tahun-bulan-tanggal">
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
									<span>Memo</span><textarea name="memo" rows="4" class="form-control" id="alasan" placeholder="memo"></textarea>
                                    <br>
									 <span>Lampiran</span><input type="file" name="attachments" class="form-control">
                                     <br>
									<span>Keterangan Lampiran</span><input type="text" name="lampiran" class="form-control">
                                    <br>
									<button id="form-btn" type="button" class="btn btn-primary" ><i class="fa fa-paper-plane-o"></i> Kirim</button>
									<button type="reset" class="btn btn-default"><i class="fa fa-refresh"></i> Reset</button>
                                    </form>
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
	  
	  //$('#penerima_cc').multiple_emails();
	$("#form-btn").click(function(){
			var data = $('#form-data').serialize();
			$.ajax({
				type: 'POST',
				url: baseURL+"surat/post_surat",
				data: data,
				success: function() {
					//$('.tampildata').load("tampil.php");
					alert('data disimpan');
					window.location = "<?php echo base_url('surat/outbox_list');?>";

				}
			});
		});
	
	
		function getDynamictable(){
		var table = "";
		$.ajax({ 
		type: 'GET', 
		url: baseURL+"cuti/get_pengajuan_cuti", 
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
						if(jsondata['data'][i]['status']=='NOT APPROVED') {
							var status_class = "label label-danger";
						} else {
							var status_class = "label label-success";
						}
						  table += "<tr>"+
								  "<td>"+(i+1)+"</td>"+
								  "<td>"+jsondata['data'][i]['pengaju']+"</td>"+
								  "<td>"+jsondata['data'][i]['tanggalMulai']+"</td>"+
								  "<td>"+jsondata['data'][i]['tanggalAkhir']+"</td>"+
								  "<td>"+jsondata['data'][i]['tipe']+": "+jsondata['data'][i]['jenis']+"</td>"+
								  "<td>"+jsondata['data'][i]['alasan']+"</td>"+
								  "<td><span class=\""+status_class+"\">"+jsondata['data'][i]['status']+"</span></td>"+
								  "<td><button type=\"button\" data-fpid=\""+jsondata['data'][i]['id']+"\" value=\"approved\" class=\"btn btn-success\">Approve</button> <button type=\"button\" data-fpid=\""+jsondata['data'][i]['id']+"\" value=\"rejected\" class=\"btn btn-danger\">Reject</button></td>"+
								 
								
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
	</script>
    <!-- end Javascript -->
    </body>
</html>