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
								<div class="panel-title">List Surat Masuk</div>
								<a href="<?php echo base_url('surat/arsip_new') ?>" class="btn btn-primary pull-left"><i class="fa fa-envelope"> </i> Buat Surat baru</a><br>
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
									<th>Tujuan Surat</th>
									<th>Perihal</th>
									<th>Sifat</th>
									<th>Status</th>
								</tr>
								</thead>
								<tbody></tbody>
								<tfoot>
								<tr>
									<th></th>
									<th></th>
									<th></th>
									<th></th>
									<th></th>
									<th></th>
									<th></th>
								</tr>
								</tfoot>
							  </table>
							  
								</div>
								<div class="panel-footer">
									<div class="row">
                                    total Surat Masuk: <span class="label label-success"></span>
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
	
	$('table tbody').on('click','tr' ,function(){
        //alert($(this).data('id'));
        if(typeof $(this).data('id') != 'undefined'){
                window.location.href='<?php echo base_url('surat/read/');?>'+$(this).data('id');
        }
    });

	} );
	
	</script>
    <!-- end Javascript -->
    </body>
</html>