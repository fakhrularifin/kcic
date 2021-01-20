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
					<!-- page -->
					<h3 class="page-title">Booking Ruang Rapat</h3>
					
						<div class="row">
							<div class="col-md-12">
								<div class="panel">
								<div class="panel-body">
									<form id="form-data" class="" action="" method="post">
										<div class="form-group row">
											<label class="col-md-12">Ruangan</label><input type="hidden" value="<?php echo $this->input->get('id');?>" class="form-control" name="id_ruang_rapat" placeholder="<?php echo $this->input->get('id');?>">
											<div class="col-md-3">
												<select class="form-control col-md-3" name="idRuangRapat" id="idRuangRapat">
												</select>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-md-12">Tanggal Penggunaan</label>
											<div class="col-md-3">
												<input type="text" class="form-control date_form" name="tanggal" placeholder="tanggal booking">
											</div>
										</div>
										<div class="form-group row">
											<label class="col-md-12">Jam Mulai</label>
											<div class="col-md-3">
												<input type="text" class="form-control time_form" name="jam_mulai" placeholder="hh:mm:ss">
											</div>
										</div>
										<div class="form-group row">
											<label class="col-md-12">Jam Akhir</label>
											<div class="col-md-3">
												<input type="text" class="form-control time_form" name="jam_akhir" placeholder="hh:mm:ss">
											</div>
										</div>
										<div class="form-group row">
											<label class="col-md-12">Peserta</label>
											<div class="col-md-3">
												<input type="text" class="form-control search_form" name="peserta">
											</div>
										</div>
										<div class="form-group">
											<label>Opsi</label><br>
										<label class="fancy-checkbox"><input type="checkbox" name="makan_siang" value="Y"><span> Perlu makan siang atau tidak (Y/N) </span></label>
										<label class="fancy-checkbox"><input type="checkbox" name="akun_zoom" value="Y"><span>  Perlu akun zoom untuk meeting virtual atau tidak? (Y/N) </span></label>
										<label class="fancy-checkbox"><input type="checkbox" name="video_conf" value="Y"><span>  Perlu persiapan alat untuk video conference atau tidak (Y/N) </span></label>
										</div>
										<div class="form-group">
											<label>Permintaan dari Tamu</label><textarea name="request_tamu" rows="4" class="form-control" id="request_tamu" placeholder="request tamu"></textarea>
										</div>
										<div class="form-group">
										<button id="form-btn" type="button" class="btn btn-primary" ><i class="fa fa-paper-plane-o"></i> Kirim</button>
										<button type="reset" class="btn btn-default"><i class="fa fa-refresh"></i> Reset</button>
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
		$( function() {
		$('.time_form').timepicker({
			'timeFormat': 'H:i:s',
			'minTime':'07:00:00',
			'maxTime':'21:00:00'
		});

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
	  
		$("#form-btn").click(function(){
			var data = $('#form-data').serialize();
			$.ajax({
				type: 'POST',
				url: baseURL+"meeting/post_pengajuan_jadwal",
				data: data,
				success: function() {
					//$('.tampildata').load("tampil.php");
					alert('data disimpan');
					//window.location = "<?php echo base_url('meeting/meeting_list');?>";
				}
			});
		});
		
		 getDynamicmenu();
 function getDynamicmenu()
 {
  var html_menu = '<option value="">Pilih Ruangan tersedia</option>';
  $.ajax({ 
		type: 'GET', 
		url: baseURL+"meeting/get_current_jadwal", 
		dataType: "json",
		success: function (jsondata) {
			var len = jsondata.length;
			console.log(jsondata);
					if(jsondata['data'].length != 0){
						for(var i = 0 ; i < jsondata['data'].length ; i++){
						  html_menu += '<option value="'+jsondata['data'][i]['idRuangRapat']+'">'+jsondata['data'][i]['nama']+" "+jsondata['data'][i]['status']+'</option>';
						}
						$('#idRuangRapat').html(html_menu);
					} 
					else{
						
					  $('#idRuangRapat').html("Belum ada Data");
					}
				  },
				  error:function(error){
					//alert("gagal memuat data");
				  }
  });
 }
	$(document).ready(function(){
		
	//dataProcess();
	function dataProcess(){
		var table = "";
		$.ajax({ 
		type: 'POST', 
		url: baseURL+"meeting/post_pengajuan_jadwal", 
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
								  "<td><button type=\"button\" class=\"btn btn-success\">Approve</button> <button type=\"button\" class=\"btn btn-danger\">Reject</button></td>"+
								"</tr>";
						}

						$('#table-content').html(table);
					  
					}else{
					  $('#table-content').html("Belum ada Data");
					}
				  },
				  error:function(error){
					//alert("gagal memuat data");
					$("#reg-info").html(error);
				  }
		});
		}
	});
	</script>
    <!-- end Javascript -->
    </body>
</html>