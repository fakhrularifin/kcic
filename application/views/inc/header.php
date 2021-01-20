<!DOCTYPE html>
<html lang="en" class="fullscreen-bg">

<head>
	<title><?php echo ucwords(str_replace("_", " ", $this->uri->segment(1)))." | "?>Kereta Cepat Indonesia</title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0">
	<!-- VENDOR CSS -->
	<link rel="stylesheet" href="<?php echo base_url('assets/css/bootstrap.min.css')?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/vendor/datatables/dataTables.bootstrap4.min.css')?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/vendor/font-awesome/css/font-awesome.min.css')?>">
	<link rel="stylesheet" href="<?php echo base_url('assets/vendor/linearicons/style.css')?>">
    <!--<link rel="stylesheet" href="<?php echo base_url('assets/vendor/chartist/css/chartist-custom.css')?>">-->
	<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
	<link rel="stylesheet" href="<?php echo base_url('/assets/vendor/timepicker/jquery.timepicker.min.css')?>">
	<!--<link rel="stylesheet" href="<?php echo base_url('assets/vendor/tokeninput/token-input-facebook.css')?>">-->
	
	<!--<link href="//cdn.quilljs.com/1.3.6/quill.snow.css" rel="stylesheet">
	<link href="//cdn.quilljs.com/1.3.6/quill.bubble.css" rel="stylesheet">-->
	<link href="<?php echo base_url('/assets/vendor/htmleditor/summernote-lite.min.css')?>" rel="stylesheet">
	<link href="<?php echo base_url('/assets/plugins/bootstrap-tagsinput/tagsinput.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('/assets/vendor/tokenize/tokenize2.min.css')?>" rel="stylesheet">
	<!-- MAIN CSS -->
	<link rel="stylesheet" href="<?php echo base_url('assets/css/main.css')?>">
	
	<!-- <link rel="stylesheet" href="<?php echo base_url('assets/css/demo.css')?>"> -->
	<!-- ICONS -->
	<link rel="apple-touch-icon" href="<?php echo base_url('assets/img/apple-icon.png')?>">
	<link rel="icon" type="image/png" href="<?php echo base_url('assets/img/favicon.png')?>">
	<!-- MESSAGEMODAL 
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.css">-->
	<!-- GOOGLE FONTS -->
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700" rel="stylesheet">


	<!-- JAVASCRIPT -->
	<script src="<?php echo base_url('/assets/vendor/jquery/jquery.min.js');?>"></script>

	<script src="<?php echo base_url('/assets/vendor/bootstrap/js/bootstrap.min.js');?>"></script>

	<!--<script src="<?php echo base_url('/assets/vendor/jquery-slimscroll/jquery.slimscroll.min.js');?>"></script>-->

	<!--<script src="<?php echo base_url('/assets/vendor/jquery.easy-pie-chart/jquery.easypiechart.min.js');?>"></script>-->

	<!--<script src="<?php echo base_url('/assets/vendor/chartist/js/chartist.min.js');?>"></script>-->

	<!--<script src="<?php echo base_url('/assets/scripts/theme-common.js');?>"></script>-->

	<!--<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.js"></script>-->

	<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

	<script src="<?php echo base_url('/assets/vendor/datatables/jquery.dataTables.min.js');?>"></script>

	<script src="<?php echo base_url('/assets/vendor/datatables/dataTables.bootstrap.min.js');?>"></script>

	<script type="text/javascript" src="<?php echo base_url('/assets/scripts/lib.js') ?>"></script>

	<script src="<?php echo base_url('/assets/vendor/timepicker/jquery.timepicker.min.js');?>"></script>

	<script src="<?php echo base_url('/assets/vendor/tokeninput/jquery.tokeninput.js');?>"></script>

	<script src="<?php echo base_url('/assets/vendor/htmleditor/summernote-lite.min.js');?>"></script>

 
  <!-- Bootstrap Select -->
  <script src="<?php echo base_url('assets/plugins/bootstrap-select-1.13.14/dist/js/bootstrap-select.min.js') ?>"></script>

  <!-- Sweet Alert 2 -->
  <script src="<?php echo base_url('assets/plugins/sweetalert2/dist/sweetalert2.all.min.js')?>"></script>
  
  <!-- popper -->
  <script src="<?php echo base_url('assets/plugins/popper/popper.min.js')?>"></script>
  
  <!-- typeahead -->
  <script src="<?php echo base_url('assets/vendor/typeahead/typeahead.js')?>"></script>
  
  <!-- boostrap tagsinput -->
  <script src="<?php echo base_url('assets/plugins/bootstrap-tagsinput/tagsinput.js')?>"></script>
  
    <!-- boostrap tagsinput -->
  <script src="<?php echo base_url('assets/vendor/tokenize/tokenize2.min.js')?>"></script>
    
  <!-- momentJS -->
  <script src="<?php echo base_url('assets/plugins/moment/moment.min.js')?>"></script>
  <script src="<?php echo base_url('assets/plugins/moment/moment-timezone-with-data.js')?>"></script>
</head>
