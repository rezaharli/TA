<ol class="breadcrumb">
	<?php for ($i=1; TRUE ; $i++) {
		$link = base_url();
		for ($j=1; $j <= $i; $j++) { 
			$link .= $this->uri->segment($j).'/';
		}
		?>
		<li <?php if($this->uri->segment($i + 1) == '') echo 'class="active"'?>>
			<a href="<?php echo $link ?>"><?php echo ucwords($this->uri->segment($i)) ?></a>
		</li>
		<?php if($this->uri->segment($i + 1) == '') break;
	} ?>
</ol>