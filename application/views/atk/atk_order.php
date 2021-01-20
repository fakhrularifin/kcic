<body>
	<!-- wrapper -->
	<div id="wrapper">
		<!-- nav top -->
		<?php $this->view("inc/nav-top"); ?>
        <style>
            #order_jumlah{
                width:80px;
            }
        </style>
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
					<h3 class="page-title">Form Pemesanan ATK</h3>
					<!-- page -->
					
					<div class="row">
                        <div class="col-md-4">
							<div class="panel">
								<div class="panel-body">
									<form id="form-add" action="" method="post">
										<div class="form-group row">
                                            <label class="control-label col-md-12">Jenis ATK</label>
                                            <div class="col-md-12">
                                                <select class="form-control" name="jenis" id="jenis">
                                                    <option value="">-- Pilih Jenis ATK --</option>
                                                    <option value="pulpen">Pulpen</option>
                                                    <option value="pencil">Pencil</option>
                                                </select>
                                                <input type="hidden" class="form-control" name="id" id="id" value="0">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-md-12">Jumlah</label>
                                            <div class="col-md-12">
                                                <input type="number" class="form-control" name="jumlah" id="jumlah" min="1" autocomplete="off">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-md-12">Unit</label>
                                            <div class="col-md-12">
                                            <input type="text" class="form-control" name="unit" id="unit" value="pcs" readonly>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="control-label col-md-12">Harga Satuan</label>
                                            <div class="col-md-12">
                                            <input type="number" class="form-control" name="harga" id="harga" value="20000" min="0" readonly>
                                            </div>
                                        </div>
									</form>
								</div>
                                <div class="panel-footer text-right">
                                    <button id="add-btn" type="button" class="btn btn-primary" ><i class="fa fa-plus"></i> Tambah Item</button>
                                </div>
							</div>
						</div>
				
						<div class="col-md-8">
							<div class="panel">
								
								<div class="panel-body">
									<table class="table" id="tbl_order">
										<thead class="thead-light">
											<th>No</th>
											<th>Jenis</th>
											<th>Jumlah</th>
											<th>Satuan</th>
											<th>Harga Satuan</th>
											<th>Harga Total</th>
											<th></th>
										</thead>
										<tbody id="table-content"></tbody>
                                        <tfoot>
                                            <tr>
                                                <th colspan="5" class="text-right">Jumlah Total</th>
                                                <th class="text-right"></th>
                                                <th></th>
                                            </tr>
                                        </tfoot>
									</table>
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
        var count = 0;
        var formatter = new Intl.NumberFormat('id-ID', {
            style: 'currency',
            currency: 'IDR',
        });

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

		
		$(document).ready(function(){
			// getDynamictable();
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

            tbl_order = $('#tbl_order').DataTable({
                "responsive" : true,
                "bLengthChange" : false,
                "paging": false,
                "order": [],
                /* "ajax": {
                    "url": "<?php echo site_url('rfm/get_sparepart');?>",
                    "type": "POST",
                    "data": function(d) {
                        d.rfmno = "<?php echo $rfm->RFMNO?>";
                    }
                }, */
                "columns": [
                    
                    { data: "no" },
                    { data: "jenis" },
                    { data: "jumlah", render: function(data,type, row){
                        return "<input type='number' class='form-control input_jumlah' id='order_jumlah' name='order[]' min='1' value='"+data+"'>";
                    }, className: "text-right"},
                    { data: "unit",},
                    { data: "harga", render: (function (data, type, row){
                        return formatter.format(data);
                    }), className: "text-right"},
                    { data: "total_harga", render: (function (data, type, row){
                        return formatter.format(data);
                    }), className: "text-right"},
                    { data: "id", render: (function(data, type, row){
                        return "<button class='btn btn-xs btn-danger btn_del_item' data-id='"+data+"'><i class='fa fa-trash'></i></button>"
                    }), className: "text-center" },
                ],
                "columnDefs": [ 
                    {
                        "targets": '_all', "orderable": false,
                    }
                ],
                "dom" : 'lrt',
                "drawCallback": function(){
                    // $('#tbl_sparepart').removeClass('dataTable');
                    var api = this.api();
                    var data = api.rows().data();
                    var sum = 0;
                    $.each(data, function (index, value) {
                        sum += parseInt(value.total_harga);
                    });
                    $( api.column(5).footer() ).html(formatter.format(sum));
                    $( api.columns().header() ).addClass( 'text-center' );
                },
                language: {
                    "emptyTable": "<div class='pad text-muted'>Belum ada data</div>"
                }
            });

            $('#tbl_order').on('change', '.input_jumlah', function (){
                let data = tbl_order.row($(this).parents('tr')).data();
                let node = tbl_order.row($(this).parents('tr')).node();
                let val = $(this).val();
                data.total_harga = data.harga * val;
                data.jumlah = val;
                cell = tbl_order.cell(node, 5).node();
                $(cell).html(formatter.format(data.total_harga));
                console.log(node);
                tbl_order.draw();
                // console.log(tbl_order.row($(this).parents('tr')).data());
            })

			function getDynamictable(data = ''){
				var table = "";
                if(data == ''){
                    table = "<tr class='empty'>"+
                            "<td colspan='7' class='text-center' style='vertical-align:middle;height:150px'>"+
                            "<p class='text-muted'>Belum ada data</p>"+
                            "</td>"+
                            "<tr>";
                    $('#table-content').hide().html(table).fadeIn();
                }else{
                    table = "<tr>"+
                            "<td>"+count+"</td>"+
                            "<td>"+data['jenis']+"</td>"+
                            "<td class='text-right'>"+data['jumlah']+"</td>"+
                            "<td>"+data['unit']+"</td>"+
                            "<td class='text-right'>"+formatter.format(data['harga'])+"</td>"+
                            "<td class='text-right'>"+formatter.format((data['harga']*data['jumlah']))+"</td>"+
                            "<td><button class='btn btn-xs btn-danger'><i class='fa fa-times'></i></button></td>"+
                            "</tr>";

                    $('#table-content tr.empty').hide();
                    $('#table-content').append(table);
                }

				/* $.ajax({ 
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
				}); */
            }

            $("#add-btn").click(function(){
                let valid = true;

                if($('#jumlah').val() < 1 || $('#jumlah').val() == ''){
                    valid = false;
                    msg = "Jumlah item harus lebih dari 0";
                }

                if($('#jenis').val() == ''){
                    valid = false;
                    msg = "Mohon pilih jenis ATK";
                }

                if(valid){
                    var data = $('#form-add').serializeArray();
                    dataObj = {};
                    
                    $(data).each(function(i, field){
                        dataObj[field.name] = field.value;
                    });
                    count++;
                    dataObj['no'] = count;
                    dataObj['total_harga'] = dataObj['harga'] * dataObj['jumlah'];

                    $('#jenis option:selected').attr('disabled', true)
                    $('#form-add :input').not('[readonly]').val('');
                    
                    tbl_order.row.add(dataObj).draw();
                }else{
                    alert(msg);
                }

                
                // getDynamictable(dataObj);
                
            });

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