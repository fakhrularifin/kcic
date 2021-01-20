  <!-- Bootstrap core JavaScript-->
  <script src="<?php echo base_url('assets/templates/sbadmin2/vendor/jquery/jquery.min.js') ?>"></script>
  <script src="<?php echo base_url('assets/templates/sbadmin2/vendor/bootstrap/js/bootstrap.bundle.min.js') ?>"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?php echo base_url('assets/templates/sbadmin2/vendor/jquery-easing/jquery.easing.min.js') ?>"></script>

  <!-- Gauge JS-->
  <script src="<?php echo base_url('assets/templates/sbadmin2/vendor/canvas-gauge/gauge.min.js') ?>"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?php echo base_url('assets/templates/sbadmin2/js/sb-admin-2.min.js')?>"></script>

  <!-- Page level plugins -->
  <script src="<?php echo base_url('assets/templates/sbadmin2/vendor/datatables/jquery.dataTables.min.js')?>"></script>
  <script src="<?php echo base_url('assets/templates/sbadmin2/vendor/datatables/dataTables.bootstrap4.min.js')?>"></script>
  
  <!-- JQuery Toast Plugin -->
  <script src="<?php echo base_url('assets/plugins/jquery-toast-plugin/dist/jquery.toast.min.js')?>"></script>

  <!-- Sswitch Plugin -->
  <script src="<?php echo base_url('assets/plugins/sswitch/js/Sswitch.js')?>"></script>

  <!-- fontawesome-colorpicker  -->
  <script src="<?php echo base_url('assets/plugins/fontawesome-iconpicker/js/fontawesome-iconpicker.js')?>"></script>

  <!-- JQuery Ace Editor -->
  <script src="<?php echo base_url('assets/plugins/cheef-jquery-ace/ace/ace.js')?>"></script>
  <script src="<?php echo base_url('assets/plugins/cheef-jquery-ace/ace/theme-monokai.js')?>"></script>
  <script src="<?php echo base_url('assets/plugins/cheef-jquery-ace/ace/mode-javascript.js')?>"></script>
  <script src="<?php echo base_url('assets/plugins/cheef-jquery-ace/jquery-ace.min.js')?>"></script>

  <!-- Bootstrap Select -->
  <script src="<?php echo base_url('assets/plugins/bootstrap-select-1.13.14/dist/js/bootstrap-select.min.js') ?>"></script>

  <!-- Sweet Alert 2 -->
  <script src="<?php echo base_url('assets/plugins/sweetalert2/dist/sweetalert2.all.min.js')?>"></script>
  
  <!-- popper -->
  <script src="<?php echo base_url('assets/plugins/popper/popper.min.js')?>"></script>
  
  <!-- typeahead -->
  <script src="<?php echo base_url('assets/plugins/typeahead/typeahead.bundle.min.js')?>"></script>
  
  <!-- boostrap tagsinput -->
  <script src="<?php echo base_url('assets/plugins/bootstrap-tagsinput/tagsinput.js')?>"></script>
  
  <!-- tinyMCE -->
  <script src="<?php echo base_url('assets/plugins/tinymce/js/tinymce/tinymce.min.js')?>"></script>
  
  <!-- momentJS -->
  <script src="<?php echo base_url('assets/plugins/moment/moment.min.js')?>"></script>
  <script src="<?php echo base_url('assets/plugins/moment/moment-timezone-with-data.js')?>"></script>

  <script>
    const baseURL = "<?php echo base_url() ?>";

	//const baseURL = "http://api.pirantipandawa5.com/surat/";

    const apiURL = "<?php echo $this->config->item('api_url') ?>";
    
    //const MAIL = window.localStorage.getItem('mail');
    //const TOKEN = window.localStorage.getItem('token');
    //const ISMANAGER = window.localStorage.getItem('isManager');
    //const MANAGER = window.localStorage.getItem('manager');
	
	const MAIL = "<?php echo $this->session->userdata('email'); ?>";
    const TOKEN = "<?php echo $this->session->userdata('token'); ?>";
    const ISMANAGER = "<?php echo $this->session->userdata('is_manager'); ?>";
    const MANAGER = "<?php echo $this->session->userdata('manager'); ?>";
    
    // set username on topbar
    $('#topbarUsername').html(MAIL);
    
    //generate menu according to userlevel
    let adminMenu = '';

    // if userlevel is superadmin or admin, add admin menu
    // if(USERLEVEL == 0 || USERLEVEL == 1){
    //   adminMenu = `
    //     <div class="sidebar-heading mt-3">
    //         ADMINISTRATION
    //     </div>

    //     <li class="nav-item" id="menu-device-sharing">
    //     <a class="nav-link" href="${baseURL + 'admin/device_sharing'}">
    //         <i class="fas fa-fw fa-microchip"></i>
    //         <span>Device Sharing</span>
    //     </a>
    //     </li>

    //     <li class="nav-item" id="menu-user-management">
    //     <a class="nav-link" href="${baseURL + 'admin/user_management'}">
    //         <i class="fas fa-fw fa-users"></i>
    //         <span>User Management</span>
    //     </a>
    //     </li>
    //   `;
    // }

    // //sidebar menu items
    // $('#sidebarMenuItems').html(`
    //     <li class="nav-item" id="menu-device-overview">
    //     <a class="nav-link" href="${baseURL + 'overview'}">
    //         <i class="fas fa-fw fa-columns"></i>
    //         <span>Device Overview</span></a>
    //     </li>

    //     <li class="nav-item" id="menu-mydashboard">
    //     <a class="nav-link" href="${baseURL + 'dashboard'}">
    //         <i class="fas fa-fw fa-tachometer-alt"></i>
    //         <span>My Dashboard</span></a>
    //     </li>

    //     <div class="sidebar-heading mt-3">
    //         INFORMATIONS
    //     </div>

    //     <li class="nav-item" id="menu-devices">
    //     <a class="nav-link" href="${baseURL + 'device'}">
    //         <i class="fas fa-fw fa-microchip"></i>
    //         <span>Devices</span>
    //     </a>
    //     </li>

    //     <li class="nav-item" id="menu-messages">
    //     <a class="nav-link" href="${baseURL + 'message'}">
    //         <i class="fas fa-fw fa-envelope"></i>
    //         <span>Messages</span>
    //         <span id="sidebarMessageCount"></span>
    //     </a>
    //     </li>

    //     <li class="nav-item" id="menu-alerts">
    //     <a class="nav-link" href="${baseURL + 'alert'}">
    //         <i class="fas fa-fw fa-bell"></i>
    //         <span>Alerts</span>
    //         <span id="menu-badges-alerts"></span>
    //     </a>
    //     </li>

    //     <div class="sidebar-heading mt-3">
    //         DEVELOPERS
    //     </div>

    //     <li class="nav-item" id="menu-parsers">
    //     <a class="nav-link" href="${baseURL + 'parser'}">
    //         <i class="fas fa-fw fa-code"></i>
    //         <span>Parsers</span>
    //     </a>
    //     </li>

    //     <li class="nav-item" id="menu-connectors">
    //     <a class="nav-link" href="${baseURL + 'connector'}">
    //         <i class="fas fa-fw fa-plug"></i>
    //         <span>Connectors</span>
    //     </a>
    //     </li>

    //     <li class="nav-item" id="menu-callbacks">
    //     <a class="nav-link" href="${baseURL + 'callback'}">
    //         <i class="fas fa-fw fa-exchange-alt"></i>
    //         <span>Callbacks</span>
    //     </a>
    //     </li>

    //     <li class="nav-item" id="menu-downlinks">
    //     <a class="nav-link" href="${baseURL + 'downlink'}">
    //         <i class="fas fa-fw fa-arrow-circle-down"></i>
    //         <span>Downlinks</span>
    //     </a>
    //     </li>

    //     ${adminMenu}
    // `);

    var dataTableLanguage = {
      "search":         "<i class='fa fa-search'></i>",
      "loadingRecords": "<img src='"+baseURL+"assets/img/loading.gif' width='100'>",
      "processing":     "<img src='"+baseURL+"assets/img/loading.gif' width='100'>",
      "paginate": {
          "first":      "<i class='fa fa-chevron-left'></i><i class='fa fa-chevron-left'></i>",
          "last":       "<i class='fa fa-chevron-right'></i><i class='fa fa-chevron-right'></i>",
          "next":       "<i class='fa fa-chevron-right'></i>",
          "previous":   "<i class='fa fa-chevron-left'></i>"
      }
    };
    var geoloc;
    var colorLib = ['#1B9CFC','#3ae374','#ff4d4d','#b71540','#706fd3','#34ace0','#7158e2','#B33771','#D6A2E8','#25CCF7'];
    
    $('#logoutLink').click(function(){
      logout();
    });

    function logout(){
        window.localStorage.clear();
        window.location.replace(baseURL);
    }

    function setActiveMenu(menu,submenu){
        $('#menu-'+menu).addClass('active');

        if(submenu != null){
            $('#submenu-'+menu).addClass('show');
            $('#submenu-'+menu+'-item-'+submenu).addClass('active');
        }
    }

    function clearModalForm(formId, element){
        for(i = 0 ; i < element.length ; i++){
            $('#'+formId+' #'+element[i]).val('');
        }
    }

    function setLoadingState(status){
        if(status == false){
            $('.loadingState').html('');
        }else{
            $('.loadingState').html(`
                <div class="spinner-border spinner-border-sm" role="status">
                    <span class="sr-only">Loading...</span>
                </div>
            `);
        }
    }
        
  </script>