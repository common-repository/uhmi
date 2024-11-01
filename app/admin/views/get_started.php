<div class="uhmi-get-started">
	
	<?php
	if (file_exists(UHMI_PLUGIN_DIR_ADMIN . '/views/partials/header.php')) {
			
		include UHMI_PLUGIN_DIR_ADMIN . '/views/partials/header.php';

	}
	?>
	
	<div class="uhmi-get-started-wrap uhmi-get-started-step<?php echo esc_attr( $step ) ?>">
		
		<?php
		if (file_exists(UHMI_PLUGIN_DIR_ADMIN . "/views/get_started/step-$step.php")) {
				
			include UHMI_PLUGIN_DIR_ADMIN . "/views/get_started/step-$step.php";
			
		}
		?>
		
	</div>
	
	<div class="uhmi-decor uhmi-decor-left"></div>
	<div class="uhmi-decor uhmi-decor-right"></div>
	
</div>