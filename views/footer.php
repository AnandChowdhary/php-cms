		<div style="margin-top: 30px; text-align: center">&copy; <?php echo date("Y") . " " . $site -> name; ?></div>
		<script src="<?php echo getSiteUrl(); ?>assets/jquery.js"></script>
		<script src="<?php echo getSiteUrl(); ?>assets/alloy.js"></script>
		<script src="<?php echo getSiteUrl(); ?>assets/scripts.js"></script>
		<script> if ($("#writecontent").length) { AlloyEditor.editable("writecontent"); } </script>
	</body>
</html>