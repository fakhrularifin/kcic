<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if(!function_exists('remove_comma')) {
  function remove_comma($value) {
    return str_replace(',','',$value);
  }
}
if(!function_exists('show_alert')) {
  function show_alert($text) {
    echo "<script>alert('$text')</script>";
  }
}
if(!function_exists('swal_alert')) {
  function swal_alert($type,$title,$text) {
	  echo "
	<script>
	  	Swal.fire({
		type: '$type',
		title: '$title',
		text: '$text'
		});
	</script>";
  }
}
if(!function_exists('show_toast')) {
  function show_toast($text) {
    echo "<script>alert('$text')</script>";
  }
}

?>