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
.d-none {
	display: none !important;
}
	body{ font-family:calibri;}
	.twitter-typeahead { display:initial !important; }
	.bootstrap-tagsinput {line-height:40px;display:block !important;}
	.bootstrap-tagsinput .tag {background:#09F;padding:5px;border-radius:4px;}
	.tt-hint {top:2px !important;}
	.tt-input{vertical-align:baseline !important;}
	.typeahead { border: 1px solid #CCCCCC;border-radius: 4px;padding: 8px 12px;width: 300px;font-size:1.5em;}
	.tt-menu { width:300px; }
	span.twitter-typeahead .tt-suggestion {padding: 10px 20px;	border-bottom:#CCC 1px solid;cursor:pointer;}
	span.twitter-typeahead .tt-suggestion:last-child { border-bottom:0px; }
	.demo-label {font-size:1.5em;color: #686868;font-weight: 500;}
	.bgcolor {max-width: 440px;height: 200px;background-color: #c3e8cb;padding: 40px 70px;border-radius:4px;margin:20px 0px;}
#tags {
  max-width: 250px;
  margin: 2.5em auto;
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
				<div class="container-fluid">
					<!-- page -->
					<div class="panel panel-headline">
                    <!-- breadcumb -->
						<?php $this->view("inc/breadcumb"); ?>
					<!-- end breadcumb -->
						<div class="panel-heading">
								<div class="panel-title">List Surat Masuk</div>
								<a href="#"  id="btnBuatSurat" class="btn btn-primary pull-left"><i class="fa fa-envelope"> </i> Buat Surat baru</a><br>

						</div>

						<div class="panel-body">
							<div class="row">
                            
						<!-- start content -->
						<div class="col-md-12">
                        
							<!-- content2 -->
							<div class="panel">

								<div class="panel-body">
								<table class="table table-hover table-responsive" id="dataTable">
								<thead style="text-height:bold; font-size:16px">
								<tr class="text-center">
                                	<th></th>
									<th>Jenis Surat</th>
									<th>Tanggal Surat</th>
                                    <th>Nomor Surat</th>
									<th>Asal</th>
									<th>Tujuan</th>
									<th>Perihal</th>
									<th>Sifat</th>
                                    <th>Aksi</th>
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
                                    <th></th>
                                    <th></th>
								</tr>
								</tfoot>
							  </table>
							  <select class="demo" multiple>
                                  <option value="1">Acura</option>
                                  <option value="2">Audi</option>
                                  <option value="3">BMW</option>
                                  <option value="4">Cadillac</option>
                                  <option value="5">Chevrolet</option>
                                  <option value="6">Ferrari</option>
                                  <option value="7">Ford</option>
                                  <option value="8">Honda</option>
                                  <option value="9">Lexus</option>
                                  <option value="10">Mercedes-Benz</option>
                                </select>
								</div>
								<div class="panel-footer">
									<div class="row">
                                    Surat Masuk: <span class="label label-success"></span>
									</div>
								</div>
							</div>
                            simple tagsinput
                            <input type="text" value="Amsterdam" id="tags1" data-role="tagsinput"  />
                            
							tokenize: <input type="text" value="" id="tags2" />

						</div>
                        <span>Kepada</span><input id="penerima" name="penerima" type="text" class="form-control search_user" placeholder="email tujuan">
									<br>
                                    <span>CC</span><input type="text" name="penerima_cc" id="penerima_cc" class="form-control search_user cc" placeholder="cc email">
                        <!-- end content -->
                        			<div class="bgcolor">
                                        <form action="javascript:void(0)" method="post">
                                          <div class="form-group">
                                            <input type="text" class="form-control" id="tags" />
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
	
$(function() {
  var tagsList = [ "CSS", "JavaScript", "HTML", "HTML5", "jQuery", "AngularJS", "Express", "PHP", "Python", "Node.js", "MySQL", "MongoDB" ];

var split = function( val ) {
    return val.split( "," );
};

var extractLast = function( term ) {
    return split( term ).pop();
};

$( "#tags" ).on( "keydown", function( event ) {
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

$('.demo').tokenize2({
  dataSource:[
  {"text":"Afghanistan","value":"AF"},
  {"text":"Åland Islands","value":"AX"},
  {"text":"Albania","value":"AL"},
  {"text":"Algeria","value":"DZ"},
  {"text":"American Samoa","value":"AS"},
  {"text":"Andorra","value":"AD"},
  {"text":"Angola","value":"AO"}
]
});


	
	$(document).ready(function() {
	//fq_20201008: new logic getsurat
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
	  
	$("input[type=button]").click(function() {
        var names = [];
        $(this).siblings("ul").find('li p').each(function(){
            names.push($(this).html());
            //names.push($(this).text());//possibly better
        });
        alert("Names are: " + names.join());
    });
	  
	$('#penerima_cc').tokenInput("<?php echo base_url('surat/get_list_user');?>", {
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
		  
	console.log(document.getElementById('penerima_cc'));
	$('#penerima_cc').on('change',function(){
			console.log(document.getElementById('penerima_cc'));

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