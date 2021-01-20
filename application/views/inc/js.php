<script>
    const baseURL = "<?php echo base_url() ?>";
	const MAIL = "<?php echo $this->session->userdata('email'); ?>";
    const TOKEN = "<?php echo $this->session->userdata('token'); ?>";
    const ISMANAGER = "<?php echo $this->session->userdata('is_manager'); ?>";
    const MANAGER = "<?php echo $this->session->userdata('manager'); ?>";
</script>
