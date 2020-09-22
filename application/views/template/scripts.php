<!-- Bootstrap core JavaScript-->
<script src="<?= base_url() ?>public/vendor/jquery/jquery.min.js"></script>
<script src="<?= base_url() ?>public/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- <script src="<?= base_url() ?>public/js/bootstrap-datetimepicker.min.js"></script> -->
<!-- <script src="<?= base_url() ?>public/js/locales/bootstrap-datetimepicker.pt-BR.js"></script> -->
<script src="<?= base_url() ?>public/js/usuario.js"></script>
<script src="<?= base_url() ?>public/js/util.js"></script>

<!-- Core plugin JavaScript-->
<script src="<?= base_url() ?>public/vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="<?= base_url() ?>public/js/sb-admin-2.min.js"></script>
<script src="<?= base_url() ?>public/js/sweetalert2.all.min.js"></script>
<!-- Page level plugins -->


<link href="<?= base_url() ?>public/css/select2.css" rel="stylesheet">
<script src="<?= base_url() ?>public/js/select2.min.js"></script>

<!--
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
-->

<?php
if (isset($scripts)) {
	foreach ($scripts as $script_name) {
		$src = base_url() . "public/js/" . $script_name;
		?>
		<script src="<?= $src ?>"></script>
		<?php
	}
}
?>
<!-- Select 2 inicio -->       
<script>
	$(document).ready(function () {
		$('.select2').select2();
	});
</script>
<script>
	function permissao(){

			swal({
				title: "Atenção!",
				text: "Voce não tem permissão para acessar esta pagina!!",
				type: "warning",
				confirmButtonText: "Ok",
				closeOnConfirm: true,
			}).then((result) => {
				setTimeout(location.href= "restrict", 0);
			})
		
	}
</script>
<!-- Select 2 Fim --> 

</body>

</html>

