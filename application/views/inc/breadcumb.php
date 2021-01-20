<!-- Breadcrumbs-->
<nav aria-label="breadcrumb">
	<div class="pull-right">
		<ol class="breadcrumb">
			<li class="breacrumb-item">
				<a href="<?php echo base_url()?>"><span class="lnr lnr-home"></span> Home</a>
			</li>
		<?php foreach ($this->uri->segments as $segment): ?>
			<?php 
				$url = substr($this->uri->uri_string, 0, strpos($this->uri->uri_string, $segment)) . $segment;
				$is_active =  $url == $this->uri->uri_string;
			?>
			<li class="breadcrumb-item <?php echo $is_active ? 'active': '' ?>">
				<?php if($is_active): ?>
					<?php echo ucwords(str_replace("_"," ",$segment)) ?>
				<?php else: ?>
					<a href="<?php echo site_url($url) ?>"><?php echo ucwords(str_replace("_"," ",$segment)) ?></a>
				<?php endif; ?>
			</li>
		<?php endforeach; ?>
		</ol>
	</div>
</nav>