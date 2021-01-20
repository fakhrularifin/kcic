
$(function(){
    window.isAdmin = function isAdmin() {
        var guid_logged = "<?php echo $this->session->userdata('guid'); ?>";
		//alert(group_logged);
		if(	guid_logged == '1004') { 
		return true;
			} else { 
		return false; 
		}
    }
});
function initClientAttributes(params){
  api_url = params['api_url'];
  base_url = params['base_url'];
  assets_url = params['assets_url'];
  activeUserId = params['uid'];
  curlTimeout = params['curlTimeout'];
  token = params['token'];
  email = params['email'];
}
function show_alert() {
	alert('test');
}
function show_alerts() {
	alert('test');
}
function swal(swal_type, swal_title, swal_text) {
	Swal.fire({
	type: swal_type,
	title: swal_title,
	text: swal_text
});
}
function show_toast(status, message){
    var bgColor='#fff';
    switch(status){
        case 'success':
            bgColor = '#1cc88a';
            break;
        case 'info':
			bgColor = '#36b9cc';
			break;
        case 'warning':
            bgColor = '#f6c23e';
            break;
        case 'danger':
            bgColor = '#e74a3b';
            break;
        default:
            bgColor = '#858796';
            break;
    }

    $.toast({
        text: message,
        hideAfter: 2000,
        position: 'mid-center',
        loader: false,
        bgColor: bgColor,
        textAlign:'center',
        showHideTransition: 'fade',
        stack:false
    });
}
function login(email, password){
  const payload = JSON.stringify({
    email: 'anggie.gunawan@kcic.co.id',
    password: 'test123'
  });
  
  $("#btn-login").attr("disabled","disabled");
  $("#message-panel").show();
  $("#message-body").html("<h5 class='text-info'>Masukkan username dan kata sandi untuk melakukan login</h5>");

  $.ajax({
    type: "POST",
    url: apiUrl+"/api/auth/postLogin",
    data: payload,
    dataType : "json",
      success: function (response) {
        $("#btn-login").removeAttr("disabled");

        if(response.responseCode === "0"){
          var message = "<h5 class='text-success'>Login berhasil !</h5>";
          var wsResponse = response.responseDesc;
          $("#message-body").html("<span class='text-info'>"+message+wsResponse+"</span>");
        }else{
          var message = "<h5 class='text-danger'>Login gagal !</h5>";
          var wsResponse = response.responseDesc;
          $("#message-body").html("<span class='text-danger'>"+message+wsResponse+"</span>");
        }
      },
      error:function(error){
        alert(error);
      }
  });
}
function activateMenu(menu){
  $('.nav li.current').removeClass('active');
  $('.nav #'+menu).addClass('active');
}

